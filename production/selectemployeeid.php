<?php
error_reporting(null);
 include_once "../classes/Employee.php";
 $em = new Employee();

 if (isset($_POST['Emplyeeval'])) {
 	$id = $_POST['Emplyeeval'];
 	$emdetails = $em->Tbl_Col_Id_Like('customer','id','customerid',$id);
 	if ($emdetails) {
 		$data = $emdetails->fetch(PDO::FETCH_OBJ);
 		if ($data) {
 			echo $data->id;
 		}else{
 			echo "";
 		}
 		
 	}
 }
?>
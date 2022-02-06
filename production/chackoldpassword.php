<?php
 include_once "../classes/Login.php";
 $em = new Login();

 if (isset($_POST['oldpass'])) {
 	$id = $_POST['oldpass'];
 	$pass = md5($id);
 	$emdetails = $em->Tbl_Col_Id_LIMITE_0('user','pass',$pass);
 	if ($emdetails) {
 		echo "<p style='color:green;font-size:25px;font-weight:bold;'>Matched</p>";
 	}else{
 		echo "<p style='color:red;font-size:25px;font-weight:bold;'>Not Match</p>";
 	}
 }
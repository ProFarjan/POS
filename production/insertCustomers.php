<?php
 include_once "../classes/Employee.php";
 $em = new Employee();

 if (isset($_POST['code2']) || isset($_POST['name2']) || isset($_POST['phone2'])) {
 	$code2 = $_POST['code2'];
 	$name2 = $_POST['name2'];
 	$phone2 = $_POST['phone2'];
 	$val = $_POST['val'];

 	$chack = $em->Tbl_Col_Id_2("customer","phone","typeval",$phone2,$val);
 	$chack_154 = $chack->fetch(PDO::FETCH_OBJ);
 	if ($chack_154) {
 		echo "1";
 	}else{
 		$insert = $em->Insert_Customer($code2,$name2,$phone2,$val);
 		if ($insert) {
 			$cutomer = $em->Tbl_Col_Id_LIMITE_0("customer","typeval","1");
	 		echo json_encode($cutomer);
	 	}else{
	 		echo "1";
	 	}
 	}

 }
?>
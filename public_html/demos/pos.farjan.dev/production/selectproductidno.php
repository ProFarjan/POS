<?php
error_reporting(null);
 include_once "../classes/Store.php";
 $em = new Store();

 if (isset($_POST['ProductVal'])) {
 	$id = $_POST['ProductVal'];
 	$emdetails = $em->Tbl_Col_Id('product','code',$id);
 	if ($emdetails) {
 		$data = $emdetails->fetch(PDO::FETCH_OBJ);
 		echo $productid = $data->id;
 	}
 }
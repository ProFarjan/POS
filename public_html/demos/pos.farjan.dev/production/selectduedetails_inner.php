<?php
if (isset($_POST["inv"])) {
	include_once "../classes/Employee.php";
 	$em = new Employee();
 	$inv = $_POST["inv"];
 	$payment_type = $_POST["payment_type"];
 	if ($payment_type == 1) {
 		$all_items = $em->tbl_select_any("income",array("invoice"=>$inv));
 	}else{
 		$all_items = $em->tbl_select_any("purchase",array("purchaseno"=>$inv));
 	}
 	
 	$all_due_list = $em->tbl_select_any("due",array("invoiceid"=>$inv));

 	$all_items_me = array();
 	while ($items = $all_items->fetch(PDO::FETCH_ASSOC)) {
 		$pro_id = $items["productid"];
 		$items["productid"] = $em->TBL_VAL_52("product","id",$pro_id,"name");
 		array_push($all_items_me, $items);
 	}

 	$all_due_list_me = array();
 	while ($due = $all_due_list->fetch(PDO::FETCH_ASSOC)) {
 		$userid = $due["received_by"];
 		$due["received_by"] = $em->TBL_VAL_52("user","id",$userid,"name");
 		array_push($all_due_list_me, $due);
 	}

 	$return_arr = array(
 		"items"=>$all_items_me,
 		"due"=>$all_due_list_me
 	);
 	echo json_encode($return_arr);
}

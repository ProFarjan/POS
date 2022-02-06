<?php
error_reporting(null);
 include_once "../classes/Store.php";
 $em = new Store();

 if (isset($_POST['ProductVal'])) {
 	$id = $_POST['ProductVal'];
 	$emdetails = $em->Tbl_Col_Id('product','code',$id);
 	if ($emdetails) {
 		$data = $emdetails->fetch(PDO::FETCH_OBJ);
 		if($data){
 		$productid = $data->id;
 		$st_data = $em->All_Store_Status($productid);
 		$sel_data = $em->Saleing_Product($productid);
 		$destroy = $em->TBL_VAL_52('destroy','productid',$productid,'destroy');
 		$sel_data1 = $sel_data->fetch(PDO::FETCH_OBJ);
 		if ($st_data->unit == '0') {
 			$total = ($st_data->TOTALCARTON)-($sel_data1->QUANTITY)-$destroy;
 			$unit = 'sq/ft';
 			$arr = array('total'=>$total,'unit'=>$unit);
 			echo json_encode($arr);
 		}elseif(!$st_data->unit){
 			$total = 'Not Add Store';
 			$unit = 'Undifine';
 			$arr = array('total'=>$total,'unit'=>$unit);
 			echo json_encode($arr);
 		}else{
 			$total =  ($st_data->QUANTITY)-($sel_data1->QUANTITY)-$destroy;
 			$unit = $st_data->unit;
 			$arr = array('total'=>$total,'unit'=>$unit);
 			echo json_encode($arr);
 		}


} else {echo "0";}
  }
 }
?>
<?php
error_reporting(null);
 include_once "../classes/Product.php";
 $po = new Product();

  if (isset($_POST['productcode'])) {
    $code = $_POST['productcode'];
    $data = $po->Tbl_Col_Id("product","code",$code);
    if ($data) {
    	$data_541 = $data->fetch(PDO::FETCH_ASSOC);
    	echo json_encode($data_541);
    }else{
    	$arr = array('id'=>'Not Fount','name'=>'Not Found','rate'=>'0','unit'=>'Null');
    	echo json_encode($arr);
    }
  }

?>
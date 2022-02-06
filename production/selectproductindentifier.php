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
	 		$protype = $em->SelectAll_By_ID('product',$productid);
	        $st_data = $em->Tbl_Col_Id_LIMITE_0('store','productid',$productid);
	        if (!$st_data) {
	            if($protype->type == "Tiles"){
echo "untiles"; } else { 
echo "unstore";
 } }else{ ?>

<?php if($protype->type == "Tiles"){ 
	echo "tiles";
 } else { 
 	echo "store";
  } } } } } ?>
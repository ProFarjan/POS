<?php
error_reporting(null);
 include_once "../classes/Customers.php";
 $em = new Customers();

 if (isset($_POST['ProductVal'])) {
 	$id = $_POST['ProductVal'];
 	$emdetails = $em->Tbl_Col_Id('product','id',$id);
 	if ($emdetails) {
 		$data = $emdetails->fetch(PDO::FETCH_OBJ);
	    if ($data) {
?>
	<ul style="margin:0;line-height: 10px;font-style: 17px;">
		<li>Code: <?php echo $data->code;?></li>
		<li>Catagroy: <?php echo $data->type;?></li>
		<li>Sub-Cat.: <?php echo $data->subtype;?></li>
		<li>Name: <?php echo $data->name;?></li>
		<li>Rate: <?php echo $data->rate;?></li>
	</ul>
<?php

	    }else{echo "Product Not Found";}
	}else{
		echo "Product Not Found";
	}
}
?>
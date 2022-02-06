<?php
error_reporting(null);
 include_once "../classes/Customers.php";
 $cu = new Customers();

 if (isset($_POST['Phone'])) {
 	$val = $_POST['Phone'];
 	$type = $_POST['typeval'];
 	$cudetails = $cu->SelectCustomerByID_244($val,$type);
 	if ($cudetails) {
?>

<ul class="list-group" style="position: absolute;width: 96%;z-index: 999;height: 400px;overflow-y: scroll;" class='countryList'>
	<?php
		while ($data_cu = $cudetails->fetch(PDO::FETCH_OBJ)) {
	?>
	<li class="list-group-item"><?php echo $data_cu->name." (<a>".$data_cu->phone."</a>)";?></li>
	<?php } ?>
</ul>

<?php } }

if (isset($_POST['myphone'])) {
	$myphone = $_POST['myphone'];
	$type = $_POST['typeval'];
	$cudetails = $cu->SelectCustomerByID_248($myphone,$type);
	if ($cudetails) {
		echo json_encode($cudetails);
	}else{
		$arr = array('customerid'=>'Not Found','name'=>'Not Found','phone'=>'Not Found','address'=>'Not Found');
		echo json_encode($arr);
	}
}



?>
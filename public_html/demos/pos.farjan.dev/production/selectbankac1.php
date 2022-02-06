<?php
error_reporting(null);
 include_once "../classes/Customers.php";
 $em = new Customers();

  if (isset($_POST['bankac'])) {
    $id = $_POST['bankac'];
    $acno = $_POST['value44'];
    $data = $em->Tbl_Col_Id_820('tbl_account','bankname',$id);
    if ($data) {
	    if ($acno == "bankname") {
	    	$data2 = $data->fetch(PDO::FETCH_OBJ);
	    	echo $data2->bankname;
	    }else{
?>
<?php
	while ($data1 = $data->fetch(PDO::FETCH_OBJ)) {
?>
<option><?php echo $data1->acnumber;?></option>
<?php } ?>
<?php } } } ?>
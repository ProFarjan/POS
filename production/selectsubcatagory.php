<?php
error_reporting(null);
 include_once "../classes/Employee.php";
 $em = new Employee();

 if (isset($_POST['Type'])) {
 	$id = $_POST['Type'];
 	$emdetails = $em->Tbl_Col_Id_820('catagory','type',$id);
 	if ($emdetails) {
 		while ($data = $emdetails->fetch(PDO::FETCH_OBJ)) {
?>
<option value="<?php echo $data->subtype?>"><?php echo $data->subtype?></option>
<?php }}} ?>

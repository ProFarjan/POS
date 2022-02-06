<?php
error_reporting(null);
 include_once "../classes/Employee.php";
 $em = new Employee();

 if (isset($_POST['val12'])) {
 	$id = $_POST['val12'];
 	$emdetails = $em->Tbl_Col_Id_2_Employee('customer','name','typeval',$id,'2');
 	if ($emdetails) {
 		while ($data = $emdetails->fetch(PDO::FETCH_OBJ)) {
?>
<ul>
	<li><?php echo $data->name;?></li>
</ul>
<?php } }else{echo "111";} } ?>
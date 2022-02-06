<?php
error_reporting(null);
 include_once "../classes/Customers.php";
 $em = new Customers();

  if (isset($_POST['bankac'])) {
    $id = $_POST['bankac'];
    $acno = $_POST['value44'];
    $data = $em->lIke_One_Col_Withou_Sum('cashin','acno',$id);
    if ($data) {
	    if ($acno == "bankname") {
	    	$data2 = $data->fetch(PDO::FETCH_OBJ);
	    	echo $data2->bankname;
	    }else{
?>
<ul>
<?php
	while ($data1 = $data->fetch(PDO::FETCH_OBJ)) {
?>
	<li><?php echo $data1->$acno;?></li>
<?php } ?>
</ul>
<?php } } } ?>
<?php
error_reporting(null);
 include_once "../classes/Employee.php";
 $em = new Employee();

$farjan = $em->SelectAll_By_ID('setting','1');
$invoice = $farjan->list1;
$purchase = $farjan->list2;

 if (isset($_POST['Emplyeeval'])) {
 	$id = $_POST['Emplyeeval'];
 	$status = $_POST['status'];
 	$emdetails = $em->Tbl_Col_Id_Like('customer','id','customerid',$id);
 	if ($emdetails) {
 		$data = $emdetails->fetch(PDO::FETCH_OBJ);
    if ($data) {
    	$result = $em->Tbl_Col_Id_2("payment","customerid","status",$data->id,$status);
    	if ($result) {
?>
<h2 style="text-align: center;"><?php if($status == '1'){echo "This Customer Previous Sales Details";}else{echo "This Supplier Previous Purchase Details";}?></h2>
<div class="x_title">
  <div class="x_content">
    <div class="col-md-12 col-sm-12 col-xs-12">
    	<table class="table table-striped table-bordered">
		  <tr>
		    <th>SL</th>
		    <th>Date</th>
		    <th><?php if($status == '1'){echo "Invoice";}else{echo "Purchase";}?></th>
		    <th>Discount</th>
		    <th>Paid</th>
		    <th>Due</th>
		  </tr>
		<?php
			$jvm = 0;
			while ($farjan = $result->fetch(PDO::FETCH_OBJ)) { $jvm++;
		?>
		  <tr>
		    <td><?php echo $jvm;?></td>
		    <td><?php echo $em->hl->formatDate01($farjan->date);?></td>
		    <td>
		    	<?php if($status == '1'){ ?>
		    	<a href="<?php echo $invoice;?>.php?invoice=<?php echo $farjan->invoice;?>" target="_blank"><?php echo $farjan->invoice;?></a>
		    	<?php } else{ ?>
		    	<a href="<?php echo $purchase;?>.php?invoice=<?php echo $farjan->invoice;?>" target="_blank"><?php echo $farjan->invoice;?></a>
		    	<?php } ?>
		    </td>
		    <td><?php echo $farjan->disamount;?></td>
		    <td><?php echo $farjan->payment;?></td>
		    <td><?php echo $farjan->currentdue;?></td>
		  </tr>
		<?php } ?>
		</table>
    </div>
  </div>
</div>

<?php } } } } ?>
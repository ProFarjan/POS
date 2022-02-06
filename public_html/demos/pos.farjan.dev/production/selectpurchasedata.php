<?php
error_reporting(null);
 include_once "../classes/Store.php";
 $em = new Store();

 if (isset($_POST['ProductVal'])) {
 	$id = $_POST['ProductVal'];
 	$emdetails = $em->Tbl_Col_Id('product','id',$id);
 	if ($emdetails) {
 		$data = $emdetails->fetch(PDO::FETCH_OBJ);
 		if($data){
 		$productid = $data->id;
 		$st_data = $em->All_Store_Status($productid);
 		$st_data_1 = $em->Tbl_Col_Id_LIMITE_0('store','productid',$productid);
 		$sel_data = $em->Saleing_Product($productid);
 		$sel_data1 = $sel_data->fetch(PDO::FETCH_OBJ);
 		if ($st_data->unit == '0') {
 			$total = ($st_data->TOTALCARTON)-($sel_data1->QUANTITY);
 			$unit = 'Percarton: '.$st_data_1->percarton.' sq/ft';
 			$unit1 = '0';
 		}else{
 			$total =  ($st_data->QUANTITY)-($sel_data1->QUANTITY);
 			$unit1 = $st_data->unit;
 			$unit = $st_data->unit;
 		}
?>

 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Quantity <span class="required">*</span>
</label>
<div class="col-md-3 col-sm-3 col-xs-6">
  <?php if($data->type == "Tiles"){ ?>
  	<input type="text" id="last-name"  class="quantityval form-control col-md-7 col-xs-12" required="required" name="totalcarton" placeholder="Total Carton sq/ft">
  <?php } else { ?>
  	<input type="text" id="last-name"  class="quantityval form-control col-md-7 col-xs-12" required="required" name="quantity" value="">
  <?php } ?>

</div>
<div class="col-md-3 col-sm-3 col-xs-6">
<?php if (empty($st_data->unit) AND $st_data->unit != '0') { ?>

	<?php if($data->type == "Tiles"){ ?>
		<input type="text" id="last-name"  class="form-control col-md-7 col-xs-12" name="percarton" placeholder="Per Carton sq/ft" >
	<?php } else { ?>
	<select id="heard" class="form-control" name="unit" required>
	    <option value="">Choose..</option>
	    <?php
	    	$unit = $em->SelectAll('unit');
	    	if ($unit) {
	    		while ($data = $unit->fetch(PDO::FETCH_OBJ)) {
	    ?>
	    <option value="<?php echo $data->name;?>"><?php echo ucfirst($data->name);?></option>
	    <?php }} ?>
  	</select>
	<?php } ?>

<?php } else {?>
  <input type="text" id="last-name"  class="form-control col-md-7 col-xs-12" value="<?php echo $unit;?>" disabled >
  <input type="hidden" name="unit" value="<?php echo $unit1;?>">
<?php } ?>
</div>

<?php
 	}else{echo "<p style='width:50%;margin:0 auto;color:red;font-weight:bolder;font-size:18px;'>Product Not Found!!</p>";}
  }
 }
?>
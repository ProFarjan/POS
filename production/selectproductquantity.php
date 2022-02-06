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
 		$sel_data = $em->Saleing_Product($productid);
 		$destroy = $em->TBL_VAL_52('destroy','productid',$productid,'destroy');
 		$sel_data1 = $sel_data->fetch(PDO::FETCH_OBJ);
 		if ($st_data->unit == '0') {
 			$total = ($st_data->TOTALCARTON)-($sel_data1->QUANTITY)-$destroy;
 			$unit = 'sq/ft';
 		}elseif(!$st_data->unit){
 			$total = 'Not Add Store';
 			$unit = 'Undifine';
 		}else{
 			$total =  ($st_data->QUANTITY)-($sel_data1->QUANTITY)-$destroy;
 			$unit = $st_data->unit;
 		}
?>
 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Quantity <span class="required">*</span>
</label>
<div class="col-md-4 col-sm-4 col-xs-8">
  <input type="number" autocomplete="off" class="quantityval form-control col-md-7 col-xs-12" required="required" name="quantity" value="<?php echo $total;?>">
</div>
<div class="col-md-2 col-sm-2 col-xs-4">
  <input type="text" id="last-name"  class="form-control col-md-7 col-xs-12" value="<?php echo $unit;?>" disabled >
  <input type="hidden" name="unit" value="<?php echo $unit;?>">
</div>
<?php
 	}else{echo "<p style='width:50%;margin:0 auto;color:red;font-weight:bolder;font-size:18px;'>Product Not Found!!</p>";}
  }
 }
?>
<?php
 include_once "../classes/Product.php";
 $em = new Product();

 if (isset($_POST['procode'])) {
 	$id = $_POST['procode'];
 	$data = $em->Tbl_Col_Id_LIMITE_0('product','code',$id);
 	if ($data) {
 		$data1 = $em->Tbl_Col_Id_LIMITE_0('store','productid',$data->id);
 		if ($data1) {
 			$chalaninfo = $em->getChalanno("store","productid","available",$data->id,"0","chalanno");
?>
<div class="form-group">
	<label class="control-label col-md-3 col-sm-3 col-xs-12">Product Catagory <span class="required">*</span>
	</label>
	<div class="col-md-6 col-sm-6 col-xs-12">
	  <input id="birthday" class="productcode date-picker form-control col-md-7 col-xs-12" value="<?php echo $data->type;?>" disabled >
	  <input type="hidden" id="birthday" name="proid" class="date-picker form-control col-md-7 col-xs-12" value="<?php echo $data->id;?>">
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3 col-sm-3 col-xs-12">Product Sub-Catagory <span class="required">*</span>
	</label>
	<div class="col-md-6 col-sm-6 col-xs-12">
	  <input id="birthday" class="productcode date-picker form-control col-md-7 col-xs-12" value="<?php echo $data->subtype;?>" disabled >
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3 col-sm-3 col-xs-12">Product Name <span class="required">*</span>
	</label>
	<div class="col-md-6 col-sm-6 col-xs-12">
	  <input id="birthday" class="productcode date-picker form-control col-md-7 col-xs-12" value="<?php echo $data->name;?>" disabled >
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3 col-sm-3 col-xs-12">Chalan No. <span class="required">*</span>
	</label>
	<div class="col-md-6 col-sm-6 col-xs-12">
	  <select class="form-control" name="chalanno">
	  	<?php
	  		while ($getchalan = $chalaninfo->fetch(PDO::FETCH_OBJ)) {
	  	?>
	  	<option><?php echo $getchalan->chalanno;?></option>
	  	<?php } ?>
	  </select>
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3 col-sm-3 col-xs-12">Destroy Entry <span class="required">*</span>
	</label>
	<div class="col-md-6 col-sm-6 col-xs-12">
	  <input id="birthday" class="productcode date-picker form-control col-md-7 col-xs-12" name="destroy" >
	</div>
	<div class="col-md-2 col-sm-2 col-xs-12">
	  <p style="color: black;margin-top: 3px;font-weight: bolder;">
	  	<?php
		  	if ($data1->unit == "0") {
		  		echo "sq/ft";
		  	}else{
		  		echo $data1->unit;
		  	}
		  ?>
	  </p>
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3 col-sm-3 col-xs-12">Note <span class="required">*</span>
	</label>
	<div class="col-md-6 col-sm-6 col-xs-12">
	  <input id="birthday" class="form-control col-md-7 col-xs-12" name="note" type="type">
	</div>
</div>
<div class="ln_solid"></div>
<div class="form-group">
	<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
	  <button type="submit" class="btn btn-success" name="serachproduct">Destroy</button>
	</div>
</div>
<?php }else{echo "<p class='alert alert-danger'>This Product Not Added Our Store.</p>";} } } ?>
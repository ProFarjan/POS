<?php

include('barcode_fr/BarcodeGenerator.php');
include('barcode_fr/BarcodeGeneratorPNG.php');
include('barcode_fr/BarcodeGeneratorSVG.php');
include('barcode_fr/BarcodeGeneratorJPG.php');
include('barcode_fr/BarcodeGeneratorHTML.php');

if (isset($_POST['productcode'])) {

	$productcode = $_POST['productcode'];
	$chalanno = $_POST['chalanno'];
	$quantity = $_POST['quantity'];
	$barcodetype = $_POST['barcodetype'];

	$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
	for ($i=0; $i < $quantity; $i++) {
?>
<div id="mydiv" style="float: left;margin-right: 20px;margin-bottom: 9px;border-bottom: 1px dashed black;">
	<?php
		if (!empty($chalanno)) {
	?>
	<p style="margin: 0;color: black;text-align: center;">CN-<?php echo $chalanno;?></p>
	<?php } ?>
	<img src="data:image/png;base64,<?php echo base64_encode($generator->getBarcode($productcode, $barcodetype));?>" id="myimg">
	<p style="margin: 0;color: black;text-align: center;"><?php echo $productcode;?></p>
</div>
<script type="text/javascript">
$("#mydiv").width($("#myimg").width());
</script>
<?php }} ?>
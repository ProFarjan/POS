<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
 $ex = new Income();
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Get Barcode From Your Product</h3>
      </div>

      <div class="title_right">
        <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right top_search">

        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Generate Barcode by Product<small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
          <span id="message123"><?php if(isset($addproduct)){echo $addproduct;}elseif(isset($Up_product)){echo $Up_product;}?></span>
            <br />
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Chalan No
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="chalanno" autofocus class="form-control col-md-7 col-xs-12" type="text">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Code
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="productcode" class="form-control col-md-7 col-xs-12">
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6">
                  <a style="font-size: 25px;" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-cube"></i></a>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Quantity
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="number" id="quantity" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Barcode Type
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" id="barcodetype">
                  	<option value="C128">Choose Barcode Type</option>
                  	<option value="C39">TYPE_CODE_39</option>
                  	<option value="C39+">TYPE_CODE_39_CHECKSUM</option>
                  	<option value="C39E">TYPE_CODE_39E</option>
                  	<option value="C39E+">TYPE_CODE_39E_CHECKSUM</option>
                  	<option value="C93">TYPE_CODE_93</option>
                  	<option value="S25">TYPE_STANDARD_2_5</option>
                  	<option value="S25+">TYPE_STANDARD_2_5_CHECKSUM</option>
                  	<option value="I25">TYPE_INTERLEAVED_2_5</option>
                  	<option value="I25+">TYPE_INTERLEAVED_2_5_CHECKSUM</option>
                  	<option value="C128">TYPE_CODE_128</option>
                  	<option value="C128A">TYPE_CODE_128_A</option>
                  	<option value="C128B">TYPE_CODE_128_B</option>
                  	<option value="C128C">TYPE_CODE_128_C</option>
                  	<option value="EAN2">TYPE_EAN_2</option>
                  	<option value="EAN5">TYPE_EAN_5</option>
                  	<option value="EAN8">TYPE_EAN_8</option>
                  	<option value="EAN13">TYPE_EAN_13</option>
                  	<option value="UPCA">TYPE_UPC_A</option>
                  	<option value="UPCE">TYPE_UPC_E</option>
                  	<option value="MSI">TYPE_MSI</option>
                  	<option value="MSI+">TYPE_MSI_CHECKSUM</option>
                  	<option value="POSTNET">TYPE_POSTNET</option>
                  	<option value="PLANET">TYPE_PLANET</option>
                  	<option value="RMS4CC">TYPE_RMS4CC</option>
                  	<option value="KIX">TYPE_KIX</option>
                  	<option value="IMB">TYPE_IMB</option>
                  	<option value="CODABAR">TYPE_CODABAR</option>
                  	<option value="CODE11">TYPE_CODE_11</option>
                  	<option value="PHARMA">TYPE_PHARMA_CODE</option>
                  	<option value="PHARMA2T">TYPE_PHARMA_CODE_TWO_TRACKS</option>
                  </select>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="button" id="generatebarcode" class="btn btn-success">Generate</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

	</div>

	<div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
      	<div class="x_panel">
      		<div style="width: 10%;text-align: center;margin: 0 auto;">
      			<button class="btn btn-primary btn-md" onclick="printData()">Print</button>
      		</div>
      		<div id="getvalueadd">
      		</div>
      	</div>
      </div>
    </div>


</div>
</div>
<!-- /page content -->

<?php include "inc/footer.php";?>


<!-- all Product By Modul -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg">
  <div class="modal-content">

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
      </button>
      <h4 class="modal-title" id="myModalLabel">All Product List</h4>
    </div>
    <div class="modal-body">
      
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_content">

<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>SL</th>
      <th>Code</th>
      <th>Name</th>
      <th>Rate</th>
      <th>Catagory</th>
      <th>Sub Catagory</th>
      <th width="10%">Action</th>
    </tr>
  </thead>


  <tbody>
  <?php
    $niceproduct = $ex->SelectAll('product');
    $i = 0;
    if ($niceproduct) {
      while ($data = $niceproduct->fetch(PDO::FETCH_OBJ)) { $i++;
  ?>
    <tr>
      <td><?php echo $i;?></td>
      <td id="<?php echo $data->code;?>"><?php echo $data->code;?></td>
      <td><?php echo $data->name;?></td>
      <td><?php echo $data->rate;?></td>
      <td><?php echo $data->type;?></td>
      <td><?php echo $data->subtype;?></td>
      <td width="10%"><button class="<?php echo $i;?> btn btn-info" data-dismiss="modal">Sale</button></td>
    </tr>
    <script type="text/javascript">
      $(document).on('click','.<?php echo $i;?>',function(){
        var code = $("#<?php echo $data->code;?>").text();
        $("#productcode").val(code);
      });
    </script>
  <?php }} ?>
  </tbody>
</table>


    </div>
  </div>
</div>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>

  </div>
</div>
</div>
<!-- all Product By Modul -->

<script type="text/javascript">
	$(function(){

		$("#generatebarcode").click(function(){
			var chalanno = $("#chalanno").val();
			var productcode = $("#productcode").val();
			var quantity = $("#quantity").val();
			var barcodetype = $("#barcodetype").val();
			if (productcode != "") {
				$.ajax({
					url: "getBarcode.php",
					method: "POST",
					data: {chalanno:chalanno,productcode:productcode,quantity:quantity,barcodetype:barcodetype},
					success: function(getdata){
						$("#getvalueadd").append(getdata);
						$("#mydiv").width($("#myimg").width());
					}
				});
			}else{
				alert("Enter Product Code!!");
			}
		});
	});
</script>

<script type="text/javascript">

  function printData(){
     var divToPrint=document.getElementById("getvalueadd");
     newWin= window.open("");
     newWin.document.write(divToPrint.outerHTML);
     newWin.print();
     newWin.close();
  }
</script>

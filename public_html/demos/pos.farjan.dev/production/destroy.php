<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
$st = new Store();
 if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['serachproduct'])) {
    $storeproductadd = $st->Destroy_Product($_POST);
  }
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Product Destroy Page</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <a href="destroylist.php" class="btn btn-primary">Product Destroy List</a>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Destroy Entry <small></small></h2>
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
          <?php if(isset($storeproductadd)){print_r($storeproductadd);}?>
            <br />
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="post">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Enter Product Code <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="birthday" name="code" class="productcode date-picker form-control col-md-7 col-xs-12" required="required" type="text" placeholder="Barcode Screen...">
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6">
                  <a style="font-size: 25px;" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-cube"></i></a>
                </div>
              </div>
              <div class="mydiv">
                
              </div>

            </form>
          </div>
        </div>
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
    $niceproduct = $st->SelectAll('product');
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
        $(".productcode").val(code).blur();
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
  $(".productcode").blur(function(){
    var procode = $(this).val();
    if (procode == '') {

    }else{
      $.ajax({
        url: "destroyproduct.php",
        method: "POST",
        data: {procode:procode},
        success: function(data){
          $(".mydiv").empty();
          $(".mydiv").append(data);
        }
      });
    }
  });
});
</script>
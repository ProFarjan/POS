<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
 $po = new Product();
?>
<?php
  if (isset($_GET['id']) AND !empty($_GET['id'])) {
    $id = $_GET['id'];
    $product = $po->SelectAll_By_ID('product',$id);
    if ($product) {
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Product Details</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
              <a class="btn btn-primary" href="" onclick="self.close();">Close</a>
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-3 col-sm-3 col-xs-3">
      </div>
      <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="x_panel">
          <div class="x_title">
            <h2>Product Details</h2>
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
              <table id="datatable" class="table table-striped table-bordered">
                <tr>
                  <td>Product Code</td>
                  <td><?php echo $product->code;?></td>
                </tr>
                <tr>
                  <td>Product Name</td>
                  <td><?php echo $product->name;?></td>
                </tr>
                <tr>
                  <td>Product Catagory</td>
                  <td><?php echo $product->type;?></td>
                </tr>
                <tr>
                  <td>Product Sub-Catagory</td>
                  <td><?php echo $product->subtype;?></td>
                </tr>
                <tr>
                  <td>Rate</td>
                  <td><?php echo $product->rate;?></td>
                </tr>
              </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
<?php }else{echo "<script>window.location = '404.php';</script>";} }else{echo "<script>window.location = '404.php';</script>";}?>


<?php include "inc/footer.php";?>
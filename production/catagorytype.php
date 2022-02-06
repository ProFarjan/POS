<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
$po = new Product();
 if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['addcat'])) {
   $addproduct = $po->Add_Catagory($_POST);
 }
 if (isset($_GET['update']) AND !empty($_GET['update'])) {
    $id = $_GET['update'];
    $product_Up = $po->SelectAll_By_ID('catagory',$id);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['upcatagory'])) {
      $Up_product = $po->Catagory_Update($id,$_POST);
    }
  }
   if (isset($_GET['delete']) AND !empty($_GET['delete'])) {
    $id = $_GET['delete'];
    $delcatagroy = $po->Delete('catagory',$id);
   }
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Add New Catagory And Sub Catagory</h3>
      </div>

      <div class="title_right">
        <div class="col-md-2 col-sm-12 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <a href="productadd.php"><button class="btn btn-primary">Add Product</button></a>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Add Form <small></small></h2>
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
            <form id="myform12" data-parsley-validate class="form-horizontal form-label-left" action="" method="post">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Catagory Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input name="type" autofocus class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" <?php if(isset($product_Up)){echo "value='".$product_Up->type."'";}?> >
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sub Catagory Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" required="required" name="subtype" class="form-control col-md-7 col-xs-12" <?php if(isset($product_Up)){echo "value='".$product_Up->subtype."'";}?> >
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" class="btn btn-success" <?php if(isset($product_Up)){?> name="upcatagory" <?php } else { ?> name="addcat" <?php }?> >Submit</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
      <div class="x_title">
            <h2>List <small></small></h2>
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
      <div class="x_panel">
      <?php if(isset($delcatagroy)){echo $delcatagroy;}?>
        <table class="table table-bordered">
          <tr class="bg-primary">
            <th>SL</th>
            <th>Catagory Name</th>
            <th>Sub Catagory Name</th>
            <th>Action</th>
          </tr>
          <?php
            $catagory = $po->SelectAll_Val('catagory','type');
            $i = 0;
            if ($catagory) {
              while ($data = $catagory->fetch(PDO::FETCH_OBJ)) { $i++;
          ?>
          <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $data->type;?></td>
            <td><?php echo $data->subtype;?></td>
            <td><a href="?update=<?php echo $data->id;?>" class="btn btn-info btn-xs">Update</a><a href="?delete=<?php echo $data->id;?>" class="btn btn-danger btn-xs">Delete</a></td>
          </tr>
          <?php }} ?>
        </table>
      </div>
      </div>
    </div>
</div>
</div>
</div>
</div>
<!-- /page content -->

<?php include "inc/footer.php";?>
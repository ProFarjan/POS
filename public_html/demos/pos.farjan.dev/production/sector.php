<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
$po = new Expense();
 if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['addcat'])) {
   $addproduct = $po->AddSector($_POST);
 }
 if (isset($_GET['update']) AND !empty($_GET['update'])) {
    $id = $_GET['update'];
    $product_Up = $po->SelectAll_By_ID('sector',$id);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['upcatagory'])) {
      $Up_product = $po->Update_Sector($id,$_POST);
    }
  }
   if (isset($_GET['delete']) AND !empty($_GET['delete'])) {
    $id = $_GET['delete'];
    $delcatagroy = $po->Delete('sector',$id);
   }
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Add New Sector For Expense</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <a href="addexpense.php"><button class="btn btn-primary">Add Expense</button></a>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Add Sector <small></small></h2>
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
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="post">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sector Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="birthday" name="sector" autocomplete="off" autofocus class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" <?php if(isset($product_Up)){echo "value='".$product_Up->sector."'";}?> >
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" class="btn btn-success" <?php if(isset($product_Up)){?> name="upcatagory" <?php } else { ?> name="addcat" <?php }?> >Submit</button>
                  <button class="btn btn-primary" type="reset">Reset</button>
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
        <table id="datatable" class="table table-bordered">
          <tr class="bg-primary">
            <th style="width: 5%;">SL</th>
            <th>Sector Name</th>
            <th style="width: 18%;">Action</th>
          </tr>
          <?php
            $catagory = $po->SelectAll('sector');
            $i = 0;
            if ($catagory) {
              while ($data = $catagory->fetch(PDO::FETCH_OBJ)) { $i++;
          ?>
          <tr>
            <td><?php echo $i;?></td>
            <td><?php echo ucfirst($data->sector);?></td>
            <td><a href="?update=<?php echo $data->id;?>" class="btn btn-info">Update</a><a href="?delete=<?php echo $data->id;?>" class="btn btn-danger">Delete</a></td>
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
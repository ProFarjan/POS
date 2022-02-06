<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
 $nias = new Inden();
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['softwareinfo'])) {
  $softwareinfo = $nias->Software_Info_Update($_POST);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['colorupdate'])) {
  $softwareinfo = $nias->Color_Update($_POST);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['animationload'])) {
  $softwareinfo = $nias->Animation_Update($_POST);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['storecontrol'])) {
  $softwareinfo = $nias->Store_Control($_POST);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['addcash'])) {
  $softwareinfo = $nias->Add_Cash_In_Hand($_POST);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['unitname'])) {
  $unit = $nias->Create_Unit_Name($_POST);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['invoicecontrol'])) {
  $unit = $nias->Invoice_Control($_POST);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['logcontrol'])) {
  $unit = $nias->login_Page_Control($_POST);
}
$farjan = $nias->SelectAll_By_ID('setting','1');
if ($invoice == 'invoice') {
  $invoice_val = "A4 Page Slip";
}elseif ($invoice == 'invoice01') {
  $invoice_val = "Thermal Printer";
}elseif ($invoice == 'invoice02') {
  $invoice_val = "Own Pad Slip";
}

if ($purchase == 'purchaseslip') {
  $purchase_val = "A4 Page Slip";
}elseif ($purchase == 'purchaseslip01') {
  $purchase_val = "Thermal Printer";
}elseif ($purchase == 'purchaseslip02') {
  $purchase_val = "Own Pad Slip";
}
?>
<?php
if (isset($_GET['aup']) AND !empty($_GET['aup'])) {
  $up_aup = $nias->hl->validation($_GET['aup']);
  $update_data = $nias->SelectAll_By_ID('cash',$up_aup);
  if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['updatecash'])) {
    $update_data1 = $nias->update_Cash_In_Hand($up_aup,$_POST);
    if ($update_data1) {
      echo "<script>window.location = 'setting.php';</script>";
    }
  }
}
?>
<?php
  if (isset($_GET['unit']) AND !empty($_GET['unit'])) {
    $del_unit = $nias->hl->validation($_GET['unit']);
    $delete_unit = $nias->Delete('unit',$del_unit);
    if ($delete_unit) {
      echo "<script>window.location = 'setting.php';</script>";
    }
  }
  if (isset($_GET['adel']) AND !empty($_GET['adel'])) {
    $del_add = $nias->hl->validation($_GET['adel']);
    $delete_add = $nias->Delete('cash',$del_add);
    if ($delete_add) {
      echo "<script>window.location = 'setting.php';</script>";
    }
  }
?>
<style type="text/css">
#unitid{width: 100px;margin: 0;background: #ededed;padding: 12px;text-align: center;border-radius: 7px;box-shadow: 2px 2px 2px 0px #ddd;cursor: pointer;float: left;margin-left: 10px;margin-bottom: 8px;}
</style>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Software Setting</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <span id="message123"><?php if(isset($unit)){echo $unit;}?></span>
            <a href="adsetting.php" class="btn btn-info">Advance Setting</a>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Software Info</h2>
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
            <br>
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Company Name<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="companyname" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $farjan->companyname;?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Company Phone<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="phone" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $farjan->phone;?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Company email<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="email" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $farjan->email;?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Company address<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="address" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $farjan->address;?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Short logo<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="file" id="last-name" name="image" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success" name="softwareinfo">Update</button>
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
          <div class="x_title">
            <h2>Color Change</h2>
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
            <br>
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="POST">

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Body Color</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="input-group demo2">
                  <input type="text" value="<?php echo $farjan->bgcolor;?>" class="form-control" name="bgcolor" />
                  <span class="input-group-addon"><i></i></span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Header Color</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="input-group demo2">
                  <input type="text" value="<?php echo $farjan->headercolor;?>" class="form-control" name="headercolor" />
                  <span class="input-group-addon"><i></i></span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Sidebar Color</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="input-group demo2">
                  <input type="text" value="<?php echo $farjan->sidebarcolor;?>" class="form-control" name="sidebarcolor" />
                  <span class="input-group-addon"><i></i></span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Content Color</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="input-group demo2">
                  <input type="text" value="<?php echo $farjan->containcolor;?>" class="form-control" name="containcolor" />
                  <span class="input-group-addon"><i></i></span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Content Text Color</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="input-group demo2">
                  <input type="text" value="<?php echo $farjan->contenttextcolor;?>" class="form-control" name="contenttextcolor" />
                  <span class="input-group-addon"><i></i></span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Footer Color</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="input-group demo2">
                  <input type="text" value="<?php echo $farjan->footercolor;?>" class="form-control" name="footercolor" />
                  <span class="input-group-addon"><i></i></span>
                </div>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success" name="colorupdate">Update</button>
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
          <div class="x_title">
            <h2>Loading Animation</h2>
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
            <br>
            <form action="" method="post">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Change Loading Animation</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" name="animation">
                    <option value="<?php echo $farjan->animate;?>">Current (<?php echo $farjan->animate;?>) </option>
                    <option value="off">Animation Off</option>
                    <option value="random">Ramdom Animation</option>
                    <option value="spinner1">Spinner 1</option>
                    <option value="spinner2">Spinner 2</option>
                    <option value="spinner3">Spinner 3</option>
                    <option value="spinner4">Spinner 4</option>
                    <option value="spinner5">Spinner 5</option>
                    <option value="spinner6">Spinner 6</option>
                  </select>
              </div>
            </div>
            <br>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="animationload" class="btn btn-success">Update</button>
              </div>
            </div>
          </form>
          </div>
          </div>
          </div>
        </div>

    <div class="row">
      <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="x_panel">
          <div class="x_title">
            <h2>Create Unit</h2>
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
            <br>
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Unit Name<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="unit" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success" name="unitname">Create</button>
              </div>
            </div>

          </form>
          </div>
          </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="x_panel">
              <h2>Unit List</h2>
              <div class="x_title">
              </div>
              <div class="x_content" style="min-height: 125px;">
              <?php
                $unit520 = $nias->SelectAll('unit');
                if ($unit520) {
                  while ($data = $unit520->fetch(PDO::FETCH_OBJ)) {
              ?>
                <p id="unitid"><?php echo $data->name;?> <a href="?unit=<?php echo $data->id;?>" title="Delete This Unit"><i class="fa fa-times" aria-hidden="true"></i></a></p>
              <?php } } ?>
              </div>
            </div>
          </div>
        </div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Store Control</h2>
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
            <br>
            <form action="" method="post">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Store Control ON/OFF</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" name="store">
                    <option value="<?php echo $farjan->storecontrol;?>">Current (<?php echo strtoupper($farjan->storecontrol);?>) </option>
                    <option value="on">ON</option>
                    <option value="off">OFF</option>
                  </select>
              </div>
            </div>
            <br>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="storecontrol" class="btn btn-success">Update</button>
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
          <div class="x_title">
            <h2>Invoice/Purchase Slip Control</h2>
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
            <br>
            <form action="" method="post">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Choese Invoice Slip</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" name="list1">
                    <option value="<?php echo $farjan->list1;?>">Current (<?php echo ucfirst($invoice_val);?>) </option>
                    <option value="invoice">A4 Page Invoice</option>
                    <option value="invoice01">Thermal Printer</option>
                    <option value="invoice02">Own Pad Invoice</option>
                  </select>
              </div>
            </div>
            <br><br><br>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Choese Purchase Slip</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" name="list2">
                    <option value="<?php echo $farjan->list2;?>">Current (<?php echo ucfirst($purchase_val);?>) </option>
                    <option value="purchaseslip">A4 Page Invoice</option>
                    <option value="purchaseslip01">Thermal Printer</option>
                    <option value="purchaseslip02">Own Pad Invoice</option>
                  </select>
              </div>
            </div>
            <br>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="invoicecontrol" class="btn btn-success">Update</button>
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
          <div class="x_title">
            <h2>Choice Login Page</h2>
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
            <br>
            <form action="" method="post">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Login Page</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" name="loginpage">
                    <option value="<?php echo $farjan->login;?>">Current (<?php echo ucfirst($farjan->login);?>) </option>
                    <option value="login">Login Page</option>
                    <option value="login1">Login Page 01</option>
                    <option value="login2">Login Page 02</option>
                    <option value="login3">Login Page 03</option>
                    <option value="login4">Login Page 04</option>
                  </select>
              </div>
            </div>
            <br>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="logcontrol" class="btn btn-success">Update</button>
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
          <div class="x_title">
            <h2>Add Cash</h2>
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
            <br>
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="post">

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Amount<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="cashadd" required="required" class="form-control col-md-7 col-xs-12" <?php if(isset($update_data)){?> value="<?php echo $update_data->cash;?>" <?php } ?> >
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Note<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="note" required="required" class="form-control col-md-7 col-xs-12" <?php if(isset($update_data)){?> value="<?php echo $update_data->note;?>" <?php } ?> >
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success" <?php if(isset($update_data)){ ?> name="updatecash" <?php } else{ ?> name="addcash" <?php } ?> >Add</button>
              </div>
            </div>

          </form>
          </div>
          </div>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_content" style="margin-bottom: 50px;">
              <table id="datatable" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>Date</th>
                    <th>Amount(Tk)</th>
                    <th>Note</th>
                    <th width="15%">Action</th>
                  </tr>
                </thead>


                <tbody>
                <?php
                  $storedata = $nias->SelectAll('cash');
                  $i = 0;
                  if ($storedata) {
                    while ($data = $storedata->fetch(PDO::FETCH_OBJ)) { $i++;
                ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $nias->hl->formatDate01($data->date);?></td>
                    <td><?php echo $data->cash;?></td>
                    <td><?php echo $data->note;?></td>
                    <td width="15%">
                      <a href="?aup=<?php echo $data->id;?>" class="btn btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                      <?php if(!isset($update_data)){ ?>
                      <a href="?adel=<?php echo $data->id;?>" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>
                      <?php } ?>
                    </td>
                  </tr>
                <?php } } ?>
                </tbody>
              </table>
          </div>
          </div>
        </div>



    </div>
</div>
<!-- /page content -->


<?php include "inc/footer.php";?>

<script type="text/javascript">
$(function(){
  $("#animation").change(function(){
    var value = $("#animation").val();
    $("#oooo").val(value);
  });
});
</script>

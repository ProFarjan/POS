<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
 $cu = new Login();

 if ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['addcustomer'])) {
   $addcustomer = $cu->Add_New_User($_POST);
 }
 if (isset($_GET['update']) AND !empty($_GET['update'])) {
   $update = $_GET['update'];
   $u_1 = $cu->SelectAll_By_ID('user',$update);
   if ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['updatecustomer'])) {
   $addcustomer = $cu->Update_New_User($update,$_POST);
  }
 }
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Add Form</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <a href="userprofile.php" class="btn btn-info">Profile</a>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Personal Info</h2>
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
         <span id="message123"><?php
            if (isset($addcustomer)) {
              echo $addcustomer;
            }elseif (isset($update_customer)) {
              echo $update_customer;
            }
         ?></span>
              

<form class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Full Name <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" <?php if(isset($u_1)){ ?> value="<?php echo $u_1->name;?>" <?php }else{ ?> placeholder="both name(s) e.g Farjan Hasan" <?php } ?> required="required" type="text" >
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Phone Number <span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="number" id="number" name="phone" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12" <?php if(isset($u_1)){ ?> value="<?php echo $u_1->mobile;?>" <?php } ?> >
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Address <span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <textarea id="textarea" name="address" class="form-control col-md-7 col-xs-12"><?php if(isset($u_1)){ ?> <?php echo $u_1->address;?> <?php } ?></textarea>
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">User Name<span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input id="occupation" type="text" name="user" data-validate-length-range="5,20" class="optional form-control col-md-7 col-xs-12" <?php if(isset($u_1)){ ?> value="<?php echo $u_1->user;?>" <?php } ?> >
    </div>
  </div>
  <?php if (!isset($u_1)) { ?>
    <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Password<span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input id="occupation" type="text" name="password" data-validate-length-range="5,20" class="optional form-control col-md-7 col-xs-12" >
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Retype Password<span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input id="occupation" type="text" name="repassword" data-validate-length-range="5,20" class="optional form-control col-md-7 col-xs-12" >
    </div>
  </div>
  <?php } ?>
  <?php if (isset($u_1)) { ?>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea"><span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <img src="<?php echo $u_1->image;?>" style="width: 120px;height: 80px;">
    </div>
  </div>
  <?php } ?>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">User Image <span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="file" id="telephone" name="image" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12">
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">User Role<span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <select name="userroll" class="form-control">
        <option value="admin">Admin</option>
        <option value="user">User</option>
        <option value="purchase_manager">Purchase Manager</option>
      </select>
    </div>
  </div>
  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-md-offset-3">
      <button type="submit" class="btn btn-primary">Cancel</button>
      <button id="send" type="submit" class="btn btn-success" <?php if (isset($u_1)) { ?> name="updatecustomer" <?php } else{ ?> name="addcustomer" <?php } ?> ><?php if (isset($u_1)) { ?>Update<?php }else{ ?>Submit<?php } ?></button>
    </div>
  </div>
</form>




          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
<?php include "inc/footer.php";?>
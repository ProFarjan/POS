<?php ?><?php include "inc/header.php"; ?>
<?php include "inc/slider.php"; ?>
<?php
$cu = new Customers();
if (isset($_GET['customer'])) {
    $typeval = "1";
    $cuscode_int = $farjan->cuscode;
} elseif (isset($_GET['dir_em'])) {
    $typeval = "2";
    $cuscode_int = $farjan->emcode;
} elseif (isset($_GET['suplier'])) {
    $typeval = "3";
    $cuscode_int = $farjan->suppcode;
}
if ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['addcustomer'])) {
    $addcustomer = $cu->addcustomer($_POST,$_FILES);
}
if (isset($_GET['custid']) AND !empty($_GET['custid'])) {
    $custid = $_GET['custid'];
    $userinfo = $cu->SelectAll_By_ID('customer', $custid);
    $typeval = $userinfo->typeval;
    if ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['upcustomer'])) {
        $update_customer = $cu->Update_Customer($custid, $_POST);
    }
}
?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
      <?php if(isset($userinfo)){ ?>
        <h3>Update Form</h3>
      <?php } else { ?>
        <h3>Add <?php
          if ($typeval == '1') {
            echo "Customer";
          }elseif ($typeval == '2') {
            echo "Director/Employee";
          }else{
            echo "Supplier";
          }
        ?> Form</h3>
      <?php } ?>
      </div>

      <div class="title_right">
        <div class="col-md-2 col-sm-2 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <button onclick="goBack();" class="btn btn-info btn-md">Back</button>
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
} elseif (isset($update_customer)) {
    echo $update_customer;
}
?></span>
              

<form class="form-horizontal form-label-left" action="" runat="server" method="post" enctype="multipart/form-data">
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">ID <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="customerid" value="<?php $custcode = $cu->Tbl_Col_Id_LIMITE_0('customer','typeval',$typeval);if($custcode){echo $custcode->customerid+1;}else{echo $cuscode_int;}?>" required="required" type="text" <?php if (isset($userinfo)) {
    echo "value='" . $userinfo->customerid . "'";
    echo "disabled";
} ?> autofocus="1">
      <?php if (isset($typeval)) { ?>
      <input type="hidden" name="typeval" value="<?php echo $typeval; ?>">
      <?php
} ?>

    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Full Name <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" required="required" type="text" <?php if (isset($userinfo)) {
    echo "value='" . $userinfo->name . "'";
} ?> >
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="email" id="email" name="email"  class="form-control col-md-7 col-xs-12" <?php if (isset($userinfo)) {
    echo "value='" . $userinfo->email . "'";
} ?> >
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Phone Number <span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="number" id="number" name="phone" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12" <?php if (isset($userinfo)) {
    echo "value='" . $userinfo->phone . "'";
} ?> >
    </div>
  </div>
  <?php if ($typeval == '2') { ?>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Destination <span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="destination" name="destination" class="form-control col-md-7 col-xs-12" <?php if (isset($userinfo)) {
    echo "value='" . $userinfo->destination . "'";
} ?> >
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Salary <span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="salary" name="salary" class="form-control col-md-7 col-xs-12" <?php if (isset($userinfo)) {
    echo "value='" . $userinfo->salary . "'";
} ?> >
    </div>
  </div>
  <?php } ?>
  <div class="item form-group" hidden="hidden">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Website URL <span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="url" id="website" name="website" placeholder="http://www.website.com" class="form-control col-md-7 col-xs-12" <?php if (isset($userinfo)) {
    echo "value='" . $userinfo->website . "'";
} ?> >
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Company Name <span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input id="occupation" type="text" name="company" data-validate-length-range="5,20" class="optional form-control col-md-7 col-xs-12" <?php if (isset($userinfo)) {
    echo "value='" . $userinfo->company . "'";
} ?> >
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Telephone <span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="tel" id="telephone" name="telephone" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12" <?php if (isset($userinfo)) {
    echo "value='" . $userinfo->telephone . "'";
} ?> >
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Full Address <span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <textarea id="textarea" name="address" class="form-control col-md-7 col-xs-12"><?php if (isset($userinfo)) {
    echo $userinfo->address;
} ?></textarea>
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">City <span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="tel" id="telephone" name="city" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12" <?php if (isset($userinfo)) {
    echo "value='" . $userinfo->city . "'";
} ?>>
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">
    Image <span class="required"></span>
    </label>
    <div class="col-md-4 col-sm-4 col-xs-6">
      <input type="file" name="image" id="imgInp" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12">
    </div>
    <div class="col-md-2 col-sm-2 col-xs-6">
      <img id="blah" src="<?php if(isset($userinfo->image) && $userinfo->image != '1'){ echo $userinfo->image;}else{echo "upload/user/3b1026d5d6.jpg";}?>" alt="your image" style="width: 130px;height: 130px;text-align: right;border-radius: 5px;box-shadow: 0px 1px 7px 1px lightslategrey;" />
    </div>
  </div>
  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-md-offset-3" style="margin-bottom: 25px;">
      <button id="send" type="submit" class="btn btn-success" <?php if (isset($custid)) { ?> name="upcustomer" <?php
} else { ?> name="addcustomer" <?php
} ?> >Submit</button>
<button type="submit" class="btn btn-primary">Cancel</button>
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
<?php include "inc/footer.php"; ?>
<script type="text/javascript">
  $("#imgInp").change(function() {
    readURL(this);
  });
</script>
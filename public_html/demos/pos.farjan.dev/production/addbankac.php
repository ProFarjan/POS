<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
$cu = new Inden();

if ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['personcash'])) {
  $acnumber = $_POST['acnumber'];
  $bankname = $_POST['bankname'];
  $initbalance = $_POST['initbalance'];
  $note = $_POST['note'];
  $reg_date = date('m/d/Y');
  $sql = "INSERT INTO tbl_account (acnumber,bankname,initbalance,note,reg_date) VALUES ('$acnumber','$bankname','$initbalance','$note','$reg_date');";
  $cu->tbl_sql($sql);
}

?>

<style type="text/css">
#showac {
  padding: 3px 25px;
}
#showac ul{list-style: none;color: #000;font-weight: bold;}
#showac ul li {
  padding: 2px 0;
  cursor: pointer;
}
</style>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Add New Bank Account</h3>
      </div>

      <div class="title_right">
        <div class="col-md-3 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <a href="banktransferlist.php" class="btn btn-info">Add New Bank Account</a>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Bank Information</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

<?php if(isset($sql)){ ?><p id="message123" style="text-align: center;border: dashed;padding: 6px;color: green;"> Bank Account Successfully Added !!</p><?php } ?>

<form class="form-horizontal form-label-left" action="" method="post">

  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">A/C Number
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="acnumber" required="required" type="text" autofocus autocomplete="off">
    </div>
  </div>

  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Bank Name <span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" name="bankname" autocomplete="off"  class="form-control col-md-7 col-xs-12" >
    </div>
  </div>

  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Initial Balance <span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="number" name="initbalance" value="0" class="form-control col-md-7 col-xs-12" >
    </div>
  </div>

  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Note <span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" name="note" autocomplete="off" class="form-control col-md-7 col-xs-12" >
    </div>
  </div>

  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-md-offset-3">
      <button id="send" type="submit" class="btn btn-success" name="personcash">Add Account</button>
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
<?php include "inc/footer.php";?>
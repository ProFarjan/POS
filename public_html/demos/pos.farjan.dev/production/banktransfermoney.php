<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
$cu = new Inden();

if ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['personcash'])) {
  $withdrawalac = $_POST['withdrawalac'];
  $depositac = $_POST['depositac'];
  $depositamt = $_POST['depositamt'];
  $note = $_POST['note'];
  $reg_date = date('m/d/Y');

  if ($depositac == "cash") {
    $aaa_pro = true;
    $acc_info = $cu->SelectAll_By_ID("tbl_account",$withdrawalac,"acnumber,bankname");
    $bankToCash = "From : ".$acc_info->bankname."\nA/C :".$acc_info->acnumber."\n".$note;
    $sql_cash = "INSERT INTO cash (cash,date,status,note) VALUES ('$depositamt','$reg_date','1','$bankToCash');";
    
    $withdraw_info = $cu->SelectAll_By_ID("tbl_account",$withdrawalac,"acnumber,bankname");
    $acno = $withdraw_info->acnumber;
    $bankname = $withdraw_info->bankname;
    $sql_withdraw = "INSERT INTO transfer (acno,bankname,deposit,amount,note,status,date) VALUES ('$acno','$bankname','','$depositamt','$note','2','$reg_date');";

    $cu->tbl_sql($sql_cash);
    $cu->tbl_sql($sql_withdraw);
  }elseif($withdrawalac == "cash"){
    $aaa_pro = true;
    $acc_info = $cu->SelectAll_By_ID("tbl_account",$withdrawalac,"acnumber,bankname");
    $bankToCash = $note;
    $depositamt_ = "-".$depositamt;
    $sql_cash = "INSERT INTO cash (cash,date,status,note) VALUES ('$depositamt_','$reg_date','1','$bankToCash');";

    $deposit_info = $cu->SelectAll_By_ID("tbl_account",$depositac,"acnumber,bankname");
    $acnod = $deposit_info->acnumber;
    $banknamed = $deposit_info->bankname;
    $sql_deposit = "INSERT INTO cashin (acno,bankname,deposit,amount,note,status,date) VALUES ('$acnod','$banknamed','','$depositamt','$note','2','$reg_date');";

    $cu->tbl_sql($sql_cash);
    $cu->tbl_sql($sql_deposit);
  }elseif($depositac != $withdrawalac){
    $aaa_pro = true;
    $withdraw_info = $cu->SelectAll_By_ID("tbl_account",$withdrawalac,"acnumber,bankname");
    $acno = $withdraw_info->acnumber;
    $bankname = $withdraw_info->bankname;
    $sql_withdraw = "INSERT INTO transfer (acno,bankname,deposit,amount,note,status,date) VALUES ('$acno','$bankname','','$depositamt','$note','2','$reg_date');";

    $deposit_info = $cu->SelectAll_By_ID("tbl_account",$depositac,"acnumber,bankname");
    $acnod = $deposit_info->acnumber;
    $banknamed = $deposit_info->bankname;
    $sql_deposit = "INSERT INTO cashin (acno,bankname,deposit,amount,note,status,date) VALUES ('$acnod','$banknamed','','$depositamt','$note','2','$reg_date');";

    $cu->tbl_sql($sql_withdraw);
    $cu->tbl_sql($sql_deposit);

  }

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
        <h3>Account Transfer Money</h3>
      </div>

      <div class="title_right">
        <div class="col-md-3 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <button onclick="javascript:goBack();" class="btn btn-info">Back</button>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Balance Transfer Information</h2>
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

<?php if(isset($aaa_pro)){ ?><p id="message123" style="text-align: center;border: dashed;padding: 6px;color: green;"> Balance Transfer Successfully!!</p><?php } ?>
<form class="form-horizontal form-label-left" action="" method="post">

  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Account To Withdrawal <span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">

      <select name="withdrawalac" data-placeholder="Choose Account ..." class="form-control chosen-select">
        <option></option>
        <option value="cash">Cash Account</option>
        <?php
          $allbank = $cu->tbl_sql("SELECT id,acnumber,bankname FROM tbl_account GROUP BY bankname ORDER BY bankname,acnumber ASC;");
          if ($allbank) {
            while ($data = $allbank->fetch(PDO::FETCH_OBJ)) {
        ?>
        <option value="<?php echo $data->id;?>"><?php echo $data->bankname." (A/C. ".$data->acnumber.")";?></option>
        <?php }} ?>
      </select>

    </div>
  </div>

  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Account To Deposit <span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <select name="depositac" data-placeholder="Choose Account ..." class="form-control chosen-select">
        <option></option>
        <option value="cash">Cash Account</option>
        <?php
          $allbank = $cu->tbl_sql("SELECT id,acnumber,bankname FROM tbl_account GROUP BY bankname ORDER BY bankname,acnumber ASC;");
          if ($allbank) {
            while ($data = $allbank->fetch(PDO::FETCH_OBJ)) {
        ?>
        <option value="<?php echo $data->id;?>"><?php echo $data->bankname." (A/C. ".$data->acnumber.")";?></option>
        <?php }} ?>
      </select>
    </div>
  </div>

  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Deposit Amount <span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="number" name="depositamt" value="0" class="form-control col-md-7 col-xs-12" >
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
      <button id="send" type="submit" class="btn btn-success" name="personcash">Transter Balance</button>
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
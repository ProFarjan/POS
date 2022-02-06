<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
$cu = new Inden();

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
        <h3>Bank Acccount Statement</h3>
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
            <h2>Balance Information</h2>
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

            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                  <tr class="bg-primary">
                    <th>SL</th>
                    <th>A/C Number</th>
                    <th>Bank Name</th>
                    <th>Current Balance</th>
                  </tr>
                </thead>

                <tbody>
                <?php
                  $i = 0;
                  $acinfo = $cu->tbl_sql("SELECT * FROM tbl_account GROUP BY bankname ORDER BY bankname,acnumber ASC;");
                  if ($acinfo) {
                    while ($data = $acinfo->fetch(PDO::FETCH_OBJ)) { $i++;
                ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $data->acnumber;?></td>
                    <td><?php echo $data->bankname;?></td>
                    <td>
                      <?php
                        $ac_no = $data->acnumber;
                        $bank_name = $data->bankname;
                        $init_balance = $data->initbalance;
                        $deposit_amt_ = $cu->tbl_sql("SELECT SUM(amount) as depositamt FROM cashin WHERE acno = '$ac_no' AND bankname = '$bank_name';");
                        $deposit_amt__ = $deposit_amt_->fetch(PDO::FETCH_OBJ);
                        $deposit_amt = $deposit_amt__->depositamt;

                        $widthdraw_amt_ = $cu->tbl_sql("SELECT SUM(amount) as widthdrawamt FROM transfer WHERE acno = '$ac_no' AND bankname = '$bank_name';");
                        $widthdraw_amt__ = $widthdraw_amt_->fetch(PDO::FETCH_OBJ);
                        $widthdraw_amt = $widthdraw_amt__->widthdrawamt;


                        $exits_balance = ($init_balance+$deposit_amt)-$widthdraw_amt;
                        echo $exits_balance;
                      ?>
                    </td>
                  </tr>
                <?php }} ?>
                </tbody>

              </table>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
<?php include "inc/footer.php";?>
<?php include "inc/header.php";?>
<link rel="stylesheet" type="text/css" href="css/inden.css">
<?php include "inc/slider.php";?>
<?php
  $ind = new Inden();
  $datei = date('m/d/Y');
?>
<?php
  $to_income = $ind->TBL_COL_2('payment','status','date','1',$datei,'payment');
  $to_receive_income = $ind->F_Receive_Todays_240();
  if ($to_income) {
    $to_income = $to_income+$to_receive_income;
  }else{
    $to_income = $to_receive_income+'0.00';
  }
  $to_purchase = $ind->TBL_COL_2('payment','status','date','2',$datei,'payment');
  $to_pay_supplier = $ind->F_Payable_Todays_240();
  if ($to_purchase) {
    $to_purchase = $to_purchase+$to_pay_supplier;
  }else{
    $to_purchase = $to_pay_supplier+'0.00';
  }
  $to_expense = $ind->TBL_COL_1('expense','date',$datei,'amount');
  if ($to_expense) {
    $to_expense = $to_expense;
  }else{
    $to_expense = '0.00';
  }
  $to_pay = $ind->F_Payable_Todays();
  if ($to_pay) {
    $to_pay = $to_pay;
  }else{
    $to_pay = '0.00';
  }
  $to_receive = $ind->F_Receive_Todays();
  if ($to_receive) {
    $to_receive = $to_receive;
  }else{
    $to_receive = '0.00';
  }
?>
<?php
  $tot_income = $ind->TBL_COL_IncomePro('payment','status','1','payment');
  if ($tot_income) {
    $tot_income = $tot_income;
  }else{
    $tot_income = "0.00";
  }
  $tot_purchase = $ind->TBL_COL_IncomePro('payment','status','2','payment');
  if ($tot_purchase) {
    $tot_purchase = $tot_purchase;
  }else{
    $tot_purchase = "0.00";
  }
  $tot_expense = $ind->TBL_VAL_01('expense','amount');
  if ($tot_expense) {
    $tot_expense = $tot_expense;
  }else{
    $tot_expense = "0.00";
  }
  $tot_receive = $ind->F_Receive_Total();
  if ($tot_receive) {
    $tot_receive = $tot_receive;
  }else{
    $tot_receive = "0.00";
  }
  $tot_payable = $ind->F_Payable_Total();
  if ($tot_payable) {
    $tot_payable = $tot_payable;
  }else{
    $tot_payable = "0.00";
  }
?>
<?php
  $cashval    = $ind->TBL_VAL_52('cash','status','1','cash');
  $personval  = $ind->TBL_VAL_52('transfer','status','1','amount');
  $bankval    = $ind->TBL_VAL_52('transfer','status','2','amount');
  $loanval    = $ind->TBL_VAL_52('transfer','status','3','amount');
  $t_transfer = $personval+$bankval;

  $Cashin_person = $ind->TBL_VAL_52('cashin','status','1','amount');
  $Cashin_bank   = $ind->TBL_VAL_52('cashin','status','2','amount');
  $cash_in       = $Cashin_person+$Cashin_bank;
?>

<?php
$acinfo = $ind->tbl_sql("SELECT * FROM tbl_account GROUP BY bankname ORDER BY bankname,acnumber ASC;");
$total_account_info = 0;
if ($acinfo) {
  while ($data = $acinfo->fetch(PDO::FETCH_OBJ)) {
    $ac_no = $data->acnumber;
    $bank_name = $data->bankname;
    $init_balance = $data->initbalance;
    $deposit_amt_ = $ind->tbl_sql("SELECT SUM(amount) as depositamt FROM cashin WHERE acno = '$ac_no' AND bankname = '$bank_name';");
    $deposit_amt__ = $deposit_amt_->fetch(PDO::FETCH_OBJ);
    $deposit_amt = $deposit_amt__->depositamt;

    $widthdraw_amt_ = $ind->tbl_sql("SELECT SUM(amount) as widthdrawamt FROM transfer WHERE acno = '$ac_no' AND bankname = '$bank_name';");
    $widthdraw_amt__ = $widthdraw_amt_->fetch(PDO::FETCH_OBJ);
    $widthdraw_amt = $widthdraw_amt__->widthdrawamt;


    $exits_balance = ($init_balance+$deposit_amt)-$widthdraw_amt;
    $total_account_info += $exits_balance;
  }
}

$dueAmtType = $ind->tbl_sql("SELECT SUM(amount) AS myAmt FROM due WHERE amtType = '1' AND invoiceStatus = '1' AND oldType = '0';");
$dueAmtTypeValue = $dueAmtType->fetch(PDO::FETCH_OBJ);
$dueAmtTypeValue = $dueAmtTypeValue->myAmt;

$dueAmtType2 = $ind->tbl_sql("SELECT SUM(amount) AS myAmt FROM due WHERE amtType = '0' AND invoiceStatus = '1' AND oldType = '1';");
$dueAmtTypeValue2 = $dueAmtType2->fetch(PDO::FETCH_OBJ);
$dueAmtTypeValue2 = $dueAmtTypeValue2->myAmt;

$dueAmtTypeValue20 = ($dueAmtTypeValue2-$dueAmtTypeValue);

?>
<div class="right_col" role="main">
  <div class="row tile_count">
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top green"><i class="fa fa-user"></i> Today's Income</span>
      <div class="count green"><?php echo $to_income;?></div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-clock-o"></i> Totday's Expense</span>
      <div class="count"><?php echo $to_expense;?></div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Today's Purchase</span>
      <div class="count "><?php echo $to_purchase;?></div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Today's Payable</span>
      <div class="count"><?php echo $to_pay;?></div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Today's Receiable</span>
      <div class="count"><?php echo $to_receive;?></div>
    </div>
    <?php
      $initBalance = $ind->tbl_sql("SELECT SUM(initbalance) as mybalance FROM tbl_account;");
      $initBalance_2 = $initBalance->fetch(PDO::FETCH_OBJ);
      $initBalance_3 = $initBalance_2->mybalance;
      $cashHadn = $tot_income-($tot_expense+$tot_purchase)-$t_transfer+($cashval+$loanval)+$cash_in+$initBalance_3+$dueAmtTypeValue20;
    ?>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Cash In Hand</span>
      <div class="count"><?php echo ($cashHadn-$total_account_info);?></div>
    </div>
  </div>
  <!-- /top tiles -->
  <!-- top tiles -->
  <div class="row tile_count" style="margin-top: 0px;">
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top green"><i class="fa fa-user"></i> Total Income</span>
      <div class="count green">
        <?php
          $tot_income_ = $ind->TBL_COL_1('payment','status','1','payment');
          if ($tot_income_) {
            echo $tot_income_ = $tot_income_;
          }else{
            echo $tot_income_ = "0.00";
          }
        ?>
      </div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-clock-o"></i> Total Expense</span>
      <div class="count"><?php echo $tot_expense;?></div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Purchase</span>
      <div class="count">
        <?php
          $Pur_tot_income_ = $ind->TBL_COL_1('payment','status','2','payment');
          if ($Pur_tot_income_) {
            echo $Pur_tot_income_ = $Pur_tot_income_;
          }else{
            echo $Pur_tot_income_ = "0.00";
          }
        ?>
      </div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Payable</span>
      <div class="count"><?php echo $tot_payable;?></div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Receiable</span>
      <div class="count"><?php echo $tot_receive;?></div>
    </div>
    <?php
      $cashHadnval = substr($cashHadn, 0,1);
    ?>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top <?php if($cashHadnval == '-' || $cashHadnval == 0){echo 'red';}else{echo 'green';}?>"><i class="fa fa-user"></i> Balance</span>
      <div class="count <?php if($cashHadnval == '-' || $cashHadnval == 0){echo 'red';}else{echo 'green';}?>"> <?php echo $cashHadn;?> </div>
    </div>
  </div>


<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel">
      <h2>Bank Account == Today's <span style="color: blue;">In. 
      <?php
        $ca_in = $ind->lIke_One_Col('transfer','status','date','2','amount',$datei);
        if (empty($ca_in) || $ca_in == '0') {
          echo '0.00';
        }else{
          echo $ca_in;
        }
      ?></span> <span style="color: navy;">Out. 
      <?php
        $ca_out = $ind->lIke_One_Col('cashin','status','date','2','amount',$datei);
        if (empty($ca_out) || $ca_out == '0') {
          echo "0.00";
        }else{
          echo $ca_out;
        }
      ?>
      </span></h2>
      <div class="x_title">
      </div>
      <div class="x_content">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Bank Name</th>
              <th>Account No</th>
              <th>Amount</th>
            </tr>
            <tbody>
            <?php
              $b_amount = $ind->bank_Amount_Total();
              $i = 0;
              $sum = 0;
              if ($b_amount) {
                while ($data = $b_amount->fetch(PDO::FETCH_OBJ)) { $i++;
                  $cashin = $ind->TBL_VAL_52('cashin','acno',$data->acno,'amount');
            ?>
              <tr>
                <td style="font-size: 12px;"><?php echo $i;?></td>
                <td style="font-size: 12px;"><?php echo $data->bankname;?></td>
                <td style="font-size: 12px;"><?php echo $data->acno;?></td>
                <td style="font-size: 12px;"><?php echo $totalval = ($data->AMOUNT)-$cashin;?></td>
              </tr>
              <?php $sum = $totalval + $sum;?>
            <?php } } ?>
            <?php if($sum != 0){ ?>
              <tr>
                <td></td>
                <td colspan="2" style="text-align: center;">Total</td>
                <td><?php echo $sum;?></td>
              </tr>
            <?php } ?>
            </tbody>
          </thead>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel">
      <h2>Person Account == Today's <span style="color: blue;">In.
      <?php
        $ca_out = $ind->lIke_One_Col('cashin','status','date','1','amount',$datei);
        if (empty($ca_out) || $ca_out == '0') {
          echo "0.00";
        }else{
          echo $ca_out;
        }
      ?>
      </span> <span style="color: navy;">Out. 
      <?php
        $ca_in = $ind->lIke_One_Col('transfer','status','date','1','amount',$datei);
        if (empty($ca_in) || $ca_in == '0') {
          echo '0.00';
        }else{
          echo $ca_in;
        }
      ?>
      </span></h2>
      <div class="x_title">
      </div>
      <div class="x_content">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Destination</th>
              <th>Amount</th>
            </tr>
            <tbody>
            <?php
              $p_amount = $ind->purson_Amount_Total();
              $i = 0;
              $sum = 0;
              if ($p_amount) {
                while ($data = $p_amount->fetch(PDO::FETCH_OBJ)) { $i++;
                  $cashin = $ind->TBL_VAL_52('cashin','mobile',$data->mobile,'amount');
            ?>
              <tr>
                <td style="font-size: 12px;"><?php echo $i;?></td>
                <td style="font-size: 12px;"><?php echo $data->person;?></td>
                <td style="font-size: 12px;"><?php echo $data->destination;?></td>
                <td style="font-size: 12px;"><?php echo $totalval = ($data->AMOUNT)-$cashin;?></td>
              </tr>
              <?php $sum = $totalval + $sum;?>
            <?php } } ?>
            <?php if($sum != 0){ ?>
              <tr>
                <td></td>
                <td colspan="2" style="text-align: center;">Total</td>
                <td><?php echo $sum;?></td>
              </tr>
            <?php } ?>
            </tbody>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Today's Income <small>Chat</small></h2>
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
        <div class="dashboard-widget-content">
            <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Invoice No</th>
                    <th>Payment(Tk)</th>
                    <th>Current Due(Tk)</th>
                    <th>Payment Type</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $storedata = $ind->Tbl_Col_Id_2('payment','status','date','1',$datei);
                  $i = 0;
                  $pay23 = 0;
                  $due23 = 0;
                  if ($storedata) {
                    while ($data = $storedata->fetch(PDO::FETCH_OBJ)) { $i++;
                ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><a href="<?php echo $invoice;?>.php?invoice=<?php echo $data->invoice;?>"><?php echo $data->invoice;?></a></td>
                    <td><?php echo $pay12 = $data->payment;?></td>
                    <td><?php echo $due12 = $data->currentdue;?></td>
                    <td>
                      <?php
                        if ($data->payment > 0) {
                          if ($data->amountType == 1) {
                            echo "Bank";
                          }else{
                            echo "Cash";
                          }
                        }
                      ?>
                    </td>
                  </tr>
                  <?php
                    $pay23 = $pay12 + $pay23;
                    $due23 = $due12 + $due23;
                  ?>
                <?php } ?>
                <?php if($pay23 != 0){ ?>
                  <tr>
                    <td colspan="2" style="text-align: center;">Total</td>
                    <td><?php echo $pay23;?></td>
                    <td><?php echo $due23;?></td>
                    <td></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <?php } else{ ?>
            <div id="world-map-gdp" class="col-md-8 col-sm-12 col-xs-12" style="height:230px;"></div>
            <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Today's Expense <small>Chat</small></h2>
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
        <div class="dashboard-widget-content">
            <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Sector Name</th>
                    <th>Employee Name</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $storedata = $ind->Tbl_Col_Id('expense','date',$datei);
                  $i = 0;
                  $extotal1 = 0;
                  if ($storedata) {
                    while ($data = $storedata->fetch(PDO::FETCH_OBJ)) { $i++;
                ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $data->purpuse;?></td>
                    <td><?php if($data->employeeid == '' || $data->employeeid == '0'){echo "";}else{$emname = $ind->SelectAll_By_ID('customer',$data->employeeid);echo $emname->name;}?></td>
                    <td><?php echo $extotal = $data->amount;?></td>
                  </tr>
                  <?php
                    $extotal1 = $extotal1 + $extotal;
                  ?>
                <?php } ?>
                  <tr>
                    <td colspan="3" style="text-align: center;">Total</td>
                    <td><?php echo $extotal1;?></td>
                  </tr>
                </tbody>
              </table>
              <?php } else{ ?>
            <div id="world-map-gdp" class="col-md-8 col-sm-12 col-xs-12" style="height:230px;"></div>
            <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Today's Purchase <small>Chat</small></h2>
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
        <div class="dashboard-widget-content">
            <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Purchase No</th>
                    <th>Payment(Tk)</th>
                    <th>Current Due(Tk)</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $storedata = $ind->Tbl_Col_Id_2('payment','status','date','2',$datei);
                  $i = 0;
                  $payment_sum = 0;
                  $due_sum = 0;
                  if ($storedata) {
                    while ($data = $storedata->fetch(PDO::FETCH_OBJ)) { $i++;
                ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><a href="<?php echo $purchase;?>.php?invoice=<?php echo $data->invoice;?>"><?php echo $data->invoice;?></a></td>
                    <td><?php echo $payment200 = $data->payment;?></td>
                    <td><?php echo $due35 = $data->currentdue;?></td>
                  </tr>
                  <?php
                    $payment_sum = $payment_sum + $payment200;
                    $due_sum = $due_sum + $due35;
                  ?>
                <?php } ?>
                  <tr>
                    <td colspan="2" style="text-align: center;">Total</td>
                    <td><?php echo $payment_sum;?></td>
                    <td><?php echo $due_sum;?></td>
                  </tr>
                </tbody>
              </table>
              <?php } else{ ?>
            <div id="world-map-gdp" class="col-md-8 col-sm-12 col-xs-12" style="height:230px;"></div>
            <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>

</div>

<?php include "inc/footer.php";?>
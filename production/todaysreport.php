<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
  $ind = new Inden();
  $datei = date('m/d/Y');
?>
<?php
  $to_income = $ind->TBL_COL_2('payment','status','date','1',$datei,'payment');
  if ($to_income) {
    $to_income = $to_income;
  }else{
    $to_income = '0.00';
  }
  $to_purchase = $ind->TBL_COL_2('payment','status','date','2',$datei,'payment');
  if ($to_purchase) {
    $to_purchase = $to_purchase;
  }else{
    $to_purchase = '0.00';
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
    $to_income = '0.00';
  }
?>
<?php
  $tot_income = $ind->TBL_COL_1('payment','status','1','payment');
  if ($tot_income) {
    $tot_income = $tot_income;
  }else{
    $tot_income = "0.00";
  }
  $tot_purchase = $ind->TBL_COL_1('payment','status','2','payment');
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

  $bank_amount = $bankval-$Cashin_bank;
  $person_amount = $personval-$Cashin_person;
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Report Section</h3>
      </div>

      <div class="title_right">
        <div class="col-md-2 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <button class="btn btn-info" onclick="goBack();">Back</button>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Todays Report</h2>
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
              
<div id="printdiv" class="info">
<style type="text/css">
.phead{
  border: 1px solid;
  border-radius: 4px;
  padding: 7px;
  text-align: center;
  margin:0;
}
.ptable{
  margin-bottom: 10px;
  display: block;
  padding-bottom: 5px;
  margin-top: 5px;
  display: table;
}
</style>

    <div class="row">
      <div class="container">
        <div class="col-sm-6">
          <p class="phead">Income Statement<br><?php echo date("d M Y");?></p>
          <?php
            $to_date = date("m/d/Y");
            $income_stmt = $ind->tbl_select_any("payment",array('status'=>'1','date'=>$to_date),"customerid,payment,invoice,predue,currentdue","id","asc");
          ?>
          <table class="ptable" width="100%" border="1" cellpadding="0" cellspacing="0">
            <thead style="color: black;">
              <tr>
                <th width="5%">SL</th>
                <th>Customer</th>
                <th>Invoice No</th>
                <th style="text-align: center;">Total Sales</th>
                <th style="text-align: center;">Prv. Due</th>
                <th style="text-align: center;">Paid</th>
                <th style="text-align: center;">Due</th>
              </tr>
            </thead>
            <tbody style="border-bottom: 1px solid #000000;">
              <?php
                $is = 0;
                $t_sales = 0;
                $t_due = 0;
                $t_paid = 0;
                $t_prv = 0;
                while ($istmt = $income_stmt->fetch(PDO::FETCH_OBJ)) {$is++;
                  $cust = $ind->Tbl_Col_Id_LIMITE_0('customer','id',$istmt->customerid,'name');
              ?>
              <tr>
                <td><?php echo $is;?></td>
                <td><?php echo $cust->name;?></td>
                <td><?php echo $istmt->invoice;?></td>
                <td style="text-align: center;"><?php echo $sales_amt = (($istmt->payment+$istmt->currentdue)-$istmt->predue);$t_sales += $sales_amt;?></td>
                <td style="text-align: center;"><?php echo $t_prv_ = $istmt->predue;$t_prv += $t_prv_;?></td>
                <td style="text-align: center;"><?php echo $t_paid_ = $istmt->payment;$t_paid += $t_paid_;?></td>
                <td style="text-align: center;"><?php echo $due_amt = (($sales_amt+$t_prv_)-$t_paid_);$t_due += $due_amt;?></td>
              </tr>
              <?php } ?>
            </tbody>
            <tfoot>
              <th colspan="3" style="text-align: right;color:#000000;">Total</th>
              <th style="text-align: center;color:#000000;"><?php echo $t_sales;?></th>
              <th style="text-align: center;color:#000000;"><?php //echo $t_prv;?></th>
              <th style="text-align: center;color:#000000;"><?php echo $t_paid;?></th>
              <th style="text-align: center;color:#000000;"><?php //echo $t_due;?></th>
            </tfoot>
          </table>
        </div>
        <br><br><br>
        <div class="col-sm-6">
          <p class="phead">
          Purchase Statement<br><?php echo date("d M Y");?>
          </p>
          <?php
            $purchase_stmt = $ind->tbl_select_any("payment",array('status'=>'2','date'=>$to_date),"customerid,payment,invoice,currentdue,predue","id","asc");
          ?>
          <table class="ptable" width="100%" border="1" cellpadding="0" cellspacing="0">
            <thead>
            <tr>
                <th width="5%">SL</th>
                <th>Supplier</th>
                <th>Invoice No</th>
                <th style="text-align: center;">Total Amount</th>
                <th style="text-align: center;">Prv.Payable</th>
                <th style="text-align: center;">Paid</th>
                <th style="text-align: center;">Payable</th>
              </tr>
            </thead>
            <tbody style="border-bottom: 1px solid #000000;">
              <?php
                $is = 0;
                $t_sales = 0;
                $t_due = 0;
                $t_paid = 0;
                $t_prv = 0;
                while ($istmt = $purchase_stmt->fetch(PDO::FETCH_OBJ)) {$is++;
                  $cust = $ind->Tbl_Col_Id_LIMITE_0('customer','id',$istmt->customerid,'name');
              ?>
              <tr>
                <td><?php echo $is;?></td>
                <td><?php echo $cust->name;?></td>
                <td><?php echo $istmt->invoice;?></td>
                <td style="text-align: center;"><?php echo $sales_amt = (($istmt->payment+$istmt->currentdue)-$istmt->predue);$t_sales += $sales_amt;?></td>
                <td style="text-align: center;"><?php echo $t_prv_ = $istmt->predue;$t_prv += $t_prv_;?></td>
                <td style="text-align: center;"><?php echo $t_paid_ = $istmt->payment;$t_paid += $t_paid_;?></td>
                <td style="text-align: center;"><?php echo $due_amt = (($sales_amt+$t_prv_)-$t_paid_);$t_due += $due_amt;?></td>
              </tr>
              <?php } ?>
            </tbody>
            <tfoot>
              <th colspan="3" style="text-align: right;color:#000000;">Total</th>
              <th style="text-align: center;color:#000000;"><?php echo $t_sales;?></th>
              <th style="text-align: center;color:#000000;"><?php //echo $t_prv;?></th>
              <th style="text-align: center;color:#000000;"><?php echo $t_paid;?></th>
              <th style="text-align: center;color:#000000;"><?php //echo $t_due;?></th>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
    <br><br><br>
    <!-- <div class="row">
      <div class="container">
        <div class="col-sm-6">
          <p class="phead">Loan Receive Statement</p>
          <?php
            $lr_stmt = $ind->tbl_select_any("cashin",array('status'=>'1','date'=>$to_date),"person,amount","id","asc");
          ?>
          <table class="ptable" width="100%">
            <thead style="color: black;">
              <tr>
                <th width="5%">SL</th>
                <th>Name</th>
                <th style="text-align: right;">Amount</th>
              </tr>
            </thead>
            <tbody style="border-bottom: 1px solid #000000;">
              <?php
                $lr = 0;
                $lrmount = 0;
                while ($lrtmt = $lr_stmt->fetch(PDO::FETCH_OBJ)) {$lr++;
              ?>
              <tr>
                <td><?php echo $lr;?></td>
                <td><?php echo $lrtmt->person;?></td>
                <td style="text-align: right;"><?php echo $lrtmt->amount;$lrmount += $lrtmt->amount;?></td>
              </tr>
              <?php } ?>
            </tbody>
            <tfoot>
              <th colspan="2" style="text-align: left;color:#000000;">Total</th>
              <th style="text-align: right;color:#000000;"><?php echo $lrmount;?></th>
            </tfoot>
          </table>
        </div>
        <div class="col-sm-6">
          <p class="phead">
          Loan Paid Statement
          </p>
          <?php
            $lp_stmt = $ind->tbl_select_any("transfer",array('status'=>'1','date'=>$to_date),"person,amount","id","asc");
          ?>
          <table class="ptable" width="100%">
            <thead style="color: black;">
              <tr>
                <th width="5%">SL</th>
                <th>Name</th>
                <th style="text-align: right;">Amount</th>
              </tr>
            </thead>
            <tbody style="border-bottom: 1px solid #000000;">
              <?php
                $lp = 0;
                $lpamount = 0;
                while ($lptmt = $lp_stmt->fetch(PDO::FETCH_OBJ)) {$lp++;
              ?>
              <tr>
                <td><?php echo $lp;?></td>
                <td><?php echo $lptmt->person;?></td>
                <td style="text-align: right;"><?php echo $lptmt->amount;$lpamount += $lptmt->amount;?></td>
              </tr>
              <?php } ?>
            </tbody>
            <tfoot>
              <th colspan="2" style="text-align: left;color:#000000;">Total</th>
              <th style="text-align: right;color:#000000;"><?php echo $lpamount;?></th>
            </tfoot>
          </table>
        </div>
      </div>
    </div> -->
    <div class="row">
      <div class="container">
        <div class="col-sm-6">
          <p class="phead">
          Expense Statement<br><?php echo date("d M Y");?>
          </p>
          <?php
            $ex_stmt = $ind->tbl_select_any("expense",array('date'=>$to_date),"purpuse,employeeid,amount,note","id","asc");
          ?>
          <table class="ptable" width="100%" border="1" cellpadding="0" cellspacing="0">
            <thead style="color: black;">
              <tr>
                <th width="5%">SL</th>
                <th>Purpuse</th>
                <th>Note</th>
                <th>Expensed By</th>
                <th style="text-align: right;">Amount</th>
              </tr>
            </thead>
            <tbody style="border-bottom: 1px solid #000000;">
              <?php
                $ex = 0;
                $examount = 0;
                while ($extmt = $ex_stmt->fetch(PDO::FETCH_OBJ)) {$ex++;
                  if ($extmt->employeeid != "0") {
                    $emp = $ind->Tbl_Col_Id_LIMITE_0('customer','id',$extmt->employeeid,'name');
                  }
              ?>
              <tr>
                <td><?php echo $ex;?></td>
                <td><?php echo $extmt->purpuse;?></td>
                <td><?php echo $extmt->note;?></td>
                <td>
                  <?php if ($extmt->employeeid != "0") {
                      echo $emp->name;
                    }
                  ?>
                </td>
                <td style="text-align: right;"><?php echo $extmt->amount;$examount += $extmt->amount;?></td>
              </tr>
              <?php }?>
            </tbody>
            <tfoot>
              <th colspan="4" style="text-align: right;color:#000000;">Total</th>
              <th style="text-align: right;color:#000000;"><?php echo $examount;?></th>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
</div>
<button id="print" class="btn btn-info pull-right">Print</button>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->


<?php include "inc/footer.php";?>

<script type="text/javascript">
  $(function(){
    $("#print").click(function(){
      printData();
    });
  });


  function printData(){
     var divToPrint=document.getElementById("printdiv");
     newWin= window.open("");
     newWin.document.write(divToPrint.outerHTML);
     newWin.print();
     newWin.close();
  }
</script>
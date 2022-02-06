<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
$po = new Expense();
 if (isset($_GET['reset'])) {
   $cash = $po->Reset_Data('cash');
   $catagory = $po->Reset_Data('catagory');
   $customer = $po->Reset_Data('customer');
   $due = $po->Reset_Data('due');
   $expense = $po->Reset_Data('expense');
   $income = $po->Reset_Data('income');
   $payment = $po->Reset_Data('payment');
   $product = $po->Reset_Data('product');
   $purchase = $po->Reset_Data('purchase');
   $returnval = $po->Reset_Data('returnval');
   $sector = $po->Reset_Data('sector');
   $transfer = $po->Reset_Data('transfer');
   $cashin = $po->Reset_Data('cashin');
   $unit = $po->Reset_Data('unit');
   $destroy = $po->Reset_Data('destroy');
   $attendance = $po->Reset_Data('attendance');
   $store = $po->Reset_Data('store');
   if ($store) {
     Session::destroy();
   }
 }
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Factory Reset</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Reset All Data <small></small></h2>
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
            <a onclick="return confirm('Are Your Sure Clear All Data!!')" href="?reset=1" class="btn btn-danger btn-lg">Click Reset All Data</a>
          </div>
        </div>
      </div>
</div>
</div>
</div>
</div>
<!-- /page content -->




<?php include "inc/footer.php";?>
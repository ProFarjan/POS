<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
$po = new Income();
$invoice = "";
 if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['serachinvoice'])) {
   $invoice = $_POST["invoice"];
   echo "<script>window.location = 'incomereturn.php?invoice=".$invoice."';</script>";
 }
 if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['upquant'])) {
  $upquant = $po->Update_Income_Product($_POST);
 }
 if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['returnamval'])) {
  $Success = $po->Update_Payment_Return($_POST,'1');
 }
 if (isset($_GET['invoice']) AND !empty($_GET['invoice'])) {
   $invoice = $_GET['invoice'];
   $payment = $po->Tbl_Col_Id_LIMITE_0('payment','invoice',$invoice);
 }

?>


<link rel="stylesheet" type="text/css" href="css/return.css">

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Sales Return Page</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <a href="incomereturn.php"><button class="btn btn-info">Refresh </button></a>
            <a href="incomereturnlist.php"><button class="btn btn-primary">View All Return </button></a>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12" <?php if (isset($payment)) {echo "hidden='hidden'";} ?>>
        <div class="x_panel">
          <div class="x_title">
            <h2>Sales Return <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
          <span id="message123"><?php if(isset($addproduct)){echo $addproduct;}elseif(isset($Up_product)){echo $Up_product;}elseif(isset($Success)){echo $Success;}?></span>
            <br />
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="post">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Enter Invoice No <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="birthday" name="invoice" class="date-picker form-control col-md-7 col-xs-12" required="required" autocomplete="off" autofocus type="text" <?php if(isset($invoice)){echo "value='".$invoice."'";}?> >
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button class="btn btn-primary" type="submit" name="serachinvoice">Submit</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
<?php if (isset($payment)) {
      if ($payment) {
        $cust = $po->SelectAll_By_ID('customer',$payment->customerid);
?>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Return Slip<small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div id="printTable">
            <link rel="stylesheet" type="text/css" href="css/return.css">
            <div class="maindiv">
              <h2>Product Return Slip</h2>
              <table class="details">
                <tr>
                  <td>Date</td>
                  <td><?php echo $po->hl->formatDate01(date('Y/m/d'));?></td>
                </tr>
                <tr>
                  <td>Invoice</td>
                  <td><?php echo $payment->invoice;?></td>
                </tr>
                <tr>
                  <td>Customer ID</td>
                  <td><?php echo $cust->customerid;?></td>
                </tr>
                <tr>
                  <td>Customer Name</td>
                  <td><?php echo $cust->name;?></td>
                </tr>
                <tr>
                  <td>Customer Phone</td>
                  <td><?php echo $cust->phone;?></td>
                </tr>
              </table>
              <table class="product">
                <tr>
                  <td>SL</td>
                  <td>Product Code</td>
                  <td>Rate</td>
                  <td>Quantity</td>
                  <td>Unit</td>
                  <td>Amount (<?php echo $farjan->amountsymbol;?>)</td>
                </tr>
              <?php
                $productall = $po->Tbl_Col_Id('income','invoice',$payment->invoice);
                $i = 0;
                $subtotal = 0;
                if ($productall) {
                  while ($data = $productall->fetch(PDO::FETCH_OBJ)) { $i++;
                    $prod = $po->Tbl_Col_Id_LIMITE_0('product','id',$data->productid);
              ?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $prod->code;?></td>
                  <td><?php echo $data->rate;?></td>
                  <td>
                    <form action="" method="post">
                      <input type="text" autocomplete="off" name="quantity" value="<?php echo $total = $data->quantity;?>" id="quantity">
                      <input type="hidden" name="quantityold" value="<?php echo $total = $data->quantity;?>">
                      <input type="hidden" name="incomeid" value="<?php echo $data->id;?>">
                      <input type="hidden" name="returnold" value="<?php echo $data->returninfo;?>">
                      <input type="submit" name="upquant" value="up" class="btn btn-primary btn-xs">
                    </form>
                  </td>
                  <td><?php echo $data->unit;?></td>
                  <td><?php echo $sub = ($data->rate*$total);?></td>
                </tr>
                <?php $subtotal = $subtotal+$sub;}} ?>
              </table>
              <form action="" method="post">
              <table class="result">
                <tr>
                  <td>Sub Total(<?php echo $farjan->amountsymbol;?>)</td>
                  <td><input type="text" value="<?php echo $subtotal;?>" disabled >
                  <input type="hidden" name="subtotal" value="<?php echo $subtotal;?>">
                  </td>
                </tr>
                <tr>
                  <td>Other(<?php echo $farjan->amountsymbol;?>)</td>
                  <td><input type="text" name="other" value="<?php echo $payment->other;?>"></td>
                </tr>
                <tr>
                  <td>Discount</td>
                  <td><input type="text" name="discount" value="<?php echo $payment->disamount;?>" data-toggle="tooltip" data-placement="right" title="If You Pay discount Amount to Presence. Plesae add This Symbol (%) end of the Discount Amount. Ex. 25%"></td>
                </tr>
                <tr <?php if($payment->predue == "0"){echo "hidden='hidden'";}?>>
                  <td>Prevoius Due(<?php echo $farjan->amountsymbol;?>)</td>
                  <td><input type="text" value="<?php echo $payment->predue.' ('.$payment->predueinvoice.')';?>" disabled>
                  <input type="hidden" name="predue" value="<?php echo $payment->predue;?>">
                  </td>
                </tr>
                <tr>
                  <td>Grand Total(<?php echo $farjan->amountsymbol;?>)</td>
                  <td><input type="text" name="grand" value="<?php 
                  $disam = $payment->disamount;
                  echo $grand = ($subtotal+$payment->other+$payment->predue)-($disam);
                  ?>" disabled></td>
                </tr>
                <?php
                  $pay = $payment->payment;
                  $return = $grand-$pay;
                  $chack = substr($return, 0,1);
                ?>
                <tr>
                  <td><?php if($chack != '-'){echo "Due";}else{echo "Return";}?> Amount(<?php echo $farjan->amountsymbol;?>)</td>
                  <td><input type="text" name="returnam" <?php
                    if ($chack != '-') {
                      echo "value='".$return."' disabled";
                    }else{
                      echo "value='".substr($return,1)."'";
                    }
                  ?> ><input type="hidden" name="paymentid" value="<?php echo $payment->id;?>"><input type="hidden" name="paymentamount" value="<?php echo $payment->payment;?>"></td>
                </tr>
                <tr>
                  <td></td>
                  <td>
                    <input type="submit" name="returnamval" value="Return" class="btn btn-success">
                    <!-- <button id="print" class="btn btn-info">Print</button> -->
                  </td>
                </tr>
              </table>
              </form>
            </div>
            </div>
          
          </div>
        </div>
      </div>
<?php }} ?>
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
     var divToPrint=document.getElementById("printTable");
     newWin= window.open("");
     newWin.document.write(divToPrint.outerHTML);
     newWin.print();
     //newWin.close();
  }
</script>
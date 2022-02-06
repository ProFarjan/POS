<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
  $po = new Store();
  $product = $po->Total_Pay_Rece_Report('2');
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Payable Report Page</h3>
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
            <h2>Payable Report</h2>
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
            <div id="printTable">
            <div class="myreport">
            <h2 style="text-align: center;margin-top: 0;margin-bottom: 4px;">Payable Report</h2>
            <p style="text-align: center;border-bottom: 2px solid;">Date : <?php echo $po->hl->formatDate01(date('m/d/Y'));?></p>
              <table style="width: 100%;font-size: 16px;text-align: center;">
                <tr style="" class="bg-primary">
                  <th style="padding: 5px 4px;border: 1px solid;text-align: center;">#</th>
                  <th style="padding: 5px 0px;border: 1px solid;text-align: center;">Supplier Name</th>
                  <th style="padding: 5px 0px;border: 1px solid;text-align: center;">Supplier Phone</th>
                  <th style="padding: 5px 0px;border: 1px solid;text-align: center;">Grand Total(<?php echo $farjan->amountsymbol;?>)</th>
                  <th style="padding: 5px 0px;border: 1px solid;text-align: center;">Paid(<?php echo $farjan->amountsymbol;?>)</th>
                  <th style="padding: 5px 0px;border: 1px solid;text-align: center;">Current Due(<?php echo $farjan->amountsymbol;?>)</th>
                </tr>
                <?php
                        $i = 0;
                        $g_total = 0;
                        $g_paid = 0;
                        $g_due = 0;
                        if ($product) {
                          while ($data = $product->fetch(PDO::FETCH_OBJ)) { $i++;
                            $totalval = $po->F_Payable_Total_amount($data->customerid);
                            $grand = ($totalval+$data->OTHER)-($data->DISAMOUNT);
                            $c_due = $grand-$data->PAYMENT;
                            if ($c_due != 0 || !empty($c_due)) {
                      ?>
                        <tr>
                          <td style="padding: 5px 0px;border: 1px solid;"><?php echo $i;?></td>
                          <td style="padding: 5px 0px;border: 1px solid;">
                          <?php $cust = $po->SelectAll_By_ID('customer',$data->customerid);echo $cust->name;?>
                          </td>
                          <td style="padding: 5px 0px;border: 1px solid;"><?php echo $cust->phone;;?></td>
                          <td style="padding: 5px 0px;border: 1px solid;"><?php echo $grand;$g_total += $grand; ?></td>
                          <td style="padding: 5px 0px;border: 1px solid;"><?php echo $data->PAYMENT;$g_paid += $data->PAYMENT;?></td>
                          <td style="padding: 5px 0px;border: 1px solid;"><?php echo $c_due;$g_due += $c_due;?></td>
                        </tr>
                      <?php }}} ?>
                      <tr>
                        <th colspan="3" style="padding: 5px 0px;border: 1px solid;text-align: right;">Total</th>
                        <th style="padding: 5px 0px;border: 1px solid;text-align: center;"><?php echo $g_total;?></th>
                        <th style="padding: 5px 0px;border: 1px solid;text-align: center;"><?php echo $g_paid;?></th>
                        <th style="padding: 5px 0px;border: 1px solid;text-align: center;"><?php echo $g_due;?></th>
                      </tr>
              </table>
            </div>
            </div>
            <div style="width: 10%;margin: 0 auto;margin-top: 30px;">
              <button style="width: 100%;text-align: center;" class="btn btn-info" id="print">Print</button>
            </div>
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
     var divToPrint=document.getElementById("printTable");
     newWin= window.open("");
     newWin.document.write(divToPrint.outerHTML);
     newWin.print();
     //newWin.close();
  }
</script>
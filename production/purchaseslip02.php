<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php include "../classes/num2word.php";?>
<?php
 $in = new Income();
?>
<?php
 if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['paymentamount'])) {
   $payment = $in->Payment_Data_01($_POST);
 }
 if (isset($_GET['invoice']) AND !empty($_GET['invoice'])) {
  $invoice = $_GET['invoice'];
  $cust1 = $in->Tbl_Col_Id_LIMITE_0('payment','invoice',$invoice);
  $products = $in->Tbl_Col_Id('purchase','purchaseno',$invoice);
  $product_s = $in->Tbl_Col_Id('purchase','purchaseno',$invoice);
    if ($cust1) {
      $cust = $in->SelectAll_By_ID('customer',$cust1->customerid);
?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">

    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">
     
          <button onclick="javascript:printData();" id="print" class="btn btn-success">Print</button>
          <a href="editpurchase.php?edit=<?php echo $invoice;?>" class="btn btn-info">Edit</a>
          <a href="purchaselist.php?del=<?php echo $invoice;?>" class="btn btn-danger" style="float: right;">Delete</a>

          <div id="printTable">
          <header>
            <div style="height: 150px;"></div>
              <div style="padding: 0px;margin-bottom: 5px;">
                <p style="text-align: center;font-size: 25px;font-weight: bolder;margin:0px;">Purchase Slip</p>
                <ul style="list-style: none;font-size: 17px;margin:0;padding: 0;">
                  <li>Date: <span style=""><?php echo $in->hl->formatDate01($cust1->date);?></span></li>
                  <li>Purchase No: <span style=""><?php echo $invoice;?></span></li>
                  <li>Chalan No: <span style=""><?php echo $product_s->fetch(PDO::FETCH_OBJ)->chalanno;?></span></li>
                </ul>
              </div>
            </header>
            <div style="overflow:hidden;"></div>
            <main>
              <div style="width: 100%">
                <table style="width: 100%;text-align: center;" cellspacing="0" cellpadding="0">
                  <tr style="background: #ddd;font-size: 20px;">
                    <th style="border:1px solid #000;text-align: center;">Bill To</th>
                    <th style="border:1px solid #000;text-align: center;">Ship To</th>
                  </tr>
                  <tr>
                      <td style="border-bottom: 1px solid #000;padding: 5px;"><?php echo $cust->name;?></td>
                      <td style="border-bottom: 1px solid #000;padding: 5px;"><?php echo $cust->name;?></td>
                  </tr>
                  <?php if ($cust->company != '1') { ?>
                  <tr>
                    <td style="border-bottom: 1px solid #000;padding: 5px;"><?php echo $cust->company;?></td>
                    <td style="border-bottom: 1px solid #000;padding: 5px;"><?php echo $cust->company;?></td>
                  </tr>
                  <?php } ?>
                  <?php if($cust->address != "" || !empty($cust->address)){ ?>
                  <tr>
                    <td style="border-bottom: 1px solid #000;padding: 5px;"><?php echo $cust->address;?></td>
                    <td style="border-bottom: 1px solid #000;padding: 5px;"><?php echo $cust->address;?></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <td style="padding: 5px;"><?php echo $cust->phone;?></td>
                    <td style="padding: 5px;"><?php echo $cust->phone;?></td>
                  </tr>
                </table>
                        
              </div>
              <div style="overflow: hidden;"></div>
              <div style="width: 100%;min-height: 350px;border: 1px solid #000;border-top: 0px;" class="product">
                <table style="width: 100%;text-align: center;" cellpadding="0" cellspacing="0">
                <thead>
                  <tr>
                    <th style="border:1px solid #000;font-size: 16px;background: #ddd;text-align: center;">SL.NO</th>
                    <th style="border:1px solid #000;font-size: 16px;background: #ddd;text-align: center;">Product Code</th>
                    <th style="border:1px solid #000;font-size: 16px;background: #ddd;text-align: center;">Product Type</th>
                    <th style="border:1px solid #000;font-size: 16px;background: #ddd;text-align: center;">Product Name</th>
                    <th style="border:1px solid #000;font-size: 16px;background: #ddd;text-align: center;">Per Unit Price</th>
                    <th style="border:1px solid #000;font-size: 16px;background: #ddd;text-align: center;">Quantity</th>
                    <th style="border:1px solid #000;font-size: 16px;background: #ddd;text-align: center;">Amount(<?php echo $farjan->amountsymbol;?>)</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    if ($products) {
                        $i = 0;
                        $subtotal1 = 0;
                        while ($data = $products->fetch(PDO::FETCH_OBJ)) { $i++;
                            $pro = $in->SelectAll_By_ID('product',$data->productid);
                ?>
                  <tr style="border:1px solid #ddd;">
                    <td style="font-size: 14px;padding: 3px 5px;border-bottom: 1px solid #000;"><?php echo $i;?></td>
                    <td style="font-size: 14px;padding: 3px 5px;border-bottom: 1px solid #000;"><?php echo $pro->code;?></td>
                    <td style="font-size: 14px;padding: 3px 5px;border-bottom: 1px solid #000;"><?php echo $pro->type;?></td>
                    <td style="font-size: 14px;padding: 3px 5px;border-bottom: 1px solid #000;"><?php echo $pro->name;?></td>
                    <td style="font-size: 14px;padding: 3px 5px;border-bottom: 1px solid #000;"><?php echo $data->rate;?></td>
                    <td style="font-size: 14px;padding: 3px 5px;border-bottom: 1px solid #000;">
                      <?php echo $data->quantity." ";
                        if ($data->unit == '0') {
                          echo 'sq/ft';
                        }else{
                          echo $data->unit;
                        }
                        if ($pro->type == 'Tiles') {
                          $car = $in->Tbl_Col_Id_LIMITE_0('store','productid',$pro->id);
                          echo " | ".round($data->quantity/$car->percarton,2)."C ";
                          $inch = $pro->name;
                          $val = explode('*', $inch);
                          $insq = $val[0]*$val[1];
                          $ftsq = $insq*0.00694444;
                          $piece = $data->quantity/$ftsq;
                          echo " | ".round($piece,2)."P";
                        }
                      ?>
                    </td>
                    <td style="font-size: 14px;padding: 3px 5px;border-bottom: 1px solid #000;"><?php echo $subtotal = ($data->quantity)*($data->rate);?></td>
                  </tr>
                  <?php
                    $subtotal1 = $subtotal1+$subtotal;
                  ?>
                <?php }} ?>
                </tbody>
                </table>
              </div>
              <div style="overflow: hidden;"></div>
              <div style="margin-top: 5px;">
                <div style="width: 49%;float: left;border:1px solid #000;min-height: 100px;margin-right: 2px;">
                   <p style="text-align: center;background: #ddd;font-size: 18px;font-weight: bolder;">In Words</p>
                   <p style="text-align: center;font-size: 16px;">
                       <?php
                            $abcd = ($subtotal1+$cust1->other+$cust1->predue)-($cust1->disamount);
                            $totalabc = convertNumberToWord($abcd);
                            echo $farjan->amountsymbol.'. '.ucwords($totalabc).' Only';
                        ?>
                   </p>
                </div>
                <table style="width: 50%;" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="border:1px solid #000;width: 60%;font-size: 15px;text-align: center;">Sub Total</td>
                    <td style="border:1px solid #000;font-size: 15px;text-align: center;"><?php
                            echo $subtotal1;
                        ?></td>
                  </tr>
                  <tr>
                    <td style="border:1px solid #000;width: 60%;font-size: 15px;text-align: center;">Other Cost</td>
                    <td style="border:1px solid #000;font-size: 15px;text-align: center;"><?php
                                echo $other = $cust1->other;
                        ?></td>
                  </tr>
                  <tr>
                    <td style="border:1px solid #000;width: 60%;font-size: 15px;text-align: center;">Discount</td>
                    <td style="border:1px solid #000;font-size: 15px;text-align: center;"><?php
                            echo $cust1->disamount.' '.$farjan->amountsymbol ." (".$cust1->discount."%)";
                        ?></td>
                  </tr>
                  <tr <?php if($cust1->predue == "0"){echo "hidden='hidden';";}?>>
                    <td style="border:1px solid #000;width: 60%;font-size: 15px;text-align: center;">Previous Due</td>
                    <td style="border:1px solid #000;font-size: 15px;text-align: center;"><?php
                                echo $cust1->predue." ".$farjan->amountsymbol." (".$cust1->predueinvoice.")";
                        ?></td>
                  </tr>
                  <tr>
                    <td style="border:1px solid #000;width: 60%;font-size: 15px;text-align: center;">Grand Total</td>
                    <td style="border:1px solid #000;font-size: 15px;text-align: center;"><?php
                            echo $grandtot = ($subtotal1+$other+$cust1->predue)-($cust1->disamount)." ".$farjan->amountsymbol;
                        ?></td>
                  </tr>
                  <tr>
                    <td style="border:1px solid #000;width: 60%;font-size: 15px;text-align: center;">Paid</td>
                    <td style="border:1px solid #000;font-size: 15px;text-align: center;"><?php
                                echo ($cust1->payment+$cust1->changeval)." ".$farjan->amountsymbol;
                            ?></td>
                  </tr>
                  <tr <?php if($cust1->currentdue == "0"){echo "hidden='hidden'";}?>>
                    <td style="border:1px solid #000;width: 60%;font-size: 15px;text-align: center;">Current Due</td>
                    <td style="border:1px solid #000;font-size: 15px;text-align: center;"><?php
                          echo $cust1->currentdue . " ".$farjan->amountsymbol;
                        ?></td>
                  </tr>
                  <?php
                    if ($cust1->changeval != "0") {
                  ?>
                  <tr>
                    <td style="border:1px solid #000;width: 60%;font-size: 15px;text-align: center;">Change</td>
                    <td style="border:1px solid #000;font-size: 15px;text-align: center;"><?php
                          echo $cust1->changeval . " ".$farjan->amountsymbol;
                        ?></td>
                  </tr>
                  <?php } ?>
                </table>
              </div>
            </main>
            <div style="overflow: hidden;"></div>
            <footer>
              <ul style="list-style: none;margin-top: 35px;margin-bottom: 0px;">
                  <li style="float: left;width: 15%;float: left;">Customer sign</li>
                  <li style="text-align: right;margin-left: 0px;margin-right: 75px;">Authorized Sign</li>
              </ul>
              <p style="font-size: 16px;font-weight: bold;text-align: center;margin:0px;position: relative;top:-15px;">Thank You For Your Business</p>
              <div style="margin: 0 auto 10px;text-align: center;">
              <img src="data:image/png;base64, <?php echo base64_encode($in->hl->barcode($invoice));?>">
              </div>
              <tt style="font-size: 12px;text-align: center;margin: 0 auto;display: block;position:absolute;bottom: 0px;">This software is developed by IT Pal Limited (www.itpal.com.bd)</tt>
            </footer>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
<?php }else{echo "<script>window.location = '404.php';</script>";}}else{echo "<script>window.location = '404.php';</script>";}?>
<?php include "inc/footer.php";?>

<script type="text/javascript">
  /*$(function(){
    $("#print").click(function(){
      printData();
    });
  });*/
  function printData(){
     var divToPrint=document.getElementById("printTable");
     newWin= window.open("");
     newWin.document.write(divToPrint.outerHTML);
     newWin.print();
     //newWin.close();
  }
</script>

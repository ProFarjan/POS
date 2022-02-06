<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php include "../classes/num2word.php";?>
<?php
 $in = new Income();
 $info = $in->Tbl_Col_Id('setting','id','1')->fetch(PDO::FETCH_OBJ);
?>
<?php
 if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['paymentamount'])) {
   $payment = $in->Payment_Data($_POST);
 }
 if (isset($_GET['invoice']) AND !empty($_GET['invoice'])) {
  $invoice = $_GET['invoice'];
  $cust1 = $in->Tbl_Col_Id_LIMITE_0('payment','invoice',$invoice);
  $products = $in->Tbl_Col_Id('income','invoice',$invoice);
    if ($cust1) {
      $cust = $in->SelectAll_By_ID('customer',$cust1->customerid);
?>

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
          <a href="editinvoice.php?edit=<?php echo $invoice;?>" class="btn btn-info">Edit</a>
          <?php $access_url =  Session::get('access');if($access_url == "admin"){ ?>
          <a href="invoicelist.php?del=<?php echo $invoice;?>" class="btn btn-danger" style="float: right;">Delete</a>
          <?php } ?>
          <div id="printTable">
              <!--<div style="width:100%;">
                  <img src="<?=$info->companylogo;?>" class="img" style="position: absolute;opacity: 0.05;margin-top: 130px;margin-left: 90px;" />
              </div>-->
            <header>
                <!--<div class="row-fluid">
                    <div class="span12" style="overflow: hidden;">
                        <div style="width: 70%;float: left;overflow: hidden;">
                            <h3 style="margin: 4px 0px 0;"><?=$info->companyname;?></h3>
                            <small><?=$info->address;?></small>
                            <br>
                            <small>Phone: <?=$info->phone;?></small>
                            <br>
                            <small>Email: <?=$info->email;?></small>
                        </div>
                        <div style="text-align: right;overflow: hidden;">
                            <img width="80px" src="<?=$info->companylogo;?>" class="img">
                        </div>
                    </div>
                    <hr>
                </div>-->
                <div style="height: 118px;"></div>
              <div style="padding: 0px;margin-bottom: 5px;width: 100%;">
                <p style="border-bottom: 1px solid;font-size: 16px;font-weight: bolder;">INVOICE # <?php echo $invoice;?></p>
                <div style="width: 50%;float: left;overflow: hidden;">
                  <ul style="list-style: none;padding-left: 0;text-align: left;margin-top: 0;">
                    <li style="font-weight: bolder;font-size: 14px;">Invoiced To</li>
                    <li><?php echo $cust->name;?></li>
                    <?php if(!empty($cust->phone)){ ?>
                    <li><?php echo $cust->phone;?></li>
                    <?php } ?>
                    <?php if(!empty($cust->address)){ ?>
                    <li><?php echo $cust->address;?></li>
                    <?php } ?>
                  </ul>
                </div>

                <div style="width: 50%;float: left;overflow: hidden;">
                  <table border="1" cellspacing="0" cellpadding="0" style="width: 100%;font-size: 16px;    margin-bottom: 15px;">
                    <tr>
                      <td colspan="2" style="text-align: center;vertical-align: middle;padding: 5px;font-weight: bolder;">
                        <b id="cdcust">Customer Copy</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="padding: 3px;">Invoice Date</td>
                      <td style="padding: 3px;"><?php echo date("d M Y",strtotime($cust1->date));?></td>
                    </tr>
                    <tr>
                      <td style="padding: 3px;">Billed By</td>
                      <td style="padding: 3px;">
                        <?php
                          $received_by_payment = $cust1->received_by;
                          $received_by = Session::get('UserId');
                          if ($received_by_payment == $received_by) {
                            echo Session::get('UserName');
                          }else{
                            $received_by_name = $in->SelectAll_By_ID("user",$received_by_payment,"name");
                            echo $received_by_name->name;
                          }
                        ?>
                      </td>
                    </tr>
                  </table>
                </div>

              </div>

            </header>

            <main>
              <div style="width: 100%;border-top: 0px;margin-top: 10px;min-height: 610px;" class="product">
                <table style="width: 100%;text-align: center;" border="1" cellpadding="0" cellspacing="0">
                <thead>
                  <tr>
                    <th width="5%" style="font-size: 16px;background: #ddd;text-align: center;">SL</th>
                    <th width="50%" style="font-size: 16px;background: #ddd;text-align: center;">Item</th>
                    <th style="font-size: 16px;background: #ddd;text-align: center;">Unit Price</th>
                    <th style="font-size: 16px;background: #ddd;text-align: center;">Quantity</th>
                    <th style="font-size: 16px;background: #ddd;text-align: center;">Amount (BDT)</th>
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
                  <tr>
                    <td style="font-size: 14px;padding: 3px 5px;border-bottom: 1px solid #000;"><?php echo $i;?></td>
                    <td style="font-size: 14px;padding: 3px 5px;border-bottom: 1px solid #000;text-align: left;">
                      <?php
                        if ($pro->type == "Tiles") {
                          echo $pro->code." :: ".$pro->type." ".$pro->subtype." (".$pro->name.")";
                        }else{
                          echo $pro->name;
                        }
                      ?>
                    </td>
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
                          echo " | ".round($data->quantity/$car->percarton,2)."C";
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

                <style type="text/css">
                  .acinfo {
                    font-size: 12px;
                    margin: 0 15px;
                    text-align: left;
                  }
                </style>

                <tr>
                  <td colspan="3" rowspan="5">
                    

                  </td>
                  <td style="text-align: right;padding: 8px 8px 8px 0;">Total</td>
                  <td><?php echo $subtotal1;?></td>
                </tr>
                <?php $status_mm = false;$other = 0;if($cust1->other > 0){$status_mm=true; ?>
                <tr>
                  <td style="text-align: right;padding: 8px 8px 8px 0;">Other Cost</td>
                  <td><?php echo $other = $cust1->other;?></td>
                </tr>
                <?php } ?>
                <?php if($cust1->disamount > 0){$status_mm=true; ?>
                <tr>
                  <td style="text-align: right;padding: 8px 8px 8px 0;">Less</td>
                  <td style="border-bottom: 1px solid;"><?php
                          echo $cust1->disamount;
                          if ($cust1->disamount > 0) {
                            echo " (".$cust1->discount.")";
                          }
                      ?></td>
                </tr>
                <?php } ?>
                <?php $grandtot = ($subtotal1+$other)-($cust1->disamount); if($status_mm){ ?>
                <tr style="border-bottom: 0px;">
                  <td style="text-align: right;padding: 8px 8px 8px 0;border-bottom: 1px solid;">Grand Total</td>
                  <td style="border-bottom: 1px solid;"><?php
                          echo $grandtot;
                      ?></td>
                </tr>
                <?php } ?>
                <tr style="border-bottom: 0px;">
                  <td style="text-align: right;padding: 8px 8px 8px 0;border-bottom: 1px solid;">Paid</td>
                  <td style="border-bottom: 1px solid;">
                    <?php echo ($cust1->payment+$cust1->changeval);?>
                  </td>
                </tr>
                <?php
                    if(($grandtot-$cust1->payment) > 0){
                ?>
                <tr style="border-bottom: 0px;">
                  <td style="text-align: right;padding: 8px 8px 8px 0;border-bottom: 1px solid;">Due</td>
                  <td style="border-bottom: 1px solid;">
                    <?php echo ($grandtot-$cust1->payment);?>
                  </td>
                </tr>
                <?php } ?>
                </tbody>
                </table>
                <?php if($cust1->changeval > 0){ ?>
                <p style="text-align: right;margin: 10px 16px;"><b>Change :</b> <?php echo $cust1->changeval;?> TK </p>
                <?php } ?>
                <br>
                <p style="text-align: left;">
                  <b>In Word :</b><br>
                  <?php
                      $abcd = ($subtotal1+$cust1->other+$cust1->predue)-($cust1->disamount);
                      $totalabc = convertNumberToWord($grandtot);
                      echo 'Taka '.ucwords($totalabc).' Only.';
                  ?>
                </p>
              </div>
            </main>
            <div style="overflow: hidden;"></div>
            <footer style="margin-bottom: 90px;">
              <ul style="list-style: none;margin-top: 10px;margin-bottom: 10px;padding: 0;">
                  <li style="float: left;width: 25%;float: left;border-top: 1px solid;">Customer</li>
                  <li style="text-align: right;margin-left: 0px;margin-right: 0px;border-top: 1px solid;width: 25%;float: right;">For <?=$info->companyname;?></li>
              </ul>
              <br><br><br><br><br>
              <p style="font-size: 16px;font-weight: bold;text-align: center;margin:0px;">In Sha-Allah Delivering A Better Tomorrow</p>
              <div style="margin: 10px auto 10px;text-align: left;">
              <img src="data:image/png;base64, <?php echo base64_encode($in->hl->barcode($invoice));?>">
              </div>
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

  function printData(){
     var divToPrint=document.getElementById("printTable");
     newWin= window.open("");
     newWin.document.write(divToPrint.outerHTML);

     document.getElementById("cdcust").innerHTML = "Office Copy";
     var divToPrint1 = document.getElementById("printTable");

     newWin.document.write(divToPrint1.outerHTML);
     newWin.print();
     newWin.close();
  }
</script>
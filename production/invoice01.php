<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php include "../classes/num2word.php";?>
<?php
 $in = new Income();
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
     
          <button id="print" class="btn btn-success">Print</button>
          <a href="editinvoice.php?edit=<?php echo $invoice;?>" class="btn btn-info">Edit</a>
          <a href="invoicelist.php?del=<?php echo $invoice;?>" class="btn btn-danger" style="float: right;">Delete</a>

          <div id="printTable" style="width: 320px;margin: 0;">
<style type="text/css">
/* vietnamese */
@font-face {
  font-family: 'Pacifico';
  font-style: normal;
  font-weight: 400;
  src: local('Pacifico Regular'), local('Pacifico-Regular'), url(https://fonts.gstatic.com/s/pacifico/v9/m0Shgsxo4xCSzZHO6RHWxBTbgVql8nDJpwnrE27mub0.woff2) format('woff2');
  unicode-range: U+0102-0103, U+1EA0-1EF9, U+20AB;
}
/* latin-ext */
@font-face {
  font-family: 'Pacifico';
  font-style: normal;
  font-weight: 400;
  src: local('Pacifico Regular'), local('Pacifico-Regular'), url(https://fonts.gstatic.com/s/pacifico/v9/6RfRbOG3yn4TnWVTc898ERTbgVql8nDJpwnrE27mub0.woff2) format('woff2');
  unicode-range: U+0100-024F, U+1E00-1EFF, U+20A0-20AB, U+20AD-20CF, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Pacifico';
  font-style: normal;
  font-weight: 400;
  src: local('Pacifico Regular'), local('Pacifico-Regular'), url(https://fonts.gstatic.com/s/pacifico/v9/Q_Z9mv4hySLTMoMjnk_rCfesZW2xOQ-xsNqO47m55DA.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215;
}


/* vietnamese */
@font-face {
  font-family: 'Pacifico';
  font-style: normal;
  font-weight: 400;
  src: local('Pacifico Regular'), local('Pacifico-Regular'), url(https://fonts.gstatic.com/s/pacifico/v9/m0Shgsxo4xCSzZHO6RHWxBTbgVql8nDJpwnrE27mub0.woff2) format('woff2');
  unicode-range: U+0102-0103, U+1EA0-1EF9, U+20AB;
}
/* latin-ext */
@font-face {
  font-family: 'Pacifico';
  font-style: normal;
  font-weight: 400;
  src: local('Pacifico Regular'), local('Pacifico-Regular'), url(https://fonts.gstatic.com/s/pacifico/v9/6RfRbOG3yn4TnWVTc898ERTbgVql8nDJpwnrE27mub0.woff2) format('woff2');
  unicode-range: U+0100-024F, U+1E00-1EFF, U+20A0-20AB, U+20AD-20CF, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Pacifico';
  font-style: normal;
  font-weight: 400;
  src: local('Pacifico Regular'), local('Pacifico-Regular'), url(https://fonts.gstatic.com/s/pacifico/v9/Q_Z9mv4hySLTMoMjnk_rCfesZW2xOQ-xsNqO47m55DA.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215;
}
/* latin-ext */
@font-face {
  font-family: 'Condiment';
  font-style: normal;
  font-weight: 400;
  src: local('Condiment'), local('Condiment-Regular'), url(https://fonts.gstatic.com/s/condiment/v4/oNYD56vpVs4G0nM6ti4yOBJtnKITppOI_IvcXXDNrsc.woff2) format('woff2');
  unicode-range: U+0100-024F, U+1E00-1EFF, U+20A0-20AB, U+20AD-20CF, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Condiment';
  font-style: normal;
  font-weight: 400;
  src: local('Condiment'), local('Condiment-Regular'), url(https://fonts.gstatic.com/s/condiment/v4/H3zUdSYh9r5ccxclUWaH7ltXRa8TVwTICgirnJhmVJw.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215;
}
/* latin */
@font-face {
  font-family: 'Tangerine';
  font-style: normal;
  font-weight: 400;
  src: local('Tangerine Regular'), local('Tangerine-Regular'), url(https://fonts.gstatic.com/s/tangerine/v8/HGfsyCL5WASpHOFnouG-RFtXRa8TVwTICgirnJhmVJw.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215;
}
@media print {
  #printTable {
    margin:0px;
  }
  /* etc */
}
</style>
            <header>
              <div style="width: 100%;margin: 0 auto;text-align: center;padding-bottom: 15px;">
                  <img src="<?php echo $farjan->companylogo;?>" style="width:80px;height: 80px;">
                <ul style="list-style: none;font-size: 14px;margin:0px;">
                  <li style="margin:0px;"><?php echo Session::get('Address');?></li>
                  <li style="margin:0px;">Contact: <?php echo Session::get('Mobile');?></li>
                  <li style="margin:0px;">E-mail: <?php echo Session::get('Email');?></li>
                </ul>
              </div>
            </header>
            <div style="overflow:hidden;"></div>
            <main>
              <div style="width: 100%;margin-bottom: 15px;">
                <table style="width: 100%;text-align: left;">
                    <tr>
                        <td style="font-size: 13px;">Invoice No. <?php echo $invoice;?></td>
                        <td style="font-size: 13px;"></td>
                    </tr>
                  <tr>
                    <td style="font-size: 13px;">Date: <?php echo $in->hl->formatDate01($cust1->date);?></td>
                    <td style="font-size: 13px;">Customer ID. <?php echo $cust->customerid;?></td>
                  </tr>
                  <tr>
                    <td style="font-size: 13px;">Name. <?php echo $cust->name;?></td>
                    <td style="font-size: 13px;">Phone. <?php echo $cust->phone;?></td>
                  </tr>
                  <?php if ($cust->company != '1') { ?>
                  <tr>
                    <td style="font-size: 13px;">Company. <?php echo $cust->company;?></td>
                    <td style="font-size: 13px;">Address. <?php echo $cust->address;?></td>
                  </tr>
                  <?php } ?>
                </table>
                        
              </div>
              <div style="overflow: hidden;"></div>
              <div style="padding-bottom: 15px;" class="product">
                <table style="width: 100%;text-align: justify;">
                <thead>
                  <tr style="border-bottom: 1px solid;">
                    <th style="font-weight: bolder;font-size: 12px;">Code</th>
                    <th style="font-weight: bolder;font-size: 12px;">Item</th>
                    <th style="font-weight: bolder;font-size: 12px;">Qty</th>
                    <th style="font-weight: bolder;font-size: 12px;">Rate</th>
                    <th style="font-weight: bolder;font-size: 12px;">Amount</th>
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
                  <tr style="border-bottom: 1px solid;">
                    <td style="padding: 2px 0px;font-size: 12px;"><?php echo $pro->code;?></td>
                    <td style="padding: 2px 0px;font-size: 12px;"><?php echo $pro->name;?></td>
                    <td style="padding: 2px 0px;font-size: 12px;">
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
                    <td style="padding: 2px 0px;font-size: 12px;"><?php echo $data->rate;?></td>
                    <td style="padding: 2px 0px;font-size: 12px;"><?php echo $subtotal = ($data->quantity)*($data->rate);?></td>
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
                <table style="width: 100%;">
                  <tr>
                    <td style="font-size: 13px;text-align: left;">Itam Total</td>
                    <td style="font-size: 13px;text-align: right;"><?php
                            echo $subtotal1;
                        ?></td>
                  </tr>
                  <tr>
                    <td style="font-size: 13px;text-align: left;">Other Cost</td>
                    <td style="font-size: 13px;text-align: right;"><?php
                                echo $other = $cust1->other;
                        ?></td>
                  </tr>
                  <tr>
                    <td style="font-size: 13px;text-align: left;">Discount/Less</td>
                    <td style="font-size: 13px;text-align: right;"><?php
                            echo $cust1->disamount;
                            if ($cust1->disamount != '0') {
                              echo " (".$cust1->discount."%)";
                            }
                        ?></td>
                  </tr>
                  <tr>
                    <td style="font-size: 13px;text-align: left;">Previous Due</td>
                    <td style="font-size: 13px;text-align: right;"><?php
                                echo $cust1->predue;
                                if ($cust1->predue != "0") {
                                  echo " (".$cust1->predueinvoice.")";
                                }
                        ?></td>
                  </tr>
                  <tr>
                    <td style="font-size: 13px;text-align: left;">Grand Total</td>
                    <td style="font-size: 13px;text-align: right;"><?php
                            echo $grandtot = ($subtotal1+$other+$cust1->predue)-($cust1->disamount);
                        ?></td>
                  </tr>
                  <tr>
                    <td style="font-size: 13px;text-align: left;border-bottom: 2px solid;">Paid</td>
                    <td style="font-size: 13px;text-align: right;border-bottom: 2px solid;"><?php
                                echo ($cust1->payment+$cust1->changeval);
                            ?></td>
                  </tr>
                  <tr>
                    <td style="font-size: 13px;text-align: left;"><?php
                      if ($cust1->changeval != "0") {
                        echo "Change";
                      }else{
                        echo "Current Due";
                      }
                    ?></td>
                    <td style="font-size: 13px;text-align: right;"><?php
                        if ($cust1->changeval != "0") {
                          echo $cust1->changeval;
                        }else{
                          echo $cust1->currentdue;
                        }
                        ?></td>
                  </tr>
                </table>
                <p style="text-align: center;font-size: 12px;padding: 5px 0;font-family: 'Pacifico', cursive;">(
                  <?php
                      $abcd = ($subtotal1+$cust1->other+$cust1->predue)-($cust1->disamount);
                      $totalabc = convertNumberToWord($abcd);
                      echo $farjan->amountsymbol.'. '.ucwords($totalabc).' Only';
                  ?>)
                </p>
              </div>
            </main>
            <div style="overflow: hidden;"></div>
            <section>
              <p style="font-size: 10px;text-align: center;">Thank You For Your Business !!</p>
              <?php
                if ($farjan->list1 == 'invoice01') {
              ?>
              <p style="font-size: 12px;text-align: center;">AHC Pharma</p>
              <?php } ?>
            </section>
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
     newWin.close();
  }
</script>
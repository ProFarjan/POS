<?php
error_reporting(null);
 include_once "../classes/Inden.php";
 $ind = new Inden();
 $farjan = $ind->SelectAll_By_ID('setting','1');
 $invoice_no = $farjan->list1;
 $purchase_no = $farjan->list2;

 if (isset($_POST['Dateval']) AND isset($_POST['Status'])) {
 	$id = $_POST['Dateval'];
 	$status = $_POST['Status'];
 	$to = substr($id, 0,10);
 	$form = substr($id, 13,10);

  $income = $ind->sarinda_sanatary("income","date","status","1",$to,$form);
  $income = $income->fetchall();
  $tiles_income = array();
  $sanatary_income = array();
  foreach ($income as $key => $value) {
    $product = $ind->SelectAll_By_ID("product",$value['productid']);
    if ($product->type == 'Tiles') {
      if (array_key_exists($value['date'], $tiles_income) == TRUE) {
        $tiles_income[$value['date']] = $tiles_income[$value['date']]+($value['quantity']*$value['rate']);
      }else{
        $tiles_income[$value['date']] = ($value['quantity']*$value['rate']);
      }
    }else{
      if (array_key_exists($value['date'], $sanatary_income) == TRUE) {
        $sanatary_income[$value['date']] = $sanatary_income[$value['date']]+($value['quantity']*$value['rate']);
      }else{
        $sanatary_income[$value['date']] = ($value['quantity']*$value['rate']);
      }
    }
  }

  $purchase = $ind->sarinda_sanatary("purchase","date","status","1",$to,$form);
  $purchase = $purchase->fetchall();
  $tiles_purchase = array();
  $sanatary_purchase = array();
  foreach ($purchase as $key => $value) {
    $product = $ind->SelectAll_By_ID("product",$value['productid']);
    if ($product->type == 'Tiles') {
      if (array_key_exists($value['date'], $tiles_purchase) == TRUE) {
        $tiles_purchase[$value['date']] = $tiles_purchase[$value['date']]+($value['quantity']*$value['rate']);
      }else{
        $tiles_purchase[$value['date']] = ($value['quantity']*$value['rate']);
      }
    }else{
      if (array_key_exists($value['date'], $sanatary_purchase) == TRUE) {
        $sanatary_purchase[$value['date']] = $sanatary_purchase[$value['date']]+($value['quantity']*$value['rate']);
      }else{
        $sanatary_purchase[$value['date']] = ($value['quantity']*$value['rate']);
      }
    }
  }

  $expense_my = $ind->sarinda_expense("expense","date",$to,$form);
  $expense_my = $expense_my->fetchall();
  $expense_sarinda = array();
  foreach ($expense_my as $key => $value) {
    if (array_key_exists($value['date'], $expense_sarinda) == TRUE) {
      $expense_sarinda[$value['date']] = $expense_sarinda[$value['date']]+$value['amount'];
    }else{
      $expense_sarinda[$value['date']] = $value['amount'];
    }
  }

?>


<h2 style="text-align: center;margin-top: 0;margin-bottom: 4px;">Sales,Purcharse,Expense Report's</h2>
<p style="text-align: center;border-bottom: 2px solid;">To : <?php echo $ind->hl->formatDate01($to);?>  <==>  From : <?php echo $ind->hl->formatDate01($form);?></p>
  <table style="width: 100%;font-size: 16px;">
    <tr style="" class="bg-primary">
      <th style="padding: 5px 4px;border: 1px solid;text-align: center;">SL.No</th>
      <th style="padding: 5px 0px;border: 1px solid;text-align: center;">Date</th>
      <th style="padding: 5px 0px;border: 1px solid;text-align: center;">Sanatery Sales</th>
      <th style="padding: 5px 0px;border: 1px solid;text-align: center;">Tiles Sales</th>
      <th style="padding: 5px 0px;border: 1px solid;text-align: center;">Sanatery Purcharse</th>
      <th style="padding: 5px 0px;border: 1px solid;text-align: center;">Tiles Purcharse</th>
      <th style="padding: 5px 0px;border: 1px solid;text-align: center;">Expense </th>
      <th style="padding: 5px 0px;border: 1px solid;text-align: center;">Cash In Hand</th>
    </tr>
    <?php
      $to_cu = substr($to, 3,2);
      $to_mth = substr($to, 0,2);
      $to_year = substr($to, 6,4);
      $form_cu = substr($form, 3,2);
      $j = 0;
      $tot_tiles12 = 0;
      $tot_san12 = 0;
      $tot_san14 = 0;
      $tot_tilse14 = 0;
      $tot_expense24 = 0;
      $cashinhand250 = 0;
      for ($i=$to_cu; $i <= $form_cu; $i++) { $j++;
        if (strlen($to_cu) < 2) {
          $to_cu = '0'.$to_cu;
        }
        $mydate = $to_mth.'/'.$to_cu.'/'.$to_year;
    ?>
    <tr>
      <td style="padding: 5px 4px;border: 1px solid;text-align: center;"><?php echo $j;?></td>
      <td style="padding: 5px 4px;border: 1px solid;text-align: center;"><?php echo $ind->hl->formatDate01($mydate);?></td>
      <td style="padding: 5px 4px;border: 1px solid;text-align: center;">
        <?php
          if (array_key_exists($mydate, $sanatary_income) == true) {
            echo $san_income = $sanatary_income[$mydate];
            $tot_san12 = $tot_san12 + $san_income;
          }else{
            $san_income = 0;
          }
        ?>
      </td>
      <td style="padding: 5px 4px;border: 1px solid;text-align: center;">
        <?php
          if (array_key_exists($mydate, $tiles_income) == true) {
            echo $til_income = $tiles_income[$mydate];
            $tot_tiles12 = $tot_tiles12 + $til_income;
          }else{
            $til_income = 0;
          }
        ?>
      </td>
      <td style="padding: 5px 4px;border: 1px solid;text-align: center;">
        <?php
          if (array_key_exists($mydate, $sanatary_purchase) == true) {
            echo $san_pur = $sanatary_purchase[$mydate];
            $tot_san14 = $tot_san14 + $san_pur;
          }else{
            $san_pur = 0;
          }
        ?>
      </td>
      <td style="padding: 5px 4px;border: 1px solid;text-align: center;">
        <?php
          if (array_key_exists($mydate, $tiles_purchase) == true) {
            echo $til_pur = $tiles_purchase[$mydate];
            $tot_tilse14 = $tot_tilse14 + $til_pur;
          }else{
            $til_pur = 0;
          }
        ?>
      </td>
      <td style="padding: 5px 4px;border: 1px solid;text-align: center;">
        <?php
          if (array_key_exists($mydate, $expense_sarinda) == true) {
            echo $san_expen = $expense_sarinda[$mydate];
            $tot_expense24 = $tot_expense24 + $san_expen;
          }else{
            $san_expen = 0;
          }
        ?>
      </td>
      <td style="padding: 5px 4px;border: 1px solid;text-align: center;">
        <?php
          $cashinhand = ($san_income+$til_income)-($san_pur+$til_pur)-$san_expen;
          echo round($cashinhand,2);
          $cashinhand250 = $cashinhand250 + $cashinhand;
        ?>
      </td>
    </tr>
  <?php $to_cu++;} ?>
    <tr>
      <td colspan="2" style="padding: 5px 4px;border: 1px solid;text-align: center;">Total Amount</td>
      <td style="padding: 5px 4px;border: 1px solid;text-align: center;"><?php echo $tot_san12;?></td>
      <td style="padding: 5px 4px;border: 1px solid;text-align: center;"><?php echo $tot_tiles12;?></td>
      <td style="padding: 5px 4px;border: 1px solid;text-align: center;"><?php echo $tot_san14;?></td>
      <td style="padding: 5px 4px;border: 1px solid;text-align: center;"><?php echo $tot_tilse14;?></td>
      <td style="padding: 5px 4px;border: 1px solid;text-align: center;"><?php echo $tot_expense24;?></td>
      <td style="padding: 5px 4px;border: 1px solid;text-align: center;"><?php echo $cashinhand250;?></td>
    </tr>
  </table>



<?php  } ?>
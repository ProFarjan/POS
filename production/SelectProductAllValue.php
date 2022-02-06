<?php
 error_reporting(null);
 include_once "../classes/Inden.php";
 $ind = new Inden();

 if (isset($_POST['Dateval']) AND isset($_POST['purpuse'])) {
    $customerid = $_POST['customerid'];
    $purpuse = $_POST['purpuse'];
 	$id = $_POST['Dateval'];
 	$to = date('Y-m-d',strtotime(substr($id, 0,10)));
 	$form = date('Y-m-d',strtotime(substr($id, 13,10)));
 	$report = array();
 	if($customerid != 'all'){
 	    $report = $ind->Like_VAlue_Search_Indenfi('income','date','productid','customerid',$to,$form,$purpuse,$customerid);
 	}else{
 	    $report = $ind->Like_VAlue_Search_Indenfi('income','date','productid','status',$to,$form,$purpuse,'1');
 	}
  if (count($report) > 0) {
?>
<h2 style="text-align: center;margin-top: 0;margin-bottom: 4px;">Product's Report</h2>
<p style="text-align: center;border-bottom: 2px solid;">Date : <?php echo $ind->hl->formatDate01(date('m/d/Y'));?></p>
  <table style="width: 100%;font-size: 16px;text-align: center;">
    <tr style="" class="bg-primary">
      <th style="padding: 5px 0px;border: 1px solid;text-align: center;">Date</th>
      <th style="padding: 5px 0px;border: 1px solid;text-align: center;">P.Code</th>
      <th style="padding: 5px 0px;border: 1px solid;text-align: center;">P.Name</th>
      <th style="padding: 5px 0px;border: 1px solid;text-align: center;">Customer Name</th>
      <th style="padding: 5px 0px;border: 1px solid;text-align: center;">Customer Phone</th>
      <th style="padding: 5px 0px;border: 1px solid;text-align: center;">Quantity</th>
      <th style="padding: 5px 0px;border: 1px solid;text-align: center;">Amount</th>
      <th style="padding: 5px 0px;border: 1px solid;text-align: center;">Discount</th>
    </tr>
    <?php
       $i = 0;
       $sum = $qty = 0;
       $rateval = 0;
       $disval = 0;
         while ($data = $report->fetch(PDO::FETCH_OBJ)) { $i++;
    ?>
    <tr>
      <td style="padding: 5px 4px;border: 1px solid;"><?php echo $ind->hl->formatDate01($data->date);?></td>
      <td style="padding: 5px 4px;border: 1px solid;"><?php $prod = $ind->Tbl_Col_Id_LIMITE_0('product','id',$data->productid);echo $prod->code;?></td>
      <td style="padding: 5px 4px;border: 1px solid;"><?php echo $prod->name;?></td>
      <td style="padding: 5px 4px;border: 1px solid;"><?php $cust = $ind->Tbl_Col_Id_LIMITE_0('customer','id',$data->customerid);echo $cust->name;?></td>
      <td style="padding: 5px 4px;border: 1px solid;"><?php echo $cust->phone;?></td>
      <td style="padding: 5px 4px;border: 1px solid;"><?php echo $aaq = $data->quantity;?></td>
      <td style="padding: 5px 4px;border: 1px solid;"><?php echo $rate = round($data->rate*$data->quantity);?></td>
      <td style="padding: 5px 4px;border: 1px solid;"><?php $dis = $ind->Tbl_Col_Id_LIMITE_0('payment','invoice',$data->invoice);
      $disc = trim($dis->discount, '%');
      $disc = ($disc/100);
      $disamount = round($disc*$data->rate*$data->quantity);
      if ($dis->discount == '0') {
        $dis->discount = '0%';
      }
      echo ($disamount." (".$dis->discount.")");
      ?></td>
    </tr>
    <?php
      $rateval = $rateval+$rate;
      $disval = $disval+$disamount;
      $sum = $sum + ($rate-$disamount);
      $qty += $aaq;
    ?>
  <?php } ?>
    <tr style="height: 50px;">
      <td colspan="4"></td>
      <td style="border: 1px solid;">Total</td>
      <td><?=$qty;?></td>
      <td style="border: 1px solid;"><?php echo $rateval;?></td>
      <td style="border: 1px solid;"><?php echo $disval;?></td>
    </tr>
    <tr style="height: 20px;">
      <td colspan="4"></td>
      <td colspan="2">Total Amount</td>
      <td style="text-align: right;"><?php echo $sum;?></td>
    </tr>
  </table>
<?php } } ?>
<?php
error_reporting(null);

function getCost($invoice){
  $ind = new Inden();
  $allIncome = $ind->Tbl_Col_Id("income","invoice",$invoice);
  $costamt = 0;
  while ($in_data = $allIncome->fetch(PDO::FETCH_OBJ)) {
    if ($in_data->chalaninfo != "in") {
      $chalaninfo = unserialize($in_data->chalaninfo);
      if (is_array($chalaninfo) && in_array("storeid", array_keys($chalaninfo[0]))) {
        $geted_data = $ind->Tbl_Col_Id_LIMITE_0("store","id",$chalaninfo[0]['storeid'],"purchaseid,rate");
        if ($geted_data->rate > 0) {
          $costamt += ($geted_data->rate*$in_data->quantity);
        }else{
          $purchas_cost = $ind->Tbl_Col_Id_LIMITE_0("purchase","id",$geted_data->purchaseid,"rate");
          $costamt += ($purchas_cost->rate*$in_data->quantity);
        }
      }
    }
  }
  return $costamt;
}

 include_once "../classes/Inden.php";
 $ind = new Inden();
 $farjan = $ind->SelectAll_By_ID('setting','1');
 $invoice_no = $farjan->list1;
 $purchase_no = $farjan->list2;

 if (isset($_POST['Dateval']) AND isset($_POST['Status'])) {
  $purpuse = $_POST['purpuse'];
 	$id = $_POST['Dateval'];
 	$status = $_POST['Status'];
 	$to = substr($id, 0,10);
 	$form = substr($id, 13,10);
  if ($status == '3') {
    if ($purpuse == 'all') {
      $report = $ind->Like_VAlue_Search('expense','date','status',$to,$form,$status);
    }else{
      $report = $ind->Like_VAlue_Search_Indenfi('expense','date','purpuse','status',$to,$form,$purpuse,$status);
    }
  }else{
    if ($purpuse == 'all') {
      $report = $ind->Like_VAlue_Search('payment','date','status',$to,$form,$status);
    }else{
      $report = $ind->Like_VAlue_Search_Indenfi('payment','date','customerid','status',$to,$form,$purpuse,$status);
    }
  }

 	if ($report) {
?>
<h2 style="text-align: center;margin-top: 0;margin-bottom: 4px;"><?php
if ($status == '1') {
	echo "Sales";
}elseif($status == '2'){
	echo "Purchase";
}else{
  echo "Expense";
}
?> Report</h2>
<p style="text-align: center;border-bottom: 2px solid;">Date : <?php echo $ind->hl->formatDate01(date('m/d/Y'));?></p>
  <table style="width: 100%;font-size: 16px;">
    <tr style="" class="bg-primary">
      <th style="padding: 5px 4px;border: 1px solid;">SL.No</th>
      <th style="padding: 5px 0px;border: 1px solid;">Date</th>
      <th style="padding: 5px 0px;border: 1px solid;">
      <?php
		if ($status == '1') {
			echo "Invoice";
		}elseif($status == '2'){
			echo "Purchase";
		}else{
      echo "Purpuse";
    }
		?> No
	</th>
      <th style="padding: 5px 0px;border: 1px solid;">
      	<?php
		if ($status == '1') {
			echo "Customer";
		}elseif($status == '2'){
			echo "Supplier";
		}else{
      echo "Employee/Staff";
    }
		?>
       Name</th>
      <th style="padding: 5px 0px;border: 1px solid;">Sales Amount</th>
      <th style="padding: 5px 0px;border: 1px solid;">Total Cost</th>
      <th style="padding: 5px 0px;border: 1px solid;">Profit</th>
    </tr>
    <?php
       $i = 0;
       $sum = 0;
       if ($report) {
         while ($data = $report->fetch(PDO::FETCH_OBJ)) { $i++;
    ?>
    <tr>
      <td style="padding: 5px 4px;border: 1px solid;"><?php echo $i;?></td>
      <td style="padding: 5px 4px;border: 1px solid;"><?php echo $ind->hl->formatDate01($data->date);?></td>
      <?php if ($status == '3') { ?>
      <td style="padding: 5px 4px;border: 1px solid;"><?php echo $data->purpuse;?></td>
      <td style="padding: 5px 4px;border: 1px solid;"><?php
        if ($data->employeeid == '0') {
          echo "";
        }else{
          $cust = $ind->SelectAll_By_ID('customer',$data->employeeid);echo $cust->name;
        }
      ?></td>
      <td style="padding: 5px 4px;border: 1px solid;"><?php echo $sumval = $data->amount;?></td>
      <?php } else { ?>
      <td style="padding: 5px 4px;border: 1px solid;">
        <?php
          if ($status == '1') {
        ?>
        <a href="<?php echo $invoice_no;?>.php?invoice=<?php echo $data->invoice;?>"><?php echo $data->invoice;?></a>
        <?php } else { ?>
          <a href="<?php echo $purchase_no;?>.php?invoice=<?php echo $data->invoice;?>"><?php echo $data->invoice;?></a>
        <?php } ?>
      </td>

      <td style="padding: 5px 4px;border: 1px solid;"><?php
      if ($data->customerid == '0') {
         echo "";
       } else{
        $cust = $ind->SelectAll_By_ID('customer',$data->customerid);echo $cust->name;
       }
      ?></td>
      <td style="padding: 5px 4px;border: 1px solid;"><?php echo $sumval = (($data->payment+$data->currentdue)-$data->predue);?></td>
      <td style="padding: 5px 4px;border: 1px solid;">
        <?php
          echo $mycost = getCost($data->invoice);
        ?>
      </td>
      <td style="padding: 5px 4px;border: 1px solid;">
        <?php
          echo $myprofit = ($sumval-$mycost);
        ?>
      </td>
      <?php } ?>
    </tr>
    <?php
      $sum = $sum + $myprofit;
    ?>
  <?php } } ?>
    <tr style="height: 50px;">
      <td></td>
      <td colspan="3" style="text-align: center;">Total</td>
      <td><?php echo $sum;?></td>
    </tr>
  </table>
<?php } }?>
<?php
error_reporting(null);
include_once "../classes/Store.php";
$po = new Store();

if (isset($_POST['product']) AND !empty($_POST['product'])) {
	$data = $_POST['product'];
	$like_value = "";
	foreach ($data as $key => $value) {
		$like_value .= "'".$value."',";
	}
	$like_value .= "'farjan'";
	$product = $po->select_product($like_value);
?>
<h2 style="text-align: center;margin-top: 0;margin-bottom: 4px;">Store Report On: <?php echo implode(', ',$data);?></h2>
<p style="text-align: center;border-bottom: 2px solid;">Date : <?php echo $po->hl->formatDate01(date('m/d/Y'));?></p>
<table style="width: 100%;font-size: 16px;text-align: center;">
    <tr style="" class="bg-primary">
      <th style="padding: 5px 0px;text-align: center;border: 1px solid;">P.Code</th>
      <th style="padding: 5px 0px;text-align: center;border: 1px solid;">P.Name</th>
      <th style="padding: 5px 0px;text-align: center;border: 1px solid;">Catagory</th>
      <th style="padding: 5px 0px;text-align: center;border: 1px solid;">Sub Catagory</th>
      <th style="padding: 5px 0px;text-align: center;border: 1px solid;">Store In QTY</th>
      <th style="padding: 5px 0px;text-align: center;border: 1px solid;">Destroy QTY</th>
      <th style="padding: 5px 0px;text-align: center;border: 1px solid;">SalLing QTY</th>
      <th style="padding: 5px 0px;text-align: center;border: 1px solid;">Current QTY</th>
    </tr>
    <?php
            $i = 0;
            $pieceval = $po->Total_Piece(30);
            if ($product) {
              while ($data = $product->fetch(PDO::FETCH_OBJ)) { $i++;
                $destroy = $po->TBL_VAL_52('destroy','productid',$data->id,'destroy');
          ?>
            <tr>
              <td style="padding: 5px 0px;border: 1px solid;"><?php echo $data->code;?></td>
              <td style="padding: 5px 0px;border: 1px solid;"><?php echo $data->name;?></td>
              <td style="padding: 5px 0px;border: 1px solid;"><?php echo $data->type;?></td>
              <td style="padding: 5px 0px;border: 1px solid;"><?php echo $data->subtype;?></td>
              <td style="padding: 5px 0px;border: 1px solid;">
              <?php 
                $alldata = $po->All_Store_Status($data->id);
                if ($alldata->unit == '0') {
                  $unit = "sq/ft";
                }else{
                  $unit = $alldata->unit;
                }
                if ($data->type == 'Tiles') {
                   $car = $po->Tbl_Col_Id_LIMITE_0('store','productid',$data->id);
                    if ($car) {
                      $perca = $car->percarton;
                    }else{
                      $perca = "1";
                    }
                    $inch = $data->name;
                    $val = explode('*', $inch);
                    $insq = $val[0]*$val[1];
                    $ftsq = $insq*0.00694444;
                    $piecea = ($alldata->TOTALCARTON)/($ftsq);
                  echo $st_to =  $alldata->TOTALCARTON."sq/ft | ";
                  echo $st_cr = round(($alldata->TOTALCARTON/$perca),2)."C | ";
                  echo $st_pi = round($piecea,2)."P";
                }else{
                  echo $alldata->QUANTITY." ".ucfirst($unit);
                }
              ?> 
              </td>
              <td style="padding: 5px 0px;border: 1px solid;">
              <?php 
                if ($alldata->unit == '0') {
                  $unit = "sq/ft";
                }else{
                  $unit = $alldata->unit;
                }
                if ($data->type == 'Tiles') {
                   $car = $po->Tbl_Col_Id_LIMITE_0('store','productid',$data->id);
                    if ($car) {
                      $perca = $car->percarton;
                    }else{
                      $perca = "1";
                    }
                    $inch = $data->name;
                    $val = explode('*', $inch);
                    $insq = $val[0]*$val[1];
                    $ftsq = $insq*0.00694444;
                    $piecea = ($destroy)/($ftsq);
                  echo $de_to =  $destroy."sq/ft | ";
                  echo $de_cr = round(($destroy/$perca),2)."C | ";
                  echo $de_pi = round($piecea,2)."P";
                } else {
                  echo $destroy." ".ucfirst($unit);
                }
              ?> 
              </td>
              <td style="padding: 5px 0px;border: 1px solid;">
                <?php 
                  $incomeval = $po->Saleing_Product($data->id);
                  $incomedata = $incomeval->fetch(PDO::FETCH_OBJ);
                  if ($incomedata->QUANTITY == "" || empty($incomedata->QUANTITY)) {
                    echo "0";
                  }else{
                    if($incomedata->unit == 'sq/ft'){
                      echo $se_to = $incomedata->QUANTITY."sq/ft | ";
                      echo $se_cr = round($incomedata->QUANTITY/$perca,2)."C | ";
                      echo $se_pi = round($incomedata->QUANTITY/$ftsq,2)."P";
                    }else{
                      echo $incomedata->QUANTITY." ".$incomedata->unit;
                    }
                  }
                   
                ?> 
              </td>
              <td style="padding: 5px 0px;border: 1px solid;">
                <?php
                  if ($data->type == 'Tiles') {

                   if($incomedata->unit == 'sq/ft'){
                    echo $st_to-$se_to."sq/ft | ";
                    echo $st_cr-$se_cr."C | ";
                    echo $st_pi-$se_pi."P | ";
                   }else{
                    echo ($alldata->QUANTITY)-($incomedata->QUANTITY)-($destroy)." ".ucfirst($unit);
                   }
                  }else{
                    echo ($alldata->QUANTITY)-($incomedata->QUANTITY)-($destroy)." ".ucfirst($unit);
                  }
                ?>
              </td>
            </tr>
          <?php }} ?>
  </table>




<?php } ?>
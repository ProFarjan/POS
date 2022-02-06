<?php
error_reporting(null);
 include_once "../classes/Inden.php";
 $ind = new Inden();

 if (isset($_POST['dateval'])) {
    $purpuse = $_POST['purpuse'];
 	$id = $_POST['dateval'];
 	$to = substr($id, 0,10);
 	$form = substr($id, 13,10);
?>

<?php
	if ($purpuse == 'all') {
      $report = $ind->Like_VAlue_Search('transfer','date','status',$to,$form,'1');
    }else{
      $report = $ind->Like_VAlue_Search_Indenfi('transfer','date','mobile','status',$to,$form,$purpuse,'1');
    }

   $i = 0;
   $sum = 0;
   $niasme = array();
   if ($report) {
     while ($data = $report->fetch(PDO::FETCH_OBJ)) { $i++;
      /*if (!in_array($data->date, $niasme)) {
      array_push($niasme,$data->date);*/
?>
<tr>
  <td style="padding: 5px 4px;border: 1px solid;"><?php echo $i;?></td>
  <td style="padding: 5px 4px;border: 1px solid;"><?php echo $ind->hl->formatDate01($data->date);?></td>
  <td style="padding: 5px 4px;border: 1px solid;"><?php echo $data->person;?></td>
  <td style="padding: 5px 4px;border: 1px solid;"><?php echo $data->mobile;?></td>
  <td style="padding: 5px 4px;border: 1px solid;">
    <?php echo $taken = $ind->lIke_One_Col("transfer","mobile","date",$data->mobile,"amount",$data->date);?>
    </td>
  <td style="padding: 5px 4px;border: 1px solid;">
    <?php echo $returnme = $ind->lIke_One_Col("cashin","mobile","date",$data->mobile,"amount",$data->date);?>
  </td>
</tr>
<?php }}//} ?>




<?php } ?> 
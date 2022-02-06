<?php
error_reporting(null);
 include_once "../classes/Inden.php";
 $ind = new Inden();

 if (isset($_POST['Dateval'])) {
  $purpuse = $_POST['purpuse'];
 	$id = $_POST['Dateval'];
 	$to = substr($id, 0,10);
 	$form = substr($id, 13,10);

?>
<h2 style="text-align: center;margin-top: 0;margin-bottom: 4px;">Attendance Report</h2>
<p style="text-align: center;border-bottom: 2px solid;">Date : <?php echo date('m/d/Y');?></p>
  <table style="width: 100%;font-size: 16px;">
    <tr style="background: #ddd;border: 1px solid;">
      <th style="padding: 5px 4px;">#</th>
      <th style="padding: 5px 0px;">Date</th>
      <th style="padding: 5px 0px;">Employee</th>
      <th style="padding: 5px 0px;">Phone</th>
      <th style="padding: 5px 0px;">Start Time</th>
      <th style="padding: 5px 0px;">Finished Time</th>
      <th style="padding: 5px 0px;">Status</th>
    </tr>
    <?php
      if ($purpuse == 'all') {
        $report = $ind->Like_VAlue_Search('attendance','date','status',$to,$form,'1');
      }else{
        $report = $ind->Like_VAlue_Search_Indenfi('attendance','date','employeeid','status',$to,$form,$purpuse,'1');
      }
       $i = 0;
       $sum = 0;
       if ($report) {
         while ($data = $report->fetch(PDO::FETCH_OBJ)) { $i++;
          $emval = $ind->Tbl_Col_Id_LIMITE_0('customer','id',$data->employeeid);
    ?>
    <tr>
      <td style="padding: 5px 4px;border-bottom: 1px solid;"><?php echo $i;?></td>
      <td style="padding: 5px 4px;border-bottom: 1px solid;"><?php echo $ind->hl->formatDate01($data->date);?></td>
      <td style="padding: 5px 4px;border-bottom: 1px solid;"><?php echo $emval->name;?></td>
      <td style="padding: 5px 4px;border-bottom: 1px solid;"><?php echo $emval->phone;?></td>
      <td style="padding: 5px 4px;border-bottom: 1px solid;"><?php echo $data->start;?></td>
      <td style="padding: 5px 4px;border-bottom: 1px solid;"><?php if($data->finish != '1'){echo $data->finish;}?></td>
      <td style="padding: 5px 4px;border-bottom: 1px solid;"><?php if($data->appsent == '1'){echo "Appsent";}elseif(empty($data->appsent) OR $data->appsent == ''){echo "GD";}else{echo $data->appsent;}?></td>
    </tr>
  <?php }} ?>
  </table>
<?php } ?>
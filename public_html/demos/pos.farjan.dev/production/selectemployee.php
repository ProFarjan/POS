<?php
error_reporting(null);
 include_once "../classes/Employee.php";
 $em = new Employee();

 if (isset($_POST['Emplyeeval'])) {
  $id = $_POST['Emplyeeval'];
 	$purpuseinfo = $_POST['purpuse'];

 	$emdetails = $em->Tbl_Col_Id_Like('customer','id','customerid',$id);
 	if ($emdetails) {
 		$data = $emdetails->fetch(PDO::FETCH_OBJ);
    if ($data) {
?>
<?php if ($data->image == '1') { ?>
<img src="images/user.png" style="width: 50%;border-radius: 50%;margin-bottom: 10px;">
<?php }else{ ?>
<img src="<?php echo $data->image;?>" style="width: 50%;border-radius: 50%;margin-bottom: 10px;">
<?php } ?>

  <table class="table table-striped table-bordered">
    <tr>
      <td>ID</td>
      <td><?php echo $data->customerid;?></td>
    </tr>
    <tr>
      <td>Name</td>
      <td>
        <?php
          if ($data->typeval == '2') {
            echo $data->name;
          }elseif ($data->typeval == '3') {
            echo $data->name." (<strong id='spcail'>Sales To Supplier</strong>)";
          }else{
            echo $data->name;
          }
          
        ?>
        </td>
    </tr>
    <tr>
      <td>Phone</td>
      <td><?php echo $data->phone;?></td>
    </tr>
    <?php if($data->telephone != '1' && !empty($data->telephone)){ ?>
    <tr>
      <td>Telephone</td>
      <td><?php echo $data->telephone;?></td>
    </tr>
    <?php } ?>
    <?php if($data->email != '1' && !empty($data->email)){ ?>
    <tr>
      <td>Email</td>
      <td><?php echo $data->email;?></td>
    </tr>
    <?php } ?>
    <?php if($data->company != '1' && !empty($data->company)){ ?>
    <tr>
      <td>Company</td>
      <td><?php echo $data->company;?></td>
    </tr>
    <?php } ?>
    <?php if(!empty($data->address)){ ?>
    <tr>
      <td>Address</td>
      <td><?php echo $data->address;?></td>
    </tr>
    <?php } ?>
    <?php if(!empty($data->city)){ ?>
    <tr>
      <td>City</td>
      <td><?php echo $data->city;?></td>
    </tr>
    <?php } ?>
    <?php if($data->website != '1' && !empty($data->website)){ ?>
    <tr>
      <td>Website</td>
      <td><?php echo $data->website;?></td>
    </tr>
    <?php } ?>
  </table>

  <?php
    if ($purpuseinfo[0] == "salary") {
      $lastday = date('t',strtotime('today'));
      $to = date('m')."/"."01"."/".date('Y');
      $from = date('m')."/".$lastday."/".date('Y');
      $data_info = $em->employeeSalary($data->id,$to,$from);
  ?>
  <table class="table table-bordered">
    <caption style="text-align: center;">This Month Salary Info</caption>
    <tr>
      <th>Date</th>
      <th>Amount</th>
    </tr>
    <?php
      while ($mydateSalary = $data_info->fetch(PDO::FETCH_OBJ)) {
    ?>
    <tr>
      <td><?php echo date('F j, Y',strtotime($mydateSalary->date));?></td>
      <td><?php echo $mydateSalary->amount;?></td>
    </tr>
  <?php } ?>
  </table>
<?php } ?>




<?php  }else{echo "Data Not Found!!";} }else{echo "Data Not Found!!";} } ?>
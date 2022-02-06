<?php
 include_once "../classes/Employee.php";
 $em = new Employee();

 if (isset($_POST['val'])) {
 	$id = $_POST['val'];
 	$emdetails = $em->Tbl_Col_Id_Like('customer','name','phone',$id);
 	if ($emdetails) {
 		while ($data = $emdetails->fetch(PDO::FETCH_OBJ)) {
?>
<div class="col-md-4 col-sm-4 col-xs-12 profile_details">
<div class="well profile_view">
  <div class="col-sm-12">
    <h4 class="brief"><i><?php echo $data->company;?></i></h4>
    <div class="left col-xs-7">
      <h2><?php echo $data->name;?></h2>
      <ul class="list-unstyled">
        <li><i class="fa fa-tachometer"></i> ID: <?php echo $data->customerid;?></li>
        <li><i class="fa fa-building"></i> City: <?php echo $data->city;?></li>
        <li><i class="fa fa-phone"></i> Phone : <?php echo $data->phone;?></li>
      </ul>
    </div>
    <div class="right col-xs-5 text-center">
    <?php if ($data->image == '1') { ?>
    	<img src="images/user.png" alt="" class="img-circle img-responsive">
    <?php } else { ?>
      <img src="<?php echo $data->image;?>" alt="" class="img-circle img-responsive" style="width: 94px;" >
    <?php } ?>
    </div>
  </div>
  <div class="col-xs-12 bottom text-center">
    <div class="col-xs-12 col-sm-6 emphasis">
      <p class="ratings">
        <a>4.0</a>
        <a href="#"><span class="fa fa-star"></span></a>
        <a href="#"><span class="fa fa-star"></span></a>
        <a href="#"><span class="fa fa-star"></span></a>
        <a href="#"><span class="fa fa-star"></span></a>
        <a href="#"><span class="fa fa-star-o"></span></a>
      </p>
    </div>
    <div class="col-xs-12 col-sm-6 emphasis">
      <a href="profile.php?userid=<?php echo $data->id;?>"><button type="button" class="btn btn-primary btn-xs">
        <i class="fa fa-user"> </i> View Profile
      </button></a>
    </div>
  </div>
</div>
</div>
<?php }}} ?>
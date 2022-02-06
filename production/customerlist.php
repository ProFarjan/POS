<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
 $cu = new Customers();
  if (isset($_GET['customer'])) {
   $typeval = "1";
 }elseif (isset($_GET['dir_em'])) {
   $typeval = "2";
 }elseif (isset($_GET['suplier'])) {
   $typeval = "3";
 }else{
  $typeval = "1";
 }
 if (isset($_GET['custid'])) {
    $cu->tbl_update($_GET['custid']);
    header('Location: '.$_SERVER['PHP_SELF'].'?customer=customer'); 
 }
?>
<style type="text/css">
.profile_details .profile_view {
  background: #87ceeb;
  color: #434242;
}
</style>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><?php if($typeval == '1'){echo "Customer's List";}elseif($typeval == '3'){echo "Supplier's List";}else{echo "Employee's List";}?></h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for..." id="searchuser">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_content">
            <div class="row">
              <div class="clearfix"></div>
              <div id="p_details"></div>
            <?php
            	$custData = $cu->Tbl_Col_Id('customer','typeval',$typeval);
            	if ($custData) {
            		while ($data = $custData->fetch(PDO::FETCH_OBJ)) {
                  if ($data->status != "1") {
            ?>
              <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                <div class="well profile_view">
                  <div class="col-sm-12">
                    <h4 class="brief"><i><?php if($data->company != "1"){echo $data->company;}?></i></h4>
                    <div class="left col-xs-7">
                      <h2><?php echo $data->name;?></h2>
                      <ul class="list-unstyled">
                        <li><i class="fa fa-tachometer"></i> ID: <?php echo $data->customerid;?></li>
                        <?php if(!empty($data->city)){ ?>
                        <li><i class="fa fa-building"></i> City: <?php echo $data->city;?></li>
                      <?php } ?>
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
                      <?php
                        if ($typeval == '2') {
                          echo $data->destination;
                        }else{
                      ?>
                        <a>
                          <?php
                            echo $usinfo = $cu->customer_payment_Count($data->id);
                            if($usinfo == 0){
                              $_1 = $_2 = $_3 = $_4 = $_5 = '-o';
                            }elseif($usinfo <= 20) {
                              $_1 = '';$_2 = $_3 = $_4 = $_5 = '-o';
                            }elseif ($usinfo <= 40) {
                              $_1 = $_2 = '';$_3 = $_4 = $_5 = '-o';
                            }elseif ($usinfo <= 60) {
                              $_1 = $_2 = $_3 = '';$_4 = $_5 = '-o';
                            }elseif ($usinfo <= 80) {
                              $_1 = $_2 = $_3 = $_4 = '';$_5 = '-o';
                            }elseif ($usinfo > 100) {
                              $_1 = $_2 = $_3 = $_4 = $_5 = '';
                            }
                          ?>
                        </a>
                        <a href="#"><span class="fa fa-star<?php if(isset($_1)){echo $_1;}?>"></span></a>
                        <a href="#"><span class="fa fa-star<?php if(isset($_2)){echo $_2;}?>"></span></a>
                        <a href="#"><span class="fa fa-star<?php if(isset($_3)){echo $_3;}?>"></span></a>
                        <a href="#"><span class="fa fa-star<?php if(isset($_4)){echo $_4;}?>"></span></a>
                        <a href="#"><span class="fa fa-star<?php if(isset($_5)){echo $_5;}?>"></span></a>
                        <?php } ?>
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<?php include "inc/footer.php";?>

<script type="text/javascript">
$(function(){
  $("#searchuser").keyup(function(){
    var val = $(this).val();
    var val = val.trim();
    if (val != '') {
      $.ajax({
        url: "selectalluser.php",
        method: "POST",
        data: {val:val},
        success: function(data){
          $("#p_details").empty();
          $("#p_details").append(data);
        }
      });
    }
  });
});
</script>

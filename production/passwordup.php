<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
 $cu = new Login();

 if (isset($_GET['update']) AND !empty($_GET['update'])) {
   $update = $_GET['update'];
   $u_1 = $cu->SelectAll_By_ID('user',$update);
   if ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['addcustomer'])) {
   $addcustomer = $cu->Update_Password($update,$_POST);
  }
 }
?>
<style type="text/css">
#myid {
    font-size: 30px;
    font-weight: bolder;
    color: green;
}
</style>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Password Update Form</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <a href="userprofile.php" class="btn btn-info">View Profile</a>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Password Info
            </h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
         <span id="message123"><?php
            if (isset($addcustomer)) {
              echo $addcustomer;
            }elseif (isset($update_customer)) {
              echo $update_customer;
            }
         ?></span>
              

<form class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Old Password <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input id="oldpass" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="oldpass" required="required" type="text" >
    </div>
    <div class="col-md-2 col-sm-2 col-xs-6" id="oldpassdiv">
      
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">New Password <span class="required"></span>
    </label>
    <div class="col-md-5 col-sm-5 col-xs-6">
      <input type="password" id="newpass" name="newpass"  class="form-control col-md-7 col-xs-12" >
    </div>
    <div class="col-md-1 col-sm-1 col-xs-6">
      <button id="showpass" class="btn btn-info" type="button">Show</button>
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Retype New Password <span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12" id="retype">
      <input type="password" id="renewpass" name="renewpass" class="form-control col-md-7 col-xs-12" >
    </div>
    <div class="col-md-2 col-sm-2 col-xs-6" id="infodiv">
      <i class="fa fa-check" aria-hidden="true" id="myid"></i>
    </div>
    <div class="col-md-2 col-sm-2 col-xs-6" id="infodiv1">
      <i class="fa fa-times" aria-hidden="true" id="myid" style="color: red;"></i>
    </div>
  </div>
  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-md-offset-3">
      <button type="submit" class="btn btn-primary">Cancel</button>
      <button id="send" type="submit" class="btn btn-success" name="addcustomer">Update</button>
    </div>
  </div>
</form>




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
  $("#infodiv").hide();
  $("#infodiv1").hide();
  $("#oldpassdiv").hide();

  $("#renewpass").keyup(function(){
    var renewpass = $(this).val();
    var newpass = $("#newpass").val();
    if (renewpass == '') {
      $("#retype").removeClass('col-md-4 col-sm-4 col-xs-6');
      $("#retype").addClass('col-md-6 col-sm-6 col-xs-12');
      $("#infodiv1").fadeOut();
      $("#infodiv").fadeOut();
    }else{
      if (renewpass != newpass) {
        $("#retype").removeClass('col-md-6 col-sm-6 col-xs-12');
        $("#retype").addClass('col-md-4 col-sm-4 col-xs-6');
        $("#infodiv").fadeOut();
        $("#infodiv1").fadeIn(1000);
      }else{
        $("#infodiv1").fadeOut();
        $("#infodiv").fadeIn(1000);
      }
    }
  });
  $("#oldpass").blur(function(){
    var oldpass = $(this).val();

    if (oldpass == '') {
      $("#oldpassdiv").slideUp(1000);
    }else{
      $.ajax({
        url: "chackoldpassword.php",
        method: "POST",
        data: {oldpass:oldpass},
        success: function(data){
          $("#oldpassdiv").empty();
          $("#oldpassdiv").append(data);
          $("#oldpassdiv").slideDown(1000);
        },
        error: function(){
          alert("Error!!");
        }
      });
    }
  });
  $("#showpass").click(function(){
    var pass = $('#newpass');
    var type = pass.attr('type');
    if (type == 'password') {
      pass.attr('type','text');
      $(this).text('Hide');
    }else{
      pass.attr('type','password');
      $(this).text('Show');
    }
  });
});
</script>
<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
<?php
 $cu = new Customers();

 if ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['addcustomer'])) {
   $addcustomer = $cu->addcustomer($_POST);
 }

?>
<?php $access_url =  Session::get('access'); ?>
<style type="text/css">
#table250{}
#table250 tr{}
#table250 tr th{padding-bottom: 5px;font-size: 18px;}
#table250 tr td{padding-bottom: 5px;font-size: 18px;}
#image {
    width: 267px;
    height: 325px;
    border-top-left-radius: 137px;
    border-bottom-right-radius: 137px;
    box-shadow: 1px 5px 6px 5px #ddd;
}
</style>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>User Profile</h3>
      </div>
<?php if($access_url == "admin"){ ?>
      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <a href="newuser.php" class="btn btn-info">Create User</a>
          </div>
        </div>
      </div>
    </div>
<?php } ?>
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>User Info</h2>
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
            <div style="width: 50%;margin: 0 auto;">
              <div style="width: 45%;margin: 0 auto 25px;">
                <img src="<?php echo Session::get('UserImg'); ?>" id="image">
              </div>
              <table style="width: 90%;margin: 0 auto;" id="table250">
                <tr>
                  <th>Full Name</th>
                  <td><?php echo Session::get('UserName'); ?></td>
                </tr>
                <tr>
                  <th>Email Address</th>
                  <td><?php echo Session::get('Email'); ?></td>
                </tr>
                <tr>
                  <th>Phone Number</th>
                  <td><?php echo Session::get('Mobile'); ?></td>
                </tr>
                <tr>
                  <th>Address</th>
                  <td><?php echo Session::get('Address'); ?></td>
                </tr>
                <tr>
                  <th>User Name</th>
                  <td><?php echo Session::get('User'); ?></td>
                </tr>
                <tr>
                  <th></th>
                  <td>
                    <a href="newuser.php?update=<?php echo Session::get('UserId'); ?>" class="btn btn-primary">Profile Update</a>
                    <a href="passwordup.php?update=<?php echo Session::get('UserId');?>" class="btn btn-primary">Password Update</a>
                  </td>
                </tr>
              </table>
              </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
<?php include "inc/footer.php";?>
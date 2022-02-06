<?php
  //error_reporting(null);
  include '../lib/Session.php';
  Session::checkSession();
  spl_autoload_register(function($name){
  include_once "../classes/".$name.".php";
  });
  date_default_timezone_set('Asia/Dhaka');
  $date_c = date('m/d/Y');
  $nias = new Inden();
  echo $nias->Chack_User_Site();
  $farjan = $nias->SelectAll_By_ID('setting','1');
  $invoice = $farjan->list1;
  $purchase = $farjan->list2;
  if(isset($_GET['action']) AND !empty($_GET['action'])){
    Session::destroy();
    header("Location: $farjan->login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $farjan->companyname;?></title>
    <link rel="icon" href="<?php echo $farjan->companylogo;?>" type="image/x-icon"/>
    <link rel="stylesheet" href="css/cal.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="../build/css/font-awesome.min.css" rel="stylesheet">
    <link href="../build/css/nprogress.css" rel="stylesheet">
    <link href="../build/css/green.css" rel="stylesheet">
    <link href="../build/css/pnotify.css" rel="stylesheet">
    <link href="../build/css/pnotify.buttons.css" rel="stylesheet">
    <link href="../build/css/nonblock.css" rel="stylesheet">
    <link href="../build/css/jquery.mCustomScrollbar.min.css" rel="stylesheet">
    <link href="../build/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <link href="../build/css/jqvmap.min.css" rel="stylesheet">
    <link href="../build/css/switchery.min.css" rel="stylesheet">
    <link href="../build/css/daterangepicker.css" rel="stylesheet">
    <link href="../build/css/fakeLoader.css" rel="stylesheet">
    <link href="../build/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/flipclock.css">
    <link href="../build/css/chosen.min.css" rel="stylesheet">
    <style type="text/css">
      body .container.body .right_col {
        background: <?php echo $farjan->bgcolor;?>;
        color: <?php echo $farjan->contenttextcolor;?>;
      }
      .nav_menu {
        background: <?php echo $farjan->headercolor;?>;
      }
      .left_col {
        background: <?php echo $farjan->sidebarcolor;?>;
      }
      .nav.side-menu>li.active>a {
        text-shadow: rgba(0,0,0,.25) 0 -1px 0;
        background: <?php echo $farjan->sidebarcolor;?>;
        box-shadow: rgba(0,0,0,.25) 0 1px 0, inset rgba(255,255,255,.16) 0 1px 0;
      }
      .x_panel {
        background: <?php echo $farjan->containcolor;?>;
      }
      #footer {
        background: <?php echo $farjan->footercolor;?>;
        width: 83%;
        position: relative;
      }
    </style>
    <script src="../build/js/jquery.min.js"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4815321847306589"
     crossorigin="anonymous"></script>
  </head>

  <body class="nav-md">
  <div class="fakeloader"></div>

    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title">
              <?php if($farjan->companylogo == 1){?>
              <i class="fa fa-paw"></i> 
              <?php }else { ?>
                <img src="<?php echo $farjan->companylogo;?>" style="width: 36px;height: 33px;">
              <?php } ?>
              <span><?php echo $farjan->companyname;?></span></a>
            </div>
            <div class="clearfix"></div>
            <div class="profile clearfix">
              <div class="profile_pic">
                <?php $image = Session::get('UserImg');
                if (!empty($image) || $image != '') { ?>
                <img src="<?php echo $image;?>" alt="..." class="img-circle profile_img">
                <?php } else { ?>
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
                <?php } ?>
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo Session::get('User'); ?></h2>
              </div>
            </div>
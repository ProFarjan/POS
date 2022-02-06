<?php
  $arr = array('png','jpg');
  shuffle($arr);
  shuffle($arr);
  shuffle($arr);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Page Not Found!! </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <style type="text/css">
      .col-middle {
          margin-top: 1%;
      }
      .error-number {
          margin: 20px 0 0px;
          color: red;
          font-weight: bold;
      }
      body{
        background-image: url('images/404.<?php echo $arr[0]; ?>');
        background-attachment: fixed;
        background-position: inherit;
        background-repeat: <?php if ($arr[0] == "png"){echo "round";}else{echo "inherit";} ?>;
        background-size: cover;
      }
    </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- page content -->
        <div class="col-md-12">
          <div class="col-middle">
            <div class="text-center text-center">
              <button class="btn btn-info" id="goback" style="float: right;width: 8%;">Back</button>
              <?php if ($arr[0] == "jpg"){ ?>
              <h1 style="background: rgba(216, 45, 45, 0.48);color:  white;font-weight:  bold;padding:  10px;border-radius:  5px;float: left;"><b style="    font-size: 70px;">404</b><br> Page Not Found !!</h1>
              <?php } ?>
            </div>
          </div>
        </div>
        <!-- /page content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    <script type="text/javascript">
      $(function(){
        $("#goback").click(function(){
          window.history.back();
        });
      });
    </script>
  </body>
</html>

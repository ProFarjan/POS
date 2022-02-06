<?php
error_reporting(null);
 include "../lib/Session.php";
 Session::checkLogin();
?>
<?php include "../classes/Login.php";?>
<?php
	$lg = new Login();

	if ($_SERVER['REQUEST_METHOD'] == 'POST' AND $_POST['login']) {
		$checklog = $lg->checklog($_POST);
	}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
  <link rel="stylesheet" href="css/style.css">
  <style type="text/css">
    #password{width: 255px;}
    #show {
      float: right;
      position: relative;
      top: -30px;
      background: #107316;
      border: 0;
      color: #fff;
      padding: 4px 11px;
      border-radius: 12px;
    }
  </style>
</head>

<body>
  <div class="login">
  <h2>Log In</h2>
  <?php if (isset($checklog)) { ?>
	<h3 style="color:red;"><?php echo $checklog;?></h3>
	<?php } ?>
<form action="" method="post">
  <fieldset>
    <input type="text" placeholder="Username" required="" name="username" />
  	<input type="password" id="password" placeholder="Password" required="" name="password" /><button id="show" type="button">S</button>
  </fieldset>
  <input type="submit" value="Log In" name="login" />
</form><!-- form -->
  <div class="utilities">
  <?php if (isset($checklog)) { ?>
    <a href="#">Forgot Password?</a>
	<?php } ?>
    <a href="#">Sign Up &rarr;</a>
  </div>
</div>
<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
  $("#show").on('click',function(){
    var pass = $('#password');
    var fieldtype = pass.attr('type');
    if (fieldtype == 'password') {
      pass.attr('type', 'text');
      $(this).text("H");
    }else{
      pass.attr('type', 'password');
      $(this).text("S");
    }
  });
</script> 
  
</body>
</html>

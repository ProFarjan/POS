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
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/login.css" media="screen" />
	<!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
	.error{color:red;}
	.succes{color:green;}
	#content form input[type="password"]{width: 60%;}
</style>
</head>

<body>
<div class="container">
	<section id="content">
	<?php if (isset($checklog)) { ?>
	<h3 style="color:red;"><?php echo $checklog;?></h3>
	<?php } ?>
		<form action="" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username Or Email" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password" id="password"/>
				<button type='button' id="show" class="btn btn-info">Show</button>
			</div>
			<div>
				<input type="submit" value="Log in" name="login" />
			</div>
		</form><!-- form -->
		<?php if (isset($checklog)) { ?>
			<div class="button">
				<a href="forgot.php">Forgot Password</a>
			</div><!-- button -->
		<?php } ?>
		<div class="button">
			<a href="http://www.itpal.com.bd">IT PAL LIMITED</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
	$("#show").on('click',function(){
		var pass = $('#password');
		var fieldtype = pass.attr('type');
		if (fieldtype == 'password') {
			pass.attr('type', 'text');
			$(this).text("Hide");
			$("#password").css("width", "60%");
		}else{
			pass.attr('type', 'password');
			$(this).text("Show");
		}
	});
</script>
</body>
</html>
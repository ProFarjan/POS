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
  <style>
  @charset "utf-8";
	@import url(http://weloveiconfonts.com/api/?family=fontawesome);

	[class*="fontawesome-"]:before {
	  font-family: 'FontAwesome', sans-serif;
	}

	body {
	  background: #2c3338;
	  color: #606468;
	  font: 87.5%/1.5em 'Open Sans', sans-serif;
	  margin: 0;
	}

	input {
	  border: none;
	  font-family: 'Open Sans', Arial, sans-serif;
	  font-size: 16px;
	  line-height: 1.5em;
	  padding: 0;
	  -webkit-appearance: none;
	}

	p {
	  line-height: 1.5em;
	}

	after { clear: both; }

	#login {
	  margin: 50px auto;
	  width: 320px;
	}

	#login form {
	  margin: auto;
	  padding: 22px 22px 22px 22px;
	  width: 100%;
	  border-radius: 5px;
	  background: #282e33;
	  border-top: 3px solid #434a52;
	  border-bottom: 3px solid #434a52;
	}

	#login form span {
	  background-color: #363b41;
	  border-radius: 3px 0px 0px 3px;
	  border-right: 3px solid #434a52;
	  color: #606468;
	  display: block;
	  float: left;
	  line-height: 50px;
	  text-align: center;
	  width: 50px;
	  height: 50px;
	}

	#login form input[type="text"] {
	  background-color: #3b4148;
	  border-radius: 0px 3px 3px 0px;
	  color: #a9a9a9;
	  margin-bottom: 1em;
	  padding: 0 16px;
	  width: 235px;
	  height: 50px;
	}

	#login form input[type="password"] {
	  background-color: #3b4148;
	  border-radius: 0px 3px 3px 0px;
	  color: #a9a9a9;
	  margin-bottom: 1em;
	  padding: 0 16px;
	  width: 235px;
	  height: 50px;
	}

	#login form input[type="submit"] {
	  background: #b5cd60;
	  border: 0;
	  width: 100%;
	  height: 40px;
	  border-radius: 3px;
	  color: white;
	  cursor: pointer;
	  transition: background 0.3s ease-in-out;
	}
	#login form input[type="submit"]:hover {
	  background: #16aa56;
	}
  </style>
</head>

<body>
    <div id="login">
    <?php if (isset($checklog)) { ?>
  <h3 style="color:red;"><?php echo $checklog;?></h3>
  <?php } ?>
      <form action="" method="post">
        <span class="fontawesome-user"></span>
          <input type="text" id="user"  placeholder="Username" required="" name="username">
       
        <span class="fontawesome-lock"></span>
          <input type="password" id="pass" placeholder="Password" required="" name="password">
        
        <input type="submit" value="Login" name="login">

</form>

<table style="padding: 20px 0;color: #fff;width: 100%;border: 0;" border="1" cellpadding="4">
      <thead>
          <tr>
              <th>User</th>
              <th>Passworld</th>
          </tr>
      </thead>
      <tbody>
          <tr>
              <td>admin</td>
              <td>123456</td>
          </tr>
          <tr>
              <td>user</td>
              <td>123456</td>
          </tr>
      </tbody>
  </table>

</body>
</html>

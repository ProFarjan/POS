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
  <link rel="stylesheet" href="css/style1.css">
</head>

<body>
  <div class="main-wrap">
  <?php if (isset($checklog)) { ?>
  <h3 style="color:red;"><?php echo $checklog;?></h3>
  <?php } ?>
  <form action="" method="post">
    <div class="login-main">
        <input type="text" placeholder="Username" required="" name="username" class="box1 border1">
        <input type="password" placeholder="Password" required="" name="password" class="box1 border2">
        <input type="submit" name="login" class="send" value="Go">
        <?php if (isset($checklog)) { ?>
          <p>Forgot Your Password? <a href="#">click here</a></p>
        <?php } ?>
        
        
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
        
    </div>
  </form><!-- form -->
    </div>
  
  
</body>
</html>

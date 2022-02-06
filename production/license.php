<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath."/../lib/Database.php";
?>
<?php include "../helpers/Format.php";?>
<?php
 $db = new Database();
 $fm = new Format();
?>
<?php
	$sql = "SELECT * FROM setting WHERE id = 1";
	$result = $db->select($sql);
	if ($result) {
		$result = $result->fetch(PDO::FETCH_ASSOC);
		$userid = $result['userid'];
		$userid_02 = $fm->Jan_02($userid);
		$millitime = round(microtime(true) * 1000);
		if($millitime < $userid_02){
			header('Location: index.php');
		}
	}
	if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['licen'])) {
		$license = $_POST['license'];
		if (empty($license)) {
			echo "Fields Must not be empty";
		}else{
			$sql = "UPDATE setting SET userid = '$license' WHERE id = 1;";
			$result = $db->update($sql);
			if ($result) {
				header('Location: index.php');
			}else{
				echo "Your License Key is not Valided.Please Enter Valid License Key!!";
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		body{background: silver;}
		.mydiv {
		  background: #ddd none repeat scroll 0 0;
		  margin: 70px auto;
		  min-height: 314px;
		  padding: 25px;
		  text-align: center;
		  width: 39%;
		  box-shadow: 7px 4px 8px 8px #dedede;
		}
		.mydiv p {
		  font-size: 46px;
		  font-weight: bolder;
		  margin: 25px 0;
		}
		#license {
		  font-size: 18px;
		  font-weight: bold;
		  min-height: 34px;
		  min-width: 350px;
		  text-align: center;
		  border: 0;
		  border-radius: 5px;
		  margin-bottom: 15px;
		}
		#licen {
		  background: #B7B7B7;
		  border: 0 none;
		  border-radius: 5px;
		  font-size: 22px;
		  padding: 5px 30px;
		  transition: 0.8s;
		}
		#licen:hover{background: #a3a3a3;color: #fff;}
	</style>
</head>
<body>
	<div class="mydiv">
		<form action="" method="post">
			<p>Enter License Key:</p>
			<input type="text" name="license" id="license"><br>
			<input type="submit" name="licen" value="Enter" id="licen">
		</form>
	</div>
</body>
</html>

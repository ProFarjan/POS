<?php
//echo phpinfo();
//die();
//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);

$link = new PDO('sqlite:db/inventory.sqlite3');
$sql = "SELECT * FROM setting WHERE id = '1';";
$result = $link->query($sql);
if ($result) {
	$result = $result->fetch(PDO::FETCH_OBJ);
	$log = $result->login;
	$chack = $result->chack;
	if ($chack == "1") {
?>
<script>
	window.location.replace("http://ahcpharma.farjan.dev/production/<?php echo $log.'.php';?>");
	//window.location.replace("http://ahcpharma/production/<?php //echo $log.'.php';?>//");
</script>
<?php
	}else{
?>
<script>
	window.location.replace("http://ahcpharma.farjan.dev/production/firstChack.php");
</script>;
<?php
	}
}else{
	echo "<h1 style='text-align: center;font-size: 60px;color: red;border: 5px solid;border-radius: 10px;width: 55%;padding: 70px;margin: 70px auto 0;'>Something is Missing!!!</h1>";
}
?>

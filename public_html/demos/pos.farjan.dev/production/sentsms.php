<?php
    if(isset($_POST['number'])){
        $num = $_POST['number'];
        $msg = $_POST['msg'];
        
        if(!empty($num) && !empty($msg)){
            
            $to_phone = $num;
            
            $token = "4636171c12d385cca1539c7f044d380f";
            $url = "http://api.greenweb.com.bd/api.php?json";
            $data= array(
                'to'=>"$to_phone",
                'message'=>"$msg",
                'token'=>"$token"
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $smsresult = curl_exec($ch);
            print_r($smsresult);
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
			<p>Sent Message:</p>
			<textarea name="number" placeholder="Enter Number" style="width:500px;height:100px;"></textarea><br>
			<textarea name="msg" placeholder="Enter Message" style="width:500px;height:200px;"></textarea><br><br>
			<input type="submit" name="licen" value="Enter" id="licen">
		</form>
	</div>
</body>
</html>

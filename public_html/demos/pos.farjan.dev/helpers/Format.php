<?php

class Format {
	public function formatDate($data){
		return date('F j, Y, g:i a',strtotime($data));
	}

	public function formatDate01($data){
		return date('F j, Y',strtotime($data));
	}

	public function formatDate02($data){
		return date('g:i:s',strtotime($data));
	}

	public function print_fr($data){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		return true;
	}
	
	public function textShorten($text, $limit = 400){
		$text = $text . ' ';
		$text = substr($text,0,$limit);
		$text = substr($text,0,strrpos($text, ' '));
		$text = $text . '...';
		return $text;
	}
        
	public function validation($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	public function title(){
		$path = $_SERVER['SCRIPT_FILENAME'];
		$title = basename($path, '.php');
		if($title == 'index'){
			$title = 'Home';
		}elseif($title == 'contact'){
			$title == 'Contact';
		}
		return $title = ucwords($title);
	}
	public function Nias($val){
		if ($val == '&_') {
			return $val = 0;
		} elseif ($val == 'A_') {
			return $val = 1;
		} elseif ($val == '_z') {
			return $val = 2;
		} elseif ($val == 'y4') {
			return $val = 3;
		} elseif ($val == '3u') {
			return $val = 4;
		} elseif ($val == '@,') {
			return $val = 5;
		} elseif ($val == 'v_') {
			return $val = 6;
		} elseif ($val == 'n8') {
			return $val = 7;
		} elseif ($val == '2j') {
			return $val = 8;
		} elseif ($val == '_l') {
			return $val = 9;
		}else{
			return $val = 'Not Valid Liceny key';
		}
	}
	public function Jan_02($val){
		$val_1 = $this->Nias(substr($val,0,2));
		$val_2 = $this->Nias(substr($val,2,2));
		$val_3 = $this->Nias(substr($val,4,2));
		$val_4 = $this->Nias(substr($val,6,2));
		$val_5 = $this->Nias(substr($val,8,2));
		$val_6 = $this->Nias(substr($val,10,2));
		$val_7 = $this->Nias(substr($val,12,2));
		$val_8 = $this->Nias(substr($val,14,2));
		$val_9 = $this->Nias(substr($val,16,2));
		$val_10 = $this->Nias(substr($val,18,2));
		$val_11 = $this->Nias(substr($val,20,2));
		$val_12 = $this->Nias(substr($val,22,2));
		$val_13 = $this->Nias(substr($val,24,2));
		return $val = $val_1.$val_2.$val_3.$val_4.$val_5.$val_6.$val_7.$val_8.$val_9.$val_10.$val_11.$val_12.$val_13;
	}

	public function nias240(){
		ob_start();   
		system('ipconfig /all');  
		$mycomsys = ob_get_contents();   
		ob_clean();  
		$find_mac = "Physical";  
		$pmac = strpos($mycomsys, $find_mac);  
		$macaddress = substr($mycomsys,($pmac+36),17);  
		return $macaddress;
	}

	public function barcode($productcode,$barcodetype='C128'){
		include('../production/barcode_fr/BarcodeGenerator.php');
		include('../production/barcode_fr/BarcodeGeneratorPNG.php');
		include('../production/barcode_fr/BarcodeGeneratorSVG.php');
		include('../production/barcode_fr/BarcodeGeneratorJPG.php');
		include('../production/barcode_fr/BarcodeGeneratorHTML.php');
		$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
		return $generator->getBarcode($productcode, $generator::TYPE_CODE_128);
	}

}
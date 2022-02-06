<?php
include_once "Main.php";

class Login extends Main{
	protected $table = "user";

	public function CheckUsername($user,$pass){
		$sql = "SELECT * FROM $this->table WHERE user = '$user' AND pass = '$pass' LIMIT 1";
		$result = $this->db->select($sql);
		if ($result) {
			return $result;
		}
	}
	public function CheckUserEmail($email,$pass){
		$sql = "SELECT * FROM $this->table WHERE email = '$email' AND pass = '$pass' LIMIT 1";
		$result = $this->db->select($sql);
		if ($result) {
			return $result;
		}
	}
	public function CheckOnlyUser($user){
		$sql = "SELECT * FROM $this->table WHERE user = '$user' OR email = '$user' LIMIT 1";
		$result = $this->db->select($sql);
		if ($result) {
			return $result;
		}else{
			return false;
		}
	}
	public function NotMatchPass($pass){
		$sql = "SELECT * FROM $this->table WHERE user != '$pass' LIMIT 1";
		$result = $this->db->select($sql);
		if ($result) {
			return false;
		}
	}

	public function checklog($value){
		$user = $this->hl->validation($value['username']);
		$password =  md5($this->hl->validation($value['password']));

		$CheckUser     = $this->CheckUsername($user,$password);
		$Checkemail     = $this->CheckUserEmail($user,$password);

		if ($user == "" || empty($user)) {
			return "<span id='error'>Username Must be Requeired!!</span>";
		}elseif ($password == "" || empty($password)) {
			return "<span id='error'>Password Must be Requeired!!</span>";
		} else {
			if ($CheckUser) {
				$data = $CheckUser->fetch(PDO::FETCH_ASSOC);
				if ($data) {
					Session::init();
					Session::set('login', true);
					Session::set('UserId', $data['id']);
					Session::set('UserName', $data['name']);
					Session::set('Address', $data['address']);
					Session::set('Mobile', $data['mobile']);
					Session::set('UserImg', $data['image']);
					Session::set('User', $data['user']);
					Session::set('access', $data['email']);
					if ($data['email'] == "admin") {
						header('Location: index.php');
					}elseif($data['email'] == "purchase_manager"){
                        header('Location: purchase.php');
                    }else{
						header('Location: income.php');
					}
				}else{
					return "<span id='error'>User OR Password Not Match!!</span>";
				}
			} elseif ($Checkemail) {
				$data = $Checkemail->fetch(PDO::FETCH_ASSOC);
				if ($data) {
					Session::init();
					Session::set('login', true);
					Session::set('UserId', $data['id']);
					Session::set('UserName', $data['name']);
					Session::set('Address', $data['address']);
					Session::set('Mobile', $data['mobile']);
					Session::set('UserImg', $data['image']);
					Session::set('User', $data['user']);
					Session::set('access', $data['email']);
					if ($data['email'] == "admin") {
						header('Location: index.php');
					}else{
						header('Location: income.php');
					}
				}else{
					return "<span id='error'>Email OR Password Not Match!!</span>";
				}
			}else{
				return "<span id='error'>Email/User OR Password Not Match!!</span>";
			}
		}
	}
	public function Add_New_User($value){
		$name = $this->hl->validation($value['name']);
		$phone = $this->hl->validation($value['phone']);
		$address = $this->hl->validation($value['address']);
		$user = $this->hl->validation($value['user']);
		$password = $this->hl->validation($value['password']);
		$repassword = $this->hl->validation($value['repassword']);
		$userroll = $this->hl->validation($value['userroll']);

		$image   = $_FILES['image']['name'];
		$size    = $_FILES['image']['size'];
		$img_tmp = $_FILES['image']['tmp_name'];
		
		$parmission = array('jpg','png','gif','jpeg');
		$unic_name  = substr(md5(time()), 0,10);
		$ext_img    = strtolower(end(explode('.', $image)));
		$up_image   = "upload/user/".$unic_name.".".$ext_img;

		if(empty($name) || empty($user) || empty($password)){
			return "Fields Must Not be empty!";
		} elseif(strlen($password) <= 5){
			return "Password Must be Upper Five Characters!";
		} elseif(in_array($ext_img,$parmission) === false){
			return $msg = "<p class='alert alert-danger'>Upload Image Only this Format:-".implode(' ,', $parmission).'</p>';
		} elseif($size > 2048567){
			return $msg = "<p class='alert alert-danger'>Image File must be less than 2Mb</p>";
		} else {
			move_uploaded_file($img_tmp,$up_image);
			$password = md5($password);
			$sql = "INSERT INTO user (name,image,email,address,mobile,user,pass) VALUES ('$name','$up_image','$userroll','$address','$phone','$user','$password');";
			$result = $this->db->insert($sql);
			if ($result) {
				return "<p class='alert alert-success'>Wellcome ".$name. "! You Are New User This Software.</p>";
			}else{
				return "New User Not Added!!";
			}
		}
	}
	public function Update_New_User($id,$value){
		$name = $this->hl->validation($value['name']);
		$email = $this->hl->validation($value['email']);
		$phone = $this->hl->validation($value['phone']);
		$address = $this->hl->validation($value['address']);
		$user = $this->hl->validation($value['user']);

		$image   = $_FILES['image']['name'];
		$size    = $_FILES['image']['size'];
		$img_tmp = $_FILES['image']['tmp_name'];
		
		$parmission = array('jpg','png','gif','jpeg');
		$unic_name  = substr(md5(time()), 0,10);
		$ext_img    = strtolower(end(explode('.', $image)));
		$up_image   = "upload/user/".$unic_name.".".$ext_img;

		if(empty($name) || empty($email) || empty($user)){
			return "Fields Must Not be empty!";
		}elseif(in_array($ext_img,$parmission) === false){
			return $msg = "<p class='alert alert-danger'>Upload Image Only this Format:-".implode(' ,', $parmission).'</p>';
		} elseif($size > 2048567){
			return $msg = "<p class='alert alert-danger'>Image File must be less than 2Mb</p>";
		}else{
			move_uploaded_file($img_tmp,$up_image);
			$sql = "UPDATE user SET name='$name',image='$up_image',email='$email',address='$address',mobile='$phone',user='$user' WHERE id = '$id'";
			$result = $this->db->update($sql);
			if ($result) {
				return "<p class='alert alert-success'>Wellcome ".$name. "! You Are Update User This Software.</p>";
			}else{
				return " User Not Update!!";
			}
		}
	}
	public function Update_Password($id,$value){
		$oldpass = $this->hl->validation($value['oldpass']);
		$newpass = $this->hl->validation($value['newpass']);
		$renewpass = $this->hl->validation($value['renewpass']);

		if (empty($oldpass) || empty($newpass) || empty($renewpass)){
			return "Fields Must Not be Empty";
		}elseif ($newpass != $renewpass) {
			return "Password Not Match!!";
		}else{
			$newpass = md5($newpass);
			$sql = "UPDATE user SET pass = '$newpass' WHERE id = '$id';";
			$result = $this->db->update($sql);
			if ($result) {
				return "<p class='alert alert-success'>Password Update Successfully</p>";
			}else{
				return " Password Not Update!!";
			}
		}
	}

}
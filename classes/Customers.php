<?php
include_once "Main.php";

class Customers extends Main{
    protected $table = "customer";
    
    public function addcustomer($data,$file) {
        $date = date('m/d/Y');
        $typeval = $this->hl->validation($data['typeval']);
        if ($typeval == '2') {
            $destination = $this->hl->validation($data['destination']);
            $salary = $this->hl->validation($data['salary']);
        }else{
            $destination = '1';
            $salary = '1';
        }
        $customerid = $this->hl->validation($data['customerid']);
        $name = $this->hl->validation($data['name']);
        $email = $this->hl->validation($data['email']);
        $phone = $this->hl->validation($data['phone']);
        $telephone = $this->hl->validation($data['telephone']);
        $website = $this->hl->validation($data['website']);
        $company = $this->hl->validation($data['company']);
        $address = $this->hl->validation($data['address']);
        $city = $this->hl->validation($data['city']);

        $image   = $file['image']['name'];
        $size    = $file['image']['size'];
        $img_tmp = $file['image']['tmp_name'];
        
        $parmission = array('jpg','png','gif','jpeg');
        $unic_name  = substr(md5(time()), 0,10);
        $ext_img    = strtolower(end(explode('.', $image)));
        $up_image   = "upload/".$unic_name.".".$ext_img;

        if (empty($image)) {
            if(empty($name) || empty($customerid)){
                return "<p class='alert alert-info'>Fields Must not be empty(*)!!</p>";
            }else{
                $sql = "INSERT INTO $this->table (customerid,name,phone,email,website,company,address,telephone,city,destination,salary,typeval,date) VALUES ('$customerid','$name','$phone','$email','$website','$company','$address','$telephone','$city','$destination','$salary','$typeval','$date');";
                $result = $this->db->insert($sql);
                if ($result) {
                    return "<p class='alert alert-success'>Add Successfully!!</p>";
                }else{
                   return "<p class='alert alert-danger'>Not Added!!</p>";
                }
            }
        }else{
            if(empty($name) || empty($customerid)){
                return "<p class='alert alert-info'>Fields Must not be empty(*)!!</p>";
            }else{
                move_uploaded_file($img_tmp,$up_image);
                $sql = "INSERT INTO $this->table (customerid,name,phone,email,website,company,address,image,telephone,city,destination,salary,typeval,date) VALUES ('$customerid','$name','$phone','$email','$website','$company','$address','$up_image','$telephone','$city','$destination','$salary','$typeval','$date');";
                $result = $this->db->insert($sql);
                if ($result) {
                    return "<p class='alert alert-success'>Add Successfully!!</p>";
                }else{
                   return "<p class='alert alert-danger'>Not Added!!</p>";
                }
            }
        }
        
        
    }
    public function Update_Customer($id,$data){
        $typeval = $this->hl->validation($data['typeval']);
        if ($typeval == '2') {
            $destination = $this->hl->validation($data['destination']);
            $salary = $this->hl->validation($data['salary']);
        }else{
            $destination = '1';
            $salary = '1';
        }
        $name = $this->hl->validation($data['name']);
        $email = $this->hl->validation($data['email']);
        $phone = $this->hl->validation($data['phone']);
        $telephone = $this->hl->validation($data['telephone']);
        $website = $this->hl->validation($data['website']);
        $company = $this->hl->validation($data['company']);
        $address = $this->hl->validation($data['address']);
        $city = $this->hl->validation($data['city']);

        $image   = $_FILES['image']['name'];
        $size    = $_FILES['image']['size'];
        $img_tmp = $_FILES['image']['tmp_name'];
        
        $parmission = array('jpg','png','gif','jpeg');
        $unic_name  = substr(md5(time()), 0,10);
        $ext_img    = strtolower(end(explode('.', $image)));
        $up_image   = "upload/".$unic_name.".".$ext_img;

        if (empty($image)) {
            if(empty($name)){
                return "<p class='alert alert-info'>Fields Must not be empty(*)!!</p>";
            }else{
                $sql = "UPDATE customer SET name='$name',phone='$phone',email='$email',website='$website',company='$company',address='$address',telephone='$telephone',city='$city',destination='$destination',salary='$salary' WHERE id = '$id';";
                $result = $this->db->update($sql);
                if ($result) {
                    return "<p class='alert alert-success'>Customer Updated Successfully!!</p>";
                }else{
                   return "<p class='alert alert-danger'>Customer not Updated!!</p>";
                }
            }
        }else{
            if(empty($name)){
                return "<p class='alert alert-info'>Fields Must not be empty(*)!!</p>";
            }else{
                move_uploaded_file($img_tmp,$up_image);
                $sql = "UPDATE customer SET name='$name',phone='$phone',email='$email',website='$website',company='$company',address='$address',image='$up_image',telephone='$telephone',city='$city' WHERE id = '$id';";
                $result = $this->db->update($sql);
                if ($result) {
                    return "<p class='alert alert-success'>Customer Updated Successfully!!</p>";
                }else{
                   return "<p class='alert alert-danger'>Customer not Updated!!</p>";
                }
            }
        }
    }

    public function SelectCustomerByID($id){
        $sql = "SELECT * FROM $this->table WHERE id = '$id'";
        $result = $this->db->select($sql);
        if ($result) {
            return $result->fetch_assoc();
        }
    }

    public function SelectCustomerByID_244($val,$type){
        $sql = "SELECT * FROM $this->table WHERE phone LIKE '%$val%' AND typeval = '$type';";
        $result = $this->db->select($sql);
        if ($result) {
            return $result;
        }
    }

    public function SelectCustomerByID_248($val,$type){
        $sql = "SELECT * FROM $this->table WHERE phone = '$val' AND typeval = '$type';";
        $result = $this->db->select($sql);
        if ($result) {
            return $result->fetch(PDO::FETCH_OBJ);
        }
    }

    public function F_Total_Income_Amount($table,$col,$id){
        $sql = "SELECT * FROM $table WHERE $col = '$id' AND status = '1';";
        $result = $this->db->select($sql);
        if ($result) {
            $sum = 0;
            while ($data = $result->fetch(PDO::FETCH_OBJ)) {
                $rate = $this->SelectAll_By_ID('product',$data->productid);
                $total = ($data->quantity)*($data->rate);
                $sum = $total+$sum;
            }
            return $sum;
        }
    }

    public function F_Total_Purchase_Amount($table,$col,$id){
        $sql = "SELECT * FROM $table WHERE $col = '$id' AND status = '1';";
        $result = $this->db->select($sql);
        if ($result) {
            $sum = 0;
            while ($data = $result->fetch(PDO::FETCH_OBJ)) {
                $total = ($data->quantity)*($data->rate);
                $sum = $total+$sum;
            }
            return $sum;
        }
    }

   public function customer_payment_Count($id){
        $sql = "SELECT * FROM payment WHERE customerid = '$id'";
        $result = $this->db->select($sql);
        if ($result) {
            $i = 1;
            $sum = 0;
            while ($data = $result->fetch(PDO::FETCH_OBJ)) {
                $sum = $i + $sum;
            }
            return $sum;
        } 
    }

    public function pay_Salary_Employee($id){
        $sql = "SELECT SUM(amount) AS AMOUNT FROM expense WHERE employeeid = '$id' AND purpuse = 'salary'";
        $result = $this->db->select($sql);
        if ($result) {
            $result = $result->fetch(PDO::FETCH_OBJ);
            return $result->AMOUNT;
        } 
    }

    public function tbl_update($id){
        $sql = "UPDATE customer SET status = '1' WHERE id = '$id';";
        $result = $this->db->update($sql);
        if ($result) {
            return true;
        }
        return false;
    }

}
<?php
 include_once "Main.php";
class Product extends Main {
    protected $table = "product";
    protected $tbl_store = "tbl_store";
    
    public function Chack_Product_Code($code){
      $sql = "SELECT * FROM product WHERE code = '$code'";
      $result = $this->db->select($sql);
        if ($result) {
            return true;
        }
    }

    public function addproduct($data) {
        $type = ucfirst($this->hl->validation($data['type']));
        $code = $this->hl->validation($data['code']);
        $name = ucfirst($this->hl->validation($data['name']));
        $subtype = ucfirst($this->hl->validation($data['subtype']));
        $rate = $this->hl->validation($data['rate']);
        //$chack_Code = $this->Chack_Product_Code($code);

        if(empty($type) || empty($code) || empty($name) || empty($subtype) || empty($rate)){
            return "<p class='alert alert-info'>Fields Must not be empty(*)!!</p>";
        } else {
          $sql = "INSERT INTO $this->table (type,subtype,name,code,rate) VALUES ('$type','$subtype','$name','$code','$rate');";
            $result = $this->db->insert($sql);
            if ($result) {
                return "<p class='alert alert-success'>Product Add Successfully!!</p>";
            }else{
               return "<p class='alert alert-danger'>Product not Added!!</p>";
            }   
        } 
    }

    public function Update_product($id,$data) {
        $type = $this->hl->validation($data['type']);
        $code = $this->hl->validation($data['code']);
        $name = $this->hl->validation($data['name']);
        $subtype = $this->hl->validation($data['subtype']);
        $rate = $this->hl->validation($data['rate']);
        
        if(empty($type) || empty($name) || empty($rate) || empty($subtype)){
            return "<p class='alert alert-info'>Fields Must not be empty(*)!!</p>";
        } else {
          $sql = "UPDATE product SET type='$type',name='$name',code='$code',subtype='$subtype',rate='$rate' WHERE id='$id';";
            $result = $this->db->update($sql);
            if ($result) {
                return "<p class='alert alert-success'>Product Updated Successfully!!</p>";
            }else{
               return "<p class='alert alert-danger'>Product not Updated!!</p>";
            }   
        } 
    }

    public function Add_Catagory($data){
        $type = ucfirst($this->hl->validation($data['type']));
        $subtype = $this->hl->validation($data['subtype']);
        if(empty($type) || empty($subtype)){
            return "<p class='alert alert-info'>Fields Must not be empty(*)!!</p>";
        } else {
          $sql = "INSERT INTO catagory (type,subtype) VALUES ('$type','$subtype')";
            $result = $this->db->insert($sql);
            if ($result) {
                return "<p class='alert alert-success'>Catagory Add Successfully!!</p>";
            }else{
               return "<p class='alert alert-danger'>Catagory not Added!!</p>";
            }   
        } 
    }

    public function Catagory_Update($id,$data){
        $type = ucfirst($this->hl->validation($data['type']));
        $subtype = $this->hl->validation($data['subtype']);
        if(empty($type) || empty($subtype)){
            return "<p class='alert alert-info'>Fields Must not be empty(*)!!</p>";
        } else {
          $sql = "UPDATE catagory SET type='$type',subtype='$subtype' WHERE id = '$id'";
            $result = $this->db->update($sql);
            if ($result) {
                return "<p class='alert alert-success'>Catagory Updated Successfully!!</p>";
            }else{
               return "<p class='alert alert-danger'>Catagory not Updated!!</p>";
            }   
        } 
    }

    public function getChalanno($table,$col,$col1,$id,$id1,$getinfo='*'){
        $sql = "SELECT $getinfo FROM $table WHERE $col = '$id' AND $col1 = '$id1';";
        $result = $this->db->select($sql);
        if ($result) {
            return $result;
        }
    }
    

}

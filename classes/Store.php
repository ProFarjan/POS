<?php
 include_once "Main.php";
class Store extends Main{
    protected $table = "tbl_store";

    public function Product_Code($data){
      $code = $this->hl->validation($data['code']);
      $sql = "SELECT * FROM product WHERE code = '$code'";
      $result = $this->db->select($sql);
      if ($result) {
        return $result->fetch(PDO::FETCH_OBJ); 
      }else{
        return false;
      }
    }

    public function Store_Product_add($data){
      $date = $this->hl->validation($data['date']);
      $productid = $this->hl->validation($data['productid']);
      $quantity = $this->hl->validation($data['quantity']);
      $unit = $this->hl->validation($data['unit']);
      $totalcarton = $this->hl->validation($data['totalcarton']);
      $percarton = $this->hl->validation($data['percarton']);
      $unitprice = $this->hl->validation($data['unitprice']);
      if(empty($date) || empty($productid)){
        return "<p class='alert alert-info'>Fields Must not be empty!!</p>";
      }else{
        $sql = "INSERT INTO store (productid,totalcarton,percarton,quantity,unit,status,date,rate) VALUES ('$productid','$totalcarton','$percarton','$quantity','$unit','1','$date','$unitprice')";
        $result = $this->db->insert($sql);
        if ($result) {
          return "<p class='alert alert-success'>This Product Add Store Successfully!!</p>";
        }else{
          return "<p class='alert alert-danger'>Not add Store!!</p>";
        }
      }
    }

    public function All_Store_Status($id){
      $sql = "SELECT SUM(totalcarton) AS TOTALCARTON,SUM(percarton) AS PERCARTON,SUM(quantity) AS QUANTITY,unit FROM store WHERE productid = '$id';";
      $result = $this->db->select($sql);
      if ($result) {
        return $result->fetch(PDO::FETCH_OBJ); 
      }
    }

    public function Total_Piece($id){
      $sql = "SELECT totalcarton AS TOTALCAT,percarton AS PERCAT FROM store WHERE productid = '$id';";
      $result = $this->db->select($sql);
      if ($result) {
        $sum = 0;
        while ($data = $result->fetch(PDO::FETCH_OBJ)) {
          $data1 = ($data->TOTALCAT)/($data->PERCAT);
          $sum = $sum+$data1;
        }
        return $sum;
      }
    }

    public function Saleing_Product($id){
      $sql = "SELECT SUM(quantity) AS QUANTITY,unit FROM income WHERE productid = '$id';";
      $result = $this->db->select($sql);
      if ($result) {
        return $result;
      }
    }

    public function Total_Pay_Rece_Report($id){
      $sql = "SELECT invoice,customerid,SUM(other) as OTHER,SUM(disamount) AS DISAMOUNT,SUM(payment) AS PAYMENT,status From payment WHERE status = '$id' GROUP BY customerid;";
      $result = $this->db->select($sql);
      if ($result) {
        return $result;
      }
    }

    public function F_Payable_Total_amount($id){
        $sql = "SELECT * FROM purchase WHERE supplierid = '$id';";
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
    public function F_Receiable_Total_amount($id){
        $sql = "SELECT * FROM income WHERE customerid = '$id';";
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

    public function Destroy_Product($data){
      $proid   = $this->hl->validation($data['proid']);
      $destroy = $this->hl->validation($data['destroy']);
      $note = $this->hl->validation($data['note']);
      $chalanno = $this->hl->validation($data['chalanno']);
      $date = date('m/d/Y');

      $sql_store = "SELECT id,quantity,salesinfo FROM store WHERE chalanno ='$chalanno' AND productid = '$proid' AND available = '0';";
      $store_result = $this->db->select($sql_store);
      while ($store_data = $store_result->fetch(PDO::FETCH_OBJ)) {
        if ($store_data->salesinfo == "0") {
          $avail = ($store_data->quantity-$destroy);
          $arr_store = array('available'=>$avail,'destroy'=>$destroy);
          $avail_real = ($avail <= 0) ? "1" : "0";
          $st_id = $store_data->id;
          $arr_store_ = serialize($arr_store);
          $sql_up_store = "UPDATE store SET available = '$avail_real', salesinfo = '$arr_store_' WHERE id = '$st_id';";
          $this->db->update($sql_up_store);
        }else{
          $available_doll = unserialize($store_data->salesinfo);
          $avail = ($available_doll['available']-$destroy);
          $arr_store = array('available'=>$avail,'destroy'=>$destroy);
          $avail_real = ($avail <= 0) ? "1" : "0";
          $st_id = $store_data->id;
          $arr_store_ = serialize($arr_store);
          $sql_up_store = "UPDATE store SET available = '$avail_real', salesinfo = '$arr_store_' WHERE id = '$st_id';";
          $this->db->update($sql_up_store);
        }
        break;
      }
      $sql = "INSERT INTO destroy (productid,chalanno,destroy,note,date) VALUES ('$proid','$chalanno','$destroy','$note','$date');";
      $result = $this->db->insert($sql);
      if ($result) {
        return "<p class='alert alert-success'>Destroy Entry Successfully.</p>";
      }else{
        return "<p class='alert alert-danger'>Destroy Not Entry Successfully.</p>";
      }
    }

    public function select_product($data){
      $sql = "SELECT * FROM product WHERE type IN(".$data.");";
      $result = $this->db->select($sql);
      if ($result) {
        return $result;
      }
    }
    
}

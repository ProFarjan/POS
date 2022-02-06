<?php
include_once 'Main.php';
class Employee extends Main{
	protected $table = "employee";

    public function selectemployerbyid($id){
        $sql = "SELECT * FROM $this->table WHERE id = '$id' LIMIT 1;";
        $result = $this->db->select($sql);
        if ($result) {
            return $result;
        }
    }
    public function deletebyid($id){
       $sql = "DELETE FROM $this->table WHERE id='$id';";
        $result = $this->db->delete($sql);
        if ($result) {
            return $result;
        }else{
            return false;
        }
    }
    public function Search_Customer_Mobile($id){
        $sql = "SELECT * FROM customer WHERE phone LIKE '%$id%';";
        $result = $this->db->delete($sql);
        if ($result) {
            return $result;
        }
    }
    public function Search_Customer_Mobile_1821($id,$type,$col='phone'){
        $sql = "SELECT * FROM customer WHERE $col LIKE '%$id%' AND typeval = '$type';";
        $result = $this->db->delete($sql);
        if ($result) {
            return $result;
        }
    }
    public function Insert_Customer($id1,$id2,$id3,$val){
        $sql = "INSERT INTO customer (customerid,name,phone,typeval) VALUES ('$id1','$id2','$id3','$val');";
        $result = $this->db->insert($sql);
        if ($result) {
            return $result;
        }
    }

    public function Tbl_Col_Id_2_Employee($table,$col1,$col2,$id1,$id2){
        $sql = "SELECT * FROM $table WHERE $col1 LIKE '%$id1%' AND $col2 = '$id2';";
        $result = $this->db->select($sql);
        if ($result) {
            return $result;
        }
    }

    public function attendance_Insert($data){
        $customerid = $this->hl->validation($data['customerid']);
        $date_c = date('m/d/Y');
        $time_c = date('h:i:s');
        $sql = "INSERT INTO attendance (employeeid,start,date) VALUES ('$customerid','$time_c','$date_c');";
        $result = $this->db->insert($sql);
        if ($result) {
            return $result;
        }
    }

    public function attendance_Insert_Appsent($data){
        $customerid = $this->hl->validation($data['customerid']);
        $date_c = date('m/d/Y');
        $sql = "INSERT INTO attendance (employeeid,appsent,finish,date) VALUES ('$customerid','1','1','$date_c');";
        $result = $this->db->insert($sql);
        if ($result) {
            return $result;
        }
    }
	
    public function attendance_Insert_finished($data){
        $id = $this->hl->validation($data['customerid']);
        $time_c = date('h:i:s');
        $sql = "UPDATE attendance SET finish = '$time_c' WHERE id = '$id';";
        $result = $this->db->update($sql);
        if ($result) {
            return $result;
        }
    }

    public function holyday_insert($data){
        $date_20 = $this->hl->validation($data['date']);
        $employeeid = $this->hl->validation($data['employeeid']);
        $note = $this->hl->validation($data['note']);

        if ($employeeid != 'all') {
            $sql = "INSERT INTO attendance (employeeid,appsent,finish,date) VALUES ('$employeeid','$note','1','$date_20');";
            $result = $this->db->insert($sql);
            if ($result) {
                return "<p class='alert alert-success'>Inserted Successfully.<p>";
            }
        }else{
          $Sector = $this->Tbl_Col_Id('customer','typeval','2');
          if ($Sector) {
              while ($data = $Sector->fetch(PDO::FETCH_OBJ)) {
                $employeeid = $data->id;
                $sql = "INSERT INTO attendance (employeeid,appsent,finish,date) VALUES ('$employeeid','$note','1','$date_20');";
                $result = $this->db->insert($sql);
              }
              if ($result) {
                  return "<p class='alert alert-success'>Inserted Successfully.<p>";
              }
          }
        }

    }

    public function employeeSalary($employeeid,$to,$from){
        $sql = "SELECT * FROM expense WHERE purpuse = 'salary' AND employeeid = '$employeeid' AND date BETWEEN '$to' AND '$from';";
        $result = $this->db->select($sql);
        if ($result) {
            return $result;
        }
    }

    public function getPaidLoad($employee_name){
        $sql = "SELECT id,amount,finished FROM transfer WHERE person = '$employee_name' AND status = '1' AND finished != '1';";
        $result = $this->db->select($sql);
        if ($result) {
            return $result;
        }
    }

    public function TBL_VAL_52($table,$col,$id,$val){
        $sql = "SELECT $val AS VALUE FROM $table WHERE $col = '$id';";
        $result = $this->db->select($sql);
        if ($result) {
            $result = $result->fetch(PDO::FETCH_OBJ);
            return $result->VALUE;
        }
    }

    public function insert_sql($sql){
        $reuslt = $this->db->insert($sql);
        if ($reuslt) {
            return true;
        }else{
            return false;
        }
    }

}
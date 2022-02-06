<?php
 include "Main.php";
class Chack extends Main{
    protected $table = 'Chack';
    
    public function selectchack($data) {
        $sql = "SELECT * from $this->table WHERE data = '$data';";
        $result = $this->db->select($sql);
        if($result){
           return true; 
        }
    }    
    public function checkrun($data) {
        $sql = "INSERT INTO $this->table (data) VALUES ('$data')";
        return $this->db->insert($sql);
    }
    public function createTable() {
        $sql = "CREATE TABLE Chack ( id INT NOT NULL AUTO_INCREMENT , data VARCHAR(255) NOT NULL , u_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (id)) ENGINE = InnoDB";
        return $this->db->insert($sql);
    }
    public function wellcome123($val) {
        $sql = "TRUNCATE TABLE $val;";
        return $this->db->delete($sql);
    }
}

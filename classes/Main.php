<?php
 $path = realpath(dirname(__FILE__));
 include_once $path."/../lib/Database.php";
 include_once $path."/../helpers/Format.php";

class Main{
	protected $db;
	public $hl;
	protected $table;
	
	function __construct(){
		$this->db = new Database();
		$this->hl = new Format();
	}
    
    public function tbl_sql($sql){
        $result = $this->db->select($sql);
        if ($result) {
            return $result;
        }
    }
    public function SelectAll($table){
        $sql = "SELECT * FROM $table ORDER BY id DESC;";
        $result = $this->db->select($sql);
        if ($result) {
            return $result;
        }
    }
    public function SelectAll_Val($table,$order){
        $sql = "SELECT * FROM $table ORDER BY $order ASC;";
        $result = $this->db->select($sql);
        if ($result) {
            return $result;
        }
    }
    public function SelectProduct_By_Type($table){
        $sql = "SELECT DISTINCT type FROM $table ORDER BY id DESC;";
        $result = $this->db->select($sql);
        if ($result) {
            return $result;
        }
    }
    public function SelectAll_By_ID($table,$id,$colinfo='*'){
        $sql = "SELECT $colinfo FROM $table WHERE id = '$id';";
        $result = $this->db->select($sql);
        if ($result) {
            return $result->fetch(PDO::FETCH_OBJ);
        }
    }
    public function SelectAll_sum($table,$id,$col,$colinfo='*'){
        $sql = "SELECT $colinfo FROM $table WHERE $col = '$id';";
        $result = $this->db->select($sql);
        if ($result) {
            return $result->fetch(PDO::FETCH_OBJ);
        }
    }
    public function Tbl_Col_Id($table,$col,$id){
        $sql = "SELECT * FROM $table WHERE $col = '$id' ORDER BY id DESC;";
        $result = $this->db->select($sql);
        if ($result) {
            return $result;
        }
    }
    public function Tbl_Col_Id_820($table,$col,$id){
        $sql = "SELECT * FROM $table WHERE $col = '$id' ORDER BY $col;";
        $result = $this->db->select($sql);
        if ($result) {
            return $result;
        }
    }
    public function Tbl_Col_Id_LIMITE_0($table,$col,$id,$colinfo='*'){
        $sql = "SELECT $colinfo FROM $table WHERE $col = '$id' ORDER BY id DESC LIMIT 1;";
        $result = $this->db->select($sql);
        if ($result) {
            return $result->fetch(PDO::FETCH_OBJ);
        }
    }
    public function Tbl_Col_Id_2($table,$col1,$col2,$id1,$id2){
        $sql = "SELECT * FROM $table WHERE $col1 = '$id1' AND $col2 = '$id2';";
        $result = $this->db->select($sql);
        if ($result) {
            return $result;
        }
    }
    public function Tbl_Col_Id_2_not($table,$col1,$col2,$id1,$id2){
        $sql = "SELECT * FROM $table WHERE $col1 = '$id1' AND $col2 != '$id2';";
        $result = $this->db->select($sql);
        if ($result) {
            return $result;
        }
    }
    public function Tbl_Col_Id_Like($table,$col1,$col2,$id){
        $sql = "SELECT * FROM $table WHERE $col1 LIKE '%$id%' OR $col2 LIKE '%$id%';";
        $result = $this->db->select($sql);
        if ($result) {
            return $result;
        }
    }
    public function Delete($table,$id){
    	$sql = "DELETE FROM $table WHERE id = '$id'";
    	$result = $this->db->delete($sql);
        if ($result) {
            return "<p class='alert alert-success'><strong>Success </strong>This Data Delete Successfully</p>";
        }
    }
    public function Delete_01($table,$col,$id){
        $sql = "DELETE FROM $table WHERE $col = '$id'";
        $result = $this->db->delete($sql);
        if ($result) {
            return "<p class='alert alert-success'><strong>Success </strong>This Data Delete Successfully</p>";
        }
    }
    public function TBL_VAL_52($table,$col,$id,$val){
        $sql = "SELECT SUM($val) AS VALUE FROM $table WHERE $col = '$id';";
        $result = $this->db->select($sql);
        if ($result) {
            $result = $result->fetch(PDO::FETCH_OBJ);
            return $result->VALUE;
        }
    }
    public function TBL_VAL_53($table,$val){
        $sql = "SELECT SUM($val) AS VALUE FROM $table";
        $result = $this->db->select($sql);
        if ($result) {
            $result = $result->fetch(PDO::FETCH_OBJ);
            return $result->VALUE;
        }
    }
    public function Reset_Data($table){
        $sql = "DELETE FROM $table;";
        $result = $this->db->delete($sql);
        if ($result) {
            return $result;
        }
    }
    public function lIke_One_Col($table,$col,$col1,$id,$val,$date){
        $sql = "SELECT sum($val) AS AMOUNT FROM $table WHERE $col = '$id' AND $col1 LIKE '%$date%';";
        $result = $this->db->select($sql);
        if ($result) {
            $result = $result->fetch(PDO::FETCH_OBJ);
            if($result){
                return $result->AMOUNT;
            }
        }
    }
    public function lIke_One_Col_Withou_Sum($table,$col,$id){
        $sql = "SELECT DISTINCT acno,bankname FROM $table WHERE $col LIKE '%$id%' ORDER BY id DESC;";
        $result = $this->db->select($sql);
        if ($result) {
            return $result;
        }
    }
    public function last_id_select($table){
        $sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 1;";
        $result = $this->db->select($sql);
        if($result){
            $result = $result->fetch(PDO::FETCH_OBJ);
            if ($result) {
                return $result->code;
            }
        }
    }
    public function smshelp($to_phone,$text){
        $token = "4636171c12d385cca1539c7f044d380f";
        $url = "http://api.greenweb.com.bd/api.php?json";
        $data= array(
            'to'=>"$to_phone",
            'message'=>"$text",
            'token'=>"$token"
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);
        return $smsresult;
    }
    public function tbl_select_any($table,$where_val,$col='*',$order='id',$sort='desc',$limit=0){
        $where_con = "";
        foreach ($where_val as $key => $value) {
            $where_con .= $key." = '".$value."' and ";
        }
        $where_con = substr($where_con, 0, strlen($where_con) - 4);
        $limit_info = "";
        if ($limit != 0) {
            $limit_info = " LIMIT $limit";
        }
        $sql = "SELECT $col FROM $table WHERE ".$where_con." ORDER BY $order $sort ".$limit_info;
        $result = $this->db->select($sql);
        if($result){
            return $result;
        }
    }

}
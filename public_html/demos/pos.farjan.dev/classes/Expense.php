<?php
 include_once 'Main.php';
class Expense extends Main{
	protected $table;

	public function AddSector($data){
		$name = $this->hl->validation($data['sector']);
		if (empty($name)) {
			return "<p class='alert alert-info'>Fields Must not be empty!!</p>";
		} else {
			$sql = "INSERT INTO sector(sector) VALUES('$name');";
			$result = $this->db->insert($sql);
			if ($result) {
				return "<p class='alert alert-success'>This Sector Add Successfully!!</p>";
			}else{
				return "<p class='alert alert-danger'>This Sector not Added!!</p>";
			}
		}
	}

	public function Update_Sector($id,$data){
		$name = strtolower($this->hl->validation($data['sector']));
		if (empty($name)) {
			return "<p class='alert alert-info'>Fields Must not be empty!!</p>";
		} else {
			$sql = "UPDATE sector SET sector='$name' WHERE id = '$id';";
			$result = $this->db->update($sql);
			if ($result) {
				return "<p class='alert alert-success'>This Sector Updated Successfully!!</p>";
			}else{
				return "<p class='alert alert-danger'>This Sector not Updated!!</p>";
			}
		}
	}

	public function AddExpense($data){
		$date = $this->hl->validation($data['date']);
        //$date = $date.' '.date('H:i:s');
		$purpuse = $this->hl->validation($data['purpuse']);
		$emplyee = $this->hl->validation($data['emplyee']);
		$amount = $this->hl->validation($data['amount']);
		$note = $this->hl->validation($data['note']);
		if (empty($date) AND empty($purpuse) AND empty($amount)) {
			return "<p class='alert alert-info'>Fields Must not be empty!!</p>";
		} elseif (!empty($emplyee)) {
			$sql = "INSERT INTO expense (purpuse,employeeid,amount,note,date) VALUES ('$purpuse','$emplyee','$amount','$note','$date')";
			$result = $this->db->insert($sql);
			if ($result) {
				return "<p class='alert alert-success'>Expense Add Successfully!!</p>";
			}else{
				return "<p class='alert alert-danger'>Expense Not Added!!</p>";
			}
		} elseif (empty($emplyee)) {
			$sql = "INSERT INTO expense (purpuse,amount,note,date) VALUES ('$purpuse','$amount','$note','$date')";
			$result = $this->db->insert($sql);
			if ($result) {
				return "<p class='alert alert-success'>Expense Add Successfully!!</p>";
			}else{
				return "<p class='alert alert-danger'>Expense Not Added!!</p>";
			}
		}
	}


}
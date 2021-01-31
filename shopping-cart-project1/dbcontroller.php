<?php
class DBController {
	/*private $host = "us-cdbr-east-02.cleardb.com";
	private $user = "bb03ef7e1c6a4b";
	private $password = "382b7325";
	private $database = "heroku_42663d36d60b5ca";*/

    private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "shopping";
	private $conn;
	
	function __construct() {
		$this->conn = $this->connectDB();
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}

	function runInsertQuery($query) {
		$result = mysqli_query($this->conn,$query);
		if($result == 1) {
			return mysqli_insert_id($this->conn);
		}

		return -1;
	}

	function runUpdateQuery($query) {
		$result = mysqli_query($this->conn,$query);
		return $result;
	}
	
	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
}
?>
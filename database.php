<?php
class Database {
	//plaats in config file
	protected $servername = "localhost";
	protected $username = "root";
	protected $password = "";
	protected $dbname = "fierypatientdb";
	
	private $conn;

	function Connect(){	
		// Create connection
		$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
		// Check connection
		if ($this->conn->connect_error) {
			die("Connection failed: " . $this->conn->connect_error);
		}
		return $this->conn;
	}
	
	function Close(){
		$this->conn->close();
	}
}

?>
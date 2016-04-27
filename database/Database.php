<?php

class Database {
	
	
	private $servername = "localhost:3307";
	private $dbname = "st-datacollector";
	private $username = "root";
	private $password = "";

	private $connection = null;


	public function openCon(){
		$this->connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
		// Check connection
		if ($this->connection->connect_error) {
			die("Connection failed: " . $this->connection->connect_error);
		}
	}

	public function closeCon(){
		if($this->connection != null){
			$this->connection->close();
		}
	}

	public function checkResult($result){
		$check = true;
		if (!$result) {
			throw new Exception("Database Error [{$this->database->errno}] {$this->database->error}");
			$check = false;
		}
		return $check;
	}

	/**
	 * @return
	 */
	public function getConnection()
	{
		return $this->connection;
	}
}

?>


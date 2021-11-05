<?php
class Database{

	public $connection;

	//Connect with database for mysql database
	public function __construct($host, $user, $pass, $db)
	{
		$this->connection = new mysqli($host,$user,$pass);

		$CreateDBsql = "CREATE DATABASE IF NOT EXISTS $db";
		
		// Create Database
		if($this->connection->query($CreateDBsql) === TRUE){
			echo "Database Created succefully! <br>";
		}else{
			echo "Error creating database:".$this->connection->error;
		}

		$this->connection->select_db($db);

		//Check Connection
		if($this->connection->connect_errno){
			die("Connection Fail ".$this->connection->connect_error);
		}
		else{
			echo "Connection is ok <br>";
		}
	}// End of constructor


	//Function to Create Table
	public function CreateTable($sql){
		//Create Table
		if ($this->connection->query($sql) === TRUE) {
		    echo "Table has been created successfully";
		} else {
			echo "Table is already exist.";
		    //echo "Error to creating table: ".$this->connection->error;
		}
		echo "<br>";
	}//End of function CreateTable


	# Insert Data within table by accepting TableName and Table column => Data as associative array
	public function insert($tblname, array $val_cols){

		$keysString = implode(", ", array_keys($val_cols));

		$i=0;
		foreach($val_cols as $key=>$value) {
			$StValue[$i] = "'".$value."'";
		    $i++;
		}

		$StValues = implode(", ",$StValue);
		
		if (mysqli_connect_errno()) {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

		//Perform Insert operation
		if($this->connection->query("INSERT INTO $tblname ($keysString) VALUES ($StValues)") === TRUE){
			echo "New record has been inserted successfully!";
		}else{
			echo "Error ".$this->connection->error;
		}
		echo "<br>";
	}//End of function insert


	//Call destructor function 
	public function __destruct() {
		if($this->connection){
			// Close the connection
        	$this->connection->close();
        	echo "Connection is release";
        }	
	}

}//end of class
?>
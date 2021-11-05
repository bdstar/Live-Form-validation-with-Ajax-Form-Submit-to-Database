<?php
require("database_class.php");

$SERVER_NAME = "localhost";
$USERNAME = "root";
$PASSWORD = "";
$DATABASE_NAME = "info";

// Create Connection
$obj = new Database($SERVER_NAME,$USERNAME,$PASSWORD,$DATABASE_NAME);


/*------------- Operation for General Information Form------------------*/

// Assign table for General Info
$tablename = "general_info";

// Create table query
$CreateTableSql = "CREATE TABLE $tablename(ID INT(10) NOT NULL AUTO_INCREMENT, Name VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, cemail VARCHAR(100) NOT NULL,  password VARCHAR(100) NOT NULL,  cpassword VARCHAR(100) NOT NULL,  PRIMARY KEY (`ID`) ) COLLATE='latin1_swedish_ci' ENGINE=InnoDB ROW_FORMAT=DEFAULT";
//Call Create Table
$obj->CreateTable($CreateTableSql);

//Fetch data for General Info Form fields
$name=$_POST['name1'];
$email=$_POST['email1'];
$cemail=$_POST['cemail1'];
$password=$_POST['password1'];
$cpassword=$_POST['cpassword1'];

echo "Name = ".$name."| Email = ".$email."| Confirm Email = ".$cemail."| Password = ".$password." | Confirm Password = ".$cpassword;

//Associative array for insert function
$InsColumnVal = array("Name"=>$name,"email"=>$email,"cemail"=>$cemail,"password"=>$password,"cpassword"=>$cpassword);
//Call insert function to insert record
$obj->insert($tablename, $InsColumnVal);


/*------------- Operation for Contact Information Form --------------------*/
// Assign table for Contact Info
$tablename = "contact_info";
// Create table query
$CreateTableSql = "CREATE TABLE $tablename (  `ID` INT(10) NOT NULL AUTO_INCREMENT,  `Address1` VARCHAR(100) NOT NULL,  `Address2` VARCHAR(100) NOT NULL,  `Conutry` VARCHAR(100) NOT NULL,  `Phone` VARCHAR(100) NOT NULL,  PRIMARY KEY (`ID`) ) COLLATE='latin1_swedish_ci' ENGINE=InnoDB ROW_FORMAT=DEFAULT";
//Call Create Table
$obj->CreateTable($CreateTableSql);
?>
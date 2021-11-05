<?php
require("database_class.php");

$SERVER_NAME = "localhost";
$USERNAME = "root";
$PASSWORD = "";
$DATABASE_NAME = "info";

// Create Connection
$obj = new Database($SERVER_NAME,$USERNAME,$PASSWORD,$DATABASE_NAME);


/*------------- Operation for Contact Information Form --------------------*/
// Assign table for Contact Info
$tablename = "contact_info";
// Create table query
$CreateTableSql = "CREATE TABLE $tablename (  `ID` INT(10) NOT NULL AUTO_INCREMENT,  `Address1` VARCHAR(100) NOT NULL,  `Address2` VARCHAR(100) NOT NULL,  `Conutry` VARCHAR(100) NOT NULL,  `Phone` VARCHAR(100) NOT NULL,  PRIMARY KEY (`ID`) ) COLLATE='latin1_swedish_ci' ENGINE=InnoDB ROW_FORMAT=DEFAULT";
//Call Create Table
$obj->CreateTable($CreateTableSql);


//Fetch data for General Info Form fields
$address1=$_POST['address1'];
$address2=$_POST['address2'];
$country=$_POST['country'];
$phone=$_POST['phone'];

echo "Address1 = ".$address1." | Address2 = ".$address2." | country = ".$country." | Phone = ".$phone;

//Associative array for insert function
$InsColumnVal = array("address1"=>$address1,"address2"=>$address2,"country"=>$country,"phone"=>$phone);
//Call insert function to insert record
$obj->insert($tablename, $InsColumnVal);
?>
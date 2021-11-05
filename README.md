# Live-Form-validation-with-Ajax-Form-Submit-to-Database

Live form validation using HTML5-CSS3-JavaScript and after validation the data will be inserted into the MySQL database through the Ajax submit with PHP functions. 

Recent I have work with a real life client side real life form validation using customize HTML5-CSS3 and also JavaScript. And previously I was present an article is that “CRUD Operation by MySqli OOP way in PHP”. So Integrating with those two project with Ajax, I am trying to present in this article that is, client side live form validation using HTML5-CSS3-JavaScript for two form “General Information” and “Contact Information” and after completing the validation the data is passed by the Ajax form submit to store MySQL database using PHP user define function. So let’s gets started, 

## Installation

Clone the project from the Github repository and run your Webserver. Open the project the to web browser. 

## Architecture
Here, I want to present two pages form which one page contains “General Information” and another page contains “Contact Information”. Each page has a Client Side Form Validation by HTML5-CSS3 and JavaScript. After Successfully submitted “General Information” Form, Form data will be submitted by Ajax to catch submitted data by the PHP functions. Here I have used MySQL database to insert data by the PHP function. Here I have arranged PHP operation by the Object Oriented Procedure. Here you are no required to create any database and table by manually, because I have defined custom PHP functions that will be created database and table by only providing database name and table name

![Architecture](https://raw.githubusercontent.com/bdstar/Live-Form-validation-with-Ajax-Form-Submit-to-Database/main/images/1.png)

## HTML5 Form Design
The basic “General Info” form contains five input fields that is Name (text field), Email (Email field), Confirm Email (Email Field), Password (Password Field), Confirm Password(Password field) and at last one submit button. Following is the sample code segment of the “General Info” Form.

Another Form “Contact Info” contains three input fields, Address 1(text field), Address 2(text field), Phone(number field) and one dropdown list country field and at last a submit button.

![HTML5 Form Design](https://raw.githubusercontent.com/bdstar/Live-Form-validation-with-Ajax-Form-Submit-to-Database/main/images/2.png)

## Adding CSS3 for HTML5 Form

Here, inside the right end of the each required input field has red-asterisk and when input field is focus in the width will be expand is as following, 

![Adding CSS3 for HTML5 Form](https://raw.githubusercontent.com/bdstar/Live-Form-validation-with-Ajax-Form-Submit-to-Database/main/images/3.png)


## Adding HTML5-CSS3 Form Validation
For the client side form validation first I want to apply HTML5-CSS3 custom validation. When an input field is focus in then the text for the form_hint class will be suggest right side of the input field. Already CSS3 provides form validation selector like :invalid, :valid, :focus and so on. 

![Adding HTML5-CSS3 Form Validation](https://raw.githubusercontent.com/bdstar/Live-Form-validation-with-Ajax-Form-Submit-to-Database/main/images/4.png)

## Adding JavaScript Form Validation
Several JavaScript Form validation is applied for the each Form. If any input field input pattern is not correct or blank then that input field background color will be changed and a red color error message will be shown top of the Form after submit button click

![Architecture](https://raw.githubusercontent.com/bdstar/Live-Form-validation-with-Ajax-Form-Submit-to-Database/main/images/5.png)

## Ajax Form Submit

After successfully submitted “General Info” form, the all data will be passed through by ajax submit for the next server side process

```
var dataString = 'name1='+ name + '&email1=' + email+ '&cemail1='+ confirm_email + '&password1='+ password + '&cpassword1='+ confirm_password;
{
// AJAX Code To Submit Form.
$.ajax({
	type: "POST",
	url: "ajax_general_info_submit.php",
	data: dataString,
	cache: false,
	success: function(result){
	document.getElementById('warning-message').innerHTML = '<div class="worning-text" style="color:green;">Data Inserted successfully</div>';
	window.setTimeout(function() {
		window.location.href = 'contact_info.html';
		}, 500);
	}
	});
}
```

## MySQL Database Connection by PHP 
All objects can have a special built-in method called a 'constructor'. Constructors allow you to initialize your object's properties when you instantiate an object. If you create a __construct(); on the execution PHP will automatically call the __construct() when you create an object from your class.

To connect the MySQLi server I want to call a constructor method. Following I have create an object name $obj where is send four arguments those are hostname as localhost, username as root, database password as blank and database name is “info”.

```
$SERVER_NAME = "localhost";
$USERNAME = "root";
$PASSWORD = "";
$DATABASE_NAME = "info";

// Create Connection
$obj = new Database($SERVER_NAME,$USERNAME,$PASSWORD,$DATABASE_NAME);
```

Here I have create an __construct() inside the Database class that accept four arguments; such as hostname, username of the database, password for the database and name of the database

```
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
```

## Table Creation

To create the table within the database using the query, you should be assigned table name. Here I have used table name “general_info”. Make sure there is no table that you select as $tablename.
```
// Assign table for General Info
$tablename = "general_info";
```

Before write the query to create the table make sure how many fields Is required and what‘s type of data will be content within each field. Here I have created a table name “general_info” and which has three fields ID, Name, email, Confirm Email(cemail), Password, Confirm Password(cpassword) . Without ID field all fields are containing string data. Here ID field is assign as a primary key and that will be auto increment.

```
// Create table query 
$CreateTableSql = "CREATE TABLE $tablename(ID INT(10) NOT NULL AUTO_INCREMENT, Name VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, cemail VARCHAR(100) NOT NULL,  password VARCHAR(100) NOT NULL,  cpassword VARCHAR(100) NOT NULL,  PRIMARY KEY (`ID`) ) COLLATE='latin1_swedish_ci' ENGINE=InnoDB ROW_FORMAT=DEFAULT"; 
```

Here, mysqli_query() perform queries against the database to create table within the database. If table is created successfully then “Table has been created successfully” is shown or else an error is thrown that to creating table.</

```
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
```

## Insert Operation
After a database and a table have been created, we can start adding data in them. To insert data into the table, I have assigned an associative array which array index is table column and value is data for the table column.

Here are some syntax rules to follow for the value of associative array:
* String values must be quoted
* Numeric values must not be quoted
* The word NULL must not be quoted

Like as, Name field is declared as string so its corresponding value must be quoted and ID field is declare as integer so its corresponding value must not be quoted.

```
//Associative array for insert function
$InsColumnVal = array("Name"=>$name,"email"=>$email,"cemail"=>$cemail,"password"=>$password,"cpassword"=>$cpassword);
```
Now time to call insert method which accept two argument one is table name ($tablename) and other is associative array ($InsColumnVal) that you declared previous.

```
//Call insert function to insert record
$obj->insert($tablename, $InsColumnVal);
```

## Connection Release

Although PHP automatically closes mysqli connection upon script termination, Instead of you want to close the connection just before script is complete, you can do so by just invoking the destructor method. But destructor method automatically invoked when the object is destroyed or its lifetime is bound to scope and the execution leaves the scope.

In this destructor method mysqli_close() function is call which closes a previously opened database connection.

```
//Call destructor function 
	public function __destruct() {
		if($this->connection){
			// Close the connection
        	$this->connection->close();
        	echo "Connection is release";
        }	
}
```

## Conclusion
It is really important for a real time project for a Form that should have server-side validation. But in this project the server side form validation is not present. That’s why you should not use it for any real life project. I will try to present server side validation Form validation next time. So have a good coding for you…:)

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
<!DOCTYPE html>
<html>
<head>
<title>FieryPatient</title>
<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
<div class="container">
	<h1>Register</h1>
	<form action="" method="post">
		<label>Username</label> 
		<input type="text" name="username" id="username" autofocus/>
		<label>Password </label>
		<input type="password" name="password" id="password"/><br/>
		<label>FirstName</label> 
		<input type="text" name="firstname" id="firstname" autofocus/>
		<label>LastName</label> 
		<input type="text" name="lastname" id="lastname" autofocus/>

		<input type="submit" class="button" value="Register"/> 
	</form>	
</div>
</body>
</html>

<?php
if(isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["username"]) && isset($_POST["password"])){
	register();
}

function register(){
	
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fierypatientdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$conn->autocommit(TRUE);

$stmt = $conn->prepare("INSERT INTO users (FirstName, LastName, UserName, Password) VALUES ( ?, ?, ?, ?)");

// set parameters and execute
$FirstName = $_POST["firstname"];
$LastName = $_POST["lastname"];
$User = $_POST["username"];
$Pass = $_POST["password"];

if(!$stmt->bind_param("ssss",$FirstName, $LastName, $User, $Pass )){
	echo "binding failed";
}

var_dump($_POST);

if (!$stmt->execute()) {
   echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}else{
	
echo "New records created successfully";

}
	



$stmt->close();
$conn->close();

}
?>
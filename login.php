<?php
require_once 'database.php';
require_once 'config.php';

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if( isset( $_POST['login'] ) ) {
	$user = $_POST['uname'];
	$user = stripslashes($user);  //remove /
	
	$pass = $_POST['psw'];
	$pass = stripslashes($pass);
	$pass = $pass . md5($user); // add salt with user name
	$pass = hash('sha256', $pass); //hasing
	
	$db = new Database();
	$conn = $db->Connect();
	
	if(!$stmt = $conn->prepare("SELECT * FROM `users` WHERE UserName=? AND Password=?;")){
		echo 'binding error';
	}
	
	if(!$stmt->bind_param("ss",$user, $pass )){
		echo "binding failed";
	}

	if (!$stmt->execute()) {
	   echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	
	$result = $stmt->get_result();
	
	if($result->num_rows == 1){
		//user found
		while($row = $result->fetch_assoc()) {
			$_SESSION['User'] = $row;
		}
		$_SESSION['logintry'] = 0;
	} else {
		if(!isset($_SESSION['logintry'])){
			$_SESSION['logintry'] = 0;
		}
		$_SESSION['logintry'] = $_SESSION['logintry'] + 1;
		sleep($_SESSION['logintry']);
		echo "login failed " . $_SESSION['logintry'];
	}
	
	$stmt->close();
	$db->Close();
	
	//redirect
	if(isset($_SESSION['User'])){
		if($_SESSION['User']['IsDoctor']){
			header( "Location: doctor.php" );
		} else {
			header( "Location: patient.php" );
		}
		exit;
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<title>login</title>
<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
<div class="container">
	<span><a href="./logout.php">loguit</a></span>
	<h1>Login</h1>
	<form action="" method="post">
		<label for="uname"><b>Username</b></label>
		<input type="text" placeholder="Enter Username" name="uname" required>

		<label for="psw"><b>Password</b></label>
		<input type="password" placeholder="Enter Password" name="psw" required>

		<input type="submit" class="button" value="Login" name="login"/>
	</form>
	<span><a href="./register.php">register</a></span>
</div>
</body>
</html>
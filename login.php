<?php
require_once 'database.php';

if( isset( $_POST['login'] ) ) {
	$user = $_POST['uname'];
	$user = stripslashes($user);  //remove /
	
	$pass = $_POST['psw'];
	$pass = stripslashes($pass);
	$pass = hash('sha256', $_POST['psw']); //hasing
	
	$db = new Database();
	$conn = $db->Connect();
	
	if(!$stmt = $conn->prepare("SELECT * FROM `users` WHERE UserName=? AND Password=?;")){
	var_dump($stmt);
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
		session_start();
		while($row = $result->fetch_assoc()) {
			var_dump($row);
			$_SESSION['User'] = $row;
		}
	}else{
		die("user not found");
	}
	
	$stmt->close();
	$db->Close();
	
	//redirect
	if(isset($_SESSION['User'])){
		header( "Location: index.php" );
		exit;
	}
}

?>

<?php if(!isset( $_POST[ 'Login' ] )) :?>
<!DOCTYPE html>
<html>
<head>
<title>login</title>
<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
<div class="container">
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
<?php endif; ?>
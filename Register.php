<?php
require_once 'database.php';

if(isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["username"]) && isset($_POST["password"])){
	//check strong  pass
	$passerror = "";
	if(strlen($_POST['password']) < 8) {
        $passerror .= "Password too short! <br>";
    }
    if(!preg_match("#[0-9]+#", $_POST['password'])) {
        $passerror .= "Password must include at least one number!<br>";
    }
    if(!preg_match("#[a-zA-Z]+#", $_POST['password'])) {
        $passerror .= "Password must include at least one letter!<br>";
    }
	if(strlen($_POST["username"]) < 6){
		$passerror .= "Username is too short!<br>";
	}
	
	if($passerror == ""){
		$db = new Database();
		$conn = $db->Connect();

		$stmt = $conn->prepare("INSERT INTO users (FirstName, LastName, UserName, Password) VALUES ( ?, ?, ?, ?);");

		// set parameters and execute
		$FirstName = $_POST["firstname"];
		$LastName = $_POST["lastname"];
		$User = $_POST["username"];
		
		$Pass = $_POST['password'] . md5($User); // add salt with user name
		$Pass = hash('sha256', $Pass); //hasing

		if(!$stmt->bind_param("ssss",$FirstName, $LastName, $User, $Pass )){
			echo "binding failed";
		}

		if (!$stmt->execute()) {
		   echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		$stmt->close();
		$conn->close();
		
		header( "Location: login.php" );
		exit;
	}
}

?>

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
		<?php if(isset($passerror)):?>
		<span><?php echo $passerror;?></span>
		<?php endif;?>
	</form>	
	<span><a href="./login.php">login</a></span>
</div>
</body>
</html>
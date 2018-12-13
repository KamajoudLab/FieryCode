<?php
require_once 'database.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['User'])){
	if($_SESSION['User']['IsDoctor'] == true){
		//check user
		$db = new Database();
		$conn = $db->Connect();

		if(isset($_POST["Topic"]) && 
			isset($_POST["Diagnose"]) && 
			isset($_POST["Medicine"]) && 
			isset($_REQUEST["id"])){
				
				$db = new Database();
				$conn = $db->Connect();

				$stmt = $conn->prepare("INSERT INTO patientfile (Date, Topic, Diagnose, Medicine, PatientId, DoctorId) VALUES ( NOW(), ?, ?, ?, ?, ?);");

				// set parameters and execute				
				$Topic = $_POST["Topic"];
				$Diagnose = $_POST["Diagnose"];
				$Medicine = $_POST["Medicine"];
				$PatientId = $_REQUEST["id"];
				$DoctorId = $_SESSION['User']['Id'];

				if(!$stmt->bind_param("sssii", $Topic, $Diagnose, $Medicine, $PatientId, $DoctorId )){
					echo "binding failed";
				}

				if (!$stmt->execute()) {
				   echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
				} else {
					header( "Location: doctor.php" );
				}

				$stmt->close();
				$conn->close();
		}
	}
}else {
	header( "Location: index.php" );
	exit;
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
	<span><a href="./logout.php">loguit</a></span>
	<h1>Patient Info</h1>
	<form action="" method="post">
		<label>Topic </label>
		<input type="text" name="Topic" id="Topic"/><br/>
		<label>Diagnose</label> 
		<input type="text" name="Diagnose" id="Diagnose" autofocus/>
		<label>Medicine</label> 
		<input type="text" name="Medicine" id="Medicine" autofocus/>
		
		<input type="submit" class="button" value="Opslaan"/>	
	</form>	
	<span><a href="./patient.php">terug naar patienten</a></span>
</div>
</body>
</html>
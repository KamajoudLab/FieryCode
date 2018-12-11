<?php
require_once 'database.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['User'])){
	//check user
	$id = $_SESSION['User']['Id'];
	$db = new Database();
	$conn = $db->Connect();
	
	if(!$stmt = $conn->prepare("SELECT * FROM `patients` WHERE `UserId` = ?")){
		echo 'binding error';
		 echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	
	if(!$stmt->bind_param('i', $id)){
		echo "binding failed";
	}

	if (!$stmt->execute()) {
	   echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	
	$result = $stmt->get_result();
	
	if($result->num_rows == 1){
		//user found
		while($row = $result->fetch_assoc()) {
			$patient = $row;
		}
	}
	
	$stmt->close();
	$db->Close();
	
} else {
	header( "Location: index.php" );
	exit;
}

?>

<!DOCTYPE html>
<html>
<head>
<title>patient</title>
<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
<div class="container">
	<h1>patient dossier</h1>
	<?php if(isset($patient)):?>
		<ul>
			<li>voornaam: <?php echo $patient['Firstname'] ?></li>
			<li>achternaam: <?php echo $patient['Lastname'] ?></li>
			<li>geboorte: <?php echo $patient['Birth'] ?></li>
			<li>geslacht: <?php echo $patient['Gender'] ?></li>
		</ul>
	<?php endif;?>
</div>
</body>
</html>
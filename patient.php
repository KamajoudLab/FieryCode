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
	
	//patient data
	if(!$stmt = $conn->prepare("SELECT * FROM `patients` WHERE `UserId` = ?")){
		echo 'sql error';
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
			//add session info
			$patient['FirstName'] = $_SESSION['User']['FirstName'];
			$patient['LastName'] = $_SESSION['User']['LastName'];
		}
	} else{
		echo 'patient niet gevonden';
	}
	
	if(isset($patient)){
		//patient file
		if(!$stmt = $conn->prepare("SELECT * FROM `patientfile` WHERE `PatientId` = ?")){
			echo 'sql error';
		}
		
		if(!$stmt->bind_param('i', $patient['Id'])){
			echo "binding failed";
		}

		if (!$stmt->execute()) {
		   echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		
		$result2 = $stmt->get_result();
		
		if($result2->num_rows >= 1){
			$patientFile = array();
			while($row = $result2->fetch_assoc()) {
				array_push($patientFile, $row);
			}
		} else{
			echo 'patient file niet gevonden';
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
	<span><a href="./logout.php">loguit</a></span>
	<h1>patient dossier</h1>
	<h3>Gegevens</h3>
	<?php if(isset($patient)):?>
		<ul>
			<li>voornaam: <?php echo $patient['FirstName']; ?></li>
			<li>achternaam: <?php echo $patient['FirstName']; ?></li>
			<li>geboorte: <?php echo $patient['Birth']; ?></li>
			<li>geslacht: <?php echo $patient['Gender']; ?></li>
		</ul>
	<?php endif;?>
	<hr>
	<h3>Dossier</h3>
	<table>
  <tr>
    <th>Datum</th>
    <th>Onderwerp</th>
    <th>Diagnose</th>
    <th>Medicijn</th>
  </tr>
	<?php if(isset($patientFile)):?>
		<?php foreach($patientFile as $a):?>
		<tr>
			<td><?php echo $a['Date']; ?></td>
			<td><?php echo $a['Topic']; ?></td>
			<td><?php echo $a['Diagnose']; ?></td>
			<td><?php echo $a['Medicine']; ?></td>
		</tr>
		<?php endforeach;?>
	<?php endif;?>
</div>
</body>
</html>
<?php
require_once 'database.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['User'])){
	if($_SESSION['User']['IsDoctor'] == true){
		//check user
		$id = $_SESSION['User']['Id'];
		$db = new Database();
		$conn = $db->Connect();
		
		//doc data
		if(!$stmt = $conn->prepare("SELECT * FROM `doctors` WHERE `UserId` = ?")){
			echo 'binding error';
		}
		
		if(!$stmt->bind_param('i', $id)){
			echo "binding failed";
		}

		if (!$stmt->execute()) {
		   echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		
		$result = $stmt->get_result();
		
		if($result->num_rows == 1){
			while($row = $result->fetch_assoc()) {
				$doc = $row;
			}
		}
		
		//patient select 
		if(!$stmt = $conn->prepare("SELECT * FROM `patients`")){
			echo 'prepare fail patients';
		}

		if (!$stmt->execute()) {
		   echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		
		$result = $stmt->get_result();
		
		if($result->num_rows >= 1){
			$patients = array();
			while($row = $result->fetch_assoc()) {
				array_push($patients, $row);
			}
		}
		
		$stmt->close();
		$db->Close();
	}
} else {
	header( "Location: index.php" );
	exit;
}

?>

<!DOCTYPE html>
<html>
<head>
<title>dokter</title>
<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
<div class="container">
	<span><a href="./logout.php">loguit</a></span>
	<h1>welkom doc</h1>
	<?php if(isset($doc)):?>
		<ul>
			<li>voornaam: <?php echo $doc['Firstname'] ?></li>
			<li>achternaam: <?php echo $doc['Lastname'] ?></li>
			<li>functie: <?php echo $doc['Funtion'] ?></li>
		</ul>
	<?php endif;?>
	
	<h3>Patienten</h3>
	<?php if(isset($patients)):?>
		<?php foreach($patients as $p):?>
		<ul>
			<li>
				<a href="./patient.php?id=<?php echo $p['Id'];?>">
					<?php echo $p['Firstname'] . ' ' . $p['Lastname']; ?>
				</a>
			</li>
		</ul>
		<?php endforeach;?>
	<?php endif;?>
</div>
</body>
</html>
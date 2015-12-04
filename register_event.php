<?php 
	include_once("database/connection.php");
	session_start();
	$event_id = trim($_GET['id']);
	$redirectUrl = 'event_page.php?id='.$event_id.'#signin';
	$stmt = $db->prepare("SELECT idUser FROM Events WHERE idEvent = :eID");
	$stmt->bindParam(':eID', $event_id);
	$stmt->execute();
	$result = $stmt->fetch();
	
	if($result['idUser'] = $_SESSION['id_user']){
		echo '<script type="application/javascript">alert("You are this event\'s owner!"); window.location.href = "'.$redirectUrl.'";</script>';
		exit();
	}
	$stmt1 = $db->prepare("SELECT idUser FROM Registers WHERE idEvent = :eID AND idUser = :uID");
	$stmt1->bindParam(':eID', $event_id);
	$stmt1->bindParam(':uID', $_SESSION['id_user']);
	$stmt1->execute();
	$result1 = $stmt1->fetch();
	if (empty($result1) == false){
		//echo ' not empty';
		echo '<script type="application/javascript">alert("You are already registered in this event!"); window.location.href = "'.$redirectUrl.'";</script>';
		exit();
	}
	$stmt2 = $db->prepare("INSERT INTO Registers(idUser, idEvent) VALUES (:uID, :eID)");
	$stmt2->bindParam(':eID', $event_id);
	$stmt2->bindParam(':uID', $_SESSION['id_user']);
	$stmt2->execute();
	echo '<script type="application/javascript">alert("You have successfully registered in this event!"); window.location.href = "'.$redirectUrl.'";</script>';
?>
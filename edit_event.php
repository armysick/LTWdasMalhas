<?php
	include_once("database/connection.php");
	session_start();
	if("" == trim($_POST['eid'])){
		$redirectUrl = 'manage_events.php';
		echo '<script type="application/javascript">alert("Please Insert your Event ID!"); window.location.href = "'.$redirectUrl.'";</script>';
		exit(0);
	}
		
	$Usid = $_SESSION['id_user'];
	$stmt1 = $db->prepare('SELECT * FROM Events WHERE idEvent = :idE LIMIT 1');
	$stmt1->bindParam(':idE', $_POST['eid']);
	$stmt1->execute();
	$result1 = $stmt1->fetch();
	//echo '-'.trim($_POST['nome']).'-';
                        	$prevdesc = $result1['description'];
							$prevtype = $result1['event_type'];
							$prevdate = $result1['event_date'];
							$prevplace = $result1['Place'];
	if("" == trim($_POST['description']))
		$Desc = $prevdesc;
	else
		$Desc = $_POST['description'];
	
	if("" == trim($_POST['type'])){
		$Etype = $prevtype;
	}
	else{
		$Etype = $_POST['type'];
	}
	
	
	if("" == trim($_POST['event_date']))
		$Date = $prevdate;
	else
		$Date = $_POST['event_date'];
	
	if("" == trim($_POST['place']))
		$Place = $prevplace;
	else
		$Place = $_POST['place'];
	
	echo 'here...->'.$_POST['eid'];
	$stmt =$db->prepare('UPDATE Events SET description = :desc, event_type = :etype, event_date = :edate, Place = :place WHERE idEvent = :ide');
	$stmt->bindParam(':desc',$Desc);
	$stmt->bindParam(':etype',$Etype);
	$stmt->bindParam(':edate',$Date);
	$stmt->bindParam(':place',$Place);
	$stmt->bindParam(':ide', $_POST['eid']);
	if($stmt->execute())
		echo success;
	//echo 'Registration successful!';
	//readfile("index.php");
	$redirectUrl = 'manage_events.php';
	
    echo '<script type="application/javascript">alert("Sucessfully Updated!"); window.location.href = "'.$redirectUrl.'";</script>';
?>
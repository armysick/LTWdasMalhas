<?php
	include_once("database/connection.php");
	include_once("templates/header_profile.php");
	
	session_start();
	
	// description  // event type // image_link // event_date // public
	// echo 'oi'.$_SESSION['login_user'].'poh';
	$User_id = $_SESSION['id_user'];
	$Description = $_POST['description'];
	$E_type= $_POST['e_type'];
	$Image_link = $_POST['image_link'];
	$E_date = $_POST['e_date'];
	$Public = $_POST['public'];
	if($Public == 1)
		$Public = true;
	else
		$Public = false;

	echo $User_id.$Description.$E_type.$Image_link.$E_date.$Public;

	$stmt =$db->prepare('INSERT INTO Events(idUser,description,event_type,image_link,event_date,public) VALUES(:userID,:description,:event_type,:image_link,:event_date,:public)');
	$stmt->bindParam(':userID',$User_id); //mais seguro com bindparam supostamente
	$stmt->bindParam(':description',$Description);
	$stmt->bindParam(':event_type',$E_type);
	$stmt->bindParam(':image_link',$Image_link);
	$stmt->bindParam(':event_date',$E_date);
	$stmt->bindParam(':public',$Public);
	$redirectUrl = 'profile.php';
	if($stmt->execute())
		echo '<script type="application/javascript">alert("New Event Sucessfully Created!"); window.location.href = "'.$redirectUrl.'";</script>';
	else
		echo '<script type="application/javascript">alert("Event Creation Error. Please check input values"); window.location.href = "'.$redirectUrl.'";</script>';
	
	

    
	
	include_once("templates/footer.php");
?>
<?php
    include_once("database/connection.php");
    session_start();
    if(isset($_SESSION['id_user'])){
        include_once("templates/header_profile.php");
    } else{
        header('Location: index.php');
    }

    $event_id_page = $_GET["event_id"];
    
    echo'<script language="javascript">';
	echo 'confirm("Are you sure you want to delete this event?")';
	echo '</script>';
	
    $stmt =$db->prepare('DELETE FROM Events WHERE idEvent= :id_event');
    $stmt->bindParam(':id_event',$event_id_page);
    $stmt->execute();
    $redirectUrl = 'manage_events.php';
	echo '<script type="application/javascript">window.location.href = "'.$redirectUrl.'";</script>';
?>
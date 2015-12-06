<?php
    include_once("database/connection.php");
    session_start();
    if(isset($_SESSION['id_user'])){
        include_once("templates/header_profile.php");
    } else{
        header('Location: index.php');
    }

    $event_id_page = $_GET["event_id"];
	
    $stmt =$db->prepare('DELETE FROM Events WHERE idEvent= :id_event');
    $stmt->bindParam(':id_event',$event_id_page);
    $stmt->execute();
    if($_SESSION['admin']){
        $redirectUrl = 'manage_events_admin.php';
    }else{
        $redirectUrl = 'manage_events.php';
    }
    //$redirectUrl = 'manage_events.php';
	echo '<script type="application/javascript">window.location.href = "'.$redirectUrl.'";</script>';
?>
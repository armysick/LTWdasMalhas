<?php
    include_once("database/connection.php");
    session_start();
    if(isset($_SESSION['admin'])){
        include_once("templates/header_profile.php");
    } else{
        header('Location: index.php');
    }

    $user_id = $_GET["user_id"];
	
    $stmt =$db->prepare('DELETE FROM Users WHERE idUser= :id'); //delete user from table Users
    $stmt->bindParam(':id',$user_id);
    $stmt->execute();
    $stmt1 =$db->prepare('DELETE FROM Events WHERE idUser= :id'); //delete all user events
    $stmt1->bindParam(':id',$user_id);
    $stmt1->execute();
    $stmt2 =$db->prepare('DELETE FROM comments WHERE idUser= :id'); //delete all user comments
    $stmt2->bindParam(':id',$user_id);
    $stmt2->execute();
    $stmt3 =$db->prepare('DELETE FROM Registers WHERE idUser= :id'); //delete all user registers
    $stmt3->bindParam(':id',$user_id);
    $stmt3->execute();

    $redirectUrl = 'manage_users.php';
	echo '<script type="application/javascript">window.location.href = "'.$redirectUrl.'";</script>';
?>
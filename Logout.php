<?php
	session_start();
	unset($_SESSION['id_user']);
	unset($_SESSION['login_user']);
	
	session_destroy();
	
	
	
	header("Location: index.php");

?>

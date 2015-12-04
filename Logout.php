<?php

	session_destroy();
	
	unset($_SESSION['id_user']);

	unset($_SESSION['login_user']);
	
	header("Location: index.php");

?>

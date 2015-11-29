<?php
	session_start(); //starts the session
	include_once("database/connection.php");
	$error=''; // Variable To Store Error Message
	
		if (empty($_POST['user']) || empty($_POST['pass'])) {
			echo'<script language="javascript">';
			echo 'alert("Incorrect username and/or password.")';
			echo '</script>';
			$redirectUrl = 'index.php';
			echo '<script type="application/javascript"> window.location.href = "'.$redirectUrl.'";</script>';
		}
		else
		{
			// Define $username and $password
			echo 'ola2';
			$username=$_POST['user'];
			$password=$_POST['pass'];
			$stmt =$db->prepare('SELECT password FROM Users WHERE username = :user LIMIT 1');
			$stmt->bindParam(':user', $username);
			$stmt->execute();
			$user = $stmt->fetch();
			echo'ola antes';
			/*$cost = 5;
			$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
			$salt = sprintf("$2a$%02d$", $cost) . $salt; // $2a$ means that we are using blowfish algorithm
			$hash = crypt($password, $salt);		
			*/
			// Hashing the password with its hash as the salt returns the same hash
			if(password_verify($password==$user['password'])){
				echo'ola sucess';
				$_SESSION['login_user'] = $username;            	// store the username
				echo'<script language="javascript">';
				echo 'alert("Correct username and/or password.")';
				echo '</script>';
				$redirectUrl = 'index.php';
				echo '<script type="application/javascript">window.location.href = "'.$redirectUrl.'";</script>';
				//header("location: index.php"); // Redirecting To Other Page
			} else {
				$error = "Username or Password is invalid";
				echo'ola not sucessful';
				echo'<script language="javascript">';
				echo 'alert("Incorrect username and/or password.")';
				echo '</script>';
				$redirectUrl = 'index.php';
				echo '<script type="application/javascript">window.location.href = "'.$redirectUrl.'";</script>';
 			}
		}
	echo'ola fim';
	
?>
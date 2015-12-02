<?php
	include_once("database/connection.php");
	

	if("" == trim($_POST['userName']))
		$User = $_SESSION['login_user'];
	else
		$User = $_POST['username'];
	
	$Pass = $_POST['password'];
	$Name= $_POST['name'];
	$Email = $_POST['email'];
	$Date = $_POST['date_of_birth'];

	$cost = 5;
	$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
	$salt = sprintf("$2a$%02d$", $cost) . $salt; // $2a$ means that we are using blowfish algorithm
	$hash = crypt($Pass, $salt);

	$stmt =$db->prepare('UPDATE Users SET username = :user, password = :pass, salt = :salt, nome = :name, email = :email, birth_date = :data WHERE idUser = :idUser');
	$stmt->bindParam(':user',$User); //mais seguro com bindparam supostamente
	$stmt->bindParam(':pass',$hash);
	$stmt->bindParam(':salt',$salt);
	$stmt->bindParam(':name',$Name);
	$stmt->bindParam(':email',$Email);
	$stmt->bindParam(':data',$Date);
	$stmt->execute();
	//echo 'Registration successful!';
	//readfile("index.php");
	$redirectUrl = 'profile.php';

    echo '<script type="application/javascript">alert("Sucessfully Updated!"); window.location.href = "'.$redirectUrl.'";</script>';
?>
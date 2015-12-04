<?php
	include_once("database/connection.php");
	

	$User = $_POST['username'];
	$Pass = $_POST['password'];
	$Name= $_POST['name'];
	$Email = $_POST['email'];
	$Date = $_POST['date_of_birth'];
	$Image="img/profile_default.jpg";
	$cost = 5;
	$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
	$salt = sprintf("$2a$%02d$", $cost) . $salt; // $2a$ means that we are using blowfish algorithm
	$hash = crypt($Pass, $salt);

	$stmt =$db->prepare('INSERT INTO Users(username,password,salt,nome,email,birth_date,imagesrc) VALUES(:user,:pass,:salt,:name,:email,:data,:image)');
	$stmt->bindParam(':user',$User); //mais seguro com bindparam supostamente
	$stmt->bindParam(':pass',$hash);
	$stmt->bindParam(':salt',$salt);
	$stmt->bindParam(':name',$Name);
	$stmt->bindParam(':email',$Email);
	$stmt->bindParam(':data',$Date);
	$stmt->bindParam(':image',$Image)
	$stmt->execute();
	//echo 'Registration successful!';
	//readfile("index.php");
	$redirectUrl = 'index.php';

    echo '<script type="application/javascript">alert("Registration successful!"); window.location.href = "'.$redirectUrl.'";</script>';
?>
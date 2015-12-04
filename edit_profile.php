<?php
	include_once("database/connection.php");
	session_start();
	$Usid = $_SESSION['id_user'];
	$stmt1 = $db->prepare('SELECT * FROM Users WHERE idUser = :idU LIMIT 1');
	$stmt1->bindParam(':idU', $Usid);
	$stmt1->execute();
	$result1 = $stmt1->fetch();
	//echo '-'.trim($_POST['nome']).'-';
                        	$prevpass = $result1['password'];
							$prevsalt = $result1['salt'];
							$prevnome = $result1['nome'];
							$prevemail = $result1['email'];
	if("" == trim($_POST['username']))
		$User = $_SESSION['login_user'];
	else
		$User = $_POST['username'];
	
	if("" == trim($_POST['password'])){
		$hash = $prevpass;
		$salt = $prevsalt;
	}
	else{
		$Pass = $_POST['password'];
		$cost = 5;
		$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
		$salt = sprintf("$2a$%02d$", $cost) . $salt; // $2a$ means that we are using blowfish algorithm
		$hash = crypt($Pass, $salt);
	}
	echo $_POST['date_of_birth'];
	if("" == trim($_POST['name']))
		$Name = $prevnome;
	else
		$Name = $_POST['name'];
	
	if("" == trim($_POST['email']))
		$Email = $prevemail;
	else
		$Email = $_POST['email'];
	
	
	if("" == trim($_POST['date_of_birth']))
		$Date = $result1['birth_date'];
	else
		$Date = $_POST['date_of_birth'];

	$stmt =$db->prepare('UPDATE Users SET password = :pass, salt = :salt, nome = :name, email = :email, birth_date = :data WHERE idUser = :idUser');
	$stmt->bindParam(':idUser', $_SESSION['id_user']); //mais seguro com bindparam supostamente
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
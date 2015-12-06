<?php
    include_once("database/connection.php");


function gerarSenha($tamanho=9, $forca=0) {
	$vogais = 'aeiou';
	$consoantes = 'bdghjkmnpqrstvwxyz';
	if ($forca >= 1) {
		$consoantes .= 'BDGHJKLMNPQRSTVWXYZ';
	}
	if ($forca >= 2) {
		$vogais .= "AEIOU";
	}
	if ($forca >= 4) {
		$consoantes .= '123456789';
	}
	if ($forca >= 8 ) {
		$vogais .= '@#$%';
	}
 
	$senha = '';
	$alt = time() % 2;
	for ($i = 0; $i < $tamanho; $i++) {
		if ($alt == 1) {
			$senha .= $consoantes[(rand() % strlen($consoantes))];
			$alt = 0;
		} else {
			$senha .= $vogais[(rand() % strlen($vogais))];
			$alt = 1;
		}
	}
	return $senha;
}

$email=$_POST['email'];


$stmt1 = $db->prepare("SELECT idUser FROM Users WHERE email = :email");
	$stmt1->bindParam(':email', $email);
	$stmt1->execute();
	$result1 = $stmt1->fetch();
	if (!empty($result1)){
	$pass=gerarSenha();
	
	$cost = 5;
	$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
	$salt = sprintf("$2a$%02d$", $cost) . $salt; // $2a$ means that we are using blowfish algorithm
	$hash = crypt($pass, $salt);

	$stmt =$db->prepare('UPDATE Users SET password = :pass , salt =:salt WHERE email = :email1');
	$stmt->bindParam(':email1', $email);
	$stmt->bindParam(':pass', $hash);
	$stmt->bindParam(':salt', $salt);
	$stmt->execute();
	
					$message = "A sua nova palavra passe é esta:  ".$pass." tente iniciar sessão com a nova palavra passe.";
                    $from = 'From: Manage My Event';
                    $to = $email;
                    $subject = 'Password Reset';
    
                    $body = "De: Manage my events \n Mensagem:\n $message";
                    //mail(($to, $subject, $body, $from));
					
                    if (isset($_POST['submit'])) {
						
                        if (mail ($to, $subject, $body, $from)) {
							
                            echo '<script language="javascript">';
							echo 'alert("message successfully sent")';
							echo '</script>';
                        } else {
                            echo '<script language="javascript">';
							echo 'alert("An error has occured! Please try again later")';
							echo '</script>';
                        }
    
                    }


	 $redirectUrl = 'index.php';
     echo '<script type="application/javascript">window.location.href = "'.$redirectUrl.'";</script>';


	}
	else{

	$redirectUrl = 'index.php';
    echo '<script type="application/javascript">alert("this email does not exist, you cant fool me!");window.location.href = "'.$redirectUrl.'";</script>';


	}
 ?>
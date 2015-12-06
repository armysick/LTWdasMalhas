<?php
    include_once("database/connection.php");
    session_start();
    if(isset($_SESSION['id_user'])){
        include_once("templates/header_profile.php");
    } else{
        
        header('Location: index.php');
    }
	
	session_start();
	
	// description  // event type // image_link // event_date // public
	// echo 'oi'.$_SESSION['login_user'].'poh';
	$User_id = $_SESSION['id_user'];
	$Description = $_POST['description'];
	$E_type= $_POST['e_type'];
	
	$target_dir = "img/";
	$target_file = $target_dir . basename($_FILES["image_link"]["name"]);
	$uploadOk = 1;
	$stringerror;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image_link"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $stringerror = "File is not an image.";
        $uploadOk = 0;
    }
}

// Check file size
if ($_FILES["image_link"]["size"] > 5000000) {
    $stringerror=$stringerror."Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $stringerror = $stringerror."Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $stringerror = $stringerror."Sorry, your file was not uploaded.";
    $redirectUrl = 'profile.php';
    echo '<script type="application/javascript">alert("Failed to Upload");window.location.href = "'.$redirectUrl.'";</script>';
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image_link"]["tmp_name"], $target_file)) {
        
    } else {
        $redirectUrl = 'profile.php';
        echo '<script type="application/javascript">alert("There was an error uploading your file try again");window.location.href = "'.$redirectUrl.'";</script>';
    }
}

	$E_date = $_POST['e_date'];
	$Public = $_POST['public'];
	if($Public == 1)
		$Public = true;
	else
		$Public = false;

	//echo $User_id.$Description.$E_type.$Image_link.$E_date.$Public;

	$stmt =$db->prepare('INSERT INTO Events(idUser,description,event_type,image_link,event_date,public) VALUES(:userID,:description,:event_type,:image_link,:event_date,:public)');
	$stmt->bindParam(':userID',$User_id); //mais seguro com bindparam supostamente
	$stmt->bindParam(':description',$Description);
	$stmt->bindParam(':event_type',$E_type);
	$stmt->bindParam(':image_link',$target_file);
	$stmt->bindParam(':event_date',$E_date);
	$stmt->bindParam(':public',$Public);
	$redirectUrl = 'profile.php';
	
	$stmt2 = $db->prepare('SELECT idEvent FROM Events WHERE idUser = :userID AND description = :description AND event_type = :event_type AND image_link = :image_link AND event_date = :event_date AND public = :public');
	$stmt2->bindParam(':userID',$User_id); //mais seguro com bindparam supostamente
	$stmt2->bindParam(':description',$Description);
	$stmt2->bindParam(':event_type',$E_type);
	$stmt2->bindParam(':image_link',$target_file);
	$stmt2->bindParam(':event_date',$E_date);
	$stmt2->bindParam(':public',$Public);	
	if($stmt->execute()){
		if($Public){
		$stmt2->execute();
		$idEve = $stmt2->fetch();
		
		$file = 'links.xml';
		
		$xml = simplexml_load_file($file);
		$xmlFormat = $xml->asXML();

		//$pages = $xml->pages;
		
		$link_new = $xml->addChild('link');
		
		$link_new->addChild('title', $Description);
		$str = '/event_page.php?id='.$idEve['idEvent'];
		$link_new->addChild('url', $str);
		$xmlFormat = $xml->asXML();
		$xml->asXML($file);
	}
		echo '<script type="application/javascript">alert("New Event Sucessfully Created!"); window.location.href = "'.$redirectUrl.'";</script>';
		/*$dom = dom_import_simplexml($xml)->ownerDocument;
		$dom->formatOutput = true;
		echo $dom->saveXML();*/
	}
	else
		echo '<script type="application/javascript">alert("Event Creation Error. Please check input values"); window.location.href = "'.$redirectUrl.'";</script>';
	
	

    
	
	include_once("templates/footer.php");
?>
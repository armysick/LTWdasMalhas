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
	$Image_link = $_POST['image_link'];
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
	$stmt->bindParam(':image_link',$Image_link);
	$stmt->bindParam(':event_date',$E_date);
	$stmt->bindParam(':public',$Public);
	$redirectUrl = 'profile.php';
	
	$stmt2 = $db->prepare('SELECT idEvent FROM Events WHERE idUser = :userID AND description = :description AND event_type = :event_type AND image_link = :image_link AND event_date = :event_date AND public = :public');
	$stmt2->bindParam(':userID',$User_id); //mais seguro com bindparam supostamente
	$stmt2->bindParam(':description',$Description);
	$stmt2->bindParam(':event_type',$E_type);
	$stmt2->bindParam(':image_link',$Image_link);
	$stmt2->bindParam(':event_date',$E_date);
	$stmt2->bindParam(':public',$Public);	
	if($stmt->execute()){
		$stmt2->execute();
		$idEve = $stmt2->fetch();
		
		$file = 'AJAXSearch/links.xml';
		if (file_exists($file)){
			echo 'O FICHEIRO EXISTE!';
		}
		$xml = simplexml_load_file($file);
		$xmlFormat = $xml->asXML();
echo '<u><b>This is the xml code from test2.xml:</b></u>
     <br /><br />
     <pre>' . htmlentities($xmlFormat, ENT_COMPAT | ENT_HTML401, "ISO-8859-1") . '</pre><br /><br />';
		//$pages = $xml->pages;
		
		$link_new = $xml->addChild('link');
		
		$link_new->addChild('title', $Description);
		$str = '/event_page.php?id='.$idEve['idEvent'];
		$link_new->addChild('url', $str);
		$xmlFormat = $xml->asXML();
		$xml->asXML($file);
		echo '<u><b>This is the xml code from test2.xml with new elements added:</b></u>
     <br /><br />
     <pre>' . htmlentities($xmlFormat, ENT_COMPAT | ENT_HTML401, "ISO-8859-1") . '</pre>';

		echo '<script type="application/javascript">alert("New Event Sucessfully Created!"); window.location.href = "'.$redirectUrl.'";</script>';
		/*$dom = dom_import_simplexml($xml)->ownerDocument;
		$dom->formatOutput = true;
		echo $dom->saveXML();*/
	}
	else
		echo '<script type="application/javascript">alert("Event Creation Error. Please check input values"); window.location.href = "'.$redirectUrl.'";</script>';
	
	

    
	
	include_once("templates/footer.php");
?>
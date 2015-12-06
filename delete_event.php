<?php
    include_once("database/connection.php");
    session_start();
    if(isset($_SESSION['id_user'])){
        include_once("templates/header_profile.php");
    } else{
        header('Location: index.php');
    }

    $event_id_page = $_GET["event_id"];
	
	$stmtd = $db->prepare('SELECT description FROM Events WHERE idEvent = :id_event');
	$stmtd->bindParam(':id_event', $event_id_page);
	$stmtd->execute();
	$ev_description = $stmtd->fetch();
	
	
    $stmt =$db->prepare('DELETE FROM Events WHERE idEvent= :id_event');
    $stmt->bindParam(':id_event',$event_id_page);
    $stmt->execute();
	
	// Remove XML element
	
	
		$file = 'links.xml';
		
		$xml = simplexml_load_file($file);
		$xmlFormat = $xml->asXML();
		foreach ($xml as $links) {
			// debug echo '<br><br\>';
			// debug echo $links->title;
			if ($links->title == $ev_description['description']) {
				$dom = dom_import_simplexml($links);
				$dom->parentNode->removeChild($dom);
				$fp = fopen("links.xml","wb");
				fwrite($fp,$xml->asXML());
				fclose($fp);
			}
		}
		
		//REMOVE All REgisters from Event
	$stmtreg = $db->prepare('SELECT idRegister FROM Registers WHERE idEvent = :id_event');
	$stmtreg->bindParam(':id_event',$event_id_page);
	$stmtreg->execute();
	$stmtreg->fetch();
	foreach ($stmtreg as $res){
		$stmtrem=$db->prepare('DELETE FROM Registers WHERE idRegister = :id_register');
		$stmtrem->bindParam(':id_register', $res['idRegister']);
		$stmtrem->execute();
	}
	
	//REMOVE All Comments from Event
	$stmtcom = $db->prepare('SELECT idComment FROM Comments WHERE idEvent = :id_event');
	$stmtcom->bindParam(':id_event',$event_id_page);
	$stmtcom->execute();
	$stmtcom->fetch();
	foreach ($stmtcom as $resc){
		$stmtremc=$db->prepare('DELETE FROM Comments WHERE idComment = :id_comment');
		$stmtremc->bindParam(':id_comment', $resc['idComment']);
		$stmtremc->execute();
	}
	
    if($_SESSION['admin']){
        $redirectUrl = 'manage_events_admin.php';
    }else{
        $redirectUrl = 'manage_events.php';
    }
    //$redirectUrl = 'manage_events.php';
	echo '<script type="application/javascript">window.location.href = "'.$redirectUrl.'";</script>';
?>
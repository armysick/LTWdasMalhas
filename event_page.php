<?php
	include_once("database/connection.php");
	include_once("templates/header_profile.php");
?>
<div class="mainContent">
    	<div class="content">
        	<article class="topcontent" id="homeSection">
            	<header>
                	<h2><a href="#" title="Title">Event Page</a></h2>
                </header>
                


                <content>
                	<div class="bigpix">
                	<?php
                		session_start();
						$username = $_SESSION['login_user']; 
						echo'<h3>';
						echo '<a href="#">'.$username.'</a>';
						echo'</h3>';
						$event_id_page = $_GET["id"];
						$stmt =$db->prepare('SELECT image_link FROM Events WHERE idEvent =:id');
						$stmt->bindParam(':id', $event_id_page);
						$stmt->execute();
						$result = $stmt->fetch();
						echo '<div class="image">';
                        echo '<img src="'.$result['image_link'].'" alt="" width="430" height="250" />'.'</div>';
                        
						?>
                	</div>
                	</br>
					<div class="information">
						<?php
							$stmt2 =$db->prepare('SELECT * FROM Events WHERE idEvent =:id');
							$stmt2->bindParam(':id', $event_id_page);
							$stmt2->execute();
							$result2 = $stmt2->fetchAll();
							foreach($result2 as $row){
								echo '<tr>';
                            	echo '<td>'.'Description: '.$row['description'].'</td>';
                            	echo'<br>';
                            	echo '<td>'.'Cateogory: '.$row['event_type'].'</td>';
                            	echo'<br>';
                            	echo '<td>'.'Date: '.$row['event_date'].'</td>';
                            	echo '</tr>';
                            }
						?>
						
						<ul class="menu">
							<li class="signin" id="signin"><!--<a href="register_event.php">Register in this event--><form method="get" action="register_event.php">
							<input type="hidden" name="id" value="<?php echo $_GET['id'] ?> ">
							<input type="submit" value = "Register in This Event">
							</form></a></li>
							<li class="signin"><a href="comment_event.php">Comment event</a></li><!--script to edit personal information-->
							<li class="signin"><a href="#">Manage your events</a></li><!--edit, delete, invite people, comment -->
							<li class="signin"><a href="AJAXSearch/search_event.php">Search Events</a></li><!--Event Search Page -->
						</ul>
						</ul>
						
						
                </content>
        </div>
    </div>
    <aside class="top-sidebar">
    	<article>
        	<h2>Recently Created Events</h2>
				<ul>
					<?php
						$user_id = $_SESSION['id_user'];
						$stmt =$db->prepare('SELECT * FROM Events WHERE idUser=:user');
						$stmt->bindParam(':user', $user_id);
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach( $result as $row) {
                        	$link = 'event_page.php?id='.$row['idEvent'];
                            echo '<li>' . '<a href="'.$link.'">'.$row['description'] . '</a>'.'</li>';
                        }
                        ?>
				</ul>
        </article>        
    </aside>
    
    <aside class="middle-sidebar">
    	<article>
        	<h2>Recent Comments</h2>
				<ul>
					<li><a href="#">Free CSS Templates</a> on <a href="#">Aliquam libero</a></li>
					<li><a href="#">Free CSS Templates</a> on <a href="#">Consectetuer adipiscing elit</a></li>
					<li><a href="#">Free CSS Templates</a> on <a href="#">Metus aliquam pellentesque</a></li>
					<li><a href="#">Free CSS Templates</a> on <a href="#">Suspendisse iaculis mauris</a></li>
					<li><a href="#">Free CSS Templates</a> on <a href="#">Urnanet non molestie semper</a></li>
					<li><a href="#">Free CSS Templates</a> on <a href="#">Proin gravida orci porttitor</a></li>
				</ul>
        </article>
        
    </aside>
    
    <aside class="bottom-sidebar">
    	<article>
        	<h2>Search</h2>
            <form method="get" action="">
				<fieldset>
					<legend>Search for Events</legend> <!--search only public events-->
					<input id="s" type="text" name="s" value="" />
					<input id="x" type="submit" value="Search" />
				</fieldset>
			</form>
        </article>
        
    </aside>





<?php
	include_once("templates/footer.php");
?>


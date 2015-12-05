<?php
    include_once("database/connection.php");
    session_start();
    if(isset($_SESSION['id_user'])){
        include_once("templates/header_profile.php");
    } else{
        include_once("templates/header.php");
    }
    $allowed=0;
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
						//echo'<h3>';
						//echo '<a href="#">'.$username.'</a>';
						//echo'</h3>';
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
						<?php 
                            $stmt3 =$db->prepare('SELECT public FROM Events WHERE idEvent=:id');
                            $stmt3->bindParam(':id', $event_id_page);
                            $stmt3->execute();
                            $result3= $stmt3->fetch();
                            if($result3['public']==1){

                        ?>
						<ul class="menu">
							<li class="signin" id="signin"><!--<a href="register_event.php">Register in this event--><form method="get" action="register_event.php">
							<input type="hidden" name="id" value="<?php echo $_GET['id'] ?> ">
							<input type="submit" value = "Register in This Event">
							</form></a></li>
							<!--<li class="signin"><a href="comment_event.php">Comment event</a></li>-->
							<li class="signin"><a href="manage_events.php">Manage your events</a></li><!--edit, delete, invite people -->
							<li class="signin"><a href="AJAXSearch/search_event.php">Search Events</a></li><!--Event Search Page -->
						</ul>
						</ul>
						<?php }
                        else { ?>
                        <ul class="menu">
                            <li class="invite" id="invite"><!--<a href="register_event.php">Register in this event--><form method="get" action="Invite_event.php">
                            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?> ">
                            <input type="submit" value = "Invite people to this event">
                            </form></a></li>
                            <!--<li class="signin"><a href="comment_event.php">Comment event</a></li>-->
                            <li class="signin"><a href="manage_events.php">Manage your events</a></li><!--edit, delete, invite people -->
                            <li class="signin"><a href="AJAXSearch/search_event.php">Search Events</a></li><!--Event Search Page -->
                        </ul>
                        </ul>


                        <?php } ?>
                            
                        </article>
                      
                        <article class="" id="contactSection">
                            <header>
                                <h2>Leave a comment...</h2>
                            </header>
                           
                                <form action="" method="POST" class="contact">
                                    <fieldset>
                                        <input type="text" name="name" placeholder="Your Name…" id="form_contact" tabindex="1" required >
                                    </fieldset>
                                    <fieldset>
                                        <input name="email" placeholder="Your Email Address" type="email" id="form_contact" tabindex="2" required>
                                    </fieldset>
                                    <fieldset>
                                        <input name="comment" placeholder="Your comment" type="textarea" id="form_contact" tabindex="3" required>
                                    </fieldset>
                                    <fieldset>
                                        <button name="submit" type="submit" value="submit" id="contact-submit">Submit</button>
                                    </fieldset>  
                                </form>
                         </article>
                            <?php
                                session_start();
                                $id_users = $_SESSION['id_user']; 
                                if($_POST['submit']){
                                    $stmt33 =$db->prepare('SELECT idUser FROM Events WHERE idEvent= :id_event_this');
                                    $stmt33->bindParam(':id_event_this', $event_id_page);
                                    $stmt33->execute();
                                    $result33 = $stmt33->fetch();
                                    if($result33 != $id_users){ //não é owner do evento
                                        $stmt34 =$db->prepare('SELECT * FROM Registers WHERE idEvent= :id_event_this');
                                        $stmt34->bindParam(':id_event_this', $event_id_page);
                                        $stmt34->execute();
                                        $result34 = $stmt34->fetchAll();        
                                        foreach($result34 as $row){
                                            if($row['idUser'] == $id_users){
                                                $allowed=1;
                                                break;
                                            }
                                        }
                                        echo'<script language="javascript">';
                                        echo 'alert("You must be registered in this event to comment")';
                                        echo '</script>';
                                        $redirectUrl = '#';
                                        echo '<script type="application/javascript">window.location.href = "'.$redirectUrl.'";</script>';
                                    } else{
                                        $allowed = 1;
                                    }
                                }
                                
                                
                                if(($_POST['submit']) && ($allowed==1)){
                                    $name = $_POST['name'];
                                    $to = $email = $_POST['email'];
                                    $comments = $_POST['comment'];
                                    $from = 'From: Manage My Event';
                                
                                    $subject = 'Comment succesfully added to event';
                                    $body = "$name, \n You added the comment:\n $comments";
                                    mail($to, $subject, $body, $from);
                                }
                                
                                if(($_POST['submit'])&&($allowed==1)){
                                    $stmt3 =$db->prepare('INSERT INTO comments(idUser,idEvent,commentary) VALUES(:id_users,:events_id_page,:comments)');
                                    $stmt3->bindParam(':id_users', $id_users);
                                    $stmt3->bindParam(':events_id_page', $event_id_page);
                                    $stmt3->bindParam(':comments', $comments);
                                    $stmt3->execute();
                                    echo'<script language="javascript">';
                                    echo 'alert("Comment added to event")';
                                    echo '</script>';
                                    $redirectUrl = '#';
                                    echo '<script type="application/javascript">window.location.href = "'.$redirectUrl.'";</script>';
                                }
                          
                            ?>
                            
                  
						
                </content>
                <article class="topcontent" id="homeSection">
                        <h2 id="last comments">Comments</h2>
                       <?php 
                       echo '<ul>';     
                        $stmt4 =$db->prepare('SELECT * FROM comments WHERE idEvent= :events_id_current');
                        $stmt4->bindParam(':events_id_current', $event_id_page);
                        $stmt4->execute();
                        $result3 = $stmt4->fetchAll();
                        foreach ($result3 as $row){
                            $stmt5 =$db->prepare('SELECT username FROM Users WHERE idUser=:user_comment LIMIT 1');
                            $stmt5->bindParam(':user_comment', $row['idUser']);
                            $stmt5->execute();
                            $result4 = $stmt5->fetch();
                            echo'<h3>'.$result4['username'].' said:'.'</h3>';
                            echo'<li>';
                            echo '<q>';
                            echo $row['commentary'];
                            echo '</q>'.'</li>';
                        }
                        echo'</ul>';
                   ?>   

                    
                </article>
               </content>
        </div>
    </div>
    <aside class="top-sidebar">
    	<article>
        	<h2>Recently Created Events</h2>
				<ul>
					<?php
						$user_id = $_SESSION['id_user'];
						$stmt =$db->prepare('SELECT * FROM Events WHERE idUser=:user AND public=1 ORDER BY idEvent DESC LIMIT 3');
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
					<?php
						$user_id = $_SESSION['id_user'];
						//echo $user_id;
						$stmt =$db->prepare('SELECT * FROM Comments WHERE idUser=:user ORDER BY idComment DESC LIMIT 3');
						$stmt->bindParam(':user', $user_id);
						$stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach( $result as $row) {
                        	$link = 'event_page.php?id='.$row['idEvent'];
                        	$stmt1=$db->prepare('SELECT description FROM Events WHERE idEvent=:events LIMIT 1' );
                        	$stmt1->bindParam(':events', $row['idEvent']);
                       		$stmt1->execute();
                        	$result1 = $stmt1->fetch();
                        	echo '<li>' . 'In '.'<a href="'.$link.'">'.$result1['description'] . '</a>'.'</li>';
                        }
                        ?>
				</ul>
        </article>
        
    </aside>

<?php
	include_once("templates/footer.php");
?>


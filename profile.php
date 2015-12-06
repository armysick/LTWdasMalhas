<?php
    include_once("database/connection.php");
    session_start();
    if(isset($_SESSION['id_user'])){
        include_once("templates/header_profile.php");
    } else{
        header('Location: index.php');
    }
?>
<div class="mainContent">
    	<div class="content">
        	<article class="topcontent" id="homeSection">
            	<header>
                	<h2><a href="profile.php" title="Title">Profile</a></h2>
                </header>
                
                <content>
                	<div class="bigpix">
                		<!--<div class="image">
                			<img src="img/profile_default.jpg" name="imagemProfile" alt="" width="430" height="250" /></div> -->
                	<?php 
                		session_start();
                        $db=new PDO('sqlite:DB.db');
                        $stmt =$db->prepare('SELECT image FROM Users WHERE username = :user LIMIT 1');
                        $stmt->bindParam(':user',$_SESSION['login_user']);
						$stmt->execute();
                        
                        $result = $stmt->fetch();
                        echo '<div class="image">';
                        echo '<img src="'.$result['image'].'" alt="" width="430" height="250" />'.'</div>';
                        
                    ?>
                		<form action="Upload.php" method="post" enctype="multipart/form-data"> 
    						<input type="file" name="fileToUpload" id="fileToUpload">
    					</br>
    						<input type="submit" value="submit" name="submit">
						</form>
                	</div>
                	<?php
                		
						$username = $_SESSION['login_user']; 
						echo'<h3>';
						echo '<a href="#">'.$username.'</a>';
						echo'</h3>';
                	?>
					<div class="information">
						<?php
							
							$stmt =$db->prepare('SELECT * FROM Users WHERE username LIKE "%'.$username.'%" LIMIT 1');
							//$stmt->bindParam(':user', $username);
							$stmt->execute();
							$result = $stmt->fetchAll();
							foreach($result as $row){
								echo '<tr>';
                            	echo '<td>'.'Nome: '.$row['nome'].'</td>';
                            	echo'<br>';
                            	echo '<td>'.'E-mail: '.$row['email'].'</td>';
                            	echo'<br>';
                            	echo '<td>'.'Date of birth '.$row['birth_date'].'</td>';
                            	echo '</tr>';
                            }
						?>
						
						<ul>
							<!-- Create new event -->
							
							<!-- CSS will hide this checkbox until the media query is activated-->
								<!--<label for="show-menu" class="show-menu">Menu</label>
								<input type="checkbox" id="show-menu" name="button" />-->
								
								<ul class="menu">
									<li class="signin"><a href="javascript:void(0)" onclick="toggle_visibility('popupBoxOnePosition');">Create New Event</a></li>
											   
									<div id="popupBoxOnePosition">
										<div class="popupBoxWrapper">
											<div class="popupBoxContent">
												<h2>Create New Event</h2>
												<content>
												<form action="create_event.php" class="contact" method="post" enctype="multipart/form-data">
													<!--alteração pra enviar pra BDAD-->
													<fieldset>
														<input type="text" name="description" placeholder="Event Description…" id="form_contact" tabindex="1" required >
													</fieldset>
													<fieldset>
														<input placeholder="Event Type…" type="text" name="e_type" id="form_contact" tabindex="2" required>
													</fieldset>
													<fieldset>
														<input name ="image_link" placeholder="Choose Image Link…" type="file" id="image_link" tabindex="3">
													</fieldset>
													<fieldset>
														<input name="e_date" placeholder="Event's Date" type="date" id="form_contact" tabindex="4">
													</fieldset>	
													<fieldset>
														<input placeholder="Place…" type="text" name="place" id="form_contact" tabindex="2" required>
													</fieldset>												
													<fieldset>
														<input name="public" placeholder="Public? (1) Private?(0)" type="number" id="form_contact" tabindex="5">	
													</fieldset>
													
													<fieldset>
														<button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
													</fieldset>
													<fieldset>
														<button name="cancel" type="button" id="contact-submit" ><a id="cancel-button" href="javascript:void(0)" onclick="toggle_visibility('popupBoxOnePosition');">Cancel</a></button>
													</fieldset>   
												</form>
												</content>
												</div>
										</div>
									</div>
								
							
							<li class="edit"><a href="javascript:void(0)" onclick="toggle_visibility('popupBoxTwoPosition');">Edit your profile</a></li><!--script to edit personal information-->
								<div id="popupBoxTwoPosition">
									<div class="popupBoxWrapper">
										<div class="popupBoxContent">
											<h2>Edit Your Profile</h2>
											<content>
											<form action="edit_profile.php" class="contact" method="post">
												<!--alteração pra enviar pra BDAD-->
												<fieldset>
													<input type="text" name="name" placeholder="Your Name…" id="form_contact" tabindex="1">
												</fieldset>
												<fieldset>
													<input placeholder="Your Email Address" type="email" name="email" id="form_contact" tabindex="2">
												</fieldset>
												<fieldset>
													<input name ="username" placeholder="Choose a username" type="user" id="form_contact" tabindex="3">
												</fieldset>
												<fieldset>
													<input name="password" placeholder="Choose a new password" type="password" id="form_contact" tabindex="4">
												</fieldset>
												<fieldset>
													<input name="password2" placeholder="Confirm new password" type="password" id="form_contact" tabindex="5">
												</fieldset>
												<fieldset>
													<input name="date_of_birth" placeholder="Date of birth" type="date" id="form_contact" tabindex="6">
												</fieldset>
												<fieldset>
													<button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
												</fieldset>
												<fieldset>
													<button name="cancel" type="button" id="contact-submit" ><a id="cancel-button" href="javascript:void(0)" onclick="toggle_visibility('popupBoxTwoPosition');">Cancel</a></button>
												</fieldset>   
											</form>
											</content>
											</div>
									</div>
								</div>
							<?php
								if($_SESSION['admin']){
									echo'<li class="signin"><a href="manage_events_admin.php">Manage all events</a></li>';
								}else{
									echo'<li class="signin"><a href="manage_events.php">Manage your events</a></li>';
								}
							
								if($_SESSION['admin']){
									echo'<li class="signin"><a href="manage_users.php">View Users</a></li>'; //view current users, delete people
								}
							?>
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
						
						$stmt =$db->prepare('SELECT * FROM Events WHERE idUser=:user ORDER BY idEvent DESC LIMIT 3');
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
						$stmt =$db->prepare('SELECT * FROM comments WHERE idUser=:user ORDER BY idComment DESC LIMIT 3');
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
	include("templates/footer.php");
?>


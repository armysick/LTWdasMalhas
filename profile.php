<?php
	include_once("database/connection.php");
	include_once("templates/header_profile.php");
?>
<div class="mainContent">
    	<div class="content">
        	<article class="topcontent" id="homeSection">
            	<header>
                	<h2><a href="#" title="Title">Profile</a></h2>
                </header>
                
                <content>
                	<div class="bigpix">
                		<div class="image"><img src="img/profile_default.jpg" alt="" width="430" height="250" /></div>
                	</div>
                	<?php
                		session_start();
						$username = $_SESSION['login_user']; 
						echo'<h3>';
						echo '<a href="#">'.$username.'</a>';
						echo'</h3>';
                	?>
					<div class="information">
						<?php
							$db=new PDO('sqlite:DB.db');
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
								<label for="show-menu" class="show-menu">Menu</label>
								<input type="checkbox" id="show-menu" name="button" />
								
								<ul class="menu">
									<li class="signin"><a href="javascript:void(0)" onclick="toggle_visibility('popupBoxOnePosition');">Create New Event</a></li>
											   
									<div id="popupBoxOnePosition">
										<div class="popupBoxWrapper">
											<div class="popupBoxContent">
												<h2>Create New Event</h2>
												<content>
												<form action="create_event.php" class="contact" method="post">
													<!--alteração pra enviar pra BDAD-->
													<fieldset>
														<input type="text" name="description" placeholder="Event Description…" id="form_contact" tabindex="1" required >
													</fieldset>
													<fieldset>
														<input placeholder="Event Type…" type="text" name="e_type" id="form_contact" tabindex="2" required>
													</fieldset>
													<fieldset>
														<input name ="image_link" placeholder="Choose Image Link…" type="text" id="form_contact" tabindex="3">
													</fieldset>
													<fieldset>
														<input name="e_date" placeholder="Event's Date" type="date" id="form_contact" tabindex="4">
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
								
							
							<li class="signin"><a href="#">Edit your profile</a></li><!--script to edit personal information-->
							<li class="signin"><a href="#">Manage your events</a></li><!--edit, delete, invite people, comment -->
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


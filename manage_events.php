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
        	<article class="topcontent">
            	<header>
                	<h2><a href="#" title="Title">Manage Your Events</a></h2>
                </header>
                
                <content>
                    <!--table containing all the public events-->
                    <table>
                        <tr>
                            <th class="left">Event Id</th>
                            <th class="center">Description</th>
                            <th class="center">Type</th>
                            <th class="center">Date</th>
                            <th class="center">Image</th>
                            <th class="center">Public</th>
                            <th class="center">Place</th>
                            <th class="center">Option</th>
                        </tr> 

                    <?php 
                        $db=new PDO('sqlite:DB.db');
                        session_start();
                        $user = $_SESSION['id_user'];
                        $stmt =$db->prepare('SELECT * FROM Events WHERE idUser= :user');
                        $stmt->bindParam(':user',$user);
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach( $result as $row) {
                            echo '<tr>';
                            echo '<td>' . $row['idEvent'] . '</td>';
                            $link = 'event_page.php?id='.$row['idEvent'];
                            echo '<td>' . '<a href="'.$link.'">'.$row['description'] . '</a>'.'</td>';
                            echo '<td>' . $row['event_type'] . '</td>';
                            echo '<td>' . $row['event_date'] . '</td>';
                            echo '<td><img src="'.$row['image_link'].'" alt="Image" height="42" width="42"></td>';
                            if($row['public']==1){
                                echo '<td>' . 'public' . '</td>';
                            } else{
                                echo '<td>' . 'private' . '</td>';
                            }
                            
                            echo '<td>' . $row['Place'] . '</td>';
                            $a=$row['idEvent'];
                            echo'<td>';
                            echo"<a href='javascript:void' onclick='if(confirm(\"Are you sure you want to delete?\")) window.location=\"delete_event.php?event_id=".$a."\";'><center>Delete</center></a>";
                            echo '<br>';
                            //echo '<a href="edit_event.php?event_id=' . $a . '">Edit Event</a>';
							//unset($idEE);
							$idEE = $row['idEvent'];
							?>
							<li class="edit"><?php echo $idEE; ?><a href="javascript:void(0)" onclick="toggle_visibility('popupBoxTwoPosition'); ">Edit your Event </a></li><!--script to edit personal information-->
								<div id="popupBoxTwoPosition">
									<div class="popupBoxWrapper">
										<div class="popupBoxContent">
											<h2>Edit Your Event</h2>
											<content>
											<form action="" name= "form1" id="form1" class="contact" method="post" onSubmit='submitForm();'>
												<!--alteração pra enviar pra BDAD-->
												<fieldset>
													<input type="text" name="description" placeholder="New Description" id="form_contact" tabindex="1">
												</fieldset>
												<fieldset>
													<input placeholder="New event type" type="text" name="type" id="form_contact" tabindex="2">
												</fieldset>
												<fieldset>
													<input name ="event_date" placeholder="New Event Date" type="date" id="form_contact" tabindex="3">
												</fieldset>
												<fieldset>
													<input name="place" placeholder="Choose a different place" type="text" id="form_contact" tabindex="4">
												</fieldset>
												<fieldset>
													<input name="eid" value ="<?php echo $idEE; ?>" type="text" id="form_contact" tabindex="5" >
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

                            //echo'<li class="signin" id="signin">';
                           /* echo'<form method="get" action="delete_event.php">';
                            echo'<input type="hidden" name="id" value="'.$row['idEvent'].'">';
                            echo'<input type="submit" value = "Delete Event">';
                            echo'</form>';
                            //echo'<form method="get" action="'.$link1.'">';
                            //echo'<input type="hidden" name="event_id" value="'.$row['idEvent'].'"';
                            //echo'<input type="submit" value = "Delete Event">';
                            //echo'<li class="signin" id="signin">';
                            echo'<form method="get" action="edit_event.php">';
                            echo'<input type="hidden" name="id" value="'.$row['idEvent'].'">';
                            echo'<input type="submit" value = "Edit Event">';*/
                            echo'</td>';
                            echo'</tr>';

                        }    
                    ?>
                </table> 
                                   	
                </content>
            </article>
        </div>
    </div>

<?php 
 	include_once("templates/footer.php");
?>
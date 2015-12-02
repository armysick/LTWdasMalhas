
<?php
	include_once("database/connection.php");
	include_once("templates/header_profile.php");
	?>
						<body class="body">
	
    
        <nav> 
        <!-- CSS will hide this checkbox until the media query is activated-->
        	<label for="show-menu" class="show-menu">Menu</label>
            <input type="checkbox" id="show-menu" name="button" />
            
        	<ul class="menu">
                <li class="signin"><a href="javascript:void(0)" onclick="toggle_visibility('popupBoxOnePosition');">Sign Up</a></li>
                           
               	<div id="popupBoxOnePosition">
					<div class="popupBoxWrapper">
						<div class="popupBoxContent">
							<h2>Sign Up</h2>
							<content>
                			<form action="SignUp.php" class="contact" method="post">
                                <!--alteração pra enviar pra BDAD-->
                                <fieldset>
                                    <input type="text" name="name" placeholder="Your Name…" id="form_contact" tabindex="1" required >
                                </fieldset>
                                <fieldset>
                                    <input placeholder="Your Email Address" type="email" name="email" id="form_contact" tabindex="2" required>
                                </fieldset>
                                <fieldset>
                                    <input name ="username" placeholder="Choose a username" type="user" id="form_contact" tabindex="3">
                                </fieldset>
                                <fieldset>
                                    <input name="password" placeholder="Choose a password" type="password" id="form_contact" tabindex="4">
                                </fieldset>
                                <fieldset>
                                    <input name="password2" placeholder="Confirm password" type="password" id="form_contact" tabindex="5">
                                </fieldset>
                                <fieldset>
                                    <input name="date_of_birth" placeholder="Date of birth" type="date" id="form_contact" tabindex="6">
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
			</ul>
		</nav>
</body>
<?php
								include_once("templates/footer.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>ManageMyEvent</title>
    
    <link rel="stylesheet" href="style.css" text="text/css" />
    <!--the browser has to consider this page as responsive-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--script for the scrolling effect-->
    <script src="lib/jquery-1.11.3.min.js"></script>
    <script src="lib/app.js"></script>
    <!--javascript for popups-->
    <script type="text/javascript">
		function toggle_visibility(id) {
			var e = document.getElementById(id);
			if(e.style.display == 'block')
				e.style.display = 'none';
			else
				e.style.display = 'block';
		}
	</script>
</head>

<body class="body">
	
    <header class="mainheader">
    	<img src="img/banner_large.jpg" />
        <nav> 
        <!-- CSS will hide this checkbox until the media query is activated-->
        	<label for="show-menu" class="show-menu">Menu</label>
            <input type="checkbox" id="show-menu" name="button" />
            
        	<ul class="menu">
            	<li><a id="home" href="index.php#homeSection" class="active">Home</a></li>
                <li><a id="about" href="index.php#aboutSection">About</a></li>
                <li><a id="contact" href="index.php#contactSection">Contact Us</a></li>
                <li><a id="events" href="list_public_events.php">Events</a></li>
                <li class="signin"><a href="javascript:void(0)" onclick="toggle_visibility('popupBoxOnePosition');">Sign Up</a></li>
                <li class="signin"><a href="javascript:void(0)" onclick="toggle_visibility('popupBoxTwoPosition');">Sign In</a></li>
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

				<div id="popupBoxTwoPosition">
					<div class="popupBoxWrapper">
						<div class="popupBoxContent">
							<h2>Sign In</h2>
                            <content>
                			<form action="SignIn.php" class="contact">
                               	<fieldset>
                                    <input placeholder="Username" type="username" id="form_contact" tabindex="1">
                                </fieldset>
                                <fieldset>
                                    <input placeholder="Password" type="password" id="form_contact" tabindex="2">
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
            </ul>
        </nav>
    </header>
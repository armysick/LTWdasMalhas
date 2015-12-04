<?php
    include_once("database/connection.php");
    include_once("templates/header.php");
?>
	<!-- these HTML5 tags make the browser react and make the page responsive -->
	<div class="mainContent">
    	<div class="content">
        	<article class="topcontent" id="homeSection">
            	<header>
                	<h2><a href="#" title="Title">Manage my Event</a></h2>
                </header>
                
                <content>
                	<p>Hello. We are the team of "Manage My Event" and our awesome application allows you to view, share and search all your events! Manage your events with our app! We would love to help you!</p>

					<p><!--fill in with stuff later--></p>
                </content>
            </article>
            
            <article class="bottomcontent" id="aboutSection">
            	<header>
                	<h2><a href="#" title="news">About</a></h2>
                </header>
                
                <content>
                	<p>ManageMyEvent is the website where you can manage all your big projects and invite all your friends to get along!

In this website you can easily:</p>
					<ul>
                        <li>Create and edit your awesome event;</li>

                        <li>Access all your events and monitor their progress;</li>
                        
                        <li>Invite friends or people to attend it;</li>
                        
                        <li>Search for other people's events and choose whether or not you want to attend them using our competent search engine;</li>
                        
                        <li>And much, much more!</li>
					</ul>
                    <p>You can also count on a solid security in all your data and a broad database so you can maximize the sharing of an event that we are sure no one would want to miss!
                    </p>
                </content>
            </article>
            
            <article class="" id="contactSection">
            	<header>
                	<h2><a href="#" title="news">Contact Us</a></h2>
                </header>
                <h4>Contact us if you have any question</h4>
                <content>
                <form action="" method="POST" class="contact">
                	<fieldset>
                    	<input type="text" name="name" placeholder="Your Name…" id="form_contact" tabindex="1" required >
                    </fieldset>
                    <fieldset>
                 		<input name="email" placeholder="Your Email Address" type="email" id="form_contact" tabindex="2" required>
                    </fieldset>
                    <fieldset>
                    	<input name="phone" placeholder="Your Phone Number" type="tel" id="form_contact" tabindex="3">
                    </fieldset>
                    <fieldset>
                    	<textarea name="message" placeholder="Type your Message Here..." id="form_contact" tabindex="4" required></textarea>
                    </fieldset>
                    <fieldset>
        				<button name="submit" type="submit" value="submit" id="contact-submit">Submit</button>
                    </fieldset>  
                </form>
            	</content>
				<?php

                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $message = $_POST['message'];
                    $from = 'From: Manage My Event';
                    $to = 'paulobfsilva@gmail.com';
                    $subject = 'New Message from Manage My Event';
    
                    $body = "De: $name \n E-Mail: $email\n Mensagem:\n $message";
                    //mail(($to, $subject, $body, $from));
                    if ($_POST['submit']) {
                        if (mail ($to, $subject, $body, $from)) {
                            echo '<script language="javascript">';
							echo 'alert("message successfully sent")';
							echo '</script>';
                        } else {
                            echo '<script language="javascript">';
							echo 'alert("An error has occured! Please try again later")';
							echo '</script>';
                        }
    
                    }
?>
            </article>
        </div>
    </div>
    <aside class="top-sidebar">
    	<article>
        	<h2>Everything in the cloud!</h2>
            <p>Store all your events and see them in all your devices</p>
        </article>
        
    </aside>
    
    <aside class="middle-sidebar">
    	<article>
        	<h2>Share with friends</h2>
            <p>You can share your events or make them private</p>
        </article>
        
    </aside>
    
    <aside class="bottom-sidebar">
    	<article>
        	<h2>Search</h2>
            <p>Search your events, change them, customize them</p>
        </article>
        
    </aside>
<?php
    include_once("templates/footer.php");
?>
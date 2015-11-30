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
                            	echo '<td>'.$row['nome'].'</td>';
                            	echo'<br>';
                            	echo '<td>'.$row['email'].'</td>';
                            	echo'<br>';
                            	echo '<td>'.$row['birth_date'].'</td>';
                            	echo '</tr>';
                            }
						?>
						<p><strong>Glazed</strong> is a free, fully standards-compliant CSS template designed by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a>. This free template is released under a <a href="http://creativecommons.org/licenses/by/2.5/">Creative Commons Attributions 2.5</a> license, so you're pretty much free to do whatever you want with it  (even use it commercially) provided you keep the links in the footer  intact. Have fun with it :)</p>
						<p>This template is also available as a <a href="http://www.freewpthemes.net/preview/glazed/">WordPress theme</a> at <a href="http://www.freewpthemes.net/">Free WordPress Themes</a>.</p>
						<h2>A Heading Level 2</h2>
						<p>This paragraph is followed by a sample unordered list:</p>
						<ul>
							<li><a href="#">Create new event</a></li> <!--script to create new events-->
							<li><a href="#">Edit your profile</a></li><!--script to edit personal information-->
							<li><a href="#">Manage your events</a></li><!--edit, delete, invite people, comment -->
						</ul>
						
						
                </content>
        </div>
    </div>
    <aside class="top-sidebar">
    	<article>
        	<h2>Recent Events</h2>
				<ul>
					<li><a href="#">Aliquam libero</a></li>
					<li><a href="#">Consectetuer adipiscing elit</a></li>
					<li><a href="#">Metus aliquam pellentesque</a></li>
					<li><a href="#">Suspendisse iaculis mauris</a></li>
					<li><a href="#">Urnanet non molestie semper</a></li>
					<li><a href="#">Proin gravida orci porttitor</a></li>
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


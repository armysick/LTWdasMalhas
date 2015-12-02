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
                <li class="signin"><a href="profile.php">Profile</a></li>
                <li class="signin"><a href="Logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
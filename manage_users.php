<?php
    include_once("database/connection.php");
    session_start();
    if(isset($_SESSION['admin'])){ //page for admin only
        include_once("templates/header_profile.php");
    } else{
        header('Location: index.php');
    }
?>
	<div class="mainContent">
    	<div class="content">
        	<article class="topcontent">
            	<header>
                	<h2><a href="#" title="Title">View Users</a></h2>
                </header>
                
                <content>
                    <!--table containing all the public events-->
                    <table>
                        <tr>
                            <th class="left">User Id</th>
                            <th class="center">Username</th>
                            <th class="center">Name</th>
                            <th class="center">Email</th>
                            <th class="center">Date of Birth</th>
                            <th class="center">Profile Image</th>
                            <th class="center">Options</th>
                        </tr> 

                    <?php 
                        $db=new PDO('sqlite:DB.db');
                        session_start();
                        $user = $_SESSION['id_user'];
                        $stmt =$db->prepare('SELECT * FROM Users');
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach( $result as $row) {
                            echo '<tr>';
                            echo '<td>' . $row['idUser'] . '</td>';
                            echo '<td>' . $row['username'].'</td>';
                            echo '<td>' . $row['nome'] . '</td>';
                            echo '<td>' . $row['email'] . '</td>';
                            echo '<td>' . $row['birth_date'] . '</td>';
                            echo '<td><img src="'.$row['image'].'" alt="Image" height="42" width="42"></td>';
                            echo'<td>';
                            $a=$row['idUser'];
                            echo"<a href='javascript:void' onclick='if(confirm(\"Are you sure you want to delete this user?\")) window.location=\"delete_user.php?user_id=".$a."\";'><center>Delete</center></a>";
                            echo '<br>';
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
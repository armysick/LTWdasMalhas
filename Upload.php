<?php
session_start();
include_once("database/connection.php");

$target_dir = "img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$stringerror;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $stringerror = "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    $stringerror=$stringerror."Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $stringerror = $stringerror."Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $stringerror = $stringerror."Sorry, your file was not uploaded.";
    $redirectUrl = 'profile.php';
    echo '<script type="application/javascript">alert("Failed to Upload");window.location.href = "'.$redirectUrl.'";</script>';
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $stmt =$db->prepare('UPDATE Users SET image = :imag WHERE username = :user');
        $stmt->bindParam(':user', $_SESSION['login_user']);
        $stmt->bindParam(':imag',$target_file);
        $stmt->execute();
        $redirectUrl = 'profile.php';
        echo '<script type="application/javascript">window.location.href = "'.$redirectUrl.'";</script>';

    } else {
        $redirectUrl = 'profile.php';
        echo '<script type="application/javascript">alert("There was an error uploading your file try again");window.location.href = "'.$redirectUrl.'";</script>';
    }
}
?>
<?php 
// checks if the user is logged in.
$cookie_name = "userId";
if(!isset($_COOKIE[$cookie_name]))
{
    header("Location: http://summamusic/login");
}

$songId = $_GET["songId"];

$servername = "localhost";
$username = "root";
$password = "";  
$dbname = "summamusic";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = 'DELETE FROM `favourite` WHERE `favourite`.`songId` = "'. $songId .'" AND `favourite`.`userId` = "'. $_COOKIE["userId"] .'";';
echo $sql;
if ($conn->query($sql) == TRUE) {
echo "New record deleted successfully";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: http://summamusic/favourites");
exit();
?>
<?php 
// checks if the user is logged in.
$cookie_name = "userId";
if(!isset($_COOKIE[$cookie_name]))
{
    header("Location: http://summamusic/login");
    exit();
}
// set all variables.
$messageId = $_POST["messageId"];

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

$sql = 'DELETE FROM `messages` WHERE `messages`.`id` = "' . $messageId . '";';

if ($conn->query($sql) == TRUE) {
echo "New record created successfully";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: http://summamusic/contact");
?>
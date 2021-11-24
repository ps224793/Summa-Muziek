<?php 
$title = $_POST["title"];
$message = $_POST["message"];

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

$sql = 'INSERT INTO `messages` (`id`, `userId`, `titel`, `message`) VALUES (NULL, "'. $_COOKIE["userId"] .'", "'. $title .'", "' . $message . '");';

if ($conn->query($sql) === TRUE) {
echo "New record created successfully";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: http://summamusic/contact");
exit();
?>
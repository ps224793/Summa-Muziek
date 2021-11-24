<?php 
session_start();
$name = $_POST["name"];
$userPassword = $_POST["password"];
$returnPage = $_SESSION["returnPage"];
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

$sql = 'SELECT `id`, `password`, `name` FROM `user` WHERE `name` = "' . $name . '";' ;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

    if(strcmp($row["password"], $userPassword) == 0){
      setcookie("userId", $row["id"], time() + (3600));
      setcookie("userName", $row["name"], time()+(3600));
      if($returnPage != ""){
        header("Location: $returnPage");
        exit();
      }else{
        header("Location: http://summamusic");
      }

    }else{
      setcookie("userId", "", time() - 3600);
      setcookie("userName", "", time() - 3600);
      header("Location: http://summamusic/login");
      exit();
    }
  }
} else {
  echo "geen artiesten gevonden";
}
$conn->close();
?>
<?php 
session_start();
$_SESSION["returnPage"] = "http://summamusic/contact";

// checks if the user is logged in.
$cookie_name = "userId";
if(!isset($_COOKIE[$cookie_name]))
{
    header("Location: http://summamusic/login");
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summa Muziek</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand navbar-light bg-light">
            <a class="navbar-brand" href="#">Summa Muziek</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                <a class="nav-item nav-link" href="http://summamusic">Home</a>
                <a class="nav-item nav-link active" href="#">Contact</a>
                <a class="nav-item nav-link" href="http://summamusic/login">Login</a>
                <a class="nav-item nav-link" href="http://summamusic/favourites">favorieten</a>
                <?php 
                    if(isset($_COOKIE["userName"])){
                        echo '<a class="nav-item nav-link active" href="http://summamusic/Logout">' . $_COOKIE["userName"] . "</a>";
                    }
                    ?>
                </div>
            </div>
        </nav>
        <br>
        <div class="row">
            <div class="col-3">
                <ul class="list-group">
                    <li class="list-group-item"><b>messages</b></li>
                    <?php
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
                    
                    $sql = 'SELECT * FROM `messages` WHERE `userId` =' . $_COOKIE["userId"];
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                      // output data of each row
                      while($row = $result->fetch_assoc()) {
                        echo '<li class="list-group-item">';
                        echo  $row["titel"];
                        echo  '<a class="stretched-link" href="http://summamusic/message?messageId='. $row["id"] . '"></a>';
                        echo '</li>';
                      }
                    } 
                    
                    $conn->close();
                    ?>
                </ul>
            </div>
            <div class="col-9">
                <form action="sendmessage.php" method="POST">
                    <div class="form-group">
                        <label>titel</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>message:</label>
                        <input type="text" name="message" class="form-control" required>
                    </div>
                    <input type="submit"  class="btn btn-primary">
                </form>
             </div>
        </div>
    </div>
</body>
</html>
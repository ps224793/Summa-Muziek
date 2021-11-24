<?php 
session_start();
$_SESSION["returnPage"] = "http://summamusic";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summa Muziek</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand navbar-light bg-light">
            <a class="navbar-brand" href="#">Summa Muziek</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="#">Home</a>
                    <a class="nav-item nav-link" href="http://summamusic/contact">contact</a>
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
        <div class="row">
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
                
                $sql = "SELECT * FROM `artist` ORDER BY `artist`.`name`";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                    
                    echo '<div class="col-4" d-flex align-items-stretch style="margin-bottom: 30px;">';
                    echo '<a href="http://summamusic/artist/?artistId=' . $row["id"] . '" class="stretched-link">'.'</a>';
                    echo '<h3 class="card-text">' . $row["name"]. '</h3>' .'<img src="' . $row["imagepath"] . '" class="img img-responsive" hight style="width: 100%;">';
                    echo "</div>";
                  }
                } else {
                  echo "geen artiesten gevonden";
                }
                $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
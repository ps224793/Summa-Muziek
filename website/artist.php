<?php 
session_start();
$returnPage = 'http://summamusic/artist/?artistId=' . $_GET["artistId"];
$_SESSION["returnPage"] = $returnPage;
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
                    $artistId = $_GET["artistId"];

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
                    
                    $stmt = $conn->prepare("SELECT * FROM `artist` WHERE `id` = ?");
                    $stmt->bind_param("s", $artistId);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    //$sql = "SELECT * FROM `artist` WHERE `id` = " . $artistId;
                    //$result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                      // output data of each row
                      while($row = $result->fetch_assoc()) {
                        echo '<div class="col-4"><img src="' . $row["imagepath"] . '" style="width: 100%;"></div>';
                        echo '<div class="col-8"><p>' . $row["discription"] . '</p></div>';
                      }
                    } else {
                      echo "geen artiest met dit id gevonden";
                    }
                    $conn->close();
                ?>

        </div>
        <hr>
        <?php 
            $artistId = $_GET["artistId"];

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
            
            $sql = 'SELECT `song`.`id`, `song`.`name`, `song`.`url` FROM `song` WHERE `song`.`artist_id` = "' . $artistId . '" ORDER BY `song`.`name`';
            $result = $conn->query($sql);
            echo '<div class="row">';
            if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                
                    echo '<div class="col-6" style="margin-bottom: 30px;">';
                        echo '<iframe style="min-height: 400px;" width="100%" src="https://www.youtube.com/embed/' . $row["url"] . '"></iframe>';
                        echo '<h3>' . $row["name"] . '</h3>';
                        echo '<a class="btn btn-primary" href="http://summamusic/addFavourite.php?songId='. $row["id"] .'">Favourite</a>';
                        echo '<br>';
                    echo '</div>';
              }
            } else {
              echo "geen artiest met dit id gevonden";
            }
            $conn->close();
            ?>
            </div>
          <br>
      </div>
</body>
</html>

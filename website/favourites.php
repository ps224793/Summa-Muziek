<?php 

session_start();

$returnPage = 'http://summamusic/favourites';
$_SESSION["returnPage"] = $returnPage;

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
        <h2>Favorieten.</h2>
        <hr>
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
                    
                    $sql = 'SELECT `song`.`id`, `song`.`name`, `song`.`url` FROM `song` INNER JOIN `favourite` ON `song`.`id` = `favourite`.`songId` WHERE `favourite`.`userId` = "' . $_COOKIE["userId"].'" ORDER BY `song`.`name`;';
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                      // output data of each row
                      while($row = $result->fetch_assoc()) {
                        echo '<div class="col-6" style="margin-bottom: 30px;">';
                        echo '<iframe style="min-height: 400px;" width="100%" src="https://www.youtube.com/embed/' . $row["url"] . '"></iframe>';
                        echo '<h3>' . $row["name"] . '</h3>';
                        echo '<a class="btn btn-danger" href="http://summamusic/unFavourite.php?songId='. $row["id"] .'">onfavoriet</a>';
                        echo '<br>';
                        echo '</div>';
                      }
                    }
                    $conn->close();
                ?>
        </div>
    </div>
</body>
</html>
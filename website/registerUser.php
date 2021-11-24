<?php 
    $name = $_POST["name"];
    $email = $_POST["email"];
    $passwordpost = $_POST["password"];

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

    $sql = 'INSERT INTO `user` (`id`, `name`, `password`, `email`) VALUES (NULL, "' . $name . '", "' . $passwordpost .'", "' . $email . '");';

    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location: http://summamusic");
    exit();
?>
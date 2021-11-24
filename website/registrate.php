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

        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 wrapper">
                <h2>Registreer</h2>
                <form action="registerUser.php" method="POST">
                
                        <div class="form-group">
                            <label>Naam:</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>e-mail:</label>
                            <input type="text" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>wachtwoord:</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <input type="submit" value="Registreer" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</body>

</html>
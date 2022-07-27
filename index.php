<?php
$servername = "localhost";
$databaseName = "birgerbolcherh3";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $databaseName);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home
                            <span class="visually-hidden">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?SQL=02">SQL-02</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?SQL=03">SQL-03</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?SQL=04">SQL-04</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?SQL=06">SQL-06</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?SQL=07">SQL-07</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?SQL=08">SQL-08</a>
                    </li>
                </div>
            </div>
        </nav>
        <div class="container">
            <?php
                switch ($_GET['SQL']) {
                    case '02':
                        include('SQL-02.php');
                        break;
                    case '03':
                        include('SQL-03.php');
                        break;
                    case '04':
                        include('SQL-04.php');
                        break;
                    case '06':
                        include('SQL-06.php');
                        break;
                    case '07':
                        include('SQL-07.php');
                        break;
                    case '08':
                        include('SQL-08.php');
                        break;
                }
            ?>
        </div>

       
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    </body>
</html>

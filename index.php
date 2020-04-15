<?php

if ($_COOKIE["login"] = false) {
    header("refresh: 0; url=login.php");
    exit("You are not logged in. Going bacc.");
}

$host="localhost";
$db = "netland";
$username = "root";
$password = "";

$dsn= "mysql:host=$host;dbname=$db";
try {
    // create a PDO connection with the configuration data
    $conn = new PDO($dsn, $username, $password);
    
    // display a message if connected to database successfully
    if ($conn) {
        echo "Connected to the <strong>$db</strong> database successfully!";
    }
} catch (PDOException $e) {
    // report error message
    echo $e->getMessage("");
}
if (isset($_POST["unset"])) {
    unset($_GET["seriesTitelSortering"]);
    unset($_GET["ratingSortering"]);
    unset($_GET["filmsTitelSortering"]);
    unset($_GET["duurSortering"]);  
}
$series = $conn->query("SELECT title, rating, id FROM series");
$films = $conn->query("SELECT titel, duur, id FROM films");

$seriesTitelSortering = $_GET["seriesTitelSortering"];
$ratingSortering = $_GET["ratingSortering"];

$filmsTitelSortering = $_GET["filmsTitelSortering"];
$duurSortering = $_GET["duurSortering"];

if(isset($_GET["ratingSortering"])) {
    $series = $conn->query("select title, rating, id from series order by $ratingSortering DESC");
} elseif (isset($_GET["seriesTitelSortering"])) {
    $series = $conn->query("select title, rating, id from series order by $seriesTitelSortering");
} elseif (isset($_GET["filmsTitelSortering"])) {
    $films = $conn->query("select titel, duur, id from films order by $filmsTitelSortering");
} elseif (isset($_GET["duurSortering"])) {
    $films = $conn->query("select titel, duur, id from films order by $duurSortering DESC");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>N E T L A N D</title>
    <style>
        * {
            font-family: Arial;
        } 
        table {
            border: 1px solid black;
        }
        td {
            border: 1px solid black;
        }
        .logout {
            font-size: large;
            float: right;
        }
    </style>
</head>
<body>
    
<br>
<a class="logout" href="logout.php">Uitloggen</a>

<h1>
    Series
</h1>

<table>
    <tr>
        <th><a href="index.php?seriesTitelSortering=title">Titel</a></th>
        <th><a href="index.php?ratingSortering=rating">Rating</a></th>
    </tr>
        <?php
        foreach($series as $row) { ?>
            <tr>
                <td><?php echo $row["title"] ?></td>
                <td><?php echo $row["rating"] ?></td>
                <td><a href="serieOfFilm.php?id=<?php echo $row["id"]?>&media=serie">Bekijk details</a></td>
            </tr>
        <?php } ?>
        <tr>
            <td><a href="nieuweFilmOfSerie.php?media=serie">Nieuwe serie</a></td>
            <td></td>
            <td></td>
        </tr>
</table>

<h1>
    Films
</h1>

<table>
    <tr>
        <th><a href="index.php?filmsTitelSortering=titel">Titel</a></th>
        <th><a href="index.php?duurSortering=duur">Duur</a></th>
    </tr>
    <?php
    foreach($films as $row) {
        ?>
        <tr>
            <td><?php echo $row["titel"] ?></td>
            <td><?php echo $row["duur"] ?></td>
            <td><a href="serieOfFilm.php?id=<?php echo $row["id"]?>&media=film">Bekijk details</a></td>
        </tr>
    <?php } ?>
    <tr>
        <td><a href="nieuweFilmOfSerie.php?media=film">Nieuwe film</a></td>
        <td></td>
        <td></td>
    </tr>
</table>
<form action="index.php" method="POST">
    <input type="submit" value="Unset sorteringen" name="unset">
</form>

</body>
</html>
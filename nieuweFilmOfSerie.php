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
    }
} catch (PDOException $e) {
    // report error message
    echo $e->getMessage("");
}
if (isset($_POST["nieuweSerie"]) and $_GET["media"] === "serie") {
    $titleVar = $_POST["titleInput"]; 
    $ratingVar = $_POST["ratingInput"]; 
    $descriptionVar = $_POST["descriptionInput"]; 
    $awardVar = $_POST["awardInput"]; 
    $seasonVar = $_POST["seasonInput"]; 
    $countryVar = $_POST["countryInput"]; 
    $languageVar = $_POST["languageInput"]; 

    $query = "INSERT INTO series (title, rating, description, has_won_awards, seasons, country, language)
    VALUES ('$titleVar', $ratingVar, '$descriptionVar', $awardVar, $seasonVar, '$countryVar', '$languageVar')";
    $conn->query($query);
    header("Refresh: 0; url=index.php");
}

if (isset($_POST["nieuweFilm"]) and $_GET["media"] === "film") {
    $titelVar = $_POST["titelInput"];
    $duurVar = $_POST["duurInput"];
    $datumVanUitkomstVar = $_POST["datumVanUitkomstInput"];
    $trailerVar = $_POST["trailerInput"];
    $conn->query(
        "INSERT INTO films (titel, duur, datum_van_uitkomst, trailer)
        VALUES ('$titelVar', $duurVar, '$datumVanUitkomstVar', '$trailerVar')"
    );
    header("Refresh: 0; url=index.php");
}

if ($_GET["media"] === "serie") { ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nieuwe serie</title>
        <style>
            * {
                font-family: Arial, Helvetica, sans-serif;
            }
        </style>
    </head>
    <body>
        <a href="index.php">Terug</a>
        <h1>Nieuwe Serie</h1>
        <form action="nieuweSerie.php" method="POST">
            <p>Title - <input type="text" name="titleInput"></p>
            <p>Rating - <input type="text" name="ratingInput"></p>
            <p>Description - <textarea name="descriptionInput" cols="30" rows="10"></textarea></p>
            <p>Awards - <input type="number" name="awardInput"></p>
            <p>Seasons - <input type="number" name="seasonInput"></p>
            <p>Country - <input type="text" name="countryInput"></p>
            <p>Language - <input type="text" name="languageInput"></p>
            <input type="submit" value="Submit nieuwe serie" name="nieuweSerie">
        </form>
    </body>
    </html>
<?php } else { ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nieuwe film B R O E R</title>
        <style>
            * {
                font-family: Arial, Helvetica, sans-serif;
            }
        </style>
    </head>
    <body>
        <a href="index.php">Terug</a>
        <h1>Nieuwe film</h1>
        <form action="nieuweFilm.php" method="POST">
            <p>Titel <input name="titelInput" type="text"></p>
            <p>Duur <input name="duurInput" type="text"></p>
            <p>Datum van uitkomst <input name="datumVanUitkomstInput" type="text"></p>
            <p>Trailer <input name="trailerInput" type="text"></p>
            <input type="submit" value="Nieuwe film" name="nieuweFilm">
        </form>

    </body>
    </html>
<?php } ?>

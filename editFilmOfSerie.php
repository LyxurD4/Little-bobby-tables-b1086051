<?php

if ($_COOKIE["login"] = false) {
    header("refresh: 0; url=login.php");
    exit("You are not logged in. Going bacc.");
}

//connectie
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
    echo $e->getMessage();
}

if ($_POST["media"] === "serie" && isset($_POST["id"])) {
    $id = $_POST["id"];

    //Data uit de POST halen
    $titleWijzigenVar = $_POST["titleWijzigen"]; 
    $awardWijzigenVar = $_POST["awardWijzigen"]; 
    $ratingWijzigenVar = $_POST["ratingWijzigen"]; 
    $countryWijzigenVar = $_POST["countryWijzigen"]; 
    $languageWijzigenVar = $_POST["languageWijzigen"]; 
    $seasonWijzigenVar = $_POST["seasonWijzigen"]; 
    $descriptionWijzigenVar = $_POST["descriptionWijzigen"]; 

    //UPDATE
    $conn->query(
        "UPDATE series 
        SET 
        title = '$titleWijzigenVar',
        has_won_awards = $awardWijzigenVar,
        rating = $ratingWijzigenVar,
        country = '$countryWijzigenVar',
        language = '$languageWijzigenVar',
        seasons = $seasonWijzigenVar,
        description = '$descriptionWijzigenVar'
        WHERE id = $id"
    );
    header("refresh: 0; url=serieOfFilm.php?media=serie&id=$id");
}

if ($_POST["media"] === "film" && isset($_POST["id"])) {
    $id = $_POST["id"];

    // Data uit de POST array vissen
    $titelWijzigenVar = $_POST["titelWijzigen"];
    $duurwijzigenVar = $_POST["duurWijzigen"];
    $datumVanUitkomstWijzigenVar = $_POST["datumVanUitkomstWijzigen"];
    $trailerWijzigenVar = $_POST["trailerWijzigen"];

    // UPDATE query 
    $conn->query("UPDATE films 
        SET titel = '$titelWijzigenVar', 
        duur = $duurwijzigenVar, 
        datum_van_uitkomst = '$datumVanUitkomstWijzigenVar', 
        trailer = '$trailerWijzigenVar' 
        WHERE id = $id"
    );
    header("refresh: 0; url=serieOfFilm.php?media=film&id=$id");
}


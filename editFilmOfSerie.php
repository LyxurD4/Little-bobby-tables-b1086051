<?php

if ($_COOKIE["login"] == false) {
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
    
    $titleWijzigenVar = $_POST["titleWijzigen"]; 
    $ratingWijzigenVar = $_POST["ratingWijzigen"];
    $descriptionWijzigenVar = $_POST["descriptionWijzigen"];
    $awardWijzigenVar = $_POST["awardWijzigen"];
    $seasonWijzigenVar = $_POST["seasonWijzigen"];  
    $countryWijzigenVar = $_POST["countryWijzigen"]; 
    $languageWijzigenVar = $_POST["languageWijzigen"];

    $serieQuery = "UPDATE series SET title=?, rating=?, description=?, has_won_awards=?, seasons=?, country=?, language=? WHERE id=?";
    $serieStmt = $conn->prepare($serieQuery);  
    $serieStmt->execute([$titleWijzigenVar, $ratingWijzigenVar, $descriptionWijzigenVar, $awardWijzigenVar, $seasonWijzigenVar, $countryWijzigenVar, $languageWijzigenVar, $id]); 

    header("refresh: 0; url=serieOfFilm.php?media=serie&id=$id");
    
}

if ($_POST["media"] === "film" && isset($_POST["id"])) {
    $id = $_POST["id"];
    
    $titelWijzigenVar = $_POST["titelWijzigen"];
    $duurwijzigenVar = $_POST["duurWijzigen"];
    $datumVanUitkomstWijzigenVar = $_POST["datumVanUitkomstWijzigen"];
    $trailerWijzigenVar = $_POST["trailerWijzigen"];

    $filmQuery = "UPDATE films SET titel=?, duur=?, datum_van_uitkomst=?, trailer=? WHERE id=?";
    $filmStmt = $conn->prepare($filmQuery);
    $filmStmt->execute([$titelWijzigenVar, $duurwijzigenVar, $datumVanUitkomstWijzigenVar, $trailerWijzigenVar, $id]);
    
    header("refresh: 0; url=serieOfFilm.php?media=film&id=$id");
    
}


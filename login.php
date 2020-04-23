<?php
$fouteInlog = false;

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
if (isset($_POST["login"])) {
    $informatie = $conn->query("SELECT username, password FROM gebruikers");
    $usernameInput = $_POST["username"];
    $passwordInput = $_POST["password"];
    foreach ($informatie as $row) {
        if ($row["username"] === $usernameInput && $row["password"] === $passwordInput) {
            setcookie("login", 'true', time() + 3600);
            header("refresh: 0; url=index.php");
            exit();
        } else {
            $fouteInlog = true;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    if ($fouteInlog == true) { ?>
        <link rel="shortcut icon" type="image/x-icon" href="shrok.ico"/> 
    <?php } else { ?>
        <link rel="shortcut icon" type="image/x-icon" href="netflixlogo.ico"/> 
    <?php } ?>
    <title>Login Page</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }
        .login {
            height: 140vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        body {
            color: white;
            <?php 
            if ($fouteInlog == false) { ?>
                background: url(netland.png) no-repeat center center fixed;
                background-size: cover;
            <?php } if ($fouteInlog == true) { ?>
                background: url(shrok.jpg) no-repeat center center fixed; 
                background-size: 130% 130%;
            <?php } ?>
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="login">
        <h1>
        <?php 
        if ($fouteInlog == true) { 
            echo "N O P E"; 
        } else { 
            echo "Netland Admin Panel"; 
        } ?>
        </h1>
        <form action="login.php" method="POST">
            <input type="text" value="test-user" name="username">
            <input type="text" value="wachtwoord" name="password">
            <input type="submit" value="Log in" name="login">
        </form>
    </div>
    <?php echo $_COOKIE["login"] ?>
</body>
</html>
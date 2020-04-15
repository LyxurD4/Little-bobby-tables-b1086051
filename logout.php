<?php
setcookie("login", "", time() - 3600);
header("refresh: 0; url=login.php");
?>
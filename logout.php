<?php
setcookie("login", false, time() - 3600);
header("refresh: 0; url=login.php");
?>
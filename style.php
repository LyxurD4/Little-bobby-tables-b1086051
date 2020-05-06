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
    color: red;
    <?php 
    if ($fouteInlog == false) { ?>
        background: url(netland.png) no-repeat center center fixed;
    <?php } if ($fouteInlog == true) { ?>
        background: url(shrok.jpg) no-repeat center center fixed; 
    <?php } ?>
    background-size: cover;
    overflow: hidden;
}
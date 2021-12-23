<!-- This is admin login form -->
<?php
    if(session_start()){
        session_unset();
        session_destroy();
    }
?>

<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="../css/adminLogin.css">

        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
        <style>
        body {
            font-family: 'Roboto';
        }
        </style>
    </head>
    <body>
        <!-- set header -->
        <header>
            <div class="header-bar">
                <!--<div class="liitem" id="proName" style="float:left"><img src="../images/ceylon tea cloud-small.png" height="40px"></img></div>
                -->
                <div class="liitem" id="proName" style="float:left"></div>
                <div class="liitem" id="teaname">Ceylon Tea Cloud</div>
                <div class="liitem"><a href="../grower-ui/about.php" class="active">About</a></div>
            </div>
        </header>
        <main>

            <center>
                <div id= "logo">
                    <img src="../images/ceylon tea cloud-small.png">
                </div>  
            </center>

            <div class="container">
            <!-- set error messages -->
            <div>
                <?php
                    if(isset($_GET['ownerlogstat'])){
                        if($_GET['ownerlogstat'] == "logoutok"){
                            echo '<p class="logsuss">You are logged out.!</p>';
                        }
                        else{
                            echo '<p class="logerr">Unauthorized Access</p>';
                        }
                    }
                    if(isset($_GET['otpstatus'])){
                        if($_GET['otpstatus'] == "deleteacc"){
                            echo '<p class="logerr">Account Deleted</p>';
                        }
                    }
                ?>
            </div>
                <!-- login form -->
                <div id="logcont">
                    <p>Log-In</p>
                    <form action="../include/ownerLogin.inc.php" class="logform" method="post">
                        <label for="unameormail">Email*</label><br>
                        <input type="text" name="unameormail" placeholder="enter your email" size="30" class="flog">
                        <br>
                        <label for="pwd">Password*</label><br>
                        <input type="password" name="pwd" placeholder="enter your password" size="30" class="flog"><br>
                        <button type="submit" name="log-submit" class="logbutn">Login</button>
                    </form>
                    <br>
                </div>
            </div>
        </main>
    </body>
</html>
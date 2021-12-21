<?php
    session_start();

    if(!isset($_SESSION['growerId'])) // no session exists
    {
        header("Location:../grower-ui/index.php?growerLoginStatus=unauthorized");
        exit();
    }else
    {
        require_once "../phpClasses/HandleGrowerSession.class.php";
        $obj = new HandleGrowerSession();
        $res = $obj-> checkSession($_SESSION['sessionId'], $_SESSION['growerId']);
        unset($obj);

        if($res != SESSION_AVAILABLE){
            header("Location:../grower-ui/index.php?growerLoginStatus=logout");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link
                rel="stylesheet"
                href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
        />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../css/main-menu.css"/>
        <title>Menu</title>
    </head>

    <body>
        <div class="main-container">
            <div class="container">

            <center>
                <a href="../grower-ui/about.php">
                    <div id= "logo">
                        <img src="../images/ceylon tea cloud-small.png">
                    </div>
                </a>   
            </center>

                <h1 class="home-title" style="margin-top: 0px;">Menu</h1>
                <div class="grower-home-options-container">
                    <a style="text-decoration: none" href='notifications.php'>
                        <div class="grower-home-option">Notifications</div>
                    </a>
                    <a style="text-decoration: none" href='weekly-reports.php'>
                        <div class="grower-home-option">Weekly Reports</div>
                    </a>
                    <a style="text-decoration: none" href='monthly-reports.php'>
                        <div class="grower-home-option">Monthly Reports</div>
                    </a>
                    <a style="text-decoration: none" href='../request/sendRequest.php'>
                        <div class="grower-home-option">Sending a Request</div>
                    </a>
                    <a style="text-decoration: none" href='#'>
                        <div class="grower-home-option">Pending Requests</div>
                    </a>
                    <a style="text-decoration: none" href='#'>
                        <div class="grower-home-option">Confirmed Requests</div>
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
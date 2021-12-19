<?php
    session_start();
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
                <h1 class="home-title">Menu</h1>
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
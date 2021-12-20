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
        <link rel="stylesheet" href="../css/weekly-reports-list.css"/>
        <link rel="stylesheet" href="../css/main-menu.css"/>
        <link rel="stylesheet" href="../css/gorReq.css"/>
        <title>Sendeing Requsets</title>
    </head>

    <body>
        <div class="main-container">
            <div class="container">
                <?php 
                    if (isset($_GET['res'])){
                        if ($_GET['res'] == "sendss"){
                            echo '<p class="ss-response">Requset Send Success</p>';
                        }else if ($_GET['res'] == "sendf") {
                            echo '<p class="login-response">Requset Fail</p>';
                        }
                    }
                ?>  
                <h1 class="home-title">Send Requset</h1>

                <div class="grower-home-options-container">
                    <a style="text-decoration: none" href='fertilizerRequset.php'>
                        <div class="grower-home-option">Fertilizer</div>
                    </a>
                    <a style="text-decoration: none" href='TeaRequset.php'>
                        <div class="grower-home-option">Tea</div>
                    </a>
                    <a style="text-decoration: none" href='loanRequest.php'>
                        <div class="grower-home-option">Loan</div>
                    </a>
                    <a style="text-decoration: none" href='../main-ui/main-menu.php'>
                        <div class="grower-home-option">Back</div>
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
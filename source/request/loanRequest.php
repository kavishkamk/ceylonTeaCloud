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
        <link rel="stylesheet" href="../css/weekly-reports-list.css"/>
        <link rel="stylesheet" href="../css/main-menu.css"/>
        <link rel="stylesheet" href="../css/gorReq.css"/>
        <title>Loan Request</title>
    </head>

    <body>
        <div class="main-container">
            <div class="container">
                <div>
                    <?php 
                        if (isset($_GET['res'])){
                            if ($_GET['res'] == "empty"){
                                echo '<p class="login-response">Please Fill All Details</p>';
                            }else if ($_GET['res'] == "unauthorized") {
                                echo '<p class="login-response">Unauthorized Access</p>';
                            }
                        }
                    ?>
                </div>
                <h1 class="home-title">Loan Request</h1>
                <form action="LoanReqDisplay.php" method="post">
                    <div class="grower-home-options-container">
                        <div class="form-div">
                            <label for="num-amount">Amount (Rs.) &nbsp&nbsp: &nbsp&nbsp </label>
                            <?php
                                if(isset($_GET['resed'])){
                                    echo '<input type="number" name="num-amount" id="amount" value="'.$_GET["amount"].'">';
                                }
                                else{
                                    echo '<input type="number" name="num-amount" id="amount">';
                                }
                            ?>
                        </div>
                        <div class="form-div">
                            <label for="num-month">No. of months to pay: </label>
                            <?php
                                if(isset($_GET['resed'])){
                                    echo '<input type="number" name="num-month" value="'.$_GET["nmonth"].'">';
                                }
                                else{
                                    echo '<input type="number" name="num-month">';
                                }
                            ?>
                        </div>
                        <div class="form-div">
                            <?php
                                if(isset($_GET['resed'])){
                                    echo '<input type="hidden" name="hreason" value="'.$_GET["hreason"].'">';
                                }
                                else{
                                    echo '<input type="hidden" name="hreason" id="head" value ="">';
                                }
                            ?>
                        </div>
                        <div class="form-div">
                            <label for="reason">Reason &nbsp&nbsp: &nbsp&nbsp </label>
                            <?php
                                if(isset($_GET['resed'])){
                                    echo '<textarea id="ta" name="reason" rows="4" cols="50"></textarea>';
                                    echo '<script>document.getElementById("ta").value = "'.$_GET["reason"].'";</script>';
                                }
                                else{
                                    echo '<textarea name="reason" rows="4" cols="50"></textarea>';  
                                }
                            ?>
                        </div>
                        
                        <div>
                            <button type="submit" onclick="setHeader()" name="sub-fer" class="grower-home-option">Request</button>
                        </div>
                        
                        <a style="text-decoration: none" href='sendRequest.php'>
                            <div class="grower-home-option" id= "back-btn">Back</div>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

<script type="text/javascript">
    function setHeader() {
        var amount = document.getElementById("amount").value;
        var str = "Request for a loan of Rs." + amount + ".00/-";
        document.getElementById('head').value = str;
    }
</script>
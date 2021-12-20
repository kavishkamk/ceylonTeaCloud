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

    if(isset($_POST['sub-fer'])){
        $hreason = $_POST['hreason'];
        $reason = $_POST['reason'];
        $nMonth = $_POST['num-month'];
        $amount = $_POST['num-amount'];

        if(empty($hreason) || empty($reason) || empty($nMonth) || empty($amount)){
            header("Location:loanRequest.php?res=empty"); // empty field
            exit();
        }
    }
    else{
        header("Location:loanRequest.php"); // no session
        exit();
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
        <title>Sending Requests</title>
    </head>

    <body>
        <div class="main-container">
            <div class="container">
                <h1 class="home-title">Loan Request</h1>
                <form action="../include/loanReq.inc.php" method="post">
                <div class="grower-home-options-container">
                    <?php
                        echo '<div><label for="gid">ID No : '.sprintf("%04d", $_SESSION["growerId"]).'</label>';
                        echo '<input type="hidden" name="gid" value="'.$_SESSION["growerId"].'"></div>';

                        echo '<div><label for="nmonth">No. of months to pay : '.$nMonth.'</label>';
                        echo '<input type="hidden" name="nmonth" value="'.$nMonth.'"></div>';

                        echo '<div><label for="amount">Amount (Rs.) : '.$amount.'</label>';
                        echo '<input type="hidden" name="amount" value="'.$amount.'"></div>';

                        echo '<div><label></label><br><textarea rows="2" cols="40" readonly>'.$hreason.'</textarea>';
                        echo '<input type="hidden" name="hreason" value="'.$hreason.'"></div>';

                        echo '<div><label>Reason : </label><br><textarea rows="4" cols="40" readonly>'.$reason.'</textarea>';
                        echo '<input type="hidden" name="reason" value="'.$reason.'"></div>';
                    ?>
                    <div>
                        <button type="submit" name="f-com" class="grower-home-option">Confirm</button>
                    </div>
                    <?php echo '<a style="text-decoration: none" href="loanRequest.php?resed=edit&nmonth='.$nMonth.'&amount='.$amount.'&hreason='.$hreason.'&reason='.$reason.'">';?>;
                        <div class="grower-home-option">Edit</div>
                    </a>
                </div>
                </form>
            </div>
        </div>
    </body>
</html>
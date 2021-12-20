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
        $type = $_POST['tea-name'];
        $date = $_POST['w-date'];
        $nMonth = $_POST['num-month'];
        $amount = $_POST['num-amount'];

        if(empty($type) || empty($date) || empty($nMonth) || empty($amount)){
            header("Location:TeaRequset.php?res=empty"); // empty field
            exit();
        }
    }
    else{
        header("Location:TeaRequset.php"); // no session
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
        <title>Sending Requests</title>
    </head>

    <body>
        <div class="main-container">
            <div class="container">
                <h1 class="home-title">Tea Request</h1>
                <form action="../include/teaReq.inc.php" method="post">
                <div class="req-options-container">
                    <?php
                        echo '<div class= "words"><label for="gid">ID No : '.sprintf("%04d", $_SESSION["growerId"]).'</label>';
                        echo '<input type="hidden" name="gid" value="'.$_SESSION["growerId"].'"></div>';

                        echo '<div class= "words"><label for="ttype">Tea type : '.$type.'</label>';
                        echo '<input type="hidden" name="ttype" value="'.$type.'"></div>';

                        echo '<div class= "words"><label for="dayw">Required Date : '.$date.'</label>';
                        echo '<input type="hidden" name="dayw" value="'.$date.'"></div>';

                        echo '<div class= "words"><label for="nmonth">No. of months to pay : '.$nMonth.'</label>';
                        echo '<input type="hidden" name="nmonth" value="'.$nMonth.'"></div>';

                        echo '<div class= "words"><label for="amount">Amount (kg) : '.$amount.'</label>';
                        echo '<input type="hidden" name="amount" value="'.$amount.'"></div>';

                        require_once "../phpClasses/Items.class.php";
                        $priObj = new Items();
                        $price = $priObj -> getTeaPrice($type);
                        unset($priObj);

                        echo '<div class= "words"><label for="pri">Price : Rs.'.($price[0]["price_of_1kg"] * $amount).'</label>';
                        echo '<input type="hidden" name="pri" value="'.($price[0]["price_of_1kg"] * $amount).'"></div>';

                        echo '<input type="hidden" name="tid" value="'.($price[0]["type_id"]).'"></div>';
                    ?>
                    <div>
                        <button type="submit" name="t-com" class="grower-home-option">Confirm</button>
                    </div>
                    <?php echo '<a style="text-decoration: none" href="TeaRequset.php?resed=edit&type='.$type.'&date='.$date.'&nmonth='.$nMonth.'&amount='.$amount.'">';?>;
                        <div class="grower-home-option">Edit</div>
                    </a>
                </div>
                </form>
            </div>
        </div>
    </body>
</html>
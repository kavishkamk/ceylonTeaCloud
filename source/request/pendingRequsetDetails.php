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
        <link rel="stylesheet" type="text/css" href="../css/request.css">
    </head>
    <body>
    <div class="main-container">
        <?php
            require_once "../phpClasses/PendingRequset.class.php";
            $reqObj = new PendingRequest();
            if($_GET['type'] == "Fertilizer"){
                $reqRes = $reqObj->getFertilizerDetails($_GET['reqid']);
            }
            elseif($_GET['type'] == "Tea"){
                $reqRes = $reqObj->getTeaRequsetDetails($_GET['reqid']);
            }
            elseif($_GET['type'] == "Loan"){
                $reqRes = $reqObj->getLoneDetails($_GET['reqid']);
            }
            unset($reqObj);
        ?>
            <div class="container">
                <h1 class="home-title"><?php echo $_GET['type'] ?> Request</h1>
                <div class="grower-home-options-container">
                    <?php
                        if($_GET['type'] == "Fertilizer"){
                            echo '<div class= "words"><label for="gid">ID No : '.sprintf("%04d", $_SESSION["growerId"]).'</label></div>';
                            echo '<div class= "words"><label for="gid">Request Date : '.$reqRes[0]['req_date'].'</label></div>';
                            echo '<div class= "words"><label for="gid">Wanted Date : '.$reqRes[0]['date_wanted'].'</label></div>';
                            echo '<div class= "words"><label for="gid">Number of month : '.$reqRes[0]['number_of_months'].'</label></div>';
                            echo '<div class= "words"><label for="gid">Item Price : '.$reqRes[0]['item_price'].'</label></div>';
                            echo '<div class= "words"><label for="gid">Monthly Deduction : '.$reqRes[0]['monthly_deduction'].'</label></div>';
                            echo '<div class= "words"><label for="gid">Fertilizer Type : '.$reqRes[0]['fertilizer_type'].'</label></div>';
                        }
                        elseif($_GET['type'] == "Tea"){
                            echo '<div class= "words"><label for="gid">ID No : '.sprintf("%04d", $_SESSION["growerId"]).'</label></div>';
                            echo '<div class= "words"><label for="gid">Request Date : '.$reqRes[0]['req_date'].'</label></div>';
                            echo '<div class= "words"><label for="gid">Wanted Date : '.$reqRes[0]['date_wanted'].'</label></div>';
                            echo '<div class= "words"><label for="gid">Number of month : '.$reqRes[0]['number_of_months_to_pay'].'</label></div>';
                            echo '<div class= "words"><label for="gid">Item Price : '.$reqRes[0]['item_price'].'</label></div>';
                            echo '<div class= "words"><label for="gid">Monthly Deduction : '.$reqRes[0]['monthly_ded'].'</label></div>';
                            echo '<div class= "words"><label for="gid">Fertilizer Type : '.$reqRes[0]['tea_type'].'</label></div>';
                        }
                        elseif($_GET['type'] == "Loan"){
                            echo '<div class= "words"><label for="gid">ID No : '.sprintf("%04d", $_SESSION["growerId"]).'</label></div>';
                            echo '<div class= "words"><label for="gid">Request Date : '.$reqRes['req_date'].'</label></div>';
                            echo '<div class= "words"><label for="gid">Head</label><br><textarea rows="2" cols="40" readonly>'.$reqRes['loanHeader'].'</textarea>';
                            echo '<div class= "words"><label for="gid">Reason : </label><br><textarea rows="4" cols="40" readonly>'.$reqRes['discription'].'</textarea></div>';
                            echo '<div class= "words"><label for="gid">Number of month : '.$reqRes['number_of_months_to_pay'].'</label></div>';
                            echo '<div class= "words"><label for="gid">Item Price : '.$reqRes['amount'].'</label></div>';
                            echo '<div class= "words"><label for="gid">Monthly Deduction : '.$reqRes['monthly_ded'].'</label></div>';
                        }
                        
                        echo '<a style="text-decoration: none" href="pendingRequest.php?tt='.$_GET['tt'].'">
                        <div class="grower-home-option">Back</div>
                        </a>'
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
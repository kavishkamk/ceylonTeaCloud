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
        <title>Fertilizer Request</title>
    </head>

    <body>
        <div class="main-container">
            <div class="container">
                <div>
                    <?php 
                        if (isset($_GET['res'])){
                            if ($_GET['res'] == "empty"){
                                echo '<p class="login-response">Please fill all the details</p>';
                            }else if ($_GET['res'] == "unauthorized") {
                                echo '<p class="login-response">Unauthorized Access</p>';
                            }
                        }
                    ?>
                </div>
                <h1 class="home-title">Fertilizer Request</h1>
                <form action="fertilizerReqDisplay.php" method="post">
                    <div class="grower-home-options-container">
                        <?php
                            require_once "../phpClasses/Items.class.php";
                            $obj = new Items();
                            $fertilizerList = $obj->getFertilizerList();
                            unset($obj);
                            $fertilizerTypeList = array();
                            while($row = mysqli_fetch_assoc($fertilizerList)){
                                $fertilizerTypeList[] = $row['fertilizer_type'];
                            }
                        ?>
                        <div class="f-item" id="fertilizer-list-s">
                                    
                        </div>
                        <?php
                            $fertilizerOption = "";
                            foreach($fertilizerTypeList as $fertilizername) {
                                $temp = '<option value="'.$fertilizername.'">'.$fertilizername.'</option>';
                                $fertilizerOption .= $temp;
                            }
                            $setval = '<label for="fertilizer-name">Fertilizer Type &nbsp&nbsp: &nbsp&nbsp</label><select name="fertilizer-name">'.$fertilizerOption.'';
                            echo "<script>document.getElementById('fertilizer-list-s').innerHTML = '".$setval."';</script>";
                        ?>
                        <div class="form-div">
                            <label for="w-date">Required Date &nbsp&nbsp: &nbsp&nbsp </label>
                            <?php
                                if(isset($_GET['resed'])){
                                    echo '<input type="date" name="w-date" value="'.$_GET["date"].'">';
                                }
                                else{
                                    echo '<input type="date" name="w-date">';
                                }
                            ?>
                        </div>
                        <div class="form-div">
                            <label for="num-month">No. of months to pay &nbsp: &nbsp&nbsp </label>
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
                            <label for="num-amount">Amount (kg) &nbsp&nbsp: &nbsp&nbsp </label>
                            <?php
                                if(isset($_GET['resed'])){
                                    echo '<input type="number" name="num-amount" value="'.$_GET["amount"].'">';
                                }
                                else{
                                    echo '<input type="number" name="num-amount">';
                                }
                            ?>
                        </div>
                        <div>
                            <button type="submit" name="sub-fer" class="grower-home-option">Request</button>
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
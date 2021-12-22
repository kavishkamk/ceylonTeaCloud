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
        <title>Sending Requests</title>
    </head>

    <body>
        <?php
            require_once '../phpClasses/GrowerPendingRequest.class.php';
            $obj = new GrowerPendingRequest();
            $val = 0;
            if($_GET['tt'] == "1"){
                $val = 1;
            }
            $teaPending = $obj -> getTeaPendingRequsetForGivenGrower($val, $_SESSION['growerId']);
            $fertilizerPending = $obj -> getFretilizerPendingRequset($val, $_SESSION['growerId']);
            $loanPending = $obj-> getLonePendingRequestList($val, $_SESSION['growerId']);
            $req = array_merge($teaPending, $fertilizerPending, $loanPending);
            unset($obj);

        ?>
        <div class="main-container">
            <div class="container">
                <?php
                    if($_GET['tt'] == "1"){
                        echo '<h1 class="home-title">Confirmed Request</h1>';
                    }
                    else{
                        echo '<h1 class="home-title">Pending Request</h1>';
                    }
                ?>
                <div class="grower-home-options-container">
                    <?php
                        if(!empty($req)){
                            echo '<div class="tab">';
                                echo '<table>
                                    <tbody>';
                                            $count = 1;
                                            foreach ($req as $value) {
                                                echo '<tr>
                                                        <td>'.$count++.'</td>
                                                        <td>'.$value["req_date"].'</td>
                                                        <td> <a href="pendingRequsetDetails.php?reqid='.$value["req_id"].'&type='.$value['type'].'&tt='.$_GET['tt'].'">'.$value['type'].'</a></td>
                                                    </tr>';
                                            }
                                    echo '</tbody>
                                </table>';
                        
                            echo '</div>';
                        }
                        else{
                            echo '<span>Empty</span>';
                        }
                    ?>
                    <div style=" height: 10px;"></div>
                    <a style="text-decoration: none" href='../main-ui/main-menu.php'>
                        <div class="grower-home-option">Back</div>
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
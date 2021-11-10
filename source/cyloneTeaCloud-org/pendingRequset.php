<?php 
    session_start();

    if(!isset($_SESSION['ownerid'])){
         header("Location:../cyloneTeaCloud-org/ownerLogin.php?ownerlogstat=logoutok"); // no session
         exit();
    }
    else{
        require_once "../phpClasses/OwnerSessionHandle.class.php";
        $sessObj = new OwnerSessionHandle();
        $sessRes = $sessObj->checkSession($_SESSION['sessionId'], $_SESSION['ownerid']); // invalid session
        unset($sessObj);
        if($sessRes != "1"){
            header("Location:../cyloneTeaCloud-org/ownerLogin.php?ownerlogstat=logoutok"); // no session
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title> 
        <link rel="stylesheet" type="text/css" href="../css/adminDashBord.css">
    </head>
    <body>
        <div class="container">
            <nav>
                <div class="top-bar">
                    <form>
                        <button class="log-out-btn" formaction="../include/ownerLogout.inc.php">Log Out</button>
                    </form>
                </div>
            </nav>
            <main class="pending-main">
                <?php
                    require_once "../phpClasses/PendingRequset.class.php";
                    $obj = new PendingRequest();
                    $tearesult = $obj->getTeaPendingRequset();
                    $fretilizeRes = $obj->getFretilizerPendingRequset();
                    unset($obj);
                ?>
                <div class="request-table" style="grid-column:1 / 2;">
                    <table>
                        <thead>
                            <caption>Fertilizer request</caption>
                        </thead>
                        <tbody>
                            <?php
                                 while($row = mysqli_fetch_assoc($fretilizeRes)){
                                    echo '<tr>
                                            <td>'.$row["req_date"].'</td>
                                            <td> <a href="fertilizerRequset.php?reqid='.$row["req_id"].'&growid='.$row['id'].'">'.sprintf('%04d', $row['id']).'</a></td>
                                        </tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="request-table" style="grid-column:2 / 3;">
                    <table>
                        <thead>
                            <caption>Tea Request</caption>
                        </thead>
                        <tbody>
                            <?php
                                while($row = mysqli_fetch_assoc($tearesult)){
                                    echo '<tr>
                                            <td>'.$row["req_date"].'</td>
                                            <td> <a href="teaRequest.php?reqid='.$row["req_id"].'&growid='.$row['id'].'">'.sprintf('%04d', $row['id']).'</a></td>
                                        </tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="request-table" style="grid-column:3 / 4;">
                    <table>
                        <thead>
                            <caption>Lone Requset</caption>
                        </thead>
                        <tbody>
                            <?php

                            ?>
                            <tr>
                                <td>2021-1-1</td>
                                <td>ID-11111</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>

            <?php
                require "adminDashbordSideBar.php";
            ?>
        </div>
    </body>
</html>
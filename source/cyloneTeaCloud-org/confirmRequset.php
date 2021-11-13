<?php 
    require "sesseionCheck.php";
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
            <!-- log out -->
            <nav>
                <div class="top-bar">
                    <form>
                        <button class="log-out-btn" formaction="../include/ownerLogout.inc.php">Log Out</button>
                    </form>
                </div>
            </nav>
            <main class="pending-main">
                <?php
                    // get details of pending requset
                    require_once "../phpClasses/PendingRequset.class.php";
                    $obj = new PendingRequest();
                    $tearesult = $obj->getTeaPendingRequset(1);
                    $fretilizeRes = $obj->getFretilizerPendingRequset(1);
                    $loanRes = $obj->getLonePendingRequestList(1);
                    unset($obj);
                ?>
                <!-- set fertilizer requset table -->
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
                                            <td> <a href="fertilizerRequset.php?reqid='.$row["req_id"].'&growid='.$row['id'].'&conftyp=yes">'.sprintf('%04d', $row['id']).'</a></td>
                                        </tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- set tea requset table -->
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
                                            <td> <a href="teaRequest.php?reqid='.$row["req_id"].'&growid='.$row['id'].'&conftyp=yes">'.sprintf('%04d', $row['id']).'</a></td>
                                        </tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- set lone requset table -->
                <div class="request-table" style="grid-column:3 / 4;">
                    <table>
                        <thead>
                            <caption>Lone Requset</caption>
                        </thead>
                        <tbody>
                            <?php
                                 while($row = mysqli_fetch_assoc($loanRes)){
                                    echo '<tr>
                                            <td>'.$row["req_date"].'</td>
                                            <td> <a href="loneRequest.php?reqid='.$row["req_id"].'&growid='.$row['id'].'&conftyp=yes">'.sprintf('%04d', $row['id']).'</a></td>
                                        </tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
            <!-- set dash bord side bar -->
            <?php
                require "adminDashbordSideBar.php";
            ?>
        </div>
    </body>
</html>
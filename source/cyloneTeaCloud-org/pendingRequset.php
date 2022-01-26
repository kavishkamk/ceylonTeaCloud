<!-- this for pending requset display -->
<?php 
    require "sesseionCheck.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Pending Requests</title> 
        <link rel="stylesheet" type="text/css" href="../css/adminDashbord.css">
    </head>
    <body>
        <div class="container">
            <!-- navigatin bar with logout -->
            <nav>
                <div class="top-bar">
                    <form>
                        <button class="log-out-btn" formaction="../include/ownerLogout.inc.php">Log Out</button>
                    </form>
                </div>
            </nav>
            <main class="pending-main">
                <?php
                    // get requset details
                    require_once "../phpClasses/PendingRequset.class.php";
                    $obj = new PendingRequest();
                    $tearesult = $obj->getTeaPendingRequset(0);
                    $fretilizeRes = $obj->getFretilizerPendingRequset(0);
                    $loanRes = $obj->getLonePendingRequestList(0);
                    unset($obj);
                ?>
                <!-- set fertilizer table -->
                <div class="request-table" style="grid-column:1 / 2;">
                    <table>
                        <thead>
                            <caption>Fertilizer Requests</caption>
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
                <!-- set tea table -->
                <div class="request-table" style="grid-column:2 / 3;">
                    <table>
                        <thead>
                            <caption>Tea Packets Requests</caption>
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
                <!-- set lone requset table -->
                <div class="request-table" style="grid-column:3 / 4;">
                    <table>
                        <thead>
                            <caption>Loan Requests</caption>
                        </thead>
                        <tbody>
                            <?php
                                 while($row = mysqli_fetch_assoc($loanRes)){
                                    echo '<tr>
                                            <td>'.$row["req_date"].'</td>
                                            <td> <a href="loneRequest.php?reqid='.$row["req_id"].'&growid='.$row['id'].'">'.sprintf('%04d', $row['id']).'</a></td>
                                        </tr>';
                                }
                            ?>
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
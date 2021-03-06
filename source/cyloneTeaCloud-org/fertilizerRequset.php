<?php

    require "sesseionCheck.php";
    
    if(!isset($_GET['reqid']) || !isset($_GET['growid'])){
        header("Location:pendingRequset.php"); // no session
        exit();
    }

    $growerId = $_GET['growid'];
    $requsetId = $_GET['reqid'];

    // get company details
    require_once "../phpClasses/CompanyDeatils.class.php";
    $comObj = new CompanyDetails();
    $comRes = $comObj->getCompanyDetails();
    unset($comObj);

    // get grower details
    require_once "../phpClasses/GrowerDetails.class.php";
    $groObj = new GrowerDetails();
    $groRes = $groObj->getGrowerDetailsUsingId($growerId);
    unset($groObj);

    //  get pending requset details
    require_once "../phpClasses/PendingRequset.class.php";
    $reqObj = new PendingRequest();
    $reqRes = $reqObj->getFertilizerDetails($requsetId);
    unset($reqObj);

    $row1 = $reqRes[0];
    $total_price = 0;
    $total_deduction = 0;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Fertilizer Request</title> 
        <link rel="stylesheet" type="text/css" href="../css/doucmunets.css">
        <link rel="stylesheet" type="text/css" href="../css/print.css" media="print">
    </head>
    <body>
        <header class="doc-header">
            <!-- set logo -->
            <div style="grid-column:2 / 3;">
                <img src="../images/ceylon tea cloud-small.png" class="logo"></img>
            </div>
            <!-- set company details to header -->
            <div class="company-details" style="grid-column:3 / 4;">
                <?php
                    echo '<span style="font-size:20px;">'.$comRes["name"].'</span><br>';
                    $str_arr = explode (",", $comRes['address']);
                    foreach($str_arr as $addres){
                        echo '<span style="font-size:15px">'.$addres.',</span><br>';
                    }
                    echo '<span style="font-size:15px">Email : '.$comRes["email"].'</span><br>';
                    echo '<span style="font-size:15px">Phone : 0'.$comRes["contactNo"].'</span><br><br>';
                    echo '<span style="font-size:15px">Fertilizer Request</span><br>';
                    echo '<span style="font-size:15px">Requested Date: '.$row1['req_date'].'</span><br>';
                    echo '<span style="font-size:15px">Requested ID: '.$requsetId.'</span><br>';
                ?>
            </div>
        </header>
        <hr style="width:90%;">
        <main class="doc-main">
            <div class="client-details" style="grid-column:2 / 3;">
            <!-- set grower details -->
                <div style="grid-column:1 / 2;">
                    <?php
                        echo '<span>From : '.$groRes["name"].'</span><br>';
                        echo '<span>Address : '.$groRes["address"].'</span><br>';
                        echo '<span>Email : '.$groRes["email"].'</span><br>';
                    ?>
                </div>
                <div style="grid-column:2 / 3;">
                    <?php
                        echo '<span>ID No : '.sprintf('%04d', $growerId).'</span><br>';
                        echo '<span>Phone : 0'.$groRes["tele"].'</span><br>';
                    ?>
                </div>
            </div>
            <!-- set requseted fertilizer types with price -->
            <div style="grid-column:2 / 3;" class="rec-table">
                <table>
                    <thead>
                        <caption>Requested Items</caption>
                            <tr>
                                <th></th>
                                <th>Item Name</th>
                                <td>Price (Rs.)</td>
                                <td>Amount (kg)</td>
                            </tr>
                    </thead>
                        <tbody>
                            <?php
                            $count = 1;
                                foreach($reqRes as $row){
                                    $total_price += $row['item_price'];
                                    $total_deduction += $row['monthly_deduction'];
                                    echo '<tr>
                                            <td>'.$count.'</td>
                                            <td>'.$row["fertilizer_type"].'</td>
                                            <td>'.number_format($row["item_price"],2).'</td>
                                            <td>'.$row["amount"].'</td>
                                        </tr>';
                                    $count++;
                                }
                            ?>
                        </tbody>
                    </table>
            </div>
            <!-- set requested details -->
            <div style="grid-column:2 / 3;" class="rec-table">
                <table>
                    <thead>
                        <caption>Request Details</caption>
                    </thead>
                    <tbody>
                        <?php
                            echo '<tr>
                                <td> 1 </td>
                                <td>Required Date</td>
                                <td>'.$row['date_wanted'].'</td>
                            </tr>
                            <tr>
                                <td> 2 </td>
                                <td>No. of Months to pay</td>
                                <td>'.$row['number_of_months'].'</td>
                            </tr>
                            <tr>
                                <td> 3 </td>
                                <td>Total Price</td>
                                <td>Rs. '.number_format($total_price,2).'</td>
                            </tr>
                            <tr>
                                <td> 4 </td>
                                <td>Monthly Deduction</td>
                                <td>Rs. '.number_format($total_deduction,2).'</td>
                            </tr>';
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- confirm success message and report genarated time -->
            <div style="grid-column:2 / 3;" class="rec-det">
                <br><br>
                <?php echo '<div style="grid-column:1 / 2;"><span class="re-time">Genarated Date : '.date("Y-n-d H:i:s").'</span></div>';
                    if(isset($_GET['result'])){
                        echo '<div><span id="comfirm-success">This request is confirmed successfully</span></div>';
                    }
                ?>
            </div>
            <div style="grid-column:2 / 3;" class="button-field">
                <!-- set back button -->
                <div>
                    <form>
                        <?php
                            if(!isset($_GET['conftyp'])){
                                echo '<button class="btn" formaction="pendingRequset.php">Back</button>';
                            }
                            else{
                                echo '<button class="btn" formaction="confirmRequset.php">Back</button>';
                            }
                        ?>
                    </form>
                </div>
                <!-- requset confirm button -->
                <div>
                    <form action="../include/requestComfirm.inc.php" method="post">
                        <?php echo '<input type="hidden" name="req-id" value="'.$requsetId.'">'; 
                                echo '<input type="hidden" name="gro-id" value="'.$growerId.'">';
                                echo '<input type="hidden" name="report-type" value="fer">';
                                if(!isset($_GET['conftyp'])){
                                    echo '<button type = "submit" name="request-comfirm" class="btn">Confirm</button>';
                                }
                        ?>
                    </form>
                </div>
                <!-- print or save button -->
                <div>
                    <button onclick="window.print();" class="btn">Save or Print</button>
                </div>
            </div>
        </main>
    </body>
</html>
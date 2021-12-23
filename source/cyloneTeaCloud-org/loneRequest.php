<?php
    // this is lone requset report
    require "sesseionCheck.php";

    // check relevent url condition
    if(!isset($_GET['reqid']) || !isset($_GET['growid'])){
        header("Location:pendingRequset.php"); // no session
        exit();
    }

    // get url data
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

    // get pending lone requset details
    require_once "../phpClasses/PendingRequset.class.php";
    $reqObj = new PendingRequest();
    $reqRes = $reqObj->getLoneDetails($requsetId);
    unset($reqObj);

    $total_price = 0;
    $total_deduction = 0;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Loan Request</title> 
        <link rel="stylesheet" type="text/css" href="../css/doucmunets.css">
        <link rel="stylesheet" type="text/css" href="../css/print.css" media="print">
    </head>
    <body>
        <header class="doc-header">
            <!-- set logo -->
            <div style="grid-column:2 / 3;">
                <img src="../images/ceylon tea cloud-small.png" class="logo"></img>
            </div>
            <!-- set company details -->
            <div class="company-details" style="grid-column:3 / 4;">
                <?php
                    echo '<span style="font-size:20px;">'.$comRes["name"].'</span><br>';
                    $str_arr = explode (",", $comRes['address']);
                    foreach($str_arr as $addres){
                        echo '<span style="font-size:15px">'.$addres.',</span><br>';
                    }
                    echo '<span style="font-size:15px">Email : '.$comRes["email"].'</span><br>';
                    echo '<span style="font-size:15px">Phone : 0'.$comRes["contactNo"].'</span><br><br>';
                    echo '<span style="font-size:15px">Loan Request</span><br>';
                    echo '<span style="font-size:15px">Requested Date: '.$reqRes['req_date'].'</span><br>';
                    echo '<span style="font-size:15px">Requested ID: '.$requsetId.'</span><br>';
                ?>
            </div>
        </header>
        <hr style="width:90%;">
        <main class="doc-main">
            <!-- set grower details -->
            <div class="client-details" style="grid-column:2 / 3;">
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
            <div style="grid-column:2 / 3;" class="rec-table">
                <?php
                    echo '<p class="loan-head">'.$reqRes['loanHeader'].'</p>';
                    echo '<p class="lone-dis">'.$reqRes['discription'].'</p>';
                ?>
            </div>
            <!-- set requset date table -->
            <div style="grid-column:2 / 3;" class="rec-table">
                <table>
                    <thead>
                        <caption>Request Details</caption>
                    </thead>
                    <tbody>
                        <?php
                            echo '<tr>
                                <td> 1 </td>
                                <td>Amount</td>
                                <td>Rs. '.number_format($reqRes['amount'],2).'</td>
                            </tr>
                            <tr>
                                <td> 2 </td>
                                <td>No. of months to pay</td>
                                <td>'.$reqRes['number_of_months_to_pay'].'</td>
                            </tr>
                            <tr>
                                <td> 3 </td>
                                <td>Monthly Deduction</td>
                                <td>Rs. '.number_format($reqRes['monthly_ded'],2).'</td>
                            </tr>';
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- set genarated time and confirm message -->
            <div style="grid-column:2 / 3;" class="rec-det">
                <br><br>
                <?php echo '<div style="grid-column:1 / 2;"><span class="re-time">Generated Date : '.date("Y-n-d H:i:s").'</span></div>';
                    if(isset($_GET['result'])){
                        echo '<div><span id="comfirm-success">This request is confirmed successfully</span></div>';
                    }
                ?>
            </div>
            <!-- buttons -->
            <div style="grid-column:2 / 3;" class="button-field">
                <!-- back -->
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
                <!-- confirm -->
                <div>
                    <form action="../include/requestComfirm.inc.php" method="post">
                        <?php echo '<input type="hidden" name="req-id" value="'.$requsetId.'">'; 
                                echo '<input type="hidden" name="gro-id" value="'.$growerId.'">';
                                echo '<input type="hidden" name="report-type" value="lone">';
                                if(!isset($_GET['conftyp'])){
                                    echo '<button type = "submit" name="request-comfirm" class="btn">Confirm</button>';
                                }
                        ?>
                    </form>
                </div>
                <!-- print or download -->
                <div>
                    <button onclick="window.print();" class="btn">Save or Print</button>
                </div>
            </div>
        </main>
    </body>
</html>
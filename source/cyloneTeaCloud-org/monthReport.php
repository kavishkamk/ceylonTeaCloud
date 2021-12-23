<?php 
    require "sesseionCheck.php";

    if(!isset($_GET['groid']) || !isset($_GET['reportid'])){
        header("Location:monthlyReport.php"); // no session
        exit();
    }

    $growerId = $_GET['groid'];
    $reportId = $_GET['reportid'];

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
    require_once "../phpClasses/MonthReport.class.php";
    $reqObj = new MonthReport();
    $reqRes = $reqObj->getMonthReportDetails($reportId);
    $teaReqDetails = $reqObj->getTeaRequsetDetails($reportId);
    $fertilezeReqDetails = $reqObj->getFertilizerDetails($reportId);
    $loneReqDetails = $reqObj->getLoneDetails($reportId);
    $weekRepoDetails = $reqObj->getDeductionDetails($reportId);
    $newReportDetails = $reqObj->getNetWeightDetails($reportId);
    unset($reqObj);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Monthly Report</title> 
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
                    echo '<span style="font-size:15px">Monthly Report</span><br>';
                    echo '<span style="font-size:15px">Reported Month : '.$reqRes['repott_year'].' - '.$reqRes['repott_month'].'</span><br>';
                    echo '<span style="font-size:15px">Reported ID: '.$reportId.'</span><br>';
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
                        <caption>Report Details</caption>
                    </thead>
                    <tbody>
                        <?php
                            echo '<tr>
                                    <td> 1 </td>
                                    <td>Total Net Weight</td>
                                    <td>'.$reqRes['total_weight'].' kg</td>
                                </tr>
                                <tr>
                                    <td> 2 </td>
                                    <td>Total Deduction for month</td>
                                    <td>Rs. '.$reqRes['total_deducation_per_month'].'</td>
                                </tr>
                                <tr>
                                    <td> 3 </td>
                                    <td>Price of 1 kg</td>
                                    <td>Rs. '.$reqRes['price_of_1kg'].'</td>
                                </tr>
                                <tr>
                                    <td> 4 </td>
                                    <td>Tea Leaves Price</td>
                                    <td>Rs. '.$reqRes['total_price'].'</td>
                                </tr>
                                <tr>
                                    <td> 5 </td>
                                    <td>Payment</td>
                                    <td>Rs. '.$reqRes['payment'].'</td>
                                </tr>';
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- set requseted tea types with price -->
            <div style="grid-column:2 / 3;" class="rec-table">
                <table>
                    <thead>
                        <caption>Tea Packets Request details</caption>
                            <tr>
                                <th></th>
                                <th>Item Name</th>
                                <td>Total Price</td>
                                <td>Monthly Deduction</td>
                            </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                            foreach($teaReqDetails as $row){
                                echo '<tr>
                                        <td>'.$count.'</td>
                                        <td>'.$row["tea_type"].'</td>
                                        <td>Rs. '.number_format($row["item_price"],2).'</td>
                                        <td>Rs. '.number_format($row["monthly_ded"],2).'</td>
                                    </tr>';
                                $count++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- set requseted fertilizer types with price -->
            <div style="grid-column:2 / 3;" class="rec-table">
                <table>
                    <thead>
                        <caption>Fertilizer Request details</caption>
                            <tr>
                                <th></th>
                                <th>Item Name</th>
                                <td>Total Price</td>
                                <td>Monthly Deduction</td>
                            </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                            foreach($fertilezeReqDetails as $row){
                                echo '<tr>
                                        <td>'.$count.'</td>
                                        <td>'.$row["fertilizer_type"].'</td>
                                        <td>Rs. '.number_format($row["item_price"],2).'</td>
                                        <td>Rs. '.number_format($row["monthly_deduction"],2).'</td>
                                    </tr>';
                                $count++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- set requseted lone with price -->
            <div style="grid-column:2 / 3;" class="rec-table">
                <table>
                    <thead>
                        <caption>Loan Request details</caption>
                            <tr>
                                <th></th>
                                <td>Total Amount</td>
                                <td>Monthly Deduction</td>
                                <td>Reason</td>
                            </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                            foreach($loneReqDetails as $row){
                                echo '<tr>
                                        <td>'.$count.'</td>
                                        <td>Rs. '.number_format($row["amount"],2).'</td>
                                        <td>Rs. '.number_format($row["monthly_ded"],2).'</td>
                                        <td>'.$row["loanHeader"].'</td>
                                    </tr>';
                                $count++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- week report details -->
            <div style="grid-column:2 / 3;" class="rec-table">
                <table>
                    <thead>
                        <caption>Weekly Reports</caption>
                            <tr>
                                <th></th>
                                <td>Date</td>
                                <td>Total weight(kg)</td>
                                <td>Sack weight(kg)</td>
                                <td>Non-standard Leaves(kg)</td>
                                <td>Water weight(kg)</td>
                                <td>Other Deduction</td>
                                <td>Other Deduction Weight(kg)</td>
                                <td>Net Weight(kg)</td>
                            </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                            foreach($weekRepoDetails as $row){
                                echo '<tr>
                                        <td>'.$count.'</td>
                                        <td>'.$row["dayrec"].'</td>
                                        <td>'.$row["total_weight"].'</td>
                                        <td>'.$row["sack_waight"].'</td>
                                        <td>'.$row["non_standard_leaves"].'</td>
                                        <td>'.$row["water_weigth"].'</td>
                                        <td>'.$row["reason"].'</td>
                                        <td>'.$row["weightOfDeduction"].'</td>
                                        <td>'.$newReportDetails[$row["data_id"]]["weight"].'</td>
                                    </tr>';
                                $count++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- genarated time and success message -->
            <div style="grid-column:2 / 3;" class="rec-det">
                <br><br>
                <?php
                    if(isset($_GET['result'])){
                        echo '<div><span id="comfirm-success">Comfirm Success</span></div>';
                    }
                ?>
            </div>
            <!-- button -->
            <div style="grid-column:2 / 3;" class="button-field">
                <!-- back -->
                <div>
                    <form>
                        <?php
                            echo '<button class="btn" formaction="monthlyReport.php">Back</button>';
                        ?>
                    </form>
                </div>
                <div>
                </div>
                <!-- print or save -->
                <div>
                    <button onclick="window.print();" class="btn">Save or Print</button>
                </div>
            </div>
        </main>
    </body>
</html>
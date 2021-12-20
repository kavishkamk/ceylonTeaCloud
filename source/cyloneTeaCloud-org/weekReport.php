<?php
    // this is week requset report
    require "sesseionCheck.php";

    // check relavent url data
    if(!isset($_GET['reportId']) || !isset($_GET['groid'])){
        header("Location:weeklyReport.php"); // no session
        exit();
    }

    // get url data
    $growerId = $_GET['groid'];
    $reporttId = $_GET['reportId'];
    $stDay = $_GET['stday'];
    $edDay = $_GET['endday'];

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

    // get week report details
    require_once "../phpClasses/WeekReport.class.php";
    $reqObj = new WeekReport();
    $reqRes = $reqObj->getMainDeduction($reporttId);
    $netRes = $reqObj->getNetWeightResult($reporttId);
    unset($reqObj);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title> 
        <link rel="stylesheet" type="text/css" href="../css/doucmunets.css">
        <link rel="stylesheet" type="text/css" href="../css/print.css" media="print">
    </head>
    <body>
        <header class="doc-header">
            <!-- set logo -->
            <div style="grid-column:2 / 3;">
                <img src="../images/ceylon tea cloud-small.png" class="logo"></img>
            </div>
            <!-- set company deatils -->
            <div class="company-details" style="grid-column:3 / 4;">
                <?php
                    echo '<span style="font-size:20px;">'.$comRes["name"].'</span><br>';
                    $str_arr = explode (",", $comRes['address']);
                    foreach($str_arr as $addres){
                        echo '<span style="font-size:15px">'.$addres.',</span><br>';
                    }
                    echo '<span style="font-size:15px">Email : '.$comRes["email"].'</span><br>';
                    echo '<span style="font-size:15px">Phone : 0'.$comRes["contactNo"].'</span><br><br>';
                    echo '<span style="font-size:15px">Week Report</span><br>';
                    echo '<span style="font-size:15px">'.$stDay.' - '.$edDay.'</span><br>';
                    echo '<span style="font-size:15px">Report ID: '.$reporttId.'</span><br>';
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
            <!-- set week report details -->
            <div style="grid-column:2 / 3;" class="rec-table">
                <table>
                    <thead>
                        <caption>Report Details</caption>
                    </thead>
                    <tbody>
                        <?php
                            echo '<tr>
                                <td> 1 </td>
                                <td>Date</td>
                                <td>'.$reqRes['date'].'</td>
                            </tr>
                            <tr>
                                <td> 2 </td>
                                <td>Total Weight (kg)</td>
                                <td>'.$reqRes['total_weight'].'</td>
                            </tr>
                            <tr>
                                <td> 3 </td>
                                <td>Number of Sacks</td>
                                <td>'.$reqRes['number_of_sacks'].'</td>
                            </tr>
                            <tr>
                                <td> 4 </td>
                                <td>Sack Weight (kg)</td>
                                <td>'.$reqRes['sack_waight'].'</td>
                            </tr>
                            <tr>
                                <td> 5 </td>
                                <td>Non Standerd Leaves (kg)</td>
                                <td>'.$reqRes['non_standard_leaves'].'</td>
                            </tr>
                            <tr>
                                <td> 6 </td>
                                <td>Water Weight (kg)</td>
                                <td>'.$reqRes['water_weigth'].'</td>
                            </tr>
                            <tr>
                                <td> 7 </td>
                                <td>Other deduction Reason</td>
                                <td>'.$reqRes['reason'].'</td>
                            </tr>
                            <tr>
                                <td> 8 </td>
                                <td>Other Deduction (kg)</td>
                                <td>'.$reqRes['weightOfDeduction'].'</td>
                            </tr>
                            <tr>
                                <td> 9 </td>
                                <td>Net Weight</td>
                                <td>'.$netRes.'</td>
                            </tr>';
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- genarated time and success message -->
            <div style="grid-column:2 / 3;" class="rec-det">
                <br><br>
                <?php echo '<div style="grid-column:1 / 2;"><span class="re-time">Genarated Date : '.date("Y-n-d H:i:s").'</span></div>';
                ?>
            </div>
            <!-- button -->
            <div style="grid-column:2 / 3;" class="button-field">
                <!-- back -->
                <div>
                    <form>
                        <?php
                            echo '<button class="btn" formaction="weeklyReport.php">Back</button>';
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
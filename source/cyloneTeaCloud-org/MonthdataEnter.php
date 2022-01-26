<?php 
    require "sesseionCheck.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Data Enter</title> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/adminDashbord.css">
        <link rel="stylesheet" type="text/css" href="../css/dateEnter.css">
    </head>
    <body>
        <div class="container">
            <!-- log out -->
            <nav>
                <div class="top-bar" style="text-align: center;">
                <!-- message display -->
                    <div style="grid-column:2 / 3;">
                        <?php
                            if(isset($_GET['result'])){
                                if($_GET['result'] == "empty"){
                                    echo '<span>Please enter valid basic details</span>';
                                }
                                else if($_GET['result'] == "ss"){
                                    echo '<span>Monthly report successfully created</span>';
                                }
                                else if($_GET['result'] == "nouser"){
                                    echo '<span>Invalid grower ID</span>';
                                }
                                else if($_GET['result'] == "sqlerror"){
                                    echo '<span>Something went wrong</span>';
                                }
                                else if($_GET['result'] == "wrong"){
                                    echo '<span>Invalid input</span>';
                                }
                            }
                        ?>
                    </div>
                    <div style="grid-column:3 / 4;">
                        <form>
                            <button class="log-out-btn" formaction="../include/ownerLogout.inc.php">Log Out</button>
                        </form>
                    </div>
                </div>
            </nav>
            <main class="weekReport">
                <div>
                    <div class="month-div">
                        <div>
                            <form class="data-form" method="post">
                                <h3>Basic details</h3>
                                <label for="input-month">Select Month : </label>
                                <input type="month" name="input-month"><br>
                                <label for="grower-id">ID : </label>
                                <input type="number" name="grower-id"><br>
                                <button formaction="MonthdataEnter.php" name="basic-submit">Get Details</button>
                            </form>
                        </div>
                        <div>
                            <?php
                                $totalFinalMonth = 0;
                                $fullWeight = 0;
                                $teaRequsetPrive = 0;
                                $fertilizerReqPrice = 0;
                                $lonePrice = 0;
                                $teaRequsetArray = array();
                                $loanDetails = array();
                                $fertiliZeRequsetArray = array();
                                $tealId = "";
                                $fertilizelId = "";
                                $lonelId = "";
                                $reportlId = "";
                                $grower_id = 0;
                                $month = 0;
                                $year = 0;
                                if(isset($_POST['basic-submit'])){
                                    $yeMonth = $_POST['input-month'];
                                    $grower_id = $_POST['grower-id'];
                                    if(!empty($yeMonth) && !empty($grower_id)){
                                        echo '<span>Month : '.$yeMonth.'</span><br>';
                                        echo '<span>Grower ID : '.$grower_id.'</span><br>';
                                        $year = substr($yeMonth, 0, 4);
                                        $month = substr($yeMonth, 5);
                                        $d=cal_days_in_month(CAL_GREGORIAN,$month,$year);
                                        $d = $d - 1;
                                        $date=date_create("$year-$month-1"); 
                                        $sDate = date_format($date,"Y-n-d");
                                        $endDate = date('Y-n-d', strtotime($sDate . ' +'.$d.' day'));
                                        require_once "../phpClasses/MonthReport.class.php";
                                        $MonthObj = new MonthReport();
                                        $res = $MonthObj->getReportIdList($grower_id, $sDate, $endDate);
                                        $teaReaId = $MonthObj->getTeaPrices($grower_id);
                                        $fertilizeId = $MonthObj->getFertilizerPrice($grower_id);
                                        $loanDetails = $MonthObj->getLonePriceId($grower_id);
                                        foreach($teaReaId as $teaIdval){
                                            $tealId .= $teaIdval['req_id'];
                                            $tealId .= "-";
                                            $teaRequsetArray[] = $MonthObj->getTeaReqDeductions($teaIdval['req_id']);
                                        }
                                        foreach($fertilizeId as $ferIdval){
                                            $fertilizelId .= $ferIdval['req_id'];
                                            $fertilizelId .= "-";
                                            $fertiliZeRequsetArray[] = $MonthObj->getFertilizerDeductions($ferIdval['req_id']);
                                        }
                                        unset($MonthObj);
                                        $resArr = array();
                                        $netArr = array();
                                        require_once "../phpClasses/WeekReport.class.php";
                                        $weekObj = new WeekReport();
                                        foreach($res as $recId){
                                            $reportlId .= $recId;
                                            $reportlId .= "-";
                                            $resArr[$recId] = $weekObj->getMainDeduction($recId);
                                            $netArr[$recId] = $weekObj->getNetWeightResult($recId);
                                        }
                                        unset($weekObj);
                                    }
                                }
                            ?>

                            <table>
                                <thead>
                                    <caption>Generated Reports</caption>
                                </thead>
                                <tbody>
                                    <?php
                                        if(isset($_POST['basic-submit'])){
                                            if(!empty($yeMonth) && !empty($grower_id)){
                                                echo '<tr>
                                                        <td>Total Weight</td>';
                                                foreach($res as $resId){
                                                   echo '<td>'.$resArr[$resId]['total_weight'].'</td>';
                                                   $fullWeight = $fullWeight + $resArr[$resId]['total_weight'];
                                                }
                                                echo '</tr>';
                                                echo '<tr>
                                                        <td>Sacks Weight</td>';
                                                foreach($res as $resId){
                                                   echo '<td>'.$resArr[$resId]['sack_waight'].'</td>';
                                                }
                                                echo '</tr>';
                                                echo '<tr>
                                                        <td>Water Weight</td>';
                                                foreach($res as $resId){
                                                   echo '<td>'.$resArr[$resId]['water_weigth'].'</td>';
                                                }
                                                echo '</tr>';
                                                echo '<tr>
                                                        <td>Non-standard Leaves Weight</td>';
                                                foreach($res as $resId){
                                                   echo '<td>'.$resArr[$resId]['non_standard_leaves'].'</td>';
                                                }
                                                echo '</tr>';
                                                echo '<tr>
                                                        <td>Other Deduction</td>';
                                                foreach($res as $resId){
                                                    if($resArr[$resId]['weightOfDeduction'] == "" || $resArr[$resId]['weightOfDeduction'] == NULL) {
                                                        $resArr[$resId]['weightOfDeduction'] = 0;
                                                    }
                                                   echo '<td>'.$resArr[$resId]['weightOfDeduction'].'</td>';
                                                }
                                                echo '</tr>';
                                                echo '<tr>
                                                        <td>Net Weight</td>';
                                                foreach($res as $resId){
                                                    if($netArr[$resId] == "nouser") {
                                                        $netArr[$resId] = 0;
                                                    }
                                                    $totalFinalMonth = $totalFinalMonth + $netArr[$resId];
                                                   echo '<td>'.$netArr[$resId].'</td>';
                                                }
                                                echo '</tr>';
                                            }
                                        }
                                    ?>   
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <?php
                                $count = 0;
                                foreach($teaRequsetArray as $reqpric){
                                    $teaRequsetPrive = $teaRequsetPrive + $reqpric[$count]['monthly_ded'];
                                }
                                $count = 0;
                                foreach($fertiliZeRequsetArray as $ferprice){
                                    $fertilizerReqPrice = $fertilizerReqPrice + $ferprice[$count]['monthly_deduction'];
                                }
                                foreach($loanDetails as $lonePri){
                                    $lonelId .= $lonePri['req_id'];
                                    $lonelId .= "-";
                                    $lonePrice = $lonePrice + $lonePri['monthly_ded'];
                                }
                                echo '<span>Total Net Weight : '.$totalFinalMonth.'</span><br>';
                                echo '<span>Loan Deduction : '.$lonePrice.'</span><br>';
                                echo '<span>Tea packets Deduction : '.$teaRequsetPrive.'</span><br>';
                                echo '<span>Fertilizer Deduction : '.$fertilizerReqPrice.'</span><br>';
                            ?>
                            <form action="../include/setMonthReport.php" method="post">
                                <?php
                                    echo '<input type="hidden" name="final-wait" value="'.$totalFinalMonth.'" id="final-w">';
                                    echo '<input type="hidden" name="loan-price" value="'.$lonePrice.'" id="lone-w">';
                                    echo '<input type="hidden" name="tea-price" value="'.$teaRequsetPrive.'" id="tea-w">';
                                    echo '<input type="hidden" name="fertilizer-price" value="'.$fertilizerReqPrice.'" id="fertilizer-w">';
                                    echo '<input type="hidden" name="tea-id" value="'.$tealId.'">';
                                    echo '<input type="hidden" name="lone-id" value="'.$lonelId.'">';
                                    echo '<input type="hidden" name="fertilize-id" value="'.$fertilizelId.'">';
                                    echo '<input type="hidden" name="report-id" value="'.$reportlId.'">';
                                    echo '<input type="hidden" name="grow-id" value="'.$grower_id.'">';
                                    echo '<input type="hidden" name="r-month" value="'.$month.'">';
                                    echo '<input type="hidden" name="r-year" value="'.$year.'">';
                                ?>
                                <br>
                                <label for="price-tea">Price of 1 kg : </label>
                                <input type="number" name="price-tea" step="0.01" id="price-input"><br>
                                <br>
                                <span id="payment-s">Payment : </span><br>
                                <button type="button" name="price-submit" id="price-submit-btn">Calculate</button>
                                <button type="submit" name="create-report">Create Report</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <?php
                require "adminDashbordSideBar.php";
            ?>
        </div>
    </body>
</html>

<script>
    $("#price-submit-btn").click(function(){
        var finalw = 0;
        var loanp = 0;
        var teap = 0;
        var fertilizerp = 0;
        var priceof1 = 0;
        var finalprice = 0;

        var tempfinalw = document.getElementById('final-w').value;
        var tempLoan = document.getElementById('lone-w').value;
        var tempTea = document.getElementById('tea-w').value;
        var tempFer = document.getElementById('fertilizer-w').value;
        var temppriceof1 = document.getElementById('price-input').value;

        if(!(tempfinalw == null || tempfinalw == "") && !(temppriceof1 == null || temppriceof1 == "")){
            finalw = tempfinalw;
            priceof1 = temppriceof1;
            if(!(tempLoan == null || tempLoan == "")){
                loanp = tempLoan;
            }
            if(!(tempTea == null || tempTea == "")){
                teap = tempTea;
            }
            if(!(tempFer == null || tempFer == "")){
                fertilizerp =tempFer; 
            }
            var loantotal = parseFloat(loanp) + parseFloat(teap) + parseFloat(fertilizerp);
            finalprice = parseFloat((finalw * priceof1)) - parseFloat(loantotal);
            document.getElementById('payment-s').innerHTML = "payment : " + finalprice;
        }
    });
</script>

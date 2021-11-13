<?php 
    require "sesseionCheck.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/adminDashBord.css">
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
                                    echo '<span>Should have to enter basic Details</span>';
                                }
                                else if($_GET['result'] == "ss"){
                                    echo '<span>success</span>';
                                }
                                else if($_GET['result'] == "nouser"){
                                    echo '<span>grour not found</span>';
                                }
                                else if($_GET['result'] == "sqlerror"){
                                    echo '<span>Error</span>';
                                }
                                else if($_GET['result'] == "wrong"){
                                    echo '<span>Wrong input</span>';
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
                    <form method="post" class="data-form">
                        <div class="data-div">
                            <div>
                                <h3>Basic details</h3>
                                <label for="input-date">Date : </label>
                                <input type="datetime-local" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}" name="input-date"><br>
                                <label for="grower-id">ID : </label>
                                <input type="number" name="grower-id"><br>
                                <label for="num-sac">No of sacks : </label>
                                <input type="number" name="num-sac"><br>
                                <label for="weight">Weight (kg) : </label>
                                <input type="number" name="weight" step="0.01" id="ttw"><br>
                            </div>
                            <div>
                                <h3>Other Deductions</h3>
                                <label name="reason">Reason : </label><br>
                                <textarea name="reason" style="width: 90%;"></textarea><br>
                                <label for="other-ded-weight">Deduction Weight (kg) : </label>
                                <input type="number" name="other-ded-weight" step="0.01" id="odw"><br>
                            </div>
                            <div>
                                <h3>Deductions</h3>
                                <label for="sack-weight">Total weight of Sacks (kg) : </label>
                                <input type="number" name="sack-weight" step="0.01" id="tsw"><br>
                                <label for="w-rate">Water rate (%) : </label>
                                <input type="number" name="w-rate" step="0.01" id="twr"><br>
                                <label for="nun-std-leave">non standard leaves rate (%) : </label>
                                <input type="number" name="nun-std-leave" step="0.01" id="nsl"><br>
                            </div>
                            <div>
                                <h3>Final Result</h3>
                                <span id="tw">Total Weight : </span><br>
                                <span id="sw">Deduction for sacks : </span><br>
                                <span id="dw">Deduction for Water : </span><br>
                                <span id="dl">Deduction for non standard leaves : </span><br>
                                <span id="td">Total Deduction : </span><br>
                                <span id="fw">Final Weight : </span><br>
                            </div>
                        </div>
                        <div class="btn-field" style="grid-column:1 / 3;">
                            <div style="grid-column:2 / 3;">
                                <button name="back-btn" formaction="weeklyReport.php">Back</button>
                            </div>
                            <div style="grid-column:3 / 4;">
                                <button type="button" formaction="dataEnter.php" id="cal-btn" name="calculate">Calculate</button>
                            </div>
                            <div style="grid-column:4 / 5;">
                                <button type="submit" formaction="../include/dataEnter.inc.php" name="data-submit">Enter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </main>

            <?php
                require "adminDashbordSideBar.php";
            ?>
        </div>
    </body>
</html>

<script>
    // calculate current details
    $("#cal-btn").click(function(){

        var fullWeight = 0;
        var totalWeightSack = 0;
        var waterWeithg = 0;
        var nonStdLeaves = 0;
        var otherDeductionWeight = 0;
        var finalWeight = 0;

        var tempttw = document.getElementById('ttw').value;
        var tempSW = document.getElementById('tsw').value;
        var tempWW = document.getElementById('twr').value;
        var tempNS = document.getElementById('nsl').value;
        var tempOD = document.getElementById('odw').value;
        if(!(tempttw == null || tempttw == "")){
            fullWeight = tempttw;
            if(!(tempSW == null || tempSW == "" )){
                totalWeightSack = tempSW;
            }
            if(!(tempWW == null || tempWW == "")){
                waterWeithg = (fullWeight * (tempWW / 100));
            }
            if(!(tempNS == null || tempNS == "")){
                nonStdLeaves = (fullWeight * (tempNS / 100));
            }
            if(!(tempOD == null || tempOD == "")){
                otherDeductionWeight = tempOD;
            }

            finalWeight = parseFloat(fullWeight) - (parseFloat(totalWeightSack) + parseFloat(waterWeithg) + parseFloat(nonStdLeaves) + parseFloat(otherDeductionWeight));
            setCalculatedResults(fullWeight, totalWeightSack, waterWeithg, nonStdLeaves, otherDeductionWeight, finalWeight);
        }
    });
    
    // set to display
    function setCalculatedResults(totalW, totalSack, totalWater, nonStdLeaves, otherDed, finalW){
        document.getElementById('tw').innerHTML = "Total Weight : " + totalW;
        document.getElementById('sw').innerHTML = "Deduction for sacks : " + totalSack;
        document.getElementById('dw').innerHTML = "Deduction for Water : " + totalWater;
        document.getElementById('dl').innerHTML = "Deduction for non standard leaves : " + nonStdLeaves;
        document.getElementById('td').innerHTML = "Total Deduction : " + otherDed;
        document.getElementById('fw').innerHTML = "Final Weight : " + finalW;
    }
</script>
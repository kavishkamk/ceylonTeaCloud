<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        require_once "../weekly-reports/WeeklyReportsData.class.php";
        $obj = new WeeklyReportsData();
        $res = $obj->report_data($id);

        $sacks = $res['number_of_sacks'];
        $total_weight = $res['total_weight'];
        $date = $res['date'];
        $sack_weight = $res['sack_waight'];
        $non_standard_leaves = $res['non_standard_leaves'];
        $water_weight = $res['water_weigth'];
        $other_reason = $res['reason'];
        $other_deduction = $res['weightOfDeduction'];

        $net_weight = $obj-> get_net_weight($id);
        unset($obj);
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
        <title>Weekly Reports</title>
    </head>

    <body>
        <div class="main-container">
            <div class="container2">
                <div class="data-container" id= "report-data">

                    <div class="row">
                        <span class="topic">Date Created : </span>
                        <?php echo '<input type="text" class="lengthy" value= "'.$date.'" readonly>';?>
                    </div>
                    <div class="row">
                        <span class="topic">Total Weight : </span>
                        <?php echo '<input type="text" class="result" value= "'.$total_weight.' kg" readonly>';?>
                    </div>
                    <div class="row">
                        <span class="topic">No. of Sacks : </span>
                        <?php echo '<input type="text" class="result" value= "'.$sacks.'" readonly>';?>
                    </div>
                    <div class="row">
                        <span class="topic">Sack Weight : </span>
                        <?php echo '<input type="text" class="result" value= "'.$sack_weight.' kg" readonly>';?>
                    </div>
                    <div class="row">
                        <span class="topic">Non-standard Leaves : </span>
                        <?php echo '<input type="text" class="result" value= "'.$non_standard_leaves.' kg" readonly>';?>
                    </div>
                    <div class="row">
                        <span class="topic">Water Weight : </span>
                        <?php echo '<input type="text" class="result" value= "'.$water_weight.' kg" readonly>';?>
                    </div>
                    <div class="row">
                        <span class="topic">Others : </span>
                        <?php echo '<input type="text" class="lengthy" value= "'.$other_reason.'" readonly>';?>
                    </div>
                    <div class="row">
                        <span class="topic">Other Deductions : </span>
                        <?php echo '<input type="text" class="result" value= "'.$other_deduction.'" readonly>';?>
                    </div>
                    <div class="row" id= "netw">
                        <span class="topic">Net Weight : </span>
                        <?php echo '<input type="text" class="result" value= "'.$net_weight.' kg" readonly>';?>   
                    </div>   
                    
                    
                </div>
                
                <div class= "btn-out">
                    <a href= "weekly-reports.php" style="text-decoration: none;">
                        <div class="report-item" id= "back-btn">Back</div>
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>

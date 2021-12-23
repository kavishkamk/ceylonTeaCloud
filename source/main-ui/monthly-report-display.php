<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        require_once "../monthly-reports/MonthlyReportsData.class.php";
        $obj = new MonthlyReportsData();
        $res = $obj->report_data($id);

        $tea = $obj->tea_request_data($id);
        $loan = $obj->loan_request_data($id);
        $fer = $obj->fertilizer_request_data($id);
        $ded = $obj->deduction_data($id);
        $net = $obj->net_weight_data($id);

        unset($obj);
    }

    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        echo "<script>console.log('" . $output . "' );</script>";
    }

    debug_to_console($res);
    debug_to_console($tea[0]);
    debug_to_console($loan[0]);
    debug_to_console($fer[0]);
    debug_to_console($ded);
    debug_to_console($net[2]);

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
        <title>Monthly Reports</title>
    </head>

    <body>
        <div class="main-container">
            <div class="container2">
                <div class="data-container" id= "report-data" style="max-height: 450px; overflow-y: scroll;">

                    <div class="row1">
                        <span class="topic">Total Weight : </span>
                        <?php echo '<input type="text" class="ss" value= "'.$res['total_weight'].' kg" readonly>';?>
                    </div>
                    <div class="row1">
                        <span class="topic">Total deduction per month : </span>
                        <?php echo '<input type="text" class="ss" value= "Rs. '.$res['total_deducation_per_month'].'" readonly>';?>
                    </div>
                    <div class="row1">
                        <span class="topic">Price of 1kg : </span>
                        <?php echo '<input type="text" class="ss" value= "Rs. '.$res['price_of_1kg'].'" readonly>';?>
                    </div>
                    <div class="row1">
                        <span class="topic">Total Price : </span>
                        <?php echo '<input type="text" class="ss" value= "Rs. '.$res['total_price'].'" readonly>';?>
                    </div>
                    <div class="row1">
                        <span class="topic">Payment : </span>
                        <?php echo '<input type="text" class="ss" value= "Rs. '.$res['payment'].'" readonly>';?>
                    </div>
                    
                    <br><br>
                    
                    <div class= "table-collection">

                        <!-- Tea Packets requests display -->
                        <table class= "monthly">
                            <thead>
                                <caption class="cap">Tea Packets Requests</caption>
                                    <tr>
                                        <td>No.</td>
                                        <td>Item Name</td>
                                        <td>Total Amount</td>
                                        <td>Deduction</td>
                                    </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                    foreach($tea as $row){
                                        echo '<tr>
                                                <td>'.$count.'</td>
                                                <td>'.$row["tea_type"].'</td>
                                                <td>'.number_format($row["item_price"],2).'</td>
                                                <td>'.number_format($row["monthly_ded"],2).'</td>
                                            </tr>';
                                        $count++;
                                    }
                                    /*
                                    echo '<tr>
                                            <td>'.$count.'</td>
                                            <td>type</td>
                                            <td>Rs. 1000</td>
                                            <td>Rs. 1000</td>
                                        </tr>';
                                    */
                                
                                ?>
                                
                            </tbody>
                        </table>
                        
                        <!-- Fertilizer requests display -->
                        <table class= "monthly">
                            <thead>
                                <caption class="cap">Fertilizer Requests</caption>
                                    <tr>
                                        <td>No.</td>
                                        <td>Item Name</td>
                                        <td>Total Amount</td>
                                        <td>Deduction</td>
                                    </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                    foreach($fer as $row){
                                        echo '<tr>
                                                <td>'.$count.'</td>
                                                <td>'.$row["fertilizer_type"].'</td>
                                                <td>'.number_format($row["item_price"],2).'</td>
                                                <td>'.number_format($row["monthly_deduction"],2).'</td>
                                            </tr>';
                                        $count++;
                                    }
                                ?>
                            </tbody>
                        </table>
                                    
                        <!-- Loan requests display -->
                        <table class= "monthly">
                            <thead>
                                <caption class="cap">Loan Requests</caption>
                                    <tr>
                                        <td>No.</td>
                                        <td>Total Amount</td>
                                        <td>Deduction</td>
                                        <td>Reason</td>
                                    </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                    foreach($loan as $row){
                                        echo '<tr>
                                                <td>'.$count.'</td>
                                                <td>'.number_format($row["amount"],2).'</td>
                                                <td>'.number_format($row["monthly_ded"],2).'</td>
                                                <td>'.$row["discription"].'</td>
                                            </tr>';
                                        $count++;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- weekly reports -->
                    <table class= "monthly" style="font-size: 10px;">
                        <thead>
                            <caption class="cap">Weekly Reports</caption>
                                <tr>
                                    <td>No.</td>
                                    <td>Date</td>
                                    <td>Total Weight(kg)</td>
                                    <td>Sack weight(kg)</td>
                                    <td>Non-standard Leaves(kg)</td>
                                    <td>Water Weight(kg)</td>
                                    <td>Others</td>
                                    <td>Others Deduction Weight(kg)</td>
                                    <td>Net Weight(kg)</td>
                                </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                                foreach($ded as $row){
                                    echo '<tr>
                                            <td>'.$count.'</td>
                                            <td>'.$row["dayrec"].'</td>
                                            <td>'.$row["total_weight"].'</td>
                                            <td>'.$row["sack_waight"].'</td>
                                            <td>'.$row["non_standard_leaves"].'</td>
                                            <td>'.$row["water_weigth"].'</td>
                                            <td>'.$row["reason"].'</td>
                                            <td>'.$row["weightOfDeduction"].'</td>
                                            <td>'.$net[$row["data_id"]]['weight'].'</td>
                                        </tr>';
                                    $count++;
                                }
                            ?>
                        </tbody>
                    </table>
                    
                </div>
                <center>
                    <div class= "btn-out" style="margin-top: 5px;">
                        <a href= "monthly-reports.php" style="text-decoration: none;">
                            <div class="report-item" id= "back-btn">Back</div>
                        </a>
                    </div>
                </center>
            </div>
        </div>
    </body>
</html>
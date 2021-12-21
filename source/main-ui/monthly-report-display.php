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
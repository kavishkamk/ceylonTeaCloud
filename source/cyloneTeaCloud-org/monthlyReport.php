<?php 
    require "sesseionCheck.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title> 
        <link rel="stylesheet" type="text/css" href="../css/adminDashBord.css">
    </head>
    <body>
        <div class="container">
            <!-- log out -->
            <nav>
                <div class="top-bar">
                    <form>
                        <button class="log-out-btn" formaction="../include/ownerLogout.inc.php">Log Out</button>
                    </form>
                </div>
            </nav>
            <main class="weekReport">
                <div class="week-div">
                    <div style="text-align:left;">
                        <form method="post" action="monthlyReport.php">
                            <label for="data-month">Select Month</label>
                            <input type="month" name="data-month">
                            <button type="submit" name="month-report">GET</button>
                        </form>
                    </div>
                    <div>
                        <form>
                            <button class="log-out-btn" formaction="MonthdataEnter.php">Data Enter</button>
                        </form>
                    </div>
                </div>
                <div>
                    <table>
                        <thead>
                            <caption>Genarated Reprot</caption>
                            <tr>
                                <th>Report Id</th>
                                <th>Grower Id</th>
                                <th>Year</th>
                                <th>Month</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($_POST['month-report'])){
                                    $repoMonth = $_POST['data-month'];
                                    if(!empty($repoMonth)){
                                        $arr = explode("-", $repoMonth);
                                        require_once "../phpClasses/MonthReport.class.php";
                                        $obj = new MonthReport();
                                        $result = $obj->getMonthlyReportsList($arr[0], $arr[1]);
                                        unset($obj);

                                        foreach($result as $row){
                                            echo '<tr>
                                                    <td><a href="monthReport.php?groid='.$row['grower_id'].'&reportid='.$row['report_id'].'">'.$row['report_id'].'</a></td>
                                                    <td>'.sprintf('%04d', $row['grower_id']).'</td>
                                                    <td>'.$row['repott_year'].'</td>
                                                    <td>'.$row['repott_month'].'</td>
                                                </tr>';
                                        }
                                    }
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
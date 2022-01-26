<?php 
    require "sesseionCheck.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Weekly Reports</title> 
        <link rel="stylesheet" type="text/css" href="../css/adminDashbord.css">
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
                        <form method="get" action="weeklyReport.php">
                            <label>Select Week</label>
                            <input type="week" name="data-week">
                            <button type="submit" name="week-report">GET</button>
                        </form>
                    </div>
                    <div>
                        <form>
                            <button class="log-out-btn" formaction="dataEnter.php">Data Enter</button>
                        </form>
                    </div>
                </div>
                <div>
                    <table>
                        <thead>
                            <caption>Generated Reports</caption>
                            <tr>
                                <th>Report Id</th>
                                <th>Grower Id</th>
                                <th>Report Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if(isset($_GET['week-report'])){
                                $weekday = $_GET['data-week'];
                                if(!empty($weekday)){
                                    $year = substr($weekday, 0, 4);
                                    $week_no = substr($weekday, 6);
                                    $week_start = new DateTime();
                                    $week_start->setISODate($year,$week_no);
                                    $sd = $week_start->format('Y-n-d');
                                    $ed = date('Y-n-d', strtotime($sd . ' +6 day'));
                                    
                                    require_once "../phpClasses/WeekReport.class.php";
                                    $weekObj = new WeekReport();
                                    $res = $weekObj->getWeekReportTableData($sd, $ed);
                                    unset($weekObj);

                                    while($row = mysqli_fetch_assoc($res)){
                                        echo '<tr>
                                                <td><a href="weekReport.php?reportId='.$row["data_id"].'&groid='.$row["id"].'&stday='.$sd.'&endday='.$ed.'">'.$row["data_id"].'</a></td>
                                                <td>'.$row["id"].'</td>
                                                <td>'.$row["date"].'</td>
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
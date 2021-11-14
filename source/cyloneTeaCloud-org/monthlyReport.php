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
                        <form method="get" action="monthlyReport.php">
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
                        </thead>
                        <tbody>
                            <tr>
                                <td>Grower Id</td>
                                <td>name</td>
                                <td>Registerd Date</td>
                            </tr>
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
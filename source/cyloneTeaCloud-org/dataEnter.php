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
        <link rel="stylesheet" type="text/css" href="../css/dateEnter.css">
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
                <div>
                    <form class="data-form">
                        <label for="input-date">Date : </label>
                        <input type="date" name="input-date"><br>
                        <label for="grower-id">ID : </label>
                        <input type="number" name="grower-id"><br>
                        <label for="num-sac">No of sacks : </label>
                        <input type="number" name="num-sac"><br>
                        <label for="waight">Weight : </label>
                        <input type="number" name="weight"><br>
                        <h3>Deductions</h3>
                        <label>Water rate (%) : </label>
                        <input type="number" name="w-rate"><br>
                        <label for="total-waight">Total Weight : </label>
                        <input type="number" name="total-waight"><br>
                        <button type="submit" name="data-submit">Enter</button>
                    </form>
                    <form>
                        <button name="back-btn" formaction="weeklyReport.php">Back</button>
                    </form>
                </div>
            </main>

            <?php
                require "adminDashbordSideBar.php";
            ?>
        </div>
    </body>
</html>
<!-- this is main admin dashbord -->
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
            <main class="dashmain">
                <!-- details of the company -->
                <div class="com-abo" style="grid-column:1 / 2; grid-row: 1 / 3;">
                    <h1>Cylone Tea Cloud</h1>
                    <p>Factory Name: </p>
                    <p>Address:</p>
                    <p>Tele:</p>
                    <h1>Factory Owner Details</h1>
                    <p>Name:</p>
                    <p>Tele</p>
                </div>
                <!-- number of grower accounts -->
                <div class="gro-abo" style="grid-column:2 / 3; grid-row: 1 / 2;">
                    <p>Total Growers</p>
                    <?php
                        require "../phpClasses/GrowerDetails.class.php";
                        $groObj = new GrowerDetails();
                        $numofGrower = $groObj->getNumOfGrowers(); // get number of growers
                        unset($groObj);
                        echo '<p>'.$numofGrower.'</p>';
                    ?>
                </div>
                <div style="grid-column:2 / 3; grid-row: 2 / 3;">
                    <p>Total Weekly report - 29</p>
                    <p>Total monthly report - 15</p>
                </div>
            </main>

            <?php
                require "adminDashbordSideBar.php";
            ?>
        </div>
    </body>
</html>
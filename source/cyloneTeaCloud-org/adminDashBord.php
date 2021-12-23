<!-- this is main admin dashbord -->
<?php
    require "sesseionCheck.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Admin Dashboard</title> 
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
                <?php
                    // get company details
                    require_once "../phpClasses/CompanyDeatils.class.php";
                    $comObj = new CompanyDetails();
                    $comRes = $comObj->getCompanyDetails();
                    unset($comObj);
                    echo '<p>Factory Name:&nbsp;&nbsp; '.$comRes['name'].'</p>';
                    echo '<p>Address:&nbsp;&nbsp; '.$comRes['address'].'</p>';
                    echo '<p>Tele:&nbsp;&nbsp; 0'.$comRes["contactNo"].'</p>';
                    echo '<p>Email :&nbsp;&nbsp; '.$comRes["email"].'</p>';
                ?>   
                </div>
                <!-- number of grower accounts -->
                <div class="gro-abo" style="grid-column:2 / 3; grid-row: 1 / 2;">
                    <p id= "total-growers">Total Growers</p>
                    <?php
                        require "../phpClasses/GrowerDetails.class.php";
                        $groObj = new GrowerDetails();
                        $numofGrower = $groObj->getNumOfGrowers(); // get number of growers
                        unset($groObj);
                        echo '<p id= "value">'.$numofGrower.'</p>';
                    ?>
                </div>
                <div style="grid-column:2 / 3; grid-row: 2 / 3;">
                    <?php
                        // require_once "../phpClasses/WeekReport.class.php";
                        // $weekObj = new WeekReport();
                        // $res = $weekObj->numberOfWeekReports();
                        // unset($weekObj);
                        // echo '<p>Total Weekly report - '.$res.'</p>
                        //         <p>Total monthly report - 15</p>'
                    ?>
                </div>
            </main>

            <?php
                require "adminDashbordSideBar.php";
            ?>
        </div>
    </body>
</html>
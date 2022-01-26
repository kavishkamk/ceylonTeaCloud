<!-- this is grower profile - admin side view -->
<?php 
    require "sesseionCheck.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title> 
        <link rel="stylesheet" type="text/css" href="../css/adminDashbord.css">
    </head>
    <body>
        <div class="container">
            <nav>
                <!-- log out button -->
                <div class="top-bar">
                    <form>
                        <button class="log-out-btn" formaction="../include/ownerLogout.inc.php">Log Out</button>
                    </form>
                </div>
            </nav>
            <!-- set grower profile -->
            <main class="grower-profile">
                <?php
                    require_once "../phpClasses/GrowerDetails.class.php";
                    $obj = new GrowerDetails();
                    $grower = $obj->getGrowerDetailsUsingId($_GET['groid']);
                    unset($obj);
                ?>
                <div class="image">
                    <?php
                         echo '<img src="../profile-pic/'.$grower["profileLink"].'" alt="Avatar" style="width: 200px" />';
                    ?>
                <div>
                <div>
                    <?php 
                    echo '<p> Grower ID: '.sprintf('%04d', $_GET['groid']).'</p>
                    <p> Name : '.$grower["name"].'</p>
                    <p> Email : '.$grower["email"].'</p>
                    <p> Address : '.$grower["address"].'</p>
                    <p> Tele : '.$grower["tele"].'</p>'
                    ?>
                </div>
            </main>
            <?php
                require "adminDashbordSideBar.php";
            ?>
        </div>
    </body>
</html>
<?php 
    session_start();

    if(!isset($_SESSION['ownerid'])){
         header("Location:../cyloneTeaCloud-org/ownerLogin.php?ownerlogstat=logoutok"); // no session
         exit();
    }
    else{
        require_once "../phpClasses/OwnerSessionHandle.class.php";
        $sessObj = new OwnerSessionHandle();
        $sessRes = $sessObj->checkSession($_SESSION['sessionId'], $_SESSION['ownerid']); // invalid session
        unset($sessObj);
        if($sessRes != "1"){
            header("Location:../cyloneTeaCloud-org/ownerLogin.php?ownerlogstat=logoutok"); // no session
            exit();
        }
    }
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
            <nav>
                <div class="top-bar">
                    <form>
                        <button class="log-out-btn" formaction="../include/ownerLogout.inc.php">Log Out</button>
                    </form>
                </div>
            </nav>
            <main class="grower-profile">
                <?php
                    require_once "../phpClasses/GrowerDetails.class.php";
                    $obj = new GrowerDetails();
                    $grower = $obj->getGrowerDetailsUsingId($_GET['groid']);
                    unset($obj);
                ?>
                <div class="image">
                    <?php
                        echo '<img src="../profile-pic/'.$grower["profileLink"].' ?>" alt="Avatar" style="width: 200px" />';
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
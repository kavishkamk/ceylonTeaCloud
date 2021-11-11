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
            <main class="grower-main">
                <div class="grower-table" style="grid-column:1 / 2; grid-row: 1 / 3;">
                    <table>
                        <thead>
                            <caption>Grower List</caption>
                            <tr>
                                <th>Grower Id</th>
                                <th>name</th>
                                <th>Registerd Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                require_once "../phpClasses/GrowerDetails.class.php";
                                $groObj = new GrowerDetails();
                                $result = $groObj->getGrowerList();
                                unset($groObj);

                                while($row = mysqli_fetch_assoc($result)){
                                    echo '<tr>
                                        <td>'.sprintf('%04d', $row['id']).'</td>
                                        <td> <a href="growerProfile.php?groid='.$row["id"].'">'.$row["name"].'</a></td>
                                        <td>'.$row["reg_date"].'</td>
                                    </tr>';
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
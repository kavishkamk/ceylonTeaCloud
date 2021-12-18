<!-- grower list display -->
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
            <!-- for log out -->
            <nav>
                <div class="top-bar">
                    <form>
                        <button class="log-out-btn" formaction="../include/ownerLogout.inc.php">Log Out</button>
                    </form>
                </div>
            </nav>
            <main class="grower-main">
                <!-- set grower list -->
                <div class="grower-table" style="grid-column:1 / 2; grid-row: 1 / 3;">
                <div > 
                    <form>
                        <button class="log-out-btn" formaction="growerRegister.php">Add</button>
                    </form>
                </div>
                <div class="grower-table-s">
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
                </div>
            </main>

            <?php
                require "adminDashbordSideBar.php";
            ?>
        </div>
    </body>
</html>
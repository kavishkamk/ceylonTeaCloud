<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title> 
        <link rel="stylesheet" type="text/css" href="../css/adminDashBord.css">
        <link rel="stylesheet" type="text/css" href="../css/items.css">
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
            <main class="item-main">
                <?php
                    require_once "../phpClasses/Items.class.php";
                    $obj = new Items();
                    $teaList = $obj->getTeaTypeList();
                    $fertilizerList = $obj->getFertilizerList();
                    unset($obj);
                ?>
                <div class="item-div" style="grid-column:1 / 2;">
                    <div>
                        <table>
                            <thead>
                                <caption>Tea List</caption>
                                <tr>
                                    <th>Type</th>
                                    <th>Price of 1kg</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $teaTypeList = array();
                                    while($row = mysqli_fetch_assoc($teaList)){
                                        $teaTypeList[] = $row['tea_type'];
                                        echo '<tr>
                                            <td>'.$row["tea_type"].'</td>
                                            <td>'.number_format($row["price_of_1kg"],2).'</td>
                                        </tr>';
                                    }
                                ?>
                            </tbody>
                        </table>    
                    </div>
                    <div class="item-form">
                        <form action="../include/addTeaType.inc.php" method="post">
                            <div class="f-item">
                                <label for="tea-name">Item &nbsp: </label>
                                <input type="text" name="tea-name" placeholder="item name">
                            </div>
                            <div  class="f-item">
                                <label for="tea-price">Price : </label>
                                <input type="number" step="0.01" min="0.00" name="tea-price">
                                <button type="submit" name="tea-insert-submit" class="btn">ADD</button>
                            </div>
                        </form>
                    </div>
                    <div class="item-form">
                        <form action="../include/addTeaType.inc.php" method="post">
                            <div class="f-item" id="tea-list-s">
                                
                            </div>
                            <!-- set the tea type list to chooese -->
                                <?php
                                    $teaOption = "";
                                    foreach($teaTypeList as $teaname) {
                                            $temp = '<option value="'.$teaname.'">'.$teaname.'</option>';
                                            $teaOption .= $temp;
                                    }
                                    $setval = '<label for="tea-name">Item &nbsp: </label><select name="tea-name">'.$teaOption.'';
                                    echo "<script>document.getElementById('tea-list-s').innerHTML = '".$setval."';</script>";
                                ?>
                            <div  class="f-item">
                                <label for="tea-price">Price : </label>
                                <input type="number" step="0.01" min="0.00" name="tea-price">
                                <button type="submit" name="tea-update-submit" class="btn">UPDATE</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="item-div" style="grid-column:2 / 3;">
                    <div>
                        <table>
                            <thead>
                                <caption>Fertilizer List</caption>
                                    <tr>
                                        <th>Type</th>
                                        <th>Price of 1kg</th>
                                    </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $fertilizerTypeList = array();
                                    while($row = mysqli_fetch_assoc($fertilizerList)){
                                        $fertilizerTypeList[] = $row['fertilizer_type'];
                                        echo '<tr>
                                            <td>'.$row["fertilizer_type"].'</td>
                                            <td>'.number_format($row["price_of_1kg"],2).'</td>
                                        </tr>';
                                    }
                                ?>
                            </tbody>
                        </table>   
                    </div>
                    <div class="item-form">
                        <form action="../include/addFertilizerType.inc.php" method="post">
                            <div class="f-item">
                                <label for="fertilizer-name">Item &nbsp: </label>
                                <input type="text" name="fertilizer-name" placeholder="item name">
                            </div>
                            <div  class="f-item">
                                <label for="fertilizer-price">Price : </label>
                                <input type="number" step="0.01" min="0.00" name="fertilizer-price">
                                <button type="submit" name="fertilizer-insert-submit" class="btn">ADD</button>
                            </div>
                        </form>
                    </div>
                    <div class="item-form">
                        <form action="../include/addFertilizerType.inc.php" method="post">
                            <div class="f-item" id="fertilizer-list-s">
                                
                            </div>
                            <!-- set the tea type list to chooese -->
                            <?php
                                    $fertilizerOption = "";
                                    foreach($fertilizerTypeList as $fertilizername) {
                                            $temp = '<option value="'.$fertilizername.'">'.$fertilizername.'</option>';
                                            $fertilizerOption .= $temp;
                                    }
                                    $setval = '<label for="fertilizer-name">Item &nbsp: </label><select name="fertilizer-name">'.$fertilizerOption.'';
                                    echo "<script>document.getElementById('fertilizer-list-s').innerHTML = '".$setval."';</script>";
                                ?>
                            <div  class="f-item">
                                <label for="fertilizer-price">Price : </label>
                                <input type="number" step="0.01" min="0.00" name="fertilizer-price">
                                <button type="submit" name="fertilizer-update-submit" class="btn">UPDATE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>

            <?php
                require "adminDashbordSideBar.php";
            ?>
        </div>
    </body>
</html>
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
                        <button class="log-out-btn" formaction="">Log Out</button>
                    </form>
                </div>
            </nav>
            <main>
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
                            <tr>
                                <td>1</td>
                                <td>Rashmi</td>
                                <td>2021-11-5</td>
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
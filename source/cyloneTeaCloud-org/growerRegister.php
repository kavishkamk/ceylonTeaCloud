<!-- grower  add -->
<?php
    require "sesseionCheck.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Grower Registration</title> 
        <link rel="stylesheet" type="text/css" href="../css/adminDashbord.css">
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
                <div id= "box" style= "position: center;">
                    <!-- registration form -->
                    <form class= "signup-form" action="../include/growerRegistration.inc.php" method="post">
                        <div class="form-header">
                            <h1>Create Account</h1>
                        </div>
                        <div class="admin-form-body">
                            <div style="grid-column:1 / 2; grid-row: 1 / 2">
                                <label for="firstname" class="label-title" >Name</label><br>
                                <?php 
                                    if(isset($_GET['firstname'])){
                                        echo '<input type="text" name="firstname" placeholder="enter your name" value="'.$_GET['firstname'].'" class="form-input">';
                                    }
                                    else{
                                        echo '<input type="text" name="firstname" placeholder="enter your name" class="form-input">';
                                    }
                                ?>
                            </div>
                            <!-- for Contact No -->
                            <div style="grid-column:2 / 3; grid-row: 1 / 2">
                                <label for="tele" class="label-title">Contact No</label><br>
                                <?php
                                if(isset($_GET['tele'])){
                                    echo '<input type="text" name="tele" placeholder="enter your contact No" value="'.$_GET['tele'].'" class="form-input">';
                                }
                                else{
                                    echo '<input type="text" name="tele" placeholder="enter your contact No" class="form-input">';
                                }
                                ?>
                            </div>
                            <!-- for email -->
                            <div style="grid-column:1 / 2; grid-row: 2 / 3">
                                <label for="uemail" class="label-title">Email*</label><br>
                                <?php
                                    if(isset($_GET['umail'])){
                                        echo '<input type="email" name="uemail" placeholder="enter your email"  value="'.$_GET['umail'].'" class="form-input">';
                                    }
                                    else{
                                        echo '<input type="email" name="uemail" placeholder="enter your email" class="form-input">';
                                    }
                                ?>
                            </div>
                            <!-- for address -->
                            <div style="grid-column:2 / 3; grid-row: 2 / 3">
                                <label for="address" class="label-title">Address</label><br>
                                <?php
                                    if(isset($_GET['address'])){
                                        echo '<input type="text" name="address" placeholder="enter your address" value="'.$_GET['address'].'" class="form-input">';
                                    }
                                    else{
                                        echo '<input type="text" name="address" placeholder="enter your address" class="form-input">';
                                    }
                                ?>
                            </div>
                            <!-- for password and comfirm password-->
                            <div style="grid-column:1 / 2; grid-row: 3 / 4">
                                <label for="upassword" class="label-title">Password</label><br>
                                <input type="password" name="upassword" placeholder="enter password" class="form-input">
                            </div>
                            <div style="grid-column:2 / 3; grid-row: 3 / 4">
                                <label for="confirm-password" class="label-title">Confirm Password</label><br>
                                <input type="password" name="confirm-password" placeholder="enter your password again" class="form-input">
                            </div>
                        </div>
                        <!-- form footer -->
                        <div class="form-footer">
                            <form>
                                <button  formaction="growerList.php" class="back-button">
                                        Back
                                </button>  
                            </form>

                            <?php
                                $errmsg = "";

                                if(isset($_GET['signerror'])){
                                    $errmsg = setErrMessage();
                                    echo '<span class="error-bar" >'.$errmsg.'</span>';
                                }
                                else if(isset($_GET['register'])){
                                    echo '<span class="success-bar" >Registration Success</span>';
                                }
                                else{
                                    echo '<span class="error-bar" > </span>';
                                }
                            ?>

                            <button type="submit" name="register-submit" class="btn" >Create</button>
                        </div>
                    </form>
                </div> 
            </main>

            <?php
                require "adminDashbordSideBar.php";
            ?>
        </div>
    </body>
</html>

<!-- set registration error messages -->
<?php
    function setErrMessage(){
        if(isset($_GET['signerror'])){
            if($_GET['signerror'] == "emptyfield"){
                return "Fill all the fields";
            }
            else if($_GET['signerror'] == "wrongmail"){
                return "Wrong email address";
            }
            else if($_GET['signerror'] == "errtele"){
                return "Use Only numbers (0-9) for contact number";
            }
            else if($_GET['signerror'] == "errpwd"){
                return "Wrong password";
            }
            else if($_GET['signerror'] == "abailableEmail"){
                return "This email is alrady used to create account..";
            }
        }
    }
?>
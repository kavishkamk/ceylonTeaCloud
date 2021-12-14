<?php
/*
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}*/

    session_start();

    if(!isset($_SESSION['growerId'])) // no session exists
    {
        header("Location:index.php?growerLoginStatus=unauthorized");
        exit();
    }else
    {
        require_once "../phpClasses/HandleGrowerSession.class.php";
        $obj = new HandleGrowerSession();
        $res = $obj-> checkSession($_SESSION['sessionId'], $_SESSION['growerId']);
        unset($obj);

        if($res != SESSION_AVAILABLE){
            header("Location:index.php?growerLoginStatus=logout");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Edit User Data</title>

    <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/editUserData.css"/>
</head>

<body>
<div class="main-container">
    <div class="container">
        <h2 class="login-title">Edit User Data</h2>
        <div class="form-container">
            <form action="../include/EditUserData.inc.php" method="post">
                <div>
                    <?php if (isset($_GET['userDataUpdateStatus'])) { ?>
                        <?php if ($_GET['userDataUpdateStatus'] == "invalid-inputs") { ?>
                            <p class="user-data-change-response">Please provide valid inputs</p>
                        <?php } else if ($_GET['userDataUpdateStatus'] == "failed") { ?>
                            <p class="user-data-change-response">Failed to Update User Data</p>
                        <?php } ?>
                    <?php } else { ?>
                        <p class="user-data-change-response"></p>
                    <?php } ?>
                </div>
                <div class="form-group text-field-container">
                    <label for="name" class="text-field-label">Name</label>
                    <input
                            type="text"
                            class="form-control"
                            id="name"
                            name="name"
                            value="<?php echo $_SESSION['name'] ?>"
                    />
                </div>
                <div class="form-group text-field-container">
                    <label for="phoneNo" class="text-field-label">Phone</label>
                    <input
                            type="tel"
                            class="form-control"
                            id="phoneNo"
                            name="phoneNo"
                            value="<?php echo $_SESSION['telephoneNo'] ?>"
                    />
                </div>
                <div class="form-group text-field-container">
                    <label for="address" class="text-field-label">Address</label>
                    <input
                            type="text"
                            class="form-control"
                            id="address"
                            name="address"
                            value="<?php echo $_SESSION['address'] ?>"
                    />
                </div>
                <div class="login-button-container">
                    <button
                            class="btn btn-primary btn-lg btn-block login-button"
                            name="edit-user-data"
                    >
                        Submit
                    </button>
                </div>
            </form>
        </div>
        <!--         <a class="b1" href="#"> PASSWORD RESET</a>-->
        <!-- <a class="password-settings" href="editUserData.php"> Edit </a> -->
    </div>
</div>
</body>
</html>

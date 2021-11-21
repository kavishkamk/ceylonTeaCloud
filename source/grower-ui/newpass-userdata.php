<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>View User Details</title>
    <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/newuser.css"/>
</head>

<body>
<div class="main-container">
    <div class="container">
        <!--        <h4>Password Updated Successfully</h4>-->

        <h2 class="login-title">View User Data</h2>
        <div class="form-container">
            <form action="../include/PasswordChange.inc.php" method="post">
                <div class="form-group text-field-container">
                    <label for="emailAddress" class="text-field-label">Name</label>
                    <input
                            type="email"
                            class="form-control"
                            id="emailAddress"
                            value="<?php echo $_SESSION['name'] ?>"
                            disabled
                    />
                </div>
                <div class="form-group text-field-container">
                    <label for="password" class="text-field-label">Phone</label>
                    <input
                            type="tel"
                            class="form-control"
                            id="password"
                            value="<?php echo $_SESSION['telephoneNo'] ?>"
                            disabled
                    />
                </div>
                <div class="form-group text-field-container">
                    <label for="password" class="text-field-label">Address</label>
                    <input
                            type="text"
                            class="form-control"
                            id="password"
                            value="<?php echo $_SESSION['address'] ?>"
                            disabled
                    />
                </div>
                <div class="login-button-container">
                    <button
                            class="btn btn-success btn-lg btn-block login-button"
                            type="submit"
                            name="view-user-data-submit"
                    >
                        Confirm
                    </button>
                    <button
                            href="userdata.php"
                            class="btn btn-primary btn-lg btn-block edit-data-button"
                    >
                        Edit Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

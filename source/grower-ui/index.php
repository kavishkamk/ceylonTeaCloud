<?php
if (session_start()) {
    session_unset();
    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/login.css"/>
    <title>Ceylon Tea Cloud</title>
</head>
<body>
<div class="main-container">
    <div class="container">
        <h1 class="login-title">Log In</h1>
        <div class="form-container">
            <form action="../include/GrowerLogin.inc.php" method="post">
<!--                <div>-->
<!--                    --><?php //if (isset($_GET['growerLoginStatus'])) { ?>
<!--                        --><?php //if ($_GET['growerLoginStatus'] == "invalid-inputs") { ?>
<!--                            <p class="login-response" style="display: none">Please provide valid inputs</p>-->
<!--                        --><?php //} else if ($_GET['growerLoginStatus'] == "unauthorized") { ?>
<!--                            <p class="login-response">Unauthorized Access</p>-->
<!--                        --><?php //} ?>
<!--                    --><?php //} else { ?>
<!--                        <p class="login-response"></p>-->
<!--                    --><?php //} ?>
<!--                </div>-->
                <div class="form-group text-field-container">
                    <label for="emailAddress" class="text-field-label">Email Address</label>
                    <input
                            type="email"
                            class="form-control"
                            id="emailAddress"
                            name="emailAddress"
                            placeholder="name@example.com"
                    />
                </div>
                <div class="form-group text-field-container">
                    <label for="password" class="text-field-label">Password</label>
                    <input
                            type="password"
                            class="form-control"
                            id="password"
                            placeholder="Password"
                    />
                </div>

                <div class="login-button-container">
                    <button
                            type="submit"
                            name="grower-login-submit"
                            class="btn btn-primary btn-lg btn-block login-button"
                    >
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

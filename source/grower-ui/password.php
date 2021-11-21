<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Change Password</title>
    <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/passwd.css"/>
</head>

<body>
<div class="main-container">
    <div class="container">
        <h1 class="login-title">Change Password</h1>
        <div class="form-container">
            <form action="../include/PasswordChange.inc.php" method="post">
                <div>
                    <?php if (isset($_GET['passwordChangeStatus'])) { ?>
                        <?php if ($_GET['passwordChangeStatus'] == "invalid-inputs") { ?>
                            <p class="password-change-response">Please provide valid inputs</p>
                        <?php } else if ($_GET['passwordChangeStatus'] == "unauthorized") { ?>
                            <p class="password-change-response">Unauthorized Access</p>
                        <?php } ?>
                    <?php } else { ?>
                        <p class="password-change-response"></p>
                    <?php } ?>
                </div>
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
                    <label for="password" class="text-field-label"
                    >Current Password</label>
                    <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="currentPassword"
                            placeholder="Current Password"
                    />
                </div>
                <div class="form-group text-field-container">
                    <label for="password" class="text-field-label">New Password</label>
                    <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="newPassword"
                            placeholder="New Password"
                    />
                </div>
                <div class="login-button-container">
                    <button
                            class="btn btn-primary btn-lg btn-block login-button"
                            name="password-change-submit"
                            type="submit"
                    >
                        Add New Password
                    </button>
                </div>
                <div class="login-button-container">
                    <a href="newpass-userdata.php">Skip</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

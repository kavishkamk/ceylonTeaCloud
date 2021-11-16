<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>password settings</title>
    <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/passwd.css"/>
</head>

<!-- testing  -->
<body>
<div class="main-container">
    <div class="container">
        <h1 class="login-title">PASSWORD SETTINGS</h1>
        <div class="form-container">
            <form action="test-password.html" method="post">
                <div class="form-group text-field-container">
                    <label for="emailAddress" class="text-field-label"
                    >Email Address</label
                    >
                    <input
                            type="email"
                            class="form-control"
                            id="emailAddress"
                            placeholder="name@example.com"
                    />
                </div>
                <div class="form-group text-field-container">
                    <label for="password" class="text-field-label"
                    >Current Password</label
                    >
                    <input
                            type="password"
                            class="form-control"
                            id="password"
                            placeholder="Password"
                    />
                </div>
                <div class="form-group text-field-container">
                    <label for="password" class="text-field-label"
                    >New Password</label
                    >
                    <input
                            type="password"
                            class="form-control"
                            id="password"
                            placeholder="Password"
                    />
                </div>
                <div class="login-button-container">
                    <a
                            href="otp.php"
                            class="btn btn-primary btn-lg btn-block login-button"
                    >Add New Password</a
                    >
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

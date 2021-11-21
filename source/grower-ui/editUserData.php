<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>USER DATA CONFIRMATION</title>

    <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/userdata.css"/>
</head>

<!-- testing -->
<body>
<div class="main-container">
    <div class="container">
        <h2 class="login-title">USER DATA CONFIRMATION</h2>
        <div class="form-container">
            <form action="test-userdata.htm" method="post">
                <div class="form-group text-field-container">
                    <label for="emailAddress" class="text-field-label">Name</label>
                    <input
                            type="email"
                            class="form-control"
                            id="emailAddress"
                            placeholder="Rinky De Silva"
                    />
                </div>
                <div class="form-group text-field-container">
                    <label for="password" class="text-field-label">Phone</label>
                    <input
                            type="password"
                            class="form-control"
                            id="password"
                            placeholder="0174512458"
                    />
                </div>
                <div class="form-group text-field-container">
                    <label for="password" class="text-field-label">Address</label>
                    <input
                            type="password"
                            class="form-control"
                            id="password"
                            placeholder="address"
                    />
                </div>
                <div class="login-button-container">
                    <!-- <a href="profilePic.php"><button
                      type="submit"
                      class="btn btn-primary btn-lg btn-block login-button"
                    >
                      Confirm
                    </button>
                  </a> -->
                    <a href="profilePic.php" class="btn btn-primary btn-lg btn-block login-button">Confirm</a>
                </div>
            </form>
        </div>
        <!--         <a class="b1" href="#"> PASSWORD RESET</a>-->
        <!-- <a class="password-settings" href="editUserData.php"> Edit </a> -->
    </div>
</div>
</body>
</html>

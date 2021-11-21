<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Change Profile Picture</title>

    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/profilePic.css"/>

</head>

<body>
<div class="main-container">
    <div class="container">
        <h2 class="login-title">Change Profile Picture</h2>
        <div class="form-container">
            <form action="profilePic.php" method="post">
                <div class="form-group text-field-container">
                    <form action="profilePic.php" method="post">
                        <div class="image">
                            <img src="../images/vishvi.jpeg" alt="Avatar" style="width: 200px"/>
<!--                            <input type="file" placeholder="image" value=""/>-->
                        </div>
                    </form>
                </div>
                <button href="#" class="btn btn-primary btn-lg btn-block login-button">Upload Profile Picture</button>
            </form>
        </div>
        <div class="login-button-container">
            <a href="home.php">
                Back to Home
            </a>
        </div>
    </div>
</div>
</body>
</html>

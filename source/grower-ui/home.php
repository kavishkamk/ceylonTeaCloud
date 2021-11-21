<?php
function redirectToChangePasswordUi()
{
    header("Location:../grower-ui/changePassword.php");
}

function redirectToViewDataUi()
{
    header("Location:../grower-ui/viewUserData.php");
}

function redirectToProfilePage()
{
    header("Location:../grower-ui/profilePic.php");
}

if (isset($_GET['change-password'])) {
    redirectToChangePasswordUi();
} else if (isset($_GET['view-data'])) {
    redirectToViewDataUi();
} else if (isset($_GET['profile-pic'])) {
    redirectToProfilePage();
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
    <link rel="stylesheet" href="../css/home.css"/>
    <title>Home</title>
</head>
<body>
<div class="main-container">
    <div class="container">
        <h1 class="home-title">Home</h1>
        <div class="grower-home-options-container">
            <a style="text-decoration: none" href='../grower-ui/home.php?change-password=true'>
                <div class="grower-home-option">
                    Change Password
                </div>
            </a>
            <a style="text-decoration: none" href='../grower-ui/home.php?view-data=true'>
                <div class="grower-home-option">
                    Edit / View Information
                </div>
            </a>
            <a style="text-decoration: none" href='../grower-ui/home.php?profile-pic=true'>
                <div class="grower-home-option">
                    Change Profile Picture
                </div>
            </a>
        </div>
    </div>
</div>
</body>
</html>

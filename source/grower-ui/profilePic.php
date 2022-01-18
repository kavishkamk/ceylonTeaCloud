<?php

require_once "../utils.php";
require_once "../phpClasses/GrowerProfile.class.php";

if (!isset($_SESSION['growerId'])) // no session exists
{
    header("Location:index.php?growerLoginStatus=unauthorized");
    exit();
} else {
    require_once "../phpClasses/HandleGrowerSession.class.php";
    $obj = new HandleGrowerSession();
    $res = $obj->checkSession($_SESSION['sessionId'], $_SESSION['growerId']);
    unset($obj);

    if ($res != SESSION_AVAILABLE) {
        header("Location:index.php?growerLoginStatus=logout");
        exit();
    }

    //Getting profile picture name
    $growerProfile = new GrowerProfile();
    $fetchProfilePicStatus = $growerProfile->getProfilePictureName();
}
?>

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
            <form action="../include/UpdateGrowerProfile.php" method="post" enctype="multipart/form-data">
                <div class="form-group text-field-container">
                    <?php if ($fetchProfilePicStatus == FETCHING_PROFILE_PIC_NAME_SUCCESS): ?>
                        <img src="../images/users/<?php echo $_SESSION['profilePic'] ?>"
                             alt="Avatar" style="height: 200px; width: 200px; border-radius: 50%;"
                             id="uploadedImage">
                    <?php else: ?>
                        <img src="../images/default-avatar.jpg" alt="Avatar"
                             style="height: 200px; width: 200px; border-radius: 50%;"
                             id="uploadedImage">
                    <?php endif; ?>
                    <div class="select-image-to-upload">
                        <input type="file" name="fileToUpload" accept="image/jpeg" id="fileToUpload">
                    </div>
                </div>
                <button
                        class="btn btn-primary btn-lg btn-block login-button"
                        type="submit"
                        value="Upload Image"
                        name="update-grower-profile"
                >
                    Upload Profile Picture
                </button>
            </form>
        </div>
        <div class="login-button-container">
            <a href="../main-ui/main-menu.php">
                Confirm
            </a>
        </div>
    </div>
</div>
</body>
</html>

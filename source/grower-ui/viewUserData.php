<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function redirectToEditUserDataUi()
{
    header("Location:../grower-ui/editUserData.php");
}

if (isset($_GET['edit-user-data'])) {
    redirectToEditUserDataUi();
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
    <link rel="stylesheet" href="../css/viewUserData.css"/>
</head>

<body>
<div class="main-container">
    <div class="container">
        <!--        <h4>Password Updated Successfully</h4>-->

        <h2 class="login-title">View User Data</h2>
        <div class="form-container">
            <div class="form-group text-field-container">
                <label for="name" class="text-field-label">Name</label>
                <input
                        type="text"
                        class="form-control"
                        id="name"
                        name="name"
                        value="<?php echo $_SESSION['name'] ?>"
                        disabled
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
                        disabled
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
                        disabled
                />
            </div>
            <div class="login-button-container">
                <a style="text-decoration: none" href='../grower-ui/viewUserData.php?edit-user-data=true'>
                    <button
                            class="btn btn-primary btn-lg btn-block edit-data-button"
                            name="view-user-data"
                    >
                        Edit Data
                    </button>
                </a>
            </div>
            <div class="login-button-container">
                <a href="home.php">
                    Back to Home
                </a>
            </div>
        </div>
    </div>
</div>
</body>
</html>

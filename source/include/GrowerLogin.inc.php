<?php
require_once "../phpClasses/GrowerLogin.class.php";

session_start();

if (isset($_POST['grower-login-submit'])) {

    $email = formatInputs($_POST['emailAddress']);
    $password = formatInputs($_POST['password']);

    if (empty($email) || empty($password)) {
        header("Location:../grower-ui/index.php?growerLoginStatus=invalid-inputs");
        exit();
    } else {

        $growerLoginObject = new GrowerLogin();
        $loginResponse = $growerLoginObject->validateLoginDetails($email, $password);

        if ($loginResponse == NO_USER_FOUND || $loginResponse == CONNECTION_ERROR
            || $loginResponse == ACCOUNT_BLOCKED_OR_DELETED || $loginResponse == WRONG_PASSWORD) {
            header("Location:../grower-ui/index.php?growerLoginStatus=unauthorized");
            unset($growerLoginObject);
            exit();
        }
    }
} else {
    header("Location:../grower-ui/index.php");
    exit();
}

// filter inputs
function formatInputs($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}
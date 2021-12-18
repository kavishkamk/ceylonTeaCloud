<?php
require_once "../phpClasses/GrowerLogin.class.php";
require_once "../utils.php";

session_start();

if (isset($_POST['grower-login-submit'])) {

    $email = $_POST['emailAddress'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        header("Location:../grower-ui/index.php?growerLoginStatus=invalid-inputs");
    } else {
        $growerLoginObject = new GrowerLogin();
        $loginResponse = $growerLoginObject->validateLoginDetails($email, $password);

        if ($loginResponse == NEW_MEMBER) {
            header("Location:../grower-ui/changePassword.php");
        } 
        else if($loginResponse == LOGIN_SUCCESSFUL){
            header("Location:../main-ui/main-menu.php");
        }
        else {
            header("Location:../grower-ui/index.php?growerLoginStatus=unauthorized");
        }
        unset($growerLoginObject);
    }
} else {
    header("Location:../grower-ui/index.php");
}
exit();
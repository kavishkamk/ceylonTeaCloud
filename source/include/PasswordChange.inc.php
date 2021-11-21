<?php
require_once "../phpClasses/HandleGrowerPasswordChange.php";
require_once "../utils.php";
require_once "../constants.php";
require_once "../include/growerSessionCheck.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['password-change-submit'])) {

    $email = $_POST['emailAddress'];
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];

    if(empty($email) || empty($currentPassword) || empty($newPassword)){
        header("Location:../grower-ui/changePassword.php?passwordChangeStatus=invalid-inputs");
    } else {
        $passwordChange = new HandleGrowerPasswordChange();

        //Checking if the current password is valid
        $currentPasswordValidation = $passwordChange->validateCurrentPassword($email, $currentPassword);
        if($currentPasswordValidation != VALID_CURRENT_PASSWORD){
            header("Location:../grower-ui/changePassword.php?passwordChangeStatus=unauthorized");
            return;
        }

        //Updating the table with the new password and getting the response
        $passwordUpdateResponse  = $passwordChange->updatePassword($email, $currentPassword, $newPassword);
        debug_to_console($passwordUpdateResponse);
        if($passwordUpdateResponse == PASSWORD_UPDATE_SUCCESS){
            header("Location:../grower-ui/viewUserData.php");
        } else {
            header("Location:../grower-ui/changePassword.php?passwordChangeStatus=unauthorized");
        }
    }

}

exit();
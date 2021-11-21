<?php
require_once "../utils.php";
require_once "../constants.php";
require_once "../phpClasses/HandleEditUserData.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['edit-user-data'])) {

    $growerEmail = $_SESSION['email'];
    $name = $_POST['name'];
    $phoneNo = $_POST['phoneNo'];
    $address = $_POST['address'];

    if (empty($name) || empty($phoneNo) || empty($address) || empty($growerEmail)) {
        header("Location:../grower-ui/editUserData.php?userDataUpdateStatus=invalid-inputs");
    } else {
        $editUserDataObj = new HandleEditUserData();

        //Updating the database with passed data
        $editUserDataResponse = $editUserDataObj->updateUserData($_SESSION['email'], $name, $phoneNo, $address);
        debug_to_console($editUserDataResponse);
        if ($editUserDataResponse != USERDATA_UPDATE_SUCCESS) {
            header("Location:../grower-ui/editUserData.php?userDataUpdateStatus=failed");
            return;
        }
        header("Location:../grower-ui/viewUserData.php");
    }

}

exit();
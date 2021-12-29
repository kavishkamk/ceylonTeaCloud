<?php
require_once "../utils.php";
require_once "../constants.php";
require_once "../phpClasses/GrowerProfile.class.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pic = $_FILES["fileToUpload"]["name"];
$fileName = basename($_FILES["fileToUpload"]["name"]);
$folder = "../images/users/";
$path = $folder . $pic;
$fileType = pathinfo($path, PATHINFO_EXTENSION);

if (isset($_POST['update-grower-profile']) && !empty($_FILES["fileToUpload"]["name"])) {

    $allowTypes = array('jpg', 'jpeg', 'png');
    if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $path)) {
            $growerProfile = new GrowerProfile();

            $imageUploadStatus = $growerProfile->uploadProfilePicture($fileName);
            if ($imageUploadStatus == UPLOADING_PROFILE_PIC_SUCCESS) {
                header("Location:../grower-ui/profilePic.php?profilePicUpdateStatus=success");
            } else {
                header("Location:../grower-ui/profilePic.php?profilePicUpdateStatus=failed");
            }
        } else {
            header("Location:../grower-ui/profilePic.php?profilePicUpdateStatus=failed");
        }
    } else {
        header("Location:../grower-ui/profilePic.php?profilePicUpdateStatus=failed");
    }

}

exit();
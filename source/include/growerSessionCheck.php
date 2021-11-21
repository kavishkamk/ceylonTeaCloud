<?php
require_once "../phpClasses/HandleGrowerSession.class.php";

session_start();

if (!isset($_SESSION['growerId'])) {
    header("Location:../grower-ui/index.php");
    exit();
} else {
    $growerSessionObj = new HandleGrowerSession();
    $sessionResponse = $growerSessionObj->checkSession($_SESSION['sessionId'], $_SESSION['growerId']); // invalid session
    unset($growerSessionObj);
    if ($sessionResponse != SESSION_AVAILABLE) {
        header("Location:../grower-ui/index.php");
        exit();
    }
}
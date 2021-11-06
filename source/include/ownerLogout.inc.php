<?php
    // for owner log out
    session_start();
    require_once "../phpClasses/OwnerSessionHandle.class.php";
    $offlineObj = new OwnerSessionHandle();
    $offlineObj->deleteSesseion($_SESSION['ownerid']);
    unset($offlineObj);

    session_unset();
    session_destroy();

    header("Location:../cyloneTeaCloud-org/ownerLogin.php?ownerlogstat=logoutok");
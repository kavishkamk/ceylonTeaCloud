<?php
    require "sessionCheck.php";

    if(isset($_POST['request-comfirm']) && isset($_POST['req-id'])){

        $requsetId = $_POST['req-id'];
        $requType = $_POST['report-type'];
        $growerId = $_POST['gro-id'];

        require_once "../phpClasses/PendingRequset.class.php";
        $reqObj = new PendingRequest();
        $reqRes = $reqObj->setRequestAsConfirm($requsetId);
        unset($reqObj);
        if($requType == "tea"){
            header("Location:../cyloneTeaCloud-org/teaRequest.php?result=ok&reqid=$requsetId&growid=$growerId"); // no session
        }
        else if($requType == "fer"){
            header("Location:../cyloneTeaCloud-org/fertilizerRequset.php?result=ok&reqid=$requsetId&growid=$growerId"); // no session
        }
        else if($requType == "lone"){
            header("Location:../cyloneTeaCloud-org/loneRequest.php?result=ok&reqid=$requsetId&growid=$growerId"); // no session
        }
        exit();
    }
    else{
        header("Location:../cyloneTeaCloud-org/pendingRequset.php"); // no session
        exit();
    }
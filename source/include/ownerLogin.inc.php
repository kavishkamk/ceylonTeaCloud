<?php
    session_start();
    // this class us used to handle admin login

    if(isset($_POST['log-submit'])){
        $umail = test_input($_POST['unameormail']);
        $pwd = test_input($_POST['pwd']);

        if(empty($umail) || empty($pwd)){
            header("Location:../cyloneTeaCloud-org/ownerLogin.php?ownerlogstat=emptyfield");
            exit();
        }
        else{
            require_once "../phpClasses/OwnerLoginHandle.class.php";

            $logObj = new OwnerLoginHandle();
            $logresult = $logObj->checkOwnerAccess($umail, $pwd);

            if($logresult == "0"){
                header("Location:../cyloneTeaCloud-org/ownerLogin.php?ownerlogstat=unotheride");
                unset($logObj);
                exit();
            }
            else if($logresult == "5"){
                header("Location:../cyloneTeaCloud-org/ownerLogin.php?ownerlogstat=unotheride");
                unset($logObj);
                exit();
            }
            else if($logresult == "1"){
                header("Location:../cyloneTeaCloud-org/adminDashBord.php");
                unset($logObj);
                exit();
            }
            else if($logresult == "2"){
                header("Location:../cyloneTeaCloud-org/ownerLogin.php?ownerlogstat=unotheride");
                unset($logObj);
                exit();
            }
            else if($logresult == "3"){
                header("Location:../cyloneTeaCloud-org/ownerLogin.php?ownerlogstat=sqlerr");
                unset($logObj);
                exit();
            }
        }
    }
    else{
        header("Location:../cyloneTeaCloud-org/ownerLogin.php");
        exit();
    }

    // filter inputs
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
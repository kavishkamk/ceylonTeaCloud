<?php 
    session_start();

    if(!isset($_SESSION['ownerid'])){
         header("Location:../cyloneTeaCloud-org/ownerLogin.php?ownerlogstat=logoutok"); // no session
         exit();
    }
    else{
        require_once "../phpClasses/OwnerSessionHandle.class.php";
        $sessObj = new OwnerSessionHandle();
        $sessRes = $sessObj->checkSession($_SESSION['sessionId'], $_SESSION['ownerid']); // invalid session
        unset($sessObj);
        if($sessRes != "1"){
            header("Location:../cyloneTeaCloud-org/ownerLogin.php?ownerlogstat=logoutok"); // no session
            exit();
        }
    }

    if(isset($_POST['pwd-submit'])){
        $upwd = test_input($_POST['upwd']);

        if(empty($upwd)){
            header("Location:../cyloneTeaCloud-org/adminProfileSetting.php?pwdedit=empty");
            exit();
        }
        else{
            require_once "../phpClasses/AdminProfileEdit.class.php";
            $proObj = new AdminProfileEdit();
            $pwdres = $proObj->CheckCurrentPwd($_SESSION['ownerid'], $upwd);
            unset($proObj);

            if($pwdres == "1"){
                $uid = $_SESSION['adminid'];
                header("Location:../cyloneTeaCloud-org/adminPwdChange.php?pwdchange=want&userid=$uid");
                exit();
            }
            else if($pwdres == "4"){
                header("Location:../cyloneTeaCloud-org/adminProfileSetting.php?pwdedit=wrongpwd");
                exit();
            }
            else if($pwdres == "usernotfund"){
                header("Location:../cyloneTeaCloud-org/adminProfileSetting.php?pwdedit=nouser");
                exit();
            }
            else if($pwdres == "sqlerror" || $pwdres == "5"){
                header("Location:../cyloneTeaCloud-org/adminProfileSetting.php?pwdedit=sqlerr");
                exit();
            }
        }
    }
    else{
        header("Location:../cyloneTeaCloud-org/adminProfileSetting.php");
        exit();
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
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
        $compwd = test_input($_POST['ucpwd']);
        $uid = test_input($_POST['userid']);

        if(empty($upwd) || empty($compwd) || empty($uid)){
            header("Location:../cyloneTeaCloud-org/adminPwdChange.php?pwdtatus=emptyfield&userid=$uid");
            exit();
        }
        else{
            if($upwd == $compwd){
                require_once "../phpClasses/AdminProfileEdit.class.php";
                $proObj = new AdminProfileEdit();
                $prores = $proObj->changePassword($uid, $upwd);
                unset($proObj);
                if($prores == "1"){
                    header("Location:../cyloneTeaCloud-org/adminProfileSetting.php?pwdedit=ok");
                    exit();
                }
                else{
                    header("Location:../cyloneTeaCloud-org/adminProfileSetting.php?pwdedit=err");
                    exit();
                }
            }
            else{
                header("Location:../cyloneTeaCloud-org/AdminPwdChange.php?pwdtatus=wrongpwd&userid=$uid");
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
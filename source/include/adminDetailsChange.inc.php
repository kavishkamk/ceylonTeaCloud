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

    if(isset($_POST['profile-submit'])){
        $fname = test_input($_POST['fname']);
        $tele = test_input($_POST['tele']);

        if(empty($fname) && empty($tele)){
            header("Location:../cyloneTeaCloud-org/adminProfileSetting.php?proedit=allempty");
            exit();
        }
        else{
            require_once "../phpClasses/AdminProfileEdit.class.php";
            $proObj = new AdminProfileEdit();
            $prores = $proObj->changeUserProfile($fname, $tele);
            unset($proObj);

            if($prores == "3"){
                header("Location:../cyloneTeaCloud-org/adminProfileSetting.php?proedits=unameok");
                exit();
            }
            else if($prores == "0"){
                header("Location:../cyloneTeaCloud-org/adminProfileSetting.php?proedit=sqlerr");
                exit();
            }
            else if($prores == "1"){
                header("Location:../cyloneTeaCloud-org/adminProfileSetting.php?proedits=success");
                exit();
            }
            else if($prores == "4"){
                header("Location:../cyloneTeaCloud-org/adminProfileSetting.php?proedit=fnamechar");
                exit();
            }
            else if($prores == "5"){
                header("Location:../cyloneTeaCloud-org/adminProfileSetting.php?proedit=fnamenum");
                exit();
            }
            else if($prores == "8"){
                header("Location:../cyloneTeaCloud-org/adminProfileSetting.php?proedit=unamechar");
                exit();
            }
            else if($prores == "9"){
                header("Location:../cyloneTeaCloud-org/adminProfileSetting.php?proedit=unamenum");
                exit();
            }
            else{
                header("Location:../cyloneTeaCloud-org/adminProfileSetting.php?proedit=error");
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
<?php 
    require "sessionCheck.php";

    if(isset($_POST['del-submit'])){
        if($_POST['delstat'] == "okDelete"){
            require_once "../phpClasses/AdminProfileEdit.class.php";
            $proObj = new AdminProfileEdit();
            $delres =$proObj->deleteAdminAcc($_SESSION['ownerid']);
            unset($proObj);

            if($delres == "1"){
                header("Location:../cyloneTeaCloud-org/ownerLogin.php?otpstatus=deleteacc");
                unset($delObj);
                exit();
            }
            else{
                header("Location:../cyloneTeaCloud-org/adminProfileSetting.php?logstat=sqlerror");
                unset($delObj);
                exit();
            }
        }
        else{
            header("Location:../cyloneTeaCloud-org/adminProfileSetting.php");
            exit();
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
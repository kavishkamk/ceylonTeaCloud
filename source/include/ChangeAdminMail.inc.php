<?php
    require "sessionCheck.php";

    if(isset($_POST['email-submit'])){
        $umail = test_input($_POST['umeil']);

        if(empty($umail)){
            header("Location:../cyloneTeaCloud-org/adminProfileSetting.php?mailedit=empty");
            exit();
        }
        else if(!filter_var($umail, FILTER_VALIDATE_EMAIL)){
            header("Location:../cyloneTeaCloud-org/adminProfileSetting.php?mailedit=invalid");
            exit();
        }
        else{
            // check user mail is availabale or not
            require_once "../phpClasses/AdminProfileEdit.class.php";
            $regObj = new AdminProfileEdit();
            $regRes = $regObj->isItAvailableEmail($umail, "admin");

            if($regRes == "0"){
                $prores = $regObj->changeUserMail($umail, $_SESSION['ownerid']);
                unset($regObj);

                if($prores == "1"){
                    header("Location:../cyloneTeaCloud-org/adminProfileSetting.php?mailedit=s");
                    exit();
                }
                else{
                    header("Location:../cyloneTeaCloud-org/adminProfileSetting.php");
                    exit();
                }
            }
            else if($regRes == "1"){
                unset($regObj);
                header("Location:../cyloneTeaCloud-org/adminProfileSetting.php?mailedit=avilablemail");
                exit();
            }
            else if($regRes == "sqlerror"){
                unset($regObj);
                header("Location:../cyloneTeaCloud-org/adminProfileSetting.php?mailedit=sqlerr");
                exit();
            }
        }
    }
    else{
        header("Location:../cyloneTeaCloud-org/adminProfileSetting.php?");
        exit();
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
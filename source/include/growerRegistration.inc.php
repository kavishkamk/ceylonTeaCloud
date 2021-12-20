<?php 
    require "sessionCheck.php";

    if(isset($_POST['register-submit'])){
        $firstName = test_input($_POST['firstname']);
        $tele = test_input($_POST['tele']);
        $usermail = test_input($_POST['uemail']);
        $address = test_input($_POST['address']);
        $userpwd = test_input($_POST['upassword']);
        $comfirmPwd = test_input($_POST['confirm-password']);

        require "../phpClasses/GrowerRegister.class.php";

        $regObj = new GrowerRegister($firstName, $tele, $usermail, $address, $userpwd, $comfirmPwd);
        $checkInput = $regObj -> checkRegInput();
        unset($regObj);

        if($checkInput == 0){
            require_once "../phpClasses/GrowerRegisterDbHandle.class.php";

            $regHandlerObj = new GrowerRegisterDbHandle();
            $userCheck = $regHandlerObj->isItAvailableEmail($usermail);

            if($userCheck == "1"){
                header("Location:../cyloneTeaCloud-org/growerRegister.php?signerror=abailableEmail&firstname=$firstName&tele=$tele&umail=$usermail&address=$address&picn=$impic");     
            }
            else if($userCheck == "0"){
                $regres = $regHandlerObj->growerRegisterUser($firstName, $tele, $usermail, $userpwd, $address);
                if($regres == "sqlerror"){
                    header("Location:../cyloneTeaCloud-org/growerRegister.php?signerror=sqlerror");
                }
                // register success
                else if($regres == "Success"){
                    header("Location:../cyloneTeaCloud-org/growerRegister.php?register=success");
                }
            }
            else if($userCheck == "sqlerror"){
                header("Location:../cyloneTeaCloud-org/growerRegister.php?signerror=sqlerror");
            }
            unset($regHandlerObj);
        }
        else if($checkInput == 1){
            header("Location:../cyloneTeaCloud-org/growerRegister.php?signerror=emptyfield&firstname=$firstName&tele=$tele&umail=$usermail&address=$address&picn=$impic"); 
        }
        else if($checkInput == 2){
            header("Location:../cyloneTeaCloud-org/growerRegister.php?signerror=wrongmail&firstname=$firstName&tele=$tele&umail=$usermail&address=$address&picn=$impic");
        }
        else if($checkInput == 4){
            header("Location:../cyloneTeaCloud-org/growerRegister.php?signerror=errtele&firstname=$firstName&tele=$tele&umail=$usermail&address=$address&picn=$impic");
        }
        else if($checkInput == 5){
            header("Location:../cyloneTeaCloud-org/growerRegister.php?signerror=errpwd&firstname=$firstName&tele=$tele&umail=$usermail&address=$address&picn=$impic");
        }
        exit();
    }
    else{
        header("Location:");
        exit();
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
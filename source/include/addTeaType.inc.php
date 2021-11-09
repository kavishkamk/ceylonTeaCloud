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

    if(isset($_POST['tea-insert-submit'])){
        $type = $_POST['tea-name'];
        $price = $_POST['tea-price'];

        if(empty($type) || empty($price)){
            header("Location:../cyloneTeaCloud-org/items.php?itemRes=empty"); // empty field
            exit();
        }
        else{
            require_once "../phpClasses/Items.class.php";
            $obj = new Items();
            $res = $obj->addTeaType($type, $price);
            unset($obj);
            if($res == 1){
                header("Location:../cyloneTeaCloud-org/items.php?itemRes=ss"); // sucess
                exit();
            }
            else{
                header("Location:../cyloneTeaCloud-org/items.php?itemRes=error"); // sucess
                exit();
            }
        }
    }
    else if(isset($_POST['tea-update-submit'])){
        $type = $_POST['tea-name'];
        $price = $_POST['tea-price'];

        if(empty($type) || empty($price)){
            header("Location:../cyloneTeaCloud-org/items.php?itemRes=empty"); // empty field
            exit();
        }
        else{
            require_once "../phpClasses/Items.class.php";
            $obj = new Items();
            $res = $obj->updateTeaPrice($type, $price);
            unset($obj);
            if($res == 1){
                header("Location:../cyloneTeaCloud-org/items.php?itemRes=ss"); // sucess
                exit();
            }
            else{
                header("Location:../cyloneTeaCloud-org/items.php?itemRes=error"); // sucess
                exit();
            }
        }
    }
    else{
        header("Location:../cyloneTeaCloud-org/items.php"); // no session
        exit();
    }
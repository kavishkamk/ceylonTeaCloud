<?php
    require "sessionCheck.php";

    if(isset($_POST['fertilizer-insert-submit'])){
        $type = $_POST['fertilizer-name'];
        $price = $_POST['fertilizer-price'];

        if(empty($type) || empty($price)){
            header("Location:../cyloneTeaCloud-org/items.php?itemRes=empty"); // empty field
            exit();
        }
        else{
            require_once "../phpClasses/Items.class.php";
            $obj = new Items();
            $res = $obj->addFertilezerType($type, $price);
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
    else if(isset($_POST['fertilizer-update-submit'])){
        $type = $_POST['fertilizer-name'];
        $price = $_POST['fertilizer-price'];

        if(empty($type) || empty($price)){
            header("Location:../cyloneTeaCloud-org/items.php?itemRes=empty"); // empty field
            exit();
        }
        else{
            require_once "../phpClasses/Items.class.php";
            $obj = new Items();
            $res = $obj->updateFertilizerPrice($type, $price);
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
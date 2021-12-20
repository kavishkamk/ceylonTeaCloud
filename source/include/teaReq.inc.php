<?php
    session_start();

    if(isset($_POST['t-com'])) {
        $groid = $_POST['gid'];
        $wantedId = $_POST['dayw'];
        $nMonth = $_POST['nmonth'];
        $amount = $_POST['amount'];
        $price = $_POST['pri'];
        $typeId = $_POST['tid'];

        if(empty($groid) || empty($wantedId) || empty($nMonth) || empty($amount) || empty($price) || empty($typeId)){
            header("Location:../request/TeaRequset.php?res=empty");
            exit();
        }
        else{
            require_once "../phpClasses/SendRequset.class.php";
            $obj = new SendRequset();
            $res = $obj->sendTeaRequset($groid, $wantedId, $nMonth, $amount, $price, $typeId);
            unset($obj);
            if($res == "1"){
                header("Location:../request/sendRequest.php?res=sendss");
                exit();
            }
            else{
                header("Location:../request/sendRequest.php?res=sendf");
                exit();
            }
        }
    }
    else {
        header("Location:../request/TeaRequset.php");
        exit();
    }
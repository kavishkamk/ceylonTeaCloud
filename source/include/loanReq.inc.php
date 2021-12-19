<?php
    session_start();

    if(isset($_POST['f-com'])) {
        $groid = $_POST['gid'];
        $hreason= $_POST['hreason'];
        $nMonth = $_POST['nmonth'];
        $amount = $_POST['amount'];
        $reason = $_POST['reason'];

        if(empty($groid) || empty($hreason) || empty($nMonth) || empty($amount) || empty($reason)){
            header("Location:../request/loanRequset.php?res=empty");
            exit();
        }
        else{
            require_once "../phpClasses/SendRequset.class.php";
            $obj = new SendRequset();
            $res = $obj->sendLoanRequset($groid, $hreason, $nMonth, $amount, $reason);
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
        header("Location:../request/loanRequset.php");
        exit();
    }

    
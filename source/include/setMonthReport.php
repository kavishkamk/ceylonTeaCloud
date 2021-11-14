<?php
    require "sessionCheck.php";

    if(isset($_POST['create-report'])){
        $finalWait = $_POST['final-wait'];
        $loanPrice = $_POST['loan-price'];
        $teaPrice = $_POST['tea-price'];
        $fertilizePrice = $_POST['fertilizer-price'];
        $priceof1kg = $_POST['price-tea'];
        $teaid = $_POST['tea-id'];
        $fertilizeId = $_POST['lone-id'];
        $loneId = $_POST['fertilize-id'];
        $report_id = $_POST['report-id'];
        $gro_id = $_POST['grow-id'];
        $year = $_POST['r-month'];
        $month = $_POST['r-year'];

        if(empty($finalWait) || empty($priceof1kg) || empty($gro_id)){
            header("Location:../cyloneTeaCloud-org/MonthdataEnter.php?result=empty"); // no session
            exit();
        }
        else{
            require_once "../phpClasses/MonthReport.class.php";
            $obj = new MonthReport();
            $res = $obj->addMonthReportData($finalWait, $loanPrice, $teaPrice, $fertilizePrice, $priceof1kg, $teaid, $fertilizeId, $loneId, $report_id, $gro_id, $year, $month);
            unset($obj);
            if($res == 1){
                header("Location:../cyloneTeaCloud-org/MonthdataEnter.php?result=ss"); // no session
                exit();
            }
            else{
               header("Location:../cyloneTeaCloud-org/MonthdataEnter.php?result=sqlerror"); // no session
                exit();
            }
        }
    }
    else{
        header("Location:../cyloneTeaCloud-org/MonthdataEnter.php"); // no session
        exit();
    }
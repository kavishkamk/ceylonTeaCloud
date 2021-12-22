<?php
    require "sessionCheck.php";

    if(isset($_POST['data-submit'])){
        $totalWeightSack = 0;
        $waterWeithg = 0;
        $nonStdLeaves = 0;
        $otherDeductionWeight = 0;
        $finalWeight = 0;

        $inputdate = $_POST['input-date'];
        $groId = $_POST['grower-id'];
        $numSac = $_POST['num-sac'];
        $fullWeight = $_POST['weight'];
        $tempSW = $_POST['sack-weight'];
        $tempTws = $_POST['w-rate'];
        $tempNSL = $_POST['nun-std-leave'];
        $tempODW = $_POST['other-ded-weight'];
        $reason = $_POST['reason'];

        if(empty($_POST['other-ded-weight'])){
            $tempODW = 0;
        }
        if(empty($_POST['reason'])){
            $reason = "-";
        }

        if(empty($inputdate) || empty($groId) || empty($numSac) || empty($fullWeight)){
            header("Location:../cyloneTeaCloud-org/dataEnter.php?result=empty");
            exit();
        }
        else{
            if(!empty($tempSW)){
                $totalWeightSack = $tempSW;
            }
            if(!empty($tempTws)){
                $waterWeithg = ($fullWeight * ($tempTws / 100));
            }
            if(!empty($tempNSL)){
                $nonStdLeaves = ($fullWeight * ($tempNSL / 100));
            }
            if(!empty($tempODW)){
                $otherDeductionWeight = $tempODW;
            }
            $finalWeight = $fullWeight - ($totalWeightSack + $waterWeithg + $nonStdLeaves + $otherDeductionWeight);

            if($finalWeight >= 0){
                require_once "../phpClasses/DataEnter.class.php";
                $obj = new DateEnter();
                $res = $obj->enterData($groId, $numSac, $fullWeight, $inputdate);
                if($res == "sqlerror"){
                    unset($obj);
                    header("Location:../cyloneTeaCloud-org/dataEnter.php?result=sqlerror");
                    exit();
                }
                else if($res == "nomember"){
                    unset($obj);
                    header("Location:../cyloneTeaCloud-org/dataEnter.php?result=nouser");
                    exit();
                }
                else{
                    $dedRes = $obj->enterDeductionData($res, $totalWeightSack, $waterWeithg, $nonStdLeaves);
                    if($dedRes != "sqlerror"){
                        
                        $otherRes = $obj->addOtherDeduction($dedRes, $reason, $otherDeductionWeight);

                        $netRes = $obj -> setNetWeight($res, $finalWeight);

                        $obj -> set_net_waight_other_ded_map($netRes, $otherRes);

                        unset($obj);
                        header("Location:../cyloneTeaCloud-org/dataEnter.php?result=ss");
                        exit();
                    }
                    else{
                        unset($obj);
                        header("Location:../cyloneTeaCloud-org/dataEnter.php?result=sqlerror");
                        exit();
                    }
                }
            }
            else{
                unset($obj);
                header("Location:../cyloneTeaCloud-org/dataEnter.php?result=wrong");
                exit();
            }
        }
    }
    else{
        header("Location:../cyloneTeaCloud-org/dataEnter.php");
        exit();
    }
<?php
    require_once "DbConnection.class.php";

    // this class use for enter data
    class DateEnter extends DbConnection{

        // enter input table data and set the member, input data map
        public function enterData($groId, $numSac, $fullWeight, $inputdate){
            $memberId = $this->getMemberID($groId);
            if($memberId != "sqlerror" && $memberId != "nouser"){
                $inputId = $this->fillDataInputTable($numSac, $fullWeight, $inputdate);
                if($inputId != "sqlerror"){
                    $inputMemMapRes = $this->set_member_data_input_map($memberId, $inputId);
                    if($inputMemMapRes != "sqlerror"){
                        return $inputId;
                        exit();
                    }
                    else{
                        return "sqlerror";
                        exit();
                    }
                }
                else{
                    return "sqlerror";
                    exit();
                }
            }
            else{
                return "nomember";
                exit();
            }
        }

        // this for enter diducton data
        public function enterDeductionData($inputId, $totalWeightSack, $waterWeithg, $nonStdLeaves){
            $sqlQ = "INSERT INTO deduction(sack_waight, non_standard_leaves, ded_total, water_weigth) VALUES (?, ?, ?, ?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                $dedTotal = $totalWeightSack + $waterWeithg + $nonStdLeaves;
                mysqli_stmt_bind_param($stmt, "dddd", $totalWeightSack, $nonStdLeaves, $dedTotal, $waterWeithg);
                mysqli_stmt_execute($stmt);
                $detailsInsertId = mysqli_stmt_insert_id($stmt);
                $this->connclose($stmt, $conn);
                $this->set_data_input_dedication_map($inputId, $detailsInsertId);
                return $detailsInsertId;
                exit();
            }
        }

        // add other deduction
        public function addOtherDeduction($dedRes, $reason, $tempODW){
            $sqlQ = "INSERT INTO deduction_others(reason, weightOfDeduction) VALUES(?,?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "sd", $reason, $tempODW);
                mysqli_stmt_execute($stmt);
                $otherDedInsertId = mysqli_stmt_insert_id($stmt);
                $this->set_deduction_other_map($dedRes, $otherDedInsertId);
                $this->connclose($stmt, $conn);
                return $otherDedInsertId;
                exit();
            }
        }

        // set new weight
        public function setNetWeight($res, $finalWeight){
            $sqlQ = "INSERT INTO net_weight(data_id, `weight`) VALUES(?,?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "id", $res, $finalWeight);
                mysqli_stmt_execute($stmt);
                $netWeightInsertId = mysqli_stmt_insert_id($stmt);
                $this->connclose($stmt, $conn);
                return $netWeightInsertId;
                exit();
            }
        }

        // set net_waight_other_ded_map
        public function set_net_waight_other_ded_map($netRes, $otherRes){
            $sqlQ = "INSERT INTO net_waight_other_ded_map(net_id, deduction_id) VALUES(?,?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "ii", $netRes, $otherRes);
                mysqli_stmt_execute($stmt);
                $this->connclose($stmt, $conn);
                return 1;
                exit();
            }
        }

        // set deduction_other_map
        private function set_deduction_other_map($dedRes, $otherDedInsertId){
            $sqlQ = "INSERT INTO deduction_other_map(ded_id, ded_other_id) VALUES(?,?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "ii", $dedRes, $otherDedInsertId);
                mysqli_stmt_execute($stmt);
                $this->connclose($stmt, $conn);
                return 1;
                exit();
            }
        }

        // set member_data_input_map table
        private function set_member_data_input_map($memberId, $inputId){
            $sqlQ = "INSERT INTO member_data_input_map(member_id, data_id) VALUES(?,?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "ii", $memberId, $inputId);
                mysqli_stmt_execute($stmt);
                $this->connclose($stmt, $conn);
                return 1;
                exit();
            }
        }

        private function set_data_input_dedication_map($inputId, $detailsInsertId){
            $sqlQ = "INSERT INTO data_input_dedication_map(data_id, deduction_id) VALUES(?,?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "ii", $inputId, $detailsInsertId);
                mysqli_stmt_execute($stmt);
                $this->connclose($stmt, $conn);
                return 1;
                exit();
            }
        }

        // fill data input table
        private function fillDataInputTable($numSac, $fullWeight, $inputdate){
            $sqlQ = "INSERT INTO data_input(number_of_sacks, total_weight, `date`) VALUES (?, ?, ?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "ids", $numSac, $fullWeight, $inputdate);
                mysqli_stmt_execute($stmt);
                $detailsInsertId = mysqli_stmt_insert_id($stmt);
                $this->connclose($stmt, $conn);
                return $detailsInsertId;
                exit();
            }
        }

        // this is used to get member id from grower id
        private function getMemberID($groId){
            $sqlQ = "SELECT member.member_id FROM (grower INNER JOIN
            member ON grower.id = member.grower_id) WHERE grower.id = ?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "i", $groId);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if($row = mysqli_fetch_assoc($result)){
                    $this->connclose($stmt, $conn);
                    return $row['member_id'];
                    exit();
                }
                else{
                    $this->connclose($stmt, $conn);
                    return "nouser";
                    exit();
                }
            }
        }

        private function connclose($stmt, $conn){
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
    }
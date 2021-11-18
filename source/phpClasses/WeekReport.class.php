<?php
    require_once "DbConnection.class.php";

    // this class use for get owner details
    class WeekReport extends DbConnection{

        public function getWeekReportTableData($startDay, $endDate){
            $sqlQ = "SELECT data_input.data_id, grower.id, data_input.date FROM
            (((data_input INNER JOIN member_data_input_map ON data_input.data_id = member_data_input_map.data_id)
            INNER JOIN member ON member_data_input_map.member_id = member.member_id)
            INNER JOIN grower ON member.grower_id = grower.id)
            WHERE DATE(data_input.date) >= ? AND DATE(data_input.date) <= ? ORDER BY data_input.date DESC;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else {
                $val1 = 1;
                mysqli_stmt_bind_param($stmt, "ss", $startDay, $endDate);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $this->connclose($stmt, $conn);
                return $result;
                exit();
            }
        }

        // get deduction details of given record id
        public function getMainDeduction($recId){
            $sqlQ = "SELECT data_input.number_of_sacks, data_input.total_weight, data_input.date, deduction.sack_waight,
            deduction.non_standard_leaves, deduction.water_weigth, deduction_others.reason,
            deduction_others.weightOfDeduction FROM
            ((((data_input INNER JOIN data_input_dedication_map ON data_input.data_id = data_input_dedication_map.data_id)
            INNER JOIN deduction ON data_input_dedication_map.deduction_id = deduction.ded_id)
            LEFT JOIN deduction_other_map ON deduction.ded_id = deduction_other_map.ded_id)
            LEFT JOIN deduction_others ON deduction_other_map.ded_other_id = deduction_others.ded_other_id)
            WHERE data_input.data_id = ?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "i", $recId);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if($row = mysqli_fetch_assoc($result)){
                    $this->connclose($stmt, $conn);
                    return $row;
                    exit();
                }
                else{
                    $this->connclose($stmt, $conn);
                    return "nouser";
                    exit();
                }
            }
        }

        // get net weigh of given record id
        public function getNetWeightResult($recId){
            $sqlQ = "SELECT net_weight.weight FROM (data_input INNER JOIN net_weight
            ON data_input.data_id = net_weight.data_id) WHERE data_input.data_id = ?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);
 
            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "i", $recId);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if($row = mysqli_fetch_assoc($result)){
                    $this->connclose($stmt, $conn);
                    return $row['weight'];
                    exit();
                }
                else{
                    $this->connclose($stmt, $conn);
                    return "nouser";
                    exit();
                }
            }
        }

        public function numberOfWeekReports(){
            $sqlQ = 'SELECT COUNT(data_input.data_id) AS numOfReport FROM data_input
            WHERE DATE(data_input.date) >= ? AND DATE(data_input.date) <= ?;';
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);
 
            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if($row = mysqli_fetch_assoc($result)){
                    $this->connclose($stmt, $conn);
                    return $row['numOfReport'];
                    exit();
                }
                else{
                    $this->connclose($stmt, $conn);
                    return 0;
                    exit();
                }
            }
        }

        private function connclose($stmt, $conn){
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
    }
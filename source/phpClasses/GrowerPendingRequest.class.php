<?php
    require_once "DbConnection.class.php";

    // this class use for check owner with passwords and create session for admin
    class GrowerPendingRequest extends DbConnection{

        // get pending tea request or confirm tea request
        public function getTeaPendingRequsetForGivenGrower($val, $groId){
            $sqlQ = "SELECT request.req_id, DATE(request.req_date) AS req_date FROM
            ((((request INNER JOIN req_tea_map ON request.req_id = req_tea_map.req_id AND request.status = ?)
            INNER JOIN member_request_map ON request.req_id = member_request_map.req_id)
            INNER JOIN member ON member_request_map.member_id = member.member_id)
            INNER JOIN grower ON member.grower_id = grower.id AND grower.id = ?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                $arr = array();
                mysqli_stmt_bind_param($stmt, "ii", $val, $groId);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $this->connclose($stmt, $conn);
                while($row = mysqli_fetch_assoc($result)){
                    $row["type"] = "Tea";
                    $arr[] = $row;
                }
                return $arr;
                exit();
            }
        }

        public function getFretilizerPendingRequset($val, $groId){
            $sqlQ = "SELECT request.req_id, DATE(request.req_date) AS req_date FROM
            ((((request INNER JOIN req_fertilizer_map ON request.req_id = req_fertilizer_map.req_id AND request.status = ?)
            INNER JOIN member_request_map ON request.req_id = member_request_map.req_id)
            INNER JOIN member ON member_request_map.member_id = member.member_id)
            INNER JOIN grower ON member.grower_id = grower.id AND grower.id = ?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                $arr = array();
                mysqli_stmt_bind_param($stmt, "ii", $val, $groId);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $this->connclose($stmt, $conn);
                while($row = mysqli_fetch_assoc($result)){
                    $row["type"] = "Fertilizer";
                    $arr[] = $row;
                }
                return $arr;
                exit();
            }
        }

        public function getLonePendingRequestList($val, $groId){
            $sqlQ = "SELECT request.req_id, DATE(request.req_date) AS req_date FROM
            ((((request INNER JOIN req_loan_map ON request.req_id = req_loan_map.req_id AND request.status = ?)
            INNER JOIN member_request_map ON request.req_id = member_request_map.req_id)
            INNER JOIN member ON member_request_map.member_id = member.member_id)
            INNER JOIN grower ON member.grower_id = grower.id AND grower.id = ?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                $arr = array();
                mysqli_stmt_bind_param($stmt, "ii", $val, $groId);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $this->connclose($stmt, $conn);
                while($row = mysqli_fetch_assoc($result)){
                    $row["type"] = "Loan";
                    $arr[] = $row;
                }
                return $arr;
                exit();
            }
        }

        private function connclose($stmt, $conn){
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
    }
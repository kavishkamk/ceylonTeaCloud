<?php
    require_once "DbConnection.class.php";

    // this class use for check owner with passwords and create session for admin
    class PendingRequest extends DbConnection{

        // get pending tea request
        public function getTeaPendingRequset(){
            $sqlQ = "SELECT request.req_id, DATE(request.req_date) AS req_date, grower.id FROM
            ((((request INNER JOIN req_tea_map ON request.req_id = req_tea_map.req_id AND request.status = ?)
            INNER JOIN member_request_map ON request.req_id = member_request_map.req_id)
            INNER JOIN member ON member_request_map.member_id = member.member_id)
            INNER JOIN grower ON member.grower_id = grower.id);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                $val0 = 0;
                mysqli_stmt_bind_param($stmt, "i", $val0);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $this->connclose($stmt, $conn);
                return $result;
                exit();
            }
        }

        public function getFretilizerPendingRequset(){
            $sqlQ = "SELECT request.req_id, DATE(request.req_date) AS req_date, grower.id FROM
            ((((request INNER JOIN req_fertilizer_map ON request.req_id = req_fertilizer_map.req_id AND request.status = ?)
            INNER JOIN member_request_map ON request.req_id = member_request_map.req_id)
            INNER JOIN member ON member_request_map.member_id = member.member_id)
            INNER JOIN grower ON member.grower_id = grower.id);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                $val0 = 0;
                mysqli_stmt_bind_param($stmt, "i", $val0);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $this->connclose($stmt, $conn);
                return $result;
                exit();
            }
        }

        public function getLonePendingRequestList(){
            $sqlQ = "SELECT request.req_id, DATE(request.req_date) AS req_date, grower.id FROM
            ((((request INNER JOIN req_loan_map ON request.req_id = req_loan_map.req_id AND request.status = ?)
            INNER JOIN member_request_map ON request.req_id = member_request_map.req_id)
            INNER JOIN member ON member_request_map.member_id = member.member_id)
            INNER JOIN grower ON member.grower_id = grower.id);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                $val0 = 0;
                mysqli_stmt_bind_param($stmt, "i", $val0);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $this->connclose($stmt, $conn);
                return $result;
                exit();
            }
        }

        // this method used to get requset details for tea using given requset id
        public function getTeaRequsetDetails($reqid){
            $sqlQ = "SELECT DATE(request.req_date) AS req_date, DATE(tea.date_wanted) AS date_wanted,
            tea.number_of_months_to_pay, tea_request.item_price, tea_request.amount, tea_request.monthly_ded,
            tea_type.tea_type FROM ((((request INNER JOIN req_tea_map ON request.req_id = req_tea_map.req_id)
            INNER JOIN tea ON req_tea_map.tea_id = tea.tea_id)
            INNER JOIN tea_request ON tea.tea_id = tea_request.request_id)
            INNER JOIN tea_type ON tea_request.tea_type_id = tea_type.type_id) WHERE request.req_id = ?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                $resArr = array();
                mysqli_stmt_bind_param($stmt, "i", $reqid);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $this->connclose($stmt, $conn);
                while($row1 = mysqli_fetch_assoc($result)){
                    $resArr[] = $row1;
                }
                return $resArr;
                exit();
            }
        }

        // this method used to get requset details for fertilizer using given requset id
        public function getFertilizerDetails($reqid){
            $sqlQ = "SELECT DATE(request.req_date) AS req_date, DATE(fertilizer.date_wanted) AS date_wanted,
            fertilizer.number_of_months, fertilizer_request.item_price, fertilizer_request.amount,
            fertilizer_request.monthly_deduction, fertilizer_type.fertilizer_type FROM
            ((((request INNER JOIN req_fertilizer_map ON request.req_id = req_fertilizer_map.req_id)
            INNER JOIN fertilizer ON req_fertilizer_map.fertilizer_id = fertilizer.fertilizer_id)
            INNER JOIN fertilizer_request ON fertilizer.fertilizer_id = fertilizer_request.request_id)
            INNER JOIN fertilizer_type ON fertilizer_request.fertilizer_type_id = fertilizer_type.type_id)
            WHERE request.req_id = ?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                $resArr = array();
                mysqli_stmt_bind_param($stmt, "i", $reqid);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $this->connclose($stmt, $conn);
                while($row1 = mysqli_fetch_assoc($result)){
                    $resArr[] = $row1;
                }
                return $resArr;
                exit();
            }
        }

        public function getLoneDetails($reqid){
            $sqlQ = "SELECT DATE(request.req_date) AS req_date, loan.amount, loan.number_of_months_to_pay,
            loan.monthly_ded, loan.loanHeader, loan.discription FROM
            ((request INNER JOIN req_loan_map ON request.req_id = req_loan_map.req_id)
            INNER JOIN loan ON req_loan_map.loan_id = loan.loan_id)
            WHERE request.req_id = ?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "i", $reqid);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $this->connclose($stmt, $conn);
                $row1 = mysqli_fetch_assoc($result);
                return $row1;
                exit();
            }
        }

        private function connclose($stmt, $conn){
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
    }

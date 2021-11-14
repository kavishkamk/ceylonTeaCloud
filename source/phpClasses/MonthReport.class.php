<?php
    require_once "DbConnection.class.php";

    // this class use for get owner details
    class MonthReport extends DbConnection{

        public function getReportIdList($grower_id, $startDay, $endDate){
            $sqlQ = 'SELECT data_input.data_id FROM
            (((data_input INNER JOIN member_data_input_map ON data_input.data_id = member_data_input_map.data_id)
            INNER JOIN member ON member_data_input_map.member_id = member.member_id)
            INNER JOIN grower ON member.grower_id = grower.id AND grower.id = ?)
            WHERE DATE(data_input.date) >= ? AND DATE(data_input.date) <= ?;';
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else {
                $idArr = array();
                $val1 = 1;
                mysqli_stmt_bind_param($stmt, "iss", $grower_id, $startDay, $endDate);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while($row = mysqli_fetch_assoc($result)){
                    $idArr[] = $row['data_id'];
                }
                $this->connclose($stmt, $conn);
                return $idArr;
                exit();
            }
        }

        public function getTeaPrices($gid){
            $sqlQ = "SELECT request.req_id, tea.paid_monnth FROM
            (((((request INNER JOIN req_tea_map ON request.req_id = req_tea_map.req_id AND request.status = ?)
            INNER JOIN tea ON tea.number_of_months_to_pay > tea.paid_monnth)
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
            else {
                $idArr = array();
                $val1 = 1;
                mysqli_stmt_bind_param($stmt, "ii", $val1, $gid);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while($row = mysqli_fetch_assoc($result)){
                    $idArr[] = $row;
                }
                $this->connclose($stmt, $conn);
                return $idArr;
                exit();
            }
        }

        public function getFertilizerPrice($gid){
            $sqlQ = "SELECT request.req_id, fertilizer.paid_monnth FROM
            (((((request INNER JOIN req_fertilizer_map ON request.req_id = req_fertilizer_map.req_id AND
            request.status = ?) INNER JOIN fertilizer ON req_fertilizer_map.fertilizer_id = fertilizer.fertilizer_id
            AND fertilizer.number_of_months > fertilizer.paid_monnth)
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
            else {
                $idArr = array();
                $val1 = 1;
                mysqli_stmt_bind_param($stmt, "ii", $val1, $gid);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while($row = mysqli_fetch_assoc($result)){
                    $idArr[] = $row;
                }
                $this->connclose($stmt, $conn);
                return $idArr;
                exit();
            }
        }

        public function getLonePriceId($gid){
            $sqlQ = 'SELECT request.req_id, loan.monthly_ded, loan.paid_monnth FROM
            ((((request INNER JOIN req_loan_map ON request.req_id = req_loan_map.req_id AND request.status = ?)
            INNER JOIN loan ON req_loan_map.loan_id = loan.loan_id AND loan.number_of_months_to_pay > loan.paid_monnth
            INNER JOIN member_request_map ON request.req_id = member_request_map.req_id)
            INNER JOIN member ON member_request_map.member_id = member.member_id)
            INNER JOIN grower ON member.grower_id = grower.id AND grower.id = ?);';
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                $val1 = 1;
                $resArr = array();
                mysqli_stmt_bind_param($stmt, "ii", $val1, $gid);
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

        public function getFertilizerDeductions($reqid){
            $sqlQ = "SELECT fertilizer_request.monthly_deduction FROM
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

        public function getTeaReqDeductions($reqid){
            $sqlQ = "SELECT tea_request.monthly_ded FROM ((((request INNER JOIN
            req_tea_map ON request.req_id = req_tea_map.req_id)
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

        public function addMonthReportData($finalWait, $loanPrice, $teaPrice, $fertilizePrice, $priceof1kg, $teaid, $fertilizeId, $loneId, $report_id, $gro_id, $year, $month){
            $sqlQ = "INSERT INTO `monthly_report`(`date`, `total_weight`, `total_deducation_per_month`, `price_of_1kg`,
            `total_price`, `payment`, `grower_id`, `repott_year`, `repott_month`) VALUES (?,?,?,?,?,?,?,?,?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                $onlieTime = date("Y-n-d H:i:s"); // acout log date and time
                $ttdeduction = $teaPrice + $loanPrice + $fertilizePrice;
                $ttprice = $finalWait * $priceof1kg;
                $tpayment = $ttprice - $ttdeduction;
                mysqli_stmt_bind_param($stmt, "sdddddiii", $onlieTime, $finalWait, $ttdeduction, $priceof1kg, $ttprice, $tpayment, $gro_id, $year, $month);
                mysqli_stmt_execute($stmt);
                $detailsInsertId = mysqli_stmt_insert_id($stmt);
                $this->connclose($stmt, $conn);
                $memId = $this->getMemberID($gro_id);
                if($memId != "sqlerror"){
                    $this->set_member_report_map($detailsInsertId, $memId);
                    $this->set_loneId($loneId, $detailsInsertId);
                    $this->set_teaId($teaid, $detailsInsertId);
                    $this->set_fertilizerId($fertilizeId, $detailsInsertId);
                    $this->set_weekReportId($report_id, $detailsInsertId);
                }
                return 1;
                exit();
            }
        }

        private function set_weekReportId($lids, $detailsInsertId){
            $arr = explode("-", $lids);
            print_r($arr);
            foreach($arr as $idlist){
                echo $idlist;
                if($idlist != NULL && $lids != ""){
                 $this->set_weekReportId_table($detailsInsertId, $idlist);
                }
            }
            return 1;
            exit();
        }

        private function set_weekReportId_table($detailsInsertId, $idlist){
            $sqlQ = "INSERT INTO weekReportId(month_report_id, week_report_id) VALUES(?,?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                echo " ";
                echo $detailsInsertId;
                echo "-";
                echo $idlist;
                echo " ";
                mysqli_stmt_bind_param($stmt, "ii", $detailsInsertId, $idlist);
                mysqli_stmt_execute($stmt);
                $this->connclose($stmt, $conn);
                return 1;
            }
        }

        private function set_fertilizerId($lids, $detailsInsertId){
            $arr = explode("-", $lids);
            $sqlQ = "INSERT INTO fertilizerId(month_report_id, request_id) VALUES(?,?);";
            $conn = $this->connect();
            foreach($arr as $idlist){
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                    $this->connclose($stmt, $conn);
                }
                else{
                    mysqli_stmt_bind_param($stmt, "ii", $detailsInsertId, $idlist);
                    mysqli_stmt_execute($stmt);
                }
            }

            $this->connclose($stmt, $conn);
            return 1;
            exit();
        }

        private function set_teaId($lids, $detailsInsertId){
            $arr = explode("-", $lids);
            $sqlQ = "INSERT INTO teaId(month_report_id, request_id) VALUES(?,?);";
            $conn = $this->connect();
            foreach($arr as $idlist){
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                    $this->connclose($stmt, $conn);
                }
                else{
                    mysqli_stmt_bind_param($stmt, "ii", $detailsInsertId, $idlist);
                    mysqli_stmt_execute($stmt);
                }
            }

            $this->connclose($stmt, $conn);
            return 1;
            exit();
        }

        private function set_loneId($lids, $detailsInsertId){
            $arr = explode("-", $lids);
            $sqlQ = "INSERT INTO loneId(month_report_id, request_id) VALUES(?,?);";
            $conn = $this->connect();
            foreach($arr as $idlist){
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                    $this->connclose($stmt, $conn);
                    return "sqlerror";
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($stmt, "ii", $detailsInsertId, $idlist);
                    mysqli_stmt_execute($stmt);
                }
            }

            $this->connclose($stmt, $conn);
            return 1;
        }

        private function set_member_report_map($detailsInsertId, $memId){
            $sqlQ = "INSERT INTO member_report_map(member_id, report_id) VALUES(?,?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "ii", $detailsInsertId, $memId);
                mysqli_stmt_execute($stmt);
                $this->connclose($stmt, $conn);
                return 1;
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
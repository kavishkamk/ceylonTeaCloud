<?php
    require_once "DbConnection.class.php";

    // this class use for get owner details
    class MonthReport extends DbConnection{

        public function getNetWeightDetails($id){
            $sqlQ = "SELECT data_input.data_id, net_weight.weight FROM
            (((monthly_report INNER JOIN weekreportid ON monthly_report.report_id = weekreportid.month_report_id)
            INNER JOIN data_input ON weekreportid.week_report_id = data_input.data_id)
            INNER JOIN net_weight ON data_input.data_id = net_weight.data_id) WHERE monthly_report.report_id = ?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                $idArr = array();
                mysqli_stmt_bind_param($stmt, "i", $id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while($row = mysqli_fetch_assoc($result)){
                    $idArr[$row['data_id']] = $row;
                }
                $this->connclose($stmt, $conn);
                return $idArr;
                exit();
            }
        }

        public function getDeductionDetails($id){
            $sqlQ = "SELECT data_input.data_id, DATE(data_input.date) AS dayrec, data_input.total_weight,
            deduction.sack_waight, deduction.non_standard_leaves, deduction.water_weigth, deduction_others.reason,
            deduction_others.weightOfDeduction FROM
            ((((((monthly_report INNER JOIN weekreportid ON monthly_report.report_id = weekreportid.month_report_id)
            INNER JOIN data_input ON weekreportid.week_report_id = data_input.data_id)
            INNER JOIN data_input_dedication_map ON data_input.data_id = data_input_dedication_map.data_id)
            INNER JOIN deduction ON data_input_dedication_map.deduction_id = deduction.ded_id)
            LEFT JOIN deduction_other_map ON deduction.ded_id = deduction_other_map.ded_id)
            LEFT JOIN deduction_others ON deduction_other_map.ded_other_id = deduction_others.ded_other_id)
            WHERE monthly_report.report_id = ?;";
            
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                $idArr = array();
                mysqli_stmt_bind_param($stmt, "i", $id);
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

        public function getLoneDetails($id){
            $sqlQ = "SELECT loan.amount, loan.monthly_ded, loan.loanHeader FROM
            ((((monthly_report INNER JOIN loneid ON monthly_report.report_id = loneid.month_report_id)
            INNER JOIN request ON loneid.request_id = request.req_id)
            INNER JOIN req_loan_map ON request.req_id = req_loan_map.req_id)
            INNER JOIN loan ON req_loan_map.loan_id = loan.loan_id)
            WHERE monthly_report.report_id = ?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                $idArr = array();
                mysqli_stmt_bind_param($stmt, "i", $id);
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

        public function getFertilizerDetails($id){
            $sqlQ = "SELECT fertilizer_request.monthly_deduction, fertilizer_type.fertilizer_type, fertilizer_request.item_price FROM
            ((((((monthly_report INNER JOIN fertilizerid ON monthly_report.report_id = fertilizerid.month_report_id)
            INNER JOIN request ON fertilizerid.request_id = request.req_id)
            INNER JOIN req_fertilizer_map ON request.req_id = req_fertilizer_map.req_id)
            INNER JOIN fertilizer ON req_fertilizer_map.fertilizer_id = fertilizer.fertilizer_id)
            INNER JOIN fertilizer_request ON fertilizer.fertilizer_id = fertilizer_request.request_id)
            INNER JOIN fertilizer_type ON fertilizer_request.type_id = fertilizer_type.type_id) WHERE monthly_report.report_id = ?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                $idArr = array();
                mysqli_stmt_bind_param($stmt, "i", $id);
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

        public function getTeaRequsetDetails($id){
            $sqlQ = "SELECT tea_request.monthly_ded, tea_type.tea_type, tea_request.item_price FROM
            ((((((monthly_report INNER JOIN teaid ON monthly_report.report_id = teaid.month_report_id)
            INNER JOIN request ON teaid.request_id = request.req_id)
            INNER JOIN req_tea_map ON request.req_id = req_tea_map.req_id)
            INNER JOIN tea ON req_tea_map.tea_id = tea.tea_id)
            INNER JOIN tea_request ON tea.tea_id = tea_request.request_id)
            INNER JOIN tea_type ON tea_request.tea_type_id = tea_type.type_id) WHERE monthly_report.report_id = ?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                $idArr = array();
                mysqli_stmt_bind_param($stmt, "i", $id);
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

        public function getMonthReportDetails($id){
            $sqlQ = "SELECT * FROM monthly_report WHERE report_id = ?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "i", $id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if($row = mysqli_fetch_assoc($result)){
                    $this->connclose($stmt, $conn);
                    return $row;
                    exit();
                }
                else{
                    $this->connclose($stmt, $conn);
                    return "noreport";
                    exit();
                }
            }
        }

        public function getMonthlyReportsList($year, $month){
            $sqlQ = "SELECT report_id, grower_id, repott_year, repott_month FROM monthly_report
            WHERE repott_year = ? AND repott_month=? ORDER BY date DESC;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                $idArr = array();
                mysqli_stmt_bind_param($stmt, "ii", $year, $month);
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
            $numRes = $this->checkMonthDate($year, $month, $gro_id);
            if($numRes == 0){
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
                        if($loneId != 0){
                            $this->set_loneId($loneId, $detailsInsertId);
                            $this->updateLoneMonthCount($loneId);
                        }
                        if($teaid != 0){
                            $this->set_teaId($teaid, $detailsInsertId);
                            $this->updateTeaMonthCount($teaid);
                        }
                        if($fertilizeId != 0){
                            $this->set_fertilizerId($fertilizeId, $detailsInsertId);
                            $this->updateFertilizeMonthCount($fertilizeId);
                        }
                        $this->set_weekReportId($report_id, $detailsInsertId);
                    }
                    return 1;
                    exit();
                }
            }
            else{
                return "availabale";
                exit();
            }
        }

        private function updateLoneMonthCount($lids){
            $arr = explode("-", $lids);
            $sqlQ = "UPDATE loan SET paid_monnth = ? WHERE loan_id = ?;";
            $conn = $this->connect();
            foreach($arr as $idlist){
                if($idlist != NULL && $idlist != ""){
                    $row = $this->getPaidLoneMonth($idlist);
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                        $this->connclose($stmt, $conn);
                    }
                    else{
                        $val = $row['paid_monnth'] + 1;
                        mysqli_stmt_bind_param($stmt, "di", $val, $row['loan_id']);
                        mysqli_stmt_execute($stmt);
                    }
                }
            }

            $this->connclose($stmt, $conn);
            return 1;

        }

        private function updateTeaMonthCount($lids){
            $arr = explode("-", $lids);
            $sqlQ = "UPDATE tea SET paid_monnth = ? WHERE tea_id = ?;";
            $conn = $this->connect();
            foreach($arr as $idlist){
                if($idlist != NULL && $idlist != ""){
                    $row = $this->getPaidTeaMonth($idlist);
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                        $this->connclose($stmt, $conn);
                    }
                    else{
                        $val = $row['paid_monnth'] + 1;
                        mysqli_stmt_bind_param($stmt, "di", $val, $row['tea_id']);
                        mysqli_stmt_execute($stmt);
                    }
                }
            }

            $this->connclose($stmt, $conn);
            return 1;
        }

        private function updateFertilizeMonthCount($lids){
            $arr = explode("-", $lids);
            $sqlQ = "UPDATE fertilizer SET paid_monnth = ? WHERE fertilizer_id = ?;";
            $conn = $this->connect();
            foreach($arr as $idlist){
                if($idlist != NULL && $idlist != ""){
                    $row = $this->getPaidFertilize($idlist);
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                        $this->connclose($stmt, $conn);
                    }
                    else{
                        $val = $row['paid_monnth'] + 1;
                        mysqli_stmt_bind_param($stmt, "di", $val, $row['fertilizer_id']);
                        mysqli_stmt_execute($stmt);
                    }
                }
            }

            $this->connclose($stmt, $conn);
            return 1;
        }

        private function getPaidFertilize($id){
            $sqlQ = "SELECT fertilizer.paid_monnth, fertilizer.fertilizer_id FROM ((request INNER JOIN
            req_fertilizer_map ON request.req_id = req_fertilizer_map.req_id)
            INNER JOIN fertilizer ON req_fertilizer_map.fertilizer_id = fertilizer.fertilizer_id) WHERE request.req_id = ?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "i", $id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_assoc($result);
                $this->connclose($stmt, $conn);
                return $row;
                exit();

            }
        }

        private function getPaidTeaMonth($id){
            $sqlQ = "SELECT tea.paid_monnth, tea.tea_id FROM ((request INNER JOIN
            req_tea_map ON request.req_id = req_tea_map.req_id)
            INNER JOIN tea ON req_tea_map.tea_id = tea.tea_id) WHERE request.req_id = ?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "i", $id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_assoc($result);
                $this->connclose($stmt, $conn);
                return $row;
                exit();

            }
        }

        private function getPaidLoneMonth($id){
            $sqlQ = "SELECT loan.paid_monnth, loan.loan_id FROM ((request INNER JOIN
            req_loan_map ON request.req_id = req_loan_map.req_id)
            INNER JOIN loan ON req_loan_map.loan_id = loan.loan_id) WHERE request.req_id = ?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "i", $id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_assoc($result);
                $this->connclose($stmt, $conn);
                return $row;
                exit();

            }
        }

        private function checkMonthDate($year, $month, $groid){
            $sqlQ = "SELECT COUNT(report_id) AS num FROM monthly_report WHERE repott_year=? AND repott_month=? AND grower_id=?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "iii", $year, $month, $groid);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_assoc($result);
                $this->connclose($stmt, $conn);
                return $row['num'];
                exit();
            }
        }

        private function set_weekReportId($lids, $detailsInsertId){
            $arr = explode("-", $lids);
            foreach($arr as $idlist){
                if($idlist != NULL && $idlist != ""){
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
                if($idlist != NULL && $idlist != ""){
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                        $this->connclose($stmt, $conn);
                    }
                    else{
                        mysqli_stmt_bind_param($stmt, "ii", $detailsInsertId, $idlist);
                        mysqli_stmt_execute($stmt);
                    }
                }
            }

            $this->connclose($stmt, $conn);
            return 1;
            exit();
        }

        private function set_teaId($lids, $detailsInsertId){
            $arr = explode("-", $lids);
            $sqlQ = "INSERT INTO teaid(month_report_id, request_id) VALUES(?,?);";
            $conn = $this->connect();
            foreach($arr as $idlist){
                if($idlist != NULL && $idlist != ""){
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                        $this->connclose($stmt, $conn);
                    }
                    else{
                        mysqli_stmt_bind_param($stmt, "ii", $detailsInsertId, $idlist);
                        mysqli_stmt_execute($stmt);
                    }
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
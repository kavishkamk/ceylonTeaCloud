<?php
    require_once "DbConnection.class.php";

    class SendRequset extends DbConnection{

        public function sendLoanRequset($groid, $hreason, $nMonth, $amount, $reason){
            $memId = $this->getMemberId($groid);
            if($memId != "nouser"){
                $requsetId = $this->setReqestTable();
                if($requsetId != "sqlerror"){
                    $u1res = $this->setMemberRequsetMap($memId, $requsetId);
                    if( $u1res == "OK"){
                        $loanTabId = $this->setLoanTable($amount, $nMonth, $hreason, $reason);
                        if( $teaTabId != "sqlerror"){
                            $u2res = $this->setLoanReqMap($requsetId,  $loanTabId);
                            if($u2res == "OK"){
                               return "1";
                            }
                            else{
                                return "3";
                            }
                        }
                        else{
                            return "3";
                        }
                    }
                    else{
                        return "3"; // sql error
                    }
                }
                else{
                    return "3"; // sql error
                }
            }
            else{
                return "2"; // id not found
                exit();
            }
        }

        public function sendTeaRequset($groid, $wantedId, $nMonth, $amount, $price, $typeId){
            $memId = $this->getMemberId($groid);
            if($memId != "nouser"){
                $requsetId = $this->setReqestTable();
                if($requsetId != "sqlerror"){
                    $u1res = $this->setMemberRequsetMap($memId, $requsetId);
                    if( $u1res == "OK"){
                        $teaTabId = $this->setTeaTable($wantedId, $nMonth);
                        if( $teaTabId != "sqlerror"){
                            $u2res = $this->setTeaReqMap($requsetId,  $teaTabId);
                            if($u2res == "OK"){
                                $u3res = $this->setTeaRequestTable($teaTabId, $typeId, $price, $amount, $nMonth);
                                if($u3res == "OK"){
                                    return "1";
                                }
                                else{
                                    return "3";
                                }
                            }
                            else{
                                return "3";
                            }
                        }
                        else{
                            return "3";
                        }
                    }
                    else{
                        return "3"; // sql error
                    }
                }
                else{
                    return "3"; // sql error
                }
            }
            else{
                return "2"; // id not found
                exit();
            }
        }

        public function sendFertilizerRequset($groid, $wantedId, $nMonth, $amount, $price, $typeId){
            $memId = $this->getMemberId($groid);
            if($memId != "nouser"){
                $requsetId = $this->setReqestTable();
                if($requsetId != "sqlerror"){
                    $u1res = $this->setMemberRequsetMap($memId, $requsetId);
                    if( $u1res == "OK"){
                        $fertilizerTabId = $this->setFertilizerTable($wantedId, $nMonth);
                        if( $fertilizerTabId != "sqlerror"){
                            $u2res = $this->setFetrtilizerReqMap($requsetId,  $fertilizerTabId);
                            if($u2res == "OK"){
                                $u3res = $this->setFertilizerRequestTable($fertilizerTabId, $typeId, $price, $amount, $nMonth);
                                if($u3res == "OK"){
                                    return "1";
                                }
                                else{
                                    return "3";
                                }
                            }
                            else{
                                return "3";
                            }
                        }
                        else{
                            return "3";
                        }
                    }
                    else{
                        return "3"; // sql error
                    }
                }
                else{
                    return "3"; // sql error
                }
            }
            else{
                return "2"; // id not found
                exit();
            }
        }

        private function setTeaRequestTable($requi, $fid, $price, $amount, $nMonth){
            $sqlQ = "INSERT INTO tea_request(request_id, tea_type_id, item_price, amount, monthly_ded) VALUES(?,?,?,?,?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                $val =  $price / $nMonth;
                mysqli_stmt_bind_param($stmt, "iidid", $requi, $fid, $price, $amount, $val);
                mysqli_stmt_execute($stmt);
                $this->connclose($stmt, $conn);
                return "OK";
                exit();
            }
        }

        private function setFertilizerRequestTable($requi, $fid, $price, $amount, $nMonth){
            $sqlQ = "INSERT INTO fertilizer_request(request_id, fertilizer_type_id, item_price, amount, monthly_deduction) VALUES(?,?,?,?,?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                $val =  $price / $nMonth;
                mysqli_stmt_bind_param($stmt, "iidid", $requi, $fid, $price, $amount, $val);
                mysqli_stmt_execute($stmt);
                $this->connclose($stmt, $conn);
                return "OK";
                exit();
            }
        }

        private function setLoanReqMap($reqid, $loanId){
            $sqlQ = "INSERT INTO req_loan_map(req_id, loan_id) VALUES(?,?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "ii", $reqid, $loanId);
                mysqli_stmt_execute($stmt);
                $this->connclose($stmt, $conn);
                return "OK";
                exit();
            }
        }


        private function setTeaReqMap($reqid, $teaId){
            $sqlQ = "INSERT INTO req_tea_map(req_id, tea_id) VALUES(?,?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "ii", $reqid, $teaId);
                mysqli_stmt_execute($stmt);
                $this->connclose($stmt, $conn);
                return "OK";
                exit();
            }
        }

        private function setFetrtilizerReqMap($reqid, $ferId){
            $sqlQ = "INSERT INTO req_fertilizer_map(req_id, fertilizer_id) VALUES(?,?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "ii", $reqid, $ferId);
                mysqli_stmt_execute($stmt);
                $this->connclose($stmt, $conn);
                return "OK";
                exit();
            }
        }

        private function setLoanTable ($amount, $nMonth, $hreason, $reason) {
            $sqlQ = "INSERT INTO loan(amount, number_of_months_to_pay, monthly_ded, loanHeader, discription, paid_monnth) VALUES (?,?,?,?,?,?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                $val0 = 0;
                $monded = $amount / $nMonth;
                mysqli_stmt_bind_param($stmt, "didssi",$amount, $nMonth, $monded, $hreason, $reason, $val0);
                mysqli_stmt_execute($stmt);
                $ferId = mysqli_stmt_insert_id($stmt);
                $this->connclose($stmt, $conn);
                return $ferId;
                exit();
            }

        }

        private function setTeaTable($wdata, $numOfMonth){
            $sqlQ = "INSERT INTO tea(date_wanted, number_of_months_to_pay, paid_monnth) VALUES (?,?,?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                $val0 = 0;
                mysqli_stmt_bind_param($stmt, "sii", $wdata, $numOfMonth, $val0);
                mysqli_stmt_execute($stmt);
                $ferId = mysqli_stmt_insert_id($stmt);
                $this->connclose($stmt, $conn);
                return $ferId;
                exit();
            }

        }

        private function setFertilizerTable($wdata, $numOfMonth){
            $sqlQ = "INSERT INTO fertilizer(date_wanted, number_of_months, paid_monnth) VALUES (?,?,?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                $val0 = 0;
                mysqli_stmt_bind_param($stmt, "sii", $wdata, $numOfMonth, $val0);
                mysqli_stmt_execute($stmt);
                $ferId = mysqli_stmt_insert_id($stmt);
                $this->connclose($stmt, $conn);
                return $ferId;
                exit();
            }

        }

        private function setMemberRequsetMap($memId, $reqId){
            $sqlQ = "INSERT INTO member_request_map(member_id, req_id) VALUES (?,?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "ii", $memId, $reqId);
                mysqli_stmt_execute($stmt);
                $this->connclose($stmt, $conn);
                return "OK";
                exit();
            }
        }

        private function setReqestTable(){
            $sqlQ = "INSERT INTO request(req_date, accept_date, status, issued_date) VALUES (?,?,?,?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                $val0 = 0;
                $createTime = date("Y-n-d H:i:s"); 
                mysqli_stmt_bind_param($stmt, "ssis", $createTime, $createTime, $val0, $createTime);
                mysqli_stmt_execute($stmt);
                $requsetId = mysqli_stmt_insert_id($stmt);
                $this->connclose($stmt, $conn);
                return $requsetId;
                exit();
            }
        }

        private function getMemberId($groid){
            $sqlQ = "SELECT member_id FROM member WHERE grower_id = ?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "i", $groid);
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
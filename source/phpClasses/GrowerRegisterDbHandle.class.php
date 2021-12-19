<?php
require_once "DbConnection.class.php";
   
   class GrowerRegisterDbHandle extends DbConnection {

        // to comfirm, given email is not in the database
        public function isItAvailableEmail($mail){
            $sqlQ = "SELECT id FROM grower WHERE email = ?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt, "s", $mail);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultcheck = mysqli_stmt_num_rows($stmt);
                if($resultcheck == 0){
                    $this->connclose($stmt, $conn);
                    return "0"; // not a available in this moment
                    exit();
                }
                else{
                    $this->connclose($stmt, $conn);
                    return "1"; // alrady have
                    exit();
                }
            }
        }

        public function growerRegisterUser($fname, $tele, $mail, $uPwd, $address){
            $sqlQ = "INSERT INTO grower(name, reg_date, email, tele, address, profileLink, active_status, pwd, new_member_status) VALUES(?,?,?,?,?,?,?,?,?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                $hashedPwd = password_hash($uPwd, PASSWORD_DEFAULT); // hashing password
                //rename user profile emage with username if user upload image
                $propic = "unknownPerson.png";
                $createTime = date("Y-n-d H:i:s"); // acout cration date and time
                $userotp = rand(100000 , 999999); // genatate OTP code
                $var1 = 1;
                mysqli_stmt_bind_param($stmt, "ssssssisi", $fname, $createTime, $mail, $tele, $address, $propic, $var1 , $hashedPwd, $var1);
                mysqli_stmt_execute($stmt);
                $detailsInsertId = mysqli_stmt_insert_id($stmt);
                $this->connclose($stmt, $conn);
                $this->updateMemberTable($detailsInsertId);
                return "Success";
                exit();

            }
        }

        private function updateMemberTable($groid){
            $sqlQ = "INSERT INTO member(factory_id, grower_id) VALUES(?,?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                $comId = 1;
                mysqli_stmt_bind_param($stmt, "ii", $comId, $groid);
                mysqli_stmt_execute($stmt);
                $this->connclose($stmt, $conn);
                return "Success";
                exit();
            }
        }

        private function connclose($stmt, $conn){
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }

   }
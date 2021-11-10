<?php
    require_once "DbConnection.class.php";

    // this class use for get owner details
    class AdminProfileEdit extends DbConnection{

        // change first name, last name, user name
        public function changeUserProfile($fname, $tele){
            $res = 0;
            if(!empty($fname)){
                if(strlen($fname) > 255){
                    return "5"; // characters shoud be <30
                    exit();
                }
                else{
                    $fRes = $this->changeFirstname($fname, $_SESSION['ownerid']);
                    if($fRes == "1"){
                        $_SESSION['name'] = $fname;
                        $res = "1"; //success
                    }
                    else{
                        $res = "0"; // error
                    }
                }
            }
            if(!empty($tele)){
                if(!preg_match("/^[0-9]*$/", $tele)){
                    return "8"; // invalid characters
                    exit();
                }
                else if(strlen($tele) > 50){
                    return "9"; // characters shoud be 50>
                    exit();
                }
                else{
                    $uRes = $this->changeTele($tele);
                    if($uRes == "1"){
                        $res = "3";
                    }
                    else{
                        $res = "0";
                    }
                }
            }

            return $res;
            exit();
        }

        // change admin first name
        private function changeFirstname($fname){
            $sqlQ = "UPDATE company_owner SET owner_name = ? WHERE owner_id = ?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "0"; // sql error
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "si", $fname, $_SESSION['ownerid']);
                mysqli_stmt_execute($stmt);
                $this->connclose($stmt, $conn);
                return "1"; // success
                exit();
            }
        }

        private function changeTele($tele){
            $sqlQ = "UPDATE company_owner SET tele = ? WHERE owner_id = ?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "0"; // sql error
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "si", $tele, $_SESSION['ownerid']);
                mysqli_stmt_execute($stmt);
                $this->connclose($stmt, $conn);
                return "1"; // success
                exit();
            }
        }

        // to comfirm, given email is not in the database
        public function isItAvailableEmail($mail){
            $sqlQ = "SELECT owner_id FROM company_owner WHERE email = ?;";
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

         // this function can use to change the mail.
        // but befor it you should enshure that email is not a availabale in the database
        public function changeUserMail($mail, $uid){
            $sqlQ = "UPDATE company_owner SET email = ? WHERE owner_id = ?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "0"; // sql error
                exit();
            }
            else{
                $val = 1; $val0 = 0;
                mysqli_stmt_bind_param($stmt, "si", $mail, $uid);
                mysqli_stmt_execute($stmt);
                $this->connclose($stmt, $conn);
                return "1";
                exit();
            }
        }

        // check user password
        public function CheckCurrentPwd($uid, $pwd){
            $sqlQ = "SELECT pwd FROM company_owner WHERE owner_id = ?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                return "sqlerror";
                $this->connclose($stmt, $conn);
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "i", $uid);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if($row = mysqli_fetch_assoc($result)){
                    $pwdCheck = password_verify($pwd, $row['pwd']); // check password
                    if($pwdCheck == false){
                        return "4";
                        $this->connclose($stmt, $conn);
                        exit(); // wrong password
                    }
                    else if($pwdCheck == true){
                        return "1";
                        $this->connclose($stmt, $conn);
                        exit(); // ok
                    }
                    else{
                        return "5";
                        $this->connclose($stmt, $conn);
                        exit(); // something was wrang
                    }
                }
                else{
                    $this->connclose($stmt, $conn);
                    return "usernotfund";
                    exit();
                }
            }
        }

        // change user password
        public function changePassword($uid, $pwd){
            $sqlQ = "UPDATE company_owner SET pwd = ? WHERE owner_id = ?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "0"; // sql error
                exit();
            }
            else{
                $hashpwd = password_hash($pwd, PASSWORD_DEFAULT); // hashing password
                mysqli_stmt_bind_param($stmt, "si", $hashpwd, $uid);
                mysqli_stmt_execute($stmt);
                return "1"; // sql error
                exit();
            }
        }

        // delete account
        public function deleteAdminAcc($uid){
            $sqlQ = "UPDATE company_owner SET actSTatus = ? WHERE owner_id = ?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);
    
            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                return "sqlerror";
                exit();
            }
            else{
                $val1 = 0;
                mysqli_stmt_bind_param($stmt, "ii", $val1, $uid);
                mysqli_stmt_execute($stmt);
                return "1"; // success
                exit();
            }
        }

        private function connclose($stmt, $conn){
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
    }
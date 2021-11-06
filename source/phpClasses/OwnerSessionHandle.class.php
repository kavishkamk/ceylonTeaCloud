<?php
    require_once "DbConnection.class.php";

    // this class used to handle admin session

    // set admin session in database
    class OwnerSessionHandle extends DbConnection {

        // set given admin session to the database
        public function setSession($ownerid, $sessionVal){

            $delres = $this->deleteSesseion($ownerid);

            if($delres == "1"){
                $sqlQ = "INSERT INTO owner_session(owner_id, session_id, session_expire) VALUES(?,?,?);";
                $conn = $this->connect();
                $stmt = mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                    $this->connclose($stmt, $conn);
                    return "sqlerror";
                    exit();
                }
                else{
                    $sessionExp = date("Y-n-d H:i:s", strtotime('+6 hours')); // session expire time
                    mysqli_stmt_bind_param($stmt, "iss", $ownerid, $sessionVal, $sessionExp);
                    mysqli_stmt_execute($stmt);
                    $this->connclose($stmt, $conn);
                    return "1";
                    exit();
                }
            }
            else{
                return "sqlerror";
                exit();
            }
        }

        // this is used to remove privious session of owner from DB
        public function deleteSesseion($ownerid){
            $sqlQ = "DELETE FROM owner_session WHERE owner_id = ?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);
        
            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "i", $ownerid);
                mysqli_stmt_execute($stmt);
                $this->connclose($stmt, $conn);
                return "1";
                exit();
            }
        }

        private function connclose($stmt, $conn){
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }

    }
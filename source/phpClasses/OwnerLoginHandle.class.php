<?php
    require_once "DbConnection.class.php";

    // this class use for check admin with passwords and create session for admin
    class OwnerLoginHandle extends DbConnection{

        private $inputpwd;
        private $inputuname;
        private $ownerId;
        private $name;
        private $pwd;
        private $email;
        private $tele;
        private $activeStatus;

        // check admin user name, password and create session if admin details are correct
        public function checkOwnerAccess($uname, $upwd){
            $this->inputpwd = $upwd;
            $this->inputuname = $uname;

            $getdetails = $this->getReleventDetais();

            if($getdetails == "ok"){
                // check blocked accounts
                if($this->activeStatus == 0){
                    return "2"; // account is deleted
                    exit();
                }
                else{
                    $pwdCheck = password_verify($this->inputpwd, $this->pwd); // check password
                    if($pwdCheck == false){
                        return "5"; // wrong password
                        exit();
                    }
                    else if($pwdCheck == true){
                        
                        session_unset();
                        session_destroy();
                        session_start();
                            require_once "OwnerSessionHandle.class.php";
                            $sesObj = new  OwnerSessionHandle();
                            $sessionVal = session_id(); // genarete session id
                            $sesResult = $sesObj->setSession($this->ownerId, $sessionVal);
                            unset($sesObj);

                            if($sesResult == "1"){
                                
                                $_SESSION['ownerid'] = $this->ownerId; // set user id of the user table
                                $_SESSION['sessionId'] = $sessionVal; // set with record id to set offline time
                                $_SESSION['name'] = $this->name;
                                $_SESSION['email'] = $this->email;
                                return "1"; // login success
                            }
                            else{
                                return "3"; // sql error
                            }
                    }
                    else{
                        return "5";
                        exit(); // something was wrang
                    }
                }
            }
            else if($getdetails == "usernotfund"){
                return "0"; // user not found
                exit();
            }
            else if($getdetails == "sqlerror"){
                return "3"; // sql error
                exit();
            }
        }

         // get admin details using admin username or password from DB
         private function getReleventDetais(){
            $sqlQ = "SELECT owner_id, owner_name, pwd, email, tele, actSTatus FROM company_owner WHERE email=?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "s", $this->inputuname);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if($row = mysqli_fetch_assoc($result)){
                    $this->ownerId = $row['owner_id'];
                    $this->name = $row['owner_name'];
                    $this->pwd = $row['pwd'];
                    $this->email = $row['email'];
                    $this->tele = $row['tele'];
                    $this->activeStatus = $row['actSTatus'];
                    $this->connclose($stmt, $conn);
                    return "ok";
                    exit();
                }
                else{
                    $this->connclose($stmt, $conn);
                    return "usernotfund";
                    exit();
                }
            }
        }

        private function connclose($stmt, $conn){
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }

    }
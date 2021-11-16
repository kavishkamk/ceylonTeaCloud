<?php
require_once "DbConnection.class.php";

class HandleGrowerSession extends DbConnection {

    //Create a new session for the Grower
    public function setSession($growerId, $sessionVal){

        $deleteSessionResponse = $this->deleteSession($growerId);

        if($deleteSessionResponse == SESSION_DELETION_SUCCESS){
            $sqlQ = "INSERT INTO grower_session(grower_id, session_id, session_expire) VALUES(?,?,?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->closeConnection($stmt, $conn);
                return CONNECTION_FAILED;
            }
            else{
                $sessionExp = date("Y-n-d H:i:s", strtotime('+6 hours')); // session expire time
                mysqli_stmt_bind_param($stmt, "iss", $growerId, $sessionVal, $sessionExp);
                mysqli_stmt_execute($stmt);
                $this->closeConnection($stmt, $conn);
                return SESSION_CREATION_SUCCESS;
            }
        }
        else{
            return "sqlerror";
        }
    }

    // this is used to remove previous session of owner from DB
    public function deleteSession($growerId){
        $sqlQ = "DELETE FROM grower_session WHERE grower_id = ?;";
        $conn = $this->connect();
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sqlQ)){
            $this->closeConnection($stmt, $conn);
            return CONNECTION_FAILED;
        }
        else{
            mysqli_stmt_bind_param($stmt, "i", $growerId);
            mysqli_stmt_execute($stmt);
            $this->closeConnection($stmt, $conn);
            return SESSION_DELETION_SUCCESS;
        }
    }

    // this function for check sessions
    public function checkSession($sessionval, $uid){
        $query = "SELECT session_id, session_expire FROM grower_session WHERE grower_id = ?;";
        $conn = $this->connect();
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $query)){
            $this->closeConnection($stmt, $conn);
            return "sqlerror";
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "i", $uid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                if($sessionval == $row['session_id']){
                    if($row['session_expire'] < date("Y-n-d H:i:s")){
                        $deleteSessionResponse = $this->deleteSession($uid);
                        $this->closeConnection($stmt, $conn);
                        return "sessionexp"; // session expired
                    }
                    else{
                        $this->closeConnection($stmt, $conn);
                        return "1"; // session ok
                    }
                }
                else{
                    $this->closeConnection($stmt, $conn);
                    return "noaccess"; // no session
                }
            }
            else{
                $this->closeConnection($stmt, $conn);
                return "usernotfund";
            }
        }
    }

    private function closeConnection($stmt, $conn){
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }

}
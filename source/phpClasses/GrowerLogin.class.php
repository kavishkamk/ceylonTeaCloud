<?php
require_once "DbConnection.class.php";
require_once "HandleGrowerSession.class.php";
include_once "../constants.php";

// this class use for get owner details
class GrowerLogin extends DbConnection
{
    private $growerId;
    private $name;
    private $email;
    private $password;
    private $activeStatus;

    //Validating the password
    public function validateLoginDetails($loginEmail, $loginPassword)
    {
        $fetchingGrowerDetailsResponse = $this->getUserDetailsForEmail();

        if ($fetchingGrowerDetailsResponse == NO_DATA_FOUND) {
            return NO_USER_FOUND;
        }
        if ($fetchingGrowerDetailsResponse == CONNECTION_FAILED) {
            return CONNECTION_ERROR;
        }

        if ($fetchingGrowerDetailsResponse == SUCCESS) {
            // check blocked accounts
            if ($this->activeStatus == 0) {
                return ACCOUNT_BLOCKED_OR_DELETED;
            } else {
                $passwordMatched = password_verify($loginPassword, $this->password); // check password
                if (!$passwordMatched) {
                    return WRONG_PASSWORD;
                } else {

                    session_unset();
                    session_destroy();
                    session_start();
                    $handleGrowerSession = new  HandleGrowerSession();
                    $sessionId = session_id(); // generate session id
                    $sessionCreationResponse = $handleGrowerSession->setSession($this->growerId, $sessionId);
                    unset($handleGrowerSession);

                    if ($sessionCreationResponse == SESSION_CREATION_SUCCESS) {
                        $_SESSION['growerId'] = $this->growerId; // set grower id of the grower table
                        $_SESSION['sessionId'] = $sessionId; // set with record id to set offline time
                        $_SESSION['name'] = $this->name;
                        $_SESSION['email'] = $this->email;
                        return LOGIN_SUCCESSFUL;
                    } else {
                        return CONNECTION_FAILED;
                    }
                }
            }
        }
    }

    // Getting user details for the given email
    private function getUserDetailsForEmail()
    {
        $query = "SELECT name, pwd, active_status FROM grower WHERE email=?;";
        $conn = $this->connect();

        //Checking connection
        if ($conn->connect_error) {
            return CONNECTION_FAILED;
        }

        //Executing the query
        $result = $conn->query($query);

        //TODO: Need to check whether we can use result even after closing the connection
        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {
                //Getting data into variables
                $this->password = $row['pwd'];
                $this->activeStatus = $row['active_status'];
                $this->name = $row['name'];
            }
            $conn->close();
            return SUCCESS;
        } else {
            $conn->close();
            return NO_DATA_FOUND;
        }
    }
}
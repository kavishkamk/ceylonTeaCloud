<?php
require_once "DbConnection.class.php";
require_once "HandleGrowerSession.class.php";
include_once "../constants.php";
include_once "../utils.php";

// this class use for get owner details
class GrowerLogin extends DbConnection
{
    private $growerId;
    private $name;
    private $email;
    private $password;
    private $activeStatus;
    private $telephoneNo;
    private $address;

    //Validating the password
    public function validateLoginDetails($loginEmail, $loginPassword)
    {
        $fetchingGrowerDetailsResponse = $this->getUserDetailsForEmail($loginEmail);

        if ($fetchingGrowerDetailsResponse == NO_DATA_FOUND) {
            return NO_USER_FOUND;
        }
        if ($fetchingGrowerDetailsResponse == CONNECTION_FAILED || $fetchingGrowerDetailsResponse == CONNECTION_ERROR) {
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
                        $_SESSION['email'] = $loginEmail;
                        $_SESSION['telephoneNo'] = $this->telephoneNo;
                        $_SESSION['address'] = $this->address;
                        return LOGIN_SUCCESSFUL;
                    } else {
                        return CONNECTION_FAILED;
                    }
                }
            }
        }
    }

    // Getting user details for the given email
    private function getUserDetailsForEmail($email)
    {
        // Prepare a select statement
        $sql = "SELECT id, name, tele, address, pwd, active_status FROM grower WHERE email= ?;";
        $conn = $this->connect();

        //Checking connection
        if ($conn->connect_error) {
            return CONNECTION_FAILED;
        }

        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $email);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);

                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $this->growerId = $row["id"];
                    $this->name = $row["name"];
                    $this->password = $row["pwd"];
                    $this->activeStatus = $row["active_status"];
                    $this->telephoneNo = $row["tele"];
                    $this->address = $row["address"];

                    return SUCCESS;
                } else if(mysqli_num_rows($result) > 1){
                    return MULTIPLE_RECORDS;
                }else{
                    return NO_DATA_FOUND;
                }

            } else{
                return CONNECTION_ERROR;
            }
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
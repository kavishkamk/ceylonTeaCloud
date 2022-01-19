<?php
require_once "DbConnection.class.php";
require_once "HandleGrowerSession.class.php";
require_once "../include/growerSessionCheck.php";
include_once "../constants.php";
include_once "../utils.php";

// this class use for get owner details
class GrowerProfile extends DbConnection
{

    //Update profile picture in the grower table
    public function uploadProfilePicture($fileName)
    {
        $sqlQ = "update grower set profilePic = ? where id = ?;";
        $conn = $this->connect();
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sqlQ)) {
            $this->closeConnection($stmt, $conn);
            return CONNECTION_FAILED;
        } else {
            mysqli_stmt_bind_param($stmt, "si", $fileName, $_SESSION['growerId']);
            mysqli_stmt_execute($stmt);
            $this->closeConnection($stmt, $conn);
            return UPLOADING_PROFILE_PIC_SUCCESS;
        }
    }

    //Get profile picture name from grower table
    public function getProfilePictureName()
    {
        // Prepare a select statement
        $sql = "SELECT profilePic FROM grower WHERE email= ?;";
        $conn = $this->connect();

        //Checking connection
        if ($conn->connect_error) {
            return CONNECTION_FAILED;
        }

        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $_SESSION['email']);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);

                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    $_SESSION['profilePic'] = $row["profilePic"];
                    return FETCHING_PROFILE_PIC_NAME_SUCCESS;
                } else {
                    return UNABLE_TO_FETCH_PROFILE_PIC_NAME;
                }
            } else{
                return CONNECTION_ERROR;
            }
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }

    private function closeConnection($stmt, $conn)
    {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
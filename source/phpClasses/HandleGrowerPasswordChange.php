<?php

require_once "../include/growerSessionCheck.php";

class HandleGrowerPasswordChange extends DbConnection
{

    public function updatePassword($growerEmail, $currentPassword, $newPassword)
    {


        $sql = "update grower set pwd = ? where email = ?;";
        $conn = $this->connect();
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            $this->closeConnection($stmt, $conn);
            return CONNECTION_FAILED;
        } else {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "ss", $hashedPassword, $growerEmail);
            if (mysqli_stmt_execute($stmt)) {
                $this->closeConnection($stmt, $conn);
                return PASSWORD_UPDATE_SUCCESS;
            } else {
                $this->closeConnection($stmt, $conn);
                return PASSWORD_UPDATE_FAILURE;
            }
        }
    }

    public function validateCurrentPassword($growerEmail, $currentPassword)
    {

        $sql = "select pwd from grower where email = ?;";
        $conn = $this->connect();
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            $this->closeConnection($stmt, $conn);
            return CONNECTION_FAILED;
        } else {
            mysqli_stmt_bind_param($stmt, "s", $growerEmail);
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                //Getting the current password from the table
                $hashedPasswordFromTable = "";
                while ($row = mysqli_fetch_assoc($result)) {
                    $hashedPasswordFromTable = $row['pwd'];
                }

                //Checking if the password was fetched successfully
                if(empty($hashedPasswordFromTable)){
                    return PASSWORD_FETCHING_FAILURE;
                }

                $passwordsMatch = password_verify($currentPassword, $hashedPasswordFromTable);
                $this->closeConnection($stmt, $conn);
                if($passwordsMatch){
                    return VALID_CURRENT_PASSWORD;
                } else {
                    return INVALID_CURRENT_PASSWORD;
                }

            } else {
                $this->closeConnection($stmt, $conn);
                return CONNECTION_ERROR;
            }
        }
    }

    private function closeConnection($stmt, $conn)
    {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
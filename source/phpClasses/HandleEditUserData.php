<?php

require_once "../include/growerSessionCheck.php";

class HandleEditUserData extends DbConnection
{

    public function updateUserData($growerEmail, $newName, $newPhoneNo, $newAddress)
    {
        $sql = "update grower set name = ?, tele = ?, address = ? where email = ?;";
        $conn = $this->connect();
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            $this->closeConnection($stmt, $conn);
            return CONNECTION_FAILED;
        } else {
            mysqli_stmt_bind_param($stmt, "ssss",
                $newName, $newPhoneNo, $newAddress, $growerEmail);
            if (mysqli_stmt_execute($stmt)) {
                $this->closeConnection($stmt, $conn);

                //Updating Session Variables with the passed data since it was successful
                $_SESSION['name'] = $newName;
                $_SESSION['telephoneNo'] = $newPhoneNo;
                $_SESSION['address'] = $newAddress;

                return USERDATA_UPDATE_SUCCESS;
            } else {
                $this->closeConnection($stmt, $conn);
                return USERDATA_UPDATE_FAILURE;
            }
        }
    }

    private function closeConnection($stmt, $conn)
    {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
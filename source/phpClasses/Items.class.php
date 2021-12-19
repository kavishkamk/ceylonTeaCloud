<?php
    require_once "DbConnection.class.php";

    // this class use for check owner with passwords and create session for admin
    class Items extends DbConnection{

        // this used to inset data to "tea_type" table
        public function addTeaType($type, $price){
            $sqlQ = "INSERT INTO tea_type(tea_type, price_of_1kg) VALUES(?,?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "sd", $type, $price);
                mysqli_stmt_execute($stmt);
                $this->connclose($stmt, $conn);
                return 1;
                exit();
            }

        }

        // this is used to get tea list with price from tea_type table
        public function getTeaTypeList(){
            $sqlQ = "SELECT tea_type, price_of_1kg FROM tea_type;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $this->connclose($stmt, $conn);
                return $result;
                exit();
            }
        }
        
        // update tea price
        public function updateTeaPrice($type, $price){
            $sqlQ = "UPDATE tea_type SET price_of_1kg = ? WHERE tea_type = ?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "ds", $price, $type);
                mysqli_stmt_execute($stmt);
                $this->connclose($stmt, $conn);
                return 1;
                exit();
            }
        }

        // this is used to add fertilizer to the table
        public function addFertilezerType($type, $price){
            $sqlQ = "INSERT INTO fertilizer_type(fertilizer_type, price_of_1kg) VALUES(?,?);";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "sd", $type, $price);
                mysqli_stmt_execute($stmt);
                $this->connclose($stmt, $conn);
                return 1;
                exit();
            }
        }

        // this for get fertilizer list
        public function getFertilizerList(){
            $sqlQ = "SELECT fertilizer_type, price_of_1kg FROM fertilizer_type;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $this->connclose($stmt, $conn);
                return $result;
                exit();
            }
        }

        // update Fertilizer price
        public function updateFertilizerPrice($type, $price){
            $sqlQ = "UPDATE fertilizer_type SET price_of_1kg = ? WHERE fertilizer_type = ?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "ds", $price, $type);
                mysqli_stmt_execute($stmt);
                $this->connclose($stmt, $conn);
                return 1;
                exit();
            }
        }

        public function getFertilizerPrice($type){
            $sqlQ = "SELECT type_id, price_of_1kg FROM fertilizer_type WHERE fertilizer_type=?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "s", $type);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if($row = mysqli_fetch_assoc($result)){
                    $arr[] = $row;
                    $this->connclose($stmt, $conn);
                    return  $arr;
                    exit();
                }
                else{
                    $this->connclose($stmt, $conn);
                    return "noreport";
                    exit();
                }
            }
        }

        public function getTeaPrice($type){
            $sqlQ = "SELECT type_id, price_of_1kg FROM tea_type WHERE tea_type=?;";
            $conn = $this->connect();
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlQ)){
                $this->connclose($stmt, $conn);
                return "sqlerror";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "s", $type);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if($row = mysqli_fetch_assoc($result)){
                    $arr[] = $row;
                    $this->connclose($stmt, $conn);
                    return  $arr;
                    exit();
                }
                else{
                    $this->connclose($stmt, $conn);
                    return "noreport";
                    exit();
                }
            }
        }

        private function connclose($stmt, $conn){
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
    }
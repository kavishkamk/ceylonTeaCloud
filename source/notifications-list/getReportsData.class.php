<?php
require_once "../phpClasses/DbConnection.class.php";

class getReportsData extends DbConnection{
    
    public function get_weekly_reports_notif($grower)
    {
        $q1 = "SELECT data_input.date
                FROM ((member_data_input_map
                    INNER JOIN member ON member_data_input_map.member_id = member.member_id)
                    INNER JOIN data_input ON data_input.data_id = member_data_input_map.data_id)
                    WHERE member.grower_id = ?
                    ORDER BY data_input.date DESC;";
        
        $conn = $this->connect();
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $q1)){
            $this->connclose($stmt, $conn);
            return "sqlerror";
            exit();
        }

        mysqli_stmt_bind_param($stmt, "i", $grower);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $data = array();
        $i =0;
        while($row = mysqli_fetch_assoc($result)){
            $data[$i] = array('date'=>$row['date']);
            $i++;
        }
        $this->connclose($stmt, $conn);
        return $data;
        exit();
    }

    public function get_monthly_reports_notif($grower)
    {
        $q1 = "SELECT date, repott_year, repott_month FROM monthly_report WHERE grower_id = ?;";
        
        $conn = $this->connect();
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $q1)){
            $this->connclose($stmt, $conn);
            return "sqlerror";
            exit();
        }

        mysqli_stmt_bind_param($stmt, "i", $grower);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $data = array();
        $i =0;
        while($row = mysqli_fetch_assoc($result)){
            $data[$i] = array('date'=>$row['date'],
                            'year'=> $row['repott_year'],
                            'month'=> $row['repott_month']
                        );
            $i++;
        }
        $this->connclose($stmt, $conn);
        return $data;
        exit();
    }

    public function get_accepted_reqs_notif($grower)
    {
        $q1 = "SELECT 'tea' AS Type, request.accept_date
                FROM ((request
                    INNER JOIN member_request_map ON member_request_map.req_id = request.req_id)
                    INNER JOIN req_tea_map ON req_tea_map.req_id = request.req_id)
                    WHERE member_request_map.member_id = ? AND request.status = ?  
                UNION 
                SELECT * FROM(
                    SELECT 'loan', request.accept_date
                    FROM ((request
                    INNER JOIN member_request_map ON member_request_map.req_id = request.req_id)
                    INNER JOIN req_loan_map ON req_loan_map.req_id = request.req_id)
                    WHERE member_request_map.member_id = ? AND request.status = ?
                    UNION 
                    SELECT 'fertilizer', request.accept_date
                    FROM ((request
                    INNER JOIN member_request_map ON member_request_map.req_id = request.req_id)
                    INNER JOIN req_fertilizer_map ON req_fertilizer_map.req_id = request.req_id)
                    WHERE member_request_map.member_id = ? AND request.status = ?
                )
                AS uniontable ORDER BY accept_date;";
        
        $conn = $this->connect();
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $q1)){
            $this->connclose($stmt, $conn);
            return "sqlerror";
            exit();
        }

        $status =1;
        mysqli_stmt_bind_param($stmt, "iiiiii", $grower, $status, $grower, $status, $grower, $status);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $data = array();
        $i =0;
        while($row = mysqli_fetch_assoc($result)){
            $data[$i] = array(  'type'=> $row['Type'],
                                'date'=> $row['accept_date']);
            $i++;
        }
        $this->connclose($stmt, $conn);
        return $data;
        exit();
    }

    private function connclose($stmt, $conn){
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
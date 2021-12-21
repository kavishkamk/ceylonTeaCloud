<?php

require_once "../phpClasses/DbConnection.class.php";

class MonthlyReportsData extends DbConnection{

    public function get_monthly_reports($grower)
    {
        $q1 = "SELECT report_id, date, repott_year, repott_month FROM monthly_report WHERE grower_id = ?;";
        
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
            $data[$i] = array('rec_id'=> $row['report_id'],
                            'date'=>$row['date'],
                            'year'=> $row['repott_year'],
                            'month'=> $row['repott_month']
                        );
            $i++;
        }
        $this->connclose($stmt, $conn);
        return $data;
        exit();
    }

    public function report_data($id)
    {
        $sqlQ = "SELECT * FROM monthly_report WHERE report_id = ?;";
        $conn = $this->connect();
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sqlQ)){
            $this->connclose($stmt, $conn);
            return "sqlerror";
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if($row = mysqli_fetch_assoc($result)){
                $this->connclose($stmt, $conn);
                return $row;
                exit();
            }
            else{
                $this->connclose($stmt, $conn);
                return "noreport";
                exit();
            }
        }
    }

    public function tea_request_data($id)
    {
        $sqlQ = "SELECT tea_request.monthly_ded, tea_type.tea_type, tea_request.item_price FROM
                ((((((monthly_report INNER JOIN teaid ON monthly_report.report_id = teaid.month_report_id)
                INNER JOIN request ON teaid.request_id = request.req_id)
                INNER JOIN req_tea_map ON request.req_id = req_tea_map.req_id)
                INNER JOIN tea ON req_tea_map.tea_id = tea.tea_id)
                INNER JOIN tea_request ON tea.tea_id = tea_request.request_id)
                INNER JOIN tea_type ON tea_request.tea_type_id = tea_type.type_id) WHERE monthly_report.report_id = ?;";

        $conn = $this->connect();
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sqlQ)){
            $this->connclose($stmt, $conn);
            return "sqlerror";
            exit();
        }
        else{
            $idArr = array();
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while($row = mysqli_fetch_assoc($result)){
                $idArr[] = $row;
            }
            $this->connclose($stmt, $conn);
            return $idArr;
            exit();
        }
    }

    public function loan_request_data($id)
    {
        $sqlQ = "SELECT loan.amount, loan.monthly_ded, loan.discription FROM
                ((((monthly_report INNER JOIN loneid ON monthly_report.report_id = loneid.month_report_id)
                INNER JOIN request ON loneid.request_id = request.req_id)
                INNER JOIN req_loan_map ON request.req_id = req_loan_map.req_id)
                INNER JOIN loan ON req_loan_map.loan_id = loan.loan_id)
                WHERE monthly_report.report_id = ?;";
        
        $conn = $this->connect();
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sqlQ)){
            $this->connclose($stmt, $conn);
            return "sqlerror";
            exit();
        }
        else{
            $idArr = array();
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while($row = mysqli_fetch_assoc($result)){
                $idArr[] = $row;
            }
            $this->connclose($stmt, $conn);
            return $idArr;
            exit();
        }
    }

    public function fertilizer_request_data($id)
    {
        $sqlQ = "SELECT fertilizer_request.monthly_deduction, 
                    fertilizer_type.fertilizer_type, 
                    fertilizer_request.item_price 
                FROM
                ((((((monthly_report INNER JOIN fertilizerid ON monthly_report.report_id = fertilizerid.month_report_id)
                INNER JOIN request ON fertilizerid.request_id = request.req_id)
                INNER JOIN req_fertilizer_map ON request.req_id = req_fertilizer_map.req_id)
                INNER JOIN fertilizer ON req_fertilizer_map.fertilizer_id = fertilizer.fertilizer_id)
                INNER JOIN fertilizer_request ON fertilizer.fertilizer_id = fertilizer_request.request_id)
                INNER JOIN fertilizer_type ON fertilizer_request.type_id = fertilizer_type.type_id) WHERE monthly_report.report_id = ?;";
        
        $conn = $this->connect();
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sqlQ)){
            $this->connclose($stmt, $conn);
            return "sqlerror";
            exit();
        }
        else{
            $idArr = array();
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while($row = mysqli_fetch_assoc($result)){
                $idArr[] = $row;
            }
            $this->connclose($stmt, $conn);
            return $idArr;
            exit();
        }
    }

    public function deduction_data($id)
    {
        $sqlQ = "SELECT data_input.data_id, 
                    DATE(data_input.date) AS dayrec, 
                    data_input.total_weight,
                    deduction.sack_waight, 
                    deduction.non_standard_leaves, 
                    deduction.water_weigth, 
                    deduction_others.reason,
                    deduction_others.weightOfDeduction 
                FROM
                ((((((monthly_report INNER JOIN weekreportid ON monthly_report.report_id = weekreportid.month_report_id)
                INNER JOIN data_input ON weekreportid.week_report_id = data_input.data_id)
                INNER JOIN data_input_dedication_map ON data_input.data_id = data_input_dedication_map.data_id)
                INNER JOIN deduction ON data_input_dedication_map.deduction_id = deduction.ded_id)
                INNER JOIN deduction_other_map ON deduction.ded_id = deduction_other_map.ded_id)
                INNER JOIN deduction_others ON deduction_other_map.ded_other_id = deduction_others.ded_other_id)
                WHERE monthly_report.report_id = ?;";
        
        $conn = $this->connect();
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sqlQ)){
            $this->connclose($stmt, $conn);
            return "sqlerror";
            exit();
        }
        else{
            $idArr = array();
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while($row = mysqli_fetch_assoc($result)){
                $idArr[] = $row;
            }
            $this->connclose($stmt, $conn);
            return $idArr;
            exit();
        }
    }

    public function net_weight_data($id)
    {
        $sqlQ = "SELECT data_input.data_id, net_weight.weight FROM
                (((monthly_report INNER JOIN weekreportid ON monthly_report.report_id = weekreportid.month_report_id)
                INNER JOIN data_input ON weekreportid.week_report_id = data_input.data_id)
                INNER JOIN net_weight ON data_input.data_id = net_weight.data_id) WHERE monthly_report.report_id = ?;";
        
        $conn = $this->connect();
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sqlQ)){
            $this->connclose($stmt, $conn);
            return "sqlerror";
            exit();
        }
        else{
            $idArr = array();
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while($row = mysqli_fetch_assoc($result)){
                $idArr[$row['data_id']] = $row;
            }
            $this->connclose($stmt, $conn);
            return $idArr;
            exit();
        }
    }

    private function connclose($stmt, $conn)
    {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
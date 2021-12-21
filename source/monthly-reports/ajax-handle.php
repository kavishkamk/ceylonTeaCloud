<?php

require_once "MonthlyReportsData.class.php";

if(isset($_POST['get_monthly_reports']))
{
    $grower = $_POST['growerid'];

    $obj = new MonthlyReportsData();
    $result = $obj-> get_monthly_reports($grower);
    unset($obj);
    echo json_encode($result);
}
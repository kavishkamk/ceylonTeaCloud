<?php

require_once "WeeklyReportsData.class.php";

if(isset($_POST['get_weekly_reports']))
{
    $grower = $_POST['growerid'];

    $obj = new WeeklyReportsData();
    $result = $obj-> get_weekly_reports($grower);
    unset($obj);
    echo json_encode($result);
}
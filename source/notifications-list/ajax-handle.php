<?php

require_once "getReportsData.class.php";

if(isset($_POST['get_weekly_reports']))
{
    $grower = $_POST['growerid'];

    $obj = new getReportsData();
    $result = $obj-> get_weekly_reports_notif($grower);
    unset($obj);
    echo json_encode($result);
}

if(isset($_POST['get_monthly_reports']))
{
    $grower = $_POST['growerid'];

    $obj = new getReportsData();
    $result = $obj-> get_monthly_reports_notif($grower);
    unset($obj);
    echo json_encode($result);
}

if(isset($_POST['get_accepted_reqs']))
{
    $grower = $_POST['growerid'];

    $obj = new getReportsData();
    $result = $obj-> get_accepted_reqs_notif($grower);
    unset($obj);
    echo json_encode($result);
}
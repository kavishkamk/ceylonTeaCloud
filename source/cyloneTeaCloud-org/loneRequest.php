<?php

    session_start();

    if(!isset($_SESSION['ownerid'])){
        header("Location:../cyloneTeaCloud-org/ownerLogin.php?ownerlogstat=logoutok"); // no session
        exit();
    }
    else{
        require_once "../phpClasses/OwnerSessionHandle.class.php";
        $sessObj = new OwnerSessionHandle();
        $sessRes = $sessObj->checkSession($_SESSION['sessionId'], $_SESSION['ownerid']); // invalid session
        unset($sessObj);
        if($sessRes != "1"){
            header("Location:../cyloneTeaCloud-org/ownerLogin.php?ownerlogstat=logoutok"); // no session
            exit();
        }
    }

    if(!isset($_GET['reqid']) || !isset($_GET['growid'])){
        header("Location:pendingRequset.php"); // no session
        exit();
    }

    $growerId = $_GET['growid'];
    $requsetId = $_GET['reqid'];

    require_once "../phpClasses/CompanyDeatils.class.php";
    $comObj = new CompanyDetails();
    $comRes = $comObj->getCompanyDetails();
    unset($comObj);

    require_once "../phpClasses/GrowerDetails.class.php";
    $groObj = new GrowerDetails();
    $groRes = $groObj->getGrowerDetailsUsingId($growerId);
    unset($groObj);

    require_once "../phpClasses/PendingRequset.class.php";
    $reqObj = new PendingRequest();
    $reqRes = $reqObj->getLoneDetails($requsetId);
    unset($reqObj);

    $total_price = 0;
    $total_deduction = 0;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title> 
        <link rel="stylesheet" type="text/css" href="../css/doucmunets.css">
        <link rel="stylesheet" type="text/css" href="../css/print.css" media="print">
    </head>
    <body>
        <header class="doc-header">
            <div style="grid-column:2 / 3;">
                <img src="../images/ceylon tea cloud-small.png" class="logo"></img>
            </div>
            <div class="company-details" style="grid-column:3 / 4;">
                <?php
                    echo '<span style="font-size:20px;">'.$comRes["name"].'</span><br>';
                    $str_arr = explode (",", $comRes['address']);
                    foreach($str_arr as $addres){
                        echo '<span style="font-size:15px">'.$addres.',</span><br>';
                    }
                    echo '<span style="font-size:15px">Email : '.$comRes["email"].'</span><br>';
                    echo '<span style="font-size:15px">Phone : 0'.$comRes["contactNo"].'</span><br><br>';
                    echo '<span style="font-size:15px">Lone Request</span><br>';
                    echo '<span style="font-size:15px">Requset Date: '.$reqRes['req_date'].'</span><br>';
                    echo '<span style="font-size:15px">Request ID: '.$requsetId.'</span><br>';
                ?>
            </div>
        </header>
        <hr style="width:90%;">
        <main class="doc-main">
            <div class="client-details" style="grid-column:2 / 3;">
                <div style="grid-column:1 / 2;">
                    <?php
                        echo '<span>From : '.$groRes["name"].'</span><br>';
                        echo '<span>Address : '.$groRes["address"].'</span><br>';
                        echo '<span>Email : '.$groRes["email"].'</span><br>';
                    ?>
                </div>
                <div style="grid-column:2 / 3;">
                    <?php
                        echo '<span>ID No : '.sprintf('%04d', $growerId).'</span><br>';
                        echo '<span>Phone : 0'.$groRes["tele"].'</span><br>';
                    ?>
                </div>
            </div>
            <div style="grid-column:2 / 3;" class="rec-table">
                <?php
                    echo '<p class="loan-head">'.$reqRes['loanHeader'].'</p>';
                    echo '<p class="lone-dis">'.$reqRes['discription'].'</p>';
                ?>
            </div>
            <div style="grid-column:2 / 3;" class="rec-table">
                <table>
                    <thead>
                        <caption>Requested Details</caption>
                    </thead>
                    <tbody>
                        <?php
                            echo '<tr>
                                <td> 1 </td>
                                <td>Amount</td>
                                <td>'.number_format($reqRes['amount'],2).'</td>
                            </tr>
                            <tr>
                                <td> 2 </td>
                                <td>Number of Month to Pay</td>
                                <td>'.$reqRes['number_of_months_to_pay'].'</td>
                            </tr>
                            <tr>
                                <td> 3 </td>
                                <td>Monthly Deduction</td>
                                <td>'.number_format($reqRes['monthly_ded'],2).'</td>
                            </tr>';
                        ?>
                    </tbody>
                </table>
            </div>
            <div style="grid-column:2 / 3;" class="rec-det">
                <br><br>
                <?php echo '<div style="grid-column:1 / 2;"><span class="re-time">Genarated Date : '.date("Y-n-d H:i:s").'</span></div>';
                    if(isset($_GET['result'])){
                        echo '<div><span id="comfirm-success">Comfirm Success</span></div>';
                    }
                ?>
            </div>
            <div style="grid-column:2 / 3;" class="button-field">
                <div>
                    <form>
                        <?php
                            if(!isset($_GET['conftyp'])){
                                echo '<button class="btn" formaction="pendingRequset.php">Back</button>';
                            }
                            else{
                                echo '<button class="btn" formaction="confirmRequset.php">Back</button>';
                            }
                        ?>
                    </form>
                </div>
                <div>
                    <form action="../include/requestComfirm.inc.php" method="post">
                        <?php echo '<input type="hidden" name="req-id" value="'.$requsetId.'">'; 
                                echo '<input type="hidden" name="gro-id" value="'.$growerId.'">';
                                echo '<input type="hidden" name="report-type" value="lone">';
                                if(!isset($_GET['conftyp'])){
                                    echo '<button type = "submit" name="request-comfirm" class="btn">Comfirm</button>';
                                }
                        ?>
                    </form>
                </div>
                <div>
                    <button onclick="window.print();" class="btn">Save or Print</button>
                </div>
            </div>
        </main>
    </body>
</html>
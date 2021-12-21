<?php
    session_start();

    if(!isset($_SESSION['growerId'])) // no session exists
    {
        header("Location:../grower-ui/index.php?growerLoginStatus=unauthorized");
        exit();
    }else
    {
        require_once "../phpClasses/HandleGrowerSession.class.php";
        $obj = new HandleGrowerSession();
        $res = $obj-> checkSession($_SESSION['sessionId'], $_SESSION['growerId']);
        unset($obj);

        if($res != SESSION_AVAILABLE){
            header("Location:../grower-ui/index.php?growerLoginStatus=logout");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link
                rel="stylesheet"
                href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
        />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../css/notifications.css"/>
        <title>Notifications</title>
    </head>

    <body>
        <div class="main-container">
            <div class="container">

                <center>
                    <a href="../grower-ui/about.php">
                        <div id= "logo">
                            <img src="../images/ceylon tea cloud-small.png">
                        </div>
                    </a>   
                </center>

                <h1 class="home-title">Notifications</h1>

                <div class="grower-home-options-container" id= "notif-list" style="max-height: 500px; overflow-y: scroll;">
                    <!--
                    <div class="notif-item">
                        <div class="date">2021-01-15</div>
                        <div class="msg">December Monthly report added</div>
                    </div>-->

                </div>

                <div class= "btn-out">
                    <a href= "main-menu.php" style="text-decoration: none;">
                        <div class="report-item" id= "back-btn">Back</div>
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>

<script type="text/javascript">

var data1 = new Array();
var data2 = new Array();

$(document).ready(function()
{
    weekly_list();  
});

function weekly_list()
{
    var growerid = <?php echo ''.$_SESSION["growerId"].'';?>;

    $.ajax({
        method: "POST",
        url: "../notifications-list/ajax-handle.php",
        data: {
            get_weekly_reports: "set",
            growerid: growerid
        },
        success: function(result){
            var obj = JSON.parse(result);

            var i=0;
            var list = new Array();

            while(obj[i]){
                var notif = obj[i];
                grp = JSON.stringify(notif);

                var date = notif.date;

                var dateformat = new Date(date);

                var month = dateformat.toLocaleString('default', { month: 'long' });
                var day = dateformat.getDate();
                if (day < 10) {
                    day = "0" + day;
                }

                var sentence = month+ " "+ day+ " weekly report added";

                var data = {date: date, 
                            sen: sentence};
                
                list.push(data);
                i++;
            }
            
            monthly_list(list);
        }
    });
}

function monthly_list(list1)
{
    var growerid = <?php echo ''.$_SESSION["growerId"].'';?>;

    $.ajax({
        method: "POST",
        url: "../notifications-list/ajax-handle.php",
        data: {
            get_monthly_reports: "set",
            growerid: growerid
        },
        success: function(result){
            var obj = JSON.parse(result);

            var i=0;
            var list = new Array();

            while(obj[i]){
                var notif = obj[i];
                grp = JSON.stringify(notif);

                var date = notif.date;

                var dateformat = new Date(date);

                var month = getMonthName(notif.month);
                var yr = dateformat.getFullYear();

                var sentence = notif.year +" "+ month + " monthly report added";

                var data = {date: date, 
                            sen: sentence};

                list.push(data);
                i++;
            }
            accepted_reqs(list1,list);
        }
    });
}

function accepted_reqs(list1, list2)
{
    //get_datas(list1, list2, list);
    var growerid = <?php echo ''.$_SESSION["growerId"].'';?>;

    $.ajax({
        method: "POST",
        url: "../notifications-list/ajax-handle.php",
        data: {
            get_accepted_reqs: "set",
            growerid: growerid
        },
        success: function(result){
            var obj = JSON.parse(result);

            var i=0;
            var list = new Array();

            while(obj[i]){
                var notif = obj[i];
                grp = JSON.stringify(notif);

                var date = notif.date;
                var type = notif.type;

                var sentence = type+ " request is accepted";

                var data = {date: date, 
                            sen: sentence};

                list.push(data);
                i++;
            }
            get_datas(list1, list2, list);
        }
    });

}

function get_datas(a1, a2, a3)
{
    data1 = JSON.parse(JSON.stringify(a1));
    data2 = JSON.parse(JSON.stringify(a2));
    data3 = JSON.parse(JSON.stringify(a3));

    const arr = [].concat(data1,data2, data3);

    const { compare } = Intl.Collator('en-US');
    arr.sort((a, b) => compare(a.date, b.date));
    console.log(arr);

    var j= arr.length-1;
    while(j < arr.length){
        var date = arr[j].date;
        var sen = arr[j].sen;

        var item = `<div class="notif-item">
                    <div class="date">`+date+`</div>
                    <div class="msg">`+sen+`</div>
                </div>`;
        $('#notif-list').append(item);
        j--;
    }
}

function getMonthName(month)
{
  const d = new Date();
  d.setMonth(month-1);
  const monthName = d.toLocaleString("default", {month: "long"});
  return monthName;
}

</script>
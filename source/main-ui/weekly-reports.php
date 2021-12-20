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
        <link rel="stylesheet" href="../css/weekly-reports-list.css"/>
        <title>Weekly Reports</title>
    </head>

    <body>
        <div class="main-container">
            <div class="container">
                <h1 class="home-title">Weekly Reports</h1>

                <div class="grower-home-options-container" id= "reports-list" style="max-height: 450px; overflow-y: scroll;">
                    <!--
                    <div class="report-item">
                        <div class="date">2021 January 15</div>
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

$(document).ready(function()
{
    weekly_list();  
});

function weekly_list()
{
    var growerid = <?php echo ''.$_SESSION["growerId"].'';?>;

    $.ajax({
        method: "POST",
        url: "../weekly-reports/ajax-handle.php",
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
                var year = dateformat.getFullYear();

                if (day < 10) {
                    day = "0" + day;
                }

                var sentence = year+ " " + month + " " + day;

                var data = {id: notif.rec_id,
                            date: date, 
                            sen: sentence};
                
                list.push(data);
                
                var id = notif.rec_id;
                var item = `<div class="report-item" id= "`+id+`">
                                <a href= "weekly-report-display.php?id=`+id+`" style="text-decoration: none">
                                    <div class="date">`+sentence+`</div>
                                </a>
                            </div>`;
                
                $('#reports-list').append(item);

                i++;
            }
            
            console.log(list);
        }
    });
}

</script>
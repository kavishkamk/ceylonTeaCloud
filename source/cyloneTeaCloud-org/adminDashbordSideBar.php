<!-- this is dash bord side bar -->
<div id="sidebar">
    <!-- set factory logo -->
    <div id= "logo">
        <img src="../images/ceylon tea cloud-small.png"></img>
    </div>
    <!-- set company name -->
    <div>
        <div class="dash-nav" id= "company">
            <?php
                require_once "../phpClasses/CompanyDeatils.class.php";
                $comObj = new CompanyDetails();
                $comRes = $comObj->getCompanyDetails();
                unset($comObj);
                echo '<span>'.$comRes['name'].'</span>';
            ?>
        </div>

        <!-- navigation list -->
        <div class="dash-nav">
            <a href="adminDashBord.php">
                <span>Dashboard</span>
            </a>
        </div>
        
        <div class="dash-nav">
            <a href="growerlist.php">
                <span>Grower List</span>
            </a>
        </div>
        
        <div class="dash-nav">
            <a href="items.php">
                <span>Add/Update Items</span>
            </a>
        </div>
        
        <div class="dash-nav">
            <a href="pendingRequset.php">
                <span>Pending Requests</span>
            </a>
        </div>
       
        <div class="dash-nav">
            <a href="confirmRequset.php">
                <span>Confirmed Requests</span>
            </a>
        </div>
       
        <div class="dash-nav">
            <a href="weeklyReport.php">
                <span>Weekly Reports</span>
            </a>
        </div>
       
        <div class="dash-nav">
            <a href="monthlyReport.php">
                <span>Monthly Reports</span>
            </a>
        </div>
        
        <div class="dash-nav">
            <a href="adminProfileSetting.php">
                <span>Profile Settings</span>
            </a>
        </div>
       
        <div class="dash-nav">
            <a href="../grower-ui/about.php">
                <span>About</span>
            </a>
        </div>
        
    </div>
    <br>
    <br>
</div>

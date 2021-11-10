<div id="sidebar">
    <div>
        <img src="../images/ceylon tea cloud-small.png"></img>
    </div>
    <div>
        <div class="dash-nav">
            <?php
                require_once "../phpClasses/CompanyDeatils.class.php";
                $comObj = new CompanyDetails();
                $comRes = $comObj->getCompanyDetails();
                unset($comObj);
                echo '<span>'.$comRes['name'].'</span>';
            ?>
        </div>
        <br>
        <div class="dash-nav">
            <a href="adminDashBord.php">
                <span>Dashboard</span>
            </a>
        </div>
        <br>
        <div class="dash-nav">
            <a href="growerlist.php">
                <span>Grower List</span>
            </a>
        </div>
        <br>
        <div class="dash-nav">
            <a href="items.php">
                <span>Items</span>
            </a>
        </div>
        <br>
        <div class="dash-nav">
            <a href="pendingRequset.php">
                <span>Pending Request</span>
            </a>
        </div>
        <br>
        <div class="dash-nav">
            <a href="">
                <span>Comfirmed Request</span>
            </a>
        </div>
        <br>
        <div class="dash-nav">
            <a href="">
                <span>Weekly Report</span>
            </a>
        </div>
        <br>
        <div class="dash-nav">
            <a href="">
                <span>Monthely Report</span>
            </a>
        </div>
        <br>
        <div class="dash-nav">
            <a href="">
                <span>Profile Setting</span>
            </a>
        </div>
        <br>
        <div class="dash-nav">
            <a href="">
                <span>About</span>
            </a>
        </div>
        <br>
    </div>
    <br>
    <br>
</div>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="route.php?route=dashboard">
        <div class="sidebar-brand-icon">
            <img src="img/bg.png" alt="Logo" style="max-width: 60%; height: auto;">
        </div>
        <div class="sidebar-brand-text mx-3">RISHATECH</div>
    </a>



    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="route.php?route=dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    

    <!-- Nav Item - Tables -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="route.php?route=appliances">
            <i class="fas fa-fw fa-tools"></i>
            <span>Appliances</span></a>
    </li> -->

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-archive"></i>
            <span>Category</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu:</h6>
                <a class="collapse-item" href="route.php?route=appliances">ITEMS & CATEGORIES</a>
                <?php
                $selectAllCategory = $db->selectAllCategory();

                foreach ($selectAllCategory as $key) {
                ?>
                <a class="collapse-item" href="route.php?route=all_items&category_id=<?=$key['id']?>&cat_name=<?=$key['cat_name']?>"><?=$key['cat_name']?></a>
                <?php
                }
                ?>

                <!-- <a class="collapse-item" href="route.php?route=all_courses">Courses</a>
                <a class="collapse-item" href="route.php?route=all_year_section">Year & Section</a> -->
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="route.php?route=customers">
            <i class="fas fa-fw fa-users"></i>
            <span>Customers</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="route.php?route=allsales">
            <i class="fas fa-fw fa-dollar-sign"></i>
            <span>Sales</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="route.php?route=cash">
            <i class="fas fa-fw fa-dollar-sign"></i>
            <span>Cash</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="route.php?route=credit">
            <i class="fas fa-fw fa-dollar-sign"></i>
            <span>Credit</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="route.php?route=discount_promotions">
            <i class="fas fa-fw fa-tag"></i>
            <span>Discounts & Promotions</span></a>
    </li>
	 <li class="nav-item">
    <a class="nav-link" href="financial_reports.php?route=financial_reports">
        <i class="fas fa-chart-line"></i>
        <span>Reports</span>
    </a>
</li>
<br>
 <li class="nav-item">
      <a class="nav-link" href="terms.php?route=terms">
        <i class="fas fa-cog"></i>
        <span>Terms and Conditions</span>
      </a>
    </li>
    

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>



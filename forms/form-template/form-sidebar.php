<!-- sidebar menu start -->
<div class="sidebar-menu sticky-sidebar-menu">

  <!-- logo start -->
  <div class="logo">
    <h1><a href="index.html">Collective</a></h1>
  </div>

  <!-- if logo is image enable this -->
  <!-- image logo -->
  <div class="logo">
    <a href="index.html">
      <img src="image-path" alt="Your logo" title="Your logo" class="img-fluid" style="height:35px;" />
    </a>
  </div>
  <!-- //image logo -->

  <div class="logo-icon text-center">
    <a href="index.html" title="logo"><img src="../../assets/images/logo.png" alt="logo-icon"> </a>
  </div>
  <!-- //logo end -->

  <div class="sidebar-menu-inner">

    <!-- sidebar nav start -->
    <ul class="nav nav-pills nav-stacked custom-nav">
      <?php
      if ($_SESSION['login_role'] == 3) {
        ?>
        <li class="active"><a href="../../customer-dashboard/dashboard.php"><i class="fa fa-tachometer"></i><span>
              Dashboard</span></a>
        </li>
        <?php
      } else {
        ?>
        <li class="active"><a href="../../dashboard/dashboard.php"><i class="fa fa-tachometer"></i><span>
              Dashboard</span></a>
        </li>
        <?php
      }
      ?>
      <?php
      if ($_SESSION['login_role'] == 1) {
        ?>
        <li class="menu-list">
          <a href="#"><i class="fa fa-users"></i>
            <span>User Management <i class="lnr lnr-chevron-right"></i></span></a>
          <ul class="sub-menu-list">
            <li><a href="../../dashboard/employee_mgt.php">Employee</a> </li>
            <li><a href="../../dashboard/customer_mgt.php">Customer</a> </li>
          </ul>
        </li>
        <li><a href="../../dashboard/attendance_monitoring.php"><i class="fa fa-table"></i> <span>Attendance Monitoring</span></a></li>
        <?php
      }
      ?>
    </ul>
    <!-- //sidebar nav end -->
  </div>
</div>
<!-- //sidebar menu end -->
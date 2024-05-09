<!-- sidebar menu start -->
<div class="sidebar-menu sticky-sidebar-menu">

  <!-- logo start -->
  <div class="logo">
    <h1><a href="index.html">Final Project</a></h1>
  </div>

  <!-- if logo is image enable this -->
  <!-- image logo -->
  <div class="logo">
    <a href="index.html">
      <img src="../assets/images/egg.jpg" alt="Your logo" title="Your logo" class="img-fluid" style="height:50px;" />
    </a>
  </div>
  <!-- //image logo -->

  <div class="logo-icon text-center">
    <a href="index.html" title="logo"><img src="../assets/images/logo.png" alt="logo-icon"> </a>
  </div>
  <!-- //logo end -->

  <div class="sidebar-menu-inner">

    <!-- sidebar nav start -->
    <ul class="nav nav-pills nav-stacked custom-nav">
      <li class="active"><a href="dashboard.php "><i class="fa fa-tachometer"></i><span> Dashboard</span></a>
      </li>
      <?php
      if ($_SESSION['login_role'] == 1) {
        ?>
        <li class="menu-list">
          <a href="#"><i class="fa fa-users"></i>
            <span>User Management <i class="lnr lnr-chevron-right"></i></span></a>
          <ul class="sub-menu-list">
            <li><a href="employee_mgt.php">Employee</a> </li>
            <li><a href="customer_mgt.php">Customer</a> </li>
          </ul>
        </li>
        <li><a href="attendance_monitoring.php"><i class="fa fa-table"></i> <span>Attendance Monitoring</span></a></li>
        <?php
      }
      ?>
      <li class="menu-list">
        <a href="#"><i class="fa-solid fa-boxes-stacked"></i>
          <span>Inventory Management <i class="lnr lnr-chevron-right"></i></span></a>
        <ul class="sub-menu-list">
          <li><a href="product.php">Product List</a> </li>
          <li><a href="category.php">Category List</a> </li>
          <li><a href="supplier.php">Supplier List</a> </li>
        </ul>
      </li>
      <li><a href="forms.html"><i class="fa fa-file-text"></i> <span>Forms</span></a></li>
    </ul>
    <!-- //sidebar nav end -->
    <!-- toggle button start -->
    <a class="toggle-btn">
      <i class="fa fa-angle-double-left menu-collapsed__left"><span>Collapse Sidebar</span></i>
      <i class="fa fa-angle-double-right menu-collapsed__right"></i>
    </a>
    <!-- //toggle button end -->
  </div>
</div>
<!-- //sidebar menu end -->
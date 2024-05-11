<!-- header-starts -->
<div class="header sticky-header">

  <!-- notification menu start -->
  <div class="menu-right">
    <div class="navbar user-panel-top">
      <div class="user-dropdown-details d-flex">
        <div class="profile_details_left">
          <ul class="nofitications-dropdown">
            <?php
            $ticket_sql = "SELECT COUNT(*) as ticket FROM `tbl_ticket` WHERE is_resolved = 0";
            $ticket_res = $conn->query($ticket_sql);
            $ticket_row = $ticket_res->fetch_assoc();
            ?>
            <li class="dropdown">
              <a href="ticket.php" class="dropdown-toggle" aria-expanded="false"><i
                  class="fa fa-circle-info fa-xl"></i><span class="badge blue"><?=($ticket_row['ticket'] != 0) ? $ticket_row['ticket'] : ""?></span></a>
            </li>
          </ul>
        </div>
        <div class="profile_details">
          <ul>
            <li class="dropdown profile_details_drop">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="dropdownMenu3" aria-haspopup="true"
                aria-expanded="false">
                <div class="profile_img">
                  <img src="../assets/images/profileimg.jpg" class="rounded-circle" alt="" />
                  <div class="user-active">
                    <span></span>
                  </div>
                </div>
              </a>
              <ul class="dropdown-menu drp-mnu" aria-labelledby="dropdownMenu3">
                <li class="user-info">
                  <?php
                  $user_id = $_SESSION['login_id'];

                  $user_sql = "SELECT * FROM `tbl_employee_account` 
                  INNER JOIN tbl_employee_info ON tbl_employee_account.employee_id = tbl_employee_info.employee_id
                  INNER JOIN tbl_login_role ON tbl_employee_account.login_role_id = tbl_login_role.login_role_id 
                  WHERE `tbl_employee_account`.`employee_id` = $user_id";
                  $user_res = $conn->query($user_sql);

                  if ($user_res->num_rows > 0) {
                    $user_row = $user_res->fetch_assoc();
                  }
                  ?>
                  <h5 class="user-name text-capitalize"><?= $user_row['lastname'] . ',' . $user_row['firstname'] ?></h5>
                  <span class="status ml-2 text-capitalize"><?= $user_row['login_role'] ?></span>
                </li>
                <?php
                if ($_SESSION['login_role'] != 1) {
                  ?>
                  <li> <a href="../forms/edit-forms/employee.php"><i class="lnr lnr-user"></i>My Profile</a> </li>
                  <?php
                }
                ?>
                <li class="logout"> <a href="../index.php"><i class="fa fa-power-off"></i> Logout</a> </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!--notification menu end -->
</div>
<!-- //header-ends -->
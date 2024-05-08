<!-- main content start -->
<div class="main-content">

    <!-- content -->
    <div class="container-fluid content-top-gap">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $_SESSION['title'] ?></li>
            </ol>
        </nav>
        <div class="welcome-msg pt-3 pb-4">
            <h1>Hi <span class="text-primary text-capitalize"><?= $user_row['firstname'] ?></span>, Welcome back</h1>
        </div>

        <!-- action msg here -->
        <?php
        if (isset($_SESSION['confirm_msg'])) {
            ?>
            <div class="alert alert-success  alert-dismissible">
                <strong>
                    <?= $_SESSION['confirm_msg'] ?>
                </strong>
            </div>
            <?php
        } elseif (isset($_SESSION['deleteMsg'])) { ?>
            <div class="alert alert-danger  alert-dismissible">
                <strong>
                    <?= $_SESSION['deleteMsg'] ?>
                </strong>
            </div>
        <?php }
        unset($_SESSION['deleteMsg']);
        unset($_SESSION['confirm_msg']);
        ?>

        <div class="cards__heading">
            <h3 id="system-time" class="text-center mb-4">System Time: </h3>
            <div class="row row-col-4 justify-content-center">
                <div class="col-2">
                    <form action="../config/employee/attendance.php" method="post">
                        <button name="btn_timein" type="submit" class="btn btn-success btn-lg btn-block">Time
                            In</button>
                    </form>
                </div>

                <div class="col-2">
                    <form action="../config/employee/attendance.php" method="post">
                        <button name="btn_timeout" type="submit" class="btn btn-danger btn-lg btn-block">Time
                            Out</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card card_border p-lg-5 p-3 mb-4">
            <div class="card-body py-3 p-0">
                <table id="staff-attendance" class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Time-In</th>
                            <th>Time-Out</th>
                            <th>Status</th>
                            <th>Worktime Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // $attendanc_sql = "";
                            // $attendanc_result = $conn->query($attendanc_sql);
                        ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>



    </div>
    <!-- //content -->
</div>
<!-- main content end-->

<script>
    new DataTable('#staff-attendance');
    // Function to update system time
    function updateSystemTime() {
        var systemTimeElement = document.getElementById('system-time');
        var now = new Date();
        var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric' };
        var formattedTime = now.toLocaleDateString('en-US', options);
        systemTimeElement.textContent = 'System Time: ' + formattedTime;
    }

    // Update system time every second
    setInterval(updateSystemTime, 1000);

    // Initial call to update system time
    updateSystemTime();
</script>
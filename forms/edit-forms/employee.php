<?php
session_start();
$_SESSION['title'] = "Employee Edit Form";
include '../form-template/form-header.php';

$gender = [
    "male",
    "female",
    "other"
];

$marital_status = [
    "single",
    "married",
    "divorced",
    "widowed",
    "separated",
    "civil_union",
    "in_a_relationship",
    "its_complicated"
];

$job = [
    "chief operating officer",
    "chief executive",
    "chief financial officer",
    "human resources manager",
    "chief marketing officer",
    "manager",
    "finance manager",
    "assistant",
    "staff",
    "other"
];

$department = [
    "hr",
    "finance",
    "production",
    "accounting",
    "quality department"
];

$hire_status = [
    "full-time employees",
    "part-time employees",
    "seasonal employees",
    "temporary employees"
];

$id = isset($_POST['id']) ? $_POST['id'] : $_SESSION['login_id'];
$sql = "SELECT * FROM `tbl_employee_info` 
INNER JOIN tbl_employee_account ON tbl_employee_info.employee_id = tbl_employee_account.employee_id
INNER JOIN tbl_job ON tbl_employee_info.job_id = tbl_job.job_id 
INNER JOIN tbl_relation ON tbl_employee_info.relation_id = tbl_relation.relation_id
INNER JOIN tbl_bill ON tbl_employee_info.bill_id = tbl_bill.bill_id
INNER JOIN tbl_login_role ON tbl_employee_account.login_role_id = tbl_login_role.login_role_id
WHERE tbl_employee_info.employee_id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
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

        <form action="../../config/employee/edit.php" method="post">

            <section class="forms">
                <!-- account -->
                <div class="card card_border py-2 mb-4">
                    <div class="cards__heading">
                        <h3>Account<span></span></h3>
                    </div>
                    <div class="card-body">
                        <div class="form-body">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" value="<?= isset($row['username']) ? $row['username'] : "" ?>"
                                    class="form-control" placeholder="Enter Username" name="username">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group input-group input-icon right">
                                    <input type="password"
                                        value="<?= isset($row['password']) ? $row['password'] : "" ?>"
                                        class="form-control" placeholder="Enter Password" name="password"
                                        id="passwordField">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary btn-sm" type="button"
                                            id="togglePassword">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if ($_SESSION['login_role'] == 1) {
                                ?>
                                <div class="form-group">
                                    <label class="control-label">Role:</label>
                                    <select name="login_role_id" class="form-control">
                                        <option selected disabled>Select an option</option>
                                        <?php
                                        $sql = "SELECT * FROM `tbl_login_role` WHERE `login_role_id` != 3";
                                        $result = $conn->query($sql);
                                        while ($row2 = $result->fetch_assoc()) {
                                            ?>
                                            <option value="<?= $row2['login_role_id'] ?>" class="text-capitalize"
                                                <?= ($row2['login_role_id'] == $row['login_role_id']) ? "selected" : "" ?>>
                                                <?= $row2['login_role'] ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <script>
                    const togglePasswordButton = document.getElementById('togglePassword');
                    const passwordField = document.getElementById('passwordField');

                    togglePasswordButton.addEventListener('click', function () {
                        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                        passwordField.setAttribute('type', type);
                        togglePasswordButton.querySelector('i').classList.toggle('fa-eye-slash');
                    });
                </script>

                <!-- information -->
                <div class="card card_border py-2 mb-4">
                    <div class="cards__heading">
                        <h3>Personal Information<span></span></h3>
                    </div>
                    <div class="card-body">
                        <div class="form-body">
                            <div class="input-group mb-3 mt-3">
                                <span class="input-group-text fw-bold">Name</span>
                                <input type="text" value="<?= isset($row['lastname']) ? $row['lastname'] : "" ?>"
                                    class="form-control" placeholder="Last Name" name="lname">
                                <input type="text" value="<?= isset($row['firstname']) ? $row['firstname'] : "" ?>"
                                    class="form-control" placeholder="First Name" name="fname">
                                <input type="text" value="<?= isset($row['middlename']) ? $row['middlename'] : "" ?>"
                                    class="form-control" placeholder="Middle Name" name="mname">
                            </div>

                            <div class="input-group mb-3 mt-3">
                                <span class="input-group-text fw-bold">Age</span>
                                <input value="<?= isset($row['age']) ? $row['age'] : "" ?>" class="form-control" min="0"
                                    placeholder="Enter Age" type="number" name="age">
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text fw-bold">Birthday</span>
                                <input value="<?= isset($row['birthdate']) ? $row['birthdate'] : "" ?>"
                                    class="form-control" type="date" name="bday">
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text fw-bold">Gender</span>
                                <select name="gender" class="form-select">
                                    <option selected disabled>Select Gender</option>
                                    <?php
                                    foreach ($gender as $gender) {
                                        ?>
                                        <option value="<?= $gender ?>" class="text-capitalize" <?= ($gender == $row['gender']) ? "selected" : "" ?>><?= $gender ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text fw-bold">Marital Status</span>
                                <select name="marital_status" class="form-select">
                                    <option selected disabled>Select Option</option>
                                    <?php
                                    foreach ($marital_status as $marital_status) {
                                        ?>
                                        <option value="<?= $marital_status ?>" class="text-capitalize"
                                            <?= ($marital_status == $row['marital_status']) ? "selected" : "" ?>>
                                            <?= $marital_status ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- contact -->
                <div class="card card_border py-2 mb-4">
                    <div class="cards__heading">
                        <h3>Contact Information<span></span></h3>
                    </div>
                    <div class="card-body">
                        <div class="form-body">
                            <div class="input-group mb-3 mt-3">
                                <span class="input-group-text fw-bold">Email</span>
                                <input value="<?= isset($row['email']) ? $row['email'] : "" ?>" class="form-control"
                                    placeholder="Enter Email" type="email" name="email" required>
                            </div>

                            <div class="input-group mb-3 mt-3">
                                <span class="input-group-text fw-bold">Phone no.</span>
                                <input value="<?= isset($row['phone_num']) ? $row['phone_num'] : "" ?>"
                                    class="form-control" maxlength="11" placeholder="Enter Phone Number" type="phone"
                                    name="phone" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- address -->
                <div class="card card_border py-2 mb-4">
                    <div class="cards__heading">
                        <h3>Address Details<span></span></h3>
                    </div>
                    <div class="card-body">
                        <div class="form-body">
                            <div class="row row-col-3 mb-3">
                                <div class="col">
                                    <?php
                                    $API_URL = 'https://psgc.gitlab.io/api/regions/';
                                    $json = file_get_contents($API_URL);
                                    $data = json_decode($json, true);
                                    ?>
                                    <label class="form-label fw-bold">Select Region:</label>
                                    <select name="region" id="regionSelect" class="form-select" required
                                        onchange="populateProvinces()">
                                        <option disabled selected>Select Region</option>
                                        <?php
                                        foreach ($data as $region) {
                                            ?>
                                            <option value="<?= $region['code'] ?>"><?= $region['name'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label fw-bold">Select Province:</label>
                                    <select name="province" id="provinceSelect" class="form-select" required disabled>
                                        <option disabled selected>Select Region First</option>
                                        <!-- Options will be populated dynamically using JavaScript -->
                                    </select>
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label fw-bold">Select Municipality:</label>
                                    <select name="municipality" id="municipalSelect" class="form-select" required
                                        disabled>
                                        <option disabled selected>Select Province First</option>
                                        <!-- Options will be populated dynamically using JavaScript -->
                                    </select>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        var regionSelect = document.getElementById('regionSelect');
                                        var provinceSelect = document.getElementById('provinceSelect');
                                        var municipalSelect = document.getElementById('municipalSelect');

                                        // Function to fetch provinces based on the selected region
                                        function populateProvinces() {
                                            var regionCode = regionSelect.value;

                                            // Fetch provinces based on the selected region using AJAX
                                            fetch('https://psgc.gitlab.io/api/regions/' + regionCode + '/provinces')
                                                .then(response => response.json())
                                                .then(provinces => {
                                                    // Clear previous options and add a default option
                                                    provinceSelect.innerHTML = '<option disabled selected>Select Province</option>';

                                                    if (provinces.length > 0) {
                                                        provinces.forEach(function (province) {
                                                            var option = document.createElement('option');
                                                            option.value = province.name;
                                                            option.text = province.name;
                                                            option.dataset.provinceCode = province.code;
                                                            provinceSelect.appendChild(option);
                                                        });
                                                        provinceSelect.disabled = false;
                                                    } else {
                                                        var option = document.createElement('option');
                                                        option.text = 'No Available Provinces';
                                                        provinceSelect.appendChild(option);
                                                        provinceSelect.disabled = true;
                                                    }
                                                })
                                                .catch(error => console.error('Error fetching provinces:', error));
                                        }

                                        // Event listener for when the region select changes
                                        regionSelect.addEventListener('change', populateProvinces);

                                        // Function to fetch municipalities based on the selected province
                                        function populateMunicipalities() {
                                            var provinceCode = provinceSelect.selectedOptions[0].dataset.provinceCode;

                                            // Fetch municipalities based on the selected province using AJAX
                                            fetch('https://psgc.gitlab.io/api/provinces/' + provinceCode + '/municipalities')
                                                .then(response => response.json())
                                                .then(municipalities => {
                                                    // Clear previous options and add a default option
                                                    municipalSelect.innerHTML = '<option disabled selected>Select Municipality</option>';

                                                    if (municipalities.length > 0) {
                                                        municipalities.forEach(function (municipality) {
                                                            var option = document.createElement('option');
                                                            option.value = municipality.name;
                                                            option.text = municipality.name;
                                                            municipalSelect.appendChild(option);
                                                        });
                                                        municipalSelect.disabled = false;
                                                    } else {
                                                        var option = document.createElement('option');
                                                        option.text = 'No Available Municipalities';
                                                        municipalSelect.appendChild(option);
                                                        municipalSelect.disabled = true;
                                                    }
                                                })
                                                .catch(error => console.error('Error fetching municipalities:', error));
                                        }

                                        // Event listener for when the province select changes
                                        provinceSelect.addEventListener('change', populateMunicipalities);

                                        // Populate provinces initially
                                        populateProvinces();
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- education -->
                <div class="card card_border py-2 mb-4">
                    <div class="cards__heading">
                        <h3>Educational Background<span></span></h3>
                    </div>
                    <div class="card-body">
                        <div class="form-body">
                            <div class="mb-3 mt-3">
                                <div class="input-group">
                                    <span class="input-group-text fw-bold">School</span>
                                    <input value="<?= isset($row['elem']) ? $row['elem'] : "" ?>" type="text"
                                        class="form-control" placeholder="Enter Elementary" name="elem">
                                    <input value="<?= isset($row['jhs']) ? $row['jhs'] : "" ?>" type="text"
                                        class="form-control" placeholder="Enter Junior Highschool" name="jhs">
                                    <input value="<?= isset($row['shs']) ? $row['shs'] : "" ?>" type="text"
                                        class="form-control" placeholder="Enter Senior Highschool" name="shs">
                                    <input value="<?= isset($row['college']) ? $row['college'] : "" ?>" type="text"
                                        class="form-control" placeholder="Enter College" name="college">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- job -->
                <div class="card card_border py-2 mb-4">
                    <div class="cards__heading">
                        <h3>Job Details<span></span></h3>
                    </div>
                    <div class="card-body">
                        <div class="form-body">
                            <div class="row row-col-5 mb-3 mt-3">

                                <div class="col">
                                    <label class="form-label fw-bold">Select Job:</label>
                                    <select class="form-control" name="job_title" required>
                                        <option selected disabled>Select a job title</option>
                                        <?php
                                        foreach ($job as $job) {
                                            ?>
                                            <option value="<?= $job ?>" class="text-capitalize" <?= ($job == $row['job_title']) ? "selected" : "" ?>><?= $job ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>


                                <div class="col">
                                    <label class="form-label fw-bold">Select Department:</label>
                                    <select class="form-control" name="department" required>
                                        <option selected disabled>Select department</option>
                                        <?php
                                        foreach ($department as $department) {
                                            ?>
                                            <option value="<?= $department ?>" class="text-capitalize"
                                                <?= ($department == $row['department']) ? "selected" : "" ?>><?= $department ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col">
                                    <label class="form-label fw-bold">Employment Status:</label>
                                    <select class="form-control" name="employment_status" required>
                                        <option selected disabled>Select status</option>
                                        <?php
                                        foreach ($hire_status as $hire_status) {
                                            ?>
                                            <option value="<?= $hire_status ?>" class="text-capitalize"
                                                <?= ($hire_status == $row['hire_status']) ? "selected" : "" ?>>
                                                <?= $hire_status ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col d-flex align-items-center justify-content-center">
                                    <div class="input-group" style="height: 1.4rem;">
                                        <span class="input-group-text fw-bold">Employee Id Number</span>
                                        <input
                                            value="<?= isset($row['employement_num']) ? $row['employement_num'] : "" ?>"
                                            type="text" class="form-control" placeholder="Enter Employee Id Number"
                                            name="employement_num" required>
                                    </div>
                                </div>

                                <div class="col d-flex align-items-center justify-content-center">
                                    <div class="input-group" style="height: 1.4rem;">
                                        <span class="input-group-text fw-bold">Date of Hire</span>
                                        <input value="<?= isset($row['hire_date']) ? $row['hire_date'] : "" ?>"
                                            type="date" class="form-control" name="hire_date" required>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- salary -->
                <div class="card card_border py-2 mb-4">
                    <div class="cards__heading">
                        <h3>Salary & Deduction Details<span></span></h3>
                    </div>
                    <div class="card-body">
                        <div class="form-body">
                            <div class="input-group mb-3 mt-3">
                                <span class="input-group-text fw-bold">SSS Number</span>
                                <input value="<?= isset($row['sss']) ? $row['sss'] : "" ?>" type="text"
                                    class="form-control" placeholder="Enter SSS number" name="sss">
                                <span class="input-group-text fw-bold">Pag-Ibig Number</span>
                                <input value="<?= isset($row['pagibig']) ? $row['pagibig'] : "" ?>" type="text"
                                    class="form-control" placeholder="Enter Pag-Ibig Number" name="pagibig">
                                <span class="input-group-text fw-bold">PhilHealth Number</span>
                                <input value="<?= isset($row['phil']) ? $row['phil'] : "" ?>" type="text"
                                    class="form-control" placeholder="Enter PhilHealth Number" name="phil">
                                <span class="input-group-text fw-bold">Basic Salary</span>
                                <input value="<?= isset($row['salary']) ? $row['salary'] : "" ?>" type="number"
                                    class="form-control" placeholder="Enter Basic Salary" name="salary" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- emergency -->
                <div class="card card_border py-2 mb-4">
                    <div class="cards__heading">
                        <h3>Emergency Contact<span></span></h3>
                    </div>
                    <div class="card-body">
                        <div class="form-body">
                            <div class="row row-col-2 input-group mb-3 mt-3">
                                <div class="col input-group">
                                    <span class="input-group-text fw-bold">Name of Spouse/Guardian</span>
                                    <input value="<?= isset($row['person_name']) ? $row['person_name'] : "" ?>"
                                        type="text" class="form-control" placeholder="Enter Name of Spouse/Guardian"
                                        name="person_name">
                                </div>
                                <div class="col input-group">
                                    <span class="input-group-text fw-bold">Relationship</span>
                                    <input value="<?= isset($row['relationship']) ? $row['relationship'] : "" ?>"
                                        type="text" class="form-control" placeholder="Enter Relationship"
                                        name="person_relationship">
                                </div>
                            </div>
                            <div class="row row-col-2 input-group mb-3 mt-3">
                                <div class="col input-group">
                                    <span class="input-group-text fw-bold">Spouse/Guardian Phone Number</span>
                                    <input value="<?= isset($row['person_num']) ? $row['person_num'] : "" ?>"
                                        type="number" class="form-control"
                                        placeholder="Enter Spouse/Guardian Phone Number" name="person_phone_num">
                                </div>
                                <div class="col input-group">
                                    <span class="input-group-text fw-bold">Spouse/Guardian Email</span>
                                    <input value="<?= isset($row['person_email']) ? $row['person_email'] : "" ?>"
                                        type="email" class="form-control" placeholder="Enter Spouse/Guardian Email"
                                        name="person_email">
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                <button type="submit" class="btn btn-primary btn-style mt-4">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </form>


    </div>

    <!-- //content -->
</div>
<!-- main content end-->
<?php include '../form-template/form-footer.php'; ?>
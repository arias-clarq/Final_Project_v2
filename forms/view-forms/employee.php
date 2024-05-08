<?php
session_start();
$_SESSION['title'] = "Employee View Form";
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

$id = $_POST['id'];
$sql = "SELECT * FROM `tbl_employee_info` 
INNER JOIN tbl_job ON tbl_employee_info.job_id = tbl_job.job_id 
INNER JOIN tbl_relation ON tbl_employee_info.relation_id = tbl_relation.relation_id
INNER JOIN tbl_bill ON tbl_employee_info.bill_id = tbl_bill.bill_id
WHERE `employee_id` = $id";
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

        <section class="forms">

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
                                class="form-control text-capitalize" placeholder="Last Name" name="lname" readonly>
                            <input type="text" value="<?= isset($row['firstname']) ? $row['firstname'] : "" ?>"
                                class="form-control text-capitalize" placeholder="First Name" name="fname" readonly>
                            <input type="text" value="<?= isset($row['middlename']) ? $row['middlename'] : "" ?>"
                                class="form-control text-capitalize" placeholder="Middle Name" name="mname" readonly>
                        </div>

                        <div class="input-group mb-3 mt-3">
                            <span class="input-group-text fw-bold">Age</span>
                            <input class="form-control" value="<?= isset($row['age']) ? $row['age'] : "" ?>" min="0"
                                placeholder="Enter Age" type="number" name="age" readonly>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bold">Birthday</span>
                            <input class="form-control" value="<?= isset($row['birthdate']) ? $row['birthdate'] : "" ?>"
                                type="text" name="bday" readonly>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bold">Gender</span>
                            <input class="form-control text-capitalize" type="text"
                                value="<?= isset($row['gender']) ? $row['gender'] : "" ?>" readonly>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bold">Marital Status</span>
                            <input class="form-control text-capitalize" type="text"
                                value="<?= isset($row['marital_status']) ? $row['marital_status'] : "" ?>" readonly>
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
                            <input class="form-control" value="<?= isset($row['email']) ? $row['email'] : "" ?>"
                                placeholder="Enter Email" type="email" name="email" readonly>
                        </div>

                        <div class="input-group mb-3 mt-3">
                            <span class="input-group-text fw-bold">Phone no.</span>
                            <input class="form-control" value="<?= isset($row['phone_num']) ? $row['phone_num'] : "" ?>"
                                maxlength="11" placeholder="Enter Phone Number" type="phone" name="phone" readonly>
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
                            <div class="col mb-3">
                                <label class="form-label fw-bold">Province:</label>
                                <input class="form-control text-capitalize" type="text"
                                    value="<?= isset($row['province']) ? $row['province'] : "" ?>" readonly>
                            </div>

                            <div class="col mb-3">
                                <label class="form-label fw-bold">Municipality:</label>
                                <input class="form-control text-capitalize" type="text"
                                    value="<?= isset($row['municipality']) ? $row['municipality'] : "" ?>" readonly>
                            </div>
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
                                <input type="text" value="<?= isset($row['elem']) ? $row['elem'] : "" ?>"
                                    class="form-control" placeholder="Enter Elementary" name="elem" readonly>
                                <input type="text" value="<?= isset($row['jhs']) ? $row['jhs'] : "" ?>"
                                    class="form-control" placeholder="Enter Junior Highschool" name="jhs" readonly>
                                <input type="text" value="<?= isset($row['shs']) ? $row['shs'] : "" ?>"
                                    class="form-control" placeholder="Enter Senior Highschool" name="shs" readonly>
                                <input type="text" value="<?= isset($row['college']) ? $row['college'] : "" ?>"
                                    class="form-control" placeholder="Enter College" name="college" readonly>
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
                                <label class="form-label fw-bold">Job:</label>
                                <input class="form-control text-capitalize" type="text"
                                    value="<?= isset($row['job_title']) ? $row['job_title'] : "" ?>" readonly>
                            </div>


                            <div class="col">
                                <label class="form-label fw-bold">Department:</label>
                                <input class="form-control text-capitalize" type="text"
                                    value="<?= isset($row['department']) ? $row['department'] : "" ?>" readonly>
                            </div>

                            <div class="col">
                                <label class="form-label fw-bold">Employment Status:</label>
                                <input class="form-control text-capitalize" type="text"
                                    value="<?= isset($row['hire_status']) ? $row['hire_status'] : "" ?>" readonly>
                            </div>

                            <div class="col d-flex align-items-center justify-content-center">
                                <div class="input-group" style="height: 1.4rem;">
                                    <span class="input-group-text fw-bold">Employee Id Number</span>
                                    <input type="text"
                                        value="<?= isset($row['employement_num']) ? $row['employement_num'] : "" ?>"
                                        class="form-control" placeholder="Enter Employee Id Number"
                                        name="employement_num" readonly>
                                </div>
                            </div>

                            <div class="col d-flex align-items-center justify-content-center">
                                <div class="input-group" style="height: 1.4rem;">
                                    <span class="input-group-text fw-bold">Date of Hire</span>
                                    <input type="text" value="<?= isset($row['hire_date']) ? $row['hire_date'] : "" ?>"
                                        class="form-control" name="hire_date" readonly>
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
                            <input type="text" value="<?= isset($row['sss']) ? $row['sss'] : "" ?>" class="form-control"
                                placeholder="Enter SSS number" name="sss" readonly>
                            <span class="input-group-text fw-bold">Pag-Ibig Number</span>
                            <input type="text" value="<?= isset($row['pagibig']) ? $row['pagibig'] : "" ?>"
                                class="form-control" placeholder="Enter Pag-Ibig Number" name="pagibig" readonly>
                            <span class="input-group-text fw-bold">PhilHealth Number</span>
                            <input type="text" value="<?= isset($row['phil']) ? $row['phil'] : "" ?>"
                                class="form-control" placeholder="Enter PhilHealth Number" name="phil">
                            <span class="input-group-text fw-bold" readonly>Basic Salary</span>
                            <input type="number" value="<?= isset($row['salary']) ? $row['salary'] : "" ?>"
                                class="form-control" placeholder="Enter Basic Salary" name="salary" readonly>
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
                                <input value="<?= isset($row['person_name']) ? $row['person_name'] : "" ?>" type="text"
                                    class="form-control" placeholder="Enter Name of Spouse/Guardian" name="person_name"
                                    readonly>
                            </div>
                            <div class="col input-group">
                                <span class="input-group-text fw-bold">Relationship</span>
                                <input value="<?= isset($row['relationship']) ? $row['relationship'] : "" ?>"
                                    type="text" class="form-control" placeholder="Enter Relationship"
                                    name="person_relationship" readonly>
                            </div>
                        </div>
                        <div class="row row-col-2 input-group mb-3 mt-3">
                            <div class="col input-group">
                                <span class="input-group-text fw-bold">Spouse/Guardian Phone Number</span>
                                <input value="<?= isset($row['person_num']) ? $row['person_num'] : "" ?>" type="number"
                                    class="form-control" placeholder="Enter Spouse/Guardian Phone Number"
                                    name="person_phone_num" readonly>
                            </div>
                            <div class="col input-group">
                                <span class="input-group-text fw-bold">Spouse/Guardian Email</span>
                                <input value="<?= isset($row['person_email']) ? $row['person_email'] : "" ?>"
                                    type="email" class="form-control" placeholder="Enter Spouse/Guardian Email"
                                    name="person_email" readonly>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="../../dashboard/employee_mgt.php">
                                <button type="submit" class="btn btn-primary btn-style mt-4">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </div>

    <!-- //content -->
</div>
<!-- main content end-->
<?php include '../form-template/form-footer.php'; ?>
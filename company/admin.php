<?php include('./views/header.php'); ?>

<?php include('./fancy/simpleQuery.php'); ?>

<style>
    form > * {
        margin: 10px;
    }

    .alert {
        margin: 10px;
    }

    form.assignments > *,
    form.managers > *,
    .btn.btn-primary,
    .alert {
        margin-right: auto;
        margin-left: auto;
        width: 60%;
    }

    select,
    .btn.btn-info {
        height: 34px;
    }

    select {
        width: calc(35% - 7px);
        margin-left: 0.5px;
    }

    @-moz-document url-prefix() {
        select {
            margin-left: 20px;
        }
    }

    .btn.btn-info {
        background-color: #3c4f79;
        width: calc(25% - 7px);
        border-radius: 2px;
        margin: -4px 0 1px;
        padding: 3px 10px;
        border: none;
    }

    hr {
        border-bottom: 1px solid rgba(0,0,0,.1);
        border-top: 1px solid rgba(0,0,0,.1);
        margin-bottom: 8px;
        height: 2px;
        width: 60%;
    }
</style>

<?php

$employeeModifSuccessMsg = "";
$departmentModifSuccessMsg = "";
$projectModifSuccessMsg = "";
$locationModifSuccessMsg = "";

$log_time_error = false;
$promote_employee_error = false;


//Submit Changes
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Modifications for the Employee
    if (isset($_POST['modifyEmployeeSubmit'])) {
        $iid = $name = $did =  $supervisor = $address = $phone =  $hourly = "";

        $iid = $_POST["iidInput"];
        $name = $_POST["nameInput"];
        $did =  $_POST["departmentInput"];
        $supervisor = $_POST["supervisorInput"];
        $address = $_POST["addressInput"];
        $phone =  $_POST["phoneInput"];
        $hourly = $_POST["hourlyInput"];

        $con = include('./fancy/connection.php');

        $sql = "UPDATE employees
                    SET did = '$did',
                    supervisor = '$supervisor',
                    address = '$address',
                    phone = '$phone',
                    hourly = '$hourly'
                    WHERE iid = '$iid'";

        $con->query($sql);

        $sql = "UPDATE identities
                    SET name = '$name'
                    WHERE id = '$iid'";

        $con->query($sql);

        $employeeModifSuccessMsg = "Successful";

        $con->close();
    }

    //Addition of an Employee
    if (isset($_POST['addEmployeeSubmit'])) {
        $iid = $sin= $name = $did =  $supervisor = $address = $phone =  $hourly = "";

        $iid = "identity". mt_rand(00000000, 99999999);
        $sin = "sin" . mt_rand(000000, 999999);
        $name = $_POST["nameInput"];
        $gender = $_POST["genderInput"];
        $birthday =  $_POST["birthdayInput"];
        $did = $_POST["departmentInput"];
        $supervisor = $_POST["supervisorInput"];
        $address = $_POST["addressInput"];
        $phone =  $_POST["phoneInput"];
        $hourly = $_POST["hourlyInput"];

        $con = include('./fancy/connection.php');

        $sql = "INSERT INTO identities
                    (id, sin, name, birthday, gender)
                    VALUES ('$iid', '$sin', '$name', '$birthday', '$gender')";

        $con->query($sql);

        $sql = "INSERT INTO employees
                    (iid, did, supervisor, address, phone, hourly)
                    VALUES ((SELECT id from identities where id = '$iid'), '$did', '$supervisor', '$address', '$phone', '$hourly')";


        $con->query($sql);

        $employeeModifSuccessMsg = "Successful";

        $con->close();
    }

    //Modifications for the department
    if (isset($_POST['modifyDepartmentSubmit'])) {
        $id = $name = $supervisor= "";

        $id = $_POST["idInput"];
        $name = $_POST["nameInput"];
        $supervisor = $_POST["supervisorInput"];

        $con = include('./fancy/connection.php');

        $sql = "UPDATE departments
                    SET name = '$name'
                    WHERE id = '$id'";

        $con->query($sql);

        $sql = "UPDATE managers
                    SET eid = '$supervisor'
                    WHERE did = '$id'";

        $con->query($sql);

        $departmentModifSuccessMsg = "Successful";

        $con->close();
    }

    //Addition of a department
    if (isset($_POST['addDepartmentSubmit'])) {
        $id =  $name = "";

        $id = "department". mt_rand(000000, 999999);
        $name = $_POST["nameInput"];

        $con = include('./fancy/connection.php');

        $sql = "INSERT INTO departments
                    (id, name)
                    VALUES ('$id', '$name')";

        $con->query($sql);

        $departmentModifSuccessMsg = "Successful";

        $con->close();
    }

    //Modifications for the project
    if (isset($_POST['modifyProjectSubmit'])) {
        $id = $name = $supervisor = $stage = "";

        $id = $_POST["idInput"];
        $name = $_POST["nameInput"];
        $lead = $_POST["supervisorInput"];
        $stage = $_POST["stageInput"];
        $did = $_POST["departmentInput"];

        $con = include('./fancy/connection.php');

        $sql = "UPDATE projects
                    SET did = '$did',
                    name = '$name',
                    lead = '$lead',
                    stage = '$stage'
                    WHERE id = '$id'";

        $con->query($sql);

        $projectModifSuccessMsg = "Successful";

        $con->close();
    }

    //Add for the project
    if (isset($_POST['addProjectSubmit'])) {
        $id = $name = $supervisor = $stage = "";

        $id = "project00000". mt_rand(00000, 99999);
        $did = $_POST["departmentInput"];
        $name = $_POST["nameInput"];
        $lead = $_POST["supervisorInput"];
        $stage = $_POST["stageInput"];

        $con = include('./fancy/connection.php');

        $sql = "INSERT INTO projects (id, did, lid, name, lead, stage)
                VALUES ('$id', '$did', (SELECT id FROM locations WHERE did = '$did'), '$name', '$lead', '$stage')";

        $con->query($sql);

        $projectModifSuccessMsg = "Successful";

        $con->close();
    }

    //log time
    if (
        isset($_POST['log-time']) &&
        isset($_POST['employee-id']) &&
        isset($_POST['project-id']) &&
        isset($_POST['hours'])
    ) {
        $eid = $_POST['employee-id'];
        $pid = $_POST['project-id'];
        $hours = number_format($_POST['hours'], 2);

        $con = include('./fancy/connection.php');

        $sql = "INSERT INTO
                    assignments (`eid`, `pid`, `hours`)
                VALUES ('$eid', '$pid', $hours)
                ON DUPLICATE KEY
                    UPDATE hours = hours + $hours;";

        $con->query($sql);
        $log_time_error = $con->error;
        $con->close();
    }

    // add a location
    if (
        isset($_POST['add-location']) &&
        isset($_POST['department-id']) &&
        isset($_POST['location'])
    ) {
        $id = "location0000". mt_rand(00000, 99999);
        $did = $_POST['department-id'];
        $location = $_POST['location'];

        $con = include('./fancy/connection.php');

        $sql = "INSERT INTO
                    locations (`id`, `did`, `location`)
                VALUES ('$id', '$did', '$location');";

        $con->query($sql);
        $locationModifSuccessMsg = "Successful";
        $con->close();
    }

    // modify a location
    if (
        isset($_POST['modify-location']) &&
        isset($_POST['id']) &&
        isset($_POST['department-id']) &&
        isset($_POST['location'])
    ) {
        $id = $_POST['id'];
        $did = $_POST['department-id'];
        $location = $_POST['location'];

        $con = include('./fancy/connection.php');

        $sql = "UPDATE locations
                SET
                    `id` = '$id',
                    `did` = '$did',
                    `location` = '$location'
                WHERE locations.id = '$id';";

        $con->query($sql);
        $locationModifSuccessMsg = "Successful";
        $con->close();
    }

    // promote employee
    if (
        isset($_POST['promote-employee']) &&
        isset($_POST['employee-id']) &&
        isset($_POST['department-id'])
    ) {
        $eid = $_POST['employee-id'];
        $did = $_POST['department-id'];

        $con = include('./fancy/connection.php');

        $sql = "INSERT INTO
                    managers (`eid`, `did`, `start`)
                VALUES ('$eid', '$did', NOW())";

        $con->query($sql);
        $promote_employee_error = $con->error;
        $con->close();
    }
}
?>

<!-- update simple queries again -->
<?php include('./fancy/simpleQuery.php'); ?>

<div class="container-fluid text-center">
    <h2>Admin Page</h2>
    <h4>Add or modify records</h4>
    <br><br>
    <div class="row">
        <div class="col-sm-4">
            <h4>Employees</h4>
            <strong class="alert-success"><?php echo $employeeModifSuccessMsg?></strong>
            <p>Add or Modify Employees Record</p>
            <a type="button" href='employeeAddPage.php'class="btn btn-primary">Add New</a>
            <hr>
            <form action="employeeModifyPage.php" id="modifyEmployeeForm" method="POST">
                <select id="modifyEmployeeSelect" name="modifyEmployeeSelect" onChange="modifyEmployeeId()" class="selectpicker">
                    <option value="default" selected disabled hidden>Choose Employee</option>

                    <?php
                    foreach ($employees as $row) {
                        echo '<option value="'.$row["iid"].'">' . $row["name"] . '</option>';
                    }
                    ?>

                </select>
                <button type="submit" class="btn btn-info submit" id="modifyEmployeeButton" disabled>Modify</button><br>
            </form>
        </div>
        <div class="col-sm-4">
            <h4>Deparments</h4>
            <strong class="alert-success"><?php echo $departmentModifSuccessMsg?></strong>
            <p>Add or Modify Departments Record</p>
            <a type="button" href='departmentAddPage.php' class="btn btn-primary">Add New</a><br>
            <hr>
            <form action="departmentModifyPage.php" id="modifyDepartmentForm" method="POST">
                <select id="modifyDepartmentSelect" name="modifyDepartmentSelect" onChange="modifyDepartmentId()" class="selectpicker">
                    <option value="default" selected disabled hidden>Choose deparment</option>

                    <?php
                    foreach ($departments as $row) {
                        echo '<option value="'.$row["id"].'">' . $row["name"] . '</option>';
                    }
                    ?>

                </select>
                <button type="submit" class="btn btn-info submit" id="modifyDepartmentButton" disabled>Modify</button><br>
            </form>
        </div>


        <div class="col-sm-4">
            <h4>Projects</h4>
            <strong class="alert-success"><?php echo $projectModifSuccessMsg?></strong>
            <p>Add or Modify Projects Record</p>
            <a type="button" href='projectAddPage.php' class="btn btn-primary">Add New</a>
            <hr>
            <form action="projectModifyPage.php" id="modifyProjectForm" method="POST">
                <select id="modifyProjectSelect" name="modifyProjectSelect" onChange="modifyProjectId()" class="selectpicker">
                    <option value="default" selected disabled hidden>Choose Project</option>

                    <?php
                    foreach ($projects as $row) {
                        echo '<option value="'.$row["id"].'">' . $row["name"] . '</option>';
                    }
                    ?>

                </select>
                <button type="submit" class="btn btn-info submit" id="modifyProjectButton" disabled>Modify</button> <br>
            </form>
        </div>
    </div>


    <br><br><br><br>


    <div class="row">
        <div class="col-sm-4">
            <h4>Assignments</h4>
            <p>Log employee hours</p>
            <form class="assignments" action="admin.php" method="POST">
                <select name="employee-id" class="selectpicker">
                    <option value="default" selected disabled hidden>Choose Employee</option>

                    <?php
                    foreach ($employees as $row) {
                        echo '<option value="'.$row["iid"].'">' . $row["name"] . '</option>';
                    }
                    ?>

                </select>
                <br>
                <select name="project-id" class="selectpicker">
                    <option value="default" selected disabled hidden>Choose Project</option>

                    <?php
                    foreach ($projects as $row) {
                        echo '<option value="'.$row["id"].'">' . $row["name"] . '</option>';
                    }
                    ?>

                </select><br>
                <input type="number" name="hours" placeholder="Number of hours" min="0" step=".01"/><br>
                <button type="submit" class="btn btn-primary" name="log-time">Log Time</button><br>
            </form>

            <?php
            if ($log_time_error) {
                echo '<div class="alert alert-danger">';
                    echo '<b>An error has occured</b> '.$log_time_error;
                echo '</div>';
            } else if ($log_time_error === '') {
                echo '<div class="alert alert-success">';
                    echo 'Time successfuly logged!';
                echo '</div>';
            }
            ?>

        </div>


        <div class="col-sm-4">
            <h4>Locations</h4>
            <strong class="alert-success"><?php echo $locationModifSuccessMsg?></strong>
            <p>Add or Modify Location Record</p>
            <a type="button" href='locationAddPage.php' class="btn btn-primary">Add New</a>
            <hr>
            <form action="locationModifyPage.php" id="modifyLocationForm" method="POST">
                <select name="location" onChange="modifyLocationId()" class="selectpicker">
                    <option value="default" selected disabled hidden>Choose Location</option>

                    <?php
                    foreach ($locations as $row) {
                        echo '<option value="'.$row["id"].'">' . $row["location"] . '</option>';
                    }
                    ?>

                </select>
                <button type="submit" class="btn btn-info submit" id="modifyLocationButton" disabled>Modify</button> <br>
            </form>
        </div>


        <div class="col-sm-4">
            <h4>Managers</h4>
            <p>Promote employees</p>
            <form class="managers" action="admin.php" method="POST">
                <select name="employee-id" class="selectpicker">
                    <option value="default" selected disabled hidden>Choose Employee</option>

                    <?php
                    foreach ($employees as $row) {
                        echo '<option value="'.$row["iid"].'">' . $row["name"] . '</option>';
                    }
                    ?>

                </select>
                <br>
                <select name="department-id" class="selectpicker">
                    <option value="default" selected disabled hidden>Choose Department</option>

                    <?php
                    foreach ($departments as $row) {
                        echo '<option value="'.$row["id"].'">' . $row["name"] . '</option>';
                    }
                    ?>

                </select><br>
                <button type="submit" class="btn btn-primary" name="promote-employee">Promote</button><br>
            </form>

            <?php
            if ($promote_employee_error) {
                echo '<div class="alert alert-danger">';
                    echo '<b>An error has occured</b> '.$promote_employee_error;
                echo '</div>';
            } else if ($promote_employee_error === '') {
                echo '<div class="alert alert-success">';
                    echo 'Employee successfuly promoted!';
                echo '</div>';
            }
            ?>

        </div>


    </div>
</div>

<script>
    function modifyEmployeeId() {
        document.getElementById("modifyEmployeeButton").disabled = false;
    }

    function modifyDepartmentId() {
        document.getElementById("modifyDepartmentButton").disabled = false;
    }

    function modifyProjectId() {
        document.getElementById("modifyProjectButton").disabled = false;
    }

    function modifyLocationId() {
        document.getElementById("modifyLocationButton").disabled = false;
    }
</script>

<?php

include('./views/footer.php');

?>

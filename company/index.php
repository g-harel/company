<?php include('./views/header.php'); ?>

<style>
    .jumbotron {
        background-color: #3c4f79;
        padding: 100px 25px;
        border-radius: 0;
        color: #fff;
    }

    .icon-color {
        color: #3c4f79;
    }
</style>

<div class="jumbotron text-center">
    <h1>Company</h1>
    <p>This is our Main Project for COMP 353</p>
</div>

<div class="container-fluid text-center">
<h2>Records</h2>
<h4>Company's Record</h4>
<br>
<div class="row">
    <div class="col-sm-4">
        <span class="glyphicon glyphicon-user icon-color"></span>
        <h4>Employees</h4>
        <a class="btn btn-secondary" href="#employees" role="button">Records of Employees</a>
    </div>
    <div class="col-sm-4">
        <span class="glyphicon glyphicon-th icon-color"></span>
        <h4>Departments</h4>
        <a class="btn btn-secondary" href="#departments" role="button">Records of Departments</a>
    </div>
    <div class="col-sm-4">
        <span class="glyphicon glyphicon-tasks icon-color"></span>
        <h4>Projects</h4>
        <a class="btn btn-secondary" href="#projects" role="button">Records of Projects</a>
    </div>
</div>

<div class="container-fluid text-center" id="employees">
    <h2>Employees</h2>
    <h4>List of Employees</h4>

    <?php

    $sql = "SELECT
                identities.name AS 'Name',
                departments.name AS 'Department',
                employees.phone AS 'Phone'
            FROM
                employees
                    JOIN identities ON (employees.iid = identities.id)
                    JOIN departments ON (employees.did = departments.id)";
    $rows = array('Name', 'Department', 'Phone');
    include('./fancy/table.php');

    ?>

</div>

<div class="container-fluid text-center" id="departments">
    <h2>Departments</h2>
    <h4>List of Departments</h4>

    <?php

    $sql = "SELECT
                departments.name AS 'Department',
                identities.name AS 'Manager',
                managers.start AS 'Since'
            FROM
                managers
                    JOIN employees ON (managers.eid = employees.iid)
                    JOIN departments ON (managers.did = departments.id)
                    JOIN identities ON (employees.iid = identities.id)";
    $rows = array('Department', 'Manager', 'Since');
    include('./fancy/table.php');

    ?>

</div>

<div class="container-fluid text-center" id="projects">
    <h2>Projects</h2>
    <h4>List of Projects</h4>

    <?php

    $sql = "SELECT
                projects.name AS 'Project',
                locations.location AS 'Location',
                departments.name AS 'Department'
            FROM projects
                JOIN locations ON (projects.lid = locations.id)
                JOIN departments ON (locations.did = departments.id)";
    $rows = array('Project', 'Location', 'Department');
    include('./fancy/table.php');

    ?>

</div>

<?php include('./views/footer.php'); ?>

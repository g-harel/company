<?php include('./views/header.php'); ?>

<style>
    .jumbotron {
        background-color: #3c4f79;
        border-radius: 0;
        color: #fff;
    }

    .jumbotron h1 {
        font-family: 'Patua One', sans-serif;
        text-shadow:  4px 4px rgba(0, 0, 0, 0.2);
        -moz-user-select: none;
        user-select: none;
        font-size: 6em;
    }

    .icon-color {
        color: #3c4f79;
    }
</style>

<div class="jumbotron text-center">
    <h1>Company</h1>
    <p>The only pyramid scheme that works **</p>
</div>

<div class="container-fluid text-center">
    <h2>Records</h2>
    <h4>Company records at a glance</h4>
    <br>
    <div class="row">
        <div class="col-2 col-lg-0"></div>
        <div class="col-4">
            <h2>Projects</h2>

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
        <div class="col-4">
            <h2>Departments</h2>

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
        <div class="col-2 col-lg-0"></div>
    </div>
    <div class="row">
        <div class="col-12">
            <h2>Employees</h2>

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
    </div>
</div>

<?php include('./views/footer.php'); ?>

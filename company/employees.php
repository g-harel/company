<?php include('header.php'); ?>

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
    include('table.php');

    ?>

</div>

<?php include('footer.php'); ?>

<?php include('header.php'); ?>

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
    include('table.php');

    ?>

</div>

<?php include('footer.php'); ?>

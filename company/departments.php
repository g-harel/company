<?php include('./views/header.php'); ?>

<div class="container-fluid text-center">
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

<div class="container-fluid text-center">
    <h2>Department Cost Breakdown</h2>
    <h4>From project assignments and employee wage</h4>

    <?php

    $sql = "SELECT
                d.name AS 'Department',
                CONCAT('$', FORMAT(SUM(a.hours * e.hourly), 2)) AS 'Total Cost'
            FROM
                departments AS d,
                projects AS p,
                assignments AS a,
                employees AS e
            WHERE
                d.id = p.did AND
                p.id = a.pid AND
                a.eid = e.iid
            GROUP BY
                d.id;";
    $rows = array('Department', 'Total Cost');
    include('./fancy/table.php');

    ?>

</div>

<?php include('./views/footer.php'); ?>

<?php include('./views/header.php'); ?>

<div class="container-fluid text-center">
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
    include('./fancy/table.php');

    ?>

</div>

<div class="container-fluid text-center">
    <h2>Employees Total Project Work</h2>
    <h4>From project assignments and hourly wage</h4>

    <?php

    $sql = "SELECT
                i.name AS 'Employee',
                SUM(a.hours) AS 'Total Hours',
                CONCAT('$', FORMAT(SUM(a.hours * e.hourly), 2)) AS 'Total Wage'
            FROM
                identities AS i,
                employees AS e,
                assignments AS a
            WHERE
                i.id = e.iid AND
                e.iid = a.eid
            GROUP BY
                i.id;";
    include('./fancy/table.php');

    ?>

</div>

<div class="container-fluid text-center">
    <h2>Employees Project Invlolvment</h2>
    <h4>From project assignments</h4>

    <?php

    $sql = "SELECT
                i.name AS 'Employee',
                COUNT(a.eid) AS 'Project Count'
            FROM
                identities AS i,
                employees AS e,
                assignments AS a
            WHERE
                i.id = e.iid AND
                e.iid = a.eid
            GROUP BY
                a.eid;";
    include('./fancy/table.php');

    ?>

</div>

<div class="container-fluid text-center">
    <h2>Employees Direct Subordinates</h2>
    <h4>From employee supervisors</h4>

    <?php

    $sql = "SELECT
                i.name AS 'Employee',
                COUNT(e.iid) AS 'Subordinates'
            FROM
                identities AS i,
                employees AS e,
                employees AS sub
            WHERE
                e.iid = i.id AND
                sub.supervisor = e.iid
            GROUP BY
                e.iid;";
    include('./fancy/table.php');

    ?>

</div>

<?php include('./views/footer.php'); ?>

<?php include('./views/header.php'); ?>

<div class="container-fluid text-center">
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
    include('./fancy/table.php');

    ?>

</div>


<div class="container-fluid text-center">
    <h2>Project Cost Breakdown</h2>
    <h4>From project assignments and employee wage</h4>

    <?php

    $sql = "SELECT
                p.name AS 'Project',
                CONCAT('$', FORMAT(SUM(a.hours * e.hourly), 2)) AS 'Total Cost'
            FROM
                projects AS p,
                assignments AS a,
                employees AS e
            WHERE
                p.id = a.pid AND
                a.eid = e.iid
            GROUP BY
                a.pid;";
    include('./fancy/table.php');

    ?>

</div>

<div class="container-fluid text-center">
    <h2>Project Progress</h2>
    <h4>Project stage aggregation</h4>

    <?php

    $sql = "SELECT
                CONCAT('STAGE_', p.stage) AS 'Stage',
                COUNT(p.stage) AS 'Project Count'
            FROM
                projects AS p
            GROUP BY
                p.stage;";
    include('./fancy/table.php');

    ?>

</div>

<div class="container-fluid text-center">
    <h2>Project Participants</h2>
    <h4>From project assignments</h4>

    <?php

    $sql = "SELECT
                p.name AS 'Project',
                GROUP_CONCAT(i.name SEPARATOR ',<br>') AS 'Participants'
            FROM
                assignments AS a,
                projects AS p,
                employees AS e,
                identities AS i
            WHERE
                a.pid = p.id AND
                a.eid = e.iid AND
                e.iid = i.id
            GROUP BY
                p.id;";
    include('./fancy/table.php');

    ?>

</div>

<?php include('./views/footer.php'); ?>

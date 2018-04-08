<?php include('header.php'); ?>

<div class="container-fluid text-center" id="projects">
    <h2>Create New Project</h2>
    <form>
        <label>Name:</label> <input type="text"></input><br>
        <label>Locations:</label> <p>a drop down of the known locations</p>
    </form>
    <br>
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
    include('table.php');

    ?>

</div>

<?php include('footer.php'); ?>

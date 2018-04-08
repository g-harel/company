<?php include('header.php'); ?>

<div class="container-fluid text-center" id="departments">
    <h2>Departments</h2>
    <h4>List of Departments</h4>
    <br>
    <table class="table table-hover">
        <thread>
            <tr>
                <th>Department</th>
                <th>Manager</th>
                <th>Since</th>
            </tr>
        </thread>
        <tbody>
            <?php
            // Query to get the name, manager and starting date of each deapartments
            $sql = "SELECT departments.name AS dname, identities.name AS iname, managers.start
                        FROM managers
                        JOIN employees ON managers.eid = employees.iid
                        JOIN departments ON managers.did = departments.id
                        JOIN identities ON employees.iid = identities.id";

            $result = $con->query($sql);

            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                        echo "<td>".$row['dname']."</td>";
                        echo "<td>".$row['iname']."</td>";
                        echo "<td>".$row['start']."</td>";
                    echo "</tr>";
                }
            }
            else{
                echo "<p>No Information to Show</p>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include('footer.php'); ?>

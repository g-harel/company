<!DOCTYPE html>
<html>

<head>
	<title>Company, Main project</title>
  	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../style.css">
</head>

<body>
    <?php
    include("nav.php");

    //get database connection
    $con = include("../db/setup.php");
    ?>

    <div class="container-fluid text-center" id="employees">
        <h2>Employees</h2>
        <h4>List of Employees</h4>            
        <table class="table table-hover">
            <thread>
                <tr>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Phone</th>
                </tr>
            </thread>	
            <tbody>
                <?php
                // Query to get the name, deparement and phone number of each employee
                $sql = "SELECT identities.name AS iname, departments.name AS dname, employees.phone 
                            FROM employees
                            JOIN identities ON employees.iid = identities.id
                            JOIN departments ON employees.did = departments.id";
                
                $result = $con->query($sql);

                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                            echo "<td>".$row['iname']."</td>";
                            echo "<td>".$row['dname']."</td>";
                            echo "<td>".$row['phone']."</td>";
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

</body>

</html>
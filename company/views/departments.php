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
				// Query to get the name, deparement and phone number of each employee
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
    
</body>

</html>
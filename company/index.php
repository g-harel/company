<?php

	$config = include('config.php');

	$host = $config['host'];
	$port = $config['port'];
	$socket = $config['socket'];
	$user = $config['user'];
	$password = $config['password'];
	$dbname = $config['dbname'];

	$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
		or die ('Could not connect to the database server' . mysqli_connect_error());
?>

<!DOCTYPE html>
<html>

<head>
	<title>Company, Main project</title>
  	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<div class="jumbotron text-center">
	<h1>Company</h1> 
	<p>This is our Main Project for COMP 353</p>
	</div>

	<div class="container-fluid text-center">
	<h2>Records</h2>
	<h4>Company's Record</h4>
	<br>
	<div class="row">
		<div class="col-sm-4">
		<span class="glyphicon glyphicon-user"></span>
		<h4>Employees</h4>
		<p>Records of Employees</p>
		</div>
		<div class="col-sm-4">
		<span class="glyphicon glyphicon-th"></span>
		<h4>Departments</h4>
		<p>Records of Departments</p>
		</div>
		<div class="col-sm-4">
		<span class="glyphicon glyphicon-tasks"></span>
		<h4>Projects</h4>
		<p>Records of Employees</p>
		</div>
	</div>

	<div class="container-fluid text-center">
		<h2>Employees</h2>
		<h4>List of employees</h4>            
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

	<?php
	$con->close();
	?>
</body>
</html>

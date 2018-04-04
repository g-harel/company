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
	<header>
		<div class="nav">
		<ul>
			<li class="home"><a href="index.php">Home</a></li>
			<li class="tutorials"><a href="views/employees.php">Employees</a></li>
			<li class="about"><a href="views/departments.php">Departments</a></li>
			<li class="news"><a href="views/projects.php">Projects</a></li>
		</ul>
		</div>
	</header>

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
			<span class="glyphicon glyphicon-user main-color"></span>
			<h4>Employees</h4>
			<a class="btn btn-secondary" href="#employees" role="button">Records of Employees</a>
		</div>
		<div class="col-sm-4">
			<span class="glyphicon glyphicon-th main-color"></span>
			<h4>Departments</h4>
			<a class="btn btn-secondary" href="#departments" role="button">Records of Departments</a>
		</div>
		<div class="col-sm-4">
			<span class="glyphicon glyphicon-tasks main-color"></span>
			<h4>Projects</h4>
			<a class="btn btn-secondary" href="#projects" role="button">Records of Projects</a>
		</div>
	</div>

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

	<div class="container-fluid text-center" id="projects">
		<h2>Projects</h2>
		<h4>List of Projects</h4>
		<br>             
		<table class="table table-hover">
			<thread>
				<tr>
					<th>Project</th>
					<th>Location</th>
					<th>Department</th>
				</tr>
			</thread>	
			<tbody>
				<?php
				// Query to get the name, deparement and phone number of each employee
				$sql = "SELECT projects.name AS pname, locations.location, departments.name AS dname
							FROM projects
							JOIN locations ON projects.lid = locations.id
							JOIN departments ON locations.did = departments.id";
				
				$result = $con->query($sql);

				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()) {
						echo "<tr>";
							echo "<td>".$row['pname']."</td>";
							echo "<td>".$row['location']."</td>";
							echo "<td>".$row['dname']."</td>";
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

	<?php $con->close(); ?>
</body>
</html>

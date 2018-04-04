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
</body>

</html>
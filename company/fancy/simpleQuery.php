<?php

$con = include('./fancy/connection.php');

// get employees values;
$employees = array();
$sql = "SELECT * FROM employees JOIN identities ON employees.iid = identities.id";
$result = $con->query($sql);
if($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($employees, $row);
    }
}

// get Departments values;
$departments = array();
$sql = "SELECT * FROM departments";
$result = $con->query($sql);
if($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($departments, $row);
    }
}

// get Project values;
$projects = array();
$sql = "SELECT * FROM projects";
$result = $con->query($sql);
if($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($projects, $row);
    }
}

// get employees that are managers Manager values;
$sql = "SELECT DISTINCT name, id, eid FROM managers JOIN identities ON identities.id = managers.eid";
$managersEmployees;
$result = $con->query($sql);
if($result->num_rows > 0) {
    $managersEmployees = $result;
}

//get locations
$sql = "SELECT * FROM locations";
$locations;
$result = $con->query($sql);
if($result->num_rows > 0) {
    $locations = $result;
}

$con->close();

?>
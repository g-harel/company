<?php

$con = include('./fancy/connection.php');

// get employees values;
$sql = "SELECT * FROM employees JOIN identities ON employees.iid = identities.id";
$employees;
$result = $con->query($sql);
if($result->num_rows > 0) {
    $employees = $result;
}

// get Departments values;
$sql = "SELECT * FROM departments";
$departments;
$result = $con->query($sql);
if($result->num_rows > 0) {
    $departments = $result;
}

// get Project values;
$sql = "SELECT * FROM projects";
$projects;
$result = $con->query($sql);
if($result->num_rows > 0) {
    $projects = $result;
}

// get employees that are managers Manager values;
$sql = "SELECT DISTINCT name, id, eid FROM managers JOIN identities ON identities.id = managers.eid";
$managersEmployees;
$result = $con->query($sql);
if($result->num_rows > 0) {
    $managersEmployees = $result;
}

$con->close();

?>
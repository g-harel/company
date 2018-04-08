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

return $con;

?>
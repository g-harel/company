<?php

$config = include('config.php');

$con = new mysqli($config['host'], $config['user'], $config['password'], $config['dbname'], $config['port'], $config['socket'])
    or die ('Could not connect to the database server'.mysqli_connect_error());

return $con // REMEMBER TO CLOSE CONNECTIONS

?>
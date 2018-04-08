<?php

$con = new mysqli('localhost', 'root', '', 'company', 3306, '')
    or die ('Could not connect to the database server'.mysqli_connect_error());

return $con // REMEMBER TO CLOSE CONNECTIONS

?>
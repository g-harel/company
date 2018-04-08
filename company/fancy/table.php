<?php
// expects mysql query ($query)
// expects list of rows ($rows)

$con = include('connection.php');

$result = $con->query($sql);

if($result->num_rows > 0) {
    echo '<table class="table table-hover">';
        echo '<thead>';
            echo '<tr>';
            for($i = 0; $i < count($rows); $i++) {
                echo '<th>'.$rows[$i].'</th>';
            }
            echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        while($row = $result->fetch_assoc()) {
            echo '<tr>';
            for($i = 0; $i < count($rows); $i++) {
                echo '<td>'.$row[$rows[$i]].'</td>';
            }
            echo '</tr>';
        }
        echo '</tbody>';
    echo '</table>';
}
else{
    echo '<p>No Results to Show</p>';
}

$con->close();

?>
<style>
    .fancy-table {
        margin: 2em 0;
    }

    .fancy-table table {
        display: inline;
    }

    .fancy-table .table-hover tbody tr:hover {
        background-color: rgba(60, 79, 121, 0.05);
    }

    .fancy-table .table-hover tbody tr:hover:nth-of-type(odd){
        background-color: rgba(60, 79, 121, 0.1);
    }

    .fancy-table td {
        font-family: 'IBM Plex Mono', monospace;
    }

    .fancy-table .right {
        text-align: right;
    }
</style>

<?php
// expects mysql query ($query)
// expects list of rows ($rows)

$con = include('connection.php');

$result = $con->query($sql);

// table id used to be able to target this table with js code.
$table_id = rand();

echo "<div class=\"fancy-table $table_id\">";
if($result->num_rows > 0) {
    echo '<table class="table table-hover table-bordered table-striped">';
        echo '<thead class="thead-dark">';
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
echo '</div>';

$con->close();

?>

<!-- aligns cells that contain numbers to the right. -->
<script>
    var tableID = "<?php echo($table_id); ?>";

    $('.fancy-table.'+tableID+' td').each(function() {
        if (this.innerHTML.match(/^\$?[\d.,-]+$/g)) {
            $(this).addClass('right');
        }
    });
</script>
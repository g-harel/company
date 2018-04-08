<?php include('./views/header.php');

$con = include('./fancy/connection.php');

// get employees values;
$sql = "SELECT * FROM employees JOIN identities ON employees.iid = identities.id";

$employees;

$result = $con->query($sql);
if($result->num_rows > 0) {
    $employees = $result;
}

$con->close();
?>


<div class="container-fluid text-center">
    <h2>Admin Page</h2>
    <h4>Add or modify records</h4>
    <br><br>
    <div class="row">
        <div class="col-sm-4">
            <h4>Employees</h4>
            <p>Modify or Add Employees record</p>
            <select id="modifyEmployeeSelect" onChange="modifyEmployeeId()">
                <option value="default" selected disabled hidden>Choose Employee</option>
                <?php
                  while($row = $employees->fetch_assoc()){
                      echo '<option value="'.$row["iid"].'">' . $row["name"] . '</option>';
                  }
                ?>                  
            </select>
            <button type="button" class="btn btn-info" id="modifyEmployeeButton" disabled>Modify</button>
            <br><br>
            <button type="button" class="btn btn-primary">Add</button>
        </div>
        <div class="col-sm-4">
            <h4>Deparments</h4>
            <p>Modify or Add Departments record</p>
            <button type="button" class="btn btn-info">Modify</button> <button type="button" class="btn btn-primary">Add</button>
        </div>
        <div class="col-sm-4">
            <h4>Projects</h4>
            <p>Modify or Add Projects record</p>
            <button type="button" class="btn btn-info">Modify</button> <button type="button" class="btn btn-primary">Add</button>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-sm-4">
            <h4>Assignments</h4>
            <p>Modify or Add Assignments record</p>
            <button type="button" class="btn btn-info">Modify</button> <button type="button" class="btn btn-primary">Add</button>
        </div>
        <div class="col-sm-4">
            <h4>Locations</h4>
            <p>Modify or Add Locations record</p>
            <button type="button" class="btn btn-info">Modify</button> <button type="button" class="btn btn-primary">Add</button>
        </div>
        <div class="col-sm-4">
            <h4>Managers</h4>
            <p>Modify or Add Managers record</p>
            <button type="button" class="btn btn-info">Modify</button> <button type="button" class="btn btn-primary">Add</button>
        </div>
    </div>
</div>

<script>
    function modifyEmployeeId(){
        document.getElementById("modifyEmployeeButton").value = document.getElementById("modifyEmployeeSelect").value;
        document.getElementById("modifyEmployeeButton").disabled = false;
    }
</script>

<?php 
// include('./views/modal.php');
include('./views/footer.php');

?>

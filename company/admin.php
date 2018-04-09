<?php include('./views/header.php');

include('./fancy/simpleQuery.php');
?>


<div class="container-fluid text-center">
    <h2>Admin Page</h2>
    <h4>Add or modify records</h4>
    <br><br>
    <div class="row">
        <div class="col-sm-4">
            <h4>Employees</h4>
            <p>Modify or Add Employees record</p>
            <form action="employeeModifyPage.php" id="modifyEmployeeForm" method="POST">
                <select id="modifyEmployeeSelect" name="modifyEmployeeSelect" onChange="modifyEmployeeId()" class="selectpicker">
                    <option value="default" selected disabled hidden>Choose Employee</option>
                    <?php
                    while($row = $employees->fetch_assoc()){
                        echo '<option value="'.$row["iid"].'">' . $row["name"] . '</option>';
                    }
                    ?>                  
                </select>
                <button type="submit" onClick="modifyEmployeeSubmit()" class="btn btn-info submit" id="modifyEmployeeButton" disabled data-toggle="modal" data-target="#modifyEmployeeModal">Modify</button>
                <br><br>
                <button type="button" class="btn btn-primary">Add</button>
            </form>
        </div>
        <div class="col-sm-4">
            <h4>Deparments</h4>
            <p>Modify or Add Departments record</p>
            <select id="modifyDepartmentSelect" onChange="modifyDepartmentId()" class="selectpicker">
                <option value="default" selected disabled hidden>Choose deparment</option>
                <?php
                  while($row = $departments->fetch_assoc()){
                      echo '<option value="'.$row["id"].'">' . $row["name"] . '</option>';
                  }
                ?>                  
            </select>
            <button type="button" class="btn btn-info" id="modifyDepartmentButton" disabled>Modify</button>
            <br><br>
            <button type="button" class="btn btn-primary">Add</button>
        </div>
        <div class="col-sm-4">
            <h4>Projects</h4>
            <p>Modify or Add Projects record</p>
            <select id="modifyProjectSelect" onChange="modifyProjectId()" class="selectpicker">
                <option value="default" selected disabled hidden>Choose Project</option>
                <?php
                  while($row = $projects->fetch_assoc()){
                      echo '<option value="'.$row["id"].'">' . $row["name"] . '</option>';
                  }
                ?>                  
            </select>
            <button type="button" class="btn btn-info" id="modifyProjectButton" disabled>Modify</button>
            <br><br>
            <button type="button" class="btn btn-primary">Add</button>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-sm-4">
            <h4>Assignments</h4>
            <p>Modify or Add Assignments record</p>
            <button type="button" class="btn btn-info">Modify</button>
            <button type="button" class="btn btn-primary">Add</button>
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
        document.getElementById("modifyEmployeeButton").disabled = false;
    }

    function modifyDepartmentId(){
        document.getElementById("modifyDepartmentButton").disabled = false;
    }

    function modifyProjectId(){
        document.getElementById("modifyProjectButton").disabled = false;
    }

</script>

<?php 
include('employeeModal.php');

include('./views/footer.php');

?>

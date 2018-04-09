<?php
include('./views/header.php');

include('./fancy/simpleQuery.php');
?>

<div class="mx-auto" style="width: 200px;">
  <form action="admin.php" name="addEmployeeFormSubmit" id="addEmployeeFormSubmit" method="POST">

    <div class="form-group">
      <br>
      <h3>Add Employee</h3>
    </div>
    
    <div class="form-group">
        <label>Name:</label> <input name="nameInput" class="form-control" type="text"> <br>
        <label>Gender:</label> <br>
            Male: <input name="genderInput" type="radio" value="M"><br>
            Femmel: <input name="genderInput" type="radio" value="F"><br>
            Other: <input name="genderInput" type="radio" value="O"> <br><br>
        <label>Birthday:</label> <input name="birthdayInput" class="form-control" type="date"> <br>
        <label>Department:</label>
        <select class="form-control" name="departmentInput">
          <?php 
          while($row = $departments->fetch_assoc()){
              echo '<option value="'.$row["id"].'">' . $row["name"] . '</option>';
          }
          ?>
        </select>   
        <br>
        <label>Supervisor:</label>
        <select class="form-control" name="supervisorInput">
          <?php 
          while($row = $managersEmployees->fetch_assoc()){
            echo '<option value="'.$row["id"].'">' . $row["name"] . '</option>';
          }
          ?>
        </select> 
        <br>
        <label>Address:</label> <input name="addressInput" class="form-control" type="text"> <br>
        <label>Phone:</label> <input name="phoneInput" class="form-control" type="text"> <br>
        <label>Hourly:</label> <input name="hourlyInput" class="form-control" type="text"> <br>
    </div>

    <button type="submit" name="addEmployeeSubmit" class="btn btn-success submit">Submit</button> 
    <a type="button" class="btn btn-danger" href="admin.php">Cancel</a>

  </form>
</div>

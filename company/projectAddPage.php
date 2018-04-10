<?php
include('./views/header.php');

include('./fancy/simpleQuery.php');
?>

<div class="mx-auto" style="width: 200px;">
  <form action="admin.php" name="addProjectFormSubmit" id="addProjectFormSubmit" method="POST">

    <div class="form-group">
      <br>
      <h3>Add Project</h3>
    </div>
    
    <div class="form-group">
        <label>Name:</label> <input name="nameInput" class="form-control" type="text"> <br>  
        <label>Department:</label>
        <select class="form-control" name="departmentInput">
          <?php 
          foreach ($departments as $row) {
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
        <label>Stage:</label>
        <select class="form-control" name="stageInput">
          <?php
          $newStage = 0; 
          while($newStage <= 3){
              echo '<option value="'.$newStage.'">' . $newStage . '</option>';
              $newStage += 1;
          }
          ?>
        </select>
    </div>

    <button type="submit" name="addProjectSubmit" class="btn btn-success submit">Submit</button> 
    <a type="button" class="btn btn-danger" href="admin.php">Cancel</a>

  </form>
</div>

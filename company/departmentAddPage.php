<?php
include('./views/header.php');

include('./fancy/simpleQuery.php');
?>

<div class="mx-auto" style="width: 200px;">
  <form action="admin.php" name="addDepartmentFormSubmit" id="addDepartmentFormSubmit" method="POST">

    <div class="form-group">
      <br>
      <h3>Add Department</h3>
    </div>

    <div class="form-group">
        <label>Name:</label> <input name="nameInput" class="form-control" type="text">
    </div>

    <button type="submit" name="addDepartmentSubmit" class="btn btn-success submit">Submit</button>
    <a type="button" class="btn btn-danger" href="admin.php">Cancel</a>

  </form>
</div>

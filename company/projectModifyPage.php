<?php
include('./views/header.php');

$id = $did = $lid = $name = $lead = $stage = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(empty($_POST["modifyProjectSelect"])){
    $id = "not defined";
  }
  else{
    $id = $_POST["modifyProjectSelect"];

    $con = include('./fancy/connection.php');

    $sql = "SELECT * FROM projects
              WHERE id = '$id'";

    echo "<script>alert($sql)</script>";

    $result = $con->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $did = $row['did'];
        $lid = $row['lid'];
        $name = $row['name'];
        $lead = $row['lead'];
        $stage = $row['stage'];
    }

    $con->close();

    include('./fancy/simpleQuery.php');
  }
}
else{
  $idd = "not defined";
}
?>

<div class="mx-auto" style="width: 200px;">
  <form action="admin.php" name="modifyProjectFormSubmit" id="modifyProjectFormSubmit" method="POST">

    <div class="form-group">
      <br>
      <h3><?php echo $name?></h3>
      <input type="text" class="form-control" name="idInput" value="<?php echo $id?>" readonly></input>
    </div>
    
    <div class="form-group">
        <label>Name:</label> <input name="nameInput" class="form-control" type="text" value="<?php echo $name?>"> <br>  
        <label>Department:</label>
        <select class="form-control" name="departmentInput">
          <?php 
          while($row = $departments->fetch_assoc()){
            if($row["id"] == $did){
              echo '<option selected value="'.$row["id"].'">' . $row["name"] . '</option>';
            }
            else{
              echo '<option value="'.$row["id"].'">' . $row["name"] . '</option>';
            }
          }
          ?>
        </select>   
        <br>
        <label>Supervisor:</label>
        <select class="form-control" name="supervisorInput">
          <?php 
          while($row = $managersEmployees->fetch_assoc()){
            if($row["eid"] == $lead){
              echo '<option selected value="'.$row["id"].'">' . $row["name"] . '</option>';
            }
            else{
              echo '<option value="'.$row["id"].'">' . $row["name"] . '</option>';
            }
          }
          ?>
        </select>
        <br>
        <label>Stage:</label>
        <select class="form-control" name="stageInput">
          <?php
          $newStage = 0; 
          while($newStage <= 3){
              if($newStage == $stage){
                echo '<option selected value="'.$newStage.'">' . $newStage. '</option>';
              }
              else{
                echo '<option value="'.$newStage.'">' . $newStage . '</option>';
              }
              $newStage += 1;
          }
          ?>
        </select>
    </div>

    <button type="submit" name="modifyProjectSubmit" class="btn btn-success submit">Submit</button> 
    <a type="button" class="btn btn-danger" href="admin.php">Cancel</a>

  </form>
</div>

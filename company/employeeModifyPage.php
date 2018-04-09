<?php
include('./views/header.php');

$iid = $name = $did =  $supervisor = $address = $phone =  $hourly = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(empty($_POST["modifyEmployeeSelect"])){
    $idd = "not defined";
  }
  else{
    $iid = $_POST["modifyEmployeeSelect"];

    $con = include('./fancy/connection.php');

    $sql = "SELECT * FROM employees JOIN identities ON employees.iid = identities.id WHERE iid = '" . $iid . "'";

    $result = $con->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $name = $row['name'];
        $did = $row['did'];
        $supervisor = $row['supervisor'];
        $address = $row['address'];
        $phone = $row['phone'];
        $hourly = $row['hourly'];
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
  <form action="admin.php" name="modifyEmployeeFormSubmit" id="modifyEmployeeFormSubmit" method="POST">

    <div class="form-group">
      <br>
      <h3><?php echo $name?></h3>
      <input type="text" class="form-control" name="iidInput" value="<?php echo $iid?>" readonly></input>
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
            if($row["eid"] == $supervisor){
              echo '<option selected value="'.$row["id"].'">' . $row["name"] . '</option>';
            }
            else{
              echo '<option value="'.$row["id"].'">' . $row["name"] . '</option>';
            }
          }
          ?>
        </select> 
        <br>
        <label>Address:</label> <input name="addressInput" class="form-control" type="text" value="<?php echo $address?>"> <br>
        <label>Phone:</label> <input name="phoneInput" class="form-control" type="text" value="<?php echo $phone?>"> <br>
        <label>Hourly:</label> <input name="hourlyInput" class="form-control" type="text" value="<?php echo $hourly?>"> <br>
    </div>

    <button type="submit" name="modifyEmployeeSubmit" class="btn btn-success submit">Submit</button> 
    <a type="button" class="btn btn-danger" href="admin.php">Cancel</a>

  </form>
</div>

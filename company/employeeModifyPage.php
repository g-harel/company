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
  <form action="<?php echo $_SERVER["PHP_SELF"];?>" id="modifyEmployeeFormSubmit" method="POST">

    <div class="form-group">
      <br>
      <h3><?php echo $name?></h3>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
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

    <button type="submit" class="btn btn-success submit">Submit</button> <button type="button" class="btn btn-danger">Cancel</button>

  </form>
</div>




<?php

//Submit Changes

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(empty($_POST["modifyEmployeeFormSubmit"])){
    //error handle
  }
  else{
    $name = $did =  $supervisor = $address = $phone =  $hourly = "";

    $name = $_POST["nameInput"];
    $did =  $_POST["nameInput"];
    $supervisor = $_POST["supervisorInput"];
    $address = $_POST["addressInput"];
    $phone =  $_POST["phoneInput"];
    $hourly = $_POST["hourlyInput"];

    $con = include('./fancy/connection.php');

    $sql = "UPDATE employees
                  SET did = '".$did."', supervisor = '".$supervisor."', address = '".$address."', phone = '".$phone."', hourly = '".$hourly."'
                  WHERE iid = '".$iid."'";

    $result = $con->query($sql);
    if($result->num_rows > 0) {
      echo "<script type='text/javascript'>location.href = 'admin.php';</script>";
    }
    else{
      echo ERROR;
    }

    $con->close();
  }
}
else{
  $idd = "not defined";
}

?>
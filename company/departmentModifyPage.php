<?php
include('./views/header.php');

$id = $eid = $dname = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(empty($_POST["modifyDepartmentSelect"])){
    $idd = "not defined";
  }
  else{
    $id = $_POST["modifyDepartmentSelect"];

    $con = include('./fancy/connection.php');

    $sql = "SELECT * FROM departments
              JOIN managers ON departments.id = managers.did
              WHERE departments.id = '$id'";

    $result = $con->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $dname = $row['name'];
        $eid = $row['eid'];
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
  <form action="admin.php" name="modifyDepartmentFormSubmit" id="modifyDepartmentFormSubmit" method="POST">

    <div class="form-group">
      <br>
      <h3><?php echo $dname?></h3>
      <input type="text" class="form-control" name="idInput" value="<?php echo $id?>" readonly></input>
    </div>

    <div class="form-group">
        <label>Name:</label> <input name="nameInput" class="form-control" type="text" value="<?php echo $dname?>"> <br>
        <label>Supervisor:</label>
        <select class="form-control" name="supervisorInput">
          <?php
          while($row = $managersEmployees->fetch_assoc()){
            if($row["eid"] == $eid){
              echo '<option selected value="'.$row["id"].'">' . $row["name"] . '</option>';
            }
            else{
              echo '<option value="'.$row["id"].'">' . $row["name"] . '</option>';
            }
          }
          ?>
        </select>
    </div>

    <button type="submit" name="modifyDepartmentSubmit" class="btn btn-success submit">Submit</button>
    <a type="button" class="btn btn-danger" href="admin.php">Cancel</a>

  </form>
</div>

<?php include('./views/footer.php'); ?>

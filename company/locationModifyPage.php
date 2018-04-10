<?php include('./views/header.php');?>

<?php

$id = "";
$did = "";
$location = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["location"])) {
    $id = $_POST["location"];

    $con = include('./fancy/connection.php');

    $sql = "SELECT * FROM locations
            WHERE locations.id = '$id'";

    $result = $con->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $did = $row['did'];
        $location = $row['location'];
    }

    $con->close();
} else {
    $idd = 'not defined';
}

?>

<?php include('./fancy/simpleQuery.php'); ?>

<div class="mx-auto" style="width: 200px;">
    <form action="admin.php" method="POST">
        <div class="form-group">
            <br>
            <h3><?php echo $id; ?></h3>
            <input type="text" class="form-control" name="id" value="<?php echo $id; ?>" readonly></input>
        </div>

        <div class="form-group">
            <label>Location:</label>
            <input name="location" class="form-control" type="text" value="<?php echo $location?>"><br>
            <label>Department:</label>
            <select class="form-control" name="department-id">

                <?php
                foreach ($departments as $row) {
                    echo '<option selected value="'.$row["id"].'">'.$row["name"].'</option>';
                }
                ?>

            </select>
        </div>

        <button type="submit" name="modify-location" class="btn btn-success submit">Submit</button>
        <a type="button" class="btn btn-danger" href="admin.php">Cancel</a>
    </form>
</div>

<?php include('./views/footer.php');?>

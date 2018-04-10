<?php include('./views/header.php');?>

<?php include('./fancy/simpleQuery.php');?>

<div class="mx-auto" style="width: 200px;">
    <form action="admin.php" method="POST">
        <div class="form-group">
            <br>
            <h3>Add Location</h3>
        </div>

        <div class="form-group">
            <label>Location Name:</label>
            <input name="location" class="form-control" type="text">
        </div>
        <div class="form-group">
            <select class="form-control" name="department-id" required>
                <option value="default" selected disabled hidden>Choose deparment</option>

                <?php
                foreach ($departments as $row){
                    echo '<option value="'.$row["id"].'">' . $row["name"] . '</option>';
                }
                ?>

            </select>
        </div>
        <button type="submit" name="add-location" class="btn btn-success submit">Submit</button>
        <a type="button" class="btn btn-danger" href="admin.php">Cancel</a>
    </form>
</div>

<?php include('./views/footer.php');?>

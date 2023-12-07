<?php
    require('functionadmin.php');
    require "session.php";
    include "headeradmin.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["EditCategoryProduct"])) {
        $id = $_POST["CPID"];
        $name = $_POST["CPName"];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
    <form action="functionadmin.php" method="post">
        <!-- these form group is used in editing an existing category -->
        <div class="form-group row">
            <label for="CID" class="col-sm-2 col-form-label">Id Category</label>
            <div class="col-sm-2">
            <input type="text" name="CID" readonly class="form-control-plaintext" id="CID" value="<?php echo $id?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputCategory" class="col-sm-2 col-form-label">Category Name</label>
            <div class="col-sm-5">
            <input type="text" name="inputCategory" class="form-control" id="inputCategory" value="<?= $name?>">
            </div>
            <button type="submit" name="EditCP" class="btn btn-outline-success btn-sm">Edit</button>
        </div>
    </form>
</body>
</html>
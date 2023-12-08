<?php
    require('functionadmin.php');
    require "session.php";
    include "headeradmin.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["EditUser"])) {
        $id = $_POST["UID"];
        $name = $_POST["UName"];
        $type = $_POST["Type"];
        $email = $_POST["Email"];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <form action="functionadmin.php" method="post">
        <!-- these outline is used in editing an existing users -->
        <div class="form-group row">
            <label for="UID" class="col-sm-2 col-form-label">Id User</label>
            <div class="col-sm-2">
            <input type="text" name="UID" readonly class="form-control-plaintext" id="UID" value="<?= $id?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="UType" class="col-sm-2 col-form-label">User Type</label>
            <div class="col-sm-2">
            <input type="number" name="UType" class="form-control" id="UType" min="0" max="1" value="<?php echo $type?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="UEmail" class="col-sm-2 col-form-label">User Email</label>
            <div class="col-sm-2">
            <input type="email" name="UEmail" class="form-control" id="UEmail" value="<?= $email?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputName" class="col-sm-2 col-form-label">User Name</label>
            <div class="col-sm-5">
            <input type="text" name="inputName" class="form-control" id="inputName" value="<?= $name?>">
            </div>
            <button type="submit" name="EditU" class="btn btn-outline-success btn-sm">Edit</button>
        </div>
    </form>
</body>
</html>
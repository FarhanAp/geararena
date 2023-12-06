<?php
    require('functionadmin.php');
    require "session.php";
    include "headeradmin.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create new category</title>
</head>
<body>
    <h2>CREATE NEW CATEGORY</h2>
    <form action="functionadmin.php" method="post">
        <div class="form-group row">
            <label for="inputCategory" class="col-sm-2 col-form-label">Category Name</label>
            <div class="col-sm-5">
            <input type="text" name="inputCategory" class="form-control" id="inputCategory" placeholder="...Monitor...">
            </div>
            <button type="submit" name="CreateCF" class="btn btn-outline-success">Create</button>
        </div>
    </form>
</body>
</html>
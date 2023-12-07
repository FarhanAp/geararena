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
    <title>Marketplace Detail</title>
</head>
<body>
    <section class="container create mt-5">
        <h6>Create New Category</h6>
        <form action="functionadmin.php" method="post">
            <div class="form-group row">
                <label for="inputCategory" class="col-sm-2 col-form-label">New Category</label>
                <div class="col-sm-5">
                <input type="text" name="inputCategory" class="form-control" id="inputCategory" placeholder="new category">
                </div>
            </div>
            <button type="submit" name="CreateCP" class="btn btn-outline-success btn-sm">Create</button>
        </form>
    </section>

    <section class="container mt-5">
        <table class="table table-striped">
            <thead class="table-dark text-center">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">product name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php loadUsers()?>
            </tbody>
        </table>
    </section>
</body>
</html>
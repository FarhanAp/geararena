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
    <title>Forum Category</title>

    <link rel="stylesheet" href="assets/css/forumcategory.css">
</head>
<body>
    <h2>category</h2>
    <?php categoryForumCreation()?>

    <div class="container">
        <table class="table table-bordered text-center">
            <tr class="table-success">
                <th>ID</th>
                <th>Name Forum</th>
                <th>Edit/Delete</th>
            </tr>
            <tr>
                <?php loadForumCategoryList()?>
            </tr>
        </table>
    </div>
</body>
</html>
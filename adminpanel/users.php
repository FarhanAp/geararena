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
    <title>User Setting</title>
</head>
<body>
    <section class="container mt-5">
        <table class="table table-striped">
            <thead class="table-dark text-center">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Date</th>
                    <th scope="col">Type</th>
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
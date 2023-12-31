<?php
    require('functionadmin.php');
    require "session.php";
    include "headeradmin.php";

    $sql1 = mysqli_query($connect, "SELECT * FROM forum_category");
    $totalforum = mysqli_num_rows($sql1);

    $sql2 = mysqli_query($connect, "SELECT * FROM products_category");
    $totalproductcategory = mysqli_num_rows($sql2);

    $sql3 = mysqli_query($connect, "SELECT * FROM users WHERE type = 0");
    $totalusers = mysqli_num_rows($sql3);

    $sql4 = mysqli_query($connect, "SELECT * FROM products");
    $totalproducts = mysqli_num_rows($sql4);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>

    <!-- css -->
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body>

    <div class="container mt-5 col-lg-8 col-md-6">
        <div class="row mt-5">
            <div class="col-lg-4 col-md-6">
                <div class="box summary-box p-2">
                    <div class="row">
                        <div class="col-6">
                            <i class="fa-regular fa-comments fa-4x text-black-50"></i>
                        </div>
                        <div class="col-6">
                            <h4>forum category</h4>
                            <p><?php echo $totalforum ?> categories</p>
                            <p><a href="forumcategory.php" style="text-decoration:none">detail</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="box summary-box p-2">
                    <div class="row">
                        <div class="col-6">
                            <i class="fa-solid fa-store fa-4x text-black-50"></i>
                        </div>
                        <div class="col-6">
                            <h4>market details</h4>
                            <p><?php echo $totalproductcategory ?> categories</p>
                            <p><a href="marketplacedetail.php" style="text-decoration:none">detail</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="box summary-box p-2">
                    <div class="row">
                        <div class="col-6">
                        <i class="fa-solid fa-people-arrows fa-4x text-black-50"></i>
                        </div>
                        <div class="col-6">
                            <h4>users section</h4>
                            <p><?php echo $totalusers ?> users</p>
                            <p><a href="users.php" style="text-decoration:none">detail</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-6">
                <div class="box summary-box p-2">
                    <div class="row">
                        <div class="col-6">
                        <i class="fa-solid fa-cart-arrow-down fa-4x text-black-50"></i>
                        </div>
                        <div class="col-6">
                            <h4>selling item</h4>
                            <p><?php echo $totalproducts ?> items</p>
                            <p><a href="insertproduct.php" style="text-decoration:none">detail</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
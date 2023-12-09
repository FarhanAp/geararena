<?php
    require('functionadmin.php');
    require "session.php";
    include "headeradmin.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["EditProduct"])) {
        $id = $_POST["PID"];
        $product = $_POST["PName"];
        // SELECT  products.id AS pid,
        //             category_id,
        //             products_category.id AS cid,
        //             products_category.Name AS category_name,
        //             product, price, quantity, users_id, username FROM products 
        //             INNER JOIN products_category ON
        //             category_id = products_category.id
        $queryCategory = mysqli_query($connect, "SELECT * FROM products WHERE id='$id'");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <section class="container mt-5" >
        <h6>Insert a New Product</h6>
        <form action="functionadmin.php" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group row mb-3">
                <label for="name">Product Name</label>
                <input type="text" name="Newproduct" id="Newproduct" class="form-control" value="<?= $product ?>" required>
            </div>
            <div class="form-group row mb-3">
                <label for="inputCategory">Select Category</label>
                <select name="inputCategory" id="inputCategory" class="form-control" required>
                    <option value="">Choose 1 category</option>
                    <?php 
                        while ($data = mysqli_fetch_assoc($queryCategory)) { 
                    ?>
                        <option value="<?= $data["id"] ?>"> <?= $data["product"] ?> </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group row mb-3">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" min="1" class="form-control" required>
            </div>
            <div class="form-group row mb-3">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" min="0" max="999" class="form-control" required>
            </div>
            <div class="form-group row mb-3">
                <label for="photo">Image</label>
                <input type="file" name="photo" id="photo" class="form-control">
            </div>
            <div class="form-group row mb-3">
                <label for="detail">Detail</label>
                <textarea type="file" name="detail" id="detail" class="form-control"></textarea>
            </div>
            <br>
            <button type="submit" name="CreatePro" class="btn btn-outline-success btn-sm">Create</button>
        </form>
    </section>
</body>
</html>
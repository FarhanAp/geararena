<?php
    require('functionadmin.php');
    require "session.php";
    include "headeradmin.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["EditProduct"])) {
        $id = $_POST["PID"];
        $product = $_POST["PName"];
        $currentphoto = $_POST["Pphoto"];
        $queryProduct = mysqli_query($connect,
                                        "SELECT products.*, products_category.Name AS cname
                                        FROM products INNER JOIN products_category
                                        ON category_id = products_category.id WHERE products.id='$id'");
        $datapro = mysqli_fetch_assoc($queryProduct);
        $proCat = $datapro["category_id"];

        $queryCategory = mysqli_query($connect,"SELECT * FROM products_category WHERE id !='$proCat'");
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
    <section class="container mt-5 mb-4" >
        <h5>Edit A Product</h5>
        <form action="functionadmin.php" method="post" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="PID" value="<?= $id ?>">
            <input type="hidden" name="Loadedphoto" value="<?= $currentphoto ?>">
            <div class="form-group row mb-3">
                <label for="Editproduct">Product Name</label>
                <input type="text" name="Editproduct" id="Editproduct" class="form-control" value="<?= $product ?>" required>
            </div>
            <div class="form-group row mb-3">
                <label for="inputCategory">Select Category</label>
                <select name="inputCategory" id="inputCategory" class="form-control" required>
                    <option value="<?= $datapro["category_id"] ?>"> <?= $datapro["cname"] ?> </option>
                    <?php 
                        while ($dataCat = mysqli_fetch_assoc($queryCategory)) { 
                    ?>
                        <option value="<?= $dataCat["id"] ?>"> <?= $dataCat["Name"] ?> </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group row mb-3">
                <label for="price">Price</label>
                <input type="number" name="price" min="1" id="price" class="form-control" value= <?=$datapro["price"]?> required>
            </div>
            <div class="form-group row mb-3">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" min="0" max="999" id="quantity" class="form-control" value= <?=$datapro["quantity"]?> required>
            </div>
            <div>
                <label for="current-photo">Product Photo currently</label>
                <img src="../../gearproduct/image/products/<?= $datapro['photo'] ?>" alt="photo" width="350px">
            </div>
            <div class="form-group row mb-3">
                <label for="photo">Image</label>
                <input type="file" name="photo" id="photo" class="form-control">
            </div>
            <div class="form-group row mb-3">
                <label for="detail">Detail</label>
                <textarea type="file" name="detail" id="detail" class="form-control">
                    <?= $datapro['detail'] ?>
                </textarea>
            </div>
            <br>
            <button type="submit" name="EditPro" class="btn btn-outline-success btn-sm">Edit</button>
        </form>
    </section>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- using a wysiwyg editor the name is ckeditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

    <!-- script of wysiwyg must be put at the bottom of body html -->
    <script>
    ClassicEditor
        .create( document.querySelector( '#detail' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>
</body>
</html>
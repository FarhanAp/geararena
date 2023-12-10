<?php
    require('functionadmin.php');
    require "session.php";
    include "headeradmin.php";

    $queryCategory = mysqli_query($connect, "SELECT * FROM products_category");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product</title>
</head>

<body>

    <section class="container mt-2">
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAdd" aria-expanded="false" aria-controls="collapseAdd">
        insert new product
        </button>
    </section>

    <section class="container collapse mt-5" id="collapseAdd">
        <h6>Insert a New Product</h6>
        <form action="functionadmin.php" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group row mb-3">
                <label for="name">Product Name</label>
                <input type="text" name="Newproduct" id="Newproduct" class="form-control" required>
            </div>
            <div class="form-group row mb-3">
                <label for="inputCategory">Select Category</label>
                <select name="inputCategory" id="inputCategory" class="form-control" required>
                    <option value="">Choose 1 category</option>
                    <?php 
                        while ($data = mysqli_fetch_assoc($queryCategory)) { 
                    ?>
                        <option value="<?= $data["id"] ?>"> <?= $data["Name"] ?> </option>
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

    <section class="container mt-5">
        <table class="table table-striped">
            <thead class="table-dark text-center">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Seller Name</th>
                    <th scope="col">Product name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Category</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php loadProductList()?>
            </tbody>
        </table>
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
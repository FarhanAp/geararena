<?php
    require('function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href=
    "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />

    <link rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="forumpost.css">
</head>
<body>
    <section id="header">
        <a href="#"><img src="images/GEAR_ARENA_v2_80x80.png" class="logo"alt=""></a>

        <div>
            <ul id="navbar">
                <li><a href="marketplace.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a class="active" href="forum.php">Forum</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
            </ul>
        </div>
    </section>
    <h1>CREATE YOUR POST</h1>

    <!-- posting in here title & body of comment -->
    <?php loadForumCreatePost() ?>
    <!-- <form action="function.php" method="post">
        <section class="post-box" >
            <input type="text" name="title" placeholder="title in here">
            <textarea id="postin" placeholder="Whats on your mind?" name="postin" class="class_44"></textarea>
            <button class="class_46" name="posting">
                Post
            </button>
        </section>
    </form> -->


    <!-- using a wysiwyg editor the name is ckeditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

    <!-- script of wysiwyg must be put at the bottom of body html -->
    <script>
    ClassicEditor
        .create( document.querySelector( '#postin' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>
</body>
</html>
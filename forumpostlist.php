<?php
    require('function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum post list page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href=
    "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />

    <link rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="forumpostlist.css">
</head>
<body> 
    <section id="header">
        <a href="#"><img src="images/GEAR_ARENA_v2_80x80.png" class="logo"alt=""></a>

        <div>
            <ul id="navbar">
                <li><a href="marketplace.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a class="active" href="forum.php">Forum</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
            </ul>
        </div>
    </section>
    
    <!-- button to go to create post page -->
    <?php if (logged_in()):?>
        <?php postCreation()?>
    <?php else:?>
        <p>login or register to be able to post</p>
    <?php endif;?>
    <!-- <div class="floating-parent">
        <div class="float-text"> <a style="text-decoration:none" href="createpost.php?cid=1">create a post</a></div>
        <button class="right-button bi-pencil-square" onclick="document.location='createpost.php?cid=1'" ></button>      
    </div> -->
        <div class="container">
        <table class="table table-bordered text-center">
            <tr class="table-success">
                <td>ID</td>
                <td>Post</td>
                <td>Date</td>
            </tr>
            <tr>
                <?php loadForumPostList()?>
                <!-- <td>X</td>
                <td>XX</td> -->
            </tr>
        </table>
    </div>
    <h1>this is a forum post page</h1>
</body>
</html>
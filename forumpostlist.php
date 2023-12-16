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
        <div class="navbar-nav">
            <ul id="navbar" class="nav-item">
                <?php if(is_admin()):?>
                <li><a href="/geararena/adminpanel/index.php">Admin</a></li>
                <?php endif;?>
                <li><a href="marketplace.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a class="active" href="forum.php">Forum</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
                <?php if(logged_in()):?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#"> 
                        More
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="user.php" style="color: #0d6efd;"><i class="fa-solid fa-bag-shopping"> my order</i></a></li>
                        
                        <form action="function.php" method="post">
                            <li><button type="submit" name="logout" class="btn dropdown-item" style="color: #dc3545;"><i class="fa-solid fa-arrow-right-from-bracket"> logout</i></button></li>
                        </form>
                    </ul>
                </li>
                
                <?php else:?>
                <li><a href="login.php"><i class="fa-regular fa-user"></i></a></li>
                <?php endif;?>
            </ul>
        </div>
    </section>
    
    <!-- button to go to create post page -->
    <?php if (logged_in()):?>
        <?php postCreation()?>
    <?php else:?>
        <div class="container">
            <p class="text-center"><Strong>login or register to be able to post</Strong></p>
        </div>
    <?php endif;?>
    <!-- <div class="floating-parent">
        <div class="float-text"> <a style="text-decoration:none" href="createpost.php?cid=1">create a post</a></div>
        <button class="right-button bi-pencil-square" onclick="document.location='createpost.php?cid=1'" ></button>      
    </div> -->
        <div class="container">
        <h1>forum post page list</h1>
        <table class="table table-bordered text-center">
            <tr class="table-success">
                <td>ID</td>
                <td>Post</td>
                <td>Date</td>
            </tr>
            <tr>
                <?php loadForumPostList()?>
            </tr>
        </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
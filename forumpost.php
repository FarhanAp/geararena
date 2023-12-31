<?php
    require('function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forum post page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href=
    "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />

    <link rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" type="text/css" href="forumpost.css">
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

    <div class="container mt-2">
    <?php loadPost() ?>
    </div>
    <!-- <button data-open-modal>Open</button>
    
    <dialog data-modal>
        <form action="">
            <input type="text">
            <button type="submit" formmethod="dialog">Cancel</button>
            <button type="submit">submit</button>
        </form>
    </dialog> -->

    <!-- <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        edit
    </button> -->

    <?php if (logged_in()):?>
    <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REPLY</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <textarea name="text-box" style= "width: 100%; height: 100%;">supposed text</textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Change</button>
            </div>
            </div>
        </div>
    </div> -->
    <?php endif;?>

    <!-- <section class="comment-container"> -->
        <?php loadComment($_GET["postid"]) ?>
        <!-- <div class="reply-box border p-2 mb-2">
            <form action="function.php" method="post">
                <h5 class="border-bottom">Name</h5>
                <h6 class="mb-3">Date</h6>
                <p>this is some text</p>
                <input type="hidden" name="commentid">
                    <div class="action-button">
                        <button type="button" class="btn-outline-primary">edit</button>
                        <button type="button" class="btn btn-danger">Delete</button>
                    </div>
            </form>
        </div>
    </section>  -->
    <?php if (logged_in()):?>
        <?php createCommentBox($_GET["postid"]) ?>
        <!-- <form action="function.php" method="post">
            <div class="comment-box" >
                <div id="error_status"></div>
                <textarea id="comment" placeholder="Comment here" name="comment" class="class_44"></textarea>
                    <button name="commenting">
                        Comment
                    </button>
                <input type="hidden" name="postid" value="$_GET['postid']">
            </div>
        </form> -->
    <?php else:?>
        <div class="container">
            <p><Strong>login or register to be able to comment</Strong></p>
        </div>
    <?php endif;?>

    <!-- using a wysiwyg editor the name is ckeditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- script of wysiwyg must be put at the bottom of body html -->
    <script>
    ClassicEditor
        .create( document.querySelector( '#comment' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>
</body>
</html>
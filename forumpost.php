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

    <link rel="stylesheet" href="forumpostlist.css">
</head>
<body>

    <section id="header">
        <a href="#"><img src="images/GEAR_ARENA_v2_80x80.png" class="logo"alt=""></a>
        <div>
            <ul id="navbar">
                <li><a href="marketplace.php">Home</a></li>
                <li><a href="shop.html">Shop</a></li>
                <li><a class="active" href="forum.php">Forum</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="cart.html"><i class="fa-solid fa-cart-shopping"></i></a></li>
            </ul>
        </div>
    </section>

    <?php loadPost() ?>

    <section id="comment-list">
        <?php loadComment($_GET["postid"]) ?>
    </section>
    <!-- <ul>
        <li>This is the parent first comment!
            <ul>
                <li>This is the reply for the first parent comment!
                    <ul>
                        <li>This is a reply for the first reply of the parent comment!</li>
                        <li>This is a third reply for the first parent comment!</li>
                    </ul>
                </li>
                <li>This is another reply for first parent comment!</li>
            </ul>
        </li>
        <li>This is gonna be parent second comment!
            <ul>
                <li>This is a reply for the second comment!</li>
            </ul>
        </li>
        <li>This is third parent comment!</li>
    </ul> -->
    <?php if (logged_in()):?>
        <form action="function.php" method="post">
            <section class="comment-box" >
                <textarea id="comment" placeholder="Whats on your mind?" name="comment" class="class_44"></textarea>
                <button name="commenting">
                    Comment
                </button>
                <input type="hidden" name="postid" value="postid"/>
                <!-- parentid input only come when it reply to a comment -->
                <input type="hidden" name="parentid" value="parentid"/>
            </section>
        </form>
    <?php else:?>
        <p>login or register to be able to comment</p>
    <?php endif;?>

    <!-- using a wysiwyg editor the name is ckeditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

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
<?php
    require('function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>this is a test</h1>

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
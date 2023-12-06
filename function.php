<?php
include "dbconn.php";
session_start();

$connect = opencon();

//handle register
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["signup"])) {

    $username = addslashes($_POST["username"]);
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $password = mysqli_real_escape_string($connect, $_POST["pass"]);
    $cpw = mysqli_real_escape_string($connect, $_POST["conpass"]);
    $date = date("Y-m-d");

    // check if the email already exist or not
    if (isset($email)) {
        $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $query = mysqli_query($connect, $sql);
        $data = mysqli_fetch_assoc($query);
        if (!empty($data)) {
            echo "<span style='color:red'>This Email is alredy exists </span>";
        } else {
            if ($password === $cpw) {
        
                $password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (username, email, password, date) values('$username', '$email', '$password', '$date')";
                $query = mysqli_query($connect, $sql) or die (mysqli_error());
            
                if (isset($query)) {
                    echo"<script>
                            alert('account is succesfully created');
                        </script>";
                    header("Location: marketplace.php");
                } else {
                    echo mysqli_error($connect);
                }
            
            } else {
                echo "<span style='color:red'>password doesn't match </span>";
            }
        }
    } 
}

// handle login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["login"])) {

    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $password = mysqli_real_escape_string($connect, $_POST["pass"]);

    // query the email to see if there is a user
    $sql = "SELECT * FROM users WHERE email='$email' limit 1";
    $query = mysqli_query($connect, $sql);
    $data = mysqli_fetch_assoc($query);

    if (mysqli_num_rows($query) == 1) {
        if (password_verify($password, $data['password'])) {
            $_SESSION["id"] = $data["id"];
            $_SESSION['username'] = $data["username"];
            $_SESSION['type'] = $data["type"];
            if ($_SESSION['type'] == 0) {
                header("Location: marketplace.php");
            } else{
                echo "<script>alert('opening admin pannel')</script>";
                header("Location: /geararena/adminpanel/index.php");
            }
        } else {
            header("Location: login.php?user=notFound");
        }
    }
}

// finding out if a user login or not
function logged_in(){
    if (isset($_SESSION["id"])) {
        return true;
    }
    return false;
}

// handle forum category
function loadForumCategoryList(){
    $con = opencon();
    $sql = "SELECT * FROM forum_category ORDER BY id DESC";
    $query = mysqli_query($con, $sql);

    while($data = mysqli_fetch_assoc($query)){
        $cId = $data["id"];
        $cName = $data["name"];

        echo "
        <tr>
            <td> <a href=\"forumpostlist.php?cid=$cId\">$cId</a> </td>
            <td> <a href='forumpostlist.php?cid=$cId'>$cName</a> </td>
        </tr>
        ";
    }
}

//handle forum post list
function loadForumPostList(){
    $caId = $_GET["cid"];
    $con = opencon();
    $sql = "SELECT * FROM forum_posts WHERE category_id= '$caId' ORDER BY id DESC";
    $query = mysqli_query($con, $sql);

    if(mysqli_num_rows($query) > 0){
        while($data = mysqli_fetch_assoc($query)){
            $id = $data["id"];
            $title = $data["title"];
            $date = date("Y M jS", strtotime($data["inserted_at"]));
            echo "
            <tr>
                <td> <a href='forumpost.php?postid=$id'> $id</a> </td>
                <td>  <a href='forumpost.php?postid=$id'> $title</a> </td>
                <td>  <a href='forumpost.php?postid=$id'> $date</a> </td>
            </tr>
            ";
        }
    } else {
        // echo "<script>alert('no post found in this category')</script>";
        echo "<h1>no post found in this category</h1>";   
    }
}


//handle the button in creating a new post
function postCreation(){
    $con = opencon();
    $cid = $_GET["cid"];
    echo "
    <div class=\"floating-parent\">
    <div class=\"float-text\"> <a style=\"text-decoration:none\" href=\"createpost.php?cid=$cid\">create a post</a></div>
    <button class=\"right-button bi-pencil-square\" onclick=\"document.location='createpost.php?cid=$cid'\" ></button>      
    </div>
    ";
}


// handle creating forum post
function loadForumCreatePost(){
    $con = opencon();
    $user_id = $_SESSION["id"];
    $cid = $_GET["cid"];

    echo "
    <form action=\"function.php\" method=\"post\">
        <section class=\"post-box\" >
            <input type=\"text\" name=\"title\" placeholder=\"title in here\">
            <textarea id=\"postin\" placeholder=\"Whats on your mind?\" name=\"postin\" class=\"class_44\"></textarea>
            <button name=\"posting\">
                Post
            </button>
            <input type=\"hidden\" name=\"caId\" value=\"$cid\"/>
        </section>
    </form>
    ";
}

//handle posting in create post
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["posting"])){
    $user_id = $_SESSION["id"];
    $cid = $_POST["caId"];
    $title = addslashes($_POST["title"]);
    $txt = htmlspecialchars($_POST["postin"]);
    $date = date("Y-m-d H:i:s");

    if (empty($txt) || empty($user_id)) {
        echo "<script>alert('please insert text to post')</script>";
        echo '<script>document.location.href = "forum.php"</script>';
        return;
    } else{
        // insert the post
        $sql = "INSERT INTO forum_posts (user_id, category_id, title, body, inserted_at) VALUES ('$user_id', '$cid', '$title', '$txt', '$date')";
        $query = mysqli_query($connect, $sql);
        if (isset($query)) {
            echo "<script>alert('Your post was created successfully')</script>";
            echo "<script>document.location.href = 'forumpostlist.php?cid=$cid'</script>";
        }             
    }
}

// handle load the post in forum post
function loadPost(){
    $con = opencon();
    $postid = $_GET["postid"];
    $sql = "SELECT * FROM forum_posts WHERE id='$postid'";
    $query = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($query);
    $title = $data["title"];
    $body = htmlspecialchars_decode($data["body"]);

    if (mysqli_num_rows($query) > 0) {
        echo"
            <p>$title</p>
            <p>$body</P>
        ";
    }
}

// handle load the comment in forumpost
function loadComment($id)  {
    $con = opencon();
    // $sql = "SELECT * FROM forum_comments WHERE post_id='$id'";
    $sql = "SELECT users.id AS userid,
            forum_comments.id,
            username,
            text,
            inserted_at
            FROM forum_comments INNER JOIN users ON forum_comments.user_id = users.id 
            WHERE forum_comments.post_id='$id'";
    $query = mysqli_query($con, $sql);

    if ( mysqli_num_rows($query) > 0) {
        while (($data = mysqli_fetch_assoc($query)) != null) {
            $name = $data["username"];
            $date = $data["inserted_at"];
            $txt = htmlspecialchars_decode($data["text"]);
            $commid = $data["id"];

            if (logged_in()) {
                if ($_SESSION["type"] == 1) {
                    echo"<section class=\"comment-container\">
                            <div class=\"reply-box border p-2 mb-2\">
                                <h5 class=\"border-bottom\">$name</h5>
                                <h6 class=\"mb-3\">$date</h6>
                                <p>$txt</p>
                                    <div class=\"action-button\">
                                        <button name=\"edit\" type=\"submit\" class=\"btn btn-outline-primary\" onclick=\"document.location='editcomment.php?commid=$commid'\">
                                        edit
                                        </button>
                                        <form action=\"function.php\" method=\"post\">
                                            <input type=\"hidden\" name=\"commentid\" value=\"$commid\"/>
                                            <input type=\"hidden\" name=\"postid\" value=\"$id\"/>
                                            <button name=\"delete_comment\" type=\"submit\" class=\"btn btn-outline-danger\">Delete</button>
                                        </form>
                                    </div>       
                            </div>
                        </section> ";
                }
                elseif ($_SESSION["id"] == $data["userid"]) {
                    echo"<section class=\"comment-container\">
                            <div class=\"reply-box border p-2 mb-2\">
                                <h5 class=\"border-bottom\">$name</h5>
                                <h6 class=\"mb-3\">$date</h6>
                                <p>$txt</p>
                                    <div class=\"action-button\">
                                        <button name=\"edit\" type=\"submit\" class=\"btn btn-outline-primary\" onclick=\"document.location='editcomment.php?commid=$commid'\">
                                        edit
                                        </button>
                                        <form action=\"function.php\" method=\"post\">
                                            <input type=\"hidden\" name=\"commentid\" value=\"$commid\"/>
                                            <input type=\"hidden\" name=\"postid\" value=\"$id\"/>
                                            <button name=\"delete_comment\" type=\"submit\" class=\"btn btn-outline-danger\">Delete</button>
                                        </form>
                                    </div>       
                            </div>
                        </section> ";
                } else {
                    echo "<section class=\"comment-container\">
                    <div class=\"reply-box border p-2 mb-2\">
                        <h5 class=\"border-bottom\">
                        $name
                        </h5>
                        <h6 class=\"mb-3\">
                            $date
                        </h6>
                        <p>$txt</p>
                        <input type=\"hidden\" name=\"commentid\ value=\"$commid\">
                    </div>
                </section>";
                }
            } else {
                echo "<section class=\"comment-container\">
                    <div class=\"reply-box border p-2 mb-2\">
                        <h5 class=\"border-bottom\">
                        $name
                        </h5>
                        <h6 class=\"mb-3\">
                            $date
                        </h6>
                        <p>$txt</p>
                        <input type=\"hidden\" name=\"commentid\ value=\"$commid\">
                    </div>
                </section>";
            }
        }
    }
}

// creating edit page
function editComment($commid){
    $con = opencon();
    $user_id = $_SESSION["id"];
    $sql = "SELECT * FROM forum_comments WHERE id='$commid' limit 1";
    $query = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($query);
    $text = $data["text"];
    $postid = $data["post_id"];

    echo "
    <form action=\"function.php\" method=\"post\">
        <section class=\"post-box\" >
            <textarea id=\"commentin\" placeholder=\"Mutcho Texto\" name=\"commentin\">$text</textarea>
            <button name=\"editing\" type=\"submit\" class=\"btn btn-outline-primary\">
                Post
            </button>
            <input type=\"hidden\" name=\"commId\" value=\"$commid\"/>
            <input type=\"hidden\" name=\"postId\" value=\"$postid\"/>
        </section>
    </form>
    ";
}

// handle edit
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["editing"])) {
    $user_id = $_SESSION["id"];
    $type = $_SESSION["type"];
    $comment_id = $_POST["commId"];
    $post_id = $_POST["postId"];
    $txt = htmlspecialchars($_POST["commentin"]);

    if (empty($txt) || empty($user_id)) {
        echo "<script>alert('please insert text to post')</script>";
        echo '<script>document.location.href = "forum.php"</script>';
        return;
    } elseif ($type == 1) {
        $sql = "UPDATE forum_comments SET text ='$txt' WHERE id = '$comment_id' limit 1";
        $query = mysqli_query($connect, $sql);
        if (isset($query)) {
            echo "<script>alert('Your comment was editted successfully')</script>";
            echo "<script>document.location.href = 'forumpost.php?postid=$post_id'</script>";
        }
    } 
    else{
        // edit the comment
        $sql = "UPDATE forum_comments SET text ='$txt' WHERE user_id ='$user_id' && id = '$comment_id' limit 1";
        $query = mysqli_query($connect, $sql);
        if (isset($query)) {
            echo "<script>alert('Your comment was editted successfully')</script>";
            echo "<script>document.location.href = 'forumpost.php?postid=$post_id'</script>";
        }             
    }
}

// handle delete
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["delete_comment"])) {
    $userId = $_SESSION["id"];
    $commentId = $_POST["commentid"];
    $postId = $_POST["postid"];
    $sql = "DELETE FROM forum_comments WHERE id = '$commentId' && user_id = '$userId' limit 1";
    $query = mysqli_query($connect, $sql);

    if(!$query){
        echo mysqli_error($conn);
        die();
    }else{
        echo "<script>
            alert('deleted');
        </script>";
        header("Location: forumpost.php?postid=$postId");   
    }
    
}

// handle create comment box
function createCommentBox($id) {
    echo "
    <form action=\"function.php\" method=\"post\">
        <div class=\"comment-box\" >
            <textarea id=\"comment\" placeholder=\"Whats on your mind?\" name=\"comment\" class=\"class_44\"></textarea>
                <button name=\"commenting\" class=\"btn btn-outline-primary\">
                    Comment
                </button>
            <input type=\"hidden\" name=\"postid\" value=\"$id\"/>
        </div>
    </form>
";
}

// handle insert comment on post page
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["commenting"])){
    $user_id = $_SESSION["id"];
    $pid = $_POST["postid"];
    $txt = htmlspecialchars($_POST["comment"]);
    $date = date("Y-m-d H:i:s");

    $sql = "INSERT INTO forum_comments (user_id, post_id, text, inserted_at) VALUES ('$user_id', '$pid', '$txt', '$date')";
    $query = mysqli_query($connect, $sql);

    if($query){
        echo
        "<script>
            alert('COMMENT SUCSESSFUL');
        </script>";
        header("Location: forumpost.php?postid=$pid");
    }else{
        "<script>
            alert('SOMETHING WRONG');
        </script>";
    }
}

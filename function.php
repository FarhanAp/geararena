<?php

session_start();

$connect = opencon();
function opencon(){
    //create connection: server, user, password, database
    $connection = mysqli_connect("localhost", "root", "", "geararena"); 

    if(!$connection){
        die("failed to connect: ".mysqli_connect_error());
    }
    return $connection;
}

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
            header("Location: marketplace.php");
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
        echo '<script>document.location.href = "index.php"</script>';
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
    $sql = "SELECT users.id,
            parent_comment_id,
            username,
            text,
            inserted_at FROM forum_comments INNER JOIN users ON forum_comments.user_id = users.id WHERE forum_comments.post_id='$id'";
    $query = mysqli_query($con, $sql);

    if ( mysqli_num_rows($query) > 0) {
        while (($data = mysqli_fetch_assoc($query)) != null) {
            $name = $data["username"];
            $date = $data["inserted_at"];
            $txt = $data["text"];
            echo"
            <section class=\"comment-container\">
                <div class=\"reply-box border p-2 mb-2\">
                    <h5 class=\"border-bottom\">
                    $name
                    </h5>
                    <h6 class=\"mb-3\">
                        $date
                    </h6>
                    <p>$txt</p>
                    <button class=\"btn-primary reply-btn\">Reply</button>
                </div>
            </section>
            ";
        }
    }
}
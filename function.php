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
    $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
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
    } else {
        header("Location: login.php?user=notFound");
    }
}

// finding out if a user login or not
function logged_in(){
    if (isset($_SESSION["id"])) {
        return true;
    }
    return false;
}

// handle log out
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["logout"])) {

    session_destroy();
    echo "<script>
            alert('succesfully logout')
        </script>",
        "<script>
            document.location.href = 'marketplace.php'
        </script>";
    // header("Location:marketplace.php");
    exit;
}

// handle forum category list
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
    $sql = "SELECT * FROM forum_comments WHERE id='$commid' LIMIT 1";
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
        $sql = "UPDATE forum_comments SET text ='$txt' WHERE id = '$comment_id' LIMIT 1";
        $query = mysqli_query($connect, $sql);
        if (isset($query)) {
            echo "<script>alert('Your comment was editted successfully')</script>";
            echo "<script>document.location.href = 'forumpost.php?postid=$post_id'</script>";
        }
    } 
    else{
        // edit the comment
        $sql = "UPDATE forum_comments SET text ='$txt' WHERE user_id ='$user_id' && id = '$comment_id' LIMIT 1";
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
    $type = $_SESSION["type"];
    $commentId = $_POST["commentid"];
    $postId = $_POST["postid"];
    

    if ($type == 1) {
        $sql = "DELETE FROM forum_comments WHERE id = '$commentId' LIMIT 1";
        $query = mysqli_query($connect, $sql);
        
    } else {
        $sql = "DELETE FROM forum_comments WHERE id = '$commentId' && user_id = '$userId' LIMIT 1";
        $query = mysqli_query($connect, $sql);
    }

    if(!$query){
        echo mysqli_error($conn);
        die();
    }else{
        echo "<script>
                    alert('deleted the comment');
            </script>",
            "<script>
                document.location.href = 'forumpost.php?postid=$postId'
            </script>";   
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
        </script>",
        "<script>
            document.location.href = 'forumpost.php?postid=$pid'
        </script>";
    }else{
        echo
        "<script>
            alert('SOMETHING WRONG');
        </script>";
        echo mysqli_error($conn);
    }
}

// handle load product list
function loadProductList() {
    $con = opencon();
    $sql = "SELECT products.id AS PID,
    products_category.id AS PCID,
    Name,
    category_id,
    price,
    product,
    quantity,
    photo
    FROM products INNER JOIN products_category 
    ON category_id = products_category.id";
    $queryCategory = mysqli_query($con, $sql);

    while ( $data = mysqli_fetch_assoc($queryCategory)) {
        $idpro = $data['PID'];
        $photo = $data['photo'];
        $category = $data['Name'];
        $product = $data['product'];
        $quantity = $data['quantity'];
        $price = $data['price'];

        echo "<div class=\"pro\">
            <div class=\"products-wrapper\">
                <img src=\"../../gearproduct/image/products/$photo\" alt=\"product image\">
            </div>
            <div class=\"des\">
                <span>$category]</span>
                <h4>$product</h4>
                <div class=\"des\">
                    <h6>stocks:$quantity</h6>
                </div>
                <h4>RM $price</h4>
            </div>
            <a href=\"productdetail.php?idpro=$idpro\"><i class=\"fa-solid fa-cart-shopping\" style=\"color: #088178;\"></i></a>
        </div>";
    }
}

// handle load product category list
function loadProductCategoryList() {
    $con = opencon();
    $sql = "SELECT * FROM products_category";
    $query = mysqli_query($con, $sql);

    while ( $data = mysqli_fetch_assoc($query)){
        $cid = $data["id"];
        $cname = $data["Name"];
        echo "<a href=\"shop.php?category=$cid\" style=\"text-decoration: none;\">
                <li class=\"list-group-item\">$cname</li>
            </a>";
    }
}

function loadProductDetail($pid) {
    $con = opencon();
    $sql = "SELECT *, products.id AS PID, Name FROM products INNER JOIN products_category 
    ON category_id = products_category.id WHERE products.id='$pid' ";
    $query = mysqli_query($con, $sql);

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        $photo = $data["photo"];
        $category_name = $data["Name"];
        $product = $data["product"];
        $price = $data["price"];
        $quantity = $data["quantity"];
        $detail = htmlspecialchars_decode($data["detail"]);
        echo
        "<div class=\"single-pro-image\">
        <form action=\"cart.php?idpro=$pid\" method=\"post\">
            <img src=\"../../gearproduct/image/products/$photo\" width=\"100%\" id=\"MainImg\" alt=\"product\">
        </div>
 
            <div class=\"single-pro-details\">
                <h5 class=\"fw-bold\">$category_name</h5>
                <h2>$product</h2>
                <h3>RM $price</h3>
                <h5>Stock: $quantity</h5>
                <input type=\"number\" name=\"quantity\" value=\"1\" max=\"$quantity\" required>
                <button type=\"submit\" class=\"normal\" name=\"add_to_cart\">Add To Cart</button>
                <h4>Product Details</h4>
                <span class=\"fw-bold\">
                    $detail
                </span>

                <input type=\"hidden\" name=\"photo\" value=\"../../gearproduct/image/products/$photo\" class=\"form-control\">
                <input type=\"hidden\" name=\"product\" value=\"$product\" class=\"form-control\">
                <input type=\"hidden\" name=\"price\" value=\"$price\" class=\"form-control\">
            </div>
        </form>";
    } else {
        echo "data unavailable or error";
    }
}

function loadFeaturedProducts() {
    $con = opencon();
    $sql = "SELECT *, products.id AS PID,
    products_category.id AS PCID,
    Name
    FROM products INNER JOIN products_category 
    ON category_id = products_category.id ORDER BY products.id DESC";
    $query = mysqli_query($con, $sql);

    if (mysqli_num_rows($query)  != null) {
        while ($data = mysqli_fetch_assoc($query)) {
            $pid = $data["PID"];
            $photo = $data["photo"];
            $product = $data["product"];
            $price = $data["price"];
            $quantity = $data["quantity"];
            $detail = htmlspecialchars_decode($data["detail"]);
            echo"
            <div class=\"pro\">
                <div class=\"products-wrapper\">
                    <img src=\"../../gearproduct/image/products/$photo\" alt=\"featured-products-images\">
                </div>
                <div class=\"des\">
                    <h5>$product</h5>
                    <h5>Stock: $quantity</h5>
                    <h4>RM $price</h4>
                </div>
                <a href=\"productdetail.php?idpro=$pid\"><i class=\"fa-solid fa-cart-shopping\" style=\"color: #088178;\"></i></a>
            </div>";
        }
    }
}

// handle payment 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["payment"])) {
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    $uid = $_SESSION["id"];
    $state = $_POST["state"];
    $city = $_POST["city"];
    $address = $_POST["address"];
    $post_code = $_POST["postCode"];
    $legal_name = $_POST["legalName"];
    $cc_number = $_POST["ccNumber"];
    $cvv = $_POST["cvv"];
    $exp_year = $_POST["expYear"];
    $exp_month = $_POST["expMonth"];
    $total = $_POST["total"];
    $date = date("Y-m-d H:i:s");
    
    $sqlOrder = "INSERT INTO orders (user_id, state, city, address, post_code, legal_name, cc_number, cvv, expired_year, expired_month, total, created_at) 
                VALUES ('$uid',
                        '$state',
                        '$city',
                        '$address',
                        '$post_code',
                        '$legal_name',
                        '$cc_number',
                        '$cvv',
                        '$exp_year',
                        '$exp_month',
                        '$total',
                        '$date')";

    $queryOrder = mysqli_query($connect, $sqlOrder);

    if ($queryOrder) {
        $sqlOrderCall = "SELECT * FROM orders WHERE user_id = '$uid' ORDER BY order_id DESC LIMIT 1";
        $queryOrderCall = mysqli_query($connect, $sqlOrderCall);
        $dataCall = mysqli_fetch_assoc($queryOrderCall);
        $orderId = $dataCall["order_id"];

        for ($i=0; $i < count($_POST["idpro"]); $i++) { 
            $productId = $_POST["idpro"][$i];
            $quantity = $_POST["quantity"][$i];
            $price = $_POST["price"][$i];

            $sqlOrderItem = "INSERT INTO order_items (order_id, product_id, quantity, single_price) 
                            VALUES ('$orderId', '$productId', '$quantity', '$price')";
            $queryOrderItem = mysqli_query($connect, $sqlOrderItem);

            if ($queryOrderItem) {
                $sqlCheckStock = "SELECT quantity FROM products WHERE id ='$productId' LIMIT 1";
                $queryCheckStock = mysqli_query($connect, $sqlCheckStock);
                $dataCheck = mysqli_fetch_assoc($queryCheckStock);
                $qttCheck = $dataCheck["quantity"];
                $qttCheck = $qttCheck - $quantity;

                $sqlUpdateStock = "UPDATE products SET quantity ='$qttCheck' WHERE id = '$productId' LIMIT 1";
                $queryUpdateStock = mysqli_query($connect, $sqlUpdateStock);

                if ($queryUpdateStock) {
                    echo "<script>
                            alert('succesfully purchased')
                        </script>",
                        "<script>
                            document.location.href = 'marketplace.php'
                        </script>";
                }
            }
        }
    }

    // for ($i=0; $i < count($_POST["idpro"]); $i++) { 
    //     $productId = $_POST["idpro"][$i];
    //     $productName = $_POST["product"][$i];
    //     $quantity = $_POST["quantity"][$i];
    //     $price = $_POST["price"][$i];
        
    //     echo "<pre>";
    //     print_r ($productId); 
    //     echo "<br>";
    //     print_r ($productName);
    //     echo "<br>";
    //     print_r ($quantity); 
    //     echo "<br>";
    //     print_r ($price);
    //     echo "</pre>";
    // }

}
<?php
include "../dbconn.php";
session_start();

$connect = opencon();

// forum
function loadForumCategoryList(){
    $con = opencon();
    $sql = "SELECT * FROM forum_category ORDER BY id DESC";
    $query = mysqli_query($con, $sql);

    while($data = mysqli_fetch_assoc($query)){
        $cId = $data["id"];
        $cName = $data["name"];

        echo "
        <tr>
            <td> <a href=\"/geararena/forumpostlist.php?cid=$cId\">$cId</a> </td>
            <td> <a href='/geararena/forumpostlist.php?cid=$cId'>$cName</a> </td>
            <form action=\"functionadmin.php\" method=\"post\">

                <input type=\"hidden\" name=\"CFID\" value=\"$cId\">
                <input type=\"hidden\" name=\"CFName\" value=\"$cName\">
                <td><button name=\"EditCategory\" class=\"right-button btn btn-outline-success\"formaction=\"editcategoryforum.php\">Edit</button>

                <button name=\"deleteCF\" class=\"right-button btn btn-outline-danger\">Delete</button>
            </form>
            </td>
        </tr>
        ";
    }
}

function categoryForumCreation() {
    $con = opencon();
    echo "<div class=\"floating-parent\">
    <div class=\"float-text\"> <a style=\"text-decoration:none\" href=\"createnewcategory.php\">create new category</a></div>
    <button class=\"right-button bi-pencil-square\" onclick=\"document.location='createnewcategory.php'\" ></button>      
    </div>";
}

// users
function loadUsers() {
    $con = opencon();
    $sql = "SELECT * FROM users WHERE type != 1 ORDER BY id DESC";
    $query = mysqli_query($con, $sql);

    while($data = mysqli_fetch_assoc($query)){
        $Id = $data["id"];
        $Name = $data["username"];
        $Email = $data["email"];
        $Date = $data["date"];
        $Type = $data["type"];

        echo "
        <tr>
            <td>$Id</td>
            <td>$Name</td>
            <td>$Email</td>
            <td>$Date</td>
            <td>$Type</td>

            <form action=\"functionadmin.php\" method=\"post\">

                <input type=\"hidden\" name=\"UID\" value=\"$Id\">
                <input type=\"hidden\" name=\"UName\" value=\"$Name\">
                <input type=\"hidden\" name=\"Email\" value=\"$Email\">
                <input type=\"hidden\" name=\"Type\" value=\"$Type\">
                <td><button name=\"EditUser\" class=\"right-button btn btn-outline-success\"formaction=\"edituser.php\">Edit</button>

                <button name=\"deleteUSER\" class=\"right-button btn btn-outline-danger\">Delete</button></td>
            </form>
        </tr>
        ";
    }
}

//product category
function loadProductCategoryList() {
    $con = opencon();
    $sql = "SELECT * FROM products_category ORDER BY id DESC";
    $query = mysqli_query($con, $sql);

    if (mysqli_num_rows($query) == 0) {
        echo "<tr>
                <td colspan =\"3\">No Data Yet</td> 
            </tr>";
    } else {
        while($data = mysqli_fetch_assoc($query)){
            $cId = $data["id"];
            $cName = $data["Name"];
    
            echo "
            <tr>
                <td>$cId</td>
                <td>$cName</td>
                <form action=\"functionadmin.php\" method=\"post\">
    
                    <input type=\"hidden\" name=\"CPID\" value=\"$cId\">
                    <input type=\"hidden\" name=\"CPName\" value=\"$cName\">
                    <td><button name=\"EditCategoryProduct\" class=\"right-button btn btn-outline-success\"formaction=\"editcategoryproduct.php\">Edit</button>
    
                    <button name=\"deleteCP\" class=\"right-button btn btn-outline-danger\">Delete</button>
                </form>
                </td>
            </tr>
            ";
        }
    }
}

// forum category
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["CreateCF"])) {
    $user_id = $_SESSION["id"];
    $user_type = $_SESSION["type"];
    $category = htmlspecialchars($_POST["inputCategory"]);

    $check_exist = "SELECT * FROM forum_category WHERE (name) LIKE '%$category%'";
    $sql_check = mysqli_query($connect, $check_exist);


    if (mysqli_num_rows($sql_check) > 0) {
        echo "this category is already inserted";
    } 
    else {
        $query = "INSERT INTO forum_category (name) values('$category')";
        $sql = mysqli_query($connect, $query);
        header("Location: forumcategory.php");
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["deleteCF"])) {
    $category_forum = $_POST["CFID"];
    print_r($category_forum);
    $sql = "DELETE FROM forum_category WHERE id = '$category_forum' limit 1";
    $query = mysqli_query($connect, $sql);

    if(!$query){
        echo mysqli_error($connect);
        die();
    }else{
        header("Location: forumcategory.php");   
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["EditCF"])) {
    $category_id = $_POST["CID"];
    $category_name = htmlspecialchars($_POST["inputCategory"]);

    $check_exist = "SELECT * FROM forum_category WHERE (name) LIKE '%$category_name%'";
    $sql_check = mysqli_query($connect, $check_exist);

    if (!$sql_check) {
        echo mysqli_error($connect);
        die();
    }else {
        if (mysqli_num_rows($sql_check) > 0) {
            echo "this category is already exist";
        } else {
            $sql = "UPDATE forum_category SET name ='$category_name' WHERE id = '$category_id' limit 1";
            $query = mysqli_query($connect, $sql);
            header("Location: forumcategory.php");  
        } 
    }
}

// users
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["EditU"])) {
    $user_id = $_POST["UID"];
    $user_type = $_POST["UType"];
    $user_name = htmlspecialchars($_POST["inputName"]);
    $user_email = filter_var($_POST["UEmail"], FILTER_VALIDATE_EMAIL);

    $sql = "UPDATE users SET username ='$user_name', type='$user_type', email='$user_email' WHERE id ='$user_id' limit 1";
    $query = mysqli_query($connect, $sql);

    if (!$sql) {
        echo mysqli_error($connect);
        die();
    }else {
        echo "<script>
            document.location.href = 'users.php'
        </script>";  
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["deleteUSER"])) {
    $user_id = $_POST["UID"];
    $user_type = $_POST["Type"];

    if ($user_type == 0) {
        $sql = "DELETE FROM users WHERE id = '$user_id' && type = '$user_type' limit 1";
        $query = mysqli_query($connect, $sql);
        if(!$query){
            echo mysqli_error($conn);
            die();
        }else{
            echo "<script>
                        alert('user has been deleted');
                </script>",
                "<script>
                    document.location.href = 'users.php'
                </script>";   
        }
    } else {
        echo "<script>
                alert('CAN'T DELETE ADMIN');
            </script>";
    }

}

// product category
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["CreateCP"])) {
    $user_id = $_SESSION["id"];
    $user_type = $_SESSION["type"];
    $category = htmlspecialchars($_POST["inputCategory"]);

    $check_exist = "SELECT * FROM products_category WHERE (name) LIKE '%$category%'";
    $sql_check = mysqli_query($connect, $check_exist);


    if (mysqli_num_rows($sql_check) > 0) {
        echo "this category is already inserted";
    } 
    else {
        $query = "INSERT INTO products_category (name) values('$category')";
        $sql = mysqli_query($connect, $query);
        echo "<script>
                document.location.href = 'marketplacedetail.php'
            </script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["EditCP"])) {
    $category_id = $_POST["CID"];
    $category_name = htmlspecialchars($_POST["inputCategory"]);

    $check_exist = "SELECT * FROM products_category WHERE (name) LIKE '%$category_name%'";
    $sql_check = mysqli_query($connect, $check_exist);

    if (!$sql_check) {
        echo mysqli_error($connect);
        die();
    }else {
        if (mysqli_num_rows($sql_check) > 0) {
            echo "<script>
                    alert('this category is already exist');
                </script>",
                "<script>
                    document.location.href = 'marketplacedetail.php'
                </script>";

        } else {
            $sql = "UPDATE products_category SET name ='$category_name' WHERE id = '$category_id' limit 1";
            $query = mysqli_query($connect, $sql);
            header("Location: marketplacedetail.php");  
        } 
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["deleteCP"])) {
    $category_forum = $_POST["CPID"];
    $sql = "DELETE FROM products_category WHERE id = '$category_forum' limit 1";
    $query = mysqli_query($connect, $sql);

    if(!$query){
        echo mysqli_error($connect);
        die();
    }else{
        echo
        "<script>
            document.location.href = 'marketplacedetail.php'
        </script>";  
    }
}
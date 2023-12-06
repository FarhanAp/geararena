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
    $sql = "SELECT * FROM users ORDER BY id DESC";
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

                <input type=\"hidden\" name=\"CFID\" value=\"$Id\">
                <input type=\"hidden\" name=\"CFName\" value=\"$Name\">
                <td><button name=\"EditCategory\" class=\"right-button btn btn-outline-success\"formaction=\"edituser.php\">Edit</button>

                <button name=\"deleteUSERS\" class=\"right-button btn btn-outline-danger\">Delete</button>
            </form>
            </td>
        </tr>
        ";
    }
}


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
        echo mysqli_error($conn);
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
        echo mysqli_error($conn);
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
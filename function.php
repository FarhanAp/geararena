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

// handle forum category
function loadForumCategory(){
    $con = opencon();
    $sql = "SELECT * FROM forum_category ORDER BY id DESC";
    $query = mysqli_query($con, $sql);

    while($data = mysqli_fetch_assoc($query)){
        $cId = $data["id"];
        $cName = $data["name"];

        echo "
        <tr>
            <td> <a href=\"forumpost.php?cid=$cId\">$cId</a> </td>
            <td> <a href='forumpost.php?id=$cId'>$cName</a> </td>
        </tr>
        ";
    }
}

//handle forum post
function loadForumPost(){
    $caId = $_GET["cid"];
    $con = opencon();
    $sql = "SELECT * FROM forum_posts WHERE category_id= '$caId' ORDER BY id DESC";
    $query = mysqli_query($con, $sql);


    if(mysqli_num_rows($query) > 0){
        while($data = mysqli_fetch_assoc($query)){
            echo "
            <tr>
                <td> X </td>
                <td> XX </td>
            </tr>
            ";
        }
    } else {
        echo "<script>alert('no post found in this category')</script>";
        echo "<h1>no post found in this category</h1>";
        
    }

}
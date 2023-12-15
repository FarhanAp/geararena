<?php 
    require 'function.php';
    include 'header.php';

    $user_id = $_SESSION["id"];
    $count = 1;

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET["myorder"])) { 
        $seller = array();
        $product = array();
        $quantity = array();
        $invoiceid = array();
        $total = array();
        $payDate = array();
        $price = array();

        $sql = "SELECT o.*, oi.*, p.product, u.username FROM orders o 
        INNER JOIN order_items oi ON o.order_id = oi.order_id
        INNER JOIN products p ON oi.product_id = p.id
        INNER JOIN users u ON p.users_id = u.id
        WHERE o.user_id = '$user_id'";

        $query = mysqli_query($connect, $sql);
        while ($dataTest = mysqli_fetch_assoc($query)) {
            array_push($seller, $dataTest['username']);
            array_push($product, $dataTest['product']);
            array_push($quantity, $dataTest['quantity']);
            array_push($invoiceid, $dataTest['order_id']);
            array_push($total, $dataTest['total']);
            array_push($payDate, date("Y M jS H:i:s", strtotime($dataTest["created_at"])));
            array_push($price, $dataTest['single_price']);

            // echo "<pre>";
            // print_r($dataTest);
            // echo "</pre>";
        }
        mysqli_data_seek($query, 0);
        mysqli_free_result ($query);
    }  elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET["mypost"])) {
        $sql = "";
    } 
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="user.css">
</head>
<body>

    <section id="header">
        <a href="#"><img src="images/GEAR_ARENA_v2_80x80.png" class="logo"alt=""></a>
        <div class="navbar-nav">
            <ul id="navbar" class="nav-item">
                <li><a href="marketplace.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="forum.php">Forum</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
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

    <div class="container-fluid mt-5">
    
        <div class="row d-flex justify-content-center">

            <div class="col-md-7">
                <div class="card p-3 py-4">
            
                    <div class="text-center mt-3">
                        <?= loadUserData() ?>
                        
                        <ul class="action-list">
                            <li><a href="user.php?myorder">ORDER</a></li>
                            <li><a href="user.php?mypost">POST</a></li>
                            <li><a href="user.php?mycomment">COMMENT</a></li>
                        </ul>
                        
                        <?php if (isset($_GET["myorder"])): ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Products</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Seller</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Invoice No</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i=0; $i < count($product); $i++) : ?>
                                        <tr>
                                            <th scope="row"><?= $count ?></th>
                                            <td><?= $product[$i] ?></td>
                                            <td><?= $price[$i] ?></td>
                                            <td><?= $quantity[$i] ?></td>
                                            <td><?= $seller[$i] ?></td>
                                            <td><?= $total[$i] ?></td>
                                            <td><?= $payDate[$i] ?></td>
                                            <td><?= $invoiceid[$i] ?></td>
                                        </tr>
                                        <?php $count += 1?>
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                        
                        <!-- <div class="buttons">
                            <button class="btn btn-outline-primary px-4">Message</button>
                            <button class="btn btn-primary px-4 ms-3">Contact</button>
                        </div>           -->
                    </div>    
                </div>         
            </div>      
        </div>  
    </div>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
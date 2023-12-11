<?php
    require('function.php');
    require 'header.php';

    $iscategory = false;
    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['category'])){
        $iscategory = true;
        $sql = "SELECT *, products.id AS PID, Name FROM products INNER JOIN products_category 
        ON category_id = products_category.id
        WHERE category_id = '$_GET[category]'";
        $queryCat = mysqli_query($connect, $sql);

        $countPro = mysqli_num_rows($queryCat);
        // $data = mysqli_fetch_assoc($queryCat);
        // print_r ($data);
        // die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gear Arena Marketplace</title>
    <link rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="marketplace.css">
</head>

<body>

    <section id="header">
        <a href="#"><img src="images/GEAR_ARENA_v2_80x80.png" class="logo"alt=""></a>

        <div>
            <ul id="navbar">
                <li><a href="marketplace.php">Home</a></li>
                <li><a class="active" href="shop.php">Shop</a></li>
                <li><a href="forum.php">Forum</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="cart.html"><i class="fa-solid fa-cart-shopping"></i></a></li>
            </ul>
        </div>
    </section>

    <section id="page-header">
        <h2>#STAY GAMING</h2>
        <p>Be Our Patrons</p>
    </section>

    <section class="container mt-2">
        <div class="row">
            <div>
                <ul class="list-group text-center">
                    <?= loadProductCategoryList() ?>
                    <!-- <a href="shop.php?category=">
                        <li class="list-group-item">An item</li>
                    </a> -->
                </ul>
            </div>
        </div>
    </section>

    <section id="product1" class="section-p1">
        <h3 class="">product</h3>
        <div class="pro-container">
 
            <?php if ($iscategory == true): ?>
                <?php if ($countPro <= 0): ?>
                    <div class="alert alert-warning center-block" role="alert">
                    The product you are looking for is not available
                    </div>
                <?php endif; ?>
                <?php while ($data = mysqli_fetch_assoc($queryCat)): ?>
                    <div class="pro">
                        <div class="products-wrapper">
                            <img src="../../gearproduct/image/products/<?= $data['photo'] ?>" alt="product image">
                        </div>
                        <div class="des">
                            <span><?= $data['Name'] ?></span>
                            <h4><?= $data['product'] ?></h4>
                            <div class="des">
                                <h6>stocks:<?= $data['quantity'] ?></h6>
                            </div>
                            <h4>RM <?= $data['price'] ?></h4>
                        </div>
                        <a href="productdetail.php?idpro=<?= $data['PID'] ?>"><i class="fa-solid fa-cart-shopping" style="color: #088178;"></i></a>
                    </div>
                <?php endwhile;?>
            <?php else:?>
                <?php loadProductList();?>
            <?php endif; ?>
            <!-- <div class="pro">
                <div class="products-wrapper">
                    <img src="images/product/product1.jpg" alt="">
                </div>
                <div class="des">
                    <span>Logitech</span>
                    <h5>Keyboard Gaming </h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>RM220</h4>
                </div>
                <a href="#"><i class="fa-solid fa-cart-shopping" style="color: #088178;"></i></a>
            </div> -->
        </div> 
    </section>

    <section id="pagination" class="section-p1">
        <a href="#">1</a>
        <a href="#">2</a>
        <a href="#"><i class="fa-solid fa-arrow-right"></i></a>
    </section>

    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Sign Up For Newsletter</h4>
            <p>Get E-Mail updates about our latest shop and <span>special offers.</span>
            </p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your email address">
            <button class="normal">Sign Up</button>
        </div>
    </section>

    <footer class="section-p1">
        <div class="col">
            <img class="logo" src="images/GEAR_ARENA_v2_80x80.png" alt="">
            <h4> Contact</h4>
            <p><strong>Address: </strong> Jalan Mayor Oking Citeureup Bogor</p>
            <p><strong>Phone:</strong>+62 85933659692</p>
            <p><strong>Hours:</strong> 10:00 - 21:00, Mon - Sat</p>
            <div class="follow">
                <h4>Follow Us</h4>
                <div class="icon">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-pinterest-p"></i>
                    <i class="fab fa-youtube"></i>
                </div>
            </div>
        </div>

        <div class="col">
            <h4>about</h4>
            <a href="#">About Us</a>
            <a href="#">Delivery Information</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms & Conditions</a>
            <a href="#">Contact Us</a>
        </div>

        <div class="col">
            <h4>My Account</h4>
            <a href="#">Sign In</a>
            <a href="#">View Cart</a>
            <a href="#">My Wishlist</a>
            <a href="#">Track My Order</a>
            <a href="#">Help</a>
        </div>

        <div class="col install">
            <h4>Install App</h4>
            <p>From App Store or Google Play</p>
            <div class="row">
                <img src="images/pay/app.jpg" alt="">
                <img src="images/pay/play.jpg" alt="">   
            </div>
            <p>Secured Payment Gateways</p>
            <img src="images/pay/pay.png" alt="">
        </div>

        <div class="copyright">
            <p>2023, Farhan-Faniyalno - Gear Arena</p>
        </div>
    </footer>



    <script src="script.js"></script>
</body>
</html>
<?php
    require('function.php');
    // require 'header.php';

    $queryCategory = mysqli_query($connect,"SELECT products.id AS PID,
                                            products_category.id AS PCID,
                                            Name,
                                            category_id,
                                            price,
                                            product,
                                            quantity,
                                            photo
                                            FROM products INNER JOIN products_category 
                                            ON category_id = products_category.id ORDER BY PID DESC LIMIT 5");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gear Arena Marketplace</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="marketplace.css">
</head>

<body>

    <section id="header">
        <a href="#"><img src="images/GEAR_ARENA_v2_80x80.png" class="logo"alt=""></a>

        <div>
            <ul id="navbar">
                <li><a class="active" href="marketplace.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="forum.php">Forum</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
                <?php if(logged_in()):?>
                <form action="function.php" method="post">
                    <li><button type="submit" name="logout" class="btn"><i class="fa-solid fa-arrow-right-from-bracket"></i></button></li>
                </form>
                <?php else:?>
                <li><a href="login.php"><i class="fa-regular fa-user"></i></a></li>
                <?php endif;?>
            </ul>
        </div>
    </section>

    <section id="hero">
        <h4>Marketplace Gaming Terbaik</h4>
        <h2>Selling Good Items</h2>
        <h1>For All Gaming Gear</h1>
        <p>BE OUR PATRONS</p>
        <button>Shop Now</button>
    </section>

    <section id="feature" class="section-p1">
        <div class="fe-box">
            <img src="images/features/f1.png" alt="">
            <h6>Free Shipping</h6>
        </div>
        <div class="fe-box">
            <img src="images/features/f2.png" alt="">
            <h6>Online Order</h6>
        </div>
        <div class="fe-box">
            <img src="images/features/f3.png" alt="">
            <h6>Save Money</h6>
        </div>
        <div class="fe-box">
            <img src="images/features/f4.png" alt="">
            <h6>Promotion</h6>
        </div>
        <div class="fe-box">
            <img src="images/features/f5.png" alt="">
            <h6>Happy Sell</h6>
        </div>
        <div class="fe-box">
            <img src="images/features/f6.png" alt="">
            <h6>24/7 Support</h6>
        </div>
    </section>

    
    <section id="product1" class="section-p1">
        <h2> Featured Product</h2>
        <p> Gaming New Collection </p>
        <div class="pro-container">
            <?php while ( $data = mysqli_fetch_assoc($queryCategory)) { ?>
            <form action="cart.php?idpro=<?= $data["PID"]?>" method="post">

                <div class="pro">

                    <div class="products-wrapper" >
                    <a href="productdetail.php?idpro=<?= $data["PID"] ?>">
                        <img src="../../gearproduct/image/products/<?= $data["photo"] ?>" alt="product image">
                    </a>
                    </div>
                    
                    <div class="des">
                    <span><?= $data["Name"] ?></span>
                    <h4><?= $data["product"] ?></h4>
                        <div class="des">
                            <h6>stocks: <?= $data["quantity"] ?></h6>
                        </div>
                    <h4>RM<?= $data["price"] ?></h4>
                    </div> 
                    
                    <input type="hidden" name="photo" value="../../gearproduct/image/products/<?= $data["photo"] ?>" class="form-control">
                    <input type="hidden" name="product" value="<?=$data["product"]?>" class="form-control">
                    <input type="hidden" name="price" value="<?=$data["price"]?>" class="form-control">
                    <input type="hidden" name="quantity" value="1"  class="form-control">
                    
                    <button class="btn" type="submit" name="add_to_cart"><i class="fa-solid fa-cart-shopping" style="color: #088178;"></i></button>
                    
      
                </div>
            </form>
            <?php } ?>

            <!-- <div class="pro">
                <div class="products-wrapper">
                    <img src="images/product/ath-m50.png" alt="">
                </div>
                <div class="des">
                    <span>Audio Technica</span>
                    <h5>Headphone</h5>
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

    <section id="banner" class="section-m1"> 
        <h4>Best Quality</h4>
        <h2>Up to <span>70% OFF</span> - All Gaming Gear </h2>
        <button class="normal">Explore More</button>
    </section>

    <section id="sm-banner" class="section-p1">
        <div class="banner-box">
            <h4>Hot Deals</h4>
            <h2>Buy 1 Get 1 Free</h2>
            <span>The Best Gaming Gear On Town</span>
            <button class="white">Learn More</button>
        </div>
        <div class="banner-box banner-box2">
            <h4>Crazy Deals</h4>
            <h2>70% Discount </h2>
            <span>The Best Gaming Gear On Town</span>
            <button class="white">Collection</button>
        </div>
    </section>

    <section id="banner3">
        <div class="banner-box">
            <h2>WINTER SALE </h2>
            <h3>Winter Got Discount 70% OFF</h3>
        </div>
        <div class="banner-box banner-box2">
            <h2>YELLOW SALE </h2>
            <h3>40% OFF YELLOW GEAR </h3>
        </div>
        <div class="banner-box banner-box3">
            <h2>SUMMER SALE </h2>
            <h3> Got Discount 70% OFF</h3>
        </div>
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
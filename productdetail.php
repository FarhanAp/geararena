<?php
    require('function.php');
    require 'header.php';
    // $_GET["idpro"];
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
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
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

    <section id="prodetails" class="section-p1">
        <?= loadProductDetail($_GET["idpro"])?>
        <!-- <div class="single-pro-image">
            <img src="images/product/product1.jpg" width="100%" id="MainImg" alt=""> -->

            <!-- <div class="small-img-group">
                <div class="small-img-col">
                    <img src="images/product/product1.jpg" width="100%" class="small-img" alt="">
                </div>
                <div class="small-img-col">
                    <img src="images/product/product1(2).jpg" width="100%" class="small-img" alt="">
                </div>
                <div class="small-img-col">
                    <img src="images/product/product1(3).webp" width="100%" class="small-img" alt="">
                </div>
                <div class="small-img-col">
                    <img src="images/product/product1(4).jpg" width="100%" class="small-img" alt="">
                </div>
            </div> 
        </div> -->

        <!-- <div class="single-pro-details">
            <h6>LOGITECH G213</h6>
            <h4>KEYBOARD GAMING</h4>
            <h2>RM220</h2>
            <select>
                <option>Select Colour</option>
                <option>Red</option>
                <option>Black</option>
                <option>White</option>
                <option>Yellow</option>
                <option>Blue</option>
            </select>
            <input type="number" value="1">
            <button class="normal">Add To Cart</button>
            <h4>Product Details</h4>
            <span>The G213 gaming keyboard features Logitech G Mech-Dome keys that are specially tuned
                 to deliver a superior tactile response and overall performance profile similar to a mechanical keyboard. 
                 Mech-Dome keys are full height, deliver a full 4 mm travel distance, 50 g actuation force, and a quiet sound operation.
            </span>
        </div> -->
    </section>

    <section id="product1" class="section-p1">
        <h2> Featured Product</h2>
        <p> Gaming New Collection </p>
        <div class="pro-container">
            <?= loadFeaturedProducts()?>
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

    <!-- <script>
        var MainImg = document.getElementById("MainImg");
        var smallimg = document.getElementsByClassName("small-img");

        smallimg[0].onclick = function(){
            MainImg.src = smallimg[0].src;
        }
        smallimg[1].onclick = function(){
            MainImg.src = smallimg[1].src;
        }
        smallimg[2].onclick = function(){
            MainImg.src = smallimg[2].src;
        }
        smallimg[3].onclick = function(){
            MainImg.src = smallimg[3].src;
        }
    </script> -->


    <script src="script.js"></script>
</body>
</html>
<?php 
    require 'function.php';
    require 'header.php'; 
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
        <div class="navbar-nav">
            <ul id="navbar" class="nav-item">
                <?php if(is_admin()):?>
                <li><a href="/geararena/adminpanel/index.php">Admin</a></li>
                <?php endif;?>
                <li><a href="marketplace.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="forum.php">Forum</a></li>
                <li><a href="about.php">About</a></li>
                <li><a class="active" href="contact.php">Contact</a></li>
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

    <section id="page-header" class="about-header">
        <h2>#lets_Talk</h2>
        <p>LEAVE A MESSAGE, We love to hear from you</p>
    </section>

    <section id="contact-details" class="section-p1">
        <div class="details">
        <span>GET IN TOUCH</span>
        <h2>Visit one of our agency locations or contact us today</h2>
        <h3>Head Office</h3>
        <div>
            <li>
                <i class="fa fa-road" aria-hidden="true"></i>
                <p>26, Jalan SS 15/6 Subang jaya Selangor</p>
            </li>
            <li>
                <i class="fa fa-address-book" aria-hidden="true"></i>
                <p>farhanaldisyah@gmail.com</p>
            </li>
            <li>
                <i class="fa fa-address-book" aria-hidden="true"></i>
                <p>faniyalnoarkan@gmail.com</p>
            </li>
            <li>
                <i class="fa fa-hourglass-end" aria-hidden="true"></i>
                <p>Monday to Saturday: 9.00am to 16.pm</p>
            </li>
        </div>
    </div>

    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m1
        2!1m3!1d3984.063545441655!2d101.58872724000462!3d3.077708296910
        8815!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc4c
        5e6a0c6887%3A0x7dd06f9999f18709!2s26%2C%20Jalan%20SS%2015%2F6%2C%20
        Ss%2015%2C%2047500%20Subang%20Jaya%2C%20Selangor!5e0!3m2!1sen!2smy!4v
        1701500944805!5m2!1sen!2smy" width="600" height="450" style="border:0;" 
        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

    </div>
    </section>

    <section id="form-details">
        <form action="">
            <span>LEAVE A MESSAGE</span>
            <h2>We love to hear from you</h2>
            <input type="text" placeholder="Your Name">
            <input type="text" placeholder="E-mail">
            <input type="text" placeholder="Subject">
            <textarea name="" id="" cols="30" rows="10" placeholder="Your Message"></textarea>
            <button class="normal">Submit</button>
        </form>

        <div class="people">
            <div>
                <img src="images/FARHANAP.jpg" alt="">
                <p><span>MUHAMAD FARHAN ALDISYAH PUTRA</span> FRONT END DEVELOPER <br> Phone: +60 11-2763-7955
                <br>Email: farhanaldisyah@gmail.com </p>
            </div>
            <div>
                <img src="images/FANIYALNO.jpg" alt="">
                <p><span>FANIYALNO ARKAN RAHMAN</span> BACK END DEVELOPER <br> Phone: +60 878-8806-2016
                <br>Email: faniyalnoarkan@gmail.com </p>
            </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="script.js"></script>
</body>
</html>
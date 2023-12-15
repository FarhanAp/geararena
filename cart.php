<?php 
    require 'function.php';
    require 'header.php';

    $total = 0;

    if (!isset($_SESSION["id"])) {
        echo "<script> 
                document.location.href = 'marketplace.php'
            </script>";
    }

    if (isset($_POST["add_to_cart"])) {
        if (isset($_SESSION["cart"])) {
            $session_array_id = array_column($_SESSION['cart'],"id");

            if (!in_array($_GET['idpro'], $session_array_id)) {
                $session_array = array(
                    "idpro" => $_GET['idpro'],
                    "photo" => $_POST['photo'],
                    "product" => $_POST['product'],
                    "price" => $_POST['price'],
                    "quantity" => $_POST['quantity'],
                );
                $_SESSION['cart'][] = $session_array;
            }
        } else {
            $session_array = array(
                "idpro" => $_GET['idpro'],
                "photo" => $_POST['photo'],
                "product" => $_POST['product'],
                "price" => $_POST['price'],
                "quantity" => $_POST['quantity'],
            );
            $_SESSION['cart'][] = $session_array;
        }
        echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";
    }

    if (isset($_GET['action'])) {
        if ($_GET['action'] == "remove") {

            foreach ($_SESSION['cart'] as $key => $value) {

                // echo "<pre>";
                // print_r ($value);
                // echo "</pre>";
                
                if ($value["idpro"] == $_GET["idpro"]) {
                    // echo "<pre>";
                    // print_r ($key);
                    // echo "</pre>";
                    unset($_SESSION['cart'][$key]);
                }
            }
        }
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
        <div class="navbar-nav">
            <ul id="navbar" class="nav-item">
                <li><a href="marketplace.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="forum.php">Forum</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a class="active" href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
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

    <section id="page-header">
        <h2>#STAY GAMING</h2>
        <p>Be Our Patrons</p>
    </section>

<form action="payment.php" method="post">

    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Remove</td>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($_SESSION['cart'])):?>
                    <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                        <tr>
                            <td><a href="cart.php?action=remove&idpro=<?=$value["idpro"]?>"><i class="far fa-times-circle"></i></a></td>
                            <td><img src="<?=$value["photo"]?>" alt=""></td>
                            
                            <td><?=$value["product"]?></td>
                            <td>RM<?=$value["price"]?></td>
                            <td><input type="number" readonly value="<?=$value["quantity"]?>"></td>
                            <td>RM <?=number_format($value["price"] * $value["quantity"], 2)?></td>
                        </tr>
                        
                        
                        <?php $total = $total + $value["quantity"] * $value["price"]; } ?>
                <?php endif; ?>
                <!-- <tr>
                    <td><a href="#"><i class="far fa-times-circle"></i></a></td>
                    <td><img src="images/product/product1.jpg" alt=""></td>
                    <td>Logitech Keyboard G213</td>
                    <td>RM220</td>
                    <td><input type="number" readonly value="1"></td>
                    <td>RM220</td>
                </tr> -->
            </tbody>
        </table>
    </section>

    <section id="cart-add" class="section-p1">

        <div id="subtotal">
            <h3>Cart Totals</h3>
            <table>
               <tr>
                    <td>Cart Subtotal</td>
                    <td>RM <?= $total ?></td>
               </tr>
               <tr>
                    <td>Shipping</td>
                    <td>Free</td>
               </tr>
               <tr>
                    <td><strong>TOTAL</strong></td>
                    <td><strong>RM <?= $total ?></strong></td>
               </tr> 
            </table>

            
            <input type="hidden" name="total" value="<?=$total?>" class="form-control">
            <button type="submit" class="normal" name="checkout">Proceed to checkout</button>
        </div>
    </section>
</form>
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
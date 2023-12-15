<?php 
    require 'function.php';

    $idpro = array();
    $pro_name = array();
    $quantity = array();
    $price = array();
    $total;
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["checkout"])) {
        $total = $_POST["total"];
        // echo"$total";
        // echo"<br>";
        // echo "<pre>";
        // print_r($_SESSION['cart']);
        // echo "</pre>";
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["payment"])) {
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
    }

    foreach ($_SESSION['cart'] as $key => $value) {
        array_push($idpro, $value['idpro']);
        array_push($pro_name, $value['product']);
        array_push($quantity, $value['quantity']);
        array_push($price, $value['price']);
    }

    // echo "<pre>";
    // print_r($_SESSION['username']);
    // echo "</pre>";

    // print_r($idpro);
    // echo"<br>";
    // print_r($pro_name);
    // echo"<br>";
    // print_r($quantity);
    // echo"<br>";
    // print_r($price);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="payment.css">

</head>
<body>

<div class="container">

    <section id="header">
        <a href="#"><img src="images/GEAR_ARENA_v2_80x80.png" class="logo"alt=""></a>
        <div>
            <ul id="navbar">
                <li><a href="marketplace.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="forum.php">Forum</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a class="active" href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
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


   

</div>  


<div class="card-payment"> 
<form action="function.php" method="post">
        <div class="row">
            <div class="col">
                <h3 class="title">billing address</h3>

                <div class="inputBox">
                    <span>username :</span>
                    <input type="text" name="name" placeholder="Jane Doe" value="<?= $_SESSION['username'] ?>">
                </div>

                <div class="inputBox">
                    <span>address :</span>
                    <input type="text" name="address" placeholder="No - Street" required>
                </div>

                <div class="inputBox">
                    <span>city :</span>
                    <input type="text" name="city" placeholder="Subang Jaya" required>
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>state :</span>
                        <input type="text" name="state" placeholder="Selangor" required>
                    </div>
                    <div class="inputBox">
                        <span>post code :</span>
                        <input type="text" name="postCode" placeholder="47500" required>
                    </div>
                </div>

            </div>

            <div class="col">

                <h3 class="title">payment</h3>

                <div class="inputBox">
                    <span>cards accepted :</span>
                    <img src="images/card_img.png" alt="">
                </div>
                <div class="inputBox">
                    <span>name on card :</span>
                    <input type="text" name="legalName" placeholder="mr. farhan ap" required>
                </div>
                <div class="inputBox">
                    <span>credit card number :</span>
                    <input type="number" name="ccNumber" placeholder="1111-2222-3333-4444" required>
                </div>
                <div class="inputBox">
                    <span>expired month :</span>
                    <input type="text" name="expMonth" placeholder="january" required>
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>expired year :</span>
                        <input type="number" name="expYear" placeholder="2022" required>
                    </div>
                    <div class="inputBox">
                        <span>CVV :</span>
                        <input type="text" name="cvv" placeholder="1234" required>
                    </div>
                </div>

            </div>
        </div>
        <?php for ($i=0; $i < count($pro_name); $i++) { ?>
            <input type="hidden" name="idpro[]" value="<?=$idpro[$i]?>">
            <input type="hidden" name="product[]" value="<?=$pro_name[$i]?>">
            <input type="hidden" name="quantity[]" value="<?=$quantity[$i]?>">
            <input type="hidden" name="price[]" value="<?=$price[$i]?>">
            
            <?php } ?>
            <input type="hidden" name="total" value="<?=$total?>">
        <button type="submit" name="payment" class="submit-btn">proceed to payment</button>
    </form>
</div>


    
</body>
</html>
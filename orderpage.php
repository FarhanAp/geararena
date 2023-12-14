<?php 
    include "function.php";
    include "header.php";


    $total;
    if (isset($_GET['orderid'])) {
        $oid = $_GET['orderid'];
        $sql = "SELECT o.*, oi.*, p.product  FROM orders o
        LEFT JOIN order_items oi ON o.order_id = oi.order_id
        INNER JOIN products p ON oi.product_id = p.id
        WHERE o.order_id = '$oid'";
        $query = mysqli_query($connect, $sql);

        // while ($dataTest = mysqli_fetch_assoc($query)) {
        //     echo "<pre>";
        //     print_r($dataTest);
        //     echo "</pre>";
        // }
        // mysqli_data_seek($query, 0);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Page</title>

    <link rel="stylesheet" href="header.css">
</head>
<body>

    <section id="header">
        <a href="#"><img src="images/GEAR_ARENA_v2_80x80.png" class="logo"alt=""></a>
        <div>
            <ul id="navbar">
                <li><a href="marketplace.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="forum.php">Forum</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
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

    <div class="container-fluid px-4" id="myInvoice">
        <div class="card mt-3">
            <div class="card-body">
                <?php if (isset($_GET["orderid"])):?>
                    <h3 class="card-title text-center fw-bolder">Thank you for your purchase in gear arena</h3>
                    <div class="text-end">
                        <h5>Invoice</h5>
                        <h5>id: #<?=$_GET['orderid']?></h5>
                    </div>
                    <?php if (mysqli_num_rows($query) > 0) : ?>
                        <?php $dataUser = mysqli_fetch_assoc($query); ?>
                        <address>
                            <p>Name: <?= $dataUser['legal_name'] ?></p>
                            <p>State: <?= $dataUser['state'] ?></p>
                            <p>City: <?= $dataUser['city'] ?></p>
                            <p>Addres: <?= $dataUser['address'] ?></p>
                            <p>Post Code: <?= $dataUser['post_code'] ?></p>
                        </address>
                        <?php mysqli_data_seek($query, 0); ?>
                        <div class="container ">
                            <p class="card-text text-center fw-bolder">Below are the items that you bought.</p>
                            <table class="table table-success table-striped">
                                <thead>
                                    <tr>
                                        <th>Items</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php while ($data = mysqli_fetch_assoc($query)): ?>
                                    <tr>
                                        <th scope="row"><?= $data['product'] ?></th>
                                        <td><?= $data['quantity'] ?></td>
                                        <td>RM: <?= $data['single_price'] ?></td>
                                        <td>RM: <?=$total = $data['single_price'] * $data['quantity']?></td>
                                    </tr>
                                    <input type="hidden" value="<?=$total = $data['total']?>"> 
                                <?php endwhile;?>
                                    <tr>
                                        <th class="text-right" colspan="3">Total</th>
                                        <td colspan="">RM: <?=$total?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php endif;?>
                <?php else:?>
                    <p class="card-text">No data Send.</p>
                <?php endif;?>
            </div>
        </div>
    </div>
    <a href="#" onclick="printMyInvoice(<?= $_GET['orderid'] ?>)" class="btn btn-sm btn-secondary float-end my-4 mx-4">Download to PDF</a>

    <!-- jspdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- html2canvas  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="assets/js/script.js"></script>
</body>
</html>
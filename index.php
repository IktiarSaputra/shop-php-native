<!-- 
------------------------------------------------------------
App Name : Shop
Author : Muhammad Ikctiar Saputra
Notice : Dilarang Merubah / Mengakui Hasil Karya Orang Lain
------------------------------------------------------------
 -->

 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>

    <!-- Style CSS -->
    <link rel="stylesheet" href="css/home.css">

</head>

<body>
    <nav class="navbar">
        <div class="navbar-brand">
            <div class="round">
                <img src="image/logo-icon.png" alt="">
            </div>
            <h4>Shop</h4>
        </div>
        <ul class="navbar-item">
            <li class="nav-item">
                <a href="index.php" class="nav-link active">Home</a>
            </li>
            <li class="nav-item">
                <a href="order/" class="nav-link">Orders</a>
            </li>
            <?php
            session_start();

            if (isset($_SESSION['username'])) {
                if ($_SESSION['username'] == 'admin') {
                    // Halaman Admin
                    echo '
                        <li class="nav-item">
                            <a href="admin/dashboard.php" class="nav-link">Dashboard</a>
                        </li>
                    ';
                } else {
                    echo '
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link">Logout</a>
                        </li>
                    ';
                }
            } else {
                echo '
                        <li class="nav-item">
                            <a href="login/" class="nav-link">Sign In</a>
                        </li>
                    ';
            }
            ?>
            
        </ul>
        <a href="cart/" class="round">
            <img src="image/icon-cart.png" class="img-cart" alt="">
        </a>
    </nav>

    <div class="banner">
        <div class="row">
            <div class="col-md-7">
                <h3 class="lead">Get The Best Deals On</h3>
                <h1 class="display-4">Printer</h1>
            </div>
            <div class="col-md-5">
                <div class="round-img">
                    <img src="image/img-banner.png" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="section-title">
            New Products
        </div>
        <div class="row-card">
            <?php
            include 'database/koneksi.php';

            $query = 'SELECT * FROM printer_tb ORDER BY idPrinter DESC';
            $result = mysqli_query($koneksi, $query);
            while ($data = mysqli_fetch_array($result)) { ?>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <div class="round-card">
                            <a href="cart/index.php?id=<?php echo $data[
                                'idPrinter'
                            ]; ?>&action=add"><img
                                    src="image/icon-cart-navy.svg" class="img-round" alt=""></a>
                            <!-- <img src="image/icon-cart-navy.svg" class="img-round" alt=""> -->
                        </div>
                        <div class="round-card">
                            <img src="image/icon-checkout.png" class="img-round" alt="">
                        </div>
                    </div>
                    <div class="card-image">
                        <div class="round-card-image">
                            <img src="img-product/<?= $data[
                                'GambarPrinter'
                            ] ?>" alt="">
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="text-title"><?= $data['NamaPrinter'] ?></h4>
                        <p class="text-desc"><?= $data[
                            'SpesifikasiPrinter'
                        ] ?></p>
                        <h6 class="text-price"><?= 'Rp.' .
                            number_format($data['HargaPrinter']) ?></h6>
                    </div>
                </div>
            </div>
            
            <?php }
            ?>
        </div>
    </div>
</body>

</html>
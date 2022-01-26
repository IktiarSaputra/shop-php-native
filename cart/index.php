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
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/cart.css">
</head>

<body>
    <nav class="navbar">
        <div class="navbar-brand">
            <div class="round">
                <img src="../image/logo-icon.png" alt="">
            </div>
            <h4>Shop</h4>
        </div>
        <ul class="navbar-item">
            <li class="nav-item">
                <a href="../index.php" class="nav-link active">Home</a>
            </li>
            <li class="nav-item">
                <a href="../order" class="nav-link">Orders</a>
            </li>
            <?php
            session_start();

            if (isset($_SESSION['username'])) {
                if ($_SESSION['username'] == 'admin') {
                    // Halaman Admin
                    echo '
                        <li class="nav-item">
                            <a href="../admin/dashboard.php" class="nav-link">Dashboard</a>
                        </li>
                    ';
                } else {
                    echo '
                        <li class="nav-item">
                            <a href="../logout.php" class="nav-link">Logout</a>
                        </li>
                    ';
                }
            } else {
                echo '
                        <li class="nav-item">
                            <a href="../login/" class="nav-link">Sign In</a>
                        </li>
                    ';
            }
            ?>

        </ul>
        <a href="index.php" class="round">
            <img src="../image/icon-cart.png" class="img-cart" alt="">
        </a>
    </nav>
    <?php
    // Mulai sesi
    require '../database/koneksi.php';
    require '../item.php';

    if (isset($_GET['id']) && !isset($_POST['update'])) {
        $sql = 'SELECT * FROM printer_tb WHERE idPrinter=' . $_GET['id'];
        $result = mysqli_query($koneksi, $sql);
        $product = mysqli_fetch_object($result);
        $item = new Item();
        $item->id = $product->idPrinter;
        $item->name = $product->NamaPrinter;
        $item->price = $product->HargaPrinter;
        $iteminstock = 10;
        $item->quantity = 1;

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        //Periksa produk dalam keranjang
        $index = -1;
        $cart = unserialize(serialize($_SESSION['cart']));
        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i]->id == $_GET['id']) {
                $index = $i;
                break;
            }
        }

        if ($index == -1) {
            $_SESSION['cart'][] = $item;
        }
        //$ _SESSION ['cart']: set $ cart sebagai variabel _session
        else {
            if ($cart[$index]->quantity < $iteminstock) {
                $cart[$index]->quantity++;
            }

            $_SESSION['cart'] = $cart;
        }
    }
    //Menghapus produk dalam keranjang
    if (isset($_GET['index']) && !isset($_POST['update'])) {
        $cart = unserialize(serialize($_SESSION['cart']));
        unset($cart[$_GET['index']]);
        $cart = array_values($cart);
        $_SESSION['cart'] = $cart;
    }
    // Perbarui jumlah dalam keranjang
    if (isset($_POST['update'])) {
        $arrQuantity = $_POST['quantity'];
        $cart = unserialize(serialize($_SESSION['cart']));
        for ($i = 0; $i < count($cart); $i++) {
            $cart[$i]->quantity = $arrQuantity[$i];
        }
        $_SESSION['cart'] = $cart;
    }
    ?>
    <div class="container">
        <h2 class="section-title">keranjang Belanja Anda</h2>
        <form method="POST">
            <table id="t01">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
                <?php
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }
                $cart = unserialize(serialize($_SESSION['cart']));
                $s = 0;
                $index = 0;
                for ($i = 0; $i < count($cart); $i++) {
                    $s += $cart[$i]->price * $cart[$i]->quantity; ?>
                <tr>
                    <td> <?php echo $cart[$i]->id; ?> </td>
                    <td> <?php echo $cart[$i]->name; ?> </td>
                    <td>Rp. <?php echo number_format($cart[$i]->price); ?> </td>
                    <td> <input type="number" class="form-number" min="1" value="<?php echo $cart[
                        $i
                    ]->quantity; ?>" name="quantity[]"> </td>
                    <td> Rp.<?php echo number_format(
                        $cart[$i]->price * $cart[$i]->quantity
                    ); ?> </td>
                    <td style="display: flex;align-items: center;justify-content: center;">
                        <a href="index.php?index=<?php echo $index; ?>" class="btn-danger"
                            onclick="return confirm('Apa Kamu Yakin Ingin Menghapus Ini?')">
                            <img src="../image/icon-delete.svg" alt=""></a>
                    </td>
                </tr>
                <?php $index++;
                }
                ?>
                <tr>
                    <td colspan="4" style="text-align:right; font-weight:500">
                        <input id="saveimg" type="image" src="../image/icon-update.png" name="update" alt="Save Button">
                        <input type="hidden" name="update">
                    </td>
                    <td colspan="2"> Rp.<?php echo number_format($s); ?> </td>
                </tr>
            </table>
        </form>
        <br>
        <a href="../index.php" class="btn btn-info">Continue Shopping</a>
        <?php 
    
            if (isset($_SESSION['id_user'])) {
        ?>
        | <a href="checkout.php" class="btn btn-primary">Checkout</a>
        <?php } ?>
    </div>
    <?php if (isset($_GET['id']) || isset($_GET['index'])) {
        header('Location: index.php');
    } ?>
</body>

</html>
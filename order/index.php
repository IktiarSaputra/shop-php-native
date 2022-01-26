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
    <link rel="stylesheet" href="../css/order.css">
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
                <a href="../index.php" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="index.php" class="nav-link active">Orders</a>
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
    <div class="container">
        <h2 class="section-title">List Transaksi Anda</h2>
    </div>
    <div class="row">
            <div class="card mt-5">
                <div class="table-responsive">
                <table>
                    <tr>
                        <th>No</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Harga</th>
                        <th>subtotal</th>
                        <th>Status</th>
                    </tr>
                    <?php
                    include '../database/koneksi.php';

                    if (isset($_SESSION['id_user'])) {
                        $id = $_SESSION['id_user'];
                        $query = "SELECT transaksi.subtotal, transaksi.Jumlah, transaksi.idTransaksi, transaksi.status ,  transaksi.UserIdUser2, user.Username, printer_tb.NamaPrinter, printer_tb.HargaPrinter FROM transaksi INNER JOIN user ON transaksi.UserIdUser2 = user.idUser INNER JOIN printer_tb ON transaksi.Printer_tblIdPrinter = printer_tb.idPrinter WHERE UserIdUser2 = '$id'";
                        $result = mysqli_query($koneksi, $query);
                        $no = 1;
                        while ($data = mysqli_fetch_object($result)) { ?>

                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data->NamaPrinter ?></td>
                            <td><?= $data->Jumlah ?></td>
                            <td><?= number_format($data->HargaPrinter) ?></td>
                            <td><?= number_format($data->subtotal) ?></td>
                            <?php 
                            
                            if ($data->status == 1) {
                            ?>

                                <td><span class="badge-warning">Belum Dikonfirmasi</span></td>
                                

                            <?php 
                            } else {
                            ?>

                                <td><span class="badge-success">Sudah Dikonfirmasi</span></td>

                            <?php } ?>
                        </tr>

                    <?php } }
                    ?>
                </table>
                </div>
            </div>
        </div>
   
</body>

</html>
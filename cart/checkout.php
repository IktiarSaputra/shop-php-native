<?php 
session_start();
require '../database/koneksi.php';
require '../item.php';
$iduser = $_SESSION['id_user'];
$cart = unserialize(serialize($_SESSION['cart']));
$status = 1;
for($i=0; $i<count($cart);$i++) {
    $subtotal = $cart[$i]->price * $cart[$i]->quantity;
$sql2 = 'INSERT INTO transaksi (jumlah, subtotal, status, UserIdUser, HargaPrinter, Printer_tblIdPrinter, UserIdUser2) VALUES ('.$cart[$i]->quantity.', '.$subtotal.' , '.$status.'  , '.$iduser.', '.$cart[$i]->price.' , '.$cart[$i]->id.' , '.$iduser.')';
mysqli_query($koneksi, $sql2);
}
// Clear all product in cart
unset($_SESSION['cart']);
header('Location: ../order/');
?>
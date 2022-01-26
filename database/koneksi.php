<?php 

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'shop';

$koneksi = mysqli_connect($host, $user, $pass, $dbname);

if (!$koneksi) {
    die("Koneksi Gagal" . mysqli_connect_error());
}

?>
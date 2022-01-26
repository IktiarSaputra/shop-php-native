-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jan 2022 pada 06.46
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `printer_tb`
--

CREATE TABLE `printer_tb` (
  `idPrinter` int(10) NOT NULL,
  `NamaPrinter` char(50) DEFAULT NULL,
  `SpesifikasiPrinter` char(50) DEFAULT NULL,
  `HargaPrinter` int(50) DEFAULT NULL,
  `GambarPrinter` varchar(50) NOT NULL,
  `UserIdUser` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `printer_tb`
--

INSERT INTO `printer_tb` (`idPrinter`, `NamaPrinter`, `SpesifikasiPrinter`, `HargaPrinter`, `GambarPrinter`, `UserIdUser`) VALUES
(9, 'Canon 67027', 'tes 1234567', 2000000, 'image1.png', NULL),
(10, 'Canon 64060', 'Printer Laser Injection Terbaru', 2450000, 'img-banner.png', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `idTransaksi` int(10) NOT NULL,
  `Jumlah` int(10) DEFAULT NULL,
  `subtotal` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UserIdUser` int(10) DEFAULT NULL,
  `HargaPrinter` int(50) DEFAULT NULL,
  `Printer_tblIdPrinter` int(10) DEFAULT NULL,
  `UserIdUser2` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`idTransaksi`, `Jumlah`, `subtotal`, `status`, `tanggal`, `UserIdUser`, `HargaPrinter`, `Printer_tblIdPrinter`, `UserIdUser2`) VALUES
(4, 2, 4000000, 2, '2022-01-26 04:51:51', 1, 2000000, 9, 1),
(5, 8, 16000000, 1, '2022-01-26 05:27:54', 2, 2000000, 9, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `idUser` int(10) NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`idUser`, `Username`, `Password`) VALUES
(1, 'admin', 'admin'),
(2, 'user', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `printer_tb`
--
ALTER TABLE `printer_tb`
  ADD PRIMARY KEY (`idPrinter`),
  ADD KEY `UserIdUser` (`UserIdUser`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`idTransaksi`),
  ADD KEY `UserIdUser2` (`UserIdUser2`),
  ADD KEY `Printer_tblIdPrinter` (`Printer_tblIdPrinter`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `printer_tb`
--
ALTER TABLE `printer_tb`
  MODIFY `idPrinter` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `idTransaksi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `printer_tb`
--
ALTER TABLE `printer_tb`
  ADD CONSTRAINT `printer_tb_ibfk_1` FOREIGN KEY (`UserIdUser`) REFERENCES `user` (`idUser`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`UserIdUser2`) REFERENCES `user` (`idUser`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`Printer_tblIdPrinter`) REFERENCES `printer_tb` (`idPrinter`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

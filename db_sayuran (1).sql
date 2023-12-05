-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Des 2023 pada 10.46
-- Versi server: 8.0.17
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sayuran`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart_kwitansi`
--

CREATE TABLE `cart_kwitansi` (
  `id_cart` int(11) NOT NULL,
  `id_sayuran` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `cart_kwitansi`
--

INSERT INTO `cart_kwitansi` (`id_cart`, `id_sayuran`, `id_user`, `qty`) VALUES
(48, 3, 22, 2),
(49, 2, 22, 1),
(51, 2, 22, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart_user`
--

CREATE TABLE `cart_user` (
  `id_cart` int(11) NOT NULL,
  `id_sayuran` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_penerima`
--

CREATE TABLE `data_penerima` (
  `id_penerima` int(11) NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `no_tlp` varchar(15) DEFAULT NULL,
  `alamat` text,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `data_penerima`
--

INSERT INTO `data_penerima` (`id_penerima`, `nama`, `no_tlp`, `alamat`, `id_user`) VALUES
(21, 'saya', '085432762267', 'jalan pasudan', 22);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_user`
--

CREATE TABLE `data_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('admin','buyer') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `data_user`
--

INSERT INTO `data_user` (`id_user`, `username`, `password`, `role`) VALUES
(6, 'admin', 'admin', 'admin'),
(22, 'pembeli', 'pembeli', 'buyer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sayuran`
--

CREATE TABLE `sayuran` (
  `id_sayuran` int(11) NOT NULL,
  `nama_sayuran` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `harga_sayuran` int(15) NOT NULL,
  `satuan` varchar(11) NOT NULL,
  `gambar_sayuran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `sayuran`
--

INSERT INTO `sayuran` (`id_sayuran`, `nama_sayuran`, `harga_sayuran`, `satuan`, `gambar_sayuran`) VALUES
(1, 'wortel impor', 15000, '/kg', 'image/wortel-impor.jpg'),
(2, 'bawang bombay', 25000, '/kg', 'image/bombay.jpeg'),
(3, 'caicim', 3000, '/ikat', 'image/caisim.jpg'),
(4, 'kol', 8000, '/kg', 'image/kol.jpg'),
(5, 'Kentang', 16000, '/kg', 'image/kentang.jpg'),
(9, 'jengkol', 20000, '/kg', 'image/jengkol.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_penerima` int(11) NOT NULL,
  `status` enum('Sedang Dikemas','Dalam Perjalanan','Sudah Sampai') NOT NULL,
  `Tanggal` date NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_penerima`, `status`, `Tanggal`, `id_user`) VALUES
(6, 21, 'Sedang Dikemas', '2023-12-05', 22);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart_kwitansi`
--
ALTER TABLE `cart_kwitansi`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `id_sayuran` (`id_sayuran`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `cart_user`
--
ALTER TABLE `cart_user`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `id_sayuran` (`id_sayuran`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `data_penerima`
--
ALTER TABLE `data_penerima`
  ADD PRIMARY KEY (`id_penerima`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `data_user`
--
ALTER TABLE `data_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `sayuran`
--
ALTER TABLE `sayuran`
  ADD PRIMARY KEY (`id_sayuran`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pelanggan` (`id_penerima`),
  ADD KEY `id_ck` (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cart_kwitansi`
--
ALTER TABLE `cart_kwitansi`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `cart_user`
--
ALTER TABLE `cart_user`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `data_penerima`
--
ALTER TABLE `data_penerima`
  MODIFY `id_penerima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `data_user`
--
ALTER TABLE `data_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `sayuran`
--
ALTER TABLE `sayuran`
  MODIFY `id_sayuran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cart_kwitansi`
--
ALTER TABLE `cart_kwitansi`
  ADD CONSTRAINT `cart_kwitansi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `data_user` (`id_user`),
  ADD CONSTRAINT `cart_kwitansi_ibfk_2` FOREIGN KEY (`id_sayuran`) REFERENCES `sayuran` (`id_sayuran`);

--
-- Ketidakleluasaan untuk tabel `cart_user`
--
ALTER TABLE `cart_user`
  ADD CONSTRAINT `cart_user_ibfk_1` FOREIGN KEY (`id_sayuran`) REFERENCES `sayuran` (`id_sayuran`),
  ADD CONSTRAINT `cart_user_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `data_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `data_penerima`
--
ALTER TABLE `data_penerima`
  ADD CONSTRAINT `data_penerima_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `data_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_penerima`) REFERENCES `data_penerima` (`id_penerima`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `data_user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

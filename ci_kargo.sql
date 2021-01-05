-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jan 2021 pada 13.50
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_kargo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `deposit`
--

CREATE TABLE `deposit` (
  `id` bigint(20) NOT NULL,
  `id_pengirim` bigint(20) DEFAULT NULL,
  `id_penjualan` bigint(20) DEFAULT NULL,
  `deposit` varchar(100) DEFAULT NULL,
  `tipe` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=In,0=Out',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `deposit`
--

INSERT INTO `deposit` (`id`, `id_pengirim`, `id_penjualan`, `deposit`, `tipe`, `created_at`) VALUES
(1, 2, NULL, '10000000', 1, '2020-12-21 19:04:26'),
(2, 1, NULL, '5000000', 1, '2020-12-21 19:04:36'),
(5, 1, 3, '2196675', 0, '2020-12-22 19:05:51'),
(10, 2, 5, '248950', 0, '2020-12-23 02:57:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gaji`
--

CREATE TABLE `gaji` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `total_gaji` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `gaji`
--

INSERT INTO `gaji` (`id`, `nama`, `keterangan`, `total_gaji`, `created_at`) VALUES
(1, 'iavong', 'harian', '100000', '2020-12-21 00:00:00'),
(2, 'atan', 'mingguan', '500000', '2020-12-21 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id` bigint(20) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `harga` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id`, `keterangan`, `harga`, `created_at`) VALUES
(1, 'rokok', '25000', '2020-12-21 19:04:00'),
(2, 'kopi', '12000', '2020-12-21 19:04:10'),
(3, 'listrik', '50000', '2020-12-23 02:45:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengirim`
--

CREATE TABLE `pengirim` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(250) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `deposit` varchar(100) DEFAULT NULL,
  `tipe` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Langganan,1=Hutang',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pengirim`
--

INSERT INTO `pengirim` (`id`, `nama`, `no_hp`, `alamat`, `deposit`, `tipe`, `created_at`) VALUES
(1, 'iavong', '0834141', 'pontianak', '2803325', 0, '2020-12-21 19:02:43'),
(2, 'atan', '0821', 'kubu', '9751050', 0, '2020-12-21 19:02:54'),
(3, 'kamal', '08142', 'media', '0', 1, '2020-12-21 19:03:08'),
(4, 'fikri', '08555', 'jawai', '0', 1, '2020-12-21 19:03:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id` bigint(20) NOT NULL,
  `no_kwitansi` int(11) DEFAULT NULL,
  `airlines` varchar(100) DEFAULT NULL,
  `no_penerbangan` varchar(100) DEFAULT NULL,
  `no_smu` varchar(100) DEFAULT NULL,
  `berat` decimal(10,0) DEFAULT NULL,
  `koli` int(11) DEFAULT NULL,
  `custom_harga` varchar(100) DEFAULT NULL,
  `harga_smu` varchar(100) DEFAULT NULL,
  `biaya_smu` varchar(100) DEFAULT NULL,
  `biaya_admin_smu` varchar(100) DEFAULT NULL,
  `biaya_operasional` varchar(100) DEFAULT NULL,
  `total_operasional` varchar(100) DEFAULT NULL,
  `harga_gudang` varchar(100) DEFAULT NULL,
  `harga_admin_gudang` varchar(100) DEFAULT NULL,
  `total_biaya_gudang` varchar(100) DEFAULT NULL,
  `biaya_tambahan` varchar(100) DEFAULT NULL,
  `biaya_total` varchar(100) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `id_pengirim` bigint(20) DEFAULT NULL,
  `pengirim` varchar(100) DEFAULT NULL,
  `penerima` varchar(100) DEFAULT NULL,
  `tujuan_id` int(11) DEFAULT NULL,
  `jenis_pembayaran` enum('deposit','cash','debit') DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id`, `no_kwitansi`, `airlines`, `no_penerbangan`, `no_smu`, `berat`, `koli`, `custom_harga`, `harga_smu`, `biaya_smu`, `biaya_admin_smu`, `biaya_operasional`, `total_operasional`, `harga_gudang`, `harga_admin_gudang`, `total_biaya_gudang`, `biaya_tambahan`, `biaya_total`, `isi`, `catatan`, `id_pengirim`, `pengirim`, `penerima`, `tujuan_id`, `jenis_pembayaran`, `deleted`, `created_at`, `status`) VALUES
(1, 10001, 'lion', 'jt-312', '321-21312', '20', 2, '30000', '30000', '615000', '15000', '1000', '20000', '1045', '3500', '24400', '5000', '664400', 'skate', 'board', 2, 'atan', 'bang jo', 1, 'deposit', 1, '2020-12-21 19:05:37', NULL),
(2, 10002, 'namair', 'nm-311', '312-312321', '15', 5, '10000', '10000', '170000', '20000', '1000', '15000', '1045', '3500', '19175', '5000', '209175', 'batu', 'akik', 1, 'iavong', 'toko', 2, 'deposit', 1, '2020-12-21 19:07:42', NULL),
(3, 10003, 'lion', 'jt-553', '313-321', '15', 2, '', '10000', '2150000', '2000000', '1500', '22500', '1045', '3500', '19175', '5000', '2196675', 'batu', 'akik', 1, 'iavong', 'toko', 1, 'deposit', 0, '2020-12-22 19:05:51', 'Edited'),
(4, 10004, 'sriwijaya', 'sj-323', '312-31231', '15', 2, '', '20000', '313000', '13000', '1200', '18000', '1045', '3500', '19175', '5000', '355175', 'batu', 'akik', 3, 'kamal', 'udin', 3, 'deposit', 1, '2020-12-23 00:38:40', 'Edited'),
(5, 10005, 'sriwijaya', 'sj-321', '321-213', '10', 2, '', '20000', '220000', '20000', '1500', '15000', '1045', '3500', '13950', '', '248950', 'batu', 'akik', 2, 'atan', 'tintin', 3, 'deposit', 0, '2020-12-23 02:56:27', 'Edited');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tujuan`
--

CREATE TABLE `tujuan` (
  `id` int(11) NOT NULL,
  `berat` decimal(10,0) DEFAULT NULL,
  `kota_tujuan` varchar(100) DEFAULT NULL,
  `biaya` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tujuan`
--

INSERT INTO `tujuan` (`id`, `berat`, `kota_tujuan`, `biaya`) VALUES
(1, '1', 'Jakarta', '10000'),
(2, '1', 'Banung', '15000'),
(3, '1', 'Surabaya', '20000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` tinyint(4) NOT NULL COMMENT '1=Master,2=Staff kantor,3=Staff lapangan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `role`) VALUES
(1, 'Administrator', 'master', '$2y$10$SMmgGW7yn/aVqf0ZsQm36.oDRyXHV9GFZASmhHLADrPiANk5dfQOm', 1),
(3, 'Atan', 'staff', '$2y$10$95nNst0hXjWRmyyo4Zq0a.A5N5jDneYsgrsvu.cTcXl/OojvGSC5a', 2),
(4, 'master dua', 'master2', '$2y$10$wSeSgBzHIT2sbfM5uAITz.ZXNhSgzt52C6JyT1ip.MgdgGH8.Gs1.', 1),
(5, 'Hap', 'lapangan', '$2y$10$17mlhhYKYHTn1gLSXZIM0u4PSzLhrXxkN6jILQsZsp1xnUIskYLB6', 3);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengirim`
--
ALTER TABLE `pengirim`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tujuan`
--
ALTER TABLE `tujuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `deposit`
--
ALTER TABLE `deposit`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pengirim`
--
ALTER TABLE `pengirim`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tujuan`
--
ALTER TABLE `tujuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

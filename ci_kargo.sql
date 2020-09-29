-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 29 Sep 2020 pada 22.18
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.9

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
  `deposit` varchar(100) DEFAULT NULL,
  `tipe` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=In,0=Out',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `deposit`
--

INSERT INTO `deposit` (`id`, `id_pengirim`, `deposit`, `tipe`, `created_at`) VALUES
(24, 9, '1000000', 1, '2020-09-13 23:41:57'),
(26, 9, '150000', 1, '2020-09-13 23:42:17'),
(28, 9, '20000', 1, '2020-09-26 02:30:42'),
(29, 9, '75000', 0, '2020-09-26 02:35:41'),
(33, 8, '20000', 1, '2020-09-26 02:44:52'),
(34, 8, '180000', 1, '2020-09-26 02:44:57'),
(35, 8, '70000', 0, '2020-09-26 02:46:18'),
(36, 8, '320000', 0, '2020-09-26 02:52:55'),
(37, 9, '228950', 0, '2020-09-30 00:35:38');

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
(2, 'makanan', '50000', '2020-09-07 04:12:45'),
(5, 'Galon', '7000', '2020-09-07 21:22:22'),
(6, 'Kopi', '5000', '2020-09-07 21:23:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerima`
--

CREATE TABLE `penerima` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pengirim`
--

INSERT INTO `pengirim` (`id`, `nama`, `no_hp`, `alamat`, `deposit`, `created_at`) VALUES
(8, 'Ahmad', '089999999', 'pontianak', '-190000', '2020-09-13 23:30:38'),
(9, 'Iavong', '0884787485784', 'pontianak', '866050', '2020-09-13 23:41:45');

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
  `biaya_smu` varchar(100) DEFAULT NULL,
  `biaya_gudang` varchar(100) DEFAULT NULL,
  `biaya_tambahan` varchar(100) DEFAULT NULL,
  `biaya_total` varchar(100) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `pengirim` varchar(100) DEFAULT NULL,
  `penerima` varchar(100) DEFAULT NULL,
  `tujuan_id` int(11) DEFAULT NULL,
  `jenis_pembayaran` enum('deposit','cash','debit') DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id`, `no_kwitansi`, `airlines`, `no_penerbangan`, `no_smu`, `berat`, `koli`, `biaya_smu`, `biaya_gudang`, `biaya_tambahan`, `biaya_total`, `isi`, `catatan`, `pengirim`, `penerima`, `tujuan_id`, `jenis_pembayaran`, `created_at`) VALUES
(4, 0, 'lion', 'lakdjkf', 'alksdjf', '10', 2, '200000', '150000', '10000', '360000', '', '', 'Didi', 'baban', 15, 'deposit', '2020-09-14 04:11:45'),
(5, 0, 'JT', 'JT', 'lakjsdf', '5', 1, '100000', '50000', '', '150000', '', '', 'jinton', 'naruto', 15, 'deposit', '2020-09-14 04:12:54'),
(6, 0, 'lion', 'lakjdf', 'akldjf', '10', 2, '100000', '15000', '10000', '125000', '', '', 'alksdjf', 'aksdjf', 15, 'deposit', '2020-09-14 04:45:11'),
(7, 0, 'lion', 'sabeb', '23', '5', 3, '50000', '20000', '5000', '75000', '', '', 'Iavong', 'Sembarang', 15, 'deposit', '2020-09-26 02:18:31'),
(15, 2147483647, 'lion', '79234', '02938402', '10', 4, '300000', '13950', '10000', '323950', '', '', 'testing', 'tester', 14, 'cash', '2020-09-29 21:20:09'),
(21, 2147483647, 'lion', '79234', '02938402', '10', 4, '203500', '13950', '10000', '227450', '', '', 'testing2', 'tester3', 14, 'cash', '2020-09-29 23:30:50'),
(22, 2147483647, 'lion', '79234', '02938402', '10', 4, '205000', '13950', '10000', '228950', '', '', 'alskdjfl', 'test', 14, 'cash', '2020-09-29 23:47:36'),
(23, 2147483647, 'lion', '79234', '02938402', '10', 4, '305000', '13950', '10000', '328950', '', '', 'alskdjfl', 'degi', 14, 'cash', '2020-09-29 23:50:13'),
(24, 2147483647, 'lion', '79234', '02938402', '10', 4, '205000', '13950', '10000', '228950', '', '', 'Iavong', 'test', 14, 'deposit', '2020-09-30 00:35:38');

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
(4, '1', 'Jakarta', '25000'),
(5, '1', 'Sambas', '15000'),
(9, '1', 'Zimbabwe', '1000000'),
(10, '1', 'Ketapang', '100'),
(11, '1', 'Solo', '16000'),
(12, '1', 'Bebas', '100'),
(14, '1', 'Sintang', '30000'),
(15, '1', 'Daerah Istimewa Yogyakarta', '10000');

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
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penerima`
--
ALTER TABLE `penerima`
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `penerima`
--
ALTER TABLE `penerima`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengirim`
--
ALTER TABLE `pengirim`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tujuan`
--
ALTER TABLE `tujuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

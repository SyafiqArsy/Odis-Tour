-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2025 at 12:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `website_umroh`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Id_admin` bigint(20) UNSIGNED NOT NULL,
  `usn_admin` varchar(30) NOT NULL,
  `pass_admin` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Id_admin`, `usn_admin`, `pass_admin`) VALUES
(111, 'admin@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id_booking` bigint(20) UNSIGNED NOT NULL,
  `nama_pembeli` varchar(100) NOT NULL,
  `paket_umroh` varchar(30) NOT NULL,
  `jml_paket` int(11) NOT NULL,
  `tgl_keberangkatan` date NOT NULL,
  `id_paket` bigint(20) UNSIGNED DEFAULT NULL,
  `id_customer` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id_booking`, `nama_pembeli`, `paket_umroh`, `jml_paket`, `tgl_keberangkatan`, `id_paket`, `id_customer`) VALUES
(28, 'Zaskiya', 'Reguler', 2, '2028-07-14', 24, 1235),
(29, 'Zaskiya', 'Diamond', 3, '2028-09-28', 25, 1235),
(30, 'sapik', 'Diamond', 2, '2028-09-28', 25, 1240),
(31, 'sapik', 'Diamond', 1, '2028-09-28', 25, 1240),
(32, 'sapik', 'Diamond', 1, '2028-09-28', 25, 1240),
(33, 'sapikwoe', 'Diamond', 2, '2028-09-28', 25, 1240),
(34, 'zskiyy', 'Diamond', 2, '2028-09-28', 25, 1243),
(35, 'audrey', 'Prestige', 2, '2028-11-28', 26, 1241),
(36, 'sapik', 'Diamond', 6, '2028-09-28', 25, 1240),
(37, 'sapik', 'Prestige', 2, '2028-11-28', 26, 1240),
(38, 'Customer', 'Prestige', 2, '2028-11-28', 26, 1240),
(39, 'Customer', 'Reguler', 2, '2028-07-14', 24, 1244);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Id_Cust` bigint(20) UNSIGNED NOT NULL,
  `nama_Cust` varchar(30) NOT NULL,
  `no_HP` int(11) NOT NULL,
  `domisili` varchar(40) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pass_Cust` varchar(30) NOT NULL,
  `konfirmasi_Pass` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Id_Cust`, `nama_Cust`, `no_HP`, `domisili`, `email`, `pass_Cust`, `konfirmasi_Pass`) VALUES
(1234, 'joko', 7568, '', '', '', ''),
(1235, 'Raka Alvaro', 2147483647, 'Jakarta', 'raka.alvaro@email.com', 'rahasia123', 'rahasia123'),
(1236, 'Zahra Meilani', 2147483647, 'Bandung', 'zahra.mei@email.com', 'passZahra', 'passZahra'),
(1237, 'Dimas Raditya', 2147483647, 'Surabaya', 'dimas.rdy@email.com', 'dimasSecure', 'dimasSecure'),
(1238, 'Aurora Syakira', 2147483647, 'Yogyakarta', 'aurora.sy@email.com', 'auroraPwd', 'auroraPwd'),
(1239, 'Naufal Arya', 2147483647, 'Malang', 'naufal.arya@email.com', 'naufalPass', 'naufalPass'),
(1240, 'sapik', 123, 'tegal', 'asd@asd', 'asd', ''),
(1241, 'audrey', 2147483647, 'solo', 'abcd@gmail.com', '12345', ''),
(1243, 'zskiyy', 8, 'ska', 'zaski@zaski', 'zaskii', ''),
(1244, 'Customer', 123, 'Surakarta', 'tes@gmail.com', 'tes123', 'tes123');

-- --------------------------------------------------------

--
-- Table structure for table `paket_umroh`
--

CREATE TABLE `paket_umroh` (
  `id_paket` bigint(20) UNSIGNED NOT NULL,
  `nama_paket` varchar(30) NOT NULL,
  `detail_fasilitas` varchar(100) NOT NULL,
  `foto_paket` varchar(300) NOT NULL,
  `tgl_keberangkatan` date NOT NULL,
  `fasilitas_tambahan` varchar(30) NOT NULL,
  `harga_paket` int(11) NOT NULL,
  `durasi_Perjalanan` varchar(100) NOT NULL,
  `konfirmasi` varchar(100) NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paket_umroh`
--

INSERT INTO `paket_umroh` (`id_paket`, `nama_paket`, `detail_fasilitas`, `foto_paket`, `tgl_keberangkatan`, `fasilitas_tambahan`, `harga_paket`, `durasi_Perjalanan`, `konfirmasi`, `status`) VALUES
(24, 'Reguler', 'Hotel Bintang 3', 'uploads/1748789011_umroh11.jpg', '2028-07-14', 'Asuransi, Manasik, Air Zamzam', 28000000, '12 Hari', '1', 'aktif'),
(25, 'Diamond', 'Hotel bintang 4', 'uploads/1748789406_umroh22.jpg', '2028-09-28', 'Asuransi, Manasik', 33000000, '12 Hari', '1', 'nonaktif'),
(26, 'Prestige', 'Hotel bintang 5', 'uploads/1748789497_umroh33.jpg', '2028-11-28', 'Asuransi, Manasik, Air Zamzam', 38000000, '12 Hari', '1', 'nonaktif'),
(27, 'Platinum', 'Luxury Resort', 'uploads/1750392930_diamond.jpg', '2027-06-24', 'Asuransi, Manasik, Air Zamzam', 50000000, '20 Hari', '1', 'nonaktif');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_transaksi`
--

CREATE TABLE `riwayat_transaksi` (
  `id_riwayat_transaksi` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `tanggal_pembayaran` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_pembayaran` enum('pending','pesanan diterima','pesanan dibatalkan') DEFAULT 'pending',
  `total_harga` decimal(15,2) NOT NULL,
  `status` enum('menunggu konfirmasi','selesai') DEFAULT 'menunggu konfirmasi',
  `detail` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riwayat_transaksi`
--

INSERT INTO `riwayat_transaksi` (`id_riwayat_transaksi`, `id_paket`, `id_customer`, `tanggal_pembayaran`, `status_pembayaran`, `total_harga`, `status`, `detail`) VALUES
(1, 25, 1240, '2025-06-10 08:55:42', 'pesanan diterima', 66000000.00, 'selesai', 'Pesanan baru dibuat'),
(3, 25, 1240, '2025-06-10 16:02:05', 'pesanan diterima', 33000000.00, 'selesai', 'Pesanan baru dibuat'),
(5, 25, 1243, '2025-06-12 03:19:52', 'pesanan dibatalkan', 66000000.00, 'selesai', 'Pesanan baru dibuat - Dibatalkan admin pada 12-06-2025 10:24:33'),
(6, 26, 1241, '2025-06-12 03:24:19', 'pesanan dibatalkan', 76000000.00, 'selesai', 'Pesanan baru dibuat - Dibatalkan admin pada 12-06-2025 10:24:36'),
(7, 25, 1240, '2025-06-12 08:46:18', 'pesanan dibatalkan', 198000000.00, 'selesai', 'digosting\\r\\n - Dibatalkan admin pada 12-06-2025 15:46:53'),
(8, 26, 1240, '2025-06-12 08:58:52', 'pesanan diterima', 76000000.00, 'selesai', 'Pesanan baru dibuat - Telah dikonfirmasi admin pada 12-06-2025 16:00:20'),
(9, 26, 1240, '2025-06-19 13:58:30', 'pending', 76000000.00, 'menunggu konfirmasi', 'Pesanan baru dibuat'),
(10, 24, 1244, '2025-06-23 02:45:22', 'pesanan dibatalkan', 56000000.00, 'selesai', 'Paket habis - Dibatalkan admin pada 23-06-2025 09:46:57');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id_video` int(11) UNSIGNED NOT NULL,
  `nama_video` varchar(50) NOT NULL,
  `link_video` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id_video`, `nama_video`, `link_video`) VALUES
(1, 'Mangu', 'XJBibv9_FBI');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id_admin`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`),
  ADD KEY `fk_booking_paket` (`id_paket`),
  ADD KEY `fk_booking_customer` (`id_customer`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Id_Cust`);

--
-- Indexes for table `paket_umroh`
--
ALTER TABLE `paket_umroh`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `riwayat_transaksi`
--
ALTER TABLE `riwayat_transaksi`
  ADD PRIMARY KEY (`id_riwayat_transaksi`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id_video`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Id_admin` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Id_Cust` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1245;

--
-- AUTO_INCREMENT for table `paket_umroh`
--
ALTER TABLE `paket_umroh`
  MODIFY `id_paket` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `riwayat_transaksi`
--
ALTER TABLE `riwayat_transaksi`
  MODIFY `id_riwayat_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id_video` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `paket_umroh` (`id_paket`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_booking_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`Id_Cust`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

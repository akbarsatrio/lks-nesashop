-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2019 at 03:46 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nesashop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_adm`
--

CREATE TABLE `tbl_adm` (
  `id_adm` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_adm`
--

INSERT INTO `tbl_adm` (`id_adm`, `username`, `password`, `code`) VALUES
(5, 'admin', '$2y$10$NXUBVZonPOSX0QPa8YgTYOFNINZ7.LD3U7wncSBLnIIGapwjPOjE.', '$2y$10$a8I6iEvIHsJz8IKWkDwp5OWXCavYlNYQIWGwsrvdoPBgvp9uXLPMW'),
(6, 'nesashop', '$2y$10$e1mtTJxv/zf4wIY04RnvXuAa4o0anZ2ELB6MqVAs4aVrOjxUd3OyW', '$2y$10$RKg/bEf4kRmscjGQX16DIO8XCNi4Dfniq/ZgSQDAgU48t2XWDQed2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id_cart` int(11) NOT NULL,
  `id_usr` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` bigint(16) NOT NULL,
  `qty` bigint(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inv`
--

CREATE TABLE `tbl_inv` (
  `id_inv` int(11) NOT NULL,
  `id_usr` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `qty` bigint(16) NOT NULL,
  `total` bigint(16) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `status` enum('Menunggu','Disetujui','Ditolak','') NOT NULL,
  `bukti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_inv`
--

INSERT INTO `tbl_inv` (`id_inv`, `id_usr`, `id_produk`, `qty`, `total`, `invoice`, `status`, `bukti`) VALUES
(11, 3, 6, 1, 34800000, 'NESAINV96263', 'Menunggu', 'images.jpeg'),
(12, 3, 8, 2, 34800000, 'NESAINV96263', 'Menunggu', 'images.jpeg'),
(13, 3, 7, 4, 920000, 'NESAINV42917', 'Menunggu', ''),
(14, 5, 16, 4, 5030000, 'NESAINV59766', 'Ditolak', 'images.jpeg'),
(15, 5, 7, 1, 5030000, 'NESAINV59766', 'Ditolak', 'images.jpeg'),
(16, 7, 17, 4, 136000000, 'NESAINV82280', 'Disetujui', 'logo.png'),
(17, 7, 15, 2, 1800000, 'NESAINV30216', 'Ditolak', 'logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `kategori`) VALUES
(2, 'Laptop'),
(3, 'Fashion'),
(4, 'Handphone'),
(5, 'Printer'),
(9, 'Rumah Tangga');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id_produk` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `merk` varchar(64) NOT NULL,
  `harga` bigint(16) NOT NULL,
  `qty` bigint(16) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `deskripsi` varchar(512) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_produk`, `nama`, `merk`, `harga`, `qty`, `id_kategori`, `deskripsi`, `gambar`) VALUES
(4, 'Xiaomi Redmi 4X 3/32', 'Xiaomi', 1000000, 7, 4, 'OKe', 'Redmi 4x.png'),
(5, 'Xiaomi Redmi 4A 2/16', 'Xiaomi', 800000, 90, 4, 'WOw', 'Redmi 4a.png'),
(6, 'Ink Toner Epson', 'Epson OEM', 800000, 91, 5, 'Keren', 'Toner Ink Canon FX10.png'),
(7, 'Blazer Pria', 'Pro ATT', 230000, 81, 3, 'Baru', 'Blazer.png'),
(8, 'Macbook Pro 2017', 'Apple Mac', 17000000, 81, 2, 'Baru', 'Macbook PRO 2017.png'),
(10, 'Printer Epson New', 'Epsonaa', 450000, 89, 0, 'Barang Baru Beli', 'Printer Epson.png'),
(13, 'iPhone 11', 'iPhone', 13000000, 90, 4, 'Wow', 'iPhone XI.png'),
(14, 'Mouse Votre Gaming', 'Votre', 25000, 1000, 2, 'Wow', 'Mouse Votre.png'),
(15, 'Nokia 3310 Legendary', 'Nokia', 900000, 98, 2, 'Barang Langka', 'Nokia 3310.png'),
(16, 'Asus Zenfone 5', 'Asus', 1200000, 496, 4, 'Barang NEw', 'Asus Zenfone 5.jpg'),
(17, 'Asus ROG Gaming Series', 'Asus', 34000000, 36, 2, 'Gaming Lanjay', 'Asus ROG.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usr`
--

CREATE TABLE `tbl_usr` (
  `id_usr` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `notel` bigint(16) NOT NULL,
  `norek` bigint(16) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_usr`
--

INSERT INTO `tbl_usr` (`id_usr`, `nama`, `username`, `email`, `password`, `alamat`, `notel`, `norek`, `gambar`) VALUES
(3, 'Akbar Satrio Yudho', 'akbarsatrio', 'akbarganteng@mail.com', '$2y$10$RjuELmI6dOchyytTFX9LDO7nM3F99LB2laIRUZkeu6vnknleiUH.m', 'Jl. Mulu jadian kaga', 123456, 123456, 'images.jpeg'),
(6, 'Adrian', 'adrian', 'adrian@mail.com', '$2y$10$CtpJkQQd8yvjDMfEH7C6De23tZTIHZ1iuxouV8DL0nIPyAEepUI/2', 'Jl. Kp Kelapa', 81513209226, 81513209226, 'unduhan.jpg'),
(7, 'Akbar Satrio Yudho', 'akbar', 'akbarsatrio@mail.com', '$2y$10$f56vPXzeM4KWJy9qbI0EAOnu1jheS.y8kduqs7GyxStlWKWpnaEIy', 'Jl. Mana Aja', 81513209226, 81513209219, 'unduhan.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_adm`
--
ALTER TABLE `tbl_adm`
  ADD PRIMARY KEY (`id_adm`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indexes for table `tbl_inv`
--
ALTER TABLE `tbl_inv`
  ADD PRIMARY KEY (`id_inv`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `tbl_usr`
--
ALTER TABLE `tbl_usr`
  ADD PRIMARY KEY (`id_usr`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_adm`
--
ALTER TABLE `tbl_adm`
  MODIFY `id_adm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_inv`
--
ALTER TABLE `tbl_inv`
  MODIFY `id_inv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_usr`
--
ALTER TABLE `tbl_usr`
  MODIFY `id_usr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

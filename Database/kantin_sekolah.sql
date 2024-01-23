-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2024 at 08:21 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kantin_sekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis_menu`
--

CREATE TABLE `tbl_jenis_menu` (
  `id_jenis_menu` int(11) NOT NULL,
  `jenis_menu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_jenis_menu`
--

INSERT INTO `tbl_jenis_menu` (`id_jenis_menu`, `jenis_menu`) VALUES
(6, 'Makanan'),
(7, 'Minuman'),
(10, 'Camilan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `kode_login` int(11) NOT NULL,
  `kode_member` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`kode_login`, `kode_member`, `username`, `password`) VALUES
(1, 2, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(32, 37, 'Muhromin', '827ccb0eea8a706c4c34a16891f84e7b'),
(33, 42, 'Rara', '827ccb0eea8a706c4c34a16891f84e7b'),
(34, 38, 'Andhika', '827ccb0eea8a706c4c34a16891f84e7b'),
(35, 40, 'Mada', '827ccb0eea8a706c4c34a16891f84e7b'),
(36, 46, 'kantin1', '827ccb0eea8a706c4c34a16891f84e7b'),
(37, 41, 'Michella', '827ccb0eea8a706c4c34a16891f84e7b'),
(38, 50, 'Ayu', '827ccb0eea8a706c4c34a16891f84e7b'),
(39, 48, 'Farida', '827ccb0eea8a706c4c34a16891f84e7b'),
(40, 49, 'Zaenal', '827ccb0eea8a706c4c34a16891f84e7b'),
(41, 47, 'Sri', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `kode_member` int(11) NOT NULL,
  `nama_tenant` varchar(100) NOT NULL,
  `nama_member` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kode_kelas` int(11) NOT NULL,
  `telp` varchar(75) NOT NULL,
  `deposit` int(11) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `kode` int(11) NOT NULL DEFAULT 1,
  `kode_password` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`kode_member`, `nama_tenant`, `nama_member`, `alamat`, `kode_kelas`, `telp`, `deposit`, `photo`, `kode`, `kode_password`) VALUES
(37, '', 'Muhromin', '', 0, '082244623402', 50000, '17012024065930male.png', 1, 2),
(38, '', 'Andhika Putra', '', 0, '086654563452', 30000, '17012024070007male.png', 1, 2),
(40, '', 'Mada Nur F', '', 0, '082345735235', 60000, '17012024070143male.png', 1, 2),
(41, '', 'Michella Sinta P', '', 0, '085345648763', 80000, '17012024070256female.png', 1, 2),
(42, '', 'Rara Aulia N', '', 0, '085234537654', 100000, '17012024070336female.png', 1, 2),
(46, 'Kantin 1', 'Yanti', 'Bojonegoro', 0, '082276563456', 200000, '17012024071510female.png', 2, 2),
(47, 'Kantin 2', 'Sri', 'Bojonegoro', 0, '081223657896', 300000, '17012024071557female.png', 2, 2),
(48, 'Kantin 3', 'Farida', 'Bojonegoro', 0, '081234567654', 200000, '17012024071655female.png', 2, 2),
(49, 'Kantin 4', 'Zaenal', 'Bojonegoro', 0, '08128765432', 100000, '17012024071758male.png', 2, 2),
(50, 'Kantin 5', 'Ayu', 'Bojonegoro', 0, '082235678765', 250000, '17012024072019female.png', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(200) NOT NULL,
  `id_jenis_menu` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `jual` int(11) NOT NULL,
  `pesan` int(11) NOT NULL,
  `img` varchar(200) NOT NULL,
  `kode_tenant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`id_menu`, `nama_menu`, `id_jenis_menu`, `harga`, `qty`, `jual`, `pesan`, `img`, `kode_tenant`) VALUES
(30, 'Seblak', 6, 5000, 30, 1, 0, '17012024072636seblak.jpg', 46),
(31, 'Jus Jeruk', 7, 3000, 30, 1, 0, '17012024072725Jus Jeruk.jpg', 46),
(32, 'Pisang Krispi', 10, 5000, 20, 0, 0, '17012024072851Pisang-Cripsy.jpg', 50),
(33, 'Makroni', 10, 3000, 20, 1, 0, '17012024072958Makroni.jpg', 50),
(34, 'Es Campur', 7, 5000, 20, 0, 0, '17012024073038Es Campur.jpg', 50),
(35, 'Jus Alpukat', 7, 6000, 20, 0, 0, '17012024073626Jus Alpuket.jpg', 48),
(37, 'Roti Lapis', 10, 5000, 15, 0, 0, '17012024073935Roti Lapis.jpg', 48),
(38, 'Bakso', 6, 6000, 30, 1, 0, '17012024074059bakso.jpg', 49),
(39, 'Soto', 6, 6000, 20, 0, 0, '17012024074550soto.jpg', 49),
(40, 'Es Teh', 7, 3000, 20, 2, 0, '17012024074622es teh.jpg', 49),
(41, 'Keripik Singkong', 10, 3000, 20, 0, 0, '17012024075222keripik.jpg', 46),
(42, 'Donat', 10, 2500, 20, 0, 0, '17012024075444donat.jpg', 46);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `no_transaksi` varchar(100) NOT NULL,
  `total_transaksi` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `kode_member` int(11) NOT NULL,
  `kode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id_transaksi`, `tgl_transaksi`, `no_transaksi`, `total_transaksi`, `total_bayar`, `kode_member`, `kode`) VALUES
(1, '2024-01-14', '20240114000000001', 6000, 6000, 31, 1),
(2, '2024-01-15', '20240115000000002', 2500, 0, 31, 1),
(3, '2024-01-17', '20240117000000003', 9000, 9000, 37, 1),
(5, '2024-01-17', '20240117000000004', 6000, 6000, 40, 1),
(6, '2024-01-17', '20240117000000006', 8000, 8000, 42, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi_detail`
--

CREATE TABLE `tbl_transaksi_detail` (
  `id_detail` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `no_transaksi` varchar(100) NOT NULL,
  `kode_member` int(11) NOT NULL,
  `kode_tenant` int(11) NOT NULL,
  `dikerjakan` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transaksi_detail`
--

INSERT INTO `tbl_transaksi_detail` (`id_detail`, `qty`, `harga`, `id_menu`, `no_transaksi`, `kode_member`, `kode_tenant`, `dikerjakan`) VALUES
(1, 1, 6000, 27, '20240114000000001', 31, 32, ''),
(2, 1, 2500, 28, '20240115000000002', 31, 34, ''),
(3, 1, 6000, 38, '20240117000000003', 37, 49, ''),
(4, 1, 3000, 40, '20240117000000003', 37, 49, ''),
(6, 1, 3000, 33, '20240117000000004', 40, 50, ''),
(7, 1, 3000, 31, '20240117000000004', 40, 46, ''),
(8, 1, 5000, 30, '20240117000000006', 42, 46, ''),
(9, 1, 3000, 40, '20240117000000006', 42, 49, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_jenis_menu`
--
ALTER TABLE `tbl_jenis_menu`
  ADD PRIMARY KEY (`id_jenis_menu`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`kode_login`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`kode_member`);

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD UNIQUE KEY `no_transaksi` (`no_transaksi`);

--
-- Indexes for table `tbl_transaksi_detail`
--
ALTER TABLE `tbl_transaksi_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_jenis_menu`
--
ALTER TABLE `tbl_jenis_menu`
  MODIFY `id_jenis_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `kode_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `kode_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_transaksi_detail`
--
ALTER TABLE `tbl_transaksi_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

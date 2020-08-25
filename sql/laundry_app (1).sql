-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2020 at 11:48 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `alur`
--

CREATE TABLE `alur` (
  `alur_id` int(11) NOT NULL,
  `alur_kd` varchar(255) NOT NULL,
  `alur_order` varchar(255) NOT NULL,
  `alur_waktu` datetime NOT NULL,
  `alur_operator` varchar(255) NOT NULL,
  `alur_event` varchar(255) NOT NULL,
  `alur_caption` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alur`
--

INSERT INTO `alur` (`alur_id`, `alur_kd`, `alur_order`, `alur_waktu`, `alur_operator`, `alur_event`, `alur_caption`) VALUES
(1, 'fGgtRTkpIajZNUc', 'IT824390KTQY', '2020-08-23 19:05:06', 'Rusly Nur Huda', 'registrasi_cucian', 'Cucian telah diregistrasi'),
(2, 'GFyXOnudKMVoNmp', 'IT824390KTQY', '2020-08-23 19:05:34', 'Rusly Nur Huda', 'mulai_cuci', 'Cucian masuk ruang cuci'),
(3, 'okhrzAJlHdQpsLm', 'IT824390KTQY', '2020-08-23 19:05:59', 'Rusly Nur Huda', 'cucian_selesai', 'Cucian telah selesai'),
(4, 'WEInJUaGdgxMozk', 'IT824390KTQY', '2020-08-23 19:06:40', 'Rusly Nur Huda', 'pembayaran_selesai', 'Pembayaran telah dilakuan'),
(5, 'lHyFxojZwmMpNYe', 'IT824390KTQY', '2020-08-23 19:10:32', 'Rusly Nur Huda', 'cucian_diambil', 'Cucian telah diambil Pelanggan'),
(6, 'CZgakFLVwryNMjx', 'PU378129VQSH', '2020-08-23 19:31:39', 'Rusly Nur Huda', 'registrasi_cucian', 'Cucian telah diregistrasi'),
(7, 'YepTZaAoSiEQBKr', 'PU378129VQSH', '2020-08-23 19:32:02', 'Rusly Nur Huda', 'mulai_cuci', 'Cucian masuk ruang cuci'),
(8, 'BEdgakoXGYWbOqF', 'PU378129VQSH', '2020-08-23 19:33:17', 'Rusly Nur Huda', 'cucian_selesai', 'Cucian telah selesai'),
(9, 'izRahmQIBlrXktJ', 'PU378129VQSH', '2020-08-23 19:34:47', 'Rusly Nur Huda', 'pembayaran_selesai', 'Pembayaran telah dilakuan'),
(10, 'DoSPsvxNkzjWLqF', 'PU378129VQSH', '2020-08-23 19:48:43', 'Rusly Nur Huda', 'cucian_diambil', 'Cucian telah diambil Pelanggan'),
(11, 'OFToRqtLmKaCGAM', 'SZ246013SWEH', '2020-08-24 07:09:38', 'Rusly Nur Huda', 'registrasi_cucian', 'Cucian telah diregistrasi'),
(12, 'sReyCvlGkWZqKiO', 'SZ246013SWEH', '2020-08-24 07:10:14', 'Rusly Nur Huda', 'mulai_cuci', 'Cucian masuk ruang cuci'),
(13, 'APTBXqpHCYQVgRs', 'SZ246013SWEH', '2020-08-24 07:22:34', 'Rusly Nur Huda', 'cucian_selesai', 'Cucian telah selesai'),
(14, 'MUVSeIfPghoGOjz', 'SZ246013SWEH', '2020-08-24 07:23:44', 'Rusly Nur Huda', 'pembayaran_selesai', 'Pembayaran telah dilakuan'),
(15, 'hvwiJaDYuyjfKGO', 'SZ246013SWEH', '2020-08-24 07:24:35', 'Rusly Nur Huda', 'cucian_diambil', 'Cucian telah diambil Pelanggan');

-- --------------------------------------------------------

--
-- Table structure for table `cuci`
--

CREATE TABLE `cuci` (
  `cuci_id` int(11) NOT NULL,
  `cuci_kd` varchar(255) NOT NULL,
  `cuci_order` varchar(255) NOT NULL,
  `cuci_operator` varchar(255) NOT NULL,
  `cuci_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cuci`
--

INSERT INTO `cuci` (`cuci_id`, `cuci_kd`, `cuci_order`, `cuci_operator`, `cuci_status`) VALUES
(1, 'AOS874019QDF', 'IT824390KTQY', 'Rusly Nur Huda', 'selesai'),
(2, 'GNA892430GNF', 'PU378129VQSH', 'Rusly Nur Huda', 'selesai'),
(3, 'TKC230158FET', 'SZ246013SWEH', 'Rusly Nur Huda', 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `orderan`
--

CREATE TABLE `orderan` (
  `orderan_id` int(11) NOT NULL,
  `orderan_kd` varchar(255) NOT NULL,
  `orderan_pelanggan` varchar(255) NOT NULL,
  `orderan_date` date NOT NULL,
  `orderan_masuk` datetime NOT NULL,
  `orderan_selesai` datetime DEFAULT NULL,
  `orderan_diambil` datetime DEFAULT NULL,
  `orderan_pembayaran` varchar(255) NOT NULL,
  `orderan_operator` varchar(255) NOT NULL,
  `orderan_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderan`
--

INSERT INTO `orderan` (`orderan_id`, `orderan_kd`, `orderan_pelanggan`, `orderan_date`, `orderan_masuk`, `orderan_selesai`, `orderan_diambil`, `orderan_pembayaran`, `orderan_operator`, `orderan_status`) VALUES
(1, 'IT824390KTQY', '4', '2020-08-23', '2020-08-23 19:05:06', '2020-08-23 19:05:59', '2020-08-23 19:10:32', 'selesai', 'Rusly Nur Huda', 'selesai'),
(2, 'PU378129VQSH', '5', '2020-08-23', '2020-08-23 19:31:39', '2020-08-23 19:33:17', '2020-08-23 19:48:43', 'selesai', 'Rusly Nur Huda', 'selesai'),
(3, 'SZ246013SWEH', '4', '2020-08-24', '2020-08-24 07:09:38', '2020-08-24 07:22:34', '2020-08-24 07:24:35', 'selesai', 'Rusly Nur Huda', 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `outlet`
--

CREATE TABLE `outlet` (
  `outlet_id` int(11) NOT NULL,
  `outlet_kd` varchar(255) NOT NULL,
  `outlet_nama` varchar(255) NOT NULL,
  `outlet_alamat` varchar(255) NOT NULL,
  `outlet_telp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outlet`
--

INSERT INTO `outlet` (`outlet_id`, `outlet_kd`, `outlet_nama`, `outlet_alamat`, `outlet_telp`) VALUES
(4, 'PC2168347IKC', 'Outlet Cabang Bantul', 'Jalan Bantul Km 125', '087961826338');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `pelanggan_id` int(11) NOT NULL,
  `pelanggan_kd` varchar(255) NOT NULL,
  `pelanggan_nama` varchar(255) NOT NULL,
  `pelanggan_alamat` varchar(255) NOT NULL,
  `pelanggan_jk` varchar(255) NOT NULL,
  `pelanggan_telp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`pelanggan_id`, `pelanggan_kd`, `pelanggan_nama`, `pelanggan_alamat`, `pelanggan_jk`, `pelanggan_telp`) VALUES
(4, '0002365981', 'RUSLY NUR HUDA', 'Bantul, Yogyakarta', 'Laki - Laki', '089616727752'),
(5, '0003702864', 'PELANGGAN', 'Bantul, Yogyakarta', 'Laki - Laki', '089616727752');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `pembayaran_id` int(11) NOT NULL,
  `pembayaran_kd` varchar(255) NOT NULL,
  `pembayaran_order` varchar(255) NOT NULL,
  `pembayaran_date` date NOT NULL,
  `pembayaran_waktu` datetime NOT NULL,
  `pembayaran_total` int(11) NOT NULL,
  `pembayaran_final` int(11) NOT NULL,
  `pembayaran_tunai` int(11) NOT NULL,
  `pembayaran_operator` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`pembayaran_id`, `pembayaran_kd`, `pembayaran_order`, `pembayaran_date`, `pembayaran_waktu`, `pembayaran_total`, `pembayaran_final`, `pembayaran_tunai`, `pembayaran_operator`) VALUES
(1, 'INV200823KL07', 'IT824390KTQY', '2020-08-23', '2020-08-23 19:06:40', 27000, 28350, 30000, 'Rusly Nur Huda'),
(2, 'INV200823TV13', 'PU378129VQSH', '2020-08-23', '2020-08-23 19:34:47', 8000, 8400, 10000, 'Rusly Nur Huda'),
(3, 'INV200824QF79', 'SZ246013SWEH', '2020-08-24', '2020-08-24 07:23:44', 28000, 29400, 30000, 'Rusly Nur Huda');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(11) NOT NULL,
  `service_kd` varchar(255) NOT NULL,
  `service_nama` varchar(255) NOT NULL,
  `service_deks` varchar(255) NOT NULL,
  `service_satuan` varchar(10) NOT NULL,
  `service_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `service_kd`, `service_nama`, `service_deks`, `service_satuan`, `service_harga`) VALUES
(1, 'ST743', 'Cuci biasa', 'Cuci biasa tanpa setrika', 'kg', 4000),
(2, 'RQ509', 'Cuci Rapi', 'Cuci + Setrika', 'kg', 8000),
(3, 'PX142', 'Cuci Karpet', 'Service Cuci Karpet ', 'Pcs', 15000);

-- --------------------------------------------------------

--
-- Table structure for table `tampung`
--

CREATE TABLE `tampung` (
  `tampung_id` int(11) NOT NULL,
  `tampung_kd` varchar(255) NOT NULL,
  `tampung_cuci` varchar(255) NOT NULL,
  `tampung_service` varchar(255) NOT NULL,
  `tampung_qt` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tampung`
--

INSERT INTO `tampung` (`tampung_id`, `tampung_kd`, `tampung_cuci`, `tampung_service`, `tampung_qt`) VALUES
(1, '1bupG2fqIZn7FvJ', '1', 'ST743', 1),
(2, 'rpc1uK62hIMAJNV', '1', 'RQ509', 1),
(3, '9VECXyqOvep6gcn', '1', 'PX142', 1),
(4, 'uFiID2lTGNdJksp', '2', 'RQ509', 1),
(5, 'wtbmUCGsvSBX9JO', '3', 'RQ509', 3.5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) DEFAULT NULL,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `outlet_id` int(11) DEFAULT NULL,
  `role` enum('Admin','Kasir','Owner') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `outlet_id`, `role`) VALUES
(1, 'Rusly Nur Huda', 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, 'Admin'),
(20, 'Owner', 'owner', '72122ce96bfec66e2396d2e25225d70a', 4, 'Owner'),
(21, 'kasir', 'kasir', 'c7911af3adbd12a035b289556d96470a', 4, 'Kasir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alur`
--
ALTER TABLE `alur`
  ADD PRIMARY KEY (`alur_id`),
  ADD KEY `alur_order` (`alur_order`);

--
-- Indexes for table `cuci`
--
ALTER TABLE `cuci`
  ADD PRIMARY KEY (`cuci_id`),
  ADD UNIQUE KEY `cuci_kd` (`cuci_kd`),
  ADD KEY `cuci_order` (`cuci_order`);

--
-- Indexes for table `orderan`
--
ALTER TABLE `orderan`
  ADD PRIMARY KEY (`orderan_id`),
  ADD UNIQUE KEY `orderan_kd` (`orderan_kd`);

--
-- Indexes for table `outlet`
--
ALTER TABLE `outlet`
  ADD PRIMARY KEY (`outlet_id`),
  ADD UNIQUE KEY `outlet_kd` (`outlet_kd`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`pelanggan_id`),
  ADD UNIQUE KEY `pelanggan_kd` (`pelanggan_kd`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`pembayaran_id`),
  ADD UNIQUE KEY `pembayaran_kd` (`pembayaran_kd`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`),
  ADD UNIQUE KEY `service_kd` (`service_kd`);

--
-- Indexes for table `tampung`
--
ALTER TABLE `tampung`
  ADD PRIMARY KEY (`tampung_id`),
  ADD UNIQUE KEY `tampung_kd` (`tampung_kd`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `outlet_id` (`outlet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alur`
--
ALTER TABLE `alur`
  MODIFY `alur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cuci`
--
ALTER TABLE `cuci`
  MODIFY `cuci_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orderan`
--
ALTER TABLE `orderan`
  MODIFY `orderan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `outlet`
--
ALTER TABLE `outlet`
  MODIFY `outlet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `pelanggan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `pembayaran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tampung`
--
ALTER TABLE `tampung`
  MODIFY `tampung_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2023 at 05:40 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aulakoronka`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryid` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `price` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryid`, `category`, `price`) VALUES
(1, 'Wedding 100pax', 11000000),
(2, 'Wedding 200pax', 12000000),
(3, 'Wedding 300pax', 13000000),
(4, 'Graduation 500pax', 7500000),
(5, 'Conference', 15500000),
(6, 'Wedding > 500pax', 15000000),
(7, 'Birthday 100pax', 6000000),
(9, 'Wedding 400 Pax', 14000000),
(10, 'Wedding 450 pax', 14500000),
(11, 'Conference 50 pax', 2500000),
(12, 'Wedding 350 Pax', 13500000),
(13, 'wedding 250 pax', 12500000);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerid`, `name`, `telp`, `address`) VALUES
(23, 'Titi Imbang', '+886979944812', NULL),
(24, 'Abraham Ciquita', '082187099839', NULL),
(25, 'Om Kuba', '082189584843', 'paslaten'),
(26, 'Fabian & Friska', '081526167677', NULL),
(27, 'christian', '08114320293', NULL),
(28, 'wilson switry', '085242677044', NULL),
(29, 'ryan lingkan', '085242841531', NULL),
(30, 'aldy novelia', '085240484238', NULL),
(31, 'james iin', '08114343192', NULL),
(32, 'maria mami', '081123456', NULL),
(33, 'jilly fekon', '082338901000', NULL),
(34, 'Kristy', '081340681181', NULL),
(35, 'Ibu etha', '085298443663', NULL),
(36, 'Bpk Daniel', '085256144002', NULL),
(37, 'Ricky n Nathalia (Petrus Siwi)', '082111177060', NULL),
(38, 'Randy & Maudy', '08993775075', NULL),
(39, 'alva n monika', '081348976075', NULL),
(40, 'reiner', '085240850308', NULL),
(41, 'Marcel n Trini', '082133979084', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `customerid` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `date` date NOT NULL,
  `numberofpeople` int(11) DEFAULT NULL,
  `theme` varchar(100) DEFAULT NULL,
  `vendor` text DEFAULT NULL,
  `information` text DEFAULT NULL,
  `start` time DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `eventid` varchar(7) NOT NULL,
  `userlog` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`customerid`, `categoryid`, `date`, `numberofpeople`, `theme`, `vendor`, `information`, `start`, `discount`, `createdate`, `eventid`, `userlog`) VALUES
(14, 1, '2020-09-08', 100, 'Kuning', 'Bridal: ABC\r\nCatering: XYZ', 'No Gladi', '11:30:00', 0, '2020-08-11 05:30:54', 'AK00001', NULL),
(15, 2, '2020-09-25', 200, 'Red and Gold', 'Vendor LKN', 'Gladi h-1', '16:36:00', 1000000, '2020-08-11 05:31:58', 'AK00002', NULL),
(16, 3, '2020-11-19', 280, 'Kuning Biru', '', '', '00:00:00', 0, '2020-08-11 05:32:32', 'AK00003', NULL),
(20, 3, '2020-08-31', 250, 'Red and Gold', 'Vendor A', 'Information B', '17:41:00', 250000, '2020-08-11 07:38:12', 'AK00007', NULL),
(21, 6, '2020-10-03', 800, 'Putih silver', '', '', '00:00:00', 2000000, '2020-08-11 07:47:32', 'AK00008', NULL),
(22, 5, '2020-08-30', 1000, 'Merah Biru', 'Vendor ABC\r\nVendor XYZ', 'Gladi h-1\r\ndekorasi h-2', '08:30:00', 500000, '2020-08-11 08:01:51', 'AK00009', NULL),
(23, 3, '2020-11-12', 300, '', '', 'Tante Lusi 500.000 (komisi)', '18:30:00', 500000, '2020-11-01 13:36:37', 'AK00010', NULL),
(24, 3, '2020-11-14', 300, '', '', '', '18:30:00', 0, '2020-11-01 13:38:54', 'AK00011', NULL),
(25, 3, '2020-11-20', 300, '', '', '', '00:00:00', 13000000, '2020-11-01 14:25:31', 'AK00012', NULL),
(26, 3, '2020-11-22', 300, '', '', '', '00:00:00', 0, '2020-11-01 14:28:07', 'AK00013', NULL),
(27, 9, '2020-11-28', 400, '', '', '', '00:00:00', 500000, '2020-11-01 14:33:08', 'AK00014', NULL),
(28, 2, '2020-12-02', 250, '', '', '', '00:00:00', 0, '2020-11-01 14:36:29', 'AK00015', NULL),
(29, 3, '2020-12-05', 300, '', '', 'cp michael', '00:00:00', 0, '2020-11-01 14:38:22', 'AK00016', NULL),
(30, 10, '2020-12-08', 450, '', '', '', '00:00:00', 0, '2020-11-01 14:40:41', 'AK00017', NULL),
(31, 9, '2020-12-13', 400, '', '', 'komisi tante eke 500000 ', '00:00:00', 500000, '2020-11-01 14:42:18', 'AK00018', NULL),
(33, 11, '2020-11-02', 50, '', '', '', '00:00:00', 0, '2020-11-01 14:48:51', 'AK00019', NULL),
(34, 3, '2021-02-12', 300, '', '', 'Atau 27-02-2020', '00:00:00', 0, '2020-11-02 06:20:58', 'AK00020', NULL),
(35, 3, '2021-01-05', 300, '', '', '', '00:00:00', 0, '2020-11-10 13:00:57', 'AK00021', NULL),
(36, 12, '2020-11-17', 350, '', '', '', '00:00:00', 500000, '2020-11-10 13:55:47', 'AK00022', NULL),
(37, 12, '2020-12-19', 350, '', '', '', '00:00:00', 0, '2020-11-18 11:51:21', 'AK00023', NULL),
(38, 3, '2021-02-05', 300, '', '', '', '00:00:00', 0, '2020-12-05 13:46:28', 'AK00024', NULL),
(39, 13, '2021-01-08', 250, '', '', '', '00:00:00', 0, '2020-12-05 08:04:33', 'AK00025', NULL),
(40, 3, '2021-01-21', 300, '', '', '', '00:00:00', 0, '2020-12-05 13:43:52', 'AK00026', NULL),
(41, 3, '2021-02-20', 300, '', '', '', '00:00:00', 0, '2020-12-05 13:47:11', 'AK00027', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventoryid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchasedate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventoryid`, `name`, `quantity`, `purchasedate`) VALUES
(1, 'Mic', 2, '2019-08-05'),
(2, 'Kotak Ampao Merah', 2, '2018-03-11'),
(3, 'Speaker', 7, '2017-05-14'),
(4, 'Mixer tipe abc', 1, '2019-08-14'),
(5, 'Round table', 60, '2017-02-15'),
(6, 'Meja Catering', 10, '2017-06-09');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `idlevel` int(3) NOT NULL,
  `namalevel` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`idlevel`, `namalevel`) VALUES
(1, 'admin'),
(2, 'owner'),
(3, 'guest'),
(7, 'usertest');

-- --------------------------------------------------------

--
-- Table structure for table `level_menuadmin`
--

CREATE TABLE `level_menuadmin` (
  `id` int(3) NOT NULL,
  `idlevel` int(3) NOT NULL,
  `idadminmenu` int(3) NOT NULL,
  `cancreate` enum('0','1') NOT NULL DEFAULT '0',
  `canread` enum('0','1') NOT NULL DEFAULT '0',
  `canupdate` enum('0','1') NOT NULL DEFAULT '0',
  `candelete` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level_menuadmin`
--

INSERT INTO `level_menuadmin` (`id`, `idlevel`, `idadminmenu`, `cancreate`, `canread`, `canupdate`, `candelete`) VALUES
(1, 1, 1, '1', '1', '1', '1'),
(2, 1, 5, '1', '1', '1', '1'),
(3, 1, 6, '1', '1', '1', '1'),
(4, 1, 7, '1', '1', '1', '1'),
(5, 1, 8, '1', '1', '1', '1'),
(6, 1, 9, '1', '1', '1', '1'),
(7, 1, 10, '1', '1', '1', '1'),
(8, 1, 11, '1', '1', '1', '1'),
(9, 1, 12, '1', '1', '1', '1'),
(10, 1, 13, '1', '1', '1', '1'),
(11, 2, 5, '1', '1', '1', '1'),
(12, 2, 6, '1', '1', '1', '1'),
(13, 2, 7, '1', '1', '1', '1'),
(14, 2, 8, '1', '1', '1', '1'),
(15, 2, 9, '1', '1', '1', '1'),
(20, 3, 5, '1', '1', '0', '0'),
(21, 3, 6, '0', '1', '0', '0'),
(22, 3, 7, '0', '1', '0', '0'),
(23, 3, 8, '0', '1', '0', '0'),
(24, 3, 9, '0', '1', '0', '0'),
(25, 3, 10, '0', '1', '0', '0'),
(26, 3, 11, '0', '1', '0', '0'),
(27, 3, 12, '0', '1', '0', '0'),
(28, 3, 13, '0', '1', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `idlevel` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `nama`, `email`, `idlevel`) VALUES
('admin', '827ccb0eea8a706c4c34a16891f84e7b', 'Administrator', 'admin@localhost.com', 1),
('gongsoo', '151ffd91fda860be995a627ac9bbe3cb', 'Reinaldo Tumbelaka', 'giovanny.rein@gmail.com', 1),
('hawkiegaming', '81dc9bdb52d04dc20036dbd8313ed055', 'Maria', 'vgeen88@gmail.com', 3),
('maria', '263bce650e68ab4e23f28263760b9fa5', 'maria', 'maria@yahoo.com', 7),
('testuser test', '85f0fb9cc2792a9b87e3b3facccedc40', 'test user', 'testuser@gmail.com', 3);

-- --------------------------------------------------------

--
-- Table structure for table `menuadmin`
--

CREATE TABLE `menuadmin` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(10) UNSIGNED DEFAULT 0,
  `create` char(1) COLLATE utf8_unicode_ci DEFAULT '1' COMMENT '1 = aktif',
  `read` char(1) COLLATE utf8_unicode_ci DEFAULT '1' COMMENT '1 = aktif',
  `update` char(1) COLLATE utf8_unicode_ci DEFAULT '1' COMMENT '1 = aktif',
  `del` char(1) COLLATE utf8_unicode_ci DEFAULT '1' COMMENT '1 = aktif',
  `active` char(50) COLLATE utf8_unicode_ci DEFAULT '0' COMMENT '1 = aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `menuadmin`
--

INSERT INTO `menuadmin` (`id`, `name`, `url`, `parent`, `create`, `read`, `update`, `del`, `active`) VALUES
(1, 'Master', '#', 0, '0', '0', '0', '0', '1'),
(2, 'Transaksi', '#', 0, '0', '0', '0', '0', '1'),
(3, 'Laporan', '#', 0, '0', '0', '0', '0', '1'),
(4, 'Setting', '#', 0, '0', '0', '0', '0', '1'),
(5, 'Customer', 'Customer', 1, '1', '1', '1', '1', '1'),
(6, 'Event Category', 'Eventcategory', 1, '1', '1', '1', '1', '1'),
(7, 'Inventory', 'Inventory', 1, '1', '1', '1', '1', '1'),
(8, 'Book Event', 'Bookevent', 2, '1', '1', '1', '1', '1'),
(10, 'User Level', 'Level', 4, '1', '1', '1', '1', '1'),
(11, 'User', 'User', 4, '1', '1', '1', '1', '1'),
(12, 'Menu', 'Menu', 4, '1', '1', '1', '1', '1'),
(13, 'Menu Level Access', 'Levelmenu', 4, '1', '1', '1', '1', '1'),
(14, 'Inventory', 'Lapinventory', 3, '1', '1', '1', '1', '1'),
(15, 'Event', 'Lapevent', 3, '1', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `paymentid` int(11) NOT NULL,
  `eventid` varchar(7) NOT NULL,
  `date` date NOT NULL,
  `paymentmethod` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `information` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`paymentid`, `eventid`, `date`, `paymentmethod`, `amount`, `information`) VALUES
(38, 'AK00010', '2020-11-01', 2, 1250000, 'BNI - Maria Tuerah'),
(39, 'AK00011', '2020-11-01', 2, 1300000, 'BNI - Maria Tuerah'),
(40, 'AK00012', '2020-11-01', 1, 13000000, ''),
(41, 'AK00013', '2020-11-01', 1, 1300000, 'panjar'),
(42, 'AK00014', '2020-11-01', 1, 1350000, 'panjar'),
(43, 'AK00015', '2020-11-01', 1, 1200000, 'panjar'),
(44, 'AK00016', '2020-11-01', 1, 500000, 'panjar'),
(45, 'AK00017', '2020-11-01', 1, 1450000, 'panjar'),
(46, 'AK00018', '2020-11-01', 1, 1500000, 'panjar'),
(49, 'AK00019', '2020-11-01', 1, 2500000, 'pelunasan'),
(50, 'AK00010', '2020-11-02', 2, 11250000, 'BNI IJIN 02-11-2020'),
(51, 'AK00020', '2020-11-02', 1, 3000000, 'panjar 31-03-2020'),
(52, 'AK00021', '2020-11-10', 1, 500000, 'panjar'),
(53, 'AK00022', '2020-11-10', 2, 13000000, 'BCA 06/11/2020'),
(54, 'AK00023', '2020-11-18', 1, 1350000, 'panjar 14-11-2020'),
(55, 'AK00024', '2020-11-18', 1, 13000000, 'panjar 18-11-2020'),
(56, 'AK00014', '2020-11-18', 2, 12150000, 'trf BNI Rei 17-11-2020'),
(57, 'AK00025', '2020-12-05', 2, 2500000, 'ijin trf BNI 02-12-2020'),
(58, 'AK00026', '2020-12-05', 2, 1500000, 'trf BNI ijin'),
(59, 'AK00027', '2020-12-05', 2, 1300000, 'ijin mandiri 05-12-2020');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerid`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventid`),
  ADD UNIQUE KEY `constraint_date` (`date`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventoryid`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`idlevel`);

--
-- Indexes for table `level_menuadmin`
--
ALTER TABLE `level_menuadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `menuadmin`
--
ALTER TABLE `menuadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`paymentid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `idlevel` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `level_menuadmin`
--
ALTER TABLE `level_menuadmin`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `menuadmin`
--
ALTER TABLE `menuadmin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `paymentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

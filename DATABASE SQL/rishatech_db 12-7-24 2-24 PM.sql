-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2024 at 07:24 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rishatech_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_account`
--

CREATE TABLE `admin_account` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `full_name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `verification_code` int(11) NOT NULL,
  `verify_status` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_account`
--

INSERT INTO `admin_account` (`id`, `username`, `full_name`, `email`, `password`, `verification_code`, `verify_status`) VALUES
(1, 'admin', 'Administrator', 'admin123@gmail.com', '$2y$10$QjNtiwWWC7YIt6bBYh8RuuNFaOfqEDFZeUmg3BNA5TLaHUO.nqqwy', 12345, 'Verified'),
(3, 'amielle', 'Amielle Siena', 'amiellesiena11@gmail.com', '$2y$10$2HrulYJPuFIFAt1.ALLWBOxjPa1pB97Vdia/XowewiT5zhzhD11tW', 12020, 'Verified');

-- --------------------------------------------------------

--
-- Table structure for table `appliances`
--

CREATE TABLE `appliances` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `brand_id` int(10) NOT NULL,
  `appliances_name` varchar(500) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_measurement` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appliances`
--

INSERT INTO `appliances` (`id`, `admin_id`, `brand_id`, `appliances_name`, `category_id`, `price`, `qty`, `unit_measurement`, `status`) VALUES
(2, 1, 6, 'Tupperware Lunch Bundle', 17, 300, 2, 'Bundle', 'Available'),
(3, 1, 3, 'JBL Speaker', 18, 2500, 15, 'pc/s', 'Available'),
(6, 3, 5, 'Hanabishi Electric Fan', 18, 4000, 15, 'pc/s', 'Available'),
(7, 1, 4, 'Dowell Washing Machine', 18, 9900, 7, 'pc/s', 'Available'),
(8, 1, 3, 'Sofa Set', 19, 11000, 7, 'pc/s', 'Available'),
(9, 1, 5, 'Hanabishi Electric Fan 2.0', 18, 2000, 10, 'pc/s', 'Available'),
(10, 1, 5, 'Hanabishi Electric Fan 3.0', 18, 2000, 20, 'pc/s', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `barangays`
--

CREATE TABLE `barangays` (
  `id` int(10) NOT NULL,
  `barangay_name` varchar(250) NOT NULL,
  `town_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `barangays`
--

INSERT INTO `barangays` (`id`, `barangay_name`, `town_id`, `created_at`, `updated_at`) VALUES
(1, 'Agot', 1, '2020-02-01 14:00:50', '2020-02-04 19:28:17'),
(2, 'Agumaymayan', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(3, 'Amoingon', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(4, 'Apitong', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(5, 'Balagasan', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(6, 'Balaring', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(7, 'Balimbing', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(8, 'Balogo', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(9, 'Bangbangalon', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(10, 'Bamban', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(11, 'Bantad', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(12, 'Bantay', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(13, 'Bayuti', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(14, 'Binunga', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(15, 'Boi', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(16, 'Boton', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(17, 'Buliasnin', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(18, 'Bunganay', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(19, 'Maligaya', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(20, 'Caganhao', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(21, 'Canat', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(22, 'Catubugan', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(23, 'Cawit', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(24, 'Daig', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(25, 'Daypay', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(26, 'Duyay', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(27, 'Ihatub', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(28, 'Isok I (Pob.)', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(29, 'Isok II (Pob.) (Kalamias)', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(30, 'Hinapulan', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(31, 'Laylay', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(32, 'Lupac', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(33, 'Mahinhin', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(34, 'Mainit', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(35, 'Malbog', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(36, 'Malusak (Pob.)', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(37, 'Mansiwat', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(38, 'Mataas Na Bayan (Pob.)', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(39, 'Maybo', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(40, 'Mercado (Pob.)', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(41, 'Murallon (Pob.)', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(42, 'Ogbac', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(43, 'Pawa', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(44, 'Pili', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(45, 'Poctoy', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(46, 'Poras', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(47, 'Puting Buhangin', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(48, 'Puyog', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(49, 'Sabong', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(50, 'San Miguel (Pob.)', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(51, 'Santol', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(52, 'Sawi', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(53, 'Tabi', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(54, 'Tabigue', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(55, 'Tagwak', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(56, 'Tambunan', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(57, 'Tampus (Pob.)', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(58, 'Tanza', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(59, 'Tugos', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(60, 'Tumagabok', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(61, 'Tumapon', 1, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(62, 'Antipolo', 2, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(63, 'Bachao Ibaba', 2, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(64, 'Bachao Ilaya', 2, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(65, 'Bacong-Bacong', 2, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(66, 'Bahi', 2, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(67, 'Bangbang', 2, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(68, 'Banot', 2, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(69, 'Banuyo', 2, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(70, 'Bognuyan', 2, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(71, 'Cabugao', 2, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(72, 'Dawis', 2, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(73, 'Dili', 2, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(74, 'Libtangin', 2, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(75, 'Mahunig', 2, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(76, 'Mangiliol', 2, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(77, 'Masiga', 2, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(78, 'Matandang Gasan', 2, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(79, 'Pangi', 2, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(80, 'Pinggan', 2, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(81, 'Tabionan', 2, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(82, 'Tapuyan', 2, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(83, 'Tiguion', 2, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(84, 'Barangay I (Pob.)', 2, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(85, 'Barangay II (Pob.)', 2, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(86, 'Barangay III (Pob.)', 2, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(87, 'Bagacay', 3, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(88, 'Bagtingon', 3, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(89, 'Bicas-bicas', 3, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(90, 'Caigangan', 3, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(91, 'Daykitin', 3, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(92, 'Libas', 3, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(93, 'Malbog', 3, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(94, 'Sihi', 3, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(95, 'Timbo (Sanggulong)', 3, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(96, 'Tungib-Lipata', 3, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(97, 'Yook', 3, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(98, 'Barangay I (Pob.)', 3, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(99, 'Barangay II (Pob.)', 3, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(100, 'Barangay III (Pob.)', 3, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(101, 'Barangay IV (Pob.)', 3, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(102, 'Bangwayin', 4, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(103, 'Bayakbakin', 4, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(104, 'Bolo', 4, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(105, 'Bonliw', 4, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(106, 'Buangan', 4, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(107, 'Cabuyo', 4, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(108, 'Cagpo', 4, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(109, 'Dampulan', 4, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(110, 'Kay Duke', 4, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(111, 'Mabuhay', 4, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(112, 'Makawayan', 4, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(113, 'Malibago', 4, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(114, 'Malinao', 4, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(115, 'Maranlig', 4, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(116, 'Marlangga', 4, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(117, 'Matuyatuya', 4, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(118, 'Nangka', 4, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(119, 'Pakaskasan', 4, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(120, 'Payanas', 4, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(121, 'Poblacion', 4, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(122, 'Poctoy', 4, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(123, 'Sibuyao', 4, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(124, 'Suha', 4, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(125, 'Talawan', 4, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(126, 'Tigwi', 4, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(127, 'Alobo', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(128, 'Angas-', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(129, 'Aturan', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(130, 'Bagong Silang Pob. (2nd Zone)', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(131, 'Baguidbirin', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(132, 'Baliis', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(133, 'Balogo', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(134, 'Banahaw Pob. (3rd Zone Pob.)', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(135, 'Bangcuangan', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(136, 'Banogbog', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(137, 'Biga', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(138, 'Botilao', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(139, 'Buyabod', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(140, 'Dating Bayan', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(141, 'Devilla', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(142, 'Dolores', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(143, 'Haguimit', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(144, 'Hupi', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(145, 'Ipil', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(146, 'Jolo', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(147, 'Kaganhao', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(148, 'Kalangkang', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(149, 'Kamandugan', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(150, 'Kasily', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(151, 'Kilo-kilo', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(152, 'Kinyaman', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(153, 'Labo', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(154, 'Lamesa', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(155, 'Landy(Perez)', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(156, 'Lapu-lapu Pob. (5th Zone)', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(157, 'Libjo', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(158, 'Lipa', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(159, 'Lusok', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(160, 'Maharlika Pob. (1st Zone)', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(161, 'Makulapnit', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(162, 'Maniwaya', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(163, 'Manlibunan', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(164, 'Masaguisi', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(165, 'Masalukot', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(166, 'Matalaba', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(167, 'Mongpong', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(168, 'Morales', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(169, 'Napo (Malabon)', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(170, 'Pag-Asa Pob. (4th Zone)', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(171, 'Pantayin', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(172, 'Polo', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(173, 'Pulong-Parang', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(174, 'Punong', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(175, 'SALUMANGI', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(176, 'San Antonio', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(177, 'San Isidro', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(178, 'Tagum', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(179, 'Tamayo', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(180, 'Tambangan', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(181, 'Tawiran', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(182, 'Taytay', 5, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(183, 'Anapog-Sibucao', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(184, 'Argao', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(185, 'Balanacan', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(186, 'Banto', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(187, 'Bintakay', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(188, 'Bocboc', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(189, 'Butansapa', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(190, 'Candahon', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(191, 'Capayang', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(192, 'Danao', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(193, 'Dulong Bayan (Pob.)', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(194, 'Gitnang Bayan (Pob.)', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(195, 'Guisian', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(196, 'Hinadharan', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(197, 'Hinanggayon', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(198, 'Ino', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(199, 'Janagdong', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(200, 'Lamesa', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(201, 'Laon', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(202, 'Magapua', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(203, 'Malayak', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(204, 'Malusak', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(205, 'Mampaitan', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(206, 'Mangyan-Mababad', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(207, 'Market Site (Pob.)', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(208, 'Mataas Na Bayan (Pob.)', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(209, 'Mendez', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(210, 'Nangka I (Pob.)', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(211, 'Nangka II', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(212, 'Paye', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(213, 'Pili', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(214, 'Puting Buhangin', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(215, 'Sayao', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(216, 'Silangan', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(217, 'Sumangga', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(218, 'Tarug', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00'),
(219, 'Villa Mendez (Pob.)', 6, '2020-02-01 14:00:50', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `brand_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `admin_id`, `brand_name`) VALUES
(3, 1, 'JBL'),
(4, 1, 'Dowell'),
(5, 1, 'Hanabishi'),
(6, 1, 'Brand X');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `admin_id`, `cat_name`) VALUES
(17, 3, 'Kitchenware'),
(18, 1, 'Appliances'),
(19, 1, 'furniture');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `credit_limit` double NOT NULL DEFAULT 0,
  `full_name` varchar(500) NOT NULL,
  `complete_address` varchar(500) NOT NULL,
  `municipality` varchar(500) NOT NULL,
  `barangay` varchar(500) NOT NULL,
  `street_name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `age` int(11) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `citizenship` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_registered` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `admin_id`, `user_id`, `credit_limit`, `full_name`, `complete_address`, `municipality`, `barangay`, `street_name`, `email`, `phone_number`, `age`, `civil_status`, `citizenship`, `name`, `date_registered`) VALUES
(1, 1, NULL, 0, 'SAMPLE', 'SAMPLE', 'Gasan', 'SAMPLE', 'SAMPLE', 'SAMPLE@MAIL.COM', '09121345678', 21, 'Single', 'SAMPLE', '', '2024-12-07'),
(10, 1, NULL, 0, 'Von Brix L. Lacdao', 'Ino, Mogpog, Marinduque', 'Mogpog', 'Ino', 'c5', 'brixlacdao10@gmail.com', '09121245345', 22, 'Married', 'Filipino', '', '2024-12-07'),
(11, 1, NULL, 4000, 'Norie L. De la Cruz', 'Barangay Quatro, Buenavista, Marinduque', 'Buenavista', 'Barangay III', 'Purok 4', 'noriedelacruz@gmail.com', '09243246456', 22, 'Single', 'Filipino', '', '2024-12-07'),
(12, 1, NULL, 10000, 'Beneden Logmao', 'Mogpog, Marinduque', 'Mogpog', 'Janagdong', 'Purok 4', 'beneden@gmail.com', '09432567689', 20, 'Married', 'Filipino', '', '2024-12-07'),
(13, 1, NULL, 0, 'Joan Logmao', 'Mogpog Marinduque', 'Mogpog', 'Dawis', 'test street', 'bellie@hulas.co', '09123658794', 21, 'Single', 'sff', '', '2024-12-07'),
(15, 1, 2, 16910, 'Steve Rogers', 'Poras Boac Marinduque', 'Boac', 'Poras', 'Sanggumay St.', 'steverogers@hulas.co', '09493131426', 21, 'Single', 'Filipino', '', '2024-12-07');

-- --------------------------------------------------------

--
-- Table structure for table `customer_credit_payment`
--

CREATE TABLE `customer_credit_payment` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `date_paid` date DEFAULT NULL,
  `amount_paid` int(11) NOT NULL,
  `payment_status` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_credit_payment`
--

INSERT INTO `customer_credit_payment` (`id`, `sales_id`, `customer_id`, `payment_date`, `date_paid`, `amount_paid`, `payment_status`) VALUES
(1, 5, 1, '2024-12-13', '2024-12-13', 100, 'PAID'),
(2, 5, 1, '2025-01-13', '2025-01-13', 100, 'PAID'),
(3, 5, 1, '2025-02-13', '2025-02-13', 100, 'PAID'),
(4, 6, 1, '2023-01-15', '2023-01-15', 1000, 'PAID'),
(7, 0, 2, '2023-03-05', '2023-03-05', 1500, 'LATE'),
(83, 22, 12, '2024-12-28', '2024-12-28', 1888, 'PAID'),
(84, 22, 12, '2025-01-28', '2025-01-28', 1982, 'LATE PAID'),
(85, 22, 12, '2025-02-28', '2025-02-28', 1888, 'PAID'),
(86, 22, 12, '2025-03-28', '2025-03-28', 1888, 'PAID'),
(87, 22, 12, '2025-04-28', '2025-04-28', 1888, 'PAID'),
(88, 22, 12, '2025-05-28', '2025-05-28', 1888, 'PAID'),
(89, 23, 12, '2024-12-28', NULL, 0, ''),
(90, 23, 12, '2025-01-28', NULL, 0, ''),
(91, 23, 12, '2025-02-28', NULL, 0, ''),
(92, 23, 12, '2025-03-28', NULL, 0, ''),
(93, 23, 12, '2025-04-28', NULL, 0, ''),
(94, 23, 12, '2025-05-28', NULL, 0, ''),
(95, 26, 10, '2024-12-01', '2024-12-07', 2383, 'LATE PAID'),
(96, 26, 10, '2025-01-29', NULL, 0, ''),
(97, 26, 10, '2025-03-01', NULL, 0, ''),
(98, 26, 10, '2025-03-29', NULL, 0, ''),
(99, 26, 10, '2025-04-29', NULL, 0, ''),
(100, 26, 10, '2025-05-29', NULL, 0, ''),
(101, 27, 15, '2025-01-06', NULL, 0, ''),
(102, 27, 15, '2025-02-06', NULL, 0, ''),
(103, 27, 15, '2025-03-06', NULL, 0, ''),
(104, 27, 15, '2025-04-06', NULL, 0, ''),
(105, 27, 15, '2025-05-06', NULL, 0, ''),
(106, 27, 15, '2025-06-06', NULL, 0, ''),
(107, 27, 15, '2025-07-06', NULL, 0, ''),
(108, 27, 15, '2025-08-06', NULL, 0, ''),
(109, 27, 15, '2025-09-06', NULL, 0, ''),
(110, 27, 15, '2025-10-06', NULL, 0, ''),
(111, 27, 15, '2025-11-06', NULL, 0, ''),
(112, 27, 15, '2025-12-06', NULL, 0, ''),
(113, 29, 15, '2025-01-06', NULL, 0, ''),
(114, 29, 15, '2025-02-06', NULL, 0, ''),
(115, 29, 15, '2025-03-06', NULL, 0, ''),
(116, 30, 15, '2025-01-06', '2025-01-06', 1082, 'LATE PAID'),
(117, 30, 15, '2025-02-06', NULL, 0, ''),
(118, 30, 15, '2025-03-06', NULL, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `discount_promotion`
--

CREATE TABLE `discount_promotion` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `type_of_discount` varchar(500) NOT NULL,
  `payment_type` enum('Cash','Credit','Both','') NOT NULL DEFAULT 'Both',
  `cash_discount_percentage` double DEFAULT NULL,
  `downpayment_percentage` varchar(500) DEFAULT NULL,
  `interest_percentage` varchar(500) DEFAULT NULL,
  `eligible` varchar(500) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `terms` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discount_promotion`
--

INSERT INTO `discount_promotion` (`id`, `admin_id`, `name`, `type_of_discount`, `payment_type`, `cash_discount_percentage`, `downpayment_percentage`, `interest_percentage`, `eligible`, `start_date`, `end_date`, `terms`) VALUES
(1, 1, 'Pay day sale', 'Promotion', 'Cash', 0.3, NULL, NULL, 'all customers', '2024-11-30', '2024-12-30', '12'),
(2, 1, '0% Interest Promo', 'Discount', 'Credit', NULL, '0.25', '0', 'all customers', '2024-11-29', '2024-12-31', '12'),
(3, 1, 'One Day BigTime Sale', 'Promotion', 'Credit', NULL, '0', '0.03', 'All Customers', '2024-11-28', '2024-12-28', ''),
(4, 1, 'Christmas Sale', 'Discount', 'Cash', 0.2, NULL, NULL, 'All Customers', '2024-12-01', '2024-12-31', 'Test Terms');

-- --------------------------------------------------------

--
-- Table structure for table `financial_reports`
--

CREATE TABLE `financial_reports` (
  `id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `transaction_type` enum('sales','credit','other') NOT NULL,
  `details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `financial_reports`
--

INSERT INTO `financial_reports` (`id`, `transaction_date`, `customer_id`, `amount`, `transaction_type`, `details`) VALUES
(7, '2024-11-15', 1, 5000.00, 'sales', 'November sales transaction for testing');

-- --------------------------------------------------------

--
-- Table structure for table `requirements`
--

CREATE TABLE `requirements` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `valid_id` varchar(500) NOT NULL,
  `twoBytwo_pic` varchar(500) NOT NULL,
  `brgy_clearance` varchar(500) NOT NULL,
  `cedula` varchar(500) NOT NULL,
  `proof_of_billing` varchar(500) NOT NULL,
  `application_form_credit` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requirements`
--

INSERT INTO `requirements` (`id`, `admin_id`, `customer_id`, `valid_id`, `twoBytwo_pic`, `brgy_clearance`, `cedula`, `proof_of_billing`, `application_form_credit`) VALUES
(22, 1, 1, '', 'uploads/6734177926fa5-images.png', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `appliances_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_sales` int(11) NOT NULL,
  `discount_promotion` varchar(500) NOT NULL,
  `payment_type` varchar(500) NOT NULL,
  `payment_method` varchar(500) NOT NULL,
  `transaction_number` int(11) NOT NULL,
  `months_to_pay` int(11) NOT NULL,
  `monthly_payment` int(11) NOT NULL,
  `downpayment` int(11) NOT NULL,
  `interest_rate` int(11) NOT NULL,
  `status` varchar(500) NOT NULL,
  `date_created` date NOT NULL,
  `cash_receipt` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `admin_id`, `customer_id`, `appliances_id`, `qty`, `total_sales`, `discount_promotion`, `payment_type`, `payment_method`, `transaction_number`, `months_to_pay`, `monthly_payment`, `downpayment`, `interest_rate`, `status`, `date_created`, `cash_receipt`) VALUES
(1, 1, 1, 1, 3, 30000, 'No Downpayment', 'Cash', 'CASH', 0, 0, 30000, 0, 0, 'FULLY PAID', '2024-11-11', ''),
(2, 1, 1, 1, 1, 10000, 'No Downpayment', 'Cash', 'CASH', 0, 0, 10000, 0, 0, 'FULLY PAID', '2024-11-13', ''),
(3, 1, 1, 2, 2, 2, 'No Discount', 'Cash', 'CASH', 0, 0, 2, 0, 0, 'FULLY PAID', '2024-11-13', 'uploads/690-images.png'),
(4, 1, 1, 2, 1, 1, 'No Discount', 'Cash', 'GCASH', 1356666, 0, 1, 0, 0, 'FULLY PAID', '2024-11-13', ''),
(5, 1, 1, 2, 1, 1, 'No Discount', 'Credit', 'CASH', 0, 3, 0, 0, 0, 'FULLY PAID', '2024-11-13', ''),
(9, 1, 1, 3, 1, 2500, 'No Discount', 'Cash', 'CASH', 0, 0, 2500, 0, 0, 'FULLY PAID', '2024-11-18', ''),
(21, 1, 12, 8, 1, 11000, '3', 'Cash', 'CASH', 0, 0, 11000, 0, 0, 'FULLY PAID', '2024-11-28', ''),
(22, 1, 12, 8, 1, 11330, '3', 'Credit', 'CASH', 0, 6, 1888, 0, 330, 'FULLY PAID', '2024-11-28', ''),
(23, 1, 12, 8, 1, 11330, '3', 'Credit', 'CASH', 0, 6, 1888, 0, 330, 'Active', '2024-11-28', ''),
(24, 1, 12, 8, 1, 11000, '3', 'Cash', 'GCASH', 2147483647, 0, 11000, 0, 0, 'FULLY PAID', '2024-11-28', ''),
(25, 1, 12, 6, 1, 4000, '3', 'Cash', 'CASH', 0, 0, 4000, 0, 0, 'FULLY PAID', '2024-11-29', ''),
(26, 1, 10, 8, 1, 11000, 'No Interest', 'Credit', 'CASH', 0, 6, 1833, 0, 0, 'Active', '2024-11-29', ''),
(27, 1, 15, 7, 1, 10123, 'No Discount', 'Credit', 'CASH', 0, 12, 637, 2475, 223, 'Active', '2024-12-06', ''),
(28, 1, 15, 3, 1, 1750, '1', 'Cash', 'CASH', 0, 0, 1750, 0, 0, 'FULLY PAID', '2024-12-06', ''),
(29, 1, 15, 3, 1, 2575, 'No Downpayment', 'Credit', 'CASH', 0, 3, 858, 0, 75, 'Active', '2024-12-06', ''),
(30, 1, 15, 6, 1, 4090, 'No Discount', 'Credit', 'CASH', 0, 3, 1030, 1000, 90, 'Active', '2024-12-06', '');

-- --------------------------------------------------------

--
-- Table structure for table `towns`
--

CREATE TABLE `towns` (
  `id` int(10) NOT NULL,
  `town_name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `towns`
--

INSERT INTO `towns` (`id`, `town_name`, `created_at`, `updated_at`) VALUES
(1, 'Boac', '2020-02-01 13:58:53', '2020-02-06 18:48:56'),
(2, 'Gasan', '2020-02-01 13:58:53', '0000-00-00 00:00:00'),
(3, 'Buenavista', '2020-02-01 13:58:53', '0000-00-00 00:00:00'),
(4, 'Torrijos', '2020-02-01 13:58:53', '0000-00-00 00:00:00'),
(5, 'Sta. Cruz', '2020-02-01 13:58:53', '0000-00-00 00:00:00'),
(6, 'Mogpog', '2020-02-01 13:58:53', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `active`) VALUES
(2, 'steverogers', '$2y$10$TzyUkeFJRXsIqDouuWAVJuci4IjvzCNeCE.rZdcl9EBYdV9b11lDC', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_account`
--
ALTER TABLE `admin_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appliances`
--
ALTER TABLE `appliances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barangays`
--
ALTER TABLE `barangays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_credit_payment`
--
ALTER TABLE `customer_credit_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount_promotion`
--
ALTER TABLE `discount_promotion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `financial_reports`
--
ALTER TABLE `financial_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `requirements`
--
ALTER TABLE `requirements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `towns`
--
ALTER TABLE `towns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_account`
--
ALTER TABLE `admin_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `appliances`
--
ALTER TABLE `appliances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `barangays`
--
ALTER TABLE `barangays`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `customer_credit_payment`
--
ALTER TABLE `customer_credit_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `discount_promotion`
--
ALTER TABLE `discount_promotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `financial_reports`
--
ALTER TABLE `financial_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `requirements`
--
ALTER TABLE `requirements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `towns`
--
ALTER TABLE `towns`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `financial_reports`
--
ALTER TABLE `financial_reports`
  ADD CONSTRAINT `financial_reports_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

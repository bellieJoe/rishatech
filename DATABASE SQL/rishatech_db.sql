-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2024 at 04:06 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

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
(1, 'admin', 'Administrator', 'admin123@gmail.com', '$2y$10$QjNtiwWWC7YIt6bBYh8RuuNFaOfqEDFZeUmg3BNA5TLaHUO.nqqwy', 12345, 'Verified');

-- --------------------------------------------------------

--
-- Table structure for table `appliances`
--

CREATE TABLE `appliances` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
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

INSERT INTO `appliances` (`id`, `admin_id`, `appliances_name`, `category_id`, `price`, `qty`, `unit_measurement`, `status`) VALUES
(2, 1, 'a', 7, 1, 2, 'pc/s', 'Available'),
(3, 1, 'JBL', 7, 2500, 10, 'pc/s', 'Available');

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
(7, 1, 'SPEAKER');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
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
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `admin_id`, `full_name`, `complete_address`, `municipality`, `barangay`, `street_name`, `email`, `phone_number`, `age`, `civil_status`, `citizenship`, `name`) VALUES
(1, 1, 'SAMPLE', 'SAMPLE', 'Gasan', 'SAMPLE', 'SAMPLE', 'SAMPLE@MAIL.COM', '09121345678', 21, 'Single', 'SAMPLE', ''),
(3, 1, 'sample sample sample', 'sample', 'Mogpog', 'Anapog-Sibucao', 'sdasd', 'sdas@asdsd.com', '09655678081', 25, 'Married', 'sdasd', ''),
(5, 0, 'Test Customer', '', '', '', '', 'test@example.com', '1234567890', 0, '', '', ''),
(6, 0, 'John Doe', '', '', '', '', 'john@example.com', '1234567890', 0, '', '', ''),
(7, 0, 'Jane Smith', '', '', '', '', 'jane@example.com', '0987654321', 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer_credit_payment`
--

CREATE TABLE `customer_credit_payment` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `payment_status` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_credit_payment`
--

INSERT INTO `customer_credit_payment` (`id`, `sales_id`, `customer_id`, `payment_date`, `amount_paid`, `payment_status`) VALUES
(1, 5, 1, '2024-12-13', 100, 'PAID'),
(2, 5, 1, '2025-01-13', 100, 'PAID'),
(3, 5, 1, '2025-02-13', 100, 'PAID'),
(4, 6, 1, '2023-01-15', 1000, 'PAID'),
(5, 0, 6, '2023-02-10', 500, 'UNPAID'),
(6, 0, 6, '2023-01-20', 750, 'PAID'),
(7, 0, 2, '2023-03-05', 1500, 'LATE'),
(8, 10, 7, '2024-11-19', 0, ''),
(9, 10, 7, '2024-11-18', 0, ''),
(10, 10, 7, '2025-02-18', 0, ''),
(11, 10, 7, '2025-03-18', 0, ''),
(12, 10, 7, '2025-04-18', 0, ''),
(13, 10, 7, '2025-05-18', 0, ''),
(14, 11, 6, '2024-11-18', 0, ''),
(15, 11, 6, '2025-01-18', 0, ''),
(16, 11, 6, '2025-02-18', 0, ''),
(17, 12, 5, '2024-11-20', 161, 'PAID'),
(18, 12, 5, '2025-11-20', 0, ''),
(19, 12, 5, '2025-02-18', 0, ''),
(20, 12, 5, '2025-03-18', 0, ''),
(21, 12, 5, '2025-04-18', 0, ''),
(22, 12, 5, '2025-05-18', 0, ''),
(23, 12, 5, '2025-06-18', 0, ''),
(24, 12, 5, '2025-07-18', 0, ''),
(25, 12, 5, '2025-08-18', 0, ''),
(26, 12, 5, '2025-09-18', 0, ''),
(27, 12, 5, '2025-10-18', 0, ''),
(28, 12, 5, '2025-11-18', 0, ''),
(29, 12, 5, '2025-12-18', 0, ''),
(30, 12, 5, '2026-01-18', 0, ''),
(31, 12, 5, '2026-02-18', 0, ''),
(32, 12, 5, '2026-03-18', 0, ''),
(33, 12, 5, '2026-04-18', 0, ''),
(34, 12, 5, '2026-05-18', 0, ''),
(35, 12, 5, '2026-06-18', 0, ''),
(36, 12, 5, '2026-07-18', 0, ''),
(37, 12, 5, '2026-08-18', 0, ''),
(38, 12, 5, '2026-09-18', 0, ''),
(39, 12, 5, '2026-10-18', 0, ''),
(40, 12, 5, '2026-11-18', 0, ''),
(41, 13, 6, '2024-12-19', 644, 'PAID'),
(42, 13, 6, '2025-01-19', 1288, 'PAID'),
(43, 13, 6, '2025-02-19', 644, 'PAID'),
(44, 13, 6, '2025-03-19', 644, 'PAID'),
(45, 13, 6, '2025-04-19', 644, 'PAID'),
(46, 13, 6, '2025-05-19', 644, 'PAID');

-- --------------------------------------------------------

--
-- Table structure for table `discount_promotion`
--

CREATE TABLE `discount_promotion` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `type_of_discount` varchar(500) NOT NULL,
  `downpayment_percentage` varchar(500) NOT NULL,
  `interest_percentage` varchar(500) NOT NULL,
  `eligible` varchar(500) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `terms` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(7, '2024-11-15', 1, '5000.00', 'sales', 'November sales transaction for testing');

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
(6, 1, 7, 2, 1, 1, 'No Discount', 'Cash', 'CASH', 0, 0, 1, 0, 0, 'FULLY PAID', '2024-11-14', ''),
(7, 1, 5, 3, 1, 2500, 'No Discount', 'Cash', 'CASH', 0, 0, 2500, 0, 0, 'FULLY PAID', '2024-11-14', 'uploads/558-bot.jpeg'),
(8, 1, 6, 3, 2, 5000, 'No Discount', 'Cash', 'CASH', 0, 0, 5000, 0, 0, 'FULLY PAID', '2024-11-18', ''),
(9, 1, 1, 3, 1, 2500, 'No Discount', 'Cash', 'CASH', 0, 0, 2500, 0, 0, 'FULLY PAID', '2024-11-18', ''),
(10, 1, 7, 3, 1, 2575, 'No Downpayment', 'Credit', 'CASH', 0, 6, 429, 0, 75, 'Active', '2024-11-18', ''),
(11, 1, 6, 3, 1, 2556, 'No Discount', 'Credit', 'CASH', 0, 3, 644, 625, 56, 'Active', '2024-11-18', ''),
(12, 1, 5, 3, 2, 5113, 'No Discount', 'Credit', 'CASH', 0, 24, 161, 1250, 113, 'Active', '2024-11-18', ''),
(13, 1, 6, 3, 2, 5113, 'No Discount', 'Credit', 'GCASH', 12345678, 6, 644, 1250, 113, 'FULLY PAID', '2024-11-19', '');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_account`
--
ALTER TABLE `admin_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appliances`
--
ALTER TABLE `appliances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer_credit_payment`
--
ALTER TABLE `customer_credit_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `discount_promotion`
--
ALTER TABLE `discount_promotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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

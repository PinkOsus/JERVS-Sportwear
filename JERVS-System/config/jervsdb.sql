-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2025 at 06:17 PM
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
-- Database: `jervsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `admin_user` varchar(100) NOT NULL,
  `admin_pass` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`admin_id`, `admin_user`, `admin_pass`) VALUES
(1, 'admin', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_tbl`
--

CREATE TABLE `inventory_tbl` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `categ` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `descrip` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_tbl`
--

INSERT INTO `inventory_tbl` (`id`, `item_name`, `categ`, `qty`, `descrip`) VALUES
(74, 'Jervs Hoodie', 'product', 10, ''),
(76, 'Jervs Short', 'product', 15, 'Comfortable short');

-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

CREATE TABLE `login_logs` (
  `id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `login_time` datetime NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(45) NOT NULL,
  `user_agent` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_logs`
--

INSERT INTO `login_logs` (`id`, `member_id`, `login_time`, `ip_address`, `user_agent`) VALUES
(15, 14, '2025-06-15 21:14:06', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0');

-- --------------------------------------------------------

--
-- Table structure for table `member_tbl`
--

CREATE TABLE `member_tbl` (
  `member_id` int(11) NOT NULL,
  `member_user` varchar(100) NOT NULL,
  `member_fullname` varchar(155) NOT NULL,
  `member_email` varchar(155) NOT NULL,
  `member_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member_tbl`
--

INSERT INTO `member_tbl` (`member_id`, `member_user`, `member_fullname`, `member_email`, `member_pass`) VALUES
(8, 'user3', 'George Davies Arellano', 'george@gmail.com', '$2y$10$Z38/IOTcWLvdRMB2uyH4Eu8WYhq0CpcgGR7eYamtBXYpbUgpMjED6'),
(14, 'member1', 'Jervie Barredo', 'jervs@gmail.com', '$2y$10$1x/kHfcGol1LFgu/cpO11O9jP3kFwRsq.3bMnqTDWvIZ58lRDuIDa'),
(15, 'member2', 'Kurt Russel J Caraig', 'kurt@gmail.com', '$2y$10$4RZ3dXH4vzaUNQFWWJ4O6.tX7crM4Vk.o8hWzKurbqbT7SJeCEbHi');

-- --------------------------------------------------------

--
-- Table structure for table `orders_tbl`
--

CREATE TABLE `orders_tbl` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `deposit` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `order_details` text NOT NULL,
  `current_phase` enum('start','printing','heatpress','sewing','ready') DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_tbl`
--

INSERT INTO `orders_tbl` (`id`, `item_name`, `qty`, `deposit`, `total_price`, `order_details`, `current_phase`, `last_updated`) VALUES
(22, 'Order - Team Bardagulan', 25, 5000, 10000, 'Jersey\r\nCaraig - Medium\r\nArellano - Medium\r\nAgco - XL\r\nBuatis - Large', 'start', '2025-06-15 12:37:33'),
(23, 'Order - Team tinambakan', 12, 1500, 10000, 'asdasdasdasdadsada', 'printing', '2025-06-15 13:16:11'),
(24, 'Order - Team Dinakdakan', 12, 5000, 15000, 'asjdgashjgdasgdjhasgda', 'start', '2025-06-14 07:54:30');

-- --------------------------------------------------------

--
-- Table structure for table `sales_tbl`
--

CREATE TABLE `sales_tbl` (
  `sales_id` int(11) NOT NULL,
  `order_name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_price` decimal(10,0) NOT NULL,
  `date_completed` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_tbl`
--

INSERT INTO `sales_tbl` (`sales_id`, `order_name`, `qty`, `total_price`, `date_completed`) VALUES
(1, 'Order-Buatis', 10, 5000, '2025-01-03'),
(2, 'Order- Butais', 15, 5000, '2025-06-13'),
(3, 'Team - BemBang', 12, 25000, '2025-05-03'),
(4, 'Jervs Hoodie', 5, 250, '2025-06-14'),
(5, 'Jervs Hoodie', 2, 1000, '2025-06-15'),
(6, 'Jervs Hoodie', 1, 250, '2025-06-15'),
(7, 'Jervs Hoodie', 1, 250, '2025-06-15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_user` (`admin_user`);

--
-- Indexes for table `inventory_tbl`
--
ALTER TABLE `inventory_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_logs_ibfk_1` (`member_id`);

--
-- Indexes for table `member_tbl`
--
ALTER TABLE `member_tbl`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `orders_tbl`
--
ALTER TABLE `orders_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_tbl`
--
ALTER TABLE `sales_tbl`
  ADD PRIMARY KEY (`sales_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory_tbl`
--
ALTER TABLE `inventory_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `member_tbl`
--
ALTER TABLE `member_tbl`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders_tbl`
--
ALTER TABLE `orders_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `sales_tbl`
--
ALTER TABLE `sales_tbl`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD CONSTRAINT `login_logs_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member_tbl` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2025 at 10:58 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `credit_card`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `status` enum('unread','read','resolve') DEFAULT 'unread',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `user`, `subject`, `message`, `status`, `created_at`) VALUES
(1, '1', 'Inquiry', 'I want to know more about your services.', 'unread', '2025-07-07 13:38:19'),
(2, '1', 'Support', 'I am having trouble logging in.', 'read', '2025-07-07 13:38:19'),
(3, '1', 'Feedback', 'Great website, keep it up!', 'resolve', '2025-07-07 13:38:19');

-- --------------------------------------------------------

--
-- Table structure for table `cvv_cards`
--

CREATE TABLE `cvv_cards` (
  `id` int(11) NOT NULL,
  `card_number` char(16) NOT NULL,
  `bin` char(6) NOT NULL,
  `cvv` char(3) NOT NULL,
  `expiry_date` date NOT NULL,
  `card_type` enum('debit','credit','virtual') DEFAULT 'debit',
  `status` enum('available','sold','reserved') DEFAULT 'available',
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `card_image` varchar(255) DEFAULT NULL,
  `bank_logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cvv_cards`
--

INSERT INTO `cvv_cards` (`id`, `card_number`, `bin`, `cvv`, `expiry_date`, `card_type`, `status`, `price`, `card_image`, `bank_logo`, `created_at`, `updated_at`) VALUES
(1, '4539123456789012', '453912', '123', '2027-12-31', 'debit', 'available', '25.00', '/uploads/cards/bg1.png', '/uploads/logos/bank1.png', '2025-07-09 08:07:39', '2025-07-09 08:07:39'),
(2, '5289123456789012', '528912', '456', '2026-11-30', 'credit', 'available', '30.00', '/uploads/cards/bg2.png', '/uploads/logos/bank2.png', '2025-07-09 08:07:39', '2025-07-09 08:07:39'),
(3, '6011123456789012', '601112', '789', '2028-05-31', 'virtual', 'available', '20.00', '/uploads/cards/bg3.png', '/uploads/logos/bank3.png', '2025-07-09 08:07:39', '2025-07-09 08:07:39'),
(7, '3987593592395132', '398759', '828', '0000-00-00', 'debit', 'sold', '34.00', NULL, NULL, '2025-07-09 08:48:29', '2025-07-09 08:48:29'),
(8, '1339691499087024', '133969', '894', '0000-00-00', 'debit', 'sold', '34.00', NULL, NULL, '2025-07-09 08:48:31', '2025-07-09 08:48:31'),
(9, '1983060584732892', '198306', '886', '0000-00-00', 'debit', 'sold', '34.00', NULL, NULL, '2025-07-09 08:48:34', '2025-07-09 08:48:34'),
(10, '90', '90', '649', '0000-00-00', 'debit', 'reserved', '12.00', NULL, NULL, '2025-07-09 08:50:58', '2025-07-09 08:50:58'),
(11, '06', '06', '823', '0000-00-00', 'debit', 'reserved', '12.00', NULL, NULL, '2025-07-09 08:51:01', '2025-07-09 08:51:01'),
(12, '27', '27', '389', '0000-00-00', 'debit', 'reserved', '12.00', NULL, NULL, '2025-07-09 08:51:02', '2025-07-09 08:51:02'),
(13, '32', '32', '099', '0000-00-00', 'debit', 'reserved', '12.00', NULL, NULL, '2025-07-09 08:51:04', '2025-07-09 08:51:04'),
(14, '01', '01', '432', '0000-00-00', 'debit', 'reserved', '12.00', NULL, NULL, '2025-07-09 08:51:41', '2025-07-09 08:51:41'),
(15, '45', '45', '025', '0000-00-00', 'debit', 'available', '3.00', NULL, NULL, '2025-07-09 08:52:05', '2025-07-09 08:52:05'),
(16, '54', '54', '214', '0000-00-00', 'debit', 'available', '3.00', NULL, NULL, '2025-07-09 08:52:07', '2025-07-09 08:52:07'),
(17, '23', '23', '215', '0000-00-00', 'debit', 'available', '3.00', NULL, NULL, '2025-07-09 08:52:08', '2025-07-09 08:52:08'),
(18, '98', '98', '155', '0000-00-00', 'debit', 'available', '3.00', NULL, NULL, '2025-07-09 08:52:11', '2025-07-09 08:52:11'),
(19, '38', '38', '057', '0000-00-00', 'debit', 'available', '3.00', NULL, NULL, '2025-07-09 08:52:12', '2025-07-09 08:52:12'),
(20, '51', '51', '246', '0000-00-00', 'debit', 'available', '3.00', NULL, NULL, '2025-07-09 08:52:13', '2025-07-09 08:52:13'),
(21, '81', '81', '631', '0000-00-00', 'debit', 'available', '3.00', NULL, NULL, '2025-07-09 08:52:15', '2025-07-09 08:52:15'),
(22, '03', '03', '760', '0000-00-00', 'debit', 'available', '3.00', NULL, NULL, '2025-07-09 08:52:17', '2025-07-09 08:52:17'),
(23, '60', '60', '463', '0000-00-00', 'debit', 'available', '3.00', NULL, NULL, '2025-07-09 08:52:23', '2025-07-09 08:52:23'),
(24, '86', '86', '039', '0000-00-00', 'debit', 'available', '3.00', NULL, NULL, '2025-07-09 08:52:26', '2025-07-09 08:52:26');

-- --------------------------------------------------------

--
-- Table structure for table `cvv_purchases`
--

CREATE TABLE `cvv_purchases` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cvv_card_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','approved','declined') DEFAULT 'pending',
  `payment_method` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `password`, `date`, `status`) VALUES
(1, 'SPOTWEBDEV', 'spotwebdev.com@gmail.com', '', '$2y$10$JH.CWZubR/GoNo9WTCmXiuWBHx0gkS7rf5lC0RF2GChiNINW2gujy', '2025-07-06 13:19:01.000000', 'active'),
(2, 'giftchinenyenwa1', 'giftchinenyenwa1@gmail.com', '', '$2y$10$JcAOEI5T9M.YtUj/CAD8t.otrvW4OxRLwqCuAHmlFpH50GnkFRFpW', '2025-07-03 13:19:08.000000', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cvv_cards`
--
ALTER TABLE `cvv_cards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `card_number` (`card_number`);

--
-- Indexes for table `cvv_purchases`
--
ALTER TABLE `cvv_purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `cvv_card_id` (`cvv_card_id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cvv_cards`
--
ALTER TABLE `cvv_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `cvv_purchases`
--
ALTER TABLE `cvv_purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cvv_purchases`
--
ALTER TABLE `cvv_purchases`
  ADD CONSTRAINT `cvv_purchases_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cvv_purchases_ibfk_2` FOREIGN KEY (`cvv_card_id`) REFERENCES `cvv_cards` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `deposits`
--
ALTER TABLE `deposits`
  ADD CONSTRAINT `deposits_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2025 at 03:59 AM
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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `country` varchar(100) DEFAULT NULL,
  `bank` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `uuid` char(36) NOT NULL DEFAULT uuid()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cvv_cards`
--

INSERT INTO `cvv_cards` (`id`, `card_number`, `bin`, `cvv`, `expiry_date`, `card_type`, `status`, `price`, `card_image`, `bank_logo`, `created_at`, `updated_at`, `country`, `bank`, `name`, `uuid`) VALUES
(1, '0889092879593249', '615506', '339', '2027-08-01', 'debit', 'sold', '28.00', NULL, NULL, '2025-08-01 01:40:37', '2025-08-01 01:50:41', 'China', 'China Construction Bank', 'John Smith', '86640f1b-6e78-11f0-bab7-8851fbcb1ead'),
(2, '9590483795301368', '978842', '464', '2028-08-01', 'debit', 'available', '36.00', NULL, NULL, '2025-08-01 01:40:37', '2025-08-01 01:40:37', 'Dubai', 'Emirates NBD', 'William Brown', '8670f1de-6e78-11f0-bab7-8851fbcb1ead'),
(3, '2143711753328788', '785413', '260', '2027-08-01', 'debit', 'available', '31.00', NULL, NULL, '2025-08-01 01:41:10', '2025-08-01 01:41:10', 'China', 'Bank of China', 'John Smith', '9a0b9bb4-6e78-11f0-bab7-8851fbcb1ead'),
(4, '8251845008970505', '716010', '180', '2026-08-01', 'debit', 'available', '18.00', NULL, NULL, '2025-08-01 01:41:10', '2025-08-01 01:41:10', 'Dubai', 'RAKBANK', 'Charlotte Thomas', '9a29500e-6e78-11f0-bab7-8851fbcb1ead'),
(5, '3886071873823349', '904308', '327', '2027-08-01', 'debit', 'sold', '53.00', NULL, NULL, '2025-08-01 01:41:11', '2025-08-01 01:49:06', 'United Kingdom', 'NatWest', 'Olivia Wilson', '9a45f105-6e78-11f0-bab7-8851fbcb1ead'),
(6, '1749330562306718', '456891', '003', '2026-08-01', 'debit', '', '19.00', NULL, NULL, '2025-08-01 01:41:28', '2025-08-01 01:41:28', 'China', 'China Construction Bank', 'Benjamin Anderson', 'a49e4097-6e78-11f0-bab7-8851fbcb1ead'),
(7, '7788470096932177', '177051', '551', '2028-08-01', 'debit', '', '44.00', NULL, NULL, '2025-08-01 01:41:28', '2025-08-01 01:41:28', 'United Kingdom', 'Lloyds Bank', 'Emily Davis', 'a4c1590d-6e78-11f0-bab7-8851fbcb1ead'),
(8, '0445141025595982', '328007', '054', '2026-08-01', 'debit', '', '24.00', NULL, NULL, '2025-08-01 01:41:28', '2025-08-01 01:41:28', 'Dubai', 'RAKBANK', 'Daniel Lee', 'a4c82112-6e78-11f0-bab7-8851fbcb1ead'),
(9, '2006309265517908', '693143', '122', '2028-08-01', 'debit', '', '55.00', NULL, NULL, '2025-08-01 01:41:28', '2025-08-01 01:41:28', 'United States', 'Chase', 'James Taylor', 'a4d182b2-6e78-11f0-bab7-8851fbcb1ead'),
(10, '6247632159104745', '777521', '412', '2027-08-01', 'debit', 'sold', '31.00', NULL, NULL, '2025-08-01 01:44:53', '2025-08-01 01:49:48', 'Dubai', 'Emirates NBD', 'Jane Doe', '1e9bab1a-6e79-11f0-bab7-8851fbcb1ead'),
(11, '5867773796829877', '085791', '615', '2028-08-01', 'debit', 'available', '48.00', NULL, NULL, '2025-08-01 01:44:53', '2025-08-01 01:44:53', 'United States', 'US Bank', 'Michael Johnson', '1eac8e66-6e79-11f0-bab7-8851fbcb1ead'),
(12, '0815980922363803', '518255', '726', '2028-08-01', 'debit', 'available', '30.00', NULL, NULL, '2025-08-01 01:45:16', '2025-08-01 01:45:16', 'China', 'China Construction Bank', 'Olivia Wilson', '2cca7b21-6e79-11f0-bab7-8851fbcb1ead'),
(13, '2565671505741623', '302618', '105', '2026-08-01', 'debit', 'available', '28.00', NULL, NULL, '2025-08-01 01:45:17', '2025-08-01 01:45:17', 'Dubai', 'Emirates NBD', 'Michael Johnson', '2ce756ef-6e79-11f0-bab7-8851fbcb1ead'),
(14, '4010255889418887', '177250', '737', '2027-08-01', 'debit', 'available', '51.00', NULL, NULL, '2025-08-01 01:45:17', '2025-08-01 01:45:17', 'United States', 'US Bank', 'James Taylor', '2cf1abc9-6e79-11f0-bab7-8851fbcb1ead');

-- --------------------------------------------------------

--
-- Table structure for table `cvv_purchases`
--

CREATE TABLE `cvv_purchases` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cvv_card_id` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `purchase_date` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `status` enum('pending','approved','declined') NOT NULL DEFAULT 'pending',
  `uuid` char(36) NOT NULL DEFAULT uuid()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cvv_purchases`
--

INSERT INTO `cvv_purchases` (`id`, `user_id`, `cvv_card_id`, `amount`, `purchase_date`, `status`, `uuid`) VALUES
(1, 4, 5, '53.00', '2025-08-01 02:49:06.521153', 'approved', 'b598c5b3-6e79-11f0-bab7-8851fbcb1ead'),
(2, 4, 10, '31.00', '2025-08-01 02:49:48.748179', 'approved', 'cec4623a-6e79-11f0-bab7-8851fbcb1ead'),
(3, 4, 1, '28.00', '2025-08-01 02:50:41.666012', 'approved', 'ee4eb9be-6e79-11f0-bab7-8851fbcb1ead');

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` int(11) NOT NULL,
  `deposts_id` varchar(255) NOT NULL,
  `user` int(11) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','approved','declined') DEFAULT 'pending',
  `payment_method` varchar(50) NOT NULL,
  `payment_address` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `deposts_id`, `user`, `amount`, `date`, `status`, `payment_method`, `payment_address`, `image`) VALUES
(1, 'DEP-688bcbd27efdf', 4, '100.00', '2025-07-31 20:02:26', 'approved', 'Bitcoin', 'bc1qgzd0yxxqsxwhdtcudnkgjqakdajdyplhtdn0q2', NULL),
(2, 'DEP-688c101400ab3', 4, '100.00', '2025-08-01 00:53:40', 'pending', 'Bitcoin', 'bc1qgzd0yxxqsxwhdtcudnkgjqakdajdyplhtdn0q2', NULL),
(3, 'DEP-688bcbd27dnfk', 4, '600.00', '2025-07-31 20:02:26', 'approved', 'Bitcoin', 'bc1qgzd0yxxqsxwhdtcudnkgjqakdajdyplhtdn0q2', NULL),
(4, 'DEP-688c101400ceb', 4, '200.00', '2025-08-01 00:53:40', 'approved', 'Bitcoin', 'bc1qgzd0yxxqsxwhdtcudnkgjqakdajdyplhtdn0q2', NULL);

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
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `bal` varchar(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `password`, `date`, `status`, `bal`) VALUES
(4, 'spotwebdev.com', 'spotwebdev.com@gmail.com', '08108833188', '$2y$10$V6GU29xhZMFj/8sD9Q0qnuN.1EF4Zgje66EERTqY1ouIsvr21YsRW', '2025-08-01 01:50:41.500974', 'active', '438'),
(5, 'firstclass', 'firstclass@gmail.com', '08108833188', '$2y$10$V6GU29xhZMFj/8sD9Q0qnuN.1EF4Zgje66EERTqY1ouIsvr21YsRW', '2025-07-17 22:26:38.635084', 'active', '0');

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
  ADD UNIQUE KEY `card_number` (`card_number`),
  ADD UNIQUE KEY `uuid` (`uuid`);

--
-- Indexes for table `cvv_purchases`
--
ALTER TABLE `cvv_purchases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cvv_cards`
--
ALTER TABLE `cvv_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cvv_purchases`
--
ALTER TABLE `cvv_purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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

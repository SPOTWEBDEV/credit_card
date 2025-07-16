-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2025 at 09:17 AM
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
(1, '8854474431552658', '885447', '653', '2028-07-15', 'debit', 'available', '4.00', NULL, NULL, '2025-07-15 02:17:21', '2025-07-15 02:17:21', 'Nigeria', 'Zenith Bank', 'Amelia Moore', 'f6306ce2-61ab-11f0-bf9f-8851fbcb1ead'),
(2, '2409245211401783', '240924', '102', '2028-07-15', 'debit', 'available', '4.00', NULL, NULL, '2025-07-15 02:17:21', '2025-07-15 02:17:21', 'Nigeria', 'Zenith Bank', 'Sophia Martinez', 'f64165e5-61ab-11f0-bf9f-8851fbcb1ead'),
(3, '0525474200499572', '052547', '788', '2028-07-15', 'debit', 'sold', '4.00', NULL, NULL, '2025-07-15 02:18:11', '2025-07-15 20:52:37', 'Poland', 'Poland Bank', 'Emily Davis', 'f64173a5-61ab-11f0-bf9f-8851fbcb1ead'),
(4, '3823904379056049', '382390', '766', '2028-07-15', 'debit', 'sold', '8.00', NULL, NULL, '2025-07-15 02:18:43', '2025-07-15 20:50:07', 'Iceland', 'Iceland Bank', 'Charlotte Thomas', 'f6417546-61ab-11f0-bf9f-8851fbcb1ead'),
(5, '1260429009465565', '126042', '730', '2028-07-15', 'debit', 'sold', '2.00', NULL, NULL, '2025-07-15 18:48:49', '2025-07-15 19:10:43', 'USA', 'SPOTbank', 'Emily Davis', '68ddf914-61ac-11f0-bf9f-8851fbcb1ead');

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
(3, 4, 5, '2.00', '2025-07-15 20:10:42.633313', 'approved', '2857695e-61b4-11f0-bf9f-8851fbcb1ead'),
(4, 4, 4, '8.00', '2025-07-15 21:50:07.777320', 'approved', '5b067f0d-61bd-11f0-bf9f-8851fbcb1ead'),
(5, 4, 3, '4.00', '2025-07-15 21:52:37.595240', 'approved', 'b452e7df-61bd-11f0-bf9f-8851fbcb1ead');

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
(6, 'DEP-687580277bfec', 4, '300.00', '2025-07-14 22:09:43', 'pending', 'BTC', '', 'bc1qexamplebtcaddress'),
(7, 'DEP-687580a03f45e', 4, '40.00', '2025-07-14 22:11:44', 'pending', 'BTC', 'bc1qexamplebtcaddress', NULL),
(8, 'DEP-6875817d582a3', 4, '40.00', '2025-07-14 22:15:25', 'pending', 'BTC', 'bc1qexamplebtcaddress', NULL),
(9, 'DEP-687581881956f', 4, '30.00', '2025-07-14 22:15:36', 'pending', 'ETH', '0xexampleethaddress', NULL),
(10, 'DEP-687581bb14f82', 4, '20.00', '2025-07-14 22:16:27', 'pending', 'BTC', 'bc1qexamplebtcaddress', NULL),
(11, 'DEP-687581d267369', 4, '29.00', '2025-07-14 22:16:50', 'pending', 'ETH', '0xexampleethaddress', NULL),
(12, 'DEP-687585859eafe', 4, '304599.00', '2025-07-14 22:32:37', 'pending', 'BTC', 'bc1qexamplebtcaddress', NULL),
(13, 'DEP-687587fe5a45a', 4, '100.00', '2025-07-14 22:43:10', 'pending', 'BTC', 'bc1qexamplebtcaddress', NULL),
(14, 'DEP-6875883a47cd1', 4, '100.00', '2025-07-14 22:44:10', 'pending', 'BTC', 'bc1qexamplebtcaddress', NULL),
(15, 'DEP-6875885ebd19c', 4, '20.00', '2025-07-14 22:44:46', 'pending', 'ETH', '0xexampleethaddress', 'proof_68758a5b26076.jpg'),
(16, 'DEP-6875a8bee34a1', 4, '501.00', '2025-07-15 01:02:54', 'pending', 'BTC', 'bc1qexamplebtcaddress', 'proof_6875a8cfb8715.jpg'),
(17, 'DEP-6875a948c0b00', 4, '232.00', '2025-07-15 01:05:12', 'approved', 'BTC', 'bc1qexamplebtcaddress', 'proof_6875a9e588767.jpg'),
(18, 'DEP-68769c3f2b3c8', 4, '100.00', '2025-07-15 18:21:51', 'approved', 'BTC', 'bc1qexamplebtcaddress', 'proof_68769c5e9a01a.jpg');

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
(4, 'spotwebdev.com', 'spotwebdev.com@gmail.com', '08108833188', '$2y$10$V6GU29xhZMFj/8sD9Q0qnuN.1EF4Zgje66EERTqY1ouIsvr21YsRW', '2025-07-15 20:52:36.910078', 'active', '286'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cvv_cards`
--
ALTER TABLE `cvv_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cvv_purchases`
--
ALTER TABLE `cvv_purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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

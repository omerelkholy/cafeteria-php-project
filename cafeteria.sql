-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 18, 2025 at 05:11 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafeteria`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `status` enum('processing','out for delivery','done') COLLATE utf8mb4_general_ci DEFAULT 'processing',
  `quantity` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category`, `picture`) VALUES
(5, 'coffee', 4.99, 'hot drinks', NULL),
(6, 'mocha', 9.99, 'cold drinks', NULL),
(7, 'Milk Shake', 6.50, 'cold drinks', NULL),
(8, 'HTML', 9.99, 'desserts', NULL),
(9, 'mohamed', 5.00, 'cold drinks', NULL),
(10, 'tea', 4.99, 'hot drinks', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `room_no` int DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_type` enum('user','admin') COLLATE utf8mb4_general_ci DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `room_no`, `picture`, `user_type`) VALUES
(1, ' XpeedyMody', 'Xpeedymody@fla7.com', '51782d21e8740d52edb53a903b9d8fb4', 207, NULL, 'user'),
(2, 'Therio', 'theriotheo@gmail.com', '41e12af73bc9e6e01598b66bae450b0d', 207, NULL, 'user'),
(3, 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, 'admin'),
(4, 'fohien', 'am.foohien@gmail.com', '94e8cde4612b3fd390677d42e7b22002', 207, NULL, 'user'),
(5, 'hadeer', 'hadeer@gmail.com', 'cb3d1dcded5015113153b2fca3cc9819', NULL, NULL, 'admin'),
(6, 'muhmmad', 'mohamed@gmail.com', '309cd3800aacbd003ac36199fa537295', NULL, NULL, 'admin'),
(7, 'omer', 'omer@gmail.com', '916468a2b614352a9b444bd0fbba39f8', 203, NULL, 'user'),
(8, 'shimaa', 'shimaa@gmail.com', 'f1db13460f388fabfda9258941e15a83', NULL, NULL, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

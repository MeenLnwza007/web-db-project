-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 07, 2024 at 12:19 PM
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
-- Database: `ramen_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `queue` int(11) NOT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `eatwhere` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `ing_id` int(11) NOT NULL,
  `ing_name` varchar(80) NOT NULL,
  `ing_quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `ing_type` varchar(50) DEFAULT NULL,
  `ing_img` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`ing_id`, `ing_name`, `ing_quantity`, `price`, `ing_type`, `ing_img`) VALUES
(1, 'Ramen', 100, 10.00, 'noodle', NULL),
(4, 'Udon', 100, 10.00, 'noodle', NULL),
(5, 'Soba', 100, 10.00, 'noodle', NULL),
(6, 'Somen', 100, 10.00, 'noodle', NULL),
(7, 'Shirataki', 100, 10.00, 'noodle', NULL),
(8, 'Tonkotsu', 100, 30.00, 'soup', NULL),
(9, 'Miso', 100, 30.00, 'soup', NULL),
(10, 'Shoyu', 100, 30.00, 'soup', NULL),
(11, 'Chicken', 100, 5.00, 'meat', NULL),
(12, 'Pork', 100, 5.00, 'meat', NULL),
(13, 'Beef', 100, 10.00, 'meat', NULL),
(14, 'Mild', 100, 0.00, 'spicy', NULL),
(15, 'Spicy', 100, 0.00, 'spicy', NULL),
(16, 'Hot', 100, 0.00, 'spicy', NULL),
(17, 'Boiled egg', 100, 10.00, 'topping', NULL),
(18, 'Shashu', 100, 25.00, 'topping', NULL),
(19, 'Menma', 100, 20.00, 'topping', NULL),
(20, 'Mushroom', 100, 10.00, 'topping', NULL),
(21, 'Narutomaki', 100, 10.00, 'topping', NULL),
(22, 'Cabbage', 100, 10.00, 'topping', NULL),
(23, 'Wakame', 100, 10.00, 'topping', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_types`
--

CREATE TABLE `ingredient_types` (
  `ing_type` varchar(50) NOT NULL,
  `type_name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredient_types`
--

INSERT INTO `ingredient_types` (`ing_type`, `type_name`) VALUES
('meat', 'meat'),
('noodle', 'noodle'),
('soup', 'soup'),
('spicy', 'spicy'),
('topping', 'topping');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `priceperdish` decimal(10,2) NOT NULL,
  `queue` int(11) NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `serve_status` varchar(50) DEFAULT 'Not Serve'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_ingre_used`
--

CREATE TABLE `order_ingre_used` (
  `order_id` int(11) NOT NULL,
  `ing_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `paid_status` varchar(50) NOT NULL DEFAULT 'NOT PAID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`queue`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`ing_id`),
  ADD KEY `ing_type` (`ing_type`);

--
-- Indexes for table `ingredient_types`
--
ALTER TABLE `ingredient_types`
  ADD PRIMARY KEY (`ing_type`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `queue` (`queue`);

--
-- Indexes for table `order_ingre_used`
--
ALTER TABLE `order_ingre_used`
  ADD PRIMARY KEY (`order_id`,`ing_id`),
  ADD KEY `ing_id` (`ing_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `queue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `ing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=449;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `ingredients_ibfk_1` FOREIGN KEY (`ing_type`) REFERENCES `ingredient_types` (`ing_type`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`payment_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`queue`) REFERENCES `customers` (`queue`);

--
-- Constraints for table `order_ingre_used`
--
ALTER TABLE `order_ingre_used`
  ADD CONSTRAINT `order_ingre_used_ibfk_1` FOREIGN KEY (`ing_id`) REFERENCES `ingredients` (`ing_id`),
  ADD CONSTRAINT `order_ingre_used_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

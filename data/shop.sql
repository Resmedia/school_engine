-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 04, 2019 at 02:37 PM
-- Server version: 5.6.33
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `session_id` text NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `basket`
--

INSERT INTO `basket` (`id`, `count`, `session_id`, `product_id`, `user_id`) VALUES
(127, 0, '9f791c98002529a7cab538451d169518', 2, NULL),
(128, 0, '9f791c98002529a7cab538451d169518', 3, NULL),
(129, 0, '9f791c98002529a7cab538451d169518', 4, NULL),
(130, 0, '9f791c98002529a7cab538451d169518', 3, NULL),
(131, 0, '9f791c98002529a7cab538451d169518', 2, NULL),
(132, 0, '9f791c98002529a7cab538451d169518', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `goods`
--

CREATE TABLE `goods` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `goods`
--

INSERT INTO `goods` (`id`, `order_id`, `product_id`) VALUES
(66, 28, 1),
(67, 28, 126),
(68, 28, 0),
(69, 28, 0),
(70, 28, 22);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `status` smallint(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `parent_id`, `name`, `url`, `position`, `status`) VALUES
(1, 0, 'Главная', '/', 1, 1),
(2, 0, 'Каталог', '/products', 2, 1),
(4, 0, 'Контакты', '/contacts', 5, 1),
(5, 0, 'Отзывы', '/feedback', 4, 1),
(7, 2, 'Каталог 1', '/catalog_1', 0, 1),
(8, 2, 'Каталог 2', '/catalog_2', 0, 1),
(9, 2, 'Каталог 3', '/catalog_3', 0, 1),
(10, 0, 'Галерея', '/gallery', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `address` varchar(300) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `time_create` int(11) NOT NULL,
  `time_update` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `session_id`, `name`, `description`, `address`, `email`, `phone`, `time_create`, `time_update`) VALUES
(28, 0, '9f791c98002529a7cab538451d169518', 'Евгений', 'дл твд ол пвларлпоап ловап', 'наб. Мартынова 6-3', 'resmedia@ya.ru', '+79218631118', 1570188800, 1570188800);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `url` varchar(255) DEFAULT NULL,
  `time_create` int(15) NOT NULL DEFAULT '0',
  `time_update` int(15) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `description`, `status`, `url`, `time_create`, `time_update`) VALUES
(1, 'Контакты', '<p><b>Контактная информация магазина</b></p>\r\n<p><b>Город:</b> Москва</p>\r\n<p><b>Индекс:</b> 12206</p>\r\n<p><b>Адрес:</b> Инженерная 13</p>\r\n<p><b>Телефон:</b> +7 (212) 000-00-00</p>\r\n<p><b>E-mail:</b> test@test.test</p>\r\n<p>\r\nТоргуем всем чем можно, а также чем угодно, что может принести денежные средства :-)\r\n</p>', 1, 'contacts', 1567069450, 1567069450);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`) VALUES
(1, 'Пицца', 'С сыром, круглая.', 22),
(2, 'Пончик', 'Сладкий, с шоколадом.', 12),
(3, 'Шоколад', 'Белый', 12),
(4, 'Сникерс', 'Заморский', 25);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password_hash` varchar(300) DEFAULT NULL,
  `default_hash` varchar(300) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `status` smallint(2) NOT NULL DEFAULT '0',
  `time_create` int(15) NOT NULL DEFAULT '0',
  `time_update` int(15) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `default_hash`, `role`, `status`, `time_create`, `time_update`) VALUES
(1, 'ООО КейсИС', 'resmedia@ya.ru', '$2y$10$Wa/q79mv0slwBZOwqygSj.gBQITIni4jgwSCSIlkwZC.zl6pkozsi', '3a9cba465e80ad1a052480', '2', 1, 1570034067, 1570049091),
(2, 'Good', 'resmedia@yandex.ru', '$2y$10$Np8vDbp0ldSbIctk3IU61.2BvDz9uNiHClqm5nn2fs0AVZejmpSCa', '55fa1eaa52491923b00f3d', '2', 1, 1570034238, 1570034238),
(4, 'Good', 'resmedia@yandex.rus', '$2y$10$3QOyiZ0TgHiQCkEQnVcHc.0hJMsPFJySyXO6q8.oLBLSTKdJ6KEza', 'dc76354288e19b9d1ce162', '2', 1, 1570034282, 1570034282),
(6, 'ООО КейсИС', 'resmedia@yandex.com', '$2y$10$D7H98o.J0B8vjSseBsEBV.BiTUTImbNK7yf1yD4.vvOFjQG6jAPue', '68258ca55fe1fbc4f16127', '2', 1, 1570049123, 1570049123),
(7, 'Сергей', 'sr2008@ya.ru', '$2y$10$h3mAkUbkwiBH5yQXlDMsb.2XqObXEscQL12M5q4rx9gh4xLRT4Oam', 'b5d3b5d86cf22d2e705982', '2', 1, 1570049338, 1570049338),
(8, 'TEST', 'test@test.ru', '$2y$10$5nkvi.sHntZCBKX.S0Z6f.HNirA/7hrKYcSFCb7uzggBFXXILiBA.', 'cdeecdc303675b6a960a32', '2', 1, 1570102851, 1570106921);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;
--
-- AUTO_INCREMENT for table `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

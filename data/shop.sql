-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 07, 2019 at 03:34 PM
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
(97, 0, 1),
(98, 0, 1),
(99, 0, 1),
(100, 0, 2),
(101, 0, 2),
(102, 0, 1),
(103, 0, 1),
(104, 0, 1),
(105, 0, 2),
(106, 0, 2),
(124, 16, 1),
(125, 16, 6),
(126, 16, 7),
(127, 16, 11),
(128, 16, 12),
(129, 16, 10),
(130, 17, 6),
(131, 17, 5),
(132, 17, 7),
(133, 17, 8),
(134, 17, 11),
(135, 17, 1);

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
  `status` smallint(2) NOT NULL DEFAULT '0',
  `time_create` int(11) NOT NULL,
  `time_update` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `session_id`, `name`, `description`, `address`, `email`, `phone`, `status`, `time_create`, `time_update`) VALUES
(16, 0, '9f791c98002529a7cab538451d169518', 'Генадий', 'Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Donec sollicitudin molestie malesuada. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.', 'Спб, Мира', 'res@ya.ru', '+79817511118', 1, 1570451033, 1570451033),
(17, 0, '9aa1958960de6078764951c63f1c2045', 'Максим', 'Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Donec sollicitudin molestie malesuada. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.', 'Никитина', 'sr@ya.ru', '+79154085282', 1, 1570451156, 1570451156);

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
(4, 'Сникерс', 'Заморский', 25),
(5, 'Арбуз', 'Арбу́з обыкновенный — однолетнее травянистое растение, вид рода Арбуз семейства Тыквенные. Бахчевая культура.', 70),
(6, 'Яйца', 'Яйцо́ — распространённый пищевой продукт. В силу доступности в настоящее время самыми распространёнными в употреблении являются куриные яйца, хотя любые птичьи яйца могут быть употреблены в пищу человеком. Кроме этого существует практика употребления яиц некоторых рептилий.', 100),
(7, 'Пицца doble', 'С сыром, круглая.', 22),
(8, 'Пончик Аэро', 'Сладкий, с шоколадом.', 12),
(9, 'Шоколад XS', 'Белый', 12),
(10, 'Сникерс MAXI', 'Заморский', 25),
(11, 'Арбуз желтый', 'Арбу́з обыкновенный — однолетнее травянистое растение, вид рода Арбуз семейства Тыквенные. Бахчевая культура.', 70),
(12, 'Яйца крашеные', 'Яйцо́ — распространённый пищевой продукт. В силу доступности в настоящее время самыми распространёнными в употреблении являются куриные яйца, хотя любые птичьи яйца могут быть употреблены в пищу человеком. Кроме этого существует практика употребления яиц некоторых рептилий.', 100);

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
(9, 'Пользователь', 'test@test.ru', '$2y$10$H2HC0Vjzmjt/0BGz0vxudOU2EUnxbfXMTbYPJZDl5e5KkXBP1HllO', 'cad2e013910f6b88e6139c', '2', 1, 1570276603, 1570451131),
(10, 'Admin', 'admin@test.ru', '$2y$10$GrhWqEIbUJRoWw1LQsV1pOuxbKNVEQYMkPY4GIadIemWvj2YNWKl2', '07d5a26954fb8f4b95fdef', '3', 1, 1570449292, 1570451163);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;
--
-- AUTO_INCREMENT for table `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

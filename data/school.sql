-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 25, 2019 at 12:08 AM
-- Server version: 5.6.33
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `catalog`
--

CREATE TABLE `catalog` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `full_desc` text,
  `price` int(255) NOT NULL DEFAULT '0',
  `views` int(255) NOT NULL DEFAULT '0',
  `time_create` int(11) NOT NULL DEFAULT '0',
  `time_update` int(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `catalog`
--

INSERT INTO `catalog` (`id`, `name`, `full_desc`, `price`, `views`, `time_create`, `time_update`) VALUES
(1, 'Стружка металлическая', 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Proin eget tortor risus. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Vivamus suscipit tortor eget felis porttitor volutpat. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Donec rutrum congue leo eget malesuada. Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.\r\n\r\nCurabitur non nulla sit amet nisl tempus convallis quis ac lectus. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Sed porttitor lectus nibh. Pellentesque in ipsum id orci porta dapibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Nulla porttitor accumsan tincidunt.', 95, 480, 1566590768, 0),
(2, 'Замок амбарный', 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Proin eget tortor risus. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Vivamus suscipit tortor eget felis porttitor volutpat. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Donec rutrum congue leo eget malesuada. Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.\r\n\r\nCurabitur non nulla sit amet nisl tempus convallis quis ac lectus. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Sed porttitor lectus nibh. Pellentesque in ipsum id orci porta dapibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Nulla porttitor accumsan tincidunt.', 100, 99, 1566590769, 0),
(3, 'Аквариум зеленый в полоску', 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Proin eget tortor risus. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Vivamus suscipit tortor eget felis porttitor volutpat. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Donec rutrum congue leo eget malesuada. Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.\r\n\r\nCurabitur non nulla sit amet nisl tempus convallis quis ac lectus. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Sed porttitor lectus nibh. Pellentesque in ipsum id orci porta dapibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Nulla porttitor accumsan tincidunt.', 176, 40, 1566590769, 1566590769);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(255) NOT NULL,
  `model_id` int(255) NOT NULL DEFAULT '0',
  `model` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `text` text,
  `time_create` int(11) NOT NULL DEFAULT '0',
  `time_update` int(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `model_id`, `model`, `user`, `text`, `time_create`, `time_update`) VALUES
(16, 2, 'catalog', 'Андрей Филатов!', 'Nulla quis lorem ut libero malesuada feugiat. Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.', 1566661857, 1566680766),
(17, 2, 'catalog', 'Вадим Мурашев', 'Nulla quis lorem ut libero malesuada feugiat. Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.\n\nCurabitur aliquet quam id dui posuere blandit. Pellentesque in ipsum id orci porta dapibus. Pellentesque in ipsum id orci porta dapibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\n\nNulla quis lorem ut libero malesuada feugiat. Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.\n\nCurabitur aliquet quam id dui posuere blandit. Pellentesque in ipsum id orci porta dapibus. Pellentesque in ipsum id orci porta dapibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 1566661868, 1566662006),
(18, 2, 'catalog', 'Матный Пост', 'Для удаления или редактирования \nNulla quis lorem ut libero malesuada feugiat. Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.\n\nCurabitur aliquet quam id dui posuere blandit. Pellentesque in ipsum id orci porta dapibus. Pellentesque in ipsum id orci porta dapibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 1566661905, 1566661905),
(20, 2, 'catalog', 'Вадим Горелов', 'Nulla quis lorem ut libero malesuada feugiat. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum porta.\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.\n\nCurabitur aliquet quam id dui posuere blandit. Nulla porttitor accumsan tincidunt. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.', 1566664875, 1566664875),
(22, 1, 'catalog', 'HeyRun', 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Donec sollicitudin molestie malesuada. Donec sollicitudin molestie malesuada.\n\nNulla quis lorem ut libero malesuada feugiat. Donec sollicitudin molestie malesuada. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.\n\nDonec rutrum congue leo eget malesuada. Pellentesque in ipsum id orci porta dapibus. Curabitur aliquet quam id dui posuere blandit.', 1566669348, 1566669348),
(23, 1, 'catalog', 'Bobo Tutu', 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Donec sollicitudin molestie malesuada. Donec sollicitudin molestie malesuada.\n\nDonec rutrum congue leo eget malesuada. Pellentesque in ipsum id orci porta dapibus. Curabitur aliquet quam id dui posuere blandit.', 1566669381, 1566669381),
(24, 3, 'catalog', 'Абрам Линкольн', 'Таким образом рамки и место обучения кадров позволяет выполнять важные задания по разработке форм развития. Таким образом постоянное информационно-пропагандистское обеспечение нашей деятельности требуют определения и уточнения существенных финансовых и административных условий. Товарищи! сложившаяся структура организации позволяет оценить значение новых предложений. Идейные соображения высшего порядка, а также постоянный количественный рост и сфера нашей активности представляет собой интересный эксперимент проверки позиций, занимаемых участниками в отношении поставленных задач.\n\nРазнообразный и богатый опыт консультация с широким активом требуют определения и уточнения позиций, занимаемых участниками в отношении поставленных задач. Значимость этих проблем настолько очевидна, что новая модель организационной деятельности позволяет выполнять важные задания по разработке новых предложений.', 1566675844, 1566675844),
(25, 2, 'images', 'Вау Пну', 'Товарищи! постоянный количественный рост и сфера нашей активности требуют от нас анализа системы обучения кадров, соответствует насущным потребностям. С другой стороны реализация намеченных плановых заданий способствует подготовки и реализации дальнейших направлений развития. Равным образом реализация намеченных плановых заданий позволяет выполнять важные задания по разработке форм развития. Повседневная практика показывает, что постоянный количественный рост и сфера нашей активности играет важную роль в формировании позиций, занимаемых участниками в отношении поставленных задач.', 1566676697, 1566676697),
(26, 1, 'images', '777 Gustov Bains!', 'Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Donec sollicitudin molestie malesuada. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.\n\nPellentesque in ipsum id orci porta dapibus. Donec sollicitudin molestie malesuada. Quisque velit nisi, pretium ut lacinia in, elementum id enim.\n\nCurabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Nulla quis lorem ut libero malesuada feugiat. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.', 1566678169, 1566680577),
(28, 1, 'images', 'Viktor Gurd 666', 'Pellentesque in ipsum id orci porta dapibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eget tortor risus.\n\nNulla porttitor accumsan tincidunt. Donec sollicitudin molestie malesuada. Proin eget tortor risus.\n\nCurabitur non nulla sit amet nisl tempus convallis quis ac lectus. Nulla quis lorem ut libero malesuada feugiat. Vivamus suscipit tortor eget felis porttitor volutpat.', 1566680563, 1566680584);

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

CREATE TABLE `gallery_images` (
  `id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL DEFAULT '0',
  `url` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `time_create` int(255) NOT NULL DEFAULT '0',
  `time_update` int(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gallery_images`
--

INSERT INTO `gallery_images` (`id`, `model_id`, `url`, `name`, `time_create`, `time_update`) VALUES
(1, 1, '01.jpg', 'Альт рисунка 1', 1566669799, 1566669799),
(2, 1, '02.jpg', 'Альт рисунка 2', 1566669799, 1566669799),
(3, 1, '03.jpg', 'Альт рисунка 3', 1566669799, 1566669799),
(4, 2, '04.jpg', 'Альт рисунка 4', 1566669799, 1566669799),
(5, 2, '05.jpg', 'Альт рисунка 5', 1566669799, 1566669799),
(6, 2, '06.jpg', 'Альт рисунка 6', 1566669799, 1566669799),
(7, 3, '07.jpg', 'Альт рисунка 7', 1566669799, 1566669799),
(8, 3, '08.jpg', 'Альт рисунка 8', 1566669799, 1566669799),
(9, 3, '09.jpg', 'Альт рисунка 9', 1566669799, 1566669799);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  `views` int(255) DEFAULT '0',
  `time_create` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `url`, `likes`, `views`, `time_create`) VALUES
(1, '01.jpg', 322, 1055, 1566467742),
(2, '02.jpg', 24, 15, 1566467742),
(3, '03.jpg', 5, 25, 1566467742),
(4, '04.jpg', 0, 1, 1566467742),
(5, '05.jpg', 0, 0, 1566467742),
(6, '06.jpg', 0, 0, 1566467742),
(7, '07.jpg', 1, 0, 1566467742),
(8, '08.jpg', 0, 0, 1566467742),
(9, '09.jpg', 14, 6, 1566467742),
(10, '10.jpg', 0, 0, 1566467742),
(11, '11.jpg', 0, 0, 1566467742),
(12, '12.jpg', 7, 13, 1566467742),
(13, '13.jpg', 10, 25, 1566467742),
(14, '14.jpg', 204, 34, 1566467742),
(15, '15.jpg', 0, 0, 1566467742);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `parent_id`, `name`, `url`) VALUES
(1, 0, 'Главная', '/'),
(2, 0, 'Каталог', '/catalog'),
(4, 0, 'Контакты', '/contacts'),
(5, 0, 'Отзывы', '/feedback'),
(7, 2, 'Каталог 1', '/catalog_1'),
(8, 2, 'Каталог 2', '/catalog_2'),
(9, 2, 'Каталог 3', '/catalog_3'),
(10, 0, 'Галерея', '/gallery');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catalog`
--
ALTER TABLE `catalog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `gallery_images`
--
ALTER TABLE `gallery_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

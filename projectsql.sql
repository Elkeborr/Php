-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 09, 2019 at 07:17 AM
-- Server version: 5.6.34-log
-- PHP Version: 7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `text` varchar(300) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `text`, `user_id`, `post_id`) VALUES
(1, 'Hallloooo', 1, 1),
(2, 'hallo', 1, 58),
(3, 'test', 1, 62),
(4, 'bla', 1, 59);

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` int(11) NOT NULL,
  `user_id1` int(11) NOT NULL,
  `user_id2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `user_id1`, `user_id2`) VALUES
(1, 23, 28),
(3, 26, 28),
(4, 28, 23),
(5, 26, 23),
(6, 30, 28);

-- --------------------------------------------------------

--
-- Table structure for table `images_with_fields`
--

CREATE TABLE `images_with_fields` (
  `id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_bin NOT NULL,
  `image_text` text COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `images_with_fields`
--

INSERT INTO `images_with_fields` (`id`, `image`, `image_text`, `user_id`, `date`) VALUES
(55, 'https://images.pexels.com/photos/1470171/pexels-photo-1470171.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940', 'Some nice plant from above', 26, '2019-05-06 16:03:18'),
(56, 'https://images.pexels.com/photos/707194/pexels-photo-707194.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940', 'Did some work today', 28, '2019-05-06 16:03:18'),
(57, 'https://images.pexels.com/photos/311458/pexels-photo-311458.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500', 'Lolzz', 28, '2019-05-06 16:03:18'),
(58, 'https://images.pexels.com/photos/1477166/pexels-photo-1477166.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500', 'hihihi', 23, '2019-05-06 16:03:18'),
(59, 'https://images.pexels.com/photos/38136/pexels-photo-38136.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940', '', 28, '2019-05-06 16:03:18'),
(60, 'https://images.pexels.com/photos/796620/pexels-photo-796620.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500', '', 23, '2019-05-06 16:03:18'),
(62, 'images/post_images/WmDev_636017832951914926.jpg', 'hello people', 26, '2019-05-06 16:03:18'),
(63, 'images/post_images/DSC_0470.jpg', 'plitvice', 23, '2019-05-06 16:30:14'),
(64, 'images/post_images/DSC_0477.jpg', 'rome', 23, '2019-05-07 14:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `bio` varchar(255) NOT NULL,
  `profileImg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `firstName`, `lastName`, `userName`, `password`, `bio`, `profileImg`) VALUES
(23, 'elke.borreij@gmail.com', 'Elke', 'Borreij', 'elkebo', '$2y$12$mHKkhyBR9OH.ONYzQqicju1pXJbtsxWoSz5qO.fy2OxW6rVXginva', '', 'images/profile_images/19403525_1148521161920775_1166382737_o kopie.jpg'),
(26, 'test@test.be', 'test', 'test', 'test', '$2y$12$143VKfRWHLVAOnSSMcOdguWiIvlgnpYr56RqeZM8mupIK6u8aZuLe', '', 'images/profile_images/download.jpeg'),
(28, 'elliot.doms@gmail.com', 'Elliot', 'Doms', 'ElliotDoms', '$2y$12$nPhBtAoNQOToa6OyO47rseHZ8tJ7YnUE9qU6laXUQX7Nz12f9kpAm', '', 'images/profile_images/DSC_0524.jpg'),
(29, 'lol@lol.com', 'lol', 'lol', 'lol', '$2y$12$83OnmXVJPDtJHTIlUxLCP.jvyA9SZLAGPyq9OYeunHnRuVo1IQdkK', '', ''),
(30, 'r0718185@student.thomasmore.be', 'Koen', 'R', 'Koen', '$2y$12$J4TF8KAWGWD3t1f3Bhzd4OUO1f9LQ.ydC2gC2FLKSpxom1Qr0eiF6', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images_with_fields`
--
ALTER TABLE `images_with_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `images_with_fields`
--
ALTER TABLE `images_with_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

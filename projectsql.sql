-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 01, 2019 at 01:25 PM
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
(1, 'Hallloooo', 1, 1);

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
(4, 28, 23);

-- --------------------------------------------------------

--
-- Table structure for table `images_with_fields`
--

CREATE TABLE `images_with_fields` (
  `id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_bin NOT NULL,
  `image_text` text COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `images_with_fields`
--

INSERT INTO `images_with_fields` (`id`, `image`, `image_text`, `user_id`) VALUES
(55, 'https://images.pexels.com/photos/1470171/pexels-photo-1470171.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940', 'Some nice plant from above', 26),
(56, 'https://images.pexels.com/photos/707194/pexels-photo-707194.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940', 'Did some work today', 28),
(57, 'https://images.pexels.com/photos/311458/pexels-photo-311458.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500', 'Lolzz', 28),
(58, 'https://images.pexels.com/photos/1477166/pexels-photo-1477166.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500', 'hihihi', 23),
(59, 'https://images.pexels.com/photos/38136/pexels-photo-38136.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940', '', 28),
(60, 'https://images.pexels.com/photos/796620/pexels-photo-796620.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500', '', 23),
(61, 'images/FB_20160508_14_46_41_Saved_Picture 1.jpg', 'seraf', 0),
(62, 'images/post_images/WmDev_636017832951914926.jpg', 'hello people', 26);

-- --------------------------------------------------------

--
-- Table structure for table `profile_images`
--

CREATE TABLE `profile_images` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image_text` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile_images`
--

INSERT INTO `profile_images` (`id`, `image`, `user_id`, `image_text`) VALUES
(3, 'images/post_images/FB_20160623_21_34_42_Saved_Picture.jpg', 0, '');

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
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `firstName`, `lastName`, `userName`, `password`) VALUES
(23, 'elke.borreij@gmail.com', 'Elke', 'Borreij', 'elkebo', '$2y$12$mHKkhyBR9OH.ONYzQqicju1pXJbtsxWoSz5qO.fy2OxW6rVXginva'),
(26, 'test@test.be', 'test', 'test', 'test', '$2y$12$143VKfRWHLVAOnSSMcOdguWiIvlgnpYr56RqeZM8mupIK6u8aZuLe'),
(28, 'elliot.doms@gmail.com', 'Elliot', 'Doms', 'ElliotDoms', '$2y$12$nPhBtAoNQOToa6OyO47rseHZ8tJ7YnUE9qU6laXUQX7Nz12f9kpAm');

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
-- Indexes for table `profile_images`
--
ALTER TABLE `profile_images`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `images_with_fields`
--
ALTER TABLE `images_with_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `profile_images`
--
ALTER TABLE `profile_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

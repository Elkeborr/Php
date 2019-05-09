-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Gegenereerd op: 09 mei 2019 om 06:56
-- Serverversie: 5.7.23
-- PHP-versie: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `project_php`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `text` varchar(300) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `comments`
--

INSERT INTO `comments` (`id`, `text`, `user_id`, `post_id`) VALUES
(1, 'Hallloooo', 1, 1),
(2, 'hallo', 1, 58);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `followers`
--

CREATE TABLE `followers` (
  `id` int(11) NOT NULL,
  `user_id1` int(11) NOT NULL,
  `user_id2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `followers`
--

INSERT INTO `followers` (`id`, `user_id1`, `user_id2`) VALUES
(1, 23, 28),
(3, 26, 28),
(4, 28, 23),
(5, 26, 23);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `images_with_fields`
--

CREATE TABLE `images_with_fields` (
  `id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_bin NOT NULL,
  `image_text` text COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `images_with_fields`
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
-- Tabelstructuur voor tabel `users`
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
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `email`, `firstName`, `lastName`, `userName`, `password`, `bio`, `profileImg`) VALUES
(23, 'elke.borreij@gmail.com', 'Elke', 'Borreij', 'elkebo', '$2y$12$mHKkhyBR9OH.ONYzQqicju1pXJbtsxWoSz5qO.fy2OxW6rVXginva', '', 'images/profile_images/19403525_1148521161920775_1166382737_o kopie.jpg'),
(26, 'test@test.be', 'test', 'test', 'test', '$2y$12$143VKfRWHLVAOnSSMcOdguWiIvlgnpYr56RqeZM8mupIK6u8aZuLe', '', 'images/profile_images/download.jpeg'),
(28, 'elliot.doms@gmail.com', 'Elliot', 'Doms', 'ElliotDoms', '$2y$12$nPhBtAoNQOToa6OyO47rseHZ8tJ7YnUE9qU6laXUQX7Nz12f9kpAm', '', 'images/profile_images/DSC_0524.jpg'),
(29, 'lol@lol.com', 'lol', 'lol', 'lol', '$2y$12$83OnmXVJPDtJHTIlUxLCP.jvyA9SZLAGPyq9OYeunHnRuVo1IQdkK', '', '');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `images_with_fields`
--
ALTER TABLE `images_with_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `images_with_fields`
--
ALTER TABLE `images_with_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

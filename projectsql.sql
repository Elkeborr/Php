-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Gegenereerd op: 09 mei 2019 om 16:32
-- Serverversie: 5.7.23
-- PHP-versie: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `project_php`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `post_id` int(10) NOT NULL,
  `color` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `colors`
--

INSERT INTO `colors` (`id`, `post_id`, `color`) VALUES
(7, 73, '666666'),
(8, 73, 'CCCCCC'),
(9, 73, '000000'),
(10, 73, '666600'),
(11, 73, '6666CC'),
(12, 74, '132132132'),
(13, 74, '000000'),
(14, 74, 'CCCCCC'),
(15, 74, '666666'),
(16, 74, '132132132'),
(17, 74, '000000'),
(18, 74, 'CCCCCC'),
(19, 74, '666666'),
(20, 76, '6666CC'),
(21, 76, '666666'),
(22, 76, '666600'),
(23, 76, '66CCCC'),
(24, 76, 'CCCCCC');

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
(2, 'hallo', 1, 58),
(3, 'test', 1, 62),
(4, 'bla', 1, 59);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `filters`
--

CREATE TABLE `filters` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `filters`
--

INSERT INTO `filters` (`id`, `name`) VALUES
(1, '_1977'),
(2, 'aden'),
(3, 'brannan'),
(4, 'brooklyn'),
(5, 'clarendon'),
(6, 'earlybird'),
(7, 'gingham'),
(8, 'hudson'),
(9, 'inkwell'),
(10, 'kelvin'),
(11, 'lark'),
(12, 'lofi'),
(13, 'maven'),
(14, 'mayfair'),
(15, 'moon'),
(16, 'nashville'),
(17, 'perpetua'),
(18, 'reyes'),
(19, 'rise'),
(20, 'slumber'),
(21, 'stinson'),
(22, 'toaster'),
(23, 'valencia'),
(24, 'walden'),
(25, 'willow'),
(26, 'xpro2'),
(55, 'no filter');

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
(5, 26, 23),
(6, 30, 28),
(8, 32, 28),
(9, 32, 23),
(10, 32, 26);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `data_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_bin NOT NULL,
  `image_text` text COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `filter_id` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `posts`
--

INSERT INTO `posts` (`id`, `image`, `image_text`, `user_id`, `date`, `filter_id`) VALUES
(55, 'https://images.pexels.com/photos/1470171/pexels-photo-1470171.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940', 'Some nice plant from above', 26, '2019-05-09 16:08:31', '55'),
(56, 'https://images.pexels.com/photos/707194/pexels-photo-707194.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940', 'Did some work today', 28, '2019-05-09 16:08:43', '55'),
(57, 'https://images.pexels.com/photos/311458/pexels-photo-311458.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500', 'Lolzz', 28, '2019-05-09 16:08:46', '55'),
(58, 'https://images.pexels.com/photos/1477166/pexels-photo-1477166.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500', 'hihihi', 23, '2019-05-09 16:08:48', '55'),
(59, 'https://images.pexels.com/photos/38136/pexels-photo-38136.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940', '', 28, '2019-05-09 16:08:50', '55'),
(60, 'https://images.pexels.com/photos/796620/pexels-photo-796620.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500', '', 23, '2019-05-09 16:08:53', '55'),
(62, 'images/post_images/WmDev_636017832951914926.jpg', 'hello people', 26, '2019-05-09 16:08:55', '55'),
(63, 'images/post_images/DSC_0470.jpg', 'plitvice', 23, '2019-05-09 16:08:57', '55'),
(73, 'images/post_images/600_5845_1024px.jpg', 'bauhaus', 23, '2019-05-09 16:08:59', '55'),
(74, 'images/post_images/Bauhaus_Chair_Breuer.png', 'Stoel', 23, '2019-05-09 15:46:58', '1'),
(76, 'images/post_images/1920px-Bauhaus_Dessau_2018.jpg', 'Schule', 23, '2019-05-09 16:11:50', '9');

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
(29, 'lol@lol.com', 'lol', 'lol', 'lol', '$2y$12$83OnmXVJPDtJHTIlUxLCP.jvyA9SZLAGPyq9OYeunHnRuVo1IQdkK', '', ''),
(30, 'r0718185@student.thomasmore.be', 'Koen', 'R', 'Koen', '$2y$12$J4TF8KAWGWD3t1f3Bhzd4OUO1f9LQ.ydC2gC2FLKSpxom1Qr0eiF6', '', ''),
(31, 'serafima.y@hotmail.com', 'serafima', 'y', 'serafima', '$2y$12$AzLEViDaxN.06zRQOoRWDeBlt9D/wXyG5ZVka3gAOT6X.KGCKwdPW', '', 'images/profile_images/WmDev_636017832951914926.jpg'),
(32, 'simon.h@gmail.com', 'Simon', 'Hostyn', 'Simonh', '$2y$12$77Pqxe1fX0sYt2QujC6VqOvp7z3QT493qZPm/u1NP0dVMoXq373q.', '', '');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `filters`
--
ALTER TABLE `filters`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT voor een tabel `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT voor een tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `filters`
--
ALTER TABLE `filters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT voor een tabel `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

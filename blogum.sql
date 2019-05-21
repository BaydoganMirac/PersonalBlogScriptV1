-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 04 Şub 2019, 22:45:28
-- Sunucu sürümü: 10.1.36-MariaDB
-- PHP Sürümü: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `blogum`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admins`
--

CREATE TABLE `admins` (
  `id` int(11) UNSIGNED NOT NULL,
  `adminname` varchar(255) NOT NULL,
  `adminusername` varchar(255) NOT NULL,
  `adminpassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

--
-- Tablo döküm verisi `admins`
--

INSERT INTO `admins` (`id`, `adminname`, `adminusername`, `adminpassword`) VALUES
(1, 'admin', 'admin', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `article`
--

CREATE TABLE `article` (
  `id` int(11) UNSIGNED NOT NULL,
  `article_title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `article_author` varchar(255) CHARACTER SET utf8 NOT NULL,
  `article_content` text CHARACTER SET utf8 NOT NULL,
  `article_image` varchar(255) CHARACTER SET utf8 NOT NULL,
  `article_datestamp` int(11) NOT NULL,
  `article_date` varchar(255) CHARACTER SET utf8 NOT NULL,
  `article_seo` varchar(255) CHARACTER SET utf8 NOT NULL,
  `article_category` varchar(255) CHARACTER SET utf8 NOT NULL,
  `article_readcount` int(11) NOT NULL,
  `numberofcomment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

--
-- Tablo döküm verisi `article`
--

INSERT INTO `article` (`id`, `article_title`, `article_author`, `article_content`, `article_image`, `article_datestamp`, `article_date`, `article_seo`, `article_category`, `article_readcount`, `numberofcomment`) VALUES
(1, 'Deneme YazÄ±sÄ± 9', 'admin', 'daklsnkljanksjgnaksjgnaksjbnaksga\n\nasgkalnsglkansg\naalgnkalkjgasfasgasfgasasdsnagagdg', '313293457.jpg', 1544957321, '16.12.2018 11:48:41', 'deneme-yazisi-9', 'Jquery Dersleri', 12, 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `categoryname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `category`
--

INSERT INTO `category` (`id`, `categoryname`) VALUES
(1, 'Jquery Dersleri');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comments`
--

CREATE TABLE `comments` (
  `id` int(11) UNSIGNED NOT NULL,
  `comments_articleid` int(11) NOT NULL,
  `comments_usersid` int(11) NOT NULL,
  `comments_content` text NOT NULL,
  `comments_datestamp` int(11) NOT NULL,
  `comments_date` varchar(255) NOT NULL,
  `comments_confirmation` int(1) NOT NULL,
  `comments_replyid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

--
-- Tablo döküm verisi `comments`
--

INSERT INTO `comments` (`id`, `comments_articleid`, `comments_usersid`, `comments_content`, `comments_datestamp`, `comments_date`, `comments_confirmation`, `comments_replyid`) VALUES
(3, 1, 0, 'Deneme Yorumu', 1544959756, '16.12.2018', 0, 0),
(4, 1, 0, 'Deneme Yorumu', 1544959759, '16.12.2018', 0, 0),
(5, 1, 0, 'Deneme Yorumu', 1544959759, '16.12.2018', 1, 0),
(7, 1, 0, 'Deneme Yorumu', 1544959760, '16.12.2018', 1, 0),
(8, 1, 0, 'Deneme Yorumu', 1544959760, '16.12.2018', 1, 0),
(9, 1, 1, 'Knk Bu BÃ¶yle OlmamÄ±Å?', 1548249144, '23.01.2019', 1, 8);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hit`
--

CREATE TABLE `hit` (
  `id` int(11) UNSIGNED NOT NULL,
  `IP` varchar(255) NOT NULL,
  `count` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

--
-- Tablo döküm verisi `hit`
--

INSERT INTO `hit` (`id`, `IP`, `count`) VALUES
(1, '::1', '88'),
(2, '192.168.137.21', '7'),
(3, '192.168.137.1', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `settings`
--

CREATE TABLE `settings` (
  `id` int(1) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 NOT NULL,
  `keywords` text CHARACTER SET utf8 NOT NULL,
  `link` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `aboutme` text CHARACTER SET utf8 NOT NULL,
  `smtphost` varchar(255) CHARACTER SET utf8 NOT NULL,
  `smtpport` varchar(255) CHARACTER SET utf8 NOT NULL,
  `encryption` varchar(255) CHARACTER SET utf8 NOT NULL,
  `smtpusername` varchar(255) CHARACTER SET utf8 NOT NULL,
  `smtppassword` varchar(255) CHARACTER SET utf8 NOT NULL,
  `myskills` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

--
-- Tablo döküm verisi `settings`
--

INSERT INTO `settings` (`id`, `title`, `description`, `keywords`, `link`, `email`, `aboutme`, `smtphost`, `smtpport`, `encryption`, `smtpusername`, `smtppassword`, `myskills`) VALUES
(1, 'Blogum', 'Deneme', 'deneme', 'http://localhost/', 'baydoganmirac@gmail.com', 'asdasdasd', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `slideshow`
--

CREATE TABLE `slideshow` (
  `id` int(11) NOT NULL,
  `slideimage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `users_username` varchar(255) NOT NULL,
  `users_password` varchar(255) NOT NULL,
  `users_datestamp` int(11) NOT NULL,
  `users_date` varchar(255) NOT NULL,
  `users_ipno` varchar(255) NOT NULL,
  `users_website` varchar(255) NOT NULL,
  `users_numberofcomment` int(11) NOT NULL,
  `users_email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `users_username`, `users_password`, `users_datestamp`, `users_date`, `users_ipno`, `users_website`, `users_numberofcomment`, `users_email`) VALUES
(1, 'ismailbulut', '202cb962ac59075b964b07152d234b70', 1548249117, '23.01.2019 14:11:57', '::1', '', 1, 'ismailbulut@gmail.com');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hit`
--
ALTER TABLE `hit`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `slideshow`
--
ALTER TABLE `slideshow`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `hit`
--
ALTER TABLE `hit`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `slideshow`
--
ALTER TABLE `slideshow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

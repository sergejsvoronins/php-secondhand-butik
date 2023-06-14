-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 14 jun 2023 kl 07:31
-- Serverversion: 10.4.28-MariaDB
-- PHP-version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `secondhand-butik`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `creating_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `categories`
--

INSERT INTO `categories` (`id`, `name`, `creating_date`) VALUES
(2, 'pants', '2023-05-29 19:14:12'),
(3, 't-shirts', '2023-06-08 19:14:12'),
(5, 'jackets', '2023-06-08 19:14:12'),
(6, 'shoes', '2023-06-08 19:14:12'),
(7, 'shirts', '2023-06-08 19:14:12');

-- --------------------------------------------------------

--
-- Tabellstruktur `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `size_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `creating_date` datetime NOT NULL DEFAULT current_timestamp(),
  `selling_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `products`
--

INSERT INTO `products` (`id`, `name`, `size_id`, `category_id`, `price`, `seller_id`, `creating_date`, `selling_date`) VALUES
(4, 'Jeans', 1, 2, 300, 1, '2023-05-29 19:14:12', '2023-06-13 19:14:12'),
(6, 'byxor', 1, 2, 250, 1, '2023-05-30 19:14:12', NULL),
(7, 'jeans', 1, 2, 100, 2, '2023-06-01 19:14:12', NULL),
(83, 'adidas t-shirt', 2, 3, 100, 3, '2023-06-13 19:22:53', NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur `sellers`
--

CREATE TABLE `sellers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `epost` varchar(32) NOT NULL,
  `mobile` varchar(13) NOT NULL,
  `creating_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `sellers`
--

INSERT INTO `sellers` (`id`, `first_name`, `last_name`, `epost`, `mobile`, `creating_date`) VALUES
(1, 'Sergejs', 'Voronins', 's@v.se', '0720801071', '2023-05-29 12:21:32'),
(2, 'Lisa', 'Johnsson', 'l@j.se', '075835050', '2023-05-29 12:21:32'),
(3, 'Carl', 'Sylvan', 'c@s.se', '0762030945', '2023-05-30 12:21:32'),
(4, 'Marta', 'Bengtsson', 'm@b.se', '0720254100', '2023-05-31 12:21:32'),
(7, 'Joanna', 'Wellington', 'j@w.se', '0720245800', '2023-06-02 12:21:32'),
(36, 'Göran', 'Larsson', 'g@l.se', '0720245834', '2023-06-07 12:21:32'),
(85, 'Frej', 'Voronins', 'f@v.se', '08923244698', '2023-06-13 12:21:32'),
(87, 'Olof', 'Matsson', 'o@m.se', '072536900', '2023-06-13 19:09:29'),
(90, 'Frej', 'Voronins', 'f@v.se', '08923244698', '2023-06-13 19:21:08'),
(91, 'Frej', 'Voronins', 'f@v.se', '08923244698', '2023-06-13 19:31:48');

-- --------------------------------------------------------

--
-- Tabellstruktur `sizes`
--

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL,
  `name` varchar(3) NOT NULL,
  `description` varchar(32) NOT NULL,
  `creating_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `description`, `creating_date`) VALUES
(1, 'XS', 'extra small', '2023-05-29 19:14:12'),
(2, 'S', 'small', '2023-06-08 19:14:12'),
(3, 'M', 'medium', '2023-06-08 19:14:12'),
(4, 'L', 'large', '2023-06-08 19:14:12'),
(5, 'XL', 'extra large', '2023-06-13 19:14:12');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `seller_id` (`seller_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Index för tabell `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT för tabell `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT för tabell `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT för tabell `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 27, 2020 at 08:01 PM
-- Server version: 5.7.25
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moscow`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `author_id`, `text`, `created_at`) VALUES
(77, 55, 'Привет друзья', '2020-10-27 14:59:12'),
(78, 55, 'Как ваши дела?', '2020-10-27 14:59:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nickname` varchar(128) NOT NULL,
  `is_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `role` enum('user','admin') NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `auth_token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `nickname`, `is_confirmed`, `role`, `password_hash`, `auth_token`, `created_at`) VALUES
(54, 'foxiscd@mail.ru', 'lolka', 1, 'user', '$2y$10$9WYoPtPC9AFslP8HKCEuUeRpkyrfzBhc.7wUbs1AZXikaU1gshJoe', 'c8bf20cc577a30262918c6fed6983bebcc63db3e50e937876869f0c4d567eaeee7a25f2d115dd25a', '2020-10-24 21:47:05'),
(55, 'foxiscd174@mail.ru', 'Foxiscd1', 1, 'user', '$2y$10$pTtGrR9lj9B9TRLc6x.cx.OEIEA7X7NMptOZ7CMblIRjLHCdx87Ty', '9efb33c3542a958a8229f0e8e25c270460d1dc80b7fe7ba1bdd518fc39ce653360bcd5ea7c2d98fd', '2020-10-24 21:56:05');

-- --------------------------------------------------------

--
-- Table structure for table `users_activation_codes`
--

CREATE TABLE `users_activation_codes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_activation_codes`
--

INSERT INTO `users_activation_codes` (`id`, `user_id`, `code`) VALUES
(1, 46, '10ef90df4ac5588553d4c21dd44e39f3'),
(2, 47, '0d48a801562cfb55d743da9d64d60483'),
(3, 48, '3d2253fb65505d11ce1fc04dbc29ea2f'),
(4, 49, '4a063f65e5896d568f18a66dca094340'),
(5, 50, '9737527dd70440f84d5a089486c3ce0c'),
(6, 51, '7c085e607e1da921ec2d81e24075f99f'),
(7, 52, '1ccb01e5dcb1cb9a0fce432675776a13'),
(8, 53, '2e874a650b42cfaa6b5ae43e146a22c0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nickname` (`nickname`);

--
-- Indexes for table `users_activation_codes`
--
ALTER TABLE `users_activation_codes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users_activation_codes`
--
ALTER TABLE `users_activation_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

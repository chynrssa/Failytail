-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 19, 2025 at 02:38 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `failytail`
--

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `id` int NOT NULL,
  `judul` varchar(100) NOT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `tahun_rilis` year DEFAULT NULL,
  `rating` decimal(3,1) DEFAULT NULL,
  `komentar` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`id`, `judul`, `genre`, `tahun_rilis`, `rating`, `komentar`) VALUES
(3, 'haha', 'action', 1999, '10.0', 'bagus');

-- --------------------------------------------------------

--
-- Table structure for table `filmadmin`
--

CREATE TABLE `filmadmin` (
  `id` int NOT NULL,
  `poster` varchar(255) DEFAULT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `deskripsi` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `filmadmin`
--

INSERT INTO `filmadmin` (`id`, `poster`, `judul`, `genre`, `deskripsi`) VALUES
(2, '../image/posters/Kowaru Neon Genesis Evangelion Wallpaper.jpg', 'Neon Genesis Evangelion', 'Horror', 'spongebobbbb'),
(3, '../image/posters/oppenheimer.jpg', 'Oppenheimer', 'Drama', 'deksripsi singkat'),
(4, '../image/posters/Perfect blue (1997) [691x1024].jpg', 'Perfect Blue', 'Drama', 'apayaa'),
(6, '../image/posters/Akira.jpeg', 'Akira', 'Action', 'Akira seorang ngabers'),
(7, '../image/posters/the wind rises.jpeg', 'The Wind Rises', 'Romance', 'Seorang yang jatuh cinta');
-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `film_id` int NOT NULL,
  `komentar` text NOT NULL,
  `rating` decimal(2,1) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id`, `user_id`, `film_id`, `komentar`, `rating`, `created_at`) VALUES
(2, 3, 7, 'Ini film ghibli paling romatis', 9.5, '2025-06-18 09:52:24'),
(3, 3, 6, 'Keren banget action dari akira', 9.2, '2025-06-18 09:56:03'),
(4, 4, 7, 'BAGUS BANGET NJIR', 9.2, '2025-06-18 10:17:07'),
(5, 4, 6, 'Gelo dunia nya keren', 9.0, '2025-06-18 10:21:16'),
(6, 3, 4, 'Serem banget, kasian mc nya', 9.2, '2025-06-18 10:22:52'),
(7, 4, 4, 'Duh ga kebayang', 9.0, '2025-06-18 10:23:21'),
(8, 4, 2, 'Gokil ini film ke tiga nya', 9.0, '2025-06-19 12:46:05'),
(9, 3, 2, 'Gelo shinjiii', 9.1, '2025-06-19 12:47:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`, `email`, `phone`, `alamat`) VALUES
(1, 'admin', '$2y$10$ZFFWhePTaUpxhIe3CIXG2OqL3W938q2DkTy4ULsCdIsUFbev2i5re', 'admin', '2025-05-26 06:36:10', NULL, NULL, NULL),
(2, 'user', '$2y$10$lk0eeWVYTAIHIDFLxkYBUOPWE7H.IPM6eZvQMupL2CClJhulvsquO', 'user', '2025-05-26 13:52:22', NULL, NULL, NULL),
(3, 'zane', '$2y$10$0qyJhnQEwPipbcGPsswXLeSSdzyC.tWgKD8NgTZD3UA/J2eSIpw/G', 'admin', '2025-06-18 05:44:46', 'akbar.lamborgini@gmail.com', '081573049831', 'Jalan Kebersihan Gang Nurul Hidayah No 45'),
(4, 'ilham', '$2y$10$OBO0MYpVZ.dNl0tpwMtoK.Y2UqfctvslSGYS3ySkENSa38MQoWSCy', 'user', '2025-06-18 06:14:07', 'nickle.ferum1135@gmail.com', '0872329840', 'Jalan Nasi Padang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filmadmin`
--
ALTER TABLE `filmadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `film_id` (`film_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `filmadmin`
--
ALTER TABLE `filmadmin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `fk_ulasan_filmadmin` FOREIGN KEY (`film_id`) REFERENCES `filmadmin` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ulasan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

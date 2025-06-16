-- phpMyAdmin SQL Dump gabungan
-- Database: `failytail`
-- Versi phpMyAdmin: 5.2.0
-- Server: localhost:3306
-- Waktu Pembuatan: 31 Mei 2025, 12:51 PM
-- Versi Server: 8.0.30
-- Versi PHP: 8.1.10

-- --------------------------------------------------------
-- Buat database failytail dan gunakan
-- --------------------------------------------------------

CREATE DATABASE IF NOT EXISTS `failytail` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `failytail`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------
-- Struktur tabel `users`
-- --------------------------------------------------------

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data awal untuk tabel `users`
INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'admin', '$2y$10$ZFFWhePTaUpxhIe3CIXG2OqL3W938q2DkTy4ULsCdIsUFbev2i5re', 'user', '2025-05-26 06:36:10'),
(2, 'user', '$2y$10$lk0eeWVYTAIHIDFLxkYBUOPWE7H.IPM6eZvQMupL2CClJhulvsquO', 'user', '2025-05-26 13:52:22');

-- Index dan Auto Increment tabel `users`
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE users ADD COLUMN email VARCHAR(100);
ALTER TABLE users ADD COLUMN phone VARCHAR(20);

-- --------------------------------------------------------
-- Struktur tabel `film`
-- --------------------------------------------------------

CREATE TABLE `film` (
  `id` int NOT NULL,
  `judul` varchar(100) NOT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `tahun_rilis` year DEFAULT NULL,
  `rating` decimal(3,1) DEFAULT NULL,
  `komentar` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data awal untuk tabel `film`
INSERT INTO `film` (`id`, `judul`, `genre`, `tahun_rilis`, `rating`, `komentar`) VALUES
(3, 'haha', 'action', 1999, '10.0', 'bagus');

-- Index dan Auto Increment tabel `film`
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `film`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------
-- Struktur tabel `ulasan`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS ulasan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  film_id INT NOT NULL,
  komentar TEXT NOT NULL,
  rating DECIMAL(2,1) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (film_id) REFERENCES film(id) ON DELETE CASCADE
);

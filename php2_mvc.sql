-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 22, 2024 at 06:23 AM
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
-- Database: `php2_mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `airlines`
--

CREATE TABLE `airlines` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `logo_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airlines`
--

INSERT INTO `airlines` (`id`, `name`, `logo_path`, `created_at`, `updated_at`) VALUES
(1, 'BamBoo Airline', 'QH.png', '2024-01-26 14:58:40', NULL),
(2, 'VietJet Air', 'VJ.png', '2024-01-26 14:58:40', NULL),
(3, 'Jetstar Pacific', 'BL.png', '2024-01-26 14:58:40', NULL),
(4, 'Vietnam Airline', 'VN.png', '2024-01-26 14:58:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `airports`
--

CREATE TABLE `airports` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airports`
--

INSERT INTO `airports` (`id`, `name`, `location`, `created_at`, `updated_at`) VALUES
(2, 'Tân Sơn Nhất', 'Trường Sơn, Phường 2, Tân Bình, Thành phố Hồ Chí Minh', '2024-01-26 14:37:23', NULL),
(3, 'Nội Bài', 'Phú Minh, Sóc Sơn, Hà Nộiiii', '2024-01-26 14:37:23', '2024-02-19 11:43:48'),
(20, 'Cần Thơ', 'TP. Cần Thơ', '2024-02-20 08:52:58', NULL),
(21, 'Phú Quốc', '5X7X+37V, Nguyễn Trường Tộ, Tổ 2, Phú Quốc, Kiên Giang', '2024-02-20 09:38:54', NULL),
(23, 'Đà Nẵng', '5X7X+37V, Nguyễn Trường Tộ, Tổ 2, Phú Quốc, Kiên Giang', '2024-02-21 04:58:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `airline_id` int NOT NULL,
  `seat` int NOT NULL,
  `price` int NOT NULL,
  `departure_airport_id` int NOT NULL,
  `arrival_airport_id` int NOT NULL,
  `departure_datetime` datetime NOT NULL,
  `arrival_datetime` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`id`, `name`, `airline_id`, `seat`, `price`, `departure_airport_id`, `arrival_airport_id`, `departure_datetime`, `arrival_datetime`, `status`, `created_at`, `update_at`) VALUES
(1, '', 1, 150, 500000, 2, 3, '2024-01-26 22:14:00', '2024-01-27 14:14:00', 1, NULL, NULL),
(2, '', 2, 150, 500000, 3, 2, '2024-01-27 22:14:00', '2024-01-28 14:14:00', 1, NULL, NULL),
(4, 'A123', 3, 150, 500000, 21, 3, '2024-02-21 17:55:00', '2024-02-22 17:56:00', 1, NULL, NULL),
(5, 'A123', 4, 120, 1500000, 21, 3, '2024-02-21 18:07:00', '2024-02-22 18:07:00', 1, NULL, NULL),
(6, 'VN555', 4, 180, 650000, 2, 3, '2024-02-21 18:10:00', '2024-02-22 18:10:00', 1, NULL, NULL),
(7, 'VN123', 3, 120, 850000, 3, 21, '2024-02-22 18:13:00', '2024-02-23 18:13:00', 1, NULL, NULL),
(8, 'AA159', 1, 120, 800000, 21, 3, '2024-02-22 23:02:00', '2024-02-22 16:02:00', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 là admin 1 là nhân viên',
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `phone`, `email`, `username`, `password`, `role`, `status`) VALUES
(1, 'Nguyễn Khoa', '0336216546', 'khoacntt2003@gmail.com', 'admin', '$2y$10$KwELP84YjuV4SIFUYOEv5On0952vulLVSHpu3U.1igtV/qaaUt7vS', 0, 1),
(2, 'Lý Thường Kiệt', '0909135329', 'khoanlapc06444@gmail.com', 'lykiet', '123456', 2, 1),
(4, 'Trần Văn An', '0336246546', 'khoanlapc06444@fpt.edu.vn', 'admin2', '$2y$10$0WAoZY5FzrrSKQUYNwbhXeyA3SGfcJKrrwF0LvzGrZGsYt1afeTAW', 1, 1),
(5, 'Bé Khoa', '0336246787', 'nlapckhoa06444@fpt.edu.vn', 'nguyenkhoa', '$2y$10$p4vBEPRjBdBxm0NuRLUeeuABrS2Zl4uC/i5JueGMxg9GcYw0Q4/Ne', 1, 1),
(7, 'Tào Mạnh Đức', '0909135666', 'tmdd@gmail.com', 'manhduc', '$2y$10$voPluXTAR8fle3w.OPujvudcTaKjSBlQe4/.pMOrR8zDXZFWrhn1C', 1, 1),
(8, 'Nguyễn Thanh Nhàn', '0336246645', 'nhan2003@gmail.com', 'nguyennhan', '$2y$10$iVc91VAjWEyTu/n48re01.IWpZ7j3Rn/GmaQqyxThb.v5B3hvAyMy', 1, 1),
(9, 'Trần Kiều Trang', '0336642546', 'trang2004@gmail.com', 'trang123', '$2y$10$dZ0VVoyxQfWQss7Dfu3hSeS2Jl93Vn38b6JQrFzhxKVgzQ37tvaeu', 1, 1),
(10, 'Trần Thủ Độ', '0336246999', 'trando2003@gmail.com', 'trando', '$2y$10$Q.pLAUH9fiEt4XILfGpZXu6VizRamcK9FEZRpT2BsKHb9m17EgZHq', 1, 1),
(11, 'Phan Văn Tính', '0336246777', 'tinhpv10@fpt.edu.vn', 'tinhpv10', '$2y$10$TEVE4Va6sJUFtaIDKC3cGuJ/7nrxvItFriuMqwBQa4ygMQ7ujFSUq', 1, 1),
(12, 'Trần Thanh Duy', '0336246222', 'duypc0111@fpt.edu.vn', 'duypc0111', '$2y$10$JpzDSvaPtD6obKPMVFYtoOi1/15Obqd8gPxjGT0.sb1Gi1nf4SrA2', 1, 1),
(13, 'Tào A Mang', '0336123321', 'taoamang03@gmail.com', 'taoamang', '$2y$10$S//dsVmbVJCkwAjROXjWieh5X5kSNDDRpIn8wTrfjZaCS6mM4tDGe', 1, 1),
(16, 'Nguyễn Tuấn Anh', '0336246022', 'khoanlapc061111@fpt.edu.vn', 'admin5878', '$2y$10$EWcDlxcpE798herxgSvt2uVVSd8e37djaiyeBDe9d7c3zpW8.6N2C', 1, 1),
(17, 'Nguyễn Khoa', '0336246025', 'khoanlapc0555@fpt.edu.vn', 'admin255', '$2y$10$YrasJMjWUZDSOy7MSTkhXO5tDO/UYtk6mqijZZY7puwSMOU6IdBCu', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airlines`
--
ALTER TABLE `airlines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `airports`
--
ALTER TABLE `airports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departure_airport_id` (`departure_airport_id`),
  ADD KEY `arrival_airport_id` (`arrival_airport_id`),
  ADD KEY `airline_id` (`airline_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airlines`
--
ALTER TABLE `airlines`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `airports`
--
ALTER TABLE `airports`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `flights_ibfk_1` FOREIGN KEY (`departure_airport_id`) REFERENCES `airports` (`id`),
  ADD CONSTRAINT `flights_ibfk_2` FOREIGN KEY (`arrival_airport_id`) REFERENCES `airports` (`id`),
  ADD CONSTRAINT `flights_ibfk_3` FOREIGN KEY (`airline_id`) REFERENCES `airlines` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

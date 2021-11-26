-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2020 at 02:44 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `devil`
--

-- --------------------------------------------------------

--
-- Table structure for table `ban`
--

CREATE TABLE `ban` (
  `id` int(15) NOT NULL,
  `clientid` int(11) NOT NULL,
  `ip` varchar(11) COLLATE utf8mb4_persian_ci NOT NULL,
  `time` varchar(30) COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kickrequest`
--

CREATE TABLE `kickrequest` (
  `id` int(22) NOT NULL,
  `voteyes` int(2) NOT NULL,
  `voteno` int(2) NOT NULL,
  `requestkick` varchar(15) COLLATE utf8mb4_persian_ci NOT NULL,
  `kicked` varchar(15) COLLATE utf8mb4_persian_ci NOT NULL,
  `timestart` varchar(30) COLLATE utf8mb4_persian_ci NOT NULL,
  `timestop` varchar(30) COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL,
  `message` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL,
  `time` varchar(10) COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `name`, `message`, `time`) VALUES
(401, 'VkdoTk5zUE4zSzV1NEM5enE4R1NMZz09', 'V3FLa1FST3dlaDY0T2FHTjYxYWNQeHNyaHhDWnpYeGdUZ3F3ZEdtYmg1Zz0=', '05:44:20pm'),
(402, 'THM5K0RIWUlhOFRTbWdxNEhxM2NHZz09', 'dFY0eFMvTHMwZVUxUG9tUjhOdDdLQT09', '06:39:52pm'),
(403, 'VkdoTk5zUE4zSzV1NEM5enE4R1NMZz09', 'ZHNpeEFuWkk4Q2RobGVzbml1U1R2QT09', '06:40:53pm'),
(404, 'VkdoTk5zUE4zSzV1NEM5enE4R1NMZz09', 'YlFrWlVtNlRReDZCWWE4ditESUV0Zz09', '06:40:54pm'),
(405, 'THM5K0RIWUlhOFRTbWdxNEhxM2NHZz09', 'Q0xLVHlyRUFDR0RGYno0WlJ3VVh5NklTVGtmOFQzU1NJSlQxM0VCTURqQT0=', '06:41:39pm'),
(406, 'THM5K0RIWUlhOFRTbWdxNEhxM2NHZz09', 'RDRNRFB4UnhQQkJYRDl4RmdZMHJKRkRMTWJOeEZSNTZZbVRUZGJiVUkwQT0=', '06:41:42pm'),
(407, 'THM5K0RIWUlhOFRTbWdxNEhxM2NHZz09', 'V3FLa1FST3dlaDY0T2FHTjYxYWNQK3BaNGNwckwwSzgxczFCeWpqaENkbz0=', '06:41:59pm'),
(408, 'THM5K0RIWUlhOFRTbWdxNEhxM2NHZz09', 'MmRvZ0NNNEEvNDExejU5K0d4WHpTRzA3aWF3Wk9uajEyLzNZM3VmWURrTT0=', '06:42:05pm'),
(409, 'THM5K0RIWUlhOFRTbWdxNEhxM2NHZz09', 'c3Z6RnFQTFRrMFFkUWJ0alFDRkNVdz09', '06:42:08pm'),
(410, 'VkdoTk5zUE4zSzV1NEM5enE4R1NMZz09', 'T3liZE5CTWlHQzVnNkxVM1BJRXVBZz09', '11:07:54pm'),
(411, 'VkdoTk5zUE4zSzV1NEM5enE4R1NMZz09', 'bmIySDhkcHFQYlBiOFpZMmJXQ0lTdz09', '11:07:57pm'),
(412, 'VkdoTk5zUE4zSzV1NEM5enE4R1NMZz09', 'MmpuVCtIVzhVMVAvZks0VnRadjJUUT09', '11:32:08pm'),
(413, 'VkdoTk5zUE4zSzV1NEM5enE4R1NMZz09', 'MENhd2lxMFRtRFZvU2RnbW1YWnhmWGVTNlJCQlVsTnB4Z09wOG1zdDJTMD0=', '04:46:28pm'),
(414, 'VkdoTk5zUE4zSzV1NEM5enE4R1NMZz09', 'U0VoeHlBMzVGV0Q5eFNFZXIyYkV1UT09', '04:46:29pm'),
(415, 'VkdoTk5zUE4zSzV1NEM5enE4R1NMZz09', 'bzYxS0xEbGNVeGpPZ2NteTl2c2FZQT09', '04:50:14pm'),
(416, 'VkdoTk5zUE4zSzV1NEM5enE4R1NMZz09', 'bWlMTDh1dHlpTkZmTWt1WVBIRWlzQT09', '04:57:20pm'),
(417, 'VkdoTk5zUE4zSzV1NEM5enE4R1NMZz09', 'NmdJclBFcmpVcWIwSnQ0KzQ5bm5odz09', '04:57:28pm'),
(418, 'VkdoTk5zUE4zSzV1NEM5enE4R1NMZz09', 'ZlUxWlRnRWRldU95Nk9nclpuY1lKUT09', '11:27:20pm'),
(419, 'VkdoTk5zUE4zSzV1NEM5enE4R1NMZz09', 'TXA0OER6aDc4RklVcG9yOG1KMHM4Zz09', '05:44:05pm'),
(420, 'VkdoTk5zUE4zSzV1NEM5enE4R1NMZz09', 'TVdIN3NrNGYvQ3QxM1lFUDJaRlNSWVhDbXFQOWlSRkNqTzIza1p6RENRVT0=', '05:53:30pm'),
(421, 'THM5K0RIWUlhOFRTbWdxNEhxM2NHZz09', 'QVNicGkxRTJzZm9lSlh3ZWx3eTExc1h5MFNia1B4VmZlemNBODI4akdFVT0=', '05:55:20pm'),
(422, 'THM5K0RIWUlhOFRTbWdxNEhxM2NHZz09', 'Yy9DVmJFcFVseXNvTmlFMEd6RXk1Zz09', '05:55:22pm'),
(423, 'VkdoTk5zUE4zSzV1NEM5enE4R1NMZz09', 'NzVSVms3aGNJTFRKa1JOZzBhK08wdz09', '12:33:39pm'),
(424, 'VkdoTk5zUE4zSzV1NEM5enE4R1NMZz09', 'OWRSOW1EU2Y1STB6MVN4UEJwaGJaUT09', '12:33:40pm');

-- --------------------------------------------------------

--
-- Table structure for table `messagepriversection`
--

CREATE TABLE `messagepriversection` (
  `id` int(11) NOT NULL,
  `creator` varchar(11) COLLATE utf8mb4_persian_ci NOT NULL,
  `reciver` varchar(11) COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `messagepriversection`
--

INSERT INTO `messagepriversection` (`id`, `creator`, `reciver`) VALUES
(129, '33', '27'),
(130, '32', '32'),
(131, '30', '31'),
(132, '30', '32');

-- --------------------------------------------------------

--
-- Table structure for table `messageprivet`
--

CREATE TABLE `messageprivet` (
  `id` int(11) NOT NULL,
  `sendername` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL,
  `recivername` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL,
  `message` varchar(200) COLLATE utf8mb4_persian_ci NOT NULL,
  `time` varchar(10) COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `messageprivet`
--

INSERT INTO `messageprivet` (`id`, `sendername`, `recivername`, `message`, `time`) VALUES
(111, '30', '31', 'NDdtMlBRemNiZnpKNG5ZU1psTDZEL0VYZVhVZWJwSHZQZ1gyNWd0dExJVT0=', '04:41:26pm'),
(112, '30', '31', 'WkNjaUl6UE16ejdqRlZNR052Z0c2UT09', '04:46:45pm'),
(113, '30', '31', 'TFhrMzZIdlVIdndOM0JPMVdUdVBVYjhERmlPNys2RXZkSStmQnVHSGJ5MD0=', '05:53:37pm'),
(114, '31', '30', 'Y1lPQ0hHN0hBU0VrWTlGUFJDU2ZJUEtudXJtdFN2M1JDSW40MUFaU0tkST0=', '05:54:11pm'),
(115, '30', '31', 'ZU9EczJLVmZtT2x0NHYySnlJNlZpY2k0akdaS2NMM1I0SU5Kc2dLekZJTT0=', '05:54:26pm'),
(116, '30', '31', 'K3lBd0FIUkpZOTRqRkRYbWFWazNSZz09', '05:54:28pm'),
(117, '30', '32', 'V3cwQklIcmhodUk5MFY0R3dhWmtvSHhLYUFpd21ldEt1dTZIbjZTREZJQT0=', '05:54:39pm');

-- --------------------------------------------------------

--
-- Table structure for table `online`
--

CREATE TABLE `online` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `onlineid` int(11) NOT NULL,
  `clientid` varchar(11) COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `time` varchar(30) COLLATE utf8mb4_persian_ci NOT NULL,
  `ip` varchar(12) COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_persian_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_persian_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_persian_ci NOT NULL,
  `onlineid` int(30) NOT NULL,
  `ip` varchar(12) COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `onlineid`, `ip`) VALUES
(30, 'VkdoTk5zUE4zSzV1NEM5enE4R1NMZz09', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'NEovRW4vQWQ5b1ZBZldqZ2QyNVk1UzdPVW9CM0E1TDgxUmg5ejJGejNSdz0=', 1721945613, '::1'),
(31, 'THM5K0RIWUlhOFRTbWdxNEhxM2NHZz09', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'Yjh6Lzc2enAwUXE5Y1YrQWVmb2pPRXlNOW84dkVyVDVBZ3hiRkdwUWxacz0=', 1504145473, '::1'),
(32, 'Q29yZHIwSU1kZGlaYlRCMFdMNE8vQT09', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'UlZOdkJva1J5dU1xUnRyelBsbW5EeUVYdXRsNjlseXB2ZmxyYVRnM3ZFYz0=', 664930989, '::1'),
(33, 'cThrQ1ZuS01UZlROeldiWFh3T2VhQT09', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'eGV2aVNaRXdEVmlTWmYzbytzdkJLUT09', 1078935976, '::1'),
(34, 'WnhTc3pkTXVsai9YMDQ2cEJJVXlqZz09', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'YTYzZzM4KzdlSENJUWVHaUtXazd4dz09', 108643021, '::1'),
(36, 'MWlCZmhFZ0pmR2R4WFVvNm9Lc0dxUT09', '65049b1f34173a5fb7ac93970f4bb7069f8b82705bd464e4cdbb8629d1c5a0ec', 'WEhKeHpaaGtDK1pLSDdBU0dXN2E3K0tJdkM0RTl2b1ZQSlhZQjQ3NGdrRT0=', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ban`
--
ALTER TABLE `ban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kickrequest`
--
ALTER TABLE `kickrequest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messagepriversection`
--
ALTER TABLE `messagepriversection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messageprivet`
--
ALTER TABLE `messageprivet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online`
--
ALTER TABLE `online`
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
-- AUTO_INCREMENT for table `ban`
--
ALTER TABLE `ban`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kickrequest`
--
ALTER TABLE `kickrequest`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=425;

--
-- AUTO_INCREMENT for table `messagepriversection`
--
ALTER TABLE `messagepriversection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `messageprivet`
--
ALTER TABLE `messageprivet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `online`
--
ALTER TABLE `online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=445;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

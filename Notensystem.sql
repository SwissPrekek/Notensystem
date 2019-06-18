-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2019 at 11:21 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notensystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `facher`
--

CREATE TABLE `facher` (
  `FachID` int(11) NOT NULL,
  `Facher` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prufung`
--

CREATE TABLE `prufung` (
  `PrufungID` int(11) NOT NULL,
  `FachID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Note` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `firstname`, `lastname`, `username`, `password`, `email`) VALUES
(1, 'Fabian', 'Zeller', 'SwissPrekek', '$2y$10$iAQU6j9Ml2Tsl5GyfY//2er0c328eJ3Upte8QR6n6X5bZVY1nH.YK', 'fabian.z@eblcom.ch');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `facher`
--
ALTER TABLE `facher`
  ADD UNIQUE KEY `Fachid` (`FachID`);

--
-- Indexes for table `prufung`
--
ALTER TABLE `prufung`
  ADD PRIMARY KEY (`PrufungID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `id` (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `prufung`
--
ALTER TABLE `prufung`
  MODIFY `PrufungID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

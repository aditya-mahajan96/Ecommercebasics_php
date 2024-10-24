-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2024 at 05:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aditya_assignment2`
--

-- --------------------------------------------------------

--
-- Table structure for table `cellphone`
--

CREATE TABLE `cellphone` (
  `CellPhonesId` int(11) NOT NULL,
  `CellPhoneName` varchar(250) NOT NULL,
  `CellPhoneDescription` varchar(300) NOT NULL,
  `QuantityAvailable` int(11) NOT NULL,
  `Price` float NOT NULL,
  `ProductAddedBy` varchar(200) NOT NULL,
  `CellPhoneCompany` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cellphone`
--

INSERT INTO `cellphone` (`CellPhonesId`, `CellPhoneName`, `CellPhoneDescription`, `QuantityAvailable`, `Price`, `ProductAddedBy`, `CellPhoneCompany`) VALUES
(9, 's23', 'samsung', 25, 989, 'Aditya Mahajan', 'Samsung'),
(10, 'galaxy', 'samsung', 25, 699, 'Aditya Mahajan', 'Samsung'),
(11, 'iphone 15 pro', 'Apple phone', 21, 1500, 'Aditya Mahajan', 'Apple'),
(12, 'iphone', '15', 24, 1200, 'Aditya Mahajan', 'Apple');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cellphone`
--
ALTER TABLE `cellphone`
  ADD PRIMARY KEY (`CellPhonesId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cellphone`
--
ALTER TABLE `cellphone`
  MODIFY `CellPhonesId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

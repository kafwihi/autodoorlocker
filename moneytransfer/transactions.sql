-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 15, 2019 at 01:23 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transactions`
--

-- --------------------------------------------------------

--
-- Table structure for table `business_details`
--

CREATE TABLE `business_details` (
  `shortcode` int(8) NOT NULL,
  `idnumber` int(10) NOT NULL,
  `business_name` varchar(20) NOT NULL,
  `business_location` varchar(30) NOT NULL,
  `business_type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_details`
--

INSERT INTO `business_details` (`shortcode`, `idnumber`, `business_name`, `business_location`, `business_type`) VALUES
(174379, 33452345, 'Diamond Limited', 'Mombasa', 'Retail');

-- --------------------------------------------------------

--
-- Table structure for table `lipanampesa`
--

CREATE TABLE `lipanampesa` (
  `merchantRequestID` varchar(40) NOT NULL,
  `amount` int(5) DEFAULT NULL,
  `mpesaReceiptNumber` varchar(45) DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `transactionDate` varchar(60) DEFAULT NULL,
  `shortcode` int(11) NOT NULL,
  `phoneNumber` int(13) DEFAULT NULL,
  `ResultCode` int(2) DEFAULT NULL,
  `ResultDesc` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lipanampesa`
--

INSERT INTO `lipanampesa` (`merchantRequestID`, `amount`, `mpesaReceiptNumber`, `balance`, `transactionDate`, `shortcode`, `phoneNumber`, `ResultCode`, `ResultDesc`) VALUES
('3053-2617823-1', 1, NULL, NULL, '14November2019', 174379, NULL, NULL, NULL),
('6732-1928340-1', 1, 'NKE5YHE2DP', 0, '14November2019', 174379, NULL, 0, 'The service request is processed successfully.');

-- --------------------------------------------------------

--
-- Table structure for table `registration_money`
--

CREATE TABLE `registration_money` (
  `idnumber` int(10) NOT NULL,
  `amount` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `firstname` varchar(16) NOT NULL,
  `lastname` varchar(16) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(128) NOT NULL,
  `idnumber` int(10) NOT NULL,
  `phonenumber` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`firstname`, `lastname`, `email`, `password`, `idnumber`, `phonenumber`) VALUES
('Peter', 'Wakiaga', 'Samuelmuraguri@outlook.com', '123456', 33452267, 2147483647),
('Peter', 'Wakiaga', 'Samuelmuraguri@outlook.com', '123456', 33452289, 2147483647),
('Peter', 'Wakiaga', 'pwakiaga@gmail.com', '123456', 33452345, 2147483647),
('Peter', 'Wakiaga', 'mingusam@gmail.com', '123456', 33452367, 2147483647),
('Peter', 'Wakiaga', 'mingusam@gmail.com', '123456', 33452398, 2147483647);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business_details`
--
ALTER TABLE `business_details`
  ADD PRIMARY KEY (`shortcode`),
  ADD UNIQUE KEY `business_name` (`business_name`),
  ADD KEY `idnumber` (`idnumber`);

--
-- Indexes for table `lipanampesa`
--
ALTER TABLE `lipanampesa`
  ADD PRIMARY KEY (`merchantRequestID`),
  ADD KEY `shortcode` (`shortcode`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`idnumber`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `business_details`
--
ALTER TABLE `business_details`
  ADD CONSTRAINT `business_details_ibfk_1` FOREIGN KEY (`idnumber`) REFERENCES `user_details` (`idnumber`);

--
-- Constraints for table `lipanampesa`
--
ALTER TABLE `lipanampesa`
  ADD CONSTRAINT `lipanampesa_ibfk_1` FOREIGN KEY (`shortcode`) REFERENCES `business_details` (`shortcode`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

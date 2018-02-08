-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2017 at 04:57 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newmarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `productCount` int(11) DEFAULT NULL,
  `shopID` int(11) NOT NULL,
  `productID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`productCount`, `shopID`, `productID`) VALUES
(20, 1, 1),
(8, 1, 3),
(50, 1, 7),
(5, 2, 2),
(7, 2, 8),
(12, 3, 5),
(225, 3, 14),
(19, 4, 9),
(50, 5, 4),
(200, 5, 6),
(7, 6, 11),
(78, 7, 12),
(99, 7, 17),
(19, 8, 13),
(31, 8, 15),
(9, 8, 16),
(91, 9, 18);

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `price` float DEFAULT NULL,
  `productID` int(11) NOT NULL,
  `shopID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`price`, `productID`, `shopID`) VALUES
(30000, 1, 1),
(8000, 3, 1),
(750, 7, 1),
(5000, 2, 2),
(1200, 8, 2),
(135, 5, 3),
(225, 10, 3),
(140, 14, 3),
(350, 9, 4),
(120, 4, 5),
(180, 6, 5),
(28000, 11, 6),
(100000, 12, 7),
(80000, 17, 7),
(20000, 13, 8),
(105000, 15, 8),
(9900, 16, 8),
(220, 18, 9);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `productName` text,
  `productType` text,
  `productModel` text,
  `productColor` text,
  `productImage` longtext NOT NULL,
  `shopID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productName`, `productType`, `productModel`, `productColor`, `productImage`, `shopID`) VALUES
(1, 'Samsung Note 3', 'Mobile', 'Note 3', 'White', '', 1),
(2, 'Philips Magic Wand', 'Appliance ', 'SRT500', 'Grey', '', 2),
(3, 'Philips Blender', 'Appliance', 'TTD1000', 'White', '', 1),
(4, 'Chicken Fry', 'Food', 'N/A', 'N/A', '', 5),
(5, 'Neem Toothpaste', 'Disposable', 'N/A', 'White', '', 3),
(6, 'Chicken Burger', 'Food', 'N/A', 'N/A', '', 5),
(7, 'LED Tubelight', 'Electronics', 'LED1000', 'Cyan', '', 1),
(8, 'Ceiling Fan', 'Electronics', 'FN610', 'Green', '', 2),
(9, 'Facewash', 'Disposable', 'N/A', 'Red', '', 4),
(10, 'Body Spray', 'Disposable', 'N/A', 'Purple', '', 3),
(11, 'Nokia 8', 'Mobile', 'Nokia 8', 'Grey', '', 6),
(12, 'iPhone X', 'Mobile', 'iPhone X', 'Black', '', 7),
(13, 'Samsung Note 2', 'Mobile', 'GSM320', 'Blue', '', 8),
(14, 'Chicken Fry', 'Food', 'N/A', 'N/A', '', 3),
(15, 'iPhone X ', 'Mobile', 'iPhone X SE', 'Grey', '', 8),
(16, 'Symphony W10', 'Mobile', 'WTX90', 'Red', '', 8),
(17, 'iPhone 8', 'Mobile', 'iosGG', 'Neon', '', 7),
(18, 'Chocolate Donut', 'Food', 'N/A', 'N/A', '', 9);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `comment` text,
  `rating` int(11) DEFAULT NULL,
  `shopID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`comment`, `rating`, `shopID`) VALUES
('Best', 4, 1),
('Jhakaas', 5, 2),
('Mediocre', 2, 3),
('Good Enough', 3, 4),
('Food is not good', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `shopID` int(11) NOT NULL,
  `shopName` text,
  `shopType` text,
  `shopAddress` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`shopID`, `shopName`, `shopType`, `shopAddress`) VALUES
(1, 'Samsung Store', 'Electronics', 'Bashundhara City Level 4'),
(2, 'Philips Store', 'Electronics', 'Jamuna Future Park Level 1'),
(3, 'Meena Store', 'General Store', 'Dhanmondi - 4'),
(4, 'Agora Store', 'General Store', 'Dhanmondi 15A'),
(5, 'BFC', 'Fast Food', 'Dhanmondi 28'),
(6, 'Nokia Store', 'Electronics', 'Jamuna level 3'),
(7, 'Apple Store', 'Mobie', 'Bashundhara level 4'),
(8, 'All Mobile Store', 'Mobile', 'Jamuna Level 3'),
(9, 'Crunchy Donuts ', 'Food', 'Gulshan 1 ');

-- --------------------------------------------------------

--
-- Table structure for table `shopkeeper`
--

CREATE TABLE `shopkeeper` (
  `skID` int(11) NOT NULL,
  `skEmail` text NOT NULL,
  `skPassword` text NOT NULL,
  `skName` text,
  `skContact` text,
  `shopID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopkeeper`
--

INSERT INTO `shopkeeper` (`skID`, `skEmail`, `skPassword`, `skName`, `skContact`, `shopID`) VALUES
(1, 'dipanzan@live.com', '123', 'Dipanzan Islam', '987654321', 1),
(2, 'rifat@gmail.com', '456', 'Rifat Arefin', '456123789', 2),
(3, 'sohel@gmail.com', '789123456', 'Sohel', '123456789', 3),
(4, 'adnan@gmail.com', '836294', 'Adnan', '47924595', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`shopID`,`productID`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`shopID`,`productID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`),
  ADD UNIQUE KEY `productID` (`productID`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`shopID`),
  ADD UNIQUE KEY `shopID` (`shopID`);

--
-- Indexes for table `shopkeeper`
--
ALTER TABLE `shopkeeper`
  ADD PRIMARY KEY (`skID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shopkeeper`
--
ALTER TABLE `shopkeeper`
  MODIFY `skID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

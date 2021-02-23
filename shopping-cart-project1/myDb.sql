-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2021 at 09:56 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Id` int(11) NOT NULL,
  `UserName` text NOT NULL,
  `Password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Id`, `UserName`, `Password`) VALUES
(1, 'Admin', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Id` int(11) NOT NULL,
  `FullName` text NOT NULL,
  `Email` text NOT NULL,
  `Address` text NOT NULL,
  `City` text NOT NULL,
  `State` text NOT NULL,
  `ZipCode` text NOT NULL,
  `Created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Id`, `FullName`, `Email`, `Address`, `City`, `State`, `ZipCode`, `Created`) VALUES
(28, 'Alan Teo', 'smithjade1212@hotmail.com', '75 West End Ave Apt C4J', 'New York', 'NY', '10023', '2020-10-12 15:50:59'),
(29, 'Alan Teo', 'smithjade1212@hotmail.com', '75 West End Ave Apt C4J', 'New York', 'NY', '10023', '2020-10-12 15:52:55'),
(30, 'Alan Teo', 'smithjade1212@hotmail.com', '75 West End Ave Apt C4J', 'New York', 'NY', '10023', '2020-10-14 06:01:12'),
(31, 'Alan Teo', 'smithjade1212@hotmail.com', '75 West End Ave Apt C4J', 'New York', 'NY', '10023', '2021-01-27 14:13:16');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `Id` int(11) NOT NULL,
  `Name` text NOT NULL,
  `StartDate` date NOT NULL,
  `Email` text NOT NULL,
  `Phone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`Id`, `Name`, `StartDate`, `Email`, `Phone`) VALUES
(1, 'Alan Teo', '2021-01-22', 'alanteo1006@outlook.com', '516 472 4746'),
(2, 'Douglass Leavy', '2021-01-02', 'douglassleavy@hotmail.com', '338 687 2451'),
(11, 'Curtiss Pope', '2012-01-31', 'curtiss@gmail.com', '387 293 8432'),
(13, 'Brandon Harris', '2020-04-30', 'brandonharris128@gmail.com', '732 223 9821');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Id` int(8) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Code` varchar(255) NOT NULL,
  `Image` text NOT NULL,
  `Price` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Id`, `Name`, `Description`, `Code`, `Image`, `Price`) VALUES
(1, 'FinePix Pro2 3D Camera', 'This is description for first product', '3DcAM01', 'image/product-images/camera.jpg', 1500.00),
(2, 'EXP Portable Hard Drive', 'This is description for second product', 'USB02', 'image/product-images/external-hard-drive.jpg', 800.00),
(3, 'Luxury Ultra thin Wrist Watch', 'This is description for third product', 'wristWear03', 'image/product-images/watch.jpg', 300.00),
(4, 'XP 1155 Intel Core Laptop', 'This is description for forth product', 'LPN45', 'image/product-images/laptop.jpg', 800.00),
(5, 'New Apple iPhone X', 'This is description for fifth product', 'Test32', 'image/product-images/phone.jpg', 399.00),
(24, 'Bottles', 'This is pretty cute bottle for children.', 'bo-23', 'image/product-images/2021_01_27_14_46_26_dinoexample.JPG', 34.00);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `Id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`Id`, `UserId`, `ProductId`, `Quantity`) VALUES
(20, 28, 1, 1),
(21, 28, 2, 2),
(22, 28, 3, 3),
(23, 28, 4, 4),
(24, 29, 1, 1),
(25, 29, 2, 1),
(26, 30, 3, 1),
(27, 30, 4, 1),
(28, 31, 4, 10),
(29, 31, 5, 1),
(30, 31, 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `product_code` (`Code`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

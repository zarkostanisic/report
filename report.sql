-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2019 at 04:22 PM
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
-- Database: `report`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `serial` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `address`, `serial`) VALUES
(1, 'Zarko Stanisic', 'Naselje Milorada Pavlovica 13, Valjevo', 'cc54rt'),
(2, 'Ivana Milic', 'Ravanicka 1, Beograd', 'bbfght');

-- --------------------------------------------------------

--
-- Table structure for table `operaters`
--

CREATE TABLE `operaters` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `operaters`
--

INSERT INTO `operaters` (`id`, `name`) VALUES
(1, 'Goran'),
(2, 'Milica');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `operater_id` varchar(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `expensive_old` int(11) NOT NULL,
  `expensive_new` int(11) NOT NULL,
  `cheap_old` int(11) NOT NULL,
  `cheap_new` int(11) NOT NULL,
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `operater_id`, `customer_id`, `expensive_old`, `expensive_new`, `cheap_old`, `cheap_new`, `year`, `month`, `created_at`) VALUES
(1, '2', 1, 123, 160, 321, 328, 2019, 1, '2019-02-05 00:00:00'),
(7, '1', 1, 160, 180, 328, 360, 2019, 2, '2019-03-03 00:00:00'),
(8, '2', 1, 180, 240, 360, 360, 2019, 3, '2019-04-06 00:00:00'),
(9, '1', 1, 240, 250, 360, 370, 2019, 4, '2019-05-07 00:00:00'),
(10, '1', 1, 250, 300, 370, 372, 2019, 5, '2019-06-02 00:00:00'),
(11, '1', 1, 300, 320, 372, 400, 2019, 6, '2019-07-05 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operaters`
--
ALTER TABLE `operaters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `year` (`year`),
  ADD KEY `operater_id` (`id`),
  ADD KEY `month` (`month`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `operaters`
--
ALTER TABLE `operaters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

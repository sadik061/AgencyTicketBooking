-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2018 at 11:55 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travelagency`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Cell_No` varchar(255) DEFAULT NULL,
  `Point` int(11) DEFAULT NULL,
  `Comission` double DEFAULT NULL,
  `Entry_By` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `Name`, `Cell_No`, `Point`, `Comission`, `Entry_By`) VALUES
(1, 'Muzahid', '0156823265', 0, 0, 1),
(2, 'M', '546345', 0, 2, 2),
(3, 'Fahim', '01687454010', 0, 5, 1),
(4, 'MJ Rawling', '8856541323', 0, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `maindata`
--

CREATE TABLE `maindata` (
  `input_id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Cell_No` int(11) DEFAULT NULL,
  `Fare` int(11) DEFAULT NULL,
  `Paid` int(11) DEFAULT NULL,
  `Due` int(11) DEFAULT NULL,
  `Commission` int(11) DEFAULT NULL,
  `Entry_By` int(11) DEFAULT NULL,
  `Ticket_By` varchar(255) DEFAULT NULL,
  `Comment` varchar(255) DEFAULT NULL,
  `Point` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Flown_Date` datetime DEFAULT NULL,
  `Pnr` varchar(255) DEFAULT NULL,
  `Pax` int(11) DEFAULT NULL,
  `Route` varchar(255) DEFAULT NULL,
  `Airlines` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maindata`
--

INSERT INTO `maindata` (`input_id`, `Name`, `Cell_No`, `Fare`, `Paid`, `Due`, `Commission`, `Entry_By`, `Ticket_By`, `Comment`, `Point`, `Date`, `Flown_Date`, `Pnr`, `Pax`, `Route`, `Airlines`) VALUES
(1, 'Abdullah Al Rifat', 2147483647, 25000, 25000, 0, 0, 1, 'Sadik Ahammed', 'None', 0, '2018-03-21', '2018-03-22 00:00:00', 'Programmers Premier League', 151270, '1671', 'UIU'),
(2, 'William Morris', 2147483647, 25000, 25000, 0, 0, 1, 'Sadik Ahammed', 'None', 0, '2018-03-28', '2018-03-29 00:00:00', 'ICT', 151450, '1671', 'UIU'),
(3, 'William Morris', 2147483647, 25000, 25000, 0, 0, 2, 'xxx', 'None', 0, '2018-03-19', '2018-03-22 00:00:00', 'ICT', 151151, '1671', 'UIU'),
(4, 'Abdullah Al Rifat', 2147483647, 25000, 25000, 0, 0, 2, 'Sadik Ahammed', 'None', 0, '0000-00-00', '2018-03-20 18:09:52', 'ICT', 151270, '1671', 'UIU'),
(5, 'Abdullah Al Rifat', 2147483647, 25000, 25000, 0, 0, 2, 'Sadik Ahammed', 'None', 0, '0000-00-00', '2018-03-20 18:09:52', 'ICT', 151270, '1671', 'UIU'),
(6, 'William Morris', 2147483647, 25000, 25000, 0, 0, 2, 'Sadik Ahammed', 'None', 0, '2018-03-20', '2018-03-20 18:19:49', 'Programmers Premier League', 151270, '1671', 'UIU');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `PhoneNo` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `Name`, `PhoneNo`, `Email`, `Password`) VALUES
(1, 'Abdullah Al Rifat', '01671080275', 'abdullahalrifat95@gmail.com', '1234'),
(2, 'Sadik Ahammed', '01686076067', 'sadik061@gmail.com', '0000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Entry_By` (`Entry_By`);

--
-- Indexes for table `maindata`
--
ALTER TABLE `maindata`
  ADD PRIMARY KEY (`input_id`),
  ADD KEY `Entry_By` (`Entry_By`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `maindata`
--
ALTER TABLE `maindata`
  MODIFY `input_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`Entry_By`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `maindata`
--
ALTER TABLE `maindata`
  ADD CONSTRAINT `maindata_ibfk_1` FOREIGN KEY (`Entry_By`) REFERENCES `user` (`id`) ON DELETE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

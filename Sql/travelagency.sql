-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2018 at 10:20 AM
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
  `id` int(11) AUTO_INCREMENT,
  `Name` varchar(255),
  `Cell_No` varchar(255),
  `Point` int(11),
  `Comission` double,
  `Entry_By` int(11),
   primary key (id),
    foreign key (Entry_By) references user(id)
		on delete set null
);

-- --------------------------------------------------------

--
-- Table structure for table `maindata`
--

CREATE TABLE `maindata` (
  `input_id` int(11) AUTO_INCREMENT,
  `Name` varchar(255),
  `Cell_No` int(11),
  `Fare` int(11),
  `Paid` int(11),
  `Due` int(11),
  `Commission` int(11),
  `Entry_By` int(11),
  `Ticket_By` varchar(255),
  `Comment` varchar(255),
  `Point` int(11),
  `Date` date ,
  `Flown_Date` date,
  `Pnr` varchar(255),
  `Pax` int(11),
  `Route` varchar(255),
  `Airlines` varchar(255),
   primary key (input_id),
    foreign key (Entry_By) references user(id)
		on delete set null
);

CREATE TABLE `user` (
  `id` int(11) AUTO_INCREMENT,
  `Name` varchar(255),
  `PhoneNo` varchar(255),
  `Email` varchar(255),
  `Password` varchar(255),
  primary key (id)
);

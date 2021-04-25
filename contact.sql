-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2020 at 05:34 AM
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
-- Database: `contact`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user`, `pass`) VALUES
(1, 'Myuser', 'SA1@123');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `profession` varchar(85) NOT NULL,
  `email` varchar(85) NOT NULL,
  `phoneNo` int(13) NOT NULL,
  `city` varchar(85) NOT NULL,
  `address` varchar(150) NOT NULL,
  `category` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `fullname`, `profession`, `email`, `phoneNo`, `city`, `address`, `category`) VALUES
(1, 'Robin Nixon', 'Academic', 'rnixon@yahoo.com', 2147483647, 'Johannesburg', '123 Crubs Road, Santon, 1234', 'Business'),
(2, 'Dick Tombs', 'Consultant', 'dicktom@gmail.com', 815697245, 'Durban', '10 Beach Road, Durban 4568', 'Private'),
(3, 'Norma Canes', 'Salsesperson', 'canesnorm@outlook.com', 2147483647, 'Cape Town', 'Cape Town\\\', \\\'10 Spencer Road, Goodwood, 7460', 'Private'),
(4, 'Evidance Mokgabudi', 'Student', 'evidance@gmail.com', 713916290, 'Witbank', '2710 Klarinet ext6', 'Private'),
(5, 'Boston College', 'Academic', 'info@boston.co.za', 115512000, 'Johannesburg', '179 Ave and Botha Street, Johannesburg', 'Business'),
(6, 'Stephanie Moyo', 'Intern', 'stephy@stems.co.za', 627347899, 'Bellvile', '2nd Flow Towers', 'Business');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`(20));

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fullname` (`fullname`(20)),
  ADD KEY `phoneNo` (`phoneNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

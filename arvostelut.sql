-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18.12.2018 klo 11:10
-- Palvelimen versio: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arvostelut`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `arvostelu`
--

CREATE TABLE `arvostelu` (
  `id` int(11) NOT NULL,
  `nimi` varchar(50) NOT NULL,
  `kommentti` varchar(300) NOT NULL,
  `arvosana` int(11) NOT NULL,
  `aika` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vedos taulusta `arvostelu`
--

INSERT INTO `arvostelu` (`id`, `nimi`, `kommentti`, `arvosana`, `aika`) VALUES
(1, 'jasmine test', 'test', 5, '2018-12-02 18:00:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arvostelu`
--
ALTER TABLE `arvostelu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arvostelu`
--
ALTER TABLE `arvostelu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

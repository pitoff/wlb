-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2021 at 04:32 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gls`
--

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `id` int(11) NOT NULL,
  `user_id` int(2) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `status` varchar(11) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `current_bal` int(11) NOT NULL,
  `available_bal` int(11) NOT NULL,
  `dod` varchar(11) NOT NULL,
  `d_debit` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`id`, `user_id`, `transaction_id`, `status`, `sender`, `amount`, `current_bal`, `available_bal`, `dod`, `d_debit`) VALUES
(1, 2, 'gprN0H5d7Alb', 'credit', 'iranianbank', 800000, 803000, 800142, '2019-02-04', ''),
(2, 3, 'gHk8q60r5Mlb', '', 'malaysian bank', 900000, 920000, 920000, '2019-11-27', '');

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `id` int(11) NOT NULL,
  `user_id` int(2) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `acc_name` varchar(50) NOT NULL,
  `acc_num` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `new_balance` int(11) NOT NULL,
  `pin` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `role` int(2) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `country` varchar(50) NOT NULL,
  `state` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` varchar(11) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `acc_num` varchar(50) NOT NULL,
  `pin` int(5) NOT NULL,
  `nok` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `role`, `surname`, `firstname`, `email`, `password`, `country`, `state`, `image`, `gender`, `dob`, `occupation`, `status`, `mname`, `acc_num`, `pin`, `nok`) VALUES
(1, 1, 'admin', 'admin', 'admin@admin.com', '$2y$10$LRkSOXWrRiRhUQvJpfjy9.A.XIOUjbIA9xg0BvZWF/MXtuRxSzstq', '', '', '', '', '', '', '', '', '', 0, ''),
(2, 2, 'Thomas', 'mills', 'thmills123@gmail.com', '$2y$10$lThQHjrCD9TN1LXBUxUkwuGFQAOc.iUeN5ECSgFFTGPe1C3DGVS3a', 'United states', 'Indiana', '12196081_10208463086799529_6938624753439977636_n.jpg', 'male', '1984-01-23', 'soldier', 'single', 'milliano sylvia', 'r-12368-989-1563', 12345, 'Diana thomas'),
(3, 2, 'Dalia', 'patria', 'dalia@yahoo.com', '$2y$10$wh52aaa5cUMHH49qF0zOWO7wk5BrOemHI0N/XJgEMHjtyLVdpQ2P6', 'USA', 'pennysylvania', 'h5OvDRhu9jc.jpg', 'female', '1981-05-17', 'real estate', 'married', 'patricia', 'r-12368-989-1563', 12345, 'diana newman');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

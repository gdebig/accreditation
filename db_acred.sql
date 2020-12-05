-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2020 at 02:23 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_acred`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `gelar_depan` varchar(100) NOT NULL,
  `gelar_belakang` varchar(100) NOT NULL,
  `NIP` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `no_HP` varchar(15) NOT NULL,
  `status` enum('new','active','inactive') NOT NULL,
  `login_SSO` varchar(50) NOT NULL,
  `role` varchar(10) NOT NULL,
  `non_DTE` int(11) NOT NULL,
  `pensiun` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `name`, `gelar_depan`, `gelar_belakang`, `NIP`, `username`, `email`, `password`, `no_HP`, `status`, `login_SSO`, `role`, `non_DTE`, `pensiun`, `date_created`, `date_modified`) VALUES
(1, 'Admin', '', 'Ph.D', '', 'admin@ui.ac.id', 'admin@ui.ac.id', '21232f297a57a5a743894a0e4a801fc3', '', 'active', '', '1000000', 0, 0, '2020-12-04 22:52:59', '2020-12-04 22:52:59'),
(5, 'I Gde Dharma Nugraha', '', '', '100120310270012891', 'i.gde', 'i.gde@ui.ac.id', '', '', 'new', 'yes', '0000100', 0, 0, '2020-12-04 04:52:30', '2020-12-04 22:52:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

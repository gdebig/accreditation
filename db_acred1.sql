-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2020 at 01:46 PM
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
-- Table structure for table `tbl_anggotatimkur`
--

CREATE TABLE `tbl_anggotatimkur` (
  `anggota_id` int(11) NOT NULL,
  `timkur_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Jabatan` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_anggotatimkur`
--

INSERT INTO `tbl_anggotatimkur` (`anggota_id`, `timkur_id`, `user_id`, `Jabatan`, `date_created`, `date_modified`) VALUES
(4, 3, 54, 'Ketua', '2020-12-13 19:50:36', '2020-12-13 19:50:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_anggotatimpdca`
--

CREATE TABLE `tbl_anggotatimpdca` (
  `anggota_id` int(11) NOT NULL,
  `timpdca_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Jabatan` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_man`
--

CREATE TABLE `tbl_man` (
  `man_id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `user_id` int(10) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_man`
--

INSERT INTO `tbl_man` (`man_id`, `title`, `prodi`, `user_id`, `date_created`, `date_modified`) VALUES
(25, 'kadep', 'elektro', 11, '2020-12-13 05:12:22', '2020-12-13 05:12:22'),
(26, 'sekdep', 'elektro', 13, '2020-12-13 05:13:23', '2020-12-13 05:13:23'),
(27, 'ketua', 'komputer', 19, '2020-12-12 20:29:26', '2020-12-12 20:29:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prodi`
--

CREATE TABLE `tbl_prodi` (
  `prodi_id` int(10) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `jenjang` varchar(50) NOT NULL,
  `kode_prodi` varchar(25) NOT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_prodi`
--

INSERT INTO `tbl_prodi` (`prodi_id`, `nama`, `jenjang`, `kode_prodi`, `date_created`, `date_modified`) VALUES
(2, 'elektro', 's1reg', '01.03.04.01', '2020-12-13 19:48:49', '2020-12-13 19:48:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_timkur`
--

CREATE TABLE `tbl_timkur` (
  `timkur_id` int(11) NOT NULL,
  `nama_tim` varchar(200) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `status` varchar(25) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_timkur`
--

INSERT INTO `tbl_timkur` (`timkur_id`, `nama_tim`, `tahun`, `semester`, `status`, `date_created`, `date_modified`) VALUES
(3, 'Tim Pertama', '2020', 'Ganjil', 'Tidak Aktif', '2020-12-13 03:02:59', '2020-12-13 03:02:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_timpdca`
--

CREATE TABLE `tbl_timpdca` (
  `timpdca_id` int(11) NOT NULL,
  `nama_tim` varchar(200) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `status` varchar(25) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_timpdca`
--

INSERT INTO `tbl_timpdca` (`timpdca_id`, `nama_tim`, `tahun`, `semester`, `status`, `date_created`, `date_modified`) VALUES
(2, 'Tim PDCA Pertama Saja', '2020', 'Ganjil', 'Aktif', '2020-12-14 05:45:57', '2020-12-14 05:45:57');

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
  `prodi` varchar(25) NOT NULL,
  `login_SSO` varchar(50) NOT NULL,
  `role` varchar(10) NOT NULL,
  `non_DTE` int(11) NOT NULL,
  `pensiun` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `name`, `gelar_depan`, `gelar_belakang`, `NIP`, `username`, `email`, `password`, `no_HP`, `status`, `prodi`, `login_SSO`, `role`, `non_DTE`, `pensiun`, `date_created`, `date_modified`) VALUES
(1, 'Admin', '', '', '0123456', 'admin@ui.ac.id', 'admin@ui.ac.id', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', '0123456', 'active', 'elektro', '', '1000000', 0, 0, '2020-12-06 07:27:33', '2020-12-06 01:27:33'),
(5, 'I Gde Dharma Nugraha', '', 'S.T., M.T., Ph.D', '100120310270012891', 'i.gde', 'i.gde@ui.ac.id', '', '081558805505', 'new', 'komputer', 'yes', '0000100', 0, 0, '2020-12-06 07:21:24', '2020-12-06 01:21:24'),
(10, 'Ruki Harwahyu', 'Dr.', 'ST. MT. MSc.', '100120910231409000', 'ruki.h@ui.ac.id', 'ruki.h@ui.ac.id', '', '6289664301811', 'new', 'komputer', 'no', '0000100', 0, 0, '2020-12-13 08:05:14', '2020-12-13 02:25:34'),
(11, 'Aries Subiantoro', 'Dr. Ir.', 'M. SEE', '197003311995121000', 'aries.subiantoro@ui.ac.id', 'aries.subiantoro@ui.ac.id', '', '0', 'new', 'elektro', 'no', '0010100', 0, 0, '2020-12-13 08:06:37', '2020-12-13 11:12:23'),
(12, 'Budi Sudiarto', 'Dr.-Ing', 'ST, MT', '197907312008121000', 'budi.sudiarto@ui.ac.id', 'budi.sudiarto@ui.ac.id', '', '6287881817178', 'new', 'elektro', 'no', '0000100', 0, 0, '2020-12-13 08:06:37', '2020-12-13 02:25:47'),
(13, 'Abdul Halim', 'Dr.', 'M.Eng.', '40803012', 'a.halim@ui.ac.id', 'a.halim@ui.ac.id', '', '8128717138', 'new', 'elektro', 'no', '0010100', 0, 0, '2020-12-13 08:06:37', '2020-12-13 11:13:23'),
(14, 'Alfan Presekal', '', 'ST, MSc.', '100120910202501000', 'presekal@ui.ac.id', 'presekal@ui.ac.id', '', '0', 'new', 'komputer', 'no', '0000100', 0, 0, '2020-12-13 08:06:37', '2020-12-13 02:25:59'),
(15, 'Fransiskus Astha Ekadiyanto', '', 'S.T. M.Sc.', '197210041997021000', 'astha.ekadiyanto@ui.ac.id', 'astha.ekadiyanto@ui.ac.id', '', '82113554956', 'new', 'komputer', 'no', '0000100', 0, 0, '2020-12-13 08:06:37', '2020-12-13 02:26:05'),
(16, 'DosenA', 'Prof.', 'IPM, MM', '1234567890', 'dosena@ruki.web.id', 'dosena@ruki.web.id', '', '2147483647', 'new', 'elektro', 'no', '0000100', 0, 0, '2020-12-13 08:06:37', '2020-12-13 02:26:09'),
(17, 'Arief Udhiarto', 'Dr.Eng.', 'S.T.,M.T.,IPM.', '197904022008121000', 'arief.udhiarto@ui.ac.id', 'arief.udhiarto@ui.ac.id', '', '87783093535', 'new', 'elektro', 'no', '0000100', 0, 0, '2020-12-13 08:06:37', '2020-12-13 02:26:14'),
(18, 'Ihsan Ibrahim', '', 'S.T., M.T.', '41903002', 'ihsan.ibrahim15@ui.ac.id', 'ihsan.ibrahim15@ui.ac.id', '', '85881186694', 'new', 'komputer', 'no', '0000100', 0, 0, '2020-12-13 08:06:37', '2020-12-13 02:26:24'),
(19, 'Muhammad Salman', 'Dr. Ir.', 'ST, MIT', '196903291997031000', 'muhammad.salman@ui.ac.id', 'muhammad.salman@ui.ac.id', '', '', 'new', 'komputer', 'no', '0010100', 0, 0, '2020-12-13 08:06:37', '2020-12-13 14:29:26'),
(20, 'Kalamullah Ramli', 'Prof. Dr.-Ing.', 'M. Eng', '196807151994031000', 'kalamullah.ramli@ui.ac.id', 'kalamullah.ramli@ui.ac.id', '', '8569009843', 'new', 'komputer', 'no', '0000100', 0, 0, '2020-12-13 08:06:37', '2020-12-13 02:26:44'),
(21, 'Purnomo Sidi Priambodo', 'Ir.', 'M.Sc., Ph.D.', '407050192', 'purnomo.sidhi@ui.ac.id', 'purnomo.sidhi@ui.ac.id', '', '81381153343', 'new', 'elektro', 'no', '0000100', 0, 0, '2020-12-13 08:06:37', '2020-12-13 02:26:51'),
(22, 'Catur Apriono', 'Dr. Ir. ', 'S.T., M.T., Ph.D', '100111610250017000', 'catur.apriono@ui.ac.id', 'catur.apriono@ui.ac.id', '', '81388352190', 'new', 'elektro', 'no', '0000100', 0, 0, '2020-12-13 08:06:37', '2020-12-13 02:26:57'),
(23, 'Diyanatul Husna', '', 'S.T.,M.T', '41703002', 'diyanatulhusna@ui.ac.id', 'diyanatulhusna@ui.ac.id', '', '', 'new', 'komputer', 'no', '0000100', 0, 0, '2020-12-13 08:06:37', '2020-12-13 02:27:05'),
(24, 'Dwi Riana Aryani', '', '', '', 'dwiriana@ui.ac.id', 'dwiriana@ui.ac.id', '', '', 'new', 'elektro', 'no', '0000100', 0, 0, '2020-12-13 08:06:37', '2020-12-13 02:27:27'),
(26, 'Basari', 'Dr.', 'S.T., M.Eng.', '197911032012121000', 'basari.st@ui.ac.id', 'basari.st@ui.ac.id', '', '', 'new', 'biomedik', 'no', '0000100', 0, 0, '2020-12-13 08:06:37', '2020-12-13 02:27:45'),
(27, 'Dadang Gunawan', 'Prof Dr Ir', 'M.Eng.', '195810141985031000', 'dadang.gunawam@ui.ac.id', 'dadang.gunawam@ui.ac.id', '', '8161469754', 'new', 'elektro', 'no', '0000100', 0, 0, '2020-12-13 08:06:37', '2020-12-14 00:05:06'),
(28, 'Fitri Yuli Zulkifli', 'Prof. Dr. Ir. ', 'ST., MSc', '197407191998022000', 'fitri.yuli@ui.ac.id', 'fitri.yuli@ui.ac.id', '', '81210339810', 'new', 'elektro', 'no', '0000100', 0, 0, '2020-12-13 08:06:37', '2020-12-13 02:27:55'),
(29, 'Eko Tjipto Rahardjo', 'Prof. Dr. Ir.', 'MSc', '195804221982031000', 'eko@eng.ui.ac.id', 'eko@eng.ui.ac.id', '', '81213039072', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:37', '2020-12-13 08:06:37'),
(30, 'Ajib Setyo Arifin', '', 'Ph.D.', '198612202015041000', 'ajib.sa@ui.ac.id', 'ajib.sa@ui.ac.id', '', '81294465462', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(31, 'Faiz Husnayain', '', 'S.T., M.Sc., M.Phil.', '100120910250608000', 'faiz.h@ui.ac.id', 'faiz.h@ui.ac.id', '', '85772288660', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(32, 'Mia Rizkinia', 'Dr. Eng.', 'S.T, M.T.', '100220310231507000', 'mia@ui.ac.id', 'mia@ui.ac.id', '', '87710106337', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(33, 'Chairul Hudaya', 'Ir. ', 'ST, M.Eng, Ph.D, IPM', '40903027', 'chairul.hudaya@ui.ac.id', 'chairul.hudaya@ui.ac.id', '', '81295166665', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(34, 'Yohan Suryanto', 'Dr.', 'ST. MT.', '41603003', 'yohansuryanto@ui.ac.id', 'yohansuryanto@ui.ac.id', '', '62811893708', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(35, 'Dodi Sudiana', 'Dr. Ir.', 'M.Eng.', '196601081991031000', 'dodi.sudiana@ui.ac.id', 'dodi.sudiana@ui.ac.id', '', '81380787675', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(36, 'Tomy Abuzairi', '', '', '100140310203217000', 'tomy.abuzairi@ui.ac.id', 'tomy.abuzairi@ui.ac.id', '', '6285695856825', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(37, 'Gunawan Wibisono', 'Ir.', 'M.Sc., Ph.D', '196602221991031000', 'gunawan.wibisono@ui.ac.id', 'gunawan.wibisono@ui.ac.id', '', '85813671099', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(38, 'Amien Rahardjo', 'Ir.', 'MT.', '195706221985031000', 'amien.rahardjo@ui.ac.id', 'amien.rahardjo@ui.ac.id', '', '6281283084667', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(39, 'Prima Dewi Purnamasari', 'Dr.', 'ST MT MSc', '198407132008122000', 'prima.dp@ui.ac.id', 'prima.dp@ui.ac.id', '', '818813784', 'new', 'komputer', 'no', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 22:09:25'),
(40, 'Gamantyo Hendrantoro', 'Prof.Dr.Ir.', 'Ph.D.', '197011111993031000', 'gamantyo@ruki.web.id', 'gamantyo@ruki.web.id', '', '', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(41, 'Muhamad Asvial', 'Dr. Ir. ', 'MEng. ', '196804061994031000', 'ir.muhammad@ui.ac.id', 'ir.muhammad@ui.ac.id', '', '81382984852', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(42, 'Fauzan Hanif Jufri', '', 'S.T., M.Sc.', '41903007', 'fauzanhj@ui.ac.id', 'fauzanhj@ui.ac.id', '', '8176024234', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(43, 'I Made Ardita Y', 'Ir.', 'M.T.', '195907051986021', 'i.made61@ui.ac.id', 'i.made61@ui.ac.id', '', '6285719402625', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(44, 'Sasongko Pramonohadi', 'Dr. Ir.', '', '170720', 'sasongko.pramonohadi@ruki.web.id', 'sasongko.pramonohadi@ruki.web.id', '', '', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(45, 'Julius Ary Mollet', 'Dr.', 'SE, MBA, MTDev', '17072020', 'julius.ary@ruki.web.id', 'julius.ary@ruki.web.id', '', '', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(46, 'Feri Yusivar', '', '', '196710081994031000', 'feri.yusivar@ui.ac.id', 'feri.yusivar@ui.ac.id', '', '', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(47, 'Benyamin Kusumo Putro', 'Prof. Dr. ', 'M. Eng', '195711171987031000', 'kusumo@ui.ac.id', 'kusumo@ui.ac.id', '', '87887551798', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(48, 'Rudy Setiabudy', 'Prof. Dr. Ir.', 'DEA', '195410071984031000', 'rudy.setiabudy@ui.ac.id', 'rudy.setiabudy@ui.ac.id', '', '', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(49, 'Taufiq Alif Kurniawan', '', 'MSc.Eng', '100120310242807000', 'taufiq.alif@ui.ac.id', 'taufiq.alif@ui.ac.id', '', '6281292912330', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(50, 'Abdul Muis', 'Dr.', 'ST. MEng.', '197509011999031000', 'muis@ui.ac.id', 'muis@ui.ac.id', '', '811978601', 'new', 'elektro', 'no', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 05:12:53'),
(51, 'Iwa Garniwa M. K.', 'Prof. Dr. Ir.', 'MT.', '196105071989031000', 'ir.iwa@ui.ac.id', 'ir.iwa@ui.ac.id', '', '8561139686', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(52, 'Siti Fauziyah Rahman', '', '', '100220910271708000', 'fauziyah17@ui.ac.id', 'fauziyah17@ui.ac.id', '', '81287867170', 'new', 'biomedik', 'no', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 02:28:40'),
(53, 'Retno Wigajatri Purnamaningsih', 'Dr.Ir.', 'MT', '196203231987032000', 'retno.wigajatri@ui.ac.id', 'retno.wigajatri@ui.ac.id', '', '8121020060', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(54, 'Anak Agung Putri Ratna', 'Dr. Ir. ', 'M.Eng', '196104241989032000', 'anak.agung@ui.ac.id', 'anak.agung@ui.ac.id', '', '81299159315', 'new', 'elektro', 'no', '0100100', 0, 0, '2020-12-13 08:06:38', '2020-12-14 01:50:36'),
(55, 'Muhammad Suryanegara', '', '', '198105142012121000', 'suryanegara@gmail.com', 'suryanegara@gmail.com', '', '8129518440', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(56, 'Uno Bintang Sudibyo', 'Dr. Ir.', 'DEA, IPM', '41203020', 'uno@ruki.web.id', 'uno@ruki.web.id', '', '', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(57, 'Soetjipto Soewono', 'Dr. Ir.', 'DEA', '42', 'soetjipto@itpln.ac.id', 'soetjipto@itpln.ac.id', '', '', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(58, 'Bambang Widiyatmoko', 'Dr.', 'M.Eng.', '196204301988031000', 'widiyatmokobambang@gmail.com', 'widiyatmokobambang@gmail.com', '', '', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(59, 'Yan Maraden', '', '', '100140310211100000', 'maradens@ui.ac.id', 'maradens@ui.ac.id', '', '', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(60, 'Riri Fitri Sari', 'Prof. Dr. Ir.', 'MM. MSc.', '197007071995012000', 'riri@ui.ac.id', 'riri@ui.ac.id', '', '81310817166', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(61, 'Nji Raden Poespawati', 'DR. Ir.', 'MT', '196101241986022000', 'pupu@eng.ui.ac.id', 'pupu@eng.ui.ac.id', '', '811133697', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(62, 'Wahidin Wahab', 'Ir.', 'M.Sc., Ph.D.', '195311251979021000', 'wahidin.wahab@ui.ac.id', 'wahidin.wahab@ui.ac.id', '', '811977779', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(63, 'Saleh Abdurrahman', 'Dr. Ir.', 'MSc.', '196209241990031000', 'saleh@esdm.go.id', 'saleh@esdm.go.id', '', '', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:38', '2020-12-13 08:06:38'),
(64, 'Tri Arief Sardjono', 'Dr.', 'ST. MT.', 'TriAriefSardjono', 'triarief@ruki.web.id', 'triarief@ruki.web.id', '', '', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:39', '2020-12-13 08:06:39'),
(65, 'Azizah Intan Pangesty', '', 'S.Si., M.Eng., D.Eng.', '41903019', 'azizah.ip@ui.ac.id', 'azizah.ip@ui.ac.id', '', '82120429675', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:39', '2020-12-13 08:06:39'),
(66, 'Eko Adhi Setiawan', 'Dr.-Ing', '', '40803032', 'eko.adhi@ui.ac.id', 'eko.adhi@ui.ac.id', '', '87889974848', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:39', '2020-12-13 08:06:39'),
(67, 'Sugeng Supriadi', 'Dr.', 'S.T., M.S.Eng.', '198207282008121000', 'sugeng.s@ruki.web.id', 'sugeng.s@ruki.web.id', '', '', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:39', '2020-12-13 08:06:39'),
(68, 'Agus Santoso Tamsir', 'Dr. Ir.', 'M.T.', '195908011989031000', 'tamsir@ruki.web.id', 'tamsir@ruki.web.id', '', '', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:39', '2020-12-13 08:06:39'),
(69, 'Yanuarsyah Haroen', 'Prof. Dr. Ir.', '', '195201011978021000', 'yanuar@stei.itb.ac.id', 'yanuar@stei.itb.ac.id', '', '', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:39', '2020-12-13 08:06:39'),
(70, 'Ridwan Gunawan', 'Dr. Ir.', 'M.T.', '41603017', 'ridwan.gunawan@ruki.web.id', 'ridwan.gunawan@ruki.web.id', '', '', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:39', '2020-12-13 08:06:39'),
(71, 'Rinaldy Dalimi', 'Prof. Ir.', 'M.Sc. Ph.D.', '195604241985031000', 'rinaldy@ruki.web.id', 'rinaldy@ruki.web.id', '', '', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:39', '2020-12-13 08:06:39'),
(72, 'Agus R. Utomo', 'Ir.', 'M.T.', '195808201986021000', 'arutomo@yahoo.com', 'arutomo@yahoo.com', '', '81295955059', 'new', 'elektro', 'no', '0000100', 0, 0, '2020-12-13 08:06:39', '2020-12-13 05:13:03'),
(73, 'Harry Sudibyo S.', 'Prof.Dr.Ir', 'DEA', '195212311980111000', 'hari.sudibyo@ui.ac.id', 'hari.sudibyo@ui.ac.id', '', '82351512161', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:39', '2020-12-13 08:06:39'),
(74, 'Daniel Moraru', 'Dr.', '', '6082020', 'moraru.daniel@shizuoka.ac.jp', 'moraru.daniel@shizuoka.ac.jp', '', '', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:39', '2020-12-13 08:06:39'),
(75, 'Ratno Nuryadi', 'Prof. Dr.', 'M.Eng', '40903052', 'ratno.nuryadi@bppt.go.id', 'ratno.nuryadi@bppt.go.id', '', '', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:39', '2020-12-13 08:06:39'),
(76, 'Bagio Budiardjo', 'Prof. Dr. Ir.', 'M.Sc.', '41103036', 'bagio.budiardjo@ui.ac.id', 'bagio.budiardjo@ui.ac.id', '', '', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:39', '2020-12-13 08:06:39'),
(77, 'Yusuf Nur Wijayanto', 'Dr.', '', '198004102005021000', 'yusuf.nur.wijayanto@lipi.go.id', 'yusuf.nur.wijayanto@lipi.go.id', '', '', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:39', '2020-12-13 08:06:39'),
(78, 'Djoko Hartanto', 'Prof. Dr. Ir.', 'M.Sc.', '41103035', 'Djoko.hartanto@ui.ac.id', 'Djoko.hartanto@ui.ac.id', '', '8170799100', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:39', '2020-12-13 08:06:39'),
(79, 'Andi Adriansyah', 'Prof. Dr. Ir.', 'M.Eng.', '194700122', 'andi.ardiansyah@m.c', 'andi.ardiansyah@m.c', '', '', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:39', '2020-12-13 08:06:39'),
(80, 'Suhaidi Hassan', 'Prof.', '', 'UUM', 'suhaidi@uum.edu.my', 'suhaidi@uum.edu.my', '', '', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:39', '2020-12-13 08:06:39'),
(81, 'Teddy Surya Gunawan', 'Prof. Dr.', '', '20003', 'teddy.surya@m.c', 'teddy.surya@m.c', '', '', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:39', '2020-12-13 08:06:39'),
(82, 'Brown Chocro', '', '', 'Brown', 'brown@ruki.web.id', 'brown@ruki.web.id', '', '', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:39', '2020-12-13 08:06:39'),
(83, 'Aji Nur Widyanto', '', '', '', 'aji.nurwidianto@ui.ac.id', 'aji.nurwidianto@ui.ac.id', '', '', 'new', '', '', '0000100', 0, 0, '2020-12-13 08:06:40', '2020-12-13 08:06:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_anggotatimkur`
--
ALTER TABLE `tbl_anggotatimkur`
  ADD PRIMARY KEY (`anggota_id`);

--
-- Indexes for table `tbl_anggotatimpdca`
--
ALTER TABLE `tbl_anggotatimpdca`
  ADD PRIMARY KEY (`anggota_id`);

--
-- Indexes for table `tbl_man`
--
ALTER TABLE `tbl_man`
  ADD PRIMARY KEY (`man_id`);

--
-- Indexes for table `tbl_prodi`
--
ALTER TABLE `tbl_prodi`
  ADD PRIMARY KEY (`prodi_id`);

--
-- Indexes for table `tbl_timkur`
--
ALTER TABLE `tbl_timkur`
  ADD PRIMARY KEY (`timkur_id`);

--
-- Indexes for table `tbl_timpdca`
--
ALTER TABLE `tbl_timpdca`
  ADD PRIMARY KEY (`timpdca_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_anggotatimkur`
--
ALTER TABLE `tbl_anggotatimkur`
  MODIFY `anggota_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_anggotatimpdca`
--
ALTER TABLE `tbl_anggotatimpdca`
  MODIFY `anggota_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_man`
--
ALTER TABLE `tbl_man`
  MODIFY `man_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_prodi`
--
ALTER TABLE `tbl_prodi`
  MODIFY `prodi_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_timkur`
--
ALTER TABLE `tbl_timkur`
  MODIFY `timkur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_timpdca`
--
ALTER TABLE `tbl_timpdca`
  MODIFY `timpdca_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

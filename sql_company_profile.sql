-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 26, 2020 at 05:26 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `company_profile`
--

-- --------------------------------------------------------

--
-- Table structure for table `d_dokumen`
--

CREATE TABLE `d_dokumen` (
  `dokumen_id` int(11) NOT NULL,
  `judul` varchar(256) NOT NULL,
  `isi` text NOT NULL,
  `dokumen` varchar(256) NOT NULL,
  `login_id` int(11) NOT NULL,
  `tgl_isi` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `d_event`
--

CREATE TABLE `d_event` (
  `event_id` int(11) NOT NULL,
  `judul` varchar(258) NOT NULL,
  `isi` text NOT NULL,
  `tgl_isi` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `login_id` int(11) NOT NULL,
  `tgl_mulai` timestamp NULL DEFAULT NULL,
  `tgl_selesai` timestamp NULL DEFAULT NULL,
  `foto` varchar(256) NOT NULL,
  `dokumen` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `d_galeri`
--

CREATE TABLE `d_galeri` (
  `galeri_id` int(11) NOT NULL,
  `judul` varchar(256) NOT NULL,
  `isi` text NOT NULL,
  `foto` varchar(256) NOT NULL,
  `login_id` int(11) NOT NULL,
  `kategori_galeri_id` int(11) NOT NULL,
  `tgl_isi` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `d_kategori_galeri`
--

CREATE TABLE `d_kategori_galeri` (
  `kategori_galeri_id` int(11) NOT NULL,
  `judul` varchar(256) NOT NULL,
  `isi` text NOT NULL,
  `login_id` int(11) NOT NULL,
  `tgl_isi` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `d_login`
--

CREATE TABLE `d_login` (
  `login_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(256) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `tgl_login` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_login`
--

INSERT INTO `d_login` (`login_id`, `username`, `password`, `nama`, `tgl_login`) VALUES
(1, 'rumahrafif', 'dea0b92c7ae44513482d96b356b031cc', 'Rumah Rafif', '2020-10-26 17:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `d_tulisan`
--

CREATE TABLE `d_tulisan` (
  `tulisan_id` int(11) NOT NULL,
  `judul` varchar(256) NOT NULL,
  `isi` text NOT NULL,
  `tgl_isi` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `login_id` int(11) NOT NULL,
  `jenis_tulisan` enum('berita','liputan','kolom') NOT NULL DEFAULT 'berita',
  `foto` varchar(256) NOT NULL,
  `dokumen` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_tulisan`
--

INSERT INTO `d_tulisan` (`tulisan_id`, `judul`, `isi`, `tgl_isi`, `tgl_update`, `login_id`, `jenis_tulisan`, `foto`, `dokumen`) VALUES
(1, 'Ini Adalah Tulisan Pertama', 'Ini Adalah Tulisan Pertama', '2020-10-26 17:01:37', '2020-10-26 17:01:37', 1, 'berita', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `d_dokumen`
--
ALTER TABLE `d_dokumen`
  ADD PRIMARY KEY (`dokumen_id`),
  ADD KEY `login_id` (`login_id`);

--
-- Indexes for table `d_event`
--
ALTER TABLE `d_event`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `login_id` (`login_id`);

--
-- Indexes for table `d_galeri`
--
ALTER TABLE `d_galeri`
  ADD PRIMARY KEY (`galeri_id`),
  ADD KEY `login_id` (`login_id`),
  ADD KEY `kategori_galeri_id` (`kategori_galeri_id`);

--
-- Indexes for table `d_kategori_galeri`
--
ALTER TABLE `d_kategori_galeri`
  ADD PRIMARY KEY (`kategori_galeri_id`),
  ADD KEY `login_id` (`login_id`);

--
-- Indexes for table `d_login`
--
ALTER TABLE `d_login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `d_tulisan`
--
ALTER TABLE `d_tulisan`
  ADD PRIMARY KEY (`tulisan_id`),
  ADD KEY `login_id` (`login_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `d_dokumen`
--
ALTER TABLE `d_dokumen`
  MODIFY `dokumen_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `d_event`
--
ALTER TABLE `d_event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `d_galeri`
--
ALTER TABLE `d_galeri`
  MODIFY `galeri_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `d_kategori_galeri`
--
ALTER TABLE `d_kategori_galeri`
  MODIFY `kategori_galeri_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `d_login`
--
ALTER TABLE `d_login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `d_tulisan`
--
ALTER TABLE `d_tulisan`
  MODIFY `tulisan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `d_dokumen`
--
ALTER TABLE `d_dokumen`
  ADD CONSTRAINT `d_dokumen_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `d_login` (`login_id`);

--
-- Constraints for table `d_event`
--
ALTER TABLE `d_event`
  ADD CONSTRAINT `d_event_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `d_login` (`login_id`);

--
-- Constraints for table `d_galeri`
--
ALTER TABLE `d_galeri`
  ADD CONSTRAINT `d_galeri_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `d_login` (`login_id`),
  ADD CONSTRAINT `d_galeri_ibfk_2` FOREIGN KEY (`kategori_galeri_id`) REFERENCES `d_kategori_galeri` (`kategori_galeri_id`);

--
-- Constraints for table `d_kategori_galeri`
--
ALTER TABLE `d_kategori_galeri`
  ADD CONSTRAINT `d_kategori_galeri_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `d_login` (`login_id`);

--
-- Constraints for table `d_tulisan`
--
ALTER TABLE `d_tulisan`
  ADD CONSTRAINT `d_tulisan_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `d_login` (`login_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

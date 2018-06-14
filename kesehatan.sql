-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2018 at 06:49 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kesehatan`
--
CREATE DATABASE IF NOT EXISTS `kesehatan` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `kesehatan`;

-- --------------------------------------------------------

--
-- Table structure for table `abdomen`
--

CREATE TABLE `abdomen` (
  `kd_abdomen` int(11) NOT NULL,
  `nyeri_tekan` varchar(15) NOT NULL,
  `hpmgl` varchar(15) NOT NULL,
  `spmgl` varchar(15) NOT NULL,
  `ket_tambahan` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `assesment`
--

CREATE TABLE `assesment` (
  `kd_assesment` varchar(20) NOT NULL,
  `primary` varchar(50) NOT NULL,
  `secondary` varchar(50) NOT NULL,
  `lain_lain` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ekstermitas`
--

CREATE TABLE `ekstermitas` (
  `kd_ekstermitas` int(11) NOT NULL,
  `ah` varchar(25) NOT NULL,
  `crt` varchar(25) NOT NULL,
  `edm` varchar(25) NOT NULL,
  `pitting` varchar(15) NOT NULL,
  `ket_tambahan` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `headtotoe`
--

CREATE TABLE `headtotoe` (
  `kd_headtotoe` int(11) NOT NULL,
  `kd_kepala` int(11) NOT NULL,
  `kd_thorak` int(11) NOT NULL,
  `kd_abdomen` int(11) NOT NULL,
  `kd_ekstermitas` int(11) NOT NULL,
  `lain_lain` varchar(600) NOT NULL,
  `diagnosa` varchar(600) NOT NULL,
  `kd_terapi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kelurahan`
--

CREATE TABLE `kelurahan` (
  `kd_kelurahan` int(11) NOT NULL,
  `nm_keluarahan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kepala`
--

CREATE TABLE `kepala` (
  `kd_kepala` varchar(30) NOT NULL,
  `anemis_kiri` varchar(30) NOT NULL,
  `anemis_kanan` varchar(30) NOT NULL,
  `ikterik_kiri` varchar(30) NOT NULL,
  `ikterik_kanan` varchar(30) NOT NULL,
  `cianosis_kiri` varchar(30) NOT NULL,
  `cianosis_kanan` varchar(30) NOT NULL,
  `deformitas_kiri` varchar(30) NOT NULL,
  `deformitas_kanan` varchar(30) NOT NULL,
  `refchy_kiri` varchar(30) NOT NULL,
  `refchy_kanan` varchar(30) NOT NULL,
  `refchyopsi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `objek`
--

CREATE TABLE `objek` (
  `kd_objek` int(11) NOT NULL,
  `tb` int(11) NOT NULL,
  `bb` int(11) NOT NULL,
  `td1` int(11) NOT NULL,
  `td2` int(11) NOT NULL,
  `N` int(11) NOT NULL,
  `RR` int(11) NOT NULL,
  `TAx` int(11) NOT NULL,
  `kd_headtotoe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `kd_pasien` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nik` int(16) NOT NULL,
  `tmp_lahir` int(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `usia` int(11) NOT NULL,
  `alamat` varchar(350) NOT NULL,
  `jkelamin` enum('L','P') NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `kd_kelurahan` int(11) NOT NULL,
  `pembayaran` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rkm_medis`
--

CREATE TABLE `rkm_medis` (
  `kd_rkm` int(20) NOT NULL,
  `kd_pasien` int(11) NOT NULL,
  `tgl_jam` datetime NOT NULL,
  `subjek` varchar(600) NOT NULL,
  `kd_objek` int(11) NOT NULL,
  `kd_assesment` int(11) NOT NULL,
  `planning` varchar(600) NOT NULL,
  `kd_dokter` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `terapi`
--

CREATE TABLE `terapi` (
  `kd_terapi` int(11) NOT NULL,
  `terapi` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `thorak`
--

CREATE TABLE `thorak` (
  `kd_thorak` int(11) NOT NULL,
  `metris` varchar(15) NOT NULL,
  `wg_kiri` varchar(15) NOT NULL,
  `wg_kanan` varchar(15) NOT NULL,
  `rk_kiri` varchar(15) NOT NULL,
  `rk_kanan` varchar(15) NOT NULL,
  `vk_kiri` varchar(15) NOT NULL,
  `vk_kanan` varchar(15) NOT NULL,
  `jtgic` varchar(15) NOT NULL,
  `s1_s2` varchar(15) NOT NULL,
  `s_tambahan` varchar(500) NOT NULL,
  `ket_tambahan` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abdomen`
--
ALTER TABLE `abdomen`
  ADD PRIMARY KEY (`kd_abdomen`);

--
-- Indexes for table `assesment`
--
ALTER TABLE `assesment`
  ADD PRIMARY KEY (`kd_assesment`);

--
-- Indexes for table `ekstermitas`
--
ALTER TABLE `ekstermitas`
  ADD PRIMARY KEY (`kd_ekstermitas`);

--
-- Indexes for table `headtotoe`
--
ALTER TABLE `headtotoe`
  ADD PRIMARY KEY (`kd_headtotoe`);

--
-- Indexes for table `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD PRIMARY KEY (`kd_kelurahan`);

--
-- Indexes for table `kepala`
--
ALTER TABLE `kepala`
  ADD PRIMARY KEY (`kd_kepala`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`kd_pasien`);

--
-- Indexes for table `rkm_medis`
--
ALTER TABLE `rkm_medis`
  ADD PRIMARY KEY (`kd_rkm`);

--
-- Indexes for table `terapi`
--
ALTER TABLE `terapi`
  ADD PRIMARY KEY (`kd_terapi`);

--
-- Indexes for table `thorak`
--
ALTER TABLE `thorak`
  ADD PRIMARY KEY (`kd_thorak`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `kd_pasien` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

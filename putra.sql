-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2018 at 04:47 PM
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
-- Table structure for table `antrian`
--

CREATE TABLE `antrian` (
  `nomor_antrian` int(11) NOT NULL,
  `nomor_pasien` varchar(255) DEFAULT NULL,
  `jam_datang` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `antrian`
--

INSERT INTO `antrian` (`nomor_antrian`, `nomor_pasien`, `jam_datang`) VALUES
(5, '001-006-01-02-07-2018', '2018-08-01 23:08:20');

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
  `chianosis_kanan` varchar(30) NOT NULL,
  `deformitas_kiri` varchar(30) NOT NULL,
  `deformitas_kanan` varchar(30) NOT NULL,
  `refchy` varchar(30) NOT NULL,
  `refchyopsi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log_kunjungan`
--

CREATE TABLE `log_kunjungan` (
  `id_pengunjung` varchar(255) DEFAULT NULL,
  `kd_pasien` varchar(255) DEFAULT NULL,
  `nama_pasien` varchar(255) DEFAULT NULL,
  `tanggal` varchar(255) DEFAULT NULL
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
  `nama` varchar(50) DEFAULT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `tmp_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `usia` varchar(11) DEFAULT NULL,
  `alamat` varchar(350) DEFAULT NULL,
  `jkelamin` varchar(10) DEFAULT NULL,
  `pekerjaan` varchar(50) DEFAULT NULL,
  `kelurahan` varchar(255) DEFAULT NULL,
  `pembayaran` varchar(30) DEFAULT NULL,
  `nomor_pasien` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`kd_pasien`, `nama`, `nik`, `tmp_lahir`, `tgl_lahir`, `usia`, `alamat`, `jkelamin`, `pekerjaan`, `kelurahan`, `pembayaran`, `nomor_pasien`) VALUES
(1, 'ridho pratama', '1233', 'malang', '1997-02-19', '21', 'Jalan gajayana  RT01 RW01 Kelurahan Kota Lama Kecamatan Kedungkandang Kota Malang', 'Laki-laki', 'Programmer', 'Kota Lama', 'umum', '001-006-01-02-07-2018');

-- --------------------------------------------------------

--
-- Table structure for table `proses_antrian`
--

CREATE TABLE `proses_antrian` (
  `nomor_pasien` varchar(255) DEFAULT NULL,
  `nomor_antrian` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proses_antrian`
--

INSERT INTO `proses_antrian` (`nomor_pasien`, `nomor_antrian`) VALUES
('001-006-01-02-07-2018', '1'),
('001-006-01-02-07-2018', '2'),
('001-006-01-02-07-2018', '3'),
('001-006-01-02-07-2018', '4');

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
-- Table structure for table `settingan`
--

CREATE TABLE `settingan` (
  `id` int(11) NOT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settingan`
--

INSERT INTO `settingan` (`id`, `value`) VALUES
(1, '2018-07-29 09:35:58');

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
  `wheezing` varchar(15) NOT NULL,
  `ronkhi` varchar(15) NOT NULL,
  `vesikuler` varchar(15) NOT NULL,
  `jantung_icor` varchar(15) NOT NULL,
  `s1_s2` varchar(15) NOT NULL,
  `s_tambahan` varchar(500) NOT NULL,
  `ket_tambahan` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `hak_akses` varchar(255) DEFAULT NULL,
  `sip` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `verified` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `hak_akses`, `sip`, `jenis_kelamin`, `alamat`, `nik`, `foto`, `verified`, `nama`) VALUES
(1, 'admin', 'd12254da81c0b155767984b3c0e721129b320e95fab8d1edb34a494964a115a2', '1', '1231231231231231231231231231233123', 'Laki - Laki ', 'jalan mawar 45 malang', '1231231231231231', 'assets/images/users_photo/juragan.jpg', 'sudah', 'dr. Muchamad Zubaid'),
(8, 'dokter', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '2', '123123123123123123123123123123312', 'Laki - Laki ', 'Gajayana', '1405356066621233', 'assets/images/users_photo/recomfarmhouse_ascher-41.jpg', 'sudah', 'dr. dokter'),
(9, 'petugas', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '3', NULL, 'Laki - Laki ', 'Gajayana', '1405356066621234', 'assets/images/users_photo/recomfarmhouse_ascher-41.jpg', 'sudah', 'petugas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abdomen`
--
ALTER TABLE `abdomen`
  ADD PRIMARY KEY (`kd_abdomen`);

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`nomor_antrian`);

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
-- Indexes for table `settingan`
--
ALTER TABLE `settingan`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`) USING BTREE,
  ADD UNIQUE KEY `sip` (`sip`) USING BTREE,
  ADD UNIQUE KEY `nik` (`nik`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
  MODIFY `nomor_antrian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `kd_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settingan`
--
ALTER TABLE `settingan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

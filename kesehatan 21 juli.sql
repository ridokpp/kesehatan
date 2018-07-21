/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : kesehatan

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-07-21 17:35:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for abdomen
-- ----------------------------
DROP TABLE IF EXISTS `abdomen`;
CREATE TABLE `abdomen` (
  `kd_abdomen` int(11) NOT NULL,
  `nyeri_tekan` varchar(15) NOT NULL,
  `hpmgl` varchar(15) NOT NULL,
  `spmgl` varchar(15) NOT NULL,
  `ket_tambahan` varchar(500) NOT NULL,
  PRIMARY KEY (`kd_abdomen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of abdomen
-- ----------------------------

-- ----------------------------
-- Table structure for antrian
-- ----------------------------
DROP TABLE IF EXISTS `antrian`;
CREATE TABLE `antrian` (
  `kd_pasien` varchar(255) DEFAULT NULL,
  `jam_datang` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of antrian
-- ----------------------------

-- ----------------------------
-- Table structure for assesment
-- ----------------------------
DROP TABLE IF EXISTS `assesment`;
CREATE TABLE `assesment` (
  `kd_assesment` varchar(20) NOT NULL,
  `primary` varchar(50) NOT NULL,
  `secondary` varchar(50) NOT NULL,
  `lain_lain` varchar(50) NOT NULL,
  PRIMARY KEY (`kd_assesment`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of assesment
-- ----------------------------

-- ----------------------------
-- Table structure for ekstermitas
-- ----------------------------
DROP TABLE IF EXISTS `ekstermitas`;
CREATE TABLE `ekstermitas` (
  `kd_ekstermitas` int(11) NOT NULL,
  `ah` varchar(25) NOT NULL,
  `crt` varchar(25) NOT NULL,
  `edm` varchar(25) NOT NULL,
  `pitting` varchar(15) NOT NULL,
  `ket_tambahan` varchar(500) NOT NULL,
  PRIMARY KEY (`kd_ekstermitas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ekstermitas
-- ----------------------------

-- ----------------------------
-- Table structure for headtotoe
-- ----------------------------
DROP TABLE IF EXISTS `headtotoe`;
CREATE TABLE `headtotoe` (
  `kd_headtotoe` int(11) NOT NULL,
  `kd_kepala` int(11) NOT NULL,
  `kd_thorak` int(11) NOT NULL,
  `kd_abdomen` int(11) NOT NULL,
  `kd_ekstermitas` int(11) NOT NULL,
  `lain_lain` varchar(600) NOT NULL,
  `diagnosa` varchar(600) NOT NULL,
  `kd_terapi` int(11) NOT NULL,
  PRIMARY KEY (`kd_headtotoe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of headtotoe
-- ----------------------------

-- ----------------------------
-- Table structure for kelurahan
-- ----------------------------
DROP TABLE IF EXISTS `kelurahan`;
CREATE TABLE `kelurahan` (
  `kd_kelurahan` int(11) NOT NULL,
  `nm_keluarahan` varchar(50) NOT NULL,
  PRIMARY KEY (`kd_kelurahan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kelurahan
-- ----------------------------

-- ----------------------------
-- Table structure for kepala
-- ----------------------------
DROP TABLE IF EXISTS `kepala`;
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
  `refchyopsi` varchar(30) NOT NULL,
  PRIMARY KEY (`kd_kepala`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kepala
-- ----------------------------

-- ----------------------------
-- Table structure for log_kunjungan
-- ----------------------------
DROP TABLE IF EXISTS `log_kunjungan`;
CREATE TABLE `log_kunjungan` (
  `id_pengunjung` varchar(255) DEFAULT NULL,
  `kd_pasien` varchar(255) DEFAULT NULL,
  `nama_pasien` varchar(255) DEFAULT NULL,
  `tanggal` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of log_kunjungan
-- ----------------------------

-- ----------------------------
-- Table structure for objek
-- ----------------------------
DROP TABLE IF EXISTS `objek`;
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

-- ----------------------------
-- Records of objek
-- ----------------------------

-- ----------------------------
-- Table structure for pasien
-- ----------------------------
DROP TABLE IF EXISTS `pasien`;
CREATE TABLE `pasien` (
  `kd_pasien` int(11) NOT NULL AUTO_INCREMENT,
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
  `nomor_pasien` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kd_pasien`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pasien
-- ----------------------------
INSERT INTO `pasien` VALUES ('1', 'ridho pratama', '1233', 'malang', '1997-02-19', '21', 'Jalan gajayana  RT01 RW01 Kelurahan Kota Lama Kecamatan Kedungkandang Kota Malang', 'Laki-laki', 'Programmer', 'Kota Lama', 'umum', '001-006-01-02-07-2018');

-- ----------------------------
-- Table structure for rkm_medis
-- ----------------------------
DROP TABLE IF EXISTS `rkm_medis`;
CREATE TABLE `rkm_medis` (
  `kd_rkm` int(20) NOT NULL,
  `kd_pasien` int(11) NOT NULL,
  `tgl_jam` datetime NOT NULL,
  `subjek` varchar(600) NOT NULL,
  `kd_objek` int(11) NOT NULL,
  `kd_assesment` int(11) NOT NULL,
  `planning` varchar(600) NOT NULL,
  `kd_dokter` varchar(50) NOT NULL,
  PRIMARY KEY (`kd_rkm`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rkm_medis
-- ----------------------------

-- ----------------------------
-- Table structure for terapi
-- ----------------------------
DROP TABLE IF EXISTS `terapi`;
CREATE TABLE `terapi` (
  `kd_terapi` int(11) NOT NULL,
  `terapi` varchar(250) NOT NULL,
  PRIMARY KEY (`kd_terapi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of terapi
-- ----------------------------

-- ----------------------------
-- Table structure for thorak
-- ----------------------------
DROP TABLE IF EXISTS `thorak`;
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
  `ket_tambahan` varchar(500) NOT NULL,
  PRIMARY KEY (`kd_thorak`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of thorak
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `hak_akses` varchar(255) DEFAULT NULL,
  `sip` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `verified` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`) USING BTREE,
  UNIQUE KEY `sip` (`sip`) USING BTREE,
  UNIQUE KEY `nik` (`nik`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'd12254da81c0b155767984b3c0e721129b320e95fab8d1edb34a494964a115a2', '1', '1231231231231231231231231231233123', 'Laki - Laki ', 'jalan mawar 45 malang', '1231231231231231', 'assets/images/users_photo/juragan.jpg', 'sudah', 'dr. Muchamad Zubaid');
INSERT INTO `user` VALUES ('8', 'dokter', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '2', '123123123123123123123123123123312', 'Laki - Laki ', 'Gajayana', '1405356066621233', 'assets/images/users_photo/recomfarmhouse_ascher-41.jpg', 'sudah', 'dr. dokter');
INSERT INTO `user` VALUES ('9', 'patugas', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '3', null, 'Laki - Laki ', 'Gajayana', '1405356066621234', 'assets/images/users_photo/recomfarmhouse_ascher-41.jpg', 'sudah', 'petugas');

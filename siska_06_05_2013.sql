/*
Navicat MySQL Data Transfer

Source Server         : lokal
Source Server Version : 50530
Source Host           : localhost:3306
Source Database       : siska

Target Server Type    : MYSQL
Target Server Version : 50530
File Encoding         : 65001

Date: 2013-05-06 13:49:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `bukutamu`
-- ----------------------------
DROP TABLE IF EXISTS `bukutamu`;
CREATE TABLE `bukutamu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tgl_posting` datetime DEFAULT '0000-00-00 00:00:00',
  `nama` varchar(255) DEFAULT '',
  `email` varchar(255) DEFAULT '',
  `subject` varchar(255) DEFAULT '',
  `message` text,
  `is_read` tinyint(1) DEFAULT '0',
  `is_reply` tinyint(1) DEFAULT '0',
  `tgl_reply` datetime DEFAULT NULL,
  `reply_message` text,
  `karyawan_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `karyawan_id` (`karyawan_id`),
  CONSTRAINT `bukutamu_ibfk_1` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of bukutamu
-- ----------------------------

-- ----------------------------
-- Table structure for `calon_mahasiswa`
-- ----------------------------
DROP TABLE IF EXISTS `calon_mahasiswa`;
CREATE TABLE `calon_mahasiswa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT '',
  `tempat_lahir` varchar(255) DEFAULT '',
  `tgl_lahir` date DEFAULT '0000-00-00',
  `email` varchar(255) DEFAULT '',
  `propinsi` varchar(255) DEFAULT '',
  `kota_kab` varchar(255) DEFAULT '',
  `kodepos` char(255) DEFAULT '',
  `alamat` text,
  `telp` char(255) DEFAULT '',
  `jenjang_pendidikan` varchar(255) DEFAULT '',
  `fakultas_kode` char(5) NOT NULL DEFAULT '0',
  `programstudi_kode` char(5) NOT NULL DEFAULT '0',
  `jenis_kelamin` enum('L','P') NOT NULL,
  `pilih_jenis_pendaftaran_id` int(10) unsigned NOT NULL DEFAULT '0',
  `status_pmb_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fakultas_kode` (`fakultas_kode`),
  KEY `programstudi_kode` (`programstudi_kode`),
  KEY `jenis_kelamin_id` (`jenis_kelamin`),
  KEY `pilih_jenis_pendaftaran_id` (`pilih_jenis_pendaftaran_id`),
  KEY `status_pmb_id` (`status_pmb_id`),
  CONSTRAINT `calon_mahasiswa_ibfk_2` FOREIGN KEY (`fakultas_kode`) REFERENCES `fakultas` (`kode`),
  CONSTRAINT `calon_mahasiswa_ibfk_3` FOREIGN KEY (`programstudi_kode`) REFERENCES `programstudi` (`kode`),
  CONSTRAINT `calon_mahasiswa_ibfk_4` FOREIGN KEY (`pilih_jenis_pendaftaran_id`) REFERENCES `pilih_jenis_pendaftaran` (`id`),
  CONSTRAINT `calon_mahasiswa_ibfk_5` FOREIGN KEY (`status_pmb_id`) REFERENCES `status_pmb` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of calon_mahasiswa
-- ----------------------------

-- ----------------------------
-- Table structure for `dosen`
-- ----------------------------
DROP TABLE IF EXISTS `dosen`;
CREATE TABLE `dosen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `karyawan_id` int(10) unsigned NOT NULL,
  `fakultas_kode` char(5) NOT NULL DEFAULT '',
  `programstudi_kode` char(5) NOT NULL DEFAULT '',
  `nama` varchar(255) DEFAULT '',
  `nip` char(255) DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nip` (`nip`),
  KEY `karyawan_id` (`karyawan_id`),
  KEY `fakultas_kode` (`fakultas_kode`),
  KEY `programstudi_kode` (`programstudi_kode`),
  CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`programstudi_kode`) REFERENCES `programstudi` (`kode`),
  CONSTRAINT `dosen_ibfk_2` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`),
  CONSTRAINT `dosen_ibfk_3` FOREIGN KEY (`fakultas_kode`) REFERENCES `fakultas` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of dosen
-- ----------------------------

-- ----------------------------
-- Table structure for `fakultas`
-- ----------------------------
DROP TABLE IF EXISTS `fakultas`;
CREATE TABLE `fakultas` (
  `kode` char(5) NOT NULL DEFAULT '',
  `nama` varchar(255) DEFAULT '',
  PRIMARY KEY (`kode`),
  KEY `id` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fakultas
-- ----------------------------

-- ----------------------------
-- Table structure for `grade`
-- ----------------------------
DROP TABLE IF EXISTS `grade`;
CREATE TABLE `grade` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL DEFAULT '',
  `bobot` int(10) NOT NULL DEFAULT '0',
  `range_awal` decimal(18,2) NOT NULL DEFAULT '0.00',
  `range_akhir` decimal(18,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of grade
-- ----------------------------

-- ----------------------------
-- Table structure for `jadwal_krs`
-- ----------------------------
DROP TABLE IF EXISTS `jadwal_krs`;
CREATE TABLE `jadwal_krs` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `matkul_dosen_id` int(10) unsigned NOT NULL DEFAULT '0',
  `penjadwalan_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `matkul_dosen_id` (`matkul_dosen_id`),
  KEY `penjadwalan_id` (`penjadwalan_id`),
  CONSTRAINT `jadwal_krs_ibfk_1` FOREIGN KEY (`penjadwalan_id`) REFERENCES `penjadwalan` (`id`),
  CONSTRAINT `jadwal_krs_ibfk_2` FOREIGN KEY (`matkul_dosen_id`) REFERENCES `matkul_dosen` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jadwal_krs
-- ----------------------------

-- ----------------------------
-- Table structure for `jadwal_mahasiswa`
-- ----------------------------
DROP TABLE IF EXISTS `jadwal_mahasiswa`;
CREATE TABLE `jadwal_mahasiswa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kalendar_akademik_id` int(10) unsigned NOT NULL DEFAULT '0',
  `jadwal_krs_id` int(10) unsigned NOT NULL DEFAULT '0',
  `mahasiswa_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `kalendar_akademik_id` (`kalendar_akademik_id`),
  KEY `jadwal_krs_id` (`jadwal_krs_id`),
  KEY `mahasiswa_id` (`mahasiswa_id`),
  CONSTRAINT `jadwal_mahasiswa_ibfk_1` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`),
  CONSTRAINT `jadwal_mahasiswa_ibfk_2` FOREIGN KEY (`kalendar_akademik_id`) REFERENCES `kalendar_akademik` (`id`),
  CONSTRAINT `jadwal_mahasiswa_ibfk_3` FOREIGN KEY (`jadwal_krs_id`) REFERENCES `jadwal_krs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jadwal_mahasiswa
-- ----------------------------

-- ----------------------------
-- Table structure for `jenis_nilai`
-- ----------------------------
DROP TABLE IF EXISTS `jenis_nilai`;
CREATE TABLE `jenis_nilai` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT '',
  `scoring` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jenis_nilai
-- ----------------------------

-- ----------------------------
-- Table structure for `jenis_pendaftaran`
-- ----------------------------
DROP TABLE IF EXISTS `jenis_pendaftaran`;
CREATE TABLE `jenis_pendaftaran` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jenis_pendaftaran
-- ----------------------------

-- ----------------------------
-- Table structure for `kalendar_akademik`
-- ----------------------------
DROP TABLE IF EXISTS `kalendar_akademik`;
CREATE TABLE `kalendar_akademik` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fakultas_kode` char(5) NOT NULL DEFAULT '',
  `programstudi_kode` char(5) NOT NULL DEFAULT '',
  `semester` enum('genap','ganjil') NOT NULL,
  `tahun_akademik` year(4) NOT NULL DEFAULT '0000',
  PRIMARY KEY (`id`),
  KEY `fakultas_kode` (`fakultas_kode`),
  KEY `programstudi_kode` (`programstudi_kode`),
  CONSTRAINT `kalendar_akademik_ibfk_1` FOREIGN KEY (`programstudi_kode`) REFERENCES `programstudi` (`kode`),
  CONSTRAINT `kalendar_akademik_ibfk_2` FOREIGN KEY (`fakultas_kode`) REFERENCES `fakultas` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kalendar_akademik
-- ----------------------------

-- ----------------------------
-- Table structure for `kalendar_informasi`
-- ----------------------------
DROP TABLE IF EXISTS `kalendar_informasi`;
CREATE TABLE `kalendar_informasi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kalendar_akademik_id` int(10) unsigned NOT NULL DEFAULT '0',
  `tgl_event` date NOT NULL,
  `jam` time NOT NULL,
  `judul` varchar(255) DEFAULT '',
  `deskripsi` text,
  `karyawan_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `kalendar_akademik_id` (`kalendar_akademik_id`),
  KEY `kalendar_akademik_id_2` (`kalendar_akademik_id`),
  KEY `karyawan_id` (`karyawan_id`),
  CONSTRAINT `kalendar_informasi_ibfk_1` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`),
  CONSTRAINT `kalendar_informasi_ibfk_2` FOREIGN KEY (`kalendar_akademik_id`) REFERENCES `kalendar_akademik` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kalendar_informasi
-- ----------------------------

-- ----------------------------
-- Table structure for `karyawan`
-- ----------------------------
DROP TABLE IF EXISTS `karyawan`;
CREATE TABLE `karyawan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL DEFAULT '',
  `alamat` text,
  `telp` char(20) DEFAULT '',
  `jenis_kelamin` enum('L','P') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jenis_kelamin_id` (`jenis_kelamin`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of karyawan
-- ----------------------------
INSERT INTO `karyawan` VALUES ('1', 'Timen Chad', 'semarang', '081326645702', 'L');
INSERT INTO `karyawan` VALUES ('5', 'Abdam Cahaya Hati', 'ngalian', '08882224444', 'L');
INSERT INTO `karyawan` VALUES ('6', 'Budi Susanto', 'semarang', '081325551234', 'L');

-- ----------------------------
-- Table structure for `khs`
-- ----------------------------
DROP TABLE IF EXISTS `khs`;
CREATE TABLE `khs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `jadwal_mahasiswa_id` int(10) unsigned NOT NULL DEFAULT '0',
  `grade_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `jadwal_mahasiswa_id` (`jadwal_mahasiswa_id`),
  KEY `grade_id` (`grade_id`),
  CONSTRAINT `khs_ibfk_1` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`),
  CONSTRAINT `khs_ibfk_2` FOREIGN KEY (`jadwal_mahasiswa_id`) REFERENCES `jadwal_mahasiswa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of khs
-- ----------------------------

-- ----------------------------
-- Table structure for `khs_jenis`
-- ----------------------------
DROP TABLE IF EXISTS `khs_jenis`;
CREATE TABLE `khs_jenis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `khs_id` int(10) unsigned NOT NULL DEFAULT '0',
  `jenis_nilai_id` int(10) unsigned NOT NULL DEFAULT '0',
  `nilai` decimal(18,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `khs_id` (`khs_id`),
  KEY `jenis_nilai_id` (`jenis_nilai_id`),
  CONSTRAINT `khs_jenis_ibfk_1` FOREIGN KEY (`jenis_nilai_id`) REFERENCES `jenis_nilai` (`id`),
  CONSTRAINT `khs_jenis_ibfk_2` FOREIGN KEY (`khs_id`) REFERENCES `khs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of khs_jenis
-- ----------------------------

-- ----------------------------
-- Table structure for `konfirmasi_pembayaran`
-- ----------------------------
DROP TABLE IF EXISTS `konfirmasi_pembayaran`;
CREATE TABLE `konfirmasi_pembayaran` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `calon_mahasiswa_id` int(10) unsigned NOT NULL DEFAULT '0',
  `tgl_konfirmasi` date DEFAULT '0000-00-00',
  `no_transaksi_transfer` varchar(255) DEFAULT '',
  `bank` char(255) DEFAULT '',
  `tgl_validasi` date DEFAULT '0000-00-00',
  `karyawan_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `calon_mahasiswa_id` (`calon_mahasiswa_id`),
  KEY `karyawan_id` (`karyawan_id`),
  CONSTRAINT `konfirmasi_pembayaran_ibfk_1` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`),
  CONSTRAINT `konfirmasi_pembayaran_ibfk_2` FOREIGN KEY (`calon_mahasiswa_id`) REFERENCES `calon_mahasiswa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of konfirmasi_pembayaran
-- ----------------------------

-- ----------------------------
-- Table structure for `mahasiswa`
-- ----------------------------
DROP TABLE IF EXISTS `mahasiswa`;
CREATE TABLE `mahasiswa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fakultas_kode` char(5) NOT NULL DEFAULT '',
  `programstudi_kode` char(5) NOT NULL DEFAULT '',
  `nim` char(5) NOT NULL DEFAULT '',
  `tahun_masuk` year(4) DEFAULT NULL,
  `tahun_lulus` year(4) DEFAULT NULL,
  `nama` varchar(255) DEFAULT '',
  `tgl_lahir` date DEFAULT '0000-00-00',
  `tmpat_lahir` varchar(255) DEFAULT '',
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` text,
  `telp` varchar(255) DEFAULT '',
  `email` varchar(255) DEFAULT '',
  `password` varchar(255) DEFAULT '',
  `status_siswa_id` tinyint(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fakultas_kode` (`fakultas_kode`),
  KEY `programstudi_kode` (`programstudi_kode`),
  KEY `jenis_kelamin_id` (`jenis_kelamin`),
  KEY `status_siswa_id` (`status_siswa_id`),
  CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`status_siswa_id`) REFERENCES `status_siswa` (`id`),
  CONSTRAINT `mahasiswa_ibfk_2` FOREIGN KEY (`fakultas_kode`) REFERENCES `fakultas` (`kode`),
  CONSTRAINT `mahasiswa_ibfk_3` FOREIGN KEY (`programstudi_kode`) REFERENCES `programstudi` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mahasiswa
-- ----------------------------

-- ----------------------------
-- Table structure for `matakuliah`
-- ----------------------------
DROP TABLE IF EXISTS `matakuliah`;
CREATE TABLE `matakuliah` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fakultas_kode` char(5) NOT NULL DEFAULT '',
  `programstudi_kode` char(5) NOT NULL DEFAULT '',
  `dosenkoordinator_id` int(10) unsigned NOT NULL DEFAULT '0',
  `nama` varchar(255) DEFAULT '',
  `karyawan_id` int(10) unsigned NOT NULL DEFAULT '0',
  `semester` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fakultas_kode` (`fakultas_kode`),
  KEY `programstudi_kode` (`programstudi_kode`),
  KEY `dosenkoordinator_id` (`dosenkoordinator_id`),
  KEY `karyawan_id` (`karyawan_id`),
  CONSTRAINT `matakuliah_ibfk_1` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`),
  CONSTRAINT `matakuliah_ibfk_2` FOREIGN KEY (`fakultas_kode`) REFERENCES `fakultas` (`kode`),
  CONSTRAINT `matakuliah_ibfk_3` FOREIGN KEY (`programstudi_kode`) REFERENCES `programstudi` (`kode`),
  CONSTRAINT `matakuliah_ibfk_4` FOREIGN KEY (`dosenkoordinator_id`) REFERENCES `dosen` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of matakuliah
-- ----------------------------

-- ----------------------------
-- Table structure for `matkul_dosen`
-- ----------------------------
DROP TABLE IF EXISTS `matkul_dosen`;
CREATE TABLE `matkul_dosen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `matakuliah_id` int(10) unsigned NOT NULL DEFAULT '0',
  `dosen_id` int(10) unsigned NOT NULL DEFAULT '0',
  `sks` tinyint(10) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `matakuliah_id` (`matakuliah_id`),
  KEY `dosen_id` (`dosen_id`),
  CONSTRAINT `matkul_dosen_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`),
  CONSTRAINT `matkul_dosen_ibfk_2` FOREIGN KEY (`matakuliah_id`) REFERENCES `matakuliah` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of matkul_dosen
-- ----------------------------

-- ----------------------------
-- Table structure for `pengumuman_info`
-- ----------------------------
DROP TABLE IF EXISTS `pengumuman_info`;
CREATE TABLE `pengumuman_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tgl_event` date NOT NULL,
  `jam` time NOT NULL,
  `judul` varchar(255) DEFAULT '',
  `deskripsi` text,
  `karyawan_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `karyawan_id` (`karyawan_id`),
  CONSTRAINT `pengumuman_info_ibfk_1` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pengumuman_info
-- ----------------------------

-- ----------------------------
-- Table structure for `penjadwalan`
-- ----------------------------
DROP TABLE IF EXISTS `penjadwalan`;
CREATE TABLE `penjadwalan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ruang` varchar(255) NOT NULL DEFAULT '',
  `weekday_id` tinyint(10) unsigned NOT NULL DEFAULT '1',
  `jam_in` time DEFAULT '00:00:00',
  `jam_out` time DEFAULT '00:00:00',
  `kuota` int(10) NOT NULL DEFAULT '0',
  `keterangan` text,
  PRIMARY KEY (`id`),
  KEY `weekday_id` (`weekday_id`),
  CONSTRAINT `penjadwalan_ibfk_1` FOREIGN KEY (`weekday_id`) REFERENCES `weekday` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of penjadwalan
-- ----------------------------

-- ----------------------------
-- Table structure for `pilih_jenis_pendaftaran`
-- ----------------------------
DROP TABLE IF EXISTS `pilih_jenis_pendaftaran`;
CREATE TABLE `pilih_jenis_pendaftaran` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `jenis_pendaftaran_id` int(10) unsigned NOT NULL DEFAULT '0',
  `asal_sekolah` varchar(255) DEFAULT '',
  `asal_universitas` varchar(255) DEFAULT '',
  `transkip_nilai` decimal(18,2) NOT NULL DEFAULT '0.00',
  `skhu` decimal(18,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `jenis_pendaftaran_id` (`jenis_pendaftaran_id`),
  CONSTRAINT `pilih_jenis_pendaftaran_ibfk_1` FOREIGN KEY (`jenis_pendaftaran_id`) REFERENCES `jenis_pendaftaran` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pilih_jenis_pendaftaran
-- ----------------------------

-- ----------------------------
-- Table structure for `programstudi`
-- ----------------------------
DROP TABLE IF EXISTS `programstudi`;
CREATE TABLE `programstudi` (
  `kode` char(5) NOT NULL DEFAULT '',
  `fakultas_kode` char(5) NOT NULL,
  `nama` varchar(255) DEFAULT '',
  PRIMARY KEY (`kode`),
  KEY `id` (`kode`),
  KEY `fakultas_kode` (`fakultas_kode`),
  CONSTRAINT `programstudi_ibfk_1` FOREIGN KEY (`fakultas_kode`) REFERENCES `fakultas` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of programstudi
-- ----------------------------

-- ----------------------------
-- Table structure for `status_pmb`
-- ----------------------------
DROP TABLE IF EXISTS `status_pmb`;
CREATE TABLE `status_pmb` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of status_pmb
-- ----------------------------

-- ----------------------------
-- Table structure for `status_siswa`
-- ----------------------------
DROP TABLE IF EXISTS `status_siswa`;
CREATE TABLE `status_siswa` (
  `id` tinyint(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of status_siswa
-- ----------------------------
INSERT INTO `status_siswa` VALUES ('1', 'Aktif');
INSERT INTO `status_siswa` VALUES ('2', 'Alumni');
INSERT INTO `status_siswa` VALUES ('3', 'DO');
INSERT INTO `status_siswa` VALUES ('4', 'Pemutihan');

-- ----------------------------
-- Table structure for `web_lang`
-- ----------------------------
DROP TABLE IF EXISTS `web_lang`;
CREATE TABLE `web_lang` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `code` varchar(150) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `lang` enum('id','en') DEFAULT 'id',
  `tipe` enum('view_file','menu') DEFAULT 'view_file',
  `view_filename` varchar(120) DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of web_lang
-- ----------------------------
INSERT INTO `web_lang` VALUES ('1', 'lang_please_singin', 'Silakan Login', 'id', 'view_file', 'alumni_bukutamu/form_login', '2013-04-01 17:23:28');
INSERT INTO `web_lang` VALUES ('2', 'lang_email_address', 'Alamat Email', 'id', 'view_file', 'alumni_bukutamu/form_login', '2013-04-01 17:23:29');
INSERT INTO `web_lang` VALUES ('3', 'lang_password', 'Password', 'id', 'view_file', 'alumni_bukutamu/form_login', '2013-04-01 17:23:29');
INSERT INTO `web_lang` VALUES ('4', 'lang_remember', 'Ingat Aku', 'id', 'view_file', 'alumni_bukutamu/form_login', '2013-04-01 17:23:30');
INSERT INTO `web_lang` VALUES ('5', 'lang_login', 'Login', 'id', 'view_file', 'alumni_bukutamu/form_login', '2013-04-01 17:23:30');
INSERT INTO `web_lang` VALUES ('6', 'lang_login_form', 'Login', 'id', 'menu', null, '2013-02-23 00:45:23');
INSERT INTO `web_lang` VALUES ('7', 'lang_home', 'Home', 'id', 'menu', null, '2013-02-23 00:46:00');
INSERT INTO `web_lang` VALUES ('8', 'lang_please_singin', 'Admin Login Form', 'id', 'view_file', 'admin/user/form_login', '2013-03-15 22:57:36');
INSERT INTO `web_lang` VALUES ('9', 'lang_email_address', 'username', 'id', 'view_file', 'admin/user/form_login', '2013-03-15 22:57:39');
INSERT INTO `web_lang` VALUES ('10', 'lang_password', 'password', 'id', 'view_file', 'admin/user/form_login', '2013-03-15 22:57:39');
INSERT INTO `web_lang` VALUES ('11', 'lang_remember', 'Ingat aku', 'id', 'view_file', 'admin/user/form_login', '2013-03-15 23:07:38');
INSERT INTO `web_lang` VALUES ('12', 'lang_login', 'Login', 'id', 'view_file', 'admin/user/form_login', '2013-03-15 22:57:40');
INSERT INTO `web_lang` VALUES ('13', 'lang_logout', 'Logout', 'id', 'menu', null, '2013-03-15 17:26:48');
INSERT INTO `web_lang` VALUES ('14', 'lang_list_user', 'User Admin', 'id', 'menu', null, '2013-03-15 17:31:54');
INSERT INTO `web_lang` VALUES ('15', 'lang_username', 'Nama User', 'id', 'view_file', 'admin/user/form_add_user', '2013-03-15 22:57:53');
INSERT INTO `web_lang` VALUES ('16', 'lang_karyawan', 'Nama Karyawan', 'id', 'view_file', 'admin/user/form_add_user', '2013-03-15 22:57:54');
INSERT INTO `web_lang` VALUES ('17', 'lang_role', 'Hak Kuasa', 'id', 'view_file', 'admin/user/form_add_user', '2013-03-15 22:57:55');
INSERT INTO `web_lang` VALUES ('18', 'lang_first_password', 'Password awal sama dengan nama user', 'id', 'view_file', 'admin/user/form_add_user', '2013-03-15 22:57:55');
INSERT INTO `web_lang` VALUES ('19', 'lang_submit', 'simpan', 'id', 'view_file', 'admin/user/form_add_user', '2013-03-15 22:57:56');
INSERT INTO `web_lang` VALUES ('20', 'lang_list_permission', 'Permission', 'id', 'menu', null, '2013-03-15 23:48:13');
INSERT INTO `web_lang` VALUES ('21', 'lang_404', '404 / Halaman Tidak Ditemukan', 'id', 'view_file', 'admin/page_not_found', '2013-03-16 04:12:50');
INSERT INTO `web_lang` VALUES ('22', 'lang_404_detail', 'Halaman/file yang Anda minta telah dipindahkan atau dihapus dari situs ini.', 'id', 'view_file', 'admin/page_not_found', '2013-03-16 04:14:55');
INSERT INTO `web_lang` VALUES ('23', 'lang_notification', 'Halaman privat, bukan untuk pengunjung umum', 'id', 'view_file', 'admin/user/form_login', '2013-03-16 04:17:04');
INSERT INTO `web_lang` VALUES ('24', 'lang_about_us', 'Tentang Kami', 'id', 'view_file', null, '2013-04-06 20:21:36');

-- ----------------------------
-- Table structure for `web_permission`
-- ----------------------------
DROP TABLE IF EXISTS `web_permission`;
CREATE TABLE `web_permission` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `parent_model` int(10) DEFAULT '0',
  `model` varchar(150) DEFAULT NULL,
  `method` varchar(150) DEFAULT NULL,
  `permission` varchar(150) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `urutan` int(3) DEFAULT NULL,
  `is_visible` enum('Y','N') DEFAULT 'N',
  `is_active` enum('Y','N') DEFAULT 'Y',
  `last_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of web_permission
-- ----------------------------
INSERT INTO `web_permission` VALUES ('2', '0', 'mahasiswa', 'login_form', 'umum', 'Login', '2', 'Y', 'Y', '2013-05-05 14:09:39');
INSERT INTO `web_permission` VALUES ('3', '0', 'common', 'homepage', 'umum', null, null, 'N', 'Y', '2013-05-05 14:09:39');
INSERT INTO `web_permission` VALUES ('4', '0', '', 'home', 'umum', 'Home', '1', 'Y', 'Y', '2013-05-05 14:09:39');
INSERT INTO `web_permission` VALUES ('5', '0', 'buku_tamu', 'form_buku_tamu', 'umum', null, null, 'N', 'Y', '2013-05-05 14:09:39');
INSERT INTO `web_permission` VALUES ('6', '0', 'buku_tamu', 'simpan_komentar', 'umum', null, null, 'N', 'Y', '2013-05-05 14:09:39');
INSERT INTO `web_permission` VALUES ('7', '0', 'user', 'login_form', 'no_admin', null, null, 'N', 'Y', '2013-05-05 14:09:39');
INSERT INTO `web_permission` VALUES ('8', '0', 'user', 'cek_login', 'no_admin', null, null, 'N', 'Y', '2013-05-05 14:09:39');
INSERT INTO `web_permission` VALUES ('9', '0', 'admin_common', 'homepage', 'admin', null, null, 'N', 'Y', '2013-05-05 14:09:39');
INSERT INTO `web_permission` VALUES ('10', '0', 'user', 'logout', 'admin', null, null, 'N', 'Y', '2013-05-05 14:09:39');
INSERT INTO `web_permission` VALUES ('11', '24', 'user', 'list_user', 'master_admin', 'Admin User', null, 'Y', 'Y', '2013-05-05 12:55:39');
INSERT INTO `web_permission` VALUES ('12', '0', 'user', 'form_add_user', 'master_admin', null, null, 'N', 'Y', '2013-05-05 14:09:39');
INSERT INTO `web_permission` VALUES ('13', '0', 'user', 'add_user', 'master_admin', null, null, 'N', 'Y', '2013-05-05 14:09:39');
INSERT INTO `web_permission` VALUES ('14', '0', 'user', 'form_edit_user', 'master_admin', null, null, 'N', 'Y', '2013-05-05 14:09:39');
INSERT INTO `web_permission` VALUES ('15', '0', 'user', 'edit_user', 'master_admin', null, null, 'N', 'Y', '2013-05-05 14:09:39');
INSERT INTO `web_permission` VALUES ('16', '0', 'user', 'logout', 'master_admin', null, null, 'N', 'Y', '2013-05-05 14:09:39');
INSERT INTO `web_permission` VALUES ('17', '0', 'zdev_permission', 'list_permission', 'web_dev', 'Permission', null, 'Y', 'Y', '2013-05-05 14:09:39');
INSERT INTO `web_permission` VALUES ('18', '0', 'user', 'logout', 'web_dev', null, null, 'N', 'Y', '2013-05-05 14:09:39');
INSERT INTO `web_permission` VALUES ('19', '0', 'common', 'about_us', 'umum', 'About Us', '3', 'Y', 'Y', '2013-05-05 14:09:39');
INSERT INTO `web_permission` VALUES ('20', '0', null, null, 'admin_penjadwalan', null, '1', 'N', 'Y', '2013-05-05 14:09:39');
INSERT INTO `web_permission` VALUES ('21', '0', 'admin_buku_tamu', 'list_buku_tamu', 'master_admin', null, '2', 'N', 'Y', '2013-05-05 14:09:39');
INSERT INTO `web_permission` VALUES ('22', '0', 'zdev_permission', 'form_edit_permission', 'web_dev', null, null, 'N', 'Y', '2013-05-05 14:09:39');
INSERT INTO `web_permission` VALUES ('23', '0', 'zdev_permission', 'form_add_permission', 'web_dev', null, null, 'N', 'Y', '2013-05-05 14:09:39');
INSERT INTO `web_permission` VALUES ('24', '0', null, null, 'master_admin', 'Human Res', null, 'Y', 'Y', '2013-05-05 16:28:38');
INSERT INTO `web_permission` VALUES ('25', '24', 'admin_karyawan', 'list_karyawan', 'master_admin', 'Admin Karyawan', null, 'Y', 'Y', '2013-05-05 15:43:51');

-- ----------------------------
-- Table structure for `web_role`
-- ----------------------------
DROP TABLE IF EXISTS `web_role`;
CREATE TABLE `web_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of web_role
-- ----------------------------
INSERT INTO `web_role` VALUES ('1', 'master_admin');
INSERT INTO `web_role` VALUES ('2', 'web_dev');
INSERT INTO `web_role` VALUES ('3', 'admin_penjadwalan');

-- ----------------------------
-- Table structure for `web_user`
-- ----------------------------
DROP TABLE IF EXISTS `web_user`;
CREATE TABLE `web_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `id_role` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of web_user
-- ----------------------------
INSERT INTO `web_user` VALUES ('1', '1', 'timen', '098f6bcd4621d373cade4e832627b4f6', '2');
INSERT INTO `web_user` VALUES ('2', '1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1');
INSERT INTO `web_user` VALUES ('3', '1', 'web_adm', '37d6de50bf6e2f27cd712718b372a8f4', '2');
INSERT INTO `web_user` VALUES ('4', null, 'pmb', null, null);
INSERT INTO `web_user` VALUES ('6', '5', 'abdam_jadwal', '92d7b3662439481b56c9ad2ad05f75a6', '3');

-- ----------------------------
-- Table structure for `weekday`
-- ----------------------------
DROP TABLE IF EXISTS `weekday`;
CREATE TABLE `weekday` (
  `id` tinyint(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of weekday
-- ----------------------------
INSERT INTO `weekday` VALUES ('1', 'Senin');
INSERT INTO `weekday` VALUES ('2', 'Selasa');
INSERT INTO `weekday` VALUES ('3', 'Rabu');
INSERT INTO `weekday` VALUES ('4', 'Kamis');
INSERT INTO `weekday` VALUES ('5', 'Jumat');
INSERT INTO `weekday` VALUES ('6', 'Sabtu');
INSERT INTO `weekday` VALUES ('7', 'Sabtu');

-- ----------------------------
-- Table structure for `xxxjenis_kelamin`
-- ----------------------------
DROP TABLE IF EXISTS `xxxjenis_kelamin`;
CREATE TABLE `xxxjenis_kelamin` (
  `id` tinyint(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of xxxjenis_kelamin
-- ----------------------------
INSERT INTO `xxxjenis_kelamin` VALUES ('1', 'Laki laki');
INSERT INTO `xxxjenis_kelamin` VALUES ('2', 'Perempuan');

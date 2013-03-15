/*
Navicat MySQL Data Transfer

Source Server         : lokal
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : siska

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2013-03-16 04:35:06
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
  PRIMARY KEY (`id`,`karyawan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of bukutamu
-- ----------------------------

-- ----------------------------
-- Table structure for `dosen`
-- ----------------------------
DROP TABLE IF EXISTS `dosen`;
CREATE TABLE `dosen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `karyawan_id` int(10) unsigned NOT NULL,
  `universitas_kode` char(5) NOT NULL DEFAULT '',
  `fakultas_kode` char(5) NOT NULL DEFAULT '',
  `programstudi_kode` char(5) NOT NULL DEFAULT '',
  `nid` char(5) NOT NULL DEFAULT '',
  `email` char(20) DEFAULT '',
  PRIMARY KEY (`id`,`karyawan_id`,`universitas_kode`,`fakultas_kode`,`programstudi_kode`,`nid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of dosen
-- ----------------------------

-- ----------------------------
-- Table structure for `fakultas`
-- ----------------------------
DROP TABLE IF EXISTS `fakultas`;
CREATE TABLE `fakultas` (
  `universitas_kode` char(5) NOT NULL DEFAULT '',
  `kode` char(5) NOT NULL DEFAULT '',
  `nama` varchar(255) DEFAULT '',
  `alamat` text,
  `telp` char(20) DEFAULT '',
  `dekan` varchar(255) DEFAULT '',
  PRIMARY KEY (`universitas_kode`,`kode`),
  KEY `id` (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fakultas
-- ----------------------------

-- ----------------------------
-- Table structure for `jadwal_krs`
-- ----------------------------
DROP TABLE IF EXISTS `jadwal_krs`;
CREATE TABLE `jadwal_krs` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `matkul_dosen_id` int(10) unsigned NOT NULL DEFAULT '0',
  `jadwal_ruang_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`matkul_dosen_id`,`jadwal_ruang_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jadwal_krs
-- ----------------------------

-- ----------------------------
-- Table structure for `jadwal_mahasiswa`
-- ----------------------------
DROP TABLE IF EXISTS `jadwal_mahasiswa`;
CREATE TABLE `jadwal_mahasiswa` (
  `kalendar_akademik_id` int(10) unsigned NOT NULL DEFAULT '0',
  `jadwal_krs_id` int(10) unsigned NOT NULL DEFAULT '0',
  `mahasiswa_id` int(10) unsigned NOT NULL DEFAULT '0',
  `nilai_tugas` decimal(3,2) DEFAULT '0.00',
  `nilai_uts` decimal(3,2) DEFAULT '0.00',
  `nilai_remidi` decimal(3,2) DEFAULT '0.00',
  `nilai_uas` decimal(3,2) DEFAULT '0.00',
  `nilai_grade` char(2) DEFAULT '',
  PRIMARY KEY (`kalendar_akademik_id`,`jadwal_krs_id`,`mahasiswa_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jadwal_mahasiswa
-- ----------------------------

-- ----------------------------
-- Table structure for `jadwal_ruang`
-- ----------------------------
DROP TABLE IF EXISTS `jadwal_ruang`;
CREATE TABLE `jadwal_ruang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ruang_id` int(10) unsigned NOT NULL DEFAULT '0',
  `weekday_id` tinyint(10) unsigned NOT NULL DEFAULT '1',
  `jam_in` time DEFAULT '00:00:00',
  `jam_out` time DEFAULT '00:00:00',
  PRIMARY KEY (`id`,`ruang_id`,`weekday_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jadwal_ruang
-- ----------------------------

-- ----------------------------
-- Table structure for `jenis_kelamin`
-- ----------------------------
DROP TABLE IF EXISTS `jenis_kelamin`;
CREATE TABLE `jenis_kelamin` (
  `id` tinyint(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jenis_kelamin
-- ----------------------------

-- ----------------------------
-- Table structure for `jenis_tagihan`
-- ----------------------------
DROP TABLE IF EXISTS `jenis_tagihan`;
CREATE TABLE `jenis_tagihan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jenis_tagihan
-- ----------------------------
INSERT INTO `jenis_tagihan` VALUES ('1', 'SKS');
INSERT INTO `jenis_tagihan` VALUES ('2', 'Uang Gedung');
INSERT INTO `jenis_tagihan` VALUES ('3', 'Skripsi');
INSERT INTO `jenis_tagihan` VALUES ('4', 'Poliklinik');

-- ----------------------------
-- Table structure for `kalendar_akademik`
-- ----------------------------
DROP TABLE IF EXISTS `kalendar_akademik`;
CREATE TABLE `kalendar_akademik` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `universitas_kode` char(5) NOT NULL DEFAULT '',
  `fakultas_kode` char(5) NOT NULL DEFAULT '',
  `programstudi_kode` char(5) NOT NULL DEFAULT '',
  `semester` enum('genap','ganjil') NOT NULL,
  `tahun_akademik` year(4) NOT NULL DEFAULT '0000',
  `biaya_sks` decimal(18,0) DEFAULT '0',
  `biaya_gedung` decimal(18,0) DEFAULT '0',
  PRIMARY KEY (`id`,`universitas_kode`,`fakultas_kode`,`programstudi_kode`,`semester`,`tahun_akademik`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`id`,`kalendar_akademik_id`,`karyawan_id`),
  KEY `kalendar_akademik_id` (`kalendar_akademik_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kalendar_informasi
-- ----------------------------

-- ----------------------------
-- Table structure for `karyawan`
-- ----------------------------
DROP TABLE IF EXISTS `karyawan`;
CREATE TABLE `karyawan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status_pegawai_id` tinyint(10) NOT NULL DEFAULT '1',
  `nama` varchar(255) NOT NULL DEFAULT '',
  `alamat` text,
  `telp` char(20) DEFAULT '',
  `jenis_kelamin_id` tinyint(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`status_pegawai_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of karyawan
-- ----------------------------
INSERT INTO `karyawan` VALUES ('1', '1', 'Timen Chad', 'semarang', '081326645702', '1');

-- ----------------------------
-- Table structure for `mahasiswa`
-- ----------------------------
DROP TABLE IF EXISTS `mahasiswa`;
CREATE TABLE `mahasiswa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `universitas_kode` char(5) NOT NULL DEFAULT '',
  `fakultas_kode` char(5) NOT NULL DEFAULT '',
  `programstudi_kode` char(5) NOT NULL DEFAULT '',
  `nim` char(5) NOT NULL DEFAULT '',
  `tahun_masuk` year(4) DEFAULT '0000',
  `tahun_lulus` year(4) DEFAULT '0000',
  `status_siswa_id` tinyint(10) unsigned NOT NULL DEFAULT '1',
  `nama` varchar(255) DEFAULT '',
  `tgl_lahir` date DEFAULT '0000-00-00',
  `tmpat_lahir` varchar(255) DEFAULT '',
  `jenis_kelamin_id` tinyint(10) unsigned NOT NULL DEFAULT '1',
  `alamat` text,
  `telp` varchar(255) DEFAULT '',
  `email` varchar(255) DEFAULT '',
  `password` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`,`universitas_kode`,`fakultas_kode`,`programstudi_kode`,`nim`,`status_siswa_id`,`jenis_kelamin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mahasiswa
-- ----------------------------

-- ----------------------------
-- Table structure for `mahasiswa_pembayaran`
-- ----------------------------
DROP TABLE IF EXISTS `mahasiswa_pembayaran`;
CREATE TABLE `mahasiswa_pembayaran` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kalendar_akademik_id` int(10) unsigned NOT NULL DEFAULT '0',
  `mahasiswa_id` int(10) unsigned NOT NULL DEFAULT '0',
  `jenis_tagihan_id` tinyint(10) unsigned NOT NULL DEFAULT '0',
  `tgl_tagihan` date DEFAULT '0000-00-00',
  `jumlah` decimal(18,0) DEFAULT '0',
  `tgl_bayar` date DEFAULT '0000-00-00',
  PRIMARY KEY (`id`,`kalendar_akademik_id`,`mahasiswa_id`,`jenis_tagihan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mahasiswa_pembayaran
-- ----------------------------

-- ----------------------------
-- Table structure for `matakuliah`
-- ----------------------------
DROP TABLE IF EXISTS `matakuliah`;
CREATE TABLE `matakuliah` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `universitas_kode` char(5) NOT NULL DEFAULT '',
  `fakultas_kode` char(5) NOT NULL DEFAULT '',
  `programstudi_kode` char(5) NOT NULL DEFAULT '',
  `dosenkoordinator_id` int(10) unsigned NOT NULL DEFAULT '0',
  `nama` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`,`universitas_kode`,`fakultas_kode`,`programstudi_kode`,`dosenkoordinator_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`id`,`matakuliah_id`,`dosen_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of matkul_dosen
-- ----------------------------

-- ----------------------------
-- Table structure for `matkul_dosen_download`
-- ----------------------------
DROP TABLE IF EXISTS `matkul_dosen_download`;
CREATE TABLE `matkul_dosen_download` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `matkul_dosen_id` int(10) unsigned NOT NULL DEFAULT '0',
  `tgl_posting` datetime DEFAULT '0000-00-00 00:00:00',
  `nama_file` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`,`matkul_dosen_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of matkul_dosen_download
-- ----------------------------

-- ----------------------------
-- Table structure for `programstudi`
-- ----------------------------
DROP TABLE IF EXISTS `programstudi`;
CREATE TABLE `programstudi` (
  `universitas_kode` char(5) NOT NULL DEFAULT '',
  `fakultas_kode` char(5) NOT NULL DEFAULT '',
  `kode` char(5) NOT NULL DEFAULT '',
  `nama` varchar(255) DEFAULT '',
  `alamat` text,
  `telp` char(20) DEFAULT '',
  `kaprogdi` int(10) unsigned NOT NULL DEFAULT '0',
  `wakaprogdi` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`universitas_kode`,`fakultas_kode`,`kode`,`kaprogdi`,`wakaprogdi`),
  KEY `id` (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of programstudi
-- ----------------------------

-- ----------------------------
-- Table structure for `registrasi`
-- ----------------------------
DROP TABLE IF EXISTS `registrasi`;
CREATE TABLE `registrasi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kalendar_akademik_id` int(10) unsigned NOT NULL DEFAULT '0',
  `nama` varchar(255) DEFAULT '',
  `alamat` text,
  `asal_sekolah` varchar(255) DEFAULT '',
  `nilai` decimal(3,2) DEFAULT '0.00',
  `is_bayar` tinyint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`kalendar_akademik_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of registrasi
-- ----------------------------

-- ----------------------------
-- Table structure for `ruang`
-- ----------------------------
DROP TABLE IF EXISTS `ruang`;
CREATE TABLE `ruang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT '',
  `lokasi` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ruang
-- ----------------------------

-- ----------------------------
-- Table structure for `status_pegawai`
-- ----------------------------
DROP TABLE IF EXISTS `status_pegawai`;
CREATE TABLE `status_pegawai` (
  `id` tinyint(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of status_pegawai
-- ----------------------------
INSERT INTO `status_pegawai` VALUES ('1', 'Tetap');
INSERT INTO `status_pegawai` VALUES ('2', 'Tidak Tetap');

-- ----------------------------
-- Table structure for `status_siswa`
-- ----------------------------
DROP TABLE IF EXISTS `status_siswa`;
CREATE TABLE `status_siswa` (
  `id` tinyint(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of status_siswa
-- ----------------------------
INSERT INTO `status_siswa` VALUES ('1', 'Aktif');
INSERT INTO `status_siswa` VALUES ('2', 'Alumni');
INSERT INTO `status_siswa` VALUES ('3', 'DO');
INSERT INTO `status_siswa` VALUES ('4', 'Pemutihan');

-- ----------------------------
-- Table structure for `universitas`
-- ----------------------------
DROP TABLE IF EXISTS `universitas`;
CREATE TABLE `universitas` (
  `kode` char(5) NOT NULL DEFAULT '',
  `nama` varchar(255) DEFAULT '',
  `alamat` text,
  `telp` char(20) DEFAULT '',
  `rektor` varchar(255) DEFAULT '',
  `wakil_rektor1` varchar(255) DEFAULT '',
  `wakil_rektor2` varchar(255) DEFAULT '',
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of universitas
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of web_lang
-- ----------------------------
INSERT INTO `web_lang` VALUES ('1', 'lang_please_singin', 'Silakan Login', 'id', 'view_file', 'form_login', '2013-02-23 03:16:35');
INSERT INTO `web_lang` VALUES ('2', 'lang_email_address', 'Alamat Email', 'id', 'view_file', 'form_login', '2013-02-23 03:16:35');
INSERT INTO `web_lang` VALUES ('3', 'lang_password', 'Password', 'id', 'view_file', 'form_login', '2013-02-23 03:16:36');
INSERT INTO `web_lang` VALUES ('4', 'lang_remember', 'Ingat Aku', 'id', 'view_file', 'form_login', '2013-02-23 03:16:36');
INSERT INTO `web_lang` VALUES ('5', 'lang_login', 'Login', 'id', 'view_file', 'form_login', '2013-02-23 03:16:37');
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

-- ----------------------------
-- Table structure for `web_permission`
-- ----------------------------
DROP TABLE IF EXISTS `web_permission`;
CREATE TABLE `web_permission` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `parent_model` int(10) DEFAULT NULL,
  `model` varchar(150) DEFAULT NULL,
  `method` varchar(150) DEFAULT NULL,
  `permission` varchar(150) DEFAULT NULL,
  `urutan` int(3) DEFAULT NULL,
  `is_visible` enum('Y','N') DEFAULT 'N',
  `is_active` enum('Y','N') DEFAULT 'Y',
  `last_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of web_permission
-- ----------------------------
INSERT INTO `web_permission` VALUES ('2', null, 'mahasiswa', 'login_form', 'umum', '2', 'Y', 'Y', '2013-03-15 18:24:34');
INSERT INTO `web_permission` VALUES ('3', null, 'common', 'homepage', 'umum', null, 'N', 'Y', '2013-03-15 18:24:36');
INSERT INTO `web_permission` VALUES ('4', null, '', 'home', 'umum', '1', 'Y', 'Y', '2013-03-15 18:24:40');
INSERT INTO `web_permission` VALUES ('5', null, 'buku_tamu', 'form_buku_tamu', 'umum', null, 'N', 'Y', '2013-03-15 18:24:45');
INSERT INTO `web_permission` VALUES ('6', null, 'buku_tamu', 'simpan_komentar', 'umum', null, 'N', 'Y', '2013-03-15 18:24:46');
INSERT INTO `web_permission` VALUES ('7', null, 'user', 'login_form', 'no_admin', null, 'N', 'Y', '2013-03-15 18:25:16');
INSERT INTO `web_permission` VALUES ('8', null, 'user', 'cek_login', 'no_admin', null, 'N', 'Y', '2013-03-15 18:25:29');
INSERT INTO `web_permission` VALUES ('9', null, 'admin_common', 'homepage', 'admin', null, 'N', 'Y', '2013-03-15 18:25:45');
INSERT INTO `web_permission` VALUES ('10', null, 'user', 'logout', 'admin', null, 'N', 'Y', '2013-03-16 03:51:14');
INSERT INTO `web_permission` VALUES ('11', null, 'user', 'list_user', 'master_admin', null, 'Y', 'Y', '2013-03-15 18:26:17');
INSERT INTO `web_permission` VALUES ('12', null, 'user', 'form_add_user', 'master_admin', null, 'N', 'Y', '2013-03-15 22:45:25');
INSERT INTO `web_permission` VALUES ('13', null, 'user', 'add_user', 'master_admin', null, 'N', 'Y', '2013-03-15 22:45:26');
INSERT INTO `web_permission` VALUES ('14', null, 'user', 'form_edit_user', 'master_admin', null, 'N', 'Y', '2013-03-15 22:45:26');
INSERT INTO `web_permission` VALUES ('15', null, 'user', 'edit_user', 'master_admin', null, 'N', 'Y', '2013-03-15 22:45:26');
INSERT INTO `web_permission` VALUES ('16', null, 'user', 'logout', 'master_admin', null, 'N', 'Y', '2013-03-16 03:51:47');
INSERT INTO `web_permission` VALUES ('17', null, 'zdev_permission', 'list_permission', 'web_dev', null, 'Y', 'Y', '2013-03-15 23:45:57');
INSERT INTO `web_permission` VALUES ('18', null, 'user', 'logout', 'web_dev', null, 'N', 'Y', '2013-03-16 03:51:08');

-- ----------------------------
-- Table structure for `web_role`
-- ----------------------------
DROP TABLE IF EXISTS `web_role`;
CREATE TABLE `web_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of web_role
-- ----------------------------
INSERT INTO `web_role` VALUES ('1', 'master_admin');
INSERT INTO `web_role` VALUES ('2', 'web_dev');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of web_user
-- ----------------------------
INSERT INTO `web_user` VALUES ('1', '1', 'timen', 'timen', '1');
INSERT INTO `web_user` VALUES ('2', '1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1');
INSERT INTO `web_user` VALUES ('3', '1', 'web_adm', '37d6de50bf6e2f27cd712718b372a8f4', '2');

-- ----------------------------
-- Table structure for `weekday`
-- ----------------------------
DROP TABLE IF EXISTS `weekday`;
CREATE TABLE `weekday` (
  `id` tinyint(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

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

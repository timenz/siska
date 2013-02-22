-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 22, 2013 at 09:29 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `siska`
--

-- --------------------------------------------------------

--
-- Table structure for table `bukutamu`
--

CREATE TABLE IF NOT EXISTS `bukutamu` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE IF NOT EXISTS `dosen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `karyawan_id` int(10) unsigned NOT NULL,
  `universitas_kode` char(5) NOT NULL DEFAULT '',
  `fakultas_kode` char(5) NOT NULL DEFAULT '',
  `programstudi_kode` char(5) NOT NULL DEFAULT '',
  `nid` char(5) NOT NULL DEFAULT '',
  `email` char(20) DEFAULT '',
  PRIMARY KEY (`id`,`karyawan_id`,`universitas_kode`,`fakultas_kode`,`programstudi_kode`,`nid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE IF NOT EXISTS `fakultas` (
  `universitas_kode` char(5) NOT NULL DEFAULT '',
  `kode` char(5) NOT NULL DEFAULT '',
  `nama` varchar(255) DEFAULT '',
  `alamat` text,
  `telp` char(20) DEFAULT '',
  `dekan` varchar(255) DEFAULT '',
  PRIMARY KEY (`universitas_kode`,`kode`),
  KEY `id` (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_krs`
--

CREATE TABLE IF NOT EXISTS `jadwal_krs` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `matkul_dosen_id` int(10) unsigned NOT NULL DEFAULT '0',
  `jadwal_ruang_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`matkul_dosen_id`,`jadwal_ruang_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_mahasiswa`
--

CREATE TABLE IF NOT EXISTS `jadwal_mahasiswa` (
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

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_ruang`
--

CREATE TABLE IF NOT EXISTS `jadwal_ruang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ruang_id` int(10) unsigned NOT NULL DEFAULT '0',
  `weekday_id` tinyint(10) unsigned NOT NULL DEFAULT '1',
  `jam_in` time DEFAULT '00:00:00',
  `jam_out` time DEFAULT '00:00:00',
  PRIMARY KEY (`id`,`ruang_id`,`weekday_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kelamin`
--

CREATE TABLE IF NOT EXISTS `jenis_kelamin` (
  `id` tinyint(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_tagihan`
--

CREATE TABLE IF NOT EXISTS `jenis_tagihan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `jenis_tagihan`
--

INSERT INTO `jenis_tagihan` (`id`, `nama`) VALUES
(1, 'SKS'),
(2, 'Uang Gedung'),
(3, 'Skripsi'),
(4, 'Poliklinik');

-- --------------------------------------------------------

--
-- Table structure for table `kalendar_akademik`
--

CREATE TABLE IF NOT EXISTS `kalendar_akademik` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `universitas_kode` char(5) NOT NULL DEFAULT '',
  `fakultas_kode` char(5) NOT NULL DEFAULT '',
  `programstudi_kode` char(5) NOT NULL DEFAULT '',
  `semester` enum('genap','ganjil') NOT NULL,
  `tahun_akademik` year(4) NOT NULL DEFAULT '0000',
  `biaya_sks` decimal(18,0) DEFAULT '0',
  `biaya_gedung` decimal(18,0) DEFAULT '0',
  PRIMARY KEY (`id`,`universitas_kode`,`fakultas_kode`,`programstudi_kode`,`semester`,`tahun_akademik`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kalendar_informasi`
--

CREATE TABLE IF NOT EXISTS `kalendar_informasi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kalendar_akademik_id` int(10) unsigned NOT NULL DEFAULT '0',
  `tgl_event` date NOT NULL,
  `jam` time NOT NULL,
  `judul` varchar(255) DEFAULT '',
  `deskripsi` text,
  `karyawan_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`kalendar_akademik_id`,`karyawan_id`),
  KEY `kalendar_akademik_id` (`kalendar_akademik_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE IF NOT EXISTS `karyawan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status_pegawai_id` tinyint(10) NOT NULL DEFAULT '1',
  `nama` varchar(255) NOT NULL DEFAULT '',
  `alamat` text,
  `telp` char(20) DEFAULT '',
  `jenis_kelamin_id` tinyint(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`status_pegawai_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE IF NOT EXISTS `mahasiswa` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_pembayaran`
--

CREATE TABLE IF NOT EXISTS `mahasiswa_pembayaran` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kalendar_akademik_id` int(10) unsigned NOT NULL DEFAULT '0',
  `mahasiswa_id` int(10) unsigned NOT NULL DEFAULT '0',
  `jenis_tagihan_id` tinyint(10) unsigned NOT NULL DEFAULT '0',
  `tgl_tagihan` date DEFAULT '0000-00-00',
  `jumlah` decimal(18,0) DEFAULT '0',
  `tgl_bayar` date DEFAULT '0000-00-00',
  PRIMARY KEY (`id`,`kalendar_akademik_id`,`mahasiswa_id`,`jenis_tagihan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE IF NOT EXISTS `matakuliah` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `universitas_kode` char(5) NOT NULL DEFAULT '',
  `fakultas_kode` char(5) NOT NULL DEFAULT '',
  `programstudi_kode` char(5) NOT NULL DEFAULT '',
  `dosenkoordinator_id` int(10) unsigned NOT NULL DEFAULT '0',
  `nama` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`,`universitas_kode`,`fakultas_kode`,`programstudi_kode`,`dosenkoordinator_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `matkul_dosen`
--

CREATE TABLE IF NOT EXISTS `matkul_dosen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `matakuliah_id` int(10) unsigned NOT NULL DEFAULT '0',
  `dosen_id` int(10) unsigned NOT NULL DEFAULT '0',
  `sks` tinyint(10) DEFAULT '0',
  PRIMARY KEY (`id`,`matakuliah_id`,`dosen_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `matkul_dosen_download`
--

CREATE TABLE IF NOT EXISTS `matkul_dosen_download` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `matkul_dosen_id` int(10) unsigned NOT NULL DEFAULT '0',
  `tgl_posting` datetime DEFAULT '0000-00-00 00:00:00',
  `nama_file` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`,`matkul_dosen_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `programstudi`
--

CREATE TABLE IF NOT EXISTS `programstudi` (
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

-- --------------------------------------------------------

--
-- Table structure for table `registrasi`
--

CREATE TABLE IF NOT EXISTS `registrasi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kalendar_akademik_id` int(10) unsigned NOT NULL DEFAULT '0',
  `nama` varchar(255) DEFAULT '',
  `alamat` text,
  `asal_sekolah` varchar(255) DEFAULT '',
  `nilai` decimal(3,2) DEFAULT '0.00',
  `is_bayar` tinyint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`kalendar_akademik_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE IF NOT EXISTS `ruang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT '',
  `lokasi` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `status_pegawai`
--

CREATE TABLE IF NOT EXISTS `status_pegawai` (
  `id` tinyint(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `status_pegawai`
--

INSERT INTO `status_pegawai` (`id`, `nama`) VALUES
(1, 'Tetap'),
(2, 'Tidak Tetap');

-- --------------------------------------------------------

--
-- Table structure for table `status_siswa`
--

CREATE TABLE IF NOT EXISTS `status_siswa` (
  `id` tinyint(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `status_siswa`
--

INSERT INTO `status_siswa` (`id`, `nama`) VALUES
(1, 'Aktif'),
(2, 'Alumni'),
(3, 'DO'),
(4, 'Pemutihan');

-- --------------------------------------------------------

--
-- Table structure for table `universitas`
--

CREATE TABLE IF NOT EXISTS `universitas` (
  `kode` char(5) NOT NULL DEFAULT '',
  `nama` varchar(255) DEFAULT '',
  `alamat` text,
  `telp` char(20) DEFAULT '',
  `rektor` varchar(255) DEFAULT '',
  `wakil_rektor1` varchar(255) DEFAULT '',
  `wakil_rektor2` varchar(255) DEFAULT '',
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `web_lang`
--

CREATE TABLE IF NOT EXISTS `web_lang` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `code` varchar(150) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `lang` enum('id','en') DEFAULT 'id',
  `tipe` enum('view_file','menu') DEFAULT 'view_file',
  `view_folder` varchar(100) DEFAULT NULL,
  `view_filename` varchar(120) DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `web_lang`
--

INSERT INTO `web_lang` (`id`, `code`, `value`, `lang`, `tipe`, `view_folder`, `view_filename`, `last_update`) VALUES
(1, 'lang_please_singin', 'Silakan Login', 'id', 'view_file', '', 'form_login', '2013-02-22 20:16:35'),
(2, 'lang_email_address', 'Alamat Email', 'id', 'view_file', NULL, 'form_login', '2013-02-22 20:16:35'),
(3, 'lang_password', 'Password', 'id', 'view_file', NULL, 'form_login', '2013-02-22 20:16:36'),
(4, 'lang_remember', 'Ingat Aku', 'id', 'view_file', NULL, 'form_login', '2013-02-22 20:16:36'),
(5, 'lang_login', 'Login', 'id', 'view_file', NULL, 'form_login', '2013-02-22 20:16:37'),
(6, 'lang_login_form', 'Login', 'id', 'menu', NULL, NULL, '2013-02-22 17:45:23'),
(7, 'lang_home', 'Home', 'id', 'menu', NULL, NULL, '2013-02-22 17:46:00');

-- --------------------------------------------------------

--
-- Table structure for table `web_permission`
--

CREATE TABLE IF NOT EXISTS `web_permission` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `parent_model` varchar(150) DEFAULT NULL,
  `model` varchar(150) DEFAULT NULL,
  `method` varchar(150) DEFAULT NULL,
  `permission` enum('umum','siswa','admin') DEFAULT 'umum',
  `role` enum('masteradmin','web_admin','operator') DEFAULT NULL,
  `urutan` int(3) DEFAULT NULL,
  `is_visible` enum('Y','N') DEFAULT 'N',
  `is_active` enum('Y','N') DEFAULT 'Y',
  `last_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `web_permission`
--

INSERT INTO `web_permission` (`id`, `parent_model`, `model`, `method`, `permission`, `role`, `urutan`, `is_visible`, `is_active`, `last_update`) VALUES
(2, NULL, 'mahasiswa', 'login_form', 'umum', NULL, 2, 'Y', 'Y', '2013-02-22 19:48:26'),
(3, NULL, 'common', 'homepage', 'umum', NULL, NULL, 'N', 'Y', '2013-02-20 22:46:30'),
(4, NULL, '', 'home', 'umum', NULL, 1, 'Y', 'Y', '2013-02-22 18:19:03'),
(5, NULL, 'buku_tamu', 'form_buku_tamu', 'umum', NULL, NULL, 'N', 'Y', '2013-02-22 19:12:10'),
(6, NULL, 'buku_tamu', 'simpan_komentar', 'umum', NULL, NULL, 'N', 'Y', '2013-02-22 19:12:20');

-- --------------------------------------------------------

--
-- Table structure for table `weekday`
--

CREATE TABLE IF NOT EXISTS `weekday` (
  `id` tinyint(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `weekday`
--

INSERT INTO `weekday` (`id`, `nama`) VALUES
(1, 'Senin'),
(2, 'Selasa'),
(3, 'Rabu'),
(4, 'Kamis'),
(5, 'Jumat'),
(6, 'Sabtu'),
(7, 'Sabtu');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

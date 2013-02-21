/*
Navicat MySQL Data Transfer

Source Server         : lokal
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : siska

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2013-02-21 21:08:20
*/

SET FOREIGN_KEY_CHECKS=0;

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
  `view_folder` varchar(100) DEFAULT NULL,
  `view_filename` varchar(120) DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of web_lang
-- ----------------------------
INSERT INTO `web_lang` VALUES ('1', 'lang_please_singin', 'Silakan Login', 'id', 'view_file', '', 'login_form', '2013-02-21 06:22:12');
INSERT INTO `web_lang` VALUES ('2', 'lang_email_address', 'Alamat Email', 'id', 'view_file', null, 'login_form', '2013-02-21 06:44:35');
INSERT INTO `web_lang` VALUES ('3', 'lang_password', 'Password', 'id', 'view_file', null, 'login_form', '2013-02-21 06:44:52');
INSERT INTO `web_lang` VALUES ('4', 'lang_remember', 'Ingat Aku', 'id', 'view_file', null, 'login_form', '2013-02-21 06:45:43');
INSERT INTO `web_lang` VALUES ('5', 'lang_login', 'Login', 'id', 'view_file', null, 'login_form', '2013-02-21 06:47:17');

-- ----------------------------
-- Table structure for `web_permission`
-- ----------------------------
DROP TABLE IF EXISTS `web_permission`;
CREATE TABLE `web_permission` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `parent_model` varchar(150) DEFAULT NULL,
  `model` varchar(150) DEFAULT NULL,
  `method` varchar(150) DEFAULT NULL,
  `permission` enum('umum','siswa','admin') DEFAULT 'umum',
  `role` enum('masteradmin','web_admin','operator') DEFAULT NULL,
  `is_visible` enum('Y','N') DEFAULT 'N',
  `is_active` enum('Y','N') DEFAULT 'Y',
  `last_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of web_permission
-- ----------------------------
INSERT INTO `web_permission` VALUES ('2', null, 'siswa', 'login_form', 'umum', null, 'N', 'Y', '2013-02-21 05:41:25');
INSERT INTO `web_permission` VALUES ('3', null, 'common', 'homepage', 'umum', null, 'N', 'Y', '2013-02-21 05:46:30');

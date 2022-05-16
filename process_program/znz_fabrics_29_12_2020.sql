/*
Navicat MySQL Data Transfer

Source Server         : MySQLDatabase
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : znz_fabrics

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-12-29 11:08:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `adding_process_to_version`
-- ----------------------------
DROP TABLE IF EXISTS `adding_process_to_version`;
CREATE TABLE `adding_process_to_version` (
  `process_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `version_id` varchar(15) NOT NULL,
  `pp_num_id` varchar(15) NOT NULL,
  `pp_number` varchar(100) NOT NULL,
  `version_name` varchar(100) NOT NULL,
  `color` varchar(20) NOT NULL,
  `process_name` varchar(250) NOT NULL,
  `process_serial_no` int(11) NOT NULL,
  `checking_field` varchar(250) NOT NULL,
  `recording_person_id` varchar(30) NOT NULL,
  `recording_person_name` varchar(50) NOT NULL,
  `recording_time` datetime NOT NULL,
  PRIMARY KEY (`process_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;



-- ----------------------------
-- Records of adding_process_to_version
-- ----------------------------
INSERT INTO `adding_process_to_version` VALUES ('1', 'version_27', 'ppnumber_3', '5893/2020', 'Pillow Back', 'Beige', 'Washing', '1', '1', 'iftekhar', 'iftekhar', '2020-12-15 12:56:43');
INSERT INTO `adding_process_to_version` VALUES ('2', 'version_27', 'ppnumber_3', '5893/2020', 'Pillow Back', 'Beige', 'Singeing & Desizing', '2', '1', 'iftekhar', 'iftekhar', '2020-12-15 12:56:43');
INSERT INTO `adding_process_to_version` VALUES ('3', 'version_27', 'ppnumber_3', '5893/2020', 'Pillow Back', 'Beige', 'Sanforizing', '3', '1', 'iftekhar', 'iftekhar', '2020-12-15 12:56:43');
INSERT INTO `adding_process_to_version` VALUES ('4', 'version_2', 'ppnumber_3', '6038/2020', 'Reverse', 'Dk. Blue', 'Steaming', '1', '1', 'iftekhar', 'iftekhar', '2020-12-20 13:33:26');
INSERT INTO `adding_process_to_version` VALUES ('5', 'version_2', 'ppnumber_3', '6038/2020', 'Reverse', 'Dk. Blue', 'Singeing & Desizing', '2', '1', 'iftekhar', 'iftekhar', '2020-12-20 13:33:26');
INSERT INTO `adding_process_to_version` VALUES ('6', 'version_2', 'ppnumber_3', '6038/2020', 'Reverse', 'Dk. Blue', 'Scouring & Bleaching', '3', '1', 'iftekhar', 'iftekhar', '2020-12-20 13:33:26');
INSERT INTO `adding_process_to_version` VALUES ('7', 'version_5', 'ppnumber_3', '6038/2020', 'Reverse', 'Light Blue', 'Bleaching', '1', '1', 'iftekhar', 'iftekhar', '2020-12-23 11:50:16');
INSERT INTO `adding_process_to_version` VALUES ('8', 'version_5', 'ppnumber_3', '6038/2020', 'Reverse', 'Light Blue', 'Calander', '2', '1', 'iftekhar', 'iftekhar', '2020-12-23 11:50:16');
INSERT INTO `adding_process_to_version` VALUES ('9', 'version_5', 'ppnumber_3', '6038/2020', 'Reverse', 'Light Blue', 'Curing', '3', '1', 'iftekhar', 'iftekhar', '2020-12-23 11:50:16');
INSERT INTO `adding_process_to_version` VALUES ('10', 'version_28', 'ppnumber_3', '5893/2020', 'Pillow Front', 'Beige', 'Bleaching', '1', '1', 'iftekhar', 'iftekhar', '2020-12-23 12:40:09');
INSERT INTO `adding_process_to_version` VALUES ('11', 'version_28', 'ppnumber_3', '5893/2020', 'Pillow Front', 'Beige', 'Dyeing', '2', '1', 'iftekhar', 'iftekhar', '2020-12-23 12:40:09');

-- ----------------------------
-- Table structure for `adding_process_to_version_bkup_02`
-- ----------------------------
DROP TABLE IF EXISTS `adding_process_to_version_bkup_02`;
CREATE TABLE `adding_process_to_version_bkup_02` (
  `process_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `version_id` varchar(15) DEFAULT NULL,
  `pp_num_id` varchar(15) DEFAULT NULL,
  `pp_number` varchar(100) DEFAULT NULL,
  `version_name` varchar(100) DEFAULT NULL,
  `process_name` varchar(250) DEFAULT NULL,
  `process_serial_no` int(11) NOT NULL,
  `checking_field` varchar(250) NOT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`process_id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of adding_process_to_version_bkup_02
-- ----------------------------
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('1', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?White?fs?111?fs?Walmart', 'Singeing-Desizing', '1', '1', 'qc', 'qc', '2020-11-30 21:00:42');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('2', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?White?fs?111?fs?Walmart', 'Scouring & Bleaching', '2', '1', 'qc', 'qc', '2020-11-30 21:00:42');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('3', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?White?fs?111?fs?Walmart', 'Finishing', '3', '1', 'qc', 'qc', '2020-11-30 21:00:42');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('4', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Light Grey?fs?111?fs?Walmart', 'Singeing & Desizing', '1', '1', 'qc', 'qc', '2020-11-30 21:09:34');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('5', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Light Grey?fs?111?fs?Walmart', 'Scouring & Bleaching', '2', '1', 'qc', 'qc', '2020-11-30 21:09:34');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('6', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Light Grey?fs?111?fs?Walmart', 'Finishing', '4', '1', 'qc', 'qc', '2020-11-30 21:09:34');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('7', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Light Grey?fs?111?fs?Walmart', 'Ready For Dyeing', '3', '1', 'qc', 'qc', '2020-11-30 21:09:34');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('8', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Tan?fs?111?fs?Walmart', 'Singeing & Desizing', '1', '1', 'qc', 'qc', '2020-11-30 21:19:54');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('9', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Tan?fs?111?fs?Walmart', 'Scouring & Bleaching', '2', '1', 'qc', 'qc', '2020-11-30 21:19:54');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('10', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Tan?fs?111?fs?Walmart', 'Finishing', '4', '1', 'qc', 'qc', '2020-11-30 21:19:54');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('11', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Tan?fs?111?fs?Walmart', 'Ready For Dyeing', '3', '1', 'qc', 'qc', '2020-11-30 21:19:54');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('12', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?White?fs?106?fs?Walmart', 'Singeing-Desizing', '1', '1', 'qc', 'qc', '2020-11-30 21:20:13');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('13', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?White?fs?106?fs?Walmart', 'Scouring & Bleaching', '2', '1', 'qc', 'qc', '2020-11-30 21:20:13');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('14', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?White?fs?106?fs?Walmart', 'Finishing', '3', '1', 'qc', 'qc', '2020-11-30 21:20:13');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('15', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Pink?fs?106?fs?Walmart', 'Singeing & Desizing', '1', '1', 'qc', 'qc', '2020-11-30 21:20:30');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('16', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Pink?fs?106?fs?Walmart', 'Scouring & Bleaching', '2', '1', 'qc', 'qc', '2020-11-30 21:20:30');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('17', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Pink?fs?106?fs?Walmart', 'Finishing', '4', '1', 'qc', 'qc', '2020-11-30 21:20:30');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('18', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Pink?fs?106?fs?Walmart', 'Ready For Dyeing', '3', '1', 'qc', 'qc', '2020-11-30 21:20:30');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('19', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Light Grey?fs?106?fs?Walmart', 'Singeing & Desizing', '1', '1', 'qc', 'qc', '2020-11-30 21:20:54');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('20', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Light Grey?fs?106?fs?Walmart', 'Scouring & Bleaching', '2', '1', 'qc', 'qc', '2020-11-30 21:20:54');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('21', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Light Grey?fs?106?fs?Walmart', 'Finishing', '4', '1', 'qc', 'qc', '2020-11-30 21:20:54');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('22', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Light Grey?fs?106?fs?Walmart', 'Ready For Dyeing', '3', '1', 'qc', 'qc', '2020-11-30 21:20:54');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('23', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Red?fs?111?fs?Walmart', 'Singeing & Desizing', '1', '1', 'qc', 'qc', '2020-11-30 21:22:18');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('24', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Red?fs?111?fs?Walmart', 'Scouring & Bleaching', '2', '1', 'qc', 'qc', '2020-11-30 21:22:18');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('25', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Red?fs?111?fs?Walmart', 'Finishing', '7', '1', 'qc', 'qc', '2020-11-30 21:22:18');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('26', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Red?fs?111?fs?Walmart', 'Ready For Dyeing', '5', '1', 'qc', 'qc', '2020-11-30 21:22:18');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('27', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Red?fs?111?fs?Walmart', 'Ready for Mercerize', '3', '1', 'qc', 'qc', '2020-11-30 21:22:18');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('28', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Red?fs?111?fs?Walmart', 'Mercerizing', '4', '1', 'qc', 'qc', '2020-11-30 21:22:18');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('29', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Red?fs?111?fs?Walmart', 'Dyeing', '6', '1', 'qc', 'qc', '2020-11-30 21:22:18');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('30', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Red?fs?106?fs?Walmart', 'Singeing & Desizing', '1', '1', 'qc', 'qc', '2020-11-30 21:22:23');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('31', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Red?fs?106?fs?Walmart', 'Scouring & Bleaching', '2', '1', 'qc', 'qc', '2020-11-30 21:22:23');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('32', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Red?fs?106?fs?Walmart', 'Finishing', '7', '1', 'qc', 'qc', '2020-11-30 21:22:23');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('33', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Red?fs?106?fs?Walmart', 'Ready For Dyeing', '5', '1', 'qc', 'qc', '2020-11-30 21:22:23');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('34', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Red?fs?106?fs?Walmart', 'Ready for Mercerize', '3', '1', 'qc', 'qc', '2020-11-30 21:22:23');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('35', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Red?fs?106?fs?Walmart', 'Mercerizing', '4', '1', 'qc', 'qc', '2020-11-30 21:22:23');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('36', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Red?fs?106?fs?Walmart', 'Dyeing', '6', '1', 'qc', 'qc', '2020-11-30 21:22:23');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('37', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Aqua?fs?106?fs?Walmart', 'Singeing & Desizing', '1', '1', 'qc', 'qc', '2020-11-30 21:22:41');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('38', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Aqua?fs?106?fs?Walmart', 'Scouring & Bleaching', '2', '1', 'qc', 'qc', '2020-11-30 21:22:41');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('39', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Aqua?fs?106?fs?Walmart', 'Finishing', '7', '1', 'qc', 'qc', '2020-11-30 21:22:41');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('40', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Aqua?fs?106?fs?Walmart', 'Ready For Dyeing', '5', '1', 'qc', 'qc', '2020-11-30 21:22:41');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('41', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Aqua?fs?106?fs?Walmart', 'Ready for Mercerize', '3', '1', 'qc', 'qc', '2020-11-30 21:22:41');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('42', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Aqua?fs?106?fs?Walmart', 'Mercerizing', '4', '1', 'qc', 'qc', '2020-11-30 21:22:41');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('43', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Aqua?fs?106?fs?Walmart', 'Dyeing', '6', '1', 'qc', 'qc', '2020-11-30 21:22:41');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('44', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Black?fs?111?fs?Walmart', 'Singeing & Desizing', '1', '1', 'qc', 'qc', '2020-11-30 21:22:54');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('45', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Black?fs?111?fs?Walmart', 'Scouring & Bleaching', '2', '1', 'qc', 'qc', '2020-11-30 21:22:54');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('46', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Black?fs?111?fs?Walmart', 'Finishing', '7', '1', 'qc', 'qc', '2020-11-30 21:22:54');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('47', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Black?fs?111?fs?Walmart', 'Ready For Dyeing', '5', '1', 'qc', 'qc', '2020-11-30 21:22:54');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('48', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Black?fs?111?fs?Walmart', 'Ready for Mercerize', '3', '1', 'qc', 'qc', '2020-11-30 21:22:54');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('49', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Black?fs?111?fs?Walmart', 'Mercerizing', '4', '1', 'qc', 'qc', '2020-11-30 21:22:54');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('50', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Black?fs?111?fs?Walmart', 'Dyeing', '6', '1', 'qc', 'qc', '2020-11-30 21:22:54');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('51', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Black?fs?106?fs?Walmart', 'Singeing & Desizing', '1', '1', 'qc', 'qc', '2020-11-30 21:22:58');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('52', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Black?fs?106?fs?Walmart', 'Scouring & Bleaching', '2', '1', 'qc', 'qc', '2020-11-30 21:22:58');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('53', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Black?fs?106?fs?Walmart', 'Finishing', '7', '1', 'qc', 'qc', '2020-11-30 21:22:58');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('54', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Black?fs?106?fs?Walmart', 'Ready For Dyeing', '5', '1', 'qc', 'qc', '2020-11-30 21:22:58');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('55', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Black?fs?106?fs?Walmart', 'Ready for Mercerize', '3', '1', 'qc', 'qc', '2020-11-30 21:22:58');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('56', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Black?fs?106?fs?Walmart', 'Mercerizing', '4', '1', 'qc', 'qc', '2020-11-30 21:22:58');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('57', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Black?fs?106?fs?Walmart', 'Dyeing', '6', '1', 'qc', 'qc', '2020-11-30 21:22:58');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('58', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Blue?fs?111?fs?Walmart', 'Singeing & Desizing', '1', '1', 'qc', 'qc', '2020-11-30 21:25:23');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('59', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Blue?fs?111?fs?Walmart', 'Scouring & Bleaching', '2', '1', 'qc', 'qc', '2020-11-30 21:25:23');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('60', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Blue?fs?111?fs?Walmart', 'Finishing', '7', '1', 'qc', 'qc', '2020-11-30 21:25:23');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('61', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Blue?fs?111?fs?Walmart', 'Ready For Dyeing', '5', '1', 'qc', 'qc', '2020-11-30 21:25:23');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('62', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Blue?fs?111?fs?Walmart', 'Ready for Mercerize', '3', '1', 'qc', 'qc', '2020-11-30 21:25:23');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('63', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Blue?fs?111?fs?Walmart', 'Mercerizing', '4', '1', 'qc', 'qc', '2020-11-30 21:25:23');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('64', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Blue?fs?111?fs?Walmart', 'Dyeing', '6', '1', 'qc', 'qc', '2020-11-30 21:25:23');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('65', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Blue?fs?106?fs?Walmart', 'Singeing & Desizing', '1', '1', 'qc', 'qc', '2020-11-30 21:25:28');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('66', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Blue?fs?106?fs?Walmart', 'Scouring & Bleaching', '2', '1', 'qc', 'qc', '2020-11-30 21:25:28');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('67', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Blue?fs?106?fs?Walmart', 'Finishing', '7', '1', 'qc', 'qc', '2020-11-30 21:25:28');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('68', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Blue?fs?106?fs?Walmart', 'Ready For Dyeing', '5', '1', 'qc', 'qc', '2020-11-30 21:25:28');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('69', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Blue?fs?106?fs?Walmart', 'Ready for Mercerize', '3', '1', 'qc', 'qc', '2020-11-30 21:25:28');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('70', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Blue?fs?106?fs?Walmart', 'Mercerizing', '4', '1', 'qc', 'qc', '2020-11-30 21:25:28');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('71', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Blue?fs?106?fs?Walmart', 'Dyeing', '6', '1', 'qc', 'qc', '2020-11-30 21:25:28');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('72', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Grey?fs?111?fs?Walmart', 'Singeing & Desizing', '1', '1', 'qc', 'qc', '2020-11-30 21:25:38');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('73', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Grey?fs?111?fs?Walmart', 'Scouring & Bleaching', '2', '1', 'qc', 'qc', '2020-11-30 21:25:38');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('74', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Grey?fs?111?fs?Walmart', 'Finishing', '7', '1', 'qc', 'qc', '2020-11-30 21:25:38');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('75', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Grey?fs?111?fs?Walmart', 'Ready For Dyeing', '5', '1', 'qc', 'qc', '2020-11-30 21:25:38');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('76', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Grey?fs?111?fs?Walmart', 'Ready for Mercerize', '3', '1', 'qc', 'qc', '2020-11-30 21:25:38');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('77', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Grey?fs?111?fs?Walmart', 'Mercerizing', '4', '1', 'qc', 'qc', '2020-11-30 21:25:38');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('78', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Grey?fs?111?fs?Walmart', 'Dyeing', '6', '1', 'qc', 'qc', '2020-11-30 21:25:38');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('79', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Grey?fs?106?fs?Walmart', 'Singeing & Desizing', '1', '1', 'qc', 'qc', '2020-11-30 21:25:43');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('80', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Grey?fs?106?fs?Walmart', 'Scouring & Bleaching', '2', '1', 'qc', 'qc', '2020-11-30 21:25:43');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('81', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Grey?fs?106?fs?Walmart', 'Finishing', '7', '1', 'qc', 'qc', '2020-11-30 21:25:43');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('82', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Grey?fs?106?fs?Walmart', 'Ready For Dyeing', '5', '1', 'qc', 'qc', '2020-11-30 21:25:43');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('83', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Grey?fs?106?fs?Walmart', 'Ready for Mercerize', '3', '1', 'qc', 'qc', '2020-11-30 21:25:43');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('84', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Grey?fs?106?fs?Walmart', 'Mercerizing', '4', '1', 'qc', 'qc', '2020-11-30 21:25:43');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('85', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Grey?fs?106?fs?Walmart', 'Dyeing', '6', '1', 'qc', 'qc', '2020-11-30 21:25:43');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('86', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Light Blue?fs?111?fs?Walmart', 'Singeing & Desizing', '1', '1', 'qc', 'qc', '2020-11-30 21:26:18');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('87', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Light Blue?fs?111?fs?Walmart', 'Scouring & Bleaching', '2', '1', 'qc', 'qc', '2020-11-30 21:26:18');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('88', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Light Blue?fs?111?fs?Walmart', 'Finishing', '4', '1', 'qc', 'qc', '2020-11-30 21:26:18');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('89', 'versionnum_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet?fs?Light Blue?fs?111?fs?Walmart', 'Ready For Dyeing', '3', '1', 'qc', 'qc', '2020-11-30 21:26:18');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('90', 'versionnum_9', 'ppnumber_3', '6038/2020', 'Front?fs?Light Blue?fs?62?fs?Ikea', 'Singeing & Desizing', '8', '1', '004143', 'Md. Jiash Hasnat', '2020-12-01 10:45:48');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('91', 'versionnum_9', 'ppnumber_3', '6038/2020', 'Front?fs?Light Blue?fs?62?fs?Ikea', 'Scouring & Bleaching', '7', '1', '004143', 'Md. Jiash Hasnat', '2020-12-01 10:45:48');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('92', 'versionnum_9', 'ppnumber_3', '6038/2020', 'Front?fs?Light Blue?fs?62?fs?Ikea', 'Ready For Print', '6', '1', '004143', 'Md. Jiash Hasnat', '2020-12-01 10:45:48');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('93', 'versionnum_9', 'ppnumber_3', '6038/2020', 'Front?fs?Light Blue?fs?62?fs?Ikea', 'Printing', '5', '1', '004143', 'Md. Jiash Hasnat', '2020-12-01 10:45:48');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('94', 'versionnum_9', 'ppnumber_3', '6038/2020', 'Front?fs?Light Blue?fs?62?fs?Ikea', 'Curing', '4', '1', '004143', 'Md. Jiash Hasnat', '2020-12-01 10:45:48');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('95', 'versionnum_9', 'ppnumber_3', '6038/2020', 'Front?fs?Light Blue?fs?62?fs?Ikea', 'Finishing', '3', '1', '004143', 'Md. Jiash Hasnat', '2020-12-01 10:45:48');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('96', 'versionnum_9', 'ppnumber_3', '6038/2020', 'Front?fs?Light Blue?fs?62?fs?Ikea', 'Calendering', '2', '1', '004143', 'Md. Jiash Hasnat', '2020-12-01 10:45:48');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('97', 'versionnum_9', 'ppnumber_3', '6038/2020', 'Front?fs?Light Blue?fs?62?fs?Ikea', 'Sanforizing', '1', '1', '004143', 'Md. Jiash Hasnat', '2020-12-01 10:45:48');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('98', 'versionnum_9', 'ppnumber_3', '6038/2020', 'Reverse?fs?Dk. Blue?fs?62?fs?Ikea', 'Printing', '1', '1', '004143', 'Md. Jiash Hasnat', '2020-12-01 10:48:35');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('99', 'versionnum_9', 'ppnumber_3', '6038/2020', 'Reverse?fs?Dk. Blue?fs?62?fs?Ikea', 'Curing', '2', '1', '004143', 'Md. Jiash Hasnat', '2020-12-01 10:48:35');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('100', 'versionnum_9', 'ppnumber_3', '6038/2020', 'Reverse?fs?Dk. Blue?fs?62?fs?Ikea', 'Singeing-Desizing', '3', '1', '004143', 'Md. Jiash Hasnat', '2020-12-01 10:48:35');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('101', 'versionnum_9', 'ppnumber_3', '6038/2020', 'Reverse?fs?Dk. Blue?fs?62?fs?Ikea', 'Scouring & Bleaching', '4', '1', '004143', 'Md. Jiash Hasnat', '2020-12-01 10:48:35');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('102', 'versionnum_9', 'ppnumber_3', '6038/2020', 'Reverse?fs?Dk. Blue?fs?62?fs?Ikea', 'Ready For Print', '5', '1', '004143', 'Md. Jiash Hasnat', '2020-12-01 10:48:35');
INSERT INTO `adding_process_to_version_bkup_02` VALUES ('103', 'versionnum_9', 'ppnumber_3', '6038/2020', 'Reverse?fs?Dk. Blue?fs?62?fs?Ikea', 'Sanforizing', '6', '1', '004143', 'Md. Jiash Hasnat', '2020-12-01 10:48:35');

-- ----------------------------
-- Table structure for `color`
-- ----------------------------
DROP TABLE IF EXISTS `color`;
CREATE TABLE `color` (
  `row_id` int(10) NOT NULL,
  `color_id` varchar(15) NOT NULL,
  `color_name` varchar(50) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`color_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of color
-- ----------------------------
INSERT INTO `color` VALUES ('1', 'color_1', 'White', 'qc', 'qc', '2020-11-30 15:54:16');
INSERT INTO `color` VALUES ('10', 'color_10', 'Rose', 'qc', 'qc', '2020-11-30 15:58:31');
INSERT INTO `color` VALUES ('11', 'color_11', 'Light Grey', 'qc', 'qc', '2020-11-30 17:50:57');
INSERT INTO `color` VALUES ('12', 'color_12', 'Tan', 'qc', 'qc', '2020-11-30 17:51:04');
INSERT INTO `color` VALUES ('13', 'color_13', 'Aqua', 'qc', 'qc', '2020-11-30 17:51:47');
INSERT INTO `color` VALUES ('14', 'color_14', 'Black', 'qc', 'qc', '2020-11-30 17:51:53');
INSERT INTO `color` VALUES ('15', 'color_15', 'Light Blue', 'qc', 'qc', '2020-11-30 17:52:15');
INSERT INTO `color` VALUES ('16', 'color_16', 'Dk. Blue', 'qc', 'qc', '2020-11-30 18:14:53');
INSERT INTO `color` VALUES ('17', 'color_17', 'Dk. Grey', 'qc', 'qc', '2020-11-30 18:15:33');
INSERT INTO `color` VALUES ('18', 'color_18', 'Grey', 'qc', 'qc', '2020-11-30 20:53:16');
INSERT INTO `color` VALUES ('2', 'color_2', 'Multi', 'qc', 'qc', '2020-11-30 15:54:42');
INSERT INTO `color` VALUES ('3', 'color_3', 'Red', 'qc', 'qc', '2020-11-30 15:54:59');
INSERT INTO `color` VALUES ('4', 'color_4', 'Green', 'qc', 'qc', '2020-11-30 15:55:09');
INSERT INTO `color` VALUES ('5', 'color_5', 'Blue', 'qc', 'qc', '2020-11-30 15:55:16');
INSERT INTO `color` VALUES ('6', 'color_6', 'Beige', 'qc', 'qc', '2020-11-30 15:55:45');
INSERT INTO `color` VALUES ('7', 'color_7', 'Yellow', 'qc', 'qc', '2020-11-30 15:56:21');
INSERT INTO `color` VALUES ('8', 'color_8', 'Orange', 'qc', 'qc', '2020-11-30 15:57:20');
INSERT INTO `color` VALUES ('9', 'color_9', 'Pink', 'qc', 'qc', '2020-11-30 15:58:10');

-- ----------------------------
-- Table structure for `construction_for_version`
-- ----------------------------
DROP TABLE IF EXISTS `construction_for_version`;
CREATE TABLE `construction_for_version` (
  `row_id` int(10) unsigned NOT NULL,
  `construction_id` varchar(15) NOT NULL,
  `warp_yarn_count` int(11) DEFAULT NULL,
  `no_of_ply_for_warp_yarn` int(11) DEFAULT NULL,
  `uom_of_warp_yarn` varchar(20) DEFAULT NULL,
  `weft_yarn_count` int(11) DEFAULT NULL,
  `no_of_ply_for_weft_yarn` int(11) DEFAULT NULL,
  `uom_of_weft_yarn` varchar(20) DEFAULT NULL,
  `no_of_threads_per_inch_in_warp` int(11) DEFAULT NULL,
  `warp_insertion` int(11) DEFAULT NULL,
  `no_of_threads_per_inch_in_weft` int(11) DEFAULT NULL,
  `weft_insertion` int(11) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`construction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of construction_for_version
-- ----------------------------
INSERT INTO `construction_for_version` VALUES ('1', 'constructver_1', '30', '1', 'Ne', '30', '1', 'Ne', '86', '1', '66', '1', 'qc', 'qc', '2020-11-30 17:48:24');
INSERT INTO `construction_for_version` VALUES ('2', 'constructver_2', '40', '1', 'Ne', '40', '1', 'Ne', '110', '1', '64', '1', 'qc', 'qc', '2020-11-30 17:59:28');
INSERT INTO `construction_for_version` VALUES ('3', 'constructver_3', '40', '1', 'Ne', '40', '1', 'Ne', '110', '1', '62', '1', 'qc', 'qc', '2020-11-30 18:01:55');
INSERT INTO `construction_for_version` VALUES ('4', 'constructver_4', '30', '1', 'Ne', '30', '1', 'Ne', '96', '1', '70', '1', 'qc', 'qc', '2020-12-01 09:47:57');
INSERT INTO `construction_for_version` VALUES ('5', 'constructver_5', '40', '2', 'Ne', '40', '1', 'Den', '110', '1', '64', '1', '004143', 'Md. Jiash Hasnat', '2020-12-01 10:35:16');
INSERT INTO `construction_for_version` VALUES ('6', 'constructver_6', '40', '2', 'Ne', '40', '1', 'Den', '110', '1', '64', '2', '004143', 'Md. Jiash Hasnat', '2020-12-01 10:35:38');
INSERT INTO `construction_for_version` VALUES ('7', 'constructver_7', '30', '4', 'Den', '50', '3', 'Tex', '30', '2', '30', '2', 'iftekhar', 'iftekhar', '2020-12-23 15:54:26');

-- ----------------------------
-- Table structure for `country`
-- ----------------------------
DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `iso` char(2) NOT NULL,
  `name_of_country` varchar(80) NOT NULL,
  `short_code` char(3) DEFAULT NULL,
  `number_code` smallint(6) DEFAULT NULL,
  `phone_code` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of country
-- ----------------------------
INSERT INTO `country` VALUES ('1', 'AF', 'Afghanistan', 'AFG', '4', '93');
INSERT INTO `country` VALUES ('2', 'AL', 'Albania', 'ALB', '8', '355');
INSERT INTO `country` VALUES ('3', 'DZ', 'Algeria', 'DZA', '12', '213');
INSERT INTO `country` VALUES ('4', 'AS', 'American Samoa', 'ASM', '16', '1684');
INSERT INTO `country` VALUES ('5', 'AD', 'Andorra', 'AND', '20', '376');
INSERT INTO `country` VALUES ('6', 'AO', 'Angola', 'AGO', '24', '244');
INSERT INTO `country` VALUES ('7', 'AI', 'Anguilla', 'AIA', '660', '1264');
INSERT INTO `country` VALUES ('8', 'AQ', 'Antarctica', null, null, '0');
INSERT INTO `country` VALUES ('9', 'AG', 'Antigua and Barbuda', 'ATG', '28', '1268');
INSERT INTO `country` VALUES ('10', 'AR', 'Argentina', 'ARG', '32', '54');
INSERT INTO `country` VALUES ('11', 'AM', 'Armenia', 'ARM', '51', '374');
INSERT INTO `country` VALUES ('12', 'AW', 'Aruba', 'ABW', '533', '297');
INSERT INTO `country` VALUES ('13', 'AU', 'Australia', 'AUS', '36', '61');
INSERT INTO `country` VALUES ('14', 'AT', 'Austria', 'AUT', '40', '43');
INSERT INTO `country` VALUES ('15', 'AZ', 'Azerbaijan', 'AZE', '31', '994');
INSERT INTO `country` VALUES ('16', 'BS', 'Bahamas', 'BHS', '44', '1242');
INSERT INTO `country` VALUES ('17', 'BH', 'Bahrain', 'BHR', '48', '973');
INSERT INTO `country` VALUES ('18', 'BD', 'Bangladesh', 'BGD', '50', '880');
INSERT INTO `country` VALUES ('19', 'BB', 'Barbados', 'BRB', '52', '1246');
INSERT INTO `country` VALUES ('20', 'BY', 'Belarus', 'BLR', '112', '375');
INSERT INTO `country` VALUES ('21', 'BE', 'Belgium', 'BEL', '56', '32');
INSERT INTO `country` VALUES ('22', 'BZ', 'Belize', 'BLZ', '84', '501');
INSERT INTO `country` VALUES ('23', 'BJ', 'Benin', 'BEN', '204', '229');
INSERT INTO `country` VALUES ('24', 'BM', 'Bermuda', 'BMU', '60', '1441');
INSERT INTO `country` VALUES ('25', 'BT', 'Bhutan', 'BTN', '64', '975');
INSERT INTO `country` VALUES ('26', 'BO', 'Bolivia', 'BOL', '68', '591');
INSERT INTO `country` VALUES ('27', 'BA', 'Bosnia and Herzegovina', 'BIH', '70', '387');
INSERT INTO `country` VALUES ('28', 'BW', 'Botswana', 'BWA', '72', '267');
INSERT INTO `country` VALUES ('29', 'BV', 'Bouvet Island', null, null, '0');
INSERT INTO `country` VALUES ('30', 'BR', 'Brazil', 'BRA', '76', '55');
INSERT INTO `country` VALUES ('31', 'IO', 'British Indian Ocean Territory', null, null, '246');
INSERT INTO `country` VALUES ('32', 'BN', 'Brunei Darussalam', 'BRN', '96', '673');
INSERT INTO `country` VALUES ('33', 'BG', 'Bulgaria', 'BGR', '100', '359');
INSERT INTO `country` VALUES ('34', 'BF', 'Burkina Faso', 'BFA', '854', '226');
INSERT INTO `country` VALUES ('35', 'BI', 'Burundi', 'BDI', '108', '257');
INSERT INTO `country` VALUES ('36', 'KH', 'Cambodia', 'KHM', '116', '855');
INSERT INTO `country` VALUES ('37', 'CM', 'Cameroon', 'CMR', '120', '237');
INSERT INTO `country` VALUES ('38', 'CA', 'Canada', 'CAN', '124', '1');
INSERT INTO `country` VALUES ('39', 'CV', 'Cape Verde', 'CPV', '132', '238');
INSERT INTO `country` VALUES ('40', 'KY', 'Cayman Islands', 'CYM', '136', '1345');
INSERT INTO `country` VALUES ('41', 'CF', 'Central African Republic', 'CAF', '140', '236');
INSERT INTO `country` VALUES ('42', 'TD', 'Chad', 'TCD', '148', '235');
INSERT INTO `country` VALUES ('43', 'CL', 'Chile', 'CHL', '152', '56');
INSERT INTO `country` VALUES ('44', 'CN', 'China', 'CHN', '156', '86');
INSERT INTO `country` VALUES ('45', 'CX', 'Christmas Island', null, null, '61');
INSERT INTO `country` VALUES ('46', 'CC', 'Cocos (Keeling) Islands', null, null, '672');
INSERT INTO `country` VALUES ('47', 'CO', 'Colombia', 'COL', '170', '57');
INSERT INTO `country` VALUES ('48', 'KM', 'Comoros', 'COM', '174', '269');
INSERT INTO `country` VALUES ('49', 'CG', 'Congo', 'COG', '178', '242');
INSERT INTO `country` VALUES ('50', 'CD', 'Congo, the Democratic Republic of the', 'COD', '180', '242');
INSERT INTO `country` VALUES ('51', 'CK', 'Cook Islands', 'COK', '184', '682');
INSERT INTO `country` VALUES ('52', 'CR', 'Costa Rica', 'CRI', '188', '506');
INSERT INTO `country` VALUES ('53', 'CI', 'Cote D\'Ivoire', 'CIV', '384', '225');
INSERT INTO `country` VALUES ('54', 'HR', 'Croatia', 'HRV', '191', '385');
INSERT INTO `country` VALUES ('55', 'CU', 'Cuba', 'CUB', '192', '53');
INSERT INTO `country` VALUES ('56', 'CY', 'Cyprus', 'CYP', '196', '357');
INSERT INTO `country` VALUES ('57', 'CZ', 'Czech Republic', 'CZE', '203', '420');
INSERT INTO `country` VALUES ('58', 'DK', 'Denmark', 'DNK', '208', '45');
INSERT INTO `country` VALUES ('59', 'DJ', 'Djibouti', 'DJI', '262', '253');
INSERT INTO `country` VALUES ('60', 'DM', 'Dominica', 'DMA', '212', '1767');
INSERT INTO `country` VALUES ('61', 'DO', 'Dominican Republic', 'DOM', '214', '1809');
INSERT INTO `country` VALUES ('62', 'EC', 'Ecuador', 'ECU', '218', '593');
INSERT INTO `country` VALUES ('63', 'EG', 'Egypt', 'EGY', '818', '20');
INSERT INTO `country` VALUES ('64', 'SV', 'El Salvador', 'SLV', '222', '503');
INSERT INTO `country` VALUES ('65', 'GQ', 'Equatorial Guinea', 'GNQ', '226', '240');
INSERT INTO `country` VALUES ('66', 'ER', 'Eritrea', 'ERI', '232', '291');
INSERT INTO `country` VALUES ('67', 'EE', 'Estonia', 'EST', '233', '372');
INSERT INTO `country` VALUES ('68', 'ET', 'Ethiopia', 'ETH', '231', '251');
INSERT INTO `country` VALUES ('69', 'FK', 'Falkland Islands (Malvinas)', 'FLK', '238', '500');
INSERT INTO `country` VALUES ('70', 'FO', 'Faroe Islands', 'FRO', '234', '298');
INSERT INTO `country` VALUES ('71', 'FJ', 'Fiji', 'FJI', '242', '679');
INSERT INTO `country` VALUES ('72', 'FI', 'Finland', 'FIN', '246', '358');
INSERT INTO `country` VALUES ('73', 'FR', 'France', 'FRA', '250', '33');
INSERT INTO `country` VALUES ('74', 'GF', 'French Guiana', 'GUF', '254', '594');
INSERT INTO `country` VALUES ('75', 'PF', 'French Polynesia', 'PYF', '258', '689');
INSERT INTO `country` VALUES ('76', 'TF', 'French Southern Territories', null, null, '0');
INSERT INTO `country` VALUES ('77', 'GA', 'Gabon', 'GAB', '266', '241');
INSERT INTO `country` VALUES ('78', 'GM', 'Gambia', 'GMB', '270', '220');
INSERT INTO `country` VALUES ('79', 'GE', 'Georgia', 'GEO', '268', '995');
INSERT INTO `country` VALUES ('80', 'DE', 'Germany', 'DEU', '276', '49');
INSERT INTO `country` VALUES ('81', 'GH', 'Ghana', 'GHA', '288', '233');
INSERT INTO `country` VALUES ('82', 'GI', 'Gibraltar', 'GIB', '292', '350');
INSERT INTO `country` VALUES ('83', 'GR', 'Greece', 'GRC', '300', '30');
INSERT INTO `country` VALUES ('84', 'GL', 'Greenland', 'GRL', '304', '299');
INSERT INTO `country` VALUES ('85', 'GD', 'Grenada', 'GRD', '308', '1473');
INSERT INTO `country` VALUES ('86', 'GP', 'Guadeloupe', 'GLP', '312', '590');
INSERT INTO `country` VALUES ('87', 'GU', 'Guam', 'GUM', '316', '1671');
INSERT INTO `country` VALUES ('88', 'GT', 'Guatemala', 'GTM', '320', '502');
INSERT INTO `country` VALUES ('89', 'GN', 'Guinea', 'GIN', '324', '224');
INSERT INTO `country` VALUES ('90', 'GW', 'Guinea-Bissau', 'GNB', '624', '245');
INSERT INTO `country` VALUES ('91', 'GY', 'Guyana', 'GUY', '328', '592');
INSERT INTO `country` VALUES ('92', 'HT', 'Haiti', 'HTI', '332', '509');
INSERT INTO `country` VALUES ('93', 'HM', 'Heard Island and Mcdonald Islands', null, null, '0');
INSERT INTO `country` VALUES ('94', 'VA', 'Holy See (Vatican City State)', 'VAT', '336', '39');
INSERT INTO `country` VALUES ('95', 'HN', 'Honduras', 'HND', '340', '504');
INSERT INTO `country` VALUES ('96', 'HK', 'Hong Kong', 'HKG', '344', '852');
INSERT INTO `country` VALUES ('97', 'HU', 'Hungary', 'HUN', '348', '36');
INSERT INTO `country` VALUES ('98', 'IS', 'Iceland', 'ISL', '352', '354');
INSERT INTO `country` VALUES ('99', 'IN', 'India', 'IND', '356', '91');
INSERT INTO `country` VALUES ('100', 'ID', 'Indonesia', 'IDN', '360', '62');
INSERT INTO `country` VALUES ('101', 'IR', 'Iran, Islamic Republic of', 'IRN', '364', '98');
INSERT INTO `country` VALUES ('102', 'IQ', 'Iraq', 'IRQ', '368', '964');
INSERT INTO `country` VALUES ('103', 'IE', 'Ireland', 'IRL', '372', '353');
INSERT INTO `country` VALUES ('104', 'IL', 'Israel', 'ISR', '376', '972');
INSERT INTO `country` VALUES ('105', 'IT', 'Italy', 'ITA', '380', '39');
INSERT INTO `country` VALUES ('106', 'JM', 'Jamaica', 'JAM', '388', '1876');
INSERT INTO `country` VALUES ('107', 'JP', 'Japan', 'JPN', '392', '81');
INSERT INTO `country` VALUES ('108', 'JO', 'Jordan', 'JOR', '400', '962');
INSERT INTO `country` VALUES ('109', 'KZ', 'Kazakhstan', 'KAZ', '398', '7');
INSERT INTO `country` VALUES ('110', 'KE', 'Kenya', 'KEN', '404', '254');
INSERT INTO `country` VALUES ('111', 'KI', 'Kiribati', 'KIR', '296', '686');
INSERT INTO `country` VALUES ('112', 'KP', 'Korea, Democratic People\'s Republic of', 'PRK', '408', '850');
INSERT INTO `country` VALUES ('113', 'KR', 'Korea, Republic of', 'KOR', '410', '82');
INSERT INTO `country` VALUES ('114', 'KW', 'Kuwait', 'KWT', '414', '965');
INSERT INTO `country` VALUES ('115', 'KG', 'Kyrgyzstan', 'KGZ', '417', '996');
INSERT INTO `country` VALUES ('116', 'LA', 'Lao People\'s Democratic Republic', 'LAO', '418', '856');
INSERT INTO `country` VALUES ('117', 'LV', 'Latvia', 'LVA', '428', '371');
INSERT INTO `country` VALUES ('118', 'LB', 'Lebanon', 'LBN', '422', '961');
INSERT INTO `country` VALUES ('119', 'LS', 'Lesotho', 'LSO', '426', '266');
INSERT INTO `country` VALUES ('120', 'LR', 'Liberia', 'LBR', '430', '231');
INSERT INTO `country` VALUES ('121', 'LY', 'Libyan Arab Jamahiriya', 'LBY', '434', '218');
INSERT INTO `country` VALUES ('122', 'LI', 'Liechtenstein', 'LIE', '438', '423');
INSERT INTO `country` VALUES ('123', 'LT', 'Lithuania', 'LTU', '440', '370');
INSERT INTO `country` VALUES ('124', 'LU', 'Luxembourg', 'LUX', '442', '352');
INSERT INTO `country` VALUES ('125', 'MO', 'Macao', 'MAC', '446', '853');
INSERT INTO `country` VALUES ('126', 'MK', 'Macedonia, the Former Yugoslav Republic of', 'MKD', '807', '389');
INSERT INTO `country` VALUES ('127', 'MG', 'Madagascar', 'MDG', '450', '261');
INSERT INTO `country` VALUES ('128', 'MW', 'Malawi', 'MWI', '454', '265');
INSERT INTO `country` VALUES ('129', 'MY', 'Malaysia', 'MYS', '458', '60');
INSERT INTO `country` VALUES ('130', 'MV', 'Maldives', 'MDV', '462', '960');
INSERT INTO `country` VALUES ('131', 'ML', 'Mali', 'MLI', '466', '223');
INSERT INTO `country` VALUES ('132', 'MT', 'Malta', 'MLT', '470', '356');
INSERT INTO `country` VALUES ('133', 'MH', 'Marshall Islands', 'MHL', '584', '692');
INSERT INTO `country` VALUES ('134', 'MQ', 'Martinique', 'MTQ', '474', '596');
INSERT INTO `country` VALUES ('135', 'MR', 'Mauritania', 'MRT', '478', '222');
INSERT INTO `country` VALUES ('136', 'MU', 'Mauritius', 'MUS', '480', '230');
INSERT INTO `country` VALUES ('137', 'YT', 'Mayotte', null, null, '269');
INSERT INTO `country` VALUES ('138', 'MX', 'Mexico', 'MEX', '484', '52');
INSERT INTO `country` VALUES ('139', 'FM', 'Micronesia, Federated States of', 'FSM', '583', '691');
INSERT INTO `country` VALUES ('140', 'MD', 'Moldova, Republic of', 'MDA', '498', '373');
INSERT INTO `country` VALUES ('141', 'MC', 'Monaco', 'MCO', '492', '377');
INSERT INTO `country` VALUES ('142', 'MN', 'Mongolia', 'MNG', '496', '976');
INSERT INTO `country` VALUES ('143', 'MS', 'Montserrat', 'MSR', '500', '1664');
INSERT INTO `country` VALUES ('144', 'MA', 'Morocco', 'MAR', '504', '212');
INSERT INTO `country` VALUES ('145', 'MZ', 'Mozambique', 'MOZ', '508', '258');
INSERT INTO `country` VALUES ('146', 'MM', 'Myanmar', 'MMR', '104', '95');
INSERT INTO `country` VALUES ('147', 'NA', 'Namibia', 'NAM', '516', '264');
INSERT INTO `country` VALUES ('148', 'NR', 'Nauru', 'NRU', '520', '674');
INSERT INTO `country` VALUES ('149', 'NP', 'Nepal', 'NPL', '524', '977');
INSERT INTO `country` VALUES ('150', 'NL', 'Netherlands', 'NLD', '528', '31');
INSERT INTO `country` VALUES ('151', 'AN', 'Netherlands Antilles', 'ANT', '530', '599');
INSERT INTO `country` VALUES ('152', 'NC', 'New Caledonia', 'NCL', '540', '687');
INSERT INTO `country` VALUES ('153', 'NZ', 'New Zealand', 'NZL', '554', '64');
INSERT INTO `country` VALUES ('154', 'NI', 'Nicaragua', 'NIC', '558', '505');
INSERT INTO `country` VALUES ('155', 'NE', 'Niger', 'NER', '562', '227');
INSERT INTO `country` VALUES ('156', 'NG', 'Nigeria', 'NGA', '566', '234');
INSERT INTO `country` VALUES ('157', 'NU', 'Niue', 'NIU', '570', '683');
INSERT INTO `country` VALUES ('158', 'NF', 'Norfolk Island', 'NFK', '574', '672');
INSERT INTO `country` VALUES ('159', 'MP', 'Northern Mariana Islands', 'MNP', '580', '1670');
INSERT INTO `country` VALUES ('160', 'NO', 'Norway', 'NOR', '578', '47');
INSERT INTO `country` VALUES ('161', 'OM', 'Oman', 'OMN', '512', '968');
INSERT INTO `country` VALUES ('162', 'PK', 'Pakistan', 'PAK', '586', '92');
INSERT INTO `country` VALUES ('163', 'PW', 'Palau', 'PLW', '585', '680');
INSERT INTO `country` VALUES ('164', 'PS', 'Palestinian Territory, Occupied', null, null, '970');
INSERT INTO `country` VALUES ('165', 'PA', 'Panama', 'PAN', '591', '507');
INSERT INTO `country` VALUES ('166', 'PG', 'Papua New Guinea', 'PNG', '598', '675');
INSERT INTO `country` VALUES ('167', 'PY', 'Paraguay', 'PRY', '600', '595');
INSERT INTO `country` VALUES ('168', 'PE', 'Peru', 'PER', '604', '51');
INSERT INTO `country` VALUES ('169', 'PH', 'Philippines', 'PHL', '608', '63');
INSERT INTO `country` VALUES ('170', 'PN', 'Pitcairn', 'PCN', '612', '0');
INSERT INTO `country` VALUES ('171', 'PL', 'Poland', 'POL', '616', '48');
INSERT INTO `country` VALUES ('172', 'PT', 'Portugal', 'PRT', '620', '351');
INSERT INTO `country` VALUES ('173', 'PR', 'Puerto Rico', 'PRI', '630', '1787');
INSERT INTO `country` VALUES ('174', 'QA', 'Qatar', 'QAT', '634', '974');
INSERT INTO `country` VALUES ('175', 'RE', 'Reunion', 'REU', '638', '262');
INSERT INTO `country` VALUES ('176', 'RO', 'Romania', 'ROM', '642', '40');
INSERT INTO `country` VALUES ('177', 'RU', 'Russian Federation', 'RUS', '643', '70');
INSERT INTO `country` VALUES ('178', 'RW', 'Rwanda', 'RWA', '646', '250');
INSERT INTO `country` VALUES ('179', 'SH', 'Saint Helena', 'SHN', '654', '290');
INSERT INTO `country` VALUES ('180', 'KN', 'Saint Kitts and Nevis', 'KNA', '659', '1869');
INSERT INTO `country` VALUES ('181', 'LC', 'Saint Lucia', 'LCA', '662', '1758');
INSERT INTO `country` VALUES ('182', 'PM', 'Saint Pierre and Miquelon', 'SPM', '666', '508');
INSERT INTO `country` VALUES ('183', 'VC', 'Saint Vincent and the Grenadines', 'VCT', '670', '1784');
INSERT INTO `country` VALUES ('184', 'WS', 'Samoa', 'WSM', '882', '684');
INSERT INTO `country` VALUES ('185', 'SM', 'San Marino', 'SMR', '674', '378');
INSERT INTO `country` VALUES ('186', 'ST', 'Sao Tome and Principe', 'STP', '678', '239');
INSERT INTO `country` VALUES ('187', 'SA', 'Saudi Arabia', 'SAU', '682', '966');
INSERT INTO `country` VALUES ('188', 'SN', 'Senegal', 'SEN', '686', '221');
INSERT INTO `country` VALUES ('189', 'CS', 'Serbia and Montenegro', null, null, '381');
INSERT INTO `country` VALUES ('190', 'SC', 'Seychelles', 'SYC', '690', '248');
INSERT INTO `country` VALUES ('191', 'SL', 'Sierra Leone', 'SLE', '694', '232');
INSERT INTO `country` VALUES ('192', 'SG', 'Singapore', 'SGP', '702', '65');
INSERT INTO `country` VALUES ('193', 'SK', 'Slovakia', 'SVK', '703', '421');
INSERT INTO `country` VALUES ('194', 'SI', 'Slovenia', 'SVN', '705', '386');
INSERT INTO `country` VALUES ('195', 'SB', 'Solomon Islands', 'SLB', '90', '677');
INSERT INTO `country` VALUES ('196', 'SO', 'Somalia', 'SOM', '706', '252');
INSERT INTO `country` VALUES ('197', 'ZA', 'South Africa', 'ZAF', '710', '27');
INSERT INTO `country` VALUES ('198', 'GS', 'South Georgia and the South Sandwich Islands', null, null, '0');
INSERT INTO `country` VALUES ('199', 'ES', 'Spain', 'ESP', '724', '34');
INSERT INTO `country` VALUES ('200', 'LK', 'Sri Lanka', 'LKA', '144', '94');
INSERT INTO `country` VALUES ('201', 'SD', 'Sudan', 'SDN', '736', '249');
INSERT INTO `country` VALUES ('202', 'SR', 'Suriname', 'SUR', '740', '597');
INSERT INTO `country` VALUES ('203', 'SJ', 'Svalbard and Jan Mayen', 'SJM', '744', '47');
INSERT INTO `country` VALUES ('204', 'SZ', 'Swaziland', 'SWZ', '748', '268');
INSERT INTO `country` VALUES ('205', 'SE', 'Sweden', 'SWE', '752', '46');
INSERT INTO `country` VALUES ('206', 'CH', 'Switzerland', 'CHE', '756', '41');
INSERT INTO `country` VALUES ('207', 'SY', 'Syrian Arab Republic', 'SYR', '760', '963');
INSERT INTO `country` VALUES ('208', 'TW', 'Taiwan, Province of China', 'TWN', '158', '886');
INSERT INTO `country` VALUES ('209', 'TJ', 'Tajikistan', 'TJK', '762', '992');
INSERT INTO `country` VALUES ('210', 'TZ', 'Tanzania, United Republic of', 'TZA', '834', '255');
INSERT INTO `country` VALUES ('211', 'TH', 'Thailand', 'THA', '764', '66');
INSERT INTO `country` VALUES ('212', 'TL', 'Timor-Leste', null, null, '670');
INSERT INTO `country` VALUES ('213', 'TG', 'Togo', 'TGO', '768', '228');
INSERT INTO `country` VALUES ('214', 'TK', 'Tokelau', 'TKL', '772', '690');
INSERT INTO `country` VALUES ('215', 'TO', 'Tonga', 'TON', '776', '676');
INSERT INTO `country` VALUES ('216', 'TT', 'Trinidad and Tobago', 'TTO', '780', '1868');
INSERT INTO `country` VALUES ('217', 'TN', 'Tunisia', 'TUN', '788', '216');
INSERT INTO `country` VALUES ('218', 'TR', 'Turkey', 'TUR', '792', '90');
INSERT INTO `country` VALUES ('219', 'TM', 'Turkmenistan', 'TKM', '795', '7370');
INSERT INTO `country` VALUES ('220', 'TC', 'Turks and Caicos Islands', 'TCA', '796', '1649');
INSERT INTO `country` VALUES ('221', 'TV', 'Tuvalu', 'TUV', '798', '688');
INSERT INTO `country` VALUES ('222', 'UG', 'Uganda', 'UGA', '800', '256');
INSERT INTO `country` VALUES ('223', 'UA', 'Ukraine', 'UKR', '804', '380');
INSERT INTO `country` VALUES ('224', 'AE', 'United Arab Emirates', 'ARE', '784', '971');
INSERT INTO `country` VALUES ('225', 'GB', 'United Kingdom', 'GBR', '826', '44');
INSERT INTO `country` VALUES ('226', 'US', 'United States', 'USA', '840', '1');
INSERT INTO `country` VALUES ('227', 'UM', 'United States Minor Outlying Islands', null, null, '1');
INSERT INTO `country` VALUES ('228', 'UY', 'Uruguay', 'URY', '858', '598');
INSERT INTO `country` VALUES ('229', 'UZ', 'Uzbekistan', 'UZB', '860', '998');
INSERT INTO `country` VALUES ('230', 'VU', 'Vanuatu', 'VUT', '548', '678');
INSERT INTO `country` VALUES ('231', 'VE', 'Venezuela', 'VEN', '862', '58');
INSERT INTO `country` VALUES ('232', 'VN', 'Viet Nam', 'VNM', '704', '84');
INSERT INTO `country` VALUES ('233', 'VG', 'Virgin Islands, British', 'VGB', '92', '1284');
INSERT INTO `country` VALUES ('234', 'VI', 'Virgin Islands, U.s.', 'VIR', '850', '1340');
INSERT INTO `country` VALUES ('235', 'WF', 'Wallis and Futuna', 'WLF', '876', '681');
INSERT INTO `country` VALUES ('236', 'EH', 'Western Sahara', 'ESH', '732', '212');
INSERT INTO `country` VALUES ('237', 'YE', 'Yemen', 'YEM', '887', '967');
INSERT INTO `country` VALUES ('238', 'ZM', 'Zambia', 'ZMB', '894', '260');
INSERT INTO `country` VALUES ('239', 'ZW', 'Zimbabwe', 'ZWE', '716', '263');

-- ----------------------------
-- Table structure for `customer`
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `row_id` int(10) NOT NULL,
  `customer_id` varchar(10) NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `customer_address` varchar(250) DEFAULT NULL,
  `country_of_origin` varchar(100) DEFAULT NULL,
  `key_account_manager_id` varchar(50) DEFAULT NULL,
  `key_account_manager_name` varchar(100) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES ('1', 'cust_1', 'Ikea', 'Sweden', 'Sweden', 'keyacmgr_10', 'Mr. Sujit Ranjan Debnath', 'iftekhar', 'iftekhar', '2020-12-01 20:52:46');
INSERT INTO `customer` VALUES ('10', 'cust_10', 'Walmart', 'Rogers, Arkansas, USA', 'United States', 'keyacmgr_7', 'Mr. Abdullah Al Razi', 'iftekhar', 'iftekhar', '2020-12-01 14:27:20');
INSERT INTO `customer` VALUES ('2', 'cust_2', 'Carrefour', 'France', 'France', 'keyacmgr_2', 'Showkat Jahan', 'iftekhar', 'iftekhar', '2020-12-01 14:27:53');
INSERT INTO `customer` VALUES ('3', 'cust_3', 'Nitori', 'Tokyo, Japan.', 'Japan', 'keyacmgr_4', 'Mr. Omar Faruk', 'iftekhar', 'iftekhar', '2020-12-01 14:28:42');
INSERT INTO `customer` VALUES ('4', 'cust_4', 'Koppermann', 'Germany', 'Germany', 'keyacmgr_4', 'Mr. Omar Faruk', 'iftekhar', 'iftekhar', '2020-12-01 14:29:10');
INSERT INTO `customer` VALUES ('5', 'cust_5', 'Horizonte', 'Minas Gerais, Brizil.', 'Brazil', 'keyacmgr_5', 'Mr. Mehedi Hasan', 'iftekhar', 'iftekhar', '2020-12-01 14:29:25');
INSERT INTO `customer` VALUES ('6', 'cust_6', 'Sainsbury', 'Holborn, United Kingdom', 'United Kingdom', 'keyacmgr_3', 'Moklesur Rahman Rony', 'iftekhar', 'iftekhar', '2020-12-01 14:29:47');
INSERT INTO `customer` VALUES ('7', 'cust_7', 'BBK', 'Kowale, POMORSKIE, 80-180  Poland', 'Poland', 'keyacmgr_6', 'Mr. Kazi Jubair', 'iftekhar', 'iftekhar', '2020-12-01 14:30:00');
INSERT INTO `customer` VALUES ('8', 'cust_8', 'Bangladesh Army', 'Dhaka, Blangladesh', 'Bangladesh', 'keyacmgr_16', 'Mr. Mahbub Sikder', 'iftekhar', 'iftekhar', '2020-12-01 14:30:40');
INSERT INTO `customer` VALUES ('9', 'cust_9', 'Bangladesh Police', 'Dhaka, Bangladesh', 'Bangladesh', 'keyacmgr_8', 'Mr. Shohorav', 'iftekhar', 'iftekhar', '2020-12-01 14:31:00');

-- ----------------------------
-- Table structure for `defining_qc_standard_for_bleaching_process`
-- ----------------------------
DROP TABLE IF EXISTS `defining_qc_standard_for_bleaching_process`;
CREATE TABLE `defining_qc_standard_for_bleaching_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) NOT NULL,
  `version_id` varchar(30) NOT NULL,
  `version_number` varchar(100) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `color` varchar(50) NOT NULL,
  `finish_width_in_inch` double NOT NULL,
  `standard_for_which_process` varchar(50) NOT NULL,
  `test_method_for_whiteness` varchar(15) NOT NULL,
  `whiteness_min_value` double NOT NULL,
  `whiteness_max_value` double NOT NULL,
  `uom_of_whiteness` varchar(20) NOT NULL,
  `test_method_for_residual_sizing_material` varchar(20) NOT NULL,
  `residual_sizing_material_min_value` double NOT NULL,
  `residual_sizing_material_max_value` double NOT NULL,
  `uom_of_residual_sizing_material` varchar(20) NOT NULL,
  `test_method_for_absorbency` varchar(20) NOT NULL,
  `absorbency_min_value` double NOT NULL,
  `absorbency_max_value` double NOT NULL,
  `uom_of_absorbency` varchar(20) DEFAULT '',
  `test_method_for_resistance_to_surface_fuzzing_and_pilling` varchar(20) NOT NULL,
  `resistance_to_surface_fuzzing_and_pilling_min_value` double NOT NULL,
  `resistance_to_surface_fuzzing_and_pilling_max_value` double DEFAULT NULL,
  `uom_of_resistance_to_surface_fuzzing_and_pilling` varchar(20) NOT NULL,
  `test_method_for_ph` varchar(20) NOT NULL,
  `ph_min_value` double NOT NULL,
  `ph_max_value` double NOT NULL,
  `uom_of_ph` varchar(20) NOT NULL,
  `recording_person_id` varchar(30) NOT NULL,
  `recording_person_name` varchar(50) NOT NULL,
  `recording_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of defining_qc_standard_for_bleaching_process
-- ----------------------------
INSERT INTO `defining_qc_standard_for_bleaching_process` VALUES ('3', '5893/2020', 'version_28', 'Pillow Front', 'Ikea', 'Beige', '50', 'Bleaching', 'Berger', '1', '2', '°', 'Drop test method', '1', '2', '%', 'Capillary Method', '0', '0', 'mm', 'ISO 12945-2', '0', '0', 'meter/min', 'Berger', '0', '0', '%', 'iftekhar', 'iftekhar', '2020-12-28 10:26:49');

-- ----------------------------
-- Table structure for `defining_qc_standard_for_calendering_process`
-- ----------------------------
DROP TABLE IF EXISTS `defining_qc_standard_for_calendering_process`;
CREATE TABLE `defining_qc_standard_for_calendering_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(50) NOT NULL,
  `version_id` varchar(30) NOT NULL,
  `version_number` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `finish_width_in_inch` float NOT NULL,
  `standard_for_which_process` varchar(50) NOT NULL,
  `test_method_for_cf_to_rubbing_dry` varchar(20) NOT NULL,
  `cf_to_rubbing_dry_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_rubbing_dry_tolerance_value` float NOT NULL,
  `cf_to_rubbing_dry_min_value` float NOT NULL,
  `cf_to_rubbing_dry_max_value` float NOT NULL,
  `uom_of_cf_to_rubbing_dry` varchar(20) NOT NULL,
  `test_method_for_cf_to_rubbing_wet` varchar(20) NOT NULL,
  `cf_to_rubbing_wet_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_rubbing_wet_tolerance_value` float NOT NULL,
  `cf_to_rubbing_wet_min_value` float NOT NULL,
  `cf_to_rubbing_wet_max_value` float NOT NULL,
  `uom_of_cf_to_rubbing_wet` varchar(20) NOT NULL,
  `test_method_for_dimensional_stability_to_warp_washing_b_iron` varchar(25) NOT NULL,
  `washing_cycle_for_warp_for_washing_before_iron` varchar(20) NOT NULL,
  `dimensional_stability_to_warp_washing_before_iron_min_value` float NOT NULL,
  `dimensional_stability_to_warp_washing_before_iron_max_value` float NOT NULL,
  `uom_of_dimensional_stability_to_warp_washing_before_iron` varchar(10) NOT NULL,
  `test_method_for_dimensional_stability_to_weft_washing_b_iron` varchar(25) NOT NULL,
  `washing_cycle_for_weft_for_washing_before_iron` varchar(20) NOT NULL,
  `dimensional_stability_to_weft_washing_before_iron_min_value` float NOT NULL,
  `dimensional_stability_to_weft_washing_before_iron_max_value` float NOT NULL,
  `uom_of_dimensional_stability_to_weft_washing_before_iron` varchar(10) NOT NULL,
  `test_method_for_dimensional_stability_to_warp_washing_after_iron` varchar(25) NOT NULL,
  `washing_cycle_for_warp_for_washing_after_iron` varchar(8) NOT NULL,
  `dimensional_stability_to_warp_washing_after_iron_min_value` float NOT NULL,
  `dimensional_stability_to_warp_washing_after_iron_max_value` float NOT NULL,
  `uom_of_dimensional_stability_to_warp_washing_after_iron` varchar(10) NOT NULL,
  `test_method_for_dimensional_stability_to_weft_washing_after_iron` varchar(20) NOT NULL,
  `dimensional_stability_to_weft_washing_after_iron_test_method` varchar(20) NOT NULL,
  `washing_cycle_for_weft_for_washing_after_iron` varchar(8) NOT NULL,
  `dimensional_stability_to_weft_washing_after_iron_min_value` float NOT NULL,
  `dimensional_stability_to_weft_washing_after_iron_max_value` float NOT NULL,
  `uom_of_dimensional_stability_to_weft_washing_after_iron` varchar(10) NOT NULL,
  `test_method_for_warp_yarn_count` varchar(20) NOT NULL,
  `warp_yarn_count_value` float NOT NULL,
  `warp_yarn_count_tolerance_range_math_operator` varchar(20) NOT NULL,
  `warp_yarn_count_tolerance_value` float NOT NULL,
  `warp_yarn_count_min_value` float NOT NULL,
  `warp_yarn_count_max_value` float NOT NULL,
  `uom_of_warp_yarn_count_value` varchar(10) NOT NULL,
  `test_method_for_weft_yarn_count` varchar(20) NOT NULL,
  `weft_yarn_count_value` float NOT NULL,
  `weft_yarn_count_tolerance_range_math_operator` varchar(10) NOT NULL,
  `weft_yarn_count_tolerance_value` float NOT NULL,
  `weft_yarn_count_min_value` float NOT NULL,
  `weft_yarn_count_max_value` float NOT NULL,
  `uom_of_weft_yarn_count_value` varchar(10) NOT NULL,
  `test_method_for_no_of_threads_in_warp` varchar(20) NOT NULL,
  `no_of_threads_in_warp_value` float NOT NULL,
  `no_of_threads_in_warp_tolerance_range_math_operator` varchar(20) NOT NULL,
  `no_of_threads_in_warp_tolerance_value` float NOT NULL,
  `no_of_threads_in_warp_min_value` float NOT NULL,
  `no_of_threads_in_warp_max_value` float NOT NULL,
  `uom_of_no_of_threads_in_warp_value` varchar(10) NOT NULL,
  `test_method_for_no_of_threads_in_weft` varchar(20) NOT NULL,
  `no_of_threads_in_weft_value` float NOT NULL,
  `no_of_threads_in_weft_tolerance_range_math_operator` varchar(20) NOT NULL,
  `no_of_threads_in_weft_tolerance_value` float NOT NULL,
  `no_of_threads_in_weft_min_value` float NOT NULL,
  `no_of_threads_in_weft_max_value` float NOT NULL,
  `uom_of_no_of_threads_in_weft_value` varchar(10) NOT NULL,
  `test_method_for_mass_per_unit_per_area` varchar(20) NOT NULL,
  `mass_per_unit_per_area_value` float NOT NULL,
  `mass_per_unit_per_area_tolerance_range_math_operator` varchar(20) NOT NULL,
  `mass_per_unit_per_area_tolerance_value` float NOT NULL,
  `mass_per_unit_per_area_min_value` float NOT NULL,
  `mass_per_unit_per_area_max_value` float NOT NULL,
  `uom_of_mass_per_unit_per_area_value` varchar(10) NOT NULL,
  `test_method_for_surface_fuzzing_and_pilling` varchar(20) NOT NULL,
  `description_or_type_for_surface_fuzzing_and_pilling` varchar(15) NOT NULL,
  `rubs_for_surface_fuzzing_and_pilling` varchar(10) NOT NULL,
  `surface_fuzzing_and_pilling_tolerance_range_math_operator` varchar(20) NOT NULL,
  `surface_fuzzing_and_pilling_tolerance_value` float NOT NULL,
  `surface_fuzzing_and_pilling_min_value` float NOT NULL,
  `surface_fuzzing_and_pilling_max_value` float NOT NULL,
  `uom_of_surface_fuzzing_and_pilling_value` varchar(10) NOT NULL,
  `tensile_properties_in_warp_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `test_method_for_tensile_properties_in_warp` varchar(20) NOT NULL,
  `tensile_properties_in_warp_value_tolerance_value` float NOT NULL,
  `tensile_properties_in_warp_value_min_value` float NOT NULL,
  `tensile_properties_in_warp_value_max_value` float NOT NULL,
  `uom_of_tensile_properties_in_warp_value` varchar(10) NOT NULL,
  `test_method_for_tensile_properties_in_weft` varchar(20) NOT NULL,
  `tensile_properties_in_weft_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `tensile_properties_in_weft_value_tolerance_value` float NOT NULL,
  `tensile_properties_in_weft_value_min_value` float NOT NULL,
  `tensile_properties_in_weft_value_max_value` float NOT NULL,
  `uom_of_tensile_properties_in_weft_value` varchar(10) NOT NULL,
  `test_method_for_tear_force_in_warp` varchar(20) NOT NULL,
  `tear_force_in_warp_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `tear_force_in_warp_value_tolerance_value` float NOT NULL,
  `tear_force_in_warp_value_min_value` float NOT NULL,
  `tear_force_in_warp_value_max_value` float NOT NULL,
  `uom_of_tear_force_in_warp_value` varchar(10) NOT NULL,
  `test_method_for_tear_force_in_weft` varchar(20) NOT NULL,
  `tear_force_in_weft_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `tear_force_in_weft_value_tolerance_value` float NOT NULL,
  `tear_force_in_weft_value_min_value` float NOT NULL,
  `tear_force_in_weft_value_max_value` float NOT NULL,
  `uom_of_tear_force_in_weft_value` varchar(10) NOT NULL,
  `test_method_for_seam_slippage_resistance_iso_2_in_warp` varchar(20) NOT NULL,
  `seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op` varchar(10) NOT NULL,
  `seam_slippage_resistance_iso_2_in_warp_tolerance_value` float NOT NULL,
  `seam_slippage_resistance_iso_2_in_warp_min_value` float NOT NULL,
  `seam_slippage_resistance_iso_2_in_warp_max_value` float NOT NULL,
  `uom_of_seam_slippage_resistance_iso_2_in_warp` varchar(10) NOT NULL,
  `uom_of_seam_slippage_resistance_iso_2_in_warp_for_load` varchar(10) NOT NULL,
  `test_method_for_seam_slippage_resistance_iso_2_in_weft` varchar(20) NOT NULL,
  `seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op` varchar(8) NOT NULL,
  `seam_slippage_resistance_iso_2_in_weft_tolerance_value` float NOT NULL,
  `seam_slippage_resistance_iso_2_in_weft_min_value` float NOT NULL,
  `seam_slippage_resistance_iso_2_in_weft_max_value` float NOT NULL,
  `uom_of_seam_slippage_resistance_iso_2_in_weft_for_load` varchar(25) NOT NULL,
  `uom_of_seam_slippage_resistance_iso_2_in_weft` varchar(15) NOT NULL,
  `test_method_for_seam_slippage_resistance_in_warp` varchar(20) NOT NULL,
  `seam_slippage_resistance_in_warp_tolerance_range_math_operator` varchar(5) NOT NULL,
  `seam_slippage_resistance_in_warp_tolerance_value` float NOT NULL,
  `seam_slippage_resistance_in_warp_min_value` float NOT NULL,
  `seam_slippage_resistance_in_warp_max_value` float NOT NULL,
  `uom_of_seam_slippage_resistance_in_warp` varchar(10) NOT NULL,
  `test_method_for_seam_slippage_resistance_in_weft` varchar(20) NOT NULL,
  `seam_slippage_resistance_in_weft_tolerance_range_math_operator` varchar(5) NOT NULL,
  `seam_slippage_resistance_in_weft_tolerance_value` float NOT NULL,
  `seam_slippage_resistance_in_weft_min_value` float NOT NULL,
  `seam_slippage_resistance_in_weft_max_value` float NOT NULL,
  `uom_of_seam_slippage_resistance_in_weft` varchar(10) NOT NULL,
  `test_method_for_seam_strength_in_warp` varchar(20) NOT NULL,
  `seam_strength_in_warp_value_tolerance_range_math_operator` varchar(8) NOT NULL,
  `seam_strength_in_warp_value_tolerance_value` float NOT NULL,
  `seam_strength_in_warp_value_min_value` float NOT NULL,
  `seam_strength_in_warp_value_max_value` float NOT NULL,
  `uom_of_seam_strength_in_warp_value` varchar(10) NOT NULL,
  `test_method_for_seam_strength_in_weft` varchar(20) NOT NULL,
  `seam_strength_in_weft_value_tolerance_range_math_operator` varchar(8) NOT NULL,
  `seam_strength_in_weft_value_tolerance_value` float NOT NULL,
  `seam_strength_in_weft_value_min_value` float NOT NULL,
  `seam_strength_in_weft_value_max_value` float NOT NULL,
  `uom_of_seam_strength_in_weft_value` varchar(10) NOT NULL,
  `test_method_for_seam_properties_seam_slippage_iso_astm_d_in_warp` varchar(20) NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op` varchar(8) NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value` float NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_warp_min_value` float NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_warp_max_value` float NOT NULL,
  `uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp` varchar(15) NOT NULL,
  `test_method_for_seam_properties_seam_slippage_iso_astm_d_in_weft` varchar(20) NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op` varchar(8) NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value` float NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_weft_min_value` float NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_weft_max_value` float NOT NULL,
  `uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft` varchar(15) NOT NULL,
  `test_method_for_seam_properties_seam_strength_iso_astm_d_in_warp` varchar(20) NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op` varchar(8) NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value` float NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_warp_min_value` float NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_warp_max_value` float NOT NULL,
  `uom_of_seam_properties_seam_strength_iso_astm_d_in_warp` varchar(15) NOT NULL,
  `test_method_for_seam_properties_seam_strength_iso_astm_d_in_weft` varchar(20) NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op` varchar(8) NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value` float NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_weft_min_value` float NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_weft_max_value` float NOT NULL,
  `uom_of_seam_properties_seam_strength_iso_astm_d_in_weft` varchar(15) NOT NULL,
  `recording_person_id` varchar(20) NOT NULL,
  `recording_person_name` varchar(20) NOT NULL,
  `recording_time` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of defining_qc_standard_for_calendering_process
-- ----------------------------
INSERT INTO `defining_qc_standard_for_calendering_process` VALUES ('1', '6038/2020', 'version_5', 'Reverse', 'Ikea', 'Light Blue', '0', 'Calander', 'ISO 105 X12', 'select', '0', '0', '0', 'uom_of_cf_to_rubbing', 'ISO 105 X12', 'select', '0', '0', '0', 'Berger', 'ISO 6330, ISO 5077, 3759', '', '0', '0', 'celcius', 'ISO 6330, ISO 5077, 3759', '', '0', '0', 'celcius', 'ISO 6330, ISO 5077, 3759', '', '0', '0', 'celcius', 'ISO 6330, ISO 5077, ', '', '', '0', '0', 'celcius', 'ISO 7211-5', '0', 'select', '0', '0', '0', 'select', 'ISO 7211-5', '0', 'select', '0', '0', '0', 'select', 'ISO 7211-2', '0', 'select', '0', '0', '0', 'select', 'ISO 7211-2', '0', 'select', '0', '0', '0', 'select', 'ISO 3801', '0', '', '0', '0', '0', 'select', 'ISO 12945-2', 'select', '', 'select', '0', '0', '0', 'uom_of_sur', 'select', 'ISO 13934-1', '0', '0', '0', 'select', 'select', 'ISO 13934-1', '0', '0', '0', 'select', 'ISO 13937-2', 'select', '0', '0', '0', 'select', 'ISO 13937-2', 'select', '0', '0', '0', 'select', 'ISO 13936-2', 'select', '0', '0', '0', 'mm', 'select', 'ISO 13936-2', 'select', '0', '0', '0', 'select', 'mm', 'ISO 13936-1', 'selec', '0', '0', '0', 'select', 'ISO 13936-1', 'selec', '0', '0', '0', 'select', 'ISO 13935-2', 'select', '0', '0', '0', 'select', 'ISO 13935-2', 'select', '0', '0', '0', 'select', 'ASTM D 1683', 'select', '0', '0', '0', 'select', 'ASTM D 1683', 'select', '0', '0', '0', 'select', 'ASTM D 1683', 'select', '0', '0', '0', 'select', 'ASTM D 1683', 'select', '0', '0', '0', 'select', 'iftekhar', 'iftekhar', '2020-12-23 11:56:46');

-- ----------------------------
-- Table structure for `defining_qc_standard_for_curing_process`
-- ----------------------------
DROP TABLE IF EXISTS `defining_qc_standard_for_curing_process`;
CREATE TABLE `defining_qc_standard_for_curing_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(50) NOT NULL,
  `version_id` varchar(30) NOT NULL,
  `version_number` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `finish_width_in_inch` float NOT NULL,
  `standard_for_which_process` varchar(50) NOT NULL,
  `test_method_for_cf_to_rubbing_dry` varchar(25) NOT NULL,
  `cf_to_rubbing_dry_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_rubbing_dry_tolerance_value` float NOT NULL,
  `cf_to_rubbing_dry_min_value` float NOT NULL,
  `cf_to_rubbing_dry_max_value` float NOT NULL,
  `uom_of_cf_to_rubbing_dry` varchar(20) NOT NULL,
  `test_method_for_cf_to_rubbing_wet` varchar(25) NOT NULL,
  `cf_to_rubbing_wet_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_rubbing_wet_tolerance_value` float NOT NULL,
  `cf_to_rubbing_wet_min_value` float NOT NULL,
  `cf_to_rubbing_wet_max_value` float NOT NULL,
  `uom_of_cf_to_rubbing_wet` varchar(20) NOT NULL,
  `test_method_for_dimensional_stability_to_warp_washing_b_iron` varchar(25) NOT NULL,
  `washing_cycle_for_warp_for_washing_before_iron` varchar(20) NOT NULL,
  `dimensional_stability_to_warp_washing_before_iron_min_value` float NOT NULL,
  `dimensional_stability_to_warp_washing_before_iron_max_value` float NOT NULL,
  `uom_of_dimensional_stability_to_warp_washing_before_iron` varchar(10) NOT NULL,
  `test_method_for_dimensional_stability_to_weft_washing_b_iron` varchar(25) NOT NULL,
  `washing_cycle_for_weft_for_washing_before_iron` varchar(20) NOT NULL,
  `dimensional_stability_to_weft_washing_before_iron_min_value` float NOT NULL,
  `dimensional_stability_to_weft_washing_before_iron_max_value` float NOT NULL,
  `uom_of_dimensional_stability_to_weft_washing_before_iron` varchar(10) NOT NULL,
  `test_method_for_warp_yarn_count` varchar(25) NOT NULL,
  `warp_yarn_count_value` float NOT NULL,
  `warp_yarn_count_tolerance_range_math_operator` varchar(20) NOT NULL,
  `warp_yarn_count_tolerance_value` float NOT NULL,
  `warp_yarn_count_min_value` float NOT NULL,
  `warp_yarn_count_max_value` float NOT NULL,
  `uom_of_warp_yarn_count_value` varchar(10) NOT NULL,
  `test_method_for_weft_yarn_count` varchar(25) NOT NULL,
  `weft_yarn_count_value` float NOT NULL,
  `weft_yarn_count_tolerance_range_math_operator` varchar(10) NOT NULL,
  `weft_yarn_count_tolerance_value` float NOT NULL,
  `weft_yarn_count_min_value` float NOT NULL,
  `weft_yarn_count_max_value` float NOT NULL,
  `uom_of_weft_yarn_count_value` varchar(10) NOT NULL,
  `test_method_for_no_of_threads_in_warp` varchar(25) NOT NULL,
  `no_of_threads_in_warp_value` float NOT NULL,
  `no_of_threads_in_warp_tolerance_range_math_operator` varchar(20) NOT NULL,
  `no_of_threads_in_warp_tolerance_value` float NOT NULL,
  `no_of_threads_in_warp_min_value` float NOT NULL,
  `no_of_threads_in_warp_max_value` float NOT NULL,
  `uom_of_no_of_threads_in_warp_value` varchar(10) NOT NULL,
  `test_method_for_no_of_threads_in_weft` varchar(25) NOT NULL,
  `no_of_threads_in_weft_value` float NOT NULL,
  `no_of_threads_in_weft_tolerance_range_math_operator` varchar(20) NOT NULL,
  `no_of_threads_in_weft_tolerance_value` float NOT NULL,
  `no_of_threads_in_weft_min_value` float NOT NULL,
  `no_of_threads_in_weft_max_value` float NOT NULL,
  `uom_of_no_of_threads_in_weft_value` varchar(10) NOT NULL,
  `test_method_for_mass_per_unit_per_area` varchar(25) NOT NULL,
  `mass_per_unit_per_area_value` float NOT NULL,
  `mass_per_unit_per_area_tolerance_range_math_operator` varchar(20) NOT NULL,
  `mass_per_unit_per_area_tolerance_value` float NOT NULL,
  `mass_per_unit_per_area_min_value` float NOT NULL,
  `mass_per_unit_per_area_max_value` float NOT NULL,
  `uom_of_mass_per_unit_per_area_value` varchar(10) NOT NULL,
  `description_or_type_for_surface_fuzzing_and_pilling` varchar(15) NOT NULL,
  `rubs_for_surface_fuzzing_and_pilling` varchar(10) NOT NULL,
  `test_method_for_surface_fuzzing_and_pilling` varchar(25) NOT NULL,
  `surface_fuzzing_and_pilling_tolerance_range_math_operator` varchar(20) NOT NULL,
  `surface_fuzzing_and_pilling_tolerance_value` float NOT NULL,
  `surface_fuzzing_and_pilling_min_value` float NOT NULL,
  `surface_fuzzing_and_pilling_max_value` float NOT NULL,
  `uom_of_surface_fuzzing_and_pilling_value` varchar(10) NOT NULL,
  `test_method_for_tensile_properties_in_warp` varchar(15) NOT NULL,
  `tensile_properties_in_warp_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `tensile_properties_in_warp_value_tolerance_value` float NOT NULL,
  `tensile_properties_in_warp_value_min_value` float NOT NULL,
  `tensile_properties_in_warp_value_max_value` float NOT NULL,
  `uom_of_tensile_properties_in_warp_value` varchar(10) NOT NULL,
  `test_method_for_tensile_properties_in_weft` varchar(25) NOT NULL,
  `tensile_properties_in_weft_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `tensile_properties_in_weft_value_tolerance_value` float NOT NULL,
  `tensile_properties_in_weft_value_min_value` float NOT NULL,
  `tensile_properties_in_weft_value_max_value` float NOT NULL,
  `uom_of_tensile_properties_in_weft_value` varchar(10) NOT NULL,
  `test_method_for_tear_force_in_warp` varchar(25) NOT NULL,
  `tear_force_in_warp_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `tear_force_in_warp_value_tolerance_value` float NOT NULL,
  `tear_force_in_warp_value_min_value` float NOT NULL,
  `tear_force_in_warp_value_max_value` float NOT NULL,
  `uom_of_tear_force_in_warp_value` varchar(10) NOT NULL,
  `test_method_for_tear_force_in_weft` varchar(25) NOT NULL,
  `tear_force_in_weft_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `tear_force_in_weft_value_tolerance_value` float NOT NULL,
  `tear_force_in_weft_value_min_value` float NOT NULL,
  `tear_force_in_weft_value_max_value` float NOT NULL,
  `uom_of_tear_force_in_weft_value` varchar(10) NOT NULL,
  `test_method_for_resistance_to_surface_wetting_before_wash` varchar(25) NOT NULL,
  `resistance_to_surface_wetting_before_wash_tol_range_math_op` varchar(8) NOT NULL,
  `resistance_to_surface_wetting_before_wash_tolerance_value` float NOT NULL,
  `resistance_to_surface_wetting_before_wash_min_value` float NOT NULL,
  `resistance_to_surface_wetting_before_wash_max_value` float NOT NULL,
  `uom_of_resistance_to_surface_wetting_before_wash` varchar(10) NOT NULL,
  `test_method_for_resistance_to_surface_wetting_after_one_wash` varchar(25) NOT NULL,
  `resistance_to_surface_wetting_after_one_wash_tol_range_math_op` varchar(8) NOT NULL,
  `resistance_to_surface_wetting_after_one_wash_tolerance_value` float NOT NULL,
  `resistance_to_surface_wetting_after_one_wash_min_value` float NOT NULL,
  `resistance_to_surface_wetting_after_one_wash_max_value` float NOT NULL,
  `uom_of_resistance_to_surface_wetting_after_one_wash` varchar(10) NOT NULL,
  `test_method_for_resistance_to_surface_wetting_after_five_wash` varchar(25) NOT NULL,
  `resistance_to_surface_wetting_after_five_wash_tol_range_math_op` varchar(8) NOT NULL,
  `resistance_to_surface_wetting_after_five_wash_tolerance_value` float NOT NULL,
  `resistance_to_surface_wetting_after_five_wash_min_value` float NOT NULL,
  `resistance_to_surface_wetting_after_five_wash_max_value` float NOT NULL,
  `uom_of_resistance_to_surface_wetting_after_five_wash` varchar(10) NOT NULL,
  `test_method_formaldehyde_content` varchar(25) NOT NULL,
  `formaldehyde_content_tolerance_range_math_operator` varchar(8) NOT NULL,
  `formaldehyde_content_tolerance_value` float NOT NULL,
  `formaldehyde_content_min_value` float NOT NULL,
  `formaldehyde_content_max_value` float NOT NULL,
  `uom_of_formaldehyde_content` varchar(10) NOT NULL,
  `test_method_for_ph` varchar(25) NOT NULL,
  `ph_value_tolerance_range_math_operator` varchar(5) NOT NULL,
  `ph_value_tolerance_value` float NOT NULL,
  `ph_value_min_value` float NOT NULL,
  `ph_value_max_value` float NOT NULL,
  `uom_of_ph_value` varchar(10) NOT NULL,
  `test_method_for_smoothness_appearance` varchar(25) NOT NULL,
  `smoothness_appearance_tolerance_range_math_op` varchar(8) NOT NULL,
  `smoothness_appearance_tolerance_value` float NOT NULL,
  `smoothness_appearance_min_value` float NOT NULL,
  `smoothness_appearance_max_value` float NOT NULL,
  `uom_of_smoothness_appearance` varchar(15) NOT NULL,
  `recording_person_id` varchar(20) NOT NULL,
  `recording_person_name` varchar(20) NOT NULL,
  `recording_time` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of defining_qc_standard_for_curing_process
-- ----------------------------
INSERT INTO `defining_qc_standard_for_curing_process` VALUES ('1', '5893/2020', 'version_28', 'Pillow Front', 'Ikea', 'Beige', '50', 'Curing', 'ISO 105 X12', 'select', '0', '0', '0', 'uom_of_cf_to_rubbing', 'ISO 105 X12', 'select', '0', '0', '0', 'Berger', 'ISO 6330, ISO 5077, 3759', '', '0', '0', 'celcius', 'ISO 6330, ISO 5077, 3759', '', '0', '0', 'celcius', 'ISO 7211-5', '0', 'select', '0', '0', '0', 'select', 'ISO 7211-5', '0', 'select', '0', '0', '0', 'select', 'ISO 7211-2', '0', 'select', '0', '0', '0', 'select', 'ISO 7211-2', '0', 'select', '0', '0', '0', 'select', 'ISO 3801', '0', '', '0', '0', '0', 'select', 'select', '', 'ISO 12945-2', 'select', '0', '0', '0', 'uom_of_sur', 'ISO 13934-1', 'select', '0', '0', '0', 'select', 'ISO 13934-1', 'select', '0', '0', '0', 'select', 'ISO 13937-2', 'select', '0', '0', '0', 'select', 'ISO 13937-2', 'select', '0', '0', '0', 'select', 'AATCC 22', '≥', '50', '20', '70', 'value', 'AATCC 22', '≥', '50', '20', '70', 'value', 'ISO 4920', '≥', '50', '50', '100', 'value', '(ISO 14184-1', 'select', '0', '0', '0', 'select', 'ISO 3071', '0', '0', '0', '0', '%', 'AATCC 124', 'select', '0', '0', '0', '%', 'iftekhar', 'iftekhar', '2020-12-27 12:41:01');

-- ----------------------------
-- Table structure for `defining_qc_standard_for_equalize_process`
-- ----------------------------
DROP TABLE IF EXISTS `defining_qc_standard_for_equalize_process`;
CREATE TABLE `defining_qc_standard_for_equalize_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) DEFAULT NULL,
  `version_id` varchar(30) NOT NULL,
  `version_number` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `finish_width_in_inch` double DEFAULT NULL,
  `standard_for_which_process` varchar(100) DEFAULT NULL,
  `whiteness_value` double DEFAULT NULL,
  `uom_of_whiteness` varchar(20) DEFAULT NULL,
  `whiteness_tolerance_range_math_operator` varchar(5) DEFAULT NULL,
  `whiteness_tolerance_value_in_percentage` double DEFAULT NULL,
  `whiteness_min_value` double DEFAULT NULL,
  `whiteness_max_value` double DEFAULT NULL,
  `bowing_and_skew_value` double DEFAULT NULL,
  `uom_of_bowing_and_skew` varchar(20) DEFAULT NULL,
  `bowing_and_skew_tolerance_range_math_operator` varchar(10) DEFAULT NULL,
  `bowing_and_skew_tolerance_value_in_percentage` double DEFAULT NULL,
  `bowing_and_skew_min_value` double DEFAULT NULL,
  `bowing_and_skew_max_value` double DEFAULT NULL,
  `ph_value` double DEFAULT NULL,
  `uom_of_ph` varchar(20) DEFAULT NULL,
  `ph_tolerance_range_math_operator` varchar(20) DEFAULT NULL,
  `ph_tolerance_value_in_percentage` double DEFAULT NULL,
  `ph_min_value` double DEFAULT NULL,
  `ph_max_value` double DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of defining_qc_standard_for_equalize_process
-- ----------------------------

-- ----------------------------
-- Table structure for `defining_qc_standard_for_finishing_process`
-- ----------------------------
DROP TABLE IF EXISTS `defining_qc_standard_for_finishing_process`;
CREATE TABLE `defining_qc_standard_for_finishing_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(20) NOT NULL,
  `version_id` varchar(20) NOT NULL,
  `version_number` varchar(15) NOT NULL,
  `customer_name` varchar(25) NOT NULL,
  `color` varchar(15) NOT NULL,
  `finish_width_in_inch` float NOT NULL,
  `standard_for_which_process` varchar(18) NOT NULL,
  `test_method_for_cf_to_rubbing_dry` varchar(15) NOT NULL,
  `cf_to_rubbing_dry_tolerance_range_math_operator` varchar(8) NOT NULL,
  `cf_to_rubbing_dry_tolerance_value` float NOT NULL,
  `cf_to_rubbing_dry_min_value` float NOT NULL,
  `cf_to_rubbing_dry_max_value` float NOT NULL,
  `uom_of_cf_to_rubbing_dry` varchar(10) NOT NULL,
  `test_method_for_cf_to_rubbing_wet` varchar(15) NOT NULL,
  `cf_to_rubbing_wet_tolerance_range_math_operator` char(2) NOT NULL,
  `cf_to_rubbing_wet_tolerance_value` float NOT NULL,
  `cf_to_rubbing_wet_min_value` float NOT NULL,
  `cf_to_rubbing_wet_max_value` float NOT NULL,
  `uom_of_cf_to_rubbing_wet` varchar(10) NOT NULL,
  `test_method_for_dimensional_stability_to_warp_washing_b_iron` varchar(15) NOT NULL,
  `washing_cycle_for_warp_for_washing_before_iron` char(2) NOT NULL,
  `dimensional_stability_to_warp_washing_before_iron_min_value` float NOT NULL,
  `dimensional_stability_to_warp_washing_before_iron_max_value` float NOT NULL,
  `uom_of_dimensional_stability_to_warp_washing_before_iron` varchar(15) NOT NULL,
  `test_method_for_dimensional_stability_to_weft_washing_b_iron` varchar(15) NOT NULL,
  `washing_cycle_for_weft_for_washing_before_iron` varchar(15) NOT NULL,
  `dimensional_stability_to_weft_washing_before_iron_min_value` float NOT NULL,
  `dimensional_stability_to_weft_washing_before_iron_max_value` float NOT NULL,
  `uom_of_dimensional_stability_to_weft_washing_before_iron` varchar(10) NOT NULL,
  `test_method_for_dimensional_stability_to_warp_washing_after_iron` varchar(20) NOT NULL,
  `washing_cycle_for_warp_for_washing_after_iron` varchar(8) NOT NULL,
  `dimensional_stability_to_warp_washing_after_iron_min_value` float NOT NULL,
  `dimensional_stability_to_warp_washing_after_iron_max_value` float NOT NULL,
  `uom_of_dimensional_stability_to_warp_washing_after_iron` varchar(10) NOT NULL,
  `test_method_for_dimensional_stability_to_weft_washing_after_iron` varchar(15) NOT NULL,
  `washing_cycle_for_weft_for_washing_after_iron` varchar(8) NOT NULL,
  `dimensional_stability_to_weft_washing_after_iron_min_value` float NOT NULL,
  `dimensional_stability_to_weft_washing_after_iron_max_value` float NOT NULL,
  `uom_of_dimensional_stability_to_weft_washing_after_iron` varchar(10) NOT NULL,
  `test_method_for_warp_yarn_count` varchar(15) NOT NULL,
  `warp_yarn_count_value` float NOT NULL,
  `warp_yarn_count_tolerance_range_math_operator` char(2) NOT NULL,
  `warp_yarn_count_tolerance_value` float NOT NULL,
  `warp_yarn_count_min_value` float NOT NULL,
  `warp_yarn_count_max_value` float NOT NULL,
  `uom_of_warp_yarn_count_value` varchar(10) NOT NULL,
  `test_method_for_weft_yarn_count` varchar(15) NOT NULL,
  `weft_yarn_count_value` float NOT NULL,
  `weft_yarn_count_tolerance_range_math_operator` char(2) NOT NULL,
  `weft_yarn_count_tolerance_value` float NOT NULL,
  `weft_yarn_count_min_value` float NOT NULL,
  `weft_yarn_count_max_value` float NOT NULL,
  `uom_of_weft_yarn_count_value` varchar(10) NOT NULL,
  `test_method_for_mass_per_unit_per_area` varchar(15) NOT NULL,
  `mass_per_unit_per_area_value` float NOT NULL,
  `mass_per_unit_per_area_tolerance_range_math_operator` char(2) NOT NULL,
  `mass_per_unit_per_area_tolerance_value` float NOT NULL,
  `mass_per_unit_per_area_min_value` float NOT NULL,
  `mass_per_unit_per_area_max_value` float NOT NULL,
  `uom_of_mass_per_unit_per_area_value` varchar(8) NOT NULL,
  `test_method_for_no_of_threads_in_warp` varchar(15) NOT NULL,
  `no_of_threads_in_warp_value` float NOT NULL,
  `no_of_threads_in_warp_tolerance_range_math_operator` char(2) NOT NULL,
  `no_of_threads_in_warp_tolerance_value` float NOT NULL,
  `no_of_threads_in_warp_min_value` float NOT NULL,
  `no_of_threads_in_warp_max_value` float NOT NULL,
  `uom_of_no_of_threads_in_warp_value` varchar(10) NOT NULL,
  `test_method_for_no_of_threads_in_weft` varchar(15) NOT NULL,
  `no_of_threads_in_weft_value` float NOT NULL,
  `no_of_threads_in_weft_tolerance_range_math_operator` char(2) NOT NULL,
  `no_of_threads_in_weft_tolerance_value` float NOT NULL,
  `no_of_threads_in_weft_min_value` float NOT NULL,
  `no_of_threads_in_weft_max_value` float NOT NULL,
  `uom_of_no_of_threads_in_weft_value` varchar(8) NOT NULL,
  `test_method_for_surface_fuzzing_and_pilling` varchar(15) NOT NULL,
  `description_or_type_for_surface_fuzzing_and_pilling` varchar(12) NOT NULL,
  `rubs_for_surface_fuzzing_and_pilling` varchar(10) NOT NULL,
  `surface_fuzzing_and_pilling_tolerance_range_math_operator` varchar(8) NOT NULL,
  `surface_fuzzing_and_pilling_tolerance_value` float NOT NULL,
  `surface_fuzzing_and_pilling_min_value` float NOT NULL,
  `surface_fuzzing_and_pilling_max_value` float NOT NULL,
  `uom_of_surface_fuzzing_and_pilling_value` char(15) NOT NULL,
  `test_method_for_tensile_properties_in_warp` char(15) NOT NULL,
  `tensile_properties_in_warp_value_tolerance_range_math_operator` char(2) NOT NULL,
  `tensile_properties_in_warp_value_tolerance_value` float NOT NULL,
  `tensile_properties_in_warp_value_min_value` float NOT NULL,
  `tensile_properties_in_warp_value_max_value` float NOT NULL,
  `uom_of_tensile_properties_in_warp_value` char(10) NOT NULL,
  `test_method_for_tensile_properties_in_weft` char(15) NOT NULL,
  `tensile_properties_in_weft_value_tolerance_range_math_operator` char(2) NOT NULL,
  `tensile_properties_in_weft_value_tolerance_value` float NOT NULL,
  `tensile_properties_in_weft_value_min_value` float NOT NULL,
  `tensile_properties_in_weft_value_max_value` float NOT NULL,
  `uom_of_tensile_properties_in_weft_value` varchar(10) NOT NULL,
  `test_method_for_tear_force_in_warp` char(15) NOT NULL,
  `tear_force_in_warp_value_tolerance_range_math_operator` char(2) NOT NULL,
  `tear_force_in_warp_value_tolerance_value` float NOT NULL,
  `tear_force_in_warp_value_min_value` float NOT NULL,
  `tear_force_in_warp_value_max_value` float NOT NULL,
  `uom_of_tear_force_in_warp_value` varchar(10) NOT NULL,
  `test_method_for_tear_force_in_weft` char(10) NOT NULL,
  `tear_force_in_weft_value_tolerance_range_math_operator` char(2) NOT NULL,
  `tear_force_in_weft_value_tolerance_value` float NOT NULL,
  `tear_force_in_weft_value_min_value` float NOT NULL,
  `tear_force_in_weft_value_max_value` float NOT NULL,
  `uom_of_tear_force_in_weft_value` varchar(10) NOT NULL,
  `test_method_for_seam_strength_in_warp` varchar(15) NOT NULL,
  `seam_strength_in_warp_value_tolerance_range_math_operator` char(2) NOT NULL,
  `seam_strength_in_warp_value_tolerance_value` float NOT NULL,
  `seam_strength_in_warp_value_min_value` float NOT NULL,
  `seam_strength_in_warp_value_max_value` float NOT NULL,
  `uom_of_seam_strength_in_warp_value` char(8) NOT NULL,
  `test_method_for_seam_strength_in_weft` char(15) NOT NULL,
  `seam_strength_in_weft_value_tolerance_range_math_operator` char(2) NOT NULL,
  `seam_strength_in_weft_value_tolerance_value` float NOT NULL,
  `seam_strength_in_weft_value_min_value` float NOT NULL,
  `seam_strength_in_weft_value_max_value` float NOT NULL,
  `uom_of_seam_strength_in_weft_value` char(8) NOT NULL,
  `test_method_for_abrasion_resistance_c_change` char(15) NOT NULL,
  `abrasion_resistance_c_change_rubs` char(2) NOT NULL,
  `abrasion_resistance_c_change_value_math_op` varchar(8) NOT NULL,
  `abrasion_resistance_c_change_value_tolerance_value` float NOT NULL,
  `abrasion_resistance_c_change_value_min_value` float NOT NULL,
  `abrasion_resistance_c_change_value_max_value` float NOT NULL,
  `uom_of_abrasion_resistance_c_change_value` varchar(8) NOT NULL,
  `test_method_for_abrasion_resistance_no_of_thread_break` varchar(15) NOT NULL,
  `abrasion_resistance_no_of_thread_break` float NOT NULL,
  `abrasion_resistance_rubs` float NOT NULL,
  `abrasion_resistance_thread_break` varchar(15) NOT NULL,
  `test_method_for_mass_loss_in_abrasion_test` varchar(15) NOT NULL,
  `rubs_for_mass_loss_in_abrasion_test` varchar(10) NOT NULL,
  `mass_loss_in_abrasion_test_value_tolerance_range_math_operator` char(2) NOT NULL,
  `mass_loss_in_abrasion_test_value_tolerance_value` float NOT NULL,
  `mass_loss_in_abrasion_test_value_min_value` float NOT NULL,
  `mass_loss_in_abrasion_test_value_max_value` float NOT NULL,
  `uom_of_mass_loss_in_abrasion_test_value` varchar(10) NOT NULL,
  `test_method_formaldehyde_content` varchar(15) NOT NULL,
  `formaldehyde_content_tolerance_range_math_operator` char(2) NOT NULL,
  `formaldehyde_content_tolerance_value` float NOT NULL,
  `formaldehyde_content_min_value` float NOT NULL,
  `formaldehyde_content_max_value` float NOT NULL,
  `uom_of_formaldehyde_content` varchar(10) NOT NULL,
  `test_method_for_cf_to_dry_cleaning_color_change` varchar(15) NOT NULL,
  `cf_to_dry_cleaning_color_change_tolerance_range_math_operator` char(2) NOT NULL,
  `cf_to_dry_cleaning_color_change_tolerance_value` float NOT NULL,
  `cf_to_dry_cleaning_color_change_min_value` float NOT NULL,
  `cf_to_dry_cleaning_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_dry_cleaning_color_change` varchar(10) NOT NULL,
  `test_method_for_cf_to_dry_cleaning_staining` varchar(15) NOT NULL,
  `cf_to_dry_cleaning_staining_tolerance_range_math_operator` char(2) NOT NULL,
  `cf_to_dry_cleaning_staining_tolerance_value` float NOT NULL,
  `cf_to_dry_cleaning_staining_min_value` float NOT NULL,
  `cf_to_dry_cleaning_staining_max_value` float NOT NULL,
  `uom_of_cf_to_dry_cleaning_staining` varchar(8) NOT NULL,
  `test_method_for_cf_to_washing_color_change` varchar(15) NOT NULL,
  `cf_to_washing_color_change_tolerance_range_math_operator` char(2) NOT NULL,
  `cf_to_washing_color_change_tolerance_value` float NOT NULL,
  `cf_to_washing_color_change_min_value` float NOT NULL,
  `cf_to_washing_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_washing_color_change` varchar(8) NOT NULL,
  `test_method_for_cf_to_washing_staining` varchar(15) NOT NULL,
  `cf_to_washing_staining_tolerance_range_math_operator` char(2) NOT NULL,
  `cf_to_washing_staining_tolerance_value` float NOT NULL,
  `cf_to_washing_staining_min_value` float NOT NULL,
  `cf_to_washing_staining_max_value` float NOT NULL,
  `uom_of_cf_to_washing_staining` varchar(8) NOT NULL,
  `test_method_for_cf_to_washing_cross_staining` varchar(15) NOT NULL,
  `cf_to_washing_cross_staining_tolerance_range_math_operator` char(2) NOT NULL,
  `cf_to_washing_cross_staining_tolerance_value` float NOT NULL,
  `cf_to_washing_cross_staining_min_value` float NOT NULL,
  `cf_to_washing_cross_staining_max_value` float NOT NULL,
  `uom_of_cf_to_washing_cross_staining` varchar(8) NOT NULL,
  `test_method_for_perspiration_acid_color_change` varchar(15) NOT NULL,
  `cf_to_perspiration_acid_color_change_tolerance_range_math_op` char(2) NOT NULL,
  `cf_to_perspiration_acid_color_change_tolerance_value` float NOT NULL,
  `cf_to_perspiration_acid_color_change_min_value` float NOT NULL,
  `cf_to_perspiration_acid_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_perspiration_acid_color_change` varchar(8) NOT NULL,
  `test_method_for_cf_to_perspiration_acid_staining` varchar(15) NOT NULL,
  `cf_to_perspiration_acid_staining_tolerance_range_math_operator` char(2) NOT NULL,
  `cf_to_perspiration_acid_staining_value` float NOT NULL,
  `cf_to_perspiration_acid_staining_min_value` float NOT NULL,
  `cf_to_perspiration_acid_staining_max_value` float NOT NULL,
  `uom_of_cf_to_perspiration_acid_staining` varchar(8) NOT NULL,
  `test_method_for_cf_to_perspiration_acid_cross_staining` varchar(15) NOT NULL,
  `cf_to_perspiration_acid_cross_staining_tolerance_range_math_op` char(2) NOT NULL,
  `cf_to_perspiration_acid_cross_staining_tolerance_value` float NOT NULL,
  `cf_to_perspiration_acid_cross_staining_max_value` float NOT NULL,
  `cf_to_perspiration_acid_cross_staining_min_value` float NOT NULL,
  `uom_of_cf_to_perspiration_acid_cross_staining` varchar(8) NOT NULL,
  `test_method_for_cf_to_perspiration_alkali_color_change` varchar(15) NOT NULL,
  `cf_to_perspiration_alkali_color_change_tolerance_range_math_op` char(2) NOT NULL,
  `cf_to_perspiration_alkali_color_change_tolerance_value` float NOT NULL,
  `cf_to_perspiration_alkali_color_change_min_value` float NOT NULL,
  `cf_to_perspiration_alkali_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_perspiration_alkali_color_change` varchar(8) NOT NULL,
  `test_method_for_cf_to_perspiration_alkali_staining` varchar(15) NOT NULL,
  `cf_to_perspiration_alkali_staining_tolerance_range_math_op` char(2) NOT NULL,
  `cf_to_perspiration_alkali_staining_tolerance_value` float NOT NULL,
  `cf_to_perspiration_alkali_staining_min_value` float NOT NULL,
  `cf_to_perspiration_alkali_staining_max_value` float NOT NULL,
  `uom_of_cf_to_perspiration_alkali_staining` varchar(8) NOT NULL,
  `test_method_for_cf_to_perspiration_alkali_cross_staining` varchar(15) NOT NULL,
  `cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op` char(2) NOT NULL,
  `cf_to_perspiration_alkali_cross_staining_tolerance_value` float NOT NULL,
  `cf_to_perspiration_alkali_cross_staining_min_value` float NOT NULL,
  `cf_to_perspiration_alkali_cross_staining_max_value` float NOT NULL,
  `uom_of_cf_to_perspiration_alkali_cross_staining` varchar(8) NOT NULL,
  `test_method_for_cf_to_water_color_change` varchar(15) NOT NULL,
  `cf_to_water_color_change_tolerance_range_math_operator` char(2) NOT NULL,
  `cf_to_water_color_change_tolerance_value` float NOT NULL,
  `cf_to_water_color_change_min_value` float NOT NULL,
  `cf_to_water_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_water_color_change` varchar(8) NOT NULL,
  `test_method_for_cf_to_water_staining` varchar(15) NOT NULL,
  `cf_to_water_staining_tolerance_range_math_operator` char(2) NOT NULL,
  `cf_to_water_staining_tolerance_value` float NOT NULL,
  `cf_to_water_staining_min_value` float NOT NULL,
  `cf_to_water_staining_max_value` float NOT NULL,
  `uom_of_cf_to_water_staining` varchar(8) NOT NULL,
  `test_method_for_cf_to_water_cross_staining` varchar(15) NOT NULL,
  `cf_to_water_cross_staining_tolerance_range_math_operator` char(2) NOT NULL,
  `cf_to_water_cross_staining_tolerance_value` float NOT NULL,
  `cf_to_water_cross_staining_min_value` float NOT NULL,
  `cf_to_water_cross_staining_max_value` float NOT NULL,
  `uom_of_cf_to_water_cross_staining` varchar(8) NOT NULL,
  `test_method_for_cf_to_water_spotting_surface` varchar(10) NOT NULL,
  `cf_to_water_spotting_surface_tolerance_range_math_op` char(2) NOT NULL,
  `cf_to_water_spotting_surface_tolerance_value` float NOT NULL,
  `cf_to_water_spotting_surface_min_value` float NOT NULL,
  `cf_to_water_spotting_surface_max_value` float NOT NULL,
  `uom_of_cf_to_water_spotting_surface` varchar(8) NOT NULL,
  `test_method_for_cf_to_water_spotting_edge` varchar(10) NOT NULL,
  `cf_to_water_spotting_edge_tolerance_range_math_op` char(2) NOT NULL,
  `cf_to_water_spotting_edge_tolerance_value` float NOT NULL,
  `cf_to_water_spotting_edge_min_value` float NOT NULL,
  `cf_to_water_spotting_edge_max_value` float NOT NULL,
  `uom_of_cf_to_water_spotting_edge` varchar(8) NOT NULL,
  `test_method_for_cf_to_water_spotting_cross_staining` varchar(15) NOT NULL,
  `cf_to_water_spotting_cross_staining_tolerance_range_math_op` char(2) NOT NULL,
  `cf_to_water_spotting_cross_staining_tolerance_value` float NOT NULL,
  `cf_to_water_spotting_cross_staining_min_value` float NOT NULL,
  `cf_to_water_spotting_cross_staining_max_value` float NOT NULL,
  `uom_of_cf_to_water_spotting_cross_staining` varchar(8) NOT NULL,
  `test_method_for_resistance_to_surface_wetting_before_wash` varchar(15) NOT NULL,
  `resistance_to_surface_wetting_before_wash_tol_range_math_op` char(2) NOT NULL,
  `resistance_to_surface_wetting_before_wash_tolerance_value` float NOT NULL,
  `resistance_to_surface_wetting_before_wash_min_value` float NOT NULL,
  `resistance_to_surface_wetting_before_wash_max_value` float NOT NULL,
  `uom_of_resistance_to_surface_wetting_before_wash` varchar(8) NOT NULL,
  `test_method_for_resistance_to_surface_wetting_after_one_wash` varchar(10) NOT NULL,
  `resistance_to_surface_wetting_after_one_wash_tol_range_math_op` char(2) NOT NULL,
  `resistance_to_surface_wetting_after_one_wash_tolerance_value` float NOT NULL,
  `resistance_to_surface_wetting_after_one_wash_min_value` float NOT NULL,
  `resistance_to_surface_wetting_after_one_wash_max_value` float NOT NULL,
  `uom_of_resistance_to_surface_wetting_after_one_wash` varchar(8) NOT NULL,
  `test_method_for_resistance_to_surface_wetting_after_five_wash` varchar(15) NOT NULL,
  `resistance_to_surface_wetting_after_five_wash_tol_range_math_op` char(2) NOT NULL,
  `resistance_to_surface_wetting_after_five_wash_tolerance_value` float NOT NULL,
  `resistance_to_surface_wetting_after_five_wash_min_value` float NOT NULL,
  `resistance_to_surface_wetting_after_five_wash_max_value` float NOT NULL,
  `uom_of_resistance_to_surface_wetting_after_five_wash` varchar(8) NOT NULL,
  `test_method_for_cf_to_hydrolysis_of_reactive_dyes_color_change` varchar(15) NOT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op` char(2) NOT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value` float NOT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_min_value` float NOT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change` varchar(8) NOT NULL,
  `test_method_for_cf_to_oxidative_bleach_damage_color_change` varchar(15) NOT NULL,
  `cf_to_oxidative_bleach_damage_color_change_tol_range_math_op` char(2) NOT NULL,
  `cf_to_oxidative_bleach_damage_value` float NOT NULL,
  `cf_to_oxidative_bleach_damage_color_change_tolerance_value` float NOT NULL,
  `cf_to_oxidative_bleach_damage_color_change_min_value` float NOT NULL,
  `cf_to_oxidative_bleach_damage_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_oxidative_bleach_damage_color_change` varchar(8) NOT NULL,
  `test_method_for_cf_to_phenolic_yellowing_staining` varchar(15) NOT NULL,
  `cf_to_phenolic_yellowing_staining_tolerance_range_math_operator` char(2) NOT NULL,
  `cf_to_phenolic_yellowing_staining_tolerance_value` float NOT NULL,
  `cf_to_phenolic_yellowing_staining_min_value` float NOT NULL,
  `cf_to_phenolic_yellowing_staining_max_value` float NOT NULL,
  `uom_of_cf_to_phenolic_yellowing_staining` varchar(8) NOT NULL,
  `test_method_for_cf_to_pvc_migration_staining` varchar(15) NOT NULL,
  `cf_to_pvc_migration_staining_tolerance_range_math_operator` char(2) NOT NULL,
  `cf_to_pvc_migration_staining_tolerance_value` float NOT NULL,
  `cf_to_pvc_migration_staining_min_value` float NOT NULL,
  `cf_to_pvc_migration_staining_max_value` float NOT NULL,
  `uom_of_cf_to_pvc_migration_staining` varchar(8) NOT NULL,
  `test_method_for_cf_to_saliva_color_change` varchar(15) NOT NULL,
  `cf_to_saliva_color_change_tolerance_range_math_operator` char(2) NOT NULL,
  `cf_to_saliva_color_change_tolerance_value` float NOT NULL,
  `cf_to_saliva_color_change_staining_min_value` float NOT NULL,
  `cf_to_saliva_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_saliva_color_change` varchar(8) NOT NULL,
  `test_method_for_cf_to_saliva_staining` varchar(15) NOT NULL,
  `cf_to_saliva_staining_tolerance_range_math_operator` char(2) NOT NULL,
  `cf_to_saliva_staining_tolerance_value` float NOT NULL,
  `cf_to_saliva_staining_staining_min_value` float NOT NULL,
  `cf_to_saliva_staining_max_value` float NOT NULL,
  `uom_of_cf_to_saliva_staining` varchar(8) NOT NULL,
  `test_method_for_cf_to_chlorinated_water_color_change` varchar(15) NOT NULL,
  `cf_to_chlorinated_water_color_change_tolerance_range_math_op` char(2) NOT NULL,
  `cf_to_chlorinated_water_color_change_tolerance_value` float NOT NULL,
  `cf_to_chlorinated_water_color_change_min_value` float NOT NULL,
  `cf_to_chlorinated_water_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_chlorinated_water_color_change` varchar(8) NOT NULL,
  `test_method_for_cf_to_cholorine_bleach_color_change` varchar(15) NOT NULL,
  `cf_to_cholorine_bleach_color_change_tolerance_range_math_op` char(2) NOT NULL,
  `cf_to_cholorine_bleach_color_change_tolerance_value` float NOT NULL,
  `cf_to_cholorine_bleach_color_change_min_value` float NOT NULL,
  `cf_to_cholorine_bleach_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_cholorine_bleach_color_change` varchar(8) NOT NULL,
  `test_method_for_cf_to_peroxide_bleach_color_change` varchar(15) NOT NULL,
  `cf_to_peroxide_bleach_color_change_tolerance_range_math_operator` char(2) NOT NULL,
  `cf_to_peroxide_bleach_color_change_tolerance_value` float NOT NULL,
  `cf_to_peroxide_bleach_color_change_min_value` float NOT NULL,
  `cf_to_peroxide_bleach_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_peroxide_bleach_color_change` varchar(8) NOT NULL,
  `cf_to_peroxide_bleach_staining_tolerance_range_math_operator` char(2) NOT NULL,
  `cf_to_peroxide_bleach_staining_tolerance_value` float NOT NULL,
  `cf_to_peroxide_bleach_staining_min_value` float NOT NULL,
  `cf_to_peroxide_bleach_staining_max_value` float NOT NULL,
  `uom_of_cf_to_peroxide_bleach_staining` varchar(8) NOT NULL,
  `test_method_for_cross_staining` varchar(15) NOT NULL,
  `cross_staining_tolerance_range_math_operator` char(2) NOT NULL,
  `cross_staining_tolerance_value` float NOT NULL,
  `cross_staining_min_value` float NOT NULL,
  `cross_staining_max_value` float NOT NULL,
  `uom_of_cross_staining` varchar(8) NOT NULL,
  `description_or_type_for_water_absorption` char(2) NOT NULL,
  `water_absorption_value_tolerance_range_math_operator` varchar(5) NOT NULL,
  `water_absorption_value_tolerance_value` float NOT NULL,
  `water_absorption_value_min_value` float NOT NULL,
  `water_absorption_value_max_value` float NOT NULL,
  `uom_of_water_absorption_value` varchar(8) NOT NULL,
  `test_method_for_water_absorption_b_wash_thirty_sec` varchar(15) NOT NULL,
  `water_absorption_b_wash_thirty_sec_tolerance_range_math_op` char(2) NOT NULL,
  `water_absorption_b_wash_thirty_sec_tolerance_value` float NOT NULL,
  `water_absorption_b_wash_thirty_sec_min_value` float NOT NULL,
  `water_absorption_b_wash_thirty_sec_max_value` float NOT NULL,
  `uom_of_water_absorption_b_wash_thirty_sec` varchar(8) NOT NULL,
  `test_method_for_water_absorption_b_wash_max` varchar(15) NOT NULL,
  `water_absorption_b_wash_max_tolerance_range_math_op` char(2) NOT NULL,
  `water_absorption_b_wash_max_tolerance_value` float NOT NULL,
  `water_absorption_b_wash_max_min_value` float NOT NULL,
  `water_absorption_b_wash_max_max_value` float NOT NULL,
  `uom_of_water_absorption_b_wash_max` varchar(8) NOT NULL,
  `test_method_for_water_absorption_a_wash_thirty_sec` varchar(15) NOT NULL,
  `water_absorption_a_wash_thirty_sec_tolerance_range_math_op` char(2) NOT NULL,
  `water_absorption_a_wash_thirty_sec_tolerance_value` float NOT NULL,
  `water_absorption_a_wash_thirty_sec_min_value` float NOT NULL,
  `water_absorption_a_wash_thirty_sec_max_value` float NOT NULL,
  `uom_of_water_absorption_a_wash_thirty_sec` varchar(8) NOT NULL,
  `wicking_test_tol_range_math_op` char(2) NOT NULL,
  `wicking_test_tolerance_value` float NOT NULL,
  `wicking_test_min_value` float NOT NULL,
  `wicking_test_max_value` float NOT NULL,
  `uom_of_wicking_test` varchar(8) NOT NULL,
  `spirality_value_tolerance_range_math_operator` char(2) NOT NULL,
  `spirality_value_tolerance_value` float NOT NULL,
  `spirality_value_min_value` float NOT NULL,
  `spirality_value_max_value` float NOT NULL,
  `uom_of_spirality_value` varchar(8) NOT NULL,
  `test_method_for_seam_slippage_resistance_iso_2_warp` varchar(10) NOT NULL,
  `seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op` char(2) NOT NULL,
  `seam_slippage_resistance_iso_2_in_warp_tolerance_value` float NOT NULL,
  `seam_slippage_resistance_iso_2_in_warp_min_value` float NOT NULL,
  `seam_slippage_resistance_iso_2_in_warp_max_value` float NOT NULL,
  `uom_of_seam_slippage_resistance_iso_2_in_warp` varchar(4) NOT NULL,
  `uom_of_seam_slippage_resistance_iso_2_in_warp_for_load` varchar(4) NOT NULL,
  `test_method_for_seam_slippage_resistance_iso_2_weft` varchar(15) NOT NULL,
  `seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op` char(2) NOT NULL,
  `seam_slippage_resistance_iso_2_in_weft_tolerance_value` float NOT NULL,
  `seam_slippage_resistance_iso_2_in_weft_min_value` float NOT NULL,
  `seam_slippage_resistance_iso_2_in_weft_max_value` float NOT NULL,
  `uom_of_seam_slippage_resistance_iso_2_in_weft_for_load` float(4,0) NOT NULL,
  `uom_of_seam_slippage_resistance_iso_2_in_weft` varchar(8) NOT NULL,
  `test_method_for_seam_slippage_resistance_in_warp` varchar(15) NOT NULL,
  `seam_slippage_resistance_in_warp_tolerance_range_math_operator` char(2) NOT NULL,
  `seam_slippage_resistance_in_warp_tolerance_value` float NOT NULL,
  `seam_slippage_resistance_in_warp_min_value` float NOT NULL,
  `seam_slippage_resistance_in_warp_max_value` float NOT NULL,
  `uom_of_seam_slippage_resistance_in_warp` varchar(8) NOT NULL,
  `test_method_for_seam_slippage_resistance_in_weft` varchar(15) NOT NULL,
  `seam_slippage_resistance_in_weft_tolerance_range_math_operator` char(2) NOT NULL,
  `seam_slippage_resistance_in_weft_tolerance_value` float NOT NULL,
  `seam_slippage_resistance_in_weft_min_value` float NOT NULL,
  `seam_slippage_resistance_in_weft_max_value` float NOT NULL,
  `uom_of_seam_slippage_resistance_in_weft` varchar(8) NOT NULL,
  `test_method_for_seam_properties_seam_slippage_iso_astm_d_in_warp` char(15) NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op` char(2) NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value` float NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_warp_min_value` float NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_warp_max_value` float NOT NULL,
  `uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp` char(8) NOT NULL,
  `test_method_for_seam_properties_seam_slippage_iso_astm_d_in_weft` char(15) NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op` char(2) NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value` float NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_weft_min_value` float NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_weft_max_value` float NOT NULL,
  `uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft` char(8) NOT NULL,
  `test_method_for_seam_properties_seam_strength_iso_astm_d_in_warp` char(15) NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op` char(2) NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value` float NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_warp_min_value` float NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_warp_max_value` float NOT NULL,
  `uom_of_seam_properties_seam_strength_iso_astm_d_in_warp` varchar(8) NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op` char(2) NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value` float NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_weft_min_value` float NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_weft_max_value` float NOT NULL,
  `uom_of_seam_properties_seam_strength_iso_astm_d_in_weft` varchar(8) NOT NULL,
  `ph_value_tolerance_range_math_operator` char(2) NOT NULL,
  `ph_value_tolerance_value` float NOT NULL,
  `ph_value_min_value` float NOT NULL,
  `ph_value_max_value` float NOT NULL,
  `uom_of_ph_value` varchar(8) NOT NULL,
  `smoothness_appearance_tolerance_range_math_op` char(2) NOT NULL,
  `smoothness_appearance_tolerance_value` float NOT NULL,
  `smoothness_appearance_min_value` float NOT NULL,
  `smoothness_appearance_max_value` float NOT NULL,
  `uom_of_smoothness_appearance` varchar(8) NOT NULL,
  `print_duribility_m_s_c_15_washing_time_value` float NOT NULL,
  `print_duribility_m_s_c_15_value` float NOT NULL,
  `uom_of_print_duribility_m_s_c_15` varchar(8) NOT NULL,
  `description_or_type_for_iron_temperature` varchar(20) NOT NULL,
  `iron_ability_of_woven_fabric_tolerance_range_math_op` char(2) NOT NULL,
  `iron_ability_of_woven_fabric_tolerance_value` float NOT NULL,
  `iron_ability_of_woven_fabric_min_value` float NOT NULL,
  `iron_ability_of_woven_fabric_max_value` float NOT NULL,
  `uom_of_iron_ability_of_woven_fabric` varchar(8) NOT NULL,
  `color_fastess_to_artificial_daylight_blue_wool_scale` varchar(8) NOT NULL,
  `color_fastess_to_artificial_daylight_tolerance_range_math_op` char(2) NOT NULL,
  `color_fastess_to_artificial_daylight_tolerance_value` float NOT NULL,
  `color_fastess_to_artificial_daylight_min_value` float NOT NULL,
  `color_fastess_to_artificial_daylight_max_value` float NOT NULL,
  `uom_of_color_fastess_to_artificial_daylight` varchar(8) NOT NULL,
  `test_method_for_moisture_content` varchar(25) NOT NULL,
  `moisture_content_tolerance_range_math_op` varchar(8) NOT NULL,
  `moisture_content_tolerance_value` float NOT NULL,
  `moisture_content_min_value` float NOT NULL,
  `moisture_content_max_value` float NOT NULL,
  `uom_of_moisture_content` varchar(8) NOT NULL,
  `test_method_for_evaporation_rate_quick_drying` varchar(25) NOT NULL,
  `evaporation_rate_quick_drying_tolerance_range_math_op` char(2) NOT NULL,
  `evaporation_rate_quick_drying_tolerance_value` float NOT NULL,
  `evaporation_rate_quick_drying_min_value` float NOT NULL,
  `evaporation_rate_quick_drying_max_value` float NOT NULL,
  `uom_of_evaporation_rate_quick_drying` varchar(8) NOT NULL,
  `description_or_type_for_percentage_of_total_cotton_content` varchar(20) NOT NULL,
  `percentage_of_total_cotton_content_value` float DEFAULT NULL,
  `percentage_of_total_cotton_content_tolerance_range_math_operator` char(2) DEFAULT NULL,
  `percentage_of_total_cotton_content_tolerance_value` float DEFAULT NULL,
  `percentage_of_total_cotton_content_min_value` float DEFAULT NULL,
  `percentage_of_total_cotton_content_max_value` float DEFAULT NULL,
  `uom_of_percentage_of_total_cotton_content` varchar(8) DEFAULT NULL,
  `description_or_type_for_percentage_of_total_polyester_content` varchar(20) NOT NULL,
  `percentage_of_total_polyester_content_value` float DEFAULT NULL,
  `percentage_of_total_polyester_content_tolerance_range_math_op` char(2) DEFAULT NULL,
  `percentage_of_total_polyester_content_tolerance_value` float DEFAULT NULL,
  `percentage_of_total_polyester_content_min_value` float DEFAULT NULL,
  `percentage_of_total_polyester_content_max_value` float DEFAULT NULL,
  `uom_of_percentage_of_total_polyester_content` varchar(8) DEFAULT NULL,
  `description_or_type_for_total_other_fiber` varchar(20) NOT NULL,
  `percentage_of_total_other_fiber_content_value` float DEFAULT NULL,
  `percentage_of_total_other_fiber_content_tolerance_range_math_op` char(2) DEFAULT NULL,
  `percentage_of_total_other_fiber_content_tolerance_value` float DEFAULT NULL,
  `percentage_of_total_other_fiber_content_min_value` float DEFAULT NULL,
  `percentage_of_total_other_fiber_content_max_value` float NOT NULL,
  `uom_of_percentage_of_total_other_fiber_content` varchar(8) NOT NULL,
  `description_or_type_for_percentage_of_warp_cotton_content` float NOT NULL,
  `percentage_of_warp_cotton_content_value` float NOT NULL,
  `percentage_of_warp_cotton_content_tolerance_range_math_operator` char(2) NOT NULL,
  `percentage_of_warp_cotton_content_tolerance_value` float NOT NULL,
  `percentage_of_warp_cotton_content_min_value` float NOT NULL,
  `uom_of_percentage_of_warp_cotton_content` varchar(8) NOT NULL,
  `description_or_type_for_percentage_of_warp_polyester_content` varchar(20) NOT NULL,
  `percentage_of_warp_polyester_content_value` float NOT NULL,
  `percentage_of_warp_polyester_content_tolerance_range_math_op` char(2) NOT NULL,
  `percentage_of_warp_polyester_content_tolerance_value` float NOT NULL,
  `percentage_of_warp_polyester_content_min_value` float NOT NULL,
  `percentage_of_warp_polyester_content_max_value` float NOT NULL,
  `uom_of_percentage_of_warp_polyester_content` varchar(8) NOT NULL,
  `description_or_type_for_warp_other_fiber` varchar(20) NOT NULL,
  `percentage_of_warp_other_fiber_content_value` float NOT NULL,
  `percentage_of_warp_other_fiber_content_tolerance_range_math_op` char(2) NOT NULL,
  `percentage_of_warp_other_fiber_content_tolerance_value` float NOT NULL,
  `percentage_of_warp_other_fiber_content_min_value` float DEFAULT NULL,
  `percentage_of_warp_other_fiber_content_max_value` float DEFAULT NULL,
  `uom_of_percentage_of_warp_other_fiber_content` varchar(8) DEFAULT NULL,
  `description_or_type_for_percentage_of_weft_cotton_content` varchar(20) NOT NULL,
  `percentage_of_weft_cotton_content_value` float NOT NULL,
  `percentage_of_weft_cotton_content_tolerance_range_math_op` char(2) NOT NULL,
  `percentage_of_weft_cotton_content_tolerance_value` float NOT NULL,
  `percentage_of_weft_cotton_content_min_value` float NOT NULL,
  `percentage_of_weft_cotton_content_max_value` float NOT NULL,
  `uom_of_percentage_of_weft_cotton_content` varchar(5) NOT NULL,
  `description_or_type_for_percentage_of_weft_polyester_content` varchar(20) NOT NULL,
  `percentage_of_weft_polyester_content_value` float DEFAULT NULL,
  `percentage_of_weft_polyester_content_tolerance_range_math_op` char(2) DEFAULT NULL,
  `percentage_of_weft_polyester_content_tolerance_value` float DEFAULT NULL,
  `percentage_of_weft_polyester_content_min_value` float DEFAULT NULL,
  `percentage_of_weft_polyester_content_max_value` float DEFAULT NULL,
  `uom_of_percentage_of_weft_polyester_content` varchar(5) DEFAULT NULL,
  `description_or_type_for_weft_other_fiber` varchar(20) NOT NULL,
  `percentage_of_weft_other_fiber_content_value` float DEFAULT NULL,
  `percentage_of_weft_other_fiber_content_tolerance_range_math_op` char(2) DEFAULT NULL,
  `percentage_of_weft_other_fiber_content_tolerance_value` float DEFAULT NULL,
  `percentage_of_weft_other_fiber_content_min_value` float DEFAULT NULL,
  `percentage_of_weft_other_fiber_content_max_value` float DEFAULT NULL,
  `uom_of_percentage_of_weft_other_fiber_content` varchar(8) DEFAULT NULL,
  `recording_person_id` varchar(15) NOT NULL,
  `recording_person_name` varchar(15) NOT NULL,
  `recording_time` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of defining_qc_standard_for_finishing_process
-- ----------------------------
INSERT INTO `defining_qc_standard_for_finishing_process` VALUES ('1', '5893/2020', 'version_28', 'Pillow Front', 'Ikea', 'Beige', '50', 'Finishing', 'ISO 105 X12', 'select', '0', '0', '0', 'uom_of_cf_', 'ISO 105 X12', 'se', '0', '0', '0', 'uom_of_cf_', 'ISO 6330, ISO 5', '', '0', '0', 'celcius', 'ISO 6330, ISO 5', '', '0', '0', 'celcius', 'ISO 6330, ISO 5077, ', '', '0', '0', 'celcius', 'ISO 6330, ISO 5', '', '0', '0', 'celcius', 'ISO 7211-5', '0', 'se', '0', '0', '0', 'select', 'ISO 7211-5', '0', 'se', '0', '0', '0', 'select', 'ISO 3801', '0', '', '0', '0', '0', 'select', 'ISO 7211-2', '0', 'se', '0', '0', '0', 'select', 'ISO 7211-2', '0', 'se', '0', '0', '0', 'select', 'ISO 12945-2', 'select', '', 'select', '0', '0', '0', 'uom_of_surface_', 'ISO 13934-1', 'se', '0', '0', '0', 'select', 'ISO 13934-1', 'se', '0', '0', '0', 'select', 'ISO 13937-2', 'se', '0', '0', '0', 'select', 'ISO 13937-', 'se', '0', '0', '0', 'select', 'ISO 13935-2', 'se', '0', '0', '0', 'select', 'ISO 13935-2', 'se', '0', '0', '0', 'select', 'ISO 12947-2', '', 'select', '0', '0', '0', 'uom', 'ISO 12947-2', '0', '0', '0', 'ISO 12947-2', '', 'se', '0', '0', '0', '%', '(ISO 14184-1', 'se', '0', '0', '0', 'select', 'ISO 105 D01', 'se', '0', '0', '0', 'value', 'ISO 105 D01', 'se', '0', '0', '0', 'value', 'ISO 105 C6', 'se', '0', '0', '0', '%', 'ISO 105 C6', 'se', '0', '0', '0', '%', 'ISO 105 C6', 'se', '0', '0', '0', '%', 'ISO 105 E04', 'se', '0', '0', '0', 'value', 'select', 'se', '0', '0', '0', 'ISO 105 ', 'select', 'se', '0', '0', '0', 'ISO 105 ', 'select', 'se', '0', '0', '0', 'ISO 105 ', 'select', 'se', '0', '0', '0', 'ISO 105 ', 'select', 'se', '0', '0', '0', 'ISO 105 ', 'select', 'se', '0', '0', '0', 'ISO 105 ', 'select', 'se', '0', '0', '0', 'ISO 105 ', 'select', 'se', '0', '0', '0', 'None', 'select', 'se', '0', '0', '0', 'None', 'select', 'se', '0', '0', '0', 'value', 'select', 'se', '0', '0', '0', 'ISO 4920', '≥', '70', '70', '100', '0', 'AATCC 22', '≥', '50', '20', '70', '0', 'ISO 4920', 'select', 'se', '0', '0', '0', 'C11', 'select', 'se', '0', '0', '0', 'C10A', 'select', 'on', '0', '0', '0', '0', 'ISO 105 ', 'select', 'se', '0', '0', '0', 'ISO 105 ', 'select', 'se', '0', '0', '0', 'DIN V 53', 'select', 'se', '0', '0', '0', 'DIN V 53', 'select', 'se', '0', '0', '0', 'ISO 105 ', 'select', 'se', '0', '0', '0', 'ISO 105 ', 'select', 'se', '0', '0', '0', 'ISO 105 ', 'select', 'se', '0', '0', '0', 'Null', '', '0', '0', '0', '', '', 'se', '0', '0', '0', 'value', 'se', '≤', '0', '0', '0', 'select', 'ISO 9073-12', 'se', '0', '0', '0', '%', 'ISO 9073-12', 'se', '0', '0', '0', '%', 'ISO 9073-12', 'se', '0', '0', '0', '%', 'se', '0', '0', '0', 'select', 'se', '0', '0', '0', '%', 'ISO 13936-', 'se', '0', '0', '0', 'mm', 'ISO ', 'select', 'se', '0', '0', '0', '0', 'select', 'ISO 13936-1', 'se', '0', '0', '0', 'select', 'ISO 13936-1', 'se', '0', '0', '0', 'select', 'ASTM D 1683', 'se', '0', '0', '0', 'select', 'ASTM D 1683', 'se', '0', '0', '0', 'select', 'ASTM D 1683', 'se', '0', '0', '0', 'select', 'se', '0', '0', '0', 'select', '0', '0', '0', '0', '%', 'se', '0', '0', '0', '%', '0', '0', 'Minute', 'select', 'se', '0', '0', '0', '%', 'select', 'se', '0', '0', '0', '%', 'Moiture Content', '≤', '0', '0', '0', '%', 'TM 10', 'se', '0', '0', '0', '%', '', '0', 'se', '0', '0', '0', '%', '', '0', 'se', '0', '0', '0', '%', 'Null', '0', 'se', '0', '0', '0', '%', '0', '0', 'se', '0', '0', '%', '', '0', 'se', '0', '0', '0', '%', 'Null', '0', 'se', '0', '0', '0', '%', '', '0', 'se', '0', '0', '0', '%', '', '0', '\n	', '0', '0', '0', '%', 'Null', '0', 'se', '0', '0', '0', '%', 'iftekhar', 'iftekhar', '2020-12-27 12:4');
INSERT INTO `defining_qc_standard_for_finishing_process` VALUES ('2', '5893/2020', 'version_27', 'Pillow Back', 'Ikea', 'Beige', '50', 'Finishing', 'ISO 105 X12', 'select', '0', '0', '0', 'uom_of_cf_', 'ISO 105 X12', 'se', '0', '0', '0', 'uom_of_cf_', 'ISO 6330, ISO 5', '', '0', '0', 'celcius', 'ISO 6330, ISO 5', '', '0', '0', 'celcius', 'ISO 6330, ISO 5077, ', '', '0', '0', 'celcius', 'ISO 6330, ISO 5', '', '0', '0', 'celcius', 'ISO 7211-5', '0', 'se', '0', '0', '0', 'select', 'ISO 7211-5', '0', 'se', '0', '0', '0', 'select', 'ISO 3801', '0', '', '0', '0', '0', 'select', 'ISO 7211-2', '0', 'se', '0', '0', '0', 'select', 'ISO 7211-2', '0', 'se', '0', '0', '0', 'select', 'ISO 12945-2', 'select', '', 'select', '0', '0', '0', 'uom_of_surface_', 'ISO 13934-1', 'se', '0', '0', '0', 'select', 'ISO 13934-1', 'se', '0', '0', '0', 'select', 'ISO 13937-2', 'se', '0', '0', '0', 'select', 'ISO 13937-', 'se', '0', '0', '0', 'select', 'ISO 13935-2', 'se', '0', '0', '0', 'select', 'ISO 13935-2', 'se', '0', '0', '0', 'select', 'ISO 12947-2', '', 'select', '0', '0', '0', 'uom', 'ISO 12947-2', '0', '0', '0', 'ISO 12947-2', '', 'se', '0', '0', '0', '%', '(ISO 14184-1', 'se', '0', '0', '0', 'select', 'ISO 105 D01', 'se', '0', '0', '0', 'value', 'ISO 105 D01', 'se', '0', '0', '0', 'value', 'ISO 105 C6', 'se', '0', '0', '0', '%', 'ISO 105 C6', 'se', '0', '0', '0', '%', 'ISO 105 C6', 'se', '0', '0', '0', '%', 'ISO 105 E04', 'se', '0', '0', '0', 'value', 'select', 'se', '0', '0', '0', 'ISO 105 ', 'select', 'se', '0', '0', '0', 'ISO 105 ', 'select', 'se', '0', '0', '0', 'ISO 105 ', 'select', 'se', '0', '0', '0', 'ISO 105 ', 'select', 'se', '0', '0', '0', 'ISO 105 ', 'select', 'se', '0', '0', '0', 'ISO 105 ', 'select', 'se', '0', '0', '0', 'ISO 105 ', 'select', 'se', '0', '0', '0', 'None', 'select', 'se', '0', '0', '0', 'None', 'select', 'se', '0', '0', '0', 'value', 'select', 'se', '0', '0', '0', 'ISO 4920', 'select', 'se', '0', '0', '0', 'ISO 4920', 'select', 'se', '0', '0', '0', 'ISO 4920', 'select', 'se', '0', '0', '0', 'C11', 'select', 'se', '0', '0', '0', 'C10A', 'select', 'on', '0', '0', '0', '0', 'ISO 105 ', 'select', 'se', '0', '0', '0', 'ISO 105 ', 'select', 'se', '0', '0', '0', 'DIN V 53', 'select', 'se', '0', '0', '0', 'DIN V 53', 'select', 'se', '0', '0', '0', 'ISO 105 ', 'select', 'se', '0', '0', '0', 'ISO 105 ', 'select', 'se', '0', '0', '0', 'ISO 105 ', 'select', 'se', '0', '0', '0', 'Null', '', '0', '0', '0', '', '', 'se', '0', '0', '0', 'value', 'se', '≤', '0', '0', '0', 'select', 'ISO 9073-12', 'se', '0', '0', '0', '%', 'ISO 9073-12', 'se', '0', '0', '0', '%', 'ISO 9073-12', 'se', '0', '0', '0', '%', 'se', '0', '0', '0', 'select', 'se', '0', '0', '0', '%', 'ISO 13936-', 'se', '0', '0', '0', 'mm', 'ISO ', 'select', 'se', '0', '0', '0', '0', 'select', 'ISO 13936-1', 'se', '0', '0', '0', 'select', 'ISO 13936-1', 'se', '0', '0', '0', 'select', 'ASTM D 1683', 'se', '0', '0', '0', 'select', 'ASTM D 1683', 'se', '0', '0', '0', 'select', 'ASTM D 1683', 'se', '0', '0', '0', 'select', 'se', '0', '0', '0', 'select', '0', '0', '0', '0', '%', 'se', '0', '0', '0', '%', '0', '0', 'Minute', 'select', 'se', '0', '0', '0', '%', 'select', 'se', '0', '0', '0', '%', 'Moiture Content', '≤', '0', '0', '0', '%', 'TM 10', 'se', '0', '0', '0', '%', '', '0', 'se', '0', '0', '0', '%', '', '0', 'se', '0', '0', '0', '%', 'Null', '0', 'se', '0', '0', '0', '%', '0', '0', 'se', '0', '0', '%', '', '0', 'se', '0', '0', '0', '%', 'Null', '0', 'se', '0', '0', '0', '%', '', '0', 'se', '0', '0', '0', '%', '', '0', '\n	', '0', '0', '0', '%', 'Null', '0', 'se', '0', '0', '0', '%', 'iftekhar', 'iftekhar', '2020-12-29 10:4');

-- ----------------------------
-- Table structure for `defining_qc_standard_for_finishing_process_bkup`
-- ----------------------------
DROP TABLE IF EXISTS `defining_qc_standard_for_finishing_process_bkup`;
CREATE TABLE `defining_qc_standard_for_finishing_process_bkup` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(50) NOT NULL,
  `version_id` varchar(30) NOT NULL,
  `version_number` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `finish_width_in_inch` float NOT NULL,
  `standard_for_which_process` varchar(50) NOT NULL,
  `cf_to_rubbing_dry_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_rubbing_dry_tolerance_value` float NOT NULL,
  `cf_to_rubbing_dry_min_value` float NOT NULL,
  `cf_to_rubbing_dry_max_value` float NOT NULL,
  `uom_of_cf_to_rubbing_dry` varchar(20) NOT NULL,
  `cf_to_rubbing_wet_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_rubbing_wet_tolerance_value` float NOT NULL,
  `cf_to_rubbing_wet_min_value` float NOT NULL,
  `cf_to_rubbing_wet_max_value` float NOT NULL,
  `uom_of_cf_to_rubbing_wet` varchar(20) NOT NULL,
  `washing_cycle_for_warp_for_washing_before_iron` varchar(20) NOT NULL,
  `dimensional_stability_to_warp_washing_before_iron_min_value` float NOT NULL,
  `dimensional_stability_to_warp_washing_before_iron_max_value` float NOT NULL,
  `uom_of_dimensional_stability_to_warp_washing_before_iron` varchar(10) NOT NULL,
  `washing_cycle_for_weft_for_washing_before_iron` varchar(20) NOT NULL,
  `dimensional_stability_to_weft_washing_before_iron_min_value` float NOT NULL,
  `dimensional_stability_to_weft_washing_before_iron_max_value` float NOT NULL,
  `uom_of_dimensional_stability_to_weft_washing_before_iron` varchar(10) NOT NULL,
  `dimensional_stability_to_warp_washing_after_iron_min_value` float NOT NULL,
  `dimensional_stability_to_warp_washing_after_iron_max_value` float NOT NULL,
  `uom_of_dimensional_stability_to_warp_washing_after_iron` varchar(10) NOT NULL,
  `dimensional_stability_to_weft_washing_after_iron_min_value` float NOT NULL,
  `dimensional_stability_to_weft_washing_after_iron_max_value` float NOT NULL,
  `uom_of_dimensional_stability_to_weft_washing_after_iron` varchar(10) NOT NULL,
  `change_in_warp_for_dry_cleaning_min_value` float NOT NULL,
  `change_in_warp_for_dry_cleaning_max_value` float NOT NULL,
  `uom_of_change_in_warp_for_dry_cleaning` varchar(10) NOT NULL,
  `change_in_weft_for_dry_cleaning_min_value` float NOT NULL,
  `change_in_weft_for_dry_cleaning_max_value` float NOT NULL,
  `uom_of_change_in_weft_for_dry_cleaning` varchar(10) NOT NULL,
  `warp_yarn_count_value` float NOT NULL,
  `warp_yarn_count_tolerance_range_math_operator` varchar(20) NOT NULL,
  `warp_yarn_count_tolerance_value` float NOT NULL,
  `warp_yarn_count_min_value` float NOT NULL,
  `warp_yarn_count_max_value` float NOT NULL,
  `uom_of_warp_yarn_count_value` varchar(10) DEFAULT NULL,
  `weft_yarn_count_value` float NOT NULL,
  `weft_yarn_count_tolerance_range_math_operator` varchar(10) NOT NULL,
  `weft_yarn_count_tolerance_value` float NOT NULL,
  `weft_yarn_count_min_value` float NOT NULL,
  `weft_yarn_count_max_value` float NOT NULL,
  `uom_of_weft_yarn_count_value` varchar(10) NOT NULL,
  `mass_per_unit_per_area_value` float DEFAULT NULL,
  `mass_per_unit_per_area_tolerance_range_math_operator` varchar(20) DEFAULT NULL,
  `mass_per_unit_per_area_tolerance_value` float DEFAULT NULL,
  `mass_per_unit_per_area_min_value` float DEFAULT NULL,
  `mass_per_unit_per_area_max_value` float DEFAULT NULL,
  `uom_of_mass_per_unit_per_area_value` varchar(10) DEFAULT NULL,
  `no_of_threads_in_warp_value` float DEFAULT NULL,
  `no_of_threads_in_warp_tolerance_range_math_operator` varchar(20) DEFAULT NULL,
  `no_of_threads_in_warp_tolerance_value` float DEFAULT NULL,
  `no_of_threads_in_warp_min_value` float DEFAULT NULL,
  `no_of_threads_in_warp_max_value` float DEFAULT NULL,
  `uom_of_no_of_threads_in_warp_value` varchar(10) DEFAULT NULL,
  `no_of_threads_in_weft_value` float DEFAULT NULL,
  `no_of_threads_in_weft_tolerance_range_math_operator` varchar(20) DEFAULT NULL,
  `no_of_threads_in_weft_tolerance_value` float DEFAULT NULL,
  `no_of_threads_in_weft_min_value` float DEFAULT NULL,
  `no_of_threads_in_weft_max_value` float DEFAULT NULL,
  `uom_of_no_of_threads_in_weft_value` varchar(10) DEFAULT NULL,
  `surface_fuzzing_and_pilling_tolerance_range_math_operator` varchar(20) DEFAULT NULL,
  `surface_fuzzing_and_pilling_tolerance_value` float DEFAULT NULL,
  `surface_fuzzing_and_pilling_min_value` float DEFAULT NULL,
  `surface_fuzzing_and_pilling_max_value` float DEFAULT NULL,
  `uom_of_surface_fuzzing_and_pilling_value` varchar(10) DEFAULT NULL,
  `tensile_properties_in_warp_value_tolerance_range_math_operator` varchar(20) DEFAULT NULL,
  `tensile_properties_in_warp_value_tolerance_value` float DEFAULT NULL,
  `tensile_properties_in_warp_value_min_value` float DEFAULT NULL,
  `tensile_properties_in_warp_value_max_value` float DEFAULT NULL,
  `uom_of_tensile_properties_in_warp_value` varchar(10) DEFAULT NULL,
  `tear_force_in_warp_value_tolerance_range_math_operator` varchar(20) DEFAULT NULL,
  `tear_force_in_warp_value_tolerance_value` float DEFAULT NULL,
  `tear_force_in_warp_value_min_value` float DEFAULT NULL,
  `tear_force_in_warp_value_max_value` float DEFAULT NULL,
  `uom_of_tear_force_in_warp_value` varchar(10) DEFAULT NULL,
  `tear_force_in_weft_value_tolerance_range_math_operator` varchar(20) DEFAULT NULL,
  `tear_force_in_weft_value_tolerance_value` float DEFAULT NULL,
  `tear_force_in_weft_value_min_value` float DEFAULT NULL,
  `tear_force_in_weft_value_max_value` float DEFAULT NULL,
  `uom_of_tear_force_in_weft_value` varchar(10) DEFAULT NULL,
  `seam_strength_in_warp_value_tolerance_range_math_operator` varchar(20) DEFAULT NULL,
  `seam_strength_in_warp_value_tolerance_value` float DEFAULT NULL,
  `seam_strength_in_warp_value_min_value` float DEFAULT NULL,
  `seam_strength_in_warp_value_max_value` float DEFAULT NULL,
  `uom_of_seam_strength_in_warp_value` varchar(10) DEFAULT NULL,
  `seam_strength_in_weft_value_tolerance_range_math_operator` varchar(20) DEFAULT NULL,
  `seam_strength_in_weft_value_tolerance_value` float DEFAULT NULL,
  `seam_strength_in_weft_value_min_value` float DEFAULT NULL,
  `seam_strength_in_weft_value_max_value` float DEFAULT NULL,
  `uom_of_seam_strength_in_weft_value` varchar(10) DEFAULT NULL,
  `abrasion_resistance_s_change_value_math_op` varchar(20) DEFAULT NULL,
  `abrasion_resistance_s_change_value_tolerance_value` float DEFAULT NULL,
  `abrasion_resistance_s_change_value_min_value` float DEFAULT NULL,
  `abrasion_resistance_s_change_value_max_value` float DEFAULT NULL,
  `uom_of_abrasion_resistance_s_change_value` varchar(10) DEFAULT NULL,
  `abrasion_resistance_thread_break` varchar(20) DEFAULT NULL,
  `revolution` varchar(20) DEFAULT NULL,
  `print_durability` varchar(20) DEFAULT NULL,
  `mass_loss_in_abrasion_test_value_tolerance_range_math_operator` varchar(20) DEFAULT NULL,
  `mass_loss_in_abrasion_test_value_tolerance_value` float DEFAULT NULL,
  `mass_loss_in_abrasion_test_value_min_value` float DEFAULT NULL,
  `mass_loss_in_abrasion_test_value_max_value` float DEFAULT NULL,
  `uom_of_mass_loss_in_abrasion_test_value` varchar(10) DEFAULT NULL,
  `formaldehyde_content_tolerance_range_math_operator` varchar(20) DEFAULT NULL,
  `formaldehyde_content_tolerance_value` float DEFAULT NULL,
  `formaldehyde_content_min_value` float DEFAULT NULL,
  `formaldehyde_content_max_value` float DEFAULT NULL,
  `uom_of_formaldehyde_content` varchar(10) DEFAULT NULL,
  `cf_to_dry_cleaning_color_change_tolerance_range_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_dry_cleaning_color_change_tolerance_value` float DEFAULT NULL,
  `cf_to_dry_cleaning_color_change_min_value` float DEFAULT NULL,
  `cf_to_dry_cleaning_color_change_max_value` float DEFAULT NULL,
  `uom_of_cf_to_dry_cleaning_color_change` varchar(10) DEFAULT NULL,
  `cf_to_dry_cleaning_staining_tolerance_range_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_dry_cleaning_staining_tolerance_value` float DEFAULT NULL,
  `cf_to_dry_cleaning_staining_min_value` float DEFAULT NULL,
  `cf_to_dry_cleaning_staining_max_value` float DEFAULT NULL,
  `uom_of_cf_to_dry_cleaning_staining` varchar(10) DEFAULT NULL,
  `cf_to_washing_color_change_tolerance_range_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_washing_color_change_tolerance_value` float DEFAULT NULL,
  `cf_to_washing_color_change_min_value` float DEFAULT NULL,
  `cf_to_washing_color_change_max_value` float DEFAULT NULL,
  `uom_of_cf_to_washing_color_change` varchar(10) DEFAULT NULL,
  `cf_to_washing_staining_tolerance_range_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_washing_staining_tolerance_value` float DEFAULT NULL,
  `cf_to_washing_staining_min_value` float DEFAULT NULL,
  `cf_to_washing_staining_max_value` float DEFAULT NULL,
  `uom_of_cf_to_washing_staining` varchar(10) DEFAULT NULL,
  `cf_to_perspiration_acid_color_change_tolerance_range_math_op` varchar(20) DEFAULT NULL,
  `cf_to_perspiration_acid_color_change_tolerance_value` float DEFAULT NULL,
  `cf_to_perspiration_acid_color_change_min_value` float DEFAULT NULL,
  `cf_to_perspiration_acid_color_change_max_value` float DEFAULT NULL,
  `uom_of_cf_to_perspiration_acid_color_change` varchar(10) DEFAULT NULL,
  `cf_to_perspiration_acid_staining_tolerance_range_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_perspiration_acid_staining_value` float DEFAULT NULL,
  `cf_to_perspiration_acid_staining_min_value` float DEFAULT NULL,
  `cf_to_perspiration_acid_staining_max_value` float DEFAULT NULL,
  `uom_of_cf_to_perspiration_acid_staining` varchar(10) DEFAULT NULL,
  `cf_to_perspiration_alkali_color_change_tolerance_range_math_op` varchar(20) DEFAULT NULL,
  `cf_to_perspiration_alkali_color_change_tolerance_value` float DEFAULT NULL,
  `cf_to_perspiration_alkali_color_change_min_value` float DEFAULT NULL,
  `cf_to_perspiration_alkali_color_change_max_value` float DEFAULT NULL,
  `uom_of_cf_to_perspiration_alkali_color_change` varchar(10) DEFAULT NULL,
  `cf_to_water_color_change_tolerance_range_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_water_color_change_tolerance_value` float DEFAULT NULL,
  `cf_to_water_color_change_min_value` float DEFAULT NULL,
  `cf_to_water_color_change_max_value` float DEFAULT NULL,
  `uom_of_cf_to_water_color_change` varchar(10) DEFAULT NULL,
  `cf_to_water_staining_tolerance_range_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_water_staining_tolerance_value` float DEFAULT NULL,
  `cf_to_water_staining_min_value` float DEFAULT NULL,
  `cf_to_water_staining_max_value` float DEFAULT NULL,
  `uom_of_cf_to_water_staining` varchar(10) DEFAULT NULL,
  `cf_to_water_sotting_staining_tolerance_range_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_water_sotting_staining_tolerance_value` float DEFAULT NULL,
  `cf_to_water_sotting_staining_min_value` float DEFAULT NULL,
  `cf_to_water_sotting_staining_max_value` float DEFAULT NULL,
  `uom_of_cf_to_water_sotting_staining` varchar(10) DEFAULT NULL,
  `cf_to_surface_wetting_staining_tolerance_range_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_surface_wetting_staining_tolerance_value` float DEFAULT NULL,
  `cf_to_surface_wetting_staining_min_value` float DEFAULT NULL,
  `cf_to_surface_wetting_staining_max_value` float DEFAULT NULL,
  `uom_of_cf_to_surface_wetting_staining` varchar(10) DEFAULT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op` varchar(20) DEFAULT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value` float DEFAULT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_min_value` float DEFAULT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_max_value` float DEFAULT NULL,
  `uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change` varchar(10) DEFAULT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_staining_toler_range_math_op` varchar(20) DEFAULT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value` float DEFAULT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_staining_min_value` float DEFAULT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_staining_max_value` float DEFAULT NULL,
  `uom_of_cf_to_hydrolysis_of_reactive_dyes_staining` varchar(10) DEFAULT NULL,
  `cf_to_oidative_bleach_damage_color_change_tolerance_range_mat_op` varchar(20) DEFAULT NULL,
  `cf_to_oidative_bleach_damage_color_change_tolerance_value` float DEFAULT NULL,
  `cf_to_oidative_bleach_damage_color_change_min_value` float DEFAULT NULL,
  `cf_to_oidative_bleach_damage_color_change_max_value` float DEFAULT NULL,
  `uom_of_cf_to_oidative_bleach_damage_color_change` varchar(10) DEFAULT NULL,
  `cf_to_phenolic_yellowing_staining_tolerance_range_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_phenolic_yellowing_staining_tolerance_value` float DEFAULT NULL,
  `cf_to_phenolic_yellowing_staining_min_value` float DEFAULT NULL,
  `cf_to_phenolic_yellowing_staining_max_value` float DEFAULT NULL,
  `uom_of_cf_to_phenolic_yellowing_staining` varchar(10) DEFAULT NULL,
  `cf_to_saliva_color_change_tolerance_range_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_pvc_migration_staining_tolerance_value` float DEFAULT NULL,
  `cf_to_pvc_migration_staining_min_value` float DEFAULT NULL,
  `cf_to_pvc_migration_staining_max_value` float DEFAULT NULL,
  `uom_of_cf_to_pvc_migration_staining` varchar(10) DEFAULT NULL,
  `cf_to_pvc_migration_staining_tolerance_range_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_saliva_color_change_tolerance_value` float DEFAULT NULL,
  `cf_to_saliva_color_change_min_value` float DEFAULT NULL,
  `cf_to_saliva_color_change_max_value` float DEFAULT NULL,
  `uom_of_cf_to_saliva_color_change` varchar(10) DEFAULT NULL,
  `cf_to_saliva_staining_tolerance_range_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_saliva_staining_tolerance_value` float DEFAULT NULL,
  `cf_to_saliva_staining_staining_min_value` float DEFAULT NULL,
  `cf_to_saliva_staining_max_value` float DEFAULT NULL,
  `uom_of_cf_to_saliva_staining` varchar(10) DEFAULT NULL,
  `cf_to_chlorinated_water_color_change_tolerance_range_math_op` varchar(20) DEFAULT NULL,
  `cf_to_chlorinated_water_color_change_tolerance_value` float DEFAULT NULL,
  `cf_to_chlorinated_water_color_change_min_value` float DEFAULT NULL,
  `cf_to_chlorinated_water_color_change_max_value` float DEFAULT NULL,
  `uom_of_cf_to_chlorinated_water_color_change` varchar(10) DEFAULT NULL,
  `cf_to_chlorinated_water_staining_tolerance_range_math_operator` varchar(5) DEFAULT NULL,
  `cf_to_chlorinated_water_staining_tolerance_value` float DEFAULT NULL,
  `cf_to_chlorinated_water_staining_min_value` float DEFAULT NULL,
  `cf_to_chlorinated_water_staining_max_value` float DEFAULT NULL,
  `uom_of_cf_to_chlorinated_water_staining` varchar(10) DEFAULT NULL,
  `cf_to_cholorine_bleach_color_change_tolerance_range_math_op` varchar(5) DEFAULT NULL,
  `cf_to_cholorine_bleach_color_change_tolerance_value` float DEFAULT NULL,
  `cf_to_cholorine_bleach_color_change_min_value` float DEFAULT NULL,
  `cf_to_cholorine_bleach_color_change_max_value` float DEFAULT NULL,
  `uom_of_cf_to_cholorine_bleach_color_change` varchar(10) DEFAULT NULL,
  `cf_to_cholorine_bleach_staining_tolerance_range_math_operator` varchar(5) DEFAULT NULL,
  `cf_to_cholorine_bleach_staining_tolerance_value` float DEFAULT NULL,
  `cf_to_cholorine_bleach_staining_min_value` float DEFAULT NULL,
  `cf_to_cholorine_bleach_staining_max_value` float DEFAULT NULL,
  `uom_of_cf_to_cholorine_bleach_staining` varchar(10) DEFAULT NULL,
  `cf_to_peroxide_bleach_color_change_tolerance_range_math_operator` varchar(5) DEFAULT NULL,
  `cf_to_peroxide_bleach_color_change_tolerance_value` float DEFAULT NULL,
  `cf_to_peroxide_bleach_color_change_min_value` float DEFAULT NULL,
  `cf_to_peroxide_bleach_color_change_max_value` float DEFAULT NULL,
  `uom_of_cf_to_peroxide_bleach_color_change` varchar(10) DEFAULT NULL,
  `cf_to_peroxide_bleach_staining_tolerance_range_math_operator` varchar(5) DEFAULT NULL,
  `cf_to_peroxide_bleach_staining_tolerance_value` float DEFAULT NULL,
  `cf_to_peroxide_bleach_staining_min_value` float DEFAULT NULL,
  `cf_to_peroxide_bleach_staining_max_value` float DEFAULT NULL,
  `uom_of_cf_to_peroxide_bleach_staining` varchar(10) DEFAULT NULL,
  `cross_staining_tolerance_range_math_operator` varchar(5) DEFAULT NULL,
  `cross_staining_tolerance_value` float DEFAULT NULL,
  `cross_staining_min_value` float DEFAULT NULL,
  `cross_staining_max_value` float DEFAULT NULL,
  `uom_of_cross_staining` varchar(10) DEFAULT NULL,
  `water_absorption_value_tolerance_range_math_operator` varchar(5) DEFAULT NULL,
  `water_absorption_value_tolerance_value` float DEFAULT NULL,
  `water_absorption_value_min_value` float DEFAULT NULL,
  `water_absorption_value_max_value` float DEFAULT NULL,
  `uom_of_water_absorption_value` varchar(10) DEFAULT NULL,
  `spirality_value_tolerance_range_math_operator` varchar(5) DEFAULT NULL,
  `spirality_value_tolerance_value` float DEFAULT NULL,
  `spirality_value_min_value` float DEFAULT NULL,
  `spirality_value_max_value` float DEFAULT NULL,
  `uom_of_spirality_value` varchar(10) DEFAULT NULL,
  `durable_press_value_tolerance_range_math_operator` varchar(5) DEFAULT NULL,
  `durable_press_value_tolerance_value` float DEFAULT NULL,
  `durable_press_value_min_value` float DEFAULT NULL,
  `durable_press_value_max_value` float DEFAULT NULL,
  `uom_of_durable_press_value` varchar(10) DEFAULT NULL,
  `ironability_of_woven_fabric_value_tolerance_range_math_operator` varchar(5) DEFAULT NULL,
  `ironability_of_woven_fabric_value_tolerance_value` float DEFAULT NULL,
  `ironability_of_woven_fabric_value_min_value` float DEFAULT NULL,
  `ironability_of_woven_fabric_value_max_value` float DEFAULT NULL,
  `uom_of_ironability_of_woven_fabric_value` varchar(10) DEFAULT NULL,
  `cf_to_artificial_light_value_tolerance_range_math_operator` varchar(5) DEFAULT NULL,
  `cf_to_artificial_light_value_tolerance_value` float DEFAULT NULL,
  `cf_to_artificial_light_value_min_value` float DEFAULT NULL,
  `cf_to_artificial_light_value_max_value` float DEFAULT NULL,
  `uom_of_cf_to_artificial_light_value` varchar(10) DEFAULT NULL,
  `moisture_content_in_percentage_min_value` float DEFAULT NULL,
  `moisture_content_in_percentage_max_value` float DEFAULT NULL,
  `uom_of_moisture_content_in_percentage` varchar(10) DEFAULT NULL,
  `evaporation_rate_in_percentage_min_value` float DEFAULT NULL,
  `evaporation_rate_in_percentage_max_value` float DEFAULT NULL,
  `uom_of_evaporation_rate_in_percentage` varchar(10) DEFAULT NULL,
  `percentage_of_total_cotton_content_value` float DEFAULT NULL,
  `percentage_of_total_cotton_content_tolerance_range_math_operator` varchar(10) DEFAULT NULL,
  `percentage_of_total_cotton_content_tolerance_value` float DEFAULT NULL,
  `percentage_of_total_cotton_content_min_value` float DEFAULT NULL,
  `percentage_of_total_cotton_content_max_value` float DEFAULT NULL,
  `uom_of_percentage_of_total_cotton_content` varchar(10) DEFAULT NULL,
  `percentage_of_total_polyester_content_value` float DEFAULT NULL,
  `percentage_of_total_polyester_content_tolerance_range_math_op` varchar(5) DEFAULT NULL,
  `percentage_of_total_polyester_content_tolerance_value` float DEFAULT NULL,
  `percentage_of_total_polyester_content_min_value` float DEFAULT NULL,
  `percentage_of_total_polyester_content_max_value` float DEFAULT NULL,
  `uom_of_percentage_of_total_polyester_content` varchar(10) DEFAULT NULL,
  `percentage_of_total_other_fiber_content_value` float DEFAULT NULL,
  `percentage_of_total_other_fiber_content_tolerance_range_math_op` varchar(5) DEFAULT NULL,
  `percentage_of_total_other_fiber_content_tolerance_value` float DEFAULT NULL,
  `percentage_of_total_other_fiber_content_min_value` float DEFAULT NULL,
  `percentage_of_total_other_fiber_content_max_value` float NOT NULL,
  `uom_of_percentage_of_total_other_fiber_content` varchar(10) NOT NULL,
  `percentage_of_warp_cotton_content_value` float NOT NULL,
  `percentage_of_warp_cotton_content_tolerance_range_math_operator` varchar(5) NOT NULL,
  `percentage_of_warp_cotton_content_tolerance_value` float NOT NULL,
  `percentage_of_warp_cotton_content_min_value` float NOT NULL,
  `uom_of_percentage_of_warp_cotton_content` varchar(10) NOT NULL,
  `percentage_of_warp_polyester_content_value` float NOT NULL,
  `percentage_of_warp_polyester_content_tolerance_range_math_op` varchar(5) NOT NULL,
  `percentage_of_warp_polyester_content_tolerance_value` float NOT NULL,
  `percentage_of_warp_polyester_content_min_value` float NOT NULL,
  `percentage_of_warp_polyester_content_max_value` float NOT NULL,
  `uom_of_percentage_of_warp_polyester_content` varchar(10) NOT NULL,
  `percentage_of_warp_other_fiber_content_value` float NOT NULL,
  `percentage_of_warp_other_fiber_content_tolerance_range_math_op` varchar(5) NOT NULL,
  `percentage_of_warp_other_fiber_content_tolerance_value` float NOT NULL,
  `percentage_of_warp_other_fiber_content_min_value` float DEFAULT NULL,
  `percentage_of_warp_other_fiber_content_max_value` float DEFAULT NULL,
  `uom_of_percentage_of_warp_other_fiber_content` varchar(10) DEFAULT NULL,
  `percentage_of_weft_cotton_content_value` float NOT NULL,
  `percentage_of_weft_cotton_content_tolerance_range_math_op` varchar(10) NOT NULL,
  `percentage_of_weft_cotton_content_tolerance_value` float NOT NULL,
  `percentage_of_weft_cotton_content_min_value` float NOT NULL,
  `percentage_of_weft_cotton_content_max_value` float NOT NULL,
  `uom_of_percentage_of_weft_cotton_content` float NOT NULL,
  `percentage_of_weft_polyester_content_value` float DEFAULT NULL,
  `percentage_of_weft_polyester_content_tolerance_range_math_op` varchar(8) DEFAULT NULL,
  `percentage_of_weft_polyester_content_tolerance_value` float DEFAULT NULL,
  `percentage_of_weft_polyester_content_min_value` float DEFAULT NULL,
  `percentage_of_weft_polyester_content_max_value` float DEFAULT NULL,
  `uom_of_percentage_of_weft_polyester_content` varchar(5) DEFAULT NULL,
  `percentage_of_weft_other_fiber_content_value` float DEFAULT NULL,
  `percentage_of_weft_other_fiber_content_tolerance_range_math_op` varchar(10) DEFAULT NULL,
  `percentage_of_weft_other_fiber_content_tolerance_value` float DEFAULT NULL,
  `percentage_of_weft_other_fiber_content_min_value` float DEFAULT NULL,
  `percentage_of_weft_other_fiber_content_max_value` float DEFAULT NULL,
  `uom_of_percentage_of_weft_other_fiber_content` varchar(10) DEFAULT NULL,
  `seam_slippage_resistance_in_warp_tolerance_range_math_operator` varchar(5) DEFAULT NULL,
  `seam_slippage_resistance_in_warp_tolerance_value` float DEFAULT NULL,
  `seam_slippage_resistance_in_warp_min_value` float DEFAULT NULL,
  `seam_slippage_resistance_in_warp_max_value` float DEFAULT NULL,
  `uom_of_seam_slippage_resistance_in_warp` varchar(10) DEFAULT NULL,
  `seam_slippage_resistance_in_weft_tolerance_range_math_operator` varchar(5) DEFAULT NULL,
  `seam_slippage_resistance_in_weft_tolerance_value` float DEFAULT NULL,
  `seam_slippage_resistance_in_weft_min_value` float DEFAULT NULL,
  `seam_slippage_resistance_in_weft_max_value` float DEFAULT NULL,
  `uom_of_seam_slippage_resistance_in_weft` varchar(10) DEFAULT NULL,
  `ph_value_tolerance_range_math_operator` varchar(5) DEFAULT NULL,
  `ph_value_tolerance_value` float DEFAULT NULL,
  `ph_value_min_value` float DEFAULT NULL,
  `ph_value_max_value` float DEFAULT NULL,
  `uom_of_ph_value` varchar(10) DEFAULT NULL,
  `recording_person_id` varchar(20) DEFAULT NULL,
  `recording_person_name` varchar(20) DEFAULT NULL,
  `recording_time` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of defining_qc_standard_for_finishing_process_bkup
-- ----------------------------

-- ----------------------------
-- Table structure for `defining_qc_standard_for_finishing_process_bkup_07_12_2020`
-- ----------------------------
DROP TABLE IF EXISTS `defining_qc_standard_for_finishing_process_bkup_07_12_2020`;
CREATE TABLE `defining_qc_standard_for_finishing_process_bkup_07_12_2020` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(50) NOT NULL,
  `version_id` varchar(30) NOT NULL,
  `version_number` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `finish_width_in_inch` float NOT NULL,
  `standard_for_which_process` varchar(50) NOT NULL,
  `cf_to_rubbing_dry_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_rubbing_dry_tolerance_value` float NOT NULL,
  `cf_to_rubbing_dry_min_value` float NOT NULL,
  `cf_to_rubbing_dry_max_value` float NOT NULL,
  `uom_of_cf_to_rubbing_dry` varchar(20) NOT NULL,
  `cf_to_rubbing_wet_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_rubbing_wet_tolerance_value` float NOT NULL,
  `cf_to_rubbing_wet_min_value` float NOT NULL,
  `cf_to_rubbing_wet_max_value` float NOT NULL,
  `uom_of_cf_to_rubbing_wet` varchar(20) NOT NULL,
  `washing_cycle_for_warp_for_washing_before_iron` varchar(20) NOT NULL,
  `dimensional_stability_to_warp_washing_before_iron_min_value` float NOT NULL,
  `dimensional_stability_to_warp_washing_before_iron_max_value` float NOT NULL,
  `uom_of_dimensional_stability_to_warp_washing_before_iron` varchar(10) NOT NULL,
  `washing_cycle_for_weft_for_washing_before_iron` varchar(20) NOT NULL,
  `dimensional_stability_to_weft_washing_before_iron_min_value` float NOT NULL,
  `dimensional_stability_to_weft_washing_before_iron_max_value` float NOT NULL,
  `uom_of_dimensional_stability_to_weft_washing_before_iron` varchar(10) NOT NULL,
  `washing_cycle_for_warp_for_washing_after_iron` varchar(20) NOT NULL,
  `dimensional_stability_to_warp_washing_after_iron_min_value` float NOT NULL,
  `dimensional_stability_to_warp_washing_after_iron_max_value` float NOT NULL,
  `uom_of_dimensional_stability_to_warp_washing_after_iron` varchar(10) NOT NULL,
  `washing_cycle_for_weft_for_washing_after_iron` varchar(20) NOT NULL,
  `dimensional_stability_to_weft_washing_after_iron_min_value` float NOT NULL,
  `dimensional_stability_to_weft_washing_after_iron_max_value` float NOT NULL,
  `uom_of_dimensional_stability_to_weft_washing_after_iron` varchar(10) NOT NULL,
  `change_in_warp_for_dry_cleaning_min_value` float NOT NULL,
  `change_in_warp_for_dry_cleaning_max_value` float NOT NULL,
  `uom_of_change_in_warp_for_dry_cleaning` varchar(10) NOT NULL,
  `change_in_weft_for_dry_cleaning_min_value` float NOT NULL,
  `change_in_weft_for_dry_cleaning_max_value` float NOT NULL,
  `uom_of_change_in_weft_for_dry_cleaning` varchar(10) NOT NULL,
  `warp_yarn_count_value` float NOT NULL,
  `warp_yarn_count_tolerance_range_math_operator` varchar(20) NOT NULL,
  `warp_yarn_count_tolerance_value` float NOT NULL,
  `warp_yarn_count_min_value` float NOT NULL,
  `warp_yarn_count_max_value` float NOT NULL,
  `uom_of_warp_yarn_count_value` varchar(10) NOT NULL,
  `weft_yarn_count_value` float NOT NULL,
  `weft_yarn_count_tolerance_range_math_operator` varchar(10) NOT NULL,
  `weft_yarn_count_tolerance_value` float NOT NULL,
  `weft_yarn_count_min_value` float NOT NULL,
  `weft_yarn_count_max_value` float NOT NULL,
  `uom_of_weft_yarn_count_value` varchar(10) NOT NULL,
  `mass_per_unit_per_area_value` float NOT NULL,
  `mass_per_unit_per_area_tolerance_range_math_operator` varchar(20) NOT NULL,
  `mass_per_unit_per_area_tolerance_value` float NOT NULL,
  `mass_per_unit_per_area_min_value` float NOT NULL,
  `mass_per_unit_per_area_max_value` float NOT NULL,
  `uom_of_mass_per_unit_per_area_value` varchar(10) NOT NULL,
  `no_of_threads_in_warp_value` float NOT NULL,
  `no_of_threads_in_warp_tolerance_range_math_operator` varchar(20) NOT NULL,
  `no_of_threads_in_warp_tolerance_value` float NOT NULL,
  `no_of_threads_in_warp_min_value` float NOT NULL,
  `no_of_threads_in_warp_max_value` float NOT NULL,
  `uom_of_no_of_threads_in_warp_value` varchar(10) NOT NULL,
  `no_of_threads_in_weft_value` float NOT NULL,
  `no_of_threads_in_weft_tolerance_range_math_operator` varchar(20) NOT NULL,
  `no_of_threads_in_weft_tolerance_value` float NOT NULL,
  `no_of_threads_in_weft_min_value` float NOT NULL,
  `no_of_threads_in_weft_max_value` float NOT NULL,
  `uom_of_no_of_threads_in_weft_value` varchar(10) NOT NULL,
  `rubs_for_surface_fuzzing_and_pilling` varchar(10) NOT NULL,
  `surface_fuzzing_and_pilling_tolerance_range_math_operator` varchar(20) NOT NULL,
  `surface_fuzzing_and_pilling_tolerance_value` float NOT NULL,
  `surface_fuzzing_and_pilling_min_value` float NOT NULL,
  `surface_fuzzing_and_pilling_max_value` float NOT NULL,
  `uom_of_surface_fuzzing_and_pilling_value` varchar(10) NOT NULL,
  `tensile_properties_in_warp_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `tensile_properties_in_warp_value_tolerance_value` float NOT NULL,
  `tensile_properties_in_warp_value_min_value` float NOT NULL,
  `tensile_properties_in_warp_value_max_value` float NOT NULL,
  `uom_of_tensile_properties_in_warp_value` varchar(10) NOT NULL,
  `tear_force_in_warp_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `tear_force_in_warp_value_tolerance_value` float NOT NULL,
  `tear_force_in_warp_value_min_value` float NOT NULL,
  `tear_force_in_warp_value_max_value` float NOT NULL,
  `uom_of_tear_force_in_warp_value` varchar(10) NOT NULL,
  `tear_force_in_weft_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `tear_force_in_weft_value_tolerance_value` float NOT NULL,
  `tear_force_in_weft_value_min_value` float NOT NULL,
  `tear_force_in_weft_value_max_value` float NOT NULL,
  `uom_of_tear_force_in_weft_value` varchar(10) NOT NULL,
  `seam_strength_in_warp_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `seam_strength_in_warp_value_tolerance_value` float NOT NULL,
  `seam_strength_in_warp_value_min_value` float NOT NULL,
  `seam_strength_in_warp_value_max_value` float NOT NULL,
  `uom_of_seam_strength_in_warp_value` varchar(10) NOT NULL,
  `seam_strength_in_weft_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `seam_strength_in_weft_value_tolerance_value` float NOT NULL,
  `seam_strength_in_weft_value_min_value` float NOT NULL,
  `seam_strength_in_weft_value_max_value` float NOT NULL,
  `uom_of_seam_strength_in_weft_value` varchar(10) NOT NULL,
  `abrasion_resistance_c_change_value_math_op` varchar(20) NOT NULL,
  `abrasion_resistance_c_change_value_tolerance_value` float NOT NULL,
  `abrasion_resistance_c_change_value_min_value` float NOT NULL,
  `abrasion_resistance_c_change_value_max_value` float NOT NULL,
  `uom_of_abrasion_resistance_c_change_value` varchar(10) NOT NULL,
  `abrasion_resistance_no_thread_break` float NOT NULL,
  `abrasion_resistance_rubs` float NOT NULL,
  `abrasion_resistance_thread_break` varchar(20) NOT NULL,
  `revolution` varchar(20) NOT NULL,
  `print_durability` varchar(20) NOT NULL,
  `rubs_for_mass_loss_in_abrasion_test` varchar(20) NOT NULL,
  `mass_loss_in_abrasion_test_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `mass_loss_in_abrasion_test_value_tolerance_value` float NOT NULL,
  `mass_loss_in_abrasion_test_value_min_value` float NOT NULL,
  `mass_loss_in_abrasion_test_value_max_value` float NOT NULL,
  `uom_of_mass_loss_in_abrasion_test_value` varchar(10) NOT NULL,
  `formaldehyde_content_tolerance_range_math_operator` varchar(20) NOT NULL,
  `formaldehyde_content_tolerance_value` float NOT NULL,
  `formaldehyde_content_min_value` float NOT NULL,
  `formaldehyde_content_max_value` float NOT NULL,
  `uom_of_formaldehyde_content` varchar(10) NOT NULL,
  `cf_to_dry_cleaning_color_change_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_dry_cleaning_color_change_tolerance_value` float NOT NULL,
  `cf_to_dry_cleaning_color_change_min_value` float NOT NULL,
  `cf_to_dry_cleaning_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_dry_cleaning_color_change` varchar(10) NOT NULL,
  `cf_to_dry_cleaning_staining_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_dry_cleaning_staining_tolerance_value` float NOT NULL,
  `cf_to_dry_cleaning_staining_min_value` float NOT NULL,
  `cf_to_dry_cleaning_staining_max_value` float NOT NULL,
  `uom_of_cf_to_dry_cleaning_staining` varchar(10) NOT NULL,
  `cf_to_washing_color_change_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_washing_color_change_tolerance_value` float NOT NULL,
  `cf_to_washing_color_change_min_value` float NOT NULL,
  `cf_to_washing_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_washing_color_change` varchar(10) NOT NULL,
  `cf_to_washing_staining_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_washing_staining_tolerance_value` float NOT NULL,
  `cf_to_washing_staining_min_value` float NOT NULL,
  `cf_to_washing_staining_max_value` float NOT NULL,
  `uom_of_cf_to_washing_staining` varchar(10) NOT NULL,
  `cf_to_washing_cross_staining_tolerance_range_math_operator` varchar(8) NOT NULL,
  `cf_to_washing_cross_staining_tolerance_value` float NOT NULL,
  `cf_to_washing_cross_staining_min_value` float NOT NULL,
  `cf_to_washing_cross_staining_max_value` float NOT NULL,
  `uom_of_cf_to_washing_cross_staining` varchar(10) NOT NULL,
  `cf_to_perspiration_acid_color_change_tolerance_range_math_op` varchar(20) NOT NULL,
  `cf_to_perspiration_acid_color_change_tolerance_value` float NOT NULL,
  `cf_to_perspiration_acid_color_change_min_value` float NOT NULL,
  `cf_to_perspiration_acid_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_perspiration_acid_color_change` varchar(10) NOT NULL,
  `cf_to_perspiration_acid_staining_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_perspiration_acid_staining_value` float NOT NULL,
  `cf_to_perspiration_acid_staining_min_value` float NOT NULL,
  `cf_to_perspiration_acid_staining_max_value` float NOT NULL,
  `uom_of_cf_to_perspiration_acid_staining` varchar(10) NOT NULL,
  `cf_to_perspiration_acid_cross_staining_tolerance_range_math_op` varchar(8) NOT NULL,
  `cf_to_perspiration_acid_cross_staining_tolerance_value` float NOT NULL,
  `cf_to_perspiration_acid_cross_staining_max_value` float NOT NULL,
  `cf_to_perspiration_acid_cross_staining_min_value` float NOT NULL,
  `uom_of_cf_to_perspiration_acid_cross_staining` varchar(10) NOT NULL,
  `cf_to_perspiration_alkali_color_change_tolerance_range_math_op` varchar(20) NOT NULL,
  `cf_to_perspiration_alkali_color_change_tolerance_value` float NOT NULL,
  `cf_to_perspiration_alkali_color_change_min_value` float NOT NULL,
  `cf_to_perspiration_alkali_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_perspiration_alkali_color_change` varchar(10) NOT NULL,
  `cf_to_perspiration_alkali_staining_tolerance_range_math_op` varchar(8) NOT NULL,
  `cf_to_perspiration_alkali_staining_tolerance_value` float NOT NULL,
  `cf_to_perspiration_alkali_staining_min_value` float NOT NULL,
  `cf_to_perspiration_alkali_staining_max_value` float NOT NULL,
  `uom_of_cf_to_perspiration_alkali_staining` varchar(10) NOT NULL,
  `cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op` varchar(8) NOT NULL,
  `cf_to_perspiration_alkali_cross_staining_tolerance_value` float NOT NULL,
  `cf_to_perspiration_alkali_cross_staining_min_value` float NOT NULL,
  `cf_to_perspiration_alkali_cross_staining_max_value` float NOT NULL,
  `uom_of_cf_to_perspiration_alkali_cross_staining` varchar(10) NOT NULL,
  `cf_to_water_color_change_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_water_color_change_tolerance_value` float NOT NULL,
  `cf_to_water_color_change_min_value` float NOT NULL,
  `cf_to_water_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_water_color_change` varchar(10) NOT NULL,
  `cf_to_water_staining_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_water_staining_tolerance_value` float NOT NULL,
  `cf_to_water_staining_min_value` float NOT NULL,
  `cf_to_water_staining_max_value` float NOT NULL,
  `uom_of_cf_to_water_staining` varchar(10) NOT NULL,
  `cf_to_water_sotting_staining_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_water_sotting_staining_tolerance_value` float NOT NULL,
  `cf_to_water_sotting_staining_min_value` float NOT NULL,
  `cf_to_water_sotting_staining_max_value` float NOT NULL,
  `uom_of_cf_to_water_sotting_staining` varchar(10) NOT NULL,
  `cf_to_surface_wetting_staining_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_surface_wetting_staining_tolerance_value` float NOT NULL,
  `cf_to_surface_wetting_staining_min_value` float NOT NULL,
  `cf_to_surface_wetting_staining_max_value` float NOT NULL,
  `uom_of_cf_to_surface_wetting_staining` varchar(10) NOT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op` varchar(20) NOT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value` float NOT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_min_value` float NOT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change` varchar(10) NOT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_staining_toler_range_math_op` varchar(20) NOT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value` float NOT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_staining_min_value` float NOT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_staining_max_value` float NOT NULL,
  `uom_of_cf_to_hydrolysis_of_reactive_dyes_staining` varchar(10) NOT NULL,
  `cf_to_oidative_bleach_damage_color_change_tolerance_range_mat_op` varchar(20) NOT NULL,
  `cf_to_oidative_bleach_damage_color_change_tolerance_value` float NOT NULL,
  `cf_to_oidative_bleach_damage_color_change_min_value` float NOT NULL,
  `cf_to_oidative_bleach_damage_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_oidative_bleach_damage_color_change` varchar(10) NOT NULL,
  `cf_to_phenolic_yellowing_staining_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_phenolic_yellowing_staining_tolerance_value` float NOT NULL,
  `cf_to_phenolic_yellowing_staining_min_value` float NOT NULL,
  `cf_to_phenolic_yellowing_staining_max_value` float NOT NULL,
  `uom_of_cf_to_phenolic_yellowing_staining` varchar(10) NOT NULL,
  `cf_to_saliva_color_change_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_pvc_migration_staining_tolerance_value` float NOT NULL,
  `cf_to_pvc_migration_staining_min_value` float NOT NULL,
  `cf_to_pvc_migration_staining_max_value` float NOT NULL,
  `uom_of_cf_to_pvc_migration_staining` varchar(10) NOT NULL,
  `cf_to_pvc_migration_staining_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_saliva_color_change_tolerance_value` float NOT NULL,
  `cf_to_saliva_color_change_min_value` float NOT NULL,
  `cf_to_saliva_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_saliva_color_change` varchar(10) NOT NULL,
  `cf_to_saliva_staining_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_saliva_staining_tolerance_value` float NOT NULL,
  `cf_to_saliva_staining_staining_min_value` float NOT NULL,
  `cf_to_saliva_staining_max_value` float NOT NULL,
  `uom_of_cf_to_saliva_staining` varchar(10) NOT NULL,
  `cf_to_chlorinated_water_color_change_tolerance_range_math_op` varchar(20) NOT NULL,
  `cf_to_chlorinated_water_color_change_tolerance_value` float NOT NULL,
  `cf_to_chlorinated_water_color_change_min_value` float NOT NULL,
  `cf_to_chlorinated_water_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_chlorinated_water_color_change` varchar(10) NOT NULL,
  `cf_to_chlorinated_water_staining_tolerance_range_math_operator` varchar(5) NOT NULL,
  `cf_to_chlorinated_water_staining_tolerance_value` float NOT NULL,
  `cf_to_chlorinated_water_staining_min_value` float NOT NULL,
  `cf_to_chlorinated_water_staining_max_value` float NOT NULL,
  `uom_of_cf_to_chlorinated_water_staining` varchar(10) NOT NULL,
  `cf_to_cholorine_bleach_color_change_tolerance_range_math_op` varchar(5) NOT NULL,
  `cf_to_cholorine_bleach_color_change_tolerance_value` float NOT NULL,
  `cf_to_cholorine_bleach_color_change_min_value` float NOT NULL,
  `cf_to_cholorine_bleach_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_cholorine_bleach_color_change` varchar(10) NOT NULL,
  `cf_to_cholorine_bleach_staining_tolerance_range_math_operator` varchar(5) NOT NULL,
  `cf_to_cholorine_bleach_staining_tolerance_value` float NOT NULL,
  `cf_to_cholorine_bleach_staining_min_value` float NOT NULL,
  `cf_to_cholorine_bleach_staining_max_value` float NOT NULL,
  `uom_of_cf_to_cholorine_bleach_staining` varchar(10) NOT NULL,
  `cf_to_peroxide_bleach_color_change_tolerance_range_math_operator` varchar(5) NOT NULL,
  `cf_to_peroxide_bleach_color_change_tolerance_value` float NOT NULL,
  `cf_to_peroxide_bleach_color_change_min_value` float NOT NULL,
  `cf_to_peroxide_bleach_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_peroxide_bleach_color_change` varchar(10) NOT NULL,
  `cf_to_peroxide_bleach_staining_tolerance_range_math_operator` varchar(5) NOT NULL,
  `cf_to_peroxide_bleach_staining_tolerance_value` float NOT NULL,
  `cf_to_peroxide_bleach_staining_min_value` float NOT NULL,
  `cf_to_peroxide_bleach_staining_max_value` float NOT NULL,
  `uom_of_cf_to_peroxide_bleach_staining` varchar(10) NOT NULL,
  `cross_staining_tolerance_range_math_operator` varchar(5) NOT NULL,
  `cross_staining_tolerance_value` float NOT NULL,
  `cross_staining_min_value` float NOT NULL,
  `cross_staining_max_value` float NOT NULL,
  `uom_of_cross_staining` varchar(10) NOT NULL,
  `water_absorption_value_tolerance_range_math_operator` varchar(5) NOT NULL,
  `water_absorption_value_tolerance_value` float NOT NULL,
  `water_absorption_value_min_value` float NOT NULL,
  `water_absorption_value_max_value` float NOT NULL,
  `uom_of_water_absorption_value` varchar(10) NOT NULL,
  `spirality_value_tolerance_range_math_operator` varchar(5) NOT NULL,
  `spirality_value_tolerance_value` float NOT NULL,
  `spirality_value_min_value` float NOT NULL,
  `spirality_value_max_value` float NOT NULL,
  `uom_of_spirality_value` varchar(10) NOT NULL,
  `durable_press_value_tolerance_range_math_operator` varchar(5) NOT NULL,
  `durable_press_value_tolerance_value` float NOT NULL,
  `durable_press_value_min_value` float NOT NULL,
  `durable_press_value_max_value` float NOT NULL,
  `uom_of_durable_press_value` varchar(10) NOT NULL,
  `ironability_of_woven_fabric_value_tolerance_range_math_operator` varchar(5) NOT NULL,
  `ironability_of_woven_fabric_value_tolerance_value` float NOT NULL,
  `ironability_of_woven_fabric_value_min_value` float NOT NULL,
  `ironability_of_woven_fabric_value_max_value` float NOT NULL,
  `uom_of_ironability_of_woven_fabric_value` varchar(10) NOT NULL,
  `cf_to_artificial_light_value_tolerance_range_math_operator` varchar(5) NOT NULL,
  `cf_to_artificial_light_value_tolerance_value` float NOT NULL,
  `cf_to_artificial_light_value_min_value` float NOT NULL,
  `cf_to_artificial_light_value_max_value` float NOT NULL,
  `uom_of_cf_to_artificial_light_value` varchar(10) NOT NULL,
  `moisture_content_in_percentage_min_value` float NOT NULL,
  `moisture_content_in_percentage_max_value` float NOT NULL,
  `uom_of_moisture_content_in_percentage` varchar(10) NOT NULL,
  `evaporation_rate_in_percentage_min_value` float NOT NULL,
  `evaporation_rate_in_percentage_max_value` float NOT NULL,
  `uom_of_evaporation_rate_in_percentage` varchar(10) NOT NULL,
  `percentage_of_total_cotton_content_value` float NOT NULL,
  `percentage_of_total_cotton_content_tolerance_range_math_operator` varchar(10) NOT NULL,
  `percentage_of_total_cotton_content_tolerance_value` float NOT NULL,
  `percentage_of_total_cotton_content_min_value` float NOT NULL,
  `percentage_of_total_cotton_content_max_value` float NOT NULL,
  `uom_of_percentage_of_total_cotton_content` varchar(10) NOT NULL,
  `percentage_of_total_polyester_content_value` float NOT NULL,
  `percentage_of_total_polyester_content_tolerance_range_math_op` varchar(5) NOT NULL,
  `percentage_of_total_polyester_content_tolerance_value` float NOT NULL,
  `percentage_of_total_polyester_content_min_value` float NOT NULL,
  `percentage_of_total_polyester_content_max_value` float NOT NULL,
  `uom_of_percentage_of_total_polyester_content` varchar(10) NOT NULL,
  `percentage_of_total_other_fiber_content_value` float NOT NULL,
  `percentage_of_total_other_fiber_content_tolerance_range_math_op` varchar(5) NOT NULL,
  `percentage_of_total_other_fiber_content_tolerance_value` float NOT NULL,
  `percentage_of_total_other_fiber_content_min_value` float NOT NULL,
  `percentage_of_total_other_fiber_content_max_value` float NOT NULL,
  `uom_of_percentage_of_total_other_fiber_content` varchar(10) NOT NULL,
  `percentage_of_warp_cotton_content_value` float NOT NULL,
  `percentage_of_warp_cotton_content_tolerance_range_math_operator` varchar(5) NOT NULL,
  `percentage_of_warp_cotton_content_tolerance_value` float NOT NULL,
  `percentage_of_warp_cotton_content_min_value` float NOT NULL,
  `uom_of_percentage_of_warp_cotton_content` varchar(10) NOT NULL,
  `percentage_of_warp_polyester_content_value` float NOT NULL,
  `percentage_of_warp_polyester_content_tolerance_range_math_op` varchar(5) NOT NULL,
  `percentage_of_warp_polyester_content_tolerance_value` float NOT NULL,
  `percentage_of_warp_polyester_content_min_value` float NOT NULL,
  `percentage_of_warp_polyester_content_max_value` float NOT NULL,
  `uom_of_percentage_of_warp_polyester_content` varchar(10) NOT NULL,
  `percentage_of_warp_other_fiber_content_value` float NOT NULL,
  `percentage_of_warp_other_fiber_content_tolerance_range_math_op` varchar(5) NOT NULL,
  `percentage_of_warp_other_fiber_content_tolerance_value` float NOT NULL,
  `percentage_of_warp_other_fiber_content_min_value` float NOT NULL,
  `percentage_of_warp_other_fiber_content_max_value` float NOT NULL,
  `uom_of_percentage_of_warp_other_fiber_content` varchar(10) NOT NULL,
  `percentage_of_weft_cotton_content_value` float NOT NULL,
  `percentage_of_weft_cotton_content_tolerance_range_math_op` varchar(10) NOT NULL,
  `percentage_of_weft_cotton_content_tolerance_value` float NOT NULL,
  `percentage_of_weft_cotton_content_min_value` float NOT NULL,
  `percentage_of_weft_cotton_content_max_value` float NOT NULL,
  `uom_of_percentage_of_weft_cotton_content` float NOT NULL,
  `percentage_of_weft_polyester_content_value` float NOT NULL,
  `percentage_of_weft_polyester_content_tolerance_range_math_op` varchar(8) NOT NULL,
  `percentage_of_weft_polyester_content_tolerance_value` float NOT NULL,
  `percentage_of_weft_polyester_content_min_value` float NOT NULL,
  `percentage_of_weft_polyester_content_max_value` float NOT NULL,
  `uom_of_percentage_of_weft_polyester_content` varchar(5) NOT NULL,
  `percentage_of_weft_other_fiber_content_value` float NOT NULL,
  `percentage_of_weft_other_fiber_content_tolerance_range_math_op` varchar(10) NOT NULL,
  `percentage_of_weft_other_fiber_content_tolerance_value` float NOT NULL,
  `percentage_of_weft_other_fiber_content_min_value` float NOT NULL,
  `percentage_of_weft_other_fiber_content_max_value` float NOT NULL,
  `uom_of_percentage_of_weft_other_fiber_content` varchar(10) NOT NULL,
  `seam_slippage_resistance_in_warp_tolerance_range_math_operator` varchar(5) NOT NULL,
  `seam_slippage_resistance_in_warp_tolerance_value` float NOT NULL,
  `seam_slippage_resistance_in_warp_min_value` float NOT NULL,
  `seam_slippage_resistance_in_warp_max_value` float NOT NULL,
  `uom_of_seam_slippage_resistance_in_warp` varchar(10) NOT NULL,
  `seam_slippage_resistance_in_weft_tolerance_range_math_operator` varchar(5) NOT NULL,
  `seam_slippage_resistance_in_weft_tolerance_value` float NOT NULL,
  `seam_slippage_resistance_in_weft_min_value` float NOT NULL,
  `seam_slippage_resistance_in_weft_max_value` float NOT NULL,
  `uom_of_seam_slippage_resistance_in_weft` varchar(10) NOT NULL,
  `ph_value_tolerance_range_math_operator` varchar(5) NOT NULL,
  `ph_value_tolerance_value` float NOT NULL,
  `ph_value_min_value` float NOT NULL,
  `ph_value_max_value` float NOT NULL,
  `uom_of_ph_value` varchar(10) NOT NULL,
  `recording_person_id` varchar(20) NOT NULL,
  `recording_person_name` varchar(20) NOT NULL,
  `recording_time` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of defining_qc_standard_for_finishing_process_bkup_07_12_2020
-- ----------------------------

-- ----------------------------
-- Table structure for `defining_qc_standard_for_finishing_process_bkup_07_12_2020_new`
-- ----------------------------
DROP TABLE IF EXISTS `defining_qc_standard_for_finishing_process_bkup_07_12_2020_new`;
CREATE TABLE `defining_qc_standard_for_finishing_process_bkup_07_12_2020_new` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(50) NOT NULL,
  `version_id` varchar(30) NOT NULL,
  `version_number` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `finish_width_in_inch` float NOT NULL,
  `standard_for_which_process` varchar(50) NOT NULL,
  `cf_to_rubbing_dry_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_rubbing_dry_tolerance_value` float NOT NULL,
  `cf_to_rubbing_dry_min_value` float NOT NULL,
  `cf_to_rubbing_dry_max_value` float NOT NULL,
  `uom_of_cf_to_rubbing_dry` varchar(20) NOT NULL,
  `cf_to_rubbing_wet_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_rubbing_wet_tolerance_value` float NOT NULL,
  `cf_to_rubbing_wet_min_value` float NOT NULL,
  `cf_to_rubbing_wet_max_value` float NOT NULL,
  `uom_of_cf_to_rubbing_wet` varchar(20) NOT NULL,
  `washing_cycle_for_warp_for_washing_before_iron` varchar(20) NOT NULL,
  `dimensional_stability_to_warp_washing_before_iron_min_value` float NOT NULL,
  `dimensional_stability_to_warp_washing_before_iron_max_value` float NOT NULL,
  `uom_of_dimensional_stability_to_warp_washing_before_iron` varchar(10) NOT NULL,
  `washing_cycle_for_weft_for_washing_before_iron` varchar(20) NOT NULL,
  `dimensional_stability_to_weft_washing_before_iron_min_value` float NOT NULL,
  `dimensional_stability_to_weft_washing_before_iron_max_value` float NOT NULL,
  `uom_of_dimensional_stability_to_weft_washing_before_iron` varchar(10) NOT NULL,
  `washing_cycle_for_warp_for_washing_after_iron` varchar(20) NOT NULL,
  `dimensional_stability_to_warp_washing_after_iron_min_value` float NOT NULL,
  `dimensional_stability_to_warp_washing_after_iron_max_value` float NOT NULL,
  `uom_of_dimensional_stability_to_warp_washing_after_iron` varchar(10) NOT NULL,
  `washing_cycle_for_weft_for_washing_after_iron` varchar(20) NOT NULL,
  `dimensional_stability_to_weft_washing_after_iron_min_value` float NOT NULL,
  `dimensional_stability_to_weft_washing_after_iron_max_value` float NOT NULL,
  `uom_of_dimensional_stability_to_weft_washing_after_iron` varchar(10) NOT NULL,
  `change_in_warp_for_dry_cleaning_min_value` float NOT NULL,
  `change_in_warp_for_dry_cleaning_max_value` float NOT NULL,
  `uom_of_change_in_warp_for_dry_cleaning` varchar(10) NOT NULL,
  `change_in_weft_for_dry_cleaning_min_value` float NOT NULL,
  `change_in_weft_for_dry_cleaning_max_value` float NOT NULL,
  `uom_of_change_in_weft_for_dry_cleaning` varchar(10) NOT NULL,
  `warp_yarn_count_value` float NOT NULL,
  `warp_yarn_count_tolerance_range_math_operator` varchar(20) NOT NULL,
  `warp_yarn_count_tolerance_value` float NOT NULL,
  `warp_yarn_count_min_value` float NOT NULL,
  `warp_yarn_count_max_value` float NOT NULL,
  `uom_of_warp_yarn_count_value` varchar(10) NOT NULL,
  `weft_yarn_count_value` float NOT NULL,
  `weft_yarn_count_tolerance_range_math_operator` varchar(10) NOT NULL,
  `weft_yarn_count_tolerance_value` float NOT NULL,
  `weft_yarn_count_min_value` float NOT NULL,
  `weft_yarn_count_max_value` float NOT NULL,
  `uom_of_weft_yarn_count_value` varchar(10) NOT NULL,
  `mass_per_unit_per_area_value` float NOT NULL,
  `mass_per_unit_per_area_tolerance_range_math_operator` varchar(20) NOT NULL,
  `mass_per_unit_per_area_tolerance_value` float NOT NULL,
  `mass_per_unit_per_area_min_value` float NOT NULL,
  `mass_per_unit_per_area_max_value` float NOT NULL,
  `uom_of_mass_per_unit_per_area_value` varchar(10) NOT NULL,
  `no_of_threads_in_warp_value` float NOT NULL,
  `no_of_threads_in_warp_tolerance_range_math_operator` varchar(20) NOT NULL,
  `no_of_threads_in_warp_tolerance_value` float NOT NULL,
  `no_of_threads_in_warp_min_value` float NOT NULL,
  `no_of_threads_in_warp_max_value` float NOT NULL,
  `uom_of_no_of_threads_in_warp_value` varchar(10) NOT NULL,
  `no_of_threads_in_weft_value` float NOT NULL,
  `no_of_threads_in_weft_tolerance_range_math_operator` varchar(20) NOT NULL,
  `no_of_threads_in_weft_tolerance_value` float NOT NULL,
  `no_of_threads_in_weft_min_value` float NOT NULL,
  `no_of_threads_in_weft_max_value` float NOT NULL,
  `uom_of_no_of_threads_in_weft_value` varchar(10) NOT NULL,
  `rubs_for_surface_fuzzing_and_pilling` varchar(10) NOT NULL,
  `surface_fuzzing_and_pilling_tolerance_range_math_operator` varchar(20) NOT NULL,
  `surface_fuzzing_and_pilling_tolerance_value` float NOT NULL,
  `surface_fuzzing_and_pilling_min_value` float NOT NULL,
  `surface_fuzzing_and_pilling_max_value` float NOT NULL,
  `uom_of_surface_fuzzing_and_pilling_value` varchar(10) NOT NULL,
  `tensile_properties_in_warp_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `tensile_properties_in_warp_value_tolerance_value` float NOT NULL,
  `tensile_properties_in_warp_value_min_value` float NOT NULL,
  `tensile_properties_in_warp_value_max_value` float NOT NULL,
  `uom_of_tensile_properties_in_warp_value` varchar(10) NOT NULL,
  `tear_force_in_warp_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `tear_force_in_warp_value_tolerance_value` float NOT NULL,
  `tear_force_in_warp_value_min_value` float NOT NULL,
  `tear_force_in_warp_value_max_value` float NOT NULL,
  `uom_of_tear_force_in_warp_value` varchar(10) NOT NULL,
  `tear_force_in_weft_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `tear_force_in_weft_value_tolerance_value` float NOT NULL,
  `tear_force_in_weft_value_min_value` float NOT NULL,
  `tear_force_in_weft_value_max_value` float NOT NULL,
  `uom_of_tear_force_in_weft_value` varchar(10) NOT NULL,
  `seam_strength_in_warp_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `seam_strength_in_warp_value_tolerance_value` float NOT NULL,
  `seam_strength_in_warp_value_min_value` float NOT NULL,
  `seam_strength_in_warp_value_max_value` float NOT NULL,
  `uom_of_seam_strength_in_warp_value` varchar(10) NOT NULL,
  `seam_strength_in_weft_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `seam_strength_in_weft_value_tolerance_value` float NOT NULL,
  `seam_strength_in_weft_value_min_value` float NOT NULL,
  `seam_strength_in_weft_value_max_value` float NOT NULL,
  `uom_of_seam_strength_in_weft_value` varchar(10) NOT NULL,
  `abrasion_resistance_c_change_value_math_op` varchar(20) NOT NULL,
  `abrasion_resistance_c_change_value_tolerance_value` float NOT NULL,
  `abrasion_resistance_c_change_value_min_value` float NOT NULL,
  `abrasion_resistance_c_change_value_max_value` float NOT NULL,
  `uom_of_abrasion_resistance_c_change_value` varchar(10) NOT NULL,
  `abrasion_resistance_no_thread_break` float NOT NULL,
  `abrasion_resistance_rubs` float NOT NULL,
  `abrasion_resistance_thread_break` varchar(20) NOT NULL,
  `rubs_for_mass_loss_in_abrasion_test` varchar(20) NOT NULL,
  `mass_loss_in_abrasion_test_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `mass_loss_in_abrasion_test_value_tolerance_value` float NOT NULL,
  `mass_loss_in_abrasion_test_value_min_value` float NOT NULL,
  `mass_loss_in_abrasion_test_value_max_value` float NOT NULL,
  `uom_of_mass_loss_in_abrasion_test_value` varchar(10) NOT NULL,
  `formaldehyde_content_tolerance_range_math_operator` varchar(20) NOT NULL,
  `formaldehyde_content_tolerance_value` float NOT NULL,
  `formaldehyde_content_min_value` float NOT NULL,
  `formaldehyde_content_max_value` float NOT NULL,
  `uom_of_formaldehyde_content` varchar(10) NOT NULL,
  `cf_to_dry_cleaning_color_change_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_dry_cleaning_color_change_tolerance_value` float NOT NULL,
  `cf_to_dry_cleaning_color_change_min_value` float NOT NULL,
  `cf_to_dry_cleaning_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_dry_cleaning_color_change` varchar(10) NOT NULL,
  `cf_to_dry_cleaning_staining_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_dry_cleaning_staining_tolerance_value` float NOT NULL,
  `cf_to_dry_cleaning_staining_min_value` float NOT NULL,
  `cf_to_dry_cleaning_staining_max_value` float NOT NULL,
  `uom_of_cf_to_dry_cleaning_staining` varchar(10) NOT NULL,
  `cf_to_washing_color_change_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_washing_color_change_tolerance_value` float NOT NULL,
  `cf_to_washing_color_change_min_value` float NOT NULL,
  `cf_to_washing_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_washing_color_change` varchar(10) NOT NULL,
  `cf_to_washing_staining_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_washing_staining_tolerance_value` float NOT NULL,
  `cf_to_washing_staining_min_value` float NOT NULL,
  `cf_to_washing_staining_max_value` float NOT NULL,
  `uom_of_cf_to_washing_staining` varchar(10) NOT NULL,
  `cf_to_washing_cross_staining_tolerance_range_math_operator` varchar(8) NOT NULL,
  `cf_to_washing_cross_staining_tolerance_value` float NOT NULL,
  `cf_to_washing_cross_staining_min_value` float NOT NULL,
  `cf_to_washing_cross_staining_max_value` float NOT NULL,
  `uom_of_cf_to_washing_cross_staining` varchar(10) NOT NULL,
  `cf_to_perspiration_acid_color_change_tolerance_range_math_op` varchar(20) NOT NULL,
  `cf_to_perspiration_acid_color_change_tolerance_value` float NOT NULL,
  `cf_to_perspiration_acid_color_change_min_value` float NOT NULL,
  `cf_to_perspiration_acid_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_perspiration_acid_color_change` varchar(10) NOT NULL,
  `cf_to_perspiration_acid_staining_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_perspiration_acid_staining_value` float NOT NULL,
  `cf_to_perspiration_acid_staining_min_value` float NOT NULL,
  `cf_to_perspiration_acid_staining_max_value` float NOT NULL,
  `uom_of_cf_to_perspiration_acid_staining` varchar(10) NOT NULL,
  `cf_to_perspiration_acid_cross_staining_tolerance_range_math_op` varchar(8) NOT NULL,
  `cf_to_perspiration_acid_cross_staining_tolerance_value` float NOT NULL,
  `cf_to_perspiration_acid_cross_staining_max_value` float NOT NULL,
  `cf_to_perspiration_acid_cross_staining_min_value` float NOT NULL,
  `uom_of_cf_to_perspiration_acid_cross_staining` varchar(10) NOT NULL,
  `cf_to_perspiration_alkali_color_change_tolerance_range_math_op` varchar(20) NOT NULL,
  `cf_to_perspiration_alkali_color_change_tolerance_value` float NOT NULL,
  `cf_to_perspiration_alkali_color_change_min_value` float NOT NULL,
  `cf_to_perspiration_alkali_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_perspiration_alkali_color_change` varchar(10) NOT NULL,
  `cf_to_perspiration_alkali_staining_tolerance_range_math_op` varchar(8) NOT NULL,
  `cf_to_perspiration_alkali_staining_tolerance_value` float NOT NULL,
  `cf_to_perspiration_alkali_staining_min_value` float NOT NULL,
  `cf_to_perspiration_alkali_staining_max_value` float NOT NULL,
  `uom_of_cf_to_perspiration_alkali_staining` varchar(10) NOT NULL,
  `cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op` varchar(8) NOT NULL,
  `cf_to_perspiration_alkali_cross_staining_tolerance_value` float NOT NULL,
  `cf_to_perspiration_alkali_cross_staining_min_value` float NOT NULL,
  `cf_to_perspiration_alkali_cross_staining_max_value` float NOT NULL,
  `uom_of_cf_to_perspiration_alkali_cross_staining` varchar(10) NOT NULL,
  `cf_to_water_color_change_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_water_color_change_tolerance_value` float NOT NULL,
  `cf_to_water_color_change_min_value` float NOT NULL,
  `cf_to_water_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_water_color_change` varchar(10) NOT NULL,
  `cf_to_water_staining_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_water_staining_tolerance_value` float NOT NULL,
  `cf_to_water_staining_min_value` float NOT NULL,
  `cf_to_water_staining_max_value` float NOT NULL,
  `uom_of_cf_to_water_staining` varchar(10) NOT NULL,
  `cf_to_water_cross_staining_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_water_cross_staining_tolerance_value` float NOT NULL,
  `cf_to_water_cross_staining_min_value` float NOT NULL,
  `cf_to_water_cross_staining_max_value` float NOT NULL,
  `uom_of_cf_to_water_cross_staining` varchar(10) NOT NULL,
  `cf_to_water_spotting_surface_tolerance_range_math_op` varchar(8) NOT NULL,
  `cf_to_water_spotting_surface_tolerance_value` float NOT NULL,
  `cf_to_water_spotting_surface_min_value` float NOT NULL,
  `cf_to_water_spotting_surface_max_value` float NOT NULL,
  `uom_of_cf_to_water_spotting_surface` varchar(10) NOT NULL,
  `cf_to_water_spotting_edge_tolerance_range_math_op` varchar(8) NOT NULL,
  `cf_to_water_spotting_edge_tolerance_value` float NOT NULL,
  `cf_to_water_spotting_edge_min_value` float NOT NULL,
  `cf_to_water_spotting_edge_max_value` float NOT NULL,
  `uom_of_cf_to_water_spotting_edge` varchar(10) NOT NULL,
  `cf_to_water_spotting_cross_staining_tolerance_range_math_op` varchar(8) NOT NULL,
  `cf_to_water_spotting_cross_staining_tolerance_value` float NOT NULL,
  `cf_to_water_spotting_cross_staining_min_value` float NOT NULL,
  `cf_to_water_spotting_cross_staining_max_value` float NOT NULL,
  `uom_of_cf_to_water_spotting_cross_staining` varchar(10) NOT NULL,
  `cf_to_surface_wetting_staining_before_wash_tol_range_math_op` varchar(20) NOT NULL,
  `cf_to_surface_wetting_staining_before_wash_tolerance_value` float NOT NULL,
  `cf_to_surface_wetting_staining_before_wash_min_value` float NOT NULL,
  `cf_to_surface_wetting_staining_before_wash_max_value` float NOT NULL,
  `uom_of_cf_to_surface_wetting_staining_before_wash` varchar(10) NOT NULL,
  `cf_to_surface_wetting_staining_after_one_wash_tol_range_math_op` varchar(8) NOT NULL,
  `cf_to_surface_wetting_staining_after_one_wash_tolerance_value` float NOT NULL,
  `cf_to_surface_wetting_staining_after_one_wash_min_value` float NOT NULL,
  `cf_to_surface_wetting_staining_after_one_wash_max_value` float NOT NULL,
  `uom_of_cf_to_surface_wetting_staining_after_one_wash` varchar(10) NOT NULL,
  `cf_to_surface_wetting_staining_after_five_wash_tol_range_math_op` varchar(8) NOT NULL,
  `cf_to_surface_wetting_staining_after_five_wash_tolerance_value` float NOT NULL,
  `cf_to_surface_wetting_staining_after_five_wash_min_value` float NOT NULL,
  `cf_to_surface_wetting_staining_after_five_wash_max_value` float NOT NULL,
  `uom_of_cf_to_surface_wetting_staining_after_five_wash` float NOT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op` varchar(20) NOT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value` float NOT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_min_value` float NOT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change` varchar(10) NOT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_staining_toler_range_math_op` varchar(20) NOT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value` float NOT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_staining_min_value` float NOT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_staining_max_value` float NOT NULL,
  `uom_of_cf_to_hydrolysis_of_reactive_dyes_staining` varchar(10) NOT NULL,
  `cf_to_oxidative_bleach_damage_color_change_tol_range_math_op` varchar(20) NOT NULL,
  `cf_to_oxidative_bleach_damage_value` varchar(10) NOT NULL,
  `cf_to_oxidative_bleach_damage_color_change_tolerance_value` float NOT NULL,
  `cf_to_oxidative_bleach_damage_color_change_min_value` float NOT NULL,
  `cf_to_oxidative_bleach_damage_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_oxidative_bleach_damage_color_change` varchar(10) NOT NULL,
  `cf_to_phenolic_yellowing_staining_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_phenolic_yellowing_staining_tolerance_value` float NOT NULL,
  `cf_to_phenolic_yellowing_staining_min_value` float NOT NULL,
  `cf_to_phenolic_yellowing_staining_max_value` float NOT NULL,
  `uom_of_cf_to_phenolic_yellowing_staining` varchar(10) NOT NULL,
  `cf_to_saliva_color_change_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_pvc_migration_staining_tolerance_value` float NOT NULL,
  `cf_to_pvc_migration_staining_min_value` float NOT NULL,
  `cf_to_pvc_migration_staining_max_value` float NOT NULL,
  `uom_of_cf_to_pvc_migration_staining` varchar(10) NOT NULL,
  `cf_to_pvc_migration_staining_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_saliva_color_change_tolerance_value` float NOT NULL,
  `cf_to_saliva_color_change_min_value` float NOT NULL,
  `cf_to_saliva_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_saliva_color_change` varchar(10) NOT NULL,
  `cf_to_saliva_staining_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_saliva_staining_tolerance_value` float NOT NULL,
  `cf_to_saliva_staining_staining_min_value` float NOT NULL,
  `cf_to_saliva_staining_max_value` float NOT NULL,
  `uom_of_cf_to_saliva_staining` varchar(10) NOT NULL,
  `cf_to_chlorinated_water_color_change_tolerance_range_math_op` varchar(20) NOT NULL,
  `cf_to_chlorinated_water_color_change_tolerance_value` float NOT NULL,
  `cf_to_chlorinated_water_color_change_min_value` float NOT NULL,
  `cf_to_chlorinated_water_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_chlorinated_water_color_change` varchar(10) NOT NULL,
  `cf_to_chlorinated_water_staining_tolerance_range_math_operator` varchar(5) NOT NULL,
  `cf_to_chlorinated_water_staining_tolerance_value` float NOT NULL,
  `cf_to_chlorinated_water_staining_min_value` float NOT NULL,
  `cf_to_chlorinated_water_staining_max_value` float NOT NULL,
  `uom_of_cf_to_chlorinated_water_staining` varchar(10) NOT NULL,
  `cf_to_cholorine_bleach_color_change_tolerance_range_math_op` varchar(5) NOT NULL,
  `cf_to_cholorine_bleach_color_change_tolerance_value` float NOT NULL,
  `cf_to_cholorine_bleach_color_change_min_value` float NOT NULL,
  `cf_to_cholorine_bleach_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_cholorine_bleach_color_change` varchar(10) NOT NULL,
  `cf_to_cholorine_bleach_staining_tolerance_range_math_operator` varchar(5) NOT NULL,
  `cf_to_cholorine_bleach_staining_tolerance_value` float NOT NULL,
  `cf_to_cholorine_bleach_staining_min_value` float NOT NULL,
  `cf_to_cholorine_bleach_staining_max_value` float NOT NULL,
  `uom_of_cf_to_cholorine_bleach_staining` varchar(10) NOT NULL,
  `cf_to_peroxide_bleach_color_change_tolerance_range_math_operator` varchar(5) NOT NULL,
  `cf_to_peroxide_bleach_color_change_tolerance_value` float NOT NULL,
  `cf_to_peroxide_bleach_color_change_min_value` float NOT NULL,
  `cf_to_peroxide_bleach_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_peroxide_bleach_color_change` varchar(10) NOT NULL,
  `cf_to_peroxide_bleach_staining_tolerance_range_math_operator` varchar(5) NOT NULL,
  `cf_to_peroxide_bleach_staining_tolerance_value` float NOT NULL,
  `cf_to_peroxide_bleach_staining_min_value` float NOT NULL,
  `cf_to_peroxide_bleach_staining_max_value` float NOT NULL,
  `uom_of_cf_to_peroxide_bleach_staining` varchar(10) NOT NULL,
  `cross_staining_tolerance_range_math_operator` varchar(5) NOT NULL,
  `cross_staining_tolerance_value` float NOT NULL,
  `cross_staining_min_value` float NOT NULL,
  `cross_staining_max_value` float NOT NULL,
  `uom_of_cross_staining` varchar(10) NOT NULL,
  `description_or_type_for_water_absorption` varchar(30) NOT NULL,
  `water_absorption_value_tolerance_range_math_operator` varchar(5) NOT NULL,
  `water_absorption_value_tolerance_value` float NOT NULL,
  `water_absorption_value_min_value` float NOT NULL,
  `water_absorption_value_max_value` float NOT NULL,
  `uom_of_water_absorption_value` varchar(10) NOT NULL,
  `wicking_test_tol_range_math_op` varchar(10) NOT NULL,
  `wicking_test_tolerance_value` float NOT NULL,
  `wicking_test_min_value` float NOT NULL,
  `wicking_test_max_value` float NOT NULL,
  `uom_of_wicking_test` varchar(10) NOT NULL,
  `spirality_value_tolerance_range_math_operator` varchar(5) NOT NULL,
  `spirality_value_tolerance_value` float NOT NULL,
  `spirality_value_min_value` float NOT NULL,
  `spirality_value_max_value` float NOT NULL,
  `uom_of_spirality_value` varchar(10) NOT NULL,
  `durable_press_value_tolerance_range_math_operator` varchar(5) NOT NULL,
  `durable_press_value_tolerance_value` float NOT NULL,
  `durable_press_value_min_value` float NOT NULL,
  `durable_press_value_max_value` float NOT NULL,
  `uom_of_durable_press_value` varchar(10) NOT NULL,
  `ironability_of_woven_fabric_value_tolerance_range_math_operator` varchar(5) NOT NULL,
  `ironability_of_woven_fabric_value_tolerance_value` float NOT NULL,
  `ironability_of_woven_fabric_value_min_value` float NOT NULL,
  `ironability_of_woven_fabric_value_max_value` float NOT NULL,
  `uom_of_ironability_of_woven_fabric_value` varchar(10) NOT NULL,
  `cf_to_artificial_light_value_tolerance_range_math_operator` varchar(5) NOT NULL,
  `cf_to_artificial_light_value_tolerance_value` float NOT NULL,
  `cf_to_artificial_light_value_min_value` float NOT NULL,
  `cf_to_artificial_light_value_max_value` float NOT NULL,
  `uom_of_cf_to_artificial_light_value` varchar(10) NOT NULL,
  `moisture_content_in_percentage_min_value` float NOT NULL,
  `moisture_content_in_percentage_max_value` float NOT NULL,
  `uom_of_moisture_content_in_percentage` varchar(10) NOT NULL,
  `evaporation_rate_in_percentage_min_value` float NOT NULL,
  `evaporation_rate_in_percentage_max_value` float NOT NULL,
  `uom_of_evaporation_rate_in_percentage` varchar(10) NOT NULL,
  `percentage_of_total_cotton_content_value` float NOT NULL,
  `percentage_of_total_cotton_content_tolerance_range_math_operator` varchar(10) NOT NULL,
  `percentage_of_total_cotton_content_tolerance_value` float NOT NULL,
  `percentage_of_total_cotton_content_min_value` float NOT NULL,
  `percentage_of_total_cotton_content_max_value` float NOT NULL,
  `uom_of_percentage_of_total_cotton_content` varchar(10) NOT NULL,
  `percentage_of_total_polyester_content_value` float NOT NULL,
  `percentage_of_total_polyester_content_tolerance_range_math_op` varchar(5) NOT NULL,
  `percentage_of_total_polyester_content_tolerance_value` float NOT NULL,
  `percentage_of_total_polyester_content_min_value` float NOT NULL,
  `percentage_of_total_polyester_content_max_value` float NOT NULL,
  `uom_of_percentage_of_total_polyester_content` varchar(10) NOT NULL,
  `percentage_of_total_other_fiber_content_value` float NOT NULL,
  `percentage_of_total_other_fiber_content_tolerance_range_math_op` varchar(5) NOT NULL,
  `percentage_of_total_other_fiber_content_tolerance_value` float NOT NULL,
  `percentage_of_total_other_fiber_content_min_value` float NOT NULL,
  `percentage_of_total_other_fiber_content_max_value` float NOT NULL,
  `uom_of_percentage_of_total_other_fiber_content` varchar(10) NOT NULL,
  `percentage_of_warp_cotton_content_value` float NOT NULL,
  `percentage_of_warp_cotton_content_tolerance_range_math_operator` varchar(5) NOT NULL,
  `percentage_of_warp_cotton_content_tolerance_value` float NOT NULL,
  `percentage_of_warp_cotton_content_min_value` float NOT NULL,
  `uom_of_percentage_of_warp_cotton_content` varchar(10) NOT NULL,
  `percentage_of_warp_polyester_content_value` float NOT NULL,
  `percentage_of_warp_polyester_content_tolerance_range_math_op` varchar(5) NOT NULL,
  `percentage_of_warp_polyester_content_tolerance_value` float NOT NULL,
  `percentage_of_warp_polyester_content_min_value` float NOT NULL,
  `percentage_of_warp_polyester_content_max_value` float NOT NULL,
  `uom_of_percentage_of_warp_polyester_content` varchar(10) NOT NULL,
  `percentage_of_warp_other_fiber_content_value` float NOT NULL,
  `percentage_of_warp_other_fiber_content_tolerance_range_math_op` varchar(5) NOT NULL,
  `percentage_of_warp_other_fiber_content_tolerance_value` float NOT NULL,
  `percentage_of_warp_other_fiber_content_min_value` float NOT NULL,
  `percentage_of_warp_other_fiber_content_max_value` float NOT NULL,
  `uom_of_percentage_of_warp_other_fiber_content` varchar(10) NOT NULL,
  `percentage_of_weft_cotton_content_value` float NOT NULL,
  `percentage_of_weft_cotton_content_tolerance_range_math_op` varchar(10) NOT NULL,
  `percentage_of_weft_cotton_content_tolerance_value` float NOT NULL,
  `percentage_of_weft_cotton_content_min_value` float NOT NULL,
  `percentage_of_weft_cotton_content_max_value` float NOT NULL,
  `uom_of_percentage_of_weft_cotton_content` float NOT NULL,
  `percentage_of_weft_polyester_content_value` float NOT NULL,
  `percentage_of_weft_polyester_content_tolerance_range_math_op` varchar(8) NOT NULL,
  `percentage_of_weft_polyester_content_tolerance_value` float NOT NULL,
  `percentage_of_weft_polyester_content_min_value` float NOT NULL,
  `percentage_of_weft_polyester_content_max_value` float NOT NULL,
  `uom_of_percentage_of_weft_polyester_content` varchar(5) NOT NULL,
  `percentage_of_weft_other_fiber_content_value` float NOT NULL,
  `percentage_of_weft_other_fiber_content_tolerance_range_math_op` varchar(10) NOT NULL,
  `percentage_of_weft_other_fiber_content_tolerance_value` float NOT NULL,
  `percentage_of_weft_other_fiber_content_min_value` float NOT NULL,
  `percentage_of_weft_other_fiber_content_max_value` float NOT NULL,
  `uom_of_percentage_of_weft_other_fiber_content` varchar(10) NOT NULL,
  `seam_slippage_resistance_in_warp_tolerance_range_math_operator` varchar(5) NOT NULL,
  `seam_slippage_resistance_in_warp_tolerance_value` float NOT NULL,
  `seam_slippage_resistance_in_warp_min_value` float NOT NULL,
  `seam_slippage_resistance_in_warp_max_value` float NOT NULL,
  `uom_of_seam_slippage_resistance_in_warp` varchar(10) NOT NULL,
  `seam_slippage_resistance_in_weft_tolerance_range_math_operator` varchar(5) NOT NULL,
  `seam_slippage_resistance_in_weft_tolerance_value` float NOT NULL,
  `seam_slippage_resistance_in_weft_min_value` float NOT NULL,
  `seam_slippage_resistance_in_weft_max_value` float NOT NULL,
  `uom_of_seam_slippage_resistance_in_weft` varchar(10) NOT NULL,
  `ph_value_tolerance_range_math_operator` varchar(5) NOT NULL,
  `ph_value_tolerance_value` float NOT NULL,
  `ph_value_min_value` float NOT NULL,
  `ph_value_max_value` float NOT NULL,
  `uom_of_ph_value` varchar(10) NOT NULL,
  `recording_person_id` varchar(20) NOT NULL,
  `recording_person_name` varchar(20) NOT NULL,
  `recording_time` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of defining_qc_standard_for_finishing_process_bkup_07_12_2020_new
-- ----------------------------

-- ----------------------------
-- Table structure for `defining_qc_standard_for_finishing_process_bkup_09_12_2020`
-- ----------------------------
DROP TABLE IF EXISTS `defining_qc_standard_for_finishing_process_bkup_09_12_2020`;
CREATE TABLE `defining_qc_standard_for_finishing_process_bkup_09_12_2020` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(50) NOT NULL,
  `version_id` varchar(30) NOT NULL,
  `version_number` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `finish_width_in_inch` float NOT NULL,
  `standard_for_which_process` varchar(50) NOT NULL,
  `cf_to_rubbing_dry_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_rubbing_dry_tolerance_value` float NOT NULL,
  `cf_to_rubbing_dry_min_value` float NOT NULL,
  `cf_to_rubbing_dry_max_value` float NOT NULL,
  `uom_of_cf_to_rubbing_dry` varchar(20) NOT NULL,
  `cf_to_rubbing_wet_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_rubbing_wet_tolerance_value` float NOT NULL,
  `cf_to_rubbing_wet_min_value` float NOT NULL,
  `cf_to_rubbing_wet_max_value` float NOT NULL,
  `uom_of_cf_to_rubbing_wet` varchar(20) NOT NULL,
  `washing_cycle_for_warp_for_washing_before_iron` varchar(20) NOT NULL,
  `change_in_warp_for_washing_before_iron_min_value` float NOT NULL,
  `change_in_warp_for_washing_before_iron_max_value` float NOT NULL,
  `uom_of_change_in_warp_for_washing_before_iron` varchar(10) NOT NULL,
  `washing_cycle_for_weft_for_washing_before_iron` varchar(20) NOT NULL,
  `change_in_weft_for_washing_before_iron_min_value` float NOT NULL,
  `change_in_weft_for_washing_before_iron_max_value` float NOT NULL,
  `uom_of_change_in_weft_for_washing_before_iron` varchar(10) NOT NULL,
  `washing_cycle_for_warp_for_washing_after_iron` varchar(20) NOT NULL,
  `change_in_warp_for_washing_after_iron_min_value` float NOT NULL,
  `change_in_warp_for_washing_after_iron_max_value` float NOT NULL,
  `uom_of_change_in_warp_for_washing_after_iron` varchar(10) NOT NULL,
  `washing_cycle_for_weft_for_washing_after_iron` varchar(20) NOT NULL,
  `change_in_weft_for_washing_after_iron_min_value` float NOT NULL,
  `change_in_weft_for_washing_after_iron_max_value` float NOT NULL,
  `uom_of_change_in_weft_for_washing_after_iron` varchar(10) NOT NULL,
  `warp_yarn_count_value` float NOT NULL,
  `warp_yarn_count_tolerance_range_math_operator` varchar(20) NOT NULL,
  `warp_yarn_count_tolerance_value` float NOT NULL,
  `warp_yarn_count_min_value` float NOT NULL,
  `warp_yarn_count_max_value` float NOT NULL,
  `uom_of_warp_yarn_count_value` varchar(10) NOT NULL,
  `weft_yarn_count_value` float NOT NULL,
  `weft_yarn_count_tolerance_range_math_operator` varchar(10) NOT NULL,
  `weft_yarn_count_tolerance_value` float NOT NULL,
  `weft_yarn_count_min_value` float NOT NULL,
  `weft_yarn_count_max_value` float NOT NULL,
  `uom_of_weft_yarn_count_value` varchar(10) NOT NULL,
  `mass_per_unit_per_area_value` float NOT NULL,
  `mass_per_unit_per_area_tolerance_range_math_operator` varchar(20) NOT NULL,
  `mass_per_unit_per_area_tolerance_value` float NOT NULL,
  `mass_per_unit_per_area_min_value` float NOT NULL,
  `mass_per_unit_per_area_max_value` float NOT NULL,
  `uom_of_mass_per_unit_per_area_value` varchar(10) NOT NULL,
  `no_of_threads_in_warp_value` float NOT NULL,
  `no_of_threads_in_warp_tolerance_range_math_operator` varchar(20) NOT NULL,
  `no_of_threads_in_warp_tolerance_value` float NOT NULL,
  `no_of_threads_in_warp_min_value` float NOT NULL,
  `no_of_threads_in_warp_max_value` float NOT NULL,
  `uom_of_no_of_threads_in_warp_value` varchar(10) NOT NULL,
  `no_of_threads_in_weft_value` float NOT NULL,
  `no_of_threads_in_weft_tolerance_range_math_operator` varchar(20) NOT NULL,
  `no_of_threads_in_weft_tolerance_value` float NOT NULL,
  `no_of_threads_in_weft_min_value` float NOT NULL,
  `no_of_threads_in_weft_max_value` float NOT NULL,
  `uom_of_no_of_threads_in_weft_value` varchar(10) NOT NULL,
  `rubs_for_surface_fuzzing_and_pilling` varchar(10) NOT NULL,
  `surface_fuzzing_and_pilling_tolerance_range_math_operator` varchar(20) NOT NULL,
  `surface_fuzzing_and_pilling_tolerance_value` float NOT NULL,
  `surface_fuzzing_and_pilling_min_value` float NOT NULL,
  `surface_fuzzing_and_pilling_max_value` float NOT NULL,
  `uom_of_surface_fuzzing_and_pilling_value` varchar(10) NOT NULL,
  `tensile_properties_in_warp_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `tensile_properties_in_warp_value_tolerance_value` float NOT NULL,
  `tensile_properties_in_warp_value_min_value` float NOT NULL,
  `tensile_properties_in_warp_value_max_value` float NOT NULL,
  `uom_of_tensile_properties_in_warp_value` varchar(10) NOT NULL,
  `tear_force_in_warp_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `tear_force_in_warp_value_tolerance_value` float NOT NULL,
  `tear_force_in_warp_value_min_value` float NOT NULL,
  `tear_force_in_warp_value_max_value` float NOT NULL,
  `uom_of_tear_force_in_warp_value` varchar(10) NOT NULL,
  `tear_force_in_weft_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `tear_force_in_weft_value_tolerance_value` float NOT NULL,
  `tear_force_in_weft_value_min_value` float NOT NULL,
  `tear_force_in_weft_value_max_value` float NOT NULL,
  `uom_of_tear_force_in_weft_value` varchar(10) NOT NULL,
  `seam_strength_in_warp_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `seam_strength_in_warp_value_tolerance_value` float NOT NULL,
  `seam_strength_in_warp_value_min_value` float NOT NULL,
  `seam_strength_in_warp_value_max_value` float NOT NULL,
  `uom_of_seam_strength_in_warp_value` varchar(10) NOT NULL,
  `seam_strength_in_weft_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `seam_strength_in_weft_value_tolerance_value` float NOT NULL,
  `seam_strength_in_weft_value_min_value` float NOT NULL,
  `seam_strength_in_weft_value_max_value` float NOT NULL,
  `uom_of_seam_strength_in_weft_value` varchar(10) NOT NULL,
  `abrasion_resistance_c_change_rubs` varchar(20) NOT NULL,
  `abrasion_resistance_c_change_value_math_op` varchar(20) NOT NULL,
  `abrasion_resistance_c_change_value_tolerance_value` float NOT NULL,
  `abrasion_resistance_c_change_value_min_value` float NOT NULL,
  `abrasion_resistance_c_change_value_max_value` float NOT NULL,
  `uom_of_abrasion_resistance_c_change_value` varchar(10) NOT NULL,
  `abrasion_resistance_no_thread_break` float NOT NULL,
  `abrasion_resistance_rubs` float NOT NULL,
  `abrasion_resistance_thread_break` varchar(20) NOT NULL,
  `rubs_for_mass_loss_in_abrasion_test` varchar(20) NOT NULL,
  `mass_loss_in_abrasion_test_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `mass_loss_in_abrasion_test_value_tolerance_value` float NOT NULL,
  `mass_loss_in_abrasion_test_value_min_value` float NOT NULL,
  `mass_loss_in_abrasion_test_value_max_value` float NOT NULL,
  `uom_of_mass_loss_in_abrasion_test_value` varchar(10) NOT NULL,
  `formaldehyde_content_tolerance_range_math_operator` varchar(20) NOT NULL,
  `formaldehyde_content_tolerance_value` float NOT NULL,
  `formaldehyde_content_min_value` float NOT NULL,
  `formaldehyde_content_max_value` float NOT NULL,
  `uom_of_formaldehyde_content` varchar(10) NOT NULL,
  `cf_to_dry_cleaning_color_change_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_dry_cleaning_color_change_tolerance_value` float NOT NULL,
  `cf_to_dry_cleaning_color_change_min_value` float NOT NULL,
  `cf_to_dry_cleaning_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_dry_cleaning_color_change` varchar(10) NOT NULL,
  `cf_to_dry_cleaning_staining_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_dry_cleaning_staining_tolerance_value` float NOT NULL,
  `cf_to_dry_cleaning_staining_min_value` float NOT NULL,
  `cf_to_dry_cleaning_staining_max_value` float NOT NULL,
  `uom_of_cf_to_dry_cleaning_staining` varchar(10) NOT NULL,
  `cf_to_washing_color_change_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_washing_color_change_tolerance_value` float NOT NULL,
  `cf_to_washing_color_change_min_value` float NOT NULL,
  `cf_to_washing_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_washing_color_change` varchar(10) NOT NULL,
  `cf_to_washing_staining_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_washing_staining_tolerance_value` float NOT NULL,
  `cf_to_washing_staining_min_value` float NOT NULL,
  `cf_to_washing_staining_max_value` float NOT NULL,
  `uom_of_cf_to_washing_staining` varchar(10) NOT NULL,
  `cf_to_washing_cross_staining_tolerance_range_math_operator` varchar(8) NOT NULL,
  `cf_to_washing_cross_staining_tolerance_value` float NOT NULL,
  `cf_to_washing_cross_staining_min_value` float NOT NULL,
  `cf_to_washing_cross_staining_max_value` float NOT NULL,
  `uom_of_cf_to_washing_cross_staining` varchar(10) NOT NULL,
  `cf_to_perspiration_acid_color_change_tolerance_range_math_op` varchar(20) NOT NULL,
  `cf_to_perspiration_acid_color_change_tolerance_value` float NOT NULL,
  `cf_to_perspiration_acid_color_change_min_value` float NOT NULL,
  `cf_to_perspiration_acid_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_perspiration_acid_color_change` varchar(10) NOT NULL,
  `cf_to_perspiration_acid_staining_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_perspiration_acid_staining_value` float NOT NULL,
  `cf_to_perspiration_acid_staining_min_value` float NOT NULL,
  `cf_to_perspiration_acid_staining_max_value` float NOT NULL,
  `uom_of_cf_to_perspiration_acid_staining` varchar(10) NOT NULL,
  `cf_to_perspiration_acid_cross_staining_tolerance_range_math_op` varchar(8) NOT NULL,
  `cf_to_perspiration_acid_cross_staining_tolerance_value` float NOT NULL,
  `cf_to_perspiration_acid_cross_staining_max_value` float NOT NULL,
  `cf_to_perspiration_acid_cross_staining_min_value` float NOT NULL,
  `uom_of_cf_to_perspiration_acid_cross_staining` varchar(10) NOT NULL,
  `cf_to_perspiration_alkali_color_change_tolerance_range_math_op` varchar(20) NOT NULL,
  `cf_to_perspiration_alkali_color_change_tolerance_value` float NOT NULL,
  `cf_to_perspiration_alkali_color_change_min_value` float NOT NULL,
  `cf_to_perspiration_alkali_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_perspiration_alkali_color_change` varchar(10) NOT NULL,
  `cf_to_perspiration_alkali_staining_tolerance_range_math_op` varchar(8) NOT NULL,
  `cf_to_perspiration_alkali_staining_tolerance_value` float NOT NULL,
  `cf_to_perspiration_alkali_staining_min_value` float NOT NULL,
  `cf_to_perspiration_alkali_staining_max_value` float NOT NULL,
  `uom_of_cf_to_perspiration_alkali_staining` varchar(10) NOT NULL,
  `cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op` varchar(8) NOT NULL,
  `cf_to_perspiration_alkali_cross_staining_tolerance_value` float NOT NULL,
  `cf_to_perspiration_alkali_cross_staining_min_value` float NOT NULL,
  `cf_to_perspiration_alkali_cross_staining_max_value` float NOT NULL,
  `uom_of_cf_to_perspiration_alkali_cross_staining` varchar(10) NOT NULL,
  `cf_to_water_color_change_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_water_color_change_tolerance_value` float NOT NULL,
  `cf_to_water_color_change_min_value` float NOT NULL,
  `cf_to_water_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_water_color_change` varchar(10) NOT NULL,
  `cf_to_water_staining_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_water_staining_tolerance_value` float NOT NULL,
  `cf_to_water_staining_min_value` float NOT NULL,
  `cf_to_water_staining_max_value` float NOT NULL,
  `uom_of_cf_to_water_staining` varchar(10) NOT NULL,
  `cf_to_water_cross_staining_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_water_cross_staining_tolerance_value` float NOT NULL,
  `cf_to_water_cross_staining_min_value` float NOT NULL,
  `cf_to_water_cross_staining_max_value` float NOT NULL,
  `uom_of_cf_to_water_cross_staining` varchar(10) NOT NULL,
  `cf_to_water_spotting_surface_tolerance_range_math_op` varchar(8) NOT NULL,
  `cf_to_water_spotting_surface_tolerance_value` float NOT NULL,
  `cf_to_water_spotting_surface_min_value` float NOT NULL,
  `cf_to_water_spotting_surface_max_value` float NOT NULL,
  `uom_of_cf_to_water_spotting_surface` varchar(10) NOT NULL,
  `cf_to_water_spotting_edge_tolerance_range_math_op` varchar(8) NOT NULL,
  `cf_to_water_spotting_edge_tolerance_value` float NOT NULL,
  `cf_to_water_spotting_edge_min_value` float NOT NULL,
  `cf_to_water_spotting_edge_max_value` float NOT NULL,
  `uom_of_cf_to_water_spotting_edge` varchar(10) NOT NULL,
  `cf_to_water_spotting_cross_staining_tolerance_range_math_op` varchar(8) NOT NULL,
  `cf_to_water_spotting_cross_staining_tolerance_value` float NOT NULL,
  `cf_to_water_spotting_cross_staining_min_value` float NOT NULL,
  `cf_to_water_spotting_cross_staining_max_value` float NOT NULL,
  `uom_of_cf_to_water_spotting_cross_staining` varchar(10) NOT NULL,
  `cf_to_surface_wetting_staining_before_wash_tol_range_math_op` varchar(20) NOT NULL,
  `cf_to_surface_wetting_staining_before_wash_tolerance_value` float NOT NULL,
  `cf_to_surface_wetting_staining_before_wash_min_value` float NOT NULL,
  `cf_to_surface_wetting_staining_before_wash_max_value` float NOT NULL,
  `uom_of_cf_to_surface_wetting_staining_before_wash` varchar(10) NOT NULL,
  `cf_to_surface_wetting_staining_after_one_wash_tol_range_math_op` varchar(8) NOT NULL,
  `cf_to_surface_wetting_staining_after_one_wash_tolerance_value` float NOT NULL,
  `cf_to_surface_wetting_staining_after_one_wash_min_value` float NOT NULL,
  `cf_to_surface_wetting_staining_after_one_wash_max_value` float NOT NULL,
  `uom_of_cf_to_surface_wetting_staining_after_one_wash` varchar(10) NOT NULL,
  `cf_to_surface_wetting_staining_after_five_wash_tol_range_math_op` varchar(8) NOT NULL,
  `cf_to_surface_wetting_staining_after_five_wash_tolerance_value` float NOT NULL,
  `cf_to_surface_wetting_staining_after_five_wash_min_value` float NOT NULL,
  `cf_to_surface_wetting_staining_after_five_wash_max_value` float NOT NULL,
  `uom_of_cf_to_surface_wetting_staining_after_five_wash` float NOT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op` varchar(20) NOT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value` float NOT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_min_value` float NOT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change` varchar(10) NOT NULL,
  `cf_to_oxidative_bleach_damage_color_change_tol_range_math_op` varchar(20) NOT NULL,
  `cf_to_oxidative_bleach_damage_value` varchar(10) NOT NULL,
  `cf_to_oxidative_bleach_damage_color_change_tolerance_value` float NOT NULL,
  `cf_to_oxidative_bleach_damage_color_change_min_value` float NOT NULL,
  `cf_to_oxidative_bleach_damage_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_oxidative_bleach_damage_color_change` varchar(10) NOT NULL,
  `cf_to_phenolic_yellowing_staining_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_phenolic_yellowing_staining_tolerance_value` float NOT NULL,
  `cf_to_phenolic_yellowing_staining_min_value` float NOT NULL,
  `cf_to_phenolic_yellowing_staining_max_value` float NOT NULL,
  `uom_of_cf_to_phenolic_yellowing_staining` varchar(10) NOT NULL,
  `cf_to_saliva_color_change_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_pvc_migration_staining_tolerance_value` float NOT NULL,
  `cf_to_pvc_migration_staining_min_value` float NOT NULL,
  `cf_to_pvc_migration_staining_max_value` float NOT NULL,
  `uom_of_cf_to_pvc_migration_staining` varchar(10) NOT NULL,
  `cf_to_pvc_migration_staining_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_saliva_color_change_tolerance_value` float NOT NULL,
  `cf_to_saliva_color_change_staining_min_value` float NOT NULL,
  `cf_to_saliva_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_saliva_color_change` varchar(10) NOT NULL,
  `cf_to_saliva_staining_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_saliva_staining_tolerance_value` float NOT NULL,
  `cf_to_saliva_staining_staining_min_value` float NOT NULL,
  `cf_to_saliva_staining_max_value` float NOT NULL,
  `uom_of_cf_to_saliva_staining` varchar(10) NOT NULL,
  `cf_to_chlorinated_water_color_change_tolerance_range_math_op` varchar(20) NOT NULL,
  `cf_to_chlorinated_water_color_change_tolerance_value` float NOT NULL,
  `cf_to_chlorinated_water_color_change_min_value` float NOT NULL,
  `cf_to_chlorinated_water_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_chlorinated_water_color_change` varchar(10) NOT NULL,
  `cf_to_cholorine_bleach_color_change_tolerance_range_math_op` varchar(5) NOT NULL,
  `cf_to_cholorine_bleach_color_change_tolerance_value` float NOT NULL,
  `cf_to_cholorine_bleach_color_change_min_value` float NOT NULL,
  `cf_to_cholorine_bleach_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_cholorine_bleach_color_change` varchar(10) NOT NULL,
  `cf_to_peroxide_bleach_color_change_tolerance_range_math_operator` varchar(5) NOT NULL,
  `cf_to_peroxide_bleach_color_change_tolerance_value` float NOT NULL,
  `cf_to_peroxide_bleach_color_change_min_value` float NOT NULL,
  `cf_to_peroxide_bleach_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_peroxide_bleach_color_change` varchar(10) NOT NULL,
  `cf_to_peroxide_bleach_staining_tolerance_range_math_operator` varchar(5) NOT NULL,
  `cf_to_peroxide_bleach_staining_tolerance_value` float NOT NULL,
  `cf_to_peroxide_bleach_staining_min_value` float NOT NULL,
  `cf_to_peroxide_bleach_staining_max_value` float NOT NULL,
  `uom_of_cf_to_peroxide_bleach_staining` varchar(10) NOT NULL,
  `cross_staining_tolerance_range_math_operator` varchar(5) NOT NULL,
  `cross_staining_tolerance_value` float NOT NULL,
  `cross_staining_min_value` float NOT NULL,
  `cross_staining_max_value` float NOT NULL,
  `uom_of_cross_staining` varchar(10) NOT NULL,
  `description_or_type_for_water_absorption` varchar(30) NOT NULL,
  `water_absorption_value_tolerance_range_math_operator` varchar(5) NOT NULL,
  `water_absorption_value_tolerance_value` float NOT NULL,
  `water_absorption_value_min_value` float NOT NULL,
  `water_absorption_value_max_value` float NOT NULL,
  `uom_of_water_absorption_value` varchar(10) NOT NULL,
  `water_absorption_b_wash_thirty_sec_tolerance_range_math_op` varchar(10) NOT NULL,
  `water_absorption_b_wash_thirty_sec_tolerance_value` float NOT NULL,
  `water_absorption_b_wash_thirty_sec_min_value` float NOT NULL,
  `water_absorption_b_wash_thirty_sec_max_value` float NOT NULL,
  `uom_of_water_absorption_b_wash_thirty_sec` varchar(15) NOT NULL,
  `water_absorption_b_wash_max_tolerance_range_math_op` varchar(10) NOT NULL,
  `water_absorption_b_wash_max_tolerance_value` float NOT NULL,
  `water_absorption_b_wash_max_min_value` float NOT NULL,
  `water_absorption_b_wash_max_max_value` float NOT NULL,
  `uom_of_water_absorption_b_wash_max` varchar(15) NOT NULL,
  `water_absorption_a_wash_thirty_sec_tolerance_range_math_op` varchar(10) NOT NULL,
  `water_absorption_a_wash_thirty_sec_tolerance_value` float NOT NULL,
  `water_absorption_a_wash_thirty_sec_min_value` float NOT NULL,
  `water_absorption_a_wash_thirty_sec_max_value` float NOT NULL,
  `uom_of_water_absorption_a_wash_thirty_sec` varchar(15) NOT NULL,
  `wicking_test_tol_range_math_op` varchar(10) NOT NULL,
  `wicking_test_tolerance_value` float NOT NULL,
  `wicking_test_min_value` float NOT NULL,
  `wicking_test_max_value` float NOT NULL,
  `uom_of_wicking_test` varchar(10) NOT NULL,
  `spirality_value_tolerance_range_math_operator` varchar(5) NOT NULL,
  `spirality_value_tolerance_value` float NOT NULL,
  `spirality_value_min_value` float NOT NULL,
  `spirality_value_max_value` float NOT NULL,
  `uom_of_spirality_value` varchar(10) NOT NULL,
  `seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op` varchar(10) NOT NULL,
  `seam_slippage_resistance_iso_2_in_warp_tolerance_value` float NOT NULL,
  `seam_slippage_resistance_iso_2_in_warp_min_value` float NOT NULL,
  `seam_slippage_resistance_iso_2_in_warp_max_value` float NOT NULL,
  `uom_of_seam_slippage_resistance_iso_2_in_warp` float NOT NULL,
  `seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op` varchar(8) NOT NULL,
  `seam_slippage_resistance_iso_2_in_weft_tolerance_value` float NOT NULL,
  `seam_slippage_resistance_iso_2_in_weft_min_value` float NOT NULL,
  `seam_slippage_resistance_iso_2_in_weft_max_value` float NOT NULL,
  `uom_of_seam_slippage_resistance_iso_2_in_weft` varchar(15) NOT NULL,
  `seam_slippage_resistance_in_warp_tolerance_range_math_operator` varchar(5) NOT NULL,
  `seam_slippage_resistance_in_warp_tolerance_value` float NOT NULL,
  `seam_slippage_resistance_in_warp_min_value` float NOT NULL,
  `seam_slippage_resistance_in_warp_max_value` float NOT NULL,
  `uom_of_seam_slippage_resistance_in_warp` varchar(10) NOT NULL,
  `seam_slippage_resistance_in_weft_tolerance_range_math_operator` varchar(5) NOT NULL,
  `seam_slippage_resistance_in_weft_tolerance_value` float NOT NULL,
  `seam_slippage_resistance_in_weft_min_value` float NOT NULL,
  `seam_slippage_resistance_in_weft_max_value` float NOT NULL,
  `uom_of_seam_slippage_resistance_in_weft` varchar(10) NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op` varchar(8) NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value` float NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_warp_min_value` float NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_warp_max_value` float NOT NULL,
  `uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp` varchar(15) NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op` varchar(8) NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value` float NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_weft_min_value` float NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_weft_max_value` float NOT NULL,
  `uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft` varchar(15) NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op` varchar(8) NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value` float NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_warp_min_value` float NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_warp_max_value` float NOT NULL,
  `uom_of_seam_properties_seam_strength_iso_astm_d_in_warp` varchar(15) NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op` varchar(8) NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value` float NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_weft_min_value` float NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_weft_max_value` float NOT NULL,
  `uom_of_seam_properties_seam_strength_iso_astm_d_in_weft` varchar(15) NOT NULL,
  `ph_value_tolerance_range_math_operator` varchar(5) NOT NULL,
  `ph_value_tolerance_value` float NOT NULL,
  `ph_value_min_value` float NOT NULL,
  `ph_value_max_value` float NOT NULL,
  `uom_of_ph_value` varchar(10) NOT NULL,
  `smoothness_appearance_tolerance_range_math_op` varchar(8) NOT NULL,
  `smoothness_appearance_tolerance_value` float NOT NULL,
  `smoothness_appearance_min_value` float NOT NULL,
  `smoothness_appearance_max_value` float NOT NULL,
  `uom_of_smoothness_appearance` varchar(15) NOT NULL,
  `print_duribility_m_s_c_15_washing_time_value` float NOT NULL,
  `print_duribility_m_s_c_15_value` varchar(30) NOT NULL,
  `uom_of_print_duribility_m_s_c_15` varchar(15) NOT NULL,
  `description_or_type_for_iron_temperature` varchar(20) NOT NULL,
  `iron_ability_of_woven_fabric_tolerance_range_math_op` varchar(8) NOT NULL,
  `iron_ability_of_woven_fabric_tolerance_value` float NOT NULL,
  `iron_ability_of_woven_fabric_min_value` float NOT NULL,
  `iron_ability_of_woven_fabric_max_value` float NOT NULL,
  `uom_of_iron_ability_of_woven_fabric` varchar(15) NOT NULL,
  `color_fastess_to_artificial_daylight_blue_wool_scale` varchar(15) NOT NULL,
  `color_fastess_to_artificial_daylight_tolerance_range_math_op` varchar(8) NOT NULL,
  `color_fastess_to_artificial_daylight_tolerance_value` float NOT NULL,
  `color_fastess_to_artificial_daylight_min_value` float NOT NULL,
  `color_fastess_to_artificial_daylight_max_value` float NOT NULL,
  `uom_of_color_fastess_to_artificial_daylight` varchar(15) NOT NULL,
  `moisture_content_tolerance_range_math_op` varchar(8) NOT NULL,
  `moisture_content_tolerance_value` float NOT NULL,
  `moisture_content_min_value` float NOT NULL,
  `moisture_content_max_value` float NOT NULL,
  `uom_of_moisture_content` varchar(15) NOT NULL,
  `evaporation_rate_quick_drying_tolerance_range_math_op` varchar(8) NOT NULL,
  `evaporation_rate_quick_drying_tolerance_value` float NOT NULL,
  `evaporation_rate_quick_drying_min_value` float NOT NULL,
  `evaporation_rate_quick_drying_max_value` float NOT NULL,
  `uom_of_evaporation_rate_quick_drying` varchar(10) NOT NULL,
  `recording_person_id` varchar(20) NOT NULL,
  `recording_person_name` varchar(20) NOT NULL,
  `recording_time` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of defining_qc_standard_for_finishing_process_bkup_09_12_2020
-- ----------------------------
INSERT INTO `defining_qc_standard_for_finishing_process_bkup_09_12_2020` VALUES ('21', '6038/2020', 'version_2', 'Reverse', 'Ikea', 'Dk. Blue', '0', 'Finishing', 'select', '0', '0', '0', 'uom_of_cf_to_rubbing', 'select', '0', '0', '0', 'Berger', '', '0', '0', 'celcius', '', '0', '0', 'celcius', '', '0', '0', 'celcius', '', '0', '0', 'celcius', '0', 'select', '0', '0', '0', 'select', '0', 'select', '0', '0', '0', 'select', '0', '', '0', '0', '0', 'select', '0', 'select', '0', '0', '0', 'select', '0', 'select', '0', '0', '0', 'select', '', 'select', '0', '0', '0', 'uom_of_sur', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', '≥', '2', '2', '5', 'select', '≥', '2', '2', '5', 'select', '', 'select', '0', '0', '0', 'uom', '0', '0', '', '', 'select', '0', '0', '0', 'uom', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', '0', 'select', '0', '0', '0', 'value', 'select', 'on tone', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'selec', '0', '0', '0', 'value', 'selec', '0', '0', '0', 'value', '', '0', '0', '0', '', 'selec', '0', '0', '0', 'value', 'select', '≤', '0', '0', '0', 'select', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', 'select', 'selec', '0', '0', '0', '%', 'select', '0', '0', '0', '0', 'select', '0', '0', '0', 'select', 'selec', '0', '0', '0', 'select', 'selec', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', '', '0', '0', '0', 'select', '', '0', '0', '0', 'select', 'selec', '0', '0', '0', '%', 'select', '0', '0', '0', '%', '0', 'select', 'Minute', 'select', 'select', '0', '0', '0', '%', '', '', '0', '0', '0', '', '≤', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'iftekhar', 'iftekhar', '2020-12-09 12:10:20');
INSERT INTO `defining_qc_standard_for_finishing_process_bkup_09_12_2020` VALUES ('22', '6038/2020', 'version_3', 'Front', 'Ikea', 'Light Blue', '0', 'Finishing', 'select', '0', '0', '0', 'uom_of_cf_to_rubbing', 'select', '0', '0', '0', 'Berger', '', '0', '0', 'celcius', '', '0', '0', 'celcius', '', '0', '0', 'celcius', '', '0', '0', 'celcius', '0', 'select', '0', '0', '0', 'select', '0', 'select', '0', '0', '0', 'select', '0', '', '0', '0', '0', 'select', '0', 'select', '0', '0', '0', 'select', '0', 'select', '0', '0', '0', 'select', '', 'select', '0', '0', '0', 'uom_of_sur', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', '', 'select', '0', '0', '0', 'uom', '0', '0', '', '', 'select', '0', '0', '0', 'uom', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', '0', 'select', '0', '0', '0', 'value', 'select', 'on tone', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'selec', '0', '0', '0', 'value', 'selec', '0', '0', '0', 'value', '', '0', '0', '0', '', 'selec', '0', '0', '0', 'value', 'select', '≤', '0', '0', '0', 'select', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', 'select', 'selec', '0', '0', '0', '%', 'select', '0', '0', '0', '0', 'select', '0', '0', '0', 'select', 'selec', '0', '0', '0', 'select', 'selec', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'selec', '0', '0', '0', '%', 'select', '0', '0', '0', '%', '0', 'select', 'Minute', 'select', 'select', '0', '0', '0', '%', '', '', '0', '0', '0', '', '≤', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'iftekhar', 'iftekhar', '2020-12-09 12:12:58');
INSERT INTO `defining_qc_standard_for_finishing_process_bkup_09_12_2020` VALUES ('23', '6038/2020', 'version_26', 'Pillow Back', 'Ikea', 'Beige', '50', 'Finishing', 'select', '0', '0', '0', 'uom_of_cf_to_rubbing', 'select', '0', '0', '0', 'Berger', '', '0', '0', 'celcius', '', '0', '0', 'celcius', '', '0', '0', 'celcius', '', '0', '0', 'celcius', '0', 'select', '0', '0', '0', 'select', '0', 'select', '0', '0', '0', 'select', '0', '', '0', '0', '0', 'select', '0', 'select', '0', '0', '0', 'select', '0', 'select', '0', '0', '0', 'select', '', 'select', '0', '0', '0', 'uom_of_sur', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', '', 'select', '0', '0', '0', 'uom', '0', '0', '', '', 'select', '0', '0', '0', 'uom', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', '0', 'select', '0', '0', '0', 'value', 'select', 'on tone', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'selec', '0', '0', '0', 'value', 'selec', '0', '0', '0', 'value', '', '0', '0', '0', '', 'selec', '0', '0', '0', 'value', 'select', '≤', '0', '0', '0', 'select', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', 'select', 'selec', '0', '0', '0', '%', 'select', '0', '0', '0', '0', 'select', '0', '0', '0', 'select', 'selec', '0', '0', '0', 'select', 'selec', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'selec', '0', '0', '0', '%', 'select', '0', '0', '0', '%', '0', 'select', 'Minute', 'select', 'select', '0', '0', '0', '%', 'AFU', 'select', '0', '0', '0', '%', '≤', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'iftekhar', 'iftekhar', '2020-12-09 13:10:24');
INSERT INTO `defining_qc_standard_for_finishing_process_bkup_09_12_2020` VALUES ('24', '6038/2020', 'version_5', 'Reverse', 'Ikea', 'Light Blue', '0', 'Finishing', 'select', '0', '0', '0', 'uom_of_cf_to_rubbing', 'select', '0', '0', '0', 'Berger', '', '0', '0', 'celcius', '', '0', '0', 'celcius', '', '0', '0', 'celcius', '', '0', '0', 'celcius', '0', 'select', '0', '0', '0', 'select', '0', 'select', '0', '0', '0', 'select', '0', '', '0', '0', '0', 'select', '0', 'select', '0', '0', '0', 'select', '0', 'select', '0', '0', '0', 'select', '', 'select', '0', '0', '0', 'uom_of_sur', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', '', 'select', '0', '0', '0', 'uom', '0', '0', '', '', 'select', '0', '0', '0', 'uom', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', '0', 'select', '0', '0', '0', 'value', 'select', 'on tone', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'selec', '0', '0', '0', 'value', 'selec', '0', '0', '0', 'value', '', '0', '0', '0', '', 'selec', '0', '0', '0', 'value', 'select', '≤', '0', '0', '0', 'select', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', 'select', 'selec', '0', '0', '0', '%', 'select', '0', '0', '0', '0', 'select', '0', '0', '0', 'select', 'selec', '0', '0', '0', 'select', 'selec', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'selec', '0', '0', '0', '%', 'select', '0', '0', '0', '%', '0', 'select', 'Minute', 'select', 'select', '0', '0', '0', '%', 'select', 'select', '0', '0', '0', '%', '≤', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'iftekhar', 'iftekhar', '2020-12-09 15:06:15');
INSERT INTO `defining_qc_standard_for_finishing_process_bkup_09_12_2020` VALUES ('25', 'ZZFL-H/PP/20/02224', 'version_12', 'Sheet', 'Walmart', 'Light Grey', '0', 'Finishing', 'select', '0', '0', '0', 'uom_of_cf_to_rubbing', 'select', '0', '0', '0', 'Berger', '', '0', '0', 'celcius', '', '0', '0', 'celcius', '', '0', '0', 'celcius', '', '0', '0', 'celcius', '0', 'select', '0', '0', '0', 'select', '0', 'select', '0', '0', '0', 'select', '0', '', '0', '0', '0', 'select', '0', 'select', '0', '0', '0', 'select', '0', 'select', '0', '0', '0', 'select', '', 'select', '0', '0', '0', 'uom_of_sur', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', '', 'select', '0', '0', '0', 'uom', '0', '0', '', '', 'select', '0', '0', '0', 'uom', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', '0', 'select', '0', '0', '0', 'value', 'select', 'on tone', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'selec', '0', '0', '0', 'value', 'selec', '0', '0', '0', 'value', '', '0', '0', '0', '', 'selec', '0', '0', '0', 'value', 'select', '≤', '0', '0', '0', 'select', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', 'select', 'selec', '0', '0', '0', '%', 'select', '0', '0', '0', '0', 'select', '0', '0', '0', 'select', 'selec', '0', '0', '0', 'select', 'selec', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'selec', '0', '0', '0', '%', 'select', '0', '0', '0', '%', '0', 'select', 'Minute', 'select', 'select', '0', '0', '0', '%', 'AFU', '≥', '0', '0', '8', '%', '≤', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'iftekhar', 'iftekhar', '2020-12-09 15:34:42');
INSERT INTO `defining_qc_standard_for_finishing_process_bkup_09_12_2020` VALUES ('26', 'ZZFL-H/PP/20/02224', 'version_18', 'Sheet', 'Walmart', 'Blue', '0', 'Finishing', 'select', '0', '0', '0', 'uom_of_cf_to_rubbing', 'select', '0', '0', '0', 'Berger', '', '0', '0', 'celcius', '', '0', '0', 'celcius', '', '0', '0', 'celcius', '', '0', '0', 'celcius', '0', 'select', '0', '0', '0', 'select', '0', 'select', '0', '0', '0', 'select', '0', '', '0', '0', '0', 'select', '0', 'select', '0', '0', '0', 'select', '0', 'select', '0', '0', '0', 'select', '', 'select', '0', '0', '0', 'uom_of_sur', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', '', 'select', '0', '0', '0', 'uom', '0', '0', '', '', 'select', '0', '0', '0', 'uom', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', '0', 'select', '0', '0', '0', 'value', 'select', 'on tone', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'selec', '0', '0', '0', 'value', 'selec', '0', '0', '0', 'value', '', '0', '0', '0', '', 'selec', '0', '0', '0', 'value', 'select', '≤', '0', '0', '0', 'select', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', 'select', 'selec', '0', '0', '0', '%', 'select', '0', '0', '0', '0', 'select', '0', '0', '0', 'select', 'selec', '0', '0', '0', 'select', 'selec', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'selec', '0', '0', '0', '%', 'select', '0', '0', '0', '%', '0', 'select', 'Minute', 'select', 'select', '0', '0', '0', '%', 'AFU', '≤', '0', '0', '6', '%', '≤', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'iftekhar', 'iftekhar', '2020-12-09 15:38:18');
INSERT INTO `defining_qc_standard_for_finishing_process_bkup_09_12_2020` VALUES ('27', 'ZZFL-H/PP/20/02224', 'version_16', 'Sheet', 'Walmart', 'Black', '0', 'Finishing', 'select', '0', '0', '0', 'uom_of_cf_to_rubbing', 'select', '0', '0', '0', 'Berger', '', '0', '0', 'celcius', '', '0', '0', 'celcius', '', '0', '0', 'celcius', '', '0', '0', 'celcius', '0', 'select', '0', '0', '0', 'select', '0', 'select', '0', '0', '0', 'select', '0', '', '0', '0', '0', 'select', '0', 'select', '0', '0', '0', 'select', '0', 'select', '0', '0', '0', 'select', '', 'select', '0', '0', '0', 'uom_of_sur', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', '', 'select', '0', '0', '0', 'uom', '0', '0', '', '', 'select', '0', '0', '0', 'uom', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', '0', 'select', '0', '0', '0', 'value', 'select', 'on tone', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'selec', '0', '0', '0', 'value', 'selec', '0', '0', '0', 'value', '', '0', '0', '0', '', 'selec', '0', '0', '0', 'value', 'select', '≤', '0', '0', '0', 'select', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', 'select', 'selec', '0', '0', '0', '%', 'select', '0', '0', '0', '0', 'select', '0', '0', '0', 'select', 'selec', '0', '0', '0', 'select', 'selec', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'selec', '0', '0', '0', '%', 'select', '0', '0', '0', '%', '0', 'select', 'Minute', 'select', 'select', '0', '0', '0', '%', 'Normal', '≥', '5', '5', '8', '%', '≤', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'iftekhar', 'iftekhar', '2020-12-09 15:40:07');
INSERT INTO `defining_qc_standard_for_finishing_process_bkup_09_12_2020` VALUES ('28', 'ZZFL-H/PP/20/02224', 'version_25', 'Front', 'Walmart', 'Black', '0', 'Finishing', 'select', '0', '0', '0', 'uom_of_cf_to_rubbing', 'select', '0', '0', '0', 'Berger', '', '0', '0', 'celcius', '', '0', '0', 'celcius', '', '0', '0', 'celcius', '', '0', '0', 'celcius', '0', 'select', '0', '0', '0', 'select', '0', 'select', '0', '0', '0', 'select', '0', '', '0', '0', '0', 'select', '0', 'select', '0', '0', '0', 'select', '0', 'select', '0', '0', '0', 'select', '', 'select', '0', '0', '0', 'uom_of_sur', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', '', 'select', '0', '0', '0', 'uom', '0', '0', '', '', 'select', '0', '0', '0', 'uom', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', '0', 'select', '0', '0', '0', 'value', 'select', 'on tone', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'select', '0', '0', '0', 'value', 'selec', '0', '0', '0', 'value', 'selec', '0', '0', '0', 'value', '', '0', '0', '0', '', 'selec', '0', '0', '0', 'value', 'select', '≤', '0', '0', '0', 'select', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'select', '0', '0', '0', 'select', 'selec', '0', '0', '0', '%', 'select', '0', '0', '0', '0', 'select', '0', '0', '0', 'select', 'selec', '0', '0', '0', 'select', 'selec', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'select', '0', '0', '0', 'select', 'selec', '0', '0', '0', '%', 'select', '0', '0', '0', '%', '0', 'select', 'Minute', 'select', 'select', '0', '0', '0', '%', 'AFU', '≥', '7.5', '7.5', '8', '%', '≤', '0', '0', '0', '%', 'select', '0', '0', '0', '%', 'iftekhar', 'iftekhar', '2020-12-09 15:49:31');

-- ----------------------------
-- Table structure for `defining_qc_standard_for_finishing_process_bkup_17_11_2020`
-- ----------------------------
DROP TABLE IF EXISTS `defining_qc_standard_for_finishing_process_bkup_17_11_2020`;
CREATE TABLE `defining_qc_standard_for_finishing_process_bkup_17_11_2020` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) DEFAULT NULL,
  `version_number` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `finish_width_in_inch` double DEFAULT NULL,
  `standard_for_which_process` varchar(50) DEFAULT NULL,
  `cf_to_rubbing_dry_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_rubbing_dry_tolerance_value` double DEFAULT NULL,
  `cf_to_rubbing_dry_min_value` double DEFAULT NULL,
  `cf_to_rubbing_dry_max_value` double DEFAULT NULL,
  `uom_of_cf_to_rubbing_dry` varchar(20) DEFAULT NULL,
  `cf_to_rubbing_wet_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_rubbing_wet_tolerance_value` double DEFAULT NULL,
  `cf_to_rubbing_wet_min_value` double DEFAULT NULL,
  `cf_to_rubbing_wet_max_value` double DEFAULT NULL,
  `uom_of_cf_to_rubbing_wet` varchar(20) DEFAULT NULL,
  `dimensional_stability_to_warp_washing_before_iron_min_value` double DEFAULT NULL,
  `dimensional_stability_to_warp_washing_before_iron_max_value` varchar(0) DEFAULT NULL,
  `uom_of_dimensional_stability_to_warp_washing_before_iron` varchar(20) DEFAULT NULL,
  `dimensional_stability_to_weft_washing_before_iron_min_value` double DEFAULT NULL,
  `dimensional_stability_to_weft_washing_before_iron_max_value` varchar(0) DEFAULT NULL,
  `uom_of_dimensional_stability_to_weft_washing_before_iron` varchar(20) DEFAULT NULL,
  `dimensional_stability_to_warp_washing_after_iron_min_value` double DEFAULT NULL,
  `dimensional_stability_to_warp_washing_after_iron_max_value` double DEFAULT NULL,
  `uom_of_dimensional_stability_to_warp_washing_after_iron` varchar(20) DEFAULT NULL,
  `dimensional_stability_to_weft_washing_after_iron_min_value` double DEFAULT NULL,
  `dimensional_stability_to_weft_washing_after_iron_max_value` double DEFAULT NULL,
  `uom_of_dimensional_stability_to_weft_washing_after_iron` varchar(20) DEFAULT NULL,
  `change_in_warp_for_dry_cleaning_min_value` double DEFAULT NULL,
  `change_in_warp_for_dry_cleaning_max_value` double DEFAULT NULL,
  `uom_of_change_in_warp_for_dry_cleaning` varchar(20) DEFAULT NULL,
  `change_in_weft_for_dry_cleaning_min_value` double DEFAULT NULL,
  `change_in_weft_for_dry_cleaning_max_value` double DEFAULT NULL,
  `uom_of_change_in_weft_for_dry_cleaning` varchar(20) DEFAULT NULL,
  `warp_yarn_count_value` double DEFAULT NULL,
  `warp_yarn_count_math_operator` varchar(20) DEFAULT NULL,
  `warp_yarn_count_tolerance_value` double DEFAULT NULL,
  `warp_yarn_count_min_value` double DEFAULT NULL,
  `warp_yarn_count_max_value` double DEFAULT NULL,
  `uom_of_warp_yarn_count_value` varchar(20) DEFAULT NULL,
  `mass_per_unit_per_area_value` double DEFAULT NULL,
  `mass_per_unit_per_area_math_operator` varchar(20) DEFAULT NULL,
  `mass_per_unit_per_area_tolerance_value` double DEFAULT NULL,
  `mass_per_unit_per_area_min_value` double DEFAULT NULL,
  `mass_per_unit_per_area_max_value` double DEFAULT NULL,
  `uom_of_mass_per_unit_per_area_value` varchar(20) DEFAULT NULL,
  `no_of_threads_in_warp_value` double DEFAULT NULL,
  `no_of_threads_in_warp_math_operator` varchar(20) DEFAULT NULL,
  `no_of_threads_in_warp_tolerance_value` double DEFAULT NULL,
  `no_of_threads_in_warp_min_value` double DEFAULT NULL,
  `no_of_threads_in_warp_max_value` double DEFAULT NULL,
  `uom_of_no_of_threads_in_warp_value` varchar(20) DEFAULT NULL,
  `no_of_threads_in_weft_value` double DEFAULT NULL,
  `no_of_threads_in_weft_math_operator` varchar(20) DEFAULT NULL,
  `no_of_threads_in_weft_tolerance_value` double DEFAULT NULL,
  `no_of_threads_in_weft_min_value` double DEFAULT NULL,
  `no_of_threads_in_weft_max_value` double DEFAULT NULL,
  `uom_of_no_of_threads_in_weft_value` varchar(20) DEFAULT NULL,
  `surface_fuzzing_and_pilling_math_operator` varchar(20) DEFAULT NULL,
  `surface_fuzzing_and_pilling_tolerance_value` double DEFAULT NULL,
  `surface_fuzzing_and_pilling_min_value` double DEFAULT NULL,
  `surface_fuzzing_and_pilling_max_value` double DEFAULT NULL,
  `uom_of_surface_fuzzing_and_pilling_value` varchar(20) DEFAULT NULL,
  `tensile_properties_in_warp_value_math_operator` varchar(20) DEFAULT NULL,
  `tensile_properties_in_warp_value_tolerance_value` double DEFAULT NULL,
  `tensile_properties_in_warp_value_min_value` double DEFAULT NULL,
  `tensile_properties_in_warp_value_max_value` double DEFAULT NULL,
  `uom_of_tensile_properties_in_warp_value` varchar(20) DEFAULT NULL,
  `tear_force_in_warp_value_math_operator` varchar(20) DEFAULT NULL,
  `tear_force_in_warp_value_tolerance_value` double DEFAULT NULL,
  `tear_force_in_warp_value_min_value` double DEFAULT NULL,
  `tear_force_in_warp_value_max_value` double DEFAULT NULL,
  `uom_of_tear_force_in_warp_value` varchar(20) DEFAULT NULL,
  `tear_force_in_weft_value_math_operator` varchar(20) DEFAULT NULL,
  `tear_force_in_weft_value_tolerance_value` double DEFAULT NULL,
  `tear_force_in_weft_value_min_value` double DEFAULT NULL,
  `tear_force_in_weft_value_max_value` double DEFAULT NULL,
  `uom_of_tear_force_in_weft_value` varchar(20) DEFAULT NULL,
  `seam_strength_in_warp_value_math_operator` varchar(20) DEFAULT NULL,
  `seam_strength_in_warp_value_tolerance_value` double DEFAULT NULL,
  `seam_strength_in_warp_value_min_value` double DEFAULT NULL,
  `seam_strength_in_warp_value_max_value` double DEFAULT NULL,
  `uom_of_seam_strength_in_warp_value` varchar(20) DEFAULT NULL,
  `seam_strength_in_weft_value_math_operator` varchar(20) DEFAULT NULL,
  `seam_strength_in_weft_value_tolerance_value` double DEFAULT NULL,
  `seam_strength_in_weft_value_min_value` double DEFAULT NULL,
  `seam_strength_in_weft_value_max_value` double DEFAULT NULL,
  `uom_of_seam_strength_in_weft_value` varchar(20) DEFAULT NULL,
  `abrasion_resistance_s_change_value_math_op` varchar(20) DEFAULT NULL,
  `abrasion_resistance_s_change_value_tolerance_value` double DEFAULT NULL,
  `abrasion_resistance_s_change_value_min_value` double DEFAULT NULL,
  `abrasion_resistance_s_change_value_max_value` double DEFAULT NULL,
  `uom_of_abrasion_resistance_s_change_value` varchar(20) DEFAULT NULL,
  `abrasion_resistance_thread_break` varchar(20) DEFAULT NULL,
  `revolution` varchar(20) DEFAULT NULL,
  `print_durability` varchar(20) DEFAULT NULL,
  `mass_loss_in_abrasion_test_value_math_operator` varchar(20) DEFAULT NULL,
  `mass_loss_in_abrasion_test_value_tolerance_value` double DEFAULT NULL,
  `mass_loss_in_abrasion_test_value_min_value` double DEFAULT NULL,
  `mass_loss_in_abrasion_test_value_max_value` double DEFAULT NULL,
  `uom_of_mass_loss_in_abrasion_test_value` varchar(20) DEFAULT NULL,
  `formaldehyde_content_math_operator` varchar(20) DEFAULT NULL,
  `formaldehyde_content_tolerance_value` double DEFAULT NULL,
  `formaldehyde_content_min_value` double DEFAULT NULL,
  `formaldehyde_content_max_value` double DEFAULT NULL,
  `uom_of_formaldehyde_content` varchar(20) DEFAULT NULL,
  `cf_to_dry_cleaning_color_change_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_dry_cleaning_color_change_tolerance_value` double DEFAULT NULL,
  `cf_to_dry_cleaning_color_change_min_value` double DEFAULT NULL,
  `cf_to_dry_cleaning_color_change_max_value` double DEFAULT NULL,
  `uom_of_cf_to_dry_cleaning_color_change` varchar(20) DEFAULT NULL,
  `cf_to_dry_cleaning_staining_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_dry_cleaning_staining_tolerance_value` double DEFAULT NULL,
  `cf_to_dry_cleaning_staining_min_value` double DEFAULT NULL,
  `cf_to_dry_cleaning_staining_max_value` double DEFAULT NULL,
  `uom_of_cf_to_dry_cleaning_staining` varchar(20) DEFAULT NULL,
  `cf_to_washing_color_change_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_washing_color_change_tolerance_value` double DEFAULT NULL,
  `cf_to_washing_color_change_min_value` double DEFAULT NULL,
  `cf_to_washing_color_change_max_value` double DEFAULT NULL,
  `uom_of_cf_to_washing_color_change` varchar(20) DEFAULT NULL,
  `cf_to_washing_staining_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_washing_staining_tolerance_value` double DEFAULT NULL,
  `cf_to_washing_staining_min_value` double DEFAULT NULL,
  `cf_to_washing_staining_max_value` double DEFAULT NULL,
  `uom_of_cf_to_washing_staining` varchar(20) DEFAULT NULL,
  `cf_to_perspiration_acid_color_change_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_perspiration_acid_color_change_tolerance_value` double DEFAULT NULL,
  `cf_to_perspiration_acid_color_change_min_value` double DEFAULT NULL,
  `cf_to_perspiration_acid_color_change_max_value` double DEFAULT NULL,
  `uom_of_cf_to_perspiration_acid_color_change` varchar(20) DEFAULT NULL,
  `cf_to_perspiration_acid_staining_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_perspiration_acid_staining_value` double DEFAULT NULL,
  `cf_to_perspiration_acid_staining_min_value` double DEFAULT NULL,
  `cf_to_perspiration_acid_staining_max_value` double DEFAULT NULL,
  `uom_of_cf_to_perspiration_acid_staining` varchar(20) DEFAULT NULL,
  `cf_to_perspiration_alkali_color_change_range_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_perspiration_alkali_color_change_tolerance_value` double DEFAULT NULL,
  `cf_to_perspiration_alkali_color_change_min_value` double DEFAULT NULL,
  `cf_to_perspiration_alkali_color_change_max_value` double DEFAULT NULL,
  `uom_of_cf_to_perspiration_alkali_color_change` varchar(20) DEFAULT NULL,
  `cf_to_water_color_change_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_water_color_change_tolerance_value` double DEFAULT NULL,
  `cf_to_water_color_change_min_value` double DEFAULT NULL,
  `cf_to_water_color_change_max_value` double DEFAULT NULL,
  `uom_of_cf_to_water_color_change` varchar(20) DEFAULT NULL,
  `cf_to_water_staining_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_water_staining_tolerance_value` double DEFAULT NULL,
  `cf_to_water_staining_min_value` double DEFAULT NULL,
  `cf_to_water_staining_max_value` double DEFAULT NULL,
  `uom_of_cf_to_water_staining` varchar(20) DEFAULT NULL,
  `cf_to_water_sotting_staining_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_water_sotting_staining_tolerance_value` double DEFAULT NULL,
  `cf_to_water_sotting_staining_min_value` double DEFAULT NULL,
  `cf_to_water_sotting_staining_max_value` double DEFAULT NULL,
  `uom_of_cf_to_water_sotting_staining` varchar(20) DEFAULT NULL,
  `cf_to_surface_wetting_staining_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_surface_wetting_staining_tolerance_value` double DEFAULT NULL,
  `cf_to_surface_wetting_staining_min_value` double DEFAULT NULL,
  `cf_to_surface_wetting_staining_max_value` double DEFAULT NULL,
  `uom_of_cf_to_surface_wetting_staining` varchar(20) DEFAULT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value` double DEFAULT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_min_value` double DEFAULT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_max_value` double DEFAULT NULL,
  `uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change` varchar(20) DEFAULT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_staining_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value` double DEFAULT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_staining_min_value` double DEFAULT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_staining_max_value` double DEFAULT NULL,
  `uom_of_cf_to_hydrolysis_of_reactive_dyes_staining` varchar(20) DEFAULT NULL,
  `cf_to_oidative_bleach_damage_color_change_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_oidative_bleach_damage_color_change_tolerance_value` double DEFAULT NULL,
  `cf_to_oidative_bleach_damage_color_change_min_value` double DEFAULT NULL,
  `cf_to_oidative_bleach_damage_color_change_max_value` double DEFAULT NULL,
  `uom_of_cf_to_oidative_bleach_damage_color_change` varchar(20) DEFAULT NULL,
  `cf_to_phenolic_yellowing_staining_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_phenolic_yellowing_staining_tolerance_value` double DEFAULT NULL,
  `cf_to_phenolic_yellowing_staining_min_value` double DEFAULT NULL,
  `cf_to_phenolic_yellowing_staining_max_value` double DEFAULT NULL,
  `uom_of_cf_to_phenolic_yellowing_staining` varchar(20) DEFAULT NULL,
  `cf_to_saliva_color_change_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_pvc_migration_staining_tolerance_value` double DEFAULT NULL,
  `cf_to_pvc_migration_staining_min_value` double DEFAULT NULL,
  `cf_to_pvc_migration_staining_max_value` double DEFAULT NULL,
  `uom_of_cf_to_pvc_migration_staining` varchar(20) DEFAULT NULL,
  `cf_to_pvc_migration_staining_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_saliva_color_change_tolerance_value` double DEFAULT NULL,
  `cf_to_saliva_color_change_min_value` double DEFAULT NULL,
  `cf_to_saliva_color_change_max_value` double DEFAULT NULL,
  `uom_of_cf_to_saliva_color_change` varchar(20) DEFAULT NULL,
  `cf_to_saliva_staining_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_saliva_staining_tolerance_value` double DEFAULT NULL,
  `cf_to_saliva_staining_staining_min_value` double DEFAULT NULL,
  `cf_to_saliva_staining_max_value` double DEFAULT NULL,
  `uom_of_cf_to_saliva_staining` varchar(20) DEFAULT NULL,
  `cf_to_chlorinated_water_color_change_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_chlorinated_water_color_change_tolerance_value` double DEFAULT NULL,
  `cf_to_chlorinated_water_color_change_min_value` double DEFAULT NULL,
  `cf_to_chlorinated_water_color_change_max_value` double DEFAULT NULL,
  `uom_of_cf_to_chlorinated_water_color_change` varchar(20) DEFAULT NULL,
  `cf_to_chlorinated_water_staining_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_chlorinated_water_staining_tolerance_value` double DEFAULT NULL,
  `cf_to_chlorinated_water_staining_min_value` double DEFAULT NULL,
  `cf_to_chlorinated_water_staining_max_value` double DEFAULT NULL,
  `uom_of_cf_to_chlorinated_water_staining` varchar(20) DEFAULT NULL,
  `cf_to_cholorine_bleach_color_change_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_cholorine_bleach_color_change_tolerance_value` double DEFAULT NULL,
  `cf_to_cholorine_bleach_color_change_min_value` double DEFAULT NULL,
  `cf_to_cholorine_bleach_color_change_max_value` double DEFAULT NULL,
  `uom_of_cf_to_cholorine_bleach_color_change` varchar(20) DEFAULT NULL,
  `cf_to_cholorine_bleach_staining_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_cholorine_bleach_staining_tolerance_value` double DEFAULT NULL,
  `cf_to_cholorine_bleach_staining_min_value` double DEFAULT NULL,
  `cf_to_cholorine_bleach_staining_max_value` double DEFAULT NULL,
  `uom_of_cf_to_cholorine_bleach_staining` varchar(20) DEFAULT NULL,
  `cf_to_peroxide_bleach_color_change_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_peroxide_bleach_color_change_tolerance_value` double DEFAULT NULL,
  `cf_to_peroxide_bleach_color_change_min_value` double DEFAULT NULL,
  `cf_to_peroxide_bleach_color_change_max_value` double DEFAULT NULL,
  `uom_of_cf_to_peroxide_bleach_color_change` varchar(20) DEFAULT NULL,
  `cf_to_peroxide_bleach_staining_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_peroxide_bleach_staining_tolerance_value` double DEFAULT NULL,
  `cf_to_peroxide_bleach_staining_min_value` double DEFAULT NULL,
  `cf_to_peroxide_bleach_staining_max_value` double DEFAULT NULL,
  `uom_of_cf_to_peroxide_bleach_staining` varchar(20) DEFAULT NULL,
  `cross_staining_math_operator` varchar(20) DEFAULT NULL,
  `cross_staining_tolerance_value` double DEFAULT NULL,
  `cross_staining_min_value` double DEFAULT NULL,
  `cross_staining_max_value` double DEFAULT NULL,
  `uom_of_cross_staining` varchar(20) DEFAULT NULL,
  `water_absorption_value_math_operator` varchar(20) DEFAULT NULL,
  `water_absorption_value_tolerance_value` double DEFAULT NULL,
  `water_absorption_value_min_value` double DEFAULT NULL,
  `water_absorption_value_max_value` double DEFAULT NULL,
  `uom_of_water_absorption_value` varchar(20) DEFAULT NULL,
  `spirality_value_math_operator` varchar(20) DEFAULT NULL,
  `spirality_value_tolerance_value` double DEFAULT NULL,
  `spirality_value_min_value` double DEFAULT NULL,
  `spirality_value_max_value` double DEFAULT NULL,
  `uom_of_spirality_value` varchar(20) DEFAULT NULL,
  `durable_press_value_math_operator` varchar(20) DEFAULT NULL,
  `durable_press_value_tolerance_value` double DEFAULT NULL,
  `durable_press_value_min_value` double DEFAULT NULL,
  `durable_press_value_max_value` double DEFAULT NULL,
  `uom_of_durable_press_value` varchar(20) DEFAULT NULL,
  `ironability_of_woven_fabric_value_math_operator` varchar(20) DEFAULT NULL,
  `ironability_of_woven_fabric_value_tolerance_value` double DEFAULT NULL,
  `ironability_of_woven_fabric_value_min_value` double DEFAULT NULL,
  `ironability_of_woven_fabric_value_max_value` double DEFAULT NULL,
  `uom_of_ironability_of_woven_fabric_value` varchar(20) DEFAULT NULL,
  `cf_to_artificial_light_value_math_operator` varchar(20) DEFAULT NULL,
  `cf_to_artificial_light_value_tolerance_value` double DEFAULT NULL,
  `cf_to_artificial_light_value_min_value` double DEFAULT NULL,
  `cf_to_artificial_light_value_max_value` double DEFAULT NULL,
  `uom_of_cf_to_artificial_light_value` varchar(20) DEFAULT NULL,
  `moisture_content_in_percentage_min_value` double DEFAULT NULL,
  `moisture_content_in_percentage_max_value` double DEFAULT NULL,
  `uom_of_moisture_content_in_percentage` varchar(20) DEFAULT NULL,
  `evaporation_rate_in_percentage_min_value` double DEFAULT NULL,
  `evaporation_rate_in_percentage_max_value` double DEFAULT NULL,
  `uom_of_evaporation_rate_in_percentage` varchar(20) DEFAULT NULL,
  `percentage_of_total_cotton_content_math_operator` varchar(20) DEFAULT NULL,
  `percentage_of_total_cotton_content_tolerance_value` double DEFAULT NULL,
  `percentage_of_total_cotton_content_min_value` double DEFAULT NULL,
  `percentage_of_total_cotton_content_max_value` double DEFAULT NULL,
  `uom_of_percentage_of_total_cotton_content` varchar(20) DEFAULT NULL,
  `percentage_of_total_polyester_content_math_operator` varchar(50) NOT NULL,
  `percentage_of_total_polyester_content_tolerance_value` double NOT NULL,
  `percentage_of_total_polyester_content_min_value` double NOT NULL,
  `percentage_of_total_polyester_content_max_value` double NOT NULL,
  `uom_of_percentage_of_total_polyester_content` varchar(50) NOT NULL,
  `percentage_of_total_other_fiber_content_math_operator` varchar(50) NOT NULL,
  `percentage_of_total_other_fiber_content_tolerance_value` double NOT NULL,
  `percentage_of_total_other_fiber_content_min_value` double NOT NULL,
  `percentage_of_total_other_fiber_content_max_value` int(11) NOT NULL,
  `uom_of_percentage_of_total_other_fiber_content` varchar(50) NOT NULL,
  `percentage_of_warp_cotton_content_math_operator` varchar(50) NOT NULL,
  `percentage_of_warp_cotton_content_tolerance_value` double NOT NULL,
  `percentage_of_warp_cotton_content_min_value` double NOT NULL,
  `uom_of_percentage_of_warp_cotton_content` varchar(50) NOT NULL,
  `percentage_of_warp_polyester_content_math_operator` varchar(50) NOT NULL,
  `percentage_of_warp_polyester_content_tolerance_value` double NOT NULL,
  `percentage_of_warp_polyester_content_min_value` double NOT NULL,
  `percentage_of_warp_polyester_content_max_value` double NOT NULL,
  `uom_of_percentage_of_warp_polyester_content` varchar(50) NOT NULL,
  `percentage_of_warp_other_fiber_content_math_operator` varchar(50) NOT NULL,
  `percentage_of_warp_other_fiber_content_tolerance_value` double NOT NULL,
  `percentage_of_warp_other_fiber_content_min_value` double DEFAULT NULL,
  `percentage_of_warp_other_fiber_content_max_value` double DEFAULT NULL,
  `uom_of_percentage_of_warp_other_fiber_content` varchar(20) DEFAULT NULL,
  `percentage_of_weft_polyester_content_math_operator` double DEFAULT NULL,
  `percentage_of_weft_polyester_content_tolerance_value` double DEFAULT NULL,
  `percentage_of_weft_polyester_content_min_value` double DEFAULT NULL,
  `percentage_of_weft_polyester_content_max_value` double DEFAULT NULL,
  `uom_of_percentage_of_weft_polyester_content` varchar(20) DEFAULT NULL,
  `percentage_of_weft_other_fiber_content_math_operator` varchar(20) DEFAULT NULL,
  `percentage_of_weft_other_fiber_content_tolerance_value` double DEFAULT NULL,
  `percentage_of_weft_other_fiber_content_min_value` double DEFAULT NULL,
  `percentage_of_weft_other_fiber_content_max_value` double DEFAULT NULL,
  `uom_of_percentage_of_weft_other_fiber_content` varchar(20) DEFAULT NULL,
  `seam_slippage_resistance_in_warp_math_operator` varchar(20) DEFAULT NULL,
  `seam_slippage_resistance_in_warp_tolerance_value` double DEFAULT NULL,
  `seam_slippage_resistance_in_warp_min_value` double DEFAULT NULL,
  `seam_slippage_resistance_in_warp_max_value` double DEFAULT NULL,
  `uom_of_seam_slippage_resistance_in_warp` varchar(20) DEFAULT NULL,
  `seam_slippage_resistance_in_weft_math_operator` varchar(20) DEFAULT NULL,
  `seam_slippage_resistance_in_weft_tolerance_value` double DEFAULT NULL,
  `seam_slippage_resistance_in_weft_min_value` double DEFAULT NULL,
  `seam_slippage_resistance_in_weft_max_value` double DEFAULT NULL,
  `uom_of_seam_slippage_resistance_in_weft` varchar(20) DEFAULT NULL,
  `ph_value_math_operator` varchar(20) DEFAULT NULL,
  `ph_value_tolerance_value` double DEFAULT NULL,
  `ph_value_min_value` double DEFAULT NULL,
  `ph_value_max_value` double DEFAULT NULL,
  `uom_of_ph_value` varchar(20) DEFAULT NULL,
  `recording_person_id` varchar(50) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of defining_qc_standard_for_finishing_process_bkup_17_11_2020
-- ----------------------------

-- ----------------------------
-- Table structure for `defining_qc_standard_for_greige_receiving_process`
-- ----------------------------
DROP TABLE IF EXISTS `defining_qc_standard_for_greige_receiving_process`;
CREATE TABLE `defining_qc_standard_for_greige_receiving_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) NOT NULL,
  `version_id` varchar(30) NOT NULL,
  `version_number` varchar(100) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `color` varchar(50) NOT NULL,
  `finish_width_in_inch` double NOT NULL,
  `standard_for_which_process` varchar(50) NOT NULL,
  `test_method_for_warp_yarn_count` float NOT NULL,
  `warp_yarn_count_value` float NOT NULL,
  `warp_yarn_count_tolerance_range_math_operator` varchar(10) NOT NULL,
  `warp_yarn_count_tolerance_value` float NOT NULL,
  `warp_yarn_count_min_value` float NOT NULL,
  `warp_yarn_count_max_value` float NOT NULL,
  `uom_of_warp_yarn_count_value` varchar(10) NOT NULL,
  `test_method_for_weft_yarn_count` float NOT NULL,
  `weft_yarn_count_value` float NOT NULL,
  `weft_yarn_count_tolerance_range_math_operator` varchar(10) NOT NULL,
  `weft_yarn_count_tolerance_value` float NOT NULL,
  `weft_yarn_count_min_value` float NOT NULL,
  `weft_yarn_count_max_value` float NOT NULL,
  `uom_of_weft_yarn_count_value` varchar(10) NOT NULL,
  `test_method_for_mass_per_unit_per_area` float NOT NULL,
  `mass_per_unit_per_area_value` float NOT NULL,
  `mass_per_unit_per_area_tolerance_range_math_operator` varchar(10) NOT NULL,
  `mass_per_unit_per_area_tolerance_value` float NOT NULL,
  `mass_per_unit_per_area_min_value` float NOT NULL,
  `mass_per_unit_per_area_max_value` float NOT NULL,
  `uom_of_mass_per_unit_per_area_value` varchar(8) NOT NULL,
  `test_method_for_no_of_threads_in_warp` float NOT NULL,
  `no_of_threads_in_warp_value` float NOT NULL,
  `no_of_threads_in_warp_tolerance_range_math_operator` varchar(10) NOT NULL,
  `no_of_threads_in_warp_tolerance_value` float NOT NULL,
  `no_of_threads_in_warp_min_value` float NOT NULL,
  `no_of_threads_in_warp_max_value` float NOT NULL,
  `uom_of_no_of_threads_in_warp_value` varchar(10) NOT NULL,
  `no_of_threads_in_weft_value` float NOT NULL,
  `no_of_threads_in_weft_tolerance_range_math_operator` varchar(10) NOT NULL,
  `no_of_threads_in_weft_tolerance_value` float NOT NULL,
  `no_of_threads_in_weft_min_value` float NOT NULL,
  `no_of_threads_in_weft_max_value` float NOT NULL,
  `uom_of_no_of_threads_in_weft_value` varchar(10) NOT NULL,
  `finish_width_in_inch_value` float NOT NULL,
  `finish_width_in_inch_range_math_operator` varchar(10) NOT NULL,
  `finish_width_in_inch_tolerance_value` float(10,0) NOT NULL,
  `finish_width_in_inch_min_value` float NOT NULL,
  `finish_width_in_inch_max_value` float(10,0) NOT NULL,
  `uom_of_finish_width_in_inch_value` varchar(10) NOT NULL,
  `percentage_of_total_cotton_content_value` float NOT NULL,
  `percentage_of_total_cotton_content_tolerance_range_math_operator` varchar(10) NOT NULL,
  `percentage_of_total_cotton_content_tolerance_value` float NOT NULL,
  `percentage_of_total_cotton_content_min_value` float NOT NULL,
  `percentage_of_total_cotton_content_max_value` float NOT NULL,
  `uom_of_percentage_of_total_cotton_content` varchar(8) NOT NULL,
  `percentage_of_total_polyester_content_value` float NOT NULL,
  `percentage_of_total_polyester_content_tolerance_range_math_op` varchar(10) NOT NULL,
  `percentage_of_total_polyester_content_tolerance_value` float NOT NULL,
  `percentage_of_total_polyester_content_min_value` float NOT NULL,
  `percentage_of_total_polyester_content_max_value` float NOT NULL,
  `uom_of_percentage_of_total_polyester_content` varchar(8) NOT NULL,
  `description_or_type_for_total_other_fiber` varchar(17) NOT NULL,
  `percentage_of_total_other_fiber_content_value` float NOT NULL,
  `percentage_of_total_other_fiber_content_tolerance_range_math_op` varchar(10) NOT NULL,
  `percentage_of_total_other_fiber_content_tolerance_value` float NOT NULL,
  `percentage_of_total_other_fiber_content_min_value` float NOT NULL,
  `percentage_of_total_other_fiber_content_max_value` float NOT NULL,
  `uom_of_percentage_of_total_other_fiber_content` varchar(8) NOT NULL,
  `description_or_type_for_total_other_fiber_1` varchar(15) NOT NULL,
  `percentage_of_total_other_fiber_content_1_value` float NOT NULL,
  `percentage_of_total_other_fiber_content_1_tol_range_math_op` varchar(4) NOT NULL,
  `percentage_of_total_other_fiber_content_1_tolerance_value` float NOT NULL,
  `percentage_of_total_other_fiber_content_1_min_value` float NOT NULL,
  `percentage_of_total_other_fiber_content_1_max_value` float NOT NULL,
  `uom_of_percentage_of_total_other_fiber_content_1` varchar(15) NOT NULL,
  `percentage_of_warp_cotton_content_value` float NOT NULL,
  `percentage_of_warp_cotton_content_tolerance_range_math_operator` varchar(10) NOT NULL,
  `percentage_of_warp_cotton_content_tolerance_value` float NOT NULL,
  `percentage_of_warp_cotton_content_min_value` float NOT NULL,
  `uom_of_percentage_of_warp_cotton_content` varchar(8) NOT NULL,
  `percentage_of_warp_polyester_content_value` float NOT NULL,
  `percentage_of_warp_polyester_content_tolerance_range_math_op` varchar(10) NOT NULL,
  `percentage_of_warp_polyester_content_tolerance_value` float NOT NULL,
  `percentage_of_warp_polyester_content_min_value` float NOT NULL,
  `percentage_of_warp_polyester_content_max_value` float NOT NULL,
  `uom_of_percentage_of_warp_polyester_content` varchar(8) NOT NULL,
  `description_or_type_for_warp_other_fiber` varchar(17) NOT NULL,
  `percentage_of_warp_other_fiber_content_value` float NOT NULL,
  `percentage_of_warp_other_fiber_content_tolerance_range_math_op` varchar(10) NOT NULL,
  `percentage_of_warp_other_fiber_content_tolerance_value` float NOT NULL,
  `percentage_of_warp_other_fiber_content_min_value` float NOT NULL,
  `percentage_of_warp_other_fiber_content_max_value` float NOT NULL,
  `uom_of_percentage_of_warp_other_fiber_content` varchar(8) NOT NULL,
  `description_or_type_for_warp_other_fiber_1` varchar(15) NOT NULL,
  `percentage_of_warp_other_fiber_content_1_value` float NOT NULL,
  `percentage_of_warp_other_fiber_content_1_tolerance_range_math_op` varchar(4) NOT NULL,
  `percentage_of_warp_other_fiber_content_1_tolerance_value` float NOT NULL,
  `percentage_of_warp_other_fiber_content_1_min_value` float NOT NULL,
  `percentage_of_warp_other_fiber_content_1_max_value` float NOT NULL,
  `uom_of_percentage_of_warp_other_fiber_content_1` varchar(15) NOT NULL,
  `percentage_of_weft_cotton_content_value` float NOT NULL,
  `percentage_of_weft_cotton_content_tolerance_range_math_op` varchar(10) NOT NULL,
  `percentage_of_weft_cotton_content_tolerance_value` float NOT NULL,
  `percentage_of_weft_cotton_content_min_value` float NOT NULL,
  `percentage_of_weft_cotton_content_max_value` float NOT NULL,
  `uom_of_percentage_of_weft_cotton_content` varchar(5) NOT NULL,
  `percentage_of_weft_polyester_content_value` float NOT NULL,
  `percentage_of_weft_polyester_content_tolerance_range_math_op` varchar(10) NOT NULL,
  `percentage_of_weft_polyester_content_tolerance_value` float NOT NULL,
  `percentage_of_weft_polyester_content_min_value` float NOT NULL,
  `percentage_of_weft_polyester_content_max_value` float NOT NULL,
  `uom_of_percentage_of_weft_polyester_content` varchar(5) NOT NULL,
  `description_or_type_for_weft_other_fiber` varchar(17) NOT NULL,
  `percentage_of_weft_other_fiber_content_value` float NOT NULL,
  `percentage_of_weft_other_fiber_content_tolerance_range_math_op` varchar(10) NOT NULL,
  `percentage_of_weft_other_fiber_content_tolerance_value` float NOT NULL,
  `percentage_of_weft_other_fiber_content_min_value` float NOT NULL,
  `percentage_of_weft_other_fiber_content_max_value` float NOT NULL,
  `uom_of_percentage_of_weft_other_fiber_content` varchar(8) NOT NULL,
  `description_or_type_for_weft_other_fiber_1` varchar(14) NOT NULL,
  `percentage_of_weft_other_fiber_content_1_value` float NOT NULL,
  `percentage_of_weft_other_fiber_content_1_tolerance_range_math_op` varchar(4) NOT NULL,
  `percentage_of_weft_other_fiber_content_1_tolerance_value` float NOT NULL,
  `percentage_of_weft_other_fiber_content_1_min_value` float NOT NULL,
  `percentage_of_weft_other_fiber_content_1_max_value` float NOT NULL,
  `uom_of_percentage_of_weft_other_fiber_content_1` varchar(15) NOT NULL,
  `recording_person_id` varchar(30) NOT NULL,
  `recording_person_name` varchar(50) NOT NULL,
  `recording_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of defining_qc_standard_for_greige_receiving_process
-- ----------------------------

-- ----------------------------
-- Table structure for `defining_qc_standard_for_mercerize_process`
-- ----------------------------
DROP TABLE IF EXISTS `defining_qc_standard_for_mercerize_process`;
CREATE TABLE `defining_qc_standard_for_mercerize_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) DEFAULT NULL,
  `version_id` varchar(30) NOT NULL,
  `version_number` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `finish_width_in_inch` double DEFAULT NULL,
  `standard_for_which_process` varchar(50) DEFAULT NULL,
  `test_method_for_whiteness` double DEFAULT NULL,
  `whiteness_min_value` double DEFAULT NULL,
  `whiteness_max_value` varchar(0) DEFAULT NULL,
  `uom_of_whiteness` varchar(20) DEFAULT NULL,
  `test_method_for_residual_sizing_material` double DEFAULT NULL,
  `residual_sizing_material_min_value` double DEFAULT NULL,
  `residual_sizing_material_max_value` double DEFAULT NULL,
  `uom_of_residual_sizing_material` varchar(20) DEFAULT NULL,
  `test_method_for_absorbency` double DEFAULT NULL,
  `absorbency_min_value` double DEFAULT NULL,
  `absorbency_max_value` double DEFAULT NULL,
  `uom_of_absorbency` varchar(20) DEFAULT '',
  `test_method_for_ph` double DEFAULT NULL,
  `ph_min_value` double DEFAULT NULL,
  `ph_max_value` double DEFAULT NULL,
  `uom_of_ph` varchar(20) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of defining_qc_standard_for_mercerize_process
-- ----------------------------

-- ----------------------------
-- Table structure for `defining_qc_standard_for_printing_process`
-- ----------------------------
DROP TABLE IF EXISTS `defining_qc_standard_for_printing_process`;
CREATE TABLE `defining_qc_standard_for_printing_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) DEFAULT NULL,
  `version_id` varchar(30) NOT NULL,
  `version_number` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `finish_width_in_inch` double DEFAULT NULL,
  `standard_for_which_process` varchar(100) DEFAULT NULL,
  `test_method_for_rubbing_dry` varchar(25) NOT NULL,
  `uom_of_rubbing_dry` varchar(20) DEFAULT NULL,
  `rubbing_dry_tolerance_range_math_operator` varchar(5) DEFAULT NULL,
  `rubbing_dry_tolerance_value` double NOT NULL,
  `rubbing_dry_min_value` double DEFAULT NULL,
  `rubbing_dry_max_value` double DEFAULT NULL,
  `test_method_for_rubbing_wet` varchar(25) NOT NULL,
  `uom_of_rubbing_wet` varchar(20) DEFAULT NULL,
  `rubbing_wet_tolerance_range_math_operator` varchar(10) DEFAULT NULL,
  `rubbing_wet_tolerance_value` double NOT NULL,
  `rubbing_wet_min_value` double DEFAULT NULL,
  `rubbing_wet_max_value` double DEFAULT NULL,
  `recording_person_id` varchar(50) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of defining_qc_standard_for_printing_process
-- ----------------------------

-- ----------------------------
-- Table structure for `defining_qc_standard_for_raising_process`
-- ----------------------------
DROP TABLE IF EXISTS `defining_qc_standard_for_raising_process`;
CREATE TABLE `defining_qc_standard_for_raising_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(50) NOT NULL,
  `version_id` varchar(30) NOT NULL,
  `version_number` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `finish_width_in_inch` float NOT NULL,
  `standard_for_which_process` varchar(50) NOT NULL,
  `test_method_for_tensile_properties_in_warp` varchar(25) NOT NULL,
  `tensile_properties_in_warp_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `tensile_properties_in_warp_value_tolerance_value` float NOT NULL,
  `tensile_properties_in_warp_value_min_value` float NOT NULL,
  `tensile_properties_in_warp_value_max_value` float NOT NULL,
  `uom_of_tensile_properties_in_warp_value` varchar(10) NOT NULL,
  `test_method_for_tensile_properties_in_weft` varchar(25) NOT NULL,
  `tensile_properties_in_weft_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `tensile_properties_in_weft_value_tolerance_value` float NOT NULL,
  `tensile_properties_in_weft_value_min_value` float NOT NULL,
  `tensile_properties_in_weft_value_max_value` float NOT NULL,
  `uom_of_tensile_properties_in_weft_value` varchar(10) NOT NULL,
  `test_method_for_tear_force_in_warp` varchar(25) NOT NULL,
  `tear_force_in_warp_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `tear_force_in_warp_value_tolerance_value` float NOT NULL,
  `tear_force_in_warp_value_min_value` float NOT NULL,
  `tear_force_in_warp_value_max_value` float NOT NULL,
  `uom_of_tear_force_in_warp_value` varchar(10) NOT NULL,
  `test_method_for_tear_force_in_weft` varchar(25) NOT NULL,
  `tear_force_in_weft_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `tear_force_in_weft_value_tolerance_value` float NOT NULL,
  `tear_force_in_weft_value_min_value` float NOT NULL,
  `tear_force_in_weft_value_max_value` float NOT NULL,
  `uom_of_tear_force_in_weft_value` varchar(10) NOT NULL,
  `recording_person_id` varchar(20) NOT NULL,
  `recording_person_name` varchar(20) NOT NULL,
  `recording_time` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of defining_qc_standard_for_raising_process
-- ----------------------------

-- ----------------------------
-- Table structure for `defining_qc_standard_for_ready_for_dying_process`
-- ----------------------------
DROP TABLE IF EXISTS `defining_qc_standard_for_ready_for_dying_process`;
CREATE TABLE `defining_qc_standard_for_ready_for_dying_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) NOT NULL DEFAULT '',
  `version_id` varchar(30) NOT NULL,
  `version_number` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `finish_width_in_inch` double DEFAULT NULL,
  `standard_for_which_process` varchar(100) DEFAULT NULL,
  `test_method_for_whiteness` double DEFAULT NULL,
  `whiteness_min_value` double DEFAULT NULL,
  `whiteness_max_value` double DEFAULT NULL,
  `uom_of_whiteness` varchar(20) DEFAULT NULL,
  `test_method_for_bowing_and_skew` double DEFAULT NULL,
  `bowing_and_skew_tolerance_range_math_operator` double DEFAULT NULL,
  `bowing_and_skew_tolerance_value` double DEFAULT NULL,
  `bowing_and_skew_min_value` double DEFAULT NULL,
  `bowing_and_skew_max_value` double DEFAULT NULL,
  `uom_of_bowing_and_skew` varchar(20) DEFAULT NULL,
  `test_method_for_ph` double DEFAULT NULL,
  `ph_min_value` double DEFAULT NULL,
  `ph_max_value` double DEFAULT NULL,
  `uom_of_ph` varchar(20) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of defining_qc_standard_for_ready_for_dying_process
-- ----------------------------

-- ----------------------------
-- Table structure for `defining_qc_standard_for_ready_for_mercerize_process`
-- ----------------------------
DROP TABLE IF EXISTS `defining_qc_standard_for_ready_for_mercerize_process`;
CREATE TABLE `defining_qc_standard_for_ready_for_mercerize_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) NOT NULL DEFAULT '',
  `version_id` varchar(30) NOT NULL,
  `version_number` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `finish_width_in_inch` double DEFAULT NULL,
  `standard_for_which_process` varchar(100) DEFAULT NULL,
  `test_method_for_whiteness` double DEFAULT NULL,
  `whiteness_min_value` double DEFAULT NULL,
  `whiteness_max_value` double DEFAULT NULL,
  `uom_of_whiteness` varchar(20) DEFAULT NULL,
  `test_method_for_bowing_and_skew` double DEFAULT NULL,
  `bowing_and_skew_tolerance_range_math_operator` double DEFAULT NULL,
  `bowing_and_skew_tolerance_value` double DEFAULT NULL,
  `bowing_and_skew_min_value` double DEFAULT NULL,
  `bowing_and_skew_max_value` double DEFAULT NULL,
  `uom_of_bowing_and_skew` varchar(20) DEFAULT NULL,
  `test_method_for_ph` double DEFAULT NULL,
  `ph_min_value` double DEFAULT NULL,
  `ph_max_value` double DEFAULT NULL,
  `uom_of_ph` varchar(20) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of defining_qc_standard_for_ready_for_mercerize_process
-- ----------------------------

-- ----------------------------
-- Table structure for `defining_qc_standard_for_ready_for_printing_process`
-- ----------------------------
DROP TABLE IF EXISTS `defining_qc_standard_for_ready_for_printing_process`;
CREATE TABLE `defining_qc_standard_for_ready_for_printing_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) NOT NULL DEFAULT '',
  `version_id` varchar(30) NOT NULL,
  `version_number` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `finish_width_in_inch` double DEFAULT NULL,
  `standard_for_which_process` varchar(100) DEFAULT NULL,
  `test_method_for_whiteness` double DEFAULT NULL,
  `whiteness_min_value` double DEFAULT NULL,
  `whiteness_max_value` double DEFAULT NULL,
  `uom_of_whiteness` varchar(20) DEFAULT NULL,
  `test_method_for_bowing_and_skew` double DEFAULT NULL,
  `bowing_and_skew_tolerance_range_math_operator` double DEFAULT NULL,
  `bowing_and_skew_tolerance_value` double DEFAULT NULL,
  `bowing_and_skew_min_value` double DEFAULT NULL,
  `bowing_and_skew_max_value` double DEFAULT NULL,
  `uom_of_bowing_and_skew` varchar(20) DEFAULT NULL,
  `test_method_for_ph` double DEFAULT NULL,
  `ph_min_value` double DEFAULT NULL,
  `ph_max_value` double DEFAULT NULL,
  `uom_of_ph` varchar(20) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of defining_qc_standard_for_ready_for_printing_process
-- ----------------------------

-- ----------------------------
-- Table structure for `defining_qc_standard_for_ready_for_raising_process`
-- ----------------------------
DROP TABLE IF EXISTS `defining_qc_standard_for_ready_for_raising_process`;
CREATE TABLE `defining_qc_standard_for_ready_for_raising_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(50) NOT NULL,
  `version_id` varchar(30) NOT NULL,
  `version_number` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `finish_width_in_inch` float NOT NULL,
  `standard_for_which_process` varchar(50) NOT NULL,
  `test_method_for_tensile_properties_in_warp` varchar(25) NOT NULL,
  `tensile_properties_in_warp_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `tensile_properties_in_warp_value_tolerance_value` float NOT NULL,
  `tensile_properties_in_warp_value_min_value` float NOT NULL,
  `tensile_properties_in_warp_value_max_value` float NOT NULL,
  `uom_of_tensile_properties_in_warp_value` varchar(10) NOT NULL,
  `test_method_for_tensile_properties_in_weft` varchar(25) NOT NULL,
  `tensile_properties_in_weft_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `tensile_properties_in_weft_value_tolerance_value` float NOT NULL,
  `tensile_properties_in_weft_value_min_value` float NOT NULL,
  `tensile_properties_in_weft_value_max_value` float NOT NULL,
  `uom_of_tensile_properties_in_weft_value` varchar(10) NOT NULL,
  `test_method_for_tear_force_in_warp` varchar(25) NOT NULL,
  `tear_force_in_warp_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `tear_force_in_warp_value_tolerance_value` float NOT NULL,
  `tear_force_in_warp_value_min_value` float NOT NULL,
  `tear_force_in_warp_value_max_value` float NOT NULL,
  `uom_of_tear_force_in_warp_value` varchar(10) NOT NULL,
  `test_method_for_tear_force_in_weft` varchar(25) NOT NULL,
  `tear_force_in_weft_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `tear_force_in_weft_value_tolerance_value` float NOT NULL,
  `tear_force_in_weft_value_min_value` float NOT NULL,
  `tear_force_in_weft_value_max_value` float NOT NULL,
  `uom_of_tear_force_in_weft_value` varchar(10) NOT NULL,
  `recording_person_id` varchar(20) NOT NULL,
  `recording_person_name` varchar(20) NOT NULL,
  `recording_time` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of defining_qc_standard_for_ready_for_raising_process
-- ----------------------------

-- ----------------------------
-- Table structure for `defining_qc_standard_for_sanforizing_process`
-- ----------------------------
DROP TABLE IF EXISTS `defining_qc_standard_for_sanforizing_process`;
CREATE TABLE `defining_qc_standard_for_sanforizing_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(50) NOT NULL,
  `version_id` varchar(30) NOT NULL,
  `version_number` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `finish_width_in_inch` float NOT NULL,
  `standard_for_which_process` varchar(50) NOT NULL,
  `test_method_for_cf_to_rubbing_dry` varchar(25) NOT NULL,
  `cf_to_rubbing_dry_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_rubbing_dry_tolerance_value` float NOT NULL,
  `cf_to_rubbing_dry_min_value` float NOT NULL,
  `cf_to_rubbing_dry_max_value` float NOT NULL,
  `uom_of_cf_to_rubbing_dry` varchar(20) NOT NULL,
  `test_method_for_cf_to_rubbing_wet` varchar(25) NOT NULL,
  `cf_to_rubbing_wet_tolerance_range_math_operator` varchar(20) NOT NULL,
  `cf_to_rubbing_wet_tolerance_value` float NOT NULL,
  `cf_to_rubbing_wet_min_value` float NOT NULL,
  `cf_to_rubbing_wet_max_value` float NOT NULL,
  `uom_of_cf_to_rubbing_wet` varchar(20) NOT NULL,
  `test_method_for_dimensional_stability_to_warp_washing_b_iron` varchar(25) NOT NULL,
  `washing_cycle_for_warp_for_washing_before_iron` varchar(20) NOT NULL,
  `dimensional_stability_to_warp_washing_before_iron_min_value` float NOT NULL,
  `dimensional_stability_to_warp_washing_before_iron_max_value` float NOT NULL,
  `uom_of_dimensional_stability_to_warp_washing_before_iron` varchar(10) NOT NULL,
  `test_method_for_dimensional_stability_to_weft_washing_b_iron` varchar(25) NOT NULL,
  `washing_cycle_for_weft_for_washing_before_iron` varchar(20) NOT NULL,
  `dimensional_stability_to_weft_washing_before_iron_min_value` float NOT NULL,
  `dimensional_stability_to_weft_washing_before_iron_max_value` float NOT NULL,
  `uom_of_dimensional_stability_to_weft_washing_before_iron` varchar(10) NOT NULL,
  `test_method_for_warp_yarn_count` varchar(25) NOT NULL,
  `warp_yarn_count_value` float NOT NULL,
  `warp_yarn_count_tolerance_range_math_operator` varchar(20) NOT NULL,
  `warp_yarn_count_tolerance_value` float NOT NULL,
  `warp_yarn_count_min_value` float NOT NULL,
  `warp_yarn_count_max_value` float NOT NULL,
  `uom_of_warp_yarn_count_value` varchar(10) NOT NULL,
  `test_method_for_weft_yarn_count` varchar(25) NOT NULL,
  `weft_yarn_count_value` float NOT NULL,
  `weft_yarn_count_tolerance_range_math_operator` varchar(10) NOT NULL,
  `weft_yarn_count_tolerance_value` float NOT NULL,
  `weft_yarn_count_min_value` float NOT NULL,
  `weft_yarn_count_max_value` float NOT NULL,
  `uom_of_weft_yarn_count_value` varchar(10) NOT NULL,
  `test_method_for_no_of_threads_in_warp` varchar(25) NOT NULL,
  `no_of_threads_in_warp_value` float NOT NULL,
  `no_of_threads_in_warp_tolerance_range_math_operator` varchar(20) NOT NULL,
  `no_of_threads_in_warp_tolerance_value` float NOT NULL,
  `no_of_threads_in_warp_min_value` float NOT NULL,
  `no_of_threads_in_warp_max_value` float NOT NULL,
  `uom_of_no_of_threads_in_warp_value` varchar(10) NOT NULL,
  `test_method_for_no_of_threads_in_weft` varchar(25) NOT NULL,
  `no_of_threads_in_weft_value` float NOT NULL,
  `no_of_threads_in_weft_tolerance_range_math_operator` varchar(20) NOT NULL,
  `no_of_threads_in_weft_tolerance_value` float NOT NULL,
  `no_of_threads_in_weft_min_value` float NOT NULL,
  `no_of_threads_in_weft_max_value` float NOT NULL,
  `uom_of_no_of_threads_in_weft_value` varchar(10) NOT NULL,
  `test_method_for_mass_per_unit_per_area` varchar(25) NOT NULL,
  `mass_per_unit_per_area_value` float NOT NULL,
  `mass_per_unit_per_area_tolerance_range_math_operator` varchar(20) NOT NULL,
  `mass_per_unit_per_area_tolerance_value` float NOT NULL,
  `mass_per_unit_per_area_min_value` float NOT NULL,
  `mass_per_unit_per_area_max_value` float NOT NULL,
  `uom_of_mass_per_unit_per_area_value` varchar(10) NOT NULL,
  `test_method_for_surface_fuzzing_and_pilling` varchar(25) NOT NULL,
  `description_or_type_for_surface_fuzzing_and_pilling` varchar(15) NOT NULL,
  `rubs_for_surface_fuzzing_and_pilling` varchar(10) NOT NULL,
  `surface_fuzzing_and_pilling_tolerance_range_math_operator` varchar(20) NOT NULL,
  `surface_fuzzing_and_pilling_tolerance_value` float NOT NULL,
  `surface_fuzzing_and_pilling_min_value` float NOT NULL,
  `surface_fuzzing_and_pilling_max_value` float NOT NULL,
  `uom_of_surface_fuzzing_and_pilling_value` varchar(10) NOT NULL,
  `test_method_for_tensile_properties_in_warp` varchar(25) NOT NULL,
  `tensile_properties_in_warp_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `tensile_properties_in_warp_value_tolerance_value` float NOT NULL,
  `tensile_properties_in_warp_value_min_value` float NOT NULL,
  `tensile_properties_in_warp_value_max_value` float NOT NULL,
  `uom_of_tensile_properties_in_warp_value` varchar(10) NOT NULL,
  `test_method_for_tensile_properties_in_weft` varchar(25) NOT NULL,
  `tensile_properties_in_weft_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `tensile_properties_in_weft_value_tolerance_value` float NOT NULL,
  `tensile_properties_in_weft_value_min_value` float NOT NULL,
  `tensile_properties_in_weft_value_max_value` float NOT NULL,
  `uom_of_tensile_properties_in_weft_value` varchar(10) NOT NULL,
  `test_method_for_tear_force_in_warp` varchar(25) NOT NULL,
  `tear_force_in_warp_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `tear_force_in_warp_value_tolerance_value` float NOT NULL,
  `tear_force_in_warp_value_min_value` float NOT NULL,
  `tear_force_in_warp_value_max_value` float NOT NULL,
  `uom_of_tear_force_in_warp_value` varchar(10) NOT NULL,
  `test_method_for_tear_force_in_weft` varchar(25) NOT NULL,
  `tear_force_in_weft_value_tolerance_range_math_operator` varchar(20) NOT NULL,
  `tear_force_in_weft_value_tolerance_value` float NOT NULL,
  `tear_force_in_weft_value_min_value` float NOT NULL,
  `tear_force_in_weft_value_max_value` float NOT NULL,
  `uom_of_tear_force_in_weft_value` varchar(10) NOT NULL,
  `test_method_for_seam_slippage_resistance_iso_2_warp` varchar(25) NOT NULL,
  `seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op` varchar(10) NOT NULL,
  `seam_slippage_resistance_iso_2_in_warp_tolerance_value` float NOT NULL,
  `seam_slippage_resistance_iso_2_in_warp_min_value` float NOT NULL,
  `seam_slippage_resistance_iso_2_in_warp_max_value` float NOT NULL,
  `uom_of_seam_slippage_resistance_iso_2_in_warp` varchar(10) NOT NULL,
  `uom_of_seam_slippage_resistance_iso_2_in_warp_for_load` varchar(25) NOT NULL,
  `test_method_for_seam_slippage_resistance_iso_2_weft` varchar(25) NOT NULL,
  `seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op` varchar(8) NOT NULL,
  `seam_slippage_resistance_iso_2_in_weft_tolerance_value` float NOT NULL,
  `seam_slippage_resistance_iso_2_in_weft_min_value` float NOT NULL,
  `seam_slippage_resistance_iso_2_in_weft_max_value` float NOT NULL,
  `uom_of_seam_slippage_resistance_iso_2_in_weft` varchar(15) NOT NULL,
  `uom_of_seam_slippage_resistance_iso_2_in_weft_for_load` varchar(25) NOT NULL,
  `test_method_for_seam_slippage_resistance_in_warp` varchar(25) NOT NULL,
  `seam_slippage_resistance_in_warp_tolerance_range_math_operator` varchar(5) NOT NULL,
  `seam_slippage_resistance_in_warp_tolerance_value` float NOT NULL,
  `seam_slippage_resistance_in_warp_min_value` float NOT NULL,
  `seam_slippage_resistance_in_warp_max_value` float NOT NULL,
  `uom_of_seam_slippage_resistance_in_warp` varchar(10) NOT NULL,
  `test_method_for_seam_slippage_resistance_in_weft` varchar(25) NOT NULL,
  `seam_slippage_resistance_in_weft_tolerance_range_math_operator` varchar(5) NOT NULL,
  `seam_slippage_resistance_in_weft_tolerance_value` float NOT NULL,
  `seam_slippage_resistance_in_weft_min_value` float NOT NULL,
  `seam_slippage_resistance_in_weft_max_value` float NOT NULL,
  `uom_of_seam_slippage_resistance_in_weft` varchar(10) NOT NULL,
  `test_method_for_seam_strength_in_warp` varchar(25) NOT NULL,
  `seam_strength_in_warp_value_tolerance_range_math_operator` varchar(8) NOT NULL,
  `seam_strength_in_warp_value_tolerance_value` float NOT NULL,
  `seam_strength_in_warp_value_min_value` float NOT NULL,
  `seam_strength_in_warp_value_max_value` float NOT NULL,
  `uom_of_seam_strength_in_warp_value` varchar(10) NOT NULL,
  `test_method_for_seam_strength_in_weft` varchar(25) NOT NULL,
  `seam_strength_in_weft_value_tolerance_range_math_operator` varchar(8) NOT NULL,
  `seam_strength_in_weft_value_tolerance_value` float NOT NULL,
  `seam_strength_in_weft_value_min_value` float NOT NULL,
  `seam_strength_in_weft_value_max_value` float NOT NULL,
  `uom_of_seam_strength_in_weft_value` varchar(10) NOT NULL,
  `test_method_for_seam_properties_seam_slippage_iso_astm_d_in_warp` varchar(25) NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op` varchar(8) NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value` float NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_warp_min_value` float NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_warp_max_value` float NOT NULL,
  `uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp` varchar(15) NOT NULL,
  `test_method_for_seam_properties_seam_slippage_iso_astm_d_in_weft` varchar(25) NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op` varchar(8) NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value` float NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_weft_min_value` float NOT NULL,
  `seam_properties_seam_slippage_iso_astm_d_in_weft_max_value` float NOT NULL,
  `uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft` varchar(15) NOT NULL,
  `test_method_for_seam_properties_seam_strength_iso_astm_d_in_warp` varchar(25) NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op` varchar(8) NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value` float NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_warp_min_value` float NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_warp_max_value` float NOT NULL,
  `uom_of_seam_properties_seam_strength_iso_astm_d_in_warp` varchar(15) NOT NULL,
  `test_method_for_seam_properties_seam_strength_iso_astm_d_in_weft` varchar(25) NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op` varchar(8) NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value` float NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_weft_min_value` float NOT NULL,
  `seam_properties_seam_strength_iso_astm_d_in_weft_max_value` float NOT NULL,
  `uom_of_seam_properties_seam_strength_iso_astm_d_in_weft` varchar(15) NOT NULL,
  `recording_person_id` varchar(20) NOT NULL,
  `recording_person_name` varchar(20) NOT NULL,
  `recording_time` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of defining_qc_standard_for_sanforizing_process
-- ----------------------------
INSERT INTO `defining_qc_standard_for_sanforizing_process` VALUES ('2', '5893/2020', 'version_27', 'Pillow Back', 'Ikea', 'Beige', '50', 'Sanforize', 'ISO 105 X12', 'select', '0', '0', '0', 'uom_of_cf_to_rubbing', 'ISO 105 X12', 'select', '0', '0', '0', 'Berger', 'ISO 6330, ISO 5077, 3759', '', '0', '0', 'celcius', 'ISO 6330, ISO 5077, 3759', '', '0', '0', 'celcius', 'ISO 7211-5', '0', 'select', '0', '0', '0', 'select', 'ISO 7211-5', '0', 'select', '0', '0', '0', 'select', 'ISO 7211-2', '0', 'select', '0', '0', '0', 'select', 'ISO 7211-2', '0', 'select', '0', '0', '0', 'select', 'ISO 3801', '0', '', '0', '0', '0', 'select', 'ISO 12945-2', 'select', '', 'select', '0', '0', '0', 'uom_of_sur', 'ISO 13934-1', 'select', '0', '0', '0', 'select', 'ISO 13934-1', 'select', '0', '0', '0', 'select', 'ISO 13937-2', 'select', '0', '0', '0', 'select', 'ISO 13937-2', 'select', '0', '0', '0', 'select', 'select', 'ISO 13936-', '0', '0', '0', '', 'select', 'ISO 13936-2', 'select', '0', '0', '0', 'mm', 'select', 'ISO 13936-1', 'selec', '0', '0', '0', 'select', 'ISO 13936-2', 'selec', '0', '0', '0', 'mm', 'ISO 13935-2', 'select', '0', '0', '0', 'select', 'ISO 13935-2', 'select', '0', '0', '0', 'select', 'ASTM D 1683', 'select', '0', '0', '0', 'select', 'ASTM D 1683', 'select', '0', '0', '0', 'select', 'ASTM D 1683', 'select', '0', '0', '0', 'select', 'ASTM D 1683', 'select', '0', '0', '0', 'select', 'iftekhar', 'iftekhar', '2020-12-27 17:58:31');

-- ----------------------------
-- Table structure for `defining_qc_standard_for_scouring_bleaching_process`
-- ----------------------------
DROP TABLE IF EXISTS `defining_qc_standard_for_scouring_bleaching_process`;
CREATE TABLE `defining_qc_standard_for_scouring_bleaching_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) NOT NULL,
  `version_id` varchar(30) NOT NULL,
  `version_number` varchar(100) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `color` varchar(50) NOT NULL,
  `finish_width_in_inch` double NOT NULL,
  `standard_for_which_process` varchar(50) NOT NULL,
  `test_method_for_whiteness` varchar(20) DEFAULT '',
  `whiteness_min_value` double NOT NULL,
  `whiteness_max_value` varchar(0) NOT NULL,
  `uom_of_whiteness` varchar(20) NOT NULL,
  `test_method_for_residual_sizing_material` varchar(20) DEFAULT '',
  `residual_sizing_material_min_value` double NOT NULL,
  `residual_sizing_material_max_value` double NOT NULL,
  `uom_of_residual_sizing_material` varchar(20) NOT NULL,
  `test_method_for_absorbency` varchar(20) NOT NULL DEFAULT '',
  `absorbency_min_value` double NOT NULL,
  `absorbency_max_value` double NOT NULL,
  `uom_of_absorbency` varchar(20) NOT NULL DEFAULT '',
  `test_method_for_resistance_to_surface_fuzzing_and_pilling` varchar(20) NOT NULL DEFAULT '',
  `resistance_to_surface_fuzzing_and_pilling_min_value` double NOT NULL,
  `resistance_to_surface_fuzzing_and_pilling_max_value` double NOT NULL,
  `uom_of_resistance_to_surface_fuzzing_and_pilling` varchar(20) NOT NULL,
  `test_method_for_ph` varchar(20) DEFAULT '',
  `ph_min_value` double NOT NULL,
  `ph_max_value` double NOT NULL,
  `uom_of_ph` varchar(20) NOT NULL,
  `recording_person_id` varchar(30) NOT NULL,
  `recording_person_name` varchar(50) NOT NULL,
  `recording_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of defining_qc_standard_for_scouring_bleaching_process
-- ----------------------------
INSERT INTO `defining_qc_standard_for_scouring_bleaching_process` VALUES ('2', '5893/2020', 'version_27', 'Pillow Back', 'Ikea', 'Beige', '50', 'Scouring & Bleaching', 'Berger', '1', '', '°', 'Drop test method', '1', '2', '%', 'Capillary Method', '0', '0', 'mm', 'ISO 12945-2', '0', '0', 'meter/min', 'Berger', '0', '0', '%', 'iftekhar', 'iftekhar', '2020-12-28 10:23:57');

-- ----------------------------
-- Table structure for `defining_qc_standard_for_scouring_bleaching_process_bkup`
-- ----------------------------
DROP TABLE IF EXISTS `defining_qc_standard_for_scouring_bleaching_process_bkup`;
CREATE TABLE `defining_qc_standard_for_scouring_bleaching_process_bkup` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) DEFAULT NULL,
  `version_number` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `finish_width_in_inch` double DEFAULT NULL,
  `standard_for_which_process` varchar(50) DEFAULT NULL,
  `absorbency_value` double DEFAULT NULL,
  `absorbency_tolerance_range_math_operator` varchar(20) DEFAULT NULL,
  `absorbency_tolerance_value` double DEFAULT NULL,
  `absorbency_min_value` double DEFAULT NULL,
  `absorbency_max_value` double DEFAULT NULL,
  `uom_of_absorbency` varchar(20) DEFAULT NULL,
  `residual_sizing_material_value` double DEFAULT NULL,
  `residual_sizing_material_tolerance_range_math_operator` varchar(20) DEFAULT NULL,
  `residual_sizing_material_tolerance_value` double DEFAULT NULL,
  `residual_sizing_material_min_value` double DEFAULT NULL,
  `residual_sizing_material_max_value` double DEFAULT NULL,
  `uom_of_residual_sizing_material` varchar(20) DEFAULT NULL,
  `whiteness_value` double DEFAULT NULL,
  `whiteness_tolerance_range_math_operator` varchar(10) DEFAULT NULL,
  `whiteness_tolerance_value` double DEFAULT NULL,
  `whiteness_min_value` double DEFAULT NULL,
  `whiteness_max_value` varchar(0) DEFAULT NULL,
  `uom_of_whiteness` varchar(20) DEFAULT NULL,
  `pilling_iso_12945_2_value` double DEFAULT NULL,
  `pilling_iso_12945_2_tolerance_range_math_operator` varchar(10) DEFAULT NULL,
  `pilling_iso_12945_2_tolerance_value` double DEFAULT NULL,
  `pilling_iso_12945_2_min_value` double DEFAULT NULL,
  `pilling_iso_12945_2_max_value` double DEFAULT NULL,
  `uom_of_pilling_iso_12945_2` varchar(20) DEFAULT NULL,
  `ph_value` double DEFAULT NULL,
  `ph_tolerance_range_math_operator` varchar(10) DEFAULT NULL,
  `ph_tolerance_value` double DEFAULT NULL,
  `ph_min_value` double DEFAULT NULL,
  `ph_max_value` double DEFAULT NULL,
  `uom_of_ph` varchar(20) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of defining_qc_standard_for_scouring_bleaching_process_bkup
-- ----------------------------
INSERT INTO `defining_qc_standard_for_scouring_bleaching_process_bkup` VALUES ('1', 'ZZFL-H/PP/20/02224', 'Sheet?fs?White?fs?111?fs?Walmart', 'Walmart', 'White', '111', 'Scouring & Bleaching', '25', '+/-', '5', '23.75', '26.25', 'Berger', '7', '+', '29', '7', '9.03', 'Celcius', '65', '+', '8', '65', '', 'Berger', '3', '+', '70', '3', '5.1', 'Meter/Minute', '5.5', '+', '27', '5.5', '6.985', 'Celcius', 'qc', 'qc', '2020-11-30 21:38:41');

-- ----------------------------
-- Table structure for `defining_qc_standard_for_scouring_process`
-- ----------------------------
DROP TABLE IF EXISTS `defining_qc_standard_for_scouring_process`;
CREATE TABLE `defining_qc_standard_for_scouring_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) NOT NULL,
  `version_id` varchar(30) NOT NULL,
  `version_number` varchar(100) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `color` varchar(50) NOT NULL,
  `finish_width_in_inch` double NOT NULL,
  `standard_for_which_process` varchar(50) NOT NULL,
  `test_method_for_residual_sizing_material` varchar(20) DEFAULT '',
  `residual_sizing_material_min_value` double NOT NULL,
  `residual_sizing_material_max_value` double NOT NULL,
  `uom_of_residual_sizing_material` varchar(20) NOT NULL,
  `test_method_for_absorbency` varchar(20) NOT NULL DEFAULT '',
  `absorbency_min_value` double NOT NULL,
  `absorbency_max_value` double NOT NULL,
  `uom_of_absorbency` varchar(20) NOT NULL DEFAULT '',
  `test_method_for_resistance_to_surface_fuzzing_and_pilling` varchar(20) NOT NULL DEFAULT '',
  `resistance_to_surface_fuzzing_and_pilling_min_value` double NOT NULL,
  `resistance_to_surface_fuzzing_and_pilling_max_value` double NOT NULL,
  `uom_of_resistance_to_surface_fuzzing_and_pilling` varchar(20) NOT NULL,
  `test_method_for_ph` varchar(20) DEFAULT '',
  `ph_min_value` double NOT NULL,
  `ph_max_value` double NOT NULL,
  `uom_of_ph` varchar(20) NOT NULL,
  `recording_person_id` varchar(30) NOT NULL,
  `recording_person_name` varchar(50) NOT NULL,
  `recording_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of defining_qc_standard_for_scouring_process
-- ----------------------------

-- ----------------------------
-- Table structure for `defining_qc_standard_for_singe_and_desize_process`
-- ----------------------------
DROP TABLE IF EXISTS `defining_qc_standard_for_singe_and_desize_process`;
CREATE TABLE `defining_qc_standard_for_singe_and_desize_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) NOT NULL DEFAULT '',
  `version_id` varchar(30) NOT NULL,
  `version_number` varchar(100) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `color` varchar(30) NOT NULL,
  `finish_width_in_inch` double NOT NULL,
  `standard_for_which_process` varchar(100) NOT NULL,
  `test_method_for_flame_intensity` varchar(30) NOT NULL,
  `flame_intensity_min_value` double NOT NULL,
  `flame_intensity_max_value` double NOT NULL,
  `uom_of_flame_intensity` varchar(20) NOT NULL,
  `test_method_for_machine_speed` varchar(30) NOT NULL,
  `machine_speed_min_value` double NOT NULL,
  `machine_speed_max_value` double NOT NULL,
  `uom_of_machine_speed` varchar(20) NOT NULL,
  `test_method_for_bath_temperature` varchar(30) NOT NULL,
  `bath_temperature_min_value` double NOT NULL,
  `bath_temperature_max_value` double NOT NULL,
  `uom_of_bath_temperature` varchar(20) NOT NULL,
  `test_method_for_bath_ph` varchar(30) NOT NULL,
  `bath_ph_min_value` double NOT NULL,
  `bath_ph_max_value` double NOT NULL,
  `uom_of_bath_ph` varchar(20) NOT NULL,
  `recording_person_id` varchar(30) NOT NULL,
  `recording_person_name` varchar(50) NOT NULL,
  `recording_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of defining_qc_standard_for_singe_and_desize_process
-- ----------------------------
INSERT INTO `defining_qc_standard_for_singe_and_desize_process` VALUES ('2', '5893/2020', 'version_27', 'Pillow Back', 'Ikea', 'Beige', '50', 'Singeing & Desizing', 'intensity', '0', '0', 'mbar', 'machine speed', '0', '0', 'Meter/Minute', 'bath', '0', '0', '\r\n     °C', 'Merck Universal Indicator', '0', '0', '°C', 'iftekhar', 'iftekhar', '2020-12-27 17:59:34');

-- ----------------------------
-- Table structure for `defining_qc_standard_for_steaming_process`
-- ----------------------------
DROP TABLE IF EXISTS `defining_qc_standard_for_steaming_process`;
CREATE TABLE `defining_qc_standard_for_steaming_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) DEFAULT NULL,
  `version_id` varchar(30) NOT NULL,
  `version_number` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `finish_width_in_inch` double DEFAULT NULL,
  `standard_for_which_process` varchar(100) DEFAULT NULL,
  `flame_intensity_value` double DEFAULT NULL,
  `uom_of_flame_intensity` varchar(20) DEFAULT NULL,
  `flame_intensity_tolerance_range_math_operator` varchar(5) DEFAULT NULL,
  `flame_intensity_tolerance_value` double DEFAULT NULL,
  `flame_intensity_min_value` double DEFAULT NULL,
  `flame_intensity_max_value` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `uom_of_speed` varchar(20) DEFAULT NULL,
  `speed_tolerance_range_math_operator` varchar(10) DEFAULT NULL,
  `speed_tolerance_value` double DEFAULT NULL,
  `speed_min_value` double DEFAULT NULL,
  `speed_max_value` double DEFAULT NULL,
  `bath_temperature` double DEFAULT NULL,
  `uom_of_bath_temperature` varchar(20) DEFAULT NULL,
  `bath_temperature_tolerance_range_math_operator` varchar(20) DEFAULT NULL,
  `bath_temperature_tolerance_value` double DEFAULT NULL,
  `bath_temperature_min_value` double DEFAULT NULL,
  `bath_temperature_max_value` double DEFAULT NULL,
  `ph` double DEFAULT NULL,
  `uom_of_ph` varchar(20) DEFAULT NULL,
  `ph_tolerance_range_math_operator` varchar(10) DEFAULT NULL,
  `ph_tolerance_value` double DEFAULT NULL,
  `ph_min_value` double DEFAULT NULL,
  `ph_max_value` double DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of defining_qc_standard_for_steaming_process
-- ----------------------------

-- ----------------------------
-- Table structure for `defining_qc_standard_for_washing_process`
-- ----------------------------
DROP TABLE IF EXISTS `defining_qc_standard_for_washing_process`;
CREATE TABLE `defining_qc_standard_for_washing_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(30) NOT NULL,
  `version_id` varchar(30) NOT NULL,
  `version_number` varchar(30) NOT NULL,
  `customer_name` varchar(30) NOT NULL,
  `color` varchar(20) NOT NULL,
  `finish_width_in_inch` float NOT NULL,
  `standard_for_which_process` varchar(30) NOT NULL,
  `test_method_for_cf_to_rubbing_dry` varchar(25) NOT NULL,
  `cf_to_rubbing_dry_tolerance_range_math_operator` varchar(8) NOT NULL,
  `cf_to_rubbing_dry_tolerance_value` float NOT NULL,
  `cf_to_rubbing_dry_min_value` float NOT NULL,
  `cf_to_rubbing_dry_max_value` float NOT NULL,
  `uom_of_cf_to_rubbing_dry` varchar(15) NOT NULL,
  `test_method_for_cf_to_rubbing_wet` varchar(25) NOT NULL,
  `cf_to_rubbing_wet_tolerance_range_math_operator` varchar(8) NOT NULL,
  `cf_to_rubbing_wet_tolerance_value` float NOT NULL,
  `cf_to_rubbing_wet_min_value` float NOT NULL,
  `cf_to_rubbing_wet_max_value` float NOT NULL,
  `uom_of_cf_to_rubbing_wet` varchar(15) NOT NULL,
  `test_method_for_cf_to_washing_color_change` varchar(25) NOT NULL,
  `cf_to_washing_color_change_tolerance_range_math_operator` varchar(8) NOT NULL,
  `cf_to_washing_color_change_tolerance_value` float NOT NULL,
  `cf_to_washing_color_change_min_value` float NOT NULL,
  `cf_to_washing_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_washing_color_change` varchar(10) NOT NULL,
  `test_method_for_cf_to_washing_staining` varchar(25) NOT NULL,
  `cf_to_washing_staining_tolerance_range_math_operator` varchar(8) NOT NULL,
  `cf_to_washing_staining_tolerance_value` float NOT NULL,
  `cf_to_washing_staining_min_value` float NOT NULL,
  `cf_to_washing_staining_max_value` float NOT NULL,
  `uom_of_cf_to_washing_staining` varchar(10) NOT NULL,
  `test_method_for_cf_to_washing_cross_staining` varchar(25) NOT NULL,
  `cf_to_washing_cross_staining_tolerance_range_math_operator` varchar(8) NOT NULL,
  `cf_to_washing_cross_staining_tolerance_value` float NOT NULL,
  `cf_to_washing_cross_staining_min_value` float NOT NULL,
  `cf_to_washing_cross_staining_max_value` float NOT NULL,
  `uom_of_cf_to_washing_cross_staining` varchar(10) NOT NULL,
  `test_method_for_cf_to_dry_cleaning_color_change` varchar(25) NOT NULL,
  `cf_to_dry_cleaning_color_change_tolerance_range_math_operator` varchar(8) NOT NULL,
  `cf_to_dry_cleaning_color_change_tolerance_value` float NOT NULL,
  `cf_to_dry_cleaning_color_change_min_value` float NOT NULL,
  `cf_to_dry_cleaning_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_dry_cleaning_color_change` varchar(10) NOT NULL,
  `test_method_for_cf_to_dry_cleaning_staining` varchar(25) NOT NULL,
  `cf_to_dry_cleaning_staining_tolerance_range_math_operator` varchar(8) NOT NULL,
  `cf_to_dry_cleaning_staining_tolerance_value` float NOT NULL,
  `cf_to_dry_cleaning_staining_min_value` float NOT NULL,
  `cf_to_dry_cleaning_staining_max_value` float NOT NULL,
  `uom_of_cf_to_dry_cleaning_staining` varchar(10) NOT NULL,
  `test_method_for_perspiration_acid_color_change` varchar(25) NOT NULL,
  `cf_to_perspiration_acid_color_change_tolerance_range_math_op` varchar(8) NOT NULL,
  `cf_to_perspiration_acid_color_change_tolerance_value` float NOT NULL,
  `cf_to_perspiration_acid_color_change_min_value` float NOT NULL,
  `cf_to_perspiration_acid_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_perspiration_acid_color_change` varchar(10) NOT NULL,
  `test_method_for_cf_to_perspiration_acid_staining` varchar(25) NOT NULL,
  `cf_to_perspiration_acid_staining_tolerance_range_math_operator` varchar(8) NOT NULL,
  `cf_to_perspiration_acid_staining_value` float NOT NULL,
  `cf_to_perspiration_acid_staining_min_value` float NOT NULL,
  `cf_to_perspiration_acid_staining_max_value` float NOT NULL,
  `uom_of_cf_to_perspiration_acid_staining` varchar(10) NOT NULL,
  `test_method_for_cf_to_perspiration_acid_cross_staining` varchar(25) NOT NULL,
  `cf_to_perspiration_acid_cross_staining_tolerance_range_math_op` varchar(8) NOT NULL,
  `cf_to_perspiration_acid_cross_staining_tolerance_value` float NOT NULL,
  `cf_to_perspiration_acid_cross_staining_max_value` float NOT NULL,
  `cf_to_perspiration_acid_cross_staining_min_value` float NOT NULL,
  `uom_of_cf_to_perspiration_acid_cross_staining` varchar(10) NOT NULL,
  `test_method_for_cf_to_perspiration_alkali_color_change` varchar(25) NOT NULL,
  `cf_to_perspiration_alkali_color_change_tolerance_range_math_op` varchar(8) NOT NULL,
  `cf_to_perspiration_alkali_color_change_tolerance_value` float NOT NULL,
  `cf_to_perspiration_alkali_color_change_min_value` float NOT NULL,
  `cf_to_perspiration_alkali_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_perspiration_alkali_color_change` varchar(10) NOT NULL,
  `test_method_for_cf_to_perspiration_alkali_staining` varchar(25) NOT NULL,
  `cf_to_perspiration_alkali_staining_tolerance_range_math_op` varchar(8) NOT NULL,
  `cf_to_perspiration_alkali_staining_tolerance_value` float NOT NULL,
  `cf_to_perspiration_alkali_staining_min_value` float NOT NULL,
  `cf_to_perspiration_alkali_staining_max_value` float NOT NULL,
  `uom_of_cf_to_perspiration_alkali_staining` varchar(10) NOT NULL,
  `test_method_for_cf_to_perspiration_alkali_cross_staining` varchar(10) NOT NULL,
  `cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op` varchar(8) NOT NULL,
  `cf_to_perspiration_alkali_cross_staining_tolerance_value` float NOT NULL,
  `cf_to_perspiration_alkali_cross_staining_min_value` float NOT NULL,
  `cf_to_perspiration_alkali_cross_staining_max_value` float NOT NULL,
  `uom_of_cf_to_perspiration_alkali_cross_staining` varchar(10) NOT NULL,
  `test_method_for_cf_to_water_color_change` varchar(25) NOT NULL,
  `cf_to_water_color_change_tolerance_range_math_operator` varchar(8) NOT NULL,
  `cf_to_water_color_change_tolerance_value` float NOT NULL,
  `cf_to_water_color_change_min_value` float NOT NULL,
  `cf_to_water_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_water_color_change` varchar(10) NOT NULL,
  `test_method_for_cf_to_water_staining` varchar(25) NOT NULL,
  `cf_to_water_staining_tolerance_range_math_operator` varchar(8) NOT NULL,
  `cf_to_water_staining_tolerance_value` float NOT NULL,
  `cf_to_water_staining_min_value` float NOT NULL,
  `cf_to_water_staining_max_value` float NOT NULL,
  `uom_of_cf_to_water_staining` varchar(10) NOT NULL,
  `test_method_for_cf_to_water_cross_staining` varchar(25) NOT NULL,
  `cf_to_water_cross_staining_tolerance_range_math_operator` varchar(8) NOT NULL,
  `cf_to_water_cross_staining_tolerance_value` float NOT NULL,
  `cf_to_water_cross_staining_min_value` float NOT NULL,
  `cf_to_water_cross_staining_max_value` float NOT NULL,
  `uom_of_cf_to_water_cross_staining` varchar(10) NOT NULL,
  `test_method_for_cf_to_water_spotting_surface` varchar(25) NOT NULL,
  `cf_to_water_spotting_surface_tolerance_range_math_op` varchar(8) NOT NULL,
  `cf_to_water_spotting_surface_tolerance_value` float NOT NULL,
  `cf_to_water_spotting_surface_min_value` float NOT NULL,
  `cf_to_water_spotting_surface_max_value` float NOT NULL,
  `uom_of_cf_to_water_spotting_surface` varchar(10) NOT NULL,
  `test_method_for_cf_to_water_spotting_edge` varchar(25) NOT NULL,
  `cf_to_water_spotting_edge_tolerance_range_math_op` varchar(8) NOT NULL,
  `cf_to_water_spotting_edge_tolerance_value` float NOT NULL,
  `cf_to_water_spotting_edge_min_value` float NOT NULL,
  `cf_to_water_spotting_edge_max_value` float NOT NULL,
  `uom_of_cf_to_water_spotting_edge` varchar(10) NOT NULL,
  `test_method_for_cf_to_water_spotting_cross_staining` varchar(25) NOT NULL,
  `cf_to_water_spotting_cross_staining_tolerance_range_math_op` varchar(8) NOT NULL,
  `cf_to_water_spotting_cross_staining_tolerance_value` float NOT NULL,
  `cf_to_water_spotting_cross_staining_min_value` float NOT NULL,
  `cf_to_water_spotting_cross_staining_max_value` float NOT NULL,
  `uom_of_cf_to_water_spotting_cross_staining` varchar(10) NOT NULL,
  `test_method_for_cf_to_hydrolysis_of_reactive_dyes_color_change` varchar(25) NOT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op` varchar(8) NOT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value` float NOT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_min_value` float NOT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change` varchar(10) NOT NULL,
  `test_method_for_cf_to_oxidative_bleach_damage` varchar(25) NOT NULL,
  `cf_to_oxidative_bleach_damage_color_change_tol_range_math_op` varchar(8) NOT NULL,
  `cf_to_oxidative_bleach_damage_value` varchar(10) NOT NULL,
  `cf_to_oxidative_bleach_damage_color_change_tolerance_value` float NOT NULL,
  `cf_to_oxidative_bleach_damage_color_change_min_value` float NOT NULL,
  `cf_to_oxidative_bleach_damage_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_oxidative_bleach_damage_color_change` varchar(10) NOT NULL,
  `test_method_for_cf_to_phenolic_yellowing_staining` varchar(25) NOT NULL,
  `cf_to_phenolic_yellowing_staining_tolerance_range_math_operator` varchar(8) NOT NULL,
  `cf_to_phenolic_yellowing_staining_tolerance_value` float NOT NULL,
  `cf_to_phenolic_yellowing_staining_min_value` float NOT NULL,
  `cf_to_phenolic_yellowing_staining_max_value` float NOT NULL,
  `uom_of_cf_to_phenolic_yellowing_staining` varchar(10) NOT NULL,
  `cf_to_pvc_migration_staining_tolerance_range_math_operator` varchar(6) NOT NULL,
  `cf_to_pvc_migration_staining_tolerance_value` float NOT NULL,
  `cf_to_pvc_migration_staining_min_value` float NOT NULL,
  `cf_to_pvc_migration_staining_max_value` float NOT NULL,
  `uom_of_cf_to_pvc_migration_staining` varchar(10) NOT NULL,
  `test_method_for_cf_to_saliva_color_change` varchar(25) NOT NULL,
  `cf_to_saliva_color_change_tolerance_range_math_operator` varchar(4) NOT NULL,
  `cf_to_saliva_color_change_tolerance_value` float NOT NULL,
  `cf_to_saliva_color_change_staining_min_value` float NOT NULL,
  `cf_to_saliva_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_saliva_color_change` varchar(10) NOT NULL,
  `test_method_for_cf_to_saliva_staining` varchar(25) NOT NULL,
  `cf_to_saliva_staining_tolerance_range_math_operator` varchar(8) NOT NULL,
  `cf_to_saliva_staining_tolerance_value` float NOT NULL,
  `cf_to_saliva_staining_staining_min_value` float NOT NULL,
  `cf_to_saliva_staining_max_value` float NOT NULL,
  `uom_of_cf_to_saliva_staining` varchar(10) NOT NULL,
  `test_method_for_cf_to_chlorinated_water_color_change` varchar(25) NOT NULL,
  `cf_to_chlorinated_water_color_change_tolerance_range_math_op` varchar(8) NOT NULL,
  `cf_to_chlorinated_water_color_change_tolerance_value` float NOT NULL,
  `cf_to_chlorinated_water_color_change_min_value` float NOT NULL,
  `cf_to_chlorinated_water_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_chlorinated_water_color_change` varchar(10) NOT NULL,
  `test_method_for_cf_to_cholorine_bleach_color_change` varchar(25) NOT NULL,
  `cf_to_cholorine_bleach_color_change_tolerance_range_math_op` varchar(5) NOT NULL,
  `cf_to_cholorine_bleach_color_change_tolerance_value` float NOT NULL,
  `cf_to_cholorine_bleach_color_change_min_value` float NOT NULL,
  `cf_to_cholorine_bleach_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_cholorine_bleach_color_change` varchar(10) NOT NULL,
  `test_method_for_cf_to_peroxide_bleach_color_change` varchar(25) NOT NULL,
  `cf_to_peroxide_bleach_color_change_tolerance_range_math_operator` varchar(5) NOT NULL,
  `cf_to_peroxide_bleach_color_change_tolerance_value` float NOT NULL,
  `cf_to_peroxide_bleach_color_change_min_value` float NOT NULL,
  `cf_to_peroxide_bleach_color_change_max_value` float NOT NULL,
  `uom_of_cf_to_peroxide_bleach_color_change` varchar(10) NOT NULL,
  `test_method_for_cross_staining` varchar(25) NOT NULL,
  `cross_staining_tolerance_range_math_operator` varchar(5) NOT NULL,
  `cross_staining_tolerance_value` float NOT NULL,
  `cross_staining_min_value` float NOT NULL,
  `cross_staining_max_value` float NOT NULL,
  `uom_of_cross_staining` varchar(10) NOT NULL,
  `test_method_for_ph` varchar(25) NOT NULL,
  `ph_value_tolerance_range_math_operator` varchar(5) NOT NULL,
  `ph_value_tolerance_value` float NOT NULL,
  `ph_value_min_value` float NOT NULL,
  `ph_value_max_value` float NOT NULL,
  `uom_of_ph_value` varchar(10) NOT NULL,
  `recording_person_id` varchar(15) NOT NULL,
  `recording_person_name` varchar(15) NOT NULL,
  `recording_time` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of defining_qc_standard_for_washing_process
-- ----------------------------

-- ----------------------------
-- Table structure for `department_info`
-- ----------------------------
DROP TABLE IF EXISTS `department_info`;
CREATE TABLE `department_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `location` varchar(100) DEFAULT NULL,
  `department_name` varchar(100) DEFAULT NULL,
  `section_name` varchar(100) DEFAULT NULL,
  `contact_person_name` varchar(100) DEFAULT NULL,
  `contact_no` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of department_info
-- ----------------------------
INSERT INTO `department_info` VALUES ('5', 'Gulashan Chairman House', 'ICT', 'Software', 'Iftekhar', '01521300352', 'iftekharmahmud123@gmail.com', 'iftekhar', 'iftekhar', '2020-12-23 17:10:27');
INSERT INTO `department_info` VALUES ('8', 'Zaber & Zubair Fabrics Ltd.', 'Lab & QC', 'Customer Service & Data Management', 'Md. Jiash Hasnat', '+8801985982850', 'ftslab@znzfab.com', 'qc', 'qc', '2020-12-01 09:59:26');

-- ----------------------------
-- Table structure for `designation_info`
-- ----------------------------
DROP TABLE IF EXISTS `designation_info`;
CREATE TABLE `designation_info` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) DEFAULT NULL,
  `short_form` varchar(100) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of designation_info
-- ----------------------------
INSERT INTO `designation_info` VALUES ('1', 'Officer', 'Officer', null, null, null);
INSERT INTO `designation_info` VALUES ('3', 'Junior Officer', 'Jr. Officer', null, null, null);
INSERT INTO `designation_info` VALUES ('4', 'Senior Officer', 'Sr. Officer', null, null, null);
INSERT INTO `designation_info` VALUES ('22', 'Programmer', 'Programmer', null, null, null);
INSERT INTO `designation_info` VALUES ('23', 'Junior Programmer', 'Jr. Programmer', null, null, null);
INSERT INTO `designation_info` VALUES ('5', 'Executive', 'Executive', null, null, null);
INSERT INTO `designation_info` VALUES ('7', 'Junior Executive', 'Jr. Executive', null, null, null);
INSERT INTO `designation_info` VALUES ('8', 'Senior Executive', 'Sr. Executive', null, null, null);
INSERT INTO `designation_info` VALUES ('9', 'General Manager', 'GM', null, null, null);
INSERT INTO `designation_info` VALUES ('24', 'Assistant Programmer', 'Asst. Programmer', null, null, null);
INSERT INTO `designation_info` VALUES ('25', 'Senior Programmer', 'Sr. Programmer', null, null, null);
INSERT INTO `designation_info` VALUES ('10', 'Assistant General Manager', 'AGM', null, null, null);
INSERT INTO `designation_info` VALUES ('11', 'Deputy General Manager', 'DGM', null, null, null);
INSERT INTO `designation_info` VALUES ('12', 'Manager', 'Manager', null, null, null);
INSERT INTO `designation_info` VALUES ('19', 'Junior Application Developer', 'Jr. App. Developer', null, null, null);
INSERT INTO `designation_info` VALUES ('13', 'Assistant Manager', 'Asst. Manager', null, null, null);
INSERT INTO `designation_info` VALUES ('14', 'Deputy Manager', 'Dept. Manager', null, null, null);
INSERT INTO `designation_info` VALUES ('15', 'Senior Manager', 'Sr. Manager', null, null, null);
INSERT INTO `designation_info` VALUES ('2', 'Assistant Officer', 'Asst. Officer', null, null, null);
INSERT INTO `designation_info` VALUES ('20', 'Assistant Application Developer', 'Asst. App. Developer', null, null, null);
INSERT INTO `designation_info` VALUES ('16', 'Head of Department', 'Head of Dept.', null, null, null);
INSERT INTO `designation_info` VALUES ('17', 'Application Implementer', 'App. Implementer', '', '', '0000-00-00 00:00:00');
INSERT INTO `designation_info` VALUES ('18', 'Application Developer', 'App. Developer', null, null, null);
INSERT INTO `designation_info` VALUES ('21', 'Senior Application Developer', 'Sr. App. Developer', null, null, null);
INSERT INTO `designation_info` VALUES ('6', 'Assistant Executive', 'Asst. Executive', null, null, null);
INSERT INTO `designation_info` VALUES ('27', 'Junior Engineer', 'Jr. Engineer', null, null, null);
INSERT INTO `designation_info` VALUES ('26', 'Engineer', 'Engineer', null, null, null);
INSERT INTO `designation_info` VALUES ('28', 'Assistant Engineer', 'Asst. Engineer', null, null, null);
INSERT INTO `designation_info` VALUES ('29', 'Senior Engineer', 'Sr. Engineer', null, null, null);
INSERT INTO `designation_info` VALUES ('30', 'System & Network Engineer', 'System & Network Engineer', null, null, null);
INSERT INTO `designation_info` VALUES ('31', 'Junior System & Network Engineer', 'Jr. System Network Engineer', null, null, null);
INSERT INTO `designation_info` VALUES ('32', 'Assistant System & Network Engineer', 'Asst. System & Network Engineer', null, null, null);
INSERT INTO `designation_info` VALUES ('33', 'Senior System & Network Engineer', 'Sr. System & Network Engineer', null, null, null);
INSERT INTO `designation_info` VALUES ('34', 'Functional Co-ordinator', 'Functional Co-ordinator', null, null, null);
INSERT INTO `designation_info` VALUES ('35', 'Senior Functional Co-ordinator', 'Sr. Functional Co-ordinator', null, null, null);
INSERT INTO `designation_info` VALUES ('36', 'Data Co-ordinator', 'Data Co-ordinator', null, null, null);
INSERT INTO `designation_info` VALUES ('37', 'Senior Data Co-ordinator', 'Sr. Data Co-ordinator', null, null, null);
INSERT INTO `designation_info` VALUES ('38', 'NOC Engineer', 'NOC Engineer', null, null, null);
INSERT INTO `designation_info` VALUES ('39', 'Chief Information Officer', 'CIO', null, null, null);
INSERT INTO `designation_info` VALUES ('40', 'Chief Technical Officer', 'CTO', null, null, null);
INSERT INTO `designation_info` VALUES ('41', 'Database Administrator', 'DBA', null, null, null);
INSERT INTO `designation_info` VALUES ('42', 'System Administrator', 'System Admin', null, null, null);
INSERT INTO `designation_info` VALUES ('43', 'System Analyst', 'System Analyst', null, null, null);
INSERT INTO `designation_info` VALUES ('44', 'Team Leader', 'Team Leader', null, null, null);
INSERT INTO `designation_info` VALUES ('45', 'Project Manager', 'PM', null, null, null);
INSERT INTO `designation_info` VALUES ('46', 'Junior NOC Engineer', 'Jr. NOC Engineer', null, null, null);
INSERT INTO `designation_info` VALUES ('47', 'Electrical Engineer', 'ELec. Engr.', null, null, null);
INSERT INTO `designation_info` VALUES ('48', 'Assistant Manufacturing Engineer', 'Asst. Manufacturing Engr.', null, null, null);

-- ----------------------------
-- Table structure for `division_info`
-- ----------------------------
DROP TABLE IF EXISTS `division_info`;
CREATE TABLE `division_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `division_name` varchar(50) DEFAULT NULL,
  `division_full_name` varchar(100) DEFAULT NULL,
  `division_address` varchar(250) DEFAULT NULL,
  `division_location` varchar(100) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of division_info
-- ----------------------------
INSERT INTO `division_info` VALUES ('1', 'MHO', 'Motijheel Head Office', 'Motijeel, Dhaka', 'Head Office', null, null, null);
INSERT INTO `division_info` VALUES ('2', 'GHO', 'Gulshan Head Office', 'Gulshan, Dhaka', 'Head Office', null, null, null);
INSERT INTO `division_info` VALUES ('3', 'YSML', 'Yesmin Spinning Mills Ltd', '', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('4', 'ZSML', 'Zaber Spinning Mills Ltd', '', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('5', 'NSML', 'Noman Spinning Mills Ltd.', '', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('6', 'TSML', 'Talha Spinning Mills Ltd.', '', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('7', 'ISML', 'Ismail Spinning Mills Ltd.', '', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('10', 'SCML', 'Sufia Cotton Mills Ltd.', 'Sreepur, Gazipur', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('11', 'SCMLW', 'Sufia Cotton Mills Ltd. (Weaving)', 'Sreepur, Gazipur', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('12', 'NDML', 'Nice Denim Mills Ltd.', 'Sreepur, Gazipur', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('13', 'NDMLW', 'Nice Denim Mills Ltd (Washing)', 'Sreepur, Gazipur', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('14', 'NWML', 'Noman Weaving Mills Ltd(Shed-1)', 'Sreepur, Gazipur', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('15', 'NWML2', 'Noman Weaving Mills Ltd.(Shed-2)', 'Sreepur, Gazipur', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('16', 'NDSD', 'Nice Denim Solid Dyeing', 'Sreepur, Gazipur', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('17', 'NTTML', 'Noman Terry Towel Mills Ltd', 'Mirzapur, Gazipur', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('18', 'TFL', 'Talha Fabrics Ltd', '', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('8', 'ZZFL', 'Zaber & Zubair Fabrics Ltd', 'Pagar, Tongi', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('20', 'SSTML', 'Saad Saan Textile Mills Ltd.', '', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('21', 'TTPL', 'Talha Texpro Ltd.', '', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('9', 'NHTML', 'Noman Home Textile Mills Ltd.', 'Sreepur, Gazipur', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('23', 'NCTL', 'Noman Composite Textile Ltd', '', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('24', 'ZTML', 'Zarba Textile Mills Ltd.', '', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('25', 'ZTML-R', 'Zarba Textile Mills Ltd.(Rotor)', '', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('26', 'ITML', 'Ismail Textile Mills Ltd.', '', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('27', 'NTML', 'Noman Textile Mills Ltd.', '', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('28', 'IAAFL', 'Ismail Anzuman Ara Fabrics Ltd.', '', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('29', 'NFFL', 'Noman Fashion Fabrics Ltd', '', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('30', 'NFL1', 'Noman Fabrics Ltd-1', '', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('31', 'NFL2', 'Noman Fabrics Ltd-2', '', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('32', 'SFL1', 'Sufia Fabrics Ltd-1', '', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('33', 'SFL2', 'Sufia Fabrics Ltd-2', '', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('34', 'SFL3', 'Sufia Fabrics Ltd-3', '', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('35', 'AFL1', 'Artex Fabrics Ltd-1', '', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('36', 'AFL2', 'Artex Fabrics Ltd-2', '', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('37', 'MTML', 'Marium Textile Mills Ltd', '', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('22', 'ZuSML', 'Zubair Spinning Mills Ltd.', '', 'Factory', null, null, null);
INSERT INTO `division_info` VALUES ('19', 'SSAL', 'Saad Saan Apparels Ltd.', '', 'Factory', null, null, null);

-- ----------------------------
-- Table structure for `greige_receiving`
-- ----------------------------
DROP TABLE IF EXISTS `greige_receiving`;
CREATE TABLE `greige_receiving` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) DEFAULT NULL,
  `version_name` varchar(50) DEFAULT NULL,
  `greige_receiving_date` date DEFAULT NULL,
  `received_quantity` double DEFAULT NULL,
  `warp_yarn_count` int(11) DEFAULT NULL,
  `weft_yarn_count` int(11) DEFAULT NULL,
  `no_of_threads_in_warp_in_thread_per_inch` double DEFAULT NULL,
  `no_of_threads_in_weft_in_thread_per_inch` double DEFAULT NULL,
  `gsm` double DEFAULT NULL,
  `percentage_of_cotton_content` double DEFAULT NULL,
  `percentage_of_polyester_content` double DEFAULT NULL,
  `name_of_other_fiber_in_yarn` varchar(100) DEFAULT NULL,
  `percentage_of_other_fiber_content` double DEFAULT NULL,
  `finish_width_in_inch` double DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of greige_receiving
-- ----------------------------
INSERT INTO `greige_receiving` VALUES ('2', '23222', 'Pillow', '2020-11-10', '10000', '30', '30', '40', '40', '20', '90', '0', 'Viscose', '10', '60', 'OK', 'ok', 'Iftekhar', 'Iftekhar', '2020-11-10 18:26:57');
INSERT INTO `greige_receiving` VALUES ('3', '23222', 'Pillow', '2020-11-20', '10000', '30', '30', '40', '40', '20', '90', '0', 'Viscose', '10', '60', 'OK', 'ok', 'Iftekhar', 'Iftekhar', '2020-11-20 12:21:33');
INSERT INTO `greige_receiving` VALUES ('4', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', '2020-11-28', '1', '1', '1', '1', '1', '1', '1', '1', 'Viscose', '1', '1', 'OK', 'OK', 'iftekhar', 'iftekhar', '2020-11-28 14:45:36');

-- ----------------------------
-- Table structure for `greige_receiving_process_info`
-- ----------------------------
DROP TABLE IF EXISTS `greige_receiving_process_info`;
CREATE TABLE `greige_receiving_process_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `greige_issunce_id` int(11) NOT NULL,
  `pp_no_id` int(11) NOT NULL,
  `pp_details_id` int(11) NOT NULL,
  `custom_date` varchar(30) NOT NULL,
  `received_quantity` double NOT NULL,
  `yarn_warp` double NOT NULL,
  `yarn_weft` double NOT NULL,
  `thread_epi` double NOT NULL,
  `thread_ppi` double NOT NULL,
  `gsm` double NOT NULL,
  `fiber_total_polyester` float NOT NULL,
  `fiber_total_cotton` float NOT NULL,
  `fiber_total_thired` float NOT NULL,
  `fiber_total_fourth` float NOT NULL,
  `fiber_warp_polyester` float NOT NULL,
  `fiber_warp_cotton` float NOT NULL,
  `fiber_warp_thired` float NOT NULL,
  `fiber_warp_fourth` float NOT NULL,
  `fiber_weft_polyester` float NOT NULL,
  `fiber_weft_cotton` float NOT NULL,
  `fiber_weft_thired` float NOT NULL,
  `fiber_weft_fourth` float NOT NULL,
  `width` double NOT NULL,
  `status` int(11) NOT NULL,
  `remarks` varchar(500) NOT NULL,
  `active` int(11) NOT NULL,
  `recording_person_id` varchar(50) NOT NULL,
  `recording_person_name` varchar(50) NOT NULL,
  `recording_time` date NOT NULL,
  `modifying_person_id` varchar(50) NOT NULL,
  `modification_time` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of greige_receiving_process_info
-- ----------------------------
INSERT INTO `greige_receiving_process_info` VALUES ('86', '1', '108', '510', '01.11.2020', '10000', '2', '2', '4', '4', '2', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '56', '1', 'ok', '1', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');

-- ----------------------------
-- Table structure for `key_account_manager`
-- ----------------------------
DROP TABLE IF EXISTS `key_account_manager`;
CREATE TABLE `key_account_manager` (
  `row_id` int(10) NOT NULL,
  `key_account_manager_id` varchar(15) NOT NULL,
  `key_account_manager_name` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`key_account_manager_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of key_account_manager
-- ----------------------------
INSERT INTO `key_account_manager` VALUES ('1', 'keyacmgr_1', 'Rowshon Abedin Shujon', 'Marketing', 'Assistant Manager', '+8801985982850', 'iftekhar', 'iftekhar', '2020-12-23 13:13:57');
INSERT INTO `key_account_manager` VALUES ('10', 'keyacmgr_10', 'Mr. Sujit Ranjan Debnath', 'Marketing', 'Manager', '+8801922120116', 'qc', 'qc', '2020-11-30 14:55:28');
INSERT INTO `key_account_manager` VALUES ('11', 'keyacmgr_11', 'Mr. Khairul Kabir', 'Marketing', 'Assistant Manager', '+8801678507573', 'qc', 'qc', '2020-11-30 14:58:14');
INSERT INTO `key_account_manager` VALUES ('12', 'keyacmgr_12', 'Mr. Mahadi', 'Marketing', 'Executive', '+8801726219984', 'qc', 'qc', '2020-11-30 14:59:39');
INSERT INTO `key_account_manager` VALUES ('13', 'keyacmgr_13', 'Md. Humaun Kabir', 'Marketing', 'Senior Executive', '01678507568', 'qc', 'qc', '2020-11-30 15:00:08');
INSERT INTO `key_account_manager` VALUES ('14', 'keyacmgr_14', 'Mr. Faruk', 'Marketing', 'Executive', '+8801709994836', 'qc', 'qc', '2020-11-30 15:00:31');
INSERT INTO `key_account_manager` VALUES ('15', 'keyacmgr_15', 'Mr. Dhananjay Shaha', 'Marketing', 'Senior Manager', '+8801922120120', 'qc', 'qc', '2020-11-30 15:02:04');
INSERT INTO `key_account_manager` VALUES ('16', 'keyacmgr_16', 'Mr. Mahbub Sikder', 'Marketing', 'Manager', '+8801777797502', 'qc', 'qc', '2020-11-30 15:04:19');
INSERT INTO `key_account_manager` VALUES ('17', 'keyacmgr_17', 'Mr. Yamin', 'Marketing', 'Assistant Manager', '+8801701212578', 'qc', 'qc', '2020-11-30 15:05:36');
INSERT INTO `key_account_manager` VALUES ('18', 'keyacmgr_18', 'Mr. Manzurul Ahsan', 'Marketing', 'Senior Executive', '+8801709994561', 'qc', 'qc', '2020-11-30 15:07:17');
INSERT INTO `key_account_manager` VALUES ('19', 'keyacmgr_19', 'Mr. Md. Mizanur Rahman', 'Marketing', 'Assistant Manager', '+8801922120115', 'qc', 'qc', '2020-11-30 15:08:15');
INSERT INTO `key_account_manager` VALUES ('2', 'keyacmgr_2', 'Showkat Jahan', 'Marketing', 'Manager', '+8801922120104', 'qc', 'qc', '2020-11-30 14:38:45');
INSERT INTO `key_account_manager` VALUES ('20', 'keyacmgr_20', 'Mr. Mahmudul Haque', 'Marketing', 'Assistant Manager', '+8801709994851', 'qc', 'qc', '2020-11-30 15:09:31');
INSERT INTO `key_account_manager` VALUES ('3', 'keyacmgr_3', 'Moklesur Rahman Rony', 'Marketing', 'Senior Executive', '+8801701212576', 'qc', 'qc', '2020-11-30 14:44:11');
INSERT INTO `key_account_manager` VALUES ('4', 'keyacmgr_4', 'Mr. Omar Faruk', 'Marketing', 'Manager', '+8801922120121', 'qc', 'qc', '2020-11-30 17:56:29');
INSERT INTO `key_account_manager` VALUES ('5', 'keyacmgr_5', 'Mr. Mehedi Hasan', 'Marketing', 'Assistant Manager', '+8801922120119', 'qc', 'qc', '2020-11-30 14:49:44');
INSERT INTO `key_account_manager` VALUES ('6', 'keyacmgr_6', 'Mr. Kazi Jubair', 'Marketing', 'Manager', '+8801755629474', 'qc', 'qc', '2020-11-30 14:50:46');
INSERT INTO `key_account_manager` VALUES ('7', 'keyacmgr_7', 'Mr. Abdullah Al Razi', 'Marketing', 'Assistant Manager', '+8801922120072', 'qc', 'qc', '2020-11-30 14:52:00');
INSERT INTO `key_account_manager` VALUES ('8', 'keyacmgr_8', 'Mr. Shohorav', 'Marketing', 'Assistant Manager', '+8801678507569', 'qc', 'qc', '2020-11-30 17:56:15');
INSERT INTO `key_account_manager` VALUES ('9', 'keyacmgr_9', 'Mr. Humayun Kabir', 'Marketing', 'Senior Executive', '+8801678507568', 'qc', 'qc', '2020-11-30 14:54:41');

-- ----------------------------
-- Table structure for `machine_name`
-- ----------------------------
DROP TABLE IF EXISTS `machine_name`;
CREATE TABLE `machine_name` (
  `row_id` int(10) NOT NULL,
  `machine_id` varchar(15) NOT NULL,
  `machine_name` varchar(100) DEFAULT NULL,
  `process_id` varchar(15) DEFAULT NULL,
  `process_name` varchar(100) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`machine_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of machine_name
-- ----------------------------
INSERT INTO `machine_name` VALUES ('1', 'macname_1', 'Osthoff -1', 'proc_10', 'Steaming', 'iftekhar', 'iftekhar', '2020-12-13 17:25:59');
INSERT INTO `machine_name` VALUES ('2', 'macname_2', 'Goller-01', 'proc_4', 'Scouring & Bleaching', 'iftekhar', 'iftekhar', '2020-12-01 14:33:18');
INSERT INTO `machine_name` VALUES ('3', 'macname_3', 'Monforts-3', 'proc_16', 'Ready for Mercerize', 'iftekhar', 'iftekhar', '2020-12-01 20:58:31');
INSERT INTO `machine_name` VALUES ('4', 'macname_4', 'Monforts-1', '', 'Calendering', 'iftekhar', 'iftekhar', '2020-12-01 20:57:47');
INSERT INTO `machine_name` VALUES ('5', 'macname_5', 'Thermosol-2', 'proc_6', 'Dyeing', 'iftekhar', 'iftekhar', '2020-12-01 14:35:57');
INSERT INTO `machine_name` VALUES ('6', 'macname_6', 'Padsteam-2', 'proc_8', 'Washing', 'iftekhar', 'iftekhar', '2020-12-01 14:36:13');
INSERT INTO `machine_name` VALUES ('7', 'macname_7', 'Monforts-1', 'proc_15', 'Ready For Dyeing', 'iftekhar', 'iftekhar', '2020-12-01 14:36:31');
INSERT INTO `machine_name` VALUES ('8', 'macname_8', 'Monforts-3', 'proc_15', 'Ready For Dyeing', 'iftekhar', 'iftekhar', '2020-12-01 14:37:20');

-- ----------------------------
-- Table structure for `mercerize_process_info`
-- ----------------------------
DROP TABLE IF EXISTS `mercerize_process_info`;
CREATE TABLE `mercerize_process_info` (
  `mercerize_id` int(11) NOT NULL AUTO_INCREMENT,
  `route_issue_id` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `b_batcher` varchar(20) NOT NULL,
  `a_batcher` varchar(20) NOT NULL,
  `p_width` int(11) NOT NULL,
  `p_qty` int(11) NOT NULL,
  `s_or_e` varchar(20) NOT NULL,
  `absorbency_left` float NOT NULL,
  `absorbency_center` float NOT NULL,
  `absorbency_right` float NOT NULL,
  `size_left` float NOT NULL,
  `size_center` float NOT NULL,
  `size_right` float NOT NULL,
  `whiteness_left` float NOT NULL,
  `whiteness_center` float NOT NULL,
  `whiteness_right` float NOT NULL,
  `ph_left` float NOT NULL,
  `ph_center` float NOT NULL,
  `ph_right` float NOT NULL,
  `status` int(11) NOT NULL,
  `remarks` varchar(150) NOT NULL,
  `recording_person_id` varchar(50) NOT NULL,
  `recording_person_name` varchar(50) NOT NULL,
  `recording_time` date NOT NULL,
  `modifying_person_id` varchar(50) NOT NULL,
  `modification_time` date NOT NULL,
  PRIMARY KEY (`mercerize_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mercerize_process_info
-- ----------------------------
INSERT INTO `mercerize_process_info` VALUES ('18', '1868', '01.11.2020', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '4', '1', 'ok', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');

-- ----------------------------
-- Table structure for `partial_test_info`
-- ----------------------------
DROP TABLE IF EXISTS `partial_test_info`;
CREATE TABLE `partial_test_info` (
  `partial_test_id` int(50) NOT NULL AUTO_INCREMENT,
  `partial_test_creation_date` date NOT NULL,
  `alternate_partial_test_creation_date_time` varchar(30) NOT NULL,
  `trf_id` int(11) NOT NULL,
  `shift` varchar(8) NOT NULL,
  `process_name` varchar(20) NOT NULL,
  `pp_number` varchar(30) NOT NULL,
  `version_number` varchar(50) NOT NULL,
  `week_in_year` varchar(20) NOT NULL,
  `design` varchar(20) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `fiber_composition` varchar(50) NOT NULL,
  `finish_width_in_inch` double NOT NULL,
  `before_trolley_number_or_batcher_number` double NOT NULL,
  `after_trolley_number_or_batcher_number` double NOT NULL,
  `qty` double NOT NULL,
  `machine_name` varchar(50) NOT NULL,
  `service_type` varchar(20) NOT NULL,
  `washing` varchar(100) NOT NULL,
  `bleaching` varchar(100) NOT NULL,
  `ironing` varchar(100) NOT NULL,
  `dry_cleaning` varchar(100) NOT NULL,
  `drying` varchar(200) NOT NULL,
  `recording_person_id` varchar(20) NOT NULL,
  `recording_person_name` varchar(20) NOT NULL,
  `recording_time` datetime NOT NULL,
  PRIMARY KEY (`partial_test_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of partial_test_info
-- ----------------------------
INSERT INTO `partial_test_info` VALUES ('1', '2020-12-27', '03:45 PM', '0', 'C', 'Ready For Dyeing', '6038/2020', 'Pillow Back', '2048', 'JATTELIK DINO BLUE', 'Ikea', 'Cotton:0 Polyester:0 Other0', '103', '2', '2', '100000', 'Monforts-1', 'Regular', 'http://localhost/znzQC/img/washing/washing.png', 'http://localhost/znzQC/img/bleaching/bleaching.png', 'http://localhost/znzQC/img/Ironing/ironing.png', 'http://localhost/znzQC/img/DryCleaning/DryCleaning.png', 'http://localhost/znzQC/img/Drying/Drying.png', 'iftekhar', 'iftekhar', '2020-12-28 17:45:12');

-- ----------------------------
-- Table structure for `pp_wise_version_creation_info`
-- ----------------------------

-- ----------------------------
-- Table structure for `process_name`
-- ----------------------------
DROP TABLE IF EXISTS `process_name`;
CREATE TABLE `process_name` (
  `row_id` int(10) NOT NULL,
  `process_id` varchar(15) NOT NULL,
  `process_name` varchar(100) DEFAULT NULL,
  `description_of_process` varchar(250) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`process_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of process_name
-- ----------------------------
INSERT INTO `process_name` VALUES ('1', 'proc_1', 'Singeing & Desizing', 'Pretreatment', 'iftekhar', 'iftekhar', '2020-12-13 17:24:13');
INSERT INTO `process_name` VALUES ('10', 'proc_10', 'Steaming', 'Remove unfixed dye ', 'qc', 'qc', '2020-11-30 16:34:56');
INSERT INTO `process_name` VALUES ('11', 'proc_11', 'Ready For Dyeing', 'For Pigment Print', 'qc', 'qc', '2020-11-30 16:36:02');
INSERT INTO `process_name` VALUES ('12', 'proc_12', 'Dyeing', ' Dyeing', 'qc', 'qc', '2020-11-30 16:40:00');
INSERT INTO `process_name` VALUES ('13', 'proc_13', 'Washing', 'Remove unfixed dye ', 'qc', 'qc', '2020-11-30 16:40:33');
INSERT INTO `process_name` VALUES ('14', 'proc_14', 'Ready For Raising', ' Sanforizing', 'qc', 'qc', '2020-11-30 18:12:59');
INSERT INTO `process_name` VALUES ('15', 'proc_15', 'Raising', 'Ready For Print', 'qc', 'qc', '2020-11-30 18:13:08');
INSERT INTO `process_name` VALUES ('16', 'proc_16', 'Finishing', 'Finishing', 'qc', 'qc', '2020-11-30 18:17:53');
INSERT INTO `process_name` VALUES ('17', 'proc_17', 'Calander', 'Need to Iron', 'iftekhar', 'iftekhar', '2020-12-01 22:20:57');
INSERT INTO `process_name` VALUES ('18', 'proc_18', 'Sanforizing', 'Need to Sanforize', 'iftekhar', 'iftekhar', '2020-12-01 22:21:29');
INSERT INTO `process_name` VALUES ('19', 'proc_19', 'Inspection & Folding', 'Need to Inspect', 'iftekhar', 'iftekhar', '2020-12-01 22:21:47');
INSERT INTO `process_name` VALUES ('2', 'proc_2', 'Scouring', 'Pretreatment', 'qc', 'qc', '2020-11-30 16:22:50');
INSERT INTO `process_name` VALUES ('3', 'proc_3', 'Bleaching', 'Pretreatment', 'qc', 'qc', '2020-11-30 16:24:05');
INSERT INTO `process_name` VALUES ('4', 'proc_4', 'Scouring & Bleaching', 'Pretreatment', 'qc', 'qc', '2020-11-30 16:25:02');
INSERT INTO `process_name` VALUES ('5', 'proc_5', 'Ready For Mercerize', 'To set the width prior to Mercerize', 'qc', 'qc', '2020-11-30 16:26:19');
INSERT INTO `process_name` VALUES ('6', 'proc_6', 'Mercerize', 'For Better Hand feel', 'qc', 'qc', '2020-11-30 16:26:41');
INSERT INTO `process_name` VALUES ('7', 'proc_7', 'Ready For Print', 'Ready For Print', 'qc', 'qc', '2020-11-30 16:27:06');
INSERT INTO `process_name` VALUES ('8', 'proc_8', 'Printing', 'Printing', 'qc', 'qc', '2020-11-30 16:27:54');
INSERT INTO `process_name` VALUES ('9', 'proc_9', 'Curing', 'For Reactive Print', 'qc', 'qc', '2020-11-30 16:39:29');

-- ----------------------------
-- Table structure for `process_name_define`
-- ----------------------------
DROP TABLE IF EXISTS `process_name_define`;
CREATE TABLE `process_name_define` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `route_issue_main_id` int(11) NOT NULL,
  `pp_no_id` int(11) NOT NULL,
  `pp_details_id` int(11) NOT NULL,
  `route` int(11) NOT NULL,
  `process` varchar(30) NOT NULL,
  `process_number` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `complete` int(11) NOT NULL,
  `recording_person_id` varchar(50) NOT NULL,
  `recording_person_name` varchar(50) NOT NULL,
  `recording_time` date NOT NULL,
  `modifying_person_id` varchar(50) NOT NULL,
  `modification_time` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of process_name_define
-- ----------------------------
INSERT INTO `process_name_define` VALUES ('76', '76', '101', '1', '7', 'process', '4', '1', '0', 'hriday', 'Hriday Ahmed', '2020-10-29', 'hriday', '2020-10-29');
INSERT INTO `process_name_define` VALUES ('75', '75', '101', '1', '2', 'process', '3', '1', '0', 'hriday', 'Hriday Ahmed', '2020-10-29', 'hriday', '2020-10-29');
INSERT INTO `process_name_define` VALUES ('74', '1', '101', '1', '5', 'process', '2', '1', '0', 'hriday', 'Hriday Ahmed', '2020-10-29', 'hriday', '2020-10-29');
INSERT INTO `process_name_define` VALUES ('77', '77', '108', '510', '2', 'process', '2', '1', '0', 'hriday', 'Hriday Ahmed', '2020-10-30', 'hriday', '2020-10-30');
INSERT INTO `process_name_define` VALUES ('78', '78', '108', '510', '11', 'process', '3', '1', '0', 'hriday', 'Hriday Ahmed', '2020-10-30', 'hriday', '2020-10-30');
INSERT INTO `process_name_define` VALUES ('79', '79', '108', '510', '7', 'process', '4', '1', '0', 'hriday', 'Hriday Ahmed', '2020-10-30', 'hriday', '2020-10-30');
INSERT INTO `process_name_define` VALUES ('80', '80', '108', '510', '8', 'process', '5', '1', '0', 'hriday', 'Hriday Ahmed', '2020-10-30', 'hriday', '2020-10-30');
INSERT INTO `process_name_define` VALUES ('81', '81', '108', '510', '5', 'process', '6', '1', '0', 'hriday', 'Hriday Ahmed', '2020-10-30', 'hriday', '2020-10-30');
INSERT INTO `process_name_define` VALUES ('82', '82', '108', '510', '10', 'process', '7', '1', '0', 'hriday', 'Hriday Ahmed', '2020-10-30', 'hriday', '2020-10-30');
INSERT INTO `process_name_define` VALUES ('83', '83', '108', '510', '3', 'process', '8', '1', '0', 'hriday', 'Hriday Ahmed', '2020-10-30', 'hriday', '2020-10-30');
INSERT INTO `process_name_define` VALUES ('84', '84', '108', '510', '6', 'process', '9', '1', '0', 'hriday', 'Hriday Ahmed', '2020-10-30', 'hriday', '2020-10-30');
INSERT INTO `process_name_define` VALUES ('85', '85', '108', '510', '13', 'process', '10', '1', '0', 'hriday', 'Hriday Ahmed', '2020-10-30', 'hriday', '2020-10-30');
INSERT INTO `process_name_define` VALUES ('86', '86', '108', '510', '18', 'process', '11', '1', '0', 'hriday', 'Hriday Ahmed', '2020-10-30', 'hriday', '2020-10-30');
INSERT INTO `process_name_define` VALUES ('87', '87', '108', '510', '4', 'process', '12', '1', '0', 'hriday', 'Hriday Ahmed', '2020-10-30', 'hriday', '2020-10-30');
INSERT INTO `process_name_define` VALUES ('88', '88', '108', '510', '17', 'process', '13', '1', '0', 'hriday', 'Hriday Ahmed', '2020-10-30', 'hriday', '2020-10-30');
INSERT INTO `process_name_define` VALUES ('89', '89', '108', '510', '19', 'process', '14', '1', '0', 'hriday', 'Hriday Ahmed', '2020-10-30', 'hriday', '2020-10-30');
INSERT INTO `process_name_define` VALUES ('90', '90', '108', '510', '12', 'process', '15', '1', '0', 'hriday', 'Hriday Ahmed', '2020-10-30', 'hriday', '2020-10-30');
INSERT INTO `process_name_define` VALUES ('91', '91', '108', '510', '16', 'process', '16', '1', '0', 'hriday', 'Hriday Ahmed', '2020-10-30', 'hriday', '2020-10-30');
INSERT INTO `process_name_define` VALUES ('92', '92', '108', '510', '15', 'process', '17', '1', '0', 'hriday', 'Hriday Ahmed', '2020-10-30', 'hriday', '2020-10-30');
INSERT INTO `process_name_define` VALUES ('93', '93', '108', '510', '1', 'process', '18', '1', '0', 'hriday', 'Hriday Ahmed', '2020-10-30', 'hriday', '2020-10-30');
INSERT INTO `process_name_define` VALUES ('94', '94', '108', '510', '20', 'process', '19', '1', '0', 'hriday', 'Hriday Ahmed', '2020-10-30', 'hriday', '2020-10-30');
INSERT INTO `process_name_define` VALUES ('95', '95', '108', '510', '9', 'process', '20', '1', '0', 'hriday', 'Hriday Ahmed', '2020-10-30', 'hriday', '2020-10-30');
INSERT INTO `process_name_define` VALUES ('96', '96', '11', '1', '4', 'process', '2', '0', '0', 'hriday', 'Hriday Ahmed', '2020-11-02', 'hriday', '2020-11-02');
INSERT INTO `process_name_define` VALUES ('97', '97', '11', '1', '18', 'process', '3', '0', '0', 'hriday', 'Hriday Ahmed', '2020-11-02', 'hriday', '2020-11-02');
INSERT INTO `process_name_define` VALUES ('98', '98', '10', '9', '5', 'process', '2', '0', '0', 'hriday', 'Hriday Ahmed', '2020-11-02', 'hriday', '2020-11-02');
INSERT INTO `process_name_define` VALUES ('99', '99', '9', '10', '5', 'process', '2', '0', '0', 'hriday', 'Hriday Ahmed', '2020-11-02', 'hriday', '2020-11-02');
INSERT INTO `process_name_define` VALUES ('100', '100', '9', '10', '10', 'process', '3', '0', '0', 'hriday', 'Hriday Ahmed', '2020-11-02', 'hriday', '2020-11-02');
INSERT INTO `process_name_define` VALUES ('101', '101', '9', '10', '3', 'process', '4', '0', '0', 'hriday', 'Hriday Ahmed', '2020-11-02', 'hriday', '2020-11-02');

-- ----------------------------
-- Table structure for `process_name_define_after_greige_receiving`
-- ----------------------------
DROP TABLE IF EXISTS `process_name_define_after_greige_receiving`;
CREATE TABLE `process_name_define_after_greige_receiving` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `route_issue_id` int(11) NOT NULL,
  `greige_issunce_id` int(11) NOT NULL,
  `route` int(11) NOT NULL,
  `original` int(11) NOT NULL,
  `process` varchar(30) NOT NULL,
  `process_number` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `complete` int(11) NOT NULL,
  `recording_person_id` varchar(50) NOT NULL,
  `recording_person_name` varchar(50) NOT NULL,
  `recording_time` date NOT NULL,
  `modifying_person_id` varchar(50) NOT NULL,
  `modification_time` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1899 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of process_name_define_after_greige_receiving
-- ----------------------------
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1862', '1', '1', '2', '0', 'process', '2', '0', '1', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1863', '1863', '1', '11', '0', 'process', '3', '0', '1', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1864', '1864', '1', '7', '0', 'process', '4', '0', '1', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1865', '1865', '1', '8', '0', 'process', '5', '0', '0', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1866', '1866', '1', '5', '0', 'process', '6', '0', '1', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1867', '1867', '1', '10', '0', 'process', '7', '0', '1', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1868', '1868', '1', '3', '0', 'process', '8', '0', '1', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1869', '1869', '1', '6', '0', 'process', '9', '0', '1', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1870', '1870', '1', '13', '0', 'process', '10', '0', '0', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1871', '1871', '1', '18', '0', 'process', '11', '0', '0', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1872', '1872', '1', '4', '0', 'process', '12', '0', '0', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1873', '1873', '1', '17', '0', 'process', '13', '0', '0', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1874', '1874', '1', '19', '0', 'process', '14', '0', '0', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1875', '1875', '1', '12', '0', 'process', '15', '0', '0', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1876', '1876', '1', '16', '0', 'process', '16', '0', '0', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1877', '1877', '1', '15', '0', 'process', '17', '0', '0', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1878', '1878', '1', '1', '0', 'process', '18', '0', '0', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1879', '1879', '1', '20', '0', 'process', '19', '0', '0', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1880', '1880', '1', '9', '0', 'process', '20', '0', '0', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1881', '1', '1', '2', '0', 'process', '2', '1', '1', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1882', '1863', '1', '11', '0', 'process', '3', '1', '1', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1883', '1864', '1', '7', '0', 'process', '4', '1', '1', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1884', '1865', '1', '8', '0', 'process', '5', '1', '0', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1885', '1866', '1', '5', '0', 'process', '6', '1', '1', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1886', '1867', '1', '10', '0', 'process', '7', '1', '1', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1887', '1868', '1', '3', '0', 'process', '8', '1', '1', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1888', '1869', '1', '6', '0', 'process', '9', '1', '1', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1889', '1870', '1', '13', '0', 'process', '10', '1', '0', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1890', '1871', '1', '18', '0', 'process', '11', '1', '0', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1891', '1872', '1', '4', '0', 'process', '12', '1', '0', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1892', '1873', '1', '17', '0', 'process', '13', '1', '0', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1893', '1874', '1', '19', '0', 'process', '14', '1', '0', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1894', '1875', '1', '12', '0', 'process', '15', '1', '0', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1895', '1876', '1', '16', '0', 'process', '16', '1', '0', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1896', '1877', '1', '15', '0', 'process', '17', '1', '0', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1897', '1878', '1', '1', '0', 'process', '18', '1', '0', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');
INSERT INTO `process_name_define_after_greige_receiving` VALUES ('1898', '1880', '1', '9', '0', 'process', '19', '1', '0', 'hriday', 'Hriday Ahmed', '2020-11-01', 'hriday', '2020-11-01');

-- ----------------------------
-- Table structure for `process_program_info`
-- ----------------------------
DROP TABLE IF EXISTS `process_program_info`;
CREATE TABLE `process_program_info` (
  `row_id` int(10) unsigned NOT NULL,
  `pp_num_id` varchar(15) NOT NULL,
  `pp_creation_date` date DEFAULT NULL,
  `pp_number` varchar(100) DEFAULT NULL,
  `pp_description` varchar(250) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `greige_demand_no` varchar(100) DEFAULT NULL,
  `week_in_year` int(11) DEFAULT NULL,
  `design` varchar(100) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`pp_num_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of process_program_info
-- ----------------------------
INSERT INTO `process_program_info` VALUES ('1', 'ppnumber_1', '2020-11-17', '6038/2020', 'Pigment Printed(Rotary) Plain Fabric', 'Ikea', '0149/20', '2048', 'JATTELIK DINO BLUE', 'qc', 'qc', '2020-11-30 17:53:09');
INSERT INTO `process_program_info` VALUES ('2', 'ppnumber_2', '2020-11-03', 'ZZFL-H/PP/20/02224', 'Walmart-Canada, Cotton Percale T-180. Non Optical', 'Walmart', '01603, 01901, 01902', '2045', 'Sheet', 'qc', 'qc', '2020-11-30 18:13:59');
INSERT INTO `process_program_info` VALUES ('3', 'ppnumber_3', '2020-10-24', '5893/2020', 'Soft Pigment Print', 'Ikea', '0150/20', '2044', 'Jattelik Dino White', 'qc', 'qc', '2020-12-01 09:46:26');



DROP TABLE IF EXISTS `pp_wise_version_creation_info`;
CREATE TABLE `pp_wise_version_creation_info` (
  `row_id` int(10) unsigned NOT NULL,
  `version_id` varchar(15) NOT NULL,
  `pp_num_id` varchar(15) NOT NULL DEFAULT '',
  `pp_number` varchar(100) NOT NULL,
  `version_name` varchar(100) NOT NULL,
  `color` varchar(50) NOT NULL,
  `construction_name` varchar(100) NOT NULL,
  `no_of_weft_yarn_picking` varchar(30) NOT NULL,
  `greige_width_in_inch` double NOT NULL,
  `finish_width_in_inch` double NOT NULL,
  `process_technique_name` varchar(100) NOT NULL,
  `percentage_of_cotton_content` double NOT NULL,
  `percentage_of_polyester_content` double NOT NULL,
  `other_fiber_in_yarn` varchar(50) NOT NULL,
  `percentage_of_other_fiber_content` double NOT NULL,
  `pp_quantity` double NOT NULL,
  `recording_person_id` varchar(30) NOT NULL,
  `recording_person_name` varchar(50) NOT NULL,
  `recording_time` datetime NOT NULL,
  PRIMARY KEY (`version_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pp_wise_version_creation_info
-- ----------------------------
INSERT INTO `pp_wise_version_creation_info` VALUES ('1', 'version_1', 'ppnumber_1', '6038/2020', 'Front', 'Light Blue', '30.30/86.66', 'SPI', '0', '57', 'Pigment Print', '100', '0', 'Tencel', '0', '0', 'qc', 'qc', '2020-11-30 18:07:13');
INSERT INTO `pp_wise_version_creation_info` VALUES ('10', 'version_10', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet', 'Pink', '40.40/110.62', 'SPI', '0', '103', 'Pigment Dyeing', '100', '0', 'Tencel', '0', '0', 'qc', 'qc', '2020-11-30 20:30:20');
INSERT INTO `pp_wise_version_creation_info` VALUES ('11', 'version_11', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet', 'Tan', '40.40/110.62', 'SPI', '0', '108', 'Pigment Dyeing', '100', '0', 'Tencel', '0', '0', 'qc', 'qc', '2020-11-30 20:30:59');
INSERT INTO `pp_wise_version_creation_info` VALUES ('12', 'version_12', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet', 'Light Grey', '40.40/110.62', 'SPI', '0', '103', 'Pigment Dyeing', '100', '0', 'Tencel', '0', '0', 'qc', 'qc', '2020-11-30 20:32:18');
INSERT INTO `pp_wise_version_creation_info` VALUES ('13', 'version_13', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet', 'Red', '40.40/110.62', 'SPI', '0', '108', 'Reactive Dyeing', '100', '0', 'Tencel', '0', '0', 'qc', 'qc', '2020-11-30 20:33:07');
INSERT INTO `pp_wise_version_creation_info` VALUES ('14', 'version_14', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet', 'Red', '40.40/110.62', 'SPI', '0', '103', 'Reactive Dyeing', '100', '0', 'Tencel', '0', '0', 'qc', 'qc', '2020-11-30 20:38:29');
INSERT INTO `pp_wise_version_creation_info` VALUES ('15', 'version_15', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet', 'Aqua', '40.40/110.62', 'SPI', '0', '103', 'Reactive Dyeing', '100', '0', 'Tencel', '0', '0', 'qc', 'qc', '2020-11-30 20:41:00');
INSERT INTO `pp_wise_version_creation_info` VALUES ('16', 'version_16', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet', 'Black', '40.40/110.62', 'SPI', '0', '108', 'Reactive Dyeing', '100', '0', 'Tencel', '0', '0', 'qc', 'qc', '2020-11-30 20:42:22');
INSERT INTO `pp_wise_version_creation_info` VALUES ('17', 'version_17', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet', 'Black', '40.40/110.62', 'SPI', '0', '103', 'Reactive Dyeing', '100', '0', 'Tencel', '0', '0', 'qc', 'qc', '2020-11-30 20:48:46');
INSERT INTO `pp_wise_version_creation_info` VALUES ('18', 'version_18', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet', 'Blue', '40.40/110.62', 'SPI', '0', '108', 'Reactive Dyeing', '100', '0', 'Tencel', '0', '0', 'qc', 'qc', '2020-11-30 20:49:31');
INSERT INTO `pp_wise_version_creation_info` VALUES ('19', 'version_19', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet', 'Blue', '40.40/110.62', 'SPI', '0', '103', 'Reactive Dyeing', '100', '0', 'Tencel', '0', '0', 'qc', 'qc', '2020-11-30 20:51:01');
INSERT INTO `pp_wise_version_creation_info` VALUES ('2', 'version_2', 'ppnumber_2', '6038/2020', 'Reverse', 'Dk. Blue', '30.30/86.66', 'SPI', '0', '57', 'Pigment Print', '100', '0', 'Tencel', '0', '0', 'qc', 'qc', '2020-11-30 18:17:26');
INSERT INTO `pp_wise_version_creation_info` VALUES ('20', 'version_20', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet', 'Grey', '40.40/110.62', 'SPI', '0', '108', 'Reactive Dyeing', '100', '0', 'Tencel', '0', '0', 'qc', 'qc', '2020-11-30 20:53:55');
INSERT INTO `pp_wise_version_creation_info` VALUES ('21', 'version_21', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet', 'Grey', '40.40/110.62', 'SPI', '0', '103', 'Reactive Dyeing', '100', '0', 'Tencel', '0', '0', 'qc', 'qc', '2020-11-30 20:54:59');
INSERT INTO `pp_wise_version_creation_info` VALUES ('22', 'version_22', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet', 'Light Blue', '40.40/110.62', 'SPI', '0', '108', 'Pigment Dyeing', '100', '0', 'Tencel', '0', '0', 'qc', 'qc', '2020-11-30 20:55:35');
INSERT INTO `pp_wise_version_creation_info` VALUES ('23', 'version_23', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet', 'Light Blue', '40.40/110.62', 'SPI', '0', '103', 'Pigment Dyeing', '100', '0', 'Tencel', '0', '0', 'qc', 'qc', '2020-11-30 20:56:21');
INSERT INTO `pp_wise_version_creation_info` VALUES ('24', 'version_24', 'ppnumber_3', '6038/2020', 'Front', 'Beige', '30.30/86.66', 'SPIorDPI', '0', '58', 'Bleach White', '0', '0', 'Tencel', '0', '0', '', '', '2020-12-01 21:45:12');
INSERT INTO `pp_wise_version_creation_info` VALUES ('25', 'version_25', 'ppnumber_3', 'ZZFL-H/PP/20/02224', 'Front', 'Black', '40.40/110.64', 'SPI_DPI', '0', '58', 'Bleach White', '0', '0', 'Null', '0', '20000', 'iftekhar', 'iftekhar', '2020-12-01 22:02:18');
INSERT INTO `pp_wise_version_creation_info` VALUES ('26', 'version_26', 'ppnumber_3', '6038/2020', 'Pillow Back', 'Beige', '40.40/110.62', 'SPI_DPI', '50', '50', 'Pigment Print', '0', '0', 'Null', '0', '2000000', 'iftekhar', 'iftekhar', '2020-12-01 23:50:24');
INSERT INTO `pp_wise_version_creation_info` VALUES ('27', 'version_27', 'ppnumber_3', '5893/2020', 'Pillow Back', 'Beige', '40.40/110.64', 'SPI_DPI', '50', '58', 'Reactive Dyeing', '0', '0', 'Null', '0', '20000', 'iftekhar', 'iftekhar', '2020-12-15 12:55:29');
INSERT INTO `pp_wise_version_creation_info` VALUES ('28', 'version_28', 'ppnumber_3', '5893/2020', 'Pillow Front', 'Beige', '40.40/110.64', 'SPI_DPI', '50', '58', 'Reactive Print', '0', '0', 'Null', '0', '4000000', 'iftekhar', 'iftekhar', '2020-12-15 13:11:53');
INSERT INTO `pp_wise_version_creation_info` VALUES ('3', 'version_3', 'ppnumber_2', '6038/2020', 'Front', 'Light Blue', '30.30/86.66', 'SPI', '0', '66', 'Pigment Print', '100', '0', 'Tencel', '0', '0', 'qc', 'qc', '2020-11-30 18:23:09');
INSERT INTO `pp_wise_version_creation_info` VALUES ('4', 'version_4', 'ppnumber_2', '6038/2020', 'Front', 'Light Blue', '30.30/86.66', 'SPI', '0', '84', 'Pigment Print', '100', '0', 'Tencel', '0', '0', 'qc', 'qc', '2020-11-30 18:23:45');
INSERT INTO `pp_wise_version_creation_info` VALUES ('5', 'version_5', 'ppnumber_2', '6038/2020', 'Reverse', 'Light Blue', '30.30/86.66', 'SPI', '0', '66', 'Pigment Print', '100', '0', 'Tencel', '0', '0', 'qc', 'qc', '2020-11-30 18:24:21');
INSERT INTO `pp_wise_version_creation_info` VALUES ('6', 'version_6', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet', 'White', '40.40/110.64', 'SPI', '0', '108', 'Pigment Print', '100', '0', 'Tencel', '0', '0', 'qc', 'qc', '2020-11-30 20:04:53');
INSERT INTO `pp_wise_version_creation_info` VALUES ('7', 'version_7', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet', 'Light Grey', '40.40/110.62', 'SPI', '0', '108', 'Pigment Print', '100', '0', 'Tencel', '0', '0', 'qc', 'qc', '2020-11-30 20:08:40');
INSERT INTO `pp_wise_version_creation_info` VALUES ('8', 'version_8', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet', 'Tan', '40.40/110.62', 'SPI', '0', '108', 'Pigment Print', '100', '0', 'Tencel', '0', '0', 'qc', 'qc', '2020-11-30 20:17:17');
INSERT INTO `pp_wise_version_creation_info` VALUES ('9', 'version_9', 'ppnumber_2', 'ZZFL-H/PP/20/02224', 'Sheet', 'White', '40.40/110.62', 'SPI', '0', '103', 'Pigment Print', '100', '0', 'Tencel', '0', '0', 'qc', 'qc', '2020-11-30 20:27:26');

-- ----------------------------
-- Table structure for `process_technique_or_program_type`
-- ----------------------------
DROP TABLE IF EXISTS `process_technique_or_program_type`;
CREATE TABLE `process_technique_or_program_type` (
  `row_id` int(10) NOT NULL,
  `process_technique_id` varchar(15) NOT NULL,
  `process_technique_name` varchar(100) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`process_technique_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of process_technique_or_program_type
-- ----------------------------
INSERT INTO `process_technique_or_program_type` VALUES ('1', 'proctec_1', 'Reactive Dyeing', 'qc', 'qc', '2020-11-30 14:31:46');
INSERT INTO `process_technique_or_program_type` VALUES ('2', 'proctec_2', 'Pigment Dyeing', 'qc', 'qc', '2020-11-30 14:32:02');
INSERT INTO `process_technique_or_program_type` VALUES ('3', 'proctec_3', 'Yarn Dyed', 'qc', 'qc', '2020-11-30 14:32:20');
INSERT INTO `process_technique_or_program_type` VALUES ('4', 'proctec_4', 'Bleach White', 'qc', 'qc', '2020-11-30 15:31:31');
INSERT INTO `process_technique_or_program_type` VALUES ('5', 'proctec_5', 'Pigment Print', 'qc', 'qc', '2020-11-30 15:32:22');
INSERT INTO `process_technique_or_program_type` VALUES ('6', 'proctec_6', 'Soft Pigment Print', 'qc', 'qc', '2020-11-30 15:36:22');
INSERT INTO `process_technique_or_program_type` VALUES ('7', 'proctec_7', 'Reactive Print', 'qc', 'qc', '2020-11-30 15:41:04');
INSERT INTO `process_technique_or_program_type` VALUES ('8', 'proctec_8', 'White Paste Print', 'qc', 'qc', '2020-11-30 15:47:01');

-- ----------------------------
-- Table structure for `qc_result_for_bleaching_process`
-- ----------------------------
DROP TABLE IF EXISTS `qc_result_for_bleaching_process`;
CREATE TABLE `qc_result_for_bleaching_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) DEFAULT NULL,
  `version_number` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `finish_width_in_inch` double DEFAULT NULL,
  `standard_for_which_process` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `before_trolley_number_or_batcher_number` double DEFAULT NULL,
  `after_trolley_number_or_batcher_number` double DEFAULT NULL,
  `fabric_width_in_inch` double DEFAULT NULL,
  `received_quantity_in_meter` double DEFAULT NULL,
  `short_or_excess_in_percentage` double DEFAULT NULL,
  `total_quantity_in_meter` double DEFAULT NULL,
  `total_short_or_excess_in_percentage` double DEFAULT NULL,
  `machine_name` varchar(50) DEFAULT NULL,
  `absorbency_value` double DEFAULT NULL,
  `uom_of_absorbency` varchar(20) DEFAULT '',
  `residual_sizing_material_value` double DEFAULT NULL,
  `uom_of_residual_sizing_material` varchar(20) DEFAULT '',
  `whiteness_value` double DEFAULT NULL,
  `uom_of_whiteness` varchar(20) DEFAULT '',
  `pilling_iso_12945_2_value` double DEFAULT NULL,
  `uom_of_pilling_iso_12945_2` varchar(20) DEFAULT '',
  `ph_value` double DEFAULT NULL,
  `uom_of_ph` varchar(20) DEFAULT '',
  `status` varchar(10) DEFAULT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qc_result_for_bleaching_process
-- ----------------------------
INSERT INTO `qc_result_for_bleaching_process` VALUES ('1', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'select', null, null, null, null, null, null, null, null, null, '1', 'Berger', '1', 'Celcius', '1', 'Berger', '1', 'Meter/Minute', '1', 'Celcius', null, null, '6', 'hriday', '2020-11-13 22:07:02');
INSERT INTO `qc_result_for_bleaching_process` VALUES ('2', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'select', null, null, null, null, null, null, null, null, null, '1', 'Berger', '1', 'Celcius', '1', 'Berger', '1', 'Meter/Minute', '1', 'Celcius', null, null, '6', 'hriday', '2020-11-13 22:20:26');
INSERT INTO `qc_result_for_bleaching_process` VALUES ('3', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'select', null, null, null, null, null, null, null, null, null, '1', 'Berger', '1', 'Celcius', '1', 'Berger', '1', 'Meter/Minute', '1', 'Celcius', null, null, '6', 'hriday', '2020-11-14 11:56:20');
INSERT INTO `qc_result_for_bleaching_process` VALUES ('4', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'select', null, null, null, null, null, null, null, null, null, '1', 'Berger', '1', 'Celcius', '1', 'Berger', '1', 'Meter/Minute', '1', 'Celcius', null, null, '6', 'hriday', '2020-11-14 12:28:27');
INSERT INTO `qc_result_for_bleaching_process` VALUES ('5', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'select', null, null, null, null, null, null, null, null, null, '1', 'Berger', '1', 'Celcius', '1', 'Berger', '1', 'Meter/Minute', '1', 'Celcius', null, null, '6', 'hriday', '2020-11-14 12:28:37');
INSERT INTO `qc_result_for_bleaching_process` VALUES ('6', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'select', null, null, null, null, null, null, null, null, null, '1', 'Berger', '1', 'Celcius', '1', 'Berger', '1', 'Meter/Minute', '1', 'Celcius', null, null, '6', 'hriday', '2020-11-14 12:28:40');
INSERT INTO `qc_result_for_bleaching_process` VALUES ('7', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'select', null, null, null, null, null, null, null, null, null, '1', 'Berger', '1', 'Celcius', '1', 'Berger', '1', 'Meter/Minute', '1', 'Celcius', null, null, '6', 'hriday', '2020-11-14 12:28:43');
INSERT INTO `qc_result_for_bleaching_process` VALUES ('8', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'select', null, null, null, null, null, null, null, null, null, '2', 'Berger', '2', 'Celcius', '2', 'Berger', '2', 'Meter/Minute', '2', 'Celcius', null, null, '6', 'hriday', '2020-11-14 16:15:28');
INSERT INTO `qc_result_for_bleaching_process` VALUES ('9', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'select', null, null, null, null, null, null, null, null, null, '1', 'Berger', '1', 'Celcius', '1', 'Berger', '1', 'Meter/Minute', '1', 'Celcius', null, null, '6', 'hriday', '2020-11-14 16:20:37');
INSERT INTO `qc_result_for_bleaching_process` VALUES ('10', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'select', null, null, null, null, null, null, null, null, null, '1', 'Berger', '1', 'Celcius', '1', 'Berger', '1', 'Meter/Minute', '1', 'Celcius', null, null, '6', 'hriday', '2020-11-14 16:36:18');
INSERT INTO `qc_result_for_bleaching_process` VALUES ('11', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'Bleaching', '0000-00-00 00:00:00', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'OK', 'ok', '', '', '2020-11-21 18:03:40');

-- ----------------------------
-- Table structure for `qc_result_for_calendering_process`
-- ----------------------------
DROP TABLE IF EXISTS `qc_result_for_calendering_process`;
CREATE TABLE `qc_result_for_calendering_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) DEFAULT NULL,
  `version_number` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `finish_width_in_inch` double DEFAULT NULL,
  `standard_for_which_process` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `before_trolley_number_or_batcher_number` double DEFAULT NULL,
  `after_trolley_number_or_batcher_number` double DEFAULT NULL,
  `before_fabric_width_in_inch` double DEFAULT NULL,
  `process_fabrice_width_inch` double DEFAULT NULL,
  `received_quantity_in_meter` double DEFAULT NULL,
  `short_or_excess_in_percentage` double DEFAULT NULL,
  `trf_number` double DEFAULT NULL,
  `total_quantity_in_meter` double DEFAULT NULL,
  `total_short_or_excess_in_percentage` double DEFAULT NULL,
  `machine_name` double DEFAULT NULL,
  `face_or_back` varchar(20) DEFAULT NULL,
  `color_fastness_to_rubbing_dry_value` double DEFAULT NULL,
  `uom_of_color_fastness_to_rubbing_dry_value` varchar(20) DEFAULT NULL,
  `color_fastness_to_rubbing_wet_value` double DEFAULT NULL,
  `color_fastness_to_rubbing_wet_tolerance_value` double DEFAULT NULL,
  `uom_of_color_fastness_to_rubbing_wet` varchar(20) DEFAULT NULL,
  `dimensional_stability_to_warp_washing_before_iron_value` varchar(0) DEFAULT NULL,
  `dimensional_stability_to_weft_washing_before_iron_value` double DEFAULT NULL,
  `uom_of_dimensional_stability_to_weft_washing_before_iron` varchar(20) DEFAULT NULL,
  `dimensional_stability_to_warp_washing_after_iron_value` double DEFAULT NULL,
  `uom_of_dimensional_stability_to_warp_washing_after_iron` varchar(20) DEFAULT NULL,
  `dimensional_stability_to_weft_washing_after_iron_value` double DEFAULT NULL,
  `uom_of_dimensional_stability_to_weft_washing_after_iron` varchar(20) DEFAULT NULL,
  `dimensional_stability_to_weft_washing_afer_iron_min_value` double DEFAULT NULL,
  `uom_of_dimensional_stability_to_weft_washing_afer_iron` varchar(20) DEFAULT NULL,
  `change_in_warp_for_dry_cleaning_value` double DEFAULT NULL,
  `uom_of_change_in_warp_for_dry_cleaning` varchar(20) DEFAULT NULL,
  `change_in_weft_for_dry_cleaning_value` double DEFAULT NULL,
  `uom_of_change_in_weft_for_dry_cleaning` varchar(20) DEFAULT NULL,
  `warp_yarn_count_value` double DEFAULT NULL,
  `uom_of_warp_yarn_count_properties` varchar(20) DEFAULT NULL,
  `mass_per_unit_per_area_value` double DEFAULT NULL,
  `uom_of_mass_per_unit_per_area_properties` varchar(20) DEFAULT NULL,
  `no_of_threads_in_warp_value` double DEFAULT NULL,
  `uom_of_no_of_threads_in_warp_properties` varchar(20) DEFAULT NULL,
  `no_of_threads_in_weft_value` double DEFAULT NULL,
  `uom_of_no_of_threads_in_weft_properties` varchar(20) DEFAULT NULL,
  `surface_fuzzing_and_pilling_tolerance_value` double DEFAULT NULL,
  `uom_of_surface_fuzzing_and_pilling` varchar(20) DEFAULT NULL,
  `warp_yarn_tensile_properties_tolerance_value` double DEFAULT NULL,
  `uom_of_warp_yarn_tensile_properties` varchar(20) DEFAULT NULL,
  `warp_yarn_tear_force_tolerance_value` double DEFAULT NULL,
  `uom_of_warp_yarn_tear_force_properties` varchar(20) DEFAULT NULL,
  `weft_yarn_tear_force_tolerance_value` double DEFAULT NULL,
  `uom_of_weft_yarn_tear_force_properties` varchar(20) DEFAULT NULL,
  `warp_yarn_seam_tolerence_value` double DEFAULT NULL,
  `uom_of_warp_yarn_seam` varchar(20) DEFAULT NULL,
  `weft_yarn_seam_tolerence_value` double DEFAULT NULL,
  `uom_of_weft_yarn_seam_properties` varchar(20) DEFAULT NULL,
  `seam_slippage_resistance_in_warp_tolerence_value` double DEFAULT NULL,
  `uom_of_seam_slippage_resistance_in_warp_properties` varchar(20) DEFAULT NULL,
  `seam_slippage_resistance_in_weft_tolerence_value` double DEFAULT NULL,
  `uom_of_seam_slippage_resistance_in_weft` varchar(20) DEFAULT NULL,
  `seam_slippage_resistance_in_warp_mm_tolerance_value` double DEFAULT NULL,
  `uom_of_seam_slippage_resistance_in_warp_mm` varchar(20) DEFAULT NULL,
  `seam_slippage_resistance_in_weft_mm_tolerence_value` double DEFAULT NULL,
  `uom_of_seam_slippage_resistance_in_weft_mm_properties` varchar(20) DEFAULT NULL,
  `hand_feel` varchar(20) NOT NULL,
  `status` varchar(20) DEFAULT '',
  `remarks` varchar(250) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qc_result_for_calendering_process
-- ----------------------------
INSERT INTO `qc_result_for_calendering_process` VALUES ('22', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'Calendering', '2020-11-22', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'OK', 'OK', 'OK', '', '', '2020-11-22 10:27:17');
INSERT INTO `qc_result_for_calendering_process` VALUES ('23', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'Calendering', '2020-11-22', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'OK', 'OK', 'OK', '6', 'hriday', '2020-11-22 10:28:35');

-- ----------------------------
-- Table structure for `qc_result_for_curing_process`
-- ----------------------------
DROP TABLE IF EXISTS `qc_result_for_curing_process`;
CREATE TABLE `qc_result_for_curing_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) DEFAULT NULL,
  `version_number` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `finish_width_in_inch` double DEFAULT NULL,
  `standard_for_which_process` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `before_trolley_number_or_batcher_number` double DEFAULT NULL,
  `after_trolley_number_or_batcher_number` double DEFAULT NULL,
  `before_fabric_width_in_inch` double DEFAULT NULL,
  `process_fabric_width_inch` double DEFAULT NULL,
  `received_quantity_in_meter` double DEFAULT NULL,
  `short_or_excess_in_percentage` double DEFAULT NULL,
  `total_quantity_in_meter` double DEFAULT NULL,
  `total_short_or_excess_in_percentage` double DEFAULT NULL,
  `machine_name` varchar(50) DEFAULT NULL,
  `absorbency_value` double DEFAULT NULL,
  `uom_of_absorbency` varchar(20) DEFAULT '',
  `residual_sizing_material_value` double DEFAULT NULL,
  `uom_of_residual_sizing_material` varchar(20) DEFAULT '',
  `pilling_iso_12945_2_value` double DEFAULT NULL,
  `uom_of_pilling_iso_12945_2` varchar(20) DEFAULT '',
  `ph_value` double DEFAULT NULL,
  `uom_of_ph` varchar(20) DEFAULT '',
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qc_result_for_curing_process
-- ----------------------------
INSERT INTO `qc_result_for_curing_process` VALUES ('5', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'Curing', '2020-11-30 00:00:00', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'OK', 'OK', '0000-00-00 00:00:00', 'iftekhar', '2020-11-30 15:40:58');

-- ----------------------------
-- Table structure for `qc_result_for_curing_process_bkup`
-- ----------------------------
DROP TABLE IF EXISTS `qc_result_for_curing_process_bkup`;
CREATE TABLE `qc_result_for_curing_process_bkup` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) DEFAULT NULL,
  `version_number` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `finish_width_in_inch` double DEFAULT NULL,
  `standard_for_which_process` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `before_trolley_number_or_batcher_number` double DEFAULT NULL,
  `after_trolley_number_or_batcher_number` double DEFAULT NULL,
  `before_fabric_width_in_inch` double DEFAULT NULL,
  `process_fabric_width_inch` double DEFAULT NULL,
  `received_quantity_in_meter` double DEFAULT NULL,
  `short_or_excess_in_percentage` double DEFAULT NULL,
  `total_quantity_in_meter` double DEFAULT NULL,
  `total_short_or_excess_in_percentage` double DEFAULT NULL,
  `machine_name` varchar(50) DEFAULT NULL,
  `absorbency_value` double DEFAULT NULL,
  `uom_of_absorbency` varchar(20) DEFAULT '',
  `residual_sizing_material_value` double DEFAULT NULL,
  `uom_of_residual_sizing_material` varchar(20) DEFAULT '',
  `pilling_iso_12945_2_value` double DEFAULT NULL,
  `uom_of_pilling_iso_12945_2` varchar(20) DEFAULT '',
  `ph_value` double DEFAULT NULL,
  `uom_of_ph` varchar(20) DEFAULT '',
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qc_result_for_curing_process_bkup
-- ----------------------------
INSERT INTO `qc_result_for_curing_process_bkup` VALUES ('4', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'select', null, null, null, null, null, null, null, null, null, null, '1', 'Berger', '1', 'Celcius', '1', 'Meter/Minute', '1', 'Celcius', '6', 'hriday', '2020-11-17 10:37:46', null, null);

-- ----------------------------
-- Table structure for `qc_result_for_equalize_process`
-- ----------------------------
DROP TABLE IF EXISTS `qc_result_for_equalize_process`;
CREATE TABLE `qc_result_for_equalize_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) DEFAULT NULL,
  `version_number` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `finish_width_in_inch` double DEFAULT NULL,
  `standard_for_which_process` varchar(100) DEFAULT NULL,
  `date` datetime NOT NULL,
  `before_trolley_number_or_batcher_number` double NOT NULL,
  `after_trolley_number_or_batcher_number` double NOT NULL,
  `before_fabric_width_in_inch` double NOT NULL,
  `process_fabric_width_inch` double NOT NULL,
  `received_quantity_in_meter` double NOT NULL,
  `short_or_excess_in_percentage` double NOT NULL,
  `total_quantity_in_meter` double NOT NULL,
  `total_short_or_excess_in_percentage` double NOT NULL,
  `machine_name` varchar(50) NOT NULL,
  `whiteness_left_value` double NOT NULL,
  `whiteness_center_value` double NOT NULL,
  `bowing_and_skew_value` double NOT NULL,
  `whiteness_right_value` double NOT NULL,
  `uom_of_whiteness` varchar(20) NOT NULL,
  `uom_of_bowing_and_skew` varchar(20) NOT NULL,
  `ph_left_value` double NOT NULL,
  `ph_center_value` double NOT NULL,
  `ph_right_value` double NOT NULL,
  `uom_of_ph` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `recording_person_id` varchar(50) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qc_result_for_equalize_process
-- ----------------------------
INSERT INTO `qc_result_for_equalize_process` VALUES ('4', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'Equalize', '2020-12-01 00:00:00', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'OK', 'OK', 'iftekhar', 'iftekhar', '2020-12-01 12:25:38');

-- ----------------------------
-- Table structure for `qc_result_for_finishing_process`
-- ----------------------------
DROP TABLE IF EXISTS `qc_result_for_finishing_process`;
CREATE TABLE `qc_result_for_finishing_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(50) DEFAULT NULL,
  `version_number` varchar(50) DEFAULT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `finish_width_in_inch` float DEFAULT NULL,
  `standard_for_which_process` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `before_trolley_number_or_batcher_number` float DEFAULT NULL,
  `after_trolley_number_or_batcher_number` float DEFAULT NULL,
  `trf_number` float DEFAULT NULL,
  `process_fabric_width_inch` float DEFAULT NULL,
  `process_qty` float DEFAULT NULL,
  `short_or_excess_in_percentage` float DEFAULT NULL,
  `total_quantity_in_meter` float DEFAULT NULL,
  `total_short_or_excess_in_percentage` float DEFAULT NULL,
  `machine_name` varchar(20) DEFAULT NULL,
  `cf_to_rubbing_dry_tolerance_value` float NOT NULL,
  `uom_of_cf_to_rubbing_dry` varchar(20) DEFAULT NULL,
  `cf_to_rubbing_wet_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_rubbing_wet` varchar(20) DEFAULT NULL,
  `dimensional_stability_to_warp_washing_before_iron_min_value` float DEFAULT NULL,
  `uom_of_dimensional_stability_to_warp_washing_before_iron` varchar(10) DEFAULT NULL,
  `dimensional_stability_to_weft_washing_before_iron_min_value` float DEFAULT NULL,
  `uom_of_dimensional_stability_to_weft_washing_before_iron` varchar(10) DEFAULT NULL,
  `dimensional_stability_to_warp_washing_after_iron_min_value` float DEFAULT NULL,
  `uom_of_dimensional_stability_to_warp_washing_after_iron` varchar(10) DEFAULT NULL,
  `dimensional_stability_to_weft_washing_after_iron_min_value` float DEFAULT NULL,
  `uom_of_dimensional_stability_to_weft_washing_after_iron` varchar(10) DEFAULT NULL,
  `change_in_warp_for_dry_cleaning_min_value` float DEFAULT NULL,
  `uom_of_change_in_warp_for_dry_cleaning` varchar(10) DEFAULT NULL,
  `change_in_weft_for_dry_cleaning_min_value` float DEFAULT NULL,
  `uom_of_change_in_weft_for_dry_cleaning` varchar(10) DEFAULT NULL,
  `warp_yarn_count_value` float DEFAULT NULL,
  `uom_of_warp_yarn_count_value` varchar(10) DEFAULT NULL,
  `mass_per_unit_per_area_value` float DEFAULT NULL,
  `uom_of_mass_per_unit_per_area_value` varchar(10) DEFAULT NULL,
  `no_of_threads_in_warp_value` float DEFAULT NULL,
  `uom_of_no_of_threads_in_warp_value` varchar(10) DEFAULT NULL,
  `no_of_threads_in_weft_value` float DEFAULT NULL,
  `uom_of_no_of_threads_in_weft_value` varchar(10) DEFAULT NULL,
  `surface_fuzzing_and_pilling_tolerance_value` float DEFAULT NULL,
  `uom_of_surface_fuzzing_and_pilling_value` varchar(10) DEFAULT NULL,
  `tensile_properties_in_warp_value_tolerance_value` float DEFAULT NULL,
  `uom_of_tensile_properties_in_warp_value` varchar(10) DEFAULT NULL,
  `tear_force_in_warp_value_tolerance_value` float DEFAULT NULL,
  `uom_of_tear_force_in_warp_value` varchar(10) DEFAULT NULL,
  `tear_force_in_weft_value_tolerance_value` float DEFAULT NULL,
  `uom_of_tear_force_in_weft_value` varchar(10) DEFAULT NULL,
  `seam_strength_in_warp_value_tolerance_value` float DEFAULT NULL,
  `uom_of_seam_strength_in_warp_value` varchar(10) DEFAULT NULL,
  `seam_strength_in_weft_value_tolerance_value` float DEFAULT NULL,
  `uom_of_seam_strength_in_weft_value` varchar(10) DEFAULT NULL,
  `abrasion_resistance_s_change_value_tolerance_value` float DEFAULT NULL,
  `uom_of_abrasion_resistance_s_change_value` varchar(10) DEFAULT NULL,
  `abrasion_resistance_thread_break` varchar(10) DEFAULT '',
  `revolution` varchar(10) DEFAULT '',
  `print_durability` varchar(10) DEFAULT '',
  `mass_loss_in_abrasion_test_value_tolerance_value` float DEFAULT NULL,
  `uom_of_mass_loss_in_abrasion_test_value` varchar(10) DEFAULT NULL,
  `formaldehyde_content_tolerance_value` float DEFAULT NULL,
  `uom_of_formaldehyde_content` varchar(10) DEFAULT NULL,
  `cf_to_dry_cleaning_color_change_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_dry_cleaning_color_change` varchar(10) DEFAULT NULL,
  `cf_to_dry_cleaning_staining_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_dry_cleaning_staining` varchar(10) DEFAULT NULL,
  `cf_to_washing_color_change_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_washing_color_change` varchar(10) DEFAULT NULL,
  `cf_to_washing_staining_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_washing_staining` varchar(10) DEFAULT NULL,
  `cf_to_perspiration_acid_color_change_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_perspiration_acid_color_change` varchar(10) DEFAULT NULL,
  `cf_to_perspiration_acid_staining_value` float DEFAULT NULL,
  `uom_of_cf_to_perspiration_acid_staining` varchar(10) DEFAULT NULL,
  `cf_to_perspiration_alkali_color_change_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_perspiration_alkali_color_change` varchar(10) DEFAULT NULL,
  `cf_to_water_color_change_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_water_color_change` varchar(10) DEFAULT NULL,
  `cf_to_water_staining_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_water_staining` varchar(10) DEFAULT NULL,
  `cf_to_water_sotting_staining_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_water_sotting_staining` varchar(10) DEFAULT NULL,
  `cf_to_surface_wetting_staining_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_surface_wetting_staining` varchar(10) DEFAULT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change` varchar(10) DEFAULT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_hydrolysis_of_reactive_dyes_staining` varchar(10) DEFAULT NULL,
  `cf_to_oidative_bleach_damage_color_change_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_oidative_bleach_damage_color_change` varchar(10) DEFAULT NULL,
  `cf_to_phenolic_yellowing_staining_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_phenolic_yellowing_staining` varchar(10) DEFAULT NULL,
  `cf_to_pvc_migration_staining_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_pvc_migration_staining` varchar(10) DEFAULT NULL,
  `cf_to_saliva_color_change_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_saliva_color_change` varchar(10) DEFAULT NULL,
  `cf_to_saliva_staining_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_saliva_staining` varchar(10) DEFAULT NULL,
  `cf_to_chlorinated_water_color_change_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_chlorinated_water_color_change` varchar(10) DEFAULT NULL,
  `cf_to_chlorinated_water_staining_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_chlorinated_water_staining` varchar(10) DEFAULT NULL,
  `cf_to_cholorine_bleach_color_change_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_cholorine_bleach_color_change` varchar(10) DEFAULT NULL,
  `cf_to_cholorine_bleach_staining_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_cholorine_bleach_staining` varchar(10) DEFAULT NULL,
  `cf_to_peroxide_bleach_color_change_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_peroxide_bleach_color_change` varchar(10) DEFAULT NULL,
  `cf_to_peroxide_bleach_staining_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_peroxide_bleach_staining` varchar(10) DEFAULT NULL,
  `cross_staining_tolerance_value` float DEFAULT NULL,
  `uom_of_cross_staining` varchar(10) DEFAULT NULL,
  `water_absorption_value_tolerance_value` float DEFAULT NULL,
  `uom_of_water_absorption_value` varchar(10) DEFAULT NULL,
  `spirality_value_tolerance_value` float DEFAULT NULL,
  `uom_of_spirality_value` varchar(10) DEFAULT NULL,
  `durable_press_value_tolerance_value` float DEFAULT NULL,
  `uom_of_durable_press_value` varchar(10) DEFAULT NULL,
  `ironability_of_woven_fabric_value_tolerance_value` float DEFAULT NULL,
  `uom_of_ironability_of_woven_fabric_value` varchar(10) DEFAULT NULL,
  `cf_to_artificial_light_value_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_artificial_light_value` varchar(10) DEFAULT NULL,
  `moisture_content_in_percentage_min_value` float DEFAULT NULL,
  `uom_of_moisture_content_in_percentage` varchar(10) DEFAULT NULL,
  `evaporation_rate_in_percentage_min_value` float DEFAULT NULL,
  `uom_of_evaporation_rate_in_percentage` varchar(10) DEFAULT NULL,
  `percentage_of_total_cotton_content_tolerance_value` float DEFAULT NULL,
  `uom_of_percentage_of_total_cotton_content` varchar(10) DEFAULT NULL,
  `percentage_of_total_polyester_content_tolerance_value` float NOT NULL,
  `uom_of_percentage_of_total_polyester_content` varchar(10) NOT NULL,
  `percentage_of_total_other_fiber_content_tolerance_value` float NOT NULL,
  `uom_of_percentage_of_total_other_fiber_content` varchar(10) NOT NULL,
  `percentage_of_warp_cotton_content_tolerance_value` float NOT NULL,
  `uom_of_percentage_of_warp_cotton_content` varchar(10) NOT NULL,
  `percentage_of_warp_polyester_content_tolerance_value` float NOT NULL,
  `uom_of_percentage_of_warp_polyester_content` varchar(10) NOT NULL,
  `percentage_of_warp_other_fiber_content_tolerance_value` float NOT NULL,
  `uom_of_percentage_of_warp_other_fiber_content` varchar(10) DEFAULT NULL,
  `percentage_of_weft_polyester_content_tolerance_value` float DEFAULT NULL,
  `uom_of_percentage_of_weft_polyester_content` varchar(5) DEFAULT NULL,
  `percentage_of_weft_other_fiber_content_tolerance_value` float DEFAULT NULL,
  `uom_of_percentage_of_weft_other_fiber_content` varchar(10) DEFAULT NULL,
  `seam_slippage_resistance_in_warp_tolerance_value` float DEFAULT NULL,
  `uom_of_seam_slippage_resistance_in_warp` varchar(10) DEFAULT NULL,
  `seam_slippage_resistance_in_weft_tolerance_value` float DEFAULT NULL,
  `uom_of_seam_slippage_resistance_in_weft` varchar(10) DEFAULT NULL,
  `ph_value_tolerance_value` float DEFAULT NULL,
  `uom_of_ph_value` varchar(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `recording_person_id` varchar(20) DEFAULT NULL,
  `recording_person_name` varchar(20) DEFAULT NULL,
  `recording_time` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qc_result_for_finishing_process
-- ----------------------------
INSERT INTO `qc_result_for_finishing_process` VALUES ('7', '1', '1', '1', '1', '1', '1', null, null, null, null, null, null, null, null, null, null, '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '11', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '11', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '11', '1', '1', '1', '1', '1', '11', '1', '1', '11', '1', '11', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '11', '11', '1', '1', '11', '1', '11', '1', '1', '1', '1', '1', '1', '1', '1', '11', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', null, null, '', '', '2020-11-17 13:55:42');
INSERT INTO `qc_result_for_finishing_process` VALUES ('8', '1', '1', '1', '1', '1', '1', null, null, null, null, null, null, null, null, null, null, '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '11', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '11', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '11', '1', '1', '1', '1', '1', '11', '1', '1', '11', '1', '11', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '11', '11', '1', '1', '11', '1', '11', '1', '1', '1', '1', '1', '1', '1', '1', '11', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', null, null, 'Iftekhar', 'Iftekhar', '2020-11-17 13:56:43');

-- ----------------------------
-- Table structure for `qc_result_for_mercerize_process`
-- ----------------------------
DROP TABLE IF EXISTS `qc_result_for_mercerize_process`;
CREATE TABLE `qc_result_for_mercerize_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) DEFAULT NULL,
  `version_number` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `finish_width_in_inch` double DEFAULT NULL,
  `standard_for_which_process` varchar(50) DEFAULT NULL,
  `date` date NOT NULL,
  `before_trolley_number_or_batcher_number` double NOT NULL,
  `after_trolley_number_or_batcher_number` double NOT NULL,
  `before_fabric_width_in_inch` double NOT NULL,
  `process_fabric_width_inch` double NOT NULL,
  `received_quantity_in_meter` double NOT NULL,
  `short_or_excess_in_percentage` double NOT NULL,
  `total_quantity_in_meter` double NOT NULL,
  `total_short_or_excess_in_percentage` double NOT NULL,
  `machine_name` varchar(50) NOT NULL,
  `absorbency_value_in_left_side_of_fabric` double NOT NULL,
  `absorbency_value_in_center_of_fabric` double NOT NULL,
  `absorbency_value_in_right_side_of_fabric` double NOT NULL,
  `uom_of_absorbency_value` varchar(20) DEFAULT NULL,
  `sizing_value_in_left_side_of_fabric` double NOT NULL,
  `sizing_value_in_center_of_fabric` double NOT NULL,
  `sizing_value_in_right_side_of_fabric` double NOT NULL,
  `uom_of_sizing` varchar(20) DEFAULT NULL,
  `whiteness_value_in_left_side_of_fabric` double NOT NULL,
  `whiteness_value_in_center_of_fabric` double NOT NULL,
  `whiteness_value_in_right_side_of_fabric` double NOT NULL,
  `uom_of_whiteness` varchar(20) DEFAULT NULL,
  `ph_value_in_left_side_of_fabric` double NOT NULL,
  `ph_value_value_in_center_of_fabric` double NOT NULL,
  `ph_value_value_in_right_side_of_fabric` double NOT NULL,
  `uom_of_ph` varchar(20) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qc_result_for_mercerize_process
-- ----------------------------
INSERT INTO `qc_result_for_mercerize_process` VALUES ('5', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'Mercerize', '2020-11-26', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'OK', 'ok', 'Iftekhar', 'Iftekhar', '2020-11-26 12:49:31');

-- ----------------------------
-- Table structure for `qc_result_for_mercerize_process_bkup_26_11_2020`
-- ----------------------------
DROP TABLE IF EXISTS `qc_result_for_mercerize_process_bkup_26_11_2020`;
CREATE TABLE `qc_result_for_mercerize_process_bkup_26_11_2020` (
  `id` int(10) unsigned NOT NULL,
  `pp_number` varchar(100) DEFAULT NULL,
  `version_number` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `finish_width_in_inch` double DEFAULT NULL,
  `standard_for_which_process` varchar(50) DEFAULT NULL,
  `date` date NOT NULL,
  `before_trolley_number_or_batcher_number` double NOT NULL,
  `after_trolley_number_or_batcher_number` double NOT NULL,
  `before_fabric_width_in_inch` double NOT NULL,
  `process_fabric_width_inch` double NOT NULL,
  `received_quantity_in_meter` double NOT NULL,
  `short_or_excess_in_percentage` double NOT NULL,
  `total_quantity_in_meter` double NOT NULL,
  `total_short_or_excess_in_percentage` double NOT NULL,
  `machine_name` varchar(50) NOT NULL,
  `absorbency_value_in_left_side_of_fabric` double NOT NULL,
  `absorbency_value_in_center_of_fabric` double NOT NULL,
  `absorbency_value_in_right_side_of_fabric` double NOT NULL,
  `uom_of_absorbency_value` varchar(20) DEFAULT NULL,
  `sizing_value_in_left_side_of_fabric` double NOT NULL,
  `sizing_value_in_center_of_fabric` double NOT NULL,
  `sizing_value_in_right_side_of_fabric` double NOT NULL,
  `uom_of_sizing` varchar(20) DEFAULT NULL,
  `whiteness_value_in_left_side_of_fabric` double NOT NULL,
  `whiteness_value_in_center_of_fabric` double NOT NULL,
  `whiteness_value_in_right_side_of_fabric` double NOT NULL,
  `uom_of_whiteness` varchar(20) DEFAULT NULL,
  `ph_value_in_left_side_of_fabric` double NOT NULL,
  `ph_value_value_in_center_of_fabric` double NOT NULL,
  `ph_value_value_in_right_side_of_fabric` double NOT NULL,
  `uom_of_ph` varchar(20) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qc_result_for_mercerize_process_bkup_26_11_2020
-- ----------------------------

-- ----------------------------
-- Table structure for `qc_result_for_printing_process`
-- ----------------------------
DROP TABLE IF EXISTS `qc_result_for_printing_process`;
CREATE TABLE `qc_result_for_printing_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) DEFAULT NULL,
  `version_number` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `finish_width_in_inch` double DEFAULT NULL,
  `standard_for_which_process` varchar(100) DEFAULT NULL,
  `date` datetime NOT NULL,
  `before_trolley_number_or_batcher_number` double NOT NULL,
  `after_trolley_number_or_batcher_number` double NOT NULL,
  `before_fabric_width_in_inch` double NOT NULL,
  `process_fabric_width_inch` double NOT NULL,
  `received_quantity_in_meter` double NOT NULL,
  `short_or_excess_in_percentage` double NOT NULL,
  `total_quantity_in_meter` double NOT NULL,
  `total_short_or_excess_in_percentage` double NOT NULL,
  `machine_name` varchar(50) NOT NULL,
  `rubbing_dry_value` double DEFAULT NULL,
  `uom_of_rubbing_dry` varchar(20) DEFAULT NULL,
  `rubbing_wet_value` double DEFAULT NULL,
  `uom_of_rubbing_wet` varchar(20) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `recording_person_id` varchar(50) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qc_result_for_printing_process
-- ----------------------------

-- ----------------------------
-- Table structure for `qc_result_for_raising_process`
-- ----------------------------
DROP TABLE IF EXISTS `qc_result_for_raising_process`;
CREATE TABLE `qc_result_for_raising_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) DEFAULT NULL,
  `version_number` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `finish_width_in_inch` double DEFAULT NULL,
  `standard_for_which_process` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `before_trolley_number_or_batcher_number` double DEFAULT NULL,
  `after_trolley_number_or_batcher_number` double DEFAULT NULL,
  `trf_number` double DEFAULT NULL,
  `process_fabric_width_inch` double DEFAULT NULL,
  `process_qty` double DEFAULT NULL,
  `short_or_excess_in_percentage` double DEFAULT NULL,
  `total_quantity_in_meter` double DEFAULT NULL,
  `total_short_or_excess_in_percentage` double DEFAULT NULL,
  `machine_name` double DEFAULT NULL,
  `face_back` varchar(20) NOT NULL,
  `warp_yarn_tensile_properties_tolerance_value` double DEFAULT NULL,
  `uom_of_warp_yarn_tensile_properties` varchar(20) DEFAULT NULL,
  `weft_yarn_tensile_properties_tolerance_value` double DEFAULT NULL,
  `uom_of_weft_yarn_tensile_properties` varchar(20) DEFAULT NULL,
  `warp_yarn_tear_force_tolerance_value` double DEFAULT NULL,
  `uom_of_warp_yarn_tear_force` varchar(10) DEFAULT NULL,
  `weft_yarn_tear_force_tolerance_value` double DEFAULT NULL,
  `uom_of_weft_yarn_tear_force` varchar(10) DEFAULT NULL,
  `hand_feel` varchar(10) NOT NULL,
  `raising_quality` varchar(10) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qc_result_for_raising_process
-- ----------------------------
INSERT INTO `qc_result_for_raising_process` VALUES ('1', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', null, null, null, null, null, null, null, null, null, null, null, '', '1', 'N', '1', 'N', '1', 'N', '1', 'N', '', '', null, null, '6', 'hriday', '2020-11-14 17:30:55');
INSERT INTO `qc_result_for_raising_process` VALUES ('2', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'Steaming', '0000-00-00 00:00:00', '1', '1', '1', '1', '1', '1', '1', '1', '1', '', '1', '1', '1', '1', '1', '1', '1', '1', 'OK', 'OK', 'OK', 'ok', 'abcd', 'abcd', '2020-11-22 12:28:36');
INSERT INTO `qc_result_for_raising_process` VALUES ('3', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'Steaming', '0000-00-00 00:00:00', '1', '1', '1', '1', '1', '1', '1', '1', '1', '', '1', '1', '1', '1', '1', '1', '1', '1', 'Not OK', 'OK', 'Not OK', 'ok', 'abcd', 'abcd', '2020-11-22 12:30:42');
INSERT INTO `qc_result_for_raising_process` VALUES ('4', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'Steaming', '0000-00-00 00:00:00', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'Not OK', 'OK', 'OK', 'a', 'abcd', 'abcd', '2020-11-22 15:27:41');
INSERT INTO `qc_result_for_raising_process` VALUES ('5', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'Raising', '0000-00-00 00:00:00', '11', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'OK', 'OK', 'OK', 'OK', 'abcd', 'abcd', '2020-11-26 12:51:57');

-- ----------------------------
-- Table structure for `qc_result_for_raising_process_bkup_26_11_2020`
-- ----------------------------
DROP TABLE IF EXISTS `qc_result_for_raising_process_bkup_26_11_2020`;
CREATE TABLE `qc_result_for_raising_process_bkup_26_11_2020` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) DEFAULT NULL,
  `version_number` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `finish_width_in_inch` double DEFAULT NULL,
  `standard_for_which_process` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `before_trolley_number_or_batcher_number` double DEFAULT NULL,
  `after_trolley_number_or_batcher_number` double DEFAULT NULL,
  `trf_number` double DEFAULT NULL,
  `process_fabric_width_inch` double DEFAULT NULL,
  `process_qty` double DEFAULT NULL,
  `short_or_excess_in_percentage` double DEFAULT NULL,
  `total_quantity_in_meter` double DEFAULT NULL,
  `total_short_or_excess_in_percentage` double DEFAULT NULL,
  `machine_name` double DEFAULT NULL,
  `face_or_back` varchar(20) DEFAULT NULL,
  `warp_yarn_tensile_properties_tolerance_value` double DEFAULT NULL,
  `uom_of_warp_yarn_tensile_properties` varchar(20) DEFAULT NULL,
  `weft_yarn_tensile_properties_tolerance_value` double DEFAULT NULL,
  `uom_of_weft_yarn_tensile_properties` varchar(20) DEFAULT NULL,
  `warp_yarn_tear_force_tolerance_value` double DEFAULT NULL,
  `uom_of_warp_yarn_tear_force` varchar(10) DEFAULT NULL,
  `weft_yarn_tear_force_tolerance_value` double DEFAULT NULL,
  `uom_of_weft_yarn_tear_force` varchar(10) DEFAULT NULL,
  `hand_feel` varchar(10) DEFAULT NULL,
  `ready_for_raising_quality` varchar(10) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qc_result_for_raising_process_bkup_26_11_2020
-- ----------------------------
INSERT INTO `qc_result_for_raising_process_bkup_26_11_2020` VALUES ('1', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', null, null, null, null, null, null, null, null, null, null, null, null, '1', 'N', '1', 'N', '1', 'N', '1', 'N', null, null, null, null, '6', 'hriday', '2020-11-14 17:30:55');

-- ----------------------------
-- Table structure for `qc_result_for_ready_for_dying_process`
-- ----------------------------
DROP TABLE IF EXISTS `qc_result_for_ready_for_dying_process`;
CREATE TABLE `qc_result_for_ready_for_dying_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) DEFAULT NULL,
  `version_number` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `finish_width_in_inch` double DEFAULT NULL,
  `standard_for_which_process` varchar(100) DEFAULT NULL,
  `date` datetime NOT NULL,
  `before_trolley_number_or_batcher_number` double NOT NULL,
  `after_trolley_number_or_batcher_number` double NOT NULL,
  `before_fabric_width_in_inch` double NOT NULL,
  `process_fabric_width_inch` double NOT NULL,
  `received_quantity_in_meter` double NOT NULL,
  `short_or_excess_in_percentage` double NOT NULL,
  `total_quantity_in_meter` double NOT NULL,
  `total_short_or_excess_in_percentage` double NOT NULL,
  `machine_name` varchar(50) NOT NULL,
  `whiteness_left_value` double NOT NULL,
  `whiteness_center_value` double NOT NULL,
  `bowing_and_skew_value` double NOT NULL,
  `whiteness_right_value` double NOT NULL,
  `uom_of_whiteness` varchar(20) NOT NULL,
  `uom_of_bowing_and_skew` varchar(20) NOT NULL,
  `ph_left_value` double NOT NULL,
  `ph_center_value` double NOT NULL,
  `ph_right_value` double NOT NULL,
  `uom_of_ph` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `recording_person_id` varchar(50) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qc_result_for_ready_for_dying_process
-- ----------------------------
INSERT INTO `qc_result_for_ready_for_dying_process` VALUES ('3', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'Printing', '2020-11-30 00:00:00', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'OK', '1', 'iftekhar', 'iftekhar', '2020-11-30 18:12:58');
INSERT INTO `qc_result_for_ready_for_dying_process` VALUES ('4', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'Dying', '2020-12-01 00:00:00', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'OK', 'Ok', 'iftekhar', 'iftekhar', '2020-12-01 10:30:11');

-- ----------------------------
-- Table structure for `qc_result_for_ready_for_mercerize_process`
-- ----------------------------
DROP TABLE IF EXISTS `qc_result_for_ready_for_mercerize_process`;
CREATE TABLE `qc_result_for_ready_for_mercerize_process` (
  `id` int(10) unsigned NOT NULL DEFAULT 0,
  `pp_number` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `version_number` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `customer_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `color` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `finish_width_in_inch` double DEFAULT NULL,
  `standard_for_which_process` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `date` date DEFAULT NULL,
  `before_trolley_number_or_batcher_number` varchar(50) NOT NULL,
  `after_trolley_number_or_batcher_number` varchar(50) NOT NULL,
  `fabric_width_in_inch` double NOT NULL,
  `received_quantity_in_meter` double NOT NULL,
  `short_or_excess_in_percentage` double NOT NULL,
  `total_quantity_in_meter` double NOT NULL,
  `total_short_or_excess_in_percentage` double NOT NULL,
  `machine_name` varchar(50) NOT NULL,
  `whiteness_value_in_left_side_of_fabric` double NOT NULL,
  `whiteness_value_in_center_of_fabric` double NOT NULL,
  `whiteness_value_in_right_side_of_fabric` double NOT NULL,
  `uom_of_whiteness` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `bowing_and_skew_value` double DEFAULT NULL,
  `uom_of_bowing_and_skew` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `Ph_value_in_left_side_of_fabric` double NOT NULL,
  `Ph_value_in_center_of_fabric` double NOT NULL,
  `Ph_value_in_right_of_fabric` double NOT NULL,
  `uom_of_ph` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `recording_person_id` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `recording_person_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of qc_result_for_ready_for_mercerize_process
-- ----------------------------
INSERT INTO `qc_result_for_ready_for_mercerize_process` VALUES ('1', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'select', null, '', '', '0', '0', '0', '0', '0', '', '0', '0', '0', 'Berger', '1', '%', '0', '0', '0', 'Celcius', '', '', '6', 'hriday', '2020-11-13 13:40:49');
INSERT INTO `qc_result_for_ready_for_mercerize_process` VALUES ('2', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'select', null, '', '', '0', '0', '0', '0', '0', '', '0', '0', '0', 'Berger', '1', '%', '0', '0', '0', 'Celcius', '', '', '6', 'hriday', '2020-11-13 14:40:58');
INSERT INTO `qc_result_for_ready_for_mercerize_process` VALUES ('3', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'select', null, '', '', '0', '0', '0', '0', '0', '', '0', '0', '0', 'Berger', '1', '%', '0', '0', '0', 'Celcius', '', '', '6', 'hriday', '2020-11-14 12:20:31');
INSERT INTO `qc_result_for_ready_for_mercerize_process` VALUES ('4', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'select', null, '', '', '0', '0', '0', '0', '0', '', '0', '0', '0', 'Berger', '1', '%', '0', '0', '0', 'Celcius', '', '', '6', 'hriday', '2020-11-14 16:32:54');
INSERT INTO `qc_result_for_ready_for_mercerize_process` VALUES ('0', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'Ready For Mercerize', '2020-11-16', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'OK', 'ok', '6', 'hriday', '2020-11-16 15:59:50');
INSERT INTO `qc_result_for_ready_for_mercerize_process` VALUES ('0', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'Ready For Mercerize', '2020-11-17', '2', '2', '1', '2', '2', '2', '2', 'Three Roller4', '1', '2', '2', 'b', '1', 'b', '1', '1', '1', 'b', 'OK', 'OK', '6', 'hriday', '2020-11-17 11:51:36');

-- ----------------------------
-- Table structure for `qc_result_for_ready_for_printing_process`
-- ----------------------------
DROP TABLE IF EXISTS `qc_result_for_ready_for_printing_process`;
CREATE TABLE `qc_result_for_ready_for_printing_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) DEFAULT NULL,
  `version_number` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `finish_width_in_inch` double DEFAULT NULL,
  `standard_for_which_process` varchar(100) DEFAULT NULL,
  `date` datetime NOT NULL,
  `before_trolley_number_or_batcher_number` double NOT NULL,
  `after_trolley_number_or_batcher_number` double NOT NULL,
  `before_fabric_width_in_inch` double NOT NULL,
  `process_fabric_width_inch` double NOT NULL,
  `received_quantity_in_meter` double NOT NULL,
  `short_or_excess_in_percentage` double NOT NULL,
  `total_quantity_in_meter` double NOT NULL,
  `total_short_or_excess_in_percentage` double NOT NULL,
  `machine_name` varchar(50) NOT NULL,
  `whiteness_left_value` double NOT NULL,
  `whiteness_center_value` double NOT NULL,
  `bowing_and_skew_value` double NOT NULL,
  `whiteness_right_value` double NOT NULL,
  `uom_of_whiteness` varchar(20) NOT NULL,
  `uom_of_bowing_and_skew` varchar(20) NOT NULL,
  `ph_left_value` double NOT NULL,
  `ph_center_value` double NOT NULL,
  `ph_right_value` double NOT NULL,
  `uom_of_ph` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `recording_person_id` varchar(50) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qc_result_for_ready_for_printing_process
-- ----------------------------
INSERT INTO `qc_result_for_ready_for_printing_process` VALUES ('3', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'Printing', '2020-11-30 00:00:00', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'OK', '1', 'iftekhar', 'iftekhar', '2020-11-30 18:12:58');

-- ----------------------------
-- Table structure for `qc_result_for_ready_for_raising_process`
-- ----------------------------
DROP TABLE IF EXISTS `qc_result_for_ready_for_raising_process`;
CREATE TABLE `qc_result_for_ready_for_raising_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) DEFAULT NULL,
  `version_number` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `finish_width_in_inch` double DEFAULT NULL,
  `standard_for_which_process` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `before_trolley_number_or_batcher_number` double NOT NULL,
  `after_trolley_number_or_batcher_number` double NOT NULL,
  `trf_number` double NOT NULL,
  `process_fabric_width_inch` double NOT NULL,
  `process_qty` double NOT NULL,
  `short_or_excess_in_percentage` double NOT NULL,
  `total_quantity_in_meter` double NOT NULL,
  `total_short_or_excess_in_percentage` double NOT NULL,
  `machine_name` varchar(50) NOT NULL,
  `face_or_back` varchar(20) DEFAULT NULL,
  `warp_yarn_tensile_properties_tolerance_value` double DEFAULT NULL,
  `uom_of_warp_yarn_tensile_properties` varchar(20) DEFAULT NULL,
  `warp_yarn_tensile_properties_value` double DEFAULT NULL,
  `uom_of_weft_yarn_tensile_properties` varchar(20) DEFAULT NULL,
  `warp_yarn_tear_force_tolerance_value` double DEFAULT NULL,
  `uom_of_warp_yarn_tear_force` varchar(10) DEFAULT NULL,
  `uom_of_weft_yarn_tear_force` varchar(10) DEFAULT NULL,
  `hand_feel` varchar(10) DEFAULT NULL,
  `ready_for_raising_quality` varchar(10) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qc_result_for_ready_for_raising_process
-- ----------------------------
INSERT INTO `qc_result_for_ready_for_raising_process` VALUES ('2', '23222', 'Pillow', 'IKEA', 'Red', '60', 'Ready For Raising', '2020-11-16', '1', '1', '1', '1', '1', '1', '1', '1', '1', null, '1', '1', '1', '1', '1', '1', '1', null, null, 'OK', '1', '', '', '2020-11-16 15:30:52');
INSERT INTO `qc_result_for_ready_for_raising_process` VALUES ('3', '23222', 'Pillow', 'IKEA', 'Red', '60', 'Ready For Raising', '2020-11-16', '1', '1', '1', '1', '1', '1', '1', '1', '1', null, '1', '1', '1', '1', '1', '1', '1', null, null, 'OK', '1', 'Iftekhar', 'Iftekhar', '2020-11-16 15:31:49');
INSERT INTO `qc_result_for_ready_for_raising_process` VALUES ('4', '23222', 'Pillow', 'IKEA', 'Red', '60', 'Ready For Raising', '2020-11-16', '2', '2', '2', '2', '2', '2', '2', '2', '2', null, '2', '2', '2', '2', '2', '2', '2', null, null, 'OK', 'ok', 'Iftekhar', 'Iftekhar', '2020-11-16 15:35:56');
INSERT INTO `qc_result_for_ready_for_raising_process` VALUES ('5', '23222', 'Pillow', 'IKEA', 'Red', '60', 'Ready For Raising', '2020-11-17', '1', '1', '1', '1', '1', '1', '1', '1', '1', null, '1', '1', '1', '1', '1', '11', '1', null, null, 'OK', 'ok', 'Iftekhar', 'Iftekhar', '2020-11-16 16:00:20');
INSERT INTO `qc_result_for_ready_for_raising_process` VALUES ('6', '23222', 'Pillow', 'IKEA', 'Red', '60', 'Ready For Raising', '2020-11-21', '1', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', 'OK', 'OK', 'OK', 'ok', '6', 'hriday', '2020-11-21 16:33:28');

-- ----------------------------
-- Table structure for `qc_result_for_sanforizing_process`
-- ----------------------------
DROP TABLE IF EXISTS `qc_result_for_sanforizing_process`;
CREATE TABLE `qc_result_for_sanforizing_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) DEFAULT NULL,
  `version_number` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `finish_width_in_inch` double DEFAULT NULL,
  `standard_for_which_process` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `before_trolley_number_or_batcher_number` double DEFAULT NULL,
  `after_trolley_number_or_batcher_number` double DEFAULT NULL,
  `trf_number` double DEFAULT NULL,
  `process_fabric_width_inch` double DEFAULT NULL,
  `process_qty` double DEFAULT NULL,
  `short_or_excess_in_percentage` double DEFAULT NULL,
  `total_quantity_in_meter` double DEFAULT NULL,
  `total_short_or_excess_in_percentage` double DEFAULT NULL,
  `machine_name` varchar(50) DEFAULT NULL,
  `face_or_back` varchar(20) DEFAULT NULL,
  `color_fastness_to_rubbing_dry_value` double DEFAULT NULL,
  `uom_of_color_fastness_to_rubbing_dry_value` varchar(20) DEFAULT NULL,
  `color_fastness_to_rubbing_wet_value` double DEFAULT NULL,
  `uom_of_color_fastness_to_rubbing_wet` varchar(20) DEFAULT NULL,
  `dimensional_stability_to_warp_washing_before_iron_value` double DEFAULT NULL,
  `uom_of_dimensional_stability_to_warp_washing_before_iron` varchar(20) DEFAULT NULL,
  `dimensional_stability_to_weft_washing_before_iron_value` double DEFAULT NULL,
  `uom_of_dimensional_stability_to_weft_washing_before_iron` varchar(20) DEFAULT NULL,
  `dimensional_stability_to_warp_washing_after_iron_value` double DEFAULT NULL,
  `uom_of_dimensional_stability_to_warp_washing_after_iron` varchar(20) DEFAULT NULL,
  `dimensional_stability_to_weft_washing_after_iron_value` double DEFAULT NULL,
  `uom_of_dimensional_stability_to_weft_washing_after_iron` varchar(20) DEFAULT NULL,
  `change_in_warp_for_dry_cleaning_value` double DEFAULT NULL,
  `uom_of_change_in_warp_for_dry_cleaning` varchar(20) DEFAULT NULL,
  `change_in_weft_for_dry_cleaning_value` double DEFAULT NULL,
  `uom_of_change_in_weft_for_dry_cleaning` varchar(20) DEFAULT NULL,
  `warp_yarn_count_value` double DEFAULT NULL,
  `uom_of_warp_yarn_count_properties` varchar(20) DEFAULT NULL,
  `mass_per_unit_per_area_value` double DEFAULT NULL,
  `uom_of_mass_per_unit_per_area_properties` varchar(20) DEFAULT NULL,
  `no_of_threads_in_warp_value` double DEFAULT NULL,
  `uom_of_no_of_threads_in_warp_properties` varchar(20) DEFAULT NULL,
  `no_of_threads_in_weft_value` double DEFAULT NULL,
  `uom_of_no_of_threads_in_weft_properties` varchar(20) DEFAULT NULL,
  `surface_fuzzing_and_pilling_value` double DEFAULT NULL,
  `uom_of_surface_fuzzing_and_pilling` varchar(20) DEFAULT NULL,
  `warp_yarn_tensile_properties_value` double DEFAULT NULL,
  `uom_of_warp_yarn_tensile_properties` varchar(20) DEFAULT NULL,
  `warp_yarn_tear_force_value` double DEFAULT NULL,
  `uom_of_warp_yarn_tear_force_properties` varchar(20) DEFAULT NULL,
  `weft_yarn_tear_force_value` double DEFAULT NULL,
  `uom_of_weft_yarn_tear_force_properties` varchar(20) DEFAULT NULL,
  `warp_yarn_seam_value` double DEFAULT NULL,
  `uom_of_warp_yarn_seam` varchar(20) DEFAULT NULL,
  `weft_yarn_seam_value` double DEFAULT NULL,
  `uom_of_weft_yarn_seam_properties` varchar(20) DEFAULT NULL,
  `seam_slippage_resistance_in_warp_value` double DEFAULT NULL,
  `uom_of_seam_slippage_resistance_in_warp_properties` varchar(20) DEFAULT NULL,
  `seam_slippage_resistance_in_weft_value` varchar(20) DEFAULT NULL,
  `uom_of_seam_slippage_resistance_in_weft` varchar(20) DEFAULT NULL,
  `seam_slippage_resistance_in_warp_mm_value` varchar(20) DEFAULT NULL,
  `uom_of_seam_slippage_resistance_in_warp_mm` varchar(20) DEFAULT NULL,
  `seam_slippage_resistance_in_weft_mm_value` varchar(20) DEFAULT NULL,
  `uom_of_seam_slippage_resistance_in_weft_mm_properties` varchar(20) DEFAULT NULL,
  `hand_feel` varchar(10) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qc_result_for_sanforizing_process
-- ----------------------------
INSERT INTO `qc_result_for_sanforizing_process` VALUES ('6', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'Sanforizing', '2020-11-16', '1', '1', '1', '1', '1', '1', '1', '1', 'Three Roller', null, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', null, 'ok', 'ok', '', '', '2020-11-16 13:38:33');
INSERT INTO `qc_result_for_sanforizing_process` VALUES ('7', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'Sanforizing', '2020-11-16', '1', '1', '1', '1', '1', '1', '1', '1', 'Three Roller', null, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', null, 'ok', 'ok', 'Iftekhar', 'Iftekhar', '2020-11-16 13:40:23');
INSERT INTO `qc_result_for_sanforizing_process` VALUES ('8', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'Sanforizing', '2020-11-16', '2', '2', '2', '2', '22', '2', '2', '2', 'Three Roller', null, '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '22', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', null, 'OK', '2', '6', 'hriday', '2020-11-16 15:10:20');
INSERT INTO `qc_result_for_sanforizing_process` VALUES ('9', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'Sanforizing', '2020-11-17', '2', '2', '1', '1', '1', '1', '1', '1', '1', null, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', null, 'OK', 'Ok', '6', 'hriday', '2020-11-17 11:06:48');
INSERT INTO `qc_result_for_sanforizing_process` VALUES ('10', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'Sanforizing', '2020-11-21', '1', '1', '11', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1111', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'OK', 'OK', 'ok', '6', 'hriday', '2020-11-21 16:59:57');

-- ----------------------------
-- Table structure for `qc_result_for_scouring_bleaching_process`
-- ----------------------------
DROP TABLE IF EXISTS `qc_result_for_scouring_bleaching_process`;
CREATE TABLE `qc_result_for_scouring_bleaching_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) NOT NULL DEFAULT '',
  `version_number` varchar(100) NOT NULL DEFAULT '',
  `customer_name` varchar(100) NOT NULL DEFAULT '',
  `color` varchar(50) NOT NULL DEFAULT '',
  `finish_width_in_inch` double DEFAULT NULL,
  `standard_for_which_process` varchar(50) NOT NULL DEFAULT '',
  `date` datetime NOT NULL,
  `before_trolley_number_or_batcher_number` double NOT NULL,
  `after_trolley_number_or_batcher_number` double NOT NULL,
  `before_fabric_width_in_inch` double NOT NULL,
  `process_fabric_width_inch` double NOT NULL,
  `received_quantity_in_meter` double NOT NULL,
  `short_or_excess_in_percentage` double NOT NULL,
  `total_quantity_in_meter` double NOT NULL,
  `total_short_or_excess_in_percentage` double NOT NULL,
  `machine_name` varchar(50) NOT NULL,
  `absorbency_left_value` double NOT NULL,
  `absorbency_center_value` double NOT NULL,
  `absorbency_right_value` double NOT NULL,
  `uom_of_absorbency` varchar(20) NOT NULL DEFAULT '',
  `residual_sizing_material_left_value` double NOT NULL,
  `residual_sizing_material_center_value` double NOT NULL,
  `residual_sizing_material_right_value` double NOT NULL,
  `uom_of_residual_sizing_material` varchar(20) NOT NULL DEFAULT '',
  `whiteness_left_value` double NOT NULL,
  `whiteness_center_value` double NOT NULL,
  `whiteness_right_value` double NOT NULL,
  `uom_of_whiteness` varchar(20) NOT NULL,
  `pilling_iso_12945_2_left_value` double NOT NULL,
  `pilling_iso_12945_2_center_value` double NOT NULL,
  `pilling_iso_12945_2_right_value` double NOT NULL,
  `uom_of_pilling_iso_12945_2` varchar(20) NOT NULL DEFAULT '',
  `ph_left_value` double NOT NULL,
  `ph_center_value` double NOT NULL,
  `ph_right_value` double NOT NULL,
  `uom_of_ph` varchar(20) NOT NULL DEFAULT '',
  `status` varchar(10) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qc_result_for_scouring_bleaching_process
-- ----------------------------
INSERT INTO `qc_result_for_scouring_bleaching_process` VALUES ('3', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'Scouring Bleaching', '2020-12-01 00:00:00', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'OK', 'OK', 'iftekhar', 'iftekhar', '2020-12-01 12:07:20');

-- ----------------------------
-- Table structure for `qc_result_for_scouring_process`
-- ----------------------------
DROP TABLE IF EXISTS `qc_result_for_scouring_process`;
CREATE TABLE `qc_result_for_scouring_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) NOT NULL DEFAULT '',
  `version_number` varchar(100) NOT NULL DEFAULT '',
  `customer_name` varchar(100) NOT NULL DEFAULT '',
  `color` varchar(50) NOT NULL DEFAULT '',
  `finish_width_in_inch` double DEFAULT NULL,
  `standard_for_which_process` varchar(50) NOT NULL DEFAULT '',
  `date` datetime NOT NULL,
  `before_trolley_number_or_batcher_number` double NOT NULL,
  `after_trolley_number_or_batcher_number` double NOT NULL,
  `before_fabric_width_in_inch` double NOT NULL,
  `process_fabric_width_inch` double NOT NULL,
  `received_quantity_in_meter` double NOT NULL,
  `short_or_excess_in_percentage` double NOT NULL,
  `total_quantity_in_meter` double NOT NULL,
  `total_short_or_excess_in_percentage` double NOT NULL,
  `machine_name` varchar(50) NOT NULL,
  `absorbency_left_value` double NOT NULL,
  `absorbency_center_value` double NOT NULL,
  `absorbency_right_value` double NOT NULL,
  `uom_of_absorbency` varchar(20) NOT NULL DEFAULT '',
  `residual_sizing_material_left_value` double NOT NULL,
  `residual_sizing_material_center_value` double NOT NULL,
  `residual_sizing_material_right_value` double NOT NULL,
  `uom_of_residual_sizing_material` varchar(20) NOT NULL DEFAULT '',
  `pilling_iso_12945_2_left_value` double NOT NULL,
  `pilling_iso_12945_2_center_value` double NOT NULL,
  `pilling_iso_12945_2_right_value` double NOT NULL,
  `uom_of_pilling_iso_12945_2` varchar(20) NOT NULL DEFAULT '',
  `ph_left_value` double NOT NULL,
  `ph_center_value` double NOT NULL,
  `ph_right_value` double NOT NULL,
  `uom_of_ph` varchar(20) DEFAULT '',
  `status` varchar(10) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qc_result_for_scouring_process
-- ----------------------------
INSERT INTO `qc_result_for_scouring_process` VALUES ('3', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'Scouring', '2020-12-01 00:00:00', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'OK', 'OK', 'iftekhar', 'iftekhar', '2020-12-01 11:57:34');

-- ----------------------------
-- Table structure for `qc_result_for_singe_and_desize_process`
-- ----------------------------
DROP TABLE IF EXISTS `qc_result_for_singe_and_desize_process`;
CREATE TABLE `qc_result_for_singe_and_desize_process` (
  `id` int(10) unsigned NOT NULL DEFAULT 0,
  `pp_number` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `version_number` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `customer_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `color` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `finish_width_in_inch` double DEFAULT NULL,
  `standard_for_which_process` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `date` date DEFAULT NULL,
  `batcher_number` varchar(50) NOT NULL,
  `fabric_width_in_inch` double NOT NULL,
  `received_quantity_in_meter` double NOT NULL,
  `short_or_excess_in_percentage` double NOT NULL,
  `total_quantity_in_meter` double NOT NULL,
  `total_short_or_excess_in_percentage` double NOT NULL,
  `machine_name` varchar(50) NOT NULL,
  `flame_intensity_value` double DEFAULT NULL,
  `uom_of_flame_intensity` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `uom_of_speed` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `bath_temperature` double DEFAULT NULL,
  `uom_of_bath_temperature` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `ph` double DEFAULT NULL,
  `uom_of_ph` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `recording_person_id` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `recording_person_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of qc_result_for_singe_and_desize_process
-- ----------------------------
INSERT INTO `qc_result_for_singe_and_desize_process` VALUES ('1', 'select', 'select', 'select', 'select', '58', 'select', null, '', '0', '0', '0', '0', '0', '', '10', 'mbar', '10', 'Meter/Minute', '10', 'Celcius', '10', 'Numeric Value', '', '', '2020-11-11 04:57:37');
INSERT INTO `qc_result_for_singe_and_desize_process` VALUES ('2', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '58', 'select', null, '', '0', '0', '0', '0', '0', '', '1', 'mbar', '1', 'Meter/Minute', '1', 'Celcius', '1', 'Numeric Value', '6', 'hriday', '2020-11-13 13:25:13');
INSERT INTO `qc_result_for_singe_and_desize_process` VALUES ('0', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'Singe And Desize', '2020-11-16', '1', '1', '1', '1', '1', '1', 'Three Roller', '1', '1', '1', '1', '1', '1', '1', '1', '', '', '2020-11-16 13:01:54');
INSERT INTO `qc_result_for_singe_and_desize_process` VALUES ('0', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'Singe And Desize', '2020-11-16', '1', '1', '1', '1', '1', '1', 'Three Roller', '1', '1', '1', '1', '1', '1', '1', '1', 'Iftekhar', 'Iftekhar', '2020-11-16 13:03:09');
INSERT INTO `qc_result_for_singe_and_desize_process` VALUES ('0', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'Singe And Desize', '2020-11-16', '2', '2', '2', '2', '2', '2', 'Three Roller4', '2', '2', '2', '2', '2', '2', '22', '2', 'Iftekhar', 'Iftekhar', '2020-11-16 13:27:31');

-- ----------------------------
-- Table structure for `qc_result_for_steaming_process`
-- ----------------------------
DROP TABLE IF EXISTS `qc_result_for_steaming_process`;
CREATE TABLE `qc_result_for_steaming_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(100) DEFAULT NULL,
  `version_number` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `finish_width_in_inch` double DEFAULT NULL,
  `standard_for_which_process` varchar(100) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `before_trolley_number_or_batcher_number` double DEFAULT NULL,
  `after_trolley_number_or_batcher_number` double DEFAULT NULL,
  `process_fabric_width_inch` double DEFAULT NULL,
  `process_qty` double DEFAULT NULL,
  `short_or_excess_in_percentage` double DEFAULT NULL,
  `total_quantity_in_meter` double DEFAULT NULL,
  `total_short_or_excess_in_percentage` double DEFAULT NULL,
  `machine_name` varchar(50) DEFAULT NULL,
  `flame_intensity_value` double DEFAULT NULL,
  `uom_of_flame_intensity` varchar(20) DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `uom_of_speed` varchar(20) DEFAULT NULL,
  `bath_temperature` double DEFAULT NULL,
  `uom_of_bath_temperature` varchar(20) DEFAULT NULL,
  `ph` double DEFAULT NULL,
  `uom_of_ph` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qc_result_for_steaming_process
-- ----------------------------
INSERT INTO `qc_result_for_steaming_process` VALUES ('3', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '58', 'select', null, null, null, null, null, null, null, null, null, '1', 'mbar', '1', 'Meter/Minute', '1', 'Celcius', '1', 'Numeric Value', null, null, '6', 'hriday', '2020-11-13 14:37:55');

-- ----------------------------
-- Table structure for `qc_result_for_washing_process`
-- ----------------------------
DROP TABLE IF EXISTS `qc_result_for_washing_process`;
CREATE TABLE `qc_result_for_washing_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pp_number` varchar(50) NOT NULL DEFAULT '',
  `version_number` varchar(50) NOT NULL DEFAULT '',
  `customer_name` varchar(50) NOT NULL DEFAULT '',
  `color` varchar(50) NOT NULL DEFAULT '',
  `finish_width_in_inch` float DEFAULT NULL,
  `standard_for_which_process` varchar(50) DEFAULT NULL,
  `date` datetime NOT NULL,
  `before_trolley_number_or_batcher_number` float NOT NULL,
  `after_trolley_number_or_batcher_number` float NOT NULL,
  `trf_number` float NOT NULL,
  `process_fabric_width_inch` float NOT NULL,
  `process_qty` float NOT NULL,
  `short_or_excess_in_percentage` float NOT NULL,
  `total_quantity_in_meter` float NOT NULL,
  `total_short_or_excess_in_percentage` float NOT NULL,
  `machine_name` float NOT NULL,
  `cf_to_rubbing_dry_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_rubbing_dry` varchar(20) DEFAULT NULL,
  `cf_to_rubbing_wet_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_rubbing_wet` varchar(20) DEFAULT NULL,
  `cf_to_dry_cleaning_color_change_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_dry_cleaning_color_change` varchar(10) DEFAULT NULL,
  `cf_to_dry_cleaning_staining_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_dry_cleaning_staining` varchar(10) DEFAULT NULL,
  `cf_to_washing_color_change_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_washing_color_change` varchar(10) DEFAULT NULL,
  `cf_to_washing_staining_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_washing_staining` varchar(10) DEFAULT NULL,
  `cf_to_perspiration_acid_color_change_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_perspiration_acid_color_change` varchar(10) DEFAULT NULL,
  `cf_to_perspiration_acid_staining_value` float DEFAULT NULL,
  `uom_of_cf_to_perspiration_acid_staining` varchar(10) DEFAULT NULL,
  `cf_to_perspiration_alkali_color_change_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_perspiration_alkali_color_change` varchar(10) DEFAULT NULL,
  `cf_to_water_color_change_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_water_color_change` varchar(10) DEFAULT NULL,
  `cf_to_water_staining_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_water_staining` varchar(10) DEFAULT NULL,
  `cf_to_water_sotting_staining_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_water_sotting_staining` varchar(10) DEFAULT NULL,
  `cf_to_surface_wetting_staining_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_surface_wetting_staining` varchar(10) DEFAULT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change` varchar(10) DEFAULT NULL,
  `cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_hydrolysis_of_reactive_dyes_staining` varchar(10) DEFAULT NULL,
  `cf_to_oidative_bleach_damage_color_change_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_oidative_bleach_damage_color_change` varchar(10) DEFAULT NULL,
  `cf_to_phenolic_yellowing_staining_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_phenolic_yellowing_staining` varchar(10) DEFAULT NULL,
  `cf_to_pvc_migration_staining_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_pvc_migration_staining` varchar(10) DEFAULT NULL,
  `cf_to_saliva_color_change_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_saliva_color_change` varchar(10) DEFAULT NULL,
  `cf_to_saliva_staining_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_saliva_staining` varchar(10) DEFAULT NULL,
  `cf_to_chlorinated_water_color_change_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_chlorinated_water_color_change` varchar(10) DEFAULT NULL,
  `cf_to_chlorinated_water_staining_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_chlorinated_water_staining` varchar(10) DEFAULT NULL,
  `cf_to_cholorine_bleach_color_change_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_cholorine_bleach_color_change` varchar(10) DEFAULT NULL,
  `cf_to_cholorine_bleach_staining_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_cholorine_bleach_staining` varchar(10) DEFAULT NULL,
  `cf_to_peroxide_bleach_color_change_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_peroxide_bleach_color_change` varchar(10) DEFAULT NULL,
  `cf_to_peroxide_bleach_staining_tolerance_value` float DEFAULT NULL,
  `uom_of_cf_to_peroxide_bleach_staining` varchar(10) DEFAULT NULL,
  `cross_staining_tolerance_value` float DEFAULT NULL,
  `uom_of_cross_staining` varchar(10) DEFAULT NULL,
  `ph_value` float NOT NULL,
  `uom_of_ph_value` varchar(10) NOT NULL DEFAULT '',
  `status` varchar(20) NOT NULL DEFAULT '',
  `remarks` varchar(250) NOT NULL DEFAULT '',
  `recording_person_id` varchar(20) NOT NULL DEFAULT '',
  `recording_person_name` varchar(20) NOT NULL DEFAULT '',
  `recording_time` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qc_result_for_washing_process
-- ----------------------------
INSERT INTO `qc_result_for_washing_process` VALUES ('12', '23222', 'Pillow?fs?Red?fs?60?fs?IKEA', 'IKEA', 'Red', '60', 'Washing', '2020-12-01 00:00:00', '2', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'OK', 'Ok', 'iftekhar', 'iftekhar', '2020-12-01 09:44:05');

-- ----------------------------
-- Table structure for `raising_process_info`
-- ----------------------------
DROP TABLE IF EXISTS `raising_process_info`;
CREATE TABLE `raising_process_info` (
  `raising_id` int(11) NOT NULL AUTO_INCREMENT,
  `route_issue_id` int(11) NOT NULL,
  `b_batcher` varchar(20) NOT NULL,
  `a_batcher` varchar(20) NOT NULL,
  `trf_no` float NOT NULL,
  `p_width` int(11) NOT NULL,
  `p_qty` int(11) NOT NULL,
  `s_or_e` int(11) NOT NULL,
  `machine` varchar(11) NOT NULL,
  `face_back` varchar(11) NOT NULL,
  `tensile_warp` float NOT NULL,
  `tensile_weft` float NOT NULL,
  `tear_force_warp` float NOT NULL,
  `tear_force_weft` int(11) NOT NULL,
  `hand_feel` int(11) NOT NULL,
  `raising_quality` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `remarks` varchar(150) NOT NULL,
  `recording_person_id` varchar(50) NOT NULL,
  `recording_person_name` varchar(50) NOT NULL,
  `recording_time` date NOT NULL,
  `modifying_person_id` varchar(50) NOT NULL,
  `modification_time` date NOT NULL,
  PRIMARY KEY (`raising_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of raising_process_info
-- ----------------------------

-- ----------------------------
-- Table structure for `test_method_for_customer`
-- ----------------------------
DROP TABLE IF EXISTS `test_method_for_customer`;
CREATE TABLE `test_method_for_customer` (
  `row_id` int(10) unsigned NOT NULL,
  `test_method_for_customer_id` varchar(20) NOT NULL DEFAULT '',
  `customer_name` varchar(50) DEFAULT '',
  `test_id` varchar(100) DEFAULT '',
  `test_name` varchar(100) DEFAULT '',
  `test_method_name` varchar(200) DEFAULT NULL,
  `checking_field` varchar(250) NOT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`test_method_for_customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of test_method_for_customer
-- ----------------------------
INSERT INTO `test_method_for_customer` VALUES ('1', 'testmcust_1', 'Ikea', 'test_1', 'Color Fastness to rubbing', 'AATCC 8', 'test_1fsColor Fastness to rubbingfsISO 105 X12,test_17fsResistance to surface fuzzing & pillingfsISO 12945-2 : 2000,test_18fsTensile properties of FabricfsISO 12934-1:1999', 'qc', 'qc', '2020-12-01 09:53:03');
INSERT INTO `test_method_for_customer` VALUES ('10', 'testmcust_10', 'Sainsbury', 'test_17', 'Resistance to surface fuzzing & pilling', 'ISO 12945-1:2000', 'test_17fsResistance to surface fuzzing & pillingfsISO 12945-1:2000,test_18fsTensile properties of FabricfsISO 12934-1:1999', 'iftekhar', 'iftekhar', '2020-12-03 11:05:05');
INSERT INTO `test_method_for_customer` VALUES ('11', 'testmcust_11', 'Sainsbury', 'test_18', 'Tensile properties of Fabric', 'ISO 12934-1:1999', 'test_17fsResistance to surface fuzzing & pillingfsISO 12945-1:2000,test_18fsTensile properties of FabricfsISO 12934-1:1999', 'iftekhar', 'iftekhar', '2020-12-03 11:05:05');
INSERT INTO `test_method_for_customer` VALUES ('12', 'testmcust_12', 'Nitori', 'test_17', 'Resistance to surface fuzzing & pilling', 'ISO 12945-2 : 2000', 'test_17fsResistance to surface fuzzing & pillingfsISO 12945-2 : 2000,test_17fsResistance to surface fuzzing & pillingfsM&S P18A,test_17fsResistance to surface fuzzing & pillingfsISO 12945-1:2000', 'iftekhar', 'iftekhar', '2020-12-03 11:07:04');
INSERT INTO `test_method_for_customer` VALUES ('13', 'testmcust_13', 'Nitori', 'test_17', 'Resistance to surface fuzzing & pilling', 'M&S P18A', 'test_17fsResistance to surface fuzzing & pillingfsISO 12945-2 : 2000,test_17fsResistance to surface fuzzing & pillingfsM&S P18A,test_17fsResistance to surface fuzzing & pillingfsISO 12945-1:2000', 'iftekhar', 'iftekhar', '2020-12-03 11:07:04');
INSERT INTO `test_method_for_customer` VALUES ('14', 'testmcust_14', 'Nitori', 'test_17', 'Resistance to surface fuzzing & pilling', 'ISO 12945-1:2000', 'test_17fsResistance to surface fuzzing & pillingfsISO 12945-2 : 2000,test_17fsResistance to surface fuzzing & pillingfsM&S P18A,test_17fsResistance to surface fuzzing & pillingfsISO 12945-1:2000', 'iftekhar', 'iftekhar', '2020-12-03 11:07:04');
INSERT INTO `test_method_for_customer` VALUES ('2', 'testmcust_2', 'Ikea', 'test_17', 'Resistance to surface fuzzing & pilling', 'ISO 12945-1:2000', 'test_1fsColor Fastness to rubbingfsISO 105 X12,test_17fsResistance to surface fuzzing & pillingfsISO 12945-2 : 2000,test_18fsTensile properties of FabricfsISO 12934-1:1999', 'qc', 'qc', '2020-12-01 09:53:03');
INSERT INTO `test_method_for_customer` VALUES ('21', 'testmcust_21', 'BBK', 'test_20', 'Tear force of Trouser shaped test specimen (Single Tear)', 'ISO13937-2: 2000', 'test_20fsTear force of Trouser shaped test specimen (Single Tear)fsISO13937-2: 2000,test_2fsColor Fastness to WashingfsISO 105 C06', 'iftekhar', 'iftekhar', '2020-12-13 16:47:44');
INSERT INTO `test_method_for_customer` VALUES ('22', 'testmcust_22', 'BBK', 'test_2', 'Color Fastness to Washing', 'ISO 105 C06', 'test_20fsTear force of Trouser shaped test specimen (Single Tear)fsISO13937-2: 2000,test_2fsColor Fastness to WashingfsISO 105 C06', 'iftekhar', 'iftekhar', '2020-12-13 16:47:44');
INSERT INTO `test_method_for_customer` VALUES ('23', 'testmcust_23', 'Bangladesh Army', 'test_16', 'Mass per unit per area', 'ISO 3801: 1977', 'test_16fsMass per unit per areafsISO 3801: 1977,test_17fsResistance to surface fuzzing & pillingfsISO 12945-2 : 2000,test_17fsResistance to surface fuzzing & pillingfsISO 12945-1:2000,test_18fsTensile properties of FabricfsISO 12934-2:1999,test_18fsT', 'iftekhar', 'iftekhar', '2020-12-13 17:10:26');
INSERT INTO `test_method_for_customer` VALUES ('24', 'testmcust_24', 'Bangladesh Army', 'test_17', 'Resistance to surface fuzzing & pilling', 'ISO 12945-2 : 2000', 'test_16fsMass per unit per areafsISO 3801: 1977,test_17fsResistance to surface fuzzing & pillingfsISO 12945-2 : 2000,test_17fsResistance to surface fuzzing & pillingfsISO 12945-1:2000,test_18fsTensile properties of FabricfsISO 12934-2:1999,test_18fsT', 'iftekhar', 'iftekhar', '2020-12-13 17:10:26');
INSERT INTO `test_method_for_customer` VALUES ('25', 'testmcust_25', 'Bangladesh Army', 'test_17', 'Resistance to surface fuzzing & pilling', 'ISO 12945-1:2000', 'test_16fsMass per unit per areafsISO 3801: 1977,test_17fsResistance to surface fuzzing & pillingfsISO 12945-2 : 2000,test_17fsResistance to surface fuzzing & pillingfsISO 12945-1:2000,test_18fsTensile properties of FabricfsISO 12934-2:1999,test_18fsT', 'iftekhar', 'iftekhar', '2020-12-13 17:10:26');
INSERT INTO `test_method_for_customer` VALUES ('26', 'testmcust_26', 'Bangladesh Army', 'test_18', 'Tensile properties of Fabric', 'ISO 12934-2:1999', 'test_16fsMass per unit per areafsISO 3801: 1977,test_17fsResistance to surface fuzzing & pillingfsISO 12945-2 : 2000,test_17fsResistance to surface fuzzing & pillingfsISO 12945-1:2000,test_18fsTensile properties of FabricfsISO 12934-2:1999,test_18fsT', 'iftekhar', 'iftekhar', '2020-12-13 17:10:26');
INSERT INTO `test_method_for_customer` VALUES ('27', 'testmcust_27', 'Bangladesh Army', 'test_18', 'Tensile properties of Fabric', 'ISO 12934-1:1999', 'test_16fsMass per unit per areafsISO 3801: 1977,test_17fsResistance to surface fuzzing & pillingfsISO 12945-2 : 2000,test_17fsResistance to surface fuzzing & pillingfsISO 12945-1:2000,test_18fsTensile properties of FabricfsISO 12934-2:1999,test_18fsT', 'iftekhar', 'iftekhar', '2020-12-13 17:10:26');
INSERT INTO `test_method_for_customer` VALUES ('28', 'testmcust_28', 'Bangladesh Army', 'test_2', 'Color Fastness to Washing', 'ISO 105 C06', 'test_16fsMass per unit per areafsISO 3801: 1977,test_17fsResistance to surface fuzzing & pillingfsISO 12945-2 : 2000,test_17fsResistance to surface fuzzing & pillingfsISO 12945-1:2000,test_18fsTensile properties of FabricfsISO 12934-2:1999,test_18fsT', 'iftekhar', 'iftekhar', '2020-12-13 17:10:26');
INSERT INTO `test_method_for_customer` VALUES ('3', 'testmcust_3', 'Ikea', 'test_18', 'Tensile properties of Fabric', 'ISO 12934-1:1999', 'test_1fsColor Fastness to rubbingfsISO 105 X12,test_17fsResistance to surface fuzzing & pillingfsISO 12945-2 : 2000,test_18fsTensile properties of FabricfsISO 12934-1:1999', 'qc', 'qc', '2020-12-01 09:53:03');
INSERT INTO `test_method_for_customer` VALUES ('8', 'testmcust_8', 'Koppermann', 'test_16', 'Mass per unit per area', 'ISO 3801: 1977', 'test_16fsMass per unit per areafsISO 3801: 1977,test_15fsColor fastness to CrockingfsAATCC 8', 'iftekhar', 'iftekhar', '2020-12-03 11:03:24');
INSERT INTO `test_method_for_customer` VALUES ('9', 'testmcust_9', 'Koppermann', 'test_15', 'Color fastness to Crocking', 'AATCC 8', 'test_16fsMass per unit per areafsISO 3801: 1977,test_15fsColor fastness to CrockingfsAATCC 8', 'iftekhar', 'iftekhar', '2020-12-03 11:03:24');

-- ----------------------------
-- Table structure for `test_method_name`
-- ----------------------------
DROP TABLE IF EXISTS `test_method_name`;
CREATE TABLE `test_method_name` (
  `row_id` int(10) NOT NULL,
  `test_method_id` varchar(15) NOT NULL,
  `test_id` varchar(15) DEFAULT NULL,
  `test_name` varchar(100) DEFAULT NULL,
  `test_method_name` varchar(100) DEFAULT NULL,
  `criteria_or_testing_lab` varchar(20) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`test_method_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of test_method_name
-- ----------------------------
INSERT INTO `test_method_name` VALUES ('1', 'testmet_1', 'test_1', 'Color Fastness to rubbing', 'ISO 105 X12', 'Physical Lab', 'iftekhar', 'iftekhar', '2020-12-01 21:14:27');
INSERT INTO `test_method_name` VALUES ('10', 'testmet_10', 'test_16', 'Mass per unit per area', 'ISO 3801: 1977', 'Physical Lab', 'qc', 'qc', '2020-11-30 20:12:54');
INSERT INTO `test_method_name` VALUES ('11', 'testmet_11', 'test_16', 'Mass per unit per area', 'ASTM D 3776', 'Physical Lab', 'qc', 'qc', '2020-11-30 20:14:57');
INSERT INTO `test_method_name` VALUES ('12', 'testmet_12', 'test_17', 'Resistance to surface fuzzing & pilling', 'ISO 12945-2 : 2000', 'Physical Lab', 'qc', 'qc', '2020-11-30 20:30:55');
INSERT INTO `test_method_name` VALUES ('13', 'testmet_13', 'test_17', 'Resistance to surface fuzzing & pilling', 'M&S P18A', 'Physical Lab', 'qc', 'qc', '2020-11-30 20:32:23');
INSERT INTO `test_method_name` VALUES ('14', 'testmet_14', 'test_17', 'Resistance to surface fuzzing & pilling', 'ISO 12945-1:2000', 'Physical Lab', 'qc', 'qc', '2020-11-30 20:34:13');
INSERT INTO `test_method_name` VALUES ('15', 'testmet_15', 'test_18', 'Tensile properties of Fabric', 'ISO 12934-2:1999', 'Physical Lab', 'qc', 'qc', '2020-11-30 20:36:41');
INSERT INTO `test_method_name` VALUES ('16', 'testmet_16', 'test_18', 'Tensile properties of Fabric', 'ISO 12934-1:1999', 'Physical Lab', 'qc', 'qc', '2020-11-30 20:37:05');
INSERT INTO `test_method_name` VALUES ('17', 'testmet_17', 'test_18', 'Tensile properties of Fabric', 'M&S P11', 'Physical Lab', 'qc', 'qc', '2020-11-30 20:38:16');
INSERT INTO `test_method_name` VALUES ('18', 'testmet_18', 'test_18', 'Tensile properties of Fabric', 'M&S P29', 'Physical Lab', 'qc', 'qc', '2020-11-30 20:38:31');
INSERT INTO `test_method_name` VALUES ('19', 'testmet_19', 'test_19', 'Tear force using Ballistic Pendulam Method ( Elmendorf)', 'ISO13937-1: 2000', 'Physical Lab', 'qc', 'qc', '2020-11-30 20:45:34');
INSERT INTO `test_method_name` VALUES ('2', 'testmet_2', 'test_15', 'Color fastness to Crocking', 'AATCC 8', 'Washing Lab', 'iftekhar', 'iftekhar', '2020-12-01 21:18:22');
INSERT INTO `test_method_name` VALUES ('20', 'testmet_20', 'test_20', 'Tear force of Trouser shaped test specimen (Single Tear)', 'ISO13937-2: 2000', 'Physical Lab', 'qc', 'qc', '2020-11-30 20:49:32');
INSERT INTO `test_method_name` VALUES ('21', 'testmet_21', 'test_7', 'Tensile Properties', 'ISO-944', 'R&D Lab', 'iftekhar', 'iftekhar', '2020-12-01 21:00:38');
INSERT INTO `test_method_name` VALUES ('3', 'testmet_3', 'test_11', 'Dimensional Change to Washing & Drying', 'ISO 3759-2011/ISO 5077-2007/ISO 6330-2012', 'Washing Lab', 'qc', 'qc', '2020-11-30 17:06:22');
INSERT INTO `test_method_name` VALUES ('4', 'testmet_4', 'test_2', 'Color Fastness to Washing', 'ISO 105 C06', 'Washing Lab', 'qc', 'qc', '2020-11-30 17:07:10');
INSERT INTO `test_method_name` VALUES ('5', 'testmet_5', 'test_10', 'Thread Per Inch', 'ISO 7211-2', 'Physical Lab', 'qc', 'qc', '2020-11-30 17:45:46');
INSERT INTO `test_method_name` VALUES ('6', 'testmet_6', 'test_9', 'Yarn Count', 'ISO 7211-5', 'Physical Lab', 'qc', 'qc', '2020-11-30 17:46:01');
INSERT INTO `test_method_name` VALUES ('7', 'testmet_7', 'test_9', 'Yarn Count', 'ISO 7211-5 :1984', 'Physical Lab', 'qc', 'qc', '2020-11-30 20:04:37');
INSERT INTO `test_method_name` VALUES ('8', 'testmet_8', 'test_9', 'Yarn Count', 'ASTM D 1059', 'Physical Lab', 'qc', 'qc', '2020-11-30 20:06:09');
INSERT INTO `test_method_name` VALUES ('9', 'testmet_9', 'test_14', 'Number of threads per unit', 'ISO 7211-2 : 1984', 'Physical Lab', 'qc', 'qc', '2020-11-30 20:07:59');

-- ----------------------------
-- Table structure for `test_name`
-- ----------------------------
DROP TABLE IF EXISTS `test_name`;
CREATE TABLE `test_name` (
  `row_id` int(10) NOT NULL,
  `test_id` varchar(15) NOT NULL,
  `test_name` varchar(100) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`test_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of test_name
-- ----------------------------
INSERT INTO `test_name` VALUES ('1', 'test_1', 'Color Fastness to rubbing', 'iftekhar', 'iftekhar', '2020-12-01 20:58:50');
INSERT INTO `test_name` VALUES ('10', 'test_10', 'Thread Per Inch', 'qc', 'qc', '2020-11-30 16:44:44');
INSERT INTO `test_name` VALUES ('11', 'test_11', 'Dimensional Change to Washing & Drying', 'qc', 'qc', '2020-11-30 16:46:15');
INSERT INTO `test_name` VALUES ('12', 'test_12', 'Color fastness to oxidative bleach damage', 'qc', 'qc', '2020-11-30 16:46:44');
INSERT INTO `test_name` VALUES ('13', 'test_13', 'Color fastness to Hydrolysis of reactive dyes', 'qc', 'qc', '2020-11-30 16:47:23');
INSERT INTO `test_name` VALUES ('14', 'test_14', 'Number of threads per unit', 'qc', 'qc', '2020-11-30 16:48:18');
INSERT INTO `test_name` VALUES ('15', 'test_15', 'Color fastness to Crocking', 'qc', 'qc', '2020-11-30 16:48:45');
INSERT INTO `test_name` VALUES ('16', 'test_16', 'Mass per unit per area', 'qc', 'qc', '2020-11-30 16:56:06');
INSERT INTO `test_name` VALUES ('17', 'test_17', 'Resistance to surface fuzzing & pilling', 'qc', 'qc', '2020-11-30 16:58:01');
INSERT INTO `test_name` VALUES ('18', 'test_18', 'Tensile properties of Fabric', 'qc', 'qc', '2020-11-30 17:04:29');
INSERT INTO `test_name` VALUES ('19', 'test_19', 'Tear force using Ballistic Pendulam Method ( Elmendorf)', 'qc', 'qc', '2020-11-30 17:07:18');
INSERT INTO `test_name` VALUES ('2', 'test_2', 'Color Fastness to Washing', 'qc', 'qc', '2020-11-30 16:44:41');
INSERT INTO `test_name` VALUES ('20', 'test_20', 'Tear force of Trouser shaped test specimen (Single Tear)', 'qc', 'qc', '2020-11-30 17:10:09');
INSERT INTO `test_name` VALUES ('21', 'test_21', 'Resistance to slipage on Seam', 'qc', 'qc', '2020-11-30 17:11:24');
INSERT INTO `test_name` VALUES ('22', 'test_22', 'Seam Tensile Properties of Fabrics', 'qc', 'qc', '2020-11-30 17:12:59');
INSERT INTO `test_name` VALUES ('23', 'test_23', 'Abrasion resistance of Fabric on Martindale Method', 'qc', 'qc', '2020-11-30 17:15:24');
INSERT INTO `test_name` VALUES ('24', 'test_24', 'Mass Loss in Abrasion test', 'qc', 'qc', '2020-11-30 17:16:52');
INSERT INTO `test_name` VALUES ('25', 'test_25', 'pH Value of Aquous Extract', 'qc', 'qc', '2020-11-30 17:22:33');
INSERT INTO `test_name` VALUES ('26', 'test_26', 'Determination of of Formaldehyde', 'qc', 'qc', '2020-11-30 17:24:13');
INSERT INTO `test_name` VALUES ('27', 'test_27', 'Color Fastness to Dry cleaning', 'qc', 'qc', '2020-11-30 17:26:53');
INSERT INTO `test_name` VALUES ('28', 'test_28', 'Color Fastness to Perspiration', 'qc', 'qc', '2020-11-30 17:29:21');
INSERT INTO `test_name` VALUES ('29', 'test_29', 'Color Fastness to water', 'qc', 'qc', '2020-11-30 17:30:09');
INSERT INTO `test_name` VALUES ('3', 'test_3', 'CF To Perspiration Acidic', 'qc', 'qc', '2020-11-30 16:17:07');
INSERT INTO `test_name` VALUES ('30', 'test_30', 'Color Fastness to Water Spotting', 'qc', 'qc', '2020-11-30 17:32:53');
INSERT INTO `test_name` VALUES ('31', 'test_31', 'Resistance to surface wetting', 'qc', 'qc', '2020-11-30 17:35:18');
INSERT INTO `test_name` VALUES ('32', 'test_32', 'Color Fastness to phenolic yellowing', 'qc', 'qc', '2020-11-30 17:49:51');
INSERT INTO `test_name` VALUES ('33', 'test_33', 'Migration of color into PVC', 'qc', 'qc', '2020-11-30 18:19:45');
INSERT INTO `test_name` VALUES ('34', 'test_34', 'Color Fastness to Saliva', 'qc', 'qc', '2020-11-30 18:21:49');
INSERT INTO `test_name` VALUES ('35', 'test_35', 'Color Fastness to Chlorinated Water', 'qc', 'qc', '2020-11-30 18:25:04');
INSERT INTO `test_name` VALUES ('36', 'test_36', 'Color Fastness to Chlorine Bleach', 'qc', 'qc', '2020-11-30 18:42:28');
INSERT INTO `test_name` VALUES ('37', 'test_37', 'Color Fastness to Peroxide Bleach', 'qc', 'qc', '2020-11-30 18:44:27');
INSERT INTO `test_name` VALUES ('38', 'test_38', 'Color Fastness to Artificial Light', 'qc', 'qc', '2020-11-30 18:46:16');
INSERT INTO `test_name` VALUES ('39', 'test_39', 'Cross Staining', 'qc', 'qc', '2020-11-30 18:47:15');
INSERT INTO `test_name` VALUES ('4', 'test_4', 'CF To Perspiration Alkali', 'qc', 'qc', '2020-11-30 16:17:34');
INSERT INTO `test_name` VALUES ('40', 'test_40', 'Water absorption', 'qc', 'qc', '2020-11-30 18:48:30');
INSERT INTO `test_name` VALUES ('41', 'test_41', 'Print Durability', 'qc', 'qc', '2020-11-30 18:54:12');
INSERT INTO `test_name` VALUES ('42', 'test_42', 'Determination of spirality after laundering', 'qc', 'qc', '2020-11-30 18:57:15');
INSERT INTO `test_name` VALUES ('43', 'test_43', 'Appearance After Laundering', 'qc', 'qc', '2020-11-30 18:59:11');
INSERT INTO `test_name` VALUES ('44', 'test_44', 'Durable Press / Smoothness Appearance', 'qc', 'qc', '2020-11-30 19:02:22');
INSERT INTO `test_name` VALUES ('45', 'test_45', 'Ironability of Woven Fabric', 'qc', 'qc', '2020-11-30 19:04:22');
INSERT INTO `test_name` VALUES ('46', 'test_46', 'Fiber composition', 'qc', 'qc', '2020-11-30 19:06:07');
INSERT INTO `test_name` VALUES ('47', 'test_47', 'Moisture Content', 'qc', 'qc', '2020-11-30 19:07:44');
INSERT INTO `test_name` VALUES ('48', 'test_48', 'Evaporation Rate', 'qc', 'qc', '2020-11-30 19:08:45');
INSERT INTO `test_name` VALUES ('49', 'test_49', 'Number of threads per unit length', 'qc', 'qc', '2020-11-30 19:11:49');
INSERT INTO `test_name` VALUES ('5', 'test_5', 'CF To Water', 'qc', 'qc', '2020-11-30 16:18:56');
INSERT INTO `test_name` VALUES ('6', 'test_6', 'Dimensional Stability To Washing', 'qc', 'qc', '2020-11-30 16:41:32');
INSERT INTO `test_name` VALUES ('7', 'test_7', 'Tensile Properties', 'qc', 'qc', '2020-11-30 16:43:55');
INSERT INTO `test_name` VALUES ('9', 'test_9', 'Yarn Count', 'qc', 'qc', '2020-11-30 16:44:28');

-- ----------------------------
-- Table structure for `trf_info`
-- ----------------------------
DROP TABLE IF EXISTS `trf_info`;
CREATE TABLE `trf_info` (
  `trf_id` int(50) NOT NULL AUTO_INCREMENT,
  `trf_creation_date` date NOT NULL,
  `alternate_trf_creation_date_time` varchar(30) NOT NULL,
  `shift` varchar(8) NOT NULL,
  `process_name` varchar(20) NOT NULL,
  `pp_number` varchar(30) NOT NULL,
  `version_number` varchar(50) NOT NULL,
  `week_in_year` varchar(20) NOT NULL,
  `design` varchar(20) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `fiber_composition` varchar(50) NOT NULL,
  `finish_width_in_inch` double NOT NULL,
  `before_trolley_number_or_batcher_number` double NOT NULL,
  `after_trolley_number_or_batcher_number` double NOT NULL,
  `qty` double NOT NULL,
  `machine_name` varchar(50) NOT NULL,
  `service_type` varchar(20) NOT NULL,
  `washing` varchar(100) NOT NULL,
  `bleaching` varchar(100) NOT NULL,
  `ironing` varchar(100) NOT NULL,
  `dry_cleaning` varchar(100) NOT NULL,
  `drying` varchar(100) NOT NULL,
  `recording_person_id` varchar(50) NOT NULL,
  `recording_person_name` varchar(20) NOT NULL,
  `recording_time` datetime NOT NULL,
  PRIMARY KEY (`trf_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of trf_info
-- ----------------------------
INSERT INTO `trf_info` VALUES ('1', '2020-12-27', '04:14 PM', 'A', 'Dyeing', '5893/2020', 'Pillow Back', '2044', 'Jattelik Dino White', 'Ikea', 'Cotton:0 Polyester:0 Other0', '103', '1', '1', '400000000', 'Thermosol-2', 'Regular', 'http://localhost/znzQC/img/washing/washing2.png', 'http://localhost/znzQC/img/bleaching/bleaching4.png', 'http://localhost/znzQC/img/Ironing/ironing.png', 'http://localhost/znzQC/img/DryCleaning/DryCleaning2.png', 'http://localhost/znzQC/img/Drying/Drying4.png', 'iftekhar', 'iftekhar', '2020-12-27 16:15:39');
INSERT INTO `trf_info` VALUES ('2', '2020-12-27', '04:17PM', 'C', 'Ready For Dyeing', '5893/2020', 'Pillow Front', '2044', 'Jattelik Dino White', 'Ikea', 'Cotton:0 Polyester:0 Other0', '103', '1', '2', '400000000', 'Monforts-3', 'Express', 'http://localhost/znzQC/img/washing/washing.png', 'http://localhost/znzQC/img/bleaching/bleaching.png', 'http://localhost/znzQC/img/Ironing/ironing.png', 'http://localhost/znzQC/img/DryCleaning/DryCleaning.png', 'http://localhost/znzQC/img/Drying/Drying.png', 'iftekhar', 'iftekhar', '2020-12-27 16:18:20');
INSERT INTO `trf_info` VALUES ('3', '2020-12-27', '04:00 PM', 'A', 'Ready For Dyeing', '6038/2020', 'Front', '2048', 'JATTELIK DINO BLUE', 'Ikea', 'Cotton:100 Polyester:0 Other0', '0', '1', '3', '400000000', 'Monforts-1', 'Express', 'http://localhost/znzQC/img/washing/washing.png', 'http://localhost/znzQC/img/bleaching/bleaching.png', 'http://localhost/znzQC/img/Ironing/ironing.png', 'http://localhost/znzQC/img/DryCleaning/DryCleaning.png', 'http://localhost/znzQC/img/Drying/Drying.png', 'iftekhar', 'iftekhar', '2020-12-27 16:20:46');
INSERT INTO `trf_info` VALUES ('4', '2020-12-27', '03:44 PM', 'B', 'Ready For Dyeing', '6038/2020', 'Front', '2048', 'JATTELIK DINO BLUE', 'Ikea', 'Cotton:0 Polyester:0 Other0', '0', '2', '4', '400000000', 'Monforts-3', 'Express', 'http://localhost/znzQC/img/washing/washing.png', 'http://localhost/znzQC/img/bleaching/bleaching.png', 'http://localhost/znzQC/img/Ironing/ironing.png', 'http://localhost/znzQC/img/DryCleaning/DryCleaning.png', 'http://localhost/znzQC/img/Drying/Drying.png', 'iftekhar', 'iftekhar', '2020-12-27 16:22:19');
INSERT INTO `trf_info` VALUES ('5', '2020-12-27', '04:00 PM', 'B', 'Steaming', '6038/2020', 'Front', '2048', 'JATTELIK DINO BLUE', 'Ikea', 'Cotton:100 Polyester:0 Other0', '0', '3', '5', '400000000', 'Osthoff -1', 'Regular', 'http://localhost/znzQC/img/washing/washing.png', 'http://localhost/znzQC/img/bleaching/bleaching.png', 'http://localhost/znzQC/img/Ironing/ironing.png', 'http://localhost/znzQC/img/DryCleaning/DryCleaning.png', 'http://localhost/znzQC/img/Drying/Drying.png', 'iftekhar', 'iftekhar', '2020-12-27 16:23:33');
INSERT INTO `trf_info` VALUES ('6', '2020-12-26', '03:40 PM', 'C', 'Dyeing', '6038/2020', 'Front', '2048', 'JATTELIK DINO BLUE', 'Ikea', 'Cotton:100 Polyester:0 Other0', '108', '2', '5', '400000000', 'Thermosol-2', 'Express', 'http://localhost/znzQC/img/washing/washing.png', 'http://localhost/znzQC/img/bleaching/bleaching.png', 'http://localhost/znzQC/img/Ironing/ironing.png', 'http://localhost/znzQC/img/DryCleaning/DryCleaning.png', 'http://localhost/znzQC/img/Drying/Drying.png', 'iftekhar', 'iftekhar', '2020-12-27 16:25:37');
INSERT INTO `trf_info` VALUES ('7', '2020-12-28', '8:50 PM', 'B', 'Ready For Dyeing', '6038/2020', 'Front', '2048', 'JATTELIK DINO BLUE', 'Ikea', 'Cotton:0 Polyester:0 Other0', '103', '5', '6', '400000000', 'Monforts-1', 'Regular', 'http://localhost/znzQC/img/washing/washing.png', 'http://localhost/znzQC/img/bleaching/bleaching4.png', 'http://localhost/znzQC/img/ironing/ironing4.png', 'http://localhost/znzQC/img/DryCleaning/DryCleaning.png', 'http://localhost/znzQC/img/Drying/Drying.png', 'iftekhar', 'iftekhar', '2020-12-28 10:35:50');

-- ----------------------------
-- Table structure for `user_access_management`
-- ----------------------------
DROP TABLE IF EXISTS `user_access_management`;
CREATE TABLE `user_access_management` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(30) NOT NULL,
  `users` int(10) DEFAULT NULL,
  `create_user` int(10) DEFAULT NULL,
  `user_list` int(10) DEFAULT NULL,
  `files` int(10) DEFAULT NULL,
  `file_create` int(10) DEFAULT NULL,
  `file_list` int(10) DEFAULT NULL,
  `lc_and_pi` int(10) DEFAULT NULL,
  `lc_and_pi_doc` int(10) DEFAULT NULL,
  `lc_and_pi_acceptance_doc` int(10) DEFAULT NULL,
  `b2b` int(10) DEFAULT NULL,
  `b2b_lc_and_pi_weave_doc` int(10) DEFAULT NULL,
  `b2b_lc_and_pi_spin_doc` int(10) DEFAULT NULL,
  `b2b_doc_weave_doc` int(10) DEFAULT NULL,
  `b2b_doc_spin_doc` int(10) DEFAULT NULL,
  `btma_and_cash` int(10) DEFAULT NULL,
  `btma_weave_doc` int(10) DEFAULT NULL,
  `btma_spin_doc` int(10) DEFAULT NULL,
  `cash_weave_doc` int(10) DEFAULT NULL,
  `banking` int(10) DEFAULT NULL,
  `banking_bank_acceptance_doc` int(10) DEFAULT NULL,
  `prc` int(10) DEFAULT NULL,
  `prc_duration_doc` int(10) DEFAULT NULL,
  `others` int(10) DEFAULT NULL,
  `backup_doc` int(10) DEFAULT NULL,
  `settings` int(10) DEFAULT NULL,
  `recording_person_id` varchar(30) NOT NULL,
  `recording_time` datetime NOT NULL,
  `modifying_person_id` varchar(30) NOT NULL,
  `modification_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_access_management
-- ----------------------------
INSERT INTO `user_access_management` VALUES ('1', 'shoeb', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '', '2018-11-25 12:32:03', '', '2019-07-14 16:59:57');
INSERT INTO `user_access_management` VALUES ('2', 'osman', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '', '2018-11-25 12:32:03', '', '2019-07-14 17:00:28');
INSERT INTO `user_access_management` VALUES ('6', 'hriday', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '', '2018-11-25 12:32:03', '', '2018-11-25 12:50:49');
INSERT INTO `user_access_management` VALUES ('5', 'anil', '1', '1', '1', '1', '1', '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0', '', '2018-11-25 12:32:03', '', '2018-11-25 12:50:49');
INSERT INTO `user_access_management` VALUES ('3', 'tanjina', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '', '2018-11-25 12:32:03', '', '2018-11-26 16:55:04');
INSERT INTO `user_access_management` VALUES ('56', 'qc', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0', 'shoeb', '2020-01-18 16:09:29', 'shoeb', '2020-01-18 16:09:29');
INSERT INTO `user_access_management` VALUES ('57', 'test', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0', 'shoeb', '2020-01-31 22:43:59', 'shoeb', '2020-01-31 22:43:59');

-- ----------------------------
-- Table structure for `user_info`
-- ----------------------------
DROP TABLE IF EXISTS `user_info`;
CREATE TABLE `user_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `confirm_password` varchar(50) DEFAULT NULL,
  `user_type` varchar(20) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contact_no` varchar(15) DEFAULT NULL,
  `department` varchar(30) DEFAULT NULL,
  `designation` varchar(30) DEFAULT NULL,
  `profile_picture` varchar(130) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_info
-- ----------------------------
INSERT INTO `user_info` VALUES ('15', 'iftekhar', 'iftekhar', '12345', '12345', 'Admin', 'Active', 'abcd@gmail.com', '11111111', 'ICT', 'Application Developer', 'default.png', 'iftekhar', 'iftekhar', '2020-12-14 10:11:14');
INSERT INTO `user_info` VALUES ('26', 'Md. Jiash Hasnat', '004143', 'covid19zz', 'covid19zz', 'Admin', 'Active', 'ftslab@znzfab.com', '01985982850', 'Lab & QC', 'Engineer', 'default.png', 'iftekhar', 'iftekhar', '2020-12-23 16:46:01');
INSERT INTO `user_info` VALUES ('27', 'Md. Saiful Islam', 'Saiful Lab', '4321', '4321', 'User', 'Active', 'md.saiful@znzfab.com', '01701212563', 'Marketing', 'Manager', 'default.png', 'qc', 'qc', '2020-12-01 09:55:55');
INSERT INTO `user_info` VALUES ('28', 'Md. Saiful Islam', 'Saiful Lab', '4321', '4321', 'User', 'Active', 'md.saiful@znzfab.com', '01701212563', 'ICT', 'Manager', 'default.png', 'qc', 'qc', '2020-12-01 09:58:41');
INSERT INTO `user_info` VALUES ('30', 'qc', 'qc', '12345', '12345', 'Admin', 'Active', 'qc@gmail.com', '100000000', 'Lab & QC', 'Deputy Manager', 'default.png', 'iftekhar', 'iftekhar', '2020-12-14 10:10:09');
INSERT INTO `user_info` VALUES ('32', 'abc', 'abc123', '12345', '12345', 'User', 'Active', 'abc@gmail.com', '11111111', 'ICT', 'Engineer', 'default.png', 'iftekhar', 'iftekhar', '2020-12-24 15:36:10');

-- ----------------------------
-- Table structure for `user_login`
-- ----------------------------
DROP TABLE IF EXISTS `user_login`;
CREATE TABLE `user_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` varchar(25) NOT NULL,
  `department` varchar(30) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `profile_picture` varchar(100) NOT NULL,
  `recording_person_id` varchar(30) NOT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_login
-- ----------------------------
INSERT INTO `user_login` VALUES ('69', 'iftekhar', 'iftekhar', '', '', '', '12345', 'abcd@gmail.com', '11111111', 'ICT', 'Application Developer', 'Admin', 'Active', 'default.png', 'iftekhar', 'iftekhar', '2020-12-14 10:11:14');
INSERT INTO `user_login` VALUES ('84', 'qc', 'qc', '', '', '', '12345', 'qc@gmail.com', '100000000', 'Lab & QC', 'Deputy Manager', 'Admin', 'Active', 'default.png', 'iftekhar', 'iftekhar', '2020-12-14 10:10:09');
INSERT INTO `user_login` VALUES ('80', '004143', 'Md. Jiash Hasnat', '', '', '', 'covid19zz', 'ftslab@znzfab.com', '01985982850', 'Lab & QC', 'Engineer', 'Admin', 'Active', 'default.png', 'iftekhar', 'iftekhar', '2020-12-23 16:46:01');
INSERT INTO `user_login` VALUES ('86', 'abc123', 'abc', '', '', '', '12345', 'abc@gmail.com', '11111111', 'ICT', 'Engineer', 'User', 'Active', 'default.png', 'iftekhar', 'iftekhar', '2020-12-24 15:36:10');

-- ----------------------------
-- Table structure for `user_login_old`
-- ----------------------------
DROP TABLE IF EXISTS `user_login_old`;
CREATE TABLE `user_login_old` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contact_no` varchar(50) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `profile_picture` varchar(100) NOT NULL,
  `recording_person_id` varchar(30) NOT NULL,
  `recording_person_name` varchar(50) NOT NULL,
  `recording_time` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_login_old
-- ----------------------------
INSERT INTO `user_login_old` VALUES ('1', 'shoeb', '517edd23ee087e994fdb9c14837cf6b8', 'super_admin', 'Active', null, null, null, null, 'shoeb.jpg', '', '', '2018-11-25 12:32:03');
INSERT INTO `user_login_old` VALUES ('2', 'osman', 'e10adc3949ba59abbe56e057f20f883e', 'super_admin', 'Active', null, null, null, null, 'osman.jpg', '', '', '2018-11-25 12:32:03');
INSERT INTO `user_login_old` VALUES ('6', 'hriday', 'hriday', 'super_admin', 'Active', null, null, null, null, 'food.png', '', '', '2018-11-25 12:32:03');
INSERT INTO `user_login_old` VALUES ('3', 'tanjina', 'e10adc3949ba59abbe56e057f20f883e', 'admin', 'Active', null, null, null, null, 'tanjina.jpg', '', '', '2018-11-25 12:32:03');
INSERT INTO `user_login_old` VALUES ('5', 'anil', '3e6c7d141e32189c917761138b026b74', 'admin', 'Active', null, null, null, null, 'default.png', '', '', '2019-07-18 12:11:00');
INSERT INTO `user_login_old` VALUES ('66', 'qc', '3e6c7d141e32189c917761138b026b74', 'admin', 'Active', null, null, null, null, 'default.png', 'shoeb', '', '2020-01-18 16:09:29');
INSERT INTO `user_login_old` VALUES ('67', 'test', '3e6c7d141e32189c917761138b026b74', 'admin', 'Active', null, null, null, null, 'code.png', 'shoeb', '', '2020-01-31 22:43:59');
INSERT INTO `user_login_old` VALUES ('68', 'abcd', '12345', 'Admin', 'Active', 'abcd@gmail.com', '0000000000', 'ICT', 'Application Developer', 'default.png', 'abcd', 'abcd', '2020-11-26 10:18:25');

-- ----------------------------
-- Table structure for `user_type`
-- ----------------------------
DROP TABLE IF EXISTS `user_type`;
CREATE TABLE `user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `short_name` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_type
-- ----------------------------
INSERT INTO `user_type` VALUES ('1', 'Super Admin', 'super_admin');
INSERT INTO `user_type` VALUES ('2', 'Admin', 'admin');
INSERT INTO `user_type` VALUES ('3', 'Senior Officer LC & PI', 'senior_officer_lc_pi');
INSERT INTO `user_type` VALUES ('4', 'Senior Officer B2B', 'senior_officer_b2b');
INSERT INTO `user_type` VALUES ('5', 'Assistant Manager ', 'assistant_manager');
INSERT INTO `user_type` VALUES ('6', 'Assistant Manager Banking', 'assistant_manager_banking');
INSERT INTO `user_type` VALUES ('7', 'Officer', 'officer');
INSERT INTO `user_type` VALUES ('8', 'Assistant Officer BTMA', 'assistant_officer_btma');
INSERT INTO `user_type` VALUES ('9', 'Assistant Officer B2B', 'assistant_officer_b2b');
INSERT INTO `user_type` VALUES ('10', 'Manager', 'manager');

-- ----------------------------
-- Table structure for `version_name`
-- ----------------------------
DROP TABLE IF EXISTS `version_name`;
CREATE TABLE `version_name` (
  `row_id` int(10) NOT NULL,
  `version_id` varchar(15) NOT NULL,
  `version_name` varchar(100) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`version_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of version_name
-- ----------------------------
INSERT INTO `version_name` VALUES ('1', 'versionnum_1', 'Front', 'iftekhar', 'iftekhar', '2020-12-01 21:18:38');
INSERT INTO `version_name` VALUES ('2', 'versionnum_2', 'Reverse', 'qc', 'qc', '2020-11-30 15:49:47');
INSERT INTO `version_name` VALUES ('3', 'versionnum_3', 'Pillow ', 'qc', 'qc', '2020-11-30 15:51:02');
INSERT INTO `version_name` VALUES ('4', 'versionnum_4', 'Piping', 'qc', 'qc', '2020-11-30 15:53:08');
INSERT INTO `version_name` VALUES ('5', 'versionnum_5', 'Qc Front', 'qc', 'qc', '2020-11-30 16:08:43');
INSERT INTO `version_name` VALUES ('6', 'versionnum_6', 'Qc Back', 'qc', 'qc', '2020-11-30 16:08:55');
INSERT INTO `version_name` VALUES ('7', 'versionnum_7', 'Pillow Front', 'qc', 'qc', '2020-11-30 16:09:10');
INSERT INTO `version_name` VALUES ('8', 'versionnum_8', 'Pillow Back', 'qc', 'qc', '2020-11-30 16:09:19');
INSERT INTO `version_name` VALUES ('9', 'versionnum_9', 'Sheet', 'qc', 'qc', '2020-11-30 18:14:43');

/*
Navicat MySQL Data Transfer

Source Server         : MySQLDatabase
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : znz_fabrics

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-12-31 09:35:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `all_test_for_trf_info`
-- ----------------------------

CREATE TABLE `all_test_for_trf_info` (
  `trf_id` int(50) NOT NULL AUTO_INCREMENT,
  `all_test_for_trf_creation_date` date NOT NULL,
  `alternate_all_test_for_trf_creation_date_time` varchar(30) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of all_test_for_trf_info
-- ----------------------------
INSERT INTO `all_test_for_trf_info` VALUES ('1', '2020-12-27', '04:14 PM', 'A', 'Dyeing', '5893/2020', 'Pillow Back', '2044', 'Jattelik Dino White', 'Ikea', 'Cotton:0 Polyester:0 Other0', '103', '1', '1', '400000000', 'Thermosol-2', 'Regular', 'http://localhost/znzQC/img/washing/washing2.png', 'http://localhost/znzQC/img/bleaching/bleaching4.png', 'http://localhost/znzQC/img/Ironing/ironing.png', 'http://localhost/znzQC/img/DryCleaning/DryCleaning2.png', 'http://localhost/znzQC/img/Drying/Drying4.png', 'iftekhar', 'iftekhar', '2020-12-27 16:15:39');
INSERT INTO `all_test_for_trf_info` VALUES ('2', '2020-12-27', '04:17PM', 'C', 'Ready For Dyeing', '5893/2020', 'Pillow Front', '2044', 'Jattelik Dino White', 'Ikea', 'Cotton:0 Polyester:0 Other0', '103', '1', '2', '400000000', 'Monforts-3', 'Express', 'http://localhost/znzQC/img/washing/washing.png', 'http://localhost/znzQC/img/bleaching/bleaching.png', 'http://localhost/znzQC/img/Ironing/ironing.png', 'http://localhost/znzQC/img/DryCleaning/DryCleaning.png', 'http://localhost/znzQC/img/Drying/Drying.png', 'iftekhar', 'iftekhar', '2020-12-27 16:18:20');
INSERT INTO `all_test_for_trf_info` VALUES ('3', '2020-12-27', '04:00 PM', 'A', 'Ready For Dyeing', '6038/2020', 'Front', '2048', 'JATTELIK DINO BLUE', 'Ikea', 'Cotton:100 Polyester:0 Other0', '0', '1', '3', '400000000', 'Monforts-1', 'Express', 'http://localhost/znzQC/img/washing/washing.png', 'http://localhost/znzQC/img/bleaching/bleaching.png', 'http://localhost/znzQC/img/Ironing/ironing.png', 'http://localhost/znzQC/img/DryCleaning/DryCleaning.png', 'http://localhost/znzQC/img/Drying/Drying.png', 'iftekhar', 'iftekhar', '2020-12-27 16:20:46');
INSERT INTO `all_test_for_trf_info` VALUES ('4', '2020-12-27', '03:44 PM', 'B', 'Ready For Dyeing', '6038/2020', 'Front', '2048', 'JATTELIK DINO BLUE', 'Ikea', 'Cotton:0 Polyester:0 Other0', '0', '2', '4', '400000000', 'Monforts-3', 'Express', 'http://localhost/znzQC/img/washing/washing.png', 'http://localhost/znzQC/img/bleaching/bleaching.png', 'http://localhost/znzQC/img/Ironing/ironing.png', 'http://localhost/znzQC/img/DryCleaning/DryCleaning.png', 'http://localhost/znzQC/img/Drying/Drying.png', 'iftekhar', 'iftekhar', '2020-12-27 16:22:19');
INSERT INTO `all_test_for_trf_info` VALUES ('5', '2020-12-27', '04:00 PM', 'B', 'Steaming', '6038/2020', 'Front', '2048', 'JATTELIK DINO BLUE', 'Ikea', 'Cotton:100 Polyester:0 Other0', '0', '3', '5', '400000000', 'Osthoff -1', 'Regular', 'http://localhost/znzQC/img/washing/washing.png', 'http://localhost/znzQC/img/bleaching/bleaching.png', 'http://localhost/znzQC/img/Ironing/ironing.png', 'http://localhost/znzQC/img/DryCleaning/DryCleaning.png', 'http://localhost/znzQC/img/Drying/Drying.png', 'iftekhar', 'iftekhar', '2020-12-27 16:23:33');
INSERT INTO `all_test_for_trf_info` VALUES ('6', '2020-12-26', '03:40 PM', 'C', 'Dyeing', '6038/2020', 'Front', '2048', 'JATTELIK DINO BLUE', 'Ikea', 'Cotton:100 Polyester:0 Other0', '108', '2', '5', '400000000', 'Thermosol-2', 'Express', 'http://localhost/znzQC/img/washing/washing.png', 'http://localhost/znzQC/img/bleaching/bleaching.png', 'http://localhost/znzQC/img/Ironing/ironing.png', 'http://localhost/znzQC/img/DryCleaning/DryCleaning.png', 'http://localhost/znzQC/img/Drying/Drying.png', 'iftekhar', 'iftekhar', '2020-12-27 16:25:37');
INSERT INTO `all_test_for_trf_info` VALUES ('7', '2020-12-28', '8:50 PM', 'B', 'Ready For Dyeing', '6038/2020', 'Front', '2048', 'JATTELIK DINO BLUE', 'Ikea', 'Cotton:0 Polyester:0 Other0', '103', '5', '6', '400000000', 'Monforts-1', 'Regular', 'http://localhost/znzQC/img/washing/washing.png', 'http://localhost/znzQC/img/bleaching/bleaching4.png', 'http://localhost/znzQC/img/ironing/ironing4.png', 'http://localhost/znzQC/img/DryCleaning/DryCleaning.png', 'http://localhost/znzQC/img/Drying/Drying.png', 'iftekhar', 'iftekhar', '2020-12-28 10:35:50');
INSERT INTO `all_test_for_trf_info` VALUES ('8', '2020-12-30', '03:40 PM', 'A', 'Dyeing', '5893/2020', 'Pillow Back', '2044', 'Jattelik Dino White', 'Ikea', 'Cotton:0 Polyester:0 Other0', '108', '1', '5', '100000', 'Thermosol-2', 'Regular', 'http://localhost/znzQC/img/washing/washing4.png', 'http://localhost/znzQC/img/bleaching/bleaching1.png', 'http://localhost/znzQC/img/Ironing/ironing.png', 'http://localhost/znzQC/img/DryCleaning/DryCleaning.png', 'http://localhost/znzQC/img/Drying/Drying.png', 'iftekhar', 'iftekhar', '2020-12-30 19:13:50');

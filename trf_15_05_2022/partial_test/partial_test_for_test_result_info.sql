/*
Navicat MySQL Data Transfer

Source Server         : MySQLDatabase
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : znz_fabrics

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-12-31 09:56:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `partial_test_for_test_result_info`
-- ----------------------------

CREATE TABLE `partial_test_for_test_result_info` (
  `partial_test_for_test_result_id` int(50) NOT NULL AUTO_INCREMENT,
  `partial_test_for_test_result_creation_date` date NOT NULL,
  `alternate_partial_test_for_test_result_creation_date_time` varchar(30) NOT NULL,
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
  PRIMARY KEY (`partial_test_for_test_result_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of partial_test_for_test_result_info
-- ----------------------------
INSERT INTO `partial_test_for_test_result_info` VALUES ('1', '2020-12-27', '03:45 PM', '0', 'C', 'Ready For Dyeing', '6038/2020', 'Pillow Back', '2048', 'JATTELIK DINO BLUE', 'Ikea', 'Cotton:0 Polyester:0 Other0', '103', '2', '2', '100000', 'Monforts-1', 'Regular', 'http://localhost/znzQC/img/washing/washing.png', 'http://localhost/znzQC/img/bleaching/bleaching.png', 'http://localhost/znzQC/img/Ironing/ironing.png', 'http://localhost/znzQC/img/DryCleaning/DryCleaning.png', 'http://localhost/znzQC/img/Drying/Drying.png', 'iftekhar', 'iftekhar', '2020-12-28 17:45:12');
INSERT INTO `partial_test_for_test_result_info` VALUES ('2', '2020-12-30', '14:30', '0', 'A', 'Dyeing', '5893/2020', 'Pillow Back', '2044', 'Jattelik Dino White', 'Ikea', 'Cotton:0 Polyester:0 Other0', '57', '1', '2', '100000', 'Thermosol-2', 'Express', 'http://localhost/znzQC/img/washing/washing11.png', 'http://localhost/znzQC/img/bleaching/bleaching.png', 'http://localhost/znzQC/img/Ironing/ironing.png', 'http://localhost/znzQC/img/DryCleaning/DryCleaning2.png', 'http://localhost/znzQC/img/Drying/Drying.png', 'iftekhar', 'iftekhar', '2020-12-30 19:15:54');

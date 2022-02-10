/*
Navicat MySQL Data Transfer

Source Server         : LocalhostMySql
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : srq

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-07-23 16:10:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for transactions
-- ----------------------------
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `tran_id` int(11) NOT NULL AUTO_INCREMENT,
  `tran_queue_number` int(6) unsigned zerofill NOT NULL,
  `tran_date` date DEFAULT NULL,
  `tran_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tran_id`),
  UNIQUE KEY `tran_queue_number` (`tran_queue_number`,`tran_date`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of transactions
-- ----------------------------
INSERT INTO `transactions` VALUES ('1', '000001', '2019-07-22', '2019-07-22 10:34:41');
INSERT INTO `transactions` VALUES ('2', '000002', '2019-07-22', '2019-07-22 10:46:41');
INSERT INTO `transactions` VALUES ('3', '000003', '2019-07-22', '2019-07-22 13:07:08');
INSERT INTO `transactions` VALUES ('4', '000004', '2019-07-22', '2019-07-22 13:07:40');
INSERT INTO `transactions` VALUES ('5', '000005', '2019-07-22', '2019-07-22 13:07:56');
INSERT INTO `transactions` VALUES ('6', '000006', '2019-07-22', '2019-07-22 13:08:13');
INSERT INTO `transactions` VALUES ('7', '000007', '2019-07-22', '2019-07-22 13:08:19');
INSERT INTO `transactions` VALUES ('8', '000008', '2019-07-22', '2019-07-22 13:48:08');

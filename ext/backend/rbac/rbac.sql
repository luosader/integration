/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : rbac

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2017-08-16 14:03:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for qx_juese
-- ----------------------------
DROP TABLE IF EXISTS `qx_juese`;
CREATE TABLE `qx_juese` (
  `code` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of qx_juese
-- ----------------------------
INSERT INTO `qx_juese` VALUES ('1', '超管');
INSERT INTO `qx_juese` VALUES ('2', '管理员');
INSERT INTO `qx_juese` VALUES ('3', '编辑');

-- ----------------------------
-- Table structure for qx_jwr
-- ----------------------------
DROP TABLE IF EXISTS `qx_jwr`;
CREATE TABLE `qx_jwr` (
  `ids` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `jueseid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '角色id',
  `ruleid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '功能id',
  PRIMARY KEY (`ids`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COMMENT='角色与功能的关系表';

-- ----------------------------
-- Records of qx_jwr
-- ----------------------------
INSERT INTO `qx_jwr` VALUES ('1', '1', '1');
INSERT INTO `qx_jwr` VALUES ('2', '1', '2');
INSERT INTO `qx_jwr` VALUES ('3', '1', '3');
INSERT INTO `qx_jwr` VALUES ('4', '1', '4');
INSERT INTO `qx_jwr` VALUES ('5', '1', '5');
INSERT INTO `qx_jwr` VALUES ('6', '1', '6');
INSERT INTO `qx_jwr` VALUES ('7', '1', '7');
INSERT INTO `qx_jwr` VALUES ('8', '1', '8');
INSERT INTO `qx_jwr` VALUES ('9', '1', '9');
INSERT INTO `qx_jwr` VALUES ('10', '1', '10');
INSERT INTO `qx_jwr` VALUES ('11', '1', '11');
INSERT INTO `qx_jwr` VALUES ('12', '1', '12');
INSERT INTO `qx_jwr` VALUES ('13', '1', '13');
INSERT INTO `qx_jwr` VALUES ('14', '1', '14');
INSERT INTO `qx_jwr` VALUES ('15', '1', '15');
INSERT INTO `qx_jwr` VALUES ('16', '1', '16');
INSERT INTO `qx_jwr` VALUES ('36', '3', '6');
INSERT INTO `qx_jwr` VALUES ('35', '3', '5');
INSERT INTO `qx_jwr` VALUES ('34', '3', '3');
INSERT INTO `qx_jwr` VALUES ('20', '2', '2');
INSERT INTO `qx_jwr` VALUES ('21', '2', '3');
INSERT INTO `qx_jwr` VALUES ('22', '2', '4');
INSERT INTO `qx_jwr` VALUES ('23', '2', '5');
INSERT INTO `qx_jwr` VALUES ('24', '2', '6');
INSERT INTO `qx_jwr` VALUES ('25', '2', '7');
INSERT INTO `qx_jwr` VALUES ('26', '2', '8');
INSERT INTO `qx_jwr` VALUES ('27', '2', '9');
INSERT INTO `qx_jwr` VALUES ('28', '2', '10');
INSERT INTO `qx_jwr` VALUES ('29', '2', '11');
INSERT INTO `qx_jwr` VALUES ('30', '2', '12');
INSERT INTO `qx_jwr` VALUES ('31', '2', '14');
INSERT INTO `qx_jwr` VALUES ('32', '2', '15');
INSERT INTO `qx_jwr` VALUES ('33', '2', '16');
INSERT INTO `qx_jwr` VALUES ('37', '3', '10');

-- ----------------------------
-- Table structure for qx_rules
-- ----------------------------
DROP TABLE IF EXISTS `qx_rules`;
CREATE TABLE `qx_rules` (
  `code` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='功能表';

-- ----------------------------
-- Records of qx_rules
-- ----------------------------
INSERT INTO `qx_rules` VALUES ('1', '系统设置');
INSERT INTO `qx_rules` VALUES ('2', '导航管理');
INSERT INTO `qx_rules` VALUES ('3', '幻灯片');
INSERT INTO `qx_rules` VALUES ('4', '单页管理');
INSERT INTO `qx_rules` VALUES ('5', '产品管理');
INSERT INTO `qx_rules` VALUES ('6', '文章管理');
INSERT INTO `qx_rules` VALUES ('7', '招聘管理');
INSERT INTO `qx_rules` VALUES ('8', '应用管理');
INSERT INTO `qx_rules` VALUES ('9', '研发管理');
INSERT INTO `qx_rules` VALUES ('10', '留言反馈');
INSERT INTO `qx_rules` VALUES ('11', '购物车');
INSERT INTO `qx_rules` VALUES ('12', '会员管理');
INSERT INTO `qx_rules` VALUES ('13', '数据备份');
INSERT INTO `qx_rules` VALUES ('14', '管理员管理');
INSERT INTO `qx_rules` VALUES ('15', '权限管理');
INSERT INTO `qx_rules` VALUES ('16', '操作记录');

-- ----------------------------
-- Table structure for qx_uij
-- ----------------------------
DROP TABLE IF EXISTS `qx_uij`;
CREATE TABLE `qx_uij` (
  `ids` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `useid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `jueseid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '角色id',
  PRIMARY KEY (`ids`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='用户与角色的关系表';

-- ----------------------------
-- Records of qx_uij
-- ----------------------------
INSERT INTO `qx_uij` VALUES ('1', '1', '1');
INSERT INTO `qx_uij` VALUES ('2', '2', '2');
INSERT INTO `qx_uij` VALUES ('3', '3', '3');
INSERT INTO `qx_uij` VALUES ('4', '4', '2');
INSERT INTO `qx_uij` VALUES ('5', '4', '3');

-- ----------------------------
-- Table structure for qx_user
-- ----------------------------
DROP TABLE IF EXISTS `qx_user`;
CREATE TABLE `qx_user` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pwd` varchar(32) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of qx_user
-- ----------------------------
INSERT INTO `qx_user` VALUES ('1', '123456', 'admin');
INSERT INTO `qx_user` VALUES ('2', '123456', 'lothar');
INSERT INTO `qx_user` VALUES ('3', '123456', 'ask1');
INSERT INTO `qx_user` VALUES ('4', '123456', 'ask2');
INSERT INTO `qx_user` VALUES ('5', '123456', 'ask3');

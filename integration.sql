/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : integration

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-06-11 00:46:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ig_article
-- ----------------------------
DROP TABLE IF EXISTS `ig_article`;
CREATE TABLE `ig_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(11) unsigned DEFAULT NULL COMMENT '分类id',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `brief` varchar(255) NOT NULL DEFAULT '' COMMENT '简介',
  `details` varchar(255) NOT NULL DEFAULT '' COMMENT '详情',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '提交时间',
  `modtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `ip` varchar(15) NOT NULL DEFAULT '' COMMENT 'IP地址',
  `uid` int(11) DEFAULT NULL COMMENT '编者id',
  `d1` tinyint(1) NOT NULL DEFAULT '0' COMMENT '备用1',
  `d2` tinyint(1) NOT NULL DEFAULT '0' COMMENT '备用2',
  `d3` tinyint(1) NOT NULL DEFAULT '0' COMMENT '备用3',
  `d4` tinyint(1) NOT NULL DEFAULT '0' COMMENT '备用4',
  `d5` tinyint(1) NOT NULL DEFAULT '0' COMMENT '备用5',
  `is_rec` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态设定：-1隐藏 0普通 1推荐 ',
  `tpls` varchar(255) NOT NULL DEFAULT 'default' COMMENT '该分类所处模板',
  `recycle` tinyint(1) NOT NULL DEFAULT '0' COMMENT '类似777权限：读=用户，写=商户，执行=管理员',
  `ext` varchar(255) NOT NULL DEFAULT '' COMMENT '拓展序列化',
  `lang_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '语言包id',
  `seo_title` varchar(255) NOT NULL DEFAULT '' COMMENT 'SEO优化标题',
  `seo_keywords` varchar(255) NOT NULL DEFAULT '' COMMENT 'SEO优化关键词',
  `seo_description` varchar(255) NOT NULL DEFAULT '' COMMENT 'SEO优化描述',
  PRIMARY KEY (`id`),
  KEY `idx_1` (`name`),
  KEY `idx_2` (`addtime`),
  KEY `idx_3` (`uid`),
  KEY `idx_4` (`is_rec`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ig_article
-- ----------------------------
INSERT INTO `ig_article` VALUES ('1', null, '自定义', '', '', '1440518400', '0', '127.0.0.1', '1', '0', '0', '0', '0', '0', '0', 'default', '0', '', '0', '', '', '');
INSERT INTO `ig_article` VALUES ('2', null, '通用', '', '', '1483200000', '0', '106.14.74.155', null, '0', '0', '0', '0', '0', '0', 'default', '7', '', '0', '', '', '');
INSERT INTO `ig_article` VALUES ('3', null, '模板', '', '', '1497106425', '0', '', null, '0', '0', '0', '0', '0', '0', 'default', '0', '', '0', '', '', '');

-- ----------------------------
-- Table structure for ig_category
-- ----------------------------
DROP TABLE IF EXISTS `ig_category`;
CREATE TABLE `ig_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `pid` int(11) unsigned DEFAULT NULL COMMENT '上级id',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '名字',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '提交时间',
  `ip` varchar(15) NOT NULL DEFAULT '' COMMENT 'IP地址',
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '编者id',
  `brief` varchar(255) NOT NULL DEFAULT '' COMMENT '简介',
  `is_rec` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态设定：-1隐藏 0普通 1推荐 ',
  `tpls` varchar(255) NOT NULL DEFAULT 'default' COMMENT '该分类所处模板',
  `ext` tinytext NOT NULL COMMENT '拓展序列化',
  `lang_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '语言包id',
  `seo_title` varchar(255) NOT NULL DEFAULT '' COMMENT 'SEO优化标题',
  `seo_keywords` varchar(255) NOT NULL DEFAULT '' COMMENT 'SEO优化关键词',
  `seo_description` varchar(255) NOT NULL DEFAULT '' COMMENT 'SEO优化描述',
  PRIMARY KEY (`id`),
  KEY `idx_1` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ig_category
-- ----------------------------

-- ----------------------------
-- Table structure for ig_file
-- ----------------------------
DROP TABLE IF EXISTS `ig_file`;
CREATE TABLE `ig_file` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '文件编号',
  `filename` varchar(100) NOT NULL DEFAULT '' COMMENT '源文件名',
  `savename` varchar(100) NOT NULL DEFAULT '' COMMENT '保存的文件名',
  `filetype` varchar(25) NOT NULL DEFAULT '文件类型',
  `group` varchar(25) NOT NULL DEFAULT '' COMMENT '组别',
  `obj_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '对象编号',
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户编号',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上传时间',
  PRIMARY KEY (`id`),
  KEY `idx_1` (`obj_id`),
  KEY `idx_2` (`uid`),
  KEY `idx_3` (`addtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文件表';

-- ----------------------------
-- Records of ig_file
-- ----------------------------

-- ----------------------------
-- Table structure for ig_sys_config
-- ----------------------------
DROP TABLE IF EXISTS `ig_sys_config`;
CREATE TABLE `ig_sys_config` (
  `k` char(50) NOT NULL COMMENT '配置键',
  `v` text COMMENT '配置值',
  `type` char(20) DEFAULT NULL,
  `desc` text,
  `listorder` int(11) unsigned NOT NULL DEFAULT '1',
  KEY `idx_1` (`k`),
  KEY `idx_2` (`type`),
  KEY `idx_3` (`listorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ig_sys_config
-- ----------------------------

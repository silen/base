# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.7.10)
# Database: yimei
# Generation Time: 2016-05-26 02:40:02 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table app_admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `app_admin`;

CREATE TABLE `app_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL DEFAULT '0' COMMENT 'username',
  `password` varchar(100) NOT NULL DEFAULT '0' COMMENT 'password',
  `email` varchar(100) NOT NULL DEFAULT '0' COMMENT 'email',
  `mobile` varchar(100) NOT NULL DEFAULT '0' COMMENT 'email',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后修改时间',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `app_admin` WRITE;
/*!40000 ALTER TABLE `app_admin` DISABLE KEYS */;

INSERT INTO `app_admin` (`id`, `username`, `password`, `email`, `mobile`, `add_time`, `update_time`, `status`, `group_id`)
VALUES
	(1,'silen','bf49c00ae1fd8988c2614651af1e3196','silenme@vip.qq.com','15815814114',1449303461,1460905109,1,1),
	(3,'admin','6b266d8cb5dc8201996983dddb49b296','admin@hacder.com','13760892454',1450273537,1460905103,1,1),
	(4,'p2','d36282c84e3f30ec9f6bfdcbfccbef9a','p2@gdws.com','15815819314',1460944891,1460966299,1,5);

/*!40000 ALTER TABLE `app_admin` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table app_auth_group
# ------------------------------------------------------------

DROP TABLE IF EXISTS `app_auth_group`;

CREATE TABLE `app_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组id,自增主键',
  `module` varchar(20) NOT NULL DEFAULT 'mt' COMMENT '用户组所属模块',
  `type` tinyint(4) NOT NULL COMMENT '组类型',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '用户组中文名称',
  `description` varchar(80) NOT NULL DEFAULT '' COMMENT '描述信息',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户组状态：为1正常，为0禁用,-1为删除',
  `rules` varchar(500) NOT NULL DEFAULT '' COMMENT '用户组拥有的规则id，多个规则 , 隔开',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `app_auth_group` WRITE;
/*!40000 ALTER TABLE `app_auth_group` DISABLE KEYS */;

INSERT INTO `app_auth_group` (`id`, `module`, `type`, `title`, `description`, `status`, `rules`)
VALUES
	(1,'mt',1,'超级管理员','',1,'397,398,399,400,401,402,403,404,405,407,408,412,413,414,415,416,417,418,419,420,421,422,423,424,425,426,427,428,429,430'),
	(5,'mt',1,'活动2用户','普通用户',1,'407,413,417,418,419,420,421,422,423,424,425,426,427,428,429,430');

/*!40000 ALTER TABLE `app_auth_group` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table app_auth_rule
# ------------------------------------------------------------

DROP TABLE IF EXISTS `app_auth_rule`;

CREATE TABLE `app_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '规则id,自增主键',
  `module` varchar(20) NOT NULL DEFAULT 'mt' COMMENT '规则所属module',
  `is_menu` tinyint(2) NOT NULL DEFAULT '1' COMMENT '菜单',
  `name` char(200) NOT NULL DEFAULT '' COMMENT '规则唯一英文标识',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '规则中文描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否有效(0:无效,1:有效)',
  `condition` varchar(300) NOT NULL DEFAULT '' COMMENT '规则附加条件',
  `sort` smallint(3) NOT NULL DEFAULT '1' COMMENT '排序',
  `pid` int(10) NOT NULL DEFAULT '1' COMMENT '上一级id',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1-url;2-主菜单',
  PRIMARY KEY (`id`),
  KEY `module` (`module`,`status`,`is_menu`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `app_auth_rule` WRITE;
/*!40000 ALTER TABLE `app_auth_rule` DISABLE KEYS */;

INSERT INTO `app_auth_rule` (`id`, `module`, `is_menu`, `name`, `title`, `status`, `condition`, `sort`, `pid`, `type`)
VALUES
	(397,'mt',1,'admin/index','管理员管理',1,'',1,0,1),
	(398,'mt',0,'admin/add','添加',1,'',0,397,1),
	(399,'mt',0,'del','删除',1,'',0,397,1),
	(400,'mt',1,'admin/index','列表',1,'',1,397,1),
	(401,'mt',1,'admin/group','群组权限',1,'',2,397,1),
	(402,'mt',1,'rule/index','后台节点设置',1,'',2,0,1),
	(403,'mt',0,'rule/add','添加',1,'',0,402,1),
	(404,'mt',0,'rule/del','删除',1,'',0,402,1),
	(405,'mt',1,'rule/index','列表',1,'',1,402,1),
	(407,'mt',1,'index/index','首页',1,'',0,0,1),
	(408,'mt',0,'admin/writeAccess','加入节点',1,'',0,397,1),
	(412,'mt',0,'admin/auth','权限列表',1,'',0,397,1),
	(413,'mt',1,'admin/info','个人设置',1,'',0,397,1),
	(414,'Mt',0,'tool/upload','upload',1,'',0,415,1),
	(415,'Mt',0,'tool','工具',1,'',0,0,1);

/*!40000 ALTER TABLE `app_auth_rule` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

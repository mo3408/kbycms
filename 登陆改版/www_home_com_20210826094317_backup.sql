-- MySQL dump 10.13  Distrib 5.7.26, for Win64 (x86_64)
--
-- Host: localhost    Database: www_home_com
-- ------------------------------------------------------
-- Server version	5.7.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tp_ad`
--

DROP TABLE IF EXISTS `tp_ad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_ad` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '广告ID',
  `ad_name` varchar(60) DEFAULT NULL COMMENT '广告名称 ',
  `on` tinyint(1) DEFAULT '1' COMMENT '广告是否开户，0否 1是',
  `type` tinyint(1) DEFAULT '1' COMMENT '广告类型1图片 2轮播',
  `img_src` varchar(150) DEFAULT NULL COMMENT '图片地址',
  `link` varchar(100) DEFAULT NULL COMMENT '广告连接地址',
  `adpos_id` smallint(5) unsigned DEFAULT NULL COMMENT '所属广告位',
  PRIMARY KEY (`id`),
  KEY `adpos_id` (`adpos_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_ad`
--

LOCK TABLES `tp_ad` WRITE;
/*!40000 ALTER TABLE `tp_ad` DISABLE KEYS */;
INSERT INTO `tp_ad` VALUES (39,'首页banner(尺寸：1920*1080px)',1,2,NULL,'',6);
/*!40000 ALTER TABLE `tp_ad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_adflash`
--

DROP TABLE IF EXISTS `tp_adflash`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_adflash` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '动画广告ID',
  `fimg_src` varchar(150) DEFAULT NULL COMMENT '动画广告图片路径',
  `flink` varchar(100) DEFAULT NULL COMMENT '动画广告图片连接地址',
  `title` varchar(60) DEFAULT NULL,
  `ad_id` smallint(6) DEFAULT NULL COMMENT '所属广告ID',
  `sort` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ad_id` (`ad_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=104 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_adflash`
--

LOCK TABLES `tp_adflash` WRITE;
/*!40000 ALTER TABLE `tp_adflash` DISABLE KEYS */;
INSERT INTO `tp_adflash` VALUES (102,'20200330\\794cac5c467e80d7f14659e477aab9d0.jpg','qwreqw','',39,0),(103,'20200330\\545663586ea34e99a2c0b6a1dd059fb9.jpg','qweq','',39,999);
/*!40000 ALTER TABLE `tp_adflash` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_admin`
--

DROP TABLE IF EXISTS `tp_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_admin` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `uname` varchar(20) DEFAULT NULL COMMENT '用户名',
  `password` char(32) DEFAULT NULL COMMENT '密码',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `last_time` int(10) DEFAULT NULL COMMENT '最后登录时间',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态1正常 2禁用',
  `groupid` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index` (`groupid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_admin`
--

LOCK TABLES `tp_admin` WRITE;
/*!40000 ALTER TABLE `tp_admin` DISABLE KEYS */;
INSERT INTO `tp_admin` VALUES (1,'kbmanager','e10adc3949ba59abbe56e057f20f883e',1508924008,1629941169,1,1),(4,'admin','e10adc3949ba59abbe56e057f20f883e',1508987069,1573635245,1,2),(11,'test11','e10adc3949ba59abbe56e057f20f883e',1571124802,1571124802,1,2),(12,'test22333','e10adc3949ba59abbe56e057f20f883e',1571125047,1571125047,1,2);
/*!40000 ALTER TABLE `tp_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_adpos`
--

DROP TABLE IF EXISTS `tp_adpos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_adpos` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '广告位ID',
  `name` varchar(60) DEFAULT NULL COMMENT '广告位名称',
  `height` smallint(6) DEFAULT NULL COMMENT '广告位高度',
  `width` smallint(6) DEFAULT NULL COMMENT '广告位宽度',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_adpos`
--

LOCK TABLES `tp_adpos` WRITE;
/*!40000 ALTER TABLE `tp_adpos` DISABLE KEYS */;
INSERT INTO `tp_adpos` VALUES (6,'首页banner',600,1400);
/*!40000 ALTER TABLE `tp_adpos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_archives`
--

DROP TABLE IF EXISTS `tp_archives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_archives` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `title` varchar(150) DEFAULT NULL COMMENT '标题',
  `keywords` varchar(150) DEFAULT NULL COMMENT '关键词',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `top` tinyint(1) DEFAULT '0',
  `writer` varchar(60) DEFAULT NULL COMMENT '作者',
  `mp4_file` char(50) DEFAULT NULL,
  `source` varchar(150) DEFAULT NULL COMMENT '来源',
  `link` varchar(500) DEFAULT NULL,
  `a_img` text COMMENT '缩略图',
  `attr` varchar(30) DEFAULT NULL COMMENT '文档属性',
  `click` mediumint(255) DEFAULT '0' COMMENT '点击量',
  `content` longtext COMMENT '内容',
  `cate_id` mediumint(9) DEFAULT NULL COMMENT '所性栏目',
  `all_img` varchar(5000) DEFAULT NULL,
  `model_id` mediumint(9) DEFAULT NULL COMMENT '所属模型',
  `time` int(10) DEFAULT NULL COMMENT '发布时间',
  `sort` int(6) DEFAULT '0' COMMENT '排序',
  `home` tinyint(1) DEFAULT '0' COMMENT '是否推荐到首页是：1 否：0',
  `show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示是：1 否：0',
  `base_id` int(11) DEFAULT NULL COMMENT '关联题库ID',
  `class_id` int(11) DEFAULT NULL COMMENT '关联分类ID',
  `related` tinyint(1) DEFAULT '0' COMMENT '相关数据',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=404 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_archives`
--

LOCK TABLES `tp_archives` WRITE;
/*!40000 ALTER TABLE `tp_archives` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_archives` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_auth_group`
--

DROP TABLE IF EXISTS `tp_auth_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` varchar(2000) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_auth_group`
--

LOCK TABLES `tp_auth_group` WRITE;
/*!40000 ALTER TABLE `tp_auth_group` DISABLE KEYS */;
INSERT INTO `tp_auth_group` VALUES (1,'超级管理员',1,'1,2,5,6,67,48,49,59,68,82,7,31,32,56,57,58,8,9,10,11,12,43,44,46,47,74,75,76,77,88,89,90,91,92,101,13,14,15,16,17,41,42,51,60,72,73,78,79,81,85,86,18,19,20,21,22,52,26,27,53,54,55,71,83,87,28,29,30,50,80,33,34,35,36,37,38,100,45,61,62,63,64,66,69,70,99,40,23,24,25,65,84,93,94,95,96,97,98,102,103,104,105,106'),(2,'系统管理员',1,'1,2,5,6,59,68,82,8,9,10,11,12,43,44,46,47,74,75,76,77,88,89,90,91,92,101,13,41,42,51,60,72,73,78,79,81,85,86,26,55,36,37,38,100,45,61,62,63,64,66,69,70,99,84,93,94,95,96,97,98');
/*!40000 ALTER TABLE `tp_auth_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_auth_group_access`
--

DROP TABLE IF EXISTS `tp_auth_group_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE,
  KEY `group_id` (`group_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_auth_group_access`
--

LOCK TABLES `tp_auth_group_access` WRITE;
/*!40000 ALTER TABLE `tp_auth_group_access` DISABLE KEYS */;
INSERT INTO `tp_auth_group_access` VALUES (1,1),(4,2),(11,2),(12,2);
/*!40000 ALTER TABLE `tp_auth_group_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_auth_rule`
--

DROP TABLE IF EXISTS `tp_auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '规则ID',
  `name` char(80) NOT NULL DEFAULT '' COMMENT '规则',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '规则名称',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '规则类型',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否启用:1:启用 0：不启用',
  `condition` char(100) NOT NULL DEFAULT '',
  `pid` mediumint(8) NOT NULL DEFAULT '0' COMMENT '上级规则ID顶级为0',
  `icon` varchar(15) DEFAULT NULL COMMENT '图标名称',
  `show` tinyint(1) DEFAULT '1' COMMENT '是否显示:1：显示  0：不显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=107 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_auth_rule`
--

LOCK TABLES `tp_auth_rule` WRITE;
/*!40000 ALTER TABLE `tp_auth_rule` DISABLE KEYS */;
INSERT INTO `tp_auth_rule` VALUES (1,'admin/Conf/conflst','系统设置',1,1,'',0,'fa-gear',1),(2,'admin/Conf/conflst','配置列表',1,1,'',1,'',1),(5,'admin/Conf/add','添加配置',1,1,'',2,'',0),(6,'admin/Conf/edit','编辑配置',1,1,'',2,'',1),(7,'admin/ModelFields','字段管理',1,1,'',0,'fa-tasks',1),(8,'admin/Content','文档管理',1,1,'',0,'fa-file-text',0),(9,'admin/Content/lst','文章列表',1,1,'',8,NULL,1),(10,'admin/Content/add','文章添加',1,1,'',8,'',0),(11,'admin/Content/edit','文章编辑',1,1,'',8,'',0),(12,'admin/Content/del','文章删除',1,1,'',8,'',0),(13,'admin/Cate/',' 栏目管理',1,1,'',0,'fa-sitemap',1),(14,'admin/Cate/lst','栏目列表',1,1,'',13,NULL,1),(15,'admin/Cate/add','栏目添加',1,1,'',13,NULL,1),(16,'admin/Cate/edit','栏目编辑',1,1,'',13,'',0),(17,'admin/Cate/del','栏目删除',1,1,'',13,NULL,0),(18,'admin/AuthRule','规则配置',1,1,'',0,'fa-lock',1),(19,'admin/AuthRule/lst','规则管理',1,1,'',18,NULL,1),(20,'admin/AuthRule/add','规则添加',1,1,'',18,'',0),(21,'admin/AuthRule/edit','规则编辑',1,1,'',18,'',0),(22,'admin/AuthRule/del','规则删除',1,1,'',18,'',0),(23,'admin/AuthGroup/lst','用户组管理',1,1,'',40,'',1),(24,'admin/AuthGroup/power','用户组权限编辑',1,1,'',40,'',0),(25,'admin/AuthGroup/del','用户组删除',1,1,'',40,'',0),(26,'admin/Admin/','管理员',1,1,'',0,'fa-user',1),(27,'admin/Admin/lst','管理员列表',1,1,'',26,NULL,1),(28,'admin/Model','模型管理',1,1,'',0,'fa-maxcdn',1),(29,'admin/Model/lst','模型列表',1,1,'',28,'',1),(30,'admin/Model/add','模型添加',1,1,'',28,'',1),(31,'admin/ModelFields/lst','字段列表',1,1,'',7,'',1),(32,'admin/ModelFields/add','字段添加',1,1,'',7,'',1),(33,'admin/Note','采集管理',1,1,'',0,'fa-bug',0),(34,'admin/Note/addlistrules','添加采集节点',1,1,'',33,'',1),(35,'admin/Note/notelist',' 采集节点列表',1,1,'',33,'',1),(36,'admin/Adpos','广告管理',1,1,'',0,'fa-video-camera',1),(37,'admin/Adpos/lst','广告位管理',1,1,'',36,'',1),(38,'admin/Ad/lst','广告列表管理',1,1,'',36,'',1),(40,'admin/AuthGroup/lst','用户组配置',1,1,'',0,'fa-group',1),(41,'admin/Cate/changestatus','栏目ajax修改',1,1,'',13,'',0),(42,'admin/Cate/ajaxlst','ajax获取子栏目ID',1,1,'',13,'',0),(43,'admin/Content/ajaxDelImg','文档图片ajax删除',1,1,'',8,'',0),(44,'admin/Content/upimg','ajax上传图片',1,1,'',8,'',0),(45,'admin/Ad/ajaxdel','ajax删除图片',1,1,'',36,'',0),(46,'admin/Content/addselect','添加文章',1,1,'',8,'',1),(47,'admin/Content/ajaxGetModelId','ajax获取modelid',1,1,'',8,'',0),(48,'admin/Conf/cftype','配置分类',1,1,'',1,'',1),(49,'admin/Conf/lst','设置字段',1,1,'',1,'',1),(50,'admin/Model/edit','编辑模型',1,1,'',28,'',0),(51,'admin/Cate/upimg','栏目ajax上传图片',1,1,'',13,'',0),(52,'admin/AuthRule/ajaxlst','栏目展开',1,1,'',18,'',0),(53,'admin/Admin/changeStatus','状态修改',1,1,'',26,'',0),(54,'admin/Admin/add','添加管理员',1,1,'',26,'',0),(55,'admin/Admin/edit','编辑管理员',1,1,'',26,'',0),(56,'admin/ModelFields/edit','字段编辑',1,1,'',7,'',0),(57,'admin/ModelFields/del','字段删除',1,1,'',7,'',0),(58,'admin/ModelFields/ajaxdel','ajax删除字段',1,1,'',7,'',0),(59,'admin/Index/index','后台首页',1,1,'',1,'',0),(60,'admin/Cate/del_sort','栏目批量排序',1,1,'',13,'',0),(61,'admin/Adpos/add','广告位添加',1,1,'',36,'',0),(62,'admin/Ad/add','广告添加',1,1,'',36,'',0),(63,'admin/Ad/edit','广告编辑',1,1,'',36,'',0),(64,'admin/Ad/changeStatus','ajax广告状态修改',1,1,'',36,'',0),(65,'admin/AuthGroup/edit','用户组编辑',1,1,'',40,'',0),(66,'admin/Adpos/edit',' 广告位编辑',1,1,'',36,'',0),(67,'admin/Conf/del','配置删除',1,1,'',2,'',0),(68,'admin/Admin/logout','系统退出',1,1,'',1,'',0),(69,'admin/Adpos/del','广告位删除',1,1,'',36,'',0),(70,'admin/Ad/del','广告删除',1,1,'',36,'',0),(71,'admin/Admin/del','管理员删除',1,1,'',26,'',0),(72,'admin/Cate/ajaxcateinfo','栏目模版继承',1,1,'',13,'',0),(73,'admin/Cate/delimg','ajax栏目图片删除',1,1,'',13,'',0),(74,'admin/Content/examine','查看文章详细',1,1,'',8,'',0),(75,'admin/Content/edits','站点文档管理',1,1,'',8,'',0),(76,'admin/Content/adds','站点文档添加',1,1,'',8,'',0),(77,'admin/Content/lsts','站点文章列表查看',1,1,'',8,'',0),(78,'admin/Cate/catelist','站点栏目管理',1,1,'',13,'',1),(79,'admin/Cate/edits','站点栏目编辑',1,1,'',13,'',0),(80,'admin/Model/ajaxdel','删除模型',1,1,'',28,'',0),(81,'admin/Cate/adds','站点栏目添加',1,1,'',13,'',0),(82,'admin/Conf/bak','数据库备份',1,1,'',1,'',1),(83,'admin/Admin/operation','操作日志',1,1,'',26,'',1),(84,'admin/Message/index','查看留言',1,1,'',0,'fa-envelope-o',1),(85,'admin/Cate/dels','站点管理删除栏目',1,1,'',13,'',0),(86,'admin/Cate/endels','站点管理删除英文栏目',1,1,'',13,'',0),(87,'admin/Admin/dellstoperation','删除日志',1,1,'',26,'',0),(88,'admin/Content/show_sort','站点管理批量修改显示状态',1,1,'',8,'',0),(89,'admin/Content/home_sort','站点管理批量修改推荐状态',1,1,'',8,'',0),(90,'admin/Content/dels_sort','站点管理批量删除内容',1,1,'',8,'',0),(91,'admin/Content/arshow','站点管理ajax异步修改内容显示状态',1,1,'',8,'',0),(92,'admin/Content/arhome','站点管理ajax异步修改内容推荐状态',1,1,'',8,'',0),(93,'admin/Message/index','留言列表',1,1,'',84,'',1),(94,'admin/classify/index','分类管理',1,1,'',0,'',0),(95,'admin/classify/adds','分类添加',1,1,'',94,'',0),(96,'admin/classify/changestatus','状态',1,1,'',94,'',0),(97,'admin/classify/del','删除',1,1,'',94,'',0),(98,'admin/classify/edits','修改',1,1,'',94,'',0),(99,'admin/ad/uploadimg','图片上传',1,1,'',36,'',0),(100,'admin/ad/upd','编辑',1,1,'',38,'',0),(101,'admin/content/top','置顶',1,1,'',8,'',0),(102,'admin/users/index','注册管理',1,1,'',0,'fa-user-o',1),(103,'admin/users/add','注册管理增加',1,1,'',102,'',0),(104,'admin/users/index','注册列表',1,1,'',102,'',1),(105,'admin/users/edit','注册编辑',1,1,'',102,'',0),(106,'admin/users/del','注册删除',1,1,'',102,'',0);
/*!40000 ALTER TABLE `tp_auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_cate`
--

DROP TABLE IF EXISTS `tp_cate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_cate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '栏目ID',
  `cate_name` varchar(300) NOT NULL COMMENT '栏目名称',
  `cate_ename` varchar(300) DEFAULT NULL,
  `language` varchar(2) DEFAULT 'cn' COMMENT '语言版本',
  `title` varchar(500) DEFAULT NULL COMMENT '栏目标题',
  `keywords` varchar(500) DEFAULT NULL COMMENT '关键词',
  `desc` varchar(255) DEFAULT NULL COMMENT '描述',
  `content` text COMMENT '内容',
  `jump_id` int(10) DEFAULT '0' COMMENT '跳转到哪个栏目：0为不跳转',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态：1显示0不显示',
  `programa` tinyint(1) DEFAULT '1' COMMENT '是否左侧栏目显示1:显示  0：不显示',
  `cate_file` varchar(150) DEFAULT NULL COMMENT '附件',
  `img` varchar(150) DEFAULT NULL COMMENT '栏目图片',
  `cate_attr` tinyint(1) DEFAULT '1' COMMENT '属性：1列表、2封面3外链栏目',
  `list_tmp` varchar(60) DEFAULT NULL COMMENT '列表模版',
  `article_tmp` varchar(60) DEFAULT NULL COMMENT '频道模版',
  `index_tmp` varchar(60) DEFAULT NULL COMMENT '内容页模版',
  `level` tinyint(1) DEFAULT NULL,
  `sort` smallint(6) DEFAULT '999' COMMENT '排序',
  `link` varchar(150) DEFAULT NULL COMMENT '外链地址',
  `model_id` mediumint(9) DEFAULT NULL COMMENT '新上所属模型',
  `pid` int(10) unsigned DEFAULT '0' COMMENT '上级ID',
  `bottom_nav` tinyint(1) DEFAULT '0' COMMENT '是否底部导航否：0   是：1',
  `icon` varchar(15) DEFAULT 'fa-th-list' COMMENT '栏目图标',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=363 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_cate`
--

LOCK TABLES `tp_cate` WRITE;
/*!40000 ALTER TABLE `tp_cate` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_cate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_cftype`
--

DROP TABLE IF EXISTS `tp_cftype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_cftype` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '字段ID',
  `cf_type` varchar(60) DEFAULT NULL COMMENT '字段类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_cftype`
--

LOCK TABLES `tp_cftype` WRITE;
/*!40000 ALTER TABLE `tp_cftype` DISABLE KEYS */;
INSERT INTO `tp_cftype` VALUES (1,'站点基本信息'),(3,'SEO设置');
/*!40000 ALTER TABLE `tp_cftype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_class`
--

DROP TABLE IF EXISTS `tp_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  `content` text,
  `sort` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `img` char(255) DEFAULT NULL,
  `add_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=111 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_class`
--

LOCK TABLES `tp_class` WRITE;
/*!40000 ALTER TABLE `tp_class` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_conf`
--

DROP TABLE IF EXISTS `tp_conf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_conf` (
  `id` mediumint(11) NOT NULL AUTO_INCREMENT COMMENT '配置项ID',
  `cname` varchar(60) DEFAULT NULL COMMENT '中文名称',
  `ename` varchar(30) DEFAULT NULL COMMENT '英文名称',
  `value` text COMMENT '默认值',
  `values` varchar(255) DEFAULT NULL COMMENT '可选值',
  `dt_type` tinyint(1) DEFAULT '1' COMMENT '1、文本框2、单选3、筛选4、下拉菜单 5、文本域6、附件',
  `cf_type` tinyint(1) DEFAULT '1' COMMENT '1、基本信息2、联系方式3、SEO设置',
  `sort` smallint(6) DEFAULT NULL COMMENT '排序',
  `status` tinyint(1) DEFAULT '1' COMMENT '是否启用1:启用 0：不启用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_conf`
--

LOCK TABLES `tp_conf` WRITE;
/*!40000 ALTER TABLE `tp_conf` DISABLE KEYS */;
INSERT INTO `tp_conf` VALUES (9,'站点根网址','siteurl','','',1,1,999,0),(10,'静态保存路径','path','','',1,1,999,0),(11,'网站logo','logo','','',6,1,999,1),(12,'备案号','beian','','',1,1,0,1),(42,'版权','copyright','','',1,1,999,1),(16,'站点名称','sitename','','',1,3,99,1),(17,'关键词','keywords','11','',1,3,NULL,1),(18,'站点描述','desc','','',5,3,NULL,1),(19,'开启缓存','ifcach','','是,否',2,1,999,0),(20,'关闭站点','close','否','是,否',2,1,999,1),(25,'允许添加水印','water','','是,否',2,1,999,0),(26,'水印位置','water_pos','','左上角,上居中,右上角,左居中,居中,右居中,左下角,下居中,右下角',2,1,999,0),(27,'水印透明度','tmd','','',1,1,999,0),(28,'水印图片','water_img','','',6,1,999,0),(29,'缩略图宽度','thumb_width','','',1,1,999,0),(30,'缩略图高度','thumb_height','','',1,1,999,0),(31,'缩略图裁剪方式','thumb_way','','等比例缩放,缩放后填充,居中裁剪,左上角裁剪,右下角裁剪,固定尺寸缩放',2,1,999,0),(32,'允许上传缩略图','thumb','','是,否',2,1,999,0),(34,'中文模板','temp','default','',1,1,999,1);
/*!40000 ALTER TABLE `tp_conf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_help`
--

DROP TABLE IF EXISTS `tp_help`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_help` (
  `aid` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_help`
--

LOCK TABLES `tp_help` WRITE;
/*!40000 ALTER TABLE `tp_help` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_help` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_message`
--

DROP TABLE IF EXISTS `tp_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` char(255) DEFAULT NULL,
  `tel` char(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` varchar(2000) DEFAULT NULL,
  `add_time` int(10) DEFAULT NULL,
  `ip` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_message`
--

LOCK TABLES `tp_message` WRITE;
/*!40000 ALTER TABLE `tp_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_model`
--

DROP TABLE IF EXISTS `tp_model`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_model` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT COMMENT '模型ID',
  `model_name` varchar(50) DEFAULT NULL COMMENT '模型名称',
  `table_name` varchar(50) DEFAULT NULL COMMENT '模型对应的表',
  `status` tinyint(1) DEFAULT '1' COMMENT '模型状态：1开户，0禁用',
  `cate_shows` varchar(50) DEFAULT NULL COMMENT '栏目设置:1:seo信息 2：栏目内容3：附栏目名称4：栏目图片5外链6：附件上传',
  `ad_shows` varchar(2000) DEFAULT NULL COMMENT '文章默认信息:1:推荐到首页 2:发布时间 3:关键词 4:描述 5：内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_model`
--

LOCK TABLES `tp_model` WRITE;
/*!40000 ALTER TABLE `tp_model` DISABLE KEYS */;
INSERT INTO `tp_model` VALUES (66,'新闻中心','newinfo',1,'[\"1\",\"4\"]','{\"4\":\"\\u63cf\\u8ff0\",\"5\":\"\\u5185\\u5bb9\",\"6\":\"\\u56fe\\u7247\"}');
/*!40000 ALTER TABLE `tp_model` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_model_fields`
--

DROP TABLE IF EXISTS `tp_model_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_model_fields` (
  `id` mediumint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '字段ID',
  `field_cname` varchar(60) DEFAULT NULL COMMENT '字段中文名',
  `field_ename` varchar(60) DEFAULT NULL COMMENT '字段英文名',
  `field_type` tinyint(1) DEFAULT '1' COMMENT '字段类型1、单选 2、单选 3、复选 4、下拉 5、文本域 6、附件 7、浮点弄 8、整型 9、长文本longtest',
  `field_values` varchar(255) DEFAULT NULL COMMENT '可选值',
  `model_id` mediumint(11) NOT NULL COMMENT '所属模型',
  `sort` smallint(6) DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `model_id` (`model_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_model_fields`
--

LOCK TABLES `tp_model_fields` WRITE;
/*!40000 ALTER TABLE `tp_model_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_model_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_newinfo`
--

DROP TABLE IF EXISTS `tp_newinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_newinfo` (
  `aid` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_newinfo`
--

LOCK TABLES `tp_newinfo` WRITE;
/*!40000 ALTER TABLE `tp_newinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_newinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_news`
--

DROP TABLE IF EXISTS `tp_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_news` (
  `aid` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_news`
--

LOCK TABLES `tp_news` WRITE;
/*!40000 ALTER TABLE `tp_news` DISABLE KEYS */;
INSERT INTO `tp_news` VALUES (408),(409);
/*!40000 ALTER TABLE `tp_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_operation_log`
--

DROP TABLE IF EXISTS `tp_operation_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_operation_log` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT '日志ID',
  `user` varchar(60) DEFAULT NULL COMMENT '用户名',
  `group` varchar(60) DEFAULT NULL COMMENT '用户组',
  `action` varchar(255) DEFAULT NULL COMMENT '执行的动作',
  `logip` varchar(15) DEFAULT NULL COMMENT '用户IP',
  `logtime` int(10) DEFAULT NULL COMMENT '执行动作的时间',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=1629 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_operation_log`
--

LOCK TABLES `tp_operation_log` WRITE;
/*!40000 ALTER TABLE `tp_operation_log` DISABLE KEYS */;
INSERT INTO `tp_operation_log` VALUES (1424,'kbmanager','1','登录成功！','::1',1572507113),(1425,'kbmanager','1','广告位ID为6编辑成功！','::1',1572507477),(1426,'kbmanager','1','广告位ID为6编辑成功！','::1',1572507484),(1427,'kbmanager','1','开启广告ID39成功！','::1',1572507496),(1428,'kbmanager','1','删除广告ID92成功！','::1',1572508046),(1429,'kbmanager','1','删除广告ID91成功！','::1',1572508049),(1430,'kbmanager','1','编辑广告ID39成功！','::1',1572508172),(1431,'kbmanager','1','删除广告ID88成功！','::1',1572508183),(1432,'kbmanager','1','编辑广告ID39成功！','::1',1572508192),(1433,'kbmanager','1','编辑广告ID39成功！','::1',1572508201),(1434,'kbmanager','1','编辑广告ID39成功！','::1',1572508395),(1435,'kbmanager','1','编辑广告ID39成功！','::1',1572508435),(1436,'kbmanager','1','添加广告ID47成功！','::1',1572508607),(1437,'kbmanager','1','开启广告ID39成功！','::1',1572508619),(1438,'kbmanager','1','开启广告ID47成功！','::1',1572508621),(1439,'kbmanager','1','开启广告ID39成功！','::1',1572508622),(1440,'kbmanager','1','开启广告ID47成功！','::1',1572508623),(1441,'kbmanager','1','开启广告ID39成功！','::1',1572508629),(1442,'kbmanager','1','开启广告ID39成功！','::1',1572508633),(1443,'kbmanager','1','开启广告ID47成功！','::1',1572508634),(1444,'kbmanager','1','开启广告ID47成功！','::1',1572508635),(1445,'kbmanager','1','开启广告ID39成功！','::1',1572508636),(1446,'kbmanager','1','开启广告ID47成功！','::1',1572508637),(1447,'kbmanager','1','开启广告ID39成功！','::1',1572508811),(1448,'kbmanager','1','开启广告ID47成功！','::1',1572508823),(1449,'kbmanager','1','广告位ID为14添加成功！','::1',1572508890),(1450,'kbmanager','1','编辑广告ID47成功！','::1',1572508925),(1451,'kbmanager','1','开启广告ID39成功！','::1',1572508927),(1452,'kbmanager','1','开启广告ID39成功！','::1',1572508929),(1453,'kbmanager','1','开启广告ID47成功！','::1',1572508931),(1454,'kbmanager','1','编辑广告ID47成功！','::1',1572509127),(1455,'kbmanager','1','模型ID65添加成功！','::1',1573204726),(1456,'kbmanager','1','栏目ID为352添加成功！','::1',1573204768),(1457,'kbmanager','1','栏目ID为353添加成功！','::1',1573205349),(1458,'kbmanager','1','栏目ID为352开启成功！','::1',1573205518),(1459,'kbmanager','1','栏目ID为352关闭成功！','::1',1573205519),(1460,'kbmanager','1','登录成功！','::1',1573278549),(1461,'kbmanager','1','修改配置成功','::1',1573280492),(1462,'kbmanager','1','栏目ID为354添加成功！','::1',1573280651),(1463,'kbmanager','1','栏目ID为355添加成功！','::1',1573280662),(1464,'kbmanager','1','栏目ID为356添加成功！','::1',1573280674),(1465,'kbmanager','1','栏目ID为357添加成功！','::1',1573280824),(1466,'kbmanager','1','栏目ID为353删除成功！','::1',1573280835),(1467,'kbmanager','1','栏目ID为357开启成功！','::1',1573280847),(1468,'kbmanager','1','栏目ID为357关闭成功！','::1',1573280848),(1469,'kbmanager','1','模型ID65修改成功！','::1',1573281040),(1470,'kbmanager','1','栏目ID为删除成功！','::1',1573283352),(1471,'kbmanager','1','栏目ID为删除成功！','::1',1573283362),(1472,'kbmanager','1','栏目ID为删除成功！','::1',1573283381),(1473,'kbmanager','1','栏目ID为358添加成功！','::1',1573283407),(1474,'kbmanager','1','栏目ID为删除成功！','::1',1573283412),(1475,'kbmanager','1','登录成功！','::1',1573435259),(1476,'kbmanager','1','文章ID387添加成功！','::1',1573435301),(1477,'kbmanager','1','内容ID为387置顶成功！','::1',1573435307),(1478,'kbmanager','1','内容ID为387关闭成功！','::1',1573436649),(1479,'kbmanager','1','内容ID为387开启成功！','::1',1573436650),(1480,'kbmanager','1','文章ID391添加成功！','::1',1573438395),(1481,'kbmanager','1','文章ID392添加成功！','::1',1573438432),(1482,'kbmanager','1','栏目ID为359添加成功！','::1',1573438486),(1483,'kbmanager','1','文章ID393添加成功！','::1',1573438504),(1484,'kbmanager','1','文章ID394添加成功！','::1',1573438555),(1485,'kbmanager','1','文章ID395添加成功！','::1',1573438629),(1486,'kbmanager','1','文章ID396添加成功！','::1',1573438663),(1487,'kbmanager','1','文章ID397添加成功！','::1',1573438706),(1488,'kbmanager','1','文章ID398添加成功！','::1',1573438809),(1489,'kbmanager','1','文章ID399添加成功！','::1',1573438910),(1490,'kbmanager','1','文章ID399更新成功！','::1',1573439084),(1491,'kbmanager','1','文章ID399更新成功！','::1',1573439281),(1492,'kbmanager','1','文章ID400添加成功！','::1',1573439418),(1493,'kbmanager','1','文章ID401添加成功！','::1',1573439442),(1494,'kbmanager','1','文章ID402添加成功！','::1',1573439449),(1495,'kbmanager','1','内容ID为402置顶成功！','::1',1573439898),(1496,'kbmanager','1','内容ID为402关闭成功！','::1',1573439929),(1497,'kbmanager','1','内容ID为402开启成功！','::1',1573439929),(1498,'kbmanager','1','内容ID为389开启成功！','::1',1573439962),(1499,'kbmanager','1','内容ID为388开启成功！','::1',1573439963),(1500,'kbmanager','1','内容ID为390开启成功！','::1',1573439963),(1501,'kbmanager','1','内容ID为391开启成功！','::1',1573439964),(1502,'kbmanager','1','内容ID为392开启成功！','::1',1573439964),(1503,'kbmanager','1','内容ID为393开启成功！','::1',1573439965),(1504,'kbmanager','1','内容ID为394开启成功！','::1',1573439965),(1505,'kbmanager','1','内容ID为395开启成功！','::1',1573439966),(1506,'kbmanager','1','内容批量显示成功！','::1',1573440006),(1507,'kbmanager','1','文章ID403添加成功！','::1',1573442783),(1508,'kbmanager','1','配置项ID403删除成功！','::1',1573443564),(1509,'kbmanager','1','配置项ID402删除成功！','::1',1573443568),(1510,'kbmanager','1','配置项ID387删除成功！','::1',1573443685),(1511,'kbmanager','1','配置项ID388删除成功！','::1',1573443698),(1512,'kbmanager','1','配置项ID401删除成功！','::1',1573443703),(1513,'kbmanager','1','内容ID为400关闭成功！','::1',1573443717),(1514,'kbmanager','1','内容ID为400开启成功！','::1',1573443718),(1515,'kbmanager','1','内容ID为400置顶成功！','::1',1573443719),(1516,'kbmanager','1','内容批量删除成功！','::1',1573444193),(1517,'kbmanager','1','删除成功！','::1',1573444323),(1518,'kbmanager','1','删除成功！','::1',1573444349),(1519,'kbmanager','1','操作成功！','::1',1573444509),(1520,'kbmanager','1','操作成功！','::1',1573444514),(1521,'kbmanager','1','操作成功！','::1',1573444523),(1522,'kbmanager','1','操作成功！','::1',1573444527),(1523,'kbmanager','1','操作成功！','::1',1573444770),(1524,'kbmanager','1','操作成功！','::1',1573444803),(1525,'admin','2','退出成功！','::1',1573635236),(1526,'admin','2','登录成功！','::1',1573635245),(1527,'admin','2','内容ID为400开启成功！','::1',1573635420),(1528,'kbmanager','1','登录成功！','124.200.176.198',1574661336),(1529,'kbmanager','1','登录成功！','::1',1574662407),(1530,'kbmanager','1','登录成功！','::1',1584762093),(1531,'kbmanager','1','修改配置成功','::1',1584762129),(1532,'kbmanager','1','删除广告ID93成功！','::1',1584762313),(1533,'kbmanager','1','删除广告ID94成功！','::1',1584762315),(1534,'kbmanager','1','删除广告ID95成功！','::1',1584762316),(1535,'kbmanager','1','编辑广告ID39成功！','::1',1584762344),(1536,'kbmanager','1','编辑广告ID39成功！','::1',1584762388),(1537,'kbmanager','1','编辑广告ID39成功！','::1',1584762470),(1538,'kbmanager','1','编辑广告ID39成功！','::1',1584762589),(1539,'kbmanager','1','编辑广告ID39成功！','::1',1584762679),(1540,'kbmanager','1','编辑广告ID39成功！','::1',1584763224),(1541,'kbmanager','1','编辑广告ID39成功！','::1',1584763244),(1542,'kbmanager','1','删除广告ID97成功！','::1',1584765182),(1543,'kbmanager','1','删除广告ID96成功！','::1',1584765184),(1544,'kbmanager','1','编辑广告ID39成功！','::1',1584765216),(1545,'kbmanager','1','删除广告ID99成功！','::1',1584765224),(1546,'kbmanager','1','编辑广告ID39成功！','::1',1584765257),(1547,'kbmanager','1','删除广告ID98成功！','::1',1584765344),(1548,'kbmanager','1','编辑广告ID39成功！','::1',1584765346),(1549,'kbmanager','1','删除广告ID100成功！','::1',1584765391),(1550,'kbmanager','1','编辑广告ID39成功！','::1',1584765694),(1551,'kbmanager','1','编辑广告ID39成功！','::1',1584765706),(1552,'kbmanager','1','编辑广告ID39成功！','::1',1584765855),(1553,'kbmanager','1','内容ID为398置顶成功！','::1',1584769200),(1554,'kbmanager','1','内容ID为400置顶成功！','::1',1584769208),(1555,'kbmanager','1','登录成功！','::1',1585532196),(1556,'kbmanager','1','规则ID为45编辑成功！','::1',1585532246),(1557,'kbmanager','1','广告位ID为6编辑成功！','::1',1585532762),(1558,'kbmanager','1','删除广告ID101成功！','::1',1585533018),(1559,'kbmanager','1','编辑广告ID39成功！','::1',1585533052),(1560,'kbmanager','1','编辑广告ID39成功！','::1',1585533084),(1561,'kbmanager','1','编辑广告ID47成功！','::1',1585533097),(1562,'kbmanager','1','删除配置项56成功！','127.0.0.1',1625984383),(1563,'kbmanager','1','删除配置项55成功！','127.0.0.1',1625984394),(1564,'kbmanager','1','删除配置项52成功！','127.0.0.1',1625984405),(1565,'kbmanager','1','删除配置项50成功！','127.0.0.1',1625984417),(1566,'kbmanager','1','删除配置项51成功！','127.0.0.1',1625984456),(1567,'kbmanager','1','删除配置项54成功！','127.0.0.1',1625984466),(1568,'kbmanager','1','删除配置项53成功！','127.0.0.1',1625984477),(1569,'kbmanager','1','修改配置成功','127.0.0.1',1625984496),(1570,'kbmanager','1','规则ID为33编辑成功！','127.0.0.1',1625984532),(1571,'kbmanager','1','删除成功！','127.0.0.1',1625984718),(1572,'kbmanager','1','编辑配置项成功！','127.0.0.1',1625984958),(1573,'kbmanager','1','备份数据库成功！','127.0.0.1',1625985129),(1574,'kbmanager','1','规则ID为84编辑成功！','127.0.0.1',1625985957),(1575,'kbmanager','1','广告位ID为14删除成功！','127.0.0.1',1625986183),(1576,'kbmanager','1','编辑广告ID39成功！','127.0.0.1',1625986371),(1577,'kbmanager','1','登录成功！','127.0.0.1',1629871789),(1578,'kbmanager','1','删除数据库备份成功！','127.0.0.1',1629871812),(1579,'kbmanager','1','栏目ID为352删除成功！','127.0.0.1',1629871823),(1580,'kbmanager','1','模型ID65删除成功！','127.0.0.1',1629872247),(1581,'kbmanager','1','栏目ID为360添加成功！','127.0.0.1',1629872262),(1582,'kbmanager','1','模型ID66添加成功！','127.0.0.1',1629872434),(1583,'kbmanager','1','栏目ID为361添加成功！','127.0.0.1',1629872444),(1584,'kbmanager','1','栏目ID为361删除成功！','127.0.0.1',1629872451),(1585,'kbmanager','1','栏目ID为362添加成功！','127.0.0.1',1629872587),(1586,'kbmanager','1','栏目ID为362编辑成功！','127.0.0.1',1629872604),(1587,'kbmanager','1','修改配置成功','127.0.0.1',1629872753),(1588,'kbmanager','1','栏目ID为362删除成功！','127.0.0.1',1629875199),(1589,'kbmanager','1','登录成功！','127.0.0.1',1629882728),(1590,'kbmanager','1','退出成功！','127.0.0.1',1629882785),(1591,'kbmanager','1','登录成功！','127.0.0.1',1629882797),(1592,'kbmanager','1','退出成功！','127.0.0.1',1629882829),(1593,'kbmanager','1','登录成功！','127.0.0.1',1629882841),(1594,'kbmanager','1','退出成功！','127.0.0.1',1629882859),(1595,'kbmanager','1','登录成功！','127.0.0.1',1629882868),(1596,'kbmanager','1','退出成功！','127.0.0.1',1629882885),(1597,'kbmanager','1','登录成功！','127.0.0.1',1629883009),(1598,'kbmanager','1','退出成功！','127.0.0.1',1629883058),(1599,'kbmanager','1','登录成功！','127.0.0.1',1629883066),(1600,'kbmanager','1','退出成功！','127.0.0.1',1629883231),(1601,'kbmanager','1','登录成功！','127.0.0.1',1629883240),(1602,'kbmanager','1','退出成功！','127.0.0.1',1629883258),(1603,'kbmanager','1','登录成功！','127.0.0.1',1629883277),(1604,'kbmanager','1','退出成功！','127.0.0.1',1629883416),(1605,'kbmanager','1','登录成功！','127.0.0.1',1629883705),(1606,'kbmanager','1','退出成功！','127.0.0.1',1629883737),(1607,'kbmanager','1','登录成功！','127.0.0.1',1629883751),(1608,'kbmanager','1','退出成功！','127.0.0.1',1629883836),(1609,'kbmanager','1','登录成功！','127.0.0.1',1629883843),(1610,'kbmanager','1','退出成功！','127.0.0.1',1629883847),(1611,'kbmanager','1','登录成功！','127.0.0.1',1629883857),(1612,'kbmanager','1','退出成功！','127.0.0.1',1629884027),(1613,'kbmanager','1','登录成功！','127.0.0.1',1629884037),(1614,'kbmanager','1','退出成功！','127.0.0.1',1629884063),(1615,'kbmanager','1','登录成功！','127.0.0.1',1629884098),(1616,'kbmanager','1','退出成功！','127.0.0.1',1629884204),(1617,'kbmanager','1','登录成功！','127.0.0.1',1629940265),(1618,'kbmanager','1','退出成功！','127.0.0.1',1629940309),(1619,'kbmanager','1','登录成功！','127.0.0.1',1629940319),(1620,'kbmanager','1','退出成功！','127.0.0.1',1629940356),(1621,'kbmanager','1','登录成功！','127.0.0.1',1629941169),(1622,'kbmanager','1','规则ID为102添加成功！','127.0.0.1',1629941221),(1623,'kbmanager','1','规则ID为103添加成功！','127.0.0.1',1629941260),(1624,'kbmanager','1','规则ID为104添加成功！','127.0.0.1',1629941284),(1625,'kbmanager','1','规则ID为105添加成功！','127.0.0.1',1629941318),(1626,'kbmanager','1','规则ID为106添加成功！','127.0.0.1',1629941349),(1627,'kbmanager','1','用户组ID为1权限分配成功！','127.0.0.1',1629941368),(1628,'kbmanager','1','规则ID为102编辑成功！','127.0.0.1',1629942096);
/*!40000 ALTER TABLE `tp_operation_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_service`
--

DROP TABLE IF EXISTS `tp_service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_service` (
  `aid` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_service`
--

LOCK TABLES `tp_service` WRITE;
/*!40000 ALTER TABLE `tp_service` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_us`
--

DROP TABLE IF EXISTS `tp_us`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_us` (
  `aid` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_us`
--

LOCK TABLES `tp_us` WRITE;
/*!40000 ALTER TABLE `tp_us` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_us` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-08-26  9:43:19

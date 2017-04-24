-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 192.168.2.100    Database: accman_clone
-- ------------------------------------------------------
-- Server version	5.7.16-log

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
-- Table structure for table `cl001`
--

DROP TABLE IF EXISTS `cl001`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cl001` (
  `CLCODE` varchar(6) DEFAULT NULL,
  `CLCONAME` varchar(40) DEFAULT NULL,
  `CLCONTACT` varchar(30) DEFAULT NULL,
  `CLADD1` varchar(30) DEFAULT NULL,
  `CLADD2` varchar(30) DEFAULT NULL,
  `CLADD3` varchar(30) DEFAULT NULL,
  `CLTEL1` varchar(12) DEFAULT NULL,
  `CLTEL2` varchar(12) DEFAULT NULL,
  `CLFAX` varchar(12) DEFAULT NULL,
  `CLPAGER` varchar(12) DEFAULT NULL,
  `CLMOBILE` varchar(12) DEFAULT NULL,
  `CLGCD` varchar(6) DEFAULT NULL,
  `CLPGROUP` varchar(1) DEFAULT NULL,
  `CLPYTIME` varchar(7) DEFAULT NULL,
  `CLDEPT` varchar(10) DEFAULT NULL,
  `CLSLMAN` varchar(18) DEFAULT NULL,
  `CLCRLT` double DEFAULT NULL,
  `CLPVPER` double DEFAULT NULL,
  `CLPVDRCR` varchar(2) DEFAULT NULL,
  `CLTHPER` double DEFAULT NULL,
  `CLTHDRCR` varchar(2) DEFAULT NULL,
  `CLCUBAL` double DEFAULT NULL,
  `CLCUDRCR` varchar(2) DEFAULT NULL,
  `CLCRAVL` double DEFAULT NULL,
  `CLASTSLDT` datetime DEFAULT NULL,
  `CLASTPYDT` datetime DEFAULT NULL,
  `CLASTSLAM` double DEFAULT NULL,
  `CLASTPYAM` double DEFAULT NULL,
  `CLTRSTA` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `equipment_master`
--

DROP TABLE IF EXISTS `equipment_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipment_master` (
  `id_equipment` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `equip_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_equipment`,`equip_name`),
  UNIQUE KEY `equip_name_UNIQUE` (`equip_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `SUP_CODE` varchar(5) DEFAULT NULL,
  `PART_NO` varchar(15) DEFAULT NULL,
  `EQUIPMENT` varchar(15) DEFAULT NULL,
  `CO_NAME` varchar(30) DEFAULT NULL,
  `DESC` varchar(100) DEFAULT NULL,
  `REMARK` varchar(80) DEFAULT NULL,
  `BIN` varchar(20) DEFAULT NULL,
  `UNIT` varchar(10) DEFAULT NULL,
  `PKG_QTY` int(11) DEFAULT NULL,
  `WT` double DEFAULT NULL,
  `UNIT_COST` double DEFAULT NULL,
  `SALES_PRIC` double DEFAULT NULL,
  `QTY_HAND` int(11) DEFAULT NULL,
  `MAX_LEVEL` int(11) DEFAULT NULL,
  `MIN_LEVEL` int(11) DEFAULT NULL,
  `RE_LEVEL` int(11) DEFAULT NULL,
  `QTY_ORDER` int(11) DEFAULT NULL,
  `LAST_ISSUE` datetime DEFAULT NULL,
  `OP_STOCK` int(11) DEFAULT NULL,
  `QTY_RES` int(11) DEFAULT NULL,
  `SSNO` varchar(15) DEFAULT NULL,
  `FRRATE` int(11) DEFAULT NULL,
  `OP_RATE` double DEFAULT NULL,
  `CAL_AVG` double DEFAULT NULL,
  KEY `SUP_CODE` (`SUP_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `item_all_view`
--

DROP TABLE IF EXISTS `item_all_view`;
/*!50001 DROP VIEW IF EXISTS `item_all_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `item_all_view` AS SELECT 
 1 AS `id_item`,
 1 AS `part_no`,
 1 AS `side`,
 1 AS `full_no`,
 1 AS `oem_no`,
 1 AS `supplier_no`,
 1 AS `equipment`,
 1 AS `description`,
 1 AS `year_from`,
 1 AS `year_to`,
 1 AS `unit`,
 1 AS `unit_cost`,
 1 AS `sales_price`,
 1 AS `stock`,
 1 AS `max_level`,
 1 AS `min_level`,
 1 AS `pkg_qty`,
 1 AS `weight`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `item_details`
--

DROP TABLE IF EXISTS `item_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_details` (
  `id_itemdetails` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_item` int(10) unsigned NOT NULL,
  `side` varchar(1) DEFAULT NULL,
  `oem_no` varchar(30) DEFAULT NULL,
  `supplier_no` varchar(30) DEFAULT NULL,
  `unit_cost` decimal(6,2) DEFAULT NULL,
  `sales_price` decimal(6,2) DEFAULT NULL,
  `qty_hand` int(10) unsigned DEFAULT NULL,
  `max_level` int(10) unsigned DEFAULT NULL,
  `min_level` int(10) unsigned DEFAULT NULL,
  `qty_order` int(10) unsigned DEFAULT NULL,
  `open_stock` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_itemdetails`),
  KEY `id_item_master_idx` (`id_item`),
  CONSTRAINT `id_item_master` FOREIGN KEY (`id_item`) REFERENCES `item_master` (`id_item`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `item_master`
--

DROP TABLE IF EXISTS `item_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_master` (
  `id_item` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_supplier` int(10) unsigned DEFAULT NULL,
  `part_no` varchar(10) NOT NULL,
  `equipment` varchar(45) DEFAULT NULL,
  `description` varchar(250) NOT NULL,
  `year_from` int(2) unsigned DEFAULT NULL,
  `year_to` int(2) unsigned DEFAULT NULL,
  `multisided` tinyint(1) DEFAULT '0',
  `unit` varchar(3) DEFAULT NULL,
  `pkg_qty` int(2) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `isdelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_item`,`part_no`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `orderitems`
--

DROP TABLE IF EXISTS `orderitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderitems` (
  `OiId` int(11) NOT NULL AUTO_INCREMENT,
  `OiOmId` int(11) NOT NULL,
  `OiPartNo` varchar(15) NOT NULL,
  `OiSupplierNo` varchar(15) NOT NULL,
  `OiDescription` varchar(100) NOT NULL,
  `OiLeftQty` int(10) unsigned DEFAULT '0',
  `OiRightQty` int(10) unsigned DEFAULT '0',
  `OiTotalQty` int(11) NOT NULL,
  `OiPrice` decimal(8,2) NOT NULL,
  `OiAmount` decimal(10,2) GENERATED ALWAYS AS ((`OiTotalQty` * `OiPrice`)) VIRTUAL,
  PRIMARY KEY (`OiId`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ordermaster`
--

DROP TABLE IF EXISTS `ordermaster`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ordermaster` (
  `OmId` int(11) NOT NULL AUTO_INCREMENT,
  `OmCompanyName` varchar(150) NOT NULL,
  `OmCreatedDate` date DEFAULT NULL,
  `OmLpo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`OmId`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `uid` int(10) unsigned NOT NULL COMMENT 'The users.uid corresponding to a session, or 0 for anonymous user.',
  `sid` varchar(128) CHARACTER SET ascii NOT NULL COMMENT 'A session ID (hashed). The value is generated by Drupal''s session handlers.',
  `hostname` varchar(128) CHARACTER SET ascii NOT NULL DEFAULT '' COMMENT 'The IP address that last used this session ID (sid).',
  `timestamp` int(11) NOT NULL DEFAULT '0' COMMENT 'The Unix timestamp when this session last requested a page. Old records are purged by PHP automatically.',
  `session` longblob COMMENT 'The serialized contents of $_SESSION, an array of name/value pairs that persists across page requests by this session ID. Drupal loads $_SESSION from here at the start of each request and saves it at the end.',
  PRIMARY KEY (`sid`),
  KEY `timestamp` (`timestamp`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Drupal''s session handlers read and write into the sessions…';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `stud`
--

DROP TABLE IF EXISTS `stud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stud` (
  `roll_no` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `supplier_master`
--

DROP TABLE IF EXISTS `supplier_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier_master` (
  `id_supplier` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(6) NOT NULL,
  `short_name` varchar(15) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `contact_name` varchar(40) DEFAULT NULL,
  `tel01` varchar(25) DEFAULT NULL,
  `tel02` varchar(25) DEFAULT NULL,
  `fax` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mob01` varchar(25) DEFAULT NULL,
  `mob02` varchar(25) DEFAULT NULL,
  `item_initial` varchar(2) NOT NULL,
  PRIMARY KEY (`id_supplier`,`code`,`short_name`,`full_name`,`item_initial`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `table 14`
--

DROP TABLE IF EXISTS `table 14`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `table 14` (
  `CLCODE` varchar(5) DEFAULT NULL,
  `CLCONAME` varchar(40) DEFAULT NULL,
  `CLCONTACT` varchar(30) DEFAULT NULL,
  `CLADD1` varchar(30) DEFAULT NULL,
  `CLADD2` varchar(30) DEFAULT NULL,
  `CLADD3` varchar(30) DEFAULT NULL,
  `CLTEL1` varchar(12) DEFAULT NULL,
  `CLTEL2` varchar(12) DEFAULT NULL,
  `CLFAX` varchar(12) DEFAULT NULL,
  `CLMOBILE` varchar(12) DEFAULT NULL,
  `COL 11` varchar(12) DEFAULT NULL,
  `COL 12` varchar(5) DEFAULT NULL,
  `COL 13` varchar(1) DEFAULT NULL,
  `COL 14` varchar(7) DEFAULT NULL,
  `COL 15` varchar(4) DEFAULT NULL,
  `COL 16` varchar(18) DEFAULT NULL,
  `COL 17` varchar(11) DEFAULT '0',
  `COL 18` varchar(15) DEFAULT '0',
  `COL 19` varchar(2) DEFAULT NULL,
  `COL 20` varchar(10) DEFAULT NULL,
  `COL 21` varchar(10) DEFAULT NULL,
  `COL 22` varchar(15) DEFAULT '0',
  `COL 23` varchar(2) DEFAULT NULL,
  `COL 24` varchar(15) DEFAULT '0',
  `COL 25` varchar(10) DEFAULT NULL,
  `COL 26` varchar(10) DEFAULT NULL,
  `COL 27` varchar(10) DEFAULT NULL,
  `COL 28` varchar(10) DEFAULT NULL,
  `COL 29` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `url_alias`
--

DROP TABLE IF EXISTS `url_alias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `url_alias` (
  `pid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'A unique path alias identifier.',
  `source` varchar(255) NOT NULL DEFAULT '' COMMENT 'The Drupal path this alias is for. e.g. node/12.',
  `alias` varchar(255) NOT NULL DEFAULT '' COMMENT 'The alias for this path. e.g. title-of-the-story.',
  `langcode` varchar(12) CHARACTER SET ascii NOT NULL DEFAULT '' COMMENT 'The language code this alias is for. if ''und'', the alias will be used for unknown languages. Each Drupal path can have an alias for each supported language.',
  PRIMARY KEY (`pid`),
  KEY `alias_langcode_pid` (`alias`(191),`langcode`,`pid`),
  KEY `source_langcode_pid` (`source`(191),`langcode`,`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='A list of URL aliases for Drupal paths. a user may visit…';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user__roles`
--

DROP TABLE IF EXISTS `user__roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user__roles` (
  `bundle` varchar(128) CHARACTER SET ascii NOT NULL DEFAULT '' COMMENT 'The field instance bundle to which this row belongs, used when deleting a field instance',
  `deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'A boolean indicating whether this data item has been deleted',
  `entity_id` int(10) unsigned NOT NULL COMMENT 'The entity id this data is attached to',
  `revision_id` int(10) unsigned NOT NULL COMMENT 'The entity revision id this data is attached to, which for an unversioned entity type is the same as the entity id',
  `langcode` varchar(32) CHARACTER SET ascii NOT NULL DEFAULT '' COMMENT 'The language code for this data item.',
  `delta` int(10) unsigned NOT NULL COMMENT 'The sequence number for this data item, used for multi-value fields',
  `roles_target_id` varchar(255) CHARACTER SET ascii NOT NULL COMMENT 'The ID of the target entity.',
  PRIMARY KEY (`entity_id`,`deleted`,`delta`,`langcode`),
  KEY `bundle` (`bundle`),
  KEY `revision_id` (`revision_id`),
  KEY `roles_target_id` (`roles_target_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Data storage for user field roles.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id_users` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` tinyint(2) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_users`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='		';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users_data`
--

DROP TABLE IF EXISTS `users_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_data` (
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Primary key: users.uid for user.',
  `module` varchar(50) CHARACTER SET ascii NOT NULL DEFAULT '' COMMENT 'The name of the module declaring the variable.',
  `name` varchar(128) CHARACTER SET ascii NOT NULL DEFAULT '' COMMENT 'The identifier of the data.',
  `value` longblob COMMENT 'The value.',
  `serialized` tinyint(3) unsigned DEFAULT '0' COMMENT 'Whether value is serialized.',
  PRIMARY KEY (`uid`,`module`,`name`),
  KEY `module` (`module`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Stores module data as key/value pairs per user.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users_field_data`
--

DROP TABLE IF EXISTS `users_field_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_field_data` (
  `uid` int(10) unsigned NOT NULL,
  `langcode` varchar(12) CHARACTER SET ascii NOT NULL,
  `preferred_langcode` varchar(12) CHARACTER SET ascii DEFAULT NULL,
  `preferred_admin_langcode` varchar(12) CHARACTER SET ascii DEFAULT NULL,
  `name` varchar(60) NOT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `mail` varchar(254) DEFAULT NULL,
  `timezone` varchar(32) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created` int(11) NOT NULL,
  `changed` int(11) DEFAULT NULL,
  `access` int(11) NOT NULL,
  `login` int(11) DEFAULT NULL,
  `init` varchar(254) DEFAULT NULL,
  `default_langcode` tinyint(4) NOT NULL,
  PRIMARY KEY (`uid`,`langcode`),
  UNIQUE KEY `user__name` (`name`,`langcode`),
  KEY `user__id__default_langcode__langcode` (`uid`,`default_langcode`,`langcode`),
  KEY `user_field__mail` (`mail`(191)),
  KEY `user_field__created` (`created`),
  KEY `user_field__access` (`access`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='The data table for user entities.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Final view structure for view `item_all_view`
--

/*!50001 DROP VIEW IF EXISTS `item_all_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root2`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `item_all_view` AS select `i`.`id_item` AS `id_item`,`i`.`part_no` AS `part_no`,`d`.`side` AS `side`,concat(`i`.`part_no`,`d`.`side`) AS `full_no`,`d`.`oem_no` AS `oem_no`,`d`.`supplier_no` AS `supplier_no`,`i`.`equipment` AS `equipment`,`i`.`description` AS `description`,`i`.`year_from` AS `year_from`,`i`.`year_to` AS `year_to`,`i`.`unit` AS `unit`,`d`.`unit_cost` AS `unit_cost`,`d`.`sales_price` AS `sales_price`,`d`.`qty_hand` AS `stock`,`d`.`max_level` AS `max_level`,`d`.`min_level` AS `min_level`,`i`.`pkg_qty` AS `pkg_qty`,`i`.`weight` AS `weight` from (`item_master` `i` join `item_details` `d`) where ((`d`.`id_item` = `i`.`id_item`) and (`i`.`isdelete` = 0)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-29 19:54:59

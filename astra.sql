-- MySQL dump 10.13  Distrib 5.7.32, for Linux (x86_64)
--
-- Host: localhost    Database: astra
-- ------------------------------------------------------
-- Server version	5.7.32

DROP TABLE IF EXISTS `core_softcam`;
CREATE TABLE `core_softcam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `name_id` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `host` varchar(50) NOT NULL,
  `port` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `user_pass` varchar(50) NOT NULL,
  `key` varchar(28) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `core_softcam_slug_711f16c0` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core_softcam`
--

LOCK TABLES `core_softcam` WRITE;
/*!40000 ALTER TABLE `core_softcam` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_softcam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_stream`
--

DROP TABLE IF EXISTS `core_stream`;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_stream` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enable` tinyint(1) NOT NULL,
  `title` varchar(200) NOT NULL,
  `stream_id` varchar(200) NOT NULL,
  `url` varchar(150) NOT NULL,
  `set_map` varchar(200) DEFAULT NULL,
  `set_pnr` int(11) DEFAULT NULL,
  `set_tsid` int(11) DEFAULT NULL,
  `service_type` varchar(1) NOT NULL,
  `service_provider` varchar(200) NOT NULL,
  `service_name` varchar(200) NOT NULL,
  `input_u` varchar(200) NOT NULL,
  `output_u` varchar(200) NOT NULL,
  `scrambled` int(10) unsigned NOT NULL,
  `bitrate` int(10) unsigned NOT NULL,
  `cc_error` int(10) unsigned NOT NULL,
  `pes_error` int(10) unsigned NOT NULL,
  `ready` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `core_stream_url_9b047887` (`url`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core_stream`
--

LOCK TABLES `core_stream` WRITE;
INSERT INTO `core_stream` VALUES (4,1,'THTMusic','THTMusic','thtmusic',NULL,NULL,NULL,'','','','dvb://adapter2_85#pnr=709','udp://238.1.2.9:1234',0,2472,0,0,0),(5,1,'Juvelirochka','Juvelirochka','juvelirochka',NULL,NULL,NULL,'','','','dvb://adapter2_85#pnr=703','udp://238.1.2.10:1234',0,4377,0,0,0),(6,1,'EuroNews','EuroNews','euronews',NULL,NULL,NULL,'','','','dvb://adapter2_85#pnr=714&cas','udp://238.1.5.10:1234',0,2755,0,28,0),(7,1,'U TV','U TV','u-tv',NULL,NULL,NULL,'','','','dvb://adapter2_85#pnr=707','udp://238.1.2.6:1234',0,2672,0,0,0),(8,1,'Souz','Souz','souz',NULL,NULL,NULL,'','','','dvb://adapter2_85#pnr=702','udp://238.1.2.5:1234',0,1924,0,0,0),(9,1,'CTC Love','CTC Love','ctc-love',NULL,NULL,NULL,'','','','dvb://adapter2_85#pnr=712','udp://238.1.2.34:1234',0,1955,0,0,0),(10,1,'8 Kanal','8 Kanal','8-kanal',NULL,NULL,NULL,'','','','dvb://adapter2_85#pnr=705','udp://238.1.2.44:1234',0,1788,0,0,0),(11,1,'Europa Plus','Europa Plus','europa-plus',NULL,NULL,NULL,'','','','dvb://adapter0_85#pnr=391','udp://238.1.5.1:1234',0,315,0,0,0),(14,1,'THT4','THT4','tht4',NULL,NULL,NULL,'','','','dvb://adapter1_75#pnr=820','udp://238.1.2.84:1234',0,3156,0,0,0),(15,1,'Super','Super','super',NULL,NULL,NULL,'','','','dvb://adapter1_75#pnr=830','udp://238.1.2.12:1234',0,3251,0,0,0),(16,1,'MirHD','MirHD','mirhd',NULL,NULL,NULL,'','','','dvb://adapter1_75#pnr=940','udp://238.1.2.13:1234',0,7968,0,0,0),(17,1,'2x2','2x2','2x2',NULL,NULL,NULL,'','','','dvb://adapter1_75#pnr=910','udp://238.1.2.32:1234',0,2482,0,0,0),(18,1,'Match! Planeta','Match! Planeta','match-planeta',NULL,NULL,NULL,'','','','dvb://adapter3_75#pnr=420','udp://238.1.2.7:1234',0,2283,0,0,0),(19,1,'RU.TV','RU.TV','rutv',NULL,NULL,NULL,'','','','dvb://adapter3_75#pnr=340','udp://238.1.2.73:1234',0,2535,0,0,0),(20,1,'DFM','DFM','dfm',NULL,NULL,NULL,'','','','dvb://adapter3_75#pnr=370','udp://238.1.5.2:1234',0,346,0,0,0),(21,1,'HIT FM','HIT FM','hit-fm',NULL,NULL,NULL,'','','','dvb://adapter3_75#pnr=380','udp://238.1.5.3:1234',0,346,0,0,0),(22,1,'Maximum','Maximum','maximum',NULL,NULL,NULL,'','','','dvb://adapter3_75#pnr=390','udp://238.1.5.4:1234',0,346,0,0,0),(23,1,'Russkoe Radio','Russkoe Radio','russkoe-radio',NULL,NULL,NULL,'','','','dvb://adapter3_75#pnr=400','udp://238.1.5.5:1234',0,346,0,0,0),(24,1,'Radio Zvezda','Radio Zvezda','radio-zvezda',NULL,NULL,NULL,'','','','dvb://adapter3_75#pnr=430','udp://238.1.5.6:1234',0,335,0,0,0);
UNLOCK TABLES;

--
-- Table structure for table `core_tuner`
--

DROP TABLE IF EXISTS `core_tuner`;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_tuner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `dvb_id` varchar(25) NOT NULL,
  `url` varchar(50) NOT NULL,
  `adapter_id` varchar(200) NOT NULL,
  `signal_type` varchar(2) NOT NULL,
  `frequency` smallint(6) NOT NULL,
  `polarization` varchar(2) NOT NULL,
  `symbolrate` smallint(6) NOT NULL,
  `lof1` smallint(6) NOT NULL,
  `lof2` smallint(6) NOT NULL,
  `slof` smallint(6) NOT NULL,
  `snr` int(10) unsigned NOT NULL,
  `bitrate` int(10) unsigned NOT NULL,
  `unc` varchar(10) NOT NULL,
  `ber` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `core_tuner_url_71644463` (`url`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core_tuner`
--

LOCK TABLES `core_tuner` WRITE;
INSERT INTO `core_tuner` VALUES (1,'adapter0_85','adapter0_85','adapter0','0','S',11720,'V',28800,0,0,0,0,0,'0',0),(2,'adapter2_85','adapter2_85','adapter2_85','2','S',12000,'H',28000,0,0,0,0,0,'0',0),(3,'adapter1_75','adapter1_75','adapter1_75','1','S',11531,'V',22000,0,0,0,73,32,'0',0),(4,'adapter3_75','adapter3_75','adapter3_75','3','S',11559,'V',22000,0,0,0,72,31,'0',0);
UNLOCK TABLES;


-- Dump completed on 2020-11-12 17:21:55

CREATE TABLE `mss`.`background` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY
) ENGINE = MYISAM ;


CREATE TABLE `merge_column_crown` (
  `id_column` INT(11) NOT NULL DEFAULT '0',
  `id_crown` INT(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `NewIndex1` (`id_column`,`id_crown`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

CREATE TABLE `merge_column_fitting` (
  `id_column` INT(11) NOT NULL DEFAULT '0',
  `id_fitting` INT(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `NewIndex1` (`id_column`,`id_fitting`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci

CREATE TABLE `merge_crown_fitting` (
  `id_crown` INT(11) NOT NULL DEFAULT '0',
  `id_fitting` INT(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `NewIndex1` (`id_crown`,`id_fitting`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;
















/*
SQLyog Enterprise v8.82 
MySQL - 5.1.41-community-log : Database - mss
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS,
FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO'
*/;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `background` */

CREATE TABLE `background` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8
COLLATE=utf8_polish_ci;

/*Data for the table `background` */

insert  into `background`(`id`) values (4);
insert  into `background`(`id`) values (5);
insert  into `background`(`id`) values (6);

/*Table structure for table `column` */

CREATE TABLE `column` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `description` text COLLATE utf8_polish_ci,
  `garden` tinyint(4) NOT NULL DEFAULT '0',
  `street` tinyint(4) NOT NULL DEFAULT '0',
  `width` int(11) NOT NULL DEFAULT '0',
  `height` int(11) NOT NULL DEFAULT '0',
  `mode` varchar(5) COLLATE utf8_polish_ci NOT NULL DEFAULT 'stand',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8
COLLATE=utf8_polish_ci;

/*Data for the table `column` */

insert  into
`column`(`id`,`title`,`description`,`garden`,`street`,`width`,`height`,`mode`)
values (14,'Slup 3','opis ...',1,0,0,0,'stand');
insert  into
`column`(`id`,`title`,`description`,`garden`,`street`,`width`,`height`,`mode`)
values (13,'Slup 2','opis ...',0,1,0,0,'stand');
insert  into
`column`(`id`,`title`,`description`,`garden`,`street`,`width`,`height`,`mode`)
values (15,'sdgdfg..','dfgdfg',1,1,200,355,'stand');

/*Table structure for table `contact` */

CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `id_category` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8
COLLATE=utf8_polish_ci;

/*Data for the table `contact` */

insert  into `contact`(`id`,`email`,`username`,`id_category`) values
(1,'adin@op.pl','Adin Adinowski',0);
insert  into `contact`(`id`,`email`,`username`,`id_category`) values
(2,'adin@op.pl','Adin Adinowski',0);
insert  into `contact`(`id`,`email`,`username`,`id_category`) values
(3,'adin@op.pl','Adin Adinowski',0);

/*Table structure for table `crown` */

CREATE TABLE `crown` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `description` text COLLATE utf8_polish_ci,
  `garden` tinyint(4) NOT NULL DEFAULT '0',
  `street` tinyint(4) NOT NULL DEFAULT '0',
  `width` int(11) NOT NULL DEFAULT '0',
  `height` int(11) NOT NULL DEFAULT '0',
  `mode` enum('stand','hang') COLLATE utf8_polish_ci NOT NULL DEFAULT
  'stand',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8
COLLATE=utf8_polish_ci;

/*Data for the table `crown` */

insert  into
`crown`(`id`,`title`,`description`,`garden`,`street`,`width`,`height`,`mode`)
values (16,'sdasdasd','',0,1,200,75,'stand');
insert  into
`crown`(`id`,`title`,`description`,`garden`,`street`,`width`,`height`,`mode`)
values (14,'asdsad','',1,1,0,0,'hang');
insert  into
`crown`(`id`,`title`,`description`,`garden`,`street`,`width`,`height`,`mode`)
values (15,'asdasd','',1,1,0,0,'stand');

/*Table structure for table `fitting` */

CREATE TABLE `fitting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `description` text COLLATE utf8_polish_ci,
  `garden` tinyint(4) NOT NULL DEFAULT '0',
  `street` tinyint(4) NOT NULL DEFAULT '0',
  `width` int(11) NOT NULL DEFAULT '0',
  `height` int(11) NOT NULL DEFAULT '0',
  `mode` enum('stand','hang') COLLATE utf8_polish_ci NOT NULL DEFAULT
  'stand',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8
COLLATE=utf8_polish_ci;

/*Data for the table `fitting` */

insert  into
`fitting`(`id`,`title`,`description`,`garden`,`street`,`width`,`height`,`mode`)
values (15,'b','',0,1,0,0,'stand');
insert  into
`fitting`(`id`,`title`,`description`,`garden`,`street`,`width`,`height`,`mode`)
values (14,'a','',1,0,0,0,'hang');
insert  into
`fitting`(`id`,`title`,`description`,`garden`,`street`,`width`,`height`,`mode`)
values (13,'qwe','qwe',1,1,0,0,'stand');

/*Table structure for table `merge_column_crown` */

CREATE TABLE `merge_column_crown` (
  `id_column` int(11) NOT NULL DEFAULT '0',
  `id_crown` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `NewIndex1` (`id_column`,`id_crown`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

/*Data for the table `merge_column_crown` */

insert  into `merge_column_crown`(`id_column`,`id_crown`) values (1,14);
insert  into `merge_column_crown`(`id_column`,`id_crown`) values (1,15);
insert  into `merge_column_crown`(`id_column`,`id_crown`) values (1,16);
insert  into `merge_column_crown`(`id_column`,`id_crown`) values (2,1);
insert  into `merge_column_crown`(`id_column`,`id_crown`) values (2,2);
insert  into `merge_column_crown`(`id_column`,`id_crown`) values (13,14);
insert  into `merge_column_crown`(`id_column`,`id_crown`) values (13,15);
insert  into `merge_column_crown`(`id_column`,`id_crown`) values (13,16);
insert  into `merge_column_crown`(`id_column`,`id_crown`) values (15,14);
insert  into `merge_column_crown`(`id_column`,`id_crown`) values (15,15);
insert  into `merge_column_crown`(`id_column`,`id_crown`) values (15,16);

/*Table structure for table `merge_column_fitting` */

CREATE TABLE `merge_column_fitting` (
  `id_column` int(11) NOT NULL DEFAULT '0',
  `id_fitting` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `NewIndex1` (`id_column`,`id_fitting`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

/*Data for the table `merge_column_fitting` */

/*Table structure for table `merge_crown_fitting` */

CREATE TABLE `merge_crown_fitting` (
  `id_crown` int(11) NOT NULL DEFAULT '0',
  `id_fitting` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `NewIndex1` (`id_crown`,`id_fitting`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

/*Data for the table `merge_crown_fitting` */

insert  into `merge_crown_fitting`(`id_crown`,`id_fitting`) values (1,14);
insert  into `merge_crown_fitting`(`id_crown`,`id_fitting`) values
(14,15);

/*Table structure for table `podjednorg` */

CREATE TABLE `podjednorg` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ljedn2id` int(11) DEFAULT '0',
  `kod8` varchar(4) DEFAULT NULL,
  `NazwaPodj` varchar(250) DEFAULT NULL,
  `skrot` varchar(16) DEFAULT NULL,
  `Aktywny` smallint(6) DEFAULT NULL,
  `createdate` timestamp NULL DEFAULT NULL,
  `createuser` int(11) NOT NULL DEFAULT '0',
  `upddate` datetime DEFAULT NULL,
  `upduser` int(11) NOT NULL DEFAULT '0',
  `OldLink` int(11) DEFAULT NULL,
  `lswiadczid` int(11) DEFAULT NULL,
  `ClShort` varchar(15) DEFAULT NULL,
  `kod_kosztowy` varchar(15) DEFAULT NULL,
  `kod7` varchar(4) DEFAULT '001',
  PRIMARY KEY (`ID`),
  KEY `ls` (`lswiadczid`),
  KEY `l2` (`ljedn2id`),
  KEY `old` (`OldLink`)
) ENGINE=MyISAM AUTO_INCREMENT=460 DEFAULT CHARSET=cp1250;

/*Data for the table `podjednorg` */

insert  into
`podjednorg`(`ID`,`ljedn2id`,`kod8`,`NazwaPodj`,`skrot`,`Aktywny`,`createdate`,`createuser`,`upddate`,`upduser`,`OldLink`,`lswiadczid`,`ClShort`,`kod_kosztowy`,`kod7`)
values (1,0,NULL,'Anestozjologii i Intensywnej
Terapii','OIOM',NULL,NULL,0,NULL,0,NULL,1,'',NULL,'001');
insert  into
`podjednorg`(`ID`,`ljedn2id`,`kod8`,`NazwaPodj`,`skrot`,`Aktywny`,`createdate`,`createuser`,`upddate`,`upduser`,`OldLink`,`lswiadczid`,`ClShort`,`kod_kosztowy`,`kod7`)
values (2,0,NULL,'Anestozjologii i Intensywnej
Terapii','OIOM',NULL,NULL,0,NULL,0,NULL,1,NULL,NULL,'001');
insert  into
`podjednorg`(`ID`,`ljedn2id`,`kod8`,`NazwaPodj`,`skrot`,`Aktywny`,`createdate`,`createuser`,`upddate`,`upduser`,`OldLink`,`lswiadczid`,`ClShort`,`kod_kosztowy`,`kod7`)
values (449,0,NULL,'Anestozjologii i Intensywnej
Terapii','OIOM',NULL,NULL,0,NULL,0,NULL,1,'OIOM',NULL,'001');
insert  into
`podjednorg`(`ID`,`ljedn2id`,`kod8`,`NazwaPodj`,`skrot`,`Aktywny`,`createdate`,`createuser`,`upddate`,`upduser`,`OldLink`,`lswiadczid`,`ClShort`,`kod_kosztowy`,`kod7`)
values (450,0,NULL,'Anestozjologii i Intensywnej
Terapii','OIOM',NULL,NULL,0,NULL,0,NULL,1,'OIOM',NULL,'001');
insert  into
`podjednorg`(`ID`,`ljedn2id`,`kod8`,`NazwaPodj`,`skrot`,`Aktywny`,`createdate`,`createuser`,`upddate`,`upduser`,`OldLink`,`lswiadczid`,`ClShort`,`kod_kosztowy`,`kod7`)
values (451,0,NULL,'Anestozjologii i Intensywnej
Terapii','OIOM',NULL,NULL,0,NULL,0,NULL,1,'OIOM',NULL,'001');
insert  into
`podjednorg`(`ID`,`ljedn2id`,`kod8`,`NazwaPodj`,`skrot`,`Aktywny`,`createdate`,`createuser`,`upddate`,`upduser`,`OldLink`,`lswiadczid`,`ClShort`,`kod_kosztowy`,`kod7`)
values (452,0,NULL,'Anestozjologii i Intensywnej
Terapii','OIOM',NULL,NULL,0,NULL,0,NULL,1,'OIOM',NULL,'001');
insert  into
`podjednorg`(`ID`,`ljedn2id`,`kod8`,`NazwaPodj`,`skrot`,`Aktywny`,`createdate`,`createuser`,`upddate`,`upduser`,`OldLink`,`lswiadczid`,`ClShort`,`kod_kosztowy`,`kod7`)
values (453,0,NULL,'Anestozjologii i Intensywnej
Terapii','OIOM',NULL,NULL,0,NULL,0,NULL,1,'OIOM',NULL,'001');
insert  into
`podjednorg`(`ID`,`ljedn2id`,`kod8`,`NazwaPodj`,`skrot`,`Aktywny`,`createdate`,`createuser`,`upddate`,`upduser`,`OldLink`,`lswiadczid`,`ClShort`,`kod_kosztowy`,`kod7`)
values (454,0,NULL,'Anestozjologii i Intensywnej
Terapii','OIOM',NULL,NULL,0,NULL,0,NULL,1,'OIOM',NULL,'001');
insert  into
`podjednorg`(`ID`,`ljedn2id`,`kod8`,`NazwaPodj`,`skrot`,`Aktywny`,`createdate`,`createuser`,`upddate`,`upduser`,`OldLink`,`lswiadczid`,`ClShort`,`kod_kosztowy`,`kod7`)
values (455,0,NULL,'Anestozjologii i Intensywnej
Terapii','OIOM',NULL,NULL,0,NULL,0,NULL,1,'OIOM',NULL,'001');
insert  into
`podjednorg`(`ID`,`ljedn2id`,`kod8`,`NazwaPodj`,`skrot`,`Aktywny`,`createdate`,`createuser`,`upddate`,`upduser`,`OldLink`,`lswiadczid`,`ClShort`,`kod_kosztowy`,`kod7`)
values (456,0,NULL,'Anestozjologii i Intensywnej
Terapii','OIOM',NULL,NULL,0,NULL,0,NULL,1,'OIOM',NULL,'001');
insert  into
`podjednorg`(`ID`,`ljedn2id`,`kod8`,`NazwaPodj`,`skrot`,`Aktywny`,`createdate`,`createuser`,`upddate`,`upduser`,`OldLink`,`lswiadczid`,`ClShort`,`kod_kosztowy`,`kod7`)
values (457,0,NULL,'Anestozjologii i Intensywnej
Terapii','OIOM',NULL,NULL,0,NULL,0,NULL,1,'OIOM',NULL,'001');
insert  into
`podjednorg`(`ID`,`ljedn2id`,`kod8`,`NazwaPodj`,`skrot`,`Aktywny`,`createdate`,`createuser`,`upddate`,`upduser`,`OldLink`,`lswiadczid`,`ClShort`,`kod_kosztowy`,`kod7`)
values (458,0,NULL,'Anestozjologii i Intensywnej
Terapii','OIOM',NULL,NULL,0,NULL,0,NULL,1,'OIOM',NULL,'001');
insert  into
`podjednorg`(`ID`,`ljedn2id`,`kod8`,`NazwaPodj`,`skrot`,`Aktywny`,`createdate`,`createuser`,`upddate`,`upduser`,`OldLink`,`lswiadczid`,`ClShort`,`kod_kosztowy`,`kod7`)
values (459,0,NULL,'Anestozjologii i Intensywnej
Terapii','OIOM',NULL,NULL,0,NULL,0,NULL,1,'OIOM',NULL,'001');

/*Table structure for table `podjednorg_ext` */

CREATE TABLE `podjednorg_ext` (
  `podj_id` int(11) NOT NULL,
  `extid` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`podj_id`),
  KEY `extid` (`extid`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1250;

/*Data for the table `podjednorg_ext` */

insert  into `podjednorg_ext`(`podj_id`,`extid`) values (449,'OIOM');
insert  into `podjednorg_ext`(`podj_id`,`extid`) values (450,'OIOM');
insert  into `podjednorg_ext`(`podj_id`,`extid`) values (451,'OIOM');
insert  into `podjednorg_ext`(`podj_id`,`extid`) values (452,'OIOM');
insert  into `podjednorg_ext`(`podj_id`,`extid`) values (453,'OIOM');
insert  into `podjednorg_ext`(`podj_id`,`extid`) values (454,'OIOM');
insert  into `podjednorg_ext`(`podj_id`,`extid`) values (455,'OIOM');
insert  into `podjednorg_ext`(`podj_id`,`extid`) values (456,'OIOM');
insert  into `podjednorg_ext`(`podj_id`,`extid`) values (457,'OIOM');
insert  into `podjednorg_ext`(`podj_id`,`extid`) values (458,'OIOM');
insert  into `podjednorg_ext`(`podj_id`,`extid`) values (459,'OIOM');

/*Table structure for table `preview_email` */

CREATE TABLE `preview_email` (
  `header` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `content` text COLLATE utf8_polish_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

/*Data for the table `preview_email` */

insert  into `preview_email`(`header`,`content`) values
('Kliknisdfsdfsdf','fhghfghfghfghfghsdfsdfsdfsdf');

/*Table structure for table `saved_element` */

CREATE TABLE `saved_element` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `id_column` int(11) NOT NULL DEFAULT '0',
  `id_crown` int(11) NOT NULL DEFAULT '0',
  `id_fitting` int(11) NOT NULL DEFAULT '0',
  `text_column` varchar(255) COLLATE utf8_polish_ci DEFAULT '',
  `text_crown` varchar(255) COLLATE utf8_polish_ci DEFAULT '',
  `text_fitting` varchar(255) COLLATE utf8_polish_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8
COLLATE=utf8_polish_ci;

/*Data for the table `saved_element` */

insert  into
`saved_element`(`id`,`id_user`,`id_column`,`id_crown`,`id_fitting`,`text_column`,`text_crown`,`text_fitting`)
values (1,1,13,16,13,'Slup 2','sdasdasd',NULL);
insert  into
`saved_element`(`id`,`id_user`,`id_column`,`id_crown`,`id_fitting`,`text_column`,`text_crown`,`text_fitting`)
values (2,1234567,15,14,14,'sdgdfg','asdsad','a');

/*Table structure for table `send_buffor` */

CREATE TABLE `send_buffor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `send` tinyint(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8
COLLATE=utf8_polish_ci;

/*Data for the table `send_buffor` */

insert  into `send_buffor`(`id`,`email`,`username`,`send`) values
(1,'adin@op.pl','Adin Adinowski',-1);
insert  into `send_buffor`(`id`,`email`,`username`,`send`) values
(2,'adin@op.pl','Adin Adinowski',-1);
insert  into `send_buffor`(`id`,`email`,`username`,`send`) values
(3,'adin@op.pl','Adin Adinowski',-1);
insert  into `send_buffor`(`id`,`email`,`username`,`send`) values
(4,'adin@op.pl','Adin Adinowski',-1);
insert  into `send_buffor`(`id`,`email`,`username`,`send`) values
(5,'adin@op.pl','Adin Adinowski',-1);
insert  into `send_buffor`(`id`,`email`,`username`,`send`) values
(6,'adin@op.pl','Adin Adinowski',-1);
insert  into `send_buffor`(`id`,`email`,`username`,`send`) values
(7,'adin@op.pl','Adin Adinowski',-1);
insert  into `send_buffor`(`id`,`email`,`username`,`send`) values
(8,'adin@op.pl','Adin Adinowski',-1);
insert  into `send_buffor`(`id`,`email`,`username`,`send`) values
(9,'adin@op.pl','Adin Adinowski',-1);

/*Table structure for table `send_param` */

CREATE TABLE `send_param` (
  `duration` decimal(10,4) DEFAULT NULL,
  `pack` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

/*Data for the table `send_param` */

insert  into `send_param`(`duration`,`pack`) values ('-1.0000',24);

/*Table structure for table `users` */

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `type` enum('user','admin') COLLATE utf8_polish_ci NOT NULL DEFAULT
  'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8
COLLATE=utf8_polish_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`type`) values (18,'Klient
3','zxc','user');
insert  into `users`(`id`,`username`,`password`,`type`) values (16,'Klient
1','abc','user');
insert  into `users`(`id`,`username`,`password`,`type`) values (17,'Klient
2','cba','user');
insert  into `users`(`id`,`username`,`password`,`type`) values
(19,'admin','demo1234','admin');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*
SQLyog Community v10.51 
MySQL - 5.5.5-10.1.30-MariaDB : Database - laravel_boilerplate_56
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`laravel_boilerplate_56` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `laravel_boilerplate_56`;

/*Table structure for table `admins` */

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `karyawan_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_id` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `admins` */

insert  into `admins`(`id`,`nama`,`email`,`password`,`karyawan_id`,`role_id`,`remember_token`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (1,'Agus Santoso','iam.agussantoso@gmail.com','$2y$10$ijZPBtN1f3.ylXQKFpC7sewA5J9ySSNWmW7ulEFL7S0.nFUg66X9y','12','2','6FxQTk3JNYkV2X4pnJ1Jrd5Oui43RWcfcr9mpCKJ2xOjFrC8RzHQJoc0vsJi',NULL,NULL,NULL,NULL),(4,'Faerul Salamun','faerul@gmail.com','$2y$10$JH6Ro1DQtg7.hplkQInH.eN6F0Zo6esWTBynNR4YM6V4/sVLX3lWq','1','1',NULL,1,1,'2018-09-05 09:57:18','2018-09-05 09:57:18'),(5,'Salma Ramadhiany','salma15@gmail.com','$2y$10$ZmvR14oTQDq12919/fvMM.w1ajjNxikgsTQKBfihhYL8lu7YB3wVC','Ridwan Fauzan','1','AySfpdIzIpqYDYYkVyKypSagH47020XJOdmRZuRTEBuPxkyfQ7mPinH6alNu',1,1,'2018-09-16 03:08:57','2018-09-16 03:08:57'),(6,'Liawati','liawati@gmail.com','$2y$10$dPnMnh0kmpgsbUftRCxBjuZMNfOF.VjvGLLoNnaf9xhHysR.Gcoly','Anida','1','5QNBu5t4G7R9pzqHObJi5ll9uSGmFSRRYbXPiF5cotIfqVC3NyHNWTJKhMAu',5,6,'2018-11-23 14:39:27','2018-11-23 14:42:21'),(7,'Aini','aini@gmail.com','$2y$10$XbATXVSwhvzyXWY2ZGpovOmIa.caGuSgaAPlK6SGYhEKx/lEURCPi','Faerul Salamun','1',NULL,5,5,'2019-03-03 15:31:57','2019-03-03 15:31:57');

/*Table structure for table `gaji` */

DROP TABLE IF EXISTS `gaji`;

CREATE TABLE `gaji` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `karyawan_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gaji` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hari` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `jam` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `totalgaji` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `gaji` */

insert  into `gaji`(`id`,`karyawan_id`,`gaji`,`hari`,`jam`,`totalgaji`,`created_at`,`updated_at`) values (2,'salma','1000000','6','8','4999808','2018-09-16 03:32:11','2018-09-16 03:32:11'),(3,'Faerul Salamun','5000000','30','8','5000000','2018-10-04 06:39:58','2018-10-04 06:39:58'),(4,'Salma Ramadhiany','5000000','24','8','4999952','2018-10-12 03:42:45','2018-10-12 03:42:45'),(5,'Faerul Salamun','50000','24','8','9600000','2018-11-24 02:13:18','2018-11-24 02:13:18'),(6,'Ikhsan Nurkholis','5000','8','9','2080.9248554913293','2018-12-03 17:16:54','2018-12-03 17:16:54'),(7,'Agus Santoso','5000','8','6','1387.2832369942196','2018-12-03 17:21:55','2018-12-03 17:21:55'),(8,'Faerul Salamun','5000','9','4','1040.4624277456646','2018-12-03 17:22:40','2018-12-03 17:22:40');

/*Table structure for table `jabatan` */

DROP TABLE IF EXISTS `jabatan`;

CREATE TABLE `jabatan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_jabatan` varchar(255) DEFAULT NULL,
  `nama_jabatan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `jabatan` */

insert  into `jabatan`(`id`,`id_jabatan`,`nama_jabatan`,`created_at`,`updated_at`) values (1,'111','CEO','2018-09-05 15:58:06','2018-09-05 08:58:06'),(2,'222','COO','2018-09-05 08:57:49','2018-09-05 08:57:49'),(3,'333','Android Developer','2018-09-05 09:01:16','2018-09-05 09:01:16'),(4,'444','Full Stack Developer','2018-09-05 09:01:56','2018-09-05 09:01:56'),(5,'555','Back end','2018-09-05 09:02:20','2018-09-05 09:02:20'),(6,'666','Quality Assurance','2018-09-05 09:03:03','2018-09-05 09:03:03'),(7,'777','Project Manager','2018-09-05 09:03:30','2018-09-05 09:03:30'),(8,'888','Manager','2018-09-20 05:58:48','2018-09-20 05:58:48'),(9,'999','Frontend','2018-10-12 03:46:08','2018-10-12 03:46:08'),(10,'1010','Teater Programming','2018-11-07 12:46:52','2018-11-07 12:46:52'),(11,'1010','HRD','2018-11-23 14:43:26','2018-11-23 14:43:26'),(12,'1010','Elektronik','2019-03-03 15:40:30','2019-03-03 15:40:30');

/*Table structure for table `karyawan` */

DROP TABLE IF EXISTS `karyawan`;

CREATE TABLE `karyawan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nik` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_jabatan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `jk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal_lahir` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `agama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `no_tlp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `karyawan` */

insert  into `karyawan`(`id`,`nik`,`nama`,`id_jabatan`,`jk`,`tempat_lahir`,`tanggal_lahir`,`agama`,`no_tlp`,`alamat`,`created_at`,`updated_at`) values (1,'1212','Faerul Salamun','CEO','L;','Bandung','09-02-1994','Islma','090890','Kiara Sari','2018-09-05 09:05:04','2018-12-02 15:01:40'),(2,'1313','Okta Dwi Priatna','COO','L','BAndung','03-08-1994','Islma','083822222194','Kiara Condong','2018-09-05 09:06:56','2018-09-05 10:01:59'),(3,'1414','Ikhsan Nurkholis','Android Developer','L','Garut','08-07-1993','Islam','085721983823','Margahayu ','2018-09-05 09:08:56','2018-09-05 09:08:56'),(4,'1515','Jadequeline','Full Stack Developer','P','Bandung','09-05-1995','kristen','08562238738','JL.Cibaduyut','2018-09-05 09:10:41','2018-09-05 09:10:41'),(5,'1616','Ridwan Fauzan','Back end','L','Bandung','06-04-1996','Islam','0896456789','Kopo','2018-09-05 09:11:50','2018-09-05 09:11:50'),(6,'1616','Fikry Andias Praja','Quality Assurance','L','Subang','08-02-1994','Islam','08785345678','Subang','2018-09-05 09:13:19','2018-09-05 09:13:19'),(7,'1717','Erwin Setiawan','Android Developer','L','Bandung','19-06-1996','Islam','09875367','Komp.Kiara permai','2018-09-05 09:14:34','2018-09-05 09:14:34'),(8,'1818','Agus Santoso','Back end','L','Bandung','09-07-1995','Islam','0987646789','Ciganitri','2018-09-05 09:15:34','2018-09-05 09:16:18'),(9,'1919','Aldi Rachman Putra','Project Manager','L','Bandung','03-08-1995','Islam','08575940940','Arcamanik','2018-09-05 09:18:00','2018-09-05 09:18:00'),(10,'12121','Salma Ramadhiany','Back end','P','Bandung','05-09-2018','Islam','09090','Riung Bandungg','2018-09-12 12:30:16','2018-09-12 12:30:16'),(11,'3131','Anida','Manager','P','Bandung','2018-08-19','Islam','09090','Ciganitri','2018-10-12 03:34:12','2018-10-12 03:34:12'),(12,'333','Liawati','CEO','P','Bandung','2018-11-18','Islam','989370','Cibiru','2018-11-23 14:41:32','2018-11-23 14:41:32'),(13,'342343','salma','CEO','p','bandung','2018-12-11','islam','78798','bandung','2018-12-18 08:41:53','2018-12-18 08:41:53');

/*Table structure for table `kontak` */

DROP TABLE IF EXISTS `kontak`;

CREATE TABLE `kontak` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nohp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `kontak` */

insert  into `kontak`(`id`,`nama`,`email`,`alamat`,`nohp`,`created_at`,`updated_at`) values (1,'Conner Ullrich','bartoletti.samir@cronin.org','8077 Stroman Ville\nEast Leoneport, KS 19839-0437','+1 (408) 612-1426',NULL,NULL),(2,'Merl Yundt','everardo.flatley@yahoo.com','54161 Gunner Ramp\nNorth Hailey, RI 38374-5954','+1.954.284.5312',NULL,NULL),(3,'Mrs. Precious Bauch','jane83@gusikowski.biz','513 Lehner Locks Suite 821\nMaziemouth, KY 72044-1768','(314) 937-3704 x51534',NULL,NULL),(4,'Mario Prosacco','blick.marjory@yahoo.com','4452 Hope Fork Apt. 889\nEverardoborough, WA 37542','+1.308.605.7269',NULL,NULL),(5,'Mr. Gerard Stiedemann III','lera95@hotmail.com','37784 Dare Pass\nPort Thorachester, LA 47641-9446','(483) 748-1429',NULL,NULL),(6,'Dr. Maxwell Mitchell','vcummerata@hotmail.com','8782 Armani Branch Suite 104\nHermanfurt, DC 09350','+1-689-454-6774',NULL,NULL),(7,'Mr. Emmanuel Rutherford MD','geovanny.quitzon@yahoo.com','711 Jayce Manors Apt. 611\nKuhnhaven, WY 50624','+1.964.468.4405',NULL,NULL),(8,'Miss Willow Mayert','jared.sawayn@gmail.com','9000 Bartell Ridges Apt. 658\nCaspermouth, VA 61437-4340','503.237.0553 x44828',NULL,NULL),(9,'Tracy Hegmann','oschumm@jerde.net','72097 Dooley Ramp Suite 076\nKochhaven, AZ 65134','595-703-9391 x900',NULL,NULL),(10,'Martine McDermott','hulda55@yahoo.com','70303 Lennie Drive Apt. 902\nCummingsberg, ID 86932-8610','+1-542-817-0458',NULL,NULL),(11,'Isom Sauer','kimberly96@gmail.com','1259 Huels Station Suite 721\nDaughertymouth, OR 89968-4012','1-690-281-7913 x94956',NULL,NULL),(12,'Miguel Douglas','pprosacco@feil.com','171 Runolfsson Brook\nMcLaughlinbury, NJ 79250-6432','692-846-8086 x5726',NULL,NULL),(13,'Sheila Stokes','xswift@reichel.com','271 Krajcik Field Apt. 696\nNorth Thadburgh, IA 87402-3204','1-208-275-5564 x3368',NULL,NULL),(14,'Minnie Goldner','ubahringer@dickinson.com','251 Kuhn Glen Apt. 367\nCreminberg, OK 80495','+1 (353) 421-5268',NULL,NULL),(15,'Madelynn Cummings','gerson.gusikowski@reichert.com','55589 Huel Walks Suite 009\nLake Paulamouth, TN 36688','+19266997006',NULL,NULL),(16,'Naomie Kohler I','francisco58@goyette.info','6894 Johns Ridges Suite 702\nNorth Janiceville, MN 97500-4792','(861) 208-7803 x76748',NULL,NULL),(17,'Prof. Trevion Hane','aiyana87@hotmail.com','97551 Ida Expressway Suite 724\nGaylordmouth, CA 42710','+18052982498',NULL,NULL),(18,'Ulices Harris Jr.','frederick49@hotmail.com','88523 Green Radial\nO\'Harahaven, CA 12104-5292','+1.753.250.3532',NULL,NULL),(19,'Ali Prohaska','rolfson.davon@gmail.com','3122 Hillary Hollow Suite 964\nNew Maeland, IL 47386','989.551.8445',NULL,NULL),(20,'Caitlyn Rau','tatyana.klocko@kertzmann.com','542 DuBuque Pines\nLehnerside, NM 35613-7331','(923) 622-9977',NULL,NULL);

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2018_06_07_043124_create_admin',1),(4,'2018_08_13_082214_bikin_table_karyawan',2),(5,'2018_09_06_040836_bikin_table_kontak',3),(6,'2018_09_10_071449_bikin_table_gaji',4);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) DEFAULT NULL,
  `nama` varchar(573) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `roles` */

insert  into `roles`(`id`,`nama`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (1,'admin apps',NULL,NULL,'2018-08-15 13:08:54','0000-00-00 00:00:00'),(2,'karyawan1',NULL,NULL,'2018-08-22 18:45:54','0000-00-00 00:00:00');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

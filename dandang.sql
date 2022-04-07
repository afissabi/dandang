/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.21-MariaDB : Database - dandang
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dandang` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `dandang`;

/*Table structure for table `m_about` */

DROP TABLE IF EXISTS `m_about`;

CREATE TABLE `m_about` (
  `id_about` int(11) NOT NULL AUTO_INCREMENT,
  `type` char(2) NOT NULL COMMENT '0=Tentang Kami, 1=Visi, 2=Misi',
  `isi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` timestamp NULL DEFAULT NULL,
  `updated_by` timestamp NULL DEFAULT NULL,
  `deleted_by` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_about`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 STATS_AUTO_RECALC=0;

/*Data for the table `m_about` */

insert  into `m_about`(`id_about`,`type`,`isi`,`gambar`,`path`,`created_at`,`updated_at`,`deleted_at`,`created_by`,`updated_by`,`deleted_by`) values 
(1,'0','<p>Isi tentang kami baru coy</p>','gambar-tentang-kami.jpg','/public/img/web\\gambar-tentang-kami.jpg','2022-04-07 03:34:57','2022-04-07 07:25:30',NULL,NULL,NULL,NULL),
(2,'1','Visi kami baru',NULL,NULL,'2022-04-07 03:49:38','2022-04-07 07:25:30',NULL,NULL,NULL,NULL),
(3,'2','Misi Kami baru',NULL,NULL,'2022-04-07 03:49:38','2022-04-07 07:25:30',NULL,NULL,NULL,NULL);

/*Table structure for table `m_menu` */

DROP TABLE IF EXISTS `m_menu`;

CREATE TABLE `m_menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(255) DEFAULT NULL,
  `status` char(255) DEFAULT NULL COMMENT '0=Tunggal, 1=parent, 2=child_parent, 3=sub_parent, 4=child_sub_parent',
  `parent_id` int(11) DEFAULT NULL,
  `sub_parent_id` int(11) DEFAULT NULL,
  `is_aktif` char(2) DEFAULT NULL COMMENT '0=Tidak Aktif, 1=Aktif',
  `urutan` int(11) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `url_menu` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_menu`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

/*Data for the table `m_menu` */

insert  into `m_menu`(`id_menu`,`nama_menu`,`status`,`parent_id`,`sub_parent_id`,`is_aktif`,`urutan`,`icon`,`url_menu`,`created_at`,`updated_at`,`deleted_at`,`created_by`,`updated_by`,`deleted_by`) values 
(1,'Master','1',NULL,NULL,'1',2,'fab fa-buffer','/master','2022-02-01 14:58:37',NULL,NULL,1,NULL,NULL),
(2,'Menu','4',1,11,'1',1,NULL,'/master/hak-akses/menu','2022-02-11 15:01:12','2022-03-02 08:08:28',NULL,1,NULL,NULL),
(3,'Dashboard','0',NULL,NULL,'1',1,'fas fa-chalkboard','/dashboard','2022-02-14 10:14:03','2022-02-16 04:06:11',NULL,1,NULL,NULL),
(4,'Role User','4',1,11,'1',2,NULL,'master/hak-akses/role-user','2022-02-14 08:51:01','2022-02-25 09:02:01',NULL,1,NULL,NULL),
(7,'Menu Ho','0',NULL,NULL,'1',4,NULL,'/master/menuho','2022-02-16 02:27:50','2022-02-16 02:28:29','2022-02-16 02:28:29',1,NULL,NULL),
(8,'Menu Ho','2',1,NULL,'1',4,NULL,'/master/menuho','2022-02-16 04:08:27','2022-02-16 04:08:38','2022-02-16 04:08:38',1,NULL,NULL),
(9,'Menu Coba','0',NULL,NULL,'1',7,NULL,'/master/menuho','2022-02-16 04:09:17','2022-02-16 04:09:39','2022-02-16 04:09:39',1,NULL,NULL),
(10,'User','4',1,11,'1',3,NULL,'master/hak-akses/user','2022-02-16 06:25:09','2022-02-24 04:04:04',NULL,1,NULL,NULL),
(11,'Hak Akses','3',1,NULL,'1',1,'fa fa-fingerprint','/hak-akses','2022-02-24 03:39:51','2022-02-24 04:02:46',NULL,1,NULL,NULL),
(12,'Menu Ho','0',NULL,NULL,'1',3,'fas fa-chalkboard','/dashboard/ho','2022-02-25 07:09:14','2022-02-25 07:13:32','2022-02-25 07:13:32',1,NULL,NULL),
(13,'Keuangan','5',NULL,NULL,'1',3,'far fa-money-bill-alt','keuangan','2022-03-15 07:37:45','2022-03-16 00:44:27',NULL,1,NULL,NULL),
(14,'Pemasukan','6',13,NULL,'1',1,NULL,'keuangan/pemasukan','2022-03-15 07:45:57','2022-03-15 07:45:57',NULL,1,NULL,NULL),
(15,'Klinik','3',1,NULL,'1',2,'fa fa-hospital','master/klinik','2022-03-19 21:42:08','2022-03-20 17:13:30',NULL,NULL,NULL,NULL),
(16,'Barang','2',1,NULL,'1',4,'fa fa-box','master/barang','2022-03-19 21:57:30','2022-03-19 21:59:14',NULL,NULL,NULL,NULL),
(17,'Pegawai','3',1,NULL,'1',3,'fa fa-users','master/pegawai','2022-03-19 21:59:05','2022-03-20 16:17:47',NULL,NULL,NULL,NULL),
(18,'jabatan','4',1,17,'1',1,NULL,'master/pegawai/jabatan','2022-03-19 22:05:44','2022-03-20 16:18:12',NULL,NULL,NULL,NULL),
(19,'Data Pasien','3',1,NULL,'1',6,'fa fa-user','master/data-pasien','2022-03-19 22:15:26','2022-03-20 17:22:47',NULL,NULL,NULL,NULL),
(20,'Status Klinik','4',1,15,'1',1,NULL,'master/klinik/status','2022-03-20 17:14:20','2022-03-20 17:14:20',NULL,NULL,NULL,NULL),
(21,'Data Klinik','4',1,15,'1',2,NULL,'master/klinik/daftar','2022-03-20 17:14:48','2022-03-20 17:14:48',NULL,NULL,NULL,NULL),
(22,'Rekanan','3',1,NULL,'1',4,'fas fa-american-sign-language-interpreting','master/rekanan','2022-03-20 17:17:05','2022-03-22 00:35:33',NULL,NULL,NULL,NULL),
(23,'Laboratorium','4',1,22,'1',1,NULL,'master/rekanan/laboratorium','2022-03-20 17:18:32','2022-03-20 17:18:32',NULL,NULL,NULL,NULL),
(24,'Apotik','4',1,22,'1',2,NULL,'master/rekanan/apotik','2022-03-20 17:18:47','2022-03-20 17:18:47',NULL,NULL,NULL,NULL),
(25,'Data Pegawai','4',1,17,'1',2,NULL,'master/pegawai/data','2022-03-20 17:21:52','2022-03-20 17:21:52',NULL,NULL,NULL,NULL),
(26,'Setting No. RM','4',1,19,'1',1,NULL,'master/data-pasien/no-rm','2022-03-20 17:23:41','2022-03-20 17:23:41',NULL,NULL,NULL,NULL),
(27,'Data Pasien','4',1,19,'1',2,NULL,'master/data-pasien/','2022-03-20 17:24:08','2022-03-20 17:24:08',NULL,NULL,NULL,NULL),
(28,'Kasir','0',NULL,NULL,'1',4,'fa fa-calculator','kasir','2022-03-20 17:28:18','2022-03-20 17:28:18',NULL,NULL,NULL,NULL),
(29,'Devisi','4',1,15,'1',3,NULL,'master/klinik/devisi','2022-03-22 00:41:29','2022-03-22 00:41:29',NULL,NULL,NULL,NULL),
(30,'CMS Website','1',NULL,NULL,'1',4,'fas fa-chalkboard','cms-website','2022-04-06 04:48:04','2022-04-06 04:48:04',NULL,NULL,NULL,NULL),
(31,'Tentang Kami','2',30,NULL,'1',1,'fas fa-quote-left','/cms-website/tentang-kami','2022-04-06 04:49:59','2022-04-06 06:38:55',NULL,NULL,NULL,NULL);

/*Table structure for table `m_menu_user` */

DROP TABLE IF EXISTS `m_menu_user`;

CREATE TABLE `m_menu_user` (
  `id_menu_user` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) DEFAULT NULL,
  `id_role` int(11) DEFAULT NULL,
  `create_btn` char(2) DEFAULT NULL,
  `edit_btn` char(2) DEFAULT NULL,
  `delete_btn` char(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_menu_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

/*Data for the table `m_menu_user` */

insert  into `m_menu_user`(`id_menu_user`,`id_menu`,`id_role`,`create_btn`,`edit_btn`,`delete_btn`,`created_at`,`updated_at`,`deleted_at`,`created_by`,`updated_by`,`deleted_by`) values 
(1,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(2,2,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(3,3,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(4,4,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(5,10,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(6,11,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(7,12,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(8,13,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(10,14,1,NULL,NULL,NULL,'2022-03-17 08:09:00','2022-03-17 08:09:00',NULL,NULL,NULL,NULL),
(11,13,4,NULL,NULL,NULL,'2022-03-17 08:26:31','2022-03-17 08:26:31',NULL,NULL,NULL,NULL),
(12,14,4,NULL,NULL,NULL,'2022-03-17 08:26:32','2022-03-17 08:26:32',NULL,NULL,NULL,NULL),
(13,15,1,NULL,NULL,NULL,'2022-03-19 21:50:32','2022-03-19 21:50:32',NULL,NULL,NULL,NULL),
(14,16,1,NULL,NULL,NULL,'2022-03-19 21:57:50','2022-03-19 21:57:50',NULL,NULL,NULL,NULL),
(15,17,1,NULL,NULL,NULL,'2022-03-19 21:59:26','2022-03-19 21:59:26',NULL,NULL,NULL,NULL),
(16,18,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(17,19,1,NULL,NULL,NULL,'2022-03-19 22:15:37','2022-03-19 22:15:37',NULL,NULL,NULL,NULL),
(18,20,1,NULL,NULL,NULL,'2022-03-20 17:15:34','2022-03-20 17:15:34',NULL,NULL,NULL,NULL),
(19,21,1,NULL,NULL,NULL,'2022-03-20 17:15:35','2022-03-20 17:15:35',NULL,NULL,NULL,NULL),
(20,22,1,NULL,NULL,NULL,'2022-03-20 17:17:31','2022-03-20 17:17:31',NULL,NULL,NULL,NULL),
(21,23,1,NULL,NULL,NULL,'2022-03-20 17:20:24','2022-03-20 17:20:24',NULL,NULL,NULL,NULL),
(22,24,1,NULL,NULL,NULL,'2022-03-20 17:20:24','2022-03-20 17:20:24',NULL,NULL,NULL,NULL),
(23,25,1,NULL,NULL,NULL,'2022-03-20 17:24:41','2022-03-20 17:24:41',NULL,NULL,NULL,NULL),
(24,26,1,NULL,NULL,NULL,'2022-03-20 17:24:41','2022-03-20 17:24:41',NULL,NULL,NULL,NULL),
(25,27,1,NULL,NULL,NULL,'2022-03-20 17:24:41','2022-03-20 17:24:41',NULL,NULL,NULL,NULL),
(26,28,1,NULL,NULL,NULL,'2022-03-20 17:28:28','2022-03-20 17:28:28',NULL,NULL,NULL,NULL),
(27,29,1,NULL,NULL,NULL,'2022-03-22 00:41:44','2022-03-22 00:41:44',NULL,NULL,NULL,NULL),
(28,30,1,NULL,NULL,NULL,'2022-04-06 04:48:21','2022-04-06 04:48:21',NULL,NULL,NULL,NULL),
(29,31,1,NULL,NULL,NULL,'2022-04-06 04:50:16','2022-04-06 04:50:16',NULL,NULL,NULL,NULL);

/*Table structure for table `m_role` */

DROP TABLE IF EXISTS `m_role`;

CREATE TABLE `m_role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `nama_role` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `is_aktif` char(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_role`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

/*Data for the table `m_role` */

insert  into `m_role`(`id_role`,`nama_role`,`keterangan`,`is_aktif`,`created_at`,`updated_at`,`deleted_at`,`created_by`,`updated_by`,`deleted_by`) values 
(1,'Admin','Admin Aplikasi','1','2022-02-16 11:47:34',NULL,NULL,NULL,NULL,NULL),
(2,'User','User Aplikasi','1','2022-02-16 06:22:54','2022-02-16 06:23:05','2022-02-16 06:23:05',NULL,NULL,NULL),
(3,'User Iku','User Aplikasi','1','2022-02-16 06:23:11','2022-02-16 06:23:48','2022-02-16 06:23:48',NULL,NULL,NULL),
(4,'Admin Keuangan','Untuk Cek Keuangan','1','2022-03-17 08:23:25','2022-03-17 08:23:25',NULL,NULL,NULL,NULL);

/*Table structure for table `m_status` */

DROP TABLE IF EXISTS `m_status`;

CREATE TABLE `m_status` (
  `id_status` int(11) NOT NULL,
  `nama_status` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `m_status` */

/*Table structure for table `m_user` */

DROP TABLE IF EXISTS `m_user`;

CREATE TABLE `m_user` (
  `id_user` bigint(20) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_aktif` char(2) DEFAULT NULL COMMENT '0=Tidak Aktif, 1=Aktif',
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `password_old` varchar(255) DEFAULT NULL,
  `see_password_old` varchar(255) DEFAULT NULL,
  `see_password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

/*Data for the table `m_user` */

insert  into `m_user`(`id_user`,`nama`,`username`,`password`,`is_aktif`,`role_id`,`created_at`,`updated_at`,`deleted_at`,`created_by`,`updated_by`,`deleted_by`,`password_old`,`see_password_old`,`see_password`) values 
(1,'Testing','testing','$2y$10$MyOX7gXGa4ugkmgWa7NkuexnbK3z59H1OP4kOGk7I1oIQWvH146cm','1',1,'2022-02-11 14:31:39',NULL,NULL,NULL,NULL,NULL,'$2y$10$MyOX7gXGa4ugkmgWa7NkuexnbK3z59H1OP4kOGk7I1oIQWvH146cm','728uql','728uql'),
(2,'Wahyu','wahyu','$2y$10$JrTYxI5cqiEITgJByDIlZu3CZjnL4x7KLX6ajRgYTsrDUOEh2lIPe','1',4,'2022-03-17 08:32:05','2022-03-17 08:32:05',NULL,NULL,NULL,NULL,'$2y$10$wcmsWNQ74TvcBcTGMeVMEOJ0BBj6/F.NKgME5ikI9OoNwPtGieFW.','123456','123456');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

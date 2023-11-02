/*
SQLyog Professional v12.5.1 (64 bit)
MySQL - 10.4.18-MariaDB : Database - rm
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`rm` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `rm`;

/*Table structure for table `aplikasi` */

DROP TABLE IF EXISTS `aplikasi`;

CREATE TABLE `aplikasi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_owner` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tlp` varchar(50) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `nama_aplikasi` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `copy_right` varchar(50) DEFAULT NULL,
  `versi` varchar(20) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `aplikasi` */

insert  into `aplikasi`(`id`,`nama_owner`,`alamat`,`tlp`,`title`,`nama_aplikasi`,`logo`,`copy_right`,`versi`,`tahun`) values 
(1,'Adam Nurfauzan Subiyanto','Bogor','-','Retensi Rekam Medis','Sistem Informasi Retensi Rekam Medis','AdminLTELogo1.png','Copy Right &copy;','1.0.0.0',2023);

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kdbarang` varchar(15) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `harga` decimal(10,0) DEFAULT NULL,
  `satuan` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `barang` */

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id_kat` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_kat` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_kat`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `kategori` */

/*Table structure for table `pasien` */

DROP TABLE IF EXISTS `pasien`;

CREATE TABLE `pasien` (
  `nik` bigint(16) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `JK` enum('L','P') NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  PRIMARY KEY (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pasien` */

insert  into `pasien`(`nik`,`nama`,`JK`,`tgl_lahir`,`alamat`,`pekerjaan`) values 
(3102937109090999,'Sadam','L','2023-08-03','Bogor','Polisi'),
(3102937109091092,'Irfan M','L','2023-08-06','Kuningan','Supir'),
(3102937109092131,'Adam Nurfauzan Subiyanto','L','2000-10-27','Bogor','Mahasiswa');

/*Table structure for table `poli` */

DROP TABLE IF EXISTS `poli`;

CREATE TABLE `poli` (
  `id_poli` int(11) NOT NULL AUTO_INCREMENT,
  `nama_poli` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_poli`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

/*Data for the table `poli` */

insert  into `poli`(`id_poli`,`nama_poli`) values 
(1,'Anak'),
(2,'Kebidanan & Kandungan'),
(3,'Gigi'),
(4,'Saraf'),
(5,'Penyakit Dalam'),
(6,'Paru'),
(7,'Bedah'),
(8,'Kulit & Kelamin'),
(9,'Patalogi Anatomi'),
(10,'Patalogi klinik'),
(11,'Anestesi'),
(12,'Radiologi'),
(13,'Jiwa'),
(14,'THT-KL'),
(15,'Ortopedi'),
(16,'Rehabilitasi Medik'),
(17,'Poli Umum');

/*Table structure for table `rekam_medis` */

DROP TABLE IF EXISTS `rekam_medis`;

CREATE TABLE `rekam_medis` (
  `no_remed` int(11) NOT NULL AUTO_INCREMENT,
  `id_remed` int(30) NOT NULL,
  `nik` bigint(16) NOT NULL,
  `tgl_awal` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `diagnosa` varchar(50) NOT NULL,
  `dokumen` varchar(100) DEFAULT NULL,
  `umur_berkas` int(3) NOT NULL,
  `status` int(10) NOT NULL,
  PRIMARY KEY (`no_remed`),
  UNIQUE KEY `nik` (`nik`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `rekam_medis` */

insert  into `rekam_medis`(`no_remed`,`id_remed`,`nik`,`tgl_awal`,`tgl_akhir`,`diagnosa`,`dokumen`,`umur_berkas`,`status`) values 
(1,0,2019008023812380,'2023-06-08','2023-07-12','','',0,1),
(5,0,3102937109090999,'2023-06-19','2023-08-03','Batuk','',0,1),
(6,0,3102937109092131,'2023-07-12','2023-10-30','e','',0,1),
(7,0,3102937109091092,'2023-08-03','2023-10-30','sa',NULL,0,1);

/*Table structure for table `riwayat_rm` */

DROP TABLE IF EXISTS `riwayat_rm`;

CREATE TABLE `riwayat_rm` (
  `id_riwayat_rm` int(11) NOT NULL AUTO_INCREMENT,
  `no_remed` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_poli` int(11) DEFAULT NULL,
  `tanggal_pemeriksaan` date DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `tanggal_keluar` date DEFAULT NULL,
  `diagnosis` text DEFAULT NULL,
  `dokumen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_riwayat_rm`),
  KEY `id_riwayat_rm` (`id_riwayat_rm`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `riwayat_rm` */

insert  into `riwayat_rm`(`id_riwayat_rm`,`no_remed`,`id_user`,`id_poli`,`tanggal_pemeriksaan`,`tanggal_masuk`,`tanggal_keluar`,`diagnosis`,`dokumen`) values 
(2,6,15,3,'2023-10-31','2023-11-08','2023-11-08','Checkup','Test_Aja.pdf'),
(3,6,15,3,'2023-10-31','2023-11-09','2023-11-09','Checkup','Test_Aja.pdf'),
(4,6,15,3,'2023-11-09','2023-11-11','2023-11-11','Checkup','Test_Aja.pdf'),
(7,6,16,17,'2023-11-01','2023-11-01','2023-11-01','Panas Dalam ','INI_TEH_DEMO_BERKAS_PDF.pdf');

/*Table structure for table `tbl_akses_menu` */

DROP TABLE IF EXISTS `tbl_akses_menu`;

CREATE TABLE `tbl_akses_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `view_level` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_akses_menu` */

insert  into `tbl_akses_menu`(`id`,`id_level`,`id_menu`,`view_level`) values 
(1,1,1,'Y'),
(2,1,2,'Y'),
(43,4,1,'Y'),
(44,4,2,'N'),
(62,5,1,'N'),
(63,5,2,'N'),
(64,1,52,'Y'),
(65,4,52,'Y'),
(66,5,52,'Y'),
(67,6,1,'N'),
(68,6,2,'N'),
(69,6,52,'N');

/*Table structure for table `tbl_akses_submenu` */

DROP TABLE IF EXISTS `tbl_akses_submenu`;

CREATE TABLE `tbl_akses_submenu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_level` int(11) NOT NULL,
  `id_submenu` int(11) NOT NULL,
  `view_level` enum('Y','N') DEFAULT 'N',
  `add_level` enum('Y','N') DEFAULT 'N',
  `edit_level` enum('Y','N') DEFAULT 'N',
  `delete_level` enum('Y','N') DEFAULT 'N',
  `print_level` enum('Y','N') DEFAULT 'N',
  `upload_level` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_akses_submenu` */

insert  into `tbl_akses_submenu`(`id`,`id_level`,`id_submenu`,`view_level`,`add_level`,`edit_level`,`delete_level`,`print_level`,`upload_level`) values 
(2,1,2,'N','Y','Y','Y','Y','Y'),
(4,1,1,'Y','Y','Y','Y','Y','Y'),
(6,1,7,'N','Y','Y','Y','Y','Y'),
(7,1,8,'Y','Y','Y','Y','Y','Y'),
(9,1,10,'Y','Y','Y','Y','Y','Y'),
(13,1,14,'Y','Y','Y','Y','Y','Y'),
(26,1,15,'Y','Y','Y','Y','Y','Y'),
(30,1,17,'Y','Y','Y','Y','Y','Y'),
(32,1,18,'Y','Y','Y','Y','Y','Y'),
(34,1,19,'Y','Y','Y','Y','Y','Y'),
(36,1,20,'Y','Y','Y','Y','Y','Y'),
(59,4,1,'N','N','N','N','N','N'),
(60,4,2,'N','N','N','N','N','N'),
(61,4,7,'N','N','N','N','N','N'),
(62,4,8,'N','N','N','N','N','N'),
(63,4,10,'N','N','N','N','N','N'),
(64,4,15,'N','N','N','N','N','N'),
(65,4,17,'N','N','N','N','N','N'),
(66,4,18,'N','N','N','N','N','N'),
(67,4,19,'N','N','N','N','N','N'),
(68,4,20,'N','N','N','N','N','N'),
(72,5,1,'N','N','N','N','N','N'),
(73,5,2,'N','N','N','N','N','N'),
(74,5,7,'N','N','N','N','N','N'),
(75,5,8,'N','N','N','N','N','N'),
(76,5,10,'N','N','N','N','N','N'),
(77,5,15,'N','N','N','N','N','N'),
(78,5,17,'N','N','N','N','N','N'),
(79,5,18,'N','N','N','N','N','N'),
(80,5,19,'N','N','N','N','N','N'),
(81,5,20,'N','N','N','N','N','N'),
(82,1,23,'Y','N','N','N','N','N'),
(83,4,23,'Y','N','N','N','N','N'),
(84,5,23,'Y','N','N','N','N','N'),
(88,1,25,'Y','N','N','N','N','N'),
(89,4,25,'Y','N','N','N','N','N'),
(90,5,25,'Y','N','N','N','N','N'),
(94,6,1,'N','N','N','N','N','N'),
(95,6,2,'N','N','N','N','N','N'),
(96,6,7,'N','N','N','N','N','N'),
(97,6,8,'N','N','N','N','N','N'),
(98,6,10,'N','N','N','N','N','N'),
(99,6,15,'N','N','N','N','N','N'),
(100,6,17,'N','N','N','N','N','N'),
(101,6,18,'N','N','N','N','N','N'),
(102,6,19,'N','N','N','N','N','N'),
(103,6,20,'N','N','N','N','N','N'),
(104,6,23,'N','N','N','N','N','N'),
(105,6,25,'N','N','N','N','N','N');

/*Table structure for table `tbl_menu` */

DROP TABLE IF EXISTS `tbl_menu`;

CREATE TABLE `tbl_menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(50) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `urutan` bigint(11) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `parent` enum('Y') DEFAULT 'Y',
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_menu` */

insert  into `tbl_menu`(`id_menu`,`nama_menu`,`link`,`icon`,`urutan`,`is_active`,`parent`) values 
(1,'Dashboard','dashboard','fas fa-tachometer-alt',1,'Y','Y'),
(2,'System','#','fas fa-cogs',2,'Y','Y'),
(52,'Menu Akses','aksesmenu','fas fa-hospital-user',1,'Y','Y');

/*Table structure for table `tbl_submenu` */

DROP TABLE IF EXISTS `tbl_submenu`;

CREATE TABLE `tbl_submenu` (
  `id_submenu` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_submenu` varchar(50) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`id_submenu`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_submenu` */

insert  into `tbl_submenu`(`id_submenu`,`nama_submenu`,`link`,`icon`,`id_menu`,`is_active`) values 
(1,'Menu','menu','far fa-circle',2,'Y'),
(2,'SubMenu','submenu','far fa-circle',2,'Y'),
(7,'Aplikasi','aplikasi','far fa-circle',2,'Y'),
(8,'User','user','far fa-circle',2,'Y'),
(10,'User Level','userlevel','far fa-circle',2,'Y'),
(15,'Barang','barang','far fa-circle',32,'Y'),
(17,'Kategori','kategori','far fa-circle',32,'Y'),
(18,'Satuan','satuan','far fa-circle',32,'Y'),
(19,'Pembelian','pembelian','far fa-circle',41,'Y'),
(20,'Penjualan','penjualan','far fa-circle',41,'Y'),
(23,'Pasien','pasien','fas fa-user-injured',52,'Y'),
(25,'Rekam Medis','rekammedis','fas fa-notes-medical',52,'Y');

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `id_user` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `id_level` int(11) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `id_poli` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`id_user`,`username`,`full_name`,`password`,`id_level`,`image`,`is_active`,`id_poli`) values 
(6,'user','Admin','$2y$05$3bEkbUWiTCavpM5FUUKbu.wdclj8vvsTgy58WSiS7Jje6i3XgZCC6',1,'user.jpg','Y',NULL),
(12,'kepala','adamfauzan','$2y$05$H0P2rUWg0h4rlmacmXTLR.8iLpnyGNLtSBlE9sYwr70N3I9.qL0XC',5,NULL,'Y',NULL),
(13,'petugas','adam fauzan','$2y$05$TEmDHR/9w/Shdic2xBmpKuFw5ON9PNG1rPyTs7SS.RErS8MP8Ai5u',4,NULL,'Y',NULL),
(14,'admin','adam nurfauzan','$2y$05$2jrO4tIytIASdhJ84XcgmOu/gapDVYv/M9L0TP0UjU3HfbLM8uyme',1,NULL,'Y',NULL),
(15,'reza','reza','$2y$05$6OaMCCuDN/ssK8DzYNhYPePuwyyGATmnWCz/NtaQYOTcQqOZ8ceBq',6,'reza.jpeg','Y',3),
(16,'alan','Alan Walker','$2y$05$fGLwxLZ18Bm8yUnk7Pa0NeWFD7OsJ1O1u9wA4E9L.jWMhZAuM1txu',6,NULL,'Y',17);

/*Table structure for table `tbl_userlevel` */

DROP TABLE IF EXISTS `tbl_userlevel`;

CREATE TABLE `tbl_userlevel` (
  `id_level` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_userlevel` */

insert  into `tbl_userlevel`(`id_level`,`nama_level`) values 
(1,'Admin'),
(4,'Petugas'),
(5,'Kepala'),
(6,'Dokter');

/*Table structure for table `tindakan_rm` */

DROP TABLE IF EXISTS `tindakan_rm`;

CREATE TABLE `tindakan_rm` (
  `id_tindakan_rm` int(11) NOT NULL AUTO_INCREMENT,
  `riwayat_rm` varchar(50) DEFAULT NULL,
  `nama_operasi` text DEFAULT NULL,
  `gol_operasi` text DEFAULT NULL,
  `jenis_anestesi` text DEFAULT NULL,
  `tanggal` text DEFAULT NULL,
  PRIMARY KEY (`id_tindakan_rm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tindakan_rm` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

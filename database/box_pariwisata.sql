/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.2.30-MariaDB : Database - tourist
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tourist` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `tourist`;

/*Table structure for table `admins` */

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `admins` */

insert  into `admins`(`id`,`username`,`password`,`name`,`email`) values 
(1,'admin','21232f297a57a5a743894a0e4a801fc3','Admin','admin@gmail.com'),
(2,'rahat','40ca651cefb9a6bffa117f429897c5f1','Rahat','rahat@gmail.com');

/*Table structure for table `tourist_hotel_books` */

DROP TABLE IF EXISTS `tourist_hotel_books`;

CREATE TABLE `tourist_hotel_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tourist_id` int(11) NOT NULL,
  `tourist_hotel_id` int(11) NOT NULL,
  `tourist_hotel_room_id` int(11) NOT NULL,
  `room_no` varchar(255) NOT NULL,
  `bed` varchar(255) NOT NULL,
  `booking_days` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tourist_hotel_books` */

insert  into `tourist_hotel_books`(`id`,`tourist_id`,`tourist_hotel_id`,`tourist_hotel_room_id`,`room_no`,`bed`,`booking_days`,`rate`,`total_price`,`date`) values 
(6,2,6,1,'123','2',1,1500,1500,'2020-01-28 08:23:00');

/*Table structure for table `tourist_hotel_rooms` */

DROP TABLE IF EXISTS `tourist_hotel_rooms`;

CREATE TABLE `tourist_hotel_rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_id` int(11) NOT NULL,
  `room_no` varchar(255) NOT NULL,
  `bed` varchar(255) NOT NULL,
  `availability` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tourist_hotel_rooms` */

insert  into `tourist_hotel_rooms`(`id`,`hotel_id`,`room_no`,`bed`,`availability`,`rate`) values 
(1,6,'123','2',0,1500),
(2,6,'125','3',1,5000);

/*Table structure for table `tourist_hotels` */

DROP TABLE IF EXISTS `tourist_hotels`;

CREATE TABLE `tourist_hotels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `location` text NOT NULL,
  `division` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `area` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tourist_hotels` */

insert  into `tourist_hotels`(`id`,`name`,`type`,`location`,`division`,`district`,`area`,`description`,`image`) values 
(6,'Hotel Indonesia','3','Center Jakarta','Center Jakarta','Center Jakarta','Center Jakarta','Hotel On Center Jakarta','1523911433.jpg');

/*Table structure for table `tourist_restaurant_books` */

DROP TABLE IF EXISTS `tourist_restaurant_books`;

CREATE TABLE `tourist_restaurant_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tourist_id` int(11) NOT NULL,
  `tourist_restaurant_id` int(11) NOT NULL,
  `tourist_restaurant_table_id` int(11) NOT NULL,
  `booking_no` varchar(255) NOT NULL,
  `booking_count` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `tourist_restaurant_books` */

insert  into `tourist_restaurant_books`(`id`,`tourist_id`,`tourist_restaurant_id`,`tourist_restaurant_table_id`,`booking_no`,`booking_count`,`rate`,`total_price`,`date`) values 
(8,2,7,0,'45963',7,10000,70000,'2020-01-30 06:47:00'),
(9,3,8,0,'VIP',7,200000,1400000,'2020-01-30 08:04:00'),
(10,2,9,0,'Regular',1,22000,22000,'2020-01-30 08:15:00');

/*Table structure for table `tourist_restaurant_tables` */

DROP TABLE IF EXISTS `tourist_restaurant_tables`;

CREATE TABLE `tourist_restaurant_tables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `restaurant_id` int(11) NOT NULL,
  `table_no` varchar(255) NOT NULL,
  `rate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `tourist_restaurant_tables` */

insert  into `tourist_restaurant_tables`(`id`,`restaurant_id`,`table_no`,`rate`) values 
(3,7,'Coming Soon',10000),
(4,8,'VIP',200000),
(5,8,'Regular',50000),
(6,9,'Regular',22000),
(7,10,'Regular',50000),
(8,10,'VIP',100000);

/*Table structure for table `tourist_restaurants` */

DROP TABLE IF EXISTS `tourist_restaurants`;

CREATE TABLE `tourist_restaurants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `location` text NOT NULL,
  `division` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `area` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `tourist_restaurants` */

insert  into `tourist_restaurants`(`id`,`name`,`type`,`location`,`division`,`district`,`area`,`description`,`image`) values 
(8,'Restaurant 3','Western Cafe','Surabaya','','','','','1580349965.jpg'),
(9,'Rocky Rooster','Western','Jakarta','','','','','1580351900.jpeg'),
(10,'Bandar Djakarta','Sea Food','Jakarta','','','','Bandar Djakarta merupakan restoran seafood yang memiliki konsep Pasar Ikan. Di Pasar Ikan inilah Bandar Djakarta menyediakan beragam varian seafood yang dijamin kualitasnya, karena seluruh seafood yang disediakan merupakan Live & Fresh Seafood. Bandar Djakarta saat ini memiliki 4 cabang yang tersebar di beberapa wilayah diantaranya ;\r\n\r\nJakarta Utara    : Bandar Djakarta Ancol & Seafood City Bandar Djakarta (managed by Bandar Djakarta)\r\n\r\nTangerang         : Bandar Djakarta Alam Sutera\r\n\r\nBekasi                  : Bandar Djakarta Bekasi\r\n\r\nDengan visi untuk menjadi wisata kuliner “Eatainment”, Bandar Djakarta memberikan hiburan live music yang tampil setiap weekdays mulai pukul 19.00 WIB sedangkan weekend dan Hari Libur Nasional akan dimulai sejak siang hari. Selain mendengarkan, pengunjung juga dapat request lagu kesukaan atau ikut bernyanyi di atas panggung.\r\n\r\nBandar Djakarta dilengkapi dengan area makan indoor dan outdoor yang cukup luas sehingga dapat menerima tamu dalam kapasitas yang besar. Restoran ini juga menawarkan harga ekonomis dan terjangkau. Setiap hari Senin sampai Kamis terdapat Daily Discount 50% untuk item-item tertentu, dan tersedia di seluruh outlet Bandar Djakarta.\r\n\r\nTekad, semangat dan fokus pada kenyamanan pelanggan, Bandar Djakarta akan terus melakukan pengembangan dan menjaga kualitas agar tetap memberikan pelayanan yang maksimal dan terbaik kepada seluruh pengunjung.','1580795691.png'),
(11,'Angke','Chineese Food','Jakarta','','','','','1580796225.png'),
(12,'Warmindo Abang Adek','Indonesian Food','Jakarta','','','','','1580804510.jpg'),
(13,'Mangkokku','Western','Jakarta','','','','','1580805236.jpg'),
(14,'Cut The Crab','Sea Food','Jakarta','','','','','1580805763.jpg'),
(15,'Sate Maranggi','Sate','Puwarkarta','','','','','1580806268.jpg'),
(16,'Permata Mubarok','Pecel lele','Jakarta','','','','','1580806834.jpg'),
(17,'Din Tai Fung','Chineese Food','Jakarta','','','','','1580808354.jpg');

/*Table structure for table `tourist_spot_books` */

DROP TABLE IF EXISTS `tourist_spot_books`;

CREATE TABLE `tourist_spot_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tourist_id` int(11) NOT NULL,
  `tourist_spot_id` int(11) NOT NULL,
  `tourist_spot_ticket_id` int(11) NOT NULL,
  `booking_count` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `tourist_spot_books` */

insert  into `tourist_spot_books`(`id`,`tourist_id`,`tourist_spot_id`,`tourist_spot_ticket_id`,`booking_count`,`rate`,`total_price`,`date`) values 
(8,2,6,3,1,10000,10000,'2020-01-30 05:44:00'),
(9,2,5,6,1,200000,200000,'2020-01-30 08:31:00'),
(10,2,5,6,1,200000,200000,'2020-01-30 10:00:00'),
(11,5,11,10,1,5000,5000,'2020-02-04 11:19:00'),
(12,5,8,11,3,27500,82500,'2020-02-04 11:19:00'),
(13,5,13,18,1,15000,15000,'2020-02-04 11:14:00'),
(14,5,20,25,3,40000,120000,'2020-02-06 10:46:00');

/*Table structure for table `tourist_spot_tickets` */

DROP TABLE IF EXISTS `tourist_spot_tickets`;

CREATE TABLE `tourist_spot_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `spot_id` int(11) NOT NULL,
  `is_weekend` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

/*Data for the table `tourist_spot_tickets` */

insert  into `tourist_spot_tickets`(`id`,`spot_id`,`is_weekend`,`rate`) values 
(3,6,0,10000),
(5,6,1,20000),
(6,5,0,200000),
(7,5,1,295000),
(8,9,0,165000),
(9,9,1,220000),
(10,11,0,5000),
(11,8,0,27500),
(12,10,0,5000),
(13,7,0,15000),
(14,10,1,5000),
(15,8,1,27500),
(16,11,1,5000),
(17,7,1,15000),
(18,13,0,15000),
(19,13,1,15000),
(20,12,0,22500),
(21,12,1,22500),
(22,17,0,100000),
(23,15,0,5000),
(24,15,1,5000),
(25,20,0,40000),
(26,20,0,250000),
(27,20,1,40000),
(28,20,1,250000),
(29,19,0,50000),
(30,19,0,250000),
(31,19,1,50000),
(32,19,1,250000),
(33,18,0,0),
(34,18,1,0),
(35,21,0,195000),
(36,21,1,230000);

/*Table structure for table `tourist_spots` */

DROP TABLE IF EXISTS `tourist_spots`;

CREATE TABLE `tourist_spots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `location` text NOT NULL,
  `division` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `area` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `open_time` varchar(10) NOT NULL,
  `close_time` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `tourist_spots` */

insert  into `tourist_spots`(`id`,`name`,`type`,`location`,`division`,`district`,`area`,`description`,`image`,`open_time`,`close_time`) values 
(5,'Ancol Beach','Beach','Jakarta ','Jakarta Utara','Jakarta Utara','Jakarta Utara','Open Time : 00:00 - 23:59 WIB','1512771113.jpg','00:00','23:59'),
(6,'Kenjeran Beach','Beach','Surabaya','Surabaya','Surabaya','Surabaya','Open Time : 07:00 - 18:00','1580201827.jpg','07:00','18:00'),
(7,'Taman Mini Indonesia Indah','Park','Jakarta ','Jakarta Timur','Jakarta Timur','Jakarta Timur','Open Time : 07:00 - 22:00','1580190785.jpeg','08:00','22:00'),
(8,'MONAS','Museum','Jakarta ','Jakarta Pusat','Jakarta Pusat','Jakarta Pusat','Open Time : 08:00 - 20:00','1580202297.jpg','08:00','20:00'),
(9,'Jungle Land','Park','Bogor','Bogor','Bogor','Bogor','Open Time\r\n\r\nWeekday (Monday-Thursday) 10.00-17.00 WIB; (Friday) 10.00-18.00 WIB\r\nWeekend : 09.00-18.00 WIB\r\nHigh Season : 09.00-19.00 WIB','1580202329.jpeg','09:00','18:00'),
(10,'Kota Tua','Museum','Jakarta ','Jakarta Pusat','Jakarta Pusat','Jakarta Pusat','Open Time : 07:00 - 22:00','1580202526.jpeg','07:00','22:00'),
(11,'Museum Bank Indonesia','Museum','Jakarta','','','','Open Time : 08:00 - 15:30','1580352290.jpeg','08:00','15:30'),
(12,'Farm House Lembang','Park','Bandung','','','','Open Time : 09:00 - 22:00','1580369402.jpg','09:00','22:00'),
(13,'Kebun Binatang Surabaya','Zoo','Surabaya','','','','','1580370032.jpg','08:00','16:00'),
(14,'Jembatan Cinta','Park','Kepulauan Seribu','','','','Jembatan Cinta adalah sebuah jembatan yang menghubungkan Pulau Tidung Besar dan Pulau Tidung Kecil di Kepulauan Seribu. Jembatan yang dikenal dengan nama Jembatan Cinta ini menjadi salah satu tempat yang biasa dikunjungi bagi para wisatawan. Panjang jembatan ini kira-kira 800 meter. Dari jembatan yang terbuat dari kayu ini, wisatawan dapat melihat pemandangan di dalam air laut seperti terumbu karang dan ikan-ikan yang lincah berenang pada sisi-sisi jembatan. Saat pagi atau sore hari, jembatan ini menjadi tempat yang romantis untuk melihat matahari terbit atau terbenam. Anda juga dapat menguji keberanian dengan melompat ke dalam laut dari Jembatan Cinta yang tingginya sekitar delapan meter. Aktivitas yang biasa dilakukan para pengunjung Pulau Tidung[.\r\n\r\nPada Saat menelusuri Jembatan Cinta ini,kita akan menjumpai bagian jembatan yang cukup tinggi,kurang lebih delapan meter dari permukaan laut dengan dasar laut sekitar empat sampai lima meter dengan kondisi air yang jernih serta arus laut yang relatif tenang. Berbicara soal Mitos, konon bagi setiap wisatawan yang loncat dari jembatan cinta ini dipercaya akan menemukan cinta sejatinya dengan cepat','1580797028.jpg','00:00','23:59'),
(15,'Gedung Sate','Museum','Bandung','','','','Gedung Sate dengan ciri khasnya berupa ornamen tusuk sate pada menara sentralnya, telah lama menjadi penanda atau markah tanah Kota Bandung yang tidak saja dikenal masyarakat di Jawa Barat, tetapi juga seluruh Indonesia bahkan model bangunan itu dijadikan pertanda bagi beberapa bangunan dan tanda-tanda kota di Jawa Barat. Misalnya bentuk gedung bagian depan Stasiun Kereta Api Tasikmalaya. Mulai dibangun tahun 1920, gedung berwarna putih ini masih berdiri kokoh namun anggun dan kini berfungsi sebagai gedung pusat pemerintahan Jawa Barat.','1580797514.jpg','08:00','16:00'),
(17,'Waterbom','Park','Jakarta','','','','','1580797583.jpg','09:00','19:00'),
(18,'Kuta Beach','Beach','Bali','','','','','1580960261.jpg','00:00','23:59'),
(19,'Candi Borobudur','Temple','Yogyakarta','','','','','1580961452.png','06:00','17:00'),
(20,'Candi Prambanan','Tample','Yogyakarta','','','','Candi lainnya yang terkenal adalah Candi Prambanan. Terletak sekitar 17Km dari pusat kota Yogyakarta, Candi Prambanan merupakan candi Hindu terbesar di Indonesia. Candi ini memiliki relief yang menceritakan kisah mengenai Ramayana dan Krishnayana.\r\n\r\n','1580961572.jpg','06:00','17:00'),
(21,'Taman Safari','Zoo','Bogor','','','','Aktivitas yang paling digemari pengunjung di Taman Safari Indonesia yaitu Safari Journey. Pengunjung dapat berkeliling taman untuk bertemu hewan – hewan langka di habitatnya selama 45 menit. Pengunjung juga akan disuguhi perjalanan berkesan menuju alam liar bertemu dengan hewan – hewan buas.\r\n\r\nKeistimewaan dari Taman Safari Indonesia, satwa – satwa ini tidak di kurung dalam kandang tetapi dibiarkan bebas. Pengunjung akan menjumpai satwa ini berkeliaran di pinggir dan tengah jalan.','1580962468.jpg','08:30','17:00');

/*Table structure for table `tourists` */

DROP TABLE IF EXISTS `tourists`;

CREATE TABLE `tourists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `birth_place` varchar(50) NOT NULL,
  `passport_no` varchar(50) NOT NULL,
  `visa_no` varchar(50) NOT NULL,
  `passport_expire` date NOT NULL,
  `visa_expire` date NOT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tourists` */

insert  into `tourists`(`id`,`username`,`password`,`fname`,`lname`,`nationality`,`birthday`,`birth_place`,`passport_no`,`visa_no`,`passport_expire`,`visa_expire`,`purpose`,`image`) values 
(2,'adi','c46335eb267e2e1cde5b017acb4cd799','Adi','Nugroho','Indonesia','1996-08-16','Bekasi','12345','8765432','2020-01-01','2018-01-15','Tour','1579849667.png'),
(3,'chochokun','3c1a7f18ff7a1567748b4cd19a201c9a','Rico Nurman','Yanuar','Indonesia','1996-01-10','Indonesia',' ',' ','0000-00-00','0000-00-00',' ','1580344576.jpg'),
(4,'rossychan','3c1a7f18ff7a1567748b4cd19a201c9a','Rossiana Ayu Indah','Sari','Indonesia','1994-12-27','Indonesia','','','0000-00-00','0000-00-00','','1580345171.jpg'),
(5,'hans','f2a0ffe83ec8d44f2be4b624b0f47dde','hans','christians','Indonesia','1998-01-15','Jakarta',' ',' ','0000-00-00','0000-00-00',' ',''),
(6,'ryan','10c7ccc7a4f0aff03c915c485565b9da','ryan','octa','Indonesia','1998-01-01','Indonesia','','','0000-00-00','0000-00-00','','');

/*Table structure for table `view_daytrips` */

DROP TABLE IF EXISTS `view_daytrips`;

/*!50001 DROP VIEW IF EXISTS `view_daytrips` */;
/*!50001 DROP TABLE IF EXISTS `view_daytrips` */;

/*!50001 CREATE TABLE  `view_daytrips`(
 `Location` text ,
 `TotalSpot` bigint(21) ,
 `destination` mediumtext ,
 `TimeNow` varchar(10) ,
 `image` varchar(100) 
)*/;

/*View structure for view view_daytrips */

/*!50001 DROP TABLE IF EXISTS `view_daytrips` */;
/*!50001 DROP VIEW IF EXISTS `view_daytrips` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_daytrips` AS select `tourist_spots`.`location` AS `Location`,count(0) AS `TotalSpot`,replace(group_concat('<span class="day trip-info"><b>',`tourist_spots`.`name`,': </b>',`tourist_spots`.`open_time`,' - ',`tourist_spots`.`close_time` separator ','),',','</span> <br>') AS `destination`,date_format(current_timestamp(),'%H:%i') AS `TimeNow`,`tourist_spots`.`image` AS `image` from `tourist_spots` where current_timestamp() between str_to_date(`tourist_spots`.`open_time`,'%H:%i') and str_to_date(`tourist_spots`.`close_time`,'%H:%i') group by `tourist_spots`.`location` */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

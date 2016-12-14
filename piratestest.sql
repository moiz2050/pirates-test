/*
SQLyog Ultimate - MySQL GUI v8.2 
MySQL - 5.7.10 : Database - pirates_test
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `posts` */

CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-pending, 1-published, 2-spam',
  `created_by` int(10) unsigned NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `posts_created_by_foreign` (`created_by`),
  CONSTRAINT `posts_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `posts` */

insert  into `posts`(`id`,`title`,`description`,`status`,`created_by`,`created_at`,`updated_at`) values (1,'test job post','posting job',1,22,'2016-12-14 21:03:26','2016-12-14 21:27:46'),(2,'svsvdhbsdhvsd vskjdvkjsdnvksdv fknfdkjnvfd',' fdvjnkjdfnvfd vkdfmvdf vdlfvmdfmvldkfmv',0,23,'2016-12-14 21:17:44','2016-12-14 21:17:44'),(3,' bxbjhb','khfbvjhbfdjhvbdfjbvjdf',0,24,'2016-12-14 21:29:11','2016-12-14 21:29:11'),(4,'vfvjndkjfnv fdvkdjnfkjvnfd','dfvdfkvpodfv dfkvpodfkopvkdpof',0,25,'2016-12-14 21:39:56','2016-12-14 21:39:56');

/*Table structure for table `users` */

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_moderator` tinyint(4) DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`email`,`is_moderator`,`created_at`,`updated_at`) values (12,'moizsattar@yahoo.com',1,'2016-12-14 06:34:54','2016-12-14 20:07:24'),(22,'new@user.com',0,'2016-12-14 21:03:26','2016-12-14 21:03:26'),(23,'mueez@askfortask.com',0,'2016-12-14 21:17:44','2016-12-14 21:17:44'),(24,'cndskjcnsd@vnkfdn.com',0,'2016-12-14 21:29:10','2016-12-14 21:29:10'),(25,'new@user1.com',0,'2016-12-14 21:39:55','2016-12-14 21:39:55');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

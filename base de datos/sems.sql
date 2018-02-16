-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.17-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2018-02-16 20:34:55
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table sems.areas
DROP TABLE IF EXISTS `areas`;
CREATE TABLE IF NOT EXISTS `areas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `latlng` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.areas: ~6 rows (approximately)
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` (`id`, `name`, `details`, `latlng`, `active`, `created_at`, `updated_at`) VALUES
	(1, 'Area 1', 'Recital', '[[-43.31097106390314,-65.04204511642456],[-43.311127198613335,-65.04094541072845],[-43.311700990227706,-65.0388640165329],[-43.30902715317825,-65.0364875793457],[-43.30757893831157,-65.03947019577025],[-43.30972977868728,-65.04132628440857]]', 1, '2018-02-02 09:50:37', '2018-02-02 09:50:37'),
	(2, 'Area 2', 'Penitenciaria', '[[-43.29705785122502,-65.10319948196411],[-43.30011871889613,-65.09901523590088],[-43.280532751781614,-65.07219314575195],[-43.27739278778321,-65.0760555267334]]', 1, '2018-02-02 09:51:12', '2018-02-02 09:51:12'),
	(3, 'Zona 1', 'Zona con puntos', '[[-43.300290497719374,-65.10978698730469],[-43.300883911738204,-65.11085987091064],[-43.30338243354694,-65.10770559310913],[-43.305443636739575,-65.11034488677979],[-43.30692703518267,-65.10785579681395],[-43.30421004625614,-65.10418653488159]]', 1, '2018-02-05 07:49:20', '2018-02-05 07:49:20'),
	(4, 'Centro', 'Zona centro', '[[-43.29872885420479,-65.10970115661621],[-43.29557421196373,-65.10519504547119],[-43.29891625354433,-65.10146141052246],[-43.3017584060512,-65.10566711425781]]', 1, '2018-02-06 13:19:26', '2018-02-06 13:19:26'),
	(5, 'Zona Playa', 'Zona habilitada para la temporada de verano', '[[-43.33529201478637,-65.06446838378905],[-43.31006547467422,-65.05640029907227],[-43.30656789993335,-65.06223678588867],[-43.299822008876504,-65.05605697631836],[-43.30244549990158,-65.04919052124023],[-43.30019680023959,-65.04507064819335],[-43.3073173971775,-65.03150939941406],[-43.34365692013494,-65.04695892333984]]', 0, '2018-02-06 13:20:43', '2018-02-09 15:08:22'),
	(6, 'Zona festival', 'zona de conciertos', '[[-43.33674347091915,-65.05573511123657],[-43.33694635987289,-65.0538682937622],[-43.331374470760295,-65.05191564559937],[-43.33114034658105,-65.05337476730347]]', 1, '2018-02-09 15:11:27', '2018-02-09 15:54:30');
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;


-- Dumping structure for table sems.areas_blocks
DROP TABLE IF EXISTS `areas_blocks`;
CREATE TABLE IF NOT EXISTS `areas_blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `block_id` int(10) unsigned NOT NULL,
  `area_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `areas_blocks_block_id_foreign` (`block_id`),
  KEY `areas_blocks_area_id_foreign` (`area_id`),
  CONSTRAINT `areas_blocks_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`),
  CONSTRAINT `areas_blocks_block_id_foreign` FOREIGN KEY (`block_id`) REFERENCES `blocks` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.areas_blocks: ~14 rows (approximately)
/*!40000 ALTER TABLE `areas_blocks` DISABLE KEYS */;
INSERT INTO `areas_blocks` (`id`, `block_id`, `area_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 4, '2018-02-06 13:19:26', '2018-02-06 13:19:26'),
	(2, 2, 4, '2018-02-06 13:19:26', '2018-02-06 13:19:26'),
	(3, 3, 4, '2018-02-06 13:19:26', '2018-02-06 13:19:26'),
	(4, 4, 5, '2018-02-06 13:20:43', '2018-02-06 13:20:43'),
	(5, 7, 5, '2018-02-09 14:42:48', '2018-02-09 14:42:48'),
	(6, 8, 5, '2018-02-09 14:43:38', '2018-02-09 14:43:38'),
	(7, 9, 5, '2018-02-09 14:44:36', '2018-02-09 14:44:36'),
	(8, 10, 5, '2018-02-09 14:45:32', '2018-02-09 14:45:32'),
	(9, 11, 5, '2018-02-09 14:46:24', '2018-02-09 14:46:24'),
	(10, 12, 5, '2018-02-09 14:47:16', '2018-02-09 14:47:16'),
	(13, 9, 6, '2018-02-09 15:54:30', '2018-02-09 15:54:30'),
	(14, 10, 6, '2018-02-09 15:54:30', '2018-02-09 15:54:30'),
	(15, 11, 6, '2018-02-09 15:54:31', '2018-02-09 15:54:31'),
	(16, 14, 4, '2018-02-14 15:26:45', '2018-02-14 15:26:50');
/*!40000 ALTER TABLE `areas_blocks` ENABLE KEYS */;


-- Dumping structure for table sems.bills
DROP TABLE IF EXISTS `bills`;
CREATE TABLE IF NOT EXISTS `bills` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `letter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_office` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `net` decimal(13,2) NOT NULL,
  `iva` decimal(13,2) NOT NULL,
  `total` decimal(13,2) NOT NULL,
  `date` date NOT NULL,
  `detail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.bills: ~16 rows (approximately)
/*!40000 ALTER TABLE `bills` DISABLE KEYS */;
INSERT INTO `bills` (`id`, `type`, `letter`, `branch_office`, `number`, `document_type`, `document_number`, `net`, `iva`, `total`, `date`, `detail`, `created_at`, `updated_at`) VALUES
	(1, 'F', 'B', '0001', '1', '99', '0', 793.39, 166.61, 960.00, '2018-02-02', 'Se reserva el estacionamiento para esta patente en el radio del área F1', '2018-02-02 17:45:14', '2018-02-02 17:45:14'),
	(2, 'F', 'B', '0001', '2', '99', '0', 793.39, 166.61, 960.00, '2018-02-02', 'Se reserva el estacionamiento para esta patente en el radio del área F1', '2018-02-02 17:49:35', '2018-02-02 17:49:35'),
	(3, 'F', 'B', '0001', '3', '99', '0', 413.22, 86.78, 500.00, '2018-02-05', 'Reserva container', '2018-02-05 09:54:14', '2018-02-05 09:54:14'),
	(4, 'F', 'B', '0001', '4', '99', '0', 2479.34, 520.66, 3000.00, '2018-02-05', 'por ser periodista.\r\nSolo un punto', '2018-02-05 13:46:51', '2018-02-05 13:46:51'),
	(5, 'F', 'B', '0001', '5', '99', '0', 1239.67, 260.33, 1500.00, '2018-02-07', 'Reserva container', '2018-02-07 18:06:07', '2018-02-07 18:06:07'),
	(6, 'F', 'B', '0001', '6', '99', '0', 743.80, 156.20, 900.00, '2018-02-09', 'Reserva load_unload', '2018-02-09 17:26:16', '2018-02-09 17:26:16'),
	(7, 'F', 'B', '0001', '7', '99', '0', 826.45, 173.55, 1000.00, '2018-02-09', 'Reserva container', '2018-02-09 17:36:09', '2018-02-09 17:36:09'),
	(8, 'F', 'B', '0001', '8', '99', '0', 19.83, 4.17, 24.00, '2018-02-15', 'Ticket por 2 Horas de estacionamiento desde las 2018-02-15 19:18:39 hasta las 2018-02-16 09:18:00 de la patente KKG679', '2018-02-15 19:18:41', '2018-02-15 19:18:41'),
	(9, 'F', 'B', '0001', '9', '99', '0', 123.97, 26.03, 150.00, '2018-02-15', 'Ticket por  Horas de estacionamiento desde las 2018-02-15 20:14:25 hasta las 2018-02-15 23:59:59 de la patente IQW938', '2018-02-15 20:14:25', '2018-02-15 20:14:25'),
	(10, 'F', 'B', '0001', '10', '99', '0', 19.83, 4.17, 24.00, '2018-02-15', 'Ticket por 2 Horas de estacionamiento desde las 2018-02-15 20:52:15 hasta las 2018-02-16 09:59:00 de la patente AB157BC', '2018-02-15 20:52:16', '2018-02-15 20:52:16'),
	(11, 'F', 'B', '0001', '11', '99', '0', 123.97, 26.03, 150.00, '2018-02-15', 'Ticket por Estadia el dia 2018-02-15 20:53:42 de la patente AB789AC', '2018-02-15 20:53:42', '2018-02-15 20:53:42'),
	(12, 'F', 'B', '0001', '12', '99', '0', 9.92, 2.08, 12.00, '2018-02-16', 'Ticket por 1 Horas de estacionamiento desde las 2018-02-16 11:17:39 hasta las 2018-02-16 12:17:00 de la patente CVS752', '2018-02-16 11:17:41', '2018-02-16 11:17:41'),
	(13, 'F', 'B', '0001', '13', '99', '0', 82.64, 17.36, 100.00, '2018-02-16', 'Ticket por Estadia el dia 2018-02-16 11:18:11 de la patente KKG679', '2018-02-16 11:18:11', '2018-02-16 11:18:11'),
	(14, 'F', 'B', '0001', '14', '99', '0', 19.83, 4.17, 24.00, '2018-02-16', 'Ticket por 2 Horas de estacionamiento desde las 2018-02-16 17:05:17 hasta las 2018-02-16 19:05:00 de la patente AA759AB', '2018-02-16 17:05:19', '2018-02-16 17:05:19'),
	(15, 'F', 'B', '0001', '15', '99', '0', 247.93, 52.07, 300.00, '2018-02-16', 'Compra de credito', '2018-02-16 17:17:59', '2018-02-16 17:17:59'),
	(16, 'F', 'B', '0001', '16', '99', '0', 1239.67, 260.33, 1500.00, '2018-02-16', 'Vive en la zona', '2018-02-16 20:30:36', '2018-02-16 20:30:36');
/*!40000 ALTER TABLE `bills` ENABLE KEYS */;


-- Dumping structure for table sems.blocks
DROP TABLE IF EXISTS `blocks`;
CREATE TABLE IF NOT EXISTS `blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `latlng` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numeration_max` int(11) NOT NULL,
  `numeration_min` int(11) NOT NULL,
  `spaces` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.blocks: ~14 rows (approximately)
/*!40000 ALTER TABLE `blocks` DISABLE KEYS */;
INSERT INTO `blocks` (`id`, `latlng`, `street`, `numeration_max`, `numeration_min`, `spaces`, `created_at`, `updated_at`) VALUES
	(1, '[[-43.32088091931779,-65.04904568195343],[-43.320813597080004,-65.0490054488182],[-43.32117655087021,-65.04815116524695],[-43.32123411592268,-65.04820480942726]]', 'Alejandro Maiz', 100, 0, 10, '2018-02-05 13:31:30', '2018-02-07 09:28:26'),
	(2, '[[-43.299458927540364,-65.10663002729416],[-43.29950968097577,-65.10673731565475],[-43.29880108110197,-65.10769486427306],[-43.29874837499627,-65.10761171579361]]', 'Alejandro Maiz', 100, 199, 10, '2018-02-05 13:32:50', '2018-02-05 13:32:50'),
	(3, '[[-43.299515537138674,-65.1065656542778],[-43.29944135903362,-65.10661661624908],[-43.298738614601326,-65.10565638542175],[-43.29880108110197,-65.10555177927017]]', 'Rivadavia', 600, 700, 10, '2018-02-05 13:33:35', '2018-02-05 13:33:35'),
	(4, '[[-43.31802795213104,-65.04509210586548],[-43.31797721415612,-65.04521012306212],[-43.31704831143514,-65.04433035850525],[-43.317102953164756,-65.0441962480545]]', 'Centenario', 0, 100, 10, '2018-02-05 13:37:04', '2018-02-05 13:37:04'),
	(5, '[[-43.311084261608016,-65.0408810377121],[-43.31104913130838,-65.04098832607269],[-43.3101162192551,-65.0404679775238],[-43.3101630603691,-65.04035532474518]]', 'Rivadavia Playa', 100, 0, 10, '2018-02-07 11:09:50', '2018-02-07 11:09:50'),
	(6, '[[-43.311084261608016,-65.0408810377121],[-43.31104913130838,-65.04098832607269],[-43.3101162192551,-65.0404679775238],[-43.3101630603691,-65.04035532474518]]', 'Rivadavia Playa', 100, 0, 10, '2018-02-07 11:15:34', '2018-02-07 11:15:34'),
	(7, '[[-43.32986484630427,-65.05188028441022],[-43.329872659537095,-65.05175154310876],[-43.33055130919782,-65.05199115034145],[-43.330613814325936,-65.05218426229366]]', 'Guillermo Rawzon', 0, 100, 10, '2018-02-09 14:42:48', '2018-02-09 14:42:48'),
	(8, '[[-43.32974952866587,-65.05181333009261],[-43.329774921717146,-65.05171677411649],[-43.328786289984244,-65.05137822405297],[-43.32872378297541,-65.05143991259325]]', 'Gullermo Rawson', 100, 200, 10, '2018-02-09 14:43:37', '2018-02-09 14:43:37'),
	(9, '[[-43.33187910171969,-65.05263786204446],[-43.332019735092885,-65.0524983923012],[-43.332344517875846,-65.05261998043275],[-43.3323015468317,-65.0527648143969]]', 'Guillermo Rawson', 200, 300, 10, '2018-02-09 14:44:36', '2018-02-09 14:44:36'),
	(10, '[[-43.332421556905096,-65.05283813485485],[-43.332441089163055,-65.05266111556533],[-43.33385883036648,-65.05322734976117],[-43.333862736726125,-65.05332926995817]]', 'Gulllermo Rawson', 300, 400, 10, '2018-02-09 14:45:32', '2018-02-09 14:45:32'),
	(11, '[[-43.333936733804585,-65.05339185855962],[-43.33394365413567,-65.05329502280894],[-43.3354757333899,-65.05375185877071],[-43.33544057707787,-65.05391278539753]]', 'gullermo Rawson', 400, 600, 20, '2018-02-09 14:46:24', '2018-02-09 14:46:24'),
	(12, '[[-43.33560701136572,-65.05379359029878],[-43.33556794888001,-65.0539652453674],[-43.33695362661915,-65.05454876474947],[-43.33698487589664,-65.0543234674719]]', 'Guillermo Rawson', 600, 700, 10, '2018-02-09 14:47:16', '2018-02-09 14:47:16'),
	(13, '[[-43.299591064226554,-65.10663230052593],[-43.29953048146474,-65.10654915510206],[-43.300255803591426,-65.10552576960663],[-43.300318339888825,-65.10562500769319]]', 'Alejandro MAiz 0-100', 100, 0, 10, NULL, NULL),
	(14, '[[-43.30036707711908,-65.10553647527931],[-43.30031431216469,-65.10546405829724],[-43.301039003270006,-65.1044832853992],[-43.30109372182886,-65.10455570238128]]', 'Bernardo Machina', 200, 100, 10, NULL, NULL);
/*!40000 ALTER TABLE `blocks` ENABLE KEYS */;


-- Dumping structure for table sems.company_sales
DROP TABLE IF EXISTS `company_sales`;
CREATE TABLE IF NOT EXISTS `company_sales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `operation_id` int(10) unsigned NOT NULL,
  `detail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `company_sales_user_id_foreign` (`user_id`),
  KEY `company_sales_operation_id_foreign` (`operation_id`),
  CONSTRAINT `company_sales_operation_id_foreign` FOREIGN KEY (`operation_id`) REFERENCES `operations` (`id`),
  CONSTRAINT `company_sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.company_sales: ~17 rows (approximately)
/*!40000 ALTER TABLE `company_sales` DISABLE KEYS */;
INSERT INTO `company_sales` (`id`, `user_id`, `operation_id`, `detail`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'Se reserva el estacionamiento para esta patente en el radio del área F1', '2018-02-02 17:45:14', '2018-02-02 17:45:14'),
	(2, 1, 2, 'Se reserva el estacionamiento para esta patente en el radio del área F1', '2018-02-02 17:49:35', '2018-02-02 17:49:35'),
	(3, 1, 3, 'Dueño del sistema', '2018-02-05 07:57:43', '2018-02-05 07:57:43'),
	(4, 1, 4, 'Reserva container', '2018-02-05 09:54:14', '2018-02-05 09:54:14'),
	(5, 1, 5, 'por ser periodista.\r\nSolo un punto', '2018-02-05 13:46:51', '2018-02-05 13:46:51'),
	(6, 1, 6, 'Reserva container', '2018-02-07 18:06:07', '2018-02-07 18:06:07'),
	(7, 1, 7, 'Reserva load_unload', '2018-02-09 17:26:16', '2018-02-09 17:26:16'),
	(8, 1, 8, 'Reserva container', '2018-02-09 17:36:09', '2018-02-09 17:36:09'),
	(9, 5, 9, 'Ticket 2018-02-15 19:18:39 - 2018-02-16 09:18:00', '2018-02-15 19:18:41', '2018-02-15 19:18:41'),
	(10, 5, 10, 'Ticket 2018-02-15 20:14:25 - 2018-02-15 23:59:59', '2018-02-15 20:14:25', '2018-02-15 20:14:25'),
	(11, 5, 11, 'Ticket por 2 Horas de estacionamiento desde las 2018-02-15 20:52:15 hasta las 2018-02-16 09:59:00 de la patente AB157BC', '2018-02-15 20:52:16', '2018-02-15 20:52:16'),
	(12, 5, 12, 'Ticket por Estadia el dia 2018-02-15 20:53:42 de la patente AB789AC', '2018-02-15 20:53:42', '2018-02-15 20:53:42'),
	(13, 5, 13, 'Ticket por 1 Horas de estacionamiento desde las 2018-02-16 11:17:39 hasta las 2018-02-16 12:17:00 de la patente CVS752', '2018-02-16 11:17:41', '2018-02-16 11:17:41'),
	(14, 5, 14, 'Ticket por Estadia el dia 2018-02-16 11:18:11 de la patente KKG679', '2018-02-16 11:18:11', '2018-02-16 11:18:11'),
	(15, 5, 15, 'Ticket por 2 Horas de estacionamiento desde las 2018-02-16 17:05:17 hasta las 2018-02-16 19:05:00 de la patente AA759AB', '2018-02-16 17:05:19', '2018-02-16 17:05:19'),
	(16, 5, 16, 'Venta de credito', '2018-02-16 17:17:59', '2018-02-16 17:17:59'),
	(17, 5, 18, 'Vive en la zona', '2018-02-16 20:30:36', '2018-02-16 20:30:36');
/*!40000 ALTER TABLE `company_sales` ENABLE KEYS */;


-- Dumping structure for table sems.costs
DROP TABLE IF EXISTS `costs`;
CREATE TABLE IF NOT EXISTS `costs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `area_id` int(10) unsigned NOT NULL,
  `time_zone_start` time NOT NULL,
  `time_zone_end` time NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL DEFAULT '2999-12-31',
  `priority` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` decimal(13,2) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_start` smallint(5) unsigned NOT NULL,
  `day_end` smallint(5) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `costs_area_id_foreign` (`area_id`),
  CONSTRAINT `costs_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.costs: ~5 rows (approximately)
/*!40000 ALTER TABLE `costs` DISABLE KEYS */;
INSERT INTO `costs` (`id`, `area_id`, `time_zone_start`, `time_zone_end`, `start_date`, `end_date`, `priority`, `cost`, `type`, `day_start`, `day_end`, `created_at`, `updated_at`) VALUES
	(1, 4, '08:00:00', '13:00:00', '2018-01-01', '2099-12-31', '1', 12.00, 'time', 1, 5, '2018-02-15 09:07:46', '2018-02-15 09:07:46'),
	(2, 4, '11:00:00', '12:00:00', '2018-02-15', '2018-02-15', '5', 40.00, 'time', 1, 5, '2018-02-15 09:08:36', '2018-02-15 09:08:36'),
	(3, 4, '15:00:00', '20:00:00', '2018-01-01', '2099-12-31', '1', 12.00, 'time', 1, 5, '2018-02-15 09:13:08', '2018-02-15 09:13:08'),
	(4, 4, '08:00:00', '20:00:00', '2018-01-01', '2099-12-31', '1', 100.00, 'day', 1, 6, '2018-02-15 12:26:43', '2018-02-15 12:26:43'),
	(5, 4, '08:00:00', '20:00:00', '2018-02-15', '2018-02-15', '5', 150.00, 'day', 0, 6, '2018-02-15 19:37:17', '2018-02-15 19:37:17');
/*!40000 ALTER TABLE `costs` ENABLE KEYS */;


-- Dumping structure for table sems.exeptuated_causes
DROP TABLE IF EXISTS `exeptuated_causes`;
CREATE TABLE IF NOT EXISTS `exeptuated_causes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.exeptuated_causes: ~4 rows (approximately)
/*!40000 ALTER TABLE `exeptuated_causes` DISABLE KEYS */;
INSERT INTO `exeptuated_causes` (`id`, `name`, `detail`, `created_at`, `updated_at`) VALUES
	(1, 'Lisiado', 'Con certificad del ......', '2018-02-02 09:10:14', '2018-02-02 09:10:14'),
	(2, 'frentistas', 'Vive en la zona', '2018-02-02 09:10:14', '2018-02-02 09:10:14'),
	(3, 'periodistas', 'Por la profecion en que trabaja', '2018-02-02 09:10:14', '2018-02-02 09:10:14'),
	(4, 'otros', 'Causas no contempladas', '2018-02-02 09:10:14', '2018-02-02 09:10:14');
/*!40000 ALTER TABLE `exeptuated_causes` ENABLE KEYS */;


-- Dumping structure for table sems.exeptuated_vehicles
DROP TABLE IF EXISTS `exeptuated_vehicles`;
CREATE TABLE IF NOT EXISTS `exeptuated_vehicles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(10) unsigned NOT NULL,
  `detail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latlng` text COLLATE utf8mb4_unicode_ci,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `operation_id` int(10) unsigned DEFAULT NULL,
  `exeptuated_cause_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exeptuated_vehicles_vehicle_id_foreign` (`vehicle_id`),
  KEY `exeptuated_vehicles_operation_id_foreign` (`operation_id`),
  KEY `exeptuated_vehicles_exeptuated_cause_id_foreign` (`exeptuated_cause_id`),
  CONSTRAINT `exeptuated_vehicles_exeptuated_cause_id_foreign` FOREIGN KEY (`exeptuated_cause_id`) REFERENCES `exeptuated_causes` (`id`),
  CONSTRAINT `exeptuated_vehicles_operation_id_foreign` FOREIGN KEY (`operation_id`) REFERENCES `operations` (`id`),
  CONSTRAINT `exeptuated_vehicles_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.exeptuated_vehicles: ~4 rows (approximately)
/*!40000 ALTER TABLE `exeptuated_vehicles` DISABLE KEYS */;
INSERT INTO `exeptuated_vehicles` (`id`, `vehicle_id`, `detail`, `latlng`, `start_time`, `end_time`, `operation_id`, `exeptuated_cause_id`, `created_at`, `updated_at`) VALUES
	(4, 8, 'Se reserva el estacionamiento para esta patente en el radio del área F1', '[-43.31531145942684, -65.04395484924316]', '2018-01-01 00:00:00', '2018-12-31 00:00:00', 2, 1, '2018-02-02 17:49:35', '2018-02-09 13:12:56'),
	(5, 2, 'Dueño del sistema', '[[-43.33529201478637,-65.06446838378905],[-43.31006547467422,-65.05640029907227],[-43.30656789993335,-65.06223678588867],[-43.299822008876504,-65.05605697631836],[-43.30244549990158,-65.04919052124023],[-43.30019680023959,-65.04507064819335],[-43.3073173971775,-65.03150939941406],[-43.34365692013494,-65.04695892333984]]', '2018-01-01 00:00:00', '2018-12-31 00:00:00', 3, 4, '2018-02-05 07:57:42', '2018-02-05 07:57:43'),
	(6, 4, 'por ser periodista.\r\nSolo un punto', '[-43.31531145942684, -65.04395484924316]', '2018-01-01 00:00:00', '2022-12-31 00:00:00', 5, 3, '2018-02-05 13:46:51', '2018-02-05 13:46:51'),
	(7, 11, 'Vive en la zona', '[[-43.31070563397527,-65.05178689956665],[-43.31126771950957,-65.04955530166626],[-43.313234977942884,-65.05075693130493],[-43.31264168448694,-65.05275249481201]]', '2018-01-01 00:00:00', '2020-12-31 00:00:00', 18, 2, '2018-02-16 20:30:35', '2018-02-16 20:30:35');
/*!40000 ALTER TABLE `exeptuated_vehicles` ENABLE KEYS */;


-- Dumping structure for table sems.exeptuated_vehicle_blocks
DROP TABLE IF EXISTS `exeptuated_vehicle_blocks`;
CREATE TABLE IF NOT EXISTS `exeptuated_vehicle_blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `exeptuated_vehicle_id` int(10) unsigned NOT NULL,
  `latlng` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exeptuated_vehicle_blocks_exeptuated_vehicle_id_foreign` (`exeptuated_vehicle_id`),
  CONSTRAINT `exeptuated_vehicle_blocks_exeptuated_vehicle_id_foreign` FOREIGN KEY (`exeptuated_vehicle_id`) REFERENCES `exeptuated_vehicles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.exeptuated_vehicle_blocks: ~1 rows (approximately)
/*!40000 ALTER TABLE `exeptuated_vehicle_blocks` DISABLE KEYS */;
INSERT INTO `exeptuated_vehicle_blocks` (`id`, `exeptuated_vehicle_id`, `latlng`, `created_at`, `updated_at`) VALUES
	(1, 7, '[[-43.31070563397527,-65.05178689956665],[-43.31126771950957,-65.04955530166626],[-43.313234977942884,-65.05075693130493],[-43.31264168448694,-65.05275249481201]]', '2018-02-16 20:30:36', '2018-02-16 20:30:36');
/*!40000 ALTER TABLE `exeptuated_vehicle_blocks` ENABLE KEYS */;


-- Dumping structure for table sems.images
DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `visible_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visible_id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.images: ~0 rows (approximately)
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
/*!40000 ALTER TABLE `images` ENABLE KEYS */;


-- Dumping structure for table sems.infringements
DROP TABLE IF EXISTS `infringements`;
CREATE TABLE IF NOT EXISTS `infringements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `situation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `infringement_cause_id` int(10) unsigned NOT NULL,
  `cost` decimal(13,2) NOT NULL,
  `voluntary_cost` decimal(13,2) NOT NULL,
  `voluntary_end_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `close_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `close_cost` decimal(13,2) DEFAULT NULL,
  `operation_id` int(10) unsigned DEFAULT NULL,
  `latlng` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `block_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `infringements_user_id_foreign` (`user_id`),
  KEY `infringements_operation_id_foreign` (`operation_id`),
  KEY `infringements_block_id_foreign` (`block_id`),
  KEY `infringements_infringement_cause_id_foreign` (`infringement_cause_id`),
  CONSTRAINT `infringements_block_id_foreign` FOREIGN KEY (`block_id`) REFERENCES `blocks` (`id`),
  CONSTRAINT `infringements_infringement_cause_id_foreign` FOREIGN KEY (`infringement_cause_id`) REFERENCES `infringement_causes` (`id`),
  CONSTRAINT `infringements_operation_id_foreign` FOREIGN KEY (`operation_id`) REFERENCES `operations` (`id`),
  CONSTRAINT `infringements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.infringements: ~0 rows (approximately)
/*!40000 ALTER TABLE `infringements` DISABLE KEYS */;
/*!40000 ALTER TABLE `infringements` ENABLE KEYS */;


-- Dumping structure for table sems.infringement_causes
DROP TABLE IF EXISTS `infringement_causes`;
CREATE TABLE IF NOT EXISTS `infringement_causes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` decimal(13,2) NOT NULL,
  `voluntary_cost` decimal(13,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.infringement_causes: ~0 rows (approximately)
/*!40000 ALTER TABLE `infringement_causes` DISABLE KEYS */;
/*!40000 ALTER TABLE `infringement_causes` ENABLE KEYS */;


-- Dumping structure for table sems.infringement_details
DROP TABLE IF EXISTS `infringement_details`;
CREATE TABLE IF NOT EXISTS `infringement_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `infringement_id` int(10) unsigned NOT NULL,
  `detail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `infringement_details_user_id_foreign` (`user_id`),
  KEY `infringement_details_infringement_id_foreign` (`infringement_id`),
  CONSTRAINT `infringement_details_infringement_id_foreign` FOREIGN KEY (`infringement_id`) REFERENCES `infringements` (`id`),
  CONSTRAINT `infringement_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.infringement_details: ~0 rows (approximately)
/*!40000 ALTER TABLE `infringement_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `infringement_details` ENABLE KEYS */;


-- Dumping structure for table sems.locals
DROP TABLE IF EXISTS `locals`;
CREATE TABLE IF NOT EXISTS `locals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `latlng` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee` decimal(13,2) NOT NULL DEFAULT '0.00',
  `verified` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `block_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `locals_user_id_foreign` (`user_id`),
  KEY `locals_block_id_foreign` (`block_id`),
  CONSTRAINT `locals_block_id_foreign` FOREIGN KEY (`block_id`) REFERENCES `blocks` (`id`),
  CONSTRAINT `locals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.locals: ~2 rows (approximately)
/*!40000 ALTER TABLE `locals` DISABLE KEYS */;
INSERT INTO `locals` (`id`, `user_id`, `latlng`, `fee`, `verified`, `address`, `block_id`, `created_at`, `updated_at`) VALUES
	(1, 5, '[[-43.29995084366814,-65.10605335235596]]', 4.00, '1', 'Alejandro Maiz', 14, '2018-02-02 09:46:07', '2018-02-02 09:46:07'),
	(2, 9, '[[-43.29913878950985,-65.10605871677399]]', 4.00, '1', 'Ridavavia 641', 3, '2018-02-15 08:54:31', '2018-02-15 08:54:31');
/*!40000 ALTER TABLE `locals` ENABLE KEYS */;


-- Dumping structure for table sems.logins
DROP TABLE IF EXISTS `logins`;
CREATE TABLE IF NOT EXISTS `logins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `platform` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `os` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latlng` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `logins_user_id_foreign` (`user_id`),
  CONSTRAINT `logins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.logins: ~0 rows (approximately)
/*!40000 ALTER TABLE `logins` DISABLE KEYS */;
/*!40000 ALTER TABLE `logins` ENABLE KEYS */;


-- Dumping structure for table sems.messages
DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_user_id_foreign` (`user_id`),
  CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.messages: ~0 rows (approximately)
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;


-- Dumping structure for table sems.message_details
DROP TABLE IF EXISTS `message_details`;
CREATE TABLE IF NOT EXISTS `message_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message_id` int(10) unsigned NOT NULL,
  `detail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `message_details_message_id_foreign` (`message_id`),
  CONSTRAINT `message_details_message_id_foreign` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.message_details: ~0 rows (approximately)
/*!40000 ALTER TABLE `message_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `message_details` ENABLE KEYS */;


-- Dumping structure for table sems.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.migrations: ~30 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2018_01_24_140000_infringement_causes', 1),
	(4, '2018_01_24_140001_create_exeptuated_causes_table', 1),
	(5, '2018_01_24_140004_operations', 1),
	(6, '2018_01_24_140008_blocks', 1),
	(7, '2018_01_24_144700_notification_types', 1),
	(8, '2018_01_24_144721_locals', 1),
	(9, '2018_01_24_144734_notifications', 1),
	(10, '2018_01_24_144814_company_sales', 1),
	(11, '2018_01_24_144826_messages', 1),
	(12, '2018_01_24_144838_message_details', 1),
	(13, '2018_01_24_144850_bills', 1),
	(14, '2018_01_24_144902_operation_bills', 1),
	(15, '2018_01_24_144914_vehicles', 1),
	(16, '2018_01_24_144927_vehicle_users', 1),
	(17, '2018_01_24_144939_exeptuated_vehicles', 1),
	(18, '2018_01_24_144952_exeptuated_vehicles_blocks', 1),
	(19, '2018_01_24_145016_operations_between_wallets', 1),
	(20, '2018_01_24_145028_wallets', 1),
	(21, '2018_01_24_145046_tickets', 1),
	(22, '2018_01_24_145058_space_reservatios', 1),
	(23, '2018_01_24_145110_infringements', 1),
	(24, '2018_01_24_145122_infringement_details', 1),
	(25, '2018_01_24_145136_images', 1),
	(26, '2018_01_24_145201_areas', 1),
	(27, '2018_01_24_145213_areas_blocks', 1),
	(28, '2018_01_24_145256_login', 1),
	(29, '2018_01_26_142504_costs', 1),
	(30, '2018_02_02_113410_create_users_billing_datas_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;


-- Dumping structure for table sems.notifications
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `notification_type_id` int(10) unsigned NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_user_id_foreign` (`user_id`),
  KEY `notifications_notification_type_id_foreign` (`notification_type_id`),
  CONSTRAINT `notifications_notification_type_id_foreign` FOREIGN KEY (`notification_type_id`) REFERENCES `notification_types` (`id`),
  CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.notifications: ~0 rows (approximately)
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;


-- Dumping structure for table sems.notification_types
DROP TABLE IF EXISTS `notification_types`;
CREATE TABLE IF NOT EXISTS `notification_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.notification_types: ~3 rows (approximately)
/*!40000 ALTER TABLE `notification_types` DISABLE KEYS */;
INSERT INTO `notification_types` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'Mail', 'Se envia un correo a la direccion del usuario', '2018-02-02 09:10:14', '2018-02-02 09:10:14'),
	(2, 'Mensaje de texto', 'Se envia un sms al telefono registrado por el usuario', '2018-02-02 09:10:14', '2018-02-02 09:10:14'),
	(3, 'WatsUp', 'Se envia un Mensaje al telefono registrado por el usuario', '2018-02-02 09:10:14', '2018-02-02 09:10:14');
/*!40000 ALTER TABLE `notification_types` ENABLE KEYS */;


-- Dumping structure for table sems.operations
DROP TABLE IF EXISTS `operations`;
CREATE TABLE IF NOT EXISTS `operations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_id` int(11) NOT NULL,
  `amount` decimal(13,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.operations: ~18 rows (approximately)
/*!40000 ALTER TABLE `operations` DISABLE KEYS */;
INSERT INTO `operations` (`id`, `type`, `type_id`, `amount`, `created_at`, `updated_at`) VALUES
	(1, 'exeptuatedVehicle', 3, 960.00, '2018-02-02 17:45:13', '2018-02-02 17:45:13'),
	(2, 'exeptuatedVehicle', 4, 960.00, '2018-02-02 17:49:35', '2018-02-02 17:49:35'),
	(3, 'exeptuatedVehicle', 5, 0.00, '2018-02-05 07:57:43', '2018-02-05 07:57:43'),
	(4, 'SpaceReservatio', 1, 500.00, '2018-02-05 09:54:14', '2018-02-05 09:54:14'),
	(5, 'ExeptuatedVehicle', 6, 3000.00, '2018-02-05 13:46:51', '2018-02-05 13:46:51'),
	(6, 'SpaceReservation', 1, 1500.00, '2018-02-07 18:06:07', '2018-02-07 18:06:07'),
	(7, 'SpaceReservation', 2, 900.00, '2018-02-09 17:26:16', '2018-02-09 17:26:16'),
	(8, 'SpaceReservation', 3, 1000.00, '2018-02-09 17:36:09', '2018-02-09 17:36:09'),
	(9, 'ticket', 1, -24.00, '2018-02-15 19:18:41', '2018-02-15 19:18:41'),
	(10, 'ticket', 2, -150.00, '2018-02-15 20:14:25', '2018-02-15 20:14:25'),
	(11, 'ticket', 3, -24.00, '2018-02-15 20:52:16', '2018-02-15 20:52:16'),
	(12, 'ticket', 4, -150.00, '2018-02-15 20:53:42', '2018-02-15 20:53:42'),
	(13, 'ticket', 5, -12.00, '2018-02-16 11:17:41', '2018-02-16 11:17:41'),
	(14, 'ticket', 6, -100.00, '2018-02-16 11:18:11', '2018-02-16 11:18:11'),
	(15, 'Ticket', 7, -24.00, '2018-02-16 17:05:19', '2018-02-16 17:05:19'),
	(16, 'wallet', 3, 300.00, '2018-02-16 17:17:59', '2018-02-16 17:17:59'),
	(17, 'wallet', 5, -300.00, '2018-02-16 17:17:59', '2018-02-16 17:17:59'),
	(18, 'exeptuatedVehicleblock', 7, 1500.00, '2018-02-16 20:30:35', '2018-02-16 20:30:35');
/*!40000 ALTER TABLE `operations` ENABLE KEYS */;


-- Dumping structure for table sems.operation_between_wallets
DROP TABLE IF EXISTS `operation_between_wallets`;
CREATE TABLE IF NOT EXISTS `operation_between_wallets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `operation_id_1` int(10) unsigned NOT NULL,
  `operation_id_2` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `operation_between_wallets_operation_id_1_foreign` (`operation_id_1`),
  KEY `operation_between_wallets_operation_id_2_foreign` (`operation_id_2`),
  CONSTRAINT `operation_between_wallets_operation_id_1_foreign` FOREIGN KEY (`operation_id_1`) REFERENCES `operations` (`id`),
  CONSTRAINT `operation_between_wallets_operation_id_2_foreign` FOREIGN KEY (`operation_id_2`) REFERENCES `operations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.operation_between_wallets: ~1 rows (approximately)
/*!40000 ALTER TABLE `operation_between_wallets` DISABLE KEYS */;
INSERT INTO `operation_between_wallets` (`id`, `operation_id_1`, `operation_id_2`, `created_at`, `updated_at`) VALUES
	(1, 16, 17, '2018-02-16 17:17:59', '2018-02-16 17:17:59');
/*!40000 ALTER TABLE `operation_between_wallets` ENABLE KEYS */;


-- Dumping structure for table sems.operation_bills
DROP TABLE IF EXISTS `operation_bills`;
CREATE TABLE IF NOT EXISTS `operation_bills` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `operation_id` int(10) unsigned NOT NULL,
  `bill_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `operation_bills_operation_id_foreign` (`operation_id`),
  KEY `operation_bills_bill_id_foreign` (`bill_id`),
  CONSTRAINT `operation_bills_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`),
  CONSTRAINT `operation_bills_operation_id_foreign` FOREIGN KEY (`operation_id`) REFERENCES `operations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.operation_bills: ~16 rows (approximately)
/*!40000 ALTER TABLE `operation_bills` DISABLE KEYS */;
INSERT INTO `operation_bills` (`id`, `operation_id`, `bill_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '2018-02-02 17:45:14', '2018-02-02 17:45:14'),
	(2, 2, 2, '2018-02-02 17:49:35', '2018-02-02 17:49:35'),
	(3, 4, 3, '2018-02-05 09:54:14', '2018-02-05 09:54:14'),
	(4, 5, 4, '2018-02-05 13:46:51', '2018-02-05 13:46:51'),
	(5, 6, 5, '2018-02-07 18:06:07', '2018-02-07 18:06:07'),
	(6, 7, 6, '2018-02-09 17:26:16', '2018-02-09 17:26:16'),
	(7, 8, 7, '2018-02-09 17:36:09', '2018-02-09 17:36:09'),
	(9, 9, 8, '2018-02-15 19:18:41', '2018-02-15 19:18:41'),
	(10, 10, 9, '2018-02-15 20:14:26', '2018-02-15 20:14:26'),
	(11, 11, 10, '2018-02-15 20:52:16', '2018-02-15 20:52:16'),
	(12, 12, 11, '2018-02-15 20:53:42', '2018-02-15 20:53:42'),
	(13, 13, 12, '2018-02-16 11:17:41', '2018-02-16 11:17:41'),
	(14, 14, 13, '2018-02-16 11:18:12', '2018-02-16 11:18:12'),
	(15, 15, 14, '2018-02-16 17:05:19', '2018-02-16 17:05:19'),
	(16, 16, 15, '2018-02-16 17:17:59', '2018-02-16 17:17:59'),
	(17, 18, 16, '2018-02-16 20:30:36', '2018-02-16 20:30:36');
/*!40000 ALTER TABLE `operation_bills` ENABLE KEYS */;


-- Dumping structure for table sems.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;


-- Dumping structure for table sems.space_reservations
DROP TABLE IF EXISTS `space_reservations`;
CREATE TABLE IF NOT EXISTS `space_reservations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `identifier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `block_id` int(10) unsigned NOT NULL,
  `latlng` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operation_id` int(10) unsigned DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `space_reservatios_block_id_foreign` (`block_id`),
  KEY `space_reservatios_operation_id_foreign` (`operation_id`),
  CONSTRAINT `space_reservatios_block_id_foreign` FOREIGN KEY (`block_id`) REFERENCES `blocks` (`id`),
  CONSTRAINT `space_reservatios_operation_id_foreign` FOREIGN KEY (`operation_id`) REFERENCES `operations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.space_reservations: ~3 rows (approximately)
/*!40000 ALTER TABLE `space_reservations` DISABLE KEYS */;
INSERT INTO `space_reservations` (`id`, `identifier`, `company`, `start_time`, `end_time`, `block_id`, `latlng`, `operation_id`, `type`, `size`, `created_at`, `updated_at`) VALUES
	(1, 'ZA123', 'Con Ene S.A.', '2018-02-07 00:00:00', '2018-02-18 00:00:00', 1, '[[-43.299972316106874,-65.10602116584778]]', 6, 'container', 4512, '2018-02-07 18:06:07', '2018-02-09 17:41:57'),
	(2, 'NVO123', 'nueva S.A.', '2018-03-03 08:00:00', '2018-03-05 20:00:00', 7, '[[-43.33529201478637,-65.06446838378905]]', 7, 'load_unload', 12, '2018-02-09 17:26:16', '2018-02-09 17:26:16'),
	(3, 'ZAS345', 'SWCI', '2018-02-07 10:00:00', '2018-02-10 20:00:00', 5, '[[-43.29950968097577,-65.10673731565475]]', 8, 'container', 12, '2018-02-09 17:36:09', '2018-02-09 17:36:09');
/*!40000 ALTER TABLE `space_reservations` ENABLE KEYS */;


-- Dumping structure for table sems.tickets
DROP TABLE IF EXISTS `tickets`;
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `plate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `block_id` int(10) unsigned NOT NULL,
  `latlng` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check` int(11) DEFAULT NULL,
  `operation_id` int(10) unsigned DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tickets_user_id_foreign` (`user_id`),
  KEY `tickets_operation_id_foreign` (`operation_id`),
  KEY `tickets_block_id_foreign` (`block_id`),
  CONSTRAINT `tickets_block_id_foreign` FOREIGN KEY (`block_id`) REFERENCES `blocks` (`id`),
  CONSTRAINT `tickets_operation_id_foreign` FOREIGN KEY (`operation_id`) REFERENCES `operations` (`id`),
  CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.tickets: ~7 rows (approximately)
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
INSERT INTO `tickets` (`id`, `user_id`, `plate`, `time`, `start_time`, `end_time`, `block_id`, `latlng`, `check`, `operation_id`, `token`, `type`, `created_at`, `updated_at`) VALUES
	(1, 5, 'KKG679', '2', '2018-02-15 19:18:39', '2018-02-16 09:18:00', 14, '[[-43.29995084366814,-65.10605335235596]]', NULL, 9, 'Ke201G1570', 'time', '2018-02-15 19:18:41', '2018-02-15 19:18:41'),
	(2, 5, 'IQW938', '0', '2018-02-15 20:14:25', '2018-02-15 23:59:59', 14, '[[-43.29995084366814,-65.10605335235596]]', NULL, 10, '082ady1152', 'day', '2018-02-15 20:14:25', '2018-02-15 20:14:25'),
	(3, 5, 'AB157BC', '2', '2018-02-15 20:52:15', '2018-02-16 09:59:00', 14, '[[-43.29995084366814,-65.10605335235596]]', NULL, 11, 'B01851tm2C', 'time', '2018-02-15 20:52:16', '2018-02-15 20:52:16'),
	(4, 5, 'AB789AC', '0', '2018-02-15 20:53:42', '2018-02-15 23:59:59', 14, '[[-43.29995084366814,-65.10605335235596]]', NULL, 12, 'A578029d1a', 'day', '2018-02-15 20:53:42', '2018-02-15 20:53:42'),
	(5, 5, 'CVS752', '1', '2018-02-16 11:17:39', '2018-02-16 12:17:00', 14, '[[-43.29995084366814,-65.10605335235596]]', NULL, 13, 'Vm1612t01S', 'time', '2018-02-16 11:17:41', '2018-02-16 11:17:41'),
	(6, 5, 'KKG679', '0', '2018-02-16 11:18:11', '2018-02-16 23:59:59', 14, '[[-43.29995084366814,-65.10605335235596]]', NULL, 14, '2111K89ay1', 'day', '2018-02-16 11:18:11', '2018-02-16 11:18:11'),
	(7, 5, 'AA759AB', '2', '2018-02-16 17:05:17', '2018-02-16 19:05:00', 14, '[[-43.29995084366814,-65.10605335235596]]', NULL, 15, '58i2tB12m0', 'time', '2018-02-16 17:05:19', '2018-02-16 17:05:19');
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;


-- Dumping structure for table sems.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.users: ~8 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `password`, `email`, `phone`, `type`, `account_status`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Administrador General', '$2y$10$kiqs7ZXoGJHAe/opud2/dO4iKisPPYIdSJEaKn93OG4myHB0Hktb6', 'administradorgeneral@gmail.com', '1544008341', 'admsuper', 'A', 'tSdqkJkxlT8EUbXvft0QpJ1q7PHLlKwPCjbNVElHi6WWsj4JEFpMyqAYePTA', NULL, NULL),
	(2, 'Ezequiel', '$2y$10$VkkmTLdp1csID.kmIyU6/eAfhe8vED/Ic8.fdW.PL/vEB2t2gpBjy', 'wernicke.ezequiel@gmail.com', '12345678', 'judge', 'N', NULL, '2018-02-02 09:13:01', '2018-02-02 09:13:01'),
	(3, 'matias Wernicke', '$2y$10$SEl191L12bmzHwCSRrH29uVh/p4BGFT3OgZMDvsmAU5QZ1cVjbmVW', 'matiaswernickec@gmail.com', '12345678', 'driver', 'N', '3E863Fuj8V5VwoM8ZUPvrqEiKLssbftQ9fOFNjFlcaZQQWJy0W1902tg5pCQ', '2018-02-02 09:13:38', '2018-02-12 12:06:11'),
	(5, 'Local 1 S.A.', '$2y$10$kiqs7ZXoGJHAe/opud2/dO4iKisPPYIdSJEaKn93OG4myHB0Hktb6', 'local@gmail.com', '12321312312', 'local', 'N', 'VlcKAjn4AqbJQfu6BdcsdVc677AtoA68QPB16QoSYEBqXXRE6oWwKx5RKzfY', '2018-02-02 09:46:07', '2018-02-09 17:01:55'),
	(6, 'Pedro Salinas', '$2y$10$w0CcB5uzyXFkMr5z7ZxkWOSEMHpzPxRUGAKtra1hSPsAONCTCDdnC', 'conductor2@gmail.com', '12321312312', 'driver', 'N', NULL, '2018-02-02 11:50:02', '2018-02-02 11:50:02'),
	(7, 'Mariano Perez', '$2y$10$No5D.BCI9BlAdgu9/B9gYue0tFhSvgzG96t8rCln7lxpnNFUhqDaG', 'conductor3@gmail.com', '12321312312', 'driver', 'N', NULL, '2018-02-02 11:50:30', '2018-02-02 11:50:30'),
	(8, 'Alejandro Garcia', '$2y$10$4wOdvn739SrKnH8gBdhAAu3.CI2Wb15vrmW14f6bYZj8UtrUvVrZm', 'conductor2@gmail.com4', '12321312312', 'driver', 'N', NULL, '2018-02-02 11:50:57', '2018-02-02 11:50:57'),
	(9, 'Rivadavia 24HS', '$2y$10$SCFhX07eN0TZlttRdLkaUuDr9Ttlmb.0cDPmqNVH9KLBdTuoANoSq', 'local2@gmail.com', '12345678', 'local', 'N', '6kgBzpT9eugBe3cqCHgOLhPBySHAtsGHckPqd7zMCXe5lN36yx7NqfDTT34V', '2018-02-15 08:54:31', '2018-02-15 08:54:31');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Dumping structure for table sems.users_billing_datas
DROP TABLE IF EXISTS `users_billing_datas`;
CREATE TABLE IF NOT EXISTS `users_billing_datas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `bussines_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_treatment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_billing_datas_user_id_foreign` (`user_id`),
  CONSTRAINT `users_billing_datas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.users_billing_datas: ~2 rows (approximately)
/*!40000 ALTER TABLE `users_billing_datas` DISABLE KEYS */;
INSERT INTO `users_billing_datas` (`id`, `user_id`, `bussines_name`, `tax_treatment`, `address`, `city`, `state`, `document_type`, `document_number`, `created_at`, `updated_at`) VALUES
	(1, 5, 'Local 1 S.A.', '1', 'Alejandro Maiz comercial', 'rawson', 'chubut', '80', '33147852698', '2018-02-02 09:46:07', '2018-02-09 17:01:55'),
	(5, 9, 'Rivadavia 24HS', '0', 'Ridavavia 641', 'Rawson', 'Chubut', '80', '20-13881508-1', '2018-02-15 08:54:31', '2018-02-15 08:54:31');
/*!40000 ALTER TABLE `users_billing_datas` ENABLE KEYS */;


-- Dumping structure for table sems.vehicles
DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE IF NOT EXISTS `vehicles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.vehicles: ~11 rows (approximately)
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;
INSERT INTO `vehicles` (`id`, `plate`, `created_at`, `updated_at`) VALUES
	(1, 'IQW938', '2018-02-02 09:52:21', '2018-02-02 09:52:21'),
	(2, 'KKG679', '2018-02-02 09:52:52', '2018-02-02 09:52:52'),
	(3, 'AA152AB', '2018-02-02 09:53:26', '2018-02-02 09:53:26'),
	(4, 'AA123BB', '2018-02-02 13:43:45', '2018-02-02 13:43:45'),
	(5, 'AA789BC', '2018-02-02 13:50:10', '2018-02-02 13:50:10'),
	(6, 'AA789BB', '2018-02-02 13:55:52', '2018-02-02 13:55:52'),
	(7, 'AZ12345', '2018-02-02 17:05:05', '2018-02-02 17:05:05'),
	(8, 'AA123ZZ', '2018-02-09 13:12:56', '2018-02-09 13:12:56'),
	(9, 'CVS752', '2018-02-16 11:17:41', '2018-02-16 11:17:41'),
	(10, 'AA759AB', '2018-02-16 17:05:19', '2018-02-16 17:05:19'),
	(11, 'AA974AB', '2018-02-16 20:30:35', '2018-02-16 20:30:35');
/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;


-- Dumping structure for table sems.vehicle_users
DROP TABLE IF EXISTS `vehicle_users`;
CREATE TABLE IF NOT EXISTS `vehicle_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicle_users_vehicle_id_foreign` (`vehicle_id`),
  KEY `vehicle_users_user_id_foreign` (`user_id`),
  CONSTRAINT `vehicle_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `vehicle_users_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.vehicle_users: ~5 rows (approximately)
/*!40000 ALTER TABLE `vehicle_users` DISABLE KEYS */;
INSERT INTO `vehicle_users` (`id`, `vehicle_id`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 3, NULL, NULL),
	(2, 2, 3, NULL, NULL),
	(5, 3, 3, '2018-02-02 10:06:17', '2018-02-02 10:06:17'),
	(6, 2, 1, '2018-02-09 19:15:07', '2018-02-09 19:15:07'),
	(7, 1, 1, '2018-02-09 19:49:58', '2018-02-09 19:49:58');
/*!40000 ALTER TABLE `vehicle_users` ENABLE KEYS */;


-- Dumping structure for table sems.wallets
DROP TABLE IF EXISTS `wallets`;
CREATE TABLE IF NOT EXISTS `wallets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `balance` decimal(13,2) NOT NULL,
  `chips` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wallets_user_id_foreign` (`user_id`),
  CONSTRAINT `wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sems.wallets: ~6 rows (approximately)
/*!40000 ALTER TABLE `wallets` DISABLE KEYS */;
INSERT INTO `wallets` (`id`, `user_id`, `balance`, `chips`, `credit`, `created_at`, `updated_at`) VALUES
	(1, 3, 300.00, '0', '0', '2018-02-02 09:13:38', '2018-02-16 17:17:59'),
	(3, 5, 4676.00, '5', '50', '2018-02-02 09:46:07', '2018-02-16 17:17:59'),
	(4, 6, 0.00, '0', '0', '2018-02-02 11:50:02', '2018-02-02 11:50:02'),
	(5, 7, 700.00, '7', '70', '2018-02-02 11:50:30', '2018-02-02 11:50:30'),
	(6, 8, 800.00, '8', '80', '2018-02-02 11:50:57', '2018-02-02 11:50:57'),
	(10, 9, 0.00, '0', '0', '2018-02-15 08:54:31', '2018-02-15 08:54:31');
/*!40000 ALTER TABLE `wallets` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

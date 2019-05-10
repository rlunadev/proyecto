# Host: localhost  (Version 5.5.5-10.1.26-MariaDB)
# Date: 2018-04-22 07:27:21
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "categorias"
#

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

#
# Data for table "categorias"
#

INSERT INTO `categorias` VALUES (1,'Equipo','equipos como maquinaria',NULL,'2017-11-10 19:25:32'),(2,'Obrero','mano de obra (maestros,ayudantes,topografos,cocinera,limpieza)','2017-10-10 00:39:15','2017-11-10 19:27:49'),(3,'Materiales','insumo de materiales','2017-10-10 00:39:24','2017-11-10 19:25:01');

#
# Structure for table "configuracion"
#

DROP TABLE IF EXISTS `configuracion`;
CREATE TABLE `configuracion` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `servidor_logueo` varchar(255) DEFAULT NULL,
  `ruta_inicial` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

#
# Data for table "configuracion"
#

INSERT INTO `configuracion` VALUES (1,'http://localhost:9000/login','http://localhost:8000/calculo/public/home',NULL,NULL);

#
# Structure for table "formulas"
#

DROP TABLE IF EXISTS `formulas`;
CREATE TABLE `formulas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `fecha` varchar(255) DEFAULT NULL,
  `unidad_id` int(11) DEFAULT NULL,
  `subTotal` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

#
# Data for table "formulas"
#

INSERT INTO `formulas` VALUES (1,'Piscina','11/10/2017',NULL,182.50,'2017-11-12 18:06:51','2017-11-12 18:06:51'),(6,'Techo','11/08/2017',NULL,85.10,'2017-11-12 18:29:55','2017-11-12 18:29:55'),(7,'Pisos 1x1x1','11/16/2017',NULL,0.00,'2017-11-12 23:07:53','2017-11-12 23:07:53'),(8,'Pared 3x3x3','11/11/2017',NULL,62.50,'2017-11-12 23:10:15','2017-11-12 23:10:15'),(9,'formula 1','11/22/2017',NULL,37.50,'2017-11-14 00:48:55','2017-11-14 00:48:55'),(10,'loza 1x1x1','11/09/2017',NULL,66.13,'2017-11-14 05:21:44','2017-11-14 05:21:44'),(11,'123','11/17/2017',NULL,180.00,'2017-11-14 05:39:10','2017-11-14 05:39:10'),(12,'formula test','12/01/2017',NULL,399.00,'2017-11-14 05:39:52','2017-11-14 05:39:52'),(13,'hhh','11/08/2017',NULL,177.50,'2017-11-14 05:40:42','2017-11-14 05:40:42'),(14,'Vivienda Luna','11/01/2017',NULL,2060.00,'2017-11-14 21:22:00','2017-11-14 21:22:00'),(15,'FORMULA 3','11/15/2017',NULL,10120.00,'2017-11-15 12:36:30','2017-11-15 12:36:30'),(16,'habitacion','11/21/2017',NULL,583.33,'2017-11-21 16:59:42','2017-11-21 16:59:42'),(17,'Cuarto vacio','11/22/2017',NULL,362.63,'2017-11-22 12:42:13','2017-11-22 12:42:13'),(18,'pasillo','11/22/2017',NULL,89.25,'2017-11-22 12:50:36','2017-11-22 12:50:36'),(19,'patio 1x1','11/22/2017',NULL,235.00,'2017-11-22 13:23:22','2017-11-22 13:23:22');

#
# Structure for table "formulas_detalles"
#

DROP TABLE IF EXISTS `formulas_detalles`;
CREATE TABLE `formulas_detalles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` decimal(10,3) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `subTotal` decimal(10,2) DEFAULT NULL,
  `parametro_id` int(11) DEFAULT NULL,
  `pago_id` int(11) DEFAULT NULL,
  `formula_id` int(11) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `categoria_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

#
# Data for table "formulas_detalles"
#

INSERT INTO `formulas_detalles` VALUES (19,50.000,1.15,57.50,15,NULL,1,NULL,'2017-11-12 17:43:00','2017-11-12 17:43:00',1),(24,50.000,1.15,57.50,15,NULL,6,NULL,'2017-11-12 18:11:08','2017-11-12 18:11:08',1),(25,24.000,1.15,27.60,15,NULL,6,NULL,'2017-11-12 18:14:15','2017-11-12 18:14:15',1),(26,NULL,10.00,0.00,16,NULL,7,NULL,'2017-11-12 23:04:42','2017-11-12 23:04:42',2),(27,5.000,12.50,62.50,9,NULL,8,NULL,'2017-11-12 23:09:58','2017-11-12 23:09:58',1),(28,3.000,12.50,37.50,9,NULL,9,NULL,'2017-11-14 00:48:42','2017-11-14 00:48:42',2),(29,5.000,12.00,60.00,13,NULL,10,NULL,'2017-11-14 05:21:10','2017-11-14 05:21:10',3),(30,0.500,12.00,6.00,12,NULL,10,NULL,'2017-11-14 05:21:17','2017-11-14 05:21:17',3),(31,0.001,125.00,0.13,11,NULL,10,NULL,'2017-11-14 05:21:24','2017-11-14 05:21:24',3),(32,15.000,12.00,180.00,13,NULL,11,NULL,'2017-11-14 05:39:02','2017-11-14 05:39:02',2),(33,2.000,12.00,24.00,13,NULL,12,NULL,'2017-11-14 05:39:40','2017-11-14 05:39:40',1),(34,3.000,125.00,375.00,11,NULL,12,NULL,'2017-11-14 05:39:44','2017-11-14 05:39:44',1),(35,10.000,12.00,120.00,12,NULL,13,NULL,'2017-11-14 05:40:31','2017-11-14 05:40:31',1),(36,50.000,1.15,57.50,15,NULL,13,NULL,'2017-11-14 05:40:36','2017-11-14 05:40:36',1),(37,5.000,12.00,60.00,13,NULL,14,NULL,'2017-11-14 12:33:24','2017-11-14 12:33:24',3),(38,100.000,20.00,2000.00,18,NULL,14,NULL,'2017-11-14 21:21:19','2017-11-14 21:21:19',1),(40,100.000,100.00,10000.00,19,NULL,15,NULL,'2017-11-15 12:35:58','2017-11-15 12:35:58',3),(41,10.000,12.00,120.00,13,NULL,15,NULL,'2017-11-15 12:36:13','2017-11-15 12:36:13',3),(43,0.500,1000.00,500.00,20,NULL,16,NULL,'2017-11-21 16:59:21','2017-11-21 16:59:21',1),(44,10.000,8.33,83.33,21,NULL,16,NULL,'2017-11-21 16:59:38','2017-11-21 16:59:38',1),(45,250.000,1.15,287.50,15,NULL,17,NULL,'2017-11-22 12:41:23','2017-11-22 12:41:23',3),(46,6.000,12.00,72.00,22,NULL,17,NULL,'2017-11-22 12:41:39','2017-11-22 12:41:39',3),(47,0.025,125.00,3.13,11,NULL,17,NULL,'2017-11-22 12:42:07','2017-11-22 12:42:07',3),(48,0.200,120.00,24.00,23,NULL,18,NULL,'2017-11-22 12:49:50','2017-11-22 12:49:50',3),(49,15.000,1.15,17.25,15,NULL,18,NULL,'2017-11-22 12:50:11','2017-11-22 12:50:11',3),(50,4.000,12.00,48.00,22,NULL,18,NULL,'2017-11-22 12:50:33','2017-11-22 12:50:33',2),(51,100.000,1.15,115.00,15,NULL,19,NULL,'2017-11-22 13:21:23','2017-11-22 13:21:23',3),(52,0.500,120.00,60.00,23,NULL,19,NULL,'2017-11-22 13:22:56','2017-11-22 13:22:56',3),(53,5.000,12.00,60.00,22,NULL,19,NULL,'2017-11-22 13:23:11','2017-11-22 13:23:11',3);

#
# Structure for table "migrations"
#

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

#
# Data for table "migrations"
#

INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2017_09_10_170407_empresa',1),('2017_09_10_171331_almacen',1),('2017_09_10_193102_unidad',1),('2017_09_10_194342_categoria',1),('2017_09_10_194814_proveedor',1),('2017_09_10_205108_producto',1);

#
# Structure for table "modulos"
#

DROP TABLE IF EXISTS `modulos`;
CREATE TABLE `modulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `proyecto_id` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT '2017-11-13',
  `fecha_final` date DEFAULT '2017-11-20',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

#
# Data for table "modulos"
#

INSERT INTO `modulos` VALUES (1,'modulo 1',1,'2017-11-21','2017-11-29','2017-11-13 01:17:39','2017-11-20 03:33:25'),(2,'modulo 2',2,'2017-11-13','2017-11-20','2017-11-14 01:13:27','2017-11-14 01:13:27'),(3,'grupo de lozas',5,'2017-11-13','2017-11-20','2017-11-14 05:22:13','2017-11-14 05:22:13'),(4,'modulo nuevo',7,'2017-11-13','2017-11-20','2017-11-14 05:34:31','2017-11-14 05:34:31'),(5,'modulo prueba',7,'2017-11-16','2017-12-01','2017-11-14 05:38:47','2017-11-23 22:58:30'),(6,'modulo mesas',7,'2017-11-24','2017-12-01','2017-11-14 21:22:40','2017-11-20 04:14:11'),(7,'MODULO PRUEBA',8,'2017-11-13','2017-11-20','2017-11-15 12:37:54','2017-11-15 12:37:54'),(8,'Instalacion de Faenas',6,'2017-11-13','2017-11-16',NULL,'2017-11-20 03:36:31'),(9,'Replanteo y Trazado',6,'2017-11-16','2017-11-23',NULL,'2017-11-20 03:39:30'),(10,'Cimiento de Hormigon',6,'2017-11-24','2017-11-28',NULL,'2017-11-20 03:39:32'),(11,'Sobrecimiento',6,'2017-11-24','2017-11-24',NULL,'2017-11-20 03:39:33'),(12,'Vigas',6,'2017-11-27','2017-12-02',NULL,'2017-11-20 09:46:23'),(13,'habitacion',9,'2017-11-14','2017-12-09','2017-11-21 17:00:29','2017-11-21 17:02:48'),(14,'vivienda UAB',10,'2017-11-13','2017-11-20','2017-11-22 12:42:46','2017-11-22 12:42:46'),(15,'Departamento',10,'2017-11-16','2017-11-23','2017-11-22 12:51:22','2017-11-22 13:26:40'),(16,'departamento',11,'2017-11-14','2017-11-22','2017-11-22 13:24:38','2017-11-22 13:26:23'),(17,'modulo 1',12,'2017-11-15','2017-11-20','2017-11-22 13:27:55','2017-11-22 13:29:23'),(18,'patio',12,'2017-11-17','2017-11-21','2017-11-22 13:28:20','2017-11-22 13:29:19');

#
# Structure for table "modulos_detalles"
#

DROP TABLE IF EXISTS `modulos_detalles`;
CREATE TABLE `modulos_detalles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` decimal(10,2) DEFAULT NULL,
  `subTotal` decimal(10,2) DEFAULT NULL,
  `formula_id` int(11) DEFAULT NULL,
  `modulo_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

#
# Data for table "modulos_detalles"
#

INSERT INTO `modulos_detalles` VALUES (11,4.00,340.40,6,1,'2017-11-13 00:25:12','2017-11-13 00:25:12'),(18,2.00,170.20,6,1,'2017-11-13 00:27:59','2017-11-13 00:27:59'),(20,2.00,170.20,6,1,'2017-11-13 00:29:03','2017-11-13 00:29:03'),(23,5.00,187.50,9,2,'2017-11-14 00:49:45','2017-11-14 00:49:45'),(24,5.00,330.65,10,3,'2017-11-14 05:22:01','2017-11-14 05:22:01'),(25,10.00,625.00,8,4,'2017-11-14 05:34:26','2017-11-14 05:34:26'),(26,12.00,450.00,14,8,'2017-11-14 05:38:32','2017-11-14 05:38:32'),(27,2.00,132.26,14,9,'2017-11-14 05:38:41','2017-11-14 05:38:41'),(33,1.00,180.00,14,10,'2017-11-14 05:47:06','2017-11-14 05:47:06'),(34,2.00,75.00,14,11,'2017-11-14 05:47:16','2017-11-14 05:47:16'),(35,2.00,4120.00,14,12,'2017-11-14 21:22:30','2017-11-14 21:22:30'),(36,5.00,50600.00,15,7,'2017-11-15 12:37:25','2017-11-15 12:37:25'),(37,1.00,583.33,16,13,'2017-11-21 17:00:12','2017-11-21 17:00:12'),(38,5.00,1813.15,17,14,'2017-11-22 12:42:34','2017-11-22 12:42:34'),(39,1.00,362.63,17,15,'2017-11-22 12:51:01','2017-11-22 12:51:01'),(40,2.00,178.50,18,15,'2017-11-22 12:51:10','2017-11-22 12:51:10'),(41,2.00,470.00,19,16,'2017-11-22 13:24:01','2017-11-22 13:24:01'),(42,1.00,362.63,17,16,'2017-11-22 13:24:14','2017-11-22 13:24:14'),(43,2.00,178.50,18,16,'2017-11-22 13:24:23','2017-11-22 13:24:23'),(44,5.00,1813.15,17,17,'2017-11-22 13:27:49','2017-11-22 13:27:49'),(45,2.00,470.00,19,18,'2017-11-22 13:28:06','2017-11-22 13:28:06');

#
# Structure for table "parametros"
#

DROP TABLE IF EXISTS `parametros`;
CREATE TABLE `parametros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `precio_venta` decimal(10,2) DEFAULT NULL,
  `unidad_id` int(11) DEFAULT NULL,
  `unidad_formula` varchar(255) DEFAULT NULL,
  `empresa_id` int(11) DEFAULT NULL,
  `nombre_empresa` varchar(255) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `equivale` int(11) DEFAULT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `unidad` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

#
# Data for table "parametros"
#

INSERT INTO `parametros` VALUES (10,'CLAVOS',12.00,10,'1',NULL,NULL,20,1,'Materiales','KG','2017-11-12 12:50:37','2017-11-12 12:50:37'),(11,'ARENA COMUN',125.00,2,'3',NULL,NULL,14,1,'Materiales','M3','2017-11-12 12:50:40','2017-11-12 12:50:40'),(12,'ALQUITRAN',12.00,10,'1',NULL,NULL,26,1,'Materiales','KG','2017-11-12 12:50:42','2017-11-12 12:50:42'),(13,'ALAMBRE DE AMARRE',12.00,10,'1',NULL,NULL,21,1,'Materiales','KG','2017-11-12 12:50:44','2017-11-12 12:50:44'),(14,'CLAVOS',15.00,10,'1',NULL,NULL,12,1,'Materiales','KG','2017-11-12 12:50:48','2017-11-12 12:50:48'),(15,'CEMENTO PORTLAND',57.50,10,'1',NULL,NULL,17,50,'Materiales','KG','2017-11-12 13:22:38','2017-11-12 13:22:38'),(16,'ESPECIALISTA',10.00,7,'1',NULL,NULL,27,1,'Obrero','hr','2017-11-12 17:47:30','2017-11-12 17:47:30'),(18,'mesas',200.00,2,'3',NULL,NULL,29,10,'Materiales','M3','2017-11-14 21:20:23','2017-11-14 21:20:23'),(19,'MADERA',100.00,1,'1',NULL,NULL,30,1,'Materiales','PZA','2017-11-15 12:35:10','2017-11-15 12:35:10'),(20,'CAbles',1000.00,6,'1',NULL,NULL,31,1,'Materiales','RLLO','2017-11-21 16:57:53','2017-11-21 16:57:53'),(21,'machimbre',100.00,1,'1',NULL,NULL,32,12,'Materiales','PZA','2017-11-21 16:57:59','2017-11-21 16:57:59'),(22,'Obrero maestro',12.00,7,'1',NULL,NULL,34,1,'Obrero','hr','2017-11-22 12:40:22','2017-11-22 12:40:22'),(23,'PIEDRA MANZANA',120.00,2,'3',NULL,NULL,18,1,'Materiales','M3','2017-11-22 12:49:22','2017-11-22 12:49:22'),(24,'Piedra redonda',50.00,2,'3',NULL,NULL,35,1000,'Materiales','M3','2017-11-22 13:20:39','2017-11-22 13:20:39');

#
# Structure for table "password_resets"
#

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

#
# Data for table "password_resets"
#


#
# Structure for table "proyectos"
#

DROP TABLE IF EXISTS `proyectos`;
CREATE TABLE `proyectos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `presupuesto` decimal(10,2) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_final` date DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

#
# Data for table "proyectos"
#

INSERT INTO `proyectos` VALUES (1,'Vivienda Luna','la paz',1000.00,12000.00,'2017-11-01','2017-11-30',NULL,'2017-11-14 21:24:03','0000-00-00 00:00:00'),(2,'Enlosetado calle tupak katari','La Paz',170.00,444.00,'2017-11-01','2017-11-30',NULL,'2017-11-14 21:24:03','2017-11-14 05:12:05'),(5,'Plaza triangular','1234',330.65,1234.00,'2017-11-01','2017-11-30',NULL,'2017-11-14 21:24:03','2017-11-14 05:32:55'),(6,'Cordon de acera','ha',1207.26,1000.00,'2017-11-01','2017-11-30',NULL,'2017-11-14 21:24:03','2017-11-14 05:48:19'),(7,'Refaccion malaga','la paz',4375.00,1000.00,'2017-11-01','2017-11-30',0,'2017-11-14 21:24:03','2017-11-14 21:24:03'),(8,'PROYECTO PRUEBA','LA PAZ',50600.00,10000.00,'2017-11-01','2017-11-15',0,'2017-11-15 12:38:25','2017-11-15 12:38:25'),(9,'casa','cbba',583.33,1000.00,'2017-11-01','2017-12-31',0,'2017-11-21 17:01:22','2017-11-21 17:01:22'),(10,'Vivienda Juanito','cbba',2354.28,15000.00,'2017-11-01','2017-11-22',0,'2017-11-22 12:52:26','2017-11-22 12:52:26'),(11,'Edificio los alamos','cbba',1011.13,20000.00,'2017-11-10','2017-11-22',0,'2017-11-22 13:25:37','2017-11-22 13:25:37'),(12,'edificio 2','la paz',2283.15,500.00,'2017-11-01','2017-11-22',0,'2017-11-22 13:28:50','2017-11-22 13:28:50');

#
# Structure for table "unidades"
#

DROP TABLE IF EXISTS `unidades`;
CREATE TABLE `unidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `simbolo` varchar(255) DEFAULT NULL,
  `calculo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "unidades"
#


#
# Structure for table "unidades_copy"
#

DROP TABLE IF EXISTS `unidades_copy`;
CREATE TABLE `unidades_copy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

#
# Data for table "unidades_copy"
#

INSERT INTO `unidades_copy` VALUES (1,'PZA','1','PIEZA',NULL,'2017-11-08 06:00:15'),(2,'M3','3','METRO CUBICO',NULL,'2017-10-20 11:07:20'),(3,'M2','2','METRO CUADRADO',NULL,'2017-10-20 11:07:23'),(4,'P2','1','P2',NULL,'2017-11-08 06:00:04'),(5,'GL','1','GALONES',NULL,'2017-11-08 06:00:49'),(6,'RLLO','1','ROLLO',NULL,'2017-11-08 06:00:29'),(7,'hr','1','HORA',NULL,'2017-11-08 06:01:04'),(8,'MM','0.01','MILIMETROS',NULL,'2017-11-08 06:00:40'),(9,'G','0.001','GRAMOS',NULL,'2017-11-08 05:59:52'),(10,'KG','1','KILOGRAMOS',NULL,'2017-11-08 06:00:57');

#
# Structure for table "users"
#

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sistema_registro_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "users"
#


create database db_pagos;
use db_pagos;

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

INSERT INTO `configuracion` VALUES (1,'http://localhost:9000/login','http://localhost:8000/pagos/public/home',NULL,NULL);

#
# Structure for table "empleados"
#

DROP TABLE IF EXISTS `empleados`;
CREATE TABLE `empleados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `tipoPago_id` int(11) DEFAULT NULL,
  `tipoEmpleado_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "empleados"
#


#
# Structure for table "tipo_empleados"
#

DROP TABLE IF EXISTS `tipo_empleados`;
CREATE TABLE `tipo_empleados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "tipo_empleados"
#

INSERT INTO `tipo_empleados` VALUES (1,'3','3','2017-11-14 11:16:00','2017-11-14 11:16:00');

#
# Structure for table "tipo_pagos"
#

DROP TABLE IF EXISTS `tipo_pagos`;
CREATE TABLE `tipo_pagos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Data for table "tipo_pagos"
#

INSERT INTO `tipo_pagos` VALUES (1,'eee','ww','2017-11-14 11:09:58','2017-11-14 11:09:58'),(2,'33','222','2017-11-14 11:10:08','2017-11-14 11:10:08');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

#
# Data for table "users"
#


# Host: localhost  (Version 5.5.5-10.1.26-MariaDB)
# Date: 2018-04-22 07:27:51
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Data for table "categorias"
#

INSERT INTO `categorias` VALUES (1,'Equipo','Equipos nesesarios para la obra',NULL,'2017-11-10 19:25:32'),(2,'Obrero','mano de obra','2017-10-10 00:39:15','2017-11-10 19:27:49'),(3,'Materiales','todos los insumos de electricidad','2017-10-10 00:39:24','2017-11-10 19:25:01');

#
# Structure for table "compra_detalles"
#

DROP TABLE IF EXISTS `compra_detalles`;
CREATE TABLE `compra_detalles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) NOT NULL DEFAULT '0',
  `precio_compra` int(11) NOT NULL DEFAULT '0',
  `precio_venta` int(11) DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `item_id` int(11) DEFAULT NULL,
  `compra_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

#
# Data for table "compra_detalles"
#


#
# Structure for table "compras"
#

DROP TABLE IF EXISTS `compras`;
CREATE TABLE `compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `empresa_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "compras"
#


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "configuracion"
#

INSERT INTO `configuracion` VALUES (1,'http://localhost:9000/login','http://localhost:8000/inventario/public/home',NULL,NULL);

#
# Structure for table "empresas"
#

DROP TABLE IF EXISTS `empresas`;
CREATE TABLE `empresas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Data for table "empresas"
#

INSERT INTO `empresas` VALUES (4,'ferreteria juan','vinto','asdf','1243',NULL,NULL,NULL),(7,'test 10','','','',NULL,NULL,NULL);

#
# Structure for table "almacenes"
#

DROP TABLE IF EXISTS `almacenes`;
CREATE TABLE `almacenes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ubicacion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `empresaId` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `almacenes_empresaid_foreign` (`empresaId`),
  CONSTRAINT `almacenes_empresaid_foreign` FOREIGN KEY (`empresaId`) REFERENCES `empresas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Data for table "almacenes"
#


#
# Structure for table "migrations"
#

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Data for table "migrations"
#

INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2017_09_10_170407_empresa',1),('2017_09_10_171331_almacen',1),('2017_09_10_193102_unidad',1),('2017_09_10_194342_categoria',1),('2017_09_10_194814_proveedor',1),('2017_09_10_205108_producto',1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Data for table "password_resets"
#


#
# Structure for table "proveedores"
#

DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE `proveedores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vendedor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Data for table "proveedores"
#

INSERT INTO `proveedores` VALUES (2,'14','4','4','4','2017-10-10 15:59:09','2017-10-10 16:26:23');

#
# Structure for table "salida_detalles"
#

DROP TABLE IF EXISTS `salida_detalles`;
CREATE TABLE `salida_detalles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_producto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '0',
  `precio_venta` decimal(10,2) DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `item_id` int(11) DEFAULT NULL,
  `salida_id` int(11) DEFAULT NULL,
  `subTotal` decimal(10,2) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `empresa_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Data for table "salida_detalles"
#

INSERT INTO `salida_detalles` VALUES (1,'ARENA COMUN',5,125.00,'0',14,1,625.00,1,0,NULL,NULL),(2,'CEMENTO PORTLAND',5,80.00,'0',17,2,400.00,1,0,NULL,NULL);

#
# Structure for table "salidas"
#

DROP TABLE IF EXISTS `salidas`;
CREATE TABLE `salidas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `empresa_id` int(11) DEFAULT NULL,
  `empresa_solicitante` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

#
# Data for table "salidas"
#

INSERT INTO `salidas` VALUES (1,'Calculo',625.00,'2017-11-11',0,'JBBL',NULL,NULL),(2,'Salida cemento',400.00,'2017-11-11',0,'jbbl',NULL,NULL);

#
# Structure for table "unidades"
#

DROP TABLE IF EXISTS `unidades`;
CREATE TABLE `unidades` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Data for table "unidades"
#

INSERT INTO `unidades` VALUES (1,'PZA','1','PIEZA',NULL,'2017-11-08 06:00:15'),(2,'M3','3','METRO CUBICO',NULL,'2017-10-20 11:07:20'),(3,'M2','2','METRO CUADRADO',NULL,'2017-10-20 11:07:23'),(4,'P2','1','P2',NULL,'2017-11-08 06:00:04'),(6,'RLLO','1','ROLLO',NULL,'2017-11-08 06:00:29'),(7,'hr','1','HORA',NULL,'2017-11-08 06:01:04'),(8,'MM','0.01','MILIMETROS',NULL,'2017-11-08 06:00:40'),(9,'G','0.001','GRAMOS',NULL,'2017-11-08 05:59:52'),(10,'KG','1','KILOGRAMOS',NULL,'2017-11-08 06:00:57');

#
# Structure for table "items"
#

DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `equivale` int(11) DEFAULT '1',
  `precio_venta` decimal(10,2) DEFAULT '0.00',
  `unidad_id` int(10) unsigned NOT NULL DEFAULT '0',
  `categoria_id` int(10) unsigned NOT NULL DEFAULT '0',
  `empresa_id` int(11) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `productos_unidadid_foreign` (`unidad_id`),
  KEY `productos_categoriaid_foreign` (`categoria_id`),
  CONSTRAINT `productos_categoriaid_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE,
  CONSTRAINT `productos_unidadid_foreign` FOREIGN KEY (`unidad_id`) REFERENCES `unidades` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Data for table "items"
#

INSERT INTO `items` VALUES (1,'DEPOSITO DE MATERIALES (ALQUILER)',100,1,350.00,1,1,1,NULL,NULL),(2,'OFICINA EN OBRA(ALQUILER)',100,1,250.00,1,3,1,NULL,NULL),(3,'LETRERO DE PANAFLEX CON ESTRUCTURA METALICA (FORMATO G.A.M.E.A.)',100,1,400.00,1,3,1,NULL,NULL),(4,'LETREROS DE PREVENCION',100,1,70.00,1,3,NULL,NULL,NULL),(7,'HABITACION PARA SERENO',100,1,250.00,1,1,NULL,NULL,NULL),(8,'ESTACAS (2*2*0.30)',100,1,4.00,1,3,NULL,NULL,NULL),(10,'ESTUCO BEDOYA',100,1,0.60,10,3,NULL,NULL,NULL),(11,'ALAMBRE DE AMARRE 2',100,1,12.50,10,3,NULL,NULL,'2017-11-14 21:26:54'),(12,'CLAVOS',100,1,15.00,10,3,NULL,NULL,'2017-11-10 15:18:33'),(13,'LIENZA PARA ALBAÑIL',100,1,5.00,6,3,NULL,NULL,NULL),(14,'ARENA COMUN',95,1,125.00,2,3,NULL,NULL,NULL),(15,'ARENA FINA',100,1,135.00,2,3,NULL,NULL,NULL),(16,'GRAVA COMUN',100,1,135.00,2,3,NULL,NULL,NULL),(17,'CEMENTO PORTLAND',95,50,57.50,10,3,NULL,NULL,'2017-11-12 13:22:30'),(18,'PIEDRA MANZANA',100,1,120.00,2,3,NULL,NULL,NULL),(19,'MADERA DE CONTRUCCION ENCOFRADOS',100,1,7.50,4,3,NULL,NULL,NULL),(20,'CLAVOS',100,1,12.00,10,3,NULL,NULL,NULL),(21,'ALAMBRE DE AMARRE',100,1,12.00,10,3,NULL,NULL,NULL),(22,'PLASTOFORMO 1CM DE ESPESOR',100,1,7.00,3,3,NULL,NULL,NULL),(23,'LOSETA ONDULADA 10CM',100,1,2.83,1,3,NULL,NULL,NULL),(24,'ARENA PARA ENLOSETADO (CAPA BASE)',100,1,110.00,2,3,NULL,NULL,NULL),(25,'POLVILLO PARA ENLOSETADO',100,1,110.00,2,3,NULL,NULL,NULL),(26,'ALQUITRAN',100,1,12.00,10,3,NULL,NULL,NULL),(27,'ESPECIALISTA',100,1,10.00,7,2,0,'2017-11-10 19:40:29','2017-11-10 19:40:29'),(28,'AYUDANTE',100,1,11.20,7,2,0,'2017-11-10 19:48:43','2017-11-10 19:48:43'),(29,'mesas',4,10,200.00,2,3,0,'2017-11-14 21:19:58','2017-11-14 21:19:58'),(30,'MADERA',100,1,100.00,1,3,0,'2017-11-15 12:34:26','2017-11-15 12:34:26'),(31,'CAbles',100,1,1000.00,6,3,0,'2017-11-21 16:56:15','2017-11-21 16:56:15'),(32,'machimbre',5,12,100.00,1,3,0,'2017-11-21 16:56:59','2017-11-21 16:56:59'),(33,'Ladrillo',1,1,1.00,1,3,0,'2017-11-22 12:23:35','2017-11-22 12:23:35'),(34,'Obrero maestro',1,1,12.00,7,2,0,'2017-11-22 12:36:50','2017-11-22 12:36:50'),(35,'Piedra redonda',1000,1000,50.00,2,3,0,'2017-11-22 13:19:59','2017-11-22 13:19:59');

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


#
# Procedure "cerrarSalida"
#

DROP PROCEDURE IF EXISTS `cerrarSalida`;
CREATE PROCEDURE `cerrarSalida`(IN ordenSalida varchar(100), IN nombreCliente varchar(100),IN id_empresa int)
    READS SQL DATA
    BEGIN
declare totalSalida decimal(10,2);
declare idSalida int;
 set totalSalida= (SELECT sum(subTotal) FROM salida_detalles sds WHERE sds.status=0 AND sds.empresa_id=id_empresa);
 insert into salidas(nombre,total,fecha,empresa_solicitante,empresa_id)values(ordenSalida,totalSalida,DATE(NOW()),nombreCliente,id_empresa);
 set idSalida=(SELECT s.id  FROM salidas s ORDER BY s.id DESC LIMIT 1);

  update salida_detalles sds 
    set
    sds.salida_id=idSalida,
    sds.status=1 
  WHERE 
   /* sds.salida_id=null 
  AND */
     sds.status=0
  AND
     sds.empresa_id=id_empresa;

END;

#
# Procedure "salidaItem"
#

DROP PROCEDURE IF EXISTS `salidaItem`;
CREATE PROCEDURE `salidaItem`(IN item_id INT, IN cantidad INT, IN status int,IN id_empresa INT)
    READS SQL DATA
    BEGIN
declare cantidad_items int;
declare verifyExistItemSalida int;
declare precioVenta decimal(10,2);
DECLARE nombreProduct varchar(100);
/*temporal items */
create temporary table if not exists temp_item as (select * from items i where i.id=item_id);
/*set parameters of items */ 
set cantidad_items = (SELECT cantidad from temp_item);
set precioVenta = (SELECT precio_venta from temp_item);
set nombreProduct = (SELECT nombre from temp_item);
/*temporal SalidaDetalle */
create temporary table if not exists temp_salida as (select * from salida_detalles sds where sds.item_id=item_id and sds.status=0 AND sds.empresa_id=id_empresa);
set verifyExistItemSalida =(select count(id) from temp_salida);

IF cantidad_items >=cantidad then
 update items i set i.cantidad=i.cantidad-cantidad where i.id=item_id;
	IF verifyExistItemSalida = 0 then
 	insert into salida_detalles(nombre_producto,cantidad,precio_venta,item_id,subTotal,status,empresa_id) 
  VALUES (nombreProduct,cantidad,precioVenta,item_id,precioVenta*cantidad,status,id_empresa);		
  ELSE 
  UPDATE salida_detalles sde
    set 
    sde.cantidad=sde.cantidad+cantidad,
    sde.precio_venta=precioVenta,
    sde.subTotal=precioVenta*cantidad 
  WHERE sde.item_id=item_id;
  END if;
END if;
drop table if exists temp_item;
drop table if exists temp_salida;
END;

#
# Procedure "salidaItemCalculo"
#

DROP PROCEDURE IF EXISTS `salidaItemCalculo`;
CREATE PROCEDURE `salidaItemCalculo`(
  IN item_id INT,
  IN cantidad INT,
  IN status int,
  IN id_empresa int,
  IN nombreSalida varchar(100),
  IN fecha date,
  IN total decimal,
  IN empresa_salida varchar(100)
  )
    READS SQL DATA
    BEGIN
declare cantidad_items int;
DECLARE idSalida int;
declare verifyExistItemSalida int;
declare precioVenta decimal(10,2);
DECLARE nombreProduct varchar(100);
/*temporal items */
create temporary table if not exists temp_item as (select * from items i where i.id=item_id);
/*set parameters of items */ 
set cantidad_items = (SELECT cantidad from temp_item);
set precioVenta = (SELECT precio_venta from temp_item);
set nombreProduct = (SELECT nombre from temp_item);
/*Salida Master */
insert INTO salidas (nombre,total,fecha,empresa_id,empresa_solicitante)
              VALUES(nombreSalida,total,fecha,id_empresa,empresa_salida);
set idSalida=(SELECT s.id  FROM salidas s ORDER BY s.id DESC LIMIT 1);
/*temporal SalidaDetalle */
create temporary table if not exists temp_salida as (select * from salida_detalles sds where sds.item_id=item_id and sds.status=0 AND sds.empresa_id=id_empresa);
set verifyExistItemSalida =(select count(id) from temp_salida);

IF cantidad_items >=cantidad then
 update items i set i.cantidad=i.cantidad-cantidad where i.id=item_id;
	IF verifyExistItemSalida = 0 then
 	insert into salida_detalles(nombre_producto,cantidad,precio_venta,item_id,subTotal,status,empresa_id,salida_id) 
  VALUES (nombreProduct,cantidad,precioVenta,item_id,precioVenta*cantidad,status,id_empresa,idSalida);		
  ELSE 
  UPDATE salida_detalles sde
    set 
    sde.cantidad=sde.cantidad+cantidad,
    sde.precio_venta=precioVenta,
    sde.subTotal=precioVenta*cantidad,
    sde.salida_Id=idSalida
  WHERE sde.item_id=item_id;
  END if;
END if;
drop table if exists temp_item;
drop table if exists temp_salida;
END;

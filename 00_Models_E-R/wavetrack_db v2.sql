-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 18, 2016 at 10:45 AM
-- Server version: 5.1.73
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "-05:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wavetrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accesories`
--

CREATE TABLE IF NOT EXISTS `tbl_accesories` (
  `id_accesories` smallint(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(20) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(20) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_accesories`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_access_log`
--

CREATE TABLE IF NOT EXISTS `tbl_access_log` (
  `id_access_log` int(10) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) NOT NULL,
  `id_company` int(10) NOT NULL,
  `id_aclfunction` smallint(5) NOT NULL COMMENT 'campo para identificar el id del modulo al que entro',
  `access_date` datetime NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(100) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(100) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  KEY `id_acces_log` (`id_access_log`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=148872 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_aclfunction`
--

CREATE TABLE IF NOT EXISTS `tbl_aclfunction` (
  `FunctionId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id de la funcion',
  `FunctionName` varchar(255) DEFAULT NULL COMMENT 'Nombre de la Funcion',
  `ParentFunctionId` int(11) DEFAULT NULL COMMENT ' Id padre de la funcion',
  `Controller` varchar(255) DEFAULT NULL COMMENT 'Url del elemento',
  `imagen` varchar(100) NOT NULL COMMENT 'campo donde se almacena el icono del item',
  `Action` varchar(255) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL COMMENT 'indica el estado de la funcion',
  `FunctionDescription` varchar(255) DEFAULT NULL COMMENT 'Desripcion de la Funcion',
  `MenuOrder` int(11) DEFAULT NULL COMMENT 'para elementos que hacen parte del menu y queremos establecer un orden',
  `ShowInMenu` tinyint(4) DEFAULT NULL COMMENT 'si deseamos que esta funcion se visualice en el menu',
  `Linage` varchar(255) DEFAULT NULL COMMENT 'por si mas adelante queremos saber el linage de una funcion',
  `TaskId` int(11) DEFAULT NULL COMMENT 'por si esa funcion hace parte de una tarea',
  `created_by` bigint(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_from` varchar(15) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_from` varchar(15) DEFAULT NULL,
  `delete_mark` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`FunctionId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Tabla donde se va manejar la permisologia de los usuarios en' AUTO_INCREMENT=72 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_acluserfunction`
--

CREATE TABLE IF NOT EXISTS `tbl_acluserfunction` (
  `id_acluserfuntion` bigint(20) NOT NULL AUTO_INCREMENT,
  `UserId` bigint(20) DEFAULT NULL,
  `FunctionId` int(11) DEFAULT NULL,
  `Acces` tinyint(4) DEFAULT NULL COMMENT 'Para negar un padre y de ahi negar los hijos',
  `Grant` tinyint(4) DEFAULT NULL COMMENT 'Permite darle permisos al ususario a otros usuarios',
  `create_by` bigint(20) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `create_from` varchar(15) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_from` varchar(15) DEFAULT NULL,
  `delete_mark` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_acluserfuntion`),
  UNIQUE KEY `id_acluserfuntion_UNIQUE` (`id_acluserfuntion`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23858 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_agreements`
--

CREATE TABLE IF NOT EXISTS `tbl_agreements` (
  `id_agreements` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_company` int(10) DEFAULT NULL,
  `case` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `identification` int(15) NOT NULL,
  `address` varchar(50) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `agreement_start` date NOT NULL,
  `agreement_end` date NOT NULL,
  `agreement_mode` tinyint(2) NOT NULL,
  `billing_period` tinyint(2) NOT NULL,
  `collection_type` tinyint(4) NOT NULL,
  `id_plans` smallint(5) NOT NULL,
  `agreement_code` tinyint(1) NOT NULL,
  `purchase_order` tinyint(1) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_agreements`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1272 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_agreement_mode`
--

CREATE TABLE IF NOT EXISTS `tbl_agreement_mode` (
  `id_agreement_mode` tinyint(1) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_agreement_mode`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assets_history`
--

CREATE TABLE IF NOT EXISTS `tbl_assets_history` (
  `id_assets_history` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `device_identification` int(20) unsigned NOT NULL,
  `id_protocol_type` tinyint(3) unsigned NOT NULL,
  `id_report_type` smallint(5) unsigned NOT NULL,
  `source_ip` varchar(15) NOT NULL,
  `source_port` varchar(5) NOT NULL,
  `id_company` smallint(5) unsigned NOT NULL,
  `id_mobiles` bigint(20) unsigned NOT NULL,
  `timestamp` int(14) unsigned NOT NULL,
  `device_timestamp` datetime NOT NULL,
  `report_tiemestamp` datetime NOT NULL,
  `server_timestamp` datetime NOT NULL,
  `sequence_number` varchar(4) NOT NULL,
  `id_cell` int(10) unsigned NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `geometry` longblob NOT NULL,
  `altitude` smallint(5) unsigned NOT NULL,
  `heading` smallint(5) unsigned DEFAULT '0',
  `hdop` smallint(5) unsigned DEFAULT '0',
  `id_revgeo` int(10) unsigned NOT NULL,
  `revgeo` varchar(150) NOT NULL,
  `id_carrier` tinyint(3) unsigned NOT NULL,
  `antenna_status` varchar(2) DEFAULT '0',
  `device_status` varchar(2) DEFAULT '0',
  `navigation_status` varchar(2) DEFAULT '0',
  `comm_status` varchar(2) DEFAULT '0',
  `inputs_status` varchar(2) DEFAULT '0',
  `outputs_status` varchar(2) DEFAULT '0',
  `rssi` smallint(5) unsigned DEFAULT '0',
  `used_satellites` tinyint(2) unsigned DEFAULT '0',
  `location_accuracy` tinyint(3) unsigned DEFAULT '0',
  `speed` smallint(5) unsigned NOT NULL,
  `acceleration` float DEFAULT '0',
  `max_speed` smallint(5) unsigned DEFAULT '0',
  `rpm` int(10) unsigned DEFAULT '0',
  `battery_status` float DEFAULT '0',
  `travelled_distance` float DEFAULT '0',
  `hourometer` float DEFAULT '0',
  `idling_time` float DEFAULT '0',
  `stop_time` float DEFAULT '0',
  `outside_green_time` float DEFAULT '0',
  `fuel_consumption` float DEFAULT '0',
  `fuel_level` tinyint(3) unsigned DEFAULT '0',
  `inst_fuel_consumption` float DEFAULT '0',
  `coolant_temperature` float DEFAULT '0',
  `oil_temperature` float DEFAULT '0',
  `trans_temperature` float DEFAULT '0',
  `axle_temperature` float DEFAULT '0',
  `payload_temperature` float DEFAULT '0',
  `exhaust_temperature` float DEFAULT '0',
  `air_pressure` float DEFAULT '0',
  `oil_pressure` float DEFAULT '0',
  `boot_presure` float DEFAULT '0',
  `atm_pressure` float DEFAULT '0',
  `tires_pressure` float DEFAULT '0',
  `max_accelerations` float DEFAULT '0',
  `max_decelerations` float DEFAULT '0',
  `total_vehicle_hours` float DEFAULT '0',
  `total_vehicle_km` float DEFAULT '0',
  `total_vehicle_fuel` float DEFAULT '0',
  `driver_key` int(10) unsigned NOT NULL DEFAULT '0',
  `geozone_control` varchar(100) DEFAULT '0',
  `trouble_code` varchar(100) DEFAULT '0',
  `tire_control` int(10) unsigned DEFAULT '0',
  `payload_control` int(10) unsigned DEFAULT '0',
  `driving_qualification` float DEFAULT '0',
  `id_event` bigint(20) unsigned NOT NULL,
  `event_name` varchar(50) NOT NULL,
  `event_content` varchar(200) DEFAULT NULL,
  `efficiency` float DEFAULT '0',
  `created_by` bigint(20) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(15) NOT NULL,
  `modified_by` bigint(20) unsigned NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(15) NOT NULL,
  `delete_mark` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id_assets_history`,`id_company`,`id_mobiles`,`id_cell`,`driver_key`,`id_event`,`id_revgeo`,`device_identification`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_billing_period`
--

CREATE TABLE IF NOT EXISTS `tbl_billing_period` (
  `id_billing_period` tinyint(1) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_billing_period`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bua`
--

CREATE TABLE IF NOT EXISTS `tbl_bua` (
  `id_bua` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_from` varchar(45) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` varchar(45) DEFAULT NULL,
  `modified_from` varchar(45) DEFAULT NULL,
  `delete_mark` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_bua`,`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5283 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_business_unit`
--

CREATE TABLE IF NOT EXISTS `tbl_business_unit` (
  `id_business_unit` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `id_company` smallint(5) unsigned DEFAULT NULL,
  `created_by` smallint(5) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` smallint(5) unsigned NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_business_unit`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=918 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_carriers`
--

CREATE TABLE IF NOT EXISTS `tbl_carriers` (
  `id_carriers` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `MCC` smallint(5) unsigned DEFAULT NULL,
  `MNC` smallint(5) unsigned DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `name` varchar(70) DEFAULT NULL,
  `technology` varchar(70) DEFAULT NULL,
  `contact` varchar(70) DEFAULT NULL,
  `phone` varchar(70) DEFAULT NULL,
  `created_by` smallint(5) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` smallint(5) unsigned NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_carriers`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_case_log`
--

CREATE TABLE IF NOT EXISTS `tbl_case_log` (
  `id_case_log` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `id_mobiles` bigint(20) NOT NULL,
  `id_company` smallint(5) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_case_log`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cellid`
--

CREATE TABLE IF NOT EXISTS `tbl_cellid` (
  `id_cell` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_carrier` int(10) unsigned NOT NULL,
  `identification` varchar(10) NOT NULL,
  `base_station` int(10) unsigned DEFAULT NULL,
  `cell` int(10) unsigned DEFAULT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `altitude` float DEFAULT NULL,
  `true_hits` int(11) NOT NULL COMMENT 'numero de reportes enviados desde la celda',
  `false_hits` int(11) NOT NULL,
  `cell_coverange` float DEFAULT NULL COMMENT 'cobertura promedio de la celda',
  `quality_lock` tinyint(1) unsigned DEFAULT '0' COMMENT 'bloqueo manual a celdas seguras',
  `created_by` smallint(5) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` smallint(5) unsigned NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_cell`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=206913 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_collection_type`
--

CREATE TABLE IF NOT EXISTS `tbl_collection_type` (
  `id_collection_type` tinyint(1) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_collection_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_companies`
--

CREATE TABLE IF NOT EXISTS `tbl_companies` (
  `id_company` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `tax_id` bigint(15) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `id_parent` smallint(5) unsigned NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `timezone` varchar(5) DEFAULT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(70) NOT NULL,
  `website` varchar(70) DEFAULT NULL,
  `contact` varchar(70) NOT NULL,
  `fault_intervals` varchar(10) DEFAULT NULL,
  `support_mail` varchar(100) DEFAULT NULL,
  `support_name` varchar(100) NOT NULL,
  `run_driver_qualification` tinyint(1) DEFAULT NULL,
  `webservice_ip` varchar(20) NOT NULL COMMENT 'ip autorizada para ingresar al webservice',
  `webservice_last_update` datetime NOT NULL COMMENT 'ultima consulta por el web service',
  `company_status` tinyint(4) DEFAULT NULL COMMENT 'campo para identificar el estado de la compañia con relacion al crm',
  `created_by` smallint(5) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) unsigned NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_company`),
  KEY `tax_id` (`tax_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=770 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_competences`
--

CREATE TABLE IF NOT EXISTS `tbl_competences` (
  `id_competences` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `id_company` smallint(5) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` date NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  `UserId` int(11) NOT NULL COMMENT 'Id del usuario',
  `FunctionId` int(11) NOT NULL COMMENT 'Id de la funcion',
  PRIMARY KEY (`id_competences`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_country`
--

CREATE TABLE IF NOT EXISTS `tbl_country` (
  `id_country` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_from` varchar(45) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` varchar(45) DEFAULT NULL,
  `modified_from` varchar(45) DEFAULT NULL,
  `delete_mark` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_country`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=263 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_county`
--

CREATE TABLE IF NOT EXISTS `tbl_county` (
  `id_county` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `crated_from` varchar(45) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` varchar(45) DEFAULT NULL,
  `modified_from` varchar(45) DEFAULT NULL,
  `delete_mark` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_county`,`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1477 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customers`
--

CREATE TABLE IF NOT EXISTS `tbl_customers` (
  `id_customers` bigint(20) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(500) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `id_company` smallint(5) DEFAULT NULL,
  `id_identification_type` bigint(20) DEFAULT NULL,
  `identification` varchar(20) DEFAULT NULL,
  `e_identification` varchar(50) DEFAULT NULL,
  `branch_code` varchar(50) DEFAULT NULL,
  `id_distribution_zone` smallint(5) DEFAULT NULL,
  `id_commercial_zone` smallint(5) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `id_country` bigint(20) DEFAULT NULL,
  `id_state` bigint(20) DEFAULT NULL,
  `id_county` bigint(20) DEFAULT NULL,
  `id_bua` bigint(20) DEFAULT NULL,
  `id_district` bigint(20) DEFAULT NULL,
  `id_neigborhood` bigint(20) DEFAULT NULL,
  `id_geo_zone` bigint(20) NOT NULL,
  `stratum` int(10) DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `radius` float NOT NULL DEFAULT '0.01' COMMENT 'indica el radio de la geozona del cliente',
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `website` varchar(50) DEFAULT NULL,
  `id_customer_type` bigint(20) DEFAULT NULL,
  `id_customer_segment` bigint(20) DEFAULT NULL,
  `id_customer_channel` bigint(20) DEFAULT NULL,
  `id_payment_method` bigint(20) DEFAULT NULL,
  `available_credit` float DEFAULT NULL,
  `accumulated_points` int(10) DEFAULT NULL,
  `averange_consumption` float DEFAULT NULL,
  `transportation_rate` float DEFAULT '1',
  `birthday` datetime DEFAULT NULL,
  `start_window` time NOT NULL COMMENT 'inicio de laventana de atencion del cliente',
  `end_window` time NOT NULL COMMENT 'finalizacion de la ventana de atencion del cliente',
  `comments` text,
  `created_by` bigint(30) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_from` varchar(50) DEFAULT NULL,
  `modified_by` bigint(30) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_from` varchar(50) DEFAULT NULL,
  `delete_mark` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_customers`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4862 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_channel`
--

CREATE TABLE IF NOT EXISTS `tbl_customer_channel` (
  `id_customer_channel` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT 'Como se le entrega el poducto o servicio al cliente',
  `id_company` smallint(5) unsigned NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) unsigned NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_customer_channel`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_segment`
--

CREATE TABLE IF NOT EXISTS `tbl_customer_segment` (
  `id_customer_segment` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT 'Como se le vende el producto al cliente',
  `id_company` smallint(5) unsigned NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) unsigned NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_customer_segment`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_type`
--

CREATE TABLE IF NOT EXISTS `tbl_customer_type` (
  `id_customer_type` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `id_company` smallint(5) unsigned NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) unsigned NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_customer_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_depots`
--

CREATE TABLE IF NOT EXISTS `tbl_depots` (
  `id_depots` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `capacity` int(11) NOT NULL,
  `load_centers` int(11) NOT NULL,
  `id_company` smallint(5) NOT NULL,
  `start_window` time NOT NULL COMMENT 'campo para indicar el inicio de actividades',
  `end_window` time NOT NULL COMMENT 'campo para indicar la finalizacion de actividades',
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_depots`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE IF NOT EXISTS `tbl_district` (
  `id_district` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_from` varchar(45) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` varchar(45) DEFAULT NULL,
  `modified_from` varchar(45) DEFAULT NULL,
  `delete_mark` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_district`,`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5358 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_drivers`
--

CREATE TABLE IF NOT EXISTS `tbl_drivers` (
  `id_drivers` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_company` smallint(5) unsigned NOT NULL,
  `id_business_unit` smallint(5) unsigned NOT NULL,
  `id_subbusiness_unit` smallint(5) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `e_identification` int(10) unsigned NOT NULL DEFAULT '0',
  `identification` varchar(50) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `home_address` varchar(50) DEFAULT NULL,
  `driver_license_number` varchar(50) DEFAULT NULL,
  `driver_license_expiration` datetime DEFAULT NULL,
  `rh` varchar(10) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `white_list` tinyint(1) NOT NULL COMMENT 'campo para identificar que el conductor es de lista blanca',
  `black_list` tinyint(1) NOT NULL COMMENT 'campo para identificar que el conductor es de lista negra',
  `gray_list` tinyint(1) NOT NULL,
  `start_window` datetime DEFAULT NULL COMMENT 'campo para indicar el inicio de la ventana de operacion del conductor',
  `end_window` datetime DEFAULT NULL COMMENT 'campo para indicar la terminacion de la ventana de produccion del conductor',
  `id_last_mobile` varchar(45) DEFAULT '0',
  `last_update` datetime DEFAULT NULL,
  `last_report` varchar(200) DEFAULT '0',
  `last_latitude` float DEFAULT '0',
  `last_longitude` float DEFAULT '0',
  `driver_qualification` float DEFAULT '0',
  `driver_hours` int(11) unsigned DEFAULT '0',
  `driver_km` int(11) unsigned DEFAULT '0',
  `driver_fuel` float DEFAULT '0',
  `total_driver_qualification` float DEFAULT '0',
  `total_driver_hours` int(11) unsigned DEFAULT '0',
  `total_driver_km` int(11) unsigned DEFAULT '0',
  `total_driver_fuel` float DEFAULT '0',
  `created_by` bigint(20) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) unsigned NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_drivers`,`e_identification`,`id_company`,`id_business_unit`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1349876755756 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_drivers_history`
--

CREATE TABLE IF NOT EXISTS `tbl_drivers_history` (
  `id_drivers_history` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_drivers` bigint(20) unsigned NOT NULL,
  `id_mobiles` bigint(20) unsigned NOT NULL,
  `id_business_unit` smallint(5) unsigned NOT NULL,
  `id_company` smallint(5) unsigned NOT NULL,
  `timestamp` datetime DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `altitude` smallint(5) unsigned DEFAULT NULL,
  `heading` smallint(5) unsigned DEFAULT NULL,
  `speed` float DEFAULT NULL,
  `revgeo` varchar(150) DEFAULT NULL,
  `geozone_control` varchar(100) DEFAULT NULL,
  `hours` int(11) unsigned DEFAULT '0',
  `distance` int(11) unsigned DEFAULT '0',
  `fuel` float DEFAULT NULL COMMENT 'consumo en el dia',
  `total_hours` int(11) unsigned DEFAULT '0',
  `total_distance` int(11) unsigned DEFAULT '0',
  `total_fuel` float DEFAULT NULL COMMENT 'acumulado de combustible',
  `fault_time` int(10) NOT NULL DEFAULT '0' COMMENT 'campo para identificar los segundos de la falta',
  `max_speed` smallint(5) NOT NULL COMMENT 'campo para identificar la velocidad máxima de la falta',
  `id_event` bigint(20) unsigned DEFAULT NULL,
  `event_name` varchar(50) DEFAULT NULL,
  `event_content` varchar(200) DEFAULT NULL,
  `driver_qualification` float DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) unsigned NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  `id_subbusiness_unit` smallint(5) DEFAULT NULL,
  PRIMARY KEY (`id_drivers_history`,`id_drivers`,`id_mobiles`,`id_business_unit`,`id_company`) USING BTREE,
  KEY `DRIVERS` (`id_drivers`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=142613770 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_error_frame`
--

CREATE TABLE IF NOT EXISTS `tbl_error_frame` (
  `id_error_frame` tinyint(1) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_error_frame`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events`
--

CREATE TABLE IF NOT EXISTS `tbl_events` (
  `id_events` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` smallint(5) unsigned DEFAULT NULL COMMENT 'Codigo que reporta el equipo remoto',
  `name` varchar(500) DEFAULT NULL COMMENT 'Nombre del evento',
  `description` varchar(100) DEFAULT NULL COMMENT 'Descripcion funcional',
  `run_shell` tinyint(1) DEFAULT NULL COMMENT 'Activa la opcion de correr linea de comando',
  `shell_params` varchar(200) DEFAULT NULL COMMENT 'Parametros pata la linea de comandos',
  `run_email` tinyint(1) DEFAULT NULL COMMENT 'Permite enviar un correo electronico cuando acurra el evento',
  `email_params` text COMMENT 'Correos electronicos de destinatarios separados por ;',
  `run_sms` tinyint(1) DEFAULT NULL COMMENT 'Permite activar la opcion de enviar un mensaje smsm cuando ocurra el evento',
  `sms_params` varchar(200) DEFAULT NULL COMMENT 'Numero celulares separados por ;',
  `run_socket` tinyint(1) DEFAULT NULL COMMENT 'Permite enviar un mensaje TCP/IP cuando aparezca el evento',
  `socket_params` varchar(200) DEFAULT NULL COMMENT 'Descriptor de la trama',
  `run_forwarder` tinyint(1) unsigned DEFAULT NULL COMMENT 'Permite redirigir la trama original cuando aparezca el evento',
  `forwarder_params` varchar(200) DEFAULT NULL COMMENT 'Direcciones IP destino separadas por ;',
  `run_xml` tinyint(1) DEFAULT NULL COMMENT 'Permite activar la opcion de invocar un fichero XML cuando ocurra el evento',
  `xml_params` varchar(200) DEFAULT NULL COMMENT 'Descriptor de archivo XML y destino',
  `run_html` tinyint(1) DEFAULT NULL COMMENT 'Pertmite activar la opcion de invocar un servucio HTTP cuando ocurra el evento',
  `html_params` varchar(200) DEFAULT NULL COMMENT 'Descripcion del destino HTTP',
  `run_popups` tinyint(1) unsigned DEFAULT NULL COMMENT 'Permite crear un popop dinamico cunado ocurra el evento',
  `popups_params` varchar(200) DEFAULT NULL COMMENT 'Descripto XML del contenido del popop dinamico',
  `run_driver_qualification` tinyint(2) unsigned DEFAULT NULL COMMENT 'Permite activar la opcion de sumar o restar calificacion al conductor',
  `driver_qualification_params` varchar(200) DEFAULT NULL COMMENT 'Candidad positiva o negativa para conputar con la calificacion',
  `run_placeholder` tinyint(1) unsigned DEFAULT NULL COMMENT 'PErmite pasar una variable del programa al campo mensaje del GPS',
  `placeholder_params` varchar(200) DEFAULT NULL COMMENT 'Descriptor de la variable a capturar',
  `run_fault` tinyint(1) DEFAULT NULL,
  `fault_params` varchar(50) DEFAULT NULL,
  `RGB` varchar(20) DEFAULT NULL COMMENT 'Color RGB que tomara el icono si aparece el evento',
  `mailByBusiness_unit` tinyint(1) NOT NULL COMMENT 'campo para aprovar enviar los correos nada mas por division',
  `id_company` smallint(5) unsigned DEFAULT NULL,
  `id_protocol_type` tinyint(3) unsigned DEFAULT NULL,
  `id_report_type` smallint(5) unsigned DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) unsigned NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  `mailBySubBusiness_unit` int(2) DEFAULT '0',
  PRIMARY KEY (`id_events`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1350590040131 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_flevel_calibration`
--

CREATE TABLE IF NOT EXISTS `tbl_flevel_calibration` (
  `id_flevel_calibration` int(10) NOT NULL AUTO_INCREMENT,
  `id_mobiles` bigint(20) NOT NULL,
  `VOLmin` float NOT NULL DEFAULT '0' COMMENT 'campo para en volumen minimo del rango',
  `VOLmax` float NOT NULL DEFAULT '0' COMMENT 'campo para el volumen maximo del rango',
  `Vmin` float NOT NULL DEFAULT '0' COMMENT 'campo para el voltaje minimo cel rango',
  `Vmax` float NOT NULL DEFAULT '0' COMMENT 'campo para el voltaje maximo del campo',
  `m_calibration` float NOT NULL DEFAULT '0' COMMENT 'campo de pendiente de la ecuacion del cuadrante',
  `b_calibration` float NOT NULL DEFAULT '0' COMMENT 'campo del aumento en y de la ecuacion del cuadrante',
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_flevel_calibration`),
  KEY `id_mobiles` (`id_mobiles`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=457 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_icon`
--

CREATE TABLE IF NOT EXISTS `tbl_icon` (
  `id_icon` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL COMMENT 'nombre del icono',
  `size` int(11) NOT NULL COMMENT 'tamaño del icono',
  `type` varchar(20) NOT NULL COMMENT 'typo del icono',
  `image` blob NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(10) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(10) NOT NULL,
  `delete_mark` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_icon`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=119 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_identification_type`
--

CREATE TABLE IF NOT EXISTS `tbl_identification_type` (
  `id_identification_type` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `id_company` smallint(5) unsigned DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) unsigned NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_identification_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_intervention_type`
--

CREATE TABLE IF NOT EXISTS `tbl_intervention_type` (
  `id_intervention_type` smallint(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_intervention_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lmu_geozones`
--

CREATE TABLE IF NOT EXISTS `tbl_lmu_geozones` (
  `id_lmu_geozone` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_company` smallint(5) unsigned NOT NULL COMMENT 'Permite funcionamiento multicompañia',
  `name` varchar(50) NOT NULL COMMENT 'Nombre del punto o zona',
  `zone_type` smallint(5) unsigned DEFAULT NULL COMMENT '0 para punto, 1 para zona',
  `record_index` smallint(5) unsigned DEFAULT NULL COMMENT 'Posicion en la memoria flash',
  `point_type` smallint(5) unsigned DEFAULT NULL COMMENT '1 para circular, 2 para poligonal, 3 para cuadrado',
  `supergroup` smallint(5) unsigned DEFAULT NULL COMMENT 'Grupo funcional de la zona',
  `group` smallint(5) unsigned DEFAULT NULL COMMENT 'Identificado de la zona',
  `customer_code` varchar(60) NOT NULL DEFAULT '0' COMMENT 'Codigo zona en cliente',
  `radius` int(10) unsigned NOT NULL COMMENT 'Radio en metros de la zona (0 para vertices de poligonos)',
  `latitude` float NOT NULL COMMENT 'Latitud del punto (WGS84)',
  `longitude` float NOT NULL COMMENT 'Latitud del punto (WGS84)',
  `created_by` smallint(5) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` smallint(5) unsigned NOT NULL,
  `modifiedt_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_lmu_geozone`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5068 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_locations`
--

CREATE TABLE IF NOT EXISTS `tbl_locations` (
  `id_locations` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_protocol_type` tinyint(3) unsigned DEFAULT NULL,
  `id_report_type` smallint(5) unsigned DEFAULT NULL,
  `source_ip` varchar(20) DEFAULT NULL,
  `source_port` smallint(5) unsigned DEFAULT '0',
  `id_mobiles` bigint(20) unsigned NOT NULL,
  `id_company` smallint(5) unsigned NOT NULL,
  `id_business_unit` smallint(5) NOT NULL,
  `id_subbusiness_unit` smallint(5) NOT NULL,
  `dispositive_number` varchar(50) NOT NULL COMMENT 'campo paraidentificar el num,ero de l dispositivo reportando',
  `timestamp` int(14) unsigned DEFAULT NULL,
  `device_timestamp` datetime DEFAULT NULL,
  `report_timestamp` datetime DEFAULT NULL,
  `server_timestamp` datetime DEFAULT NULL,
  `sequence_number` varchar(4) DEFAULT NULL,
  `id_cell` int(10) unsigned DEFAULT NULL,
  `cell_latitude` float DEFAULT NULL,
  `cell_longitude` float DEFAULT NULL,
  `cell_altitude` smallint(5) unsigned DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `altitude` smallint(5) unsigned DEFAULT NULL,
  `heading` smallint(5) unsigned DEFAULT NULL,
  `hdop` smallint(5) unsigned DEFAULT NULL,
  `id_revgeo` int(10) unsigned DEFAULT NULL,
  `revgeo` varchar(150) DEFAULT NULL,
  `id_carrier` tinyint(3) unsigned DEFAULT NULL,
  `antena_status` varchar(15) DEFAULT NULL,
  `device_status` varchar(80) DEFAULT NULL,
  `navigation_status` varchar(50) DEFAULT NULL,
  `comm_status` varchar(50) DEFAULT NULL,
  `inputs_status` varchar(10) DEFAULT NULL,
  `output_status` varchar(10) DEFAULT NULL,
  `rssi` smallint(5) DEFAULT NULL,
  `used_satellites` tinyint(5) unsigned DEFAULT NULL,
  `location_accuracy` int(10) unsigned DEFAULT NULL,
  `speed` smallint(5) unsigned DEFAULT NULL,
  `acceleration` float DEFAULT '0',
  `max_speed` smallint(5) unsigned DEFAULT NULL,
  `revolutions_per_minute` int(10) unsigned DEFAULT NULL,
  `battery_status` float unsigned DEFAULT NULL,
  `travelled_distance` int(11) unsigned DEFAULT '0',
  `hourometer` int(11) unsigned DEFAULT '0',
  `idling_time` float unsigned DEFAULT NULL,
  `stop_time` float unsigned DEFAULT NULL,
  `outside_green_time` float unsigned DEFAULT NULL,
  `fuel_consumption` float unsigned DEFAULT NULL,
  `fuel_level` float unsigned DEFAULT '0',
  `inst_fuel_consumption` float unsigned DEFAULT '0',
  `coolant_temperature` float DEFAULT '0',
  `oil_temperature` float unsigned DEFAULT '0',
  `trans_temperature` float unsigned DEFAULT '0',
  `axle_temperature` float unsigned DEFAULT '0',
  `payload_temperature` float unsigned DEFAULT '0',
  `exhaust_temperature` float unsigned DEFAULT '0',
  `air_pressure` float unsigned DEFAULT '0',
  `oil_pressure` float unsigned DEFAULT '0',
  `boost_pressure` float unsigned DEFAULT '0',
  `atm_pressure` float unsigned DEFAULT '0',
  `tires_pressure` float unsigned DEFAULT '0',
  `max_accelerations` float unsigned DEFAULT NULL,
  `max_decelerations` float unsigned DEFAULT NULL,
  `total_vehicle_hours` int(11) unsigned DEFAULT '0',
  `total_vehicle_km` int(11) unsigned DEFAULT '0',
  `total_vehicle_fuel` float unsigned DEFAULT NULL,
  `driver_key` int(10) unsigned DEFAULT '0',
  `geozone_control` varchar(100) DEFAULT NULL,
  `trouble_code` varchar(200) DEFAULT '0',
  `tire_control` int(10) unsigned DEFAULT '0',
  `payload_control` int(10) unsigned DEFAULT '0',
  `driving_qualification` float DEFAULT '0',
  `id_event` bigint(20) unsigned DEFAULT NULL,
  `event_name` varchar(50) DEFAULT NULL,
  `event_content` varchar(200) DEFAULT NULL,
  `efficiency` float unsigned DEFAULT NULL,
  `fault_time` int(10) NOT NULL DEFAULT '0' COMMENT 'campo para identificar los tiempos de las faltas',
  `error_frame` tinyint(1) NOT NULL COMMENT 'campo para identificar si la trama contiene algun error',
  `created_by` bigint(20) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) unsigned NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id_locations`,`id_mobiles`,`id_company`,`id_business_unit`,`id_subbusiness_unit`),
  KEY `MOBILES` (`id_mobiles`) USING BTREE,
  KEY `EVENTS` (`id_event`) USING BTREE,
  KEY `mobile_timestamp` (`id_mobiles`,`device_timestamp`),
  KEY `assettimedist` (`id_mobiles`,`device_timestamp`,`hourometer`,`travelled_distance`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=485130396 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_maintenance`
--

CREATE TABLE IF NOT EXISTS `tbl_maintenance` (
  `id_maintenance` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificacion unica del objeto',
  `id_parent` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'Identificacion del conjunto de mayor nivel',
  `id_asset` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'Identificacion del vehiculo o maquina',
  `id_business_unit` bigint(20) unsigned DEFAULT '0',
  `id_company` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Identificacion de la empresa a la que hace parte el vehiculo',
  `id_maintenance_activity` bigint(20) NOT NULL COMMENT 'Indicador de actividad de mantenimiento',
  `name` varchar(255) DEFAULT '0' COMMENT 'Nombre del componente',
  `sku` varchar(50) DEFAULT '0' COMMENT 'Numero de referencia del componente',
  `process_time` int(10) unsigned DEFAULT '0' COMMENT 'Es el tiempo en segundos que se tomara para realizar este cambio',
  `spare_cost` float DEFAULT '0' COMMENT 'Costo de los componentes asociados al mantenimiento',
  `labor_cost` float DEFAULT '0' COMMENT 'Costo de la mano de obra asociada al mantenimiento',
  `date_enabled` tinyint(1) DEFAULT '0',
  `date_suggested` int(10) unsigned DEFAULT '0' COMMENT 'Numero de segundos para calcular la nueva fecha de mantenimiento',
  `date_last_maint` datetime DEFAULT '0000-00-00 00:00:00',
  `date_deadline` datetime DEFAULT NULL,
  `km_enabled` tinyint(1) DEFAULT '0',
  `km_suggested` int(11) unsigned DEFAULT '0',
  `km_last_maint` int(11) unsigned DEFAULT '0',
  `km_deadline` int(11) unsigned DEFAULT '0',
  `km_forecast` datetime DEFAULT NULL,
  `h_enabled` tinyint(1) DEFAULT '0',
  `h_suggested` int(11) unsigned DEFAULT '0',
  `h_last_maint` int(11) unsigned DEFAULT '0',
  `h_deadline` int(11) unsigned DEFAULT '0',
  `h_forecast` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'Pronostico de cuando se cumplira el limite establecido',
  `maintenance_forecast` datetime DEFAULT '0000-00-00 00:00:00',
  `id_maintenance_center` bigint(20) NOT NULL,
  `mail_30` tinyint(1) DEFAULT NULL,
  `mail_15` tinyint(1) DEFAULT NULL,
  `mail_8` tinyint(1) DEFAULT NULL,
  `alertfordays` tinyint(1) NOT NULL COMMENT 'columna de activacion de alerta por dias',
  `alertforhours` tinyint(1) NOT NULL COMMENT 'columna de activacion de alerta por horas',
  `alertforkm` tinyint(1) NOT NULL COMMENT 'columna de activacion de alerta por kilometros',
  `time_alert_days` int(11) NOT NULL COMMENT 'tiempo de envio de alerta en dias',
  `time_alert_hours` int(11) NOT NULL COMMENT 'horas para el envio de la alerta',
  `time_alert_km` int(11) NOT NULL COMMENT 'kilometros para el envio de la alerta',
  `sent_mail` tinyint(1) NOT NULL COMMENT 'validacion de si ya se envio el correo',
  `created_by` bigint(20) unsigned DEFAULT '0',
  `created_at` datetime DEFAULT '0000-00-00 00:00:00',
  `created_from` varchar(50) DEFAULT '0',
  `modified_by` bigint(20) unsigned DEFAULT '0',
  `modified_at` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_from` varchar(50) DEFAULT '0',
  `delete_mark` tinyint(1) DEFAULT '0',
  `id_subbusiness_unit` smallint(5) DEFAULT NULL,
  PRIMARY KEY (`id_maintenance`,`id_asset`,`id_company`,`id_parent`) USING BTREE,
  KEY `id_maintenance_activity` (`id_maintenance_activity`),
  KEY `id_maintenance_center` (`id_maintenance_center`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1338391059156 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_maintenance_activities`
--

CREATE TABLE IF NOT EXISTS `tbl_maintenance_activities` (
  `id_maintenance_activity` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_company` smallint(6) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(15) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(15) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_maintenance_activity`),
  KEY `id_company` (`id_company`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1451505971272 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_maintenance_centers`
--

CREATE TABLE IF NOT EXISTS `tbl_maintenance_centers` (
  `id_maintenance_center` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_company` smallint(6) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `mail` varchar(200) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(15) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(15) NOT NULL,
  `delete_mark` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_maintenance_center`),
  KEY `id_company` (`id_company`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1451505989630 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_maintenance_deleted`
--

CREATE TABLE IF NOT EXISTS `tbl_maintenance_deleted` (
  `id_maintenance_deleted` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificacion unica del objeto',
  `id_parent` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'Identificacion del conjunto de mayor nivel',
  `id_asset` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'Identificacion del vehiculo o maquina',
  `id_business_unit` bigint(20) unsigned DEFAULT '0',
  `id_company` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Identificacion de la empresa a la que hace parte el vehiculo',
  `id_maintenance_activity` bigint(20) NOT NULL COMMENT 'Indicador de actividad de mantenimiento',
  `name` varchar(255) DEFAULT '0' COMMENT 'Nombre del componente',
  `sku` varchar(50) DEFAULT '0' COMMENT 'Numero de referencia del componente',
  `process_time` int(10) unsigned DEFAULT '0' COMMENT 'Es el tiempo en segundos que se tomara para realizar este cambio',
  `spare_cost` float DEFAULT '0' COMMENT 'Costo de los componentes asociados al mantenimiento',
  `labor_cost` float DEFAULT '0' COMMENT 'Costo de la mano de obra asociada al mantenimiento',
  `date_enabled` tinyint(1) DEFAULT '0',
  `date_suggested` int(10) unsigned DEFAULT '0' COMMENT 'Numero de segundos para calcular la nueva fecha de mantenimiento',
  `date_last_maint` datetime DEFAULT '0000-00-00 00:00:00',
  `date_deadline` datetime DEFAULT NULL,
  `km_enabled` tinyint(1) DEFAULT '0',
  `km_suggested` int(10) unsigned DEFAULT '0' COMMENT 'Es el kilometraje que recomienda el fabricante para un nuevo mantenimiento',
  `km_last_maint` int(10) unsigned DEFAULT '0',
  `km_deadline` int(11) DEFAULT NULL,
  `km_forecast` datetime DEFAULT NULL,
  `h_enabled` tinyint(1) DEFAULT '0',
  `h_suggested` int(11) DEFAULT NULL,
  `h_last_maint` int(11) DEFAULT NULL,
  `h_deadline` int(10) unsigned DEFAULT '0' COMMENT 'Limite en horas para que se realice el mantenimiento',
  `h_forecast` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'Pronostico de cuando se cumplira el limite establecido',
  `maintenance_forecast` datetime DEFAULT '0000-00-00 00:00:00',
  `id_maintenance_center` bigint(20) NOT NULL,
  `mail_30` tinyint(1) DEFAULT NULL,
  `mail_15` tinyint(1) DEFAULT NULL,
  `mail_8` tinyint(1) DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT '0',
  `created_at` datetime DEFAULT '0000-00-00 00:00:00',
  `created_from` varchar(50) DEFAULT '0',
  `modified_by` bigint(20) unsigned DEFAULT '0',
  `modified_at` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_from` varchar(50) DEFAULT '0',
  `delete_mark` tinyint(1) DEFAULT '0',
  `id_subbusiness_unit` smallint(5) DEFAULT NULL,
  PRIMARY KEY (`id_maintenance_deleted`,`id_asset`,`id_company`,`id_parent`) USING BTREE,
  KEY `id_maintenance_activity` (`id_maintenance_activity`),
  KEY `id_maintenance_center` (`id_maintenance_center`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1338391059156 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_maintenance_history`
--

CREATE TABLE IF NOT EXISTS `tbl_maintenance_history` (
  `id_maintenance_history` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_maintenance` bigint(20) NOT NULL,
  `id_mobiles` bigint(20) unsigned DEFAULT NULL,
  `id_company` smallint(5) unsigned DEFAULT NULL,
  `sku` varchar(50) DEFAULT NULL,
  `process_time` int(10) unsigned DEFAULT NULL,
  `spare_cost` float DEFAULT NULL,
  `labor_cost` float DEFAULT NULL,
  `stop_cost` float DEFAULT NULL,
  `maintenance_date` datetime DEFAULT NULL,
  `maintenance_km` int(10) unsigned DEFAULT NULL,
  `maintenance_h` int(10) unsigned DEFAULT NULL,
  `id_maintenance_center` bigint(20) NOT NULL,
  `comments` text,
  `created_by` bigint(20) unsigned NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT '2010-06-10 00:00:00',
  `created_from` varchar(50) NOT NULL DEFAULT '190.84.246.133',
  `modified_by` bigint(20) unsigned NOT NULL DEFAULT '1',
  `modified_at` datetime NOT NULL DEFAULT '2010-06-10 00:00:00',
  `modified_from` varchar(50) NOT NULL DEFAULT '190.84.246.133',
  `delete_mark` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_maintenance_history`),
  KEY `id_maintenance` (`id_maintenance`),
  KEY `id_maintenance_center` (`id_maintenance_center`),
  KEY `id_company` (`id_company`),
  KEY `id_mobiles` (`id_mobiles`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=212 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mobiles`
--

CREATE TABLE IF NOT EXISTS `tbl_mobiles` (
  `id_mobiles` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_business_unit` smallint(5) unsigned NOT NULL DEFAULT '0',
  `id_subbusiness_unit` smallint(5) NOT NULL,
  `id_company` smallint(5) NOT NULL,
  `id_parent` smallint(5) NOT NULL,
  `id_agreements` bigint(20) NOT NULL,
  `id_protocol_type` tinyint(3) NOT NULL DEFAULT '0',
  `id_report_type` smallint(5) NOT NULL DEFAULT '0',
  `photo` varchar(100) DEFAULT NULL,
  `name` varchar(70) DEFAULT NULL,
  `identification` varchar(30) NOT NULL DEFAULT '',
  `imei` varchar(50) DEFAULT NULL,
  `sim_id` varchar(20) DEFAULT NULL,
  `sim_pin` varchar(20) DEFAULT NULL,
  `sim_puk` varchar(20) DEFAULT NULL,
  `sim_imsi` varchar(20) DEFAULT NULL,
  `sim_apn` varchar(50) DEFAULT NULL,
  `sim_username` varchar(50) DEFAULT NULL,
  `sim_password` varchar(50) DEFAULT NULL,
  `owner` varchar(45) DEFAULT NULL,
  `owner_name` varchar(200) DEFAULT NULL,
  `brand` varchar(20) DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL,
  `line` varchar(20) DEFAULT NULL,
  `model` varchar(20) DEFAULT NULL,
  `plate` varchar(20) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `start_window` time NOT NULL COMMENT 'campo para indicar el incio de la ventana de servicio del vehiculo',
  `end_window` time NOT NULL COMMENT 'campo para indicar la terminacion de la ventana de servicio del vehiculo',
  `id_fuel_type` smallint(5) unsigned DEFAULT NULL,
  `engine_cubic_capacity` smallint(5) unsigned DEFAULT NULL,
  `engine_horse_power` smallint(5) unsigned DEFAULT NULL,
  `km_per_litre` float unsigned DEFAULT NULL,
  `hours_per_litre` float unsigned DEFAULT NULL,
  `pulses_per_litre` float unsigned DEFAULT NULL,
  `cost_per_kilometer` float unsigned DEFAULT NULL,
  `cost_per_hour` float unsigned DEFAULT NULL,
  `cost_per_day` float DEFAULT NULL,
  `vehicle_identification_number` varchar(20) DEFAULT NULL,
  `tank_capacity` smallint(10) DEFAULT '0' COMMENT 'indica la capacidad del tanque',
  `sensor_type` tinyint(1) DEFAULT NULL COMMENT 'campo para identificar el tipo de sensor que se utiliza en el vehiculo',
  `type_tank` tinyint(1) DEFAULT NULL COMMENT 'campo para identificar el tipo de sensor que usa el vehiculo',
  `vmax_tank` smallint(10) DEFAULT NULL,
  `vmin_tank` smallint(10) DEFAULT NULL,
  `last_efficiency` float unsigned DEFAULT NULL,
  `m_distance` float DEFAULT NULL,
  `b_distance` float DEFAULT NULL,
  `r2_distance` float DEFAULT NULL,
  `m_hours` float DEFAULT NULL,
  `b_hours` float DEFAULT NULL,
  `r2_hours` float DEFAULT NULL,
  `simul_data` tinyint(1) unsigned DEFAULT NULL,
  `id_mobile_type` tinyint(3) unsigned DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `last_server_timestamp` datetime DEFAULT NULL,
  `last_carrier` varchar(20) DEFAULT NULL,
  `last_ip` varchar(20) DEFAULT NULL,
  `last_port` smallint(5) unsigned DEFAULT '0',
  `last_sequence_number` varchar(4) DEFAULT '0',
  `last_command` int(5) unsigned DEFAULT '0',
  `last_cell_latitude` float DEFAULT NULL,
  `last_cell_longitude` float DEFAULT NULL,
  `last_cell_altitude` smallint(5) unsigned DEFAULT NULL,
  `last_latitude` float DEFAULT NULL,
  `last_longitude` float DEFAULT NULL,
  `last_altitude` smallint(5) unsigned DEFAULT NULL,
  `last_heading` smallint(5) unsigned DEFAULT NULL,
  `last_hdop` smallint(5) unsigned DEFAULT NULL,
  `last_street_name` varchar(150) DEFAULT NULL,
  `last_input_status` varchar(4) DEFAULT NULL,
  `last_output_status` varchar(4) DEFAULT NULL,
  `last_navigation_status` varchar(50) DEFAULT NULL,
  `last_comm_status` varchar(50) DEFAULT NULL,
  `last_device_status` varchar(80) DEFAULT NULL,
  `last_antenna_status` varchar(15) DEFAULT NULL,
  `last_rssi` smallint(6) DEFAULT NULL,
  `last_satellites` tinyint(3) unsigned DEFAULT NULL,
  `last_location_accuracy` int(10) unsigned DEFAULT NULL,
  `last_speed` smallint(5) unsigned DEFAULT NULL,
  `last_acceleration` float DEFAULT '0',
  `last_max_speed` smallint(5) unsigned DEFAULT NULL,
  `last_revolutions_per_minute` int(10) unsigned DEFAULT NULL,
  `last_battery_status` float unsigned DEFAULT NULL,
  `last_travelled_distance` int(11) unsigned DEFAULT '0',
  `last_hourometer` int(11) unsigned DEFAULT '0',
  `partial_travelled_distance` int(11) DEFAULT '0',
  `partial_hourometer` int(11) DEFAULT '0',
  `last_idling_time` float unsigned DEFAULT NULL,
  `last_stop_time` float unsigned DEFAULT NULL,
  `last_outside_green_time` float unsigned DEFAULT NULL,
  `last_fuel_consumption` float unsigned DEFAULT NULL,
  `last_fuel_level` float unsigned DEFAULT NULL,
  `last_inst_fuel_consumption` float unsigned DEFAULT '0',
  `last_coolant_temperature` float DEFAULT NULL,
  `last_oil_temperature` float DEFAULT NULL,
  `last_trans_temperature` float DEFAULT NULL,
  `last_axle_temperature` float DEFAULT NULL,
  `last_payload_temperature` float DEFAULT NULL,
  `last_exhaust_temperature` float DEFAULT NULL,
  `last_air_pressure` float unsigned DEFAULT NULL,
  `last_oil_pressure` float unsigned DEFAULT NULL,
  `last_boost_pressure` float unsigned DEFAULT '0',
  `last_atm_pressure` float unsigned DEFAULT NULL,
  `last_tires_pressure` float unsigned DEFAULT NULL,
  `last_max_accelerations` float unsigned DEFAULT NULL,
  `last_max_decelerations` float unsigned DEFAULT NULL,
  `last_total_vehicle_hours` int(11) unsigned DEFAULT '0',
  `last_total_vehicle_km` int(11) unsigned DEFAULT '0',
  `last_total_vehicle_fuel` float unsigned DEFAULT NULL,
  `last_driver_key` int(10) unsigned DEFAULT NULL,
  `last_geozone_control` varchar(100) DEFAULT NULL,
  `last_trouble_code` varchar(100) DEFAULT NULL,
  `last_tire_control` smallint(5) unsigned DEFAULT NULL,
  `last_payload_control` varchar(50) DEFAULT NULL,
  `last_driving_qualification` float DEFAULT NULL,
  `last_event_name` varchar(50) DEFAULT NULL,
  `last_event_content` varchar(100) DEFAULT NULL,
  `desktop_icon` varchar(5) DEFAULT NULL,
  `web_icon` varchar(5) DEFAULT NULL,
  `suspension_level` tinyint(1) NOT NULL COMMENT 'el nivel de suspencion en el que se encuentra el dispositivo',
  `apportionment` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'tipo de prorrateo',
  `created_by` bigint(20) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) unsigned NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id_mobiles`,`id_company`,`id_business_unit`,`identification`,`id_agreements`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1351203695526 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mobile_support`
--

CREATE TABLE IF NOT EXISTS `tbl_mobile_support` (
  `id_mobile_support` int(10) NOT NULL AUTO_INCREMENT,
  `case` int(10) NOT NULL,
  `act_number` int(10) NOT NULL COMMENT 'campo para identificar el numero de acta que se llena fisicamente',
  `intervention_date` date NOT NULL,
  `identification` varchar(30) NOT NULL,
  `iridium` varchar(30) NOT NULL DEFAULT '0',
  `id_mobile` bigint(20) NOT NULL,
  `id_company` smallint(5) NOT NULL,
  `id_business_unit` smallint(5) NOT NULL,
  `id_subbusiness_unit` smallint(5) NOT NULL,
  `id_intervention_type` smallint(5) NOT NULL,
  `intervention_cost` float NOT NULL,
  `id_technician` smallint(5) NOT NULL,
  `observations` text NOT NULL,
  `buzer` tinyint(1) NOT NULL,
  `motor_shutdown` tinyint(1) NOT NULL,
  `ignition_on` tinyint(1) NOT NULL,
  `ignition_off` tinyint(1) NOT NULL,
  `assisted_button` tinyint(1) NOT NULL,
  `platform_report` tinyint(1) NOT NULL,
  `gps` tinyint(1) NOT NULL,
  `driver` tinyint(1) NOT NULL,
  `key_number` int(15) NOT NULL,
  `odometer_p` int(10) NOT NULL,
  `ant_status` varchar(50) NOT NULL,
  `hdop` smallint(4) NOT NULL,
  `satellites` smallint(4) NOT NULL,
  `used_satellites` tinyint(5) NOT NULL,
  `travelled_distance` float NOT NULL,
  `hourometer` float NOT NULL,
  `battery_status` float NOT NULL,
  `accesories` text NOT NULL,
  `id_city` bigint(20) NOT NULL,
  `is_manipulated` tinyint(1) NOT NULL COMMENT 'campo para identificar si el equipo fue manipulado',
  `testing` tinyint(1) NOT NULL COMMENT 'campo para identificar si las pruebas fueron exitosas o no',
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_mobile_support`),
  KEY `id_mobile` (`id_mobile`,`id_company`,`id_business_unit`,`id_subbusiness_unit`,`id_intervention_type`,`id_city`,`id_technician`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3004 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_neigborhood`
--

CREATE TABLE IF NOT EXISTS `tbl_neigborhood` (
  `id_neigborhood` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_from` varchar(45) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` varchar(45) DEFAULT NULL,
  `modified_from` varchar(45) DEFAULT NULL,
  `delete_mark` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_neigborhood`,`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14198 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_owners`
--

CREATE TABLE IF NOT EXISTS `tbl_owners` (
  `id_owners` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `identification` varchar(50) DEFAULT NULL,
  `phone` int(10) unsigned DEFAULT NULL,
  `id_company` smallint(5) unsigned NOT NULL,
  `create_by` bigint(20) unsigned NOT NULL,
  `create_at` datetime NOT NULL,
  `create_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) unsigned NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id_owners`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_method`
--

CREATE TABLE IF NOT EXISTS `tbl_payment_method` (
  `id_payment_method` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `id_company` smallint(5) unsigned NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) unsigned NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_payment_method`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_plans`
--

CREATE TABLE IF NOT EXISTS `tbl_plans` (
  `id_plans` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `cost` float NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_plans`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_poi`
--

CREATE TABLE IF NOT EXISTS `tbl_poi` (
  `id_poi` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `id_company` smallint(5) unsigned NOT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `id_poi_type` smallint(5) unsigned DEFAULT NULL,
  `id_poi_subtype` smallint(5) unsigned DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `start_service` datetime DEFAULT NULL,
  `end_service` datetime DEFAULT NULL,
  `image` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'campo para definir que el punto tienen imagen',
  `icon` varchar(50) DEFAULT NULL,
  `created_by` smallint(5) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_from` varchar(50) DEFAULT NULL,
  `modified_by` smallint(5) unsigned DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_from` varchar(50) DEFAULT NULL,
  `delete_mark` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_poi`,`id_company`),
  KEY `COMPANY` (`id_company`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1373389730396 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_poi_subtype`
--

CREATE TABLE IF NOT EXISTS `tbl_poi_subtype` (
  `id_poi_subtype` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_poi_type` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_from` varchar(50) DEFAULT NULL,
  `modified_by` bigint(20) unsigned DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_from` varchar(50) DEFAULT NULL,
  `delete_mark` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_poi_subtype`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=191 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_poi_type`
--

CREATE TABLE IF NOT EXISTS `tbl_poi_type` (
  `id_poi_type` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_from` varchar(50) DEFAULT NULL,
  `modified_by` bigint(20) unsigned DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_from` varchar(50) DEFAULT NULL,
  `delete_mark` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_poi_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_polygon_details`
--

CREATE TABLE IF NOT EXISTS `tbl_polygon_details` (
  `id_polygon_point` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_company` smallint(6) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `id_polygon_zone` bigint(20) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_from` varchar(15) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(15) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `delete_mark` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_polygon_point`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12617 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_polygon_zones`
--

CREATE TABLE IF NOT EXISTS `tbl_polygon_zones` (
  `id_polygon_zone` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_company` smallint(6) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `line_color` varchar(7) NOT NULL DEFAULT '#0000FF',
  `polygon_color` varchar(7) NOT NULL DEFAULT '#0000FF',
  `created_at` datetime NOT NULL,
  `created_from` varchar(15) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(15) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `delete_mark` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_polygon_zone`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1440866771920 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_popups`
--

CREATE TABLE IF NOT EXISTS `tbl_popups` (
  `id_popups` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_company` smallint(5) unsigned DEFAULT NULL,
  `id_business_unit` int(10) NOT NULL,
  `id_subbusiness_unit` int(10) NOT NULL,
  `content` varchar(200) DEFAULT NULL,
  `media` varchar(45) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_by` smallint(5) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(20) NOT NULL,
  `modified_by` smallint(5) unsigned NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(20) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_popups`),
  KEY `id_company` (`id_company`),
  KEY `id_business_unit` (`id_business_unit`,`id_subbusiness_unit`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=783753 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE IF NOT EXISTS `tbl_products` (
  `id_products` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `id_company` smallint(5) unsigned NOT NULL,
  `id_type_product` int(10) unsigned NOT NULL,
  `e_identification` varchar(50) NOT NULL COMMENT 'campo para la referencia interna de las compañias sobre sus productos',
  `price` double NOT NULL,
  `weight` int(20) NOT NULL,
  `volume` int(20) NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) unsigned NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_products`,`id_company`,`id_type_product`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1343237290236 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_protocoltype`
--

CREATE TABLE IF NOT EXISTS `tbl_protocoltype` (
  `id_protocol_type` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(70) DEFAULT NULL,
  `description` text,
  `created_by` smallint(5) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` smallint(5) unsigned NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_protocol_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_relation_competences`
--

CREATE TABLE IF NOT EXISTS `tbl_relation_competences` (
  `id_relation_competences` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_competence` bigint(20) NOT NULL,
  `id_resource_type` bigint(20) NOT NULL,
  `id_tasks` bigint(20) NOT NULL,
  `id_company` smallint(5) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_relation_competences`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reports_scheduler`
--

CREATE TABLE IF NOT EXISTS `tbl_reports_scheduler` (
  `id_reports_scheduler` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_report` int(10) unsigned NOT NULL,
  `frequency` int(5) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  `mail` text NOT NULL,
  `concept` text,
  `id_business_unit` int(10) unsigned DEFAULT '0',
  `id_start_event` int(10) unsigned DEFAULT NULL,
  `id_end_event` int(10) unsigned DEFAULT NULL,
  `asset_type` int(10) unsigned DEFAULT NULL,
  `id_variable` int(10) unsigned DEFAULT NULL,
  `id_company` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_from` varchar(50) DEFAULT NULL,
  `modified_by` bigint(20) unsigned DEFAULT NULL,
  `modified_from` varchar(50) DEFAULT NULL,
  `delete_mark` tinyint(1) unsigned DEFAULT NULL,
  `id_subbusiness_unit` smallint(5) DEFAULT NULL,
  PRIMARY KEY (`id_reports_scheduler`,`id_company`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reporttype`
--

CREATE TABLE IF NOT EXISTS `tbl_reporttype` (
  `id_report_type` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `name` varchar(70) NOT NULL,
  `id_protocol_type` tinyint(3) unsigned NOT NULL,
  `description` text,
  `created_by` smallint(5) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` smallint(5) unsigned NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_report_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_resource_type`
--

CREATE TABLE IF NOT EXISTS `tbl_resource_type` (
  `id_resource_type` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_company` smallint(5) NOT NULL,
  `name` varchar(150) NOT NULL,
  `cost` int(11) NOT NULL,
  `cost_per_km` int(11) NOT NULL,
  `cost_wait_time` int(11) NOT NULL,
  `cost_drive_time` int(11) NOT NULL,
  `cost_service_time` int(11) NOT NULL,
  `costo_pre_group_change` int(11) NOT NULL,
  `cost_per_subroute` int(11) NOT NULL,
  `cost_load_km` int(11) NOT NULL,
  `service_time_per_job` time NOT NULL,
  `service_time_per_demand` time NOT NULL,
  `capacities` int(11) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_resource_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_revgeo`
--

CREATE TABLE IF NOT EXISTS `tbl_revgeo` (
  `id_revgeo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `geometry` geometry NOT NULL,
  `created_by` smallint(5) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` smallint(5) unsigned NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_revgeo`) USING BTREE,
  SPATIAL KEY `geospatial` (`geometry`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=817523 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rfid_dispositives`
--

CREATE TABLE IF NOT EXISTS `tbl_rfid_dispositives` (
  `id_rfid_dispositives` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_company` int(10) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `serial` varchar(20) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `altitude` smallint(5) NOT NULL,
  `interval` time NOT NULL COMMENT 'intervalo de medición en el punto',
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(10) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(10) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_rfid_dispositives`),
  KEY `id_company` (`id_company`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales`
--

CREATE TABLE IF NOT EXISTS `tbl_sales` (
  `id_sales` bigint(30) unsigned NOT NULL AUTO_INCREMENT,
  `id_company` int(20) unsigned NOT NULL,
  `id_customer` int(20) unsigned NOT NULL,
  `id_mobile` bigint(30) unsigned NOT NULL,
  `id_driver` bigint(30) unsigned NOT NULL,
  `id_task` int(10) DEFAULT '0',
  `timestamp` varchar(45) DEFAULT NULL,
  `latitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  `revgeo` varchar(45) DEFAULT NULL,
  `net_value` double DEFAULT NULL,
  `comments` text,
  `created_by` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_from` varchar(45) NOT NULL,
  `modified_by` varchar(45) NOT NULL,
  `modified_from` varchar(45) NOT NULL,
  `modified_at` varchar(45) NOT NULL,
  `delete_mark` varchar(45) NOT NULL,
  PRIMARY KEY (`id_sales`,`id_company`,`id_mobile`,`id_customer`,`id_driver`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1325000171690 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales_details`
--

CREATE TABLE IF NOT EXISTS `tbl_sales_details` (
  `id_sales` bigint(30) unsigned NOT NULL AUTO_INCREMENT,
  `id_company` int(20) unsigned NOT NULL,
  `id_customer` int(20) NOT NULL,
  `id_mobiles` bigint(30) NOT NULL,
  `id_driver` bigint(30) unsigned NOT NULL,
  `id_task` int(20) DEFAULT NULL,
  `id_product` int(20) unsigned NOT NULL,
  `price` double NOT NULL,
  `quantity_received` double NOT NULL,
  `quantity_delivered` varchar(45) NOT NULL,
  `subtotal_line` double NOT NULL,
  `created_by` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_from` varchar(45) NOT NULL,
  `modified_by` varchar(45) NOT NULL,
  `modified_at` varchar(45) NOT NULL,
  `delete_mark` varchar(45) NOT NULL,
  PRIMARY KEY (`id_sales`,`id_company`,`id_customer`,`id_mobiles`,`id_driver`,`id_product`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales_news`
--

CREATE TABLE IF NOT EXISTS `tbl_sales_news` (
  `id_sales_new` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_company` int(20) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `id_type_new` bigint(20) unsigned NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(45) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_from` varchar(45) NOT NULL,
  `modified_at` datetime NOT NULL,
  `delete_mark` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id_sales_new`,`id_company`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1342121738019 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sensor_type`
--

CREATE TABLE IF NOT EXISTS `tbl_sensor_type` (
  `id_sensor_type` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_sensor_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='tabla para identificar los tipos de sensores que existen' AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state`
--

CREATE TABLE IF NOT EXISTS `tbl_state` (
  `id_state` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_from` varchar(45) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` varchar(45) DEFAULT NULL,
  `modified_from` varchar(45) DEFAULT NULL,
  `delete_mark` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_state`,`parent_id`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=371 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status_tasks`
--

CREATE TABLE IF NOT EXISTS `tbl_status_tasks` (
  `id_task_status` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `enable_sales` tinyint(1) NOT NULL,
  `enable_news` int(10) NOT NULL,
  `id_company` int(20) unsigned NOT NULL,
  `color` varchar(10) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) unsigned NOT NULL,
  `modified_at` varchar(50) NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id_task_status`,`id_company`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subbusiness_unit`
--

CREATE TABLE IF NOT EXISTS `tbl_subbusiness_unit` (
  `id_subbusiness_unit` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `id_company` smallint(5) unsigned DEFAULT NULL,
  `id_business_unit` smallint(5) NOT NULL,
  `created_by` smallint(5) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` smallint(5) unsigned NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_subbusiness_unit`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=160 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_suspension_level`
--

CREATE TABLE IF NOT EXISTS `tbl_suspension_level` (
  `id_suspension_level` smallint(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(20) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_suspension_level`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tasks`
--

CREATE TABLE IF NOT EXISTS `tbl_tasks` (
  `id_tasks` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_customer` bigint(20) unsigned NOT NULL,
  `id_mobile` bigint(20) unsigned NOT NULL DEFAULT '0',
  `id_drivers` bigint(20) DEFAULT NULL,
  `id_company` smallint(5) unsigned DEFAULT NULL,
  `id_tasks_type` int(11) NOT NULL COMMENT 'campo para el id del tipo de tarea',
  `reference` varchar(500) DEFAULT NULL,
  `order_task` int(11) DEFAULT NULL,
  `id_task_status` bigint(20) NOT NULL,
  `color_code` varchar(7) NOT NULL,
  `id_sales_new` bigint(20) unsigned NOT NULL,
  `comments` text,
  `service_type` varchar(50) DEFAULT NULL,
  `delivery_address` varchar(100) NOT NULL COMMENT 'direccion de entrega',
  `latitude_delivery` float NOT NULL COMMENT 'latitud de entrega',
  `longitude_delivery` float NOT NULL COMMENT 'longitud de entrega',
  `start_address` varchar(100) NOT NULL COMMENT 'direccion de inicio',
  `latitude_start` float NOT NULL COMMENT 'latitud de inicio',
  `longitude_start` float NOT NULL COMMENT 'longitud de inicio',
  `address_send` varchar(500) NOT NULL,
  `latitude_send` float NOT NULL,
  `longitude_send` float NOT NULL,
  `starting_at` datetime DEFAULT NULL,
  `forecasted_finish` datetime NOT NULL,
  `real_finish` datetime DEFAULT NULL,
  `finish_task` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'campo para indicar que la tarea ha sido finalizada',
  `geozone_by_server` tinyint(1) NOT NULL COMMENT 'campo para indicar que la tarea se va a evaluar por el servicio',
  `geozone_by_device` tinyint(1) NOT NULL COMMENT 'campo para decir que la tarea se va a evaluar por geozona',
  `last_status` varchar(50) DEFAULT NULL,
  `last_resource` varchar(50) DEFAULT NULL,
  `last_location` varchar(100) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `created_by` bigint(30) unsigned DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(100) NOT NULL,
  `delete_mark` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id_tasks`,`id_mobile`,`id_customer`,`id_task_status`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55380 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tasks_type`
--

CREATE TABLE IF NOT EXISTS `tbl_tasks_type` (
  `id_task_type` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_company` smallint(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  UNIQUE KEY `id_task_type` (`id_task_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task_details`
--

CREATE TABLE IF NOT EXISTS `tbl_task_details` (
  `id_task_details` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_task` bigint(20) NOT NULL,
  `id_products` bigint(20) NOT NULL,
  `volume` int(20) NOT NULL COMMENT 'campo para el volumen del producto',
  `price` int(11) NOT NULL COMMENT 'campo para el precio del producto',
  `weight` int(11) NOT NULL COMMENT 'campo para el peso del producto',
  `id_company` int(11) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_task_details`,`id_task`,`id_products`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52473 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task_history`
--

CREATE TABLE IF NOT EXISTS `tbl_task_history` (
  `id_task_history` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_task` int(10) unsigned NOT NULL,
  `id_task_status` int(20) unsigned NOT NULL,
  `id_task_new` int(20) unsigned DEFAULT NULL,
  `comments` text,
  `last_update` datetime DEFAULT NULL,
  `id_sales` bigint(30) DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `last_location` varchar(500) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_from` varchar(50) DEFAULT NULL,
  `modified_by` int(20) unsigned DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_from` varchar(50) DEFAULT NULL,
  `delete_mark` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_task`,`id_task_history`,`id_task_status`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_technician`
--

CREATE TABLE IF NOT EXISTS `tbl_technician` (
  `id_technician` smallint(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `identification` int(20) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_technician`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id_users` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(70) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `app_user` varchar(70) NOT NULL,
  `app_password` varchar(70) NOT NULL,
  `id_company` smallint(5) unsigned DEFAULT NULL,
  `id_business_unit` smallint(5) unsigned NOT NULL DEFAULT '0',
  `id_subbusiness_unit` smallint(5) NOT NULL,
  `last_log` datetime DEFAULT NULL,
  `id_role` smallint(5) unsigned DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) unsigned NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_users`,`app_user`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=100000000001486 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

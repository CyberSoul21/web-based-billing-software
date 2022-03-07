--
-- Base de datos: `Administrativo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_type_person`
--

CREATE TABLE IF NOT EXISTS `tbl_type_person` (
  `id_type_person` tinyint(1) NOT NULL COMMENT 'Tipo de persona Ej: 1 = Natural 2 = Jurídica',
  `name` varchar(50) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_type_person`
--
ALTER TABLE `tbl_type_person`
  ADD PRIMARY KEY (`id_type_person`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_type_person`
--
ALTER TABLE `tbl_type_person`
  MODIFY `id_type_person` tinyint(1) NOT NULL AUTO_INCREMENT COMMENT 'Tipo de persona Ej: 1 = Natural 2 = Jurídica';

  

--
-- Base de datos: `Administrativo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tariff`
--

CREATE TABLE IF NOT EXISTS `tbl_tariff` (
  `id_tariff` int(10) unsigned NOT NULL COMMENT 'Tabla la cual tendra las tarifas con los diferentes precios. Ej: Normal = 60000, la llena el usuario con un formulario y va añadiendo seún necesidades',
  `name_tariff` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `created_by` smallint(5) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `delete_mark` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_tariff`
--
ALTER TABLE `tbl_tariff`
  ADD PRIMARY KEY (`id_tariff`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_tariff`
--
ALTER TABLE `tbl_tariff`
  MODIFY `id_tariff` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Tabla la cual tendra las tarifas con los diferentes precios. Ej: Normal = 60000, la llena el usuario con un formulario y va añadiendo seún necesidades';





--
-- Base de datos: `Administrativo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_purchase_order`
--

CREATE TABLE IF NOT EXISTS `tbl_purchase_order` (
  `id_purchase_order` tinyint(1) NOT NULL COMMENT 'Orden de compra 1 = Si 2 = NO',
  `name` varchar(50) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_purchase_order`
--
ALTER TABLE `tbl_purchase_order`
  ADD PRIMARY KEY (`id_purchase_order`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_purchase_order`
--
ALTER TABLE `tbl_purchase_order`
  MODIFY `id_purchase_order` tinyint(1) NOT NULL AUTO_INCREMENT COMMENT 'Orden de compra 1 = Si 2 = NO';


--
-- Base de datos: `Administrativo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_extension`
--

CREATE TABLE IF NOT EXISTS `tbl_extension` (
  `id_extension` tinyint(1) NOT NULL COMMENT 'Prorroga 1 = Si 2 = NO',
  `name` varchar(50) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_extension`
--
ALTER TABLE `tbl_extension`
  ADD PRIMARY KEY (`id_extension`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_extension`
--
ALTER TABLE `tbl_extension`
  MODIFY `id_extension` tinyint(1) NOT NULL AUTO_INCREMENT COMMENT 'Prorroga 1 = Si 2 = NO';


--
-- Base de datos: `Administrativo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_due_date`
--

CREATE TABLE IF NOT EXISTS `tbl_due_date` (
  `id_due_date` smallint(5) NOT NULL COMMENT 'Tabla de vencimiento, contiene por ejemplo si es 15 días, 30 días, 45 días...etc.',
  `name_due_date` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `created_by` smallint(5) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `delete_mark` tinyint(1) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_due_date`
--
ALTER TABLE `tbl_due_date`
  ADD PRIMARY KEY (`id_due_date`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_due_date`
--
ALTER TABLE `tbl_due_date`
  MODIFY `id_due_date` smallint(5) NOT NULL AUTO_INCREMENT COMMENT 'Tabla de vencimiento, contiene por ejemplo si es 15 días, 30 días, 45 días...etc.';


--
-- Base de datos: `Administrativo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_billing`
--

CREATE TABLE IF NOT EXISTS `tbl_billing` (
  `id_billing` bigint(20) NOT NULL COMMENT 'Id facturación activo, único.',
  `id_servers` smallint(5) NOT NULL COMMENT 'Dato de la tabla servidores, cuando se cree el vehículo, envia id, desde que servidor fue enviado 1,2 o 3.',
  `id_mobiles` bigint(20) NOT NULL COMMENT 'Dato de la tabla mobiles, cuando se crea el vehículo envia el id asignado por tbl_mobiles a este campo.',
  `name` varchar(30) COLLATE latin1_general_ci NOT NULL COMMENT 'Dato de la tabla mobiles, cuando se crea el vehículo envia el nombre diligenciado en tbl_mobiles a este campo.',
  `identification` varchar(30) COLLATE latin1_general_ci NOT NULL COMMENT 'Dato de la tabla mobiles, cuando se crea el vehículo envia la identificación diligenciado en tbl_mobiles a este campo.',
  `sim_imsi` varchar(20) COLLATE latin1_general_ci NOT NULL COMMENT 'Dato de la tabla mobiles, cuando se crea el vehículo envia el imsi diligenciado en tbl_mobiles a este campo.',
  `id_company` smallint(5) NOT NULL COMMENT 'Dato de la tabla mobiles, cuando se crea el vehículo envia compañia a la cual esta reportando diligenciado en tbl_mobiles a este campo.',
  `suspension_level` tinyint(1) NOT NULL COMMENT 'Dato de la tabla mobiles, cuando se cambia el estado se debe actualizar automáticamente en esta tabla',
  `id_owner` bigint(20) NOT NULL DEFAULT '0' COMMENT 'Dato de la tabla contrato, que esta asociado con el código de contrato --- otra opcion es que lo diligencie el usuario, enlazando tablas propietario y compañia, que es lo que haria la tabla contratos',
  `agreement_code` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT '0' COMMENT 'Usuario diligencia campo, de la tabla contratos',
  `id_billing_period` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Usuario Ingresa dato, de la tabla billing_period',
  `time_to_billing` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '0' COMMENT 'Inicialmente que el usuario ingrese dato, pero se cambiara para que sea automático y dependa de más parametros como el contrato...etc',
  `id_plans` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT '0' COMMENT 'Información que se debe traer desde el contrato; el campo se llena en contrto y se tiiene una tabla con los planes',
  `id_tariff` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Usuario ingresa dato para cada activo, dato de la tabla tarifas.',
  `radicated` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT '0' COMMENT 'Usuario ingresa si es por medio electronico o físico, talvez creaar tabla con FISICO, ELECTRONICO',
  `id_due_date` smallint(5) NOT NULL DEFAULT '0',
  `price` bigint(20) NOT NULL DEFAULT '0' COMMENT 'Valor mensual',
  `support_name` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '0' COMMENT 'Dato desde la tabla compañias',
  `adress` varchar(45) COLLATE latin1_general_ci NOT NULL DEFAULT '0' COMMENT 'Usuario ingresa datos.',
  `case` int(10) NOT NULL DEFAULT '0' COMMENT 'Usuario ingresa dato para seguimiento del activo',
  `ip` varchar(50) NOT NULL,
  `created_by` smallint(5) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `modified_by` bigint(20) NOT NULL DEFAULT '0',
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `delete_mark` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Dato de la tabla mobiles, cuando se cambia el estado se debe actualizar automáticamente en esta tabla'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_billing`
--
ALTER TABLE `tbl_billing`
  ADD PRIMARY KEY (`id_billing`,`id_servers`,`id_mobiles`,`name`,`identification`,`sim_imsi`,`id_company`),
  ADD KEY `id_mobiles` (`id_mobiles`),
  ADD KEY `name` (`name`),
  ADD KEY `sim_imsi` (`sim_imsi`),
  ADD KEY `identification` (`identification`),
  ADD KEY `id_company` (`id_company`),
  ADD KEY `suspension_level` (`suspension_level`),
  ADD KEY `delete_mark` (`delete_mark`),
  ADD KEY `support_name` (`support_name`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_billing`
--
ALTER TABLE `tbl_billing`
  MODIFY `id_billing` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Id facturación activo, único.';



--
-- Base de datos: `Administrativo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_agreements`
--

CREATE TABLE IF NOT EXISTS `tbl_agreements` (
  `id_agreements` bigint(20) NOT NULL,
  `agreement_code` varchar(20) COLLATE latin1_general_ci NOT NULL COMMENT 'código que esta en el contrato, lo utiliza la tabla facturacion',
  `id_owner` int(10) NOT NULL COMMENT 'Este dato es traido de tbl_companies o tbl_owners dependiendo de los diferentes casos que se den, si ya existe en plataforma, o si no tiene plataforma',
  `identification` int(15) NOT NULL,
  `agreement_start` date NOT NULL,
  `agreement_end` date NOT NULL,
  `agreement_mode` tinyint(2) NOT NULL,
  `id_collection_type` tinyint(1) NOT NULL,
  `billing_period` tinyint(2) NOT NULL,
  `id_plans` smallint(5) NOT NULL COMMENT 'Dato de la tabla planes, usuario ingresa opción',
  `purchase_order` tinyint(1) NOT NULL COMMENT 'Orden de compra lo utiliza también ',
  `extension` tinyint(1) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_from` varchar(50) CHARACTER SET latin1 NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) CHARACTER SET latin1 NOT NULL,
  `delete_mark` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_agreements`
--
ALTER TABLE `tbl_agreements`
  ADD PRIMARY KEY (`id_agreements`,`id_owner`,`agreement_code`),
  ADD KEY `id_owner` (`id_owner`),
  ADD KEY `agreement_code` (`agreement_code`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_agreements`
--
ALTER TABLE `tbl_agreements`
  MODIFY `id_agreements` bigint(20) NOT NULL AUTO_INCREMENT;

  


--
-- Base de datos: `Administrativo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `owners`
--

CREATE TABLE IF NOT EXISTS `owners` (
  `id_owners` bigint(20) unsigned NOT NULL COMMENT 'Tabla donde se encuentran todas las entidades a las que se les genera factura, es decir tienen contrato....',
  `tax_id` varchar(50) NOT NULL COMMENT 'Este campo se llena con la cedula o el NIT, depende el tipo de persona',
  `name` varchar(50) NOT NULL COMMENT 'Nombre y apellido',
  `type_person` tinyint(1) unsigned NOT NULL COMMENT 'Tipo de persona Ej: 1 = Natural 2 = Jurídica',
  `address` varchar(100) NOT NULL COMMENT 'Dirección a erradicar factura',
  `phone` int(10) unsigned NOT NULL COMMENT 'Telefono celular o fijo',
  `email` varchar(70) NOT NULL COMMENT 'Correo electrónico',
  `website` varchar(70) NOT NULL COMMENT 'Sitio Web, si se tiene',
  `contact` varchar(70) NOT NULL COMMENT 'Numero de contacto, celular',
  `create_by` bigint(20) unsigned NOT NULL,
  `create_at` datetime NOT NULL,
  `create_from` varchar(50) NOT NULL,
  `modified_by` bigint(20) unsigned NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_from` varchar(50) NOT NULL,
  `delete_mark` smallint(5) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id_owners`,`tax_id`),
  ADD KEY `tax_id` (`tax_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `owners`
--
ALTER TABLE `owners`
  MODIFY `id_owners` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Tabla donde se encuentran todas las entidades a las que se les genera factura, es decir tienen contrato....';
  
  
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
  

  

  
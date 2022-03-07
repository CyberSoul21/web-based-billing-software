
--tbl_aclfunction---------------------------------
--Insersion ruta del menú
INSERT INTO `tbl_aclfunction` (`FunctionId`, `FunctionName`, `ParentFunctionId`, `Controller`, `imagen`, `Action`, `Status`, `FunctionDescription`, `MenuOrder`, `ShowInMenu`, `Linage`, `TaskId`, `created_by`, `created_at`, `created_from`, `modified_by`, `modified_at`, `modified_from`, `delete_mark`) 
VALUES (NULL, 'assets_bill', '1', '/administracion/assets_bill.php', 'money.png', NULL, '1', 'Facturar', '10', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0'),
       (NULL, 'owners', '1', '/administracion/owners.php', 'people.png', NULL, '1', 'Propietarios', '11', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0'),
	   (NULL, 'agreements', '1', '/administracion/agreements.php', 'ico_con_48.gif', NULL, '1', 'Contratos', '12', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0');
	   
	   
--tbl_acluserfunction---------------------------------
--Insersion funciones de usuario	   

INSERT INTO `tbl_acluserfunction` (`id_acluserfuntion`, `UserId`, `FunctionId`, `Acces`, `Grant`, `create_by`, `create_at`, `create_from`, `modified_by`, `modified_at`, `modified_from`, `delete_mark`) VALUES 
(NULL, '51', '10', '1', '0', '1', NOW(), '10.168.155.193', '1', NOW(), '10.168.155.193', '0'),
(NULL, '51', '11', '1', '0', '1', NOW(), '10.168.155.193', '1', NOW(), '10.168.155.193', '0'),
(NULL, '51', '12', '1', '0', '1', NOW(), '10.168.155.193', '1', NOW(), '10.168.155.193', '0');




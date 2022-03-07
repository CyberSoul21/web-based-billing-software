DELETE FROM `wavetrackAdminPlat`.`tbl_aclfunction` WHERE `FunctionName`= 'assets_bill';
DELETE FROM `wavetrackAdminPlat`.`tbl_aclfunction` WHERE `FunctionName`= 'owners';
DELETE FROM `wavetrackAdminPlat`.`tbl_aclfunction` WHERE `FunctionName`= 'agreements';


DELETE FROM `wavetrackAdminPlat`.`tbl_acluserfunction` WHERE `UserId`= '51' AND `FunctionId`= '10';
DELETE FROM `wavetrackAdminPlat`.`tbl_acluserfunction` WHERE `UserId`= '51' AND `FunctionId`= '11';
DELETE FROM `wavetrackAdminPlat`.`tbl_acluserfunction` WHERE `UserId`= '51' AND `FunctionId`= '12';
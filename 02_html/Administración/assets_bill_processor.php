<?php

//--------Archivo para consulta de datos de facturación, luego organizarlos con función "render_sql" y crear en conjunto el grid, base de datos local

require("../dhtml/dhtmlxConnector/codebase/grid_connector.php");
session_start();
if(!isset($_SESSION['id'])){
    header("location:../index.php");
}
include('../resources/credentials/wavetrack.php');
include('../resources/credentials/mysql.php');
include('../resources/credentials/source_inspector.php');

//$db_host, $db_user, $db_pass, $db_name

$res = mysql_connect($db_host, $db_user, $db_pass);
if (!$res){die('Could not connect: ' . mysql_error());}
$db_selected = mysql_select_db($db_name, $res);
if (!$db_selected){die ('Can\'t use foo : ' . mysql_error());}

if(isset($_GET['id_asset'])){$id_asset=@$_GET['id_asset'];}


        
$nivel = @$_GET['nivel'];

if($nivel=="todos"){
    $sql="SELECT b.`name` Servidor, a.`id_billing` ID, a.identification Identificacion, a.`sim_imsi` SIM, a.`name` Activo, c.`tax_id` NIT, c.`name` Propietario, a.`suspension_level` NS, a.`delete_mark` DM, a.case caso, m.`name` Estado, i.`name` Tipo_de_persona, a.`agreement_code` Contrato, h.`name` Plan, e.`name` Modo_contrato, n.`name` Prorroga, f.`name` Ciclo_Facturacion, a.`time_to_billing` Tiempo_a_Facturar, j.`name` Orden_de_Compra, g.`name` Tipo_de_Recaudo, k.`name_due_date` Vencimiento, a.radicated Radicar, c.`address` Enviar, l.`name_tariff` Tarifa, a.`price` Valor, a.support_name Soporte 
        FROM `tbl_billing` a
        LEFT JOIN `tbl_servers` b ON a.id_servers = b.id_servers
        LEFT JOIN `owners` c ON a.id_owner=c.id_owners
        LEFT JOIN `tbl_agreements` d ON a.`agreement_code`=d.`agreement_code`
        LEFT JOIN `tbl_agreement_mode` e ON d.`agreement_mode` = e.`id_agreement_mode`
        LEFT JOIN `tbl_billing_period` f ON d.`billing_period` = f.`id_billing_period`
        LEFT JOIN `tbl_collection_type` g ON d.`id_collection_type` = g.`id_collection_type`  
        LEFT JOIN `tbl_plans` h ON d.`id_plans` = h.`id_plans`
        LEFT JOIN `tbl_type_person` i ON c.`type_person` = i.`id_type_person`
        LEFT JOIN `tbl_purchase_order` j ON d.`purchase_order` = j.`id_purchase_order`
        LEFT JOIN `tbl_due_date` k ON a.`id_due_date` = k.`id_due_date`
        LEFT JOIN `tbl_tariff` l ON a.`id_tariff` = l.`id_tariff`
        LEFT JOIN `tbl_suspension_level` m ON a.`suspension_level` = m.`id_suspension_level`
        LEFT JOIN `tbl_extension` n ON d.`extension` = n.`id_extension` 
        WHERE 1";
}

if($nivel=="activo"){
    $sql="SELECT b.`name` Servidor, a.`id_billing` ID, a.identification Identificacion, a.`sim_imsi` SIM, a.`name` Activo, c.`tax_id` NIT, c.`name` Propietario, a.`suspension_level` NS, a.`delete_mark` DM, a.case caso, m.`name` Estado, i.`name` Tipo_de_persona, a.`agreement_code` Contrato, h.`name` Plan, e.`name` Modo_contrato, n.`name` Prorroga, f.`name` Ciclo_Facturacion, a.`time_to_billing` Tiempo_a_Facturar, j.`name` Orden_de_Compra, g.`name` Tipo_de_Recaudo, k.`name_due_date` Vencimiento, a.radicated Radicar, c.`address` Enviar, l.`name_tariff` Tarifa, a.`price` Valor, a.support_name Soporte 
        FROM `tbl_billing` a
        LEFT JOIN `tbl_servers` b ON a.id_servers = b.id_servers
        LEFT JOIN `owners` c ON a.id_owner=c.id_owners
        LEFT JOIN `tbl_agreements` d ON a.`agreement_code`=d.`agreement_code`
        LEFT JOIN `tbl_agreement_mode` e ON d.`agreement_mode` = e.`id_agreement_mode`
        LEFT JOIN `tbl_billing_period` f ON d.`billing_period` = f.`id_billing_period`
        LEFT JOIN `tbl_collection_type` g ON d.`id_collection_type` = g.`id_collection_type`  
        LEFT JOIN `tbl_plans` h ON d.`id_plans` = h.`id_plans`
        LEFT JOIN `tbl_type_person` i ON c.`type_person` = i.`id_type_person`
        LEFT JOIN `tbl_purchase_order` j ON d.`purchase_order` = j.`id_purchase_order`
        LEFT JOIN `tbl_due_date` k ON a.`id_due_date` = k.`id_due_date`
        LEFT JOIN `tbl_tariff` l ON a.`id_tariff` = l.`id_tariff`
        LEFT JOIN `tbl_suspension_level` m ON a.`suspension_level` = m.`id_suspension_level`
        LEFT JOIN `tbl_extension` n ON d.`extension` = n.`id_extension` 
        WHERE a.`delete_mark`= 0 OR a.`suspension_level`=0";
}
if($nivel=="suspension"){

    $sql="SELECT b.`name` Servidor, a.`id_billing` ID, a.identification Identificacion, a.`sim_imsi` SIM, a.`name` Activo, c.`tax_id` NIT, c.`name` Propietario, a.`suspension_level` NS, a.`delete_mark` DM, a.case caso, m.`name` Estado, i.`name` Tipo_de_persona, a.`agreement_code` Contrato, h.`name` Plan, e.`name` Modo_contrato, n.`name` Prorroga, f.`name` Ciclo_Facturacion, a.`time_to_billing` Tiempo_a_Facturar, j.`name` Orden_de_Compra, g.`name` Tipo_de_Recaudo, k.`name_due_date` Vencimiento, a.radicated Radicar, c.`address` Enviar, l.`name_tariff` Tarifa, a.`price` Valor, a.support_name Soporte 
        FROM `tbl_billing` a
        LEFT JOIN `tbl_servers` b ON a.id_servers = b.id_servers
        LEFT JOIN `owners` c ON a.id_owner=c.id_owners
        LEFT JOIN `tbl_agreements` d ON a.`agreement_code`=d.`agreement_code`
        LEFT JOIN `tbl_agreement_mode` e ON d.`agreement_mode` = e.`id_agreement_mode`
        LEFT JOIN `tbl_billing_period` f ON d.`billing_period` = f.`id_billing_period`
        LEFT JOIN `tbl_collection_type` g ON d.`id_collection_type` = g.`id_collection_type`  
        LEFT JOIN `tbl_plans` h ON d.`id_plans` = h.`id_plans`
        LEFT JOIN `tbl_type_person` i ON c.`type_person` = i.`id_type_person`
        LEFT JOIN `tbl_purchase_order` j ON d.`purchase_order` = j.`id_purchase_order`
        LEFT JOIN `tbl_due_date` k ON a.`id_due_date` = k.`id_due_date`
        LEFT JOIN `tbl_tariff` l ON a.`id_tariff` = l.`id_tariff`
        LEFT JOIN `tbl_suspension_level` m ON a.`suspension_level` = m.`id_suspension_level`
        LEFT JOIN `tbl_extension` n ON d.`extension` = n.`id_extension` 
        WHERE a.`delete_mark`= 2 OR a.`suspension_level`= 2 OR a.`delete_mark`= 2 OR a.`suspension_level`= 3";    
    
    
}
if($nivel=="desactivos"){
    
    $sql="SELECT b.`name` Servidor, a.`id_billing` ID, a.identification Identificacion, a.`sim_imsi` SIM, a.`name` Activo, c.`tax_id` NIT, c.`name` Propietario, a.`suspension_level` NS, a.`delete_mark` DM, a.case caso, m.`name` Estado, i.`name` Tipo_de_persona, a.`agreement_code` Contrato, h.`name` Plan, e.`name` Modo_contrato, n.`name` Prorroga, f.`name` Ciclo_Facturacion, a.`time_to_billing` Tiempo_a_Facturar, j.`name` Orden_de_Compra, g.`name` Tipo_de_Recaudo, k.`name_due_date` Vencimiento, a.radicated Radicar, c.`address` Enviar, l.`name_tariff` Tarifa, a.`price` Valor, a.support_name Soporte 
        FROM `tbl_billing` a
        LEFT JOIN `tbl_servers` b ON a.id_servers = b.id_servers
        LEFT JOIN `owners` c ON a.id_owner=c.id_owners
        LEFT JOIN `tbl_agreements` d ON a.`agreement_code`=d.`agreement_code`
        LEFT JOIN `tbl_agreement_mode` e ON d.`agreement_mode` = e.`id_agreement_mode`
        LEFT JOIN `tbl_billing_period` f ON d.`billing_period` = f.`id_billing_period`
        LEFT JOIN `tbl_collection_type` g ON d.`id_collection_type` = g.`id_collection_type`  
        LEFT JOIN `tbl_plans` h ON d.`id_plans` = h.`id_plans`
        LEFT JOIN `tbl_type_person` i ON c.`type_person` = i.`id_type_person`
        LEFT JOIN `tbl_purchase_order` j ON d.`purchase_order` = j.`id_purchase_order`
        LEFT JOIN `tbl_due_date` k ON a.`id_due_date` = k.`id_due_date`
        LEFT JOIN `tbl_tariff` l ON a.`id_tariff` = l.`id_tariff`
        LEFT JOIN `tbl_suspension_level` m ON a.`suspension_level` = m.`id_suspension_level`
        LEFT JOIN `tbl_extension` n ON d.`extension` = n.`id_extension` 
        WHERE a.`delete_mark`= 1 OR a.`suspension_level`= 1 OR a.`delete_mark`= 1 OR a.`suspension_level`= 2";    
    
}
$conn = new GridConnector($res);             //initializes the connector object
//$conn->render_table("contacts","contact_id","fname,lname,email");  //loads data}
$conn->render_sql($sql,"","Servidor, ID, Identificacion, SIM, Activo, NIT, Propietario, NS, DM, caso, Estado, Tipo_de_persona, Contrato, Plan, Modo_contrato, Prorroga, Ciclo_Facturacion, Tiempo_a_Facturar,  Orden_de_Compra, Tipo_de_Recaudo, Vencimiento, Radicar, Enviar, Tarifa, Valor, Soporte");
	

?>

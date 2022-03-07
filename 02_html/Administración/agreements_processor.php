<?php

//--------Archivo para consulta de datos del contrato, luego organizarlos con función "render_sql" y crear en conjunto el grid, base de datos local

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
        

	$conn = new GridConnector($res); 
	$conn->render_sql("SELECT a.`agreement_code` Codigo_Contrato, b.`tax_id` NIT_CC, b.`name` El_contratante, c.`name` Modo_contrato, d.`name` Tipo_de_Recaudo, e.`name` Ciclo_Facturacion, f.`name` Plan, g.`name` Orden_de_Compra, h.`name` Prorroga 
                          FROM `tbl_agreements` a 
                          LEFT JOIN `owners` b ON a.`id_owner` = b.`id_owners` 
                          LEFT JOIN `tbl_agreement_mode` c ON a.`agreement_mode` = c.`id_agreement_mode` 
                          LEFT JOIN `tbl_collection_type` d ON a.`id_collection_type` = d.`id_collection_type` 
                          LEFT JOIN `tbl_billing_period` e ON a.`billing_period` = e.`id_billing_period` 
                          LEFT JOIN `tbl_plans` f ON a.`id_plans`=f.`id_plans` 
                          LEFT JOIN `tbl_purchase_order` g ON g.`id_purchase_order`=a.`purchase_order`
                          LEFT JOIN  `tbl_extension` h ON a.`extension` = h.`id_extension`
                          WHERE 1","","Codigo_Contrato, NIT_CC, El_contratante, Modo_contrato, Tipo_de_Recaudo, Ciclo_Facturacion, Plan, Orden_de_Compra, Prorroga");


?>

<?php 

//--------Archivo para consulta de datos de propietario, luego organizarlos con función "render_sql" y crear en conjunto el grid, base de datos local

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
	$conn->render_sql("SELECT a.`tax_id` NIT_CC, a.`name` Nombre, b.`name` Tipo_de_persona, a.`address` Direccion, a.`phone` Telefono, a.`email` Email, a.`website` sitioweb 
					   FROM `owners` a LEFT JOIN `tbl_type_person` b ON a.`type_person`=b.`id_type_person` 
					   WHERE 1","","NIT_CC, Nombre, Tipo_de_persona, Direccion, Telefono, Email, sitioweb");

?>

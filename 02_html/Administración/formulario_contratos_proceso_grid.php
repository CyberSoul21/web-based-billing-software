<?php

//------------Proceso si se actualiza el contrato, formulario del grid, cuando hace doble click

	require("../dhtml/dhtmlxConnector/codebase/grid_connector.php");
	session_start();
	if(!isset($_SESSION['id'])){
		header("location:../index.php");
	}


	include('../resources/credentials/wavetrack.php');
	include('../resources/credentials/mysql.php');
	include('../resources/credentials/source_inspector.php');

//-----------conexión base de datos----------------------------------
//$db_host, $db_user, $db_pass, $db_name
	$conn = mysql_connect($db_host, $db_user, $db_pass);
	if (!$conn){die('Could not connect: ' . mysql_error());}
	$db_selected = mysql_select_db($db_name, $conn);
	if (!$db_selected){die ('Can\'t use foo : ' . mysql_error());}

	if(isset($_GET['id_asset'])){$id_asset=@$_GET['id_asset'];}
	

    if(@$_POST['action']=="actualizar"){
        
		
		//Solamente hace los cambios en BD si detecta cambios---------------------------------
        if(@$_POST['tipo_de_contrato']!=""){
            $sql3="UPDATE `tbl_agreements` SET  
            `agreement_mode` =  '".@$_POST['tipo_de_contrato']."' WHERE  `agreement_code` =  '".@$_POST['codigo']."';";
            $result3 = mysql_query($sql3) or die(mysql_error());            
        }
        if(@$_POST['tipo_de_recaudo']!=""){
            
            $sql3="UPDATE `tbl_agreements` SET  
            `id_collection_type` =  '".@$_POST['tipo_de_recaudo']."'
            WHERE  `agreement_code` =  '".@$_POST['codigo']."';";
            $result3 = mysql_query($sql3) or die(mysql_error());            
            
        }
        if(@$_POST['ciclo_de_facturacion']!=""){
            
            $sql3="UPDATE `tbl_agreements` SET  
            `billing_period` =  '".@$_POST['ciclo_de_facturacion']."'
            WHERE  `agreement_code` =  '".@$_POST['codigo']."';";
            $result3 = mysql_query($sql3) or die(mysql_error());            
        }
        if(@$_POST['plan']!=""){
            
            $sql3="UPDATE `tbl_agreements` SET  
            `id_plans` =  '".@$_POST['plan']."'
            WHERE  `agreement_code` =  '".@$_POST['codigo']."';";
            $result3 = mysql_query($sql3) or die(mysql_error());                     
        }        
        if(@$_POST['orden_de_compra']!=""){
            
            $sql3="UPDATE `tbl_agreements` SET  
            `purchase_order` =  '".@$_POST['orden_de_compra']."'
            WHERE  `agreement_code` =  '".@$_POST['codigo']."';";
            $result3 = mysql_query($sql3) or die(mysql_error());            
            
        }  
        if(@$_POST['prorroga']!=""){
            
            $sql3="UPDATE `tbl_agreements` SET  
            `extension` =  '".@$_POST['prorroga']."'
            WHERE  `agreement_code` =  '".@$_POST['codigo']."';";
            $result3 = mysql_query($sql3) or die(mysql_error());            
            
        }        
    

        /*
        $sql3="UPDATE `tbl_agreements` SET  
                `agreement_mode` =  '".@$_POST['tipo_de_contrato']."',
                `id_collection_type` =  '".@$_POST['tipo_de_recaudo']."',
                `billing_period` =  '".@$_POST['ciclo_de_facturacion']."',
                `id_plans` =  '".@$_POST['plan']."',
                `purchase_order` =  '".@$_POST['orden_de_compra']."',
                `extension` =  '".@$_POST['prorroga']."'
                WHERE  `agreement_code` =  '".@$_POST['codigo']."';";
        $result3 = mysql_query($sql3) or die(mysql_error());*/
        header("Location: ./formulario_grid_contrato.php?actualizo=1");
    }
     /*  if(@$_POST['codigo']=="1161"){
    

        

        header("Location: ./formulario_grid_contrato.php");
    }*/

    
    

?>

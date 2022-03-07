<?php

//------------Proceso si se actualiza el activo, formulario del grid, cuando hace doble click


	require("../dhtml/dhtmlxConnector/codebase/grid_connector.php");
	session_start();
	if(!isset($_SESSION['id'])){
		header("location:../index.php");
	}
	include('../resources/credentials/wavetrack.php');
	include('../resources/credentials/mysql.php');
	include('../resources/credentials/source_inspector.php');

//-------------Conexión base de datos.
//$db_host, $db_user, $db_pass, $db_name
	$conn = mysql_connect($db_host, $db_user, $db_pass);
	if (!$conn){die('Could not connect: ' . mysql_error());}
	$db_selected = mysql_select_db($db_name, $conn);
	if (!$db_selected){die ('Can\'t use foo : ' . mysql_error());}

	if(isset($_GET['id_asset'])){$id_asset=@$_GET['id_asset'];}

	$id_fp = @$_POST['id'];	
	$servidor_fp = @$_POST['servidor'];	
	$identificacion_fp = @$_POST['identificacion'];
	$activo_fp = @$_POST['activo'];
	$soporte_fp = @$_POST['soporte'];
	$ns_fp = @$_POST['ns'];
	$dm_fp = @$_POST['dm'];
	$contrato_fp = @$_POST['contrato'];
	$radicar_fp = @$_POST['radicar'];
	
	
	
	
    if(@$_POST['action']=="agregar"){
		
		if(@$_POST['radicar']=="ELECTRONICO"){
			$radica = "h.`email`";
			$radica2 = "email";
		}else{
			$radica = "h.`address`";
			$radica2 = "address";			

		};
		
		
		$contratoSql = "SELECT a.`id_agreements`, a.`id_owner`, a.`identification`, a.`agreement_mode`, b.`name` name_agreement_mode, a.`id_plans`, 
						c.`name` name_plan, a.`purchase_order`, d.`name` name_purchase_order, a.`extension`, e.`name` name_extension, a.`billing_period`, 
						f.`name` name_billing_period, a.`id_collection_type`, g.`name` name_collection, h.`name` name_owner, h.`tax_id` nit,".$radica.", h.`type_person`, i.`name` person 
						FROM `tbl_agreements` a 
						LEFT JOIN `tbl_agreement_mode` b ON a.`agreement_mode` = b.`id_agreement_mode`
						LEFT JOIN `tbl_plans` c ON a.`id_plans`= c.`id_plans`
						LEFT JOIN `tbl_purchase_order` d ON d.`id_purchase_order`= a.`purchase_order`
						LEFT JOIN `tbl_extension` e ON a.`extension` = e.`id_extension`
						LEFT JOIN `tbl_billing_period` f ON a.`billing_period` = f.`id_billing_period`
                                                LEFT JOIN `tbl_collection_type` g ON a.`id_collection_type` = g.`id_collection_type` 
						LEFT JOIN `owners` h ON a.`id_owner` = h.`id_owners`
                                                LEFT JOIN `tbl_type_person` i ON h.`type_person`= i.`id_type_person`
						WHERE a.`agreement_code`='".@$_POST['contrato']."';"; 
		
		$result = mysql_query($contratoSql) or die(mysql_error());
		while ($row = mysql_fetch_array($result)) {
			$contr[] = array($row["id_agreements"], $row["id_owner"], $row["identification"], $row["agreement_mode"], $row["name_agreement_mode"],
			$row["id_plans"],$row["name_plan"],$row["purchase_order"],$row["name_purchase_order"],$row["extension"],$row["name_extension"],$row["billing_period"],
			$row["name_billing_period"],$row["id_collection_type"],$row["name_collection"],$row["name_owner"],$row["nit"],$row[$radica2],$row["type_person"],$row["person"]);            
		}
                
        $actualizar = "UPDATE `tbl_billing` SET `id_owner`='".$contr[0][1]."',`agreement_code`='".@$_POST['contrato']."',`id_billing_period`='".$contr[0][11]."',`id_plans`='".$contr[0][5]."',`radicated`='".@$_POST['radicar']."',`adress`='".$contr[0][17]."',`modified_at`=NOW() WHERE `id_billing`='".$id_fp."'";
		$result2 = mysql_query($actualizar) or die(mysql_error());
        
//-------------------Servidor de creación------------------------------------------------------------------------------                
                $sql = "SELECT a.`ip` FROM `tbl_billing` a WHERE a.`id_billing`='".$id_fp."'";
                $result3 = mysql_query($sql) or die(mysql_error());
                while ($row2 = mysql_fetch_array($result3)){
                    $serv[]= array($row2["ip"]);
                }
                $total = mysql_num_rows($result3);
                if($total==0){
                 $y= "Esta vacia";
                }else{
                    $y= "No lo esta".$serv[0][0];
                }
                
                $sql2 = "SELECT `id_servers` FROM `tbl_servers` WHERE `ip`= '".$serv[0][0]."'";
                $result4 = mysql_query($sql2) or die("Error  ".$sql2);
                while ($row3 = mysql_fetch_array($result4)){
                    $idserv[]= array($row3["id_servers"]);
                }
                $actualizar2 = "UPDATE `tbl_billing` SET `id_servers`='".$idserv[0][0]."'WHERE `id_billing`='".$id_fp."'";
                $result5 = mysql_query($actualizar2) or die(mysql_error());

//-------------------Servidor de creación------------------------------------------------------------------------------                 
  		
		
                
		
		
		header("Location: ./formulario_grid_facturar.php?name_agreement_mode=".$contr[0][4]."&name_plan=".$contr[0][6]."&name_purchase_order=".$contr[0][8].
		"&name_extension=".$contr[0][10]."&name_billing_period=".$contr[0][12]."&name_collection=".$contr[0][14]."&contrato_fp=".$contrato_fp."&servidor_fp=".$servidor_fp."&identificacion_fp=".$identificacion_fp.
		"&activo_fp=".$activo_fp."&soporte_fp=".$soporte_fp."&ns_fp=".$ns_fp."&dm_fp=".$dm_fp."&radicar_fp=".$radicar_fp."&name_owner_fp=".$contr[0][15]."&nit_fp=".$contr[0][16].
		"&enviar_fp=".$contr[0][17]."&person_fp=".$contr[0][19]."&id_fp=".$id_fp."&cerrar=no");

    }
    if(@$_POST['action']=="guardar"){
        
        $tiempo_facturar = @$_POST['tiempo_facturar'];
        $vencimiento = @$_POST['vencimiento'];
        $tarifa = @$_POST['tarifa'];
        $valor = @$_POST['valor'];
        $caso = @$_POST['caso'];
        
		
		//Si detecta cambios realiza los cambios, esto es cuando ya esta creado, si es primera vez agrega los datos 
		if(@$_POST['tiempo_facturar']!=""){
			$guardar="UPDATE `tbl_billing` SET  
            `time_to_billing` =  '".@$_POST['tiempo_facturar']."',`modified_at`=NOW() WHERE  `id_billing` =  '".$id_fp."';";
            $result2 = mysql_query($guardar) or die(mysql_error());            
        }
		if(@$_POST['vencimiento']!=""){
			$guardar="UPDATE `tbl_billing` SET  
            `id_due_date` =  '".@$_POST['vencimiento']."',`modified_at`=NOW() WHERE  `id_billing` =  '".$id_fp."';";
            $result2 = mysql_query($guardar) or die(mysql_error());            
        }		
		if(@$_POST['tarifa']!=""){
			$guardar="UPDATE `tbl_billing` SET  
            `id_tariff` =  '".@$_POST['tarifa']."',`modified_at`=NOW() WHERE  `id_billing` =  '".$id_fp."';";
            $result2 = mysql_query($guardar) or die(mysql_error());            
        }	
		if(@$_POST['valor']!=""){
			$guardar="UPDATE `tbl_billing` SET  
            `price` =  '".@$_POST['valor']."',`modified_at`=NOW() WHERE  `id_billing` =  '".$id_fp."';";
            $result2 = mysql_query($guardar) or die(mysql_error());            
        }
		if(@$_POST['caso']!=""){
			$guardar="UPDATE `tbl_billing` SET  
            `case` =  '".@$_POST['caso']."',`modified_at`=NOW() WHERE  `id_billing` =  '".$id_fp."';";
            $result2 = mysql_query($guardar) or die(mysql_error());            
        }
		if(@$_POST['soporte']!=""){
			$guardar="UPDATE `tbl_billing` SET  
            `support_name` =  '".@$_POST['soporte']."',`modified_at`=NOW() WHERE  `id_billing` =  '".$id_fp."';";
            $result2 = mysql_query($guardar) or die(mysql_error());            
        }
		if(@$_POST['identificacion']!=""){
			$guardar="UPDATE `tbl_billing` SET  
            `identification` =  '".@$_POST['identificacion']."',`modified_at`=NOW() WHERE  `id_billing` =  '".$id_fp."';";
            $result2 = mysql_query($guardar) or die(mysql_error());            
        }
		if(@$_POST['sim']!=""){
			$guardar="UPDATE `tbl_billing` SET  
            `sim_imsi` =  '".@$_POST['sim']."',`modified_at`=NOW() WHERE  `id_billing` =  '".$id_fp."';";
            $result2 = mysql_query($guardar) or die(mysql_error());            
        }		
		
		
		
        //$guardar = "UPDATE `tbl_billing` SET `time_to_billing`='".$tiempo_facturar."',`id_due_date`='".$vencimiento."',`id_tariff`='".$tarifa."',`price`='".$valor."',`case`='".$caso."',`modified_at`=NOW() WHERE `name`='".$activo_fp."'";
	    //$result2 = mysql_query($guardar) or die(mysql_error());

        header("Location: ./formulario_grid_facturar.php?cerrar=si");        
        
        
        
    }
        
		

?>

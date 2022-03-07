<?php

//--------------Proceso para el contrato


	require("../dhtml/dhtmlxConnector/codebase/grid_connector.php");
	session_start();
	if(!isset($_SESSION['id'])){
		header("location:../index.php");
	}
	include('../resources/credentials/wavetrack.php');
	include('../resources/credentials/mysql.php');
	include('../resources/credentials/source_inspector.php');

//--------------conexiòn base de datos
//$db_host, $db_user, $db_pass, $db_name
	$conn = mysql_connect($db_host, $db_user, $db_pass);
	if (!$conn){die('Could not connect: ' . mysql_error());}
	$db_selected = mysql_select_db($db_name, $conn);
	if (!$db_selected){die ('Can\'t use foo : ' . mysql_error());}

	if(isset($_GET['id_asset'])){$id_asset=@$_GET['id_asset'];}
	
	
	
    function existe_propietario(){//Consulta Existencia de propietario
		$sql_valida="SELECT `id_owners`, `tax_id`, `name`, `address`, `phone`, `email`, `website` FROM `owners` WHERE `tax_id`=".@$_POST['nit'];
        $result = mysql_query($sql_valida) or die(mysql_error());
		$rows = mysql_num_rows($result);
        if($rows==0){
            return  "noexiste";
        }
		else{
		    return $result;			
		}		
    }

//Guarda datos cargados en el formulario para que no se pierdan cuando se vuelva a cargar el formulario, la función de carga del formulario lleva un control con las banderas
	
    $codigo_contrato_fp = @$_POST['codigo_contrato'];
    $nit_fp = @$_POST['nit'];
    $tipo_de_persona_fp = @$_POST['tipo_de_persona'];
    $tipo_de_contrato_fp = @$_POST['tipo_de_contrato'];
    $tipo_de_recaudo_fp = @$_POST['tipo_de_recaudo'];
    $ciclo_de_facturacion_fp = @$_POST['ciclo_de_facturacion'];
    $orden_de_compra_fp = @$_POST['orden_de_compra'];
    $plan_fp = @$_POST['plan'];
    $prorroga_fp = @$_POST['prorroga']; 
    
    $nombre_fp = @$_POST['nombre'];
    $apellido_fp = @$_POST['apellido'];
    $direccion_fp = @$_POST['direccion'];
    $telefono_fp = @$_POST['telefono'];
    $email_fp = @$_POST['email'];
    $sitioweb_fp = @$_POST['sitioweb'];
    
//Valida existencia de propietario, 
    if(@$_POST['action']=="validar"){
        
        $verifica = "propietario";

        //$sql_valida="SELECT `id_owners`, `tax_id`, `name`, `address`, `phone`, `email`, `website` FROM `owners` WHERE `tax_id`=".@$_POST['nit'];
        //$result = mysql_query($sql_valida) or die(mysql_error());
       
        //$rows = mysql_num_rows($result);
        
        if(existe_propietario()=="noexiste"){
            $existe = "noexiste";
        }else{
            $existe = "existe";
			$result1 = existe_propietario();
            while ($row = mysql_fetch_array($result1)) {
                $own[] = array($row["id_owners"], $row["tax_id"], $row["name"], $row["address"], $row["phone"], $row["email"], $row["website"]);
            }
            $nombre_fp = $own[0][2];
            $direccion_fp = $own[0][3];
            $telefono_fp = $own[0][4];
            $email_fp = $own[0][5];
            $sitioweb_fp = $own[0][6];            
           
        }
        header("Location: ./formulario_creacion_contrato.php?codigo_contrato_fp=".$codigo_contrato_fp."&nit_fp=".$nit_fp."&tipo_de_persona_fp=".$tipo_de_persona_fp.
        "&tipo_de_contrato_fp=".$tipo_de_contrato_fp."&tipo_de_recaudo_fp=".$tipo_de_recaudo_fp."&ciclo_de_facturacion_fp=".$ciclo_de_facturacion_fp.
        "&orden_de_compra_fp=".$orden_de_compra_fp."&plan_fp=".$plan_fp."&prorroga_fp=".$prorroga_fp."&existe=".$existe. "&nombre_fp=" .$nombre_fp.
        "&direccion_fp=" .$direccion_fp. "&telefono_fp=".$telefono_fp."&email_fp=".$email_fp."&sitioweb_fp=".$sitioweb_fp."&existe_contrato=".$existe_contrato.
        "&verifica=".$verifica);//Envia datos para que no se pierdan y dependiendo si existe o no el propietario envia datos

    }


    if(@$_POST['action']=="crear"){//Comandos para la creación de contrato
        
        $verifica = "contrato";

        $sql_existe_contrato="SELECT `agreement_code` FROM `tbl_agreements` WHERE `agreement_code`='".@$_POST['codigo_contrato']."'";
        $result2 = mysql_query($sql_existe_contrato) or die(mysql_error());
       
        $rows2 = mysql_num_rows($result2);   
        if($rows2==0){
            $existe_contrato = "noexiste";
            //insertar contrato y propietario según exista o no....
			
			if(existe_propietario()=="noexiste"){//Si no existe propietario debe ingresar los dos, contrato y propietario.
				
				$nombre_apellido = @$_POST['nombre']." ".@$_POST['apellido'];
				
				$propietario = "INSERT INTO `owners` (`id_owners`, `tax_id`, `name`, `type_person`, `address`, `phone`, `email`, `website`, `contact`, `create_by`, `create_at`, `create_from`, `modified_by`, `modified_at`, `modified_from`, `delete_mark`) 
				VALUES (NULL, '".@$_POST['nit']."', '".$nombre_apellido."', '".@$_POST['tipo_de_persona']."', '".@$_POST['direccion']."', '".@$_POST['telefono']."', '".@$_POST['email']."', '".@$_POST['sitioweb']."', '0', '10.168.155.186', NOW(), '10.168.155.186', '10.168.155.186', NOW(), '10.168.155.186', '0');";
				$result_insert = mysql_query($propietario) or die(mysql_error());

				$buscar = "SELECT `id_owners`, `tax_id` FROM owners WHERE `tax_id`='".@$_POST['nit']."';";
				$result = mysql_query($buscar) or die(mysql_error());
				while ($row = mysql_fetch_array($result)) {
					$new[] = array($row["id_owners"], $row["tax_id"]);
				}				
				$contrato = "INSERT INTO `tbl_agreements` (`id_agreements`, `agreement_code`, `id_owner`, `identification`, `agreement_start`, `agreement_end`, `agreement_mode`, `id_collection_type`, `billing_period`, `id_plans`, `purchase_order`, `extension`, `created_by`, `created_at`, `created_from`, `modified_by`, `modified_at`, `modified_from`, `delete_mark`) 
				VALUES (NULL, '".@$_POST['codigo_contrato']."', '".$new[0][0]."', '".$new[0][1]."', '0', '0', '".@$_POST['tipo_de_contrato']."', '".@$_POST['tipo_de_recaudo']."', '".@$_POST['ciclo_de_facturacion']."', '".@$_POST['plan']."', '".$orden_de_compra_fp = @$_POST['orden_de_compra']."', '".$prorroga_fp = @$_POST['prorroga']."', '10.168.155.186', NOW(), '10.168.155.186', '10.168.155.186', NOW(), '10.168.155.186', '0');";
				$result_insert = mysql_query($contrato) or die(mysql_error());
			
			}else{// Propietario existe entonces solo inserta contrato
			
				$buscar = "SELECT `id_owners`, `tax_id` FROM owners WHERE `tax_id`='".@$_POST['nit']."';";
				$result = mysql_query($buscar) or die(mysql_error());
				while ($row = mysql_fetch_array($result)) {
					$new[] = array($row["id_owners"], $row["tax_id"]);
				}				
				$contrato = "INSERT INTO `tbl_agreements` (`id_agreements`, `agreement_code`, `id_owner`, `identification`, `agreement_start`, `agreement_end`, `agreement_mode`, `id_collection_type`, `billing_period`, `id_plans`, `purchase_order`, `extension`, `created_by`, `created_at`, `created_from`, `modified_by`, `modified_at`, `modified_from`, `delete_mark`) 
				VALUES (NULL, '".@$_POST['codigo_contrato']."', '".$new[0][0]."', '".$new[0][1]."', '0', '0', '".@$_POST['tipo_de_contrato']."', '".@$_POST['tipo_de_recaudo']."', '".@$_POST['ciclo_de_facturacion']."', '".@$_POST['plan']."', '".$orden_de_compra_fp = @$_POST['orden_de_compra']."', '".$prorroga_fp = @$_POST['prorroga']."', '10.168.155.186', NOW(), '10.168.155.186', '10.168.155.186', NOW(), '10.168.155.186', '0');";
				$result_insert = mysql_query($contrato) or die(mysql_error());			
				
			}

            
            
        }else{
            $existe_contrato = "existe";
        }
        header("Location: ./formulario_creacion_contrato.php?codigo_contrato_fp=".$codigo_contrato_fp."&nit_fp=".$nit_fp."&tipo_de_persona_fp=".$tipo_de_persona_fp.
        "&tipo_de_contrato_fp=".$tipo_de_contrato_fp."&tipo_de_recaudo_fp=".$tipo_de_recaudo_fp."&ciclo_de_facturacion_fp=".$ciclo_de_facturacion_fp.
        "&orden_de_compra_fp=".$orden_de_compra_fp."&plan_fp=".$plan_fp."&prorroga_fp=".$prorroga_fp."&existe=".$existe. "&nombre_fp=" .$nombre_fp.
        "&direccion_fp=" .$direccion_fp. "&telefono_fp=".$telefono_fp."&email_fp=".$email_fp."&sitioweb_fp=".$sitioweb_fp."&existe_contrato=".$existe_contrato.
        "&verifica=".$verifica);
    }
    if(@$_POST['action']=="actualizar"){//eSTO NO SE UTILIZA, NO ŚE NI POR QUE pU*$%&"#! ESTA AQUI :V 
    
        $sql3="UPDATE `tbl_agreements` SET  
                `agreement_mode` =  '2'
                WHERE  `agreement_code` =  '1161';";
        
      /*  $sql="UPDATE `tbl_agreements` SET  
                `agreement_mode` =  '".@$_POST['tipo_de_contrato']."',
                `id_collection_type` =  '".@$_POST['tipo_de_recaudo']."',
                `billing_period` =  '".@$_POST['ciclo_de_facturacion']."',
                `id_plans` =  '".@$_POST['plan']."',
                `purchase_order` =  '".@$_POST['orden_de_compra']."',
                `extension` =  '".@$_POST['prorroga']."'
                WHERE  `agreement_code` =  '".@$_POST['codigo_contrato']."';";*/
        $result3 = mysql_query($sql3) or die(mysql_error());
        header("Location: ./formulario_grid_contrato.php");
    }
   

    
    

?>

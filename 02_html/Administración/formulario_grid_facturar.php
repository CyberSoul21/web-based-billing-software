<?php
	
//Código php, conexión, recibir variables a utilizar, método post
    
	require("../dhtml/dhtmlxConnector/codebase/grid_connector.php");
	session_start();
	if(!isset($_SESSION['id'])){
		header("location:../index.php");
	}
	include('../resources/credentials/wavetrack.php');
	include('../resources/credentials/mysql.php');
	include('../resources/credentials/source_inspector.php');
//$db_host, $db_user, $db_pass, $db_name
	$conn = mysql_connect($db_host, $db_user, $db_pass);
	if (!$conn){die('Could not connect: ' . mysql_error());}
	$db_selected = mysql_select_db($db_name, $conn);
	if (!$db_selected){die ('Can\'t use foo : ' . mysql_error());}

	if(isset($_GET['id_asset'])){$id_asset=@$_GET['id_asset'];}


    $sql = "SELECT `id_due_date`,  `name_due_date` FROM `tbl_due_date` WHERE 1";
    $result = mysql_query($sql) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $ven[] = array($row["id_due_date"], $row["name_due_date"]);            
    }
	$sql2 = "SELECT `id_tariff`,  `name_tariff` FROM `tbl_tariff` WHERE 1";
    $result2 = mysql_query($sql2) or die(mysql_error());
    while ($row = mysql_fetch_array($result2)) {
        $tar[] = array($row["id_tariff"], $row["name_tariff"]);            
    }
 	

	
    if(isset($_GET['name_agreement_mode'])){        
        $ingreso = 2;
		
		$id_grid = @$_GET['id_fp'];
		$servidor_grid = @$_GET['servidor_fp'];
		$identificacion_grid = @$_GET['identificacion_fp'];
		$sim_grid = @$_GET['sim'];		
		$activo_grid = @$_GET['activo_fp'];
		$soporte_grid = @$_GET['soporte_fp'];
		
		$propietario_grid = @$_GET['name_owner_fp'];
		$nit_grid = @$_GET['nit_fp'];
		$tipo_persona_grid = @$_GET['person_fp'];                
		$radicar_grid = @$_GET['radicar_fp'];
		$enviar_grid = @$_GET['enviar_fp'];
                
		$tipo_contrato_grid = @$_GET['name_agreement_mode'];
		$plan_grid = @$_GET['name_plan'];
		$orden_compra_grid = @$_GET['name_purchase_order']; 
		$prorroga_grid = @$_GET['name_extension'];
		$ciclo_facturacion_grid = @$_GET['name_billing_period'];
		$tipo_recaudo_grid = @$_GET['name_collection'];
		$ns_grid = @$_GET['ns_fp'];
		$dm_grid = @$_GET['dm_fp'];	
		$contrato_grid = @$_GET['contrato_fp'];
		
		
		
	}else{
                $ingreso = 1;
        $id_grid = @$_GET['id'];        
		$servidor_grid = @$_GET['servidor'];
		$identificacion_grid = @$_GET['identificacion'];
		$sim_grid = @$_GET['sim'];		
		$activo_grid = @$_GET['activo'];
		$nit_grid = @$_GET['nit'];
		$propietario_grid = @$_GET['propietario'];
		$ns_grid = @$_GET['ns'];
		$dm_grid = @$_GET['dm'];
		$caso_grid = @$_GET['caso'];
		$tipo_persona_grid = @$_GET['tipo_persona'];
		$contrato_grid = @$_GET['contrato'];
		$plan_grid = @$_GET['plan'];
		$tipo_contrato_grid = @$_GET['tipo_contrato'];
		$prorroga_grid = @$_GET['prorroga'];
		$ciclo_facturacion_grid = @$_GET['ciclo_facturacion'];
		$tiempo_facturar_grid = @$_GET['tiempo_facturar'];
		$orden_compra_grid = @$_GET['orden_compra'];   
        $tipo_recaudo_grid = @$_GET['tipo_recaudo']; 
		$vencimiento_grid = @$_GET['vencimiento'];
		$radicar_grid = @$_GET['radicar'];
		$enviar_grid = @$_GET['enviar'];
		$tarifa_grid = @$_GET['tarifa'];
		$valor_grid = @$_GET['valor'];
                $soporte_grid = @$_GET['soporte'];                
                
	}
    
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>FACTURAR</title>
    <link rel="shortcut icon" href="../resources/icons/globe.ico">
    <link rel="stylesheet" type="text/css" href="../dhtml/dhtmlxLayout/codebase/dhtmlxlayout.css">
    <link rel="stylesheet" type="text/css" href="../dhtml/dhtmlxLayout/codebase/skins/dhtmlxlayout_dhx_skyblue.css">
    <link rel="stylesheet" type="text/css" href="../dhtml/dhtmlxMenu/codebase/skins/dhtmlxmenu_dhx_skyblue.css">
    <link rel="stylesheet" type="text/css" href="../dhtml/dhtmlxToolbar/codebase/skins/dhtmlxtoolbar_dhx_skyblue.css">
    <link rel="stylesheet" type="text/css" href="../dhtml/dhtmlxGrid/codebase/dhtmlxgrid.css">
    <link rel="stylesheet" type="text/css" href="../dhtml/dhtmlxGrid/codebase/skins/dhtmlxgrid_dhx_skyblue.css">
    <link rel="STYLESHEET" type="text/css" href="../dhtml/dhtmlxWindows/codebase/dhtmlxwindows.css"> 
    <link rel="STYLESHEET" type="text/css" href="../dhtml/dhtmlxWindows/codebase/skins/dhtmlxwindows_dhx_skyblue.css">
    <link rel="stylesheet" type="text/css" href="../popups/shadowbox/shadowbox.css">
        
    <link rel="stylesheet" type="text/css" href="../dhtml/dhtmlxCalendar/codebase/dhtmlxcalendar.css">

    <script src="../dhtml/dhtmlxCalendar/codebase/dhtmlxcommon.js"></script>
    <script src="../dhtml/dhtmlxCalendar/codebase/dhtmlxcalendar.js"></script>
    <script>window.dhx_globalImgPath="../dhtml/dhtmlxCalendar/codebase/imgs/";</script> 
    
    <script src="../dhtml/dhtmlxLayout/codebase/dhtmlxcommon.js"></script>
    <script src="../dhtml/dhtmlxLayout/codebase/dhtmlxcontainer.js"></script>
    <script src="../dhtml/dhtmlxLayout/codebase/dhtmlxlayout.js"></script>
    <script src="../dhtml/dhtmlxMenu/codebase/dhtmlxcommon.js"></script>
    <script src="../dhtml/dhtmlxMenu/codebase/dhtmlxmenu.js"></script>
    <script src="../dhtml/dhtmlxMenu/codebase/ext/dhtmlxmenu_ext.js"></script>
    <script src="../dhtml/dhtmlxToolbar/codebase/dhtmlxcommon.js"></script>
    <script src="../dhtml/dhtmlxToolbar/codebase/dhtmlxtoolbar.js"></script>
    <script src="../dhtml/dhtmlxGrid/codebase/dhtmlxcommon.js"></script>
    <script src="../dhtml/dhtmlxGrid/codebase/dhtmlxgrid.js"></script>
    <script src="../dhtml/dhtmlxGrid/codebase/dhtmlxgridcell.js"></script>
    <script src="../dhtml/dhtmlxGrid/codebase/ext/dhtmlxgrid_srnd.js"></script>
    <script src="../dhtml/dhtmlxGrid/codebase/ext/dhtmlxgrid_filter.js"></script>
    <script src="../dhtml/dhtmlxGrid/codebase/ext/dhtmlxgrid_filter1.js"></script>
    <script src="../dhtml/dhtmlxGrid/codebase/ext/dhtmlxgrid_nxml.js"></script>
    <script src="../dhtml/dhtmlxGrid/codebase/grid2excel/client/dhtmlxgrid_export.js"></script>
    <script src="../dhtml/dhtmlxGrid/codebase/grid2pdf/client/dhtmlxgrid_export.js"></script>

    <script src="../dhtml/dhtmlxWindows/codebase/dhtmlxcommon.js" type="text/javascript"></script> 
    <script src="../dhtml/dhtmlxWindows/codebase/dhtmlxcontainer.js" type="text/javascript"></script> 
    <script src="../dhtml/dhtmlxWindows/codebase/dhtmlxwindows.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="../dhtml/dhtmlxForm/codebase/skins/dhtmlxform_dhx_skyblue.css">
        <script src="../dhtml/dhtmlxForm/codebase/dhtmlxcommon.js"></script>
        <script src="../dhtml/dhtmlxForm/codebase/dhtmlxform.js"></script>



    <script src="../popups/shadowbox/shadowbox.js"></script>
    <script type="text/javascript">Shadowbox.init();</script>
    <script src="../dhtml/dhtmlxDataProcessor/codebase/dhtmlxdataprocessor.js"></script>
    <style> html, body {width: 100%;height: 100%;margin: 0px;overflow: hidden;}</style>
    
    
           
            <style> 
                html, body {background-color:#FFF ;width: 100%; height: 100%; margin: 0px; overflow: hidden;} 
                td {font-family:Tahoma, Geneva, sans-serif;font-size:11px}
                .label_table{width:80px;}
                .btn_style{cursor:pointer;font-family: Arial, Helvetica, sans-serif;font-size: 12px;
                           color: #666666;;border: 1px solid #CCCCCC;height: 25px;width: 110px;
                           background-image: url(../resources/icons/btnsend.jpg);background-position:bottom;
                           background-repeat: repeat-x;background-color: #FFFFFF;}
                .input_text{width:280px;border:#a4bed4 solid thin}
            </style>
            <script type="text/javascript">
				//Aquí van las funciones}
                function agregar_contrato(){
                    if(document.form_facturar_grid.radicar.value == ''||document.form_facturar_grid.contrato.value == ''){
                      alert("El campo RADICAR y Código de contrato deben de estar diligenciados");  
                    }else{
                        if(confirm('Se actualizaran la información del activo ¿Continuar?')){
                            document.form_facturar_grid.action.value = "agregar";                        
                            document.form_facturar_grid.submit();
                            //parent.dhxWins.window("w1").close(); 
                        }            
                        
                    }
 						
		}
                function guardar_contrato(){
                    /*if(document.form_facturar_grid.tiempo_facturar.value == ''||document.form_facturar_grid.vencimiento.value == ''||
                       document.form_facturar_grid.tarifa.value == ''||document.form_facturar_grid.valor.value == ''||
                       document.form_facturar_grid.caso.value == ''||"<?php echo($tiempo_facturar_grid);?>"==""||"<?php echo($vencimiento_grid);?>"==""||
					   "<?php echo($tarifa_grid);?>"==""||"<?php echo($caso_grid);?>"==""||"<?php echo($valor_grid);?>"==""){
                   
                       alert("Diligencie todos los campos obligatorios *");
                        
                    }*/
					if("<?php echo($tiempo_facturar_grid);?>"==""||"<?php echo($vencimiento_grid);?>"==""||
					   "<?php echo($tarifa_grid);?>"==""||"<?php echo($caso_grid);?>"==""||"<?php echo($valor_grid);?>"==""){
						
						if(document.form_facturar_grid.tiempo_facturar.value == ''||document.form_facturar_grid.vencimiento.value == ''||
							document.form_facturar_grid.tarifa.value == ''||document.form_facturar_grid.valor.value == ''||
							document.form_facturar_grid.caso.value == ''){                   
								
								alert("Diligencie todos los campos obligatorios *");
                        }
						else{
							if(confirm('Se guardara la información del activo ¿Continuar?')){
								document.form_facturar_grid.action.value = "guardar";                        
								document.form_facturar_grid.submit();
								//parent.dhxWins.window("w1").close(); 
							}                        
						}						
                 
                    }					
					else{
                        if(confirm('Se guardara la información del activo ¿Continuar?')){
                            document.form_facturar_grid.action.value = "guardar";                        
                            document.form_facturar_grid.submit();
                            //parent.dhxWins.window("w1").close(); 
                        }                        
                    }
                }
                function cancelar_grid(){

                    parent.dhxWins.window("w1").close(); 
                             
                }                
                function myFunction(){

                    if("<?php echo($_GET['cerrar']);?>"=="si"){
                        parent.dhxWins.window("w1").close();
                    }

                }
                
                mCal = new dhtmlxCalendarObject("calInput1");   
                mCal.draw();
            </script>





</head>

<body onload="myFunction();">

    <div class="scroll">
        <form name="form_facturar_grid" id ="id_form" action="formulario_facturar_proceso_grid.php" method="post" >
            <table><tr><td style="font-size: 16pt; ">Activo</td><td></td><td><img src="../resources/money.png" align="top" /></td></tr></table>
             <table>
                    <tr>
                            <td rowspan="3" colspan="3">
                                <table>
                                    <tr>
                                        <td class="label_table">Activo:</td>
                                        <td class="label_table">Identificación:</td>
                                        <td class="label_table">SIM:</td>										
                                        <td class="label_table">*Código de Contrato:</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="input_text" type="text" name="activo" id="id_activo"  value="<?php echo($activo_grid);?>"/>
											<input name="id" value="<?php echo($id_grid);?>" type="hidden"/>
                                        </td>										

                                        <td>
                                            <input class="input_text" type="text" name='identificacion' id="id_idenificacion" value="<?php echo($identificacion_grid);?>" style="background-color:#58ACFA"/>
                                            
                                        </td>
                                        <td>
                                            <input class="input_text" type="text" name='sim' id="id_sim" value="<?php echo($sim_grid);?>" style="background-color:#58ACFA"/>
                                            
                                        </td>										
                                        <td>
                                            <input class="input_text" type="text" name="contrato" id="id_contrato" style="width:280px;font-family:Tahoma, Geneva, sans-serif;background-color:#58ACFA;font-size:11px;border:#a4bed4 solid thin" value="<?php echo($contrato_grid);?>"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="label_table">Servidor:</td>										
                                        <td class="label_table">Propietario:</td>                                        
                                        <td class="label_table">NIT/CC:</td>
                                        <td class="label_table">Tipo De Persona:</td>


                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="input_text" type="text" name="servidor" id="id_servidor"  value="<?php echo($servidor_grid);?>"/>
											<input name="action" value="" type="hidden"/>
										</td>										
                                        <td>
                                            <input class="input_text" type="text" name="propietario" id="id_propietario"  value="<?php echo($propietario_grid);?>"/>
                                        </td>
                                        <td>
                                            <input class="input_text" type="text" name="nit" id="id_codigo_contrato"  value="<?php echo($nit_grid);?>"/>
                                        </td>
                                        <td>
                                            <input class="input_text" type="text" name="tipo_persona" id="id_tipo_persona"  value="<?php echo($tipo_persona_grid);?>"/>
                                        </td>
                                       
                                    </tr>
                                    <tr>
                                        <td class="label_table">Modo Contrato:</td>                                        
                                        <td class="label_table">Plan:</td>
                                        <td class="label_table">Orden De Compra:</td>
                                        <td class="label_table">Enviar:</td>										

                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="input_text" type="text" name="tipo_contrato" id="id_tipo_contrato"  value="<?php echo($tipo_contrato_grid);?>"/>
                                        </td>
                                        <td>
                                            <input class="input_text" type="text" name="plan" id="id_plan"  value="<?php echo($plan_grid);?>"/>
                                        </td>
                                        <td>
                                            <input class="input_text" type="text" name="orden_compra" id="id_orden_compa"  value="<?php echo($orden_compra_grid);?>"/>											
                                        </td>
                                        <td>
                                            <input class="input_text" type="text" name="enviar" id="id_enviar"  value="<?php echo($enviar_grid);?>"/>
                                        </td> 										
                                      
                                    </tr>
                                    <tr>
                                        <td class="label_table">Prorroga:</td>                                        
                                        <td class="label_table">Ciclo Facturación:</td>
									    <td class="label_table">Tipo De Recaudo:</td>
                                        <td class="label_table">*Radicar:</td>										
 
                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="input_text" type="text" name="prorroga" id="id_prorroga"  value="<?php echo($prorroga_grid);?>"/>											
                                        </td> 
                                        <td>
                                            <input class="input_text" type="text" name="ciclo_facturacion" id="id_ciclo_facturacion"  value="<?php echo($ciclo_facturacion_grid);?>"/>											
                                        </td> 

                                        <td>
                                            <input class="input_text" type="text" name="tipo_recaudo" id="id_tipo_recaudo"  value="<?php echo($tipo_recaudo_grid);?>"/>											
                                        </td> 
                                        <td>
											<select name="radicar" id="id_radicar" style="width:280px;font-family:Tahoma, Geneva, sans-serif;background-color:#58ACFA;font-size:11px;border:#a4bed4 solid thin" >
                                                <option value="<?php echo($radicar_grid);?>"><?php echo($radicar_grid);?></option>
                                                <option value="FISICO">FISICO</option>
                                                <option value="ELECTRONICO">ELECTRONICO</option>
											</select>												
                                        </td> 										
                                    </tr>
                                    <tr>
                                        <td class="label_table">*Vencimiento:</td>										
                                        <td class="label_table">*Tiempo a Facturar:</td>										
                                        <td class="label_table">*Tarifa:</td>                                        
                                        <td class="label_table">*Valor:</td>
                                  
 
                                    </tr>
                                    <tr>
                                        <td>
                                            <select name="vencimiento" id="id_vencimiento" style="width:280px;font-family:Tahoma, Geneva, sans-serif;background-color:#F5DA81;font-size:11px;border:#a4bed4 solid thin" >
                                                <?php
                                                    echo("<option value=''>" .$vencimiento_grid. "</option>");
                                                    for ($i = 0; $i < count($ven); $i++){
														echo("<option value='" . $ven[$i][0] . "'>" . $ven[$i][1] . "</option>");
                                                    }                        
                                               ?>
                                            </select> 											
                                        </td>  										
                                        <td>
                                            <!--<input class="input_text" type="text" name="tiempo_facturar" id="id_tiempo_facturar"  value="<?php echo($tiempo_facturar_grid);?>"/>-->										
                                            <input class="input_text" type="text" name="tiempo_facturar" id="calInput1"  value="<?php echo($tiempo_facturar_grid);?>" style="background-color:#F5DA81"/>
                                        </td> 										
                                        <td>
                                            <select name="tarifa" id="id_tarifa" style="width:280px;font-family:Tahoma, Geneva, sans-serif;background-color:#F5DA81;font-size:11px;border:#a4bed4 solid thin" >
                                                <?php
                                                    echo("<option value=''>" .$tarifa_grid. "</option>");
                                                    for ($i = 0; $i < count($tar); $i++){
														echo("<option value='" . $tar[$i][0] . "'>" . $tar[$i][1] . "</option>");
                                                    }                        
                                               ?>
                                            </select> 											
                                        </td> 
                                        <td>
                                            <input class="input_text" type="text" name="valor" id="id_valor"  value="<?php echo($valor_grid);?>" style="background-color:#F5DA81"/>											
                                        </td> 
                                        
                                    </tr>
                                    <tr>
                                        <td class="label_table">*Caso:</td>											
                                        <td class="label_table">Ingeniero De Soporte:</td>  														
                                        <td class="label_table">Nivel suspensión:</td>                                        
                                        <td class="label_table">Delete Mark:</td>
                                    </tr> 
                                   
                                    <tr>
                                        <td>
                                            <input class="input_text" type="text" name="caso" id="id_caso"  value="<?php echo($caso_grid);?>" style="background-color:#F5DA81"/>											
                                        </td> 										
                                        <td>
                                            <input class="input_text" type="text" name="soporte" id="id_soporte"  value="<?php echo($soporte_grid);?>" style="background-color:#F5DA81"/>											
                                        </td>  																			
                                        <td>
                                            <input class="input_text" type="text" name="ns" id="id_ns"  value="<?php echo($ns_grid);?>"/>											
                                        </td> 
                                        <td>
                                            <input class="input_text" type="text" name="dm" id="id_dm"  value="<?php echo($dm_grid);?>"/>											
                                        </td> 
                                        
                                    </tr>
                                    <tr>
                                        <td>
                                            <input  name="guardar" class="btn_style" type="button" id="id_cancelar" value="Guardar Datos" onclick="guardar_contrato();"/>
                                        </td>    
                                        <td>
                                            <input  name="cancelar" class="btn_style" type="button" id="id_cancelar" value="Cancelar" onclick="cancelar_grid();"/>
                                        </td>
                                        <td>
                                            <input  name="agregar" class="btn_style" type="button" id="id_cancelar" value="Agregar Contrato"  onclick="agregar_contrato();"/>
                                        </td> 										
                                        
                                    </tr>
                                    </tr>

                                </table>
                            </td>
                    </tr>

             </table>
             
		</form>
        
        
    </div>
  <script>
      mCal = new dhtmlxCalendarObject("calInput1");   
      mCal.draw();
  </script>    


</body>
</html>

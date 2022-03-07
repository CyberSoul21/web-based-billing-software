<?php
		//include ("../data/formulario_contratos_proceso.php");


	require("../dhtml/dhtmlxConnector/codebase/grid_connector.php");
	session_start();
	if(!isset($_SESSION['id'])){
		header("location:../index.php");
	}
	include('../resources/credentials/wavetrack.php');
	include('../resources/credentials/mysql.php');
	include('../resources/credentials/source_inspector.php');

//---------------Conexiòn Base de Datos--------------------------------------------
//$db_host, $db_user, $db_pass, $db_name
	$conn = mysql_connect($db_host, $db_user, $db_pass);
	if (!$conn){die('Could not connect: ' . mysql_error());}
	$db_selected = mysql_select_db($db_name, $conn);
	if (!$db_selected){die ('Can\'t use foo : ' . mysql_error());}

	if(isset($_GET['id_asset'])){$id_asset=@$_GET['id_asset'];}
	
//---------------Realiza consulta de todos los datos a mostrar en el formulario-------------	
	
    $sql = "SELECT `id_type_person`,  `name` FROM `tbl_type_person` WHERE 1";//Para selección de tipo de persona
    $result = mysql_query($sql) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $pers[] = array($row["id_type_person"], $row["name"]);
            
    }
    $sql2 = "SELECT `id_agreement_mode`,  `name` FROM `tbl_agreement_mode` WHERE 1";//Para selección de Modo de contrato
    $result2 = mysql_query($sql2) or die(mysql_error());
    while ($row2 = mysql_fetch_array($result2)) {
        $contr[] = array($row2["id_agreement_mode"], $row2["name"]);
            
    }
    $sql3 = "SELECT `id_collection_type`,  `name` FROM `tbl_collection_type` WHERE 1";//Para selección de modo de recaudo
    $result3 = mysql_query($sql3) or die(mysql_error());
    while ($row3 = mysql_fetch_array($result3)) {
        $coll[] = array($row3["id_collection_type"], $row3["name"]);
            
    }
    $sql4 = "SELECT `id_billing_period`,  `name` FROM `tbl_billing_period` WHERE 1";//Para selección de tiempo a facturar
    $result4 = mysql_query($sql4) or die(mysql_error());
    while ($row4 = mysql_fetch_array($result4)) {
        $cyc[] = array($row4["id_billing_period"], $row4["name"]);
            
    }

    $sql5 = "SELECT `id_purchase_order`,  `name` FROM `tbl_purchase_order` WHERE 1";//Para selección de oden de compra
    $result5 = mysql_query($sql5) or die(mysql_error());
    while ($row5 = mysql_fetch_array($result5)) {
        $purch[] = array($row5["id_purchase_order"], $row5["name"]);
            
    }         
    
    $sql6 = "SELECT `id_plans`,  `name` FROM `tbl_plans` WHERE 1";//Para selección de planes
    $result6 = mysql_query($sql6) or die(mysql_error());
    while ($row6 = mysql_fetch_array($result6)) {
        $plan[] = array($row6["id_plans"], $row6["name"]);
            
    }
    $sql7 = "SELECT `id_purchase_order`,  `name` FROM `tbl_purchase_order` WHERE 1";//Para selección de prorroga como solo es Si o No
    $result7 = mysql_query($sql7) or die(mysql_error());
    while ($row7 = mysql_fetch_array($result7)) {
        $ext[] = array($row7["id_purchase_order"], $row7["name"]);
    }

//---------------Finaliza consulta de todos los datos a mostrar en el formulario-----------------



    $habilita_propietario="disabled";//Bandera que habilita casillas en el formulario
    $habilita_crear="disabled";
    
	
	if(isset($_GET['nit_fp'])){ //Si la variable nit_fp ha sido inicializada, esto cuando se cuelve a llamar el formulario desde el proceso
		
		$valor_codigo_contrato = $_GET['codigo_contrato_fp'];
		$valor_nit = $_GET['nit_fp'];
		$valor_tipo_de_persona = $_GET['tipo_de_persona_fp'];
		$valor_tipo_de_contrato = $_GET['tipo_de_contrato_fp'];
		$valor_tipo_de_recaudo = $_GET['tipo_de_recaudo_fp'];
		$valor_ciclo_de_facturacion = $_GET['ciclo_de_facturacion_fp'];
		$valor_orden_de_compra = $_GET['orden_de_compra_fp'];
		$valor_plan = $_GET['plan_fp'];
		$valor_prorroga = $_GET['prorroga_fp'];
                
                $valor_nombre = $_GET['nombre_fp'];
                $valor_direccion = $_GET['direccion_fp'];
                $valor_telefono = $_GET['telefono_fp'];
                $valor_email = $_GET['email_fp'];
                $valor_sitioweb = $_GET['sitioweb_fp'];                
                
                $ingreso ="2";
                $habilita_crear="able";
                if($_GET['existe']=="noexiste"){//Verificación si propietario existe, si, No existe habilita casillas para diligenciar formulario de datos de propietario 
                        
                        $habilita_propietario="able";
                    }else{//De lo contrario imprime datos de propietario existente en el formulario
                        
                        $habilita_propietario="disabled";
                        
                        $valor_nombre = $_GET['nombre_fp'];
                        $valor_direccion = $_GET['direccion_fp'];
                        $valor_telefono = $_GET['telefono_fp'];
                        $valor_email = $_GET['email_fp'];
                        $valor_sitioweb = $_GET['sitioweb_fp'];
                        
                    }
                    
	}else{/* Entra la primera vez */
                $ingreso ="1";//Bandera de ingreso 
		$codigo_contrato = "";
		$valor_nit = "";
		$valor_tipo_de_persona = "";
		$valor_tipo_de_contrato = "";
		$valor_tipo_de_recaudo = "";
		$valor_ciclo_de_facturacion = "";
		$valor_orden_de_compra = "";
		$valor_plan = "";
		$valor_prorroga = "";
                $valor_nombre = "";
                $valor_apellido = "";
                $valor_direccion = "";
                $valor_telefono = "";
                $valor_email = "";
                $valor_sitioweb = "";
	}
  	
	
 	
//Termina php
    
?>

<!--Llamado Librerias de DHTMLX-->	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Creación de contrato</title>
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

<!--FIN Llamado Librerias de DHTMLX-->	

    <script src="../popups/shadowbox/shadowbox.js"></script>
    <script type="text/javascript">Shadowbox.init();</script>
    <script src="../dhtml/dhtmlxDataProcessor/codebase/dhtmlxdataprocessor.js"></script>
    <style> html, body {width: 100%;height: 100%;margin: 0px;overflow: hidden;}</style>
    
    
           
            <style> 
                html, body {background-color:#FFF ;width: 100%; height: 100%; margin: 0px; overflow: hidden;} 
                td {font-family:Tahoma, Geneva, sans-serif;font-size:11px}
                .label_table{width:80px;}
                .btn_style{cursor:pointer;font-family: Arial, Helvetica, sans-serif;font-size: 12px;
                           color: #666666;;border: 1px solid #CCCCCC;height: 25px;width: 80px;
                           background-image: url(../resources/icons/btnsend.jpg);background-position:bottom;
                           background-repeat: repeat-x;background-color: #FFFFFF;}
                .input_text{width:280px;border:#a4bed4 solid thin}
            </style>
            <script type="text/javascript">
               
                function crear_contrato(){//Funcion para crear contrato, pero antes verifica que todos los campos esten diligenciados.
                    if (document.form_contract.nit.value == '' || document.form_contract.codigo_contrato.value == '' ||
                        document.form_contract.tipo_de_persona.value == '' || document.form_contract.tipo_de_contrato.value == '' ||
						document.form_contract.tipo_de_recaudo.value == '' || document.form_contract.ciclo_de_facturacion.value == '' || 
						document.form_contract.orden_de_compra.value == '' || document.form_contract.plan.value == '' || 
						document.form_contract.prorroga.value == '') {
                        alert("Debe diligenciar todos los campos del contrato");
                    }else{
						document.form_contract.action.value = "crear";
						document.form_contract.submit();	
					}                    
                }
                function existe(){//Función para verificar si ya existe propietario
                    if (document.form_contract.nit.value == '') {
                        alert("El campo NIT/CC no puede estar vacio");
                    }else{
						document.form_contract.action.value = "validar";
						document.form_contract.submit();		
					}					
                    

                }

                function cancelar_registro(){//Cierra ventana, no almacena nada
					
					if (confirm('Si cancela perdera los datos digitados ¿Desea cancelar?')){ 
						parent.dhxWins.window("w1").close(); 
					}		 
                    
                    //alert("Cancelar");
					
                    //document.form_contract.action.value = "cancelar";
                    //document.form_contract.submit();
                             
                }                
                function myFunction(){//Funcion de carga cuando inicializa formulaario

                    if("<?php echo($ingreso);?>"=="2" && "<?php echo($_GET['existe']);?>"=="noexiste" && "<?php echo($_GET['verifica']);?>"=="propietario"){
                        alert("Popietario no existe, ingresar datos para completar formulario");
                    }
                    else if("<?php echo($ingreso);?>"=="2" && "<?php echo($_GET['existe']);?>"=="existe" && "<?php echo($_GET['verifica']);?>"=="propietario"){
                        alert("Propietario ya existe");
                    }
                    if("<?php echo($ingreso);?>"=="2" && "<?php echo($_GET['existe_contrato']);?>"=="existe" && "<?php echo($_GET['verifica']);?>"=="contrato"){
                        alert("El contrato: <?php echo($_GET['codigo_contrato_fp']);?> ya existe");
                    }
                    else if("<?php echo($ingreso);?>"=="2" && "<?php echo($_GET['existe_contrato']);?>"=="noexiste" && "<?php echo($_GET['verifica']);?>"=="contrato"){
                        alert("Contrato Creado con exito");
						parent.dhxWins.window("w1").close(); 
                    }
                }
            </script>





</head>

<body onload="myFunction();">

    <div class="scroll">
        <form name="form_contract" id ="id_form" action="formulario_contratos_proceso.php" method="post" >
            <table><tr><td style="font-size: 16pt; ">Nuevo Contrato</td><td></td><td><img src="../resources/icons/ico_con_48.gif" align="top" /></td></tr></table>
             <table>
                    <tr>
                            <td rowspan="3" colspan="3">
                                <table>
                                    <tr>
                                        <td class="label_table">Código de Contrato:</td>
                                        <td class="label_table">NIT/CC:</td>
                                        <td class="label_table">Tipo de Persona:</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="input_text" type="text" name="codigo_contrato" id="id_codigo_contrato"  value="<?php echo($valor_codigo_contrato);?>"/>
                                        </td>
                                        <td>
                                            <input class="input_text" type="text" name='nit' id="id_nit" value="<?php echo($valor_nit);?>"/>
                                            <input name="action" value="" type="hidden"/>
                                        </td>
                                        <td>
                                            <select name="tipo_de_persona" id="tipo_de_persona" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" >
                                                <?php
													
                                                    if(isset($_GET['tipo_de_persona_fp'])){
                                                            $valor_tipo_de_persona2 = (int)$valor_tipo_de_persona -1;
                                                            echo("<option value='" .$valor_tipo_de_persona. "'>" . $pers[$valor_tipo_de_persona2][1] . "</option>");
                                                            for ($i = 0; $i < count($pers); $i++){
                                                                    echo("<option value='" . $pers[$i][0] . "'>" . $pers[$i][1] . "</option>");
                                                            }														
                                                    }
                                                    else{
                                                            echo("<option value='" .$valor_tipo_de_persona. "'>" .$valor_tipo_de_persona. "</option>");
                                                            for ($i = 0; $i < count($pers); $i++){
                                                                    echo("<option value='" . $pers[$i][0] . "'>" . $pers[$i][1] . "</option>");
                                                            }
                                                    }
                                                ?>
                                            </select>    
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="label_table">Tipo de contrato:</td>                                        
                                        <td class="label_table">Tipo De Recaudo:</td>
                                        <td class="label_table">Ciclo De Facturación:</td>


                                    </tr>
                                    <tr>
                                        <td>
                                            <select name="tipo_de_contrato" id="tipo_de_contrato" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" >
                                                <?php
                                                   if(isset($_GET['tipo_de_contrato_fp'])){
                                                            $valor_tipo_de_contrato2 = (int)$valor_tipo_de_contrato -1;
                                                            echo("<option value='" .$valor_tipo_de_contrato. "'>" . $contr[$valor_tipo_de_contrato2][1] . "</option>");
                                                            for ($i = 0; $i < count($contr); $i++){
                                                                    echo("<option value='" . $contr[$i][0] . "'>" . $contr[$i][1] . "</option>");
                                                            }														
                                                    }
                                                    else{
                                                            echo("<option value='" .$valor_tipo_de_contrato. "'>" .$valor_tipo_de_contrato. "</option>");
                                                            for ($i = 0; $i < count($contr); $i++){
                                                                    echo("<option value='" . $contr[$i][0] . "'>" . $contr[$i][1] . "</option>");
                                                            }
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="tipo_de_recaudo" id="tipo_de_recaudo" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" >
                                                <?php
													
                                                if(isset($_GET['tipo_de_recaudo_fp'])){
                                                        $valor_tipo_de_recaudo2 = (int)$valor_tipo_de_recaudo -1;
                                                        echo("<option value='" .$valor_tipo_de_recaudo. "'>" . $coll[$valor_tipo_de_recaudo2][1] . "</option>");
                                                        for ($i = 0; $i < count($coll); $i++){
                                                                echo("<option value='" . $coll[$i][0] . "'>" . $coll[$i][1] . "</option>");
                                                        }														
                                                }
                                                else{
                                                        echo("<option value='" .$valor_tipo_de_recaudo. "'>" .$valor_tipo_de_recaudo. "</option>");
                                                        for ($i = 0; $i < count($coll); $i++){
                                                                echo("<option value='" . $coll[$i][0] . "'>" . $coll[$i][1] . "</option>");
                                                        }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="ciclo_de_facturacion" id="ciclo_de_facturacion" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" >
                                                <?php
													
                                                    if(isset($_GET['ciclo_de_facturacion_fp'])){
                                                            $valor_ciclo_de_facturacion2 = (int)$valor_ciclo_de_facturacion -1;
                                                            echo("<option value='" .$valor_ciclo_de_facturacion. "'>" . $cyc[$valor_ciclo_de_facturacion2][1] . "</option>");
                                                            for ($i = 0; $i < count($cyc); $i++){
                                                                    echo("<option value='" . $cyc[$i][0] . "'>" . $cyc[$i][1] . "</option>");
                                                            }														
                                                    }
                                                    else{
                                                            echo("<option value='" .$valor_ciclo_de_facturacion. "'>" .$valor_ciclo_de_facturacion. "</option>");
                                                            for ($i = 0; $i < count($cyc); $i++){
                                                                    echo("<option value='" . $cyc[$i][0] . "'>" . $cyc[$i][1] . "</option>");
                                                            }
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label_table">Orden De Compra:</td>                                        
                                        <td class="label_table">Plan:</td>
                                        <td class="label_table">Prorroga:</td>


                                    </tr>
                                    <tr>
                                        <td>
                                            <select name="orden_de_compra" id="orden_de_compra" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" >
                                                <?php
													
                                                    if(isset($_GET['orden_de_compra_fp'])){
                                                            $valor_orden_de_compra2 = (int)$valor_orden_de_compra -1;
                                                            echo("<option value='" .$valor_orden_de_compra. "'>" . $purch[$valor_orden_de_compra2][1] . "</option>");
                                                            for ($i = 0; $i < count($purch); $i++){
                                                                    echo("<option value='" . $purch[$i][0] . "'>" . $purch[$i][1] . "</option>");
                                                            }														
                                                    }
                                                    else{
                                                            echo("<option value='" .$valor_orden_de_compra. "'>" .$valor_orden_de_compra. "</option>");
                                                            for ($i = 0; $i < count($purch); $i++){
                                                                    echo("<option value='" . $purch[$i][0] . "'>" . $purch[$i][1] . "</option>");
                                                            }
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="plan" id="plan" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" >
                                                <?php
													
                                                    if(isset($_GET['plan_fp'])){
                                                            $valor_plan2 = (int)$valor_plan -1;
                                                            echo("<option value='" .$valor_plan. "'>" . $plan[$valor_plan2][1] . "</option>");
                                                            for ($i = 0; $i < count($plan); $i++){
                                                                    echo("<option value='" . $plan[$i][0] . "'>" . $plan[$i][1] . "</option>");
                                                            }														
                                                    }
                                                    else{
                                                            echo("<option value='" .$valor_plan. "'>" .$valor_plan. "</option>");
                                                            for ($i = 0; $i < count($plan); $i++){
                                                                    echo("<option value='" . $plan[$i][0] . "'>" . $plan[$i][1] . "</option>");
                                                            }
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="prorroga" id="prorroga" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" >
                                                <?php
													
                                                    if(isset($_GET['orden_de_compra_fp'])){
                                                            $valor_orden_de_compra2 = (int)$valor_orden_de_compra -1;
                                                            echo("<option value='" .$valor_orden_de_compra. "'>" . $ext[$valor_orden_de_compra2][1] . "</option>");
                                                            for ($i = 0; $i < count($ext); $i++){
                                                                    echo("<option value='" . $ext[$i][0] . "'>" . $ext[$i][1] . "</option>");
                                                            }														
                                                    }
                                                    else{
                                                            echo("<option value='" .$valor_orden_de_compra. "'>" .$valor_orden_de_compra. "</option>");
                                                            for ($i = 0; $i < count($ext); $i++){
                                                                    echo("<option value='" . $ext[$i][0] . "'>" . $ext[$i][1] . "</option>");
                                                            }
                                                    }
                                                ?>
                                            </selec
                                            </select>
											
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label_table">Validar existencia de propietario:</td>
										*Nota: Todos los campos son obligatorios 
                                    </tr>
                                    <tr>
                                        <td>
                                            <input  name="validar" class="btn_style" type="button" id="id_validar" value="Validar" onclick="existe();" />
                                        </td>
                                    </tr>                                    
                                </table>
                            </td>
                    </tr>

             </table>
             <table><tr><td style="font-size: 16pt; ">Datos Propietario</td><td></td><td><img src="../resources/icons/people.png" align="top" /></td></tr></table>
             <table>
                    <tr>
                            <td rowspan="3" colspan="3">
                                <table>
                                    <tr>
                                        <td class="label_table">Nombres:</td>
                                        <td class="label_table">Apellido:</td>
                                        <td class="label_table">Dirección:</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="input_text" type="text" id="id_name" name="nombre" value= "<?php echo($valor_nombre);?>" <?php echo($habilita_propietario);?>/>
                                        </td>
                                        <td>
                                            <input class="input_text" type="text" name="apellido" id="id_lastname" value="<?php echo($valor_apellido);?>" <?php echo($habilita_propietario);?>/>
                                        </td>
                                        <td>                     
                                            <input class="input_text" type="text" name="direccion" id="id_direction" value="<?php echo($valor_direccion);?>" <?php echo($habilita_propietario);?>/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="label_table">Telefono:</td>
                                        <td class="label_table">Email:</td>
                                        <td class="label_table">Sitio Web:</td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="input_text" type="text" name="telefono" id="id_telefono" value="<?php echo htmlspecialchars($valor_telefono);?>" <?php echo($habilita_propietario);?>/>
                                        </td>
                                        <td>
                                            <input class="input_text" type="text" name="email" id="id_email" value="<?php echo($valor_email);?>"  <?php echo($habilita_propietario);?>/>
                                        </td>
                                        <td>
                                            <input class="input_text" type="text" name="sitioweb" id="id_email" value="<?php echo($valor_sitioweb);?>"  <?php echo($habilita_propietario);?>/>
                                        </td>                                        
                                    </tr>
                                    <tr>
                                        <td class="label_table">Crear Contrato:</td>
                                        <td class="label_table">Cancelar:</td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <input  name="crear" class="btn_style" type="button" id="id_crear" value="Crear" onclick="crear_contrato();" <?php echo($habilita_crear);?>/>
                                        </td>
                                        <td>
                                            <input  name="cancelar" class="btn_style" type="button" id="id_cancelar" value="Cancelar" onclick="cancelar_registro();"/>
                                        </td>                                        
                                    </tr> 

                                </table>
                            </td>
                    </tr>

             </table>
        </form>
        
        
    </div>


</body>
</html>

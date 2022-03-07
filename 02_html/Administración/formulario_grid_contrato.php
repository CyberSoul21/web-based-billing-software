<?php
	
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

    if(isset($_GET['actualizo'])){//Si la variable actualizo ha sido inicializada, esto cuando se Vuelve a llamar el formulario desde el proceso
        
        $ingreso = 2;
        
    }else{//Ingresa la primera vez
        $ingreso = 1;
	$codigo_contrato_grid = $_GET['codigo_contrato_grid'];
	$nit_grid = $_GET['nit_grid'];
	$nombre_grid = $_GET['nombre_grid'];
	
	$tipo_contrato_grid = $_GET['tipo_contrato_grid'];
	$tipo_recaudo_grid = $_GET['tipo_recaudo_grid'];
	$ciclo_facturacion_grid = $_GET['ciclo_facturacion_grid'];
	
	$plan_grid = $_GET['plan_grid'];
	$orden_compra_grid = $_GET['orden_compra_grid'];
	$prorroga_grid = $_GET['prorroga_grid'];            
    }
  
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	
	<!--Llamado Librerias de DHTMLX-->	
	
    <title>Contrato</title>
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



    <script src="../popups/shadowbox/shadowbox.js"></script>
    <script type="text/javascript">Shadowbox.init();</script>
    <script src="../dhtml/dhtmlxDataProcessor/codebase/dhtmlxdataprocessor.js"></script>
    <style> html, body {width: 100%;height: 100%;margin: 0px;overflow: hidden;}</style>

<!--FIN Llamado Librerias de DHTMLX-->		
    
           
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
                function act(){//Actualizar contrato
                    
                    if(confirm('Se actualizaran la información del contrato ¿Continuar?')){
                        document.form_contract_grid.action.value = "actualizar";
                        
                        document.form_contract_grid.submit();
                        //parent.dhxWins.window("w1").close(); 
                    }            
                }
                function sal(){//Cierra ventana sin guardar datos
				
                    if (confirm('¿Desea salir?')){ 
                        parent.dhxWins.window("w1").close(); 
                    }                  
                    //alert("Cancelar");
					
                    //document.form_contract.action.value = "cancelar";
                    //document.form_contract.submit();
                }
                function myFunction(){
                    if("<?php echo($ingreso);?>"=="2"){
                        //alert("Contrato actualizado");
                        parent.dhxWins.window("w1").close();
                    }                    
                }
            </script>





</head>

<body onload="myFunction();">

    <div class="scroll">
        <form name="form_contract_grid" id ="id_form" action="formulario_contratos_proceso_grid.php" method="post" >
            <table><tr><td style="font-size: 16pt; ">Contrato</td><td></td><td><img src="../resources/icons/ico_con_48.gif" align="top" /></td></tr></table>
             <table>
                    <tr>
                            <td rowspan="3" colspan="3">
                                <table>
                                    <tr>
                                        <td class="label_table">Código Contrato:</td>
                                        <td class="label_table">NIT/CC:</td>
                                        <td class="label_table">Contratante:</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="input_text" type="text" name="codigo_contrato" id="id_codigo_contrato"  value="<?php echo($codigo_contrato_grid);?>" disabled />
                                            <input name="codigo" value="<?php echo($codigo_contrato_grid);?>" type="hidden"/>
                                        </td>
                                        <td>
                                            <input class="input_text" type="text" name='nit' id="id_nit" value="<?php echo($nit_grid);?>" disabled />
                                            <input name="action" value="" type="hidden"/>
                                        </td>
                                        <td>
                                            <input class="input_text" type="text" name="nombre" id="id_nombre"  value="<?php echo($nombre_grid);?>" disabled />
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
                                                    echo("<option value=''>" .$tipo_contrato_grid. "</option>");
                                                    for ($i = 0; $i < count($contr); $i++){
                                                    echo("<option value='" . $contr[$i][0] . "'>" . $contr[$i][1] . "</option>");
                                                    }                        
                                               ?>
                                            </select>  
                                        </td>
                                        <td>
                                            <select name="tipo_de_recaudo" id="tipo_de_recaudo" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" >
                                                <?php
                                                    echo("<option value=''>" .$tipo_recaudo_grid. "</option>");
                                                            for ($i = 0; $i < count($coll); $i++){
                                                                    echo("<option value='" . $coll[$i][0] . "'>" . $coll[$i][1] . "</option>");
                                                            }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="ciclo_de_facturacion" id="ciclo_de_facturacion" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" >
                                                <?php
                                                    echo("<option value=''>" .$ciclo_facturacion_grid. "</option>");
                                                            for ($i = 0; $i < count($cyc); $i++){
                                                                    echo("<option value='" . $cyc[$i][0] . "'>" . $cyc[$i][1] . "</option>");
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
                                                    echo("<option value=''>" .$orden_compra_grid. "</option>");
                                                        for ($i = 0; $i < count($purch); $i++){
                                                            echo("<option value='" . $purch[$i][0] . "'>" . $purch[$i][1] . "</option>");
                                                        }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="plan" id="plan" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" >
                                                <?php
                                                    echo("<option value=''>" .$plan_grid. "</option>");
                                                        for ($i = 0; $i < count($plan); $i++){
                                                            echo("<option value='" . $plan[$i][0] . "'>" . $plan[$i][1] . "</option>");
                                                        }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="prorroga" id="prorroga" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" >
                                                <?php
                                                    echo("<option value=''>" .$prorroga_grid. "</option>");
                                                        for ($i = 0; $i < count($ext); $i++){
                                                            echo("<option value='" . $ext[$i][0] . "'>" . $ext[$i][1] . "</option>");
                                                        }
                                                ?>
                                            </select>										
                                        </td>
                                    </tr>
                                    <tr>
                                        <!-- <td class="label_table">Boton:</td> -->
										<!-- <td class="label_table">Boton2:</td> -->
										<!--*Nota:--> 
                                    </tr>
                                    <tr>
                                        <td>
                                            <input  name="actualizar" class="btn_style" type="button" id="id_actualizar" value="Actualizar" onclick="act();" />
                                        </td>
                                        <td>
                                            <input  name="salir" class="btn_style" type="button" id="id_salir" value="Salir" onclick="sal();" />
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

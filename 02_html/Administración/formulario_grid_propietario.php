<?php
	
//Código php, conexión, recibir variables a utilizar, método post 	
	
    if(isset($_GET['actualizo'])){        
        $ingreso = 2;	
	}else{
		$ingreso = 1;
		$nombre_grid = @$_GET['nombre'];
		$nit_grid = @$_GET['nit'];
		$tipo_persona_grid = @$_GET['tipo_persona'];
		$direccion_grid = @$_GET['direccion'];
		$email_grid = @$_GET['email'];
		$telefono_grid = @$_GET['telefono'];
		$sitioweb_grid = @$_GET['sitioweb'];
	}

    
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Propietario</title>
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
				//Aquí van las funciones
                function Actualizar(){
				      
				      if("<?php echo($direccion_grid); ?>" != document.form_owner_grid.direccion.value || 
						 "<?php echo($telefono_grid); ?>" != document.form_owner_grid.telefono.value ||
						 "<?php echo($email_grid); ?>" != document.form_owner_grid.email.value ||
						 "<?php echo($sitioweb_grid); ?>" != document.form_owner_grid.sitioweb.value ||
						 "<?php echo($nombre_grid); ?>" != document.form_owner_grid.nombre.value){
						  
						if("<?php echo($direccion_grid); ?>" != document.form_owner_grid.direccion.value){
							document.form_owner_grid.cambio_direccion.value = "1";
						}
						if("<?php echo($telefono_grid); ?>" != document.form_owner_grid.telefono.value){
							document.form_owner_grid.cambio_telefono.value = "1";
						}
						if("<?php echo($email_grid); ?>" != document.form_owner_grid.email.value){
							document.form_owner_grid.cambio_email.value = "1";
						}
						if("<?php echo($sitioweb_grid); ?>" != document.form_owner_grid.sitioweb.value){
							document.form_owner_grid.cambio_sitioweb.value = "1";
						}
						if("<?php echo($nombre_grid); ?>" != document.form_owner_grid.nombre.value){
							document.form_owner_grid.cambio_nombre.value = "1";
						}						
						
						if(confirm('Se actualizaran la información del contrato ¿Continuar?')){
							document.form_owner_grid.action.value = "actualizar";
							document.form_owner_grid.submit();						
						}
					  }else{
						  alert("No se ha hecho ningun cambio en algún campo");
					  }
                      
						//parent.dhxWins.window("w1").close();                                
               }
                function salir(){
				
                    //if (confirm('¿Desea salir?')){ 
                        parent.dhxWins.window("w1").close(); 
                    //}                  
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
        <form name="form_owner_grid" id ="id_form" action="formulario_propietario_proceso_grid.php" method="post" >
            <table><tr><td style="font-size: 16pt; ">Datos Propietario</td><td></td><td><img src="../resources/icons/people.png" align="top" /></td></tr></table>
             <table>
                    <tr>
                            <td rowspan="3" colspan="3">
                                <table>
                                    <tr>
                                        <td class="label_table">Nombres:</td>
                                        <td class="label_table">Apellido:</td>
                                        <td class="label_table">NIT/CC:</td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="input_text" type="text" id="id_name" name="nombre" value= "<?php echo($nombre_grid);?>"  />
											<input name="action" value="" type="hidden"/>
											<input name="cambio_nombre" value="" type="hidden"/>
										</td>
                                        <td>
                                            <input class="input_text" type="text" name="apellido" id="id_lastname" value="" disabled />
                                        </td>
                                        <td>                     
                                            <input class="input_text" type="text" name="nit" id="id_nit" value="<?php echo($nit_grid);?>"   />
                                        </td>                                        
                                    </tr>

                                    <tr>
                                        <td class="label_table">Tipo de Persona:</td>                                        
                                        <td class="label_table">Dirección:</td>
                                        <td class="label_table">Telefono:</td>


                                    </tr>
                                    <tr>
                                        <td>                     
                                            <input class="input_text" type="text" name="tipo_persona" id="id_tipo_persona" value="<?php echo($tipo_persona_grid);?>" disabled />
                                        </td>                                        
                                        <td>                     
                                            <input class="input_text" type="text" name="direccion" id="id_direction" value="<?php echo($direccion_grid);?>" />
											<input name="cambio_direccion" value="" type="hidden"/>
									   </td>                                        
                                        <td>
                                            <input class="input_text" type="text" name="telefono" id="id_telefono" value="<?php echo htmlspecialchars($telefono_grid);?>" />
                                            <input name="cambio_telefono" value="" type="hidden"/>
									   </td>
                                    
                                    </tr>
                                    <tr>
                                        <td class="label_table">Email:</td>
                                        <td class="label_table">Sitio Web:</td>                                        
                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="input_text" type="text" name="email" id="id_email" value="<?php echo($email_grid);?>"  />
											<input name="cambio_email" value="" type="hidden"/>
										</td>
                                        <td>
                                            <input class="input_text" type="text" name="sitioweb" id="id_email" value="<?php echo($sitioweb_grid);?>"  />
											<input name="cambio_sitioweb" value="" type="hidden"/>
										</td>                                         
                                      
                                    </tr>
                                    <tr>
                                        <td class="label_table">Actualiza Datos:</td>
                                        <td class="label_table">Cancelar:</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input  name="actualizar" class="btn_style" type="button" id="id_actualizar" value="Actualizar" onclick="Actualizar();" />
                                        </td>
                                        <td>
                                            <input  name="cancelar" class="btn_style" type="button" id="id_cancelar" value="Cancelar" onclick="salir();"/>
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

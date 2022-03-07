<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<!--Llamado Librerias de DHTMLX-->	
	
    <title>Facturación</title>
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
    
    <div id="mygrid_container" style="width:100%; height:100%;"></div>
    <style>
            /*these styles allow dhtmlxLayout to work in fullscreen mode in different browsers correctly*/
        html, body {
            width: 100%;
            height: 100%;
            margin: 0px;
            overflow: hidden;
            background-color:white;
        }
    </style>



    <script type="text/javascript">
        var layout,menu,toolbar,MyGrid,MyForm,dhxWins,w1;//Inicializaciòn variables usadas durante la creaciòn
        //dhtmlx.image_path = "codebase/imgs/";
        dhtmlxEvent(window,"load",function(){                                          
        
		dhxWins = new dhtmlXWindows();//Objeto para la ventana de formulario
		//----------------------------Creaciòn de Layout------------------------------------------------------				
	    layout = new dhtmlXLayoutObject(document.body,"1C","dhx_skyblue");                       
            //layout.cells("a").setText("Contacts");                                     
            layout.cells("a").setText("Activos");                              
            layout.cells("a").setWidth(500);                                           
		//----------------------------Añadir menù------------------------------------------------------
            menu = layout.attachMenu();                                                
            menu.setIconsPath("../resources/icons/");                                              
            menu.setSkin("dhx_skyblue");
			menu.loadXML("../resources/xml/main_menu.php");           
			//(menu.loadXML("data/menu.xml");          
			
		//----------------------------Añadir barra de herramientas------------------------------------------------------   
            toolbar = layout.attachToolbar();                                          
            toolbar.setSkin("dhx_skyblue");
            toolbar.setIconsPath("../resources/icons/");                                            
            toolbar.loadXML("../resources/xml/toolbar_billing.xml");                                       
            
			/*toolbar.loadXML("data/toolbar.xml");                                       
            //comentado filtro de busqueda NO IMPLEMENTADO
            toolbar.addInput("myInput","*","type...");
            toolbar.attachEvent("onClick",function(id){
                
                if(id=="newContact"){
                    
                    if(toolbar.getValue("myInput")=="Hola"){
                        alert("Works :)");
                    }
                    else{
                        alert("You are wrong :( ");
                    }                   
                }
            });//*/        
			
		//----------------------------Añadir Grid------------------------------------------------------   
            MyGrid = layout.cells("a").attachGrid();			
			MyGrid.attachEvent("onXLS",function(){layout.progressOn();});
			MyGrid.attachEvent("onXLE",function(){layout.progressOff();});
			MyGrid.attachEvent("onFilterStart",function(){layout.progressOn();return true;});
			MyGrid.attachEvent("onFilterEnd",function(){layout.progressOff();});		
            MyGrid.setSkin("dhx_skyblue");    
            //MyGrid.setInitWidths("60,100,*,*,80,*,50,*,*,*,*,*,*,*,*,*,*,80,*,*,*,*,*");
            
			MyGrid.setInitWidths("100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100");
            MyGrid.setColAlign("justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify");
            MyGrid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");               //sets the types of columns
            MyGrid.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");  //sets the sorting types of columns		
            MyGrid.setHeader("Servidor, ID, Identificacion, SIM, Activo, NIT, Propietario, NS, DM, caso, Estado, Tipo de persona, Contrato, Plan, Tipo de contrato, Prorroga, Ciclo Facturacion, Tiempo a Facturar, Orden de Compra, Tipo de Recaudo, Vencimiento, Radicar, Enviar, Tarifa, Valor, Soporte");//23	
            MyGrid.setColumnIds("Servidor, ID, Identificacion, SIM, Activo, NIT, Propietario, NS, DM, caso, Estado, Tipo_de_persona, Contrato, Plan, Modo_contrato, Prorroga, Ciclo_Facturacion, Tiempo_a_Facturar, Orden_de_Compra, Tipo_de_Recaudo,  Vencimiento, Radicar, Enviar, Tarifa, Valor, Soporte");
            MyGrid.init();
			MyGrid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
            
			//MyGrid.load("data/activos.php");
            toolbar.attachEvent("onClick",function(id){//Según el boton elgido modifique la consulta, pasando parametros al archivo php
            	
				if(id=="Todos"){
              	    
					MyGrid.clearAll(true);
					
					MyGrid.setInitWidths("100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100");
					MyGrid.setColAlign("justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify");
					MyGrid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");               //sets the types of columns
					MyGrid.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");  //sets the sorting types of columns		
					MyGrid.setHeader("Servidor, ID, Identificacion, SIM, Activo, NIT, Propietario, NS, DM, caso, Estado, Tipo de persona, Contrato, Plan, Tipo de contrato, Prorroga, Ciclo Facturacion, Tiempo a Facturar, Orden de Compra, Tipo de Recaudo, Vencimiento, Radicar, Enviar, Tarifa, Valor, Soporte");//23	
					MyGrid.setColumnIds("Servidor, ID, Identificacion, SIM, Activo, NIT, Propietario, NS, DM, caso, Estado, Tipo_de_persona, Contrato, Plan, Modo_contrato, Prorroga, Ciclo_Facturacion, Tiempo_a_Facturar, Orden_de_Compra, Tipo_de_Recaudo,  Vencimiento, Radicar, Enviar, Tarifa, Valor, Soporte");
					MyGrid.init();
					MyGrid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");

					MyGrid.load("assets_bill_processor.php?nivel=todos");
		    		var dp = new dataProcessor("assets_bill_processor.php?nivel=todos");
		    		dp.init(MyGrid);		                  
                }                
                if(id=="Activos"){
					
                    MyGrid.clearAll(true);
					
					MyGrid.setInitWidths("100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100");
					MyGrid.setColAlign("justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify");
					MyGrid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");               //sets the types of columns
					MyGrid.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");  //sets the sorting types of columns		
					MyGrid.setHeader("Servidor, ID, Identificacion, SIM, Activo, NIT, Propietario, NS, DM, caso, Estado, Tipo de persona, Contrato, Plan, Tipo de contrato, Prorroga, Ciclo Facturacion, Tiempo a Facturar, Orden de Compra, Tipo de Recaudo, Vencimiento, Radicar, Enviar, Tarifa, Valor, Soporte");//23	
					MyGrid.setColumnIds("Servidor, ID, Identificacion, SIM, Activo, NIT, Propietario, NS, DM, caso, Estado, Tipo_de_persona, Contrato, Plan, Modo_contrato, Prorroga, Ciclo_Facturacion, Tiempo_a_Facturar, Orden_de_Compra, Tipo_de_Recaudo,  Vencimiento, Radicar, Enviar, Tarifa, Valor, Soporte");
					MyGrid.init();
					MyGrid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");

					MyGrid.load("assets_bill_processor.php?nivel=activo");
				    var dp = new dataProcessor("assets_bill_processor.php?nivel=activo");
				    dp.init(MyGrid);		                  
                }
                else if(id=="Suspension"){
                    
                    MyGrid.clearAll(true);
					
					
					MyGrid.setInitWidths("100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100");
					MyGrid.setColAlign("justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify");
					MyGrid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");               //sets the types of columns
					MyGrid.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");  //sets the sorting types of columns		
					MyGrid.setHeader("Servidor, ID, Identificacion, SIM, Activo, NIT, Propietario, NS, DM, caso, Estado, Tipo de persona, Contrato, Plan, Tipo de contrato, Prorroga, Ciclo Facturacion, Tiempo a Facturar, Orden de Compra, Tipo de Recaudo, Vencimiento, Radicar, Enviar, Tarifa, Valor, Soporte");//23	
					MyGrid.setColumnIds("Servidor, ID, Identificacion, SIM, Activo, NIT, Propietario, NS, DM, caso, Estado, Tipo_de_persona, Contrato, Plan, Modo_contrato, Prorroga, Ciclo_Facturacion, Tiempo_a_Facturar, Orden_de_Compra, Tipo_de_Recaudo,  Vencimiento, Radicar, Enviar, Tarifa, Valor, Soporte");
					MyGrid.init();
					MyGrid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");

					MyGrid.load("assets_bill_processor.php?nivel=suspension");
		    		var dp = new dataProcessor("assets_bill_processor.php?nivel=suspension");
		    		dp.init(MyGrid);
                }
                else if(id=="Desactivos"){
                    
                    MyGrid.clearAll(true);
					
					
					MyGrid.setInitWidths("100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100");
					MyGrid.setColAlign("justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify,justify");
					MyGrid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");               //sets the types of columns
					MyGrid.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");  //sets the sorting types of columns		
					MyGrid.setHeader("Servidor, ID, Identificacion, SIM, Activo, NIT, Propietario, NS, DM, caso, Estado, Tipo de persona, Contrato, Plan, Tipo de contrato, Prorroga, Ciclo Facturacion, Tiempo a Facturar, Orden de Compra, Tipo de Recaudo, Vencimiento, Radicar, Enviar, Tarifa, Valor, Soporte");//23	
					MyGrid.setColumnIds("Servidor, ID, Identificacion, SIM, Activo, NIT, Propietario, NS, DM, caso, Estado, Tipo_de_persona, Contrato, Plan, Modo_contrato, Prorroga, Ciclo_Facturacion, Tiempo_a_Facturar, Orden_de_Compra, Tipo_de_Recaudo,  Vencimiento, Radicar, Enviar, Tarifa, Valor, Soporte");
					MyGrid.init();
					MyGrid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");

					
					MyGrid.load("assets_bill_processor.php?nivel=desactivos");
		    		var dp = new dataProcessor("assets_bill_processor.php?nivel=desactivos");
				    dp.init(MyGrid);
                }
                else if(id=="export_xls"){
                    MyGrid.toExcel("../exporter/excel/filter_by_events.php","color",true,true);
                }
                else if(id=="export_csv"){
					MyGrid.csv.cell = ";";
					document.getElementById('data').value = MyGrid.serializeToCSV();
					document.forms[0].submit();
                }                 
            });
			
			
			MyGrid.attachEvent("onRowDblClicked",function(Id,cellIndex){//Creaciòn de formulario cuando se de el evento doble click sobre un registro

		//----------------------------almacenar datos del registro para el formulario-----------------------------------------------------				
                    var identificador=Id.split(",");
                    var servidor = MyGrid.cellById(Id,0).getValue();
					var id = MyGrid.cellById(Id,1).getValue()
                    var identificacion = MyGrid.cellById(Id,2).getValue();
				    var sim = MyGrid.cellById(Id,3).getValue();
                    var activo = MyGrid.cellById(Id,4).getValue();
                    var nit = MyGrid.cellById(Id,5).getValue();
                    var propietario = MyGrid.cellById(Id,6).getValue();
                    var ns = MyGrid.cellById(Id,7).getValue();
                    var dm = MyGrid.cellById(Id,8).getValue();
                    var caso = MyGrid.cellById(Id,9).getValue();
				
                    var tipo_persona = MyGrid.cellById(Id,11).getValue();
                    var contrato = MyGrid.cellById(Id,12).getValue();
                    var plan = MyGrid.cellById(Id,13).getValue(); 
                    var tipo_contrato = MyGrid.cellById(Id,14).getValue();
                    var prorroga = MyGrid.cellById(Id,15).getValue();
                    var ciclo_facturacion = MyGrid.cellById(Id,16).getValue();
                    var tiempo_facturar = MyGrid.cellById(Id,17).getValue();
                    var orden_compra = MyGrid.cellById(Id,18).getValue();
                    var tipo_recaudo = MyGrid.cellById(Id,19).getValue();
                    var vencimiento = MyGrid.cellById(Id,20).getValue();
                    var radicar = MyGrid.cellById(Id,21).getValue();
                    var enviar = MyGrid.cellById(Id,22).getValue();
                    var tarifa = MyGrid.cellById(Id,23).getValue();
                    var valor = MyGrid.cellById(Id,24).getValue();
                    var soporte = MyGrid.cellById(Id,25).getValue();
                     
			//Ventana para el formulario                    
                    w1 = dhxWins.createWindow("w1", 30, 160, 1170, 380);	
                    w1.button("park").hide();
                    w1.button("minmax1").hide();			
                    w1.denyMove();
                    w1.centerOnScreen();
                    w1.setModal(true);
                    w1.attachURL("formulario_grid_facturar.php?servidor="+servidor+"&identificacion="+identificacion+"&sim="+sim+"&activo="+activo+
                                "&nit="+nit+"&propietario="+propietario+"&ns="+ns+"&dm="+dm+"&caso="+caso+"&tipo_persona="+tipo_persona+
                                "&contrato="+contrato+"&plan="+plan+"&tipo_contrato="+tipo_contrato+"&prorroga="+prorroga+"&ciclo_facturacion="+ciclo_facturacion+
                                "&tiempo_facturar="+tiempo_facturar+"&orden_compra="+orden_compra+"&tipo_recaudo="+tipo_recaudo+"&vencimiento="+vencimiento+
                                "&radicar="+radicar+"&enviar="+enviar+"&tarifa="+tarifa+"&valor="+valor+"&soporte="+soporte+"&id="+id);
                    
                    w1.setText("Datos Activo");//direcciona a formulario y envia datos
                    
           
                
  	    });	
            

        });

        
    </script>

</head>

<body>
<form action="export_csv.php" id="export.csv" name="export.csv" method="post" accept-charset="utf-8"><input type="hidden" name="data" value="" id="data"></form>
</body>
</html>

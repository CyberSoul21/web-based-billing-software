<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	
<!--Llamado Librerias de DHTMLX-->	
	
    <title>Propietarios</title>
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
		
        var layout,menu,toolbar,MyGrid,MyForm,w1,dhxWins;//Inicializaciòn variables usadas durante la creaciòn
        
		dhtmlx.image_path = "codebase/imgs/";
        
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
			
		//----------------------------Añadir barra de herramientas------------------------------------------------------ 
            toolbar = layout.attachToolbar();                                          
            toolbar.setSkin("dhx_skyblue");
            toolbar.setIconsPath("../resources/icons/");                                           
            toolbar.loadXML("../resources/xml/toolbar_owner.xml");  
            toolbar.attachEvent("onClick",function(id){
                
				if(id=="export_xls"){
                    MyGrid.toExcel("../exporter/excel/filter_by_events.php","color",true,true);
                }
                else if(id=="export_csv"){
					MyGrid.csv.cell = ";";
					document.getElementById('data').value = MyGrid.serializeToCSV();
					document.forms[0].submit();
                }					
            });//*/			

        
		//----------------------------Añadir Grid------------------------------------------------------
            MyGrid = layout.cells("a").attachGrid();			
			MyGrid.attachEvent("onXLS",function(){layout.progressOn();});
			MyGrid.attachEvent("onXLE",function(){layout.progressOff();});
			MyGrid.attachEvent("onFilterStart",function(){layout.progressOn();return true;});
			MyGrid.attachEvent("onFilterEnd",function(){layout.progressOff();});			
            MyGrid.setSkin("dhx_skyblue");    
            MyGrid.setInitWidths("*,*,*,*,*,*,*");            
            MyGrid.setColAlign("justify,justify,justify,justify,justify,justify,justify");
            MyGrid.setColTypes("ro,ro,ro,ro,ro,ro,ro");               //sets the types of columns
            MyGrid.setColSorting("str,str,str,str,str,str,str");  //sets the sorting types of columns		
            MyGrid.setHeader("NIT/CC, Nombre, Tipo de Persona, Dirección, Telefono, Email, Sitio Web");//6
            MyGrid.setColumnIds("NIT_CC, Nombre, Tipo_de_persona, Direccion, Telefono, Email, sitioweb");	
            MyGrid.init();
            MyGrid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
            MyGrid.load("owners_processor.php");            
            MyGrid.attachEvent("onRowDblClicked",function(Id,cellIndex){//Creaciòn de formulario cuando se de el evento doble click sobre un registro
				
		//----------------------------almacenar datos del registro para el formulario-----------------------------------------------------		
                var identificador=Id.split(",");
                var nit = MyGrid.cellById(Id,0).getValue();
                var nombre = MyGrid.cellById(Id,1).getValue();
                var tipo_persona = MyGrid.cellById(Id,2).getValue();
                var direccion = MyGrid.cellById(Id,3).getValue();
                var telefono = MyGrid.cellById(Id,4).getValue();
                var email = MyGrid.cellById(Id,5).getValue();
                var sitioweb = MyGrid.cellById(Id,6).getValue();

			//Ventana para el formulario 			
                
                w1 = dhxWins.createWindow("w1", 30, 160, 890, 270);	
                w1.button("park").hide();
                w1.button("minmax1").hide();			
                w1.denyMove();
                w1.centerOnScreen();
                w1.setModal(true);
                w1.attachURL("formulario_grid_propietario.php?nit="+nit+"&nombre="+nombre+"&tipo_persona="+tipo_persona+"&direccion="+direccion+
				"&telefono="+telefono+"&email="+email+"&sitioweb="+sitioweb);
                //w1.attachURL("data/formulario_grid_contrato.php?codigo_contrato_grid="+codigo+"&nit_grid="+nit+"&nombre_grid="+nombre+
                //"&tipo_contrato_grid="+tipo_contrato+"&tipo_recaudo_grid="+tipo_recaudo+"&ciclo_facturacion_grid="+ciclo_facturacion+"&plan_grid="+plan+
                //"&orden_compra_grid="+orden_compra+"&prorroga_grid="+prorroga);
                w1.setText("Propietario");//direcciona a formulario y envia datos
				
  	    });            

        });

        
    </script>

</head>

<body>
<form action="export_csv.php" id="export.csv" name="export.csv" method="post" accept-charset="utf-8"><input type="hidden" name="data" value="" id="data"></form>
</body>
</html>

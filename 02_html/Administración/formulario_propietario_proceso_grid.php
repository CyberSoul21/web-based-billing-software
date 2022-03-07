<?php
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
	

    if(@$_POST['action']=="actualizar"){
      
        if(@$_POST['direccion']!="" && @$_POST['cambio_direccion']=="1"){
            $sql3="UPDATE `owners` SET  
            `address` =  '".@$_POST['direccion']."' WHERE  `tax_id` =  '".@$_POST['nit']."';";
            $result3 = mysql_query($sql3) or die(mysql_error());            
        }
        if(@$_POST['telefono']!="" && @$_POST['cambio_telefono']=="1"){
      
            $sql3="UPDATE `owners` SET  
            `phone` =  '".@$_POST['telefono']."'
            WHERE  `tax_id` =  '".@$_POST['nit']."';";
            $result3 = mysql_query($sql3) or die(mysql_error());            
          
        }
        if(@$_POST['email']!="" && @$_POST['cambio_email']=="1"){
            
            $sql3="UPDATE `owners` SET  
            `email` =  '".@$_POST['email']."'
            WHERE  `tax_id` =  '".@$_POST['nit']."';";
            $result3 = mysql_query($sql3) or die(mysql_error());            
        }
        if(@$_POST['sitioweb']!="" && @$_POST['cambio_sitioweb']=="1"){
            
            $sql3="UPDATE `owners` SET  
            `website` =  '".@$_POST['sitioweb']."'
            WHERE  `tax_id` =  '".@$_POST['nit']."';";
            $result3 = mysql_query($sql3) or die(mysql_error());                     
        }
        if(@$_POST['nombre']!="" && @$_POST['cambio_nombre']=="1"){
            
            $sql3="UPDATE `owners` SET  
            `name` =  '".@$_POST['nombre']."'
            WHERE  `tax_id` =  '".@$_POST['nit']."';";
            $result3 = mysql_query($sql3) or die(mysql_error());                     
        }        
        
    

		//header("Location: ../owner.php?");
        header("Location: ./formulario_grid_propietario.php?actualizo=1");
    }


    

?>
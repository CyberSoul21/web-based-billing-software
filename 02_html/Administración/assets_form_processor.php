<?php
//Administracion de la sesion
session_start();
if(!isset($_SESSION['id'])){
    header("location:../index.php");
}
include('../resources/credentials/wavetrack.php');
include('../resources/credentials/mysql.php');
include('../resources/credentials/source_inspector.php');


//$db_host, $db_user, $db_pass, $db_name
$cnxLocal = mysqli_connect($db_host, $db_user, $db_pass, $db_name)or die("Error de coneccion local: ".mysqli_error($cnxLocal));
$srv = @$_GET['server'];
if(!@$_GET['server']){
    $srv = @$_GET['ip'];
}

$cnxTMS = mysqli_connect($srv, $db_user_tms, $db_pass_tms, $db_name_tms)or die("Error de coneccion al servidor: ".mysqli_error($cnxTMS));
$suspension=@$_GET['suspension_level'];
$action=@$_GET['action'];
if($action=='insert'){
        $contrato="SELECT id_agreements from tbl_agreements where id_agreements='".@$_GET['agreement']."';";
        $resultcon = mysqli_query($cnxTMS, $contrato); if (!$resultcon){echo "La consulta SQL contiene errores0. ". $contrato;}
	while($row0 = mysql_fetch_array($resultcon)):
            $contratos[]=array($row0["id_agreements"]);
        endwhile;
        if(@$_GET['id_business_unit'] == ''){		
		$id_division=0;	
	}else{
		$id_division=@$_GET['id_business_unit'];
	}
        if(@$_GET['id_subbusiness_unit'] == ''){		
		$id_subdivision=0;	
	}else{
		$id_subdivision=@$_GET['id_subbusiness_unit'];
	}
        if(@$_GET['sensor_type'] == ''){		
		$sensor=0;	
	}else{
		$sensor=@$_GET['sensor_type'];
	}
        
        $sql= "INSERT INTO tbl_mobiles(id_parent,id_mobiles, id_company, id_business_unit, id_subbusiness_unit, id_agreements, name, identification, 
        imei, sim_id, sim_imsi, brand, class, line, model, color,  plate, web_icon,start_window, end_window, tank_capacity, type_tank, vmax_tank, vmin_tank, 
        km_per_litre, hours_per_litre, pulses_per_litre, cost_per_kilometer, cost_per_hour, last_latitude, last_longitude, last_total_vehicle_hours, 
        last_total_vehicle_km, last_total_vehicle_fuel, last_driver_key, last_travelled_distance, last_hourometer, last_fuel_consumption, last_driving_qualification, 
        last_efficiency, created_by, created_at, created_from, modified_by, modified_at, modified_from , delete_mark,last_update, apportionment, suspension_level, sensor_type ) 
        VALUES ('1',null, '".@$_GET['company']."','".$id_division."','".$id_subdivision."','".@$_GET['agreement']."','".@$_GET['name']."','".@$_GET['identification']."',
        '".@$_GET['imei']."','".@$_GET['sim_id']."','".@$_GET['sim_imsi']."','".@$_GET['brand']."','".@$_GET['class']."','".@$_GET['line']."','".@$_GET['model']."','".@$_GET['color']."','".@$_GET['plate']."', 
        '".@$_GET['web_icon']."','".@$_GET['start_window']."','".@$_GET['end_window']."','".@$_GET['tank_capacity']."','0','0','0', '10', '1', '1000', '100', '100', '4.676408', '-74.047402', '0', '".@$_GET['odometer']."',
        '0', '0', '0',  '0', '0', '0', '0', '".$_SESSION['id']."', NOW(),'".getIP()."','".$_SESSION['id']."', NOW(),'".getIP()."', '0',now(),'".@$_GET['apportionment']."','0','".$sensor."');";	
		$result = mysqli_query($cnxTMS,$sql)or die("Error consulta 1 ".mysql_error($cnxTMS));



		
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------
//------21-09-2016 Código para crear Activo en base de datos administrativo " wavetrackAdminPlat", tbl_billing---------------------------------------------------------------------------	   

		$sql2 = "SELECT id_mobiles FROM tbl_mobiles WHERE id_company ='".@$_GET['company']."' AND name = '".@$_GET['name']."' AND identification = '".@$_GET['identification']."'";
	    
		$result2 = mysqli_query($cnxTMS,$sql2) or die("Error consulta id servidor: ".$sql2." espacio ".mysql_error($cnxTMS));

		while ($row = mysql_fetch_array($result2)) {
			$id_m[] = array($row['id_mobiles']);
        }	
		
		$id_mobile = mysqli_insert_id($cnxTMS);
		$sql3= "INSERT INTO `tbl_billing` (`id_billing`, `id_servers`, `id_mobiles`, `name`, `identification`, `sim_imsi`, `id_company`, `suspension_level`, `id_owner`, `agreement_code`, `id_billing_period`, `time_to_billing`, `id_plans`, `id_tariff`, `radicated`, `id_due_date`, `price`, `support_name`, `adress`, `case`, `ip`, `created_by`, `created_at`, `created_from`, `modified_by`, `modified_at`, `modified_from`, `delete_mark`) VALUES
		('NULL', '0', '".$id_mobile."', '".@$_GET['plate']."', '".@$_GET['identification']."', '".@$_GET['sim_imsi']."', '".@$_GET['company']."', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '".$srv."',  '".$_SESSION['id']."','NOW()','".getIP()."','".$_SESSION['id']."','NOW()','".getIP()."','0');";
		$result3 = mysqli_query($cnxLocal,$sql3)or die("Error código insert:".$id_mobile." POOO ".mysqli_error($cnxLocal));//Inserta Activo en tbl_billing					
//------------------------------------------------------------------------------------------------------------------------------------------------------------------

		
		
		
		

        header("location: assets_win_form.php?add_driver=ok&action_form=new");
	}
	
/*	if ($action == 'update') {									//CaDiaz (2016-03-14): En comentario para implementar solucion de cambio de nivel de suspension al cambiar de division
    if (@$_GET['id_business_unit'] == '') {
        $id_division = 0;
    } else {
        $id_division = @$_GET['id_business_unit'];
    }
    if (@$_GET['id_subbusiness_unit'] == '') {
        $id_subdivision = 0;
    } else {
        $id_subdivision = @$_GET['id_subbusiness_unit'];
    }

    if ($suspension == '' || $suspension == 0) {
        $suspension_level = 0;
        $delete_mark = 0;
    } else if ($suspension == 1) {
        $suspension_level = $suspension;
        $delete_mark = 1;
    } else {
        $suspension_level = $suspension;
        $delete_mark = 2;
    }

    if (@$_GET['sensor_type'] == '') {
        $sensor = 0;
    } else {
        $sensor = @$_GET['sensor_type'];
    }*/
        
if ($action == 'update') {
    if (@$_GET['id_business_unit'] == '') {
        $id_division = 0;
    } else {
        $id_division = @$_GET['id_business_unit'];
    }
    if (@$_GET['id_subbusiness_unit'] == '') {
        $id_subdivision = 0;
    } else {
        $id_subdivision = @$_GET['id_subbusiness_unit'];
    }
	
	//Inicio - CaDiaz 2016-03-14: Para arreglar cambio de nivel de suspensión al cambiar la división
	$sql = "UPDATE tbl_mobiles SET imei='" . @$_GET['imei'] . "',sim_id='" . @$_GET['sim_id'] . "', last_total_vehicle_km='" . @$_GET['odometer'] . "'
           ,sim_imsi='" . @$_GET['sim_imsi'] . "',brand='" . @$_GET['brand'] . "',class='" . @$_GET['class'] . "',line='" . @$_GET['line'] . "',model='" . @$_GET['model'] . "', tank_capacity='" . @$_GET['tank_capacity'] . "'
           ,color='" . @$_GET['color'] . "',web_icon='" . @$_GET['web_icon'] . "', start_window='" . @$_GET['start_window'];

    if (@$_GET['sensor_type'] == '') {
        $sensor = 0;
    } else {
        $sensor = @$_GET['sensor_type'];
    }   

    if ($suspension == ''){
		$sql = $sql . "',end_window='" . @$_GET['end_window'] . "',id_business_unit='" . $id_division . "', id_subbusiness_unit='" . $id_subdivision . "', sensor_type='" . $sensor . "',
           modified_by='" . $_SESSION['id'] . "',modified_at= NOW(), modified_from='" . getIP() . "', owner='" . @$_GET['owner'] . "',owner_name='" . @$_GET['owner_name'] . "' WHERE id_mobiles=" . @$_GET['id_mobiles'];
	} else if ($suspension == 0) {
        $suspension_level = 0;
        $delete_mark = 0;
		$sql = $sql . "',suspension_level= '" . $suspension_level . "',
           end_window='" . @$_GET['end_window'] . "',id_business_unit='" . $id_division . "', id_subbusiness_unit='" . $id_subdivision . "', sensor_type='" . $sensor . "',
           modified_by='" . $_SESSION['id'] . "',modified_at= NOW(), modified_from='" . getIP() . "', owner='" . @$_GET['owner'] . "',owner_name='" . @$_GET['owner_name'] . "' , delete_mark='" . $delete_mark . "'
           WHERE id_mobiles=" . @$_GET['id_mobiles'];	 
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------21-09-2016 Código para cambiar nivel de suspensión y Delete_marck del activo en BD Administrativo  wavetrackAdminPlat, tbl_billing Walmario-------------------------------- 
		$sql4 = "UPDATE tbl_billing SET suspension_level= '".$suspension_level."', delete_mark= '" .$delete_mark. "' WHERE id_mobiles= '".@$_GET['id_mobiles']."'";
		//$sql4 = "UPDATE tbl_billing SET suspension_level= '".$suspension_level."', delete_mark= '" .$delete_mark. "' WHERE name= '".@$_GET['plate']."' AND identification= '".@$_GET['identification']."' AND ip = '".@$_GET['server']."'";
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------		    		   
    } else if ($suspension == 1) {
        $suspension_level = $suspension;
        $delete_mark = 1;
		$sql = $sql . "',suspension_level= '" . $suspension_level . "',
           end_window='" . @$_GET['end_window'] . "',id_business_unit='" . $id_division . "', id_subbusiness_unit='" . $id_subdivision . "', sensor_type='" . $sensor . "',
           modified_by='" . $_SESSION['id'] . "',modified_at= NOW(), modified_from='" . getIP() . "', owner='" . @$_GET['owner'] . "',owner_name='" . @$_GET['owner_name'] . "' , delete_mark='" . $delete_mark . "'
           WHERE id_mobiles=" . @$_GET['id_mobiles'];
		   
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------21-09-2016 Código para cambiar nivel de suspensión y Delete_marck del activo en BD Administrativo  wavetrackAdminPlat, tbl_billing Walmario-------------------------------- 
		$sql4 = "UPDATE tbl_billing SET suspension_level= '".$suspension_level."', delete_mark= '" .$delete_mark. "' WHERE id_mobiles= '".@$_GET['id_mobiles']."'";
		//$sql4 = "UPDATE tbl_billing SET suspension_level= '".$suspension_level."', delete_mark= '" .$delete_mark. "' WHERE name= '".@$_GET['plate']."' AND identification= '".@$_GET['identification']."' AND ip = '".@$_GET['server']."'";
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------			   
		   
		   
    } else {
        $suspension_level = $suspension;
        $delete_mark = 2;
		$sql = $sql . "',suspension_level= '" . $suspension_level . "',
           end_window='" . @$_GET['end_window'] . "',id_business_unit='" . $id_division . "', id_subbusiness_unit='" . $id_subdivision . "', sensor_type='" . $sensor . "',
           modified_by='" . $_SESSION['id'] . "',modified_at= NOW(), modified_from='" . getIP() . "', owner='" . @$_GET['owner'] . "',owner_name='" . @$_GET['owner_name'] . "' , delete_mark='" . $delete_mark . "'
           WHERE id_mobiles=" . @$_GET['id_mobiles'];

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------21-09-2016 Código para cambiar nivel de suspensión y Delete_marck del activo en BD Administrativo  wavetrackAdminPlat, tbl_billing Walmario-------------------------------- 
		$sql4 = "UPDATE tbl_billing SET suspension_level= '".$suspension_level."', delete_mark= '" .$delete_mark. "' WHERE id_mobiles= '".@$_GET['id_mobiles']."'";
		//$sql4 = "UPDATE tbl_billing SET suspension_level= '".$suspension_level."', delete_mark= '" .$delete_mark. "' WHERE name= '".@$_GET['plate']."' AND identification= '".@$_GET['identification']."' AND ip = '".@$_GET['server']."'";	
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------			   
		   
		   
    }
	//Fin - CaDiaz 2016-03-14: Para arreglar cambio de nivel de suspensión al cambiar la división

    /*
    $sql = "UPDATE tbl_mobiles SET identification='" . @$_GET['identification'] . "', imei='" . @$_GET['imei'] . "',sim_id='" . @$_GET['sim_id'] . "', last_total_vehicle_km='" . @$_GET['odometer'] . "'
           ,sim_imsi='" . @$_GET['sim_imsi'] . "',brand='" . @$_GET['brand'] . "',class='" . @$_GET['class'] . "',line='" . @$_GET['line'] . "',model='" . @$_GET['model'] . "', tank_capacity='" . @$_GET['tank_capacity'] . "'
           ,color='" . @$_GET['color'] . "',web_icon='" . @$_GET['web_icon'] . "', start_window='" . @$_GET['start_window'] . "',suspension_level= '" . $suspension_level . "',
           end_window='" . @$_GET['end_window'] . "',id_business_unit='" . $id_division . "', id_subbusiness_unit='" . $id_subdivision . "', sensor_type='" . $sensor . "',
           modified_by='" . $_SESSION['id'] . "',modified_at= NOW(), modified_from='" . getIP() . "', owner='" . @$_GET['owner'] . "',owner_name='" . @$_GET['owner_name'] . "' , delete_mark='" . $delete_mark . "'
           WHERE id_mobiles=" . @$_GET['id_mobiles'];
     */
	 
	//CaDiaz (2016-03-14): En comentario para implementar solucion de cambio de nivel de suspension al cambiar de division:
    /*    $sql = "UPDATE tbl_mobiles SET imei='" . @$_GET['imei'] . "',sim_id='" . @$_GET['sim_id'] . "', last_total_vehicle_km='" . @$_GET['odometer'] . "'
           ,sim_imsi='" . @$_GET['sim_imsi'] . "',brand='" . @$_GET['brand'] . "',class='" . @$_GET['class'] . "',line='" . @$_GET['line'] . "',model='" . @$_GET['model'] . "', tank_capacity='" . @$_GET['tank_capacity'] . "'
           ,color='" . @$_GET['color'] . "',web_icon='" . @$_GET['web_icon'] . "', start_window='" . @$_GET['start_window'] . "',suspension_level= '" . $suspension_level . "',
           end_window='" . @$_GET['end_window'] . "',id_business_unit='" . $id_division . "', id_subbusiness_unit='" . $id_subdivision . "', sensor_type='" . $sensor . "',
           modified_by='" . $_SESSION['id'] . "',modified_at= NOW(), modified_from='" . getIP() . "', owner='" . @$_GET['owner'] . "',owner_name='" . @$_GET['owner_name'] . "' , delete_mark='" . $delete_mark . "'
           WHERE id_mobiles=" . @$_GET['id_mobiles'];*/

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------21-09-2016 Código para cambiar nivel de suspensión y Delete_marck del activo en BD Administrativo  wavetrackAdminPlat, tbl_billing Walmario-------------------------------- 
	if ($suspension != ''){	   
		$result4 = mysqli_query($cnxLocal, $sql4)or die("Error CAMBIO NS Y DM".$sql4."".mysqli_error($cnxLocal));
	}
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------
	
    $result = mysqli_query($cnxTMS, $sql);
    header("location: assets_win_form.php?update_driver=ok&action_form=update&id_mobile=" . @$_GET['id_mobiles']);
}

if ($action == 'delete') {
    $sql = "UPDATE tbl_mobiles SET delete_mark=1 ,modified_by='" . $_SESSION['id'] . "',modified_at= NOW(), modified_from='" . getIP() . "' WHERE id_mobiles=" . @$_GET['id_mobiles'];
    $result = mysqli_query($cnxTMS, $sql);
    header("location: assets_win_form.php?delete_driver=ok&action_form=delete");
}
?>
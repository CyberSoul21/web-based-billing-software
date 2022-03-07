<?php
//Administracion de la sesion
session_start();
if (!isset($_SESSION['id'])) {
    header("location:../index.php");
}
include('../resources/credentials/wavetrack.php');
include('../resources/credentials/mysql.php');
include('../resources/credentials/source_inspector.php');
$cnxLocal = mysqli_connect($db_host, $db_user, $db_pass, $db_name)or die("Error de coneccion local: " . mysqli_error($cnxLocal));
$sql = "select id_servers, name, ip from tbl_servers";
$result = mysqli_query($cnxLocal, $sql);
if (!$result) {
    echo "La consulta SQL contiene errores0.";
}
while ($row = mysqli_fetch_array($result)):
    $ser[] = array($row["ip"], $row["name"]);
endwhile;
$sqla = "SELECT id_suspension_level, name FROM tbl_suspension_level where delete_mark=0  ORDER BY name;";
$resulta = mysqli_query($cnxLocal, $sqla);
if (!$resulta) {
    echo "La consulta SQL contiene errores." . $sqla;
}
$susp = null;
while ($row = mysqli_fetch_array($resulta)) {
    $susp[] = array($row["id_suspension_level"], $row["name"]);
}
$sqlb = "SELECT id_sensor_type, name FROM tbl_sensor_type where delete_mark=0  ORDER BY name;";
$resultb = mysqli_query($cnxLocal, $sqlb);
if (!$resultb) {
    echo "La consulta SQL contiene erroresa." . $sqla;
}
while ($row = mysqli_fetch_array($resultb)):
    $sensor[] = array($row["id_sensor_type"], $row["name"]);
endwhile;
if ($_GET['action_form'] != 'new') {
    $sql = "select id_servers, name, ip from tbl_servers where name='" . @$_GET["server"] . "'";
    $result = mysqli_query($cnxLocal, $sql);
    if (!$result) {
        echo "La consulta SQL contiene errores0.";
    }
    $arr1 = null;
    while ($row = mysqli_fetch_array($result)):
        $arr1[] = array($row["id_servers"], $row["ip"]);
    endwhile;
    $cnxTMS = mysqli_connect($arr1[0][1], $db_user_tms, $db_pass_tms, $db_name_tms)or die("Error de coneccion al servidor: " . mysqli_error($cnxTMS));
    $sql = "SELECT T0.id_mobiles, T0.id_business_unit,T0.id_subbusiness_unit,T1.name as business, T2.name as subbusiness, T0.sensor_type, T0.tank_capacity,
    T0.name, T0.identification, T0.imei, T0.sim_id, T0.sim_imsi, T0.brand, T0.class, T0.line, T0.model, T0.color, T0.plate, T0.id_agreements as agreement,
    T0.web_icon, T0.owner, T0.owner_name, T0.start_window, T0.end_window, T0.suspension_level, T0.apportionment, T0.last_total_vehicle_km
    FROM tbl_mobiles T0 LEFT JOIN tbl_business_unit T1 ON T0.id_business_unit = T1.id_business_unit
LEFT JOIN tbl_subbusiness_unit T2 ON T0.id_subbusiness_unit = T2.id_subbusiness_unit    
WHERE T0.id_mobiles=" . @$_GET['id_mobile'] . ";";

    $result = mysqli_query($cnxTMS, $sql);
    $row = mysqli_fetch_array($result);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>   
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title><?php echo($app_tittle); ?></title> 
        <link rel="shortcut icon" href="../resources/icons/globe.ico"> 
            <link rel="stylesheet" href="type_file/librerias/css/colorpicker.css" type="text/css" />
            <script type="text/javascript" src="type_file/librerias/js/jquery.js"></script>
            <script type="text/javascript" src="type_file/librerias/js/colorpicker.js"></script>
            <style> 
                html, body {background-color:#FFF ;width: 100%; height: 100%; margin: 0px; overflow: hidden;} 
                td {font-family:Tahoma, Geneva, sans-serif;font-size:11px}
                .label_table{width:80px;}
                .btn_style{cursor:pointer;font-family: Arial, Helvetica, sans-serif;font-size: 12px;
                           color: #666666;;border: 1px solid #CCCCCC;height: 25px;width: 80px;
                           background-image: url(../images/diseno/btn/btnsend.jpg);background-position:bottom;
                           background-repeat: repeat-x;background-color: #FFFFFF;}
                .input_text{width:280px;border:#a4bed4 solid thin}
            </style>
            <script type="text/javascript">
                var company = '<?php echo @$_GET['company']; ?>';
                var business = '<?php echo @$_GET['id_business']; ?>';
                var subbusiness = '<?php echo @$_GET['id_subbusiness']; ?>';
                $(document).ready(function () {
                    $("#server").change(function () {
                        dependencia_estado();
                    });
                    $("#company").change(function () {
                        dependencia_ciudad();
                    });
                    $("#id_business_unit").change(function () {
                        dependencia_subdivision();
                    });
                });

                function dependencia_estado()
                {
                    var code = $("#server").val();
                    $.get("scripts/dependencia-estado.php", {code: code, code1: company},
                    function (resultado)
                    {
                        if (resultado == false)
                        {
                        }
                        else
                        {
                            if ('<?php echo @$_GET['action_form'] ?>' != 'new') {
                                $("#company").attr("disabled", true);
                            } else {
                                $("#company").attr("disabled", false);
                            }
                            document.getElementById("company").options.length = 1;
                            $('#company').append(resultado);
                        }
                    }

                    );
                    if ('<?php echo @$_GET['action_form'] ?>' != 'new') {
                        dependencia_ciudad();
                    }
                }
                function dependencia_ciudad()
                {
                    var code1 = $("#server").val();
                    var code = $("#company").val();
                    $.get("scripts/dependencia-ciudades.php?", {code: code, code1: code1, code2: business, code3: company}, function (resultado) {
                        if (resultado == false)
                        {
                        }
                        else
                        {
                            if ('<?php echo @$_GET['action_form'] ?>' == 'delete') {
                                $("#id_business_unit").attr("disabled", true);
                            } else {
                                $("#id_business_unit").attr("disabled", false);
                            }
                            document.getElementById("id_business_unit").options.length = 1;
                            $('#id_business_unit').append(resultado);
                        }
                    });
                    if ('<?php echo @$_GET['action_form'] ?>' != 'new') {
                        dependencia_subdivision();
                    }
                }

                function dependencia_subdivision()
                {
                    var code = $("#id_business_unit").val();
                    var code1 = $("#server").val();
                    $.get("scripts/dependencia-subdivision.php?", {code: code, code1: code1, code2: business, code3: company, code4: subbusiness}, function (resultado) {
                        if (resultado == false)
                        {
                        }
                        else
                        {
                            if ('<?php echo @$_GET['action_form'] ?>' == 'delete') {
                                $("#id_subbusiness_unit").attr("disabled", true);
                            } else {
                                $("#id_subbusiness_unit").attr("disabled", false);
                            }
                            document.getElementById("id_subbusiness_unit").options.length = 1;
                            $('#id_subbusiness_unit').append(resultado);
                        }
                    });
                }

                function doOnload() {
                    document.form_asset.id_subbusiness_unit.disabled = true;
                    document.form_asset.id_business_unit.disabled = true;
                    document.form_asset.company.disabled = true;
                }
                function only_Num(variable) {
                    Numer = parseInt(variable);
                    if (isNaN(Numer))
                        return "";
                    else
                        return Numer;
                }

                function ValNumero(Control) {
                    Control.value = only_Num(Control.value);
                }

                function valid_form_update_driver() {
                    if (document.form_asset.name.value == '' ||
                            document.form_asset.imei.value == '' ||
                            document.form_asset.identification.value == '' ||
                            document.form_asset.odometer.value == '') {
                        alert("Verificar los campos obligatorios");
                    } else {
                        if (document.form_asset.identification.value == '') {
                            document.form_asset.identification.value = 0;
                        }
                        document.form_asset.ip.value = document.form_asset.server.value;
                        document.form_asset.action.value = "update";
                        document.form_asset.submit();
                    }
                }

                function delete_driver() {
                    if (confirm("seguro que desea desactivar este vehiculo")) {
                        document.form_asset.ip.value = document.form_asset.server.value;
                        document.form_asset.action.value = "delete";
                        document.form_asset.submit();
                    }
                }

                function valid_form_new_driver() {
                    if (document.form_asset.name.value == '' || document.form_asset.imei.value == '' || document.form_asset.identification.value == '' || document.form_asset.odometer.value == '') {
                        alert("Verificar los campos obligatorios");
                    } else {
                        if (document.form_asset.identification.value == '') {
                            document.form_asset.identification.value = 0;
                        }
                        var newId = (new Date()).valueOf();
                        document.form_asset.id_mobiles.value = newId;
                        document.form_asset.action.value = "insert";
                        document.form_asset.submit();
                    }
                }
                function check_add_driver() {
                    alert("Vehiculo creado con Exito");
                    parent.dhxWins.window("w1").close();
                }
                function check_add_driver_fail() {
                    alert("El numero de contrato no es valido, Revise la informacion con el asesor de cartera");
                }
                function check_update_driver() {
                    alert("Actualizacion Exitosa");
                    parent.dhxWins.window("w1").close();
                }
                function check_delete_driver() {
                    alert("Vehiculo Desactivado");
                    parent.dhxWins.window("w1").close();
                }
                function close_w1() {
                    parent.dhxWins.window("w1").hide();
                    parent.dhxWins.window("w1").setModal(false);
                }

                function commonTemplate(item) {
                    return "<option value='" + item.Value + "'>" + item.Text + "</option>";
                }
                function commonMatch(selectedValue) {
                    return this.When == selectedValue;
                }
            </script>
            <style> 
                html, body {background-color:#FFF ;width: 100%; height: 100%; margin: 0px; overflow: hidden;} 
                td {font-family:Tahoma, Geneva, sans-serif;font-size:11px}
                .label_table{width:80px;}
                .btn_style{cursor:pointer;font-family: Arial, Helvetica, sans-serif;font-size: 12px;
                           color: #666666;;border: 1px solid #CCCCCC;height: 25px;width: 80px;
                           background-image: url(../images/diseno/btn/btnsend.jpg);background-position:bottom;
                           background-repeat: repeat-x;background-color: #FFFFFF;}
                .input_text{width:280px;border:#a4bed4 solid thin}
                div.scroll
                {
                    width:590x;
                    height:550px;
                    overflow-x:auto;
                }
            </style>
    </head>
    <body onload="<?php
          if (@$_GET['add_driver'] == 'ok') {
              echo('check_add_driver();');
          }if (@$_GET['add_driver'] == 'fail') {
              echo('check_add_driver_fail();');
          }if (@$_GET['update_driver'] == 'ok') {
              echo('check_update_driver();');
          }if (@$_GET['delete_driver'] == 'ok') {
              echo('check_delete_driver();');
          }if (@$_GET['action_form'] != 'new')
              
              ?>dependencia_estado();
        doOnload();">
        <div class="scroll">
            <form name="form_asset" action="assets_form_processor.php" method="pos">
                <table><tr><td style="font-size: 16pt; ">CREACION DE VEHICULOS</td><td></td><td><img src="../resources/images/mobiles.jpg" align="top" /></td></tr></table>
                <table>
<?php
if (@$_GET['action_form'] == 'new') {
    ?>
                        <tr>
                            <td rowspan="2" colspan="2">
                                <table>
                                    <tr><td class="label_table">CONTRATO:</td><td class="label_table">*Odometro:</td></tr>
                                    <tr><td><input class="input_text" type="text" name="agreement" value="<?php echo htmlspecialchars($row["agreement"]); ?>" onkeyUp="return ValNumero(this);"/></td>
                                        <td><input class="input_text" type="text" name="odometer" value="<?php echo htmlspecialchars($row["last_total_vehicle_km"]); ?>"/></td></tr>
                                    <tr></tr><tr></tr>
                                    <tr><td class="label_table">*Nombre:</td><td class="label_table">*Identificador:</td></tr><tr><td>
                                            <input name="id_mobiles" value="<?php echo htmlspecialchars($row["id_mobiles"]); ?>" type="hidden"/>
                                            <input name="action" value="" type="hidden"/>
                                            <input class="input_text" type="text" name="name" value="<?php echo htmlspecialchars($row["name"]); ?>"/></td>
                                        <td><input class="input_text" type="text" name="identification" value="<?php echo htmlspecialchars($row["identification"]); ?>"/></td></tr>
                                    <tr></tr><tr></tr>
                                    <tr><td class="label_table">*IMEI:</td><td class="label_table">*SIM:</td></tr>
                                    <tr><td><input class="input_text" type="text" name="imei" value="<?php echo htmlspecialchars($row["imei"]); ?>" onkeyUp="return ValNumero(this);"/></td>
                                        <td><input class="input_text" type="text" name="sim_id" value="<?php echo htmlspecialchars($row["sim_id"]); ?>"/></td></tr>
                                    <tr></tr><tr></tr>
                                    <tr><td class="label_table">*IMSI:</td><td class="label_table">*Tipo:</td></tr>
                                    <tr><td><input class="input_text" type="text" name="sim_imsi" value="<?php echo htmlspecialchars($row["sim_imsi"]); ?>"/></td>
                                        <td><input class="input_text" type="text" name="class" value="<?php echo htmlspecialchars($row["class"]); ?>"/> </td></tr>
                                    <tr></tr><tr></tr>
                                    <tr><td class="label_table">*Marca:</td><td class="label_table">*Linea:</td></tr>
                                    <tr><td><input class="input_text" type="text" name="brand" value="<?php echo htmlspecialchars($row["brand"]); ?>"/></td>
                                        <td><input class="input_text" type="text" name="line" value="<?php echo htmlspecialchars($row["line"]); ?>"/></td></tr>
                                    <tr></tr><tr></tr>
                                    <tr><td class="label_table">*Modelo:</td><td class="label_table">*Color:</td></tr>
                                    <tr><td><input class="input_text" type="text" name="model" value="<?php echo htmlspecialchars($row["model"]); ?>"/></td>
                                        <td><input class="input_text" type="text" name="color" id="colorpickerField1"  value="<?php echo htmlspecialchars($row["color"]); ?>" /></td></tr>
                                    <tr></tr><tr></tr>
                                    <tr><td class="label_table">*Placa:</td><td class="label_table">*Icono:</td></tr>
                                    <tr><td><input class="input_text" type="text" name="plate" value="<?php echo htmlspecialchars($row["plate"]); ?>"/></td>
                                        <td><input class="input_text" type="text" name="web_icon" value="<?php echo htmlspecialchars($row["web_icon"]); ?>"/></td></tr>
                                    <tr></tr><tr></tr>                                                            
                                    <tr><td class="label_table">*Servidor:</td><td class="label_table">*Compañia:</td></tr><tr>
                                        <td>
                                            <select name='server' id="server" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" >
    <?php for ($i = 0; $i < count($ser); $i++) {
        echo("<option value='" . $ser[$i][0] . "'>" . $ser[$i][1] . "</option>");
    }
    ?>
                                            </select> </td>
                                        <td>
                                            <select name='company' id="company" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" >
                                            </select> </td></tr>
                                    <tr></tr><tr>
                                    </tr>
                                    <tr><td class="label_table">Division:</td><td class="label_table">SubDivision:</td></tr><tr>
                                        <td>
                                            <select name='id_business_unit' id="id_business_unit" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" >        
                                            </select> </td>
                                        <td>
                                            <select name='id_subbusiness_unit' id="id_subbusiness_unit" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" >
                                            </select> </td></tr>
                                    <tr></tr><tr>
                                    </tr>
                                    <tr><td class="label_table">*Prorrateo:</td><td class="label_table">*Nivel de Suspension:</td></tr>
                                    <tr><td><select name="apportionment" id="apportionment" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" >
                                                <option value="0"></option>
                                                <option value="1">SI</option>
                                                <option value="2">NO</option>
                                            </select></td>
                                        <td>
                                            <select name='suspension_level' id="suspension_level" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" >
                                                <option value=''></option>
    <?php
    for ($i = 0; $i < count($susp); $i++) {
        if ($susp[$i][0] == $row["company_status"]) {
            echo("<option value='" . $susp[$i][0] . "' selected>" . $susp[$i][1] . "</option>");
        } else {
            echo("<option value='" . $susp[$i][0] . "' >" . $susp[$i][1] . "</option>");
        }
    }
    ?>
                                            </select>
                                        </td></tr>
                                    <tr></tr><tr></tr> 
                                    <tr><td class="label_table">Inicio de Actividades:</td><td class="label_table">Fin de Actividades:</td></tr>
                                    <tr><td><input class="input_text" type="text" name="start_window" value="<?php echo htmlspecialchars($row["start_window"]); ?>"/></td>
                                        <td><input class="input_text" type="text" name="end_window" value="<?php echo htmlspecialchars($row["end_window"]); ?>"/></td></tr>
                                    <tr><td class="label_table">Tipo de Sensor:</td><td class="label_table">capacidad del tanque</td></tr>
                                    <tr><td><select name='sensor_type' id="sensor_type" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" >
                                                <option value=""></option>
                                            <?php
                                            for ($i = 0; $i < count($sensor); $i++) {
                                                if ($sensor[$i][0] == $row["sensor_type"]) {
                                                    echo("<option value='" . $sensor[$i][0] . "' selected>" . $sensor[$i][1] . "</option>");
                                                } else {
                                                    echo("<option value='" . $sensor[$i][0] . "' >" . $sensor[$i][1] . "</option>");
                                                }
                                            }
                                            ?>
                                            </select></td><td><input class="input_text" type="text" name="tank_capacity" value="<?php echo htmlspecialchars($row["tank_capacity"]); ?>" /></tr>
                                    <tr><td class="label_table">Propietario:</td><td class="label_table">Nombre Propietario:</td></tr>
                                    <tr><td><input class="input_text" type="text" name="owner" value="<?php echo htmlspecialchars($row["owner"]); ?>" /></td>
                                        <td><input class="input_text" type="text" name="owner_name" value="<?php echo htmlspecialchars($row["owner_name"]); ?>" /></td></tr>
                                    <tr>
                                        <td>
                                            <input  name="add" class="btn_style" type="button" id="add" value="Guardar" onclick="valid_form_new_driver();"/>
                                            <input  name="close" class="btn_style" type="button" id="close" value="Cerrar" onclick="close_w1();"/>
<?php
} else if (@$_GET['action_form'] == 'update') {
    if ($_SESSION['rol'] == 3 || $_SESSION['rol'] == "3") {//si el rol es 3 entonces solo puede modificar odometros
        ?>
                                                <tr>
                                                    <td rowspan="2" colspan="2">
                                                        <table>
                                                            <tr><td class="label_table">CONTRATO:</td><td class="label_table">*Odometro:</td></tr>
                                                            <tr><td><input class="input_text" type="text" name="agreement" value="<?php echo htmlspecialchars($row["agreement"]); ?>" onkeyUp="return ValNumero(this);" disabled="true" readonly/></td>
                                                                <td><input class="input_text" type="text" name="odometer" value="<?php echo htmlspecialchars($row["last_total_vehicle_km"]); ?>"/></td></tr>
                                                            <tr></tr><tr></tr>
                                                            <tr><td class="label_table">*Nombre:</td><td class="label_table">*Identificador:</td></tr><tr><td>
                                                                    <input name="id_mobiles" value="<?php echo htmlspecialchars($row["id_mobiles"]); ?>" type="hidden"/>
                                                                    <input name="action" value="" type="hidden"/>
                                                                    <input name="ip" value="" type="hidden"/>
                                                                    <input class="input_text" type="text" name="name" value="<?php echo htmlspecialchars($row["name"]); ?>" /></td>
                                                                <td><input class="input_text" type="text" name="identification" value="<?php echo htmlspecialchars($row["identification"]); ?>"/></td></tr>
                                                            <tr></tr><tr></tr>
                                                            <tr><td class="label_table">*IMEI:</td><td class="label_table">*SIM:</td></tr>
                                                            <tr><td><input class="input_text" type="text" name="imei" value="<?php echo htmlspecialchars($row["imei"]); ?>" onkeyUp="return ValNumero(this);" readonly/></td>
                                                                <td><input class="input_text" type="text" name="sim_id" value="<?php echo htmlspecialchars($row["sim_id"]); ?>" readonly/></td></tr>
                                                            <tr></tr><tr></tr>
                                                            <tr><td class="label_table">*IMSI:</td><td class="label_table">*Tipo:</td></tr>
                                                            <tr><td><input class="input_text" type="text" name="sim_imsi" value="<?php echo htmlspecialchars($row["sim_imsi"]); ?>" readonly/></td>
                                                                <td><input class="input_text" type="text" name="class" value="<?php echo htmlspecialchars($row["class"]); ?>" readonly/></td></tr>
                                                            <tr></tr><tr></tr>
                                                            <tr><td class="label_table">*Marca:</td><td class="label_table">*Linea:</td></tr>
                                                            <tr><td><input class="input_text" type="text" name="brand" value="<?php echo htmlspecialchars($row["brand"]); ?>" readonly/></td>
                                                                <td><input class="input_text" type="text" name="line" value="<?php echo htmlspecialchars($row["line"]); ?>" readonly/></td></tr>
                                                            <tr></tr><tr></tr>
                                                            <tr><td class="label_table">*Modelo:</td><td class="label_table">*Color:</td></tr>
                                                            <tr><td><input class="input_text" type="text" name="model" value="<?php echo htmlspecialchars($row["model"]); ?>" readonly/></td>
                                                                <td><input class="input_text" type="text" name="color" id="colorpickerField1"  value="<?php echo htmlspecialchars($row["color"]); ?>" readonly/></td></tr>
                                                            <tr></tr><tr></tr>
                                                            <tr><td class="label_table">*Placa:</td><td class="label_table">*Icono:</td></tr>
                                                            <tr><td><input class="input_text" type="text" name="plate" value="<?php echo htmlspecialchars($row["plate"]); ?>" /></td>
                                                                <td><input class="input_text" type="text" name="web_icon" value="<?php echo htmlspecialchars($row["web_icon"]); ?>" readonly/></td></tr>
                                                            <tr></tr><tr></tr>                                                            
                                                            <tr><td class="label_table">*Servidor:</td><td class="label_table">*Compañia:</td></tr><tr>
                                                                <td>
                                                                    <select name='server' id="server" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" >
                                                                        <option value=''></option>
        <?php
        for ($i = 0; $i < count($ser); $i++) {
            if ($ser[$i][1] == $_GET['server']) {
                echo("<option value='" . $ser[$i][0] . "' selected>" . $ser[$i][1] . "</option>");
            } else {
                echo("<option value='" . $ser[$i][0] . "'>" . $ser[$i][1] . "</option>");
            }
        }
        ?>
                                                                    </select> </td>
                                                                <td>
                                                                    <select name='company' id="company" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" disabled>
                                                                    </select> </td></tr>
                                                            <tr></tr><tr>
                                                            </tr>
                                                            <tr><td class="label_table">Division:</td><td class="label_table">SubDivision:</td></tr><tr>
                                                                <td>
                                                                    <select name='id_business_unit' id="id_business_unit" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" disabled>        
                                                                    </select> </td>
                                                                <td>
                                                                    <select name='id_subbusiness_unit' id="id_subbusiness_unit" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" disabled>
                                                                    </select> </td></tr>
                                                            <tr></tr><tr>
                                                            </tr>
                                                            <tr><td class="label_table">*Prorrateo:</td><td class="label_table">*Nivel de Suspension:</td></tr>
                                                            <tr><td><select name="apportionment" id="apportionment" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" disabled>
                                                                        <option value="0" <?php if ($row["apportionment"] == "0") {
            echo("selected");
        } ?>></option>
                                                                        <option value="1" <?php if ($row["apportionment"] == "1") {
                                                                    echo("selected");
                                                                } ?>>SI</option>
                                                                        <option value="2" <?php if ($row["apportionment"] == "2") {
                                                                    echo("selected");
                                                                } ?>>NO</option>
                                                                    </select></td>
                                                                <td>
                                                                    <select name='suspension_level' id="suspension_level" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" disabled>
                                                                        <option value='0'>Activo</option>
                                                                    <?php
                                                                    for ($i = 0; $i < count($susp); $i++) {
                                                                        echo $susp[$i][0] . " - " . $row["suspension_level"];
                                                                        if ($susp[$i][0] == $row["suspension_level"]) {
                                                                            echo("<option value='" . $susp[$i][0] . "' selected>" . $susp[$i][1] . "</option>");
                                                                        } else {
                                                                            echo("<option value='" . $susp[$i][0] . "'>" . $susp[$i][1] . "</option>");
                                                                        }
                                                                    }
                                                                    ?>
                                                                    </select>
                                                                </td></tr>
                                                            <tr></tr><tr></tr> 
                                                            <tr><td class="label_table">Inicio de Actividades:</td><td class="label_table">Fin de Actividades:</td></tr>
                                                            <tr><td><input class="input_text" type="text" name="start_window" value="<?php echo htmlspecialchars($row["start_window"]); ?>" readonly/></td>
                                                                <td><input class="input_text" type="text" name="end_window" value="<?php echo htmlspecialchars($row["end_window"]); ?>" readonly/></td></tr>
                                                            <tr><td class="label_table">Tipo de Sensor:</td><td class="label_table">capacidad del tanque</td></tr>
                                                            <tr><td><select name='sensor_type' id="sensor_type" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" disabled>
                                                                        <option value=""></option>
        <?php
        for ($i = 0; $i < count($sensor); $i++) {
            if ($sensor[$i][0] == $row["sensor_type"]) {
                echo("<option value='" . $sensor[$i][0] . "' selected>" . $sensor[$i][1] . "</option>");
            } else {
                echo("<option value='" . $sensor[$i][0] . "' >" . $sensor[$i][1] . "</option>");
            }
        }
        ?>
                                                                    </select></td><td><input class="input_text" type="text" name="tank_capacity" value="<?php echo htmlspecialchars($row["tank_capacity"]); ?>" readonly/></tr>
                                                            <tr><td class="label_table">Propietario:</td><td class="label_table">Nombre Propietario:</td></tr>
                                                            <tr><td><input class="input_text" type="text" name="owner" value="<?php echo htmlspecialchars($row["owner"]); ?>" readonly/></td>
                                                                <td><input class="input_text" type="text" name="owner_name" value="<?php echo htmlspecialchars($row["owner_name"]); ?>" readonly/></td></tr>
                                                            <tr>
                                                                <td>
                                                                    <input  name="update" class="btn_style" type="button" id="update" value="Actualizar" onclick="valid_form_update_driver();"/>
        <?php
    } else if ($_SESSION['rol'] == 2 || $_SESSION['rol'] == "2") {//si es rol 2 solo puede modificar nivel de suspension
        ?>
                                                                    <tr>
                                                                        <td rowspan="2" colspan="2">
                                                                            <table>
                                                                                <tr><td class="label_table">CONTRATO:</td><td class="label_table">*Odometro:</td></tr>
                                                                                <tr><td><input class="input_text" type="text" name="agreement" value="<?php echo htmlspecialchars($row["agreement"]); ?>" onkeyUp="return ValNumero(this);" disabled="true" readonly/></td>
                                                                                    <td><input class="input_text" type="text" name="odometer" value="<?php echo htmlspecialchars($row["last_total_vehicle_km"]); ?>" readonly/></td></tr>
                                                                                <tr></tr><tr></tr>
                                                                                <tr><td class="label_table">*Nombre:</td><td class="label_table">*Identificador:</td></tr><tr><td>
                                                                                        <input name="id_mobiles" value="<?php echo htmlspecialchars($row["id_mobiles"]); ?>" type="hidden"/>
                                                                                        <input name="action" value="" type="hidden"/>
                                                                                        <input name="ip" value="" type="hidden"/>
                                                                                        <input class="input_text" type="text" name="name" value="<?php echo htmlspecialchars($row["name"]); ?>" /></td>
                                                                                    <td><input class="input_text" type="text" name="identification" value="<?php echo htmlspecialchars($row["identification"]); ?>" /></td></tr>
                                                                                <tr></tr><tr></tr>
                                                                                <tr><td class="label_table">*IMEI:</td><td class="label_table">*SIM:</td></tr>
                                                                                <tr><td><input class="input_text" type="text" name="imei" value="<?php echo htmlspecialchars($row["imei"]); ?>" onkeyUp="return ValNumero(this);" readonly/></td>
                                                                                    <td><input class="input_text" type="text" name="sim_id" value="<?php echo htmlspecialchars($row["sim_id"]); ?>" readonly/></td></tr>
                                                                                <tr></tr><tr></tr>
                                                                                <tr><td class="label_table">*IMSI:</td><td class="label_table">*Tipo:</td></tr>
                                                                                <tr><td><input class="input_text" type="text" name="sim_imsi" value="<?php echo htmlspecialchars($row["sim_imsi"]); ?>" readonly/></td>
                                                                                    <td><input class="input_text" type="text" name="class" value="<?php echo htmlspecialchars($row["class"]); ?>" readonly/></td></tr>
                                                                                <tr></tr><tr></tr>
                                                                                <tr><td class="label_table">*Marca:</td><td class="label_table">*Linea:</td></tr>
                                                                                <tr><td><input class="input_text" type="text" name="brand" value="<?php echo htmlspecialchars($row["brand"]); ?>" readonly/></td>
                                                                                    <td><input class="input_text" type="text" name="line" value="<?php echo htmlspecialchars($row["line"]); ?>" readonly/></td></tr>
                                                                                <tr></tr><tr></tr>
                                                                                <tr><td class="label_table">*Modelo:</td><td class="label_table">*Color:</td></tr>
                                                                                <tr><td><input class="input_text" type="text" name="model" value="<?php echo htmlspecialchars($row["model"]); ?>" readonly/></td>
                                                                                    <td><input class="input_text" type="text" name="color" id="colorpickerField1"  value="<?php echo htmlspecialchars($row["color"]); ?>" readonly/></td></tr>
                                                                                <tr></tr><tr></tr>
                                                                                <tr><td class="label_table">*Placa:</td><td class="label_table">*Icono:</td></tr>
                                                                                <tr><td><input class="input_text" type="text" name="plate" value="<?php echo htmlspecialchars($row["plate"]); ?>" /></td>
                                                                                    <td><input class="input_text" type="text" name="web_icon" value="<?php echo htmlspecialchars($row["web_icon"]); ?>" readonly/></td></tr>
                                                                                <tr></tr><tr></tr>                                                            
                                                                                <tr><td class="label_table">*Servidor:</td><td class="label_table">*Compañia:</td></tr><tr>
                                                                                    <td>
                                                                                        <select name='server' id="server" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin"  >
                                                                                            <?php
                                                                                            for ($i = 0; $i < count($ser); $i++) {
                                                                                                if ($ser[$i][1] == $_GET['server']) {
                                                                                                    echo("<option value='" . $ser[$i][0] . "' selected>" . $ser[$i][1] . "</option>");
                                                                                                } else {
                                                                                                    echo("<option value='" . $ser[$i][0] . "'>" . $ser[$i][1] . "</option>");
                                                                                                }
                                                                                            }
                                                                                            ?>
                                                                                        </select> </td>
                                                                                    <td>
                                                                                        <select name='company' id="company" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" disabled>
                                                                                        </select> </td></tr>
                                                                                <tr></tr><tr>
                                                                                </tr>
                                                                                <tr><td class="label_table">Division:</td><td class="label_table">SubDivision:</td></tr><tr>
                                                                                    <td>
                                                                                        <select name='id_business_unit' id="id_business_unit" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" disabled>        
                                                                                        </select> </td>
                                                                                    <td>
                                                                                        <select name='id_subbusiness_unit' id="id_subbusiness_unit" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" disabled>
                                                                                        </select> </td></tr>
                                                                                <tr></tr><tr>
                                                                                </tr>
                                                                                <tr><td class="label_table">*Prorrateo:</td><td class="label_table">*Nivel de Suspension:</td></tr>
                                                                                <tr><td><select name="apportionment" id="apportionment" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" disabled>
                                                                                            <option value="0" <?php if ($row["apportionment"] == "0") {
                                                                                                echo("selected");
                                                                                            } ?>></option>
                                                                                            <option value="1" <?php if ($row["apportionment"] == "1") {
                                                                                                echo("selected");
                                                                                            } ?>>SI</option>
                                                                                            <option value="2" <?php if ($row["apportionment"] == "2") {
                                                                                                echo("selected");
                                                                                            } ?>>NO</option>
                                                                                        </select></td>
                                                                                    <td>
                                                                                        <select name='suspension_level' id="suspension_level" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" >
                                                                                            <option value='0'>Activo</option>
        <?php
        for ($i = 0; $i < count($susp); $i++) {
            echo $susp[$i][0] . " - " . $row["suspension_level"];
            if ($susp[$i][0] == $row["suspension_level"]) {
                echo("<option value='" . $susp[$i][0] . "' selected>" . $susp[$i][1] . "</option>");
            } else {
                echo("<option value='" . $susp[$i][0] . "'>" . $susp[$i][1] . "</option>");
            }
        }
        ?>
                                                                                        </select>
                                                                                    </td></tr>
                                                                                <tr></tr><tr></tr> 
                                                                                <tr><td class="label_table">Inicio de Actividades:</td><td class="label_table">Fin de Actividades:</td></tr>
                                                                                <tr><td><input class="input_text" type="text" name="start_window" value="<?php echo htmlspecialchars($row["start_window"]); ?>" readonly/></td>
                                                                                    <td><input class="input_text" type="text" name="end_window" value="<?php echo htmlspecialchars($row["end_window"]); ?>" readonly/></td></tr>
                                                                                <tr><td class="label_table">Tipo de Sensor:</td><td class="label_table">capacidad del tanque</td></tr>
                                                                                <tr><td><select name='sensor_type' id="sensor_type" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" disabled>
                                                                                            <option value=""></option>
        <?php
        for ($i = 0; $i < count($sensor); $i++) {
            if ($sensor[$i][0] == $row["sensor_type"]) {
                echo("<option value='" . $sensor[$i][0] . "' selected>" . $sensor[$i][1] . "</option>");
            } else {
                echo("<option value='" . $sensor[$i][0] . "' >" . $sensor[$i][1] . "</option>");
            }
        }
        ?>
                                                                                        </select></td><td><input class="input_text" type="text" name="tank_capacity" value="<?php echo htmlspecialchars($row["tank_capacity"]); ?>" readonly/></tr>
                                                                                <tr><td class="label_table">Propietario:</td><td class="label_table">Nombre Propietario:</td></tr>
                                                                                <tr><td><input class="input_text" type="text" name="owner" value="<?php echo htmlspecialchars($row["owner"]); ?>" readonly/></td>
                                                                                    <td><input class="input_text" type="text" name="owner_name" value="<?php echo htmlspecialchars($row["owner_name"]); ?>" readonly/></td></tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <input  name="update" class="btn_style" type="button" id="update" value="Actualizar" onclick="valid_form_update_driver();"/>
        <?php
    } else if ($_SESSION['rol'] == 4 || $_SESSION['rol'] == "4") {//si es rol 4 puede modificar todo menos nivel de suspension
        ?>
                                                                                        <tr>
                                                                                            <td rowspan="2" colspan="2">
                                                                                                <table>
                                                                                                    <tr><td class="label_table">CONTRATO:</td><td class="label_table">*Odometro:</td></tr>
                                                                                                    <tr><td><input class="input_text" type="text" name="agreement" value="<?php echo htmlspecialchars($row["agreement"]); ?>" onkeyUp="return ValNumero(this);" /></td>
                                                                                                        <td><input class="input_text" type="text" name="odometer" value="<?php echo htmlspecialchars($row["last_total_vehicle_km"]); ?>" /></td></tr>
                                                                                                    <tr></tr><tr></tr>
                                                                                                    <tr><td class="label_table">*Nombre:</td><td class="label_table">*Identificador:</td></tr><tr><td>
                                                                                                            <input name="id_mobiles" value="<?php echo htmlspecialchars($row["id_mobiles"]); ?>" type="hidden"/>
                                                                                                            <input name="action" value="" type="hidden"/>
                                                                                                            <input name="ip" value="" type="hidden"/>
                                                                                                            <input class="input_text" type="text" name="name" value="<?php echo htmlspecialchars($row["name"]); ?>" /></td>
                                                                                                        <td><input class="input_text" type="text" name="identification" value="<?php echo htmlspecialchars($row["identification"]); ?>" /></td></tr>
                                                                                                    <tr></tr><tr></tr>
                                                                                                    <tr><td class="label_table">*IMEI:</td><td class="label_table">*SIM:</td></tr>
                                                                                                    <tr><td><input class="input_text" type="text" name="imei" value="<?php echo htmlspecialchars($row["imei"]); ?>" onkeyUp="return ValNumero(this);" /></td>
                                                                                                        <td><input class="input_text" type="text" name="sim_id" value="<?php echo htmlspecialchars($row["sim_id"]); ?>" /></td></tr>
                                                                                                    <tr></tr><tr></tr>
                                                                                                    <tr><td class="label_table">*IMSI:</td><td class="label_table">*Tipo:</td></tr>
                                                                                                    <tr><td><input class="input_text" type="text" name="sim_imsi" value="<?php echo htmlspecialchars($row["sim_imsi"]); ?>" /></td>
                                                                                                        <td><input class="input_text" type="text" name="class" value="<?php echo htmlspecialchars($row["class"]); ?>" /></td></tr>
                                                                                                    <tr></tr><tr></tr>
                                                                                                    <tr><td class="label_table">*Marca:</td><td class="label_table">*Linea:</td></tr>
                                                                                                    <tr><td><input class="input_text" type="text" name="brand" value="<?php echo htmlspecialchars($row["brand"]); ?>" /></td>
                                                                                                        <td><input class="input_text" type="text" name="line" value="<?php echo htmlspecialchars($row["line"]); ?>" /></td></tr>
                                                                                                    <tr></tr><tr></tr>
                                                                                                    <tr><td class="label_table">*Modelo:</td><td class="label_table">*Color:</td></tr>
                                                                                                    <tr><td><input class="input_text" type="text" name="model" value="<?php echo htmlspecialchars($row["model"]); ?>" /></td>
                                                                                                        <td><input class="input_text" type="text" name="color" id="colorpickerField1"  value="<?php echo htmlspecialchars($row["color"]); ?>" /></td></tr>
                                                                                                    <tr></tr><tr></tr>
                                                                                                    <tr><td class="label_table">*Placa:</td><td class="label_table">*Icono:</td></tr>
                                                                                                    <tr><td><input class="input_text" type="text" name="plate" value="<?php echo htmlspecialchars($row["plate"]); ?>"/></td>
                                                                                                        <td><input class="input_text" type="text" name="web_icon" value="<?php echo htmlspecialchars($row["web_icon"]); ?>" /></td></tr>
                                                                                                    <tr></tr><tr></tr>                                                            
                                                                                                    <tr><td class="label_table">*Servidor:</td><td class="label_table">*Compañia:</td></tr><tr>
                                                                                                        <td>
                                                                                                            <select name='server' id="server" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin">
                                                                                                                <?php
                                                                                                                for ($i = 0; $i < count($ser); $i++) {
                                                                                                                    if ($ser[$i][1] == $_GET['server']) {
                                                                                                                        echo("<option value='" . $ser[$i][0] . "' selected>" . $ser[$i][1] . "</option>");
                                                                                                                    } else {
                                                                                                                        echo("<option value='" . $ser[$i][0] . "'>" . $ser[$i][1] . "</option>");
                                                                                                                    }
                                                                                                                }
                                                                                                                ?>
                                                                                                            </select> </td>
                                                                                                        <td>
                                                                                                            <select name='company' id="company" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin">
                                                                                                            </select> </td></tr>
                                                                                                    <tr></tr><tr>
                                                                                                    </tr>
                                                                                                    <tr><td class="label_table">Division:</td><td class="label_table">SubDivision:</td></tr><tr>
                                                                                                        <td>
                                                                                                            <select name='id_business_unit' id="id_business_unit" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin">        
                                                                                                            </select> </td>
                                                                                                        <td>
                                                                                                            <select name='id_subbusiness_unit' id="id_subbusiness_unit" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin">
                                                                                                            </select> </td></tr>
                                                                                                    <tr></tr><tr>
                                                                                                    </tr>
                                                                                                    <tr><td class="label_table">*Prorrateo:</td><td class="label_table">*Nivel de Suspension:</td></tr>
                                                                                                    <tr><td><select name="apportionment" id="apportionment" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin">
                                                                                                                <option value="0" <?php if ($row["apportionment"] == "0") {
                                                                                                                    echo("selected");
                                                                                                                } ?>></option>
                                                                                                                <option value="1" <?php if ($row["apportionment"] == "1") {
                                                                                                                    echo("selected");
                                                                                                                } ?>>SI</option>
                                                                                                                <option value="2" <?php if ($row["apportionment"] == "2") {
                                                                                                                    echo("selected");
                                                                                                                } ?>>NO</option>
                                                                                                            </select></td>
                                                                                                        <td>
                                                                                                            <select name='suspension_level' id="suspension_level" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" disabled>
                                                                                                                <option value='0'>Activo</option>
        <?php
        for ($i = 0; $i < count($susp); $i++) {
            echo $susp[$i][0] . " - " . $row["suspension_level"];
            if ($susp[$i][0] == $row["suspension_level"]) {
                echo("<option value='" . $susp[$i][0] . "' selected>" . $susp[$i][1] . "</option>");
            } else {
                echo("<option value='" . $susp[$i][0] . "'>" . $susp[$i][1] . "</option>");
            }
        }
        ?>
                                                                                                            </select>
                                                                                                        </td></tr>
                                                                                                    <tr></tr><tr></tr> 
                                                                                                    <tr><td class="label_table">Inicio de Actividades:</td><td class="label_table">Fin de Actividades:</td></tr>
                                                                                                    <tr><td><input class="input_text" type="text" name="start_window" value="<?php echo htmlspecialchars($row["start_window"]); ?>" /></td>
                                                                                                        <td><input class="input_text" type="text" name="end_window" value="<?php echo htmlspecialchars($row["end_window"]); ?>" /></td></tr>
                                                                                                    <tr><td class="label_table">Tipo de Sensor:</td><td class="label_table">capacidad del tanque</td></tr>
                                                                                                    <tr><td><select name='sensor_type' id="sensor_type" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin">
                                                                                                                <option value=""></option>
        <?php
        for ($i = 0; $i < count($sensor); $i++) {
            if ($sensor[$i][0] == $row["sensor_type"]) {
                echo("<option value='" . $sensor[$i][0] . "' selected>" . $sensor[$i][1] . "</option>");
            } else {
                echo("<option value='" . $sensor[$i][0] . "' >" . $sensor[$i][1] . "</option>");
            }
        }
        ?>
                                                                                                            </select></td><td><input class="input_text" type="text" name="tank_capacity" value="<?php echo htmlspecialchars($row["tank_capacity"]); ?>" /></tr>
                                                                                                    <tr><td class="label_table">Propietario:</td><td class="label_table">Nombre Propietario:</td></tr>
                                                                                                    <tr><td><input class="input_text" type="text" name="owner" value="<?php echo htmlspecialchars($row["owner"]); ?>" /></td>
                                                                                                        <td><input class="input_text" type="text" name="owner_name" value="<?php echo htmlspecialchars($row["owner_name"]); ?>" /></td></tr>
                                                                                                    <tr>
                                                                                                        <td>
                                                                                                            <input  name="update" class="btn_style" type="button" id="update" value="Actualizar" onclick="valid_form_update_driver();"/>
        <?php
    } else {//si NO es rol 2 o 3 o 4 entonces puede modificar todo
        ?>
                                                                                                            <tr>
                                                                                                                <td rowspan="2" colspan="2">
                                                                                                                    <table>
                                                                                                                        <tr><td class="label_table">CONTRATO:</td><td class="label_table">*Odometro:</td></tr>
                                                                                                                        <tr><td><input class="input_text" type="text" name="agreement" value="<?php echo htmlspecialchars($row["agreement"]); ?>" onkeyUp="return ValNumero(this);" disabled="true"/></td>
                                                                                                                            <td><input class="input_text" type="text" name="odometer" value="<?php echo htmlspecialchars($row["last_total_vehicle_km"]); ?>"/></td></tr>
                                                                                                                        <tr></tr><tr></tr>
                                                                                                                        <tr><td class="label_table">*Nombre:</td><td class="label_table">*Identificador:</td></tr><tr><td>
                                                                                                                                <input name="id_mobiles" value="<?php echo htmlspecialchars($row["id_mobiles"]); ?>" type="hidden"/>
                                                                                                                                <input name="action" value="" type="hidden"/>
                                                                                                                                <input name="ip" value="" type="hidden"/>
                                                                                                                                <input class="input_text" type="text" name="name" value="<?php echo htmlspecialchars($row["name"]); ?>" disabled="true"/></td>
                                                                                                                            <td><input class="input_text" type="text" name="identification" value="<?php echo htmlspecialchars($row["identification"]); ?>"  /></td></tr>
                                                                                                                        <tr></tr><tr></tr>
                                                                                                                        <tr><td class="label_table">*IMEI:</td><td class="label_table">*SIM:</td></tr>
                                                                                                                        <tr><td><input class="input_text" type="text" name="imei" value="<?php echo htmlspecialchars($row["imei"]); ?>" onkeyUp="return ValNumero(this);"/></td>
                                                                                                                            <td><input class="input_text" type="text" name="sim_id" value="<?php echo htmlspecialchars($row["sim_id"]); ?>"/></td></tr>
                                                                                                                        <tr></tr><tr></tr>
                                                                                                                        <tr><td class="label_table">*IMSI:</td><td class="label_table">*Tipo:</td></tr>
                                                                                                                        <tr><td><input class="input_text" type="text" name="sim_imsi" value="<?php echo htmlspecialchars($row["sim_imsi"]); ?>"/></td>
                                                                                                                            <td><input class="input_text" type="text" name="class" value="<?php echo htmlspecialchars($row["class"]); ?>"/> </td></tr>
                                                                                                                        <tr></tr><tr></tr>
                                                                                                                        <tr><td class="label_table">*Marca:</td><td class="label_table">*Linea:</td></tr>
                                                                                                                        <tr><td><input class="input_text" type="text" name="brand" value="<?php echo htmlspecialchars($row["brand"]); ?>"/></td>
                                                                                                                            <td><input class="input_text" type="text" name="line" value="<?php echo htmlspecialchars($row["line"]); ?>"/></td></tr>
                                                                                                                        <tr></tr><tr></tr>
                                                                                                                        <tr><td class="label_table">*Modelo:</td><td class="label_table">*Color:</td></tr>
                                                                                                                        <tr><td><input class="input_text" type="text" name="model" value="<?php echo htmlspecialchars($row["model"]); ?>"/></td>
                                                                                                                            <td><input class="input_text" type="text" name="color" id="colorpickerField1"  value="<?php echo htmlspecialchars($row["color"]); ?>" /></td></tr>
                                                                                                                        <tr></tr><tr></tr>
                                                                                                                        <tr><td class="label_table">*Placa:</td><td class="label_table">*Icono:</td></tr>
                                                                                                                        <tr><td><input class="input_text" type="text" name="plate" value="<?php echo htmlspecialchars($row["plate"]); ?>" /></td>
                                                                                                                            <td><input class="input_text" type="text" name="web_icon" value="<?php echo htmlspecialchars($row["web_icon"]); ?>"/></td></tr>
                                                                                                                        <tr></tr><tr></tr>                                                            
                                                                                                                        <tr><td class="label_table">*Servidor:</td><td class="label_table">*Compañia:</td></tr><tr>
                                                                                                                            <td>
                                                                                                                                <select name='server' id="server" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin"  >                                                                                                                                   
        <?php
        for ($i = 0; $i < count($ser); $i++) {
            if ($ser[$i][1] == $_GET['server']) {
                echo("<option value='" . $ser[$i][0] . "' selected>" . $ser[$i][1] . "</option>");
            } else {
                echo("<option value='" . $ser[$i][0] . "'>" . $ser[$i][1] . "</option>");
            }
        }
        ?>
                                                                                                                                </select> </td>
                                                                                                                            <td>
                                                                                                                                <select name='company' id="company" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" >
                                                                                                                                </select> </td></tr>
                                                                                                                        <tr></tr><tr>
                                                                                                                        </tr>
                                                                                                                        <tr><td class="label_table">Division:</td><td class="label_table">SubDivision:</td></tr><tr>
                                                                                                                            <td>
                                                                                                                                <select name='id_business_unit' id="id_business_unit" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" >        
                                                                                                                                </select> </td>
                                                                                                                            <td>
                                                                                                                                <select name='id_subbusiness_unit' id="id_subbusiness_unit" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" >
                                                                                                                                </select> </td></tr>
                                                                                                                        <tr></tr><tr>
                                                                                                                        </tr>
                                                                                                                        <tr><td class="label_table">*Prorrateo:</td><td class="label_table">*Nivel de Suspension:</td></tr>
                                                                                                                        <tr><td><select name="apportionment" id="apportionment" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" >
                                                                                                                                    <option value="0" <?php if ($row["apportionment"] == "0") {
            echo("selected");
        } ?>></option>
                                                                                                                                    <option value="1" <?php if ($row["apportionment"] == "1") {
            echo("selected");
        } ?>>SI</option>
                                                                                                                                    <option value="2" <?php if ($row["apportionment"] == "2") {
            echo("selected");
        } ?>>NO</option>
                                                                                                                                </select></td>
                                                                                                                            <td><select name='suspension_level' id="suspension_level" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" >
                                                                                                                                    <option value='0'>Activo</option>
        <?php
        for ($i = 0; $i < count($susp); $i++) {
            echo $susp[$i][0] . " - " . $row["suspension_level"];
            if ($susp[$i][0] == $row["suspension_level"]) {
                echo("<option value='" . $susp[$i][0] . "' selected>" . $susp[$i][1] . "</option>");
            } else {
                echo("<option value='" . $susp[$i][0] . "'>" . $susp[$i][1] . "</option>");
            }
        }
        ?>
                                                                                                                                </select></td></tr>
                                                                                                                        <tr></tr><tr></tr> 
                                                                                                                        <tr><td class="label_table">Inicio de Actividades:</td><td class="label_table">Fin de Actividades:</td></tr>
                                                                                                                        <tr><td><input class="input_text" type="text" name="start_window" value="<?php echo htmlspecialchars($row["start_window"]); ?>"/></td>
                                                                                                                            <td><input class="input_text" type="text" name="end_window" value="<?php echo htmlspecialchars($row["end_window"]); ?>"/></td></tr>
                                                                                                                        <tr><td class="label_table">Tipo de Sensor:</td><td class="label_table">capacidad del tanque</td></tr>
                                                                                                                        <tr><td><select name='sensor_type' id="sensor_type" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" >
                                                                                                                                    <option value=""></option>
        <?php
        for ($i = 0; $i < count($sensor); $i++) {
            if ($sensor[$i][0] == $row["sensor_type"]) {
                echo("<option value='" . $sensor[$i][0] . "' selected>" . $sensor[$i][1] . "</option>");
            } else {
                echo("<option value='" . $sensor[$i][0] . "' >" . $sensor[$i][1] . "</option>");
            }
        }
        ?>
                                                                                                                                </select></td><td><input class="input_text" type="text" name="tank_capacity" value="<?php echo htmlspecialchars($row["tank_capacity"]); ?>" /></tr>
                                                                                                                        <tr><td class="label_table">Propietario:</td><td class="label_table">Nombre Propietario:</td></tr>
                                                                                                                        <tr><td><input class="input_text" type="text" name="owner" value="<?php echo htmlspecialchars($row["owner"]); ?>" /></td>
                                                                                                                            <td><input class="input_text" type="text" name="owner_name" value="<?php echo htmlspecialchars($row["owner_name"]); ?>" /></td></tr>
                                                                                                                        <tr>
                                                                                                                            <td>
                                                                                                                                <input  name="update" class="btn_style" type="button" id="update" value="Actualizar" onclick="valid_form_update_driver();"/>
        <?php
    }
} else if (@$_GET['action_form'] == 'delete') {
    for ($i = 0; $i < count($ser); $i++) {
        if ($ser[$i][1] == $_GET['server']) {
            echo("<option value='" . $ser[$i][0] . "' selected>" . $ser[$i][1] . "</option>");
        } else {
            echo("<option value='" . $ser[$i][0] . "'>" . $ser[$i][1] . "</option>");
        }
    }
    ?>
                                                                                                                                                </select> </td>
                                                                                                                                            <td>
                                                                                                                                                <select name='company' id="company" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" disabled="true">
                                                                                                                                                </select> </td></tr>
                                                                                                                                        <tr></tr><tr>
                                                                                                                                        </tr>
                                                                                                                                        <tr><td class="label_table">Division:</td><td class="label_table">SubDivision:</td></tr><tr>
                                                                                                                                            <td>
                                                                                                                                                <select name='id_business_unit' id="id_business_unit" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" disabled="true">        
                                                                                                                                                </select> </td>
                                                                                                                                            <td>
                                                                                                                                                <select name='id_subbusiness_unit' id="id_subbusiness_unit" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" disabled="true">
                                                                                                                                                </select> </td></tr>
                                                                                                                                        <tr></tr><tr>
                                                                                                                                        </tr>
                                                                                                                                        <tr><td class="label_table">*Prorrateo:</td><td class="label_table">*Nivel de Suspension:</td></tr>
                                                                                                                                        <tr><td><select name="apportionment" id="apportionment" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" disabled="false">
                                                                                                                                                    <option value="0" <?php if ($row["apportionment"] == "0") {
        echo("selected");
    } ?>></option>
                                                                                                                                                    <option value="1" <?php if ($row["apportionment"] == "1") {
        echo("selected");
    } ?>>SI</option>
                                                                                                                                                    <option value="2" <?php if ($row["apportionment"] == "2") {
        echo("selected");
    } ?>>NO</option>
                                                                                                                                                </select></td>
                                                                                                                                            <td>
                                                                                                                                                <select name='suspension_level' id="suspension_level" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" disabled="true">
                                                                                                                                                    <option value=""></option>
    <?php
    for ($i = 0; $i < count($susp); $i++) {
        if ($susp[$i][0] == $row["suspension_level"]) {
            echo("<option value='" . $susp[$i][0] . "' selected>" . $susp[$i][1] . "</option>");
        } else {
            echo("<option value='" . $susp[$i][0] . "' >" . $susp[$i][1] . "</option>");
        }
    }
    ?>
                                                                                                                                                </select>
                                                                                                                                            </td></tr>
                                                                                                                                        <tr></tr><tr></tr> 
                                                                                                                                        <tr><td class="label_table">Inicio de Actividades:</td><td class="label_table">Fin de Actividades:</td></tr>
                                                                                                                                        <tr><td><input class="input_text" type="text" name="start_window" value="<?php echo htmlspecialchars($row["start_window"]); ?>" disabled="true"/></td>
                                                                                                                                            <td><input class="input_text" type="text" name="end_window" value="<?php echo htmlspecialchars($row["end_window"]); ?>" disabled="true"/></td></tr>
                                                                                                                                        <tr><td class="label_table">Tipo de Sensor:</td><td class="label_table">capacidad del tanque</td></tr>
                                                                                                                                        <tr><td><select name='sensor_type' id="sensor_type" style="width:280px;font-family:Tahoma, Geneva, sans-serif;font-size:11px;border:#a4bed4 solid thin" >
                                                                                                                                                    <option value=""></option>
    <?php
    for ($i = 0; $i < count($sensor); $i++) {
        if ($sensor[$i][0] == $row["sensor_type"]) {
            echo("<option value='" . $sensor[$i][0] . "' selected>" . $sensor[$i][1] . "</option>");
        } else {
            echo("<option value='" . $sensor[$i][0] . "' >" . $sensor[$i][1] . "</option>");
        }
    }
    ?>
                                                                                                                                                </select></td><td><input class="input_text" type="text" name="tank_capacity" value="<?php echo htmlspecialchars($row["tank_capacity"]); ?>" /></tr>
                                                                                                                                        <tr><td class="label_table">Propietario:</td><td class="label_table">Nombre Propietario:</td></tr>
                                                                                                                                        <tr><td><input class="input_text" type="text" name="owner" value="<?php echo htmlspecialchars($row["owner"]); ?>" disabled="true"/></td>
                                                                                                                                            <td><input class="input_text" type="text" name="owner_name" value="<?php echo htmlspecialchars($row["owner_name"]); ?>" disabled="true"/></td></tr>
                                                                                                                                        <tr>
                                                                                                                                            <td>
                                                                                                                                                <input  name="delete" class="btn_style" type="button" id="delete" value="ELIMINAR" onclick="delete_driver();"/>
<?php } ?>
                                                                                                                                            *Campos Obligatorios 
                                                                                                                                        </td>
                                                                                                                                    </tr>
                                                                                                                                </table>
                                                                                                                            </td> 
                                                                                                                        </tr>
                                                                                                                        </table>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </table>
                                                                                                            </form>
                                                                                                            </div>
                                                                                                            <script>
                                                                                                                $('#colorpickerField1').ColorPicker({color: '#0000ff',
                                                                                                                    onShow: function (colpkr) {
                                                                                                                        $(colpkr).fadeIn(500);
                                                                                                                        return false;
                                                                                                                    },
                                                                                                                    onHide: function (colpkr) {
                                                                                                                        $(colpkr).fadeOut(500);
                                                                                                                        return false;
                                                                                                                    },
                                                                                                                    onChange: function (hsb, hex, rgb) {
                                                                                                                        $('#colorpickerField1').css('background', '#' + hex);
                                                                                                                        $("#colorpickerField1").val('#' + hex);
                                                                                                                    }
                                                                                                                });

                                                                                                            </script>
                                                                                                            </body>
                                                                                                            </html>
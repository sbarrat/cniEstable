<?php
/* TODO: Almacenaje: Seleccionas un cliente y sale el almacenaje de años anteriores.
 * Programarse para qwu se vea solo el año en curso y especificar el iva al 18%
 *
 *
 */
require_once '../inc/Cni.php';
$sql = "Select Id, Nombre FROM clientes 
        WHERE 
        `Estado_de_cliente` LIKE '-1' OR 
        `Estado_de_cliente` LIKE 'on'
        ORDER BY Nombre";
$clientes = Cni::consulta($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="pragma" content="no-cache" />
<script type="text/javascript" src="../js/prototype.js" ></script>
<script type="text/javascript" src="../js/calendar.js"></script>
<script type="text/javascript" src="../js/lang/calendar-es.js"></script>
<script type="text/javascript" src="../js/calendar-setup.js"></script>
<script src="js/aplicacion.js" type="text/javascript"></script>
<link href="../estilo/cni.css" rel="stylesheet" type="text/css">
<link href="../estilo/calendario.css" rel="stylesheet" type="text/css">
<title>Gestión Almacenaje</title>
</head>
<body>
<div class='formulario'>
    <br/>
    Seleccione Cliente: <select id='cliente' onchange='abreform()'>
    <option value='0'>--Seleccione cliente--</option>
<?php
foreach ($clientes as $key => $cliente) {
    echo "<option value='".$cliente['Id']."'>".$cliente['Nombre']."</option>";
}
?>
    </select>
    <span class='boton' onclick='abre()'>[R]Recargar Cliente</span>
    <span class='boton' onclick='window.close()'>[X]Cerrar</span>
    <br/>
    <div id='formulario_almacen'></div>
</div>
<div id='tabla_datos'></div>
<div id='consulta'></div>
<div id='observa'></div>
<div id='modificar'></div>
</body>
</html>
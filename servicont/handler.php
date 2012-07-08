<?php
/**
 * Manejador de peticiones de estadisticas
 */
require_once '../inc/variables.php';
require_once '../inc/Datos.php';
$clientes = new Datos('clientes');
$categorias = new Datos('categorías clientes');
$servicios = new Datos('servicios2');
if ( isset($_POST['form'])) {
    ?>
    <form name='consulta' id='consulta' method='post' onsubmit='procesa();return false'>
        <input type='hidden' name='formu' id='formu' value='<?=$_POST['form'];?>'>
        <select name='clientes' id='clientes'>
            <option value='0'> -- Seleccione Cliente -- </option>
    <?php
    foreach ($clientes->getTodosDatos() as $value) {
        echo "<option value='".$value['Id']."'>".$value['Nombre']."</option>";
    }
    ?>
        </select>
        <select name='categorias' id='categorias'>
            <option value='0'> -- Seleccione Categoria -- </option>
    <?php
    foreach ($categorias->getTodosDatos() as $value) {
        echo "<option value='".$value['Id']."'>".$value['Nombre']."</option>";
    }
    ?>
        </select>
        <select name='servicios' id='servicios'>
            <option value='0'> -- Seleccione Servicio -- </option>
    <?php
    foreach ($servicios->getTodosDatos() as $value) {
        echo "<option value='".$value['Id']."'>".$value['Nombre']."</option>";
    }
    ?>
        </select>
        <br/>
        <label for='fechaInicial'>Fecha Inicial:</label>
        <input type='text' id='fechaInicial' name='fechaInicial'></input>
        <button type='button' class='calendario' id='botonFechaInicial'></button>
        <label for='fechaFinal'>Fecha Final:</label>
        <input type='text' id='fechaFinal' name='fechaFinal'></input>
        <button type='button' class='calendario' id='botonFechaFinal'></button>
        <input type='radio' name='tipo' value='acumulado' checked='checked'> Acumulado
        <input type='radio' name='tipo' value='detallado'> Detallado
        <input type='radio' name='tipo' value='comparativa'>Comparativa
        <input type='submit' value='&raquo; Buscar'/>     
    </form>
    <script type='text/javascript'>
    camposFecha();
    </script>    
    <?php
}
<?php
/**
 * Index File Doc Comment
 * 
 * Fichero principal de la aplicacion
 * 
 * Pagina principal de la aplicación, aparece por defecto el formulario de 
 * acceso, si se accede con el usuario aparece la pagina principal de la
 * aplicacion
 * 
 * PHP Version 5.2.6
 * 
 * @author  Ruben Lacasa <ruben@ensenalia.com>
 * @package cniEstable
 * @license Creative Commons Atribución-NoComercial-SinDerivadas 3.0 Unported
 * @version 2.0e Estable
 * @link    https://github.com/sbarrat/cniEstable
 * 
 * @todo Crear fichero de clases estaticas para uso en toda la aplicacion
 * @todo Revision de codigo y standard
 */
require_once 'inc/variables.php';
Cni::checkSession();
$mensaje = '';
if ( isset($_GET['exit']) ) {
    $mensaje = "<span class='ok'>Sesión Cerrada</span>";
}
if ( isset($_GET['error']) ) {
    $mensaje = "<span class='ko'>Usuario/Contraseña Incorrecta</span>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="estilo/cni.css" rel="stylesheet" type="text/css">
<link href="estilo/calendario.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src='js/prototype.js'></script>
<script type="text/javascript" src="js/calendar.js"></script>
<script type="text/javascript" src="js/lang/calendar-es.js"></script>
<script type="text/javascript" src="js/calendar-setup.js"></script>
<script type="text/javascript" src='js/independencia.js'></script>
<title>
    Principal - <?php Cni::APLICACION; ?> - <?php echo Cni::VERSION; ?>
</title>
</head>
<body>
<div id='cuerpo'>
<?php
if ( isset($_SESSION['usuario']) ) {
    include_once 'inc/menu.php';
} else {
    ?>
    <div id='registro'>
    <center>
    <!-- 	    <img src='imagenes/logotipo2.png' width='538px'  -->
    <!-- 	        alt='The Perfect Place' /> -->
    </center>
    <p />
    <center>
        <?php echo $mensaje; ?>
	    <form id='login_usuario' method='post' action='inc/valida.php'>
	        <table width='30%' class="login">
  	            <tr>
  	                <td align='right'>
	                    Usuario:
	                </td>
	                <td>
	                    <input type='text' id="usuario" name="usuario" 
	                        title='Introduzca su usuario' tabindex="1" />
	                </td>
	            </tr>
	            <tr>
	                <td align='right'>
	                    Contraseña:
	                </td>
	                <td>
	                    <input type='password' id="passwd" name="passwd" 
	                        title='Introduzca su contraseña' tabindex="2" />
	                </td>
	            </tr>
	            <tr>
	                <td align='center' colspan="2">
	                    <input type='submit' class='boton' tabindex="3"  
	                        title='Haga clic para entrar' 
	                        value = '[->]Entrar' />
	                </td>
	            </tr>
	            <tr>
	                <td colspan='2'></td>
	            </tr>
	        </table>
	    </form>
    </center>
    <p />
    <center>
        <p>
  	        <span class="etiqueta">Desarrollado por:</span>
        </p>
        <p>
  	        <a href='http://www.ensenalia.com'>
  	            <img src='imagenes/ensenalia.jpg' width='128' /> 
  	        </a>
  	        <a rel="license" 
  	            href="http://creativecommons.org/licenses/by-nc-nd/3.0/">
  	            <img alt="Licencia Creative Commons" style="border-width:0" 
  	            src="http://i.creativecommons.org/l/by-nc-nd/3.0/80x15.png" />
  	        </a>  
        </p>
    </center>
    </div>
    <?php 
    } // Fin del formulario en la seccion de no registrado 
?>
</div>
<div id='datos_interesantes'></div>
<div id='debug'></div>
<?php 
if ( isset($_SESSION['usuario']) ) {
    echo "<div id='avisos'>";
    include_once 'inc/avisos.php';//Se muestran los avisos solo con el include
    echo "</div>";
    echo "<div id='resultados'></div>";//linea de los resultados de busqueda
    echo "<div id='formulario'></div>";//linea del formulario
}
?>
</body>
</html>
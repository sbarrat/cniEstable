<?php 
/**
 * Variables File Doc Comment
 *
 * Funciones ,constantes y variables requeridas por la aplicacion
 *
 * Conjunto de Funciones, constantes y variables usadas en toda la aplicación
 * que se definen en este fichero
 *
 * PHP Version 5.2.6
 *
 * @author  Ruben Lacasa <ruben@ensenalia.com>
 * @package cniEstable/inc
 * @license Creative Commons Atribución-NoComercial-SinDerivadas 3.0 Unported
 * @version 2.0e Estable
 * @link    https://github.com/sbarrat/cniEstable
 *
 * @todo Crear fichero de clases estaticas para uso en toda la aplicacion
 * @todo Revision de codigo y standard
 */
error_reporting(0);
/**
 * Establecemos la zona horaria 
 */ 
date_default_timezone_set('Europe/Madrid'); 
/**
 * Version de la aplicación
 * 
 * @var string
 */
define('VERSION', '2.0e');
/**
 * Titulo de la aplicación
 * 
 * @var string
 */
define('APLICACION', 'Aplicación Gestión Independencia Centro Negocios');
/**
 * Iva Generico a utilizar en la aplicación
 * @var integer
 */
define('IVA', 18);
/**
 * Precio Generico del almacenaje
 * @var integer
 */
define('ALMACENAJE', 0.70);
/**
 * Conexion a la base de datos
 * 
 * @var resource $con
 * @deprecated - Sustituir por clase de conexion
 */
$con = mysql_connect('localhost', 'cni', 'inc') or die (mysql_error());
/**
 * Establecemos el juego de caracteres de la conexion
 */
mysql_set_charset('utf8', $con);
/**
 * Nombre de la tabla
 * 
 * @deprecated - establecerlo dentro de la funcion mysql_select_db
 * @var string
 */
$dbname = 'centro'; 
mysql_select_db($dbname, $con);
/**
 * Imagen en el mensaje de correcto
 * 
 * @deprecated - Estan siendo retiradas de donde aparecian
 * @var string
 */
define('OK', 'imagenes/clean.png');
/**
 * Imagen en el mensaje de error
 * @deprecated - Estan siendo retiradas de donde aparecian
 * @var string
 */
define('NOK', 'imagenes/error.png');
//define("SISTEMA","*nix");
/**
 * Define el sistema operativo donde va a trabajar la aplicacion
 * 
 * @var string
 */
define('SISTEMA', 'windows');
/**
 * Establecemos las locales del sistema
 */
setlocale(LC_ALL, 'es_ES');
setlocale(LC_NUMERIC, 'es_ES');
/**
 * Clase Estatica
 */
require_once 'Cni.php';
require_once 'CniQuery.php';
/**
 * Devuelve el precio formateado con 2 decimales separados por , miles . y
 * el simbolo del Euro;
 * @param integer $number
 * @deprecated - cambiar a Cni::formatoDinero
 */
function formatoDinero( $number )
{
    return Cni::formatoDinero($number);
}
/**
 * Devuelve el numero formateado con 2 decimales separados por , y miles .
 * @param unknown_type $number
 * @deprecated - Cambiar a Cni::formatoNoDinero
 */
function formatoNoDinero( $number )
{
    return Cni::formatoNoDinero($number);
}
/**
 * Chequea si la sesion se ha iniciado
 * @deprecated - Cambiar a Cni::checkSession()
 */
function checkSession()
{
    Cni::checkSession();
}
/**
 * Devuelve el tipo de clase css que sera el campo
 * 
 * @param integer $k
 * @return string
 * @deprecated - Cambiar a Cni::clase($k)
 */
function clase($k)
{
    Cni::clase($k);
}
/**
 * Se le puede pasar como parametro un array o una string y la sanea
 *
 * @param mixed $vars
 * @todo - Cambiar a clase de conexion de base de datos
 * @deprecated - usar CniDB::sanitize()
 */
function sanitize( &$vars )
{
    global $con;
    if ( is_array($vars) ) {
        foreach ( $vars as &$var ) {
            mysql_real_escape_string($var, $con);
        }
    } elseif ( is_string($vars) ) {
        mysql_real_escape_string($vars, $con);
    }
}
/**
 * Convierte el texto a utf8
 * 
 * @deprecated - Borrar donde aparezca
 * @param string $texto
 * @return string $texto
 */
function traduce($texto)
{
    return $texto;
}
/**
 * Traduce el texto de utf8
 * 
 * @deprecated - Borrar donde aparezca
 * @param string $texto
 * @return string $texto
 */
function codifica($texto)
{
    return $texto;
}
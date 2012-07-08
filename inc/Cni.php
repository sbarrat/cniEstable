<?php
/**
 * Cni File Doc Comment
 *
 * Clase estatica de la aplicacion
 *
 * Conjunto de funciones usadas a lo largo de toda la aplicacion
 *
 * PHP Version 5.2.6
 *
 * @author  Ruben Lacasa <ruben@ensenalia.com>
 * @package cniEstable/inc
 * @license Creative Commons Atribución-NoComercial-SinDerivadas 3.0 Unported
 * @version 2.0e Estable
 * @link    https://github.com/sbarrat/cniEstable
 */
/**
 * Cni Class Doc Comment
 * 
 * Funciones estaticas generales de toda la aplicacion
 *
 */
require_once 'CniDB.php';
final class Cni
{
    const SISTEMA = 'windows';
    const ALMACENAJE = 0.70;
    const IVA = 18;
    const APLICACION = 'Aplicación Gestión Independencia Centro Negocios';
    const VERSION = '2.0e';
    
    public static function initApp()
    {
        error_reporting(0);
        date_default_timezone_set('Europe/Madrid');
        setlocale(LC_ALL, 'es_ES');
        setlocale(LC_NUMERIC, 'es_ES');
    }
    /**
     * Devuelve el precio formateado con 2 decimales separados por, miles . y
     * el simbolo del Euro
     * 
     * @param string $number
     * @return string
     */
    public static function formatoDinero($number)
    {
        if ( SISTEMA == "windows" ) {
            $number = number_format($number, 2, ',', '.')."&euro;";
        } else {
            $number = money_format('%n', $number);
        }
        return $number;
    }
    /**
     * Devuelve el numero formateado con 2 decimales separados por , y miles .
     * 
     * @param string $number
     * @return string
     */
    public static function formatoNoDinero( $number ) 
    {
        $number = number_format($number, 2, ',', '.');
        return $number;
    }
    /**
     * Chequea si la sesion se ha iniciado, si no la inicia
     */
    public static function checkSession()
    {
        if ( session_id() != null ) {
            session_regenerate_id();
        } else {
            session_start();
        }
    }
    /**
     * Devuelve la clase a usar dependiendo del numero pasado
     * 
     * @param integer $k
     * @return string
     */
    public static function clase( $numeroLinea )
    {
        return ( $numeroLinea % 2 == 0 ) ? 'par' : 'impar';
    }
    /**
     * Ejecuta la consulta y devuelve los resultados
     * 
     * @param string $sql
     * @param integer $type PDO::FETCH_BOTH, PDO::FETCH_ASSOC
     * @return resource
     */
    public static function consulta( $sql, $type = PDO::FETCH_BOTH )
    {
        try {
            $con = CniDB::connect();
            return $con->query($sql, $type);
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }
    /**
     * Sanea las variables
     * 
     * @param multitype:string|array $vars
     * @param integer $type - INPUT_POST, INPUT_GET
     * @return mixed:string|array
     */
    public static function sanitize( $vars, $type = INPUT_POST ) 
    {
        if ( is_array($vars) ) {
            reset($vars);
            while ( current($vars) ) {
                $newVar[key($vars)] = filter_input($type, key($vars));
                next($vars);
            }
        } else {
            $newVar = filter_input($type, $vars);
        }
        return $newVar;
    }
}
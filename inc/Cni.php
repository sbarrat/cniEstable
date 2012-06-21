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
final class Cni
{
    /**
     * Devuelve el precio formateado con 2 decimales separados por , miles . y
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
     * @param integer $k
     * @return string
     */
    public static function clase($k)
    {
        return ( $k%2 == 0 ) ? 'par' : 'impar';
    }
    
}

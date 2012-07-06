<?php
/**
 * Avisos File Doc Comment
 *
 * Gestiona los avisos de la aplicación
 *
 * Clase que muestra los distintos avisos de la aplicacion
 *
 * PHP Version 5.2.6
 *
 * @author  Ruben Lacasa <ruben@ensenalia.com>
 * @package cniEstable/inc
 * @license Creative Commons Atribución-NoComercial-SinDerivadas 3.0 Unported
 * @version 2.0e Estable
 * @link    https://github.com/sbarrat/cniEstable
 */
require_once 'Cni.php';
/**
 * Avisos Class Doc Comment
 *
 * Funciones estaticas de trabajo con la base de datos
 *
 */
class Avisos
{
    // TODO - Insert your code here
    private $_when = 'today';
    /**
     */
    function __construct ()
    {
        
        // TODO - Insert your code here
    }
/**
 * Devuelve todos los cumpleaños del rango seleccionado
 *
 * @return array
 */   
    public function cumples( $when = 'today' ) 
    {
        $this->_when = $when;
        return array_merge(
            $this->personasCentral(),
            $this->personasEmpresa(),
            $this->empleados()
        );
    }
    public function personasCentral()
    {
        $sql = "SELECT
            clientes.Nombre as 'Empresa',
            pcentral.persona_central as 'Nombre',
            DATE_FORMAT(pcentral.cumple, '%d %c') as 'Fecha',
            clientes.id as 'Id'
            FROM clientes INNER JOIN pcentral ON
            clientes.Id = pcentral.idemp
            WHERE DATE_FORMAT(pcentral.cumple,'%d %c')
            LIKE DATE_FORMAT(";
        $sql .= $this->_whenQuery();
        $sql .= ",'%d %c') 
            AND clientes.Estado_de_cliente != 0";
        return CNI::consulta($sql);
    }
    
    public function personasEmpresa()
    {
        $sql = "SELECT
		    clientes.Nombre as 'Empresa',
		    CONCAT(pempresa.nombre,' ',
		    pempresa.apellidos) as 'Nombre',
		    DATE_FORMAT(pempresa.cumple, '%d %c') as 'Fecha',
	        clientes.id as 'Id'
	        FROM clientes INNER JOIN pempresa ON 
            clientes.Id = pempresa.idemp
	        WHERE date_format(pempresa.cumple,'%d %c')
	        LIKE date_format(";
        $sql .= $this->_whenQuery();
	    $sql .= ",'%d %c') 
	        AND clientes.Estado_de_cliente != 0";
	    return CNI::consulta($sql);   
    }
    
    public function empleados()
    {
        $sql = "SELECT 'Centro' as 'Empresa',
            CONCAT(Nombre,' ', Apell1, ' ', Apell2) as 'Nombre'
            DATE_FORMAT(FechNac, '%d %c') as 'Fecha',
            Id
            FROM `empleados`
            WHERE DATE_FORMAT(FechNac,'%d %c') 
            LIKE DATE_FORMAT(";
        $sql .= $this->_whenQuery();
        $sql.=",'%d %c')";
        return CNI::consulta($sql);
    }
    
    private function _whenQuery()
    {
        $sql = '';
        if ( $this->_when == 'today' ) {
            $sql = "CURDATE()";
        } elseif ( $this->_when == 'tomorrow') {
            $sql = "ADDDATE(CURDATE(),1)";
        } else {
            // TODO: Los proximos 40 dias
            
        }
        return $sql;
    }
    public function siguientes()
    {
        $sql ="SELECT
		clientes.Nombre,
		pcentral.persona_central,
		pcentral.cumple,
	    clientes.id, date_format( pcentral.cumple, '0000-%m-%d' ) AS cumplea
	    FROM clientes INNER JOIN pcentral ON clientes.Id = pcentral.idemp where
        (
             day(pcentral.cumple) > day(curdate()) and
             month(pcentral.cumple) like month(curdate())
             or
             month(pcentral.cumple)
             like month(date_add(curdate(), interval 1 month))
        )
        and clientes.`Estado_de_cliente` != 0
         order by month(pcentral.cumple)".$orden.", day(pcentral.cumple) ";
    }
}

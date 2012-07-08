<?php
/**
 * Clase Clientes
 */
require_once 'Cni.php';
/**
* 
*/
class Clientes
{
    
    public $idCliente = null;
    public $datosCliente = null;
    private $_camposTabla = null;
    private $_table = 'clientes';
    /**
     * [__construct description]
     * @param [type] $idCliente [description]
     */
    public function __construct($idCliente = null)
    {
        $sql = "DESCRIBE ".$this->_table;
        foreach ( Cni::consulta($sql, PDO::FETCH_ASSOC) as $key => $var ) {
            if ($key == 'Field') {
                $this->_camposTabla[$var] = null;
            }
        }
        if ( !is_null($idCliente) ) {
            $this->idCliente = $idCliente;
            $datosCliente = $this->_datosCliente();
        }
    }
    /**
     * [todosClientes description]
     * @return [type] [description]
     */
    public function todosClientes()
    {
        $sql = "SELECT * from ".$this->_table;
        return Cni::consulta($sql, PDO::FETCH_ASSOC);
    }
    /**
     * [getDatosCliente description]
     * @return [type] [description]
     */
    private function _datosCliente()
    {
            $sql = "SELECT * FROM ".$this->_table." WHERE Id LIKE ".$this->idCliente;
            return Cni::consulta($sql, PDO::FETCH_ASSOC);
    }
    public function nombreCliente() 
    {
            return $this->datosCliente['Nombre'];
    }
}
<?php
/**
 * Clase Clientes
 */
require_once 'Cni.php';
class Datos
{
    
    private $_idRegistro = null;
    private $_datosRegistro = null;
    private $_camposTabla = null;
    private $_tabla = null;
    
    public function __construct($tabla = null, $idRegistro = null)
    {
        if ( !is_null($tabla) ) {
            $this->_tabla = $tabla;
            $this->_setCamposTabla();    
            if ( !is_null($idRegistro) ) {
                $this->_idRegistro = $idRegistro;
                $this->_setDatosRegistro(); 
            }
        } else {
            die('Debe especificar una tabla');
        }
    }
    private function _setCamposTabla()
    {
        $sql = "DESCRIBE `".$this->_tabla."`";
        foreach (Cni::consulta($sql, PDO::FETCH_ASSOC) as $key => $var) {
            if ($key == 'Field') {
                $this->_camposTabla[$key] = $var;
            }
        }
    }
    private function _setDatosRegistro()
    {
         $sql = "SELECT * FROM `".$this->_table."` WHERE Id LIKE ".$this->_idRegistro;
         $this->_datosRegistro = (object) Cni::consulta($sql, PDO::FETCH_ASSOC);
    }
    public function getTodosDatos()
    {
        $sql = "SELECT * from `".$this->_tabla."` WHERE Nombre NOT LIKE '' order by Nombre";
        return Cni::consulta($sql, PDO::FETCH_ASSOC);
    }
    public function getDatosRegistro()
    {
        return $this->_datosRegistro;
    }
}
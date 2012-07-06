<?php
/**
 * Handler File Doc Comment
 *
 * Manejador de Acciones
 *
 * Manejador de las acciones solicitadas
 *
 * PHP Version 5.2.6
 *
 * @author  Ruben Lacasa <ruben@ensenalia.com>
 * @package cniEstable/entradas
 * @license Creative Commons Atribución-NoComercial-SinDerivadas 3.0 Unported
 * @version 2.0e Estable
 * @link    https://github.com/sbarrat/cniEstable
 */
if (isset($_POST['inicio'])) {
    require_once 'clases/EntradasSalidas.php';
    $entradasSalidas = new EntradasSalidas();
    $entradasSalidas->anyoInicial = $_POST['inicio'];
    $entradasSalidas->anyoFinal = $_POST['fin'];
    $entradasSalidas->setAnyos();
    $entradasSalidas->setTipoVista($_POST['vista']);
    $entradasSalidas->setTipoDato($_POST['datos']);
    echo "<h3>{$entradasSalidas->titulo()}</h3>"; 
    switch ($_POST['vista']) {
        case 1:
            ($_POST['datos'] == '1') ? 
             $html = $entradasSalidas->listadoAcumuladoClientes() : 
             $html = $entradasSalidas->listadoAcumuladoServicios();
            break;
        case 2:
            ($_POST['datos'] == '1') ? 
             $html = $entradasSalidas->listadoDetalladoClientes() : 
             $html = $entradasSalidas->listadoDetalladoServicios();
            break;
        case 3:
            ($_POST['datos'] == '1') ? 
             $html = $entradasSalidas->graficaClientes() : 
             $html = $entradasSalidas->graficaServicios();
            break;
        default:
            $html = "Opcion no disponible";
            break;
    }
    echo $html;
}
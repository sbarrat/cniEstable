<?php 
/**
 * menu File Doc Comment
 *
 * Menu de la aplicación
 *
 * Menu general de la aplicacion, enlaces a los distintos apartados del 
 * programa
 *
 * PHP Version 5.2.6
 *
 * @author  Ruben Lacasa <ruben@ensenalia.com>
 * @package cniEstable/inc
 * @license Creative Commons Atribución-NoComercial-SinDerivadas 3.0 Unported
 * @version 2.0e Estable
 * @link    https://github.com/sbarrat/cniEstable
 */
require_once 'variables.php';
Cni::checkSession();
$sql = "Select * from menus";
$datosMenu = Cni::consulta($sql);
$tabla = "<div id='menu_general'>";
$tabla .= "<table width='100%'><tr>";
foreach ( $datosMenu as $dato ) {
    switch ( $dato[0] ) {
        case 7:
            $tabla .="<th><a href='javascript:datos(1)'>
			        <img src='".$dato[3]."' alt='".$dato[1]."' width='32'/>
				    <p />".$dato[1]."</a></th>";
            break;
        case 8:
            $tabla .="<th><a href='javascript:datos(2)'>
				    <img src='".$dato[3]."' alt='".$dato[1]."' width='32'/>
				    <p />".$dato[1]."</a></th>";
            break;
        case 9:
            $tabla .="<th><a href='javascript:datos(3)'>
				    <img src='".$dato[3]."' alt='".$dato[1]."' width='32' />
				    <p />".$dato[1]."</a></th>";
            break;
        default:
            $tabla .= "<th><a href='javascript:menu(".$dato[0].")'>
				    <img src='".$dato[3]."' alt='".$dato[1]."' width='32'/>
				    <p/>".$dato[1]."</a></th>";
            break;
    }
}
$tabla .="<th><a href='inc/logout.php'>
	<img src='imagenes/salir.png' width='32' alt='Salir'><p/>Salir<a></th>";
$tabla .= "</tr></table><div id='principal'></div>";
$tabla .="</div>";
echo $tabla;
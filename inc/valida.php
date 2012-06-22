<?php
/**
 * valida File Doc Comment
 *
 * Valida al usuario
 *
 * Se encarga de validar al usuario
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
if ( isset( $_POST['usuario'] ) && isset( $_POST['passwd']) ) {
    $vars = Cni::sanitize($_POST);
    $sql = "SELECT 1 from usuarios
    WHERE nick like '".$vars['usuario']."' 
    AND contra like sha1('".$vars['passwd']."')";
    $resultados = Cni::consulta($sql);
    if ( count($resultados) == 1 ) {
        // OK
        $_SESSION['usuario'] = $vars['usuario'];
        header("Location:../index.php");
        exit(0);
    } else {
        // KO
        header("Location:../index.php?error=1");
        exit(0);
    }
} else {
    // KO
    header("Location:../index.php?error=1");
    exit(0);
}
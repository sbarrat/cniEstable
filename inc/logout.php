<?php
/**
 * Logout File Doc Comment
 *
 * Cierra la sesion
 *
 * Cierra la aplicación y redirige a la pantalla principal
 *
 * PHP Version 5.2.6
 *
 * @author  Ruben Lacasa <ruben@ensenalia.com>
 * @package cniEstable/inc
 * @license Creative Commons Atribución-NoComercial-SinDerivadas 3.0 Unported
 * @version 2.0e Estable
 * @link    https://github.com/sbarrat/cniEstable
 */
session_start();
session_destroy();
header("Location:../index.php?exit=0");
exit(0);
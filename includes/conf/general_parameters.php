<?php
/**
 *
 * Description: Configuraciones y parametros generales.
 *
 * LICENSE:   HFJ_LICENSE
 *
 * @category    includes
 * @package     SeidoRed
 * @author      <hfj@hfj.com>
 * @version     3.0
 * @file        general_parameters.php
 * @path        includes/
 * @date        21/06/2009
*/

$empresa_name   = "HIDROANDES"; // Nombre de la empresa
$system_title   = "HIDROANDES | "; //titulo del sistema ::: TEC
$foot_page      = ".:: Aplicación Web ::: HIDROANDES -  ::.";
$host_system    = "";
$auth_table     = 'usuarios'; // Nombre de la tabla que contendra los datos de los usuarios
$usuarios_sesion = 'the_name_session';
$redir          = 'http://localhost/hidroandes/index.php';
$ruta_base      = '//localhost/hidroandes/';
// Configuracion de Modulos Activos en en Sistema (0:Inactivo, 1:Activo)
$mod_moodle  = 0;
//Mod Chat
global $absolute_uri;
$absolute_uri   = 'http://localhost/hidroandes/';
$mod_chat       = 1;
// Mensajes de error.
$ruta_upload = $ruta_base."includes/uploads/";
$ruta_album = "";
$ruta_album_uploader = "../../fotoAlbum/";
$ruta_album_perfil = "../fotoperf";
$ruta_album_perfil_uploader = "../../fotoperf/";
$ruta_album_mini = "../fotoAlbum/thumbs/";
$ruta_album_video = "../videos/";

$error_login_ms[0] = "No se pudo conectar con la Base de datos";
$error_login_ms[1] = "No se pudo realizar consulta a la Base de datos";
$error_login_ms[2] = "Contrase&ntilde;a &oacute; Usuario no v&aacute;lidos";
$error_login_ms[3] = "Contrase&ntilde;a &oacute; Usuario no v&aacute;lidos";
$error_login_ms[4] = "Contrase&ntilde;a &oacute; Usuario no v&aacute;lidos";
$error_login_ms[5] = "No est&aacute; autorizado para realizar esta acci&oacute;n o entrar en esta p&aacute;gina";
$error_login_ms[6] = "Acceso no autorizado! Reg&iacute;strese";
$error_login_ms[7] = "El C&oacute;digo aleatorio que introdujo no coincide con la imagen mostrada";
$error_login_ms[8] = "No introdujo el C&oacute;digo aleatorio";
$error_login_ms[9] = "Su sesi&oacute;n expir&oacute; o a&uacute;n no se ha identificado.";
$error_login_ms[10] = "Acceso incorrecto";

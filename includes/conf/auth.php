<?php

ini_set('display_errors', false);
ini_set('display_startup_errors', false);
/**
*
* Description: Archivo de autentificacion.
*
* LICENSE:   HFJ_LICENSE
*
* @category    includes
* @package     Seido
* @author      <hfj@hfj.com>
* @version     3.0
* @file        auth.php
* @path        includes/
* @date        21/06/2009
*/
require_once 'db.php';
require_once 'general_parameters.php';

$url = explode("?", $_SERVER['HTTP_REFERER']);
$pag_referida = $url[0];
$redir2 = $pag_referida;


// chequear si se llama directo al script.

if ($_SERVER['HTTP_REFERER'] == '') {
    die(header("Location:  $redir?error_login=10"));
    exit;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['user']) && isset($_POST['pass']) && ($_POST['user']!='') && ($_POST['pass']!='')) {
    $usu = trim($_POST['user']);
    $login = stripslashes($usu);
    $login = preg_replace("/[';]/", "", $login);
    $conexion = new Conexion();
    $conectar = $conexion->obtenerConexionMy();
    $usuario_consulta = $conectar->prepare("SELECT * FROM $auth_table WHERE Usuario='$login'") or die(header("Location:  $redir?error_login=1"));// or die(header ("Location:  $redir?error_login=1"));
    $usuario_consulta->execute();



    if ($usuario_consulta->rowCount() == 1) {
        $password = trim($_POST['pass']);
        $password = md5($password);
    	// almacenamos datos del Usuario en un array para empezar a chequear.
    	$usuario_datos = $usuario_consulta->fetch(PDO::FETCH_ASSOC);
    	// liberamos la memoria usada por la consulta, ya que tenemos estos datos en el Array.
    	$usuario_consulta->closeCursor();
        if ($login != $usuario_datos['Usuario']) {
            Header("Location: $redir?error_login=4");
            exit;
        }
		print_r($usuario_datos['contrasena']);
		print_r($password);
        if ($password != $usuario_datos['contrasena']) {
            Header("Location: $redir?error_login=3");
            exit;
        }
        session_start();
        session_cache_limiter('nocache,private');
        $_SESSION['usuario_nivel'] = $usuario_datos['Tipo'];
        $_SESSION['usuario_login'] = $usuario_datos['id'];
        $_SESSION['ci'] = $usuario_datos['Cedula'];
        $_SESSION['usuario_password']  = $usuario_datos['contrasena'];
        $_SESSION['user_pass_ne'] = $_POST['pass'];
        $_SESSION['usuario_perfil'] = $usuario_datos['Nivel'];
        $_SESSION['usuario_stilo']=$usuario_datos['Stilo'];
        $_SESSION['tipo_usuario']=$usuario_datos['TipoUsuario'];
    //Verificacion de los permisos de lectura escritura
    $auth['S']=1;
        $auth['I']=1;
        $auth['D']=1;
        $auth['U']=1;
        $pag = $_SERVER['PHP_SELF'];
        Header("Location: $pag?valida=hola");
        exit;
    } else {
        Header("Location: $redir?error_login=2");
        exit;
    }
} else {
    session_start();
    $auth['S']=1;
    $auth['I']=1;
    $auth['D']=1;
    $auth['U']=1;
    if (!isset($_SESSION['usuario_login']) && !isset($_SESSION['usuario_password'])) {
        session_destroy();
        Header("Location: $redir?error_login=9");
        exit;
    }
}
?>

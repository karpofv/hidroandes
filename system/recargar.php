<?php
    error_reporting(E_ALL);
    ini_set('display_errors', false);
    ini_set('display_startup_errors', false);
    require('../includes/conf/auth.php');
    $nivel_acceso='Empleado';
    if ($nivel_acceso!=$_SESSION['usuario_nivel']) {
        header("Location: $redir?error_login=5");
        exit;
    }
    /*Se incluye archivo auth para autentificar la sesion*/
    if ($_GET[salir]=='1') {
        session_cache_limiter('nocache,private');
        session_name($sess_name);
        session_start();
        $sid = session_id();
        session_destroy();
        header("Location: ../index.php");
    }
    $permiso = $_SESSION['usuario_login'];
    include_once('../includes/conexion.php');
    include_once('../includes/chat.php');
    //include_once('../includes/conf/general_parameters.php');
    //conectar();
    if ($nivel_acceso!=$_SESSION['usuario_nivel']) {
        header("Location: ../index.php?error_login=5");
        exit;
    }

    include_once '../includes/tools.php';
    include_once '../includes/validation.php';
    include_once '../includes/combos.php';
    include_once '../includes/conexion.php';
    include_once('modelo/menu/class.menu.php');
    include_once('modelo/usuarios/class.usuarios.php');
    include_once('modelo/prestamos/class.prestamos.php');
    include_once('modelo/notificacion/class.notif.php');

    $consultasMenu = new paraTodos();

    //$result=mysql_query("set names utf8");
    $permiso    =   $_SESSION['usuario_login'];
    $nivel      =   $_SESSION['usuario_permisos'];

    /**
    * Esto trae los datos del empleado
    */
    $cedula = $_SESSION[ci];
    //$cedula=$_SESSION['ci'];
    $datosPersonales = UsuariosModel::datosUsuario($cedula);
    $sid = session_id($sid);
    $update=update_sessions();
    //$consultasMenu->arrayInserte("time, sid, username, status, Cedula","chat_sessions","'time()', '$sid', '$permiso', '1', '$cedula'");
    $idMenut=$_POST[dmn];
    if ($idMenut=='') {
        $idMenut=$_GET[dmn];
        if ($idMenut=='') {
            $idMenut=$_SESSION[dmn];
        } else {
            $_SESSION[dmn]=$_GET[dmn];
        }
    }

    $FOTO="../assets/img/avatar5.png";
    $act=$_POST[act];
    if ($act=='') {
        $act=$_GET[act];
    }
    $res = $consultasMenu->arrayConsulta("S,U,D,I,P", "perfiles_det", "IdPerfil = '$_SESSION[usuario_permisos]' AND SubMenu = '$idMenut'");
    foreach ($res as $arr) {
        $accPermisos=array(S=> $arr[S],U=> $arr[U],I=> $arr[I],D=> $arr[D],P=> $arr[P]);
    }
    if ($_POST[ver]=='' or $_GET[ver]==0) {
        $bMenu='menu_emp_sub';
    }
    if ($_POST[ver]=='2') {
        $bMenu='m_menu_emp_sub_menj';
    }
    $res_ = $consultasMenu->arrayConsulta("Url_1,Url_2,Url_3,Url_4,Url_5,Url_6,Url_7,Url_8,Url_9,Url_10", "$bMenu", "id=$idMenut");

    foreach ($res_ as $rownivel) {

      if ($act=='' or $act=='1') {
          $conexf=$rownivel["Url_1"];
      }
        if ($act=='2') {
            $conexf=$rownivel["Url_2"];
        }
        if ($act=='3') {
            $conexf=$rownivel["Url_3"];
        }
        if ($act=='4') {
            $conexf=$rownivel["Url_4"];
        }
        if ($act=='5') {
            $conexf=$rownivel["Url_5"];
        }
        if ($act=='6') {
            $conexf=$rownivel["Url_6"];
        }
        if ($act=='7') {
            $conexf=$rownivel["Url_7"];
        }
        if ($act=='8') {
            $conexf=$rownivel["Url_8"];
        }
        if ($act=='9') {
            $conexf=$rownivel["Url_9"];
        }
        if ($act=='10') {
            $conexf=$rownivel["Url_10"];
        }
    }
    if ($_POST[ver]=='1' or $_GET[ver]=='1' or $_SESSION[ver]=='1') {
        $res_ = $consultasMenu->arrayConsulta("URL", "recargar", "id=$idMenut");
        foreach ($res_ as $rownivel) {
            $conexf=$rownivel["URL"];
        }
    }
    if ($conexf!='') {
        include_once($conexf);
    }

    ?>

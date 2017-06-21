<?php
    $confInv = $_GET["confInv"];
    ini_set('display_errors', false);
    ini_set('display_startup_errors', false);
    require("../includes/conf/auth.php");
    $Quien = $_SESSION['usuario_nivel'];
    if ($_SESSION['usuario_nivel'] != 'Empleado') {
        header("Location: ../index.php?error_login=5");
        exit;
    } else {
        $permiso = $_SESSION['usuario_login'];
    }
    include_once ('../includes/layout/head.php');
    include_once ('../includes/tools.php');
    include_once ('../includes/conexion.php');
    include_once('/modelo/class.consultas.php');
    $consultasPermiso = new paraTodos();
    $consultas = new Consultas();
    $res_ = $consultasPermiso->arrayConsulta("Nivel", "usuarios", "Cedula=$_SESSION[ci]");
    foreach ($res_ as $rownivelEmp) {
        $_SESSION['usuario_permisos'] = "$rownivelEmp[Nivel]";
        $_SESSION['dmn'] = "351";
        $_SESSION['ver'] = "1";
    }
    header("Location: accion.php");
    include_once($ruta_base."includes/layout/footer.php");
    ?>
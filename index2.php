<?php
error_reporting(E_ALL);
ini_set('display_errors', false);
ini_set('display_startup_errors', false);
?>
<!-- PROBANDO GIMON -->

<?php
require_once 'includes/conexion.php';
require_once 'includes/conf/auth.php';
if ($_SESSION['usuario_nivel'] != 'Empleado') {
    header('Location: index.php?error_login=5');
    exit;
}

switch ($_SESSION['usuario_nivel']) {
  case 'Empleado':
  require_once 'includes/conexion.php';
  require_once 'system/modelo/class.consultas.php';

  /*
  |--------------------------------------------------------------------------
  | Instanciamos la clase consulta
  |--------------------------------------------------------------------------
  | Esto es para llamamr los metodos que se encuentran en la class consulta
  |
  */
  $consulta = new Consultas();
  $insertar = $consulta->nuevoUsuario();
  $update = $consulta->actualizarCodigo();
  $codigo = $consulta->evaluarCodigo();
  $headers = "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/html; charset=UTF-8\r\n";
  $headers .= "To: $correou \r\n";
  $headers .= "From: VENEZOLANA DE TRANSPORTES Y CONSTRUCCIONES <info@vtcca.com.ve>\r\n";
  $headers .= "Cc: \r\n";
  $headers .= "Bcc: \r\n";
  $elcontenido = '<div style="width: 645px;overflow: hidden;font-family: Arial;border: 1px solid #EEEEEE;background: #F9F9F9;">
  <img src="http://vtcca.com.ve/publicidad/headercorreo.png" border="0" />
  <div style="overflow: hidden;background: #FFFFFF;margin-left: 20px;margin-top: 15px;width: 602px;text-align: left;font-family: Arial;font-size: 1.100em;border-top: 2px solid #EEEEEE;border-left: 2px solid #EEEEEE;border-right: 2px solid #EEEEEE;">
  <div style="width: 100%;text-align: center;font-size: 1.100em;font-family: Arial;font-weight: bold;margin-bottom: 20px;">
  <U>Codigo de Acceso</U>
  </div>
  <div style="margin-left: 10px;width: 620px;text-align: left;font-family: Arial;font-size: 0.900em;">
  <b>VENEZOLANA DE TRANSPORTES Y CONSTRUCCIONES</b>, te da la bienvenida, el codigo de acceso es el siguiente:<br><br>
  <b>Codigo :</b> '.$clavexxxemp.'<br><br>
  </div>
  <br>
  </div>
  <div style="background: #F3F3F3;width: 645px;height: auto;text-align: center;">
  <img src="http://vtcca.com.ve/publicidad/footercorreo.png" border="0" />
  </div>
  </div>';
  //mail($correou, "Acceso Creado para el Sistema VENEZOLANA DE TRANSPORTES Y CONSTRUCCIONES", $elcontenido,$headers)or die('Error enviando correo');
  header('Location: system/index.php');
  break;
}
?>

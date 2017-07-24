<?php
	session_start();
	function get_extension($str)
	{
			return end(explode(".", $str));
	}
	$nuevo_nombre = $_GET[cod];
	$return = Array('ok'=>TRUE);
	$upload_folder ='../../producto';
	$nombre_archivo = $_FILES['archivo']['name'];
	$tipo_archivo = $_FILES['archivo']['type'];
	$tamano_archivo = $_FILES['archivo']['size'];
	$tmp_archivo = $_FILES['archivo']['tmp_name'];
	$mTipo = exif_imagetype($tmp_archivo);
	$tipo = get_extension($nombre_archivo) ;

	if (($tipo != 'jpg') && ($tipo != 'JPEG')&& ($tipo != 'JPG')){
		$return ="Formato de archivo no reconocido.";
	} else{
		if ($tamano_archivo>204800){
			$return ="Formato excede el tamaño permitido.";
		} else {
			$archivador = $upload_folder . '/' . $nuevo_nombre.".".$tipo;
			if (!move_uploaded_file($tmp_archivo, $archivador)) {
				$return = $nuevo_nombre."Ocurrio un error al subir el archivo. ".$nombre_archivo." No pudo guardarse.";
			} else {
				$return = true;
			}
		}
	}
		echo $nuevo_nombre;
?>

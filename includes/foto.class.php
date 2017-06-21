<?php
/**
* Description:.
*
* LICENSE:     HFJ_LICENSE
*
* @category    Profesor
*
* @author      <hfj@hfj.com>
*
* @version     3.0
* @file        tool.class.php
* @path        public/profesor/inc/
* @date        21/6/2009
*/

/**
 * Funciones y Herramientas para fotos.
 *
 * @author hfj
 */
class photo
{
    /**
   * Permite obtener una imagen a partir de una URL.
   *
   * @param url    ruta de la imagen a crear
   *
   * @return image
   */
  private function getUrlData($url)
  {
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_FAILONERROR, 1);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $get = curl_exec($ch);
      curl_close($ch);

      return $get;
  }

  /**
   * Permite crear un thumb o redimensionar el tamaño a una imagen.
   *
   * @param imagen  ruta absoluta de la imagen redimensionar
   * @param alturam Altura maxima
   * @param anchom  Ancho maximo
   *
   * @return image
   */
  public function resizeImage($imagen, $alturam, $anchom, $thumbnail)
  {

    // Lugar donde se guardarán los thumbnails respecto a la carpeta donde está la imagen "grande".
    if ($thumbnail != '') {
        $dir_thumb = $thumbnail.'/';
    }

      $camino_nombre = explode('/', $imagen);

    // Aquí tendremos el nombre de la imagen.
    $nombre = end($camino_nombre);

    // Aquí la ruta especificada para buscar la imagen.
    $camino = substr($imagen, 0, strlen($imagen) - strlen($nombre));

    // Intentamos crear el directorio de thumbnails, si no existiera previamente.
    // if (!file_exists($camino.$dir_thumb))
    // mkdir ($camino.$dir_thumb, 0777) or die("No se ha podido crear el directorio $dir_thumb");

    // Aquí comprobamos que la imagen que queremos crear no exista previamente
    //      if (!file_exists($camino.$dir_thumb.$prefijo_thumb.$nombre)) {
    //echo $camino.$dir_thumb.$prefijo_thumb.$nombre." NO existía<br>";
    /* if (stripos($imagen, 'http://') !== false) {
    $im = imagecreatefromstring(self::getUrlData($imagen));
    imagealphablending($im, true);
    imagesavealpha($im, true);
  } else */

  // miramos el tamaño de la imagen original...
  $datos = getimagesize($camino.$nombre) or die("Problemas con $camino$nombre<br>");

      if ($datos[1] > $alturam or $datos[0] > $anchom) {
          if (stripos($imagen, '.jpg') !== false or stripos($imagen, '.jpeg') !== false) {
              $im = imagecreatefromjpeg($imagen);
          } elseif (stripos($imagen, '.gif') !== false) {
              $imp = imagecreatefromgif($imagen);
              $x = imagesx($imp);
              $y = imagesy($imp);
              $im = imagecreatetruecolor($x, $y);
              imagefilledrectangle($im, 0, 0, $x, $y, imagecolorallocate($im, 255, 255, 255));
              imagecopy($im, $imp, 0, 0, 0, 0, $x, $y);
          } elseif (stripos($imagen, '.png') !== false) {
              $im = imagecreatefrompng($imagen);
              imagealphablending($im, true);
              imagesavealpha($im, true);
          }
    // $img = imagecreatefromjpeg($camino.$nombre) or die("No se encuentra la imagen $camino$nombre<br>n");

    // intentamos escalar la imagen original a la medida que nos interesa
    if ($datos[0] > $anchom and $anchom != '') {
        $ratio = ($datos[0] / $anchom);
        $altura = round($datos[1] / $ratio);
        $anchura = $anchom;
        if ($altura > $alturam) {
            $ratio = ($altura / $alturam);
            $anchura = round($anchura / $ratio);
            $altura = $alturam;
        }
    } elseif ($datos[1] > $alturam and $alturam != '') {
        $ratio = ($datos[1] / $alturam);
        $anchura = round($datos[0] / $ratio);
        $altura = $alturam;
    }

    // esta será la nueva imagen reescalada
    $thumb = imagecreatetruecolor($anchura, $altura);

    // con esta función la reescalamos
    imagecopyresampled($thumb, $im, 0, 0, 0, 0, $anchura, $altura, $datos[0], $datos[1]);

    // voilà la salvamos con el nombre y en el lugar que nos interesa.
    /*if (stripos($imagen, 'http://') !== false) {
    $im = imagecreatefromstring(self::getUrlData($imagen));
    imagealphablending($im, true);
    imagesavealpha($im, true);
  } else */
  if (stripos($imagen, '.jpg') !== false or stripos($imagen, '.jpeg') !== false) {
      if ($thumbnail != '') {
          imagejpeg($thumb, $camino.$dir_thumb.$nombre, 50);
      } else {
          imagejpeg($thumb, $camino.$dir_thumb.$nombre);
      }
  } elseif (stripos($imagen, '.gif') !== false) {
      imagegif($thumb, $camino.$dir_thumb.$nombre);
  } elseif (stripos($imagen, '.png') !== false) {
      if ($thumbnail != '') {
          imagepng($thumb, $camino.$dir_thumb.$nombre, 5);
      } else {
          imagepng($thumb, $camino.$dir_thumb.$nombre);
      }
  }
      } //if ($datos[1]  > $alturam OR $datos[0] > $anchom)
  }
//    }
}

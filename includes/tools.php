<?php
class paraTodos
{
    public function randomColor()
    {
        $possibilities = array(1, 2, 3, 4, 5, 6, 7, 8, 9, "A", "B", "C", "D", "E", "F" );
        shuffle($possibilities);
        $color = "#";
        for ($i=1;$i<=6;$i++) {
            $color .= $possibilities[rand(0, 14)];
        }
        return $color;
    }
    public function dateDias($start, $end)
    {
        $start_ts = strtotime($start);
        $end_ts = strtotime($end);
        $diff = $end_ts - $start_ts;
        return round($diff / 86400);
    }

    public static function sanitize($text)
    {
        $text = trim($text);
        $text = htmlspecialchars($text, ENT_QUOTES);
        $text = preg_replace("/[;]/", "", $text);
        $text = str_replace("\n\r", "\n", $text);
        $text = str_replace("\r\n", "\n", $text);
        $text = str_replace("\n", "<br>", $text);
        return $text;
    }
    public static function convertDate($fecha_americana)
    {
        $ano = substr($fecha_americana, 0, 4);
        $mes = substr($fecha_americana, 5, 2);
        $dia = substr($fecha_americana, 8, 2);
        $fecha_europea = "$dia/$mes/$ano";
        return $fecha_europea;
    }
    /**
     * Función que devuelve parte de una fecha de acuerdo con el formato que se pase
     * @param fecha      Fecha en Formato
     * @param formato    Formato en el que se esta pasando la fecha A = YYYY/mm/dd, E = dd/mm/YYYY
     * @param campo      Campo que debe retornar la funcion D = dd, M = mm, Y = YYYY
     * @return text
    */
    public static function getFromDate($fecha, $formato, $campo)
    {
        if ($formato == 'A') {
            $ano = substr($fecha, 0, 4);
            $mes = substr($fecha, 5, 2);
            $dia = substr($fecha, 8, 2);
        }
        if ($formato == 'E') {
            $dia = substr($fecha, 0, 2);
            $mes = substr($fecha, 3, 2);
            $ano = substr($fecha, 6, 4);
        }
        switch ($campo) {
            case 'D':
                return $dia;
                break;
            case 'M':
                return $mes;
                break;
            case 'Y':
                return $ano;
                break;
        }
    }

    /**
     * Permite mostrar un mensaje de acuerdo a una clase definida.
     * @param msg      Mensaje a mostrar.
     * @param type      Tipo de mensaje (Clase CSS a usar)
     * @return text
     */
    public static function showMsg($msg, $type)
    {
        if ($msg<>'') {
            ?>
            <div class="<?php echo $type ?>" id="alerta-msg">
            <a class="close" data-dismiss="alert" onclick="cerrar()">&times;</a>
            <strong>Accion!</strong> <?php echo $msg ?>
            </div>
            <?php

        }
    }

    public static function arrayConsulta($campos, $tablas, $consultas)
    {
        /*
    |--------------------------------------------------------------------------
    | Hacemos la conexion a MYSQL
    |--------------------------------------------------------------------------
    | Esto es para llamar a la conexion en PDO que creamos
    |--------------------------------------------------------------------------
    */
        $conexion = new Conexion();
        $conectar = $conexion->obtenerConexionMy();
        $sql = ("SELECT $campos FROM $tablas WHERE $consultas");
        $preparar = $conectar->prepare($sql);
        $preparar->execute();
        $resultado = $preparar->fetchAll();
        return $resultado;
        $conectar = $conexion->cerrarConexionMy();
    }
    public static function arrayConsultanum($campos, $tablas, $consultas)
    {
        /*
    |--------------------------------------------------------------------------
    | Hacemos la conexion a MYSQL
    |--------------------------------------------------------------------------
    | Esto es para llamar a la conexion en PDO que creamos
    |--------------------------------------------------------------------------
    */
        $conexion = new Conexion();
        $conectar = $conexion->obtenerConexionMy();
        $sql = ("SELECT $campos FROM $tablas WHERE $consultas");
        $preparar = $conectar->prepare($sql);
        $preparar->execute();
        $resultado = $preparar->rowCount();
        return $resultado;
        $conectar = $conexion->cerrarConexionMy();
    }

    public static function arrayDelete($consultas, $tabla)
    {
        /*
    |--------------------------------------------------------------------------
    | Hacemos la conexion a MYSQL
    |--------------------------------------------------------------------------
    | Esto es para llamar a la conexion en PDO que creamos
    |--------------------------------------------------------------------------
    */
        $conexion = new Conexion();
        $conectar = $conexion->obtenerConexionMy();
        //echo "DELETE FROM $tabla WHERE $consultas";
        $sql = ("DELETE FROM $tabla WHERE $consultas");
        $preparar = $conectar->prepare($sql);
        $preparar->execute();
        $cuenta = $preparar->rowCount();
        if ($cuenta > 0) {
            $si='True';
        }
        return $si;
        $conectar = $conexion->cerrarConexionMy();
    }


    public static function arrayUpdate($campo, $tabla, $consulta)
    {
        /*
    |--------------------------------------------------------------------------
    | Hacemos la conexion a MYSQL
    |--------------------------------------------------------------------------
    | Esto es para llamar a la conexion en PDO que creamos
    |--------------------------------------------------------------------------
    */
        $conexion = new Conexion();
        $conectar = $conexion->obtenerConexionMy();
        //echo "DELETE FROM $tabla WHERE $consultas";
        $sql = ("UPDATE $tabla SET  $campo WHERE $consulta");
        $preparar = $conectar->prepare($sql);
        $preparar->execute();
        $cuenta = $preparar->rowCount();
        if ($cuenta > 0) {
            $si='True';
        }
        return $si;
        $conectar = $conexion->cerrarConexionMy();
    }


    public static function arrayInserte($campo1, $tabla, $campo2)
    {
        /*
    |--------------------------------------------------------------------------
    | Hacemos la conexion a MYSQL
    |--------------------------------------------------------------------------
    | Esto es para llamar a la conexion en PDO que creamos
    |--------------------------------------------------------------------------
    */
        $conexion = new Conexion();
        $conectar = $conexion->obtenerConexionMy();
        $sql = ("INSERT INTO $tabla ($campo1) VALUES ($campo2)");
        $preparar = $conectar->prepare($sql);
        $preparar->execute();
        $cuenta = $preparar->rowCount();
        if ($cuenta > 0) {
            $si='True';
        }
        return $sql;
        $conectar = $conexion->cerrarConexionMy();
    }
    public static function arrayejecutar($consulta) {
     /*
    |--------------------------------------------------------------------------
    | Hacemos la conexion a MYSQL
    |--------------------------------------------------------------------------
    | Esto es para llamar a la conexion en PDO que creamos
    |--------------------------------------------------------------------------
    */
		$conexion = new Conexion();
		$conectar = $conexion->obtenerConexionMy();
		$sql = $consulta;
		$preparar = $conectar->prepare($sql);
		$preparar->execute();
		$cuenta = $preparar->rowCount();
		if ($cuenta > 0) { $si='True'; }
		return $cuenta;
    }
    public static function arrayConsultaPG($campos, $tablas, $consultas)
    {
        /*
    |--------------------------------------------------------------------------
    | Hacemos la conexion a POSTGRESQL
    |--------------------------------------------------------------------------
    | Esto es para llamar a la conexion en PDO que creamos
    |--------------------------------------------------------------------------
    */
        $conexion = new Conexion();
        $conectar = $conexion->obtenerConexionPg();
        try {
            $sql = ("SELECT $campos FROM $tablas WHERE $consultas");
            $preparar = $conectar->prepare($sql);
            $preparar->execute();
            $resultado = $preparar->fetchAll();
          //$conectar = $conexion->cerrarConexionPg();
        } catch (PDOException $e) {
            echo "Error:" .$e->getMessage();
        }
        return $resultado;
        $conectar = '';
    }

    public function url_exists($url = null)
    {
        if (empty($url)) {
            return false;
        }
        $options['http'] = array(
            'method' => "HEAD",
            'ignore_errors' => 1,
            'max_redirects' => 0
        );
        $body = @file_get_contents($url, null, stream_context_create($options));
        // Ver http://php.net/manual/es/reserved.variables.httpresponseheader.php
        if (isset($http_response_header)) {
            sscanf($http_response_header[0], 'HTTP/%*d.%*d %d', $httpcode);
            //Aceptar solo respuesta 200 (Ok), 301 (redirección permanente) o 302 (redirección temporal)
            $accepted_response = array( 200, 301, 302 );
            if (in_array($httpcode, $accepted_response)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
?>

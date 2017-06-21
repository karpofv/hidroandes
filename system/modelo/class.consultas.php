<?php

class Consultas {
    /*
      |--------------------------------------------------------------------------
      | Metodo Agregar usuario de LDAP
      |--------------------------------------------------------------------------
      | creamos el usuario si el no existe
      |en la tabla usuarios
     */

    public function nuevoUsuario() {
        $clavexxxemp = substr(uniqid(), -5);
        $cedula = $_SESSION[ci];
        $modelo = new Conexion();
        $conexion = $modelo->obtenerConexionMy();
        $sql = "INSERT INTO usuarios (Cedula,Codigo,Fecha) VALUES (:Cedula,:Codigo,:Fecha)";
        $preparar = $conexion->prepare($sql);
        $preparar->bindValue(':Cedula', $cedula);
        $preparar->bindValue(':Codigo', $clavexxxemp);
        $preparar->bindValue(':Fecha', 'now()');
        if (!$preparar) {
            return "Error al crear registro";
        } else {
            $preparar->execute();
            return "Registro creado con exito";
        }
    }

    /*
      |--------------------------------------------------------------------------
      | Metodo actualizar codigo de seguridad
      |--------------------------------------------------------------------------
      | Actualizamos los codigos si el usuario ya existe
      |
     */

    public function actualizarCodigo() {
        $clavexxxemp = substr(uniqid(), -5);
        $cedula = $_SESSION[ci];
        //instanciamos la clase ConexionMysql
        $modelo = new Conexion();
        // Obtenemos el parametro para la conexion
        $conexion = $modelo->obtenerConexionMy();
        // ahora preparamos la consulta en una variable
        $sql = "UPDATE usuarios SET Codigo='$clavexxxemp' WHERE Cedula='$cedula'";
        $preparar = $conexion->prepare($sql);
        if (!$preparar) {
            echo "Error: No tiene datos";
        } else {
            $preparar->execute();
            echo "Almacenado exitosamente";
        }
    }

    public function actualizarCodigoC() {
        $clavexxxemp = substr(uniqid(), -5);
        $cedula = $_SESSION[usuario_cedu];
        //instanciamos la clase ConexionMysql
        $modelo = new Conexion();
        // Obtenemos el parametro para la conexion
        $conexion = $modelo->obtenerConexionMy();
        // ahora preparamos la consulta en una variable
        $sql = "UPDATE usuarios_clinicas SET Codigo='$clavexxxemp' WHERE Cedula='$cedula'";
        $preparar = $conexion->prepare($sql);
        if (!$preparar) {
            echo "Error: No tiene datos";
        } else {
            $preparar->execute();
            echo "Almacenado exitosamente";
        }
    }

    /*
      |--------------------------------------------------------------------------
      | Metodo para validar campos iguales
      |--------------------------------------------------------------------------
      | Evaluamos los códigos para saber si son iguales
      |
     */

    public function evaluarCodigo($searchBox) {
        $rows = null;
        $clavexxxemp = substr(uniqid(), -5);
        $cedula = $_SESSION[ci];
        //instanciamos la clase ConexionMysql
        $modelo = new Conexion();
        //obtenemos el metodo para la conexion
        $conexion = $modelo->obtenerConexionMy();
        // preparamos la consulta para evaluar el codigo enviado al correo
        $sql = ("SELECT Codigo from usuarios WHERE Cedula='$cedula'");
        $vsql = $conexion->prepare($sql);
        $vsql->execute();
        $resultado = $vsql->fetchAll();
        return $resultado;
    }

    public function evaluarCodigoC($searchBox) {
        $rows = null;
        $clavexxxemp = substr(uniqid(), -5);
        $cedula = $_SESSION[usuario_cedu];
        //instanciamos la clase ConexionMysql
        $modelo = new Conexion();
        //obtenemos el metodo para la conexion
        $conexion = $modelo->obtenerConexionMy();
        // preparamos la consulta para evaluar el codigo enviado al correo
        $sql = ("SELECT Codigo from usuarios_clinicas WHERE Cedula='$cedula'");
        $vsql = $conexion->prepare($sql);
        $vsql->execute();
        $resultado = $vsql->fetchAll();
        return $resultado;
    }

}

?>

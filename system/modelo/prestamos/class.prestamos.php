<?php
/**
*  Clase para los prestamos
*/
class Prestamos {

	public function verPrestamos($cedula){
		$conexion = new Conexion;
		$conectar = $conexion->obtenerConexionMy();
		$sql = "SELECT
p.INSTT,
p.ASOC,
p.P_IR_ASOCIADO,
p.CEDULA,
p.SOLICITADO,
p.CANC_NORM,
p.CANC_ESP,
p.PDT_NORM,
p.PDT_ESP,
p.CTAS_NORM,
p.CTAS_ESP,
p.INICIO_NORM,
p.INICIO_ESP,
p.CREADO_EL,
p.CREADO_POR,
p.TP_PREST_N,
p.AFECT_DISP,
p.CUOTAS,
tp.INSTT,
tp.NAME,
tp.INTERES,
tp.CUONTAS,
tp.MTO_MAX,
tp.METODO_MORT,
tp.AFECT_DISP,
tp.SERVICIOS,
tp.REPETIDO,
tp.GASTOS,
tp.CTAS_ESP
 FROM prest p  INNER JOIN  tp_prest tp ON  tp.ID = p.TP_PREST  WHERE P.CEDULA = '2114621'";
		$preparar = $conectar->prepare($sql);
		$preparar->execute();

		$resultado = $preparar->fetchAll();
		return $resultado;
	}
}

?>

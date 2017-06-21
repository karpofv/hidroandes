<?php

class Notificaciones {

    public function notificacion($cedula) {
		/*Se verifica la persona posea algun prestamo en proceso*/
        $consulsol = paraTodos::arrayConsulta("ID, TP_PREST, ESTATUS", "solict_prest", "CEDULA='$cedula' and ESTATUS<>'ELIMINADO'");
        foreach ($consulsol as $row){
			/*De poseerlo se obtiene la ultima notificacion que tuvo el cliente con el prestamo selccionado*/
				$consulnotifnum = paraTodos::arrayConsultanum("*", "notificacion", "notif_cedula='$cedula' and notif_tipprest=$row[TP_PREST] order by notif_codigo desc limit 1");
			if ($consulnotifnum>0){
				$consulnotif = paraTodos::arrayConsulta("*", "notificacion", "notif_cedula='$cedula' and notif_tipprest=$row[TP_PREST] order by notif_codigo desc limit 1");
				foreach ($consulnotif as $notif){
					$datoscredito = paraTodos::arrayConsulta("*", "tp_prest", "ID=$row[TP_PREST]");
					foreach($datoscredito as $rowdatosc){
						$credito = $rowdatosc[NAME];
					}
					$estatusant= $notif[notif_estatusprest];
					$colaant= $notif[notif_cola];
					$estatus = $row[ESTATUS];
					if ($estatusant != $estatus){
						if ($estatus=='APROBADO'){
							$descripcion = "Su solicitud para el prestamo $credito ha sido aprobada.";
							$icono = "glyphicon glyphicon-ok text-red";
						}
						if ($estatus=='RECHAZADO'){
							$descripcion = "Su solicitud para el prestamo $credito ha sido rechazada.";
							$icono = "glyphicon glyphicon-remove text-red";
						}
						/*Se guarda la notificacion con la fecha actual y la bandera de leido en 0 para false y 1 para true*/
						paraTodos::arrayInserte("notif_cedula, notif_descripcion, notif_tipprest, notif_estatusprest, notif_cola, notif_icono, notif_fecha, notif_leido", "notificacion", "'$cedula', '$descripcion', $row[TP_PREST], '$estatus', 0, '$icono', current_date, 0");
					}
					/*Se verifican cuantas personas tienen solicitudes mas antiguas a la del cliente consultado*/
					$consulpersonas = paraTodos::arrayConsultanum("*", "solict_prest", "TP_PREST=$row[TP_PREST] and ID<$row[ID] and ESTATUS<>'APROBADO' and ESTATUS<>'ELIMINADO'");
					/*Se consultan los datos del tipo de prestamo*/
					if ($consulpersonas<$colaant){
						/*Si la cantidad de personas es mayor a 0 entonces se muestra la posicion de la persona else se estima el prestamo se encuentra en revision*/
						if ($consulpersonas>0 and $estatus!='APROBADO'){
							$descripcion = "Su puesto en la cola para el prestamo $credito es  el Nº $consulpersonas.";
							$icono = "fa fa-users text-red";
						}
						if ($consulpersonas==0 and $estatus!='APROBADO'){
							$descripcion = "Su prestamo $credito se encuentra en revision.";
							$icono = "fa fa-tag text-red";
						}
						/*Se guarda la notificacion con la fecha actual y la bandera de leido en 0 para false y 1 para true*/
						paraTodos::arrayInserte("notif_cedula, notif_descripcion, notif_tipprest, notif_estatusprest, notif_cola, notif_icono, notif_fecha, notif_leido", "notificacion", "'$cedula', '$descripcion', $row[TP_PREST], '$estatus', $consulpersonas, '$icono', current_date, 0");
					}
				}
			} else {
				/*Se no tiene notificaciones para este tipo de prestamo se ingreso por primera vez con los datos actuales del prestamo*/
				$estatus = $row[ESTATUS];
				/*Se verifican cuantas personas tienen solicitudes mas antiguas a la del cliente consultado*/
				$consulpersonas = paraTodos::arrayConsultanum("*", "solict_prest", "TP_PREST=$row[TP_PREST] and ID<$row[ID] and ESTATUS<>'APROBADO' and ESTATUS<>'ELIMINADO'");
				$consulpersonas = $consulpersonas+1;
				/*Se consultan los datos del tipo de prestamo*/
				$datoscredito = paraTodos::arrayConsulta("*", "tp_prest", "ID=$row[TP_PREST]");
				foreach($datoscredito as $rowdatosc){
					$credito = $rowdatosc[NAME];
				}
				/*Si la cantidad de personas es mayor a 0 entonces se muestra la posicion de la persona else se estima el prestamo se encuentra en revision*/
				if ($consulpersonas>0){
					$descripcion = "Su puesto en la cola para el prestamo $credito es  el Nº $consulpersonas.";
					$icono = "fa fa-users text-red";
				} else {
					$descripcion = "Su prestamo para $credito se encuentra en revision.";
					$icono = "fa fa-tag text-red";
				}
				/*Se guarda la notificacion con la fecha actual y la bandera de leido en 0 para false y 1 para true*/
				paraTodos::arrayInserte("notif_cedula, notif_descripcion, notif_tipprest, notif_estatusprest, notif_cola, notif_icono, notif_fecha, notif_leido", "notificacion", "'$cedula', '$descripcion', $row[TP_PREST], '$estatus', $consulpersonas, '$icono', current_date, 0");
			}

        }
    }
	public function notif($cedula){
		$consulta = paraTodos::arrayConsulta("*", "notificacion", "notif_cedula='$cedula' and notif_leido=0");
		foreach ($consulta as $row){
?>
			<li>
				<a href="javascript:void(0);" onclick="$.ajax({
        			 										type: 'POST',
        			 										url: 'recargar.php',
        													data: {dmn: 356, ver:1, codigo:<?php echo $row[notif_codigo];?>},
        													success: function(html) {
        													},error: function(xhr,msg,excep) {
        														alert('Error Status ' + xhr.status + ': ' + msg + '/ ' + excep);
        													}
        												}).done(function(){
    $.ajax({
        url:'recargar.php',
		type:'POST',
		data:{
            dmn 	: 355,
            ver     : 1
		},
		success : function (html) {
		  $('#notificaciones').html(html);
		},
    });
        												});"> <i class="<?php echo $row[notif_icono];?>"></i> <?php echo $row[notif_descripcion];?> </a>
			</li>
<?php
		}
	}
	public function numnotif($cedula){
		$consulta = paraTodos::arrayConsultanum("*", "notificacion", "notif_cedula='$cedula' and notif_leido=0");
		echo $consulta;
	}
}
?>

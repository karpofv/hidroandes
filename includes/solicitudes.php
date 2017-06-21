<?php
class Solicitudes {
    function verSolicitudes($cedula,$periodo) {
        $resultxp=mysql_query("select semestreabierto.Semestre from semestreabierto,carreras_est
        where carreras_est.ConexEst='$cedula' and carreras_est.Status='A' and semestreabierto.CodCar=carreras_est.CodCar and semestreabierto.Sede=carreras_est.Sede Limit 0,1");
        while($rowp = mysql_fetch_array($resultxp)) {
            $periodo=$rowp[Semestre];
        }mysql_free_result($resultxp);
        if ($periodo=='') {
            $resultxp=mysql_query("select semestreabierto.Semestre from semestreabierto,carreras_est
            where carreras_est.ConexEst='$cedula' and carreras_est.Status='I' and semestreabierto.CodCar=carreras_est.CodCar and semestreabierto.Sede=carreras_est.Sede Limit 0,1");
            while($rowp = mysql_fetch_array($resultxp)) {
                $periodo=$rowp[Semestre];
            }mysql_free_result($resultxp);
        }
        $resultxp=mysql_query("select DISTINCT Tipo from solicitudes
        where Cedula='$cedula' and Periodo='$periodo'");
        while($rowp = mysql_fetch_array($resultxp)) {
            $cc=$rowp[Tipo];
            if ($cc=='CTurn') { $cc='Cambio de Turno'; } 
            if ($cc=='Reing') { $cc='Reingreso'; } 
            if ($cc=='RT') { $cc='Retiro Temporal'; } 
            if ($cc=='CTras') { $cc='Traslado'; } 
            if ($cc=='CCar') { $cc='Cambio de Carrera'; } 
            if ($cc=='CarS') { $cc='Carrera Simultanea'; }
            echo '-Tiene una Solicitud de '.$cc.'<br>';
        }mysql_free_result($resultxp);
    }
}
?>

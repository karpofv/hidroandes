<?php
if ($permiso_accion['S']==1) {
if ($_POST[Estado]!='' AND $_POST[Municipio]!='' AND $_POST[Parroquia]!='' AND $_POST[CedulaPerm]!='' AND $_POST[bb]!='') {
    $Mody=Acciones::InsertarPerilEncuestado($permiso, "usuarios_perm_estad", "CedulaEmp,Estado,Fecha", "'$_POST[CedulaPerm]','$_POST[Estado]',Now()", $idsubmenu, $permiso_accion);
    if ($Mody=='True') {
        //Acciones::InsertarPerilEncuestado($permiso, "auditar_planilla", "CedulaEmp,CedulaPers,Accion,Fecha,Hora", "'$cedulaEmp','$_POST[Cedula]','Inserto Bodega',Now(),Now()", $idsubmenu, $permiso_accion);
        $ejecucion = 1;
    }
    $Mody=Acciones::InsertarPerilEncuestado($permiso, "usuarios_perm_munic", "CedulaEmp,Municipio,Fecha", "'$_POST[CedulaPerm]','$_POST[Municipio]',Now()", $idsubmenu, $permiso_accion);
    if ($Mody=='True') {
        //Acciones::InsertarPerilEncuestado($permiso, "auditar_planilla", "CedulaEmp,CedulaPers,Accion,Fecha,Hora", "'$cedulaEmp','$_POST[Cedula]','Inserto Bodega',Now(),Now()", $idsubmenu, $permiso_accion);
        $ejecucion = 1;
    }
    $Mody=Acciones::InsertarPerilEncuestado($permiso, "usuarios_perm_parroq", "CedulaEmp,Parroquia,Fecha", "'$_POST[CedulaPerm]','$_POST[Parroquia]',Now()", $idsubmenu, $permiso_accion);
    if ($Mody=='True') {
        //Acciones::InsertarPerilEncuestado($permiso, "auditar_planilla", "CedulaEmp,CedulaPers,Accion,Fecha,Hora", "'$cedulaEmp','$_POST[Cedula]','Inserto Bodega',Now(),Now()", $idsubmenu, $permiso_accion);
        $ejecucion = 1;
    }
}
$campos="Nombres,Apellidos";
$tablas="registrados";
$consultas="Cedula=$_POST[CedulaPerm]";
$res_ =paraTodos::arrayConsulta($campos,$tablas,$consultas);
foreach ($res_ as $row ) {
    $Datos=$row[Nombres].', '.$row[Apellidos];
}
?>
<div style="width: 98%;margin: 20px auto 0px auto;height: auto;">
    <div style="color: #A50000;width: 100%;padding: 8px 0px 8px 0px; text-align: center;height: auto;font-weight: bold;overflow: hidden;font-size: 11pt;border: 1px solid #DDDDDD;background: #FAFAFA;;">
    PERMISOS ASIGNADOS A <?php echo $Datos; ?>
    </div>
        <div style="border: 1px solid #CCCCCC;background: #FFFFFF;padding: 6px;overflow: hidden;width: 30%;height: auto;font-weight: 700;margin: 6px 10px 6px 10px;float: left;">
            <div style="color: #A50000;width: 100%;padding: 8px 0px 8px 0px; text-align: center;height: auto;font-weight: bold;overflow: hidden;font-size: 11pt;border: 1px solid #DDDDDD;background: #FAFAFA;;">
            PERMISOS EN ESTADOS
            </div>
            <?php
            $campos="c_estados.Estado";
            $tablas="usuarios_perm_estad,c_estados";
            $consultas="usuarios_perm_estad.CedulaEmp=$_POST[CedulaPerm] AND c_estados.id=usuarios_perm_estad.Estado";
            $res_ =paraTodos::arrayConsulta($campos,$tablas,$consultas);
            foreach ($res_ as $row ) {
                ?><div style="padding: 6px;border: 1px solid #DDDDDD;"><?php echo $row[Estado]; ?></div><?php
            }
            ?>
        </div>
        <div style="border: 1px solid #CCCCCC;background: #FFFFFF;padding: 6px;overflow: hidden;width: 30%;height: auto;font-weight: 700;margin: 6px 10px 6px 10px;float: left;">
            <div style="color: #A50000;width: 100%;padding: 8px 0px 8px 0px; text-align: center;height: auto;font-weight: bold;overflow: hidden;font-size: 11pt;border: 1px solid #DDDDDD;background: #FAFAFA;;">
            PERMISOS EN MUNICIPIOS
            </div>
            <?php
            $campos="c_municipios.Municipio";
            $tablas="usuarios_perm_munic,c_municipios";
            $consultas="usuarios_perm_munic.CedulaEmp=$_POST[CedulaPerm] AND c_municipios.id=usuarios_perm_munic.Municipio";
            $res_ =paraTodos::arrayConsulta($campos,$tablas,$consultas);
            foreach ($res_ as $row ) {
                ?><div style="padding: 6px;border: 1px solid #DDDDDD;"><?php echo $row[Municipio]; ?></div><?php
            }
            ?>
        </div>
        <div style="border: 1px solid #CCCCCC;background: #FFFFFF;padding: 6px;overflow: hidden;width: 30%;height: auto;font-weight: 700;margin: 6px 10px 6px 10px;float: left;">
            <div style="color: #A50000;width: 100%;padding: 8px 0px 8px 0px; text-align: center;height: auto;font-weight: bold;overflow: hidden;font-size: 11pt;border: 1px solid #DDDDDD;background: #FAFAFA;;">
            PERMISOS EN PARROQUIAS
            </div>
            <?php
            $campos="c_parroquia.Parroquia";
            $tablas="usuarios_perm_parroq,c_parroquia";
            $consultas="usuarios_perm_parroq.CedulaEmp=$_POST[CedulaPerm] AND c_parroquia.id=usuarios_perm_parroq.Parroquia";
            $res_ =paraTodos::arrayConsulta($campos,$tablas,$consultas);
            foreach ($res_ as $row ) {
                ?><div style="padding: 6px;border: 1px solid #DDDDDD;"><?php echo $row[Parroquia]; ?></div><?php
            }
            ?>
        </div>
</div>
<?php
} ?>
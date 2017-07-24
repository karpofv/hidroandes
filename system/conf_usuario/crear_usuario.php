<link href="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery-1.12.4.js"></script>
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<?php
$codigo = $_POST[codigo];
$cedula = $_POST[cedula];
$nombre = utf8_encode($_POST[nombre]);
$apellido = utf8_encode($_POST[apellido]);
$usuario = utf8_encode($_POST[usuario]);
$pass = md5($_POST[pass]);
$tipo = $_POST[tipo];
$eliminar = $_POST[eliminar];
$editar = $_POST[editar];
/*GUARDAR*/
if ($editar=='1' and $codigo==""){
    $consulu = paraTodos::arrayConsultanum("*", "usuarios", "Cedula='$cedula'");
    if ($consulu>0){
        paraTodos::showMsg("Esta persona ya se encuentra registrada", "alert-danger");
    } else{
        paraTodos::arrayInserte("Cedula, Usuario, Nivel, contrasena, Tipo", "usuarios", "$cedula, '$usuario', '$tipo', '$pass', 'Empleado'");
        paraTodos::arrayInserte("cedula, Nombres, Apellidos", "registrados", "$cedula, '$nombre', '$apellido'");
    }
}
/*UPDATE*/
if($editar == 1 and $nombre !="" and $codigo!=""){
    paraTodos::arrayUpdate("Cedula='$cedula', Usuario='$usuario', Nivel='$tipo', contrasena='$pass'", "usuarios", "id=$codigo");
    paraTodos::arrayUpdate("cedula='$cedula', Nombres='$nombre', Apellidos='$apellido'", "registrados", "cedula=$cedula");
    $codigo="";    
}
/*ELIMINAR*/
if ($eliminar !=''){
    paraTodos::arrayDelete("id=$codigo", "usuarios");
    $codigo="";
}
/*MOSTRAR*/
if($editar == 1 and $codigo !="" and $nombre==""){
    
    $consulta = paraTodos::arrayConsulta("u.Cedula, r.Nombres, r.Apellidos,u.Usuario, p.Nombre", "usuarios u, registrados r, perfiles p", "u.Cedula=r.cedula and u.Nivel=p.CodPerfil and u.id=$codigo");
    foreach($consulta as $row){
        $cedula =$row[Cedula];
        $nombre =$row[Nombres];
        $apellido =$row[Apellidos];
        $usuario =$row[Usuario];
        $tipo =$row[Nombre];
    }
}
?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Usuarios</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal" method="post" action="javascript:void(0)" onsubmit="
                                $.ajax({
                                url:'accion.php',
                                type:'POST',
                                data:{
                                dmn 	: <?php echo $idMenut;?>,
                                codigo 	: $('#codigo').val(),
                                cedula 	: $('#cedula').val(),
                                nombre 	: $('#nombre').val(),
                                apellido 	: $('#apellido').val(),
                                usuario 	: $('#usuario').val(),
                                pass 	: $('#clave').val(),
                                tipo 	: $('#seltipo').val(),
                                editar: 1,
                                ver 	: 2
                                },
                                success : function (html) {
                                $('#page-content').html(html);
                                $('#cedula').val('');
                                $('#nombre').val('');
                                $('#apellido').val('');
                                $('#usuario').val('');
                                },
                                }); return false;">
                        <div class="col-sm-2" style="display: block;">
                            <label class="control-label" for="cedula">Cédula</label>
                            <input class="form-control" id="cedula" type="number" value="<?php echo $cedula; ?>">
                            <input class="form-control" id="codigo" type="hidden" value="<?php echo $codigo; ?>"> </div>
                        <div class="col-sm-5" style="display: block;">
                            <label class="control-label" for="nombre">Nombres</label>
                            <input class="form-control" id="nombre" type="text" value="<?php echo $nombre;?>"> </div>
                        <div class="col-sm-5" style="display: block;">
                            <label class="control-label" for="apellido">Apellidos</label>
                            <input class="form-control" id="apellido" type="text" value="<?php echo $apellido;?>"> </div>
                        <div class="col-sm-4" style="display: block;">
                            <label class="control-label" for="usuario">Usuario</label>
                            <input class="form-control" id="usuario" type="text" value="<?php echo $usuario;?>"> </div>
                        <div class="col-sm-4" style="display: block;">
                            <label class="control-label" for="clave">clave</label>
                            <input class="form-control" id="clave" type="password"> </div>
                        <div class="col-sm-4" style="display: block;">
                            <label class="control-label" for="seltipo">Tipo de usuario</label>
                            <select class="form-control" id="seltipo">
                                <?php
                                combos::CombosSelect("1", "$tipo", "CodPerfil, Nombre", "perfiles", "CodPerfil", "Nombre", "CodPerfil<>2");
                                ?>
                            </select>
                        </div>
                        <div class="box-footer">
                            <input id="enviar" type="submit" value="Guardar" class="btn btn-primary col-md-offset-5"> </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Usuarios registrados</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table table-hover" id="usuarios">
                        <thead>
                            <tr>
                                <td class="text-center"><strong>Cédula</strong></td>
                                <td class="text-center"><strong>Nombres</strong></td>
                                <td class="text-center"><strong>Apellidos</strong></td>
                                <td class="text-center"><strong>Usuario</strong></td>
                                <td class="text-center"><strong>Tipo de usuario</strong></td>
                                <td class="text-center"><strong>Editar</strong></td>
                                <td class="text-center"><strong>Eliminar</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        $consulta = paraTodos::arrayConsulta("u.id, u.Cedula, r.Nombres, r.Apellidos,u.Usuario, p.Nombre", "usuarios u, registrados r, perfiles p", "u.Cedula=r.cedula and u.Nivel=p.CodPerfil and  u.Nivel<>2");
                        foreach($consulta as $row){
                        ?>
                                <tr>
                                    <td class="text-center">
                                        <?php echo $row[Cedula];?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo utf8_decode($row[Nombres]);?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo utf8_decode($row[Apellidos]);?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo utf8_decode($row[Usuario]);?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo utf8_decode($row[Nombre]);?>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0);" onclick="$.ajax({
                                                url:'accion.php',
                                                type:'POST',
                                                data:{
                                                dmn 	: <?php echo $idMenut;?>,
                                                codigo 	: <?php echo $row[id];?>,
                                                editar 	: 1,
                                                ver 	: 2
                                                },
                                                success : function (html) {
                                                $('#page-content').html(html);
                                                },
                                                }); return false;"> <i class="fa fa-edit"></i> </a>
                                    </td>
                                    <td class="text-center"> <a href="javascript:void(0);" onclick="$.ajax({
                                                url:'accion.php',
                                                type:'POST',
                                                data:{
                                                dmn 	: <?php echo $idMenut;?>,
                                                codigo 	: <?php echo $row[id];?>,
                                                eliminar : 1,
                                                ver 	: 2
                                                },
                                                success : function (html) {
                                                $('#page-content').html(html);
                                                },
                                                }); return false;"><i class="fa fa-eraser"></i>
                                    </a> </td>
                                </tr>
                                <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#usuarios').DataTable({
            "language": {
                "url": "<?php echo $ruta_base;?>assets/js/Spanish.json"
            }
        });
    </script>
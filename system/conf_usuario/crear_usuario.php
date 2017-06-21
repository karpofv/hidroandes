<link href="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo $ruta_base; ?>assets/plugins/datatables/buttons.dataTables.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery-1.12.4.js"></script>
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/buttons.print.min.js"></script>
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/buttons.colVis.min.js"></script>
<?php
	$cedula = $_POST[cedula];
	$nombre = utf8_encode($_POST[nombre]);
	$apellido = utf8_encode($_POST[apellido]);
	$usuario = utf8_encode($_POST[usuario]);
	$pass = md5($_POST[pass]);
	$tipo = $_POST[tipo];
	$eliminar = $_POST[eliminar];
	$editar = $_POST[editar];
	$insertar = $_POST[insertar];
	/*GUARDAR*/
	if ($insertar=='1'){
		$consulu = paraTodos::arrayConsultanum("*", "usuarios", "Cedula='$cedula'");
		if ($consulu>0){
			paraTodos::showMsg("Esta persona ya se encuentra registrada", "alert-danger");
		} else{
			paraTodos::arrayInserte("Cedula, Nombres, Apellidos, Usuario, Nivel, contrasena", "usuarios", "$cedula, '$nombre', '$apellido', '$usuario', '$tipo', '$pass'");
		}
	}
	/*MOSTRAR*/
	if($editar == 1 and $nombre ==""){
        $consulta = paraTodos::arrayConsulta("*", "usuarios u", "u.Cedula=$cedula");
		foreach($consulta as $row){
            $nombre = $row[Nombres];
            $apellido = $row[Apellidos];
            $tipo = $row[Nivel];
            $usuario = $row[Usuario];
        }
	}
	/*UPDATE*/
	if($editar == 1 and $nombre !=""){
		paraTodos::arrayUpdate("Nombres='$nombre', Apellidos='$apellido', Usuario='$usuario', contrasena='$pass', Nivel='$tipo'", "usuarios", "Cedula=$cedula");
	}
	/*ELIMINAR*/
	if ($eliminar !=''){
		paraTodos::arrayDelete("Cedula=$cedula", "usuarios");
	}
?>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Administrar usuarios</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <form class="form-horizontal">
                    <div class="form-group" style="display: block;">
                        <label class="col-sm-1 control-label" for="cedula">Cédula</label>
                        <div class="col-sm-8">
                            <input class="form-control" id="cedula" type="number" value="<?php echo $cedula; ?>"> </div>
                    </div>
                    <div class="form-group" style="display: block;">
                        <label class="col-sm-1 control-label" for="nombre">Nombres</label>
                        <div class="col-sm-8">
                            <input class="form-control" id="nombre" type="text" value="<?php echo $nombre;?>"> </div>
                    </div>
                    <div class="form-group" style="display: block;">
                        <label class="col-sm-1 control-label" for="apellido">Apellidos</label>
                        <div class="col-sm-8">
                            <input class="form-control" id="apellido" type="text" value="<?php echo $apellido;?>">
                        </div>
                    </div>
                    <div class="form-group" style="display: block;">
                        <label class="col-sm-1 control-label" for="usuario">Usuario</label>
                        <div class="col-sm-8">
                            <input class="form-control" id="usuario" type="text" value="<?php echo $usuario;?>">
                        </div>
                    </div>
                    <div class="form-group" style="display: block;">
                        <label class="col-sm-1 control-label" for="clave">clave</label>
                        <div class="col-sm-8">
                            <input class="form-control" id="clave" type="password">
                        </div>
                    </div>
                    <div class="form-group" style="display: block;">
                        <label class="col-sm-1 control-label" for="seltipo">Tipo de usuario</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="seltipo">
                                <?php
                                combos::CombosSelect("1", "$tipo", "CodPerfil, Nombre", "perfiles", "CodPerfil", "Nombre", "CodPerfil<>2");
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="box-footer">
                        <input id="enviar" type="button" value="Guardar" class="btn btn-primary col-md-offset-5"
                               onclick="
                                        <?php
                                        if($editar==""){
                                        ?>
                                        $.ajax({
                                        url:'accion.php',
                                        type:'POST',
                                        data:{
                                        dmn 	: <?php echo $idMenut;?>,
                                        cedula 	: $('#cedula').val(),
                                        nombre 	: $('#nombre').val(),
                                        apellido 	: $('#apellido').val(),
                                        usuario 	: $('#usuario').val(),
                                        pass 	: $('#clave').val(),
                                        tipo 	: $('#seltipo').val(),
                                        insertar: 1,
                                        ver 	: 2
                                        },
                                        success : function (html) {
                                        $('#page-content').html(html);
                                        $('#cedula').val('');
                                        $('#nombre').val('');
                                        $('#apellido').val('');
                                        $('#usuario').val('');
                                        },
                                        }); return false;
                                        <?php
                                        } else {
                                        ?>
                                        $.ajax({
                                        url:'accion.php',
                                        type:'POST',
                                        data:{
                                        dmn 	: <?php echo $idMenut;?>,
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
                                        }); return false;
                                        <?php
                                               }
                                        ?>
                                        "> 
                    </div>
                </form>
                <div class="row">
                    <table class="table table-hover" id="usuarios">
                        <thead>
                            <tr>
                                <td class="text-center"><strong>Cédula</strong></td>
                                <td class="text-center"><strong>Nombre y Apellido</strong></td>
                                <td class="text-center"><strong>Usuario</strong></td>
                                <td class="text-center"><strong>Tipo de usuario</strong></td>
                                <td class="text-center"><strong>Editar</strong></td>
                                <td class="text-center"><strong>Eliminar</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $consulsol = paraTodos::arrayConsulta("u.cedula, u.Nombres, u.Apellidos, u.Usuario, u.Nivel, p.Nombre", "usuarios u, perfiles p", "u.Nivel<>2 and u.Nivel=p.CodPerfil");
                            foreach($consulsol as $row){
                            ?>
                            <tr>
                                <td class="text-center">
                                    <?php echo $row[cedula];?>
                                </td>
                                <td class="text-center">
                                    <?php echo utf8_decode($row[Nombres]." ".$row[Apellidos]);?>
                                </td>
                                <td class="text-center">
                                    <?php echo utf8_decode($row[Usuario]);?>
                                </td>
                                <td class="text-center">
                                    <?php echo utf8_decode($row[Nombre]);?>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0);"
                                       onclick="$.ajax({
                                                url:'accion.php',
                                                type:'POST',
                                                data:{
                                                dmn 	: <?php echo $idMenut;?>,
                                                cedula 	: <?php echo $row[cedula];?>,
                                                editar 	: 1,
                                                ver 	: 2
                                                },
                                                success : function (html) {
                                                $('#page-content').html(html);
                                                },
                                                }); return false;"><i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0);"
                                       onclick="$.ajax({
                                                url:'accion.php',
                                                type:'POST',
                                                data:{
                                                dmn 	: <?php echo $idMenut;?>,
                                                cedula 	: <?php echo $row[cedula];?>,
                                                eliminar : 1,
                                                ver 	: 2
                                                },
                                                success : function (html) {
                                                $('#page-content').html(html);
                                                },
                                                }); return false;"><i class="fa fa-eraser"></i>
                                    </a>
                                </td>
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
</div>
<script>
    $('#usuarios').DataTable({
        "language": {
            "url": "<?php echo $ruta_base;?>assets/theme/js/Spanish.json"
        }
    });
</script>

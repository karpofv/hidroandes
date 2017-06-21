<?php
	$codigo = $_POST[codigo];
	$cedula = $_POST[cedula];
	$nombre = $_POST[nombre];
	$apellido = $_POST[apellido];
	$telefono = $_POST[telefono];
	$correo = $_POST[correo];
	$cargo = $_POST[car];
	$dep = $_POST[dep];
	$eliminar = $_POST[eliminar];
	$editar = $_POST[editar];
	$insertar = $_POST[insertar];
	/*GUARDAR*/
	if ($insertar=='1'){
		$consul = paraTodos::arrayConsultanum("cedula", "personal", "per_cedula=$cedula");
		if ($consul>0){
			paraTodos::showMsg("Esta persona ya se encuentra registrada", "alert-danger");
		} else{
			paraTodos::arrayInserte("per_cedula, per_nombres, per_apellidos, per_telefonos, per_correo, per_cargo, per_departamento", "personal", "$cedula, '$nombre', '$apellido', '$telefono', '$correo', $cargo, $dep");
		}
	}
	/*MOSTRAR*/
	if($editar == 1 and $nombre ==""){
        $consulta = paraTodos::arrayConsulta("*", "personal p", "p.per_codigo=$codigo");
		foreach($consulta as $row){
		  $cedula = $row[per_cedula];
		  $nombre = $row[per_nombres];
		  $apellido = $row[per_apellidos];
		  $telefono = $row[per_telefonos];
		  $correo = $row[per_correo];
		}
	}
	/*UPDATE*/
	if($editar == 1 and $nombre !=""){
		paraTodos::arrayUpdate("per_cedula=$cedula, per_nombres='$nombre', per_apellidos='$apellido', per_telefonos='$telefono', per_correo='$correo', per_cargo='$cargo', per_departamento='$dep'", "personal", "per_codigo=$codigo");
	}
	/*ELIMINAR*/
	if ($eliminar !=''){
		paraTodos::arrayDelete("per_codigo=$codigo", "personal");
	}
?>
    <div class="content">
        <div>
            <div class="page-header-title">
                <h4 class="page-title">Personal</h4> </div>
        </div>
        <div class="page-content-wrapper ">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <h4 class="m-b-30 m-t-0">Administrar personal</h4>
                                <div class="row">
                                    <form class="form-horizontal">
                                        <div class="form-group" style="display: block;">
                                            <label class="col-sm-2 control-label" for="cedula">Cédula</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="cedula" type="number" value="<?php echo $cedula; ?>">
                                                <input class="form-control collapse" id="codigo" type="number" value="<?php echo $codigo; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group" style="display: block;">
                                            <label class="col-sm-2 control-label" for="nombre">Nombres</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="nombre" type="text" value="<?php echo $nombre;?>"> </div>
                                        </div>
                                        <div class="form-group" style="display: block;">
                                            <label class="col-sm-2 control-label" for="apellido">Apellidos</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="apellido" type="text" value="<?php echo $apellido;?>"> </div>
                                        </div>
                                        <div class="form-group" style="display: block;">
                                            <label class="col-sm-2 control-label" for="txttelefono">Teléfonos</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="txttelefono" type="text" value="<?php echo $telefono;?>"> </div>
                                        </div>
                                        <div class="form-group" style="display: block;">
                                            <label class="col-sm-2 control-label" for="txtcorreo">Correo electrónico</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="txtcorreo" type="mail" value="<?php echo $correo;?>"> </div>
                                        </div>
                                        <div class="form-group" style="display: block;">
                                            <label class="col-sm-2 control-label" for="txtcorreo">Cargo</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="selcar">
                                                    <option value="0">Seleccione un cargo</option>
                                                <?php
                                                combos::CombosSelect("1", "$cargo", "car_codigo, car_descripcion", "cargos", "car_codigo", "car_descripcion", "1=1");
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" style="display: block;">
                                            <label class="col-sm-2 control-label" for="txtcorreo">Departamento</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="seldep">
                                                    <option value="0">Seleccione un departamento</option>
                                                <?php
                                                combos::CombosSelect("1", "$dep", "dep_codigo, dep_descripcion", "departamento", "dep_codigo", "dep_descripcion", "1=1");
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <input id="enviar" type="button" value="Guardar" class="btn btn-primary col-md-offset-5" onclick="
<?php
						if($editar==""){
?>
                            $.ajax({
								url:'accion.php',
								type:'POST',
								data:{
									dmn 	: <?php echo $idMenut;?>,
									codigo 	: $('#codigo').val(),
									cedula 	: $('#cedula').val(),
									nombre 	: $('#nombre').val(),
									apellido: $('#apellido').val(),
									telefono: $('#txttelefono').val(),
									correo: $('#txtcorreo').val(),
									dep: $('#seldep').val(),
									car: $('#selcar').val(),
									insertar: 1,
									ver 	: 2
								},
								success : function (html) {
									$('#page-content').html(html);
									$('#cedula').val('');
									$('#nombre').val('');
									$('#apellido').val('');
									$('#txttelefono').val('');
									$('#txtcorreo').val('');
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
									codigo 	: $('#codigo').val(),
									cedula 	: $('#cedula').val(),
									nombre 	: $('#nombre').val(),
									apellido: $('#apellido').val(),
									telefono: $('#txttelefono').val(),
									correo: $('#txtcorreo').val(),
									dep: $('#seldep').val(),
									car: $('#selcar').val(),
									editar: 1,
									ver 	: 2
								},
								success : function (html) {
									$('#page-content').html(html);
									$('#cedula').val('');
									$('#nombre').val('');
									$('#apellido').val('');
									$('#txttelefono').val('');
									$('#txtcorreo').val('');
								},
							}); return false;
<?php
					}
?>
                   "> </div>
                                    </form>
                                </div>
                                <div class="row">
                                    <table class="table table-hover" id="personal">
                                        <thead>
                                            <tr>
                                                <td class="text-center"><strong>Cédula</strong></td>
                                                <td class="text-center"><strong>Nombre y Apellido</strong></td>
                                                <td class="text-center"><strong>Teléfonos</strong></td>
                                                <td class="text-center"><strong>Correo</strong></td>
                                                <td class="text-center"><strong>Cargo</strong></td>
                                                <td class="text-center"><strong>Dept.</strong></td>
                                                <td class="text-center"><strong>Editar</strong></td>
                                                <td class="text-center"><strong>Eliminar</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
								            $consulsol = paraTodos::arrayConsulta("*", "personal p, cargos c, departamento d", "p.per_cargo=c.car_codigo and p.per_departamento=d.dep_codigo");
								            foreach($consulsol as $row){
?>
                                            <tr>
                                                <td class="text-center">
                                                    <?php echo $row[per_cedula];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo utf8_decode($row[per_nombres]." ".$row[per_apellidos]);?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[per_telefonos];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[per_correo];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[car_descripcion];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[dep_descripcion];?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="javascript:void(0);" onclick="$.ajax({
                                                        url:'accion.php',
                                                        type:'POST',
                                                        data:{
                                                            dmn 	: <?php echo $idMenut;?>,
                                                            codigo 	: <?php echo $row[per_codigo];?>,
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
                                                    <a href="javascript:void(0);" onclick="$.ajax({
                                                        url:'accion.php',
                                                        type:'POST',
                                                        data:{
                                                            dmn 	: <?php echo $idMenut;?>,
                                                            codigo 	: <?php echo $row[per_codigo];?>,
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
            </div>
        </div>
    </div>
    <script>
        $('#personal').DataTable({
            "language": {
                "url": "<?php echo $ruta_base;?>assets/js/Spanish.json"
            }
        });
    </script>

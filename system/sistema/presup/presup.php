<link href="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery-1.12.4.js"></script>
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<?php
$codigo = $_POST[codigo];
$partidas = $_POST[partidas];
$descripcion = $_POST[descripcion];
$montoi = $_POST[montoi];
$eliminar = $_POST[eliminar];
$editar = $_POST[editar];
/*GUARDAR*/
if ($editar=='1' and $codigo==""){
    $consulu = paraTodos::arrayConsultanum("*", "partidas", "part_descripcion='$partidas'");
    if ($consulu>0){
        paraTodos::showMsg("Esta partida ya se encuentra registrada", "alert-danger");
    } else{
        paraTodos::arrayInserte("part_descripcion, part_partida, part_montoi", "partidas", "'$descripcion', '$partidas', '$monotoi'");
        $codigo="";    
        $partidas = "";
        $descripcion = "";
        $montoi = "";
    }
}
/*UPDATE*/
if($editar == 1 and $partidas !="" and $codigo!=""){
    paraTodos::arrayUpdate("part_descripcion='$descripcion', part_partida='$partidas', part_montoi='$montoi'", "partidas", "part_codigo=$codigo");
    $codigo="";    
    $partidas = "";
    $descripcion = "";
    $montoi = "";
}
/*ELIMINAR*/
if ($eliminar !=''){
    paraTodos::arrayDelete("part_codigo=$codigo", "partidas");
    $codigo="";
}
/*MOSTRAR*/
if($editar == 1 and $codigo !="" and $partidas==""){
    
    $consulta = paraTodos::arrayConsulta("*", "partidas", "part_codigo=$codigo");
    foreach($consulta as $row){
        $partidas = $row[part_partida];
        $descripcion = $row[part_descripcion];
        $montoi = $row[part_montoi];
    }
}
?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Partidas presupuestarias</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal" onsubmit="
                            $.ajax({
								url:'accion.php',
								type:'POST',
								data:{
									dmn 	: <?php echo $idMenut;?>,
									codigo 	: $('#codigo').val(),
									partidas 	: $('#txtpartidas').val(),
									descripcion 	: $('#txtdescrip').val(),
									montoi 	: $('#txtmontoi').val(),
									editar: 1,
									ver 	: 2
								},
								success : function (html) {
									$('#page-content').html(html);
								},
							}); return false;
                   " action="javascript:void(0);" method="post">
                        <div class="form-group" style="display: block;">
                            <div class="col-sm-6">
                                <label class="control-label" for="txtpartidas">Partida</label>
                                <input class="form-control" id="txtpartidas" type="text" value="<?php echo $partidas; ?>" required>
                                <input class="form-control collapse" id="codigo" type="hidden" value="<?php echo $codigo; ?>">
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label" for="txtdescrip">Descripcion</label>
                                <input class="form-control" id="txtdescrip" type="text" value="<?php echo $descripcion; ?>" required>
                            </div>
                        </div>
                        <div class="form-group" style="display: block;">
                            <div class="col-sm-3">
                                <label class="control-label" for="txtmontoi">Monto inicial</label>
                                <input class="form-control" id="txtmontoi" type="text" value="<?php echo $montoi; ?>" required>
                            </div>
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
                    <h5>Partidas registradas</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table table-hover" id="partidas">
                        <thead>
                            <tr>
                                <td class="text-center"><strong>Partidas</strong></td>
                                <td class="text-center"><strong>Descripción</strong></td>
                                <td class="text-center"><strong>Monto inicial</strong></td>
                                <td class="text-center"><strong>Editar</strong></td>
                                <td class="text-center"><strong>Eliminar</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        $consulta = paraTodos::arrayConsulta("*", "partidas", "1=1");
                        foreach($consulta as $row){
                        ?>
                                <tr>
                                    <td class="text-center">
                                        <?php echo $row[part_partida];?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row[part_descripcion];?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row[part_montoi];?>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0);" onclick="$.ajax({
                                                url:'accion.php',
                                                type:'POST',
                                                data:{
                                                dmn 	: <?php echo $idMenut;?>,
                                                codigo 	: <?php echo $row[part_codigo];?>,
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
                                                codigo 	: <?php echo $row[part_codigo];?>,
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
        $('#partidas').DataTable({
            "language": {
                "url": "<?php echo $ruta_base;?>assets/js/Spanish.json"
            }
        });
    </script>
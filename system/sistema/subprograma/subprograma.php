<link href="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery-1.12.4.js"></script>
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<?php
$codigo = $_POST[codigo];
$programa = $_POST[programa];
$subprograma = $_POST[subprograma];
$eliminar = $_POST[eliminar];
$editar = $_POST[editar];
/*GUARDAR*/
if ($editar=='1' and $codigo==""){
    $consulu = paraTodos::arrayConsultanum("*", "subprograma", "subp_descripcion='$subprograma'");
    if ($consulu>0){
        paraTodos::showMsg("Este subprograma ya se encuentra registrado", "alert-danger");
    } else{
        paraTodos::arrayInserte("subp_procodigo,subp_descripcion", "subprograma", "$programa, '$subprograma'");
        $codigo="";    
        $subprograma = "";
    }
}
/*UPDATE*/
if($editar == 1 and $subprograma !="" and $codigo!=""){
    paraTodos::arrayUpdate("subp_descripcion='$subprograma'", "subprograma", "subp_codigo=$codigo");
    $codigo="";    
    $subprograma = "";
}
/*ELIMINAR*/
if ($eliminar !=''){
    paraTodos::arrayDelete("subp_codigo=$codigo", "subprograma");
    $codigo="";
}
/*MOSTRAR*/
if($editar == 1 and $codigo !="" and $subprograma==""){
    
    $consulta = paraTodos::arrayConsulta("*", "subprograma", "subp_codigo=$codigo");
    foreach($consulta as $row){
        $subprograma = $row[subp_descripcion];
        $programa = $row[subp_procodigo];
    }
}
?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>subprogramaes</h5>
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
									subprograma 	: $('#txtsubprograma').val(),
									programa 	: $('#txtprograma').val(),
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
                                <label class="control-label" for="txtprograma">programa</label>
                                <select class="form-control" id="txtprograma" required>
                                    <option value="">Seleccione una opción</option>
                                    <?php
                                    combos::CombosSelect("1", "$programa", "*", "programa", "pro_codigo", "pro_descripcion", "1=1");
                                    ?>
                                </select>
                                <input class="form-control collapse" id="codigo" type="hidden" value="<?php echo $codigo; ?>"> </div>                            
                            <div class="col-sm-6">
                                <label class="control-label" for="txtsubprograma">subprograma</label>
                                <input class="form-control" id="txtsubprograma" type="text" value="<?php echo $subprograma; ?>" required>
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
                    <h5>subprogramaes registrado</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table table-hover" id="subprograma">
                        <thead>
                            <tr>
                                <td class="text-center"><strong>Programa</strong></td>
                                <td class="text-center"><strong>subprograma</strong></td>
                                <td class="text-center"><strong>Editar</strong></td>
                                <td class="text-center"><strong>Eliminar</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        $consulta = paraTodos::arrayConsulta("*", "subprograma s, programa p", "p.pro_codigo=subp_procodigo");
                        foreach($consulta as $row){
                        ?>
                                <tr>
                                    <td class="text-center">
                                        <?php echo $row[pro_descripcion];?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row[subp_descripcion];?>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0);" onclick="$.ajax({
                                                url:'accion.php',
                                                type:'POST',
                                                data:{
                                                dmn 	: <?php echo $idMenut;?>,
                                                codigo 	: <?php echo $row[subp_codigo];?>,
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
                                                codigo 	: <?php echo $row[subp_codigo];?>,
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
        $('#subprograma').DataTable({
            "language": {
                "url": "<?php echo $ruta_base;?>assets/js/Spanish.json"
            }
        });
    </script>
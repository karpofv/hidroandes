<link href="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery-1.12.4.js"></script>
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<?php
    $partida = $_POST[partida];
    $unidad = $_POST[unidad];
    $editar = $_POST[editar];
    $codigo = $_POST[codigo];
    $eliminar = $_POST[eliminar];
    if($editar==1){
        paraTodos::arrayInserte("unip_parcodigo, unip_unicodigo", "unidad_presup", "'$partida', '$unidad'");
    }
    if($eliminar==1){
        paraTodos::arrayDelete("unip_codigo=$codigo", "unidad_presup");
    }
?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <?php
                    ?>
                        <h5>Unidades ejecutoras</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
                        </div>
                </div>
                <div class="ibox-content">
                    <form class="" method="post" action="javascript:void(0)" onsubmit="$.ajax({
                                        type: 'POST',
                                        url: 'accion.php',
                                        data: {
                                                 dmn:<?php echo $idMenut;?>,
                                                 ver    :   2,
                                                 editar :   1,
                                                 partida:   $('#codpartida').val(),
                                                 unidad :   $('#txtunidad').val()
                                                 },
                                        ajaxSend: $('#page-content').html(cargando),                                                 
                                        success: function(html) {
                                            $('#page-content').html(html);
                                        },
                                        error: function(xhr,msg,excep) {
                                            alert('Error Status ' + xhr.status + ': ' + msg + '/ ' + excep);
                                        }
                                    });">
                        <div class="row">
                            <div class="form-group" style="display: block;">
                                <div class="col-sm-6">
                                    <label class="control-label" for="txtunidad">Unidad Ejecutora</label>
                                    <select class="form-control" id="txtunidad" onchange="
                                                  $.ajax({
                                        type: 'POST',
                                        url: 'accion.php',
                                        data: {
                                                 dmn    :   <?php echo $idMenut;?>,
                                                 ver    :   2,
                                                 unidad :    $('#txtunidad').val()
                                                 },
                                        ajaxSend: $('#page-content').html(cargando),                                                
                                        success: function(html) {
                                            $('#page-content').html(html);
                                        },
                                        error: function(xhr,msg,excep) {
                                            alert('Error Status ' + xhr.status + ': ' + msg + '/ ' + excep);
                                        }
                                    });" required>
                                        <option value="">Seleccione una opción</option>
                                        <?php
                                    combos::CombosSelect("1", "$unidad", "*", "unidad_eje", "uni_codigo", "uni_descripcion", "1=1");
                                    ?>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label class="control-label" for="btnbuscar">Partida presupuestaria</label>
                                    <br>
                                    <button type="button" class="btn" id="btnbuscar" onclick="$.ajax({
                                                 url:'accion.php',
                                                 type:'POST',
                                                 data:{
                                                 dmn 	: <?php echo $idMenut;?>,
                                                 unidad 	: $('#txtunidad').val(),
                                                 act :2,
                                                 ver 	: 2
                                                 },
                                                 success : function (html) {
                                                 $('#ventanaVer').html(html);
                                                 },
                                                 });"> <i class="fa fa-search"></i> </button>
                                    <input class="form-control" style="display:none;" type="number" id="codpartida" value="<?php echo $partida;?>" required>
                                    <label class="control-label"><strong id="buscpartida"><?php echo $partidanombre;?></strong></label>
                                </div>
                                <div class="col-xs-2">
                                    <br>
                                    <button type="submit" class="btn btn-defaul">Agregar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Partidas asignadas al a unidad ejecutora seleccionada</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table table-hover" id="unidad_presup">
                        <thead>
                            <tr>
                                <td class="text-center"><strong>Partida</strong></td>
                                <td class="text-center"><strong>Descripcion</strong></td>
                                <td class="text-center"><strong>Eliminar</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        $consulta = paraTodos::arrayConsulta("*", "unidad_presup up, unidad_eje ue, partidas p", "up.unip_parcodigo=p.part_codigo and up.unip_unicodigo=ue.uni_codigo and unip_unicodigo=$unidad");
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
                                        <a href="javascript:void(0);" onclick="$.ajax({
                                                url:'accion.php',
                                                type:'POST',
                                                data:{
                                                dmn 	: <?php echo $idMenut;?>,
                                                codigo 	: <?php echo $row[unip_codigo];?>,
                                                unidad :    $('#txtunidad').val(),
                                                eliminar 	: 1,
                                                ver 	: 2
                                                },
                                                success : function (html) {
                                                $('#page-content').html(html);
                                                },
                                                }); return false;"> <i class="fa fa-edit"></i> </a>
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
    <script>
        $('#unidad_presup').DataTable({
            "language": {
                "url": "<?php echo $ruta_base;?>assets/js/Spanish.json"
            }
        });
    </script>
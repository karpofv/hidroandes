<link href="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery-1.12.4.js"></script>
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<?php
    $partida = $_POST[partida];
    $unidad = $_POST[unidad];
    $editar = $_POST[editar];
    $codigo = $_POST[codigo];
    $eliminar = $_POST[eliminar];
    $generar = $_POST[generar];
    if($eliminar==1){
        paraTodos::arrayUpdate("req_estatus=1", "requisicion", "req_codigo=$codigo");
    }
    if($generar==1){
        $consultotal = paraTodos::arrayConsulta("sum(req_monto) as total", "requisicion r", "r.req_unicodigo=$unidad and r.req_estatus=3");
        foreach($consultotal as $row){
            $total= $row[total];
        }
        paraTodos::arrayInserte("ord_unicodigo, ord_fecha, ord_total", "orden", "$unidad, current_date, '$total'");
        $consulmaxorden = paraTodos::arrayConsulta("max(ord_codigo) as ord_codigo", "orden", "ord_unicodigo=$unidad");
        foreach($consulmaxorden as $maxorden){
            $orden = $maxorden[ord_codigo];
        }
        paraTodos::arrayUpdate("req_ordcodigo=$orden, req_estatus=4", "requisicion", "req_unicodigo=$unidad and req_estatus=3");
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
                            <div class="col-xs-6">
                                <?php
                                    $productosnum = paraTodos::arrayConsultanum("*", "requisicion r,producto p, partidas", "r.req_procodigo=p.prod_codigo and r.req_unicodigo=$unidad and prod_partida=part_codigo and req_estatus=3");
                                if($productosnum>0){
                                  ?>
                                <br>
                                <button type="button" class="btn btn-default"
                                        onclick="$.ajax({
                                                url:'accion.php',
                                                type:'POST',
                                                data:{
                                                dmn 	: <?php echo $idMenut;?>,
                                                unidad 	: <?php echo $unidad;?>,
                                                generar 	: 1,
                                                ver 	: 2
                                                },
                                                success : function (html) {
                                                $('#page-content').html(html);
                                                },
                                                }); return false;">Generar Orden de compra</button>                                
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Requisiciones registradas</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table table-hover" id="requisicion">
                        <thead>
                            <tr>
                                <td class="text-center"><strong>Partida</strong></td>
                                <td class="text-center"><strong>Producto</strong></td>
                                <td class="text-center"><strong>Medida</strong></td>
                                <td class="text-center"><strong>Precio</strong></td>
                                <td class="text-center"><strong>Cantidad</strong></td>
                                <td class="text-center"><strong>Total</strong></td>
                                <td class="text-center"><strong>Cancelar</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $consulrequisicion = paraTodos::arrayConsulta("*", "requisicion r,producto p, partidas", "r.req_procodigo=p.prod_codigo and r.req_unicodigo=$unidad and prod_partida=part_codigo and req_estatus=3");
                            foreach($consulrequisicion as $req){
                        ?>
                                <tr>
                                    <td class="text-center">
                                        <?php echo $req[part_partida];?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $req[prod_descripcion];?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $req[prod_medida];?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo number_format($req[prod_precio],2, ",", ".");?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo number_format($req[req_cantidad],2, ",", ".");?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo number_format($req[req_monto],2, ",", ".");?>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0);" onclick="$.ajax({
                                                url:'accion.php',
                                                type:'POST',
                                                data:{
                                                dmn 	: <?php echo $idMenut;?>,
                                                codigo 	: <?php echo $req[req_codigo];?>,
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
        $('#requisicion').DataTable({
            "language": {
                "url": "<?php echo $ruta_base;?>assets/js/Spanish.json"
            }
        });
    </script>
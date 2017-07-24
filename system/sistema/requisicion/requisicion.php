<?php
    $cedula = $_SESSION['ci'];
    $consulcodigo = paraTodos::arrayConsulta("per_codigo", "personal", "per_cedula=$cedula");
foreach($consulcodigo as $codigo){
    $codemp = $codigo[per_codigo];
}
    $consulunidad = paraTodos::arrayConsulta("uni_codigo", "unidad_eje", "uni_responsable=$codemp");
    foreach($consulunidad as $unidad){
        $codunidad = $unidad[uni_codigo];
    }
    
?>
    <link href="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <?php
$codigo = $_POST[codigo];
$unidad = $_POST[unidad];
$producto = $_POST[producto];
$cantidad = $_POST[cantidad];
$monto = $_POST[monto];
$eliminar = $_POST[eliminar];
$editar = $_POST[editar];
/*GUARDAR*/
if ($editar=='1' and $codigo==""){
    $consulprecio = paraTodos::arrayConsulta("prod_precio", "producto", "prod_codigo=$producto");
    foreach($consulprecio as $precio){
        $monto = $cantidad*$precio[prod_precio];
        $precio = $precio[prod_precio];
    }
    paraTodos::arrayInserte("req_fecha, req_unicodigo, req_procodigo, req_cantidad,req_precio, req_monto, req_estatus", "requisicion", "current_date, '$codunidad', '$producto', '$cantidad','$precio', '$monto', 1");
    $codigo="";    
    $requisicion = "";
}
if($eliminar==1){
    paraTodos::arrayDelete("req_codigo=$codigo", "requisicion");
    
}
?>
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
                                    <td class="text-center"><strong>Producto</strong></td>
                                    <td class="text-center"><strong>Medida</strong></td>
                                    <td class="text-center"><strong>Precio</strong></td>
                                    <td class="text-center"><strong>Cantidad</strong></td>
                                    <td class="text-center"><strong>Total</strong></td>
                                    <td class="text-center"><strong>solicitar</strong></td>
                                    <td class="text-center"><strong>Eliminar</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            $consulrequisicion = paraTodos::arrayConsulta("*", "requisicion r,producto p", "r.req_procodigo=p.prod_codigo and r.req_unicodigo=$codunidad and req_estatus=1");
                            foreach($consulrequisicion as $req){
                        ?>
                                    <tr>
                                        <td class="text-center">
                                            <?php echo $req[prod_descripcion];?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $req[prod_medida];?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $req[prod_precio];?>
                                        </td>
                                        <td>
                                            <?php echo $req[req_cantidad];?>
                                        </td>
                                        <td>
                                            <?php echo $req[req_monto];?>
                                        </td>
                                        <td class="text-center">
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
                                                }); return false;"> <i class="fa fa-eraser"></i> </a>
                                        </td>
                                    </tr>
                                    <?php                            
                            }
                        $consulta = paraTodos::arrayConsulta("*", "unidad_presup", "unip_unicodigo=$codunidad");
                        foreach($consulta as $row){
                            $consulproductos = paraTodos::arrayConsulta("*", "producto", "prod_partida=$row[unip_parcodigo] and prod_codigo not in (select req_procodigo from requisicion where req_unicodigo=$codunidad and (req_estatus=1 or req_estatus=3)");
                            foreach($consulproductos as $productos){
                                
                        ?>
                                        <tr>
                                            <td class="text-center">
                                                <?php echo $productos[prod_descripcion];?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $productos[prod_medida];?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $productos[prod_precio];?>
                                            </td>
                                            <td>
                                                <input class="form-control" id="cantidad<?php echo $productos[prod_codigo];?>" type="number"> </td>
                                            <td class="text-center">
                                            </td>                                            
                                            <td class="text-center">
                                                <a href="javascript:void(0);" onclick="$.ajax({
                                                url:'accion.php',
                                                type:'POST',
                                                data:{
                                                dmn 	: <?php echo $idMenut;?>,
                                                producto 	: <?php echo $productos[prod_codigo];?>,
                                                cantidad 	: $('#cantidad<?php echo $productos[prod_codigo];?>').val(),
                                                editar 	: 1,
                                                ver 	: 2
                                                },
                                                success : function (html) {
                                                $('#page-content').html(html);
                                                },
                                                }); return false;"> <i class="fa fa-edit"></i> </a>
                                            </td>                                            
                                            <td class="text-center">
                                            </td>                                            
                                        </tr>
                                        <?php
                            }                                
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
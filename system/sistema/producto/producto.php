<link href="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery-1.12.4.js"></script>
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<?php
$codigo = $_POST[codigo];
$producto = $_POST[producto];
$detalle = $_POST[detalle];
$medida = $_POST[medida];
$precio = $_POST[precio];
$partida = $_POST[partida];
$eliminar = $_POST[eliminar];
$editar = $_POST[editar];
/*GUARDAR*/
if ($editar=='1' and $codigo==""){
    $consulu = paraTodos::arrayConsultanum("*", "producto", "prod_descripcion='$producto'");
    if ($consulu>0){
        paraTodos::showMsg("Este producto ya se encuentra registrado", "alert-danger");
    } else{
        paraTodos::arrayInserte("prod_descripcion, prod_detalle, prod_medida, prod_precio, prod_partida", "producto", "'$producto', '$detalle', '$medida', '$precio', $partida");
        $codigo="";    
        $producto = "";
        $detalle = "";
        $precio = "";
        $medida = "";
        $partida = "";
    }
}
/*UPDATE*/
if($editar == 1 and $producto !="" and $codigo!=""){
    paraTodos::arrayUpdate("prod_descripcion='$producto', prod_detalle='$detalle', prod_medida='$medida', prod_precio='$precio', prod_partida=$partida", "producto", "prod_codigo=$codigo");
    $codigo="";    
    $producto = "";
    $detalle = "";
    $precio = "";
    $medida = "";
    $partida = "";
}
/*ELIMINAR*/
if ($eliminar !=''){
    paraTodos::arrayDelete("prod_codigo=$codigo", "producto");
    $codigo="";    
}
/*MOSTRAR*/
if($editar == 1 and $codigo !="" and $producto==""){
    
    $consulta = paraTodos::arrayConsulta("*", "producto pr left join partidas p on p.part_codigo=pr.prod_partida", "prod_codigo=$codigo");
    foreach($consulta as $row){
        $producto = $row[prod_descripcion];
        $detalle = $row[prod_detalle];
        $medida = $row[prod_medida];        
        $precio = $row[prod_precio];        
        $partida = $row[prod_partida];        
        $partidanombre = $row[part_partida];        
        
    }
}
?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Productos</h5>
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
									producto 	: $('#txtproducto').val(),
									medida 	: $('#txtmedida').val(),
									detalle 	: $('#txtdetalle').val(),
									precio 	: $('#txtprecio').val(),
									partida 	: $('#codpartida').val(),
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
                                <label class="control-label" for="txtproducto">Producto</label>
                                <input class="form-control" id="txtproducto" type="text" value="<?php echo $producto; ?>" required>
                                <input class="form-control collapse" id="codigo" type="hidden" value="<?php echo $codigo; ?>">
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label" for="txtmedida">Medida</label>
                                <input class="form-control" id="txtmedida" type="text" value="<?php echo $medida; ?>" required>
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label" for="txtprecio">Precio</label>
                                <input class="form-control" id="txtprecio" type="number" min="0" step="any" value="<?php echo $precio; ?>" required>
                            </div>
                        </div>
                        <div class="form-group" style="display: block;">
                            <div class="col-sm-10">
                                <label class="control-label" for="txtdetalle">Descripción del producto</label>
                                <input class="form-control" id="txtdetalle" type="text" value="<?php echo $detalle; ?>" required>
                            </div>
                            <div class="col-sm-2">
                                <label class="control-label" for="btnbuscar">Partida presupuestaria</label>
                                <br>
                                <button type="button" class="btn" id="btnbuscar" 
                                        onclick="$.ajax({
                                                 url:'accion.php',
                                                 type:'POST',
                                                 data:{
                                                 dmn 	: <?php echo $idMenut;?>,
                                                 act :2,
                                                 ver 	: 2
                                                 },
                                                 success : function (html) {
                                                 $('#ventanaVer').html(html);
                                                 },
                                                 });">
                                    <i class="fa fa-search"></i>
                                </button>
                                <input class="form-control" type="hidden" id="codpartida" value="<?php echo $partida;?>" required>
                                <label class="control-label"><strong id="buscpartida"><?php echo $partidanombre;?></strong></label>
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
                    <h5>Productos registrados</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table table-hover" id="producto">
                        <thead>
                            <tr>
                                <td class="text-center"><strong>Producto</strong></td>
                                <td class="text-center"><strong>Medida</strong></td>
                                <td class="text-center"><strong>Precio</strong></td>
                                <td class="text-center"><strong>Detalle</strong></td>
                                <td class="text-center"><strong>Partida</strong></td>
                                <td class="text-center"><strong>Editar</strong></td>
                                <td class="text-center"><strong>Eliminar</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        $consulta = paraTodos::arrayConsulta("*", "producto pr left join partidas p on p.part_codigo=pr.prod_partida", "1=1");
                        foreach($consulta as $row){
                        ?>
                                <tr>
                                    <td class="text-center">
                                        <?php echo $row[prod_descripcion];?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row[prod_medida];?>
                                    </td> 
                                    <td class="text-center">
                                        <?php echo number_format($row[prod_precio],2,",", ".");?>
                                    </td>                                    
                                    <td class="text-center">
                                        <?php echo $row[prod_detalle];?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row[part_partida];?>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0);" onclick="$.ajax({
                                                url:'accion.php',
                                                type:'POST',
                                                data:{
                                                dmn 	: <?php echo $idMenut;?>,
                                                codigo 	: <?php echo $row[prod_codigo];?>,
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
                                                codigo 	: <?php echo $row[prod_codigo];?>,
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
        $('#producto').DataTable({
            "language": {
                "url": "<?php echo $ruta_base;?>assets/js/Spanish.json"
            }
        });
    </script>
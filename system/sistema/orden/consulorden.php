<?php
    if($_SESSION['usuario_perfil']==4){
        $consulcodigo = paraTodos::arrayConsulta("per_codigo", "personal", "per_cedula=$_SESSION[ci]");
        foreach($consulcodigo as $codigo){
            $codemp = $codigo[per_codigo];
        }        
        $condicion = " and uni_responsable=$codemp";
    }
?>
<link href="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery-1.12.4.js"></script>
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Ordenes de compra Generadas</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table table-hover" id="ordenes">
                        <thead>
                            <tr>
                                <td class="text-center"><strong>Codigo</strong></td>
                                <td class="text-center"><strong>Fecha</strong></td>
                                <td class="text-center"><strong>Unidad Ejecutora</strong></td>
                                <td class="text-center"><strong>Monto</strong></td>
                                <td class="text-center"><strong>Ver detalles</strong></td>
                                <td class="text-center"><strong>Reimprimir</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $consulrequisicion = paraTodos::arrayConsulta("*", "orden, unidad_eje", "uni_codigo=ord_unicodigo $condicion");
                            foreach($consulrequisicion as $req){
                        ?>
                                <tr>
                                    <td class="text-center">
                                        <?php echo $req[ord_codigo];?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo paraTodos::convertDate($req[ord_fecha]);?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $req[uni_descripcion];?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo number_format($req[ord_total],2, ",", ".");?>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0);" onclick="$.ajax({
                                                url:'accion.php',
                                                type:'POST',
                                                data:{
                                                dmn 	: <?php echo $idMenut;?>,
                                                codigo 	: <?php echo $req[ord_codigo];?>,
                                                ver 	: 2,
                                                act     :   2
                                                },
                                                success : function (html) {
                                                $('#ventanaVer').html(html);
                                                },
                                                }); return false;"> Ver detalles </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="accion.php?dmn=123&cd=<?php echo $req[ord_codigo];?>&ver=2&act=2" target="_blank"> <i class="fa fa-print"></i> </a>
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
        $('#ordenes').DataTable({
            "language": {
                "url": "<?php echo $ruta_base;?>assets/js/Spanish.json"
            }
        });
    </script>
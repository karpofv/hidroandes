<?php
    $orden = $_POST[codigo];
?>
<div class="modal inmodal in" id="myModal5" tabindex="-1" role="dialog" aria-hidden="true" style="display:block;    background-color: rgba(0, 0, 0, 0.55);">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onclick="cerrarmodal();"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Requisiciones registradas</h4> <small class="font-bold"></small> </div>
            <div class="modal-body">
                    <table class="table table-hover" id="partidas">
                        <thead>
                            <tr>
                                <td class="text-center"><strong>Fecha</strong></td>
                                <td class="text-center"><strong>Producto</strong></td>
                                <td class="text-center"><strong>Cantidad</strong></td>
                                <td class="text-center"><strong>Precio</strong></td>
                                <td class="text-center"><strong>Total</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        $consulta = paraTodos::arrayConsulta("r.req_fecha, p.prod_descripcion, r.req_cantidad,r.req_precio, r.req_monto", "requisicion r, producto p", "r.req_ordcodigo=$orden and p.prod_codigo=r.req_procodigo");
                        foreach($consulta as $row){
                        ?>
                                <tr>
                                    <td class="text-center">
                                        <?php echo paraTodos::convertDate($row[req_fecha]);?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row[prod_descripcion];?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo number_format($row[req_cantidad],2,",",".");?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo number_format($row[req_precio],2,",",".");?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo number_format($row[req_monto],2,",",".");?>
                                    </td>
                                </tr>
                                <?php
                        }
                        ?>
                        </tbody>
                    </table>
            </div>
            <div class="modal-footer"> </div>
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
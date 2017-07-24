<?php
    $unidad = $_POST[unidad];
?>
<div class="modal inmodal in" id="myModal5" tabindex="-1" role="dialog" aria-hidden="true" style="display:block;    background-color: rgba(0, 0, 0, 0.55);">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onclick="cerrarmodal();"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Partidas registradas</h4> <small class="font-bold">Use el buscador para la partida a la que afectará el producto.</small> </div>
            <div class="modal-body">
                    <table class="table table-hover" id="partidas">
                        <thead>
                            <tr>
                                <td class="text-center"><strong>Partidas</strong></td>
                                <td class="text-center"><strong>Descripción</strong></td>
                                <td class="text-center"><strong>Monto inicial</strong></td>
                                <td class="text-center"><strong>Seleccionar</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        $consulta = paraTodos::arrayConsulta("*", "partidas p", "p.part_codigo not in (select unip_parcodigo from unidad_presup up where up.unip_unicodigo=$unidad)");
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
                                    <a href="javascript:void(0);" 
                                       onclick="
                                                $('#buscpartida').html('<?php echo $row[part_partida];?>');
                                                $('#codpartida').val(<?php echo $row[part_codigo];?>);
                                                cerrarmodal();
                                                "> <i class="fa fa-edit"></i> </a>
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
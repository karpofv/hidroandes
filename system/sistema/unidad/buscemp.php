<div class="modal inmodal in" id="myModal5" tabindex="-1" role="dialog" aria-hidden="true" style="display:block;    background-color: rgba(0, 0, 0, 0.55);">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onclick="cerrarmodal();"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Empleados registrados</h4> <small class="font-bold">Use el buscador para elegir al responsable de la unidad ejecutora.</small> </div>
            <div class="modal-body">
                <table class="table table-hover" id="empleados">
                    <thead>
                        <tr>
                            <td class="text-center"><strong>Cédula</strong></td>
                            <td class="text-center"><strong>Nombres</strong></td>
                            <td class="text-center"><strong>Apellidos</strong></td>
                            <td class="text-center"><strong>Seleccionar</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $consulta = paraTodos::arrayConsulta("*", "personal", "per_status=1 and per_codigo not in (select uni_responsable from unidad_eje)");
                        foreach($consulta as $row){
                        ?>
                            <tr>
                                <td class="text-center">
                                    <?php echo $row[per_cedula];?>
                                </td>
                                <td class="text-center">
                                    <?php echo $row[per_nombres];?>
                                </td>
                                <td class="text-center">
                                    <?php echo $row[per_apellidos];?>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0);" 
                                       onclick="
                                                $('#buscempleado').html('<?php echo $row[per_apellidos].' '.$row[per_nombres];?>');
                                                $('#codemp').val(<?php echo $row[per_codigo];?>);
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
        $('#empleados').DataTable({
            "language": {
                "url": "<?php echo $ruta_base;?>assets/js/Spanish.json"
            }
        });
    </script>
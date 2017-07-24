<link href="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery-1.12.4.js"></script>
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<?php
$codigo = $_POST[codigo];
$unidad_eje = $_POST[unidad_eje];
$codemp = $_POST[codemp];
$sector = $_POST[sector];
$programa = $_POST[programa];
$subprograma = $_POST[subprograma];
$activi = $_POST[actividad];
$obra = $_POST[obra];
$eliminar = $_POST[eliminar];
$editar = $_POST[editar];
/*GUARDAR*/
if ($editar=='1' and $codigo==""){
    $consulu = paraTodos::arrayConsultanum("*", "unidad_eje", "uni_descripcion='$unidad_eje'");
    if ($consulu>0){
        paraTodos::showMsg("Esta unidad ejecutora ya se encuentra registrada", "alert-danger");
    } else{
        paraTodos::arrayInserte("uni_descripcion,uni_sector,uni_programa, uni_subprograma, uni_actividad, uni_obra, uni_responsable", "unidad_eje", "'$unidad_eje','$sector', '$programa', '$subprograma', '$activi', '$obra', $codemp");
        $codigo="";    
        $unidad_eje = "";
        $sector = "";
        $programa = "";
        $subprograma = "";
        $activi = "";
        $obra = "";
    }
}
/*UPDATE*/
if($editar == 1 and $unidad_eje !="" and $codigo!=""){
    paraTodos::arrayUpdate("uni_descripcion='$unidad_eje',uni_sector='$sector',uni_programa='$programa', uni_subprograma='$subprograma', uni_actividad='$activi', uni_obra='$obra'", "unidad_eje", "uni_codigo=$codigo");
    $codigo="";    
    $unidad_eje = "";
    $sector = "";
    $programa = "";
    $subprograma = "";
    $activi = "";
    $obra = "";
}
/*ELIMINAR*/
if ($eliminar==1){
    paraTodos::arrayDelete("uni_codigo=$codigo", "unidad_eje");
    $codigo="";
}
/*MOSTRAR*/
if($editar == 1 and $codigo !="" and $unidad_eje==""){
    
    $consulta = paraTodos::arrayConsulta("*", "unidad_eje u left join personal p on u.uni_responsable=p.per_codigo", "uni_codigo=$codigo");
    foreach($consulta as $row){
        $unidad_eje = $row[uni_descripcion];
        $codemp = $row[uni_responsable];
        $responsable = $row[per_apellidos]." ".$row[per_nombres];
        $sector = $row[uni_sector];
        $programa = $row[uni_programa];
        $subprograma = $row[uni_subprograma];
        $activi = $row[uni_actividad];
        $obra = $row[uni_obra];        
    }
}
?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Unidad ejecutora</h5>
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
									unidad_eje 	: $('#txtunidad_eje').val(),
									sector 	: $('#sector').val(),
									programa 	: $('#programa').val(),
									subprograma 	: $('#subprograma').val(),
									actividad 	: $('#actividad').val(),
									obra 	: $('#obra').val(),
									codemp 	: $('#codemp').val(),
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
                                <label class="control-label" for="txtunidad_eje">Unidad Ejecutora</label>
                                <input class="form-control" id="txtunidad_eje" type="text" value="<?php echo $unidad_eje; ?>" required>
                                <input class="form-control collapse" id="codigo" type="hidden" value="<?php echo $codigo; ?>">
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label" for="sector">Sector</label>
                                    <select class="form-control" id="sector" >
                                        <option value="">Seleccione una opción</option>
                                        <?php
                                    combos::CombosSelect("1", "$sector", "*", "sector", "sec_codigo", "sec_descripcion", "1=1");
                                    ?>
                                    </select>                                
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label" for="programa">Programa</label>
                                    <select class="form-control" id="programa"
                                            onchange="$.ajax({
								url:'accion.php',
								type:'POST',
								data:{
									dmn 	: <?php echo $idMenut;?>,
                                    codigo     : $('#programa').val(),
                                    act     : 10,
                                    actd    : 1,
									ver 	: 2
								},
								success : function (html) {
									$('#subprograma').html(html);
								},
							});">
                                        <option value="">Seleccione una opción</option>
                                        <?php
                                    combos::CombosSelect("1", "$programa", "*", "programa", "pro_codigo", "pro_descripcion", "1=1");
                                    ?>
                                    </select>                                
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label" for="subprograma">Sub-programa</label>
                                <select class="form-control" id="subprograma">
                                        <?php
                                    combos::CombosSelect("1", "$subprograma", "*", "subprograma", "subp_codigo", "subp_descripcion", "subp_procodigo=$programa");
                                    ?>                                    
                                </select>                                
                            </div> 
                            <div class="col-sm-3">
                                <label class="control-label" for="actividad">Actividad</label>
                                    <select class="form-control" id="actividad" >
                                        <option value="">Seleccione una opción</option>
                                        <?php
                                    combos::CombosSelect("1", "$activi", "*", "actividad", "act_codigo", "act_descripcion", "1=1");
                                    ?>
                                    </select>                                
                            </div>  
                            <div class="col-sm-3">
                                <label class="control-label" for="obra">Obra</label>
                                    <select class="form-control" id="obra">
                                        <option value="">Seleccione una opción</option>
                                        <?php
                                    combos::CombosSelect("1", "$obra", "*", "obra", "ob_codigo", "ob_descripcion", "1=1");
                                    ?>
                                    </select>                                
                            </div>                            
                            <div class="col-sm-3">
                                <label class="control-label" for="btnbuscar">Buscar responsable</label>
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
                                <input class="form-control" type="hidden" id="codemp" value="<?php echo $codemp;?>" required>
                                <label class="control-label"><strong id="buscempleado"><?php echo $responsable;?></strong></label>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input id="enviar" type="submit" value="Guardar" class="btn btn-primary col-md-offset-5">                             
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
                    <h5>Unidades Ejecutoras registradas</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table table-hover" id="unidad_eje">
                        <thead>
                            <tr>
                                <td class="text-center"><strong>Unidad Ejecutora</strong></td>
                                <td class="text-center"><strong>Sector</strong></td>
                                <td class="text-center"><strong>Programa</strong></td>
                                <td class="text-center"><strong>Sub-Programa</strong></td>
                                <td class="text-center"><strong>Actividad</strong></td>
                                <td class="text-center"><strong>Obra</strong></td>
                                <td class="text-center"><strong>Responsable</strong></td>
                                <td class="text-center"><strong>Editar</strong></td>
                                <td class="text-center"><strong>Eliminar</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        $consulta = paraTodos::arrayConsulta("ue.uni_codigo,ue.uni_descripcion, s.sec_descripcion, p.pro_descripcion, sp.subp_descripcion, a.act_descripcion, o.ob_descripcion, per.per_nombres, per.per_apellidos", "unidad_eje ue 
left join programa p on p.pro_codigo=ue.uni_programa
left join subprograma sp on sp.subp_codigo=ue.uni_subprograma
left join actividad a on a.act_codigo=ue.uni_actividad
left join obra o on o.ob_codigo=ue.uni_obra
left join sector s on s.sec_codigo=ue.uni_sector
left join personal per on per.per_codigo=ue.uni_responsable", "1=1");
                        foreach($consulta as $row){
                        ?>
                                <tr>
                                    <td class="text-center">
                                        <?php echo $row[uni_descripcion];?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row[sec_descripcion];?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row[pro_descripcion];?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row[subp_descripcion];?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row[act_descripcion];?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row[ob_descripcion];?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row[per_apellidos]." ".$row[per_nombres];?>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0);" onclick="$.ajax({
                                                url:'accion.php',
                                                type:'POST',
                                                data:{
                                                dmn 	: <?php echo $idMenut;?>,
                                                codigo 	: <?php echo $row[uni_codigo];?>,
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
                                                codigo 	: <?php echo $row[uni_codigo];?>,
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
        $('#unidad_eje').DataTable({
            "language": {
                "url": "<?php echo $ruta_base;?>assets/js/Spanish.json"
            }
        });
    </script>
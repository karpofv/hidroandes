<link href="<?php echo $ruta_base;?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<?php
	$codigo = $_POST[codigo];
	$cedula = $_POST[cedula];
	$nombre = $_POST[nombre];
	$direccion = $_POST[direccion];
	$telefono = $_POST[telefono];
	$correo = $_POST[correo];
	$sitio = $_POST[sitio];
	$rubro = $_POST[rubro];
	$eliminar = $_POST[eliminar];
	$validar = $_POST[validar];
	$editar = $_POST[editar];
	$insertar = $_POST[insertar];
    /*VALIDAR PROVEEDOR*/
    if($validar==1){
        paraTodos::arrayUpdate("prov_status=1", "proveedor", "prov_codigo=$codigo");
    }
	/*GUARDAR*/
	if ($editar=='1' and $codigo=="" and $nombre!=''){
		$consul = paraTodos::arrayConsultanum("prov_nit", "proveedor", "prov_nit=$cedula");
		if ($consul>0){
			paraTodos::showMsg("Este proveedor ya se encuentra registrado", "alert-danger");
		} else{
			$insertar = paraTodos::arrayInserte("prov_nit, prov_razon, prov_direccion, prov_email, prov_telefono, prov_sitioweb, prov_rubro, prov_status", "proveedor", "$cedula, '$nombre', '$direccion', '$correo', '$telefono', '$sitio', '$rubro', 0");
            if($insertar){
                paraTodos::showMsg("Registro exitoso", "alert-success", "");
            }
		}
	}
	/*UPDATE*/
	if($editar == 1 and $nombre !=""){
		$update = paraTodos::arrayUpdate("prov_nit='$cedula', prov_razon='$nombre', prov_direccion='$direccion', prov_email='$correo', prov_telefono='$telefono', prov_sitioweb='$sitio', prov_rubro='$rubro'", "proveedor", "prov_codigo=$codigo");
            if($update){
                paraTodos::showMsg("Actualización exitosa", "alert-success", "");
            }        
	}
	/*MOSTRAR*/
    if($accPermisos[S]==0){
        $editar=1;
        $consulcodigo = paraTodos::arrayConsulta("prov_codigo", "proveedor", "prov_nit=$_SESSION[ci]");
        foreach($consulcodigo as $codigoprov){
            $codigo = $codigoprov[prov_codigo];
        }
    }
	if($editar == 1 and $nombre ==""){
        $consulta = paraTodos::arrayConsulta("*", "proveedor p", "p.prov_codigo=$codigo");
		foreach($consulta as $row){
		  $cedula = $row[prov_nit];
		  $nombre = $row[prov_razon];
		  $direccion = $row[prov_direccion];
		  $telefono = $row[prov_telefono];
		  $correo = $row[prov_email];
		  $sitio = $row[prov_sitioweb];
		  $rubro = $row[prov_rubro];
		}
	}
	/*ELIMINAR*/
	if ($eliminar !=''){
		paraTodos::arrayDelete("prov_codigo=$codigo", "proveedor");
	}
    if($accPermisos[S]==0){
        $editar=1;
        $consulcodigo = paraTodos::arrayConsulta("prov_codigo", "proveedor", "prov_nit=$_SESSION[ci]");
        foreach($consulcodigo as $codigoprov){
            $codigo = $codigoprov[prov_codigo];
        }
    }
?>
    <div class="content">
        <div>
            <div class="page-header-title">
                <h4 class="page-title">Proveedor</h4> </div>
        </div>
        <div class="page-content-wrapper ">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <h4 class="m-b-30 m-t-0">Registro de proveedores</h4>
                                <div class="row">
                                    <form class="form-horizontal" method="post" enctype="application/x-www-form-urlencoded" action="javascript:void(0)" onsubmit="$.ajax({
								url:'accion.php',
								type:'POST',
								data:{
									dmn 	: <?php echo $idMenut;?>,
									codigo 	: $('#codigo').val(),
									cedula 	: $('#cedula').val(),
									nombre 	: $('#nombre').val(),
									direccion: $('#direccion').val(),
									telefono: $('#txttelefono').val(),
									correo: $('#txtcorreo').val(),
									sitio: $('#sitio').val(),
									rubro: $('#rubro').val(),
									editar: 1,
									ver 	: 2
								},
								success : function (html) {
                                <?php if($accPermisos[S]==1){?>
									$('#page-content').html(html);
									$('#codigo').val('');
									$('#cedula').val('');
									$('#nombre').val('');
									$('#direccion').val('');
									$('#txttelefono').val('');
									$('#txtcorreo').val('');
									$('#sitio').val('');
									$('#rubro').val('');
                                <?php } else {
    ?>
									$('#page-content').html(html);        
    <?php    
}?>
								},
							}); return false">
                                        <div class="form-group" style="display: block;">
                                            <label class="col-sm-2 control-label" for="cedula">NIT</label>
                                            <div class="col-sm-8">
                                                <?php 
                                                    if($accPermisos[S]==1){
                                                ?>
                                                <input class="form-control" id="cedula" type="number" value="<?php echo $cedula; ?>">
                                                <?php
                                                    } else {
                                                ?>
                                                <input class="form-control" id="cedula" type="number" value="<?php echo $_SESSION[ci]; ?>" readonly>                                                
                                                <?php
                                                    }
                                                ?>                                                
                                                <input class="form-control collapse" id="codigo" type="number" value="<?php echo $codigo; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group" style="display: block;">
                                            <label class="col-sm-2 control-label" for="nombre">Razón social</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="nombre" type="text" value="<?php echo $nombre;?>"> </div>
                                        </div>
                                        <div class="form-group" style="display: block;">
                                            <label class="col-sm-2 control-label" for="nombre">Dirección</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="direccion" type="text" value="<?php echo $direccion;?>"> </div>
                                        </div>
                                        <div class="form-group" style="display: block;">
                                            <label class="col-sm-2 control-label" for="txttelefono">Teléfonos</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="txttelefono" type="text" value="<?php echo $telefono;?>"> </div>
                                        </div>
                                        <div class="form-group" style="display: block;">
                                            <label class="col-sm-2 control-label" for="txtcorreo">Correo electrónico</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="txtcorreo" type="mail" value="<?php echo $correo;?>"> </div>
                                        </div>
                                        <div class="form-group" style="display: block;">
                                            <label class="col-sm-2 control-label" for="sitio">Sitio Web</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="sitio" type="text" value="<?php echo $sitio;?>"> </div>
                                        </div>
                                        <div class="form-group" style="display: block;">
                                            <label class="col-sm-2 control-label" for="rubro">Rubro</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="rubro" type="text" value="<?php echo $rubro;?>"> </div>
                                        </div>
                                        <div class="box-footer">
                                            <input id="enviar" type="submit" value="Guardar" class="btn btn-primary col-md-offset-5"> </div>
                                    </form>
                                </div>
                                <?php 
                                if($accPermisos[S]==1){
                                ?>                                
                                <div class="row">
                                    <table class="" id="personal">
                                        <thead>
                                            <tr>
                                                <td class="text-center"><strong>Cédula</strong></td>
                                                <td class="text-center"><strong>Nombre o razón social</strong></td>
                                                <td class="text-center"><strong>Direccion</strong></td>
                                                <td class="text-center"><strong>Teléfonos</strong></td>
                                                <td class="text-center"><strong>Correo</strong></td>
                                                <td class="text-center"><strong>Sitio Web</strong></td>
                                                <td class="text-center"><strong>Rubro</strong></td>
                                                <td class="text-center"><strong>Editar</strong></td>
                                                <td class="text-center"><strong>Validar</strong></td>
                                                <td class="text-center"><strong>Eliminar</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
								            $consulsol = paraTodos::arrayConsulta("*", "proveedor", "1=1");
								            foreach($consulsol as $row){
?>
                                            <tr>
                                                <td class="text-center">
                                                    <?php echo $row[prov_nit];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo utf8_decode($row[prov_razon]);?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[prov_direccion];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[prov_telefono];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[prov_email];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[prov_sitioweb];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[prov_rubro];?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="javascript:void(0);" onclick="$.ajax({
                                                        url:'accion.php',
                                                        type:'POST',
                                                        data:{
                                                            dmn 	: <?php echo $idMenut;?>,
                                                            codigo 	: <?php echo $row[prov_codigo];?>,
                                                            editar 	: 1,
                                                            ver 	: 2
                                                        },
                                                        success : function (html) {
                                                            $('#page-content').html(html);
                                                        },
                                                    }); return false;"><i class="fa fa-edit"></i>
									               </a>
                                                </td>
                                                <?php 
                                                                        if($row[prov_status]==0){
                                                ?>
                                                <td class="text-center">
                                                    <a href="javascript:void(0);" onclick="$.ajax({
                                                        url:'accion.php',
                                                        type:'POST',
                                                        data:{
                                                            dmn 	: <?php echo $idMenut;?>,
                                                            codigo 	: <?php echo $row[prov_codigo];?>,
                                                            validar 	: 1,
                                                            ver 	: 2
                                                        },
                                                        success : function (html) {
                                                            $('#page-content').html(html);
									                       $('#codigo').val('');                                                                                           
                                                        },
                                                    }); return false;"><i class="fa fa-gavel" style="color:red"></i>
									               </a>
                                                </td>
                                                <?php
                                                                        } else {
                                                ?>
                                                <td class="text-center">
                                                    <i class="fa fa-gavel" style="color:green;"></i>
                                                </td>
                                                <?php
                                                                        }
                                                ?>
                                                <td class="text-center">
                                                    <a href="javascript:void(0);" onclick="$.ajax({
                                                        url:'accion.php',
                                                        type:'POST',
                                                        data:{
                                                            dmn 	: <?php echo $idMenut;?>,
                                                            codigo 	: <?php echo $row[prov_codigo];?>,
                                                            eliminar : 1,
                                                            ver 	: 2
                                                        },
                                                        success : function (html) {
                                                            $('#page-content').html(html);
									                           $('#codigo').val('');                                                                                           
                                                        },
                                                    }); return false;"><i class="fa fa-eraser"></i>
									               </a>
                                                </td>
                                            </tr>
<?php
								            }
?>
                                        </tbody>
                                    </table>
                                </div>
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
    <!-- Jquery DataTable Plugin Js -->
    <script src="<?php echo $ruta_base?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?php echo $ruta_base?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo $ruta_base?>assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="<?php echo $ruta_base?>assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="<?php echo $ruta_base?>assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="<?php echo $ruta_base?>assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="<?php echo $ruta_base?>assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="<?php echo $ruta_base?>assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="<?php echo $ruta_base?>assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
    <script>
$('#personal').DataTable({
    scrollX: 300
    , scroller: true
    , dom: 'Bfrtip'
    , buttons: [{
        extend: 'excelHtml5',
        exportOptions: {
            columns: ':visible'
        }
    },
    {
        extend: 'print',
        text: 'Imprimir',
        title: '',
        exportOptions: {
            columns: ':visible'
        },
        customize: function (win) {
            $(win.document.body).css('font-size', '8pt').prepend('<div><h4 style="text-align:center">Clientes registrados</h4></div>');
            $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
        }
    },
    {
        extend: 'colvis',
        text: 'Columnas visibles'
    }]
});
    </script>

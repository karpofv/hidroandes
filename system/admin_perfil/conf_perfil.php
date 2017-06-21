<?php
    ini_set('display_errors', false);
    ini_set('display_startup_errors', false);
	$idperfil=$_POST['eliminar'];
	$dmn = $_POST['dmn'];
	$mody=$_POST['mody'];	
    /*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/	
	/*Eliminar un Perfil*/
    if (isset($_POST['eliminar'])) {
        $consulta_nombre_perfil=paraTodos::arrayConsulta("Nombre","perfiles", "CodPerfil=$idperfil");
        foreach($consulta_nombre_perfil as $resultado_nombre){
 	      $nombre_perfil=$resultado_nombre["Nombre"];
        }	
        $verifica_perfil=paratodos::arrayConsultanum("*","usuarios","Nivel='$nombre_perfil'");
        if ($verifica_perfil==0) {
            $consulta_eliminar=paratodos::arrayDelete("IdPerfil=$idperfil","perfiles_det");
            $consulta_eliminar=paratodos::arrayDelete("CodPerfil=$idperfil","perfiles");
        } else {
 	      echo "<h3 class=\"error\">El perfil no puede ser eliminado porque se encuentra en uso</h3>";
        }
    }
	/*Insertar un nuevo perfil*/
	if ($_POST['nuevoperfil']<>'') {
		//Si el texto tiene algo es porque se va a crear un nuevo perfil
		$indicemenu=$_POST['indicemenu'];	
		$nuevoperfil=$_POST['nuevoperfil'];
                //Validar si el perfil solapa a otro
		if ($nuevoperfil<>'') {		
                    $consulta_nombre_perfil=paraTodos::arrayConsultanum("Nombre","perfiles","Nombre like '%".$nuevoperfil."%'");
                    if ($consulta_nombre_perfil> 0) {
                        die ('<h3 class="error">El nombre de perfil seleccionado no puede usarse, intente con otro</h3>');
                    }
                    $consulta_nombre_perfil=null;
		}
		if ($nuevoperfil<>'') {
			$id=time();
			$insertar_perfil=paraTodos::arrayInserte("CodPerfil,Nombre","perfiles","'0','$nuevoperfil'");
		}
		
    }
?>
   <script>
</script>
    <form onsubmit="
                   $.ajax({
                   	type: 'POST',
                   	url: 'accion.php',
                    data: {
                    	ver:2,
                    	dmn:<?php echo $dmn;?>,
                    	nuevoperfil: $('#nuevoperfil').val()
                    },
                    success: function(html) {
						$('#page-content').html(html);
                    },
                    error: function(xhr,msg,excep) { alert('Error Status ' + xhr.status + ': ' + msg + '/ ' + excep); }
                    }); return false" action="javascript: void(0);" method="post" name="enviar">
        <div class="container" style="margin: 57px auto 0 auto;background: #FFFFFF;border: 1px solid #DDDDDD;width: 60%;">
            <div style="color: #A50000;width: 100%;padding: 8px 0px 8px 0px; text-align: center;height: 45px;font-weight: bold;overflow: hidden;font-size: 11pt;border: 1px solid #DDDDDD;background: #FAFAFA;;"> Administraci&oacute;n de Perfiles
            </div>
            <div style="height: auto;overflow: hidden;padding: 10px;">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Perfil</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="idperfil" name="idperfil" style=" border: 1px solid #DDDDDD;height: 32px;width: 60%;">
                            <option value="">Selecciona un perfil</option>
                            <?php  Combos::CombosSelect($permiso, $id, 'DISTINCT CodPerfil,Nombre', 'perfiles', 'CodPerfil', 'Nombre', "CodPerfil<>'' ORDER BY Nombre");   ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nombre del Nuevo Perfil</label>
                    <div class="col-sm-10">
                        <input class="gen_input" maxLength="150" size="30" name="nuevoperfil" id="nuevoperfil" type="text" title="Ingrese nuevo perfil" style=" border: 1px solid #DDDDDD;height: 32px;" onchange="" required="required"> </div>
                </div>
            </div>
            <div style="color: #A50000;width: 100%;padding: 8px 0px 8px 0px; text-align: center;height: auto;font-weight: bold;overflow: hidden;font-size: 11pt;border: 1px solid #DDDDDD;background: #FAFAFA;;">
                <button class="btn btn-primary popover-button" type="submit">Crear Perfil</button>
            </div>
        </div>
    </form>
    <div id="perfilver"></div>
    <script type="text/javascript">
        $('#idperfil').change(function () {
            var perf = $('#idperfil').val();
            if (perf != '') {
                $.ajax({
                    type: 'POST'
                    , url: 'accion.php'
                    , data: 'idperfil=' + perf + '&ver=2&act=2&dmn=<?php echo $dmn; ?>'
                    , success: function (html) {
                        $('#perfilver').html(html);
                    }
                });
            }
        });
    </script>

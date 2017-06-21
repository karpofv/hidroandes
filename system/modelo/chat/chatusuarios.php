<?php
Class ChatUsuarios {
function chatUsuariosConectados() {
    $consultasUsuariosConectados = new paraTodos();
        $filasUseConectados = $consultasUsuariosConectados->arrayConsulta("Cedula","chat_sessions","sid<>''");
        foreach($filasUseConectados as $userConectados){
		$datosEmpChat = DatosPersonales::datosEmpleado($userConectados[Cedula]);
		
              if (strlen($datosEmpChat[0][nomemp]) > 22) {
                     $empChat = substr($datosEmpChat[0][nomemp],0,22).'... ';
              } else {
                     $empChat = $datosEmpChat[0][nomemp];
              } 
		$ruta = "http://www.unellez.edu.ve/portal/servicios/siproma/sistema/fotos/".$userConectados[Cedula].".jpg";
    		$urlexists = paraTodos::url_exists($ruta );
    		if ($urlexists == 'true') {
        		$FOTO = "http://www.unellez.edu.ve/portal/servicios/siproma/sistema/fotos/".$userConectados[Cedula].".jpg";
    		} else {
     			$FOTO="../assets-minified/images/icono_perfil.png";
    		}
		?>
            <li>
                <i class="files-icon glyph-icon font-red" style="margin-right: 6px;">
                    <img src="<?php echo $FOTO; ?>" border="0" name="Image_Encab" style="width: 30px;">
                </i>
                <a href="javascript:void(0)" onclick="javascript:chatWith('Nombre')">
                <div class="files-content">
                    <b><?php echo $empChat; ?></b>
                    <div class="files-date">
                        <i class="glyph-icon icon-clock-o"></i>
                        Conectado on <b>22.10.2014</b>
                    </div>
                </div></a>
                <div class="files-buttons">
                    
                </div>
            </li>
	     <li class="divider"></li>
            <?php            
        }
}
}
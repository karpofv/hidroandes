<div style="width: 100%;height: 1500px;overflow: hidden;">
<div style="width: 1050px;height: auto;margin: 2% auto auto auto;padding: 7px;border: 1px solid  #DDDDDD;overflow: hidden;background: #FFFFFF;box-shadow: 0px 0px 12px #C6C6C6;-webkit-box-shadow: 0px 0px 12px #C6C6C6;-moz-box-shadow: 0px 0px 12px #C6C6C6;">
<?php
if ($permiso_accion['S']==1) {
    
 ?>
    <div style="width: 99%;height: auto;border: 1px solid #CCCCCC;background: #FFFFFF;margin: 0px auto 0px auto;padding: 5px;overflow: hidden;">
        <a id="cerrarVentana" title="Cerrar la ventana"><div style="font-weight: 800;cursor: pointer;position: absolute;margin: 4px 7px 6px 970px;color: #222222;background: red;color: #FFFFFF;padding: 2px 7px 2px 7px;-moz-border-radius: 50px 50px 50px 50px;-webkit-border-radius: 50px 50px 50px 50px;border-radius: 50px 50px 50px 50px;">X</div></a>
        <div style="color: #A50000;width: 100%;padding: 8px 0px 8px 0px; text-align: center;height: auto;font-weight: bold;overflow: hidden;font-size: 11pt;border: 1px solid #DDDDDD;background: #FAFAFA;;">
            ASIGNAR PERMISO
        </div>
        <div id="Estadoc" style="margin: 7px;float: left;height: auto;width: 200px;overflow: hidden;">
            <select style='font-family: Arial; height: 33px;width: 200px;padding: 7px;border: 1px solid #DDDDDD;' id="Estado" name="Estado" required="required">
              <option value="">Seleccione el Estado</option><?php Combos::CombosEstadoPermiso($permiso,'',"idCiudad=1 order by Estado "); ?>
            </select>
        </div>
        <div id="Municipioc" style="margin: 7px;float: left;height: auto;width: 200px;overflow: hidden;">
            <select style='font-family: Arial; height: 33px;width: 200px;padding: 7px;border: 1px solid #DDDDDD;' id="Municipio" name="Municipio" required="required">
              <option value="">Seleccione el Municipio</option><?php Combos::CombosMunicipioPermiso($permiso,$idMunicipio,$idEstado); ?>
            </select>
        </div>
        <div id="Parroquiac" style="margin: 7px;float: left;height: auto;width: 260px;overflow: hidden;">
            <select style='font-family: Arial; height: 33px;width: 240px;padding: 7px;border: 1px solid #DDDDDD;' id="Parroquia" name="Parroquia" required="required">
              <option value="">Seleccione la Parroquia</option><?php Combos::CombosParroquiaPermiso($permiso,$idParroquia,$idMunicipio); ?>
            </select>
        </div>
        <?php
        if ($permiso_accion['I']==1) { ?>
        <a onclick="$.ajax({ type: 'POST', url: 'controller.php',
            data: 'idsubmenu=<?php echo $idsubmenu; ?>&CedulaPerm=<?php echo $_POST[CedulaPerm]; ?>&bb=1&M=3'+'&Estado='+$('#Estado').val()+'&Municipio='+$('#Municipio').val()+'&Parroquia='+$('#Parroquia').val(),
            success: function(html) { $('#AsignarPermiso').html(html); },
            error: function(xhr,msg,excep) { alert('Error Status ' + xhr.status + ': ' + msg + '/ ' + excep); }
            }); return false;" href="javascript: void(0);">
            <div><button title="Buscar" class="btn btn-primary popover-button" style="float: left;margin: 7px 0 0 5px;padding: 0px 5px 0px 5px;" name="Buscar" value="Buscar">Asignar</button></div>
        </a>
        <?php } ?>
    <div  style="color: #A50000;width: 100%;padding: 8px 0px 8px 0px; text-align: center;height: 30px;font-weight: bold;overflow: hidden;font-size: 11pt;border: 1px solid #DDDDDD;background: #FAFAFA;;">

    </div>
    </div>
     <div id="AsignarPermiso" style="width: 100%;height: auto;overflow: hidden;">
         <?php
         $campos="Nombres,Apellidos";
        $tablas="registrados";
        $consultas="Cedula=$_POST[CedulaPerm]";
        $res_ =paraTodos::arrayConsulta($campos,$tablas,$consultas);
        foreach ($res_ as $row ) {
            $Datos=$row[Nombres].', '.$row[Apellidos];
        }
        ?>
        <div style="width: 98%;margin: 20px auto 0px auto;height: auto;">
            <div style="color: #A50000;width: 100%;padding: 8px 0px 8px 0px; text-align: center;height: auto;font-weight: bold;overflow: hidden;font-size: 11pt;border: 1px solid #DDDDDD;background: #FAFAFA;;">
            PERMISOS ASIGNADOS A <?php echo $Datos; ?>
            </div>
                <div style="border: 1px solid #CCCCCC;background: #FFFFFF;padding: 6px;overflow: hidden;width: 30%;height: auto;font-weight: 700;margin: 6px 10px 6px 10px;float: left;">
                    <div style="color: #A50000;width: 100%;padding: 8px 0px 8px 0px; text-align: center;height: auto;font-weight: bold;overflow: hidden;font-size: 11pt;border: 1px solid #DDDDDD;background: #FAFAFA;;">
                    PERMISOS EN ESTADOS
                    </div>
                    <?php
                    $campos="c_estados.Estado";
                    $tablas="usuarios_perm_estad,c_estados";
                    $consultas="usuarios_perm_estad.CedulaEmp=$_POST[CedulaPerm] AND c_estados.id=usuarios_perm_estad.Estado";
                    $res_ =paraTodos::arrayConsulta($campos,$tablas,$consultas);
                    foreach ($res_ as $row ) {
                        ?><div style="padding: 6px;border: 1px solid #DDDDDD;"><?php echo $row[Estado]; ?></div><?php
                    }
                    ?>
                </div>
                <div style="border: 1px solid #CCCCCC;background: #FFFFFF;padding: 6px;overflow: hidden;width: 30%;height: auto;font-weight: 700;margin: 6px 10px 6px 10px;float: left;">
                    <div style="color: #A50000;width: 100%;padding: 8px 0px 8px 0px; text-align: center;height: auto;font-weight: bold;overflow: hidden;font-size: 11pt;border: 1px solid #DDDDDD;background: #FAFAFA;;">
                    PERMISOS EN MUNICIPIOS
                    </div>
                    <?php
                    $campos="c_municipios.Municipio";
                    $tablas="usuarios_perm_munic,c_municipios";
                    $consultas="usuarios_perm_munic.CedulaEmp=$_POST[CedulaPerm] AND c_municipios.id=usuarios_perm_munic.Municipio";
                    $res_ =paraTodos::arrayConsulta($campos,$tablas,$consultas);
                    foreach ($res_ as $row ) {
                        ?><div style="padding: 6px;border: 1px solid #DDDDDD;"><?php echo $row[Municipio]; ?></div><?php
                    }
                    ?>
                </div>
                <div style="border: 1px solid #CCCCCC;background: #FFFFFF;padding: 6px;overflow: hidden;width: 30%;height: auto;font-weight: 700;margin: 6px 10px 6px 10px;float: left;">
                    <div style="color: #A50000;width: 100%;padding: 8px 0px 8px 0px; text-align: center;height: auto;font-weight: bold;overflow: hidden;font-size: 11pt;border: 1px solid #DDDDDD;background: #FAFAFA;;">
                    PERMISOS EN PARROQUIAS
                    </div>
                    <?php
                    $campos="c_parroquia.Parroquia";
                    $tablas="usuarios_perm_parroq,c_parroquia";
                    $consultas="usuarios_perm_parroq.CedulaEmp=$_POST[CedulaPerm] AND c_parroquia.id=usuarios_perm_parroq.Parroquia";
                    $res_ =paraTodos::arrayConsulta($campos,$tablas,$consultas);
                    foreach ($res_ as $row ) {
                        ?><div style="padding: 6px;border: 1px solid #DDDDDD;"><?php echo $row[Parroquia]; ?></div><?php
                    }
                    ?>
                </div>
        </div>

     </div>
    <script type="text/javascript">
        $('#Ciudad').change(function() {
          var perf = $('#Ciudad').val();
          if (perf != ''){
            $.ajax({
              type: 'POST',
              url:  'controller.php',
              data: 'ciudad='+perf+'&lf=2&idsubmenu=<?php echo $idsubmenu; ?>&idsubmenur=2&PQuien=2&PQ=99',
              success: function(html) { $('#Estadoc').html(html);}
            });
          }
        });
    </script>
    <script type="text/javascript">
        $('#Estado').change(function() {
          var perf = $('#Estado').val();
          if (perf != ''){
            $.ajax({
              type: 'POST',
              url:  'controller.php',
              data: 'estado='+perf+'&lf=2&idsubmenu=<?php echo $idsubmenu; ?>&CedulaPerm=<?php echo $_POST[CedulaPerm]; ?>&idsubmenur=2&PQuien=17&PQ=99',
              success: function(html) { $('#Municipioc').html(html);}
            });
          }
        });
    </script>
    <script type="text/javascript">
    $("#cerrarVentana").click(function(){
        $('[id^=verMas]').html('');
    });
    </script>

<?php } ?>
</div>
</div>

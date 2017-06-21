<?php
class MensajesCorreo
{
    public function bandejaMensajes($cedula, $cuantos)
    {
        ?>
        <div class="content-box">
            <!--<div class="mail-header clearfix">
            <div class="float-right col-md-4 pad0A">
            <div class="input-group">
            <input type="text" class="form-control">
            <div class="input-group-btn">
            <button type="button" class="btn btn-default" tabindex="-1">
            <i class="glyph-icon icon-search"></i>
        </button>
    </div>
</div>
</div>
</div> -->
<div class="mail-toolbar clearfix">
    <div class="float-left">
        <a title="Recargar" onclick="$.ajax({ type: 'POST', url: 'recargar.php', ajaxSend: $('#Bandeja').html(cargando),
        data: 'act=1&dmnd=3&MM=26',
        success: function(html) { $('#Bandeja').html(html); $('#thebutton').click(); }
    });  return false;" href="javascript: void(0);" title="" class="btn btn-default mrg5R">
    <i class="glyph-icon font-size-11 icon-refresh"></i>
</a>
<!--<div class="dropdown">
<a href="#" title="" class="btn btn-default" data-toggle="dropdown">
<i class="glyph-icon icon-cog"></i>
<i class="glyph-icon icon-chevron-down"></i>
</a>
<ul class="dropdown-menu float-right">

<li>
<a href="#" title="">
<i class="glyph-icon icon-edit mrg5R"></i>
Edit
</a>
</li>
<li>
<a href="#" title="">
<i class="glyph-icon icon-calendar mrg5R"></i>
Schedule
</a>
</li>
<li>
<a href="#" title="">
<i class="glyph-icon icon-download mrg5R"></i>
Download
</a>
</li>
<li class="divider"></li>
<li>
<a href="#" class="font-red" title="">
<i class="glyph-icon icon-remove mrg5R"></i>
Delete
</a>
</li>
</ul>
</div> -->
</div>

<div class="float-right">
    <div class="btn-toolbar">
        <div class="btn-group">
            <div class="size-md mrg10R">
                1 to 15 of <?php echo $cuantos; ?> entradas
            </div>
        </div>
        <div class="btn-group">
            <a href="#" class="btn btn-default">
                <i class="glyph-icon icon-angle-left"></i>
            </a>
            <a href="#" class="btn btn-default">
                <i class="glyph-icon icon-angle-right"></i>
            </a>
        </div>
        <div class="btn-group mrg15L">
            <a href="#" class="btn btn-primary">
                <i class="glyph-icon icon-list opacity-80"></i>
                <i class="glyph-icon icon-caret-down"></i>
            </a>
        </div>
    </div>
</div>
<div class="float-right" style="width: 30%;margin-right: 15%;">
    <input style="width: 85%;float: left;" type="email" class="form-control" id="inputEmail1" placeholder="Buscar correo...">
    <div style="float: right;" class="btn btn-default">
        <i class="glyph-icon font-size-13 icon-search"></i>
    </div>
</div>
</div>
<table class="table table-hover text-center">
    <tbody>
        <?php
        if ($_POST[HH] == 1) {
            $campos = '*';
            $tablas = 'correos';
            $consultas = "Conex='$cedula' Limit 0,15";
        }
        if ($_POST[HH] == 2) {
            $campos = '*';
            $tablas = 'correos';
            $consultas = "Conex='$cedula' AND Status=0 Limit 0,15";
        }
        if ($_POST[HH] == 3) {
            $campos = '*';
            $tablas = 'correos';
            $consultas = "Conex='$cedula' AND (Status=1 Or Status=0) AND Estado=0 Limit 0,15";
        }
        if ($_POST[HH] == 4) {
            $campos = '*';
            $tablas = 'correos';
            $consultas = "Conex='$cedula' AND Estado=1 Limit 0,15";
        }
        if ($_POST[HH] == 5) {
            $campos = '*';
            $tablas = 'correos';
            $consultas = "Conex='$cedula' AND Destacado=1 Limit 0,15";
        }
        if ($_POST[HH] == 6) {
            $campos = '*';
            $tablas = 'correos';
            $consultas = "Conex='$cedula' AND Remitente='$_POST[quienenv]' Limit 0,15";
        }
        if ($_POST[HH] == '') {
            $campos = '*';
            $tablas = 'correos';
            $consultas = "Conex='$cedula' Limit 0,15";
        }
        $res_ = paraTodos::arrayConsulta($campos, $tablas, $consultas);
        foreach ($res_ as $rowp) {
            $conex = $rowp['id'];
            $Asunto = $rowp['Asunto'];
            $Datosquien = 'Hever Escolcha';
            $resaltar = '';
            $marca = '';
            if ($Asunto == '') {
                $Asunto = 'Sin asunto';
            }
            if ($rowp[Status] == 0) {
                $resaltar = 'font-weight: 800;';
                $marca = "<span class='bs-label bg-orange tooltip-button'  title='mensaje nuevo'>New</span>";
            }
            $lcolor = paraTodos::randomColor();
            $quienes = substr("$Datosquien", 0, 1); ?>
            <tr>
                <td>
                    <input type="checkbox" id="example-mail-<?php echo $I++; ?>" class="custom-checkbox">
                </td>
                <td>
                    <div style="-moz-border-radius: 120px 120px 120px 120px;-webkit-border-radius: 120px 120px 120px 120px;border-radius: 120px 120px 120px 120px;font-size: 1.300em;color: #FFFFFF;font-weight: 700; padding: 9px 12px 9px 12px; float: left;background: <?php echo $lcolor; ?>;">
                        <?php echo $quienes; ?>
                    </div>
                    <?php if ($rowp[Destacado] == '0') {
                ?>
                        <a title="Destacar" onclick="$.ajax({ type: 'POST', url: 'recargar.php', ajaxSend: $('#mdestacar<?php echo $I; ?>').html(cargando),
                            data: 'act=1&dmnd=3&MM=25&quienM=<?php echo $conex; ?>&QQ=1',
                            success: function(html) { $('#mdestacar<?php echo $I; ?>').html(html); $('#thebutton').click(); }
                        });  return false;" href="javascript: void(0);">
                        <div style="margin-top: 12px;" id="mdestacar<?php echo $I; ?>"><i class="glyph-icon icon-star-o"></i></div> </a>
                        <?php
            }
            if ($rowp[Destacado] == '1') {
                ?>
                            <a title="Sin Destacar" onclick="$.ajax({ type: 'POST', url: 'recargar.php', ajaxSend: $('#mdestacar<?php echo $I; ?>').html(cargando),
                                data: 'act=1&dmnd=3&MM=25&quienM=<?php echo $conex; ?>&QQ=0',
                                success: function(html) { $('#mdestacar<?php echo $I; ?>').html(html); $('#thebutton').click(); }
                            });  return false;" href="javascript: void(0);">
                            <div style="margin-top: 12px;" id="mdestacar<?php echo $I; ?>"><i style="color: #D7DF01;" class="glyph-icon icon-star"></i></div> </a>
                            <?php
            } ?>
                        </td>
                        <td class="email-title" style="<?php echo $resaltar; ?>">
                            <a title="Leer" onclick="$.ajax({ type: 'POST', url: 'recargar.php', ajaxSend: $('#Bandeja').html(cargando),
                            data: 'act=1&dmnd=3&MM=28&quienM=<?php echo $conex; ?>',
                            success: function(html) { $('#Bandeja').html(html); $('#thebutton').click(); }
                        });  return false;" href="javascript: void(0);">
                        <?php echo "$Datosquien $marca"; ?>
                    </a>
                </td>
                <td class="email-body" style="<?php echo $resaltar; ?>">
                    <?php
                    if (strlen($Asunto) > 150) {
                        echo $Asuntod = substr($Asunto, 0, 150).'... ';
                    } else {
                        echo $Asunto;
                    } ?>
                </td>
                <td> <!--<i class="glyph-icon icon-paperclip"></i>--> </td>
                <td> <?php echo date('d-m-Y', strtotime($rowp[Fecha])); ?> </td>
            </tr>
            <?php

        } ?>
    </tbody>
</table>

</div>
<?php

    }
    public function ResponderMensajes($cedula_est, $cuantos)
    {
        ?>
    <div class="content-box">
        <div class="mail-header clearfix" style="background: #FAFAFA;border: 1px solid #DDDDDD;">
            <div class="float-left">
                <span class="mail-title">Enviar Mensajes</span>
            </div>

        </div>
        <form class="form-horizontal mrg15T row" role="form">
            <div class="form-group">
                <label for="inputEmail1" class="col-sm-2 control-label">Para:</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="inputEmail1" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail2" class="col-sm-2 control-label">Asunto:</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="inputEmail2" placeholder="">
                </div>
            </div>
        </form>

        <div class="pad15A">
            <div class="wysiwyg-editor"></div>
        </div>
        <link rel="stylesheet" type="text/css" href="assets-minified/widgets/summernote-wysiwyg/summernote-wysiwyg.css">
        <script type="text/javascript" src="assets-minified/widgets/summernote-wysiwyg/summernote-wysiwyg.js"></script>
        <script type="text/javascript">
        /* WYSIWYG editor */

        $(function() {
            $('.wysiwyg-editor').summernote({
                height: 350
            });
        });
        $(function() {
            $('.wysiwyg-editor-air').summernote({
                airMode: true
            });
        });
        </script>

        <div class="button-pane">
            <button class="btn btn-info">Enviar Mensaje</button>
        </div>

    </div>
    <?php

    }
    public function LeerMensajes($cedula, $cuantos)
    {
        $campos = '*';
        $tablas = 'correos';
        $consultas = "Conex='$cedula' AND id=$_POST[quienM]";
        $res_ = paraTodos::arrayConsulta($campos, $tablas, $consultas);
        foreach ($res_ as $rowp) {
            $conex = $rowp['id'];
            $Asunto = $rowp['Asunto'];

            $campo = "Status='1'";
            $tabla = 'correos';
            $consultas = "Conex='$cedula' AND id='$_POST[quienM]'";
            $Mody = paraTodos::arrayUpdate($campo, $tabla, $consultas);
            if ($Mody == 'True') {
                $ejecucion = 1;
            }
            $Datosquien = 'Hever Escolcha';
            $resaltar = '';
            $marca = '';
            if ($Asunto == '') {
                $Asunto = 'Sin asunto';
            }
            if ($rowp[Status] == 0) {
                $resaltar = 'font-weight: 800;';
                $marca = "<span class='bs-label bg-orange tooltip-button'  title='mensaje nuevo'>New</span>";
            } ?>
        <div class="content-box">
            <div class="pad15A clearfix mrg10B">
                <div class="float-left">
                    <b><?php echo $Datosquien; ?></b>
                </div>
                <div class="float-right opacity-80">
                    <i class="glyph-icon icon-clock-o mrg5R"></i>
                    <?php echo date('d-m-Y', strtotime($rowp[Fecha])); ?>
                </div>
            </div>
            <div class="mail-toolbar clearfix">
                <div class="float-left">
                    <h4><?php echo $Asunto; ?></h4>
                </div>
                <div class="float-right">
                    <a href="#" class="btn btn-primary" title="Reply">
                        Reply
                        <i class="glyph-icon icon-mail-reply"></i>
                    </a>
                    <a href="#" class="btn btn-default" title="Print">
                        <i class="glyph-icon icon-print"></i>
                    </a>
                    <a href="#" class="btn btn-danger mrg10L" title="Delete">
                        <i class="glyph-icon icon-trash-o"></i>
                    </a>
                </div>
            </div>
            <div class="divider"></div>
            <div class="pad15A">
                <p><?php echo $rowp[Mensaje]; ?></p>
            </div>
            <div class="button-pane">
                <a href="#" class="btn btn-blue-alt" title="Reply">
                    <i class="glyph-icon icon-mail-reply"></i>
                    Reply
                </a>
                <a href="#" class="btn btn-default" title="Reply">
                    Forward
                    <i class="glyph-icon icon-mail-forward"></i>
                </a>
            </div>
        </div>
        <?php

        }
    }
}

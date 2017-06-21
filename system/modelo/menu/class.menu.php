<?php
class Menu
{
    public function menuEmpUsuario($quien, $cedula, $pendiente='')
    {
        $conexion = new Conexion;
        $conectar = $conexion->obtenerConexionMy();

        $sql = "SELECT id FROM correos WHERE Conex='$cedula' AND Status='0'";
        $preparar = $conectar->prepare($sql);
        $preparar->execute();
        $preparar->fetchAll();
        $NroRegistros=0;
        $NroRegistros = Count($preparar); ?>
        <li class="divider"></li>
        <!--<li class="treeview"><a href="accion.php?dmn=112" title="Mi Perfil"><i class="glyph-icon icon-user"></i> <span>Mi Perfil </span></a></li> -->
        <li class="treeview"><a  onclick="$.ajax({ type: 'POST', url: 'accion.php', ajaxSend: $('#page-content').html(cargando),
                      data: 'dmn=356',
                      success: function(html) { $('#nova').show('');$('#page-content').html(html); }
                    });  return false;" href="javascript: void(0);" title="Solicitudes"><i class="glyph-icon icon-paste"></i> <span>Documentos</span>
            </a>
        </li>
        <li class="treeview"><a onclick="$.ajax({ type: 'POST', url: 'accion.php', ajaxSend: $('#page-content').html(cargando),
                            data: 'dmn=121',
                            success: function(html) { $('#nova').show('');$('#page-content').html(html); },
                            error: function(xhr,msg,excep) { alert('Error Status ' + xhr.status + ': ' + msg + '/ ' + excep); }
                            }); return false;" href="javascript: void(0);" title="Mensajes">
                <i class="glyph-icon icon-envelope-o"></i> <span>Mensajes</span></a>
                <?php if ($NroRegistros > 0) {
            ?>
                    <div style="font-weight: 600;cursor: pointer;float: right;margin: -37px 0px 6px 15px;color: #FFFFFF;background: #FF0000;padding: 1px 5px 1px 5px;-moz-border-radius: 50px 50px 50px 50px;-webkit-border-radius: 50px 50px 50px 50px;border-radius: 50px 50px 50px 50px;">
                        <?php echo $NroRegistros; ?>
                    </div>
                <?php

        } ?>
        </li>
        <li class="treeview"><a href="#" title="Reclamos"><i class="glyph-icon icon-edit"></i> <span>Reclamos</span></a></li>

        <li class="treeview"><a href="../../index.php?logaut=1"><i class="glyph-icon icon-clock-os"></i><span>Cerrar Sesion</span></a></li>
        <?php

    }
    public function menuEmpMenj($quien, $nivel)
    {
        $consultasMenu = new paraTodos();
        $filasMenu = $consultasMenu->arrayConsulta("DISTINCT  m_menu_emp_menj.ConexMenuMaster,m_menu_emp_menj.conex,m_menu_emp_menj.menu,m_menu_emp_menj.id, Imagen", "m_menu_emp_menj,perfiles_det", "m_menu_emp_menj.id=perfiles_det.Menu AND perfiles_det.IdPerfil=$nivel AND perfiles_det.S=1 Order By m_menu_emp_menj.menu");
        foreach ($filasMenu as $filasMenud) {
            $ii++;
            if (strlen($filasMenud['menu']) > 14) {
                $empresaMenu = substr($filasMenud['menu'], 0, 14).'... ';
            } else {
                $empresaMenu = $filasMenud['menu'];
            }
            if ($ccm!=$filasMenud[ConexMenuMaster]) {
                $ccm=$filasMenud[ConexMenuMaster];
                $filasMenuM = $consultasMenu->arrayConsulta("nombre_menu", "menu_master", "id=$filasMenud[ConexMenuMaster]");
                foreach ($filasMenuM as $filasMenudM) {
                    ?><li class="divider"></li>
                <li class="treeview"><a><i class="glyph-icon icon-laptop"></i><span style="color: #FFFFFF;"><?php echo utf8_decode($filasMenudM[nombre_menu]); ?></span></a></li>
                <li class="divider"></li>
                <?php

                }
            } ?>
            <li>
                <a href="#" title="<?php echo ['menu']; ?>">
                    <i class="<?php echo $filasMenud['Imagen']; ?>"></i> 
                    <span><?php echo $empresaMenu; ?></span>
                </a>
                <ul class="nav nav-second-level">
                    <?php
                    $filasSubMenu = $consultasMenu->arrayConsulta("DISTINCT m_menu_emp_sub_menj.Url_1,m_menu_emp_sub_menj.menu,m_menu_emp_sub_menj.id", "m_menu_emp_sub_menj,perfiles_det", "m_menu_emp_sub_menj.id=perfiles_det.Submenu AND perfiles_det.Menu=$filasMenud[id] AND perfiles_det.IdPerfil=$nivel AND perfiles_det.S=1 Order By m_menu_emp_sub_menj.orden,m_menu_emp_sub_menj.menu");
            foreach ($filasSubMenu as $filasSubMenud) {
                if (strlen($filasSubMenud['menu']) > 35) {
                    $empresaSMenu = substr($filasSubMenud['menu'], 0, 35).'... ';
                } else {
                    $empresaSMenu = $filasSubMenud['menu'];
                } ?>
                            <li><a title="Pulse para ejecutar (<?php echo utf8_decode($filasSubMenud['menu']); ?>)"
                            onclick="$.ajax({
                                        type: 'POST',
                                        url: 'accion.php',
                                        ajaxSend: $('#page-content').html(cargando),
                                        data: 'dmn=<?php echo $filasSubMenud[id]; ?>&ver=2',
                                        success: function(html) {
                                            $('#page-content').html(html);
                                        },
                                        error: function(xhr,msg,excep) {
                                            alert('Error Status ' + xhr.status + ': ' + msg + '/ ' + excep);
                                        }
                                    }); return false;" href="javascript: void(0);">
                                <span><?php echo $empresaSMenu; ?></span>
                            </a></li>
                            <?php

            } ?>
                </ul>
            </li>
            <?php

        }
        ////////////////////////////////////////////////////////////////////
    }
}

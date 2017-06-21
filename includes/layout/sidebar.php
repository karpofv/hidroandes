<?php
    $consultausuario = paraTodos::arrayConsulta("*", "usuarios", "Cedula=$_SESSION[ci]");
    foreach($consultausuario as $usuario){
        $nombre = $usuario[Apellidos]." ".$usuario[Nombres];
        $nivel = $usuario[Nivel];
    }
    if($nivel==1){
        $nivelmos="Administrador";
    }
    if($nivel==3){
        $nivelmos="Operador";
    }
?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span>
                        <img alt="image" class="img-circle" src="<?php echo $ruta_base;?>assets/images/logo.jpg" width="50%" />
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs"> 
                                <strong class="font-bold"><?php echo $nombre?></strong>
                             </span>
                            <span class="text-muted text-xs block"><?php echo $nivelmos;?> <b class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li class="divider"></li>
                        <li><a href="accion.php"> Salir</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <?php menu::menuEmpMenj($quien,$nivel); ?>
        </ul>
    </div>
</nav>

<?php
    $opcion = $_POST[actd];
if($opcion==1){
    $consulsubprograma = paraTodos::arrayConsulta("*", "subprograma", "subp_procodigo=$_POST[codigo]");
    foreach($consulsubprograma as $subprograma){
        echo "<option value='$subprograma[subp_codigo]'>$subprograma[subp_descripcion]</option>";
    }
}
?>
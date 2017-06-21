<?php
if ($_POST['clavev']<>"" and $_POST['dd']=="dd"){
    $clavev=md5($_POST['clavev']);
    $claven=md5($_POST['claven']);
    $claven2=md5($_POST['claven2']);
    $conf="Usuario";
    
    $ttCla="";
	if($cedula_est==$_POST['claven']){ $ttCla="La clave no puede ser la cedula"; }
	if($_POST['claven']=='123456' Or $_POST['claven']=='123' Or $_POST['claven']=='12345' Or $_POST['claven']=='1'){ $ttCla="El tipo de clave que estas usando no es segura"; }
	if($permiso==$_POST['claven']){ $ttCla="La clave no puede ser el Usuario"; }
	if(strlen($_POST['claven']) < 6){ $ttCla="La clave no puede tener menos de 6 caracteres"; }
	$valida_clave=mysql_query("SELECT COUNT(contrasena) from confirmar where contrasena like '$clavev' and usuario ='$permiso'");
    $clave_valida=mysql_fetch_array($valida_clave);
    if($clave_valida['0']!=1){ $ttCla="La clave Actual no es correcta"; }
    if($claven2!=$claven){ $ttCla="no repiti&oacute; la clave Nueva correctamente"; }
    if($ttCla==""){
    $modificar147 = "UPDATE confirmar SET contrasena='$claven' WHERE $conf='$permiso' AND Tipo='Estudiante'";
    $resultado= mysql_query($modificar147);
    ?>
    <div class='message'> La contrase&ntilde;a fue actualizada correctamente.</div>

    <?php

    }else{
    ?>
    <div class='error'> <?php echo $ttCla; ?></div>
    <?php
    }
}
?>
<form onsubmit="$.ajax({ type: 'POST', url: 'accion.php',
data: 'act=1&dd=dd&dmn=357&claven='+$('#claven')
.val()+'&clavev='+$('#clavev').val()+'&apellido='+$('#apellido')
.val()+'&claven2='+$('#claven2').val(),
success: function(html) {   $('#contenido').html(html); }
}); return false" action="javascript: void(0);" method="post">
<div style="height: auto;width: 600px;margin:auto;">
<div style="height: auto;width: 600px;margin:6px;background: #FFFFFF;border: 1px solid #EEEEEE;">
<table style="width: 600px;" cellpadding="1" cellspacing="0">
<tr>
    <th colSpan="2" style="padding: 10px 0 10px 0;background: url('<?php echo "images/barra1.png"; ?>') left repeat-x;color: #FFFFFF;border: 1px solid #EEEEEE;">Cambio de Clave</th>
</tr>
<tr class="row0">
<td style="padding: 6px 0 6px 5px;" width="30%"><b>Ingrese Clave Actual:</b></td>
<td style="padding: 6px 0 6px 5px;" >
<input maxLength="15" size="15" type="password" style="border: 1px solid #DDDDDD;" name="clavev" id="clavev"></td>
</tr>
<tr class="row1">
<td style="padding: 6px 0 6px 5px;"><b>Ingrese Clave Nueva:</b></td>
<td style="padding: 6px 0 6px 5px;" >
<input maxLength="15" size="15" type="password" style="border: 1px solid #DDDDDD;" name="claven" id="claven"></td>
</tr>
<tr class="row0">
<td style="padding: 6px 0 6px 5px;"><b>Repita la Clave Nueva: </b> </font></td>
<td style="padding: 6px 0 6px 5px;" >
<input maxLength="15" size="15" type="password" style="border: 1px solid #DDDDDD;" name="claven2" id="claven2"></td>
</tr>
<tr>
<th colspan="2" align="center"  style="padding: 6px 0 6px 0;background: #EEEEEE;border: 1px solid #DDDDDD;">
    <input style="border: 1px solid #cccccc;cursor: pointer; background: url('<?php echo "images/barra1.png"; ?>') left repeat-x;color: #FFFFFF;padding-left: 10px;padding-right: 10px;font-weight: bold" type="submit" value="Enviar">
</th>
</tr>
</table>
</div></div>
</form>

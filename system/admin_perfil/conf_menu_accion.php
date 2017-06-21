<?php
	$dmn = $_POST['dmn'];
if ($_POST[permiso]!='') {
    if ($_POST[idsubmenupp]!='') {
        if ($_POST[accC]!='') {
			$acc=$_POST[accC];
			$campo='S';
			$iddiv='consultartd';
			$accb='accC';
			if($_POST[accC]==0) {
				$accbb=1;
			}else{
				$accbb=0;
			}
		}
        if ($_POST[accI]!='') {
			$acc=$_POST[accI];
			$campo='I';
			$iddiv='insertartd';
			$accb='accI';
			if($_POST[accI]==0) {
				$accbb=1;
			}else{
				$accbb=0;
			}
		}
        if ($_POST[accM]!='') {
			$acc=$_POST[accM];
			$campo='U';
			$iddiv='modificartd';
			$accb='accM';
			if($_POST[accM]==0) {
				$accbb=1;
			}else{
				$accbb=0;
			}
		}
        if ($_POST[accE]!='') {
			$acc=$_POST[accE];
			$campo='D';
			$iddiv='eliminartd';
			$accb='accE';
			if($_POST[accE]==0) {
				$accbb=1;
			}else{
				$accbb=0;
			}
		}
        if ($_POST[accImp]!='') {
			$acc=$_POST[accImp];
			$campo='P';
			$iddiv='imprimirtd';
			$accb='accImp';
			if($_POST[accImp]==0) {
				$accbb=1;
			}else{
				$accbb=0;
			}
		}
        if ($acc==1) {
			$imgper="<i style='color: #36be00;' class='glyphicon glyphicon-check'></i>";
		}else{
			$imgper="<i style='color: #FF0000;' class='glyphicon glyphicon-remove'></i>";
		}

        $consulta_insertamenu=paraTodos::arrayInserte("SubMenu,Menu,idPerfil","perfiles_det","'$_POST[submenu]','$_POST[menus]','$_POST[idperfil]'");
        $actualiza_submenu=paraTodos::arrayUpdate("$campo=$acc","perfiles_det","idPerfil='$_POST[idperfil]' and Menu='$_POST[menus]' and SubMenu='$_POST[submenu]'");
?>
	<a onclick="$.ajax({
        	type: 'POST',
        	url: 'accion.php',
        	data: {
        		act:3,
        		ver:2,
        		dmn:<?php echo $dmn; ?>,
        		idsubmenupp:<?php echo $_POST[idsubmenupp]; ?>,
        		<?php echo $accb; ?>:<?php echo $accbb; ?>,
        		permiso:1
        	},
        	success: function(html) {
        		$('#<?php echo $iddiv.$_POST[idsubmenupp]; ?>').html(html);
        		$('#thebutton').click();
        	},
        	error: function(xhr,msg,excep) {
        		alert('Error Status ' + xhr.status + ': ' + msg + '/ ' + excep);
        	}
        });  return false;" href="javascript: void(0);">
		<?php echo $imgper; ?>
	</a>
<?php
    }else{

        if ($_POST[accC]!='') {
			$acc=$_POST[accC];
			$campo='S';
			$iddiv='consultartd';
			$accb='accC';
			if($_POST[accC]==0) {
				$accbb=1;
			}else{
				$accbb=0;
			}
		}
        if ($_POST[accI]!='') {
			$acc=$_POST[accI];
			$campo='I';
			$iddiv='insertartd';
			$accb='accI';
			if($_POST[accI]==0) {
				$accbb=1;
			}else{
				$accbb=0;
			}
		}
        if ($_POST[accM]!='') {
			$acc=$_POST[accM];
			$campo='U';
			$iddiv='modificartd';
			$accb='accM';
			if($_POST[accM]==0) {
				$accbb=1;
			}else{
				$accbb=0;
			}
		}
        if ($_POST[accE]!='') {
			$acc=$_POST[accE];
			$campo='D';
			$iddiv='elimiinartd';
			$accb='accE';
			if($_POST[accE]==0) {
				$accbb=1;
			}else{
				$accbb=0;
			}
		}
        if ($_POST[accImp]!='') {
			$acc=$_POST[accImp];
			$campo='P';
			$iddiv='imprimirtd';
			$accb='accImp';
			if($_POST[accImp]==0) {
				$accbb=1;
			}else{
				$accbb=0;
			}
		}
        if ($acc==1) {
			$imgper="<i style='color: #36be00;' class='glyphicon glyphicon-check'></i>";
		}else{
			$imgper="<i style='color: #FF0000;' class='glyphicon glyphicon-remove'></i>";
		}
        $consulta_insertamenu=paraTodos::arrayInserte("SubMenu,Menu,idPerfil","perfiles_det","'$_POST[submenu]','$_POST[menus]','$_POST[idperfil]'");
        $actualiza_submenu=paraTodos::arrayUpdate("$campo=$acc","perfiles_det","idPerfil='$_POST[idperfil]' and Menu='$_POST[menus]' and SubMenu='$_POST[submenu]'");
         echo $imgper;
    }
}
?>

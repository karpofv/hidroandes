<?php
	error_reporting(E_ALL);
    ini_set('display_errors', false);
    ini_set('display_startup_errors', false);
	require ("includes/conf/general_parameters.php");
	include_once("includes/layout/headp.php");

    if ($_GET[logaut]=='1') {
        session_cache_limiter('nocache,private');
        session_name($sess_name);
        session_start();
        $sid = session_id();
        session_destroy();
    }

?>
	<div class="middle-box text-center loginscreen animated fadeInDown">
		<div>
			<div>
			<img id="logo" src="<?php $ruta_base;?>assets/images/logo.png" class="img-responsive">
			<h3>Bienvenido</h3>
			<p>Sistema de requisiciones Hidroandes
				<!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
			</p>
			<p>Ingresa con tu Usario y Contraseña</p>
        	<form action="index2.php" id="login-validation" class="m-t" method="post" enctype="multipart/form-data">
				<!-- notificacion de error -->
				<?php if (isset($_GET['error_login'])) {
						$error=$_GET['error_login'];
				?>
					<ul class="noty-wrapper i-am-new" id="noty_bottom">
						<li class="bg-red" style="cursor: pointer;">
							<div class="noty_bar" id="noty_1047669272175724900">
							<div class="noty_message">
							<span class="noty_text">
								<i class="glyph-icon icon-cog mrg5R"></i><?php echo $error_login_ms[$error]; ?>
							</span>
							</div>
							</div>
						</li>
					</ul>
					<?php
							}
					?>
			<!-- fin notificacion de error -->        	
				<div class="form-group">
					<input title="Ingrese su Usuario de Acceso" type="text" name="user" id="user" class="form-control" id="exampleInputEmail1" placeholder="Ingresa tu usuario">
				</div>
				<div class="form-group">
					<input title="Ingrese su Clave de Acceso" type="password" name="pass" id="pass" class="form-control" id="exampleInputPassword1" placeholder="Ingresa tu clave">
				</div>
				<button type="submit" class="btn btn-primary block full-width m-b">INGRESAR</button>
			</form>
			<p class="m-t"> <small>HIDROANDES &copy; 2017</small> </p>
		</div>
	</div>
	<?php
    include_once("includes/layout/footp.php");
?>
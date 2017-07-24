<?php
	session_start();
	if ($_SESSION['ci'] != ""){
		echo $_SESSION['ci'];
	} else {
		echo 0;
	}
?>

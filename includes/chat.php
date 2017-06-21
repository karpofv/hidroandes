<?php
function update_sessions($sid){
    //$sid = session_id();
    $permiso = $_SESSION['usuario_login'];
    $cedula=$_SESSION['ci'];
    $consultasMenu = new paraTodos();
    
    if($_SESSION['sitename_online'] == "1") {
      	$consultasMenu->arrayUpdate("time=time()","chat_sessions","sid='$sid'");
	//echo "///////////////";
    }else{
        $_SESSION['sitename_online'] = 1;
        $consultasMenu->arrayInserte("time, sid, username, status, Cedula","chat_sessions","'time()', '$sid', '$permiso', '1', '$cedula'");
    }
}

function get_onlineusers(){
    $min = time() - 301;
    $consultasMenu = new paraTodos();
    $consultasMenu->arrayDelete("time<=$min","chat_sessions");
	 echo "///////////////";
    //$query = mysql_query("SELECT COUNT(sid) FROM `sessions`");
    //$num = mysql_fetch_row($query);
    //return($num[0]);
}
?>
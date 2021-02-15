<?php
if(session_id() == '' || !isset($_SESSION)) {
		session_start();
}
if(!empty($_SESSION['iniciado']))
{
	$_SESSION['iniciado'] = '';
	$_SESSION['usuario'] = '';
	$_SESSION['tipo'] = '';
	session_destroy();
}
header("Location:login.php");
?>
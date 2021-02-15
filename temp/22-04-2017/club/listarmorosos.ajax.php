<?php 
include_once 'inc/conexion.php';

	$redirect = '/';
	$link = '/';
	$retorno = '';
	if(session_id() == '' || !isset($_SESSION)) {
		session_start();
	}
	$usuario=$_SESSION['usuario'];
	$idcliente=0;
	$tipo = $_REQUEST['tipo'];
	$estado = $_REQUEST['info'];
	$nom_barra= $_SESSION['labarra'];	
	
		
	if ($estado == true){
		$query = "SELECT * from afiliados where tipo = 'H'";
		}else{
			$query = "SELECT idafiliado, nombre, apellido, dni, tipo from afiliados order by idafiliado desc";
		}
		mysql_query('SET CHARACTER SET utf8'); //oro en polvo
		$resp = mysql_query($query);
		$saldoactualdelcli= 0;	
		$total = mysql_num_rows($resp) ;
			if ($total >=1)
			{
				while($datos = mysql_fetch_array($resp)) {
				
					$output[] = array($datos[0],$datos[1],$datos[2],$datos[3],$datos[4],$datos[5],$datos[6],$datos[7]);
				} ;
			}else{
				$output[] = array("Err","Err","Err");
			}
echo json_encode($output);
?>
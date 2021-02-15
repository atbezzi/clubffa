<?php
	if(session_id() == '' || !isset($_SESSION)) {
		session_start();
	}
	if (!(isset($_SESSION['iniciado']))) {
		header ("Location: login.php");
		exit();
	}
	if ($_SESSION['iniciado'] != '5dbc98dcc983a70728bd082d1a47546e'){
		header ("Location: login.php");
		exit();
	}
	include_once 'inc/conexion.php';
	
	error_reporting (0); //ocultar "notice"
	
	mysql_query('SET CHARACTER SET utf8'); //oro en polvo
	
	if($_SESSION['tipo'] != 'P'){
		header("location:index.php?retorno=no_acess");
	} else{
		
	}
/*	$qhacemos="nuevo";
	$idcli= $_REQUEST['idcli'];
	$accion = $_REQUEST['accion'];
	if ($accion =="inactiva")
			{
				$add = mysql_query("update clientes set activo = 'N' where idcliente = $idcli");
				if($add){
					header("location:consulsolicitudpres.php?retorno=Inactivado correctamente");
				}else{
					header("location:consulsolicitudpres.php?retorno=" .mysql_error());
				}
			}
	if ($accion =="modifica")
			{
				$resp = mysql_query("select * from clientes where idcliente = $idcli");
				while($datos = mysql_fetch_array($resp)) {
					$qhacemos="modifica";
					$vnombre= $datos['nombrecompleto'];
					$vdni=$datos['dni'];;
					$vtel= $datos['telefono'];;
					$vmail= $datos['email'];;
				}
			}
*/?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon"  href="img/club.ico"/>
	<link rel="icon" href="club.ico">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link href="css/botones.css" rel="stylesheet">
	<title>Club de las Fuerzas Armadas de Cordoba</title>
	<!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<!-- menu lateral -->
	<link href="css/menulateral.css" rel="stylesheet">
	<!-- menu lateral -->
	<link href="css/animate.css" rel="stylesheet">
	<!-- menu lateral -->
	<!-- datetimepicker -->
	<link href="css/datepicker.css" rel="stylesheet">
	<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" type="text/css">-->
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<div id="container">
	<div style="position:fixed;width:100%; z-index: 10000;">
		<?php include_once "menu.php" ?>
	</div>
	<div class="visible-xs" style="height:70px;"></div>
	<div class="visible-sm" style="height:30px;"></div>
	<div class="row" style="max-width:100%; margin-left:0px; margin-right:0px;">
		<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
		</div>
		<div class="col-md-8 col-lg-8 col-xs-12 col-sm-12">
			<div class="main1">
				<div class="content">
					<h2><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Consultar Solicitud</h2>
					<br>
					<form id="frmcarga" name="frmcarga" method="post" action="consultarcobrador_post.php">
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;N° de Socio, tipo o estado:</label>
						<div class="input-group">
						  <input type="text" name="nomzona" class="form-control" id="nomzona" placeholder="Introduce un numero de socio, tipo o estado" value="<?php echo $vcodigoafilia;?>">
						  <span class="input-group-btn"><button class="btn btn-default" type="button" id="buscar" name="buscar">Buscar</button></span>
						</div>
						</div>
						<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
							<div class="main1">
								<div class="content">
									<div class="table-responsive">
										<table class="table table-striped table-bordered">
											<tr>
											<th class="warning">N° de Socio</th>
											<th class="warning">Tipo</th>
											<th  class="warning">Estado</th>
											<th class="warning">Acciones</th>
											</tr>
											<?php 
												$usrtarget = $_SESSION['usuario'];
												$elsql="";
												$select = mysql_query($elsql); 
											// echo $elsql;
												while($datos = mysql_fetch_array($select)) {
												?>
												<tr>
													<td><?php echo $datos['numsocio'];?></td>
													<td><?php echo $datos['tipo'];?></td>
													<td><?php echo $datos['estado'];?></td>
													<td>
													<a href="modificarzonas.php?accion=modifica&idu=<?php echo $datos['idcobrador'];?>&close=dor">
													<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
													<a href="modificarzonas.php?accion=modifica&idu=<?php echo $datos['idcobrador'];?>&close=dor">
													<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
													<a href="modificarzonas.php?accion=modifica&idu=<?php echo $datos['idcobrador'];?>&close=dor">
													<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
													</td>
												</tr>
												<?php
												} ;
											?>
										</table>
									</div>
								</div>
							</div>
						</div>
				</div>
						<input type="hidden" id="usuariocarga" name="usuariocarga" value="<?php echo $_SESSION['usuario']; ?>">
					</form>
			</div>
			<br><br>
		</div>
	</div>
	<br><br>
</div>
<div class="col-md-1 col-lg-1 col-xs-12 col-sm-12">
</div>
	<!-- /#wrapper -->
	<!-- jQuery -->
	<script src="js/jquery.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<!-- Menu Toggle Script -->
	<script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
	</script>
	<script type="text/javascript">
		// When the document is ready
		$(document).ready(function ()
		{
			$('#fechanac').datepicker({
				format: "dd/mm/yyyy", 
				endDate: "+0d",
				autoclose: true,
			}); 
			 
		});
	</script>
	<script type="text/javascript">
			jQuery('#frmcarga').on('click', '#cargar', function(event) {
				if(document.getElementById("codigoafi").value.trim() != ""){
					if(document.getElementById("fechanac").value.trim() != ""){
						if(document.getElementById("recibo").value.trim() != ""){							
							if(document.getElementById("formpago").value.trim() != 0){
								document.getElementById('frmcarga').submit();
							}else{
								alert("Debe seleccionar el tipo de solicitud");
							}
						}else{
							alert("Debe ingresar un recibo");
						}
					}else{
						alert("Debe ingresar una fecha de pago");
					}
				}else{
						alert("Debe ingresar un codigo de afiliado");
					}
			});
	</script>
	<script type="text/javascript">
			jQuery('#frmcarga').on('click', '#buscar', function(event) {
				if(document.getElementById("nomzona").value.trim() != 0){
					document.getElementById('frmcarga').submit();
				}else{
					alert("Debe ingresar un nombre o zona");
				}
			});
	</script>
	<script type="text/javascript">
		function validarNumeros(e) { // 1
		
		tecla = (document.all) ? e.keyCode : e.which; // 2
		
		if (tecla==8) return true; // backspace
			if (tecla==9) return true; // backspace
			if (tecla==110) return true; // punto
		if (e.ctrlKey && tecla==86) { return true}; //Ctrl v
		if (e.ctrlKey && tecla==67) { return true}; //Ctrl c
		if (e.ctrlKey && tecla==88) { return true}; //Ctrl x
		if (tecla>=96 && tecla<=105) { return true;} //numpad
		 
		patron = /[0-9]/; // patron
		 
		te = String.fromCharCode(tecla);
		return patron.test(te); // prueba
		}
	</script>
</body>
</html>
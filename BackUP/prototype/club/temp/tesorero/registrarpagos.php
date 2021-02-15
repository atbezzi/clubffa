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
	
	if($_SESSION['tipo'] != 'Tesorero'){
		header("location:index.php?retorno=no_acess");
	} else{
		
	}
	$qhacemos="nuevo";
	$ids= $_REQUEST['ids'];
	$accion = $_REQUEST['accion'];
	if ($accion =="modifica")
			{
				$resp = mysql_query("select nsocio from socios where id = $ids");
				while($datos = mysql_fetch_array($resp)) {
					$qhacemos="modifica";
					$vcodigoafilia = $datos['nsocio'];
				}
			}
?>
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
	<!-- datetimepicker -->
	<link href="css/datepicker.css" rel="stylesheet">
	<!-- menu lateral -->
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
					<h2><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Registrar pago</h2>
					<br>
					<form id="frmcarga" name="frmcarga" method="post" action="registrarpagos_post.php">
						<div class="col-lg-6 col-md-6 form-group text-center">
						<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;N° de recibo:</label>
						<div class="col-sm-12">
						  <input type="text" name="recibo" class="form-control" id="recibo" placeholder="Introduce un nuero de recibo" value="<?php echo $vrecibo;?>">
						</div>
						</div>
						<div class="col-lg-6 col-md-6 form-group text-center">
						<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Detalle:</label>
						<div class="col-sm-12">
						  <textarea name="detalle" class="form-control" id="detalle" placeholder="Introduce un detalle" style="resize:none" value="<?php echo $vdetalle;?>"></textarea>
						</div>
						</div>
						<div class="col-lg-6 col-md-6 form-group text-center">
						<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Importe:</label>
						<div class="col-sm-12">
						  <input type="text" name="importe" class="form-control" id="importe" onkeydown="return validarNumeros(event)" placeholder="Introduce un importe" value="<?php echo $vimporte;?>">
						</div>
						</div>
						<div class="col-lg-6 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Fecha de pago:</label>
							<input type="text" name="fechapago" class="form-control" id="fechapago" placeholder="Introduce la fecha de pao" value="<?php echo $vfechapago;?>">
						</div>
						<div style="padding-left:15px;padding-right:15px">
							<input type="hidden" id="qhacemos" name="qhacemos" value="<?php echo $qhacemos;?>" />
							<input type="hidden" id="idcli" name="idcli" value="<?php echo $idcli;?>" />
							<div id="retorno" name="retorno" style="font-size:20px; color:#F60; background-color:#fff" class="pull-left"><?php if(isset($_GET['retorno'])){ echo $_GET['retorno'];}?></div>
							<input style="margin-top: 10px; text-align:center" id="cargar" name="cargar" type="button" class="pull-right botoncss" value="Guardar" >
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
	<!-- Date Time Picker -->
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
			$('#fechapago').datepicker({
				format: "yyyy-mm-dd", 
				endDate: "+0d",
				autoclose: true,
			}); 
			 
		});
	</script>
	<script type="text/javascript">
			jQuery('#frmcarga').on('click', '#cargar', function(event) {
				if(document.getElementById("recibo").value.trim() != ""){
					if(document.getElementById("detalle").value.trim() != ""){
						if(document.getElementById("importe").value.trim() != ""){
							if(document.getElementById("fechapago").value.trim() != ""){
								document.getElementById('frmcarga').submit();
							}else{
								alert("Debe seleccionar la fecha de pago");
							}
						}else{
							alert("Debe ingresar un importe");
						}
					}else{
						alert("Debe ingresar un detalle");
					}
				}else{
					alert("Debe ingresar un numero de recibo");
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
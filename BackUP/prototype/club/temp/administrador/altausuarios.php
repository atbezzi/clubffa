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
	
	if($_SESSION['tipo'] != 'Administrador'){
		header("location:index.php?retorno=no_acess");
	} else{
		
	}
	
/*	$qhacemos="nuevo";
	$idu= $_REQUEST['idu'];
	$accion = $_REQUEST['accion'];
	if ($accion =="modifica")
			{
				$resp = mysql_query("select * from usuarios where idusuario = $idu");
				while($datos = mysql_fetch_array($resp)) {
					$qhacemos ="modifica";
					$vusuario = $datos['usuario'];
					$vclave = $datos['clave'];
					$vmail = $datos['email'];
					$vactivo = $datos['activo'];
					$vtipo = $datos['tipo'];
				//echo "------------------------------------------------------------hola-".$datos['clave'];
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
					<h2><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Registrar usuario</h2>
					<br>
					<form id="frmcarga" name="frmcarga" method="post" action="altausuarios_post.php">
							<div class="col-sm-6 text-center">
								<div class="form-group">
								<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Usuario</label>
								<div class="col-sm-12">
								  <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Introduce un usuario" value="<?php echo $vusuario;?>">
								</div>
								</div>
								<div class="form-group">
								<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Clave</label>
								<div class="col-sm-12">
								  <input type="password" name="clave" class="form-control" id="clave" placeholder="Introduce un clave" value="<?php echo $vclave;?>">
								</div>
								</div>
								<div class="form-group">
								<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Email</label>
								<div class="col-sm-12">
								  <input type="text" name="email" class="form-control" id="email" placeholder="Introduce un mail" value="<?php echo $vmail;?>">
								</div>
								</div>
								<div class="form-group">
								<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Tipo</label>
								<div class="col-sm-12">
									<select class="form-control" name="tipo" id="tipo">
										<option value="<?php echo $vtipo;?>"> - <?php echo $vtipo;?> - </option>
										<option value="Secretario">Secretario</option>
										<option value="Administrador">Administrador</option>
										<option value="Tesorero">Tesorero</option>
										<option value="Auditor">Auditor</option>
										<option value="Presidente">Presidente</option>
									</select>
								</div>
								</div>
								<div style="padding-left:15px;padding-right:15px">
								<input type="hidden" id="qhacemos" name="qhacemos" value="<?php echo $qhacemos;?>" />
								<input type="hidden" id="idcli" name="idcli" value="<?php echo $idcli;?>" />
								<div id="retorno" name="retorno" style="font-size:20px; color:#F60; background-color:#fff" class="pull-left"><?php if(isset($_GET['retorno'])){ echo $_GET['retorno'];}?></div>
								<input style="margin-top: 10px; text-align:center" id="cargar" name="cargar" type="button" class="pull-right botoncss" value="Guardar" >
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
	<!-- Menu Toggle Script -->
	<script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
	</script>
	<script type="text/javascript">
			jQuery('#frmcarga').on('click', '#cargar', function(event) {
				if(document.getElementById("usuario").value.trim() != ""){
					if(document.getElementById("clave").value.trim() != ""){
						if(document.getElementById("email").value.trim() != ""){
							if(document.getElementById("tipo").value.trim() != 0){
								document.getElementById('frmcarga').submit();
							}else{
								alert("Debe ingresar el tipo");
							}
						}else{
						alert("Debe ingresar el mail");
						}
					}else{
						alert("Debe ingresar la clave");
					}
				}else{
						alert("Debe ingresar el usuario");
					}
			});
	</script>
</body>
</html>
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
	
	if($_SESSION['tipo'] != 'Secretario' AND $_SESSION['tipo'] != 'SA'){
	header("location:index.php?retorno=no_acess");
	} else{
		
	}
	mysql_query('SET CHARACTER SET utf8'); //oro en polvo
	$qhacemos = "nuevo";
	$idf = $_REQUEST['idf'];
	$accion = $_REQUEST['accion'];
/*	if ($accion =="inactiva")
			{
				$add = mysql_query("update clientes set activo = 'N' where idcliente = $idcli");
				if($add){
					header("location:adminclientes.php?retorno=Inactivado correctamente");
				}else{
					header("location:adminclientes.php?retorno=" .mysql_error());
				}
			}*/
	if ($accion =="modifica")
			{
				$resp = mysql_query("select id, nsocio, foto, nombre, apellido, dni from socios where id = $idf");
				while($datos = mysql_fetch_array($resp)) {
					$qhacemos="modifica";
					$vnsocio = $datos['nsocio'];
					$vfoto = $datos['foto'];
					$vnombre = $datos['nombre'];
					$vapellido = $datos['apellido'];
					$vdni = $datos['dni'];
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
	<!-- menu lateral -->
	<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" type="text/css">-->
	<!-- foto perfil -->
	<link href="css/fileinput.min.css" rel="stylesheet">
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
					<h2><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Foto de perfil</h2>
					<hr>
					<form id="frmcarga" name="frmcarga" method="post" enctype="multipart/form-data" action="fotoperfil_post.php">
						<div class="col-lg-6 col-md-6 form-group text-left">
							<label for="title" class="col-sm-12 control-label">&nbsp;N° de socio: <span class="label label-success"><?php echo $vnsocio;?></span></label>
							<label for="title" class="col-sm-12 control-label">&nbsp;Apellido y nombre: <span class="label label-success"><?php echo $vapellido.", ".$vnombre;?></span></label>
							<label for="title" class="col-sm-12 control-label">&nbsp;DNI: <span class="label label-success"><?php echo $vdni;?></span></label>
						</div><br><br><br><br><br><br>
						<div class="col-lg-4 col-md-6 form-group text-center">
							<label for="title" class="control-label"><span class="glyphicon glyphicon-camera"></span>&nbsp;Foto de Perfil:</label>
							<div id="kv-avatar-errors-2" style="width:250px;display:none"></div>
							<div class="kv-avatar center-block" style="width:210px">
								<input id="foto" name="foto" type="file" accept="image/jpg,image/jpeg" value="<?php echo $vfoto;?>" class="file-loading">
							</div>
						</div><br>
						
						<div style="padding-left:15px;padding-right:15px">
						<input type="hidden" id="qhacemos" name="qhacemos" value="<?php echo $qhacemos;?>" />
						<input type="hidden" id="idf" name="idf" value="<?php echo $idf;?>" />
						<input type="hidden" id="nsocio" name="nsocio" value="<?php echo $vnsocio;?>" />
						<div id="retorno" name="retorno" style="font-size:20px; color:#F60; background-color:#fff" class="pull-left"><?php if(isset($_GET['retorno'])){ echo $_GET['retorno'];}?></div>
						</div>
						<input type="hidden" id="usuariocarga" name="usuariocarga" value="<?php echo $_SESSION['usuario']; ?>">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
	<!-- /#wrapper -->
	<script src="js/ajax.js"></script>
	<!-- jQuery -->
	<script src="js/jquery.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Menu Profile Picture -->
	<script src="js/fileinput.min.js"></script>
	<script>
	var btnCust = '<button type="button" class="btn btn-default" title="Etiquetas" ' + 
		'onclick="alert(\'Seleccione una foto de perfil para el socio\')">' +
		'<i class="glyphicon glyphicon-tag"></i>' +
		'</button>'; 
	$("#foto").fileinput({
		overwriteInitial: true,
		maxFileSize: 1500,
		showClose: false,
		showCaption: true,
		showBrowse: true,
		browseOnZoneClick: true,
		removeLabel: '',
		removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
		removeTitle: 'Cancelar',
		elErrorContainer: '#kv-avatar-errors-2',
		msgErrorClass: 'alert alert-block alert-danger',
		defaultPreviewContent: '<img src="foto/socio/<?php echo $vfoto;?>" alt="Perfil" style="width:160px"><h6 class="text-muted">Click para seleccionar</h6>',
		layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
		allowedFileExtensions: ["jpg", "jpeg"]
	});
	</script>
	<!-- Menu Toggle Script -->
	<script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
	</script>
	<script type="text/javascript">
		jQuery('#frmcarga').on('click', '#cargar', function(event) {
			if(document.getElementById("avatar-2").value.trim() != ""){
				document.getElementById('frmcarga').submit();
			}else{
				alert("Debe ingresar el nombre");
			}
		});
	</script>
</body>
</html>
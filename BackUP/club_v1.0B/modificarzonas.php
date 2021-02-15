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
	
	mysql_query('SET CHARACTER SET utf8'); //oro en polvo
	
	if($_SESSION['tipo'] != 'Administrador'){
		header("location:index.php?retorno=no_acess");
	} else{
		
	}
	
	$qhacemos="nuevo";
	$idz= $_REQUEST['idz'];
	$accion = $_REQUEST['accion'];
	if ($accion =="modifica")
			{
				$resp = mysql_query("SELECT z.id as idzona, z.descripcion as descripcion, z.barrio as barrio, z.localidad_id as localidad_id, p.id as provincia_id FROM zonas z INNER JOIN localidades l ON l.id = z.localidad_id INNER JOIN provincias p ON p.id = l.provincia_id WHERE z.id = $idz");
				while($datos = mysql_fetch_array($resp)) {
					$qhacemos="modifica";
					$vdescripcion= $datos['descripcion'];
					$vprovincia_id=$datos['provincia_id'];
					$vlocalidad= $datos['localidad_id'];
					$vbarrio= $datos['barrio'];
					//echo "------------------------------------------------------------hola-".$idz;
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
					<h2><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Modificar Zonas</h2>
					<br>
					<form id="frmcarga" name="frmcarga" method="post" action="modificarzonas_post.php">
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Nombre de Zona:</label>
						<div class="col-sm-12">
						  <input type="text" name="zona" class="form-control" id="zona" placeholder="Introduce un nombre de zona" value="<?php echo $vdescripcion;?>">
						</div>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Provincia:</label>
							<?php
							$res=mysql_query("select * from provincias");
							?>
							<select type="text" name="nacidoen" class="form-control" id="nacidoen" placeholder="Introduce lugar de nacimiento" onchange="load(this.value)" value="<?php echo $vprovincia_id;?>">
							<option value="">Seleccione</option>
							<?php
							while($fila=mysql_fetch_array($res)){
								if ($vprovincia_id == $fila['id']){
									$select = "selected";
								} else{
									$select = "";
								}
							?>
							<option  <?php echo $select; ?> value="<?php echo $fila['id']; ?>"><?php echo $fila['descripcion']; ?></option>
							<?php }
							?>
							</select>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center" id="myDivZona">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Localidad:</label>
							<select type="text" name="localidad" class="form-control" id="localidad" placeholder="Introduce la localidad" value="<?php echo $vlocalidad;?>"></select>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Nombre del Barrio:</label>
						<div class="col-sm-12">
						  <input type="text" name="barrio" class="form-control" id="barrio" placeholder="Introduce un nombre de barrio" value="<?php echo $vbarrio;?>">
						</div>
						</div>
						<div style="padding-left:15px;padding-right:15px">
							<input type="hidden" id="qhacemos" name="qhacemos" value="<?php echo $qhacemos;?>" />
							<input type="hidden" id="idz" name="idz" value="<?php echo $idz;?>" />
							<div id="retorno" name="retorno" style="font-size:20px; color:#F60; background-color:#fff" class="pull-left"><?php if(isset($_GET['retorno'])){ echo $_GET['retorno'];}?></div>
							<input style="margin-top: 10px; text-align:center" id="cargar" name="cargar" type="button" class="pull-right botoncss" value="Actualizar" >
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
	<!-- Carga de Provincias y Localidades -->
	<script src="js/ajax.js"></script>
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
	<!-- Carga de Provincias y Localidades Selectiva Para Modificar -->
	<script type="text/javascript">
	loadmodifica7(<?php echo $vprovincia_id.",".$vlocalidad; ?>);
	</script>
	<script type="text/javascript">
			jQuery('#frmcarga').on('click', '#cargar', function(event) {
				if(document.getElementById("zona").value.trim() != ""){
					if(document.getElementById("nacidoen").value.trim() != 0){
						if(document.getElementById("localidad").value.trim() != 0){
							if(document.getElementById("barrio").value.trim() != ""){
								document.getElementById('frmcarga').submit();
							}else{
								alert("Debe ingresar el nombre del barrio");
							}
						}else{
							alert("Debe seleccionar la localidad");
						}
					}else{
						alert("Debe seleccionar la provincia");
					}
				}else{
						alert("Debe ingresar el nombre de la zona");
					}
			});
	</script>
</body>
</html>
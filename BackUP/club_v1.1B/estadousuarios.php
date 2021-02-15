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
	
	$accion = $_REQUEST['accion'];
	$idu = $_REQUEST['idu'];
	$vidmodificausuario = $_SESSION['usuario'];
	if ($accion == "alta")
			{
				$add = mysql_query("update usuarios set estado ='Activo', fechaupdate = NOW(), idmodificausuario = '$vidmodificausuario' where id = $idu");
				if($add){
					header("location:estadousuarios.php?retorno=Activado correctamente");
				}else{
					header("location:estadousuarios.php?retorno=" .mysql_error());
				}
			}
	if ($accion == "baja")
			{
				$add = mysql_query("update usuarios set estado ='Inactivo', fechaupdate = NOW(), idmodificausuario = '$vidmodificausuario' where id = $idu");
				if($add){
					header("location:estadousuarios.php?retorno=Inactivado correctamente");
				}else{
					header("location:estadousuarios.php?retorno=" .mysql_error());
				}
			}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon"  href="img/670df58df5a2ec63b0a33e054418105a.ico"/>
	<link rel="icon" href="670df58df5a2ec63b0a33e054418105a.ico">
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
	<link href="css/noticiasstyle.css" rel="stylesheet">
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
					<h2><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Estados de usuarios</h2>
					<br>
						Referencias de estados:<br>
						<span class="label label-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>Usuarios activos</span>&nbsp;<span class="label label-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Usuarios no activos</span>
						<br><br>
						<div class="table-responsive">
							<table class="table table-striped table-bordered">
								<tr>
								<th class="success">ID Usuario</th>
								<th class="success">Usuario</th>
								<th class="success">Email</th>
								<th  class="success">Tipo Usuario</th>
								<th  class="success">Estado</th>
								<th class="success">Accion</th>
								<th class="success">Editar</th>
								</tr>
								<?php 
									$usrtarget = $_SESSION['usuario'];
									$elsql="SELECT * from usuarios order by id desc ";
									$select = mysql_query($elsql); 
								// echo $elsql;
									while($datos = mysql_fetch_array($select)) {
									?>
									<tr>
										<td><?php echo $datos['id'];?></td>
										<td><?php echo $datos['usuario'];?></td>
										<td><?php echo $datos['email'];?></td>
										<td><?php echo $datos['tipo'];?></td>
										<td>
										<?php if ($datos['estado']=="Activo")
											{
											?><span class="label label-success">Activo</span>
											<?php
											}
											if ($datos['estado']=="P")
											{ ?>
												<span class="label label-warning">Pendiente de Activacion</span>
											<?php }
											if ($datos['estado']=="Inactivo")
											{
												 ?>
												<span class="label label-danger">No Activo</span>
											<?php
											}?>
										</td>
										<td>
										<?php if ($datos['estado']=="P")
										{?>
										<a href="estadousuarios.php?accion=alta&idu=<?php echo $datos['id'];?>&close=dor">
										<span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
										&nbsp;&nbsp;
										<a href="estadousuarios.php?accion=baja&idu=<?php echo $datos['id'];?>&close=dor">
										<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
										<?php	}
												if ($datos['estado']=="Activo")
												{
											?>
											<a href="estadousuarios.php?accion=baja&idu=<?php echo $datos['id'];?>&close=dor">
											<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
											<?php
												}
											?>
										<?php if ($datos['estado']=="Inactivo")
										{?>
										<a href="estadousuarios.php?accion=alta&idu=<?php echo $datos['id'];?>&close=dor">
										<span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
										<?php	}?>
										</td>
										<td>
										<a href="modificarusuarios.php?accion=modifica&idu=<?php echo $datos['id'];?>&close=dor">
										<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
										</td>
									</tr>
									<?php
									} ;
								?>
							</table>
						</div><hr>
				</div>
				 
			</div>
			<br>
			<br>
			
		</div>

		<div class="col-md-1 col-lg-1 col-xs-12 col-sm-12">
		</div>
	</div>
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
</body>
</html>
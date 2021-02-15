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
						Referencias:<br>
						<span class="label label-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Activar usuarios</span>&nbsp;<span class="label label-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Inactivar usuarios</span>&nbsp;<span class="label label-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar usuarios</span>&nbsp;<span class="label label-warning"><span class="glyphicon glyphicon-eye-open" aria-hidden="false"></span> Ver detalle</span>
						<br><br>
						<div class="table-responsive">
							<table class="table table-striped table-bordered">
								<tr>
								<th class="success text-center">ID Usuario</th>
								<th class="success text-center">Usuario</th>
								<th class="success text-center">Email</th>
								<th class="success text-center">Tipo Usuario</th>
								<th class="success text-center">Accion</th>
								<th class="success text-center">Editar</th>
								<th class="success text-center">Ver+</th>
								</tr>
								<?php 
									$usrtarget = $_SESSION['usuario'];
									$elsql="SELECT * from usuarios order by id desc ";
									$select = mysql_query($elsql); 
								// echo $elsql;
									while($datos = mysql_fetch_array($select)) {
									?>
									<tr>
										<td class="text-center"><?php echo $datos['id'];?></td>
										<td class="text-center"><?php echo $datos['usuario'];?></td>
										<td class="text-center"><?php echo $datos['email'];?></td>
										<td class="text-center"><?php echo $datos['tipo'];?></td>
										<td class="text-center">
										<?php if ($datos['estado']=="Activo")
											{
											?><span class="label label-danger text-center">
											<a href="estadousuarios.php?accion=baja&idu=<?php echo $datos['id'];?>&close=dor" onclick="return confirm('¿Esta seguro que desea dar de baja este usuario?')">
											<font color=white><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></font></a>
											</span>
											<?php
											}
											if ($datos['estado']=="Pendiente")
											{ ?>
												<span class="label label-warning text-center">
												<a href="estadousuarios.php?accion=alta&idu=<?php echo $datos['id'];?>&close=dor">
												<font color=white><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></font></a>
												&nbsp;&nbsp;
												<a href="estadousuarios.php?accion=baja&idu=<?php echo $datos['id'];?>&close=dor" onclick="return confirm('¿Esta seguro que desea dar de baja este usuario?')">
												<font color=white><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></font></a>
												</span>
											<?php }
											if ($datos['estado']=="Inactivo")
											{
												 ?>
												<span class="label label-success text-center">
												<a href="estadousuarios.php?accion=alta&idu=<?php echo $datos['id'];?>&close=dor">
												<font color=white><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></font></a>
												</span>
											<?php
											}?>
										</td>
										<td class="text-center">
										<span class="label label-primary text-center">
										<a href="modificarusuarios.php?accion=modifica&idu=<?php echo $datos['id'];?>&close=dor">
										<font color=white><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></font></a>
										</span>
										</td>
										<td class="text-center">
										<span class="label label-warning text-center">
										<a href="#" data-toggle="modal" data-target="#myModal" data-id="<?php echo $datos['id'];?>">
										<font color=white><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></font></a>
										</span>
										</td>
									</tr>
									<?php
									} ;
								?>
							</table>
						<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h3 class="modal-title" id="myModalLabel"><span class="label label-success">Datos del socio</span></h3>
							  </div>
							  <div class="modal-body">
								<h3>Nombre: <span class="label label-primary"><label id="lblnombre"></label></span></h3><hr>
								<h3>Apellido: <span class="label label-primary"><label id="lblapellido"></label></span></h3><hr>
								<h3>DNI: <span class="label label-primary"><label id="lbldni"></label></span></h3><hr>
								<h3>Fecha nacimiento: <span class="label label-primary"><label id="lblfechanacimiento"></label></span></h3><hr>
								<h3>Domicilio: <span class="label label-primary"><label id="lbldomicilio"></label></span></h3><hr>
								<h3>Teléfono: <span class="label label-primary"><label id="lbltelefono"></label></span></h3><hr>
								<h3>Celular: <span class="label label-primary"><label id="lblcelular"></label></span></h3><hr>
								<h3>Email: <span class="label label-primary"><label id="lblemail"></label></span></h3><hr>
							  </div>
							  
							  <div class="modal-footer">
								<button type="button" class="pull-right botoncss" data-dismiss="modal">Cerrar</button>
							  </div>
							</div>
						  </div>
						</div>
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
	<script type="text/javascript">
	 $("a[data-toggle=modal]").click(function() 
    {		
		console.log($(this).attr("data-id"));
		
		$.ajax({			
			url     : "buscardatosusuarios.php?id="+$(this).attr("data-id"),
			type    : "POST",
			dataType: "json",
	 success: function( data ){
								console.log(data.encontro);
								if (data.encontro =="SI")
								{
								document.getElementById("lblnombre").innerHTML = data.nombre;
								document.getElementById("lblapellido").innerHTML = data.apellido;
								document.getElementById("lbldni").innerHTML = data.dni;
								document.getElementById("lblfechanacimiento").innerHTML = data.fechanacimiento;
								document.getElementById("lbldomicilio").innerHTML = data.domicilio;
								document.getElementById("lbltelefono").innerHTML = data.telefono;
								document.getElementById("lblcelular").innerHTML = data.celular;
								document.getElementById("lblemail").innerHTML = data.email;
								}
								else
								{
								document.getElementById("lblnombre").innerHTML = "";
								document.getElementById("lblapellido").innerHTML = "";
								document.getElementById("lbldni").innerHTML = "";
								document.getElementById("lblfechanacimiento").innerHTML = "";
								document.getElementById("lbldomicilio").innerHTML = "";
								document.getElementById("lbltelefono").innerHTML = "";
								document.getElementById("lblcelular").innerHTML = "";
								document.getElementById("lblemail").innerHTML = "";
								}
							},
	 error:	function( data ){
								document.getElementById("lblnombre").innerHTML = "error";
								document.getElementById("lblapellido").innerHTML = "error";
								document.getElementById("lbldni").innerHTML = "error";
								document.getElementById("lblfechanacimiento").innerHTML = "error";
								document.getElementById("lbldomicilio").innerHTML = "error";
								document.getElementById("lbltelefono").innerHTML = "error";
								document.getElementById("lblcelular").innerHTML = "error";
								document.getElementById("lblemail").innerHTML = "error";
							}													
	});
});
	</script>
</body>
</html>
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
	
	if($_SESSION['tipo'] != 'Administrador'){
	header("location:index.php?retorno=no_acess");
	} else{
		
	}
	
	$accion = $_REQUEST['accion'];
	$idc = $_REQUEST['idc'];
	$vidmodificausuario = $_SESSION['usuario'];
	if ($accion == "alta")
			{
				$add = mysql_query("update cobradores set estado = 'Activo', fechaupdate = NOW(), idmodificausuario = '$vidmodificausuario' where id = $idc");
				if($add){
					header("location:consultarcobrador.php?retorno=Activado correctamente");
				}else{
					header("location:consultarcobrador.php?retorno=" .mysql_error());
				}
			}
	if ($accion == "baja")
			{
				$add = mysql_query("update cobradores set estado = 'Inactivo', fechaupdate = NOW(), idmodificausuario = '$vidmodificausuario' where id = $idc");
				if($add){
					header("location:consultarcobrador.php?retorno=Inactivado correctamente");
				}else{
					header("location:consultarcobrador.php?retorno=" .mysql_error());
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
					<h2><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Consultar Cobrador</h2>
					<br>
					<form id="frmcarga" name="frmcarga" method="post">
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Nombre o Zona:</label>
						<div class="col-sm-12">
						  <input type="text" name="busqueda" class="form-control" id="busqueda" placeholder="Introduce un nombre o apellido" value="">							
						</div>
						</div>
						<div id="resultadoBusqueda"></div>
						<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
							<div class="main1">
								<div class="content">
									<div id="resultado" class="table-responsive">
										<table class="table table-striped table-bordered">
											<tr>
											<th class="success">Nombre/s y Apellido/s</th>
											<th class="success">Zona</th>
											<th class="success">Estado</th>
											<th class="success">Acciones</th>
											</tr>
											<?php 
												$usrtarget = $_SESSION['usuario'];
												$elsql="SELECT c.id, c.zona_id, c.nombre, c.apellido, c.estado, z.descripcion FROM cobradores c INNER JOIN zonas z ON c.zona_id = z.id";
												$select = mysql_query($elsql); 
											// echo $elsql;
												while($datos = mysql_fetch_array($select)) {
												?>
												<tr>
													<td><?php echo $datos['nombre'].', '.$datos['apellido'];?></td>
													<td><?php echo $datos['descripcion'];?></td>
													<td><?php echo $datos['estado'];?></td>
													<td>
													<?php if ($datos['estado']=="P")
													{?>
													<a href="consultarcobrador.php?accion=alta&idc=<?php echo $datos['id'];?>&close=dor">
													<span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
													&nbsp;&nbsp;
													<a href="consultarcobrador.php?accion=baja&idc=<?php echo $datos['id'];?>&close=dor">
													<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
													<?php	}
															if ($datos['estado']=="Activo")
															{
														?>
														<a href="consultarcobrador.php?accion=baja&idc=<?php echo $datos['id'];?>&close=dor">
														<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
														<?php
															}
														?>
													<?php if ($datos['estado']=="Inactivo")
													{?>
													<a href="consultarcobrador.php?accion=alta&idc=<?php echo $datos['id'];?>&close=dor">
													<span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
													<?php	}?>
													
													<a href="modificarcobrador.php?accion=modifica&idc=<?php echo $datos['id'];?>&close=dor">
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
			jQuery('#frmcarga').on('click', '#buscar', function(event) {
				if(document.getElementById("nomzona").value.trim() != 0){
					document.getElementById('frmcarga').submit();
				}else{
					alert("Debe ingresar un nombre o zona");
				}
			});
	</script>
	<script>
	$(document).ready(function(){
        var consulta;
        //hacemos focus al campo de búsqueda
        $("#busqueda").focus();
                                                                                                     
        //comprobamos si se pulsa una tecla
        $("#busqueda").keyup(function(e){
                                      
              //obtenemos el texto introducido en el campo de búsqueda
              consulta = $("#busqueda").val();
              //hace la búsqueda                                                                                  
              $.ajax({
                    type: "POST",
                    url: "consultarcobrador_post.php",
                    data: "b="+consulta,
                    dataType: "html",
                    beforeSend: function(){
                    //imagen de carga
                    $("#resultado").html("<p align='center'><img src='ajax-loader.gif' /></p>");
                    },
                    error: function(){
                    alert("error petición ajax");
                    },
                    success: function(data){                                                    
                    $("#resultado").empty();
                    $("#resultado").append(data);                                                             
                    }
              });                                                                         
        });                                                     
	});
	</script>
</body>
</html>
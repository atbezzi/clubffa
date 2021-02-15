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

	if($_SESSION['tipo'] != 'Secretario'){
	header("location:index.php?retorno=no_acess");
	} else{
		
	}
	
	$accion = $_REQUEST['accion'];
	$idf = $_REQUEST['idf'];
	$vidmodificausuario = $_SESSION['usuario'];
	if ($accion == "baja")
			{
				$add = mysql_query("update familiares set estado = 'Inactivo', fechaupdate = NOW(), idmodificausuario = '$vidmodificausuario' where id = $idf");
				if($add){
					header("location:consultarfamiliar.php?retorno=Inactivado correctamente");
				}else{
					header("location:consultarfamiliar.php?retorno=" .mysql_error());
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
					<h2><span class="glyphicon glyphicon-star-empty"></span>&nbsp;Consulta de Familiares</h2>
					<form id="frmbuscar" name="frmbuscar" method="post" action="buscarparientes_post.php">
						<br>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<input type="text" name="busqueda" class="form-control" id="busqueda" placeholder="Número de socio titular" value="">	
						</div>
						<br><br><br>
						<div id="resultado" class="table-responsive">
							<table class="table table-striped table-bordered">
								<tr>
								<th class="success">Nombre</th>
								<th class="success">DNI</th>
								<th  class="success">Fecha de Nacimiento</th>
								<th  class="success">Parentesco</th>
								<th  class="success">Baja</th>
								<th class="success">Editar</th>
								</tr>
								<?php 
									$usrtarget = $_SESSION['usuario'];
									$elsql="";
									$select = mysql_query($elsql); 
								// echo $elsql;
									while($datos = mysql_fetch_array($select)) {
									?>
									<tr>
										<td><?php echo $datos['nombrepariente'];?></td>
										<td><?php echo $datos['dnipariente'];?></td>
										<td><?php echo $datos['fechanacpariente'];?>
										<td><?php echo $datos['parentesco'];?></td>
										<td>
										<a href="consultarfamiliar.php?accion=baja&idf=<?php echo $datos['id'];?>&close=dor">
										<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
										</td>
										<td>
										<a href="modificarfamiliar.php?accion=modifica&idf=<?php echo $datos['id'];?>&close=dor">
										<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
										</td>
									</tr>
									<?php
									} ;
								?>
							</table>
						</div><hr>
					</form>
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
                    url: "consultarfamiliar_post.php",
                    data: "b="+consulta,
                    dataType: "html",
                    beforeSend: function(){
                    //imagen de carga
                    $("#resultado").html("<p align='center'><img src='img/loading.gif' /></p>");
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
	<script type="text/javascript">
	$(document).ready(function() {
		$("#frmbuscar").keypress(function(e) {
			if (e.which == 13) {
				return false;
			}
		});
	});
	</script>
</body>
</html>
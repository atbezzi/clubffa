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
	
	if($_SESSION['tipo'] != 'Tesorero'){
	header("location:index.php?retorno=no_acess");
	} else{
		
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
<form>
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
					<h2>Consulta de socios - Cargar plan</h2>
					<br>
						<input type="text" name="busqueda" class="form-control" id="busqueda" placeholder="Número de socio o nombre del socio" value="">	
						<br>
						Referencia:<br>
						<span class="label label-primary"><span class="glyphicon glyphicon-search" aria-hidden="false"></span> Seleccionar socio</span>
						<br><br>
						<div id='resultado' class="table-responsive">
						 <table class="table table-striped table-bordered">
							<tr>							
							<th class="success text-center">Número de socio</th>
							<th class="success text-center">Nombre</th>
							<th class="success text-center">Tipo de socio</th>
							<th class="success text-center">Acciones</th>
							</tr>						
							<?php 
								$usrtarget = $_SESSION['usuario'];
								$elsql="SELECT s.id, s.nsocio, s.nombre, s.apellido, s.tipo FROM socios s 
								where s.id not in (SELECT s.id FROM socios s JOIN plan_socio ps on (s.id=ps.socio_id) where ps.vencimiento > date(now())) and s.estado = 'Activo' 
								group by s.id";
								$select = mysql_query($elsql); 
							// echo $elsql;
								while($datos = mysql_fetch_array($select)) {	
								?>
								<tr>
									<td class="text-center"><?php echo $datos['nsocio'];?></td>
									<td class="text-center"><?php echo $datos['nombre'].', '.$datos['apellido'];?></td>
									<td class="text-center"><?php echo $datos['tipo'];?></td>
									<td class="text-center">
									<span class="label label-primary text-center">
									<a href="cargarcobrodos.php?accion=buscar&idu=<?php echo $datos['nsocio'];?>&close=dor">
									<font color=white><span class="glyphicon glyphicon-search" aria-hidden="true"></span></font></a>
									</span>
									</td>
								</tr>
								<?php
								} ;
							?>
						</table>
						</div>
						<br>
						<hr>						
				 </div>
				 
			</div>
			
			<br>
			<br>
			
		</div>
		
		<div class="col-md-1 col-lg-1 col-xs-12 col-sm-12">
		</div>
</form>
		 
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
                    url: "cargarcobrobusqueda_post.php",
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
</body>
</html>
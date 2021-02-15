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

	if($_SESSION['tipo'] != 'Secretario' AND $_SESSION['tipo'] != 'Presidente'){
	header("location:index.php?retorno=no_acess");
	} else{
		
	}
	
	$accion = $_REQUEST['accion'];
	$idu = $_REQUEST['idu'];
	$vidmodificausuario = $_SESSION['usuario'];
	if ($accion == "alta")
			{
				$add = mysql_query("update usuarios set activo ='S', fechaupdate = NOW(), idmodificausuario = '$vidmodificausuario' where idusuario = $idu");
				if($add){
					header("location:estadousuarios.php?retorno=Activado correctamente");
				}else{
					header("location:estadousuarios.php?retorno=" .mysql_error());
				}
			}
	if ($accion == "baja")
			{
				$add = mysql_query("update usuarios set activo ='N', fechaupdate = NOW(), idmodificausuario = '$vidmodificausuario' where idusuario = $idu");
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
					<h2><span class="glyphicon glyphicon-star-empty"></span>&nbsp;Consulta de formularios</h2><br>
						<div class="col-md-6 form-group text-center">
						<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-search"></span>&nbsp;Solicitud, numeró o nombre del socio:</label>
						<div class="col-sm-12">
						  <input type="text" name="busqueda" class="form-control" id="busqueda" placeholder="Solicitud, numeró o nombre del socio" value="">	
						</div>
						</div>
							<br><br><br><br>
						<div id='resultado' class="table-responsive">
							<table id="myTable" data-toggle="table" data-detail-view="true" data-detail-formatter="detailFormatter" class="table table-striped table-bordered">
								<tr>
								<th class="success">Numero de solicitud</th>
								<th class="success">Numero de socio</th>
								<th class="success">Nombre del socio</th>
								<th class="success">Tipo de socio</th>
								<th  class="success">Tipo de solcitud</th>
								<th  class="success">Estado de la solicitud</th>
								<th  class="success">Accion</th>
								</tr>
								<?php 
									$usrtarget = $_SESSION['usuario'];
									$elsql="select f.id as idsolicitud, f.tipo as stipo, s.id as idsocio, s.nsocio, s.nombre, s.apellido, s.tipo, f.estado from solicitudes f inner join socios s on s.id = f.socio_id";
									$select = mysql_query($elsql);
								// echo $elsql;
									while($datos = mysql_fetch_array($select)) {
									?>
									<tr>
										<td><?php echo $datos['idsolicitud'];?></td>
										<td><?php echo $datos['nsocio'];?></td>
										<td><?php echo $datos['nombre'].', '.$datos['apellido'];?></td>
										<td><?php echo $datos['tipo'];?></td>
										<td><?php echo $datos['stipo'];?></td>
										<td><?php echo $datos['estado'];?></td>
										<td>
										<a href="#" data-toggle="modal" data-target="#myModal" data-id="<?php echo $datos['idsolicitud'];?>">
										<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
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
								<h3>ID solicitud: <span class="label label-primary"><label id="lblid"></label></span></h3><hr>
								<h3>Tipo solicitud: <span class="label label-primary"><label id="lbltipo"></label></span></h3><hr>
								<h3>Numero de socio: <span class="label label-primary"><label id="lblnumero"></label></span></h3><hr>
								<h3>Nombre: <span class="label label-primary"><label id="lblnombre"></label></span></h3><hr>
								<h3>Apellido: <span class="label label-primary"><label id="lblapellido"></label></span></h3><hr>
								<h3>Motivo: <span class="label label-primary"><label id="lblmotivo"></label></span></h3><hr>
								<h3>Estado: <span class="label label-primary"><label id="lblestado"></label></span></h3><hr>
								<h3>Presidente: <span class="label label-primary"><label id="lblpres"></label></span></h3><hr>
								<h3>Observación: <span class="label label-primary"><label id="lblobservacion"></label></span></h3>
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
			url     : "buscarformulario.php?idsolicitud="+$(this).attr("data-id"),
			type    : "POST",
			dataType: "json",
	 success: function( data ){
								console.log(data.encontro);
								if (data.encontro =="SI")
								{
								document.getElementById("lblid").innerHTML = data.idsol;
								document.getElementById("lbltipo").innerHTML = data.tiposol;
								document.getElementById("lblnumero").innerHTML = data.numsocio;
								document.getElementById("lblnombre").innerHTML = data.nombre;
								document.getElementById("lblapellido").innerHTML = data.apellido;
								document.getElementById("lblmotivo").innerHTML = data.motivo;
								document.getElementById("lblestado").innerHTML = data.estado;
								document.getElementById("lblpres").innerHTML = data.nomusuario;
								document.getElementById("lblobservacion").innerHTML = data.observacion;
								}
								else
								{
								document.getElementById("lblid").innerHTML = "";
								document.getElementById("lbltipo").innerHTML = "";
								document.getElementById("lblnumero").innerHTML = "";
								document.getElementById("lblnombre").innerHTML = "";
								document.getElementById("lblapellido").innerHTML = "";
								document.getElementById("lblmotivo").innerHTML = "";
								document.getElementById("lblestado").innerHTML = "";
								document.getElementById("lblpres").innerHTML = "";
								document.getElementById("lblobservacion").innerHTML = "";
								}
							},
	 error:	function( data ){
								document.getElementById("lblid").innerHTML = "error";
								document.getElementById("lbltipo").innerHTML = "error";
								document.getElementById("lblnumero").innerHTML = "error";
								document.getElementById("lblnombre").innerHTML = "error";
								document.getElementById("lblapellido").innerHTML = "error";
								document.getElementById("lblmotivo").innerHTML = "error";
								document.getElementById("lblestado").innerHTML = "error";
								document.getElementById("lblpres").innerHTML = "error";
								document.getElementById("lblobservacion").innerHTML = "error";
							}													
	});
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
                    url: "consultarformularios_post.php",
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
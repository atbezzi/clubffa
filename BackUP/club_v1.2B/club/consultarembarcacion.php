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
	$ide = $_REQUEST['idembarca'];
	$vidmodificausuario = $_SESSION['usuario'];
	if ($accion == "baja")
			{
				$add = mysql_query("update embarcaciones set estado ='Inactivo', fechaupdate = NOW(), idmodificausuario = '$vidmodificausuario' where id = $ide");
				if($add){
					header("location:consultarembarcacion.php?retorno=Inactivado correctamente");
				}else{
					header("location:consultarembarcacion.php?retorno=" .mysql_error());
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
<form id="frm">
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
					<h2>Consulta de embarcaciones</h2>
					<br>
					<input type="text" name="busqueda" class="form-control" id="busqueda" placeholder="Nombre, matrícula de la embarcación o número de socio" value="">	
					<br>
						Referencias:<br>
						<span class="label label-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar embarcacion</span>&nbsp;<span class="label label-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Baja embarcacion</span>&nbsp;<span class="label label-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Ver detalle</span>&nbsp;<span class="label label-warning"><span class="glyphicon glyphicon-qrcode" aria-hidden="true"></span> Generar QR</span>
						<br><br>
						<div id="resultado" class="table-responsive">
						<table class="table table-striped table-bordered">
							<tr>							
							<th class="success text-center">Nombre</th>
							<th class="success text-center">Arboladura</th>
							<th class="success text-center">Matricula</th>
							<th class="success text-center">Número de socio</th>
							<th class="success text-center">Nombre del socio</th>
							<th class="success text-center">Editar</th>
							<th class="success text-center">Baja</th>
							<th class="success text-center">Ver+</th>
							<th class="success text-center">QR</th>
							</tr>						
							<?php 
								$usrtarget = $_SESSION['usuario'];
								$elsql="select e.id as idembarca, e.nombre, e.matricula, e.arboladura, s.nsocio, s.nombre as snombre, s.apellido from embarcaciones e inner join socios s on s.id=e.socio_id where e.estado = 'Activo'";
								$select = mysql_query($elsql); 
							// echo $elsql;
								while($datos = mysql_fetch_array($select)) {	
								?>
								<tr>
									<td class="text-center"><?php echo $datos['nombre'];?></td>
									<td class="text-center"><?php echo $datos['arboladura'];?></td>
									<td class="text-center"><?php echo $datos['matricula'];?></td>
									<td class="text-center"><?php echo $datos['nsocio'];?></td>
									<td class="text-center"><?php echo $datos['snombre'].', '.$datos['apellido'];?></td>
									<td class="text-center">
									<span class="label label-primary text-center">
									<a href="modificarembarcacion.php?accion=modifica&ide=<?php echo $datos['idembarca'];?>&close=dor">
									<font color=white><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></font></a>
									</span>
									</td>
									<td class="text-center">
									<span class="label label-danger text-center">
									<a href="consultarembarcacion.php?accion=baja&idembarca=<?php echo $datos['idembarca'];?>&close=dor">
									<font color=white><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></font></a>
									</span>
									</td>
									<td class="text-center">
									<span class="label label-success text-center">
									<a href="#" data-toggle="modal" data-target="#myModal" data-id="<?php echo $datos['idembarca'];?>">
									<font color=white><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></font></a>
									</span>
									</td>
									<td class="text-center">
									<span class="label label-warning text-center">
									<a href="qr/buscarimprimirqr.php?accion=imprimir&ide=<?php echo $datos['idembarca'];?>&close=dor" target="_blank">
									<font color=white><span class="glyphicon glyphicon-qrcode" aria-hidden="true"></span></font></a>
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
								<h4 class="modal-title" id="myModalLabel"><span class="label label-success">Datos de la Embarcacion</span></h4>
							  </div>
							  <div class="modal-body">
								<h3>Nombre embarcación: <span class="label label-primary"><label id="lblnombre"></label></span></h3><br>
								<h3>Arboladura: <span class="label label-primary"><label id="lblarboladura"></label></span></h3><br>
								<h3>Casco: <span class="label label-primary"><label id="lblcasco"></label></span></h3><br>
								<h3>Eslora: <span class="label label-primary"><label id="lbleslora"></label></span></h3><br>
								<h3>Manga: <span class="label label-primary"><label id="lblmanga"></label></span></h3><br>
								<h3>Puntal: <span class="label label-primary"><label id="lblpuntal"></label></span></h3><br>
								<h3>Calado: <span class="label label-primary"><label id="lblcalado"></label></span></h3><br>
								<h3>Tonelaje: <span class="label label-primary"><label id="lbltonelaje"></label></span></h3><br>
								<h3>Marca motor: <span class="label label-primary"><label id="lblmarcacotor"></label></span></h3><br>
								<h3>Número motor: <span class="label label-primary"><label id="lblnumeromotor"></label></span></h3><br>
								<h3>Potencia motor: <span class="label label-primary"><label id="lblpotmotor"></label></span></h3><br>
								<h3>Matrícula: <span class="label label-primary"><label id="lblmatricula"></label></span></h3><br>
								<h3>Rey: <span class="label label-primary"><label id="lblrey"></label></span></h3><br>
								<h3>Fecha última inspección: <span class="label label-primary"><label id="lblfecinsp"></label></span></h3><br>
								<h3>N° de socio: <span class="label label-primary"><label id="lblcodigosocio"></label></span></h3><br>
								<h3>Elementos: <span class="label label-primary"><label id="lblelementos"></label></span></h3><br>
							  </div>
							  
							  <div class="modal-footer">
								<button type="button" class="pull-right botoncss" data-dismiss="modal">Cerrar</button>
							  </div>
							</div>
						  </div>
						</div>
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
	
	 $("a[data-toggle=modal]").click(function() 
    {   
		console.log($(this).attr('data-id'));
		
		$.ajax({			
			url     : 'buscarembarcaciones.php?idembarca='+$(this).attr('data-id'),
			type    : 'POST',
			dataType: 'json',
	success: function( data ) {
			console.log(data.encontro);
			if (data.encontro =="SI")
			{
			document.getElementById("lblnombre").innerHTML = data.nombre;
			document.getElementById("lblarboladura").innerHTML = data.arboladura;
			document.getElementById("lblcasco").innerHTML = data.casco;
			document.getElementById("lbleslora").innerHTML = data.eslora;
			document.getElementById("lblmanga").innerHTML = data.manga;
			document.getElementById("lblpuntal").innerHTML = data.puntal;
			document.getElementById("lblcalado").innerHTML = data.calado;
			document.getElementById("lbltonelaje").innerHTML = data.tonelaje;
			document.getElementById("lblmarcacotor").innerHTML = data.motormarca;
			document.getElementById("lblnumeromotor").innerHTML = data.motornumero;
			document.getElementById("lblpotmotor").innerHTML = data.motorpotencia;
			document.getElementById("lblmatricula").innerHTML = data.matricula;
			document.getElementById("lblrey").innerHTML = data.rey;
			document.getElementById("lblfecinsp").innerHTML = data.inspeccion;
			document.getElementById("lblcodigosocio").innerHTML = data.socio_id;
			document.getElementById("lblelementos").innerHTML = data.elementos;
			}
			else
			{
			document.getElementById("lblnombre").innerHTML = "";
			document.getElementById("lblarboladura").innerHTML = "";
			document.getElementById("lblcasco").innerHTML = "";
			document.getElementById("lbleslora").innerHTML = "";
			document.getElementById("lblmanga").innerHTML = "";
			document.getElementById("lblpuntal").innerHTML = "";
			document.getElementById("lblcalado").innerHTML = "";
			document.getElementById("lbltonelaje").innerHTML = "";
			document.getElementById("lblmarcacotor").innerHTML = "";
			document.getElementById("lblnumeromotor").innerHTML = "";
			document.getElementById("lblpotmotor").innerHTML = "";
			document.getElementById("lblmatricula").innerHTML = "";
			document.getElementById("lblrey").innerHTML = "";
			document.getElementById("lblfecinsp").innerHTML = "";
			document.getElementById("lblcodigosocio").innerHTML = "";
			document.getElementById("lblelementos").innerHTML = "";
			}
					
							},
	error:	function( data ) {
		
			document.getElementById("lblnombre").innerHTML = "error";
			document.getElementById("lblarboladura").innerHTML = "error";
			document.getElementById("lblcasco").innerHTML = "error";
			document.getElementById("lbleslora").innerHTML = "error";
			document.getElementById("lblmanga").innerHTML = "error";
			document.getElementById("lblpuntal").innerHTML = "error";
			document.getElementById("lblcalado").innerHTML = "error";
			document.getElementById("lbltonelaje").innerHTML = "error";
			document.getElementById("lblmarcacotor").innerHTML = "error";
			document.getElementById("lblnumeromotor").innerHTML = "error";
			document.getElementById("lblpotmotor").innerHTML = "error";
			document.getElementById("lblmatricula").innerHTML = "error";
			document.getElementById("lblrey").innerHTML = "error";
			document.getElementById("lblfecinsp").innerHTML = "error";
			document.getElementById("lblcodigosocio").innerHTML = "error";
			document.getElementById("lblelementos").innerHTML = "error";
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
                    url: "consultarembarcacion_post.php",
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
		$("#frm").keypress(function(e) {
			if (e.which == 13) {
				return false;
			}
		});
	});
	</script>
</body>
</html>
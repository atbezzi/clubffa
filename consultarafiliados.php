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
	$idu = $_REQUEST['idu'];
	$vidmodificausuario = $_SESSION['usuario'];
	if ($accion == "alta")
			{
				$add = mysql_query("update afiliados set activo ='S', fechaupdate = NOW(), idmodificausuario = '$vidmodificausuario' where idafiliado = $idu");
				if($add){
					header("location:estadoafiliados.php?retorno=Activado correctamente");
				}else{
					header("location:estadoafiliados.php?retorno=" .mysql_error());
				}
			}
	if ($accion == "baja")
			{
				$add = mysql_query("update afiliados set activo ='N', fechaupdate = NOW(), idmodificausuario = '$vidmodificausuario' where idafiliado = $idu");
				if($add){
					header("location:estadoafiliados.php?retorno=Inactivado correctamente");
				}else{
					header("location:estadoafiliados.php?retorno=" .mysql_error());
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
					<h2>Consulta de Afiliados</h2>
					<br>

						  <input type="text" name="busqueda" class="form-control" id="busqueda" placeholder="Número de socio o nombre del socio" value="">	
						<br>
						<div id='resultado' class="table-responsive">
						  <table class="table table-striped table-bordered">
							<tr>							
							<th class="warning">Número de socio</th>
							<th class="warning">Nombre</th>
							<th class="warning">Tipo de Socio</th>
							<th class="warning">Acciones</th>
							</tr>						
							<?php 
								$usrtarget = $_SESSION['usuario'];
								$elsql="select id, nsocio, nombre, apellido, tipo from socios where estado = 'Activo' ";
								$select = mysql_query($elsql); 
							// echo $elsql;
								while($datos = mysql_fetch_array($select)) {	
								?>
								<tr>
									<td><?php echo $datos['nsocio'];?></td>
									<td><?php echo $datos['nombre'].', '.$datos['apellido'];?></td>
									<td><?php echo $datos['tipo'];?></td>
									<td>
									<div>
									<?php

									if ($datos['tipo'] == 'Civil'){
										echo '<h4><a href="cargarafiliadocivil.php?accion=modifica&idu='.$datos['id'].'&close=dor"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a></h4>';
									}else{
										if ($datos['tipo'] == 'Pensionista'){
											echo '<h4><a href="cargarafiliadopencionada.php?accion=modifica&idu='.$id['idafiliado'].'&close=dor"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a></h4>';
										}else{
											if ($datos['tipo'] == 'Militar'){
												echo '<h4><a href="cargarafiliadomilitar.php?accion=modifica&idu='.$id['idafiliado'].'&close=dor"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a></h4>';
											}
										}
									}
									?>
									</div>
									<a href="#" data-toggle="modal" data-target="#myModal" data-id="<?php echo $datos['id'];?>">
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
								<h4 class="modal-title" id="myModalLabel"><span class="label label-success">Datos del Afiliado</span></h4>
							  </div>
							  <div class="modal-body">
								<h3>Tipo de Afiliado: <span class="label label-default"><label id="lbltipo"></label></span></h3><br>
								<h3>Nombre: <span class="label label-default"><label id="lblnombre"></label></span></h3><br>
								<h3>Apellido: <span class="label label-default"><label id="lblapellido"></label></span></h3><br>
								<h3>Nacido en: <span class="label label-default"><label id="lblnacidoen"></label></span></h3><br>
								<h3>Localidad: <span class="label label-default"><label id="lbllocalidad"></label></span></h3><br>
								<h3>Fecha de Nacimiento: <span class="label label-default"><label id="lblfechanac"></label></span></h3><br>
								<h3>DNI: <span class="label label-default"><label id="lbldni"></label></span></h3><br>
								<h3>Nombre de la Calle: <span class="label label-default"><label id="lblnomcalle"></label></span></h3><br>
								<h3>N° de Calle: <span class="label label-default"><label id="lblnumcalle"></label></span></h3><br>
								<h3>Piso: <span class="label label-default"><label id="lblpiso"></label></span></h3><br>
								<h3>Dpto: <span class="label label-default"><label id="lbldpto"></label></span></h3><br>
								<h3>Barrio: <span class="label label-default"><label id="lblbarrio"></label></span></h3><br>
								<h3>Codigo Postal: <span class="label label-default"><label id="lblcodpostal"></label></span></h3><br>
								<h3>Telefono: <span class="label label-default"><label id="lbltelefono"></label></span></h3><br>
								<h3>Celular: <span class="label label-default"><label id="lblcelular"></label></span></h3><br>
								<h3>Email: <span class="label label-default"><label id="lblemail"></label></span></h3><br>
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
			url     : 'buscarafiliados.php?idafilia='+$(this).attr('data-id'),
			type    : 'POST',
			dataType: 'json',
	success: function( data ) {
			console.log(data.encontro);
			if (data.encontro =="SI")
			{
			document.getElementById("lbltipo").innerHTML = data.tipo;
			document.getElementById("lblnombre").innerHTML = data.nombre;
			document.getElementById("lblapellido").innerHTML = data.apellido;
			document.getElementById("lbldni").innerHTML = data.dni;
			document.getElementById("lblafilia").innerHTML = data.idafiliado;
			}
			else
			{
			document.getElementById("lbltipo").innerHTML = "";
			document.getElementById("lblnombre").innerHTML = "";
			document.getElementById("lblapellido").innerHTML = "";
			document.getElementById("lbldni").innerHTML = "";
			document.getElementById("lblafilia").innerHTML = "";
			}
					
							},
	error:	function( data ) {
		
			document.getElementById("lbltipo").innerHTML = "error";
			document.getElementById("lblnombre").innerHTML = "error";
			document.getElementById("lblapellido").innerHTML = "error";
			document.getElementById("lbldni").innerHTML = "error";
			document.getElementById("lblafilia").innerHTML = "error";
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
                    url: "consultarafiliados_post.php",
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
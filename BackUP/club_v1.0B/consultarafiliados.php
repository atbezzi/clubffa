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
							<th class="success">Número de socio</th>
							<th class="success">Nombre</th>
							<th class="success">Tipo de Socio</th>
							<th class="success">Acciones</th>
							<th class="success">Ver</th>
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
										echo '<h7><a href="modificarformularioscivil.php?accion=modifica&idu='.$datos['id'].'&close=dor"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a></h7>';
									}else{
										if ($datos['tipo'] == 'Pensionista'){
											echo '<h7><a href="modificarformulariospensionista.php?accion=modifica&idu='.$datos['id'].'&close=dor"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a></h7>';
										}else{
											if ($datos['tipo'] == 'Militar'){
												echo '<h7><a href="modificarformulariosmilitar.php?accion=modifica&idu='.$datos['id'].'&close=dor"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a></h7>';
											}
										}
									}
									?>
									</div>
									</td>
									<td>
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
								<h3 class="modal-title" id="myModalLabel"><span class="label label-success">Datos del Afiliado</span></h3>
							  </div>
							  <div class="modal-body">
								<h3>Tipo de Afiliado: <span class="label label-primary"><label id="lbltipo"></label></span></h3><hr>
								<h3>N° Afiliado: <span class="label label-primary"><label id="lblnsocio"></label></span></h3><hr>
								<h3>Nombre: <span class="label label-primary"><label id="lblnombre"></label></span></h3><hr>
								<h3>Apellido: <span class="label label-primary"><label id="lblapellido"></label></span></h3><hr>
								<h3>Localidad de Nacimiento: <span class="label label-primary"><label id="lbllocalidadnacimiento"></label></span></h3><hr>
								<h3>Fecha de Nacimiento: <span class="label label-primary"><label id="lblfechanacimiento"></label></span></h3><hr>
								<h3>DNI: <span class="label label-primary"><label id="lbldni"></label></span></h3><hr>
								<h3>Estado Civil: <span class="label label-primary"><label id="lblestadocivil"></label></span></h3><hr>
								<h3>Sexo: <span class="label label-primary"><label id="lblsexo"></label></span></h3><hr>
								<h3>Domicilio: <span class="label label-primary"><label id="lbldomicilio"></label></span></h3><hr>
								<h3>Barrio: <span class="label label-primary"><label id="lblbarrio"></label></span></h3><hr>
								<h3>Localidad Actual: <span class="label label-primary"><label id="lbllocaactual"></label></span></h3><hr>
								<h3>Codigo Postal: <span class="label label-primary"><label id="lblcp"></label></span></h3><hr>
								<h3>Telefono: <span class="label label-primary"><label id="lbltelefono"></label></span></h3><hr>
								<h3>Celular: <span class="label label-primary"><label id="lblcelular"></label></span></h3><hr>
								<h3>Email: <span class="label label-primary"><label id="lblemail"></label></span></h3><hr>
								<h3>Forma de Pago: <span class="label label-primary"><label id="lblformadepago"></label></span></h3><hr>
								<h3>Domicilio Cobrador: <span class="label label-primary"><label id="lbldomiciliocobrador"></label></span></h3><hr>
								<h3>Barrio Cobrador: <span class="label label-primary"><label id="lblbarriocobrador"></label></span></h3><hr>
								<h3>Localidad Cobrador: <span class="label label-primary"><label id="lbllocalidad_idcobrador"></label></span></h3><hr>
								<h3>Zona: <span class="label label-primary"><label id="lblzona_id"></label></span></h3><hr>
								<h3>Libro: <span class="label label-primary"><label id="lbllibro"></label></span></h3><hr>
								<h3>Acta: <span class="label label-primary"><label id="lblacta"></label></span></h3><hr>
								<h3>Categoria: <span class="label label-primary"><label id="lblcategoria_id"></label></span></h3><hr>
								<h3>Embarcadero: <span class="label label-primary"><label id="lblestadoembarcadero"></label></span></h3><hr>
								<h3>Estado: <span class="label label-primary"><label id="lblestado"></label></span></h3>
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
	</script>
	<script type="text/javascript">
	 $("a[data-toggle=modal]").click(function() 
    {
		console.log($(this).attr("data-id"));
		
		$.ajax({			
			url     : "buscarafiliados.php?id="+$(this).attr("data-id"),
			type    : "POST",
			dataType: "json",
	 success: function( data ){
								console.log(data.encontro);
								if (data.encontro =="SI")
								{
								document.getElementById("lbltipo").innerHTML = data.tipo;
								document.getElementById("lblnsocio").innerHTML = data.nsocio;
								document.getElementById("lblnombre").innerHTML = data.nombre;
								document.getElementById("lblapellido").innerHTML = data.apellido;
								document.getElementById("lbllocalidadnacimiento").innerHTML = data.descripcion;
								document.getElementById("lblfechanacimiento").innerHTML = data.fechanacimiento;
								document.getElementById("lbldni").innerHTML = data.dni;
								document.getElementById("lblestadocivil").innerHTML = data.estadocivil;
								document.getElementById("lblsexo").innerHTML = data.sexo;
								document.getElementById("lbldomicilio").innerHTML = data.domicilio;
								document.getElementById("lblbarrio").innerHTML = data.barrio;
								document.getElementById("lbllocaactual").innerHTML = data.descripcion2;
								document.getElementById("lblcp").innerHTML = data.cp;
								document.getElementById("lbltelefono").innerHTML = data.telefono;
								document.getElementById("lblcelular").innerHTML = data.celular;
								document.getElementById("lblemail").innerHTML = data.email;
								document.getElementById("lblformadepago").innerHTML = data.formadepago;
								document.getElementById("lbldomiciliocobrador").innerHTML = data.domiciliocobrador;
								document.getElementById("lblbarriocobrador").innerHTML = data.barriocobrador;
								document.getElementById("lbllocalidad_idcobrador").innerHTML = data.descripcion3;
								document.getElementById("lblzona_id").innerHTML = data.desczona;
								document.getElementById("lbllibro").innerHTML = data.libro;
								document.getElementById("lblacta").innerHTML = data.acta;
								document.getElementById("lblcategoria_id").innerHTML = data.desccat;
								document.getElementById("lblestadoembarcadero").innerHTML = data.estadoembarcadero;
								document.getElementById("lblestado").innerHTML = data.estado;
								}
								else
								{
								document.getElementById("lbltipo").innerHTML = "";
								document.getElementById("lblnsocio").innerHTML = "";
								document.getElementById("lblnombre").innerHTML = "";
								document.getElementById("lblapellido").innerHTML = "";
								document.getElementById("lbllocalidadnacimiento").innerHTML = "";
								document.getElementById("lblfechanacimiento").innerHTML = "";
								document.getElementById("lbldni").innerHTML = "";
								document.getElementById("lblestadocivil").innerHTML = "";
								document.getElementById("lblsexo").innerHTML = "";
								document.getElementById("lbldomicilio").innerHTML = "";
								document.getElementById("lblbarrio").innerHTML = "";
								document.getElementById("lbllocaactual").innerHTML = "";
								document.getElementById("lblcp").innerHTML = "";
								document.getElementById("lbltelefono").innerHTML = "";
								document.getElementById("lblcelular").innerHTML = "";
								document.getElementById("lblemail").innerHTML = "";
								document.getElementById("lblformadepago").innerHTML = "";
								document.getElementById("lbldomiciliocobrador").innerHTML = "";
								document.getElementById("lblbarriocobrador").innerHTML = "";
								document.getElementById("lbllocalidad_idcobrador").innerHTML = "";
								document.getElementById("lblzona_id").innerHTML = "";
								document.getElementById("lbllibro").innerHTML = "";
								document.getElementById("lblacta").innerHTML = "";
								document.getElementById("lblcategoria_id").innerHTML = "";
								document.getElementById("lblestadoembarcadero").innerHTML = "";
								document.getElementById("lblestado").innerHTML = "";
								}
							},
	 error:	function( data ){
								document.getElementById("lbltipo").innerHTML = "error";
								document.getElementById("lblnsocio").innerHTML = "error";
								document.getElementById("lblnombre").innerHTML = "error";
								document.getElementById("lblapellido").innerHTML = "error";
								document.getElementById("lbllocalidadnacimiento").innerHTML = "error";
								document.getElementById("lblfechanacimiento").innerHTML = "error";
								document.getElementById("lbldni").innerHTML = "error";
								document.getElementById("lblestadocivil").innerHTML = "error";
								document.getElementById("lblsexo").innerHTML = "error";
								document.getElementById("lbldomicilio").innerHTML = "error";
								document.getElementById("lblbarrio").innerHTML = "error";
								document.getElementById("lbllocaactual").innerHTML = "error";
								document.getElementById("lblcp").innerHTML = "error";
								document.getElementById("lbltelefono").innerHTML = "error";
								document.getElementById("lblcelular").innerHTML = "error";
								document.getElementById("lblemail").innerHTML = "error";
								document.getElementById("lblformadepago").innerHTML = "error";
								document.getElementById("lbldomiciliocobrador").innerHTML = "error";
								document.getElementById("lblbarriocobrador").innerHTML = "error";
								document.getElementById("lbllocalidad_idcobrador").innerHTML = "error";
								document.getElementById("lblzona_id").innerHTML = "error";
								document.getElementById("lbllibro").innerHTML = "error";
								document.getElementById("lblacta").innerHTML = "error";
								document.getElementById("lblcategoria_id").innerHTML = "error";
								document.getElementById("lblestadoembarcadero").innerHTML = "error";
								document.getElementById("lblestado").innerHTML = "error";
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
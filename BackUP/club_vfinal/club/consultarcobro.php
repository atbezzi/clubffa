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
	
	if($_SESSION['tipo'] != 'Tesorero' AND $_SESSION['tipo'] != 'SA'){
	header("location:index.php?retorno=no_acess");
	} else{
		
	}
	
	$accion = $_REQUEST['accion'];
	$idu = $_REQUEST['idu'];
	$vidmodificausuario = $_SESSION['usuario'];
	if ($accion == "anular")
			{
				$add = mysql_query("update pagos set estado = 'Anulado', fechaupdate = NOW(), idmodificausuario = '$vidmodificausuario' where id = $idu");
				$add2 = mysql_query("update pago_detalle set estado = 'Anulado', fechaupdate = NOW(), idmodificausuario = '$vidmodificausuario' where pago_id = $idu");
				if($add){
					if($add2){
						header("location:consultarcobro.php?retorno=Anulado correctamente");
					}else{
						header("location:consultarcobro.php?retorno=" .mysql_error());
					}
				}else{
					header("location:consultarcobro.php?retorno=" .mysql_error());
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
<form id="frm" method="post">
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
					<h2>Consulta de cobros</h2>
					<br>
					<input type="text" name="busqueda" class="form-control" id="busqueda" placeholder="Recibo, numero de socio" value="">
						<br>
						Referencias:<br>
						<span class="label label-primary"><span class="glyphicon glyphicon-print" aria-hidden="false"></span> Imprimir</span>
						<br><br>
						<div id="resultado" class="table-responsive">
							<table class="table table-striped table-bordered">
								<tr>							
									<th class="success text-center">Fecha pago</th>
									<th class="success text-center">Recibo</th>
									<th class="success text-center">Detalle</th>
									<th class="success text-center">Imp. total</th>
									<th class="success text-center">Número de socio</th>
									<th class="success text-center">Nombre del socio</th>
									<th class="success text-center">Imprimir</th>
								</tr>						
								<?php 
									$usrtarget = $_SESSION['usuario'];
									$elsql="SELECT p.id as idu, DATE_FORMAT(p.fechapago,'%d/%m/%Y') as fecha, p.recibo as recibo, p.detalle as detalle, p.importe as imptotal, s.nsocio as numsocio, s.nombre as nomsocio, 
									s.apellido as apellidosocio FROM cobros p INNER JOIN socios s ON s.id = p.socio_id WHERE p.estado = 'Pago' ORDER by p.fechapago DESC";
									$select = mysql_query($elsql); 
								// echo $elsql;
									while($datos = mysql_fetch_array($select)) {	
									?>
									<tr>
										<td class="text-center"><?php echo $datos['fecha'];?></td>
										<td class="text-center"><?php echo $datos['recibo'];?></td>
										<td class="text-center"><?php echo $datos['detalle'];?></td>
										<td class="text-right"><?php echo "$".$datos['imptotal'];?></td>
										<td class="text-center"><?php echo $datos['numsocio'];?></td>
										<td class="text-left"><?php echo $datos['nomsocio'].', '.$datos['apellidosocio'];?></td>
										<td class="text-center">
										<span class="label label-primary text-center">
										<a href="buscarimprimircobrosconsultas.php?accion=imprimir&idu=<?php echo $datos['idu'];?>&close=dor" target="_blank">
										<font color=white><span class="glyphicon glyphicon-print" aria-hidden="true"></span></font></a>
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
                    url: "consultarcobro_post.php",
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
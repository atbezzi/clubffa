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
	
	if($_SESSION['tipo'] != 'Secretario'){
		header("location:index.php?retorno=no_acess");
	} else{
		
	}
	
	$idf= $_REQUEST['idf'];
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
<body onload="imprimir();">
<div id="container">
	<div class="visible-xs" style="height:70px;"></div>
	<div class="visible-sm" style="height:30px;"></div>
	<div class="row" style="max-width:100%; margin-left:0px; margin-right:0px;">
		<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
		</div>
		<div class="col-md-8 col-lg-8 col-xs-12 col-sm-12">
			<div class="main1">
				<div class="content">
					<h2><u>Carnet de asosciado</u></h2>
					<br>
					<form id="frmcarga" name="frmcarga" method="post" action="reportedeingresos_post.php">
						<div class="col-lg-4 col-md-6 form-group text-center">
							<!-- Va algo aca -->
						</div>
						<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
							<div class="main1">
								<div class="content">						
									<?php
									$qhacemos = "nuevo";
									$idf = $_REQUEST['idf'];
									$accion = $_REQUEST['accion'];
									if ($accion =="imprimir")
											{
											$elsql="select s.nsocio, s.foto, CONCAT(s.apellido, ', ', s.nombre) as nombre, s.dni, c.descripcion, p.descripcion as plan, 
											ps.vencimiento from planes p inner join plan_socio ps on ps.plan_id = p.id inner join socios s on s.id = ps.socio_id 
											inner join categorias c on c.id = s.categoria_id where ps.id = '$idf'";
											$select = mysql_query($elsql); 
											// echo $elsql;
											while($datos = mysql_fetch_array($select)) {	
											?>
												<div class="css-shapes-preview">
													<div class="verticalLine text-center">
														Este carnet pertenece al socio que figura en la <br>
														descripción miembro del Club de las Fuerzas <br>
														Armadas de Córdoba. En caso de perdida o <br>
														extravió se ruega devolver al dueño o sino <br>
														contactarse con el club: <br>
														Teléfono: +54 0351 4608763 <br>
														Dirección: Avenida Concepción Arenal 10 <br>
														Córdoba, Argentina <br>
														Mail: cffaacba@gmail.com.ar
													</div>
													&nbsp;<img class="img-rounded" src="foto\socio\<?php echo $datos['foto'];?>" width="50px" height="50px">
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Club FFAA - Córdoba &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													&nbsp;<img class="img-rounded" src="img\logo.jpg" width="50px" height="50px"><hr>
													<h5 class="text-right"> &nbsp; <b><?php echo $datos['plan'];?></b> &nbsp;</h5>
													<h5 class="text-left"> &nbsp; <?php echo $datos['nsocio'];?> &nbsp;-&nbsp; <?php echo $datos['nombre'];?> &nbsp;</h5>
													<h5 class="text-left"> &nbsp; <?php echo $datos['descripcion'];?> &nbsp;</h5>
													<h5 class="text-left"> &nbsp; <?php echo $datos['dni'];?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Vto: <?php echo $datos['vencimiento'];?> &nbsp;</h5>
												</div>
											<?php
											} ;
										}
									?>
								</div>
							</div>
						</div>
						<input type="hidden" id="usuariocarga" name="usuariocarga" value="<?php echo $_SESSION['usuario']; ?>">
					</form>
				</div>
			</div>
			<br><br>
		</div>
	</div>
	<br><br>
</div>
	<!-- /#wrapper -->
	<!-- jQuery -->
	<script src="js/jquery.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<!-- Dibujo carnet -->
	<style>
	.rectangulo {
		 width: 250px; 
		 height: 100px; 
		 border: 3px solid #555;
	}
	.css-shapes-preview{ 
		position: relative; 
		height: 200px; 
		width: 700px; 
		padding: 5px 0px 0px 10px; 
		background-color: #FFFFFF; 
		border-radius: 0px; 
		top: -25px; 
		left: 25px; 
		transform: rotate(0deg) skew(0deg); 
		-webkit-transform: rotate(0deg) skew(0deg); 
		border-top: 3px double #000000; 
		border-left: 3px double #000000;
		border-right: double #000000; 
		border-bottom: 3px double #000000; 
	}
	.verticalLine {
		float: right;
		padding: 0px 20px 5px 30px;
		border-left: thick solid #000000;
	}
	</style>
	<!-- Menu Toggle Script -->
	<script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
	</script>
	<script type="text/javascript">
            function imprimir() {
                if (window.print) {
                    window.print();
                } else {
                    alert("La función de impresion no esta soportada por su navegador.");
                }
				window.close();
            }
    </script>
</body>
</html>
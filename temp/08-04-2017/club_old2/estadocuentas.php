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
	
	if($_SESSION['tipo'] != 'T' AND $_SESSION['tipo'] !='F'){
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
  <title>Club de las Fuerzas Armadas de Cordoba</title>
	<!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<!-- menu lateral -->
	<link href="css/menulateral.css" rel="stylesheet">
	<!-- menu lateral -->
	<link href="css/animate.css" rel="stylesheet">
	<!-- menu lateral -->
	<link href="css/noticiasstyle.css" rel="stylesheet">
	<!-- Switch Butoom -->
	<link href="css/bootstrap-switch.css" rel="stylesheet">
	<link href="css/chosen.min.css" rel="stylesheet">
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
					<h2>Afiliados Deudores</h2>
					<br>
					<input type="checkbox" name="my-checkbox1" value="T" data-label-text="Morosos" >
					<br><br>
						<div class="table-responsive" name="resultado" id="resultado">
						  <table class="table table-striped table-bordered">
							<tr>
							<th class="warning">Id Socio</th>
							<th class="warning">Nombre</th>
							<th class="warning">Apellidos</th>
							<th class="warning">DNI</th>
							<th class="warning">Tipo de Afiliado</th>
							<th class="warning">Fecha Ultimo Pago</th>
							<th class="warning">Meses Adeudados</th>
							<th class="warning">Importe Adeudado</th>
							</tr>
							<?php 
								$usrtarget = $_SESSION['usuario'];
								$elsql="SELECT idafiliado, nombre, apellido, dni, tipo from afiliados order by idafiliado desc";
								$select = mysql_query($elsql); 
							// echo $elsql;
								while($datos = mysql_fetch_array($select)) {	
								?>
								<tr>
									<td><?php echo $datos['idafiliado'];?></td>
									<td><?php echo $datos['nombre'];?></td>
									<td><?php echo $datos['apellido'];?></td>
									<td><?php echo $datos['dni'];?></td>
									<td><?php echo $datos['tipo'];?></td>
									<td>null</td>
									<td>null</td>
									<td>null</td>
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
		
		 
	</div>
</div>
	<!-- /#wrapper -->
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>
	<!-- jQuery -->
	<script src="js/jquery.js"></script>
	<!-- Switch Butoom -->
	<script src="js/highlight.js"></script>
	<script src="js/bootstrap-switch.js"></script>
	<!-- Menu Toggle Script -->
	<script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
	</script>

	<script type="text/javascript">
		$(document).ready(function() {
		$('input[name="my-checkbox1"]').on('switchChange.bootstrapSwitch', function(event, state) {
		 // console.log(this); // DOM element
		 // console.log(event); // jQuery event
		  console.log(state); // true | false
		  console.log(this.value);
		  var toto = 0;
		  if (state == true){
			 toto = 1;
			 }
			 var res = this.value.split("#"); 
			 $.ajax({
							url: 'listarmorosos.ajax.php?info='+toto+'&tipo='+this.value,
							type    : 'POST',
							dataType: 'json',
							data: $('#frmcarga').serialize(),
							success: 
								function( data ) {
									//alert(data);
									var salida ="<table class='table table-striped table-bordered'> <tr> <th class='warning'>Id Socio</th> <th class='warning'>Nombre</th> <th class='warning'>Apellidos</th> <th class='warning'>DNI</th> <th class='warning'>Tipo de Afiliado</th> <th class='warning'>Fecha Ultimo Pago</th> <th class='warning'>Meses Adeudados</th> <th class='warning'>Importe Adeudado</th> </tr>";
									$.each(data, function(i, item) {
									console.log(item);
									//console.log(item[3] +'-'+item[5]); nobarman
									salida=salida + '<tr> <td>'+item[0]+'</td> <td>'+item[1]+'</td> <td>'+item[2]+'</td><td>'+item[3]+'</td> <td>'+item[4]+'</td> <td>'+item[5]+'</td> <td>'+item[6]+'</td> <td>'+item[7]+'</td> </tr>';
								 });
								 document.getElementById("resultado").innerHTML = salida + '</tbody></table>' ;
								},
								error:
								function( data ) {
									alert("ocurrio un error inesperado, por favor consultar con soporte tecnico");
								}
						});
			});
	(function() {
	  var $confirm;
	  $confirm = null;
	  $(function() {
		var $createDestroy, $window, sectionTop;
		$window = $(window);
		sectionTop = $(".top").outerHeight() + 20;
		$createDestroy = $("#switch-create-destroy");
		hljs.initHighlightingOnLoad();
		$("a[href*=\"#\"]").on("click", function(event) {
		  var $target;
		  event.preventDefault();
		  $target = $($(this).attr("href").slice("#"));
		  if ($target.length) {
			return $window.scrollTop($target.offset().top - sectionTop);
		  }
		});
		$("input[type=\"checkbox\"], input[type=\"radio\"]").not("[data-switch-no-init]").bootstrapSwitch();
		$("[data-switch-get]").on("click", function() {
		  var type;
		  type = $(this).data("switch-get");
		  return alert($("#switch-" + type).bootstrapSwitch(type));
		});
		$("[data-switch-set]").on("click", function() {
		  var type;
		  type = $(this).data("switch-set");
		  return $("#switch-" + type).bootstrapSwitch(type, $(this).data("switch-value"));
		});
		$("[data-switch-toggle]").on("click", function() {
		  var type;
		  type = $(this).data("switch-toggle");
		  return $("#switch-" + type).bootstrapSwitch("toggle" + type.charAt(0).toUpperCase() + type.slice(1));
		});
		$("[data-switch-set-value]").on("input", function(event) {
		  var type, value;
		  event.preventDefault();
		  type = $(this).data("switch-set-value");
		  value = $.trim($(this).val());
		  if ($(this).data("value") === value) {
			return;
		  }
		  return $("#switch-" + type).bootstrapSwitch(type, value);
		});
		$("[data-switch-create-destroy]").on("click", function() {
		  var isSwitch;
		  isSwitch = $createDestroy.data("bootstrap-switch");
		  $createDestroy.bootstrapSwitch((isSwitch ? "destroy" : null));
		  return $(this).button((isSwitch ? "reset" : "destroy"));
		});
		return $confirm = $("#confirm").bootstrapSwitch({
		  size: "large",
		  onSwitchChange: function(event, state) {
			event.preventDefault();
			return console.log(state, event.isDefaultPrevented());
		  }
		});
	  });
	 }).call(this);
			});
	</script>
</body>
</html>
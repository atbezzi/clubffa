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
	
	if($_SESSION['tipo'] != 'Tesorero'){
		header("location:index.php?retorno=no_acess");
	} else{
		
	}
/*	$qhacemos="nuevo";
	$idcli= $_REQUEST['idcli'];
	$accion = $_REQUEST['accion'];
	if ($accion =="inactiva")
			{
				$add = mysql_query("update clientes set activo = 'N' where idcliente = $idcli");
				if($add){
					header("location:adminclientes.php?retorno=Inactivado correctamente");
				}else{
					header("location:adminclientes.php?retorno=" .mysql_error());
				}
			}
	if ($accion =="modifica")
			{
				$resp = mysql_query("select * from clientes where idcliente = $idcli");
				while($datos = mysql_fetch_array($resp)) {
					$qhacemos="modifica";
					$vnombre= $datos['nombrecompleto'];
					$vdni=$datos['dni'];;
					$vtel= $datos['telefono'];;
					$vmail= $datos['email'];;
				}
			}
*/?>
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
	<style type="text/css">
#containergraficos {
	min-width: 310px;
	max-width: 800px;
	height: 400px;
	margin: 0 auto
}
		</style>
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
					<h2><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Reporte de ingresos</h2>
					<br>
					Referencia:<br>
					<span class="label label-primary"><span class="glyphicon glyphicon-print" aria-hidden="false"></span> Imprimir ingresos</span>
					<br><br>
					<form id="frmcarga" name="frmcarga" method="post" action="#">
						<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
							<div class="main1">
								<div class="content">
									<div class="table-responsive">
										<div class="col-lg-4 col-md-6 col-sx-12 form-group text-center">
										<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Fecha desde:</label>
										<input type="text" name="fechadesde" class="form-control" id="fechadesde" placeholder="Fecha desde" value="<?php echo $vfechadesde;?>">
										</div>
										<div class="col-lg-4 col-md-6 col-sx-12 form-group text-center">
										<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Fecha hasta:</label>
										<input type="text" name="fechahasta" class="form-control" id="fechahasta" placeholder="Fecha hasta" value="<?php echo $vfechahasta;?>">
										<input style="margin-top: 10px; text-align:center" id="cargar" name="cargar" type="button" class="pull-right botoncss" value="Cargar" >
										</div><br><br><br><br><br><br><br><br>
										<div class="alert alert-success" role="alert"><strong>Reporte de ingresos mensuales por mes</strong></div>
										<table id="tableta" class="table table-striped table-bordered">
											<tr>							
											<th class="success text-center">Fecha</th>
											<th class="success text-center">Imp. total</th>
											<th class="success text-center">Imprimir</th>
											</tr>
										</table><br><br><br><br><br>
										<div class="col-md-8 text-center">
										<!-- grafico 1 ingresos -->
										<div id="containergraficos"></div>
										</div>
									</div>
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
<div class="col-md-1 col-lg-1 col-xs-12 col-sm-12">
</div>
	<!-- /#wrapper -->
	<!-- jQuery -->
	<script src="js/jquery.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<!-- Grafios -->
	<script src="graficos/highcharts.js"></script>
	<script src="graficos/modules/exporting.js"></script>
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
			$('#fechadesde').datepicker({
				format: "yyyy-mm", 
				endDate: "+0d",
				minViewMode: "months",
				autoclose: true,
			}); 
			 
		});
	</script>
	<script type="text/javascript">
		// When the document is ready
		$(document).ready(function ()
		{
			$('#fechahasta').datepicker({
				format: "yyyy-mm", 
				endDate: "+0d",
				minViewMode: "months",
				autoclose: true,
			}); 
			 
		});
	</script>
	<script type="text/javascript">
			jQuery('#frmcarga').on('click', '#cargar', function(event) {
				if(document.getElementById("fechadesde").value.trim() != ""){
					if(document.getElementById("fechahasta").value.trim() != ""){
						prevgraf();
					}else{
						alert("Debe ingresar una fecha");
					}
				}else{
					alert("Debe ingresar una fecha");
				}
			});
	</script>
	<script type="text/javascript">
		function validarNumeros(e) { // 1
		
		tecla = (document.all) ? e.keyCode : e.which; // 2
		
		if (tecla==8) return true; // backspace
			if (tecla==9) return true; // backspace
			if (tecla==110) return true; // punto
		if (e.ctrlKey && tecla==86) { return true}; //Ctrl v
		if (e.ctrlKey && tecla==67) { return true}; //Ctrl c
		if (e.ctrlKey && tecla==88) { return true}; //Ctrl x
		if (tecla>=96 && tecla<=105) { return true;} //numpad
		 
		patron = /[0-9]/; // patron
		 
		te = String.fromCharCode(tecla);
		return patron.test(te); // prueba
		}
	</script>
	<script type="text/javascript">
	function prevgraf(){
		
		var desde = document.getElementById("fechadesde").value;
		var hasta = document.getElementById("fechahasta").value;
		var todojunto = new Array();
		var series = new Array();
				
	$.ajax({
		data: {"desde": desde, "hasta": hasta},
		type    : 'POST',
		dataType: 'json',
		url: 'buscardatosgrafreporte.php',
		success: 
			function( data ) {
				for(var i=0;i<data.length; i++)
                           {
								if((i+1)==data.length){
									todojunto = todojunto+'["'+data[i].fecha+'",'+data[i].total+']';
								}else{
									todojunto = todojunto+'["'+data[i].fecha+'",'+data[i].total+'],';
								}

                           }
				//tablaaaaaaaaaaaaaaa
				var html='';
				// si la consulta ajax devuelve datos
				html += '<tr>'
							html += '<th class="success text-center">Fecha</th>'
							html += '<th class="success text-center">Imp. total</th>'
							html += '<th class="success text-center">Imprimir</th>'
						html += '</tr>';
				if(data.length > 0){
				  $.each(data, function(i,item){
					  html += '<tr>'
							html += '<td class="text-center">'+item.fecha+'</td>'
							html += '<td class="text-right">$'+item.total+'</td>'
							html += '<td class="text-center"><span class="label label-primary text-center"><a href="buscarimprimirrepingreso.php?accion=imprimir&idp='+item.fecha+'&close=dor" target="_blank"><font color=white><span class="glyphicon glyphicon-print" aria-hidden="true"></span></font></a></span></td>'
						html += '</tr>';
					});
				} 
				// si no hay datos mostramos mensaje de no encontraron registros
				if(html == '') html = '<tr><td colspan="6">No se encontraron registros..</td></tr>'
				// añadimos  a nuestra tabla todos los datos encontrados mediante la funcion html
				$("#tableta tbody").html(html);
			
				Highcharts.chart('containergraficos', {
				chart: {
					type: 'column'
				},
				title: {
					text: 'Importe Mensuales'
				},
				subtitle: {
					text: 'CFFAA CBA'
				},
				xAxis: {
					type: 'category'
				},
				yAxis: {
					min: 0,
					title: {
						text: 'Ingresos ($)'
					}
				},
				tooltip: {
					headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
					pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
						'<td style="padding:0"><b>{point.y} </b></td></tr>',
					footerFormat: '</table>',
					shared: true,
					useHTML: true
				},
				plotOptions: {
					column: {
						pointPadding: 0.2,
						borderWidth: 0
					}
				},
				series: [{
					name: 'Importe Total',
					data: []

				}]
			});
			todojunto = JSON.parse("["+todojunto+"]");
			$("#containergraficos").highcharts().series[0].setData(todojunto);
			},
			
		error:
			function( data ) {
				alert("ocurrio un error inesperado, por favor consultar con soporte tecnico");
			}
		
	});
	}
	</script>
</body>
</html>
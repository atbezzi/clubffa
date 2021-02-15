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
	$qhacemos = "nuevo";
	$idu = $_REQUEST['idu'];
	$accion = $_REQUEST['accion'];
	if ($accion =="buscar")
			{
				$resp = mysql_query("select * from socios where nsocio = $idu");
				while($datos = mysql_fetch_array($resp)) {
					$qhacemos = "buscar";
					$vnsocio = $datos['nsocio'];
					$vnombre = $datos['nombre'];
					$vapellido = $datos['apellido'];
					$vdni = $datos['dni'];
					$vformapago = $datos['formadepago'];
				}
			}
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
					<h2><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Cargar cobro</h2>
					<br>
					<form id="frmcarga" name="frmcarga" method="post">
						<div class="col-lg-6 col-md-6 form-group text-left">
							<label for="title" class="col-sm-12 control-label">&nbsp;Número de socio: <span class="label label-success"><?php echo $vnsocio;?></span></label>
							<label for="title" class="col-sm-12 control-label">&nbsp;Nombre de socio: <span class="label label-success"><?php echo $vnombre;?></span></label>
							<label for="title" class="col-sm-12 control-label">&nbsp;Apellido de socio: <span class="label label-success"><?php echo $vapellido;?></span></label>	
							<label for="title" class="col-sm-12 control-label">&nbsp;DNI de socio: <span class="label label-success"><?php echo $vdni;?></span></label>
							<label for="title" class="col-sm-12 control-label">&nbsp;Forma de pago: <span class="label label-success"><?php echo $vformapago;?></span></label><br>
						</div>
						<br><br><br><br><br><br><br>
						<div class="col-lg-4 col-md-6 col-sx-12 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Periodo:</label>
						<input type="text" name="periodo" class="form-control" id="periodo" placeholder="Periodo" value="<?php echo $vperiodo;?>">
						</div>
						<div class="col-lg-4 col-md-6 col-sx-12 form-group text-center">
						<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-search"></span>&nbsp;Cuota:</label>
								<select class="form-control" name="cuota" id="cuota" placeholder="Cuota" value="<?php echo $vcuota;?>">
									<option value="0"> - Seleccione - </option>
									<option value="Inscripcion">Inscripcion</option>
									<option value="Cuota">Cuota</option>
									<option value="Servicio">Servicio</option>
								</select>
						</div>
						<div class="col-lg-4 col-md-6 col-sx-12 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Detalle:</label>
						<input type="text" name="detalle" class="form-control" id="detalle" placeholder="Detalle" value="<?php echo $vdetalle;?>">
						</div>
						<div class="col-lg-4 col-md-6 col-sx-12 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Importe:</label>
						<input type="text" name="importe" class="form-control" id="importe" onkeydown="return validarNumeros(event)" placeholder="Importe" value="<?php echo $vimporte;?>">
						</div>
						<div style="padding-left:15px;padding-right:15px">
							<input style="margin-top: 10px; text-align:center" id="cargar" name="cargar" type="button" class="pull-right botoncss" value="Cargar" >
						</div>
						<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
							<div class="main1">
								<div class="content">
									<div class="table-responsive">
										<table id="tableta" class="table table-striped table-bordered">
											<tr id="tablita">
											<th class="success">Periodo</th>
											<th class="success">Cuota</th>
											<th class="success">Detalle</th>
											<th class="success">Importe</th>
											<th class="success">Acciones</th>
											</tr>
										</table>
									</div>
								</div>
							</div>
							<label for="title" class="control-label">Importe total: $</label><label id="totales" for="title" class="control-label">0</label>
						</div>
					</form>
					<form id="frmguardar" name="frmguardar" method="post" action="#">
						<div class="col-lg-4 col-md-6 col-sx-12 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Fecha:</label>
						<input type="text" name="fechapago" class="form-control" id="fechapago" placeholder="Fecha de pago" value="<?php echo $vfechapago;?>">
						</div>
						<div class="col-lg-4 col-md-6 col-sx-12 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Recibo:</label>
						<input type="text" name="recibo" class="form-control" id="recibo" placeholder="Recibo" value="<?php echo $vrecibo;?>">
						</div>
						<div style="padding-left:15px;padding-right:15px">
							<input type="hidden" id="qhacemos" name="qhacemos" value="<?php echo $qhacemos;?>" />
							<input type="hidden" id="idu" name="idu" value="<?php echo $idu;?>" />
							<div id="retorno" name="retorno" style="font-size:20px; color:#F60; background-color:#fff" class="pull-left"><?php if(isset($_GET['retorno'])){ echo $_GET['retorno'];}?></div>
							<input style="margin-top: 10px; text-align:center" id="guardar" name="guardar" type="button" class="pull-right botoncss" value="Guardar" >
							<br><br><br><br><br><br>
						</div>
				</div>
						<input type="hidden" id="usuariocarga" name="usuariocarga" value="<?php echo $_SESSION['usuario']; ?>">
					</form>
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
			$('#fechapago').datepicker({
				format: "yyyy-mm-dd", 
				endDate: "+0d",
				autoclose: true,
			}); 
			 
		});
	</script>
	<script type="text/javascript">
		// When the document is ready
		$(document).ready(function ()
		{
			$('#periodo').datepicker({
				format: "yyyy-mm-dd", 
				endDate: "+0d",
				autoclose: true,
			}); 
			 
		});
	</script>
	<script type="text/javascript">
			jQuery('#frmcarga').on('click', '#cargar', function(event) {
				if(document.getElementById("periodo").value.trim() != ""){
					if(document.getElementById("cuota").value.trim() != 0){
						if(document.getElementById("detalle").value.trim() != ""){
							if(document.getElementById("importe").value.trim() != ""){
								var d = '<tr id="tablita">'+
								'<td id="tdperiodo"><input type="text" name="periodo" class="form-control" id="periodo" value="'+document.getElementById("periodo").value.trim()+'" disabled="disabled"></td>'+
								'<td id="tdcuota"><input type="text" name="cuota" class="form-control" id="cuota" value="'+document.getElementById("cuota").value.trim()+'" disabled="disabled"></td>'+
								'<td id="tddetalle"><input type="text" name="detalle" class="form-control" id="detalle" value="'+document.getElementById("detalle").value.trim()+'" disabled="disabled"></td>'+
								'<td id="tdimporte"><input type="text" name="importe" class="form-control" id="importe" value="'+parseFloat(document.getElementById("importe").value.trim()).toFixed(2)+'" disabled="disabled"></td>'+
								'<td id="tdacciones">'+'<button type="button" class="btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>'+'</td>'+
								'</tr>';
								$("#tableta").append(d);
								document.getElementById("periodo").value = "";
								document.getElementById("cuota").value = 0;
								document.getElementById("detalle").value = "";
								document.getElementById("importe").value = "";
								calculartotal('tableta');
							}else{
								alert("Debe ingresar un importe");
							}
						}else{
							alert("Debe ingresar un detalle");
						}
					}else{
						alert("Debe seleccionar una cuota");
					}
				}else{
				alert("Debe ingresar un periodo");
			}
		});
	</script>
	 <script type="text/javascript">	
	$(document).on('click', '.btn-danger', function (event) {
	   event.preventDefault();
	   $(this).closest('tr').remove();
	   calculartotal('tableta');
	   });
	</script>
	<script type="text/javascript">
			jQuery('#frmguardar').on('click', '#guardar', function(event) {
				if(document.getElementById("tableta").rows.length > 1){
					if(document.getElementById("fechapago").value.trim() != ""){
						if(document.getElementById("recibo").value.trim() != ""){
							grabaTodoTabla('tableta');
						}else{
							alert("Debe ingresar un recibo");
						}
					}else{
						alert("Debe ingresar una fecha de pago");
					}
				}else{
					alert("Debe cargar al menos un valor en la tabla");
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
		function calculartotal(ID){
			var total = 0;
			for (var i=1;i < document.getElementById(ID).rows.length; i++){
			sum = document.getElementById(ID).rows[i].cells[3].children[0].value;
            total = (parseFloat(total) + parseFloat(sum)).toFixed(2) ;              
     } 
   document.getElementById('totales').innerHTML = total ;            
     }
   
		
	</script>
	<script type="text/javascript">
	// Actualiza de manera masiva todos los archivos cargados en la tercera pestaña.
	function grabaTodoTabla(ID){
		//tenemos 2 variables, la primera será el Array principal donde estarán nuestros datos y la segunda es el objeto tabla
		var DATA = [];
		var TABLA = $("#"+ID+" tbody > tr");

		vnsocio = <?php echo $vnsocio; ?>;
		DATA.push(vnsocio);
		vrecibo = document.getElementById("recibo").value;
		DATA.push(vrecibo);
		vfechapago = document.getElementById("fechapago").value;
		DATA.push(vfechapago);
		vusuariocarga = document.getElementById("usuariocarga").value;
		DATA.push(vusuariocarga);
		vtotalimporte = document.getElementById("totales").innerHTML;
		DATA.push(vtotalimporte);
		//una vez que tenemos la tabla recorremos esta misma recorriendo cada TR y por cada uno de estos se ejecuta el siguiente codigo
		TABLA.each(function(){
			//por cada fila o TR que encuentra rescatamos 3 datos, el ID de cada fila, la Descripción que tiene asociada en el input text, y el valor seleccionado en un select
			var PER = $(this).find("input[id*='periodo']").val(),
				CUOT = $(this).find("input[id*='cuota']").val(),
				DET = $(this).find("input[id*='detalle']").val(),
				IMP = $(this).find("input[id*='importe']").val();

			//entonces declaramos un array para guardar estos datos, lo declaramos dentro del each para así reemplazarlo y cada vez
			item = {};
			//si miramos el HTML vamos a ver un par de TR vacios y otros con el titulo de la tabla, por lo que le decimos a la función que solo se ejecute y guarde estos datos cuando exista la variable ID, si no la tiene entonces que no anexe esos datos.
			if(PER !== ''){
				item ["periodo"] = PER;
				item ["cuota"] = CUOT;
				item ['detalle'] = DET;
				item ['importe'] = IMP;
				//una vez agregados los datos al array "item" declarado anteriormente hacemos un .push() para agregarlos a nuestro array principal "DATA".
				DATA.push(item);
			}
		});
		
		console.log(DATA);

		//eventualmente se lo vamos a enviar por PHP por ajax de una forma bastante simple y además convertiremos el array en json para evitar cualquier incidente con compativilidades.
		INFO = new FormData();
		aInfo = JSON.stringify(DATA);

		INFO.append('data', aInfo);
		
		$.ajax({
			data: INFO,
			type: 'POST',
			url : './cargarcobrodos_post.php',
			processData: false, 
			contentType: false,
			success: function(r){
				window.open('buscarimprimircobros.php?accion=imprimir&idu=<?php echo $vnsocio; ?>&close=dor', '_blank');
				window.location.href = "cargarcobro.php";
			}
		});
	}//Fin funcion
	</script>
</body>
</html>

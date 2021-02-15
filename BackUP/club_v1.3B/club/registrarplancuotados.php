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
	$qhacemos="nuevo";
	$ids= $_REQUEST['ids'];
	$accion = $_REQUEST['accion'];

	if ($accion =="buscar")
			{
				$resp = mysql_query("select s.id as idsocio, s.nombre as nombre, s.apellido as apellido, s.dni as dni, c.id as idcat, c.descripcion as categoria from socios s inner join categorias c on c.id = s.categoria_id where nsocio = $ids");
				while($datos = mysql_fetch_array($resp)) {
					$qhacemos ="modifica";
					$vnombre = $datos['nombre'];
					$vapellido = $datos['apellido'];
					$vdni = $datos['dni'];
					$vcategoria = $datos['categoria'];
					$catid = $datos['idcat'];
					$idsocio = $datos['idsocio'];
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
					<h2><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Registrar plan de cuota</h2>
					<br>
					<form id="frmcarga" name="frmcarga" method="post" action="registrarplancuota_post.php">
						<div id=resultado class="col-lg-12 col-md-12 form-group text-left">
						<label for="title" class="col-sm-12 control-label">&nbsp;Nombre del socio: <span class="label label-success"><?php echo $vnombre;?></span></label>
						<label for="title" class="col-sm-12 control-label">&nbsp;Apellido del socio: <span class="label label-success"><?php echo $vapellido;?></span></label>	
						<label for="title" class="col-sm-12 control-label">&nbsp;DNI del socio: <span class="label label-success"><?php echo $vdni;?></span></label>
						<label for="title" class="col-sm-12 control-label">&nbsp;Categoría: <span class="label label-success"><?php echo $vcategoria;?></span></label>
						</div>
						<div class="col-lg-8 col-md-6 form-group text-center">
							<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Tipo de planes:</label>
							<div class="col-sm-12">
								<?php
								$res=mysql_query("select id, descripcion, cantidad_cuota, importe, cantidad_familiar from planes where categoria_id = '$catid'");
								?>
								<select type="text" name="tipoplan" class="form-control" id="tipoplan" onChange="recargadiv();" placeholder="Selecciona un plan" value="<?php echo $vtipoplanes;?>">
								<option value="">Seleccione</option>
								<?php
								while($fila=mysql_fetch_array($res)){
								?>
								<option value="<?php echo $fila['id']; ?>"><?php echo $fila['descripcion'].' - ('.$fila['cantidad_cuota'].' Cuotas)'; ?></option>
								<?php }
								?>
								</select>
								<div class="col-lg-6 col-md-6 form-group text-center">
								<label for="title" class="col-sm-12 control-label">Importe:</label>
									<input type="text" class="form-control text-right" id="precioplan" name="precioplan" value="$0 <?php echo $vprecioplan;?>" disabled="disabled"/>
								</div>
								<div class="col-lg-6 col-md-6 form-group text-center">
								<label for="title" class="col-sm-12 control-label">Familiares:</label>
									<input type="text" class="form-control text-right" id="cantfamilia" name="cantfamilia" value="0 <?php echo $vcantfamilia;?>" disabled="disabled"/>
								</div>
								
							</div>
						</div>
						<div class="col-lg-8 col-md-6 form-group text-center">
							<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Familiares:</label>
							<div class="col-sm-12">
								<?php
								$res=mysql_query("select id, nombre, apellido, socio_id from familiares where estado = 'Activo' and socio_id = '$idsocio'");
								?>
								<select type="text" name="parentescosocio" class="form-control" id="parentescosocio" onChange="buscarfamiliares();" placeholder="Selecciona un plan" value="<?php echo $vtipoplanes;?>">
								<option value="">Seleccione</option>
								<?php
								while($fila=mysql_fetch_array($res)){
								?>
								<option value="<?php echo $fila['id']; ?>"><?php echo $fila['apellido'].', '.$fila['nombre']; ?></option>
								<?php }
								?>
								</select>
								<input type="hidden" id="familiar_id" name="familiar_id" value="" />
								<input type="hidden" id="nombreyape" name="nombreyape" value="" />
								<input type="hidden" id="dnifamilia" name="dnifamilia" value="" />
								<input type="hidden" id="fechanac" name="fechanac" value="" />
								<input type="hidden" id="pariente" name="pariente" value="" />
							</div>
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
											<th class="success">ID</th>
											<th class="success">Nombre y apellido</th>
											<th class="success">DNI</th>
											<th class="success">Fecha de nacimiento</th>
											<th class="success">Parentesco</th>
											<th class="success">Acciones</th>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</div>
					</form>
					<form id="frmguardar" name="frmguardar" method="post" action="registrarplancuota_post.php">
						<div style="padding-left:15px;padding-right:15px">
							<input type="hidden" id="qhacemos" name="qhacemos" value="<?php echo $qhacemos;?>" />
							<input type="hidden" id="ids" name="ids" value="<?php echo $ids;?>" />
							<input type="hidden" id="planid" name="planid" value="" />
							<input type="hidden" id="socioid" name="socioid" value="<?php echo $idsocio;?>" />
							<div id="retorno" name="retorno" style="font-size:20px; color:#F60; background-color:#fff" class="pull-left"><?php if(isset($_GET['retorno'])){ echo $_GET['retorno'];}?></div>
							<input style="margin-top: 10px; text-align:center" id="guardar" name="guardar" type="button" class="pull-right botoncss" value="Guardar" >
							<br><br><br><br><br><br>
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
	<!-- Menu Toggle Script -->
	<script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
	</script>
	<script type="text/javascript">
		jQuery('#frmcarga').on('click', '#cargar', function(event) {
			if(document.getElementById("tipoplan").value.trim() != 0){
				if(document.getElementById("parentescosocio").value.trim() != 0){
					if(document.getElementById("tableta").rows.length <= document.getElementById("cantfamilia").value){
						if(controlarTabla('tableta')==true){
							var d = '<tr id="tablita">'+
							'<td id="tdtabla"><input type="text" name="familiar_id" class="form-control" id="familiar_id" value="'+document.getElementById("familiar_id").value.trim()+'" disabled="disabled"></td>'+
							'<td id="tdtabla"><input type="text" name="nombreyape" class="form-control" id="nombreyape" value="'+document.getElementById("nombreyape").value.trim()+'" disabled="disabled"></td>'+
							'<td id="tdtabla"><input type="text" name="dnifamilia" class="form-control" id="dnifamilia" value="'+document.getElementById("dnifamilia").value.trim()+'" disabled="disabled"></td>'+
							'<td id="tdtabla"><input type="text" name="fechanac" class="form-control" id="fechanac" value="'+document.getElementById("fechanac").value.trim()+'" disabled="disabled"></td>'+
							'<td id="tdtabla"><input type="text" name="pariente" class="form-control" id="pariente" value="'+document.getElementById("pariente").value.trim()+'" disabled="disabled"></td>'+
							'<td id="tdtabla">'+'<button type="button" class="btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>'+'</td>'+
							'</tr>';
							$("#tableta").append(d);
							document.getElementById("parentescosocio").value = 0;
							document.getElementById("familiar_id").value = "";
							document.getElementById("nombreyape").value = "";
							document.getElementById("dnifamilia").value = "";
							document.getElementById("fechanac").value = "";
							document.getElementById("pariente").value = "";
						}else{
							alert("No puede agregar dos veces el mismo familiar");
						}
					}else{
						alert("No puede seleccionar mas de "+document.getElementById("cantfamilia").value+" familiares");
					}
				}else{
					alert("Debe seleccionar un familiar");
				}
			}else{
				alert("Debe seleccionar un tipo de plan");
			}
		});
	</script>
	<script type="text/javascript">
    function controlarTabla(ID){
        //tenemos 2 variables, la primera será el Array principal donde estarán nuestros datos y la segunda es el objeto tabla
        var TABLA = $("#"+ID+" tbody > tr");
        var f = document.getElementById("parentescosocio").value;
        var a = true;
        //una vez que tenemos la tabla recorremos esta misma recorriendo cada TR y por cada uno de estos se ejecuta el siguiente codigo
        TABLA.each(function(){
            //por cada fila o TR que encuentra rescatamos 3 datos, el ID de cada fila, la Descripción que tiene asociada en el input text, y el valor seleccionado en un select
            var PER = $(this).find("input[id*='familiar_id']").val();

            //entonces declaramos un array para guardar estos datos, lo declaramos dentro del each para así reemplazarlo y cada vez
            item = {};
            //si miramos el HTML vamos a ver un par de TR vacios y otros con el titulo de la tabla, por lo que le decimos a la función que solo se ejecute y guarde estos datos cuando exista la variable ID, si no la tiene entonces que no anexe esos datos.
            if(PER == f){
                a = false;
            };
        });
        return a;
    }
    </script>
	<script type="text/javascript">	
	$(document).on('click', '.btn-danger', function (event) {
	   event.preventDefault();
	   $(this).closest('tr').remove();
	   });
	</script>
	<script type="text/javascript">
		jQuery('#frmguardar').on('click', '#guardar', function(event) {
			if(document.getElementById("tipoplan").value.trim() != 0){
				if(document.getElementById("tableta").rows.length > 1){
					//document.getElementById('frmguardar').submit();
					grabaTodoTabla('tableta');
				}else{
					alert("Debe ingresar al menos un familiar");
				}
			}else{
				alert("Debe ingresar un tipo de plan");
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
		function recargadiv() {
		$('#tableta tbody tr').slice(1).remove();
		
			var idcategoria = document.getElementById("tipoplan").value;
			
			$.ajax({
			data: {"idcategoria": idcategoria},
			type    : 'POST',
			dataType: 'json',
			url: 'buscardatoscategoria.php',
			success: 
				function( data ) {
					for(var i=0;i<data.length; i++)
                           {
								document.getElementById("precioplan").value = "$"+data[i].importe;
								document.getElementById("cantfamilia").value = data[i].cantidad_familiar;
								document.getElementById("planid").value = data[i].id;
                           }
				},
			error:
				function( data ) {
					alert("ocurrio un error inesperado, por favor consultar con soporte tecnico");
				}
			});
		} 
	</script>
	<script type="text/javascript">
		function buscarfamiliares() {
			
			var idfamilia = document.getElementById("parentescosocio").value;
			
			$.ajax({
			data: {"idfamilia": idfamilia},
			type    : 'POST',
			dataType: 'json',
			url: 'buscardatosflia.php',
			success: 
				function( data ) {
					for(var i=0;i<data.length; i++)
                           {
								document.getElementById("familiar_id").value = data[i].id;
								document.getElementById("nombreyape").value = data[i].nombre+", "+data[i].apellido;
								document.getElementById("dnifamilia").value = data[i].dni;
								document.getElementById("fechanac").value = data[i].fechanacimiento;
								document.getElementById("pariente").value = data[i].parentesco;
                           }
				},
			error:
				function( data ) {
					alert("ocurrio un error inesperado, por favor consultar con soporte tecnico");
				}
			});
		}
	</script>
	<script type="text/javascript">
	// Actualiza de manera masiva todos los archivos cargados en la tercera pestaña.
	function grabaTodoTabla(ID){
		//tenemos 2 variables, la primera será el Array principal donde estarán nuestros datos y la segunda es el objeto tabla
		var DATA = [];
		var TABLA = $("#"+ID+" tbody > tr");
		
		vplan = document.getElementById("planid").value;
		DATA.push(vplan);
		vsocio = document.getElementById("socioid").value;
		DATA.push(vsocio);

		//una vez que tenemos la tabla recorremos esta misma recorriendo cada TR y por cada uno de estos se ejecuta el siguiente codigo
		TABLA.each(function(){
			//por cada fila o TR que encuentra rescatamos 3 datos, el ID de cada fila, la Descripción que tiene asociada en el input text, y el valor seleccionado en un select
			var PER = $(this).find("input[id*='familiar_id']").val();

			//entonces declaramos un array para guardar estos datos, lo declaramos dentro del each para así reemplazarlo y cada vez
			item = {};
			//si miramos el HTML vamos a ver un par de TR vacios y otros con el titulo de la tabla, por lo que le decimos a la función que solo se ejecute y guarde estos datos cuando exista la variable ID, si no la tiene entonces que no anexe esos datos.
			if(PER !== ''){
				item ["familiar_id"] = PER;
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
			url : './registrarplancuota_post.php',
			processData: false, 
			contentType: false,
			success: function(r){
				window.location.href = "registrarplancuota.php";
			}
		});
	}//Fin funcion
	</script>
</body>
</html>
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
					<h2><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Registrar plan social</h2>
					<br>
					<form id="frmcarga" name="frmcarga" method="post" action="cargarcuotas_post.php">
						<div class="col-lg-6 col-md-6 form-group text-center" id="myDivC">
							<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Tipo de categoria:</label>
							<div class="col-sm-12">
								<select class="form-control" name="tipocat" id="tipocat" onchange="loadcate(this.value)" value="<?php echo $vtipocat;?>">
									<option value="<?php echo $vtipocat;?>"> - <?php echo $vtipocat;?> - </option>
									<option value="Civil">Civil</option>
									<option value="Militar">Militar</option>
									<option value="Pensionista">Pensionista</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 form-group text-center" id="myDivCat">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Categorias:</label>
						<div class="col-sm-12">
							<select type="text" name="categoria" class="form-control" id="categoria" placeholder="Seleccione la categoria" value="<?php echo $vcategoria;?>"></select>
						</div>
						</div>
						<div class="col-lg-6 col-md-6 form-group text-center">
						<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Descripción:</label>
						<div class="col-sm-12">
						  <input type="text" name="descripcion" class="form-control" id="descripcion" placeholder="Introduce una descripción" value="<?php echo $vdescripcion;?>">
						</div>
						</div>
						<div class="col-lg-6 col-md-6 form-group text-center">
						<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Detalle:</label>
						<div class="col-sm-12">
						  <textarea type="text" name="detalle" class="form-control" id="detalle" style="resize:none" placeholder="Introduce un detalle" value="<?php echo $vdetalle;?>"></textarea>
						</div>
						</div>
						<div class="col-lg-6 col-md-6 form-group text-center">
						<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Cantidad de meses:</label>
						<div class="col-sm-12">
						  <input type="text" name="cantmeses" class="form-control" id="cantmeses" onkeydown="return validarNumeros(event)" placeholder="Introduce una cantidad de meses" value="<?php echo $vcantmeses;?>">
						</div>
						</div>
						<div class="col-lg-6 col-md-6 form-group text-center">
						<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Familiar:</label>
						<div class="col-sm-12">
							<input type="text" name="familiar" class="form-control" id="familiar" onkeydown="return validarNumeros(event)" onChange="sumatotal();" placeholder="Introduce la cantidad de familiares">
						</div>
						</div>
						<div class="col-lg-6 col-md-6 form-group text-center">
						<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Importe total:</label>
						<div class="col-sm-12">
							<input type="text" class="form-control text-right" id="totales" name="totales" onkeydown="return validarNumeros(event)" onpaste="return false" value="0"/>
						</div>
						</div>
						<div style="padding-left:15px;padding-right:15px">
							<input type="hidden" id="qhacemos" name="qhacemos" value="<?php echo $qhacemos;?>" />
							<input type="hidden" id="idcu" name="idcu" value="<?php echo $idcu;?>" />
							<input type="hidden" id="sifamiliar" name="sifamiliar" value="<?php echo $vsifamiliar;?>" />
							<input type="hidden" id="sisocial" name="sisocial" value="<?php echo $vsisocial;?>" />
							<div id="retorno" name="retorno" style="font-size:20px; color:#F60; background-color:#fff" class="pull-left"><?php if(isset($_GET['retorno'])){ echo $_GET['retorno'];}?></div>
							<input style="margin-top: 10px; text-align:center" id="cargar" name="cargar" type="button" class="pull-right botoncss" value="Guardar" >
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
	<!-- Carga de Provincias y Localidades -->
	<script src="js/ajax.js"></script>
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
				if(document.getElementById("tipocat").value.trim() != 0){
					if(document.getElementById("categoria").value.trim() >= 1){
						if(document.getElementById("descripcion").value.trim() != ""){
							if(document.getElementById("detalle").value.trim() != ""){
								if(document.getElementById("cantmeses").value.trim() != ""){
									if(document.getElementById("familiar").value.trim() != ""){
										if(document.getElementById("totales").value.trim() != 0){
											document.getElementById('frmcarga').submit();
										}else{
											alert("Debe ingresar un monto total");
										}
									}else{
										alert("Debe ingresar la cantidad de familiares");
									}
								}else{
									alert("Debe ingresar la cantidad de meses");
								}
							}else{
								alert("Debe ingresar un detalle");
							}
						}else{
							alert("Debe ingresar el nombre de la descripción");
						}
					}else{
						alert("Debe seleccionar la categoria");
					}
				}else{
						alert("Debe seleccionar el tipo de categoría");
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
		function validar(e) { // 1
			tecla = (document.all) ? e.keyCode : e.which; // 2
			if (tecla==8) return true; // 3
			patron = /[]/; // 4
			te = String.fromCharCode(tecla); // 5
			return patron.test(te); // 6
		}
	</script>
	<script>
		function validarchk1(){
		var chk = document.getElementById('chkfamiliar');
		var txt = document.getElementById('familiar');
		if(chk.checked){
			txt.disabled='';
			document.getElementById("familiar").value = 1;
		}else{
			txt.value='';
			txt.disabled='disabled';
		}
		}
	</script>
</body>
</html>
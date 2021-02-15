<?php
	require("config.php");
	if(empty($_SESSION['user'])) 
	{
		header("Location: index.php");
		die("Redirecting to index.php"); 
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Bootstrap Tab + Fixed Sidebar Tutorial with HTML5 / CSS3 / JavaScript">
	<meta name="author" content="Untame.net">
	<title>Club FFAA</title>
	<!-- Bootstrap -->
	<link href="assets/all-krajee.css" rel="stylesheet">
	<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="assets/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
	<link href="assets/datepicker.css" rel="stylesheet">
	
	<link href="assets/fileinput.min.css" rel="stylesheet">
	
	<script src="assets/jquery.min.js"></script>
	
	<style type="text/css">
		body { background: url(assets/bglight.png); }
		.hero-unit { background-color: #fff; }
		.center { display: block; margin: 0 auto; }
		.col-sm-1,.col-sm-10,.col-sm-11,.col-sm-12,.col-sm-2,.col-sm-3,.col-sm-4,.col-sm-5,.col-sm-6,.col-sm-7,.col-sm-8,.col-sm-9{}.col-sm-12{width:100%}.col-sm-11{width:91.66666667%}.col-sm-10{width:83.33333333%}.col-sm-9{width:75%}.col-sm-8{width:66.66666667%}.col-sm-7{width:58.33333333%}.col-sm-6{}.col-sm-5{width:41.66666667%}.col-sm-4{width:33.33333333%}.col-sm-3{width:25%}.col-sm-2{width:16.66666667%}.col-sm-1{width:8.33333333%}.col-sm-pull-12{right:100%}.col-sm-pull-11{right:91.66666667%}.col-sm-pull-10{right:83.33333333%}.col-sm-pull-9{right:75%}.col-sm-pull-8{right:66.66666667%}.col-sm-pull-7{right:58.33333333%}.col-sm-pull-6{right:50%}.col-sm-pull-5{right:41.66666667%}.col-sm-pull-4{right:33.33333333%}.col-sm-pull-3{right:25%}.col-sm-pull-2{right:16.66666667%}.col-sm-pull-1{right:8.33333333%}.col-sm-pull-0{right:auto}.col-sm-push-12{left:100%}.col-sm-push-11{left:91.66666667%}.col-sm-push-10{left:83.33333333%}.col-sm-push-9{left:75%}.col-sm-push-8{left:66.66666667%}.col-sm-push-7{left:58.33333333%}.col-sm-push-6{left:50%}.col-sm-push-5{left:41.66666667%}.col-sm-push-4{left:33.33333333%}.col-sm-push-3{left:25%}.col-sm-push-2{left:16.66666667%}.col-sm-push-1{left:8.33333333%}.col-sm-push-0{left:auto}.col-sm-offset-12{margin-left:100%}.col-sm-offset-11{margin-left:91.66666667%}.col-sm-offset-10{margin-left:83.33333333%}.col-sm-offset-9{margin-left:75%}.col-sm-offset-8{margin-left:66.66666667%}.col-sm-offset-7{margin-left:58.33333333%}.col-sm-offset-6{margin-left:50%}.col-sm-offset-5{margin-left:41.66666667%}.col-sm-offset-4{margin-left:33.33333333%}.col-sm-offset-3{margin-left:25%}.col-sm-offset-2{margin-left:16.66666667%}.col-sm-offset-1{margin-left:8.33333333%}.col-sm-offset-0{margin-left:0};
	</style>
	<style>
	.kv-avatar .file-preview-frame,.kv-avatar .file-preview-frame:hover {
		margin: 0;
		padding: 0;
		border: none;
		box-shadow: none;
		text-align: center;
	}
	.kv-avatar .file-input {
		display: table-cell;
		max-width: 220px;
	}
	</style>
</head>
<?php
$idafiliado_v="";
$dni_v="";
$apellido_v="";
$nombre_v="";
$domicilio_v="";
$telefono_v="";
$mail_v="";
$fechanac_v="";
$localidad_v="";
$estaciv_v="";
$pare_v="";
$ocupa_v="";
$forma_v="";
$depo_v="";
$hobb_v="";
?>
<body>
	<div class="navbar navbar-fixed-top navbar-inverse">
	  <div class="navbar-inner">
		<div class="container">
		  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </a>
		  <a class="brand">Club de las Fuerzas Armadas - Córdoba</a>
		  <div class="nav-collapse">
			<ul class="nav pull-right">
			  <li class="dropdown">
				<a class="dropdown-toggle" href="#" data-toggle="dropdown">Cargar<strong class="caret"></strong></a>
				<div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
					<form action="index.php" method="post"> 
						<a href="secret.php">Nuevo Cliente</a><br /><br />
						<a href="secret.php">Nuevo Embarcacion</a>  
					</form> 
				</div>
			  </li>
			  <li class="divider-vertical"></li>
			  <li><a href="menu.php">Volver</a></li>
			  <li><a href="logout.php">Desconectarse</a></li>
			  <li class="divider-vertical"></li>
			</ul>
		  </div>
		</div>
	  </div>
	</div>

<div class="container hero-unit">
	<h2>Bienvenido <?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?>! Por favor, selecciona a continuacion el tipo de socio a cargar:</h2>
	<div class="col-sm-12 text-center">
		<SELECT style="width:300px;height:35px" NAME="selSocio" class="" id="selSocio" placeholder="Seleccione Socio" onChange="cambiardivs(this)">
		<option value="0"> - Seleccione - </option>
		<OPTION value="1">Socio Activo</OPTION>
		<OPTION value="2">Socio Concurrente</OPTION>
		<OPTION value="3">Socio Retirado</OPTION>
		<OPTION value="4">Socio Familiar</OPTION> 
		</SELECT>
	</div>
</div>
<div class="container hero-unit" id="vasiosi" style="display:;">
	<div class="col-sm-6 text-center">
		<li>
			<label for="foto">Foto de perfil</label>
			<!-- the avatar markup -->
			<div id="kv-avatar-errors-2" class="center-block" style="width:800px;display:none"></div>
			<form class="text-center" action="/avatar_upload.php" method="post" enctype="multipart/form-data">
				<div class="kv-avatar center-block" style="width:200px">
					<input id="avatar-2" name="avatar-2" type="file" class="file-loading">
				</div>
				<!-- include other inputs if needed and include a form submit (save) button -->
			</form>
			<!-- your server code `avatar_upload.php` will receive `$_FILES['avatar']` on form submission -->
		</li>
		<li>
		 <label for="idafiliado">Id de Afiliado</label>
		 <input type="hidden" id="modificar" name="modificar" value="<?php $v_modifica;?>">
		 <input style="height:35px" type="text" name="idafiliado" value="<?php echo 
		  $idafiliado_v;?>" class="form-control" id="idafiliado" placeholder="Id de afiliado" onkeypress="return justNumbers(event);">
		</li>
		<li>
		 <label for="dni">DNI de Afiliado</label>
		 <input style="height:35px" type="text" name="dni" value="<?php echo 
		  $dni_v;?>" class="form-control" id="dni" placeholder="Dni del afiliado" onkeypress="return justNumbers(event);">
		</li>
		<li>
		 <label for="apellido">Apellido</label>
		 <input style="height:35px" type="text" name="apellido" value="<?php echo 
		  $apellido_v;?>" class="form-control" id="apellido" placeholder="Apellido del afiliado">
		</li>
	</div>
	<div class="col-sm-6 text-center">
		<li>
		 <label for="nombre">Nombre</label>
		 <input style="height:35px" type="text" name="nombre" value="<?php echo 
		  $nombre_v;?>" class="form-control" id="nombre" placeholder="Nombre del afiliado">
		</li>
		<li>
		 <label for="domicilio">Domicilio</label>
		 <input style="height:35px" type="text" name="domicilio" value="<?php echo 
		  $domicilio_v;?>" class="form-control" id="domicilio" placeholder="Domicilio del afiliado">
		</li>
		<li>
		 <label for="telefono">Telefono</label>
		 <input style="height:35px" type="text" name="telefono" value="<?php echo 
		  $telefono_v;?>" class="form-control" id="telefono" placeholder="Telefono del afiliado" onkeypress="return justNumbers(event);">
		</li>
		<li>
		 <label for="mail">E-Mail</label>
		 <input style="height:35px" type="text" name="mail" value="<?php echo 
		  $mail_v;?>" class="form-control" id="mail" placeholder="E-mail del afiliado">
		</li>
		<li>
		 <label for="fechanac">Fecha de Nacimiento</label>
		
		 <input style="height:35px" type="text" name="fechanac" value="<?php echo 
		  $fechanac_v;?>" class="form-control" id="fechanac" placeholder="DD/MM/AAAA">
		</li>
		<li>
		 <label for="provincia">Provincia</label>
		 <select style="width:300px;height:35px" name="provincia" value="<?php echo 
		  $localidad_v;?>" class="" id="provincia" placeholder="Provincia del afiliado">
		 <option value=""> - Seleccione - </option>
		 <?php
		 include("conection.php");
		 $sql = "select provincia from provincias";
		 $query = "SELECT * FROM provincias";
		  $result = mysql_query($sql);
		  $numero = 0;
		  while($row = mysql_fetch_array($result))
		  { 
				if ($localidad_v ==  $row['provincia'])
				{
				?>
			<option selected value="<?php echo $row['provincia'];?>"><?php echo $row['provincia'];?></option>
		<?php 
			}
			else
			{
		 ?>
				<option value="<?php echo $row['provincia'];?>"><?php echo $row['provincia'];?></option>
		<?php 		}
		  }
		?>
		 </select>
		</li>
		<li>
		 <label for="localidad">Localidad</label>
		 <select style="width:300px;height:35px" name="localidad" value="<?php echo 
		  $localidad_v;?>" class="" id="localidad" placeholder="Localidad del afiliado">
		 <option value=""> - Seleccione - </option>
		 <?php
		 include("conection.php");
		 $sql = "select localidad from localidades";
		 $query = "SELECT * FROM localidades";
		  $result = mysql_query($sql);
		  $numero = 0;
		  while($row = mysql_fetch_array($result))
		  { 
				if ($localidad_v ==  $row['localidad'])
				{
				?>
			<option selected value="<?php echo $row['localidad'];?>"><?php echo $row['localidad'];?></option>
		<?php 
			}
			else
			{
		 ?>
				<option value="<?php echo $row['localidad'];?>"><?php echo $row['localidad'];?></option>
		<?php 		}
		  }
		?>
		 </select>
		</li>
		<button name="btnUNO" id="btnUNO" type="button" class="btn btn-default" onClick="validardatos()">Cargar</button>
	</div>
</div>
<div class="container hero-unit" id="nova" style="display:none;">
	<div class="col-sm-6 text-center">
		<li>
		 <label for="estadocivil">Estado Civil</label>
		 <input style="height:35px" type="text" name="estadocivil" value="<?php echo 
		  $estaciv_v;?>" class="form-control" id="estadocivil" placeholder="Estado civil del afiliado">
		</li>
		<li>
		 <label for="parentesco">Parentesco</label>
		 <input style="height:35px" type="text" name="parentesco" value="<?php echo 
		  $pare_v;?>" class="form-control" id="parentesco" placeholder="Parentesco del afiliado">
		</li>
	</div>
	<div class="col-sm-6 text-center">
		<li>
		 <label for="ocupacion">Ocupacion</label>
		 <input style="height:35px" type="text" name="ocupacion" value="<?php echo 
		  $ocupa_v;?>" class="form-control" id="ocupacion" placeholder="Ocupacion del afiliado">
		</li>
		<button name="btnDOS" id="btnDOS" type="button" class="btn btn-default" onClick="validardatos2()">Cargar</button>
	</div>
</div>
<div class="container hero-unit" id="capaz" style="display:none;">
	<div class="col-sm-6 text-center">
		<li>
		 <label for="formacion">Formacion</label>
		 <input style="height:35px" type="text" name="formacion" value="<?php echo 
		  $forma_v;?>" class="form-control" id="formacion" placeholder="Formacion del afiliado">
		</li>
		<li>
		 <label for="deportes">Deportes</label>
		 <input style="height:35px" type="text" name="deportes" value="<?php echo 
		  $depo_v;?>" class="form-control" id="deportes" placeholder="Deportes del afiliado">
		</li>
	</div>
	<div class="col-sm-6 text-center">
		<li>
		 <label for="hobbies">Hobbies</label>
		 <input style="height:35px" type="text" name="hobbies" value="<?php echo 
		  $hobb_v;?>" class="form-control" id="hobbies" placeholder="Hobbies del afiliado">
		</li>
		<button name="btnTRES" id="btnTRES" type="button" class="btn btn-default" onClick="validardatos2()">Cargar</button>
	</div>
</div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="assets/bootstrap.min.js"></script>
	<script src="assets/bootstrap-datepicker.js"></script>
	<script src="assets/fileinput.min.js"></script>
	<script>
	var btnCust = '<button type="button" class="btn btn-default" title="Etiquetas" ' + 
		'onclick="alert(\'Mensaje del servidor\')">' +
		'<i class="glyphicon glyphicon-tag"></i>' +
		'</button>'; 
	$("#avatar-2").fileinput({
		overwriteInitial: true,
		maxFileSize: 1500,
		showClose: false,
		showCaption: false,
		showBrowse: false,
		browseOnZoneClick: true,
		removeLabel: '',
		removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
		removeTitle: 'Cancelar',
		elErrorContainer: '#kv-avatar-errors-2',
		msgErrorClass: 'alert alert-block alert-danger',
		defaultPreviewContent: '<img src="img/default.jpg" alt="Perfil" style="width:160px"><h6 class="text-muted">Click para seleccionar</h6>',
		layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
		allowedFileExtensions: ["jpg", "png", "gif"]
	});
	</script>
	<script>
	$("#file-3").fileinput({
		showCaption: false,
		browseClass: "btn btn-primary btn-lg",
		fileType: "any"
	});
	</script>
	<script type="text/javascript">
		// When the document is ready
		$(document).ready(function ()
		{
			$('#fechanac').datepicker({
				format: "dd/mm/yyyy", 
				endDate: "+0d"
			}); 
			 
		});
	</script>
	<script type="text/javascript">
		function justNumbers(e)
		{
		 var keynum = window.event ? window.event.keyCode : e.which;
		 if ((keynum == 8) || (keynum == 46))
		 return true;
		 return /\d/.test(String.fromCharCode(keynum));
		}
	</script>
	<script type="text/javascript">
	function cambiardivs(sel) {
		  if (sel.value=="0"){
			   divC = document.getElementById("vasiosi");
			   divC.style.display = "";

			   divT = document.getElementById("nova");
			   divT.style.display = "none";
			   
			   divT = document.getElementById("capaz");
			   divT.style.display = "none";

			   btnUNO.style.visibility  = 'visible';
			   btnDOS.style.visibility  = 'hidden';
			   btnTRES.style.visibility  = 'hidden';

		  }else{
			  if (sel.value=="1"){
			   divC = document.getElementById("vasiosi");
			   divC.style.display="";

			   divT = document.getElementById("nova");
			   divT.style.display = "";
			   
			   divT = document.getElementById("capaz");
			   divT.style.display = "none";

			   btnUNO.style.visibility  = 'hidden';
			   btnDOS.style.visibility  = 'visible';
			   btnTRES.style.visibility  = 'hidden';
			  }else{
			   divC = document.getElementById("vasiosi");
			   divC.style.display="";

			   divT = document.getElementById("nova");
			   divT.style.display = "";
			   
			   divT = document.getElementById("capaz");
			   divT.style.display = "";

			   btnUNO.style.visibility  = 'hidden';
			   btnDOS.style.visibility  = 'hidden';
			   btnTRES.style.visibility  = 'visible';
			  }

		  }
	}
	</script>
</body>
</html>
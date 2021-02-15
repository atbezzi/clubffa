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

function echoActiveClassIfRequestMatches($requestUri)
{
	$current_file_name = basename($_SERVER['REQUEST_URI'], ".php");
	if ($current_file_name == $requestUri)
		echo 'class="active"';
}

$elsql="SELECT estado from solicitudes";
$select = mysql_query($elsql);
$cantpend = 0;
while($datos = mysql_fetch_array($select)) {
	if ($datos['estado']=='Pendiente'){
		$cantpend = $cantpend + 1;
	}
}
?>
<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">-->
<div class="nav-side-menu" style="font-family: 'Open Sans', sans-serif;">
	<div class="brand hidden-sm hidden-xs" style="cursor:pointer; line-height:30px" onclick="window.location.replace('index.php');"><span class="hidden-xs hidden-sm" style="padding-top:15px;"><strong style="font-weight:900">CFFAA </strong>Cba<br></span><span style="font-size:18px;">Club de las Fuerzas Armadas</span><div class="hidden-xs hidden-sm" style="height:20px;"></div></div>
	<div class="brand hidden-lg hidden-md" style="cursor:pointer; line-height:30px; width:70%" onclick="window.location.replace('index.php');"><span class="hidden-xs hidden-sm" style="padding-top:15px;"><strong style="font-weight:900">Club de las Fuerzas Armadas </strong>Cba<br></span><span style="font-size:18px;">CFFAA Cba</span><div class="hidden-xs hidden-sm" style="height:20px;"></div></div>
	<i class="toggle-btn" data-toggle="collapse" data-target="#menu-content"><span class="glyphicon glyphicon-align-justify"></span></i>
		<div class="menu-list">
			<ul id="menu-content" class="menu-content collapse out">
				<li> <?=echoActiveClassIfRequestMatches("datosusuario")?>
					<a href="datosusuarios.php"><i class="glyphicon glyphicon-user"></i><strong style="font-weight:900"><?php echo $_SESSION['usuario'];?></strong></a>
				</li>
				<?php if($_SESSION['tipo'] == 'Administrador' OR $_SESSION['tipo'] == 'SA'){ ?>
				<li data-toggle="collapse" data-target="#usuarios" class="collapsed">
					<a href="#"><i class="glyphicon glyphicon-user"></i>&nbsp;Usuarios<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				</li>
				<ul class="sub-menu collapse" id="usuarios">
				<li <?=echoActiveClassIfRequestMatches("altausuarios")?>><a href="altausuarios.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-floppy-save"></span>&nbsp;Registrar</a></li>
				<li <?=echoActiveClassIfRequestMatches("estadousuarios")?>><a href="estadousuarios.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-search"></span>&nbsp;Consultar</a></li>
				</ul>
				<li data-toggle="collapse" data-target="#zonas" class="collapsed">
					<a href="#"><i class="glyphicon glyphicon-picture"></i>&nbsp;Zonas<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				</li>
				<ul class="sub-menu collapse" id="zonas">
				<li <?=echoActiveClassIfRequestMatches("registrarzonas")?>><a href="registrarzonas.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-floppy-save"></span>&nbsp;Registrar</a></li>
				<li <?=echoActiveClassIfRequestMatches("consultarzonas")?>><a href="consultarzonas.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-search"></span>&nbsp;Consultar</a></li>
				</ul>
				<li data-toggle="collapse" data-target="#categorias" class="collapsed">
					<a href="#"><i class="glyphicon glyphicon-star-empty"></i>&nbsp;Categorías de socio<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				</li>
				<ul class="sub-menu collapse" id="categorias">
				<li <?=echoActiveClassIfRequestMatches("registrarcategorias")?>><a href="registrarcategorias.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-floppy-save"></span>&nbsp;Registrar</a></li>
				<li <?=echoActiveClassIfRequestMatches("consultarcategorias")?>><a href="consultarcategorias.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-search"></span>&nbsp;Consultar</a></li>
				</ul>
				<li data-toggle="collapse" data-target="#cobradores" class="collapsed">
					<a href="#"><i class="glyphicon glyphicon-usd"></i>&nbsp;Cobradores<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				</li>
				<ul class="sub-menu collapse" id="cobradores">
				<li <?=echoActiveClassIfRequestMatches("registrarcobrador")?>><a href="registrarcobrador.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-floppy-save"></span>&nbsp;Registrar</a></li>
				<li <?=echoActiveClassIfRequestMatches("consultarcobrador")?>><a href="consultarcobrador.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-search"></span>&nbsp;Consultar</a></li>
				</ul>
				<?php } ?>
				<?php if($_SESSION['tipo'] == 'Secretario' OR $_SESSION['tipo'] == 'SA'){ ?>
				<li data-toggle="collapse" data-target="#formulario" class="collapsed">
					<a href="#"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;Formulario<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				</li>
				<ul class="sub-menu collapse" id="formulario">
				<li data-toggle="collapse" data-target="#formingreso" class="collapsed">
					<a href="#">&nbsp;<i class="glyphicon glyphicon-floppy-save"></i>&nbsp;Formularios de ingreso<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				</li>
				<ul class="sub-menu collapse" id="formingreso">
				<li <?=echoActiveClassIfRequestMatches("cargarafiliadocivil")?>><a href="cargarafiliadocivil.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-menu-right"></span>&nbsp;Civil</a></li>
				<li <?=echoActiveClassIfRequestMatches("cargarafiliadopencionada")?>><a href="cargarafiliadopencionada.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-menu-right"></span>&nbsp;Pensionista</a></li>
				<li <?=echoActiveClassIfRequestMatches("cargarafiliadomilitar")?>><a href="cargarafiliadomilitar.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-menu-right"></span>&nbsp;Militar</a></li>
				</ul>
				<li <?=echoActiveClassIfRequestMatches("formulariodeegreso")?>><a href="formulariodeegreso.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-floppy-save"></span>&nbsp;Formularios de egreso</a></li>
				<li <?=echoActiveClassIfRequestMatches("consultarformularios")?>><a href="consultarformularios.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-search"></span>&nbsp;Consultar</a></li>
				</ul>
				<li data-toggle="collapse" data-target="#adminafiliados" class="collapsed">
					<a href="#"><i class="glyphicon glyphicon-stats"></i>&nbsp;Administración de socios<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				</li>
				<ul class="sub-menu collapse" id="adminafiliados">
				<li data-toggle="collapse" data-target="#consulsocios" class="collapsed">
					<a href="#">&nbsp;<i class="glyphicon glyphicon-user"></i>&nbsp;Consulta de socios<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				</li>
				<ul class="sub-menu collapse" id="consulsocios">
				<li <?=echoActiveClassIfRequestMatches("consultarafiliados")?>><a href="consultarafiliados.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-search"></span>&nbsp;Activos</a></li>
				<li <?=echoActiveClassIfRequestMatches("consultarafiliadosaprobados")?>><a href="consultarafiliadosaprobados.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-search"></span>&nbsp;Aprobados</a></li>
				</ul>
				<li data-toggle="collapse" data-target="#admifami" class="collapsed">
					<a href="#">&nbsp;<i class="glyphicon glyphicon-user"></i>&nbsp;Administrar familiares<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				</li>
				<ul class="sub-menu collapse" id="admifami">
				<li <?=echoActiveClassIfRequestMatches("registrarfamiliar")?>><a href="registrarfamiliar.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-floppy-save"></span>&nbsp;Registrar</a></li>
				<li <?=echoActiveClassIfRequestMatches("consultarfamiliar")?>><a href="consultarfamiliar.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-search"></span>&nbsp;Consultar</a></li>
				</ul>
				</ul>
				<li data-toggle="collapse" data-target="#adminembarca" class="collapsed">
					<a href="#"><i class="glyphicon glyphicon-stats"></i>&nbsp;Administrar embarcaciones<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				</li>
				<ul class="sub-menu collapse" id="adminembarca">
				<li <?=echoActiveClassIfRequestMatches("registrarembarcacion")?>><a href="registrarembarcacion.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-floppy-save"></span>&nbsp;Registrar</a></li>
				<li <?=echoActiveClassIfRequestMatches("consultarembarcacion")?>><a href="consultarembarcacion.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-search"></span>&nbsp;Consultar</a></li>
				</ul>
				<li data-toggle="collapse" data-target="#reportes" class="collapsed">
					<a href="#"><i class="glyphicon glyphicon-signal"></i>&nbsp;Reportes<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				</li>
				<ul class="sub-menu collapse" id="reportes">
				<li <?=echoActiveClassIfRequestMatches("socioportipo")?>><a href="socioportipo.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-picture"></span>&nbsp;Socios por tipo</a></li>
				<li <?=echoActiveClassIfRequestMatches("socioporcategorias")?>><a href="socioporcategorias.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-picture"></span>&nbsp;Socios por categorias</a></li>
				<li <?=echoActiveClassIfRequestMatches("movimientossocios")?>><a href="movimientossocios.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-picture"></span>&nbsp;Movimientos socios</a></li>
				<li <?=echoActiveClassIfRequestMatches("socioporplan")?>><a href="socioporplan.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-picture"></span>&nbsp;Planes sociales</a></li>
				</ul>
				<?php } ?>
				<?php if($_SESSION['tipo'] == 'Tesorero' OR $_SESSION['tipo'] == 'SA'){ ?>
				<li data-toggle="collapse" data-target="#cuotas" class="collapsed">
					<a href="#"><i class="glyphicon glyphicon-file"></i>&nbsp;Planes sociales<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				</li>
				<ul class="sub-menu collapse" id="cuotas">
				<li <?=echoActiveClassIfRequestMatches("cargarcuotas")?>><a href="cargarcuotas.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-floppy-save"></span>&nbsp;Registrar</a></li>
				<li <?=echoActiveClassIfRequestMatches("consultarplanes")?>><a href="consultarplanes.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-search"></span>&nbsp;Consultar</a></li>
				</ul>
				<li data-toggle="collapse" data-target="#inssub" class="collapsed">
					<a href="#"><i class="glyphicon glyphicon-usd"></i>&nbsp;Inscripción y suscripción<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				</li>
				<ul class="sub-menu collapse" id="inssub">
				<li <?=echoActiveClassIfRequestMatches("cargarinscripcion")?>><a href="cargarinscripcion.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-floppy-save"></span>&nbsp;Inscripciones</a></li>
				<li <?=echoActiveClassIfRequestMatches("cargarcobro")?>><a href="cargarcobro.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-floppy-save"></span>&nbsp;Suscripciones</a></li>
				</ul>
				<li data-toggle="collapse" data-target="#pagos" class="collapsed">
					<a href="#"><i class="glyphicon glyphicon-usd"></i>&nbsp;Cobros<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				</li>
				<ul class="sub-menu collapse" id="pagos">
				<li <?=echoActiveClassIfRequestMatches("consultarcobro")?>><a href="consultarcobro.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-search"></span>&nbsp;Consultar</a></li>
				</ul>
				<li data-toggle="collapse" data-target="#pagosver" class="collapsed">
					<a href="#"><i class="glyphicon glyphicon-usd"></i>&nbsp;Pagos<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				</li>
				<ul class="sub-menu collapse" id="pagosver">
				<li <?=echoActiveClassIfRequestMatches("registrarpagos")?>><a href="registrarpagos.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-floppy-save"></span>&nbsp;Registrar</a></li>
				<li <?=echoActiveClassIfRequestMatches("consultarpago")?>><a href="consultarpago.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-search"></span>&nbsp;Consultar</a></li>
				</ul>
				<li data-toggle="collapse" data-target="#pagosgraf" class="collapsed">
					<a href="#"><i class="glyphicon glyphicon-indent-left"></i>&nbsp;Reportes<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				</li>
				<ul class="sub-menu collapse" id="pagosgraf">
				<li <?=echoActiveClassIfRequestMatches("reportedeingresos")?>><a href="reportedeingresos.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-stats"></span>&nbsp;Reporte de ingresos</a></li>
				</ul>
				<li data-toggle="collapse" data-target="#tarifasadmin" class="collapsed">
					<a href="#"><i class="glyphicon glyphicon-credit-card"></i>&nbsp;Tarifas<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				</li>
				<ul class="sub-menu collapse" id="tarifasadmin">
				<li <?=echoActiveClassIfRequestMatches("tarifas")?>><a href="tarifas.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-usd"></span>&nbsp;Inscripciones</a></li>
				<li <?=echoActiveClassIfRequestMatches("planes")?>><a href="planes.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-usd"></span>&nbsp;Planes</a></li>
				</ul>
				<?php } ?>
				<?php if($_SESSION['tipo'] == 'Auditor' OR $_SESSION['tipo'] == 'SA'){ ?>
				<li data-toggle="collapse" data-target="#auditoria" class="collapsed">
					<a href="#"><i class="glyphicon glyphicon-eye-open"></i>&nbsp;Auditoría<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				</li>
				<ul class="sub-menu collapse" id="auditoria">
				<li <?=echoActiveClassIfRequestMatches("estadousuariosauditoria")?>><a href="estadousuariosauditoria.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-list-alt"></span>&nbsp;Usuarios</a></li>
				<li <?=echoActiveClassIfRequestMatches("estadosociosauditoria")?>><a href="estadosociosauditoria.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-list-alt"></span>&nbsp;Socios</a></li>
				<li <?=echoActiveClassIfRequestMatches("estadocobrosauditoria")?>><a href="estadocobrosauditoria.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-list-alt"></span>&nbsp;Cobros</a></li>
				<li <?=echoActiveClassIfRequestMatches("estadopagosauditoria")?>><a href="estadopagosauditoria.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-list-alt"></span>&nbsp;Pagos</a></li>
				<li <?=echoActiveClassIfRequestMatches("logaccesos")?>><a href="logaccesos.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-list-alt"></span>&nbsp;Accesos</a></li>
				<li <?=echoActiveClassIfRequestMatches("backupbase")?>><a href="backupbase.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-save-file"></span>&nbsp;Backup BD</a></li>
				</ul>
				<?php } ?>
				<?php if($_SESSION['tipo'] == 'Presidente' OR $_SESSION['tipo'] == 'SA'){ ?>
				<li data-toggle="collapse" data-target="#formpresidente" class="collapsed">
					<a href="#"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;Solicitudes<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-chevron-down pull-right"></span> <span class="badge"><?php echo $canttotal;?></a>
				</li>
				<ul class="sub-menu collapse" id="formpresidente">
				<li <?=echoActiveClassIfRequestMatches("pendientesolicitudpres")?>><a href="pendientesolicitudpres.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-floppy-save"></span>&nbsp;Pendientes  <span class="badge"><?php echo $cantpend;?></a></li>
				<li <?=echoActiveClassIfRequestMatches("consultarformularios")?>><a href="consultarformularios.php">&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:5px; padding-top:10px;" class="glyphicon glyphicon-search"></span>&nbsp;Consultar</a></li>
				</ul>
				<?php } ?>
				<li>
					<a href="logout.php"><i class="glyphicon glyphicon-off"></i>&nbsp;Desconectar</a>
				</li>
			</ul>
		</div>
</div>
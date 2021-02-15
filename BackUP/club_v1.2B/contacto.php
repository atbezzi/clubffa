<?php
$mjs = "";

if($_SERVER['REQUEST_METHOD'] === 'POST') {

// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
$email_to = "cffaacba@gmail.com";
$email_to2 = "info@hotellacapilla.com.ar";
$email_subject = "Contacto desde sitio web CFFAA";
$email_from = "cffaacba@gmail.com";

  $comonosconocio="";
		foreach($_POST['chkcomo'] as $selected)
		{
			$comonosconocio = $comonosconocio." \n* ".$selected."\n";
			}


// Aquí se deberían validar los datos ingresados por el usuario
if(!isset($_POST['nombre']) ||
!isset($_POST['correo']) ||
!isset($_POST['telefono']) ||
!isset($_POST['mensaje'])) {

echo "<b>Ocurrió un error y el formulario no ha sido enviado. </b><br />";
echo "Por favor, vuelva atrás y verifique la información ingresada<br />";
die();
}

$email_message = "Detalles del formulario de contacto:\n\n";
$email_message .= "Nombre: " . $_POST['nombre'] . "\n";
$email_message .= "E-mail: " . $_POST['correo'] . "\n";
$email_message .= "Teléfono: " . $_POST['telefono'] . "\n";

$email_message .= "Como nos conoció?: " . $comonosconocio. "\n";
$email_message .= "Comentarios: " . $_POST['mensaje'] . "\n";


// Ahora se envía el e-mail usando la función mail() de PHP
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
@mail($email_to2, $email_subject, $email_message, $headers);

$mjs = "¡El formulario de contacto se ha enviado con éxito!";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="footer, address, phone, icons" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/cffaa.png">

    <title>Club FFAA</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
	
	<!-- Footer -->
	<link rel="stylesheet" href="css/footer-distributed-with-address-and-phones.css">
	
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
	<link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="css/carousel.css" rel="stylesheet">
  </head>
<!-- NAVBAR
================================================== -->
  <body>
	<div class="menu">
		<?php include 'menu.php';?>
	</div>
	<br><br><br><br><br>
	<div class="container">
		<div class="row">
			<div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Consultas a
                        <strong>CFFAA</strong>
                    </h2>
                    <hr>					
					<span style="color:#04B431 "><h5><b><?php echo $mjs; ?></b></h5></span>
                    <p>A continuacion puede completar con sus datos y realizarnos las consultas que necesite. Su consulta no es molestia para nosotros.</p>
                    <form role="form" name="frmContacto" id="frmContacto" method="post" action="contacto.php">
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label>Nombre:</label>
                                <input type="text" name="nombre" id="nombre" class="form-control">
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Direccion de Correo:</label>
                                <input type="email" name="correo" id="correo" class="form-control">
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Telefono:</label>
                                <input type="tel" name="telefono" id="telefono" class="form-control">
                            </div>
                            <div class="clearfix"></div>
								<div class="form-group col-lg-12">

                                
									<div align="center"><table width="390px">
									<span><b>¿Cómo se enteró de Nosotros ? </b></span><br><br>
									<tr><td align="left">
									 <input type="checkbox" name="chkcomo[]" value="amigo-colega"><b>Amigo, colega</b><br>
									 <input type="checkbox" name="chkcomo[]" value="redes" ><b>Redes sociales</b><br>
									 <input type="checkbox" name="chkcomo[]" value="prensa" ><b>Prensa y anuncios</b><br>
									 
									 </td>
									 <td align="left">
									 <input type="checkbox" name="chkcomo[]" value="diario/revista" ><b>Diario, revista</b><br>
									 <input type="checkbox" name="chkcomo[]" value="radio" ><b>Radio</b><br>
									 <input type="checkbox" name="chkcomo[]" value="otros" ><b>Otros</b><br>
									</td>
									</tr></table>
									</div>

                            </div>
                            <div class="form-group col-lg-12">
                                <label>Mensaje:</label>
                                <textarea class="form-control" name="mensaje" id="mensaje" rows="6"></textarea>
                            </div>
                            <div class="form-group col-lg-12">
                                <input type="hidden" name="save" value="contact">
                                <button button type="button" onclick="controlar()" class="btn btn-default">Enviar</button> 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
		</div>
	</div>
	<br><br><br><br><br>
	<div class="footer">
		<?php include 'footer.php';?>
	</div>
      <!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="js/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
	<script type="text/javascript">
		function controlar()
			{
			var todovacio = 0;
					if  (document.getElementById('nombre').value=="")
						{
						 todovacio = 1;
						}
					if  (document.getElementById('correo').value=="")
						{
						 todovacio = 1;
						}	
					if  (document.getElementById('telefono').value=="")
						{
						 todovacio = 1;
						}
				
					if  (document.getElementById('mensaje').value=="")
						{
						 todovacio = 1;
						}	
				if 	(todovacio ==0)
					{
						document.forms["frmContacto"].submit();
					}
				else
					{
						alert('Debera completar toda la información requerida ');
					}
			}
	</script>
  </body>
</html>
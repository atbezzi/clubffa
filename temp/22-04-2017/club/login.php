<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="shortcut icon"  href="img/club.ico"/>
	<link rel="icon" href="club.ico">
	<meta name="robots" content="noindex">
	<meta name="googlebot" content="noindex">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

	<title>Club de las Fuerzas Armadas de Cordoba</title>

	<link rel="stylesheet" href="css/login.css">
	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" type="text/css">-->
</head>

<body>

	<div class="container">
		
		<div style="margin-top:5%" class="visible-xs visible-sm"></div> 
		<div style="margin-top:20%" class="visible-lg visible-md"></div> <!-- relleno -->
	
		<div class="row">
			<div class="col-md-4 col-lg-4 col-sm-8 col-xs-12" style="margin-left:auto; margin-right:auto; float:none">

				<div class="wrap">
					<p class="form-title" style="font-size:38px;">
						<b>Club de las Fuerzas Armadas de Cordoba	</b></p>
					<form class="login" id="FrmLogin" name="FrmLogin" method="post" action="">
						<input type="text" id="us" name="us" placeholder="Usuario" autocorrect="off" autocapitalize="none"/>
						<input type="password" id="con" name="con" placeholder="Contrase&ntilde;a" />
						<input type="button" value="Ingresar" id="cmdingresar" name="cmdingresar" class="btn btn-sm"  style="background-color:#364852; color:#FFF"/>
						<div class="remember-forgot">
							<div class="row">
								<div class="col-md-12">
									<label id="lblerror" name="lblerror" style="color:#FF0000; font-size:18px;"></label>
								</div>
							</div>
						</div>
						
					</form>
				</div>
				
			</div>
		</div>
	</div>

	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/login.js"></script>

	<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('#FrmLogin').on('click', '#cmdingresar', function(event) {
					
					if(document.getElementById("us").value.trim() != ""){
						if(document.getElementById("con").value.trim() != ""){
							$.ajax({
								url     : 'loginpost.php',
								type    : 'POST',
								dataType: 'json',
								data    : $('#FrmLogin').serialize(),
								success: function( data ){
									document.getElementById("lblerror").innerHTML = data.lblerror;
									if (data.redireccion == 'redirect') {
											window.location.replace(data.link);
																		}
														},
								error:	function( data ) {
									document.getElementById("lblerror").innerHTML = data.lblerror;	
														}
								});
						}else{
							document.getElementById("lblerror").innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'></span>&nbsp;Debe ingresar contrase&ntilde;a";
							}
					}else{
						document.getElementById("lblerror").innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'></span>&nbsp;Debe ingresar usuario";
					}	
        });
	});
	
	$('#us, #con').keypress(function(tecla){
		if(tecla.which == "13"){
			if($(this).prop('id')=="us"){
				$('#con').focus();
			}else{
				$('#cmdingresar').click();
			}
		}
	});
	</script>

</body>
</html>

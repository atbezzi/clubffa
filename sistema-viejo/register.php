<?php 
    require("config.php");
    if(!empty($_POST)) 
    { 
        // Ensure that the user fills out fields 
        if(empty($_POST['username'])) 
        { die("Please enter a username."); } 
        if(empty($_POST['password'])) 
        { die("Please enter a password."); } 
         
        // Check if the username is already taken
        $query = " 
            SELECT 
                1 
            FROM users 
            WHERE 
                username = :username 
        "; 
        $query_params = array( ':username' => $_POST['username'] ); 
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
        $row = $stmt->fetch(); 
        if($row){ die("Este nombre de usuario ya se encuentra actualmente en uso"); } 
        /*$query = " 
            SELECT 
                1 
            FROM users 
            WHERE 
                tipo = :tipo 
        "; 
        $query_params = array( 
            ':tipo' => $_POST['tipo'] 
        ); 
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage());} 
        $row = $stmt->fetch(); 
        if($row){ die("This tipo address is already registered"); }*/
         
        // Add row to database 
        $query = " 
            INSERT INTO users ( 
                username, 
                password, 
                salt, 
                tipo 
            ) VALUES ( 
                :username, 
                :password, 
                :salt, 
                :tipo 
            ) 
        "; 
         
        // Security measures
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
        $password = hash('sha256', $_POST['password'] . $salt); 
        for($round = 0; $round < 65536; $round++){ $password = hash('sha256', $password . $salt); } 
        $query_params = array( 
            ':username' => $_POST['username'], 
            ':password' => $password, 
            ':salt' => $salt, 
            ':tipo' => $_POST['tipo'] 
        ); 
        try {  
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
        header("Location: register.php"); 
        die("Redirecting to register.php"); 
    } 
?>
<!-- Author: Michael Milstead / Mode87.com
     for Untame.net
     Bootstrap Tutorial, 2013
-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Club FFAA</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <meta name="description" content="Bootstrap Tab + Fixed Sidebar Tutorial with HTML5 / CSS3 / JavaScript">
    <meta name="author" content="Untame.net">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="assets/bootstrap.min.js"></script>
    <link href="assets/bootstrap.min.css" rel="stylesheet" media="screen">
    <style type="text/css">
        body { background: url(assets/bglight.png); }
        .hero-unit { background-color: #fff; }
        .center { display: block; margin: 0 auto; }
    </style>
</head>

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
          <li><a href="menu.php">Volver</a></li>
		  <li class="divider-vertical"></li>
		  <li><a href="logout.php">Desconectarse</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="container hero-unit">
    <h1>Registro</h1> <br /><br />
    <form action="register.php" method="post"> 
        <label>Nombre Usuario:<strong style="color:darkred;">*</strong></label> 
        <input type="text" name="username" value="" style="width:287px;height:26px" /> 
        <label>Tipo:</label> 
        <SELECT style="width:300px;height:35px" NAME="tipo" class="" id="tipo" placeholder="Seleccione Tipo Socio">
		<option value="0"> - Seleccione - </option>
		<OPTION value="1">Administrador</OPTION>
		<OPTION value="2">Presidente</OPTION>
		<OPTION value="3">Tesorero</OPTION>
		<OPTION value="4">Consultor</OPTION> 
		</SELECT>
        <label>Contraseña:</label> 
        <input type="password" name="password" value="" style="width:287px;height:26px" /> <br /><br />
        <p style="color:darkred;">* Recuerden que los nombres de usuarios deben ser unicos e irrepetibles.</p><br />
        <input type="submit" class="btn btn-info" value="Register" /> 
    </form>
</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
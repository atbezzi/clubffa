<!doctype html>
<html lang="es">
<head>
<link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="assets/bootstrap.min.js"></script>
    <link href="assets/bootstrap.min.css" rel="stylesheet" media="screen">
	<style type="text/css">
		.row.vdivide [class*='col-']:not(:last-child):after {
		  background: #e0e0e0;
		  width: 1px;
		  content: "";
		  display:block;
		  position: absolute;
		  top:0;
		  bottom: 0;
		  right: 0;
		  min-height: 70px;
		}
	</style>
</head>
<body>
<div class="container">
  <div class="row vdivide">
    <div class="col-sm-4 text-center"><h1>One</h1></div>
    <div class="col-sm-4 text-center"><h1>Two</h1></div>
    <div class="col-sm-4 text-center"><h1>Three</h1></div>
  </div>
</div>
<hr>
<div class="container">
  <div class="row vdivide">
    <div class="col-sm-6 text-center"><h1>One</h1></div>
    <div class="col-sm-6 text-center"><h1>Two</h1></div>
  </div>
</div>
<hr>
<div class="container">
  <div class="row vdivide">
    <div class="col-sm-3 text-center"><h1>One</h1></div>
    <div class="col-sm-3 text-center"><h1>Two</h1></div>
    <div class="col-sm-3 text-center"><h1>Three</h1></div>
    <div class="col-sm-3 text-center"><h1>Four</h1></div>
  </div>
</div>
<hr>
</body>
</html>
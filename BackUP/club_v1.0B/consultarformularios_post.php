<?php
  
      $buscar = $_POST['b'];
        
      if(!empty($buscar)) {
            buscar($buscar);
      }
      else{ 
      	consultar();;
      }
        
      function buscar($b) {
            $con = mysql_connect('localhost','root', '');
            mysql_select_db('clubffaa', $con);
        
            $sql = mysql_query("select f.id as idsolicitud, f.tipo as stipo, s.id as idsoc, s.nsocio, s.nombre, s.apellido, s.tipo, f.estado from solicitudes f inner join socios s on s.id = f.socio_id WHERE s.nombre LIKE '%".$b."%' OR s.apellido LIKE '%".$b."%' OR f.id LIKE '%".$b."%' OR s.nsocio LIKE '%".$b."%'" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
			<table class="table table-striped table-bordered">
				<tr>
					<th class="success">Numero de solicitud</th>
					<th class="success">Numero de socio</th>
					<th class="success">Nombre del socio</th>
					<th class="success">Tipo de socio</th>
					<th class="success">Tipo de solicitud</th>
					<th class="success">Estado de la solicitud</th>
					<th class="success">Accion</th>
				</tr>
			<?php
				while($row=mysql_fetch_array($sql)){
                $idsolicitud = $row['idsolicitud'] ;
				$nsocio = $row['nsocio'] ;
                $nombre = $row['nombre']. ', '.$row['apellido'] ;
         		$tipo = $row['tipo'] ;
         		$stipo = $row['stipo'] ;
				$estado = $row['estado'] ;
         		?>					
				<tr>
				<td><?php echo $idsolicitud;?></td>
				<td><?php echo $nsocio;?></td>
				<td><?php echo $nombre;?></td>
				<td><?php echo $tipo;?></td>
				<td><?php echo $stipo;?></td>
				<td><?php echo $estado;?></td>
				<td>
				<a href="#" data-toggle="modal" data-target="#myModal1" data-id="<?php echo $row['idsolicitud'];?>">
				<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
				</td>
				</tr>
			<!-- Modal -->
				<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="modal-title" id="myModalLabel"><span class="label label-success">Datos del Afiliado</span></h3>
					  </div>
					  <div class="modal-body">
						<h3>ID Solicitud: <span class="label label-primary"><label id="lblid"></label></span></h3><hr>
						<h3>Tipo Solicitud: <span class="label label-primary"><label id="lbltipo"></label></span></h3><hr>
						<h3>Numero de Socio: <span class="label label-primary"><label id="lblnumero"></label></span></h3><hr>
						<h3>Nombre: <span class="label label-primary"><label id="lblnombre"></label></span></h3><hr>
						<h3>Apellido: <span class="label label-primary"><label id="lblapellido"></label></span></h3><hr>
						<h3>Motivo: <span class="label label-primary"><label id="lblmotivo"></label></span></h3><hr>
						<h3>Estado: <span class="label label-primary"><label id="lblestado"></label></span></h3><hr>
						<h3>Presidente: <span class="label label-primary"><label id="lblpres"></label></span></h3><hr>
						<h3>Observacion: <span class="label label-primary"><label id="lblobservacion"></label></span></h3>
					  </div>
					  
					  <div class="modal-footer">
						<button type="button" class="pull-right botoncss" data-dismiss="modal">Cerrar</button>
					  </div>
					</div>
				  </div>
				</div>
             <?php
            }
        }
  }

  function consultar() { 
  	 $con = mysql_connect('localhost','root', '');
            mysql_select_db('clubffaa', $con);
        
            $sql = mysql_query("select f.id as idsolicitud, f.tipo as stipo, s.id as idsoc, s.nsocio, s.nombre, s.apellido, s.tipo, f.estado from solicitudes f inner join socios s on s.id = f.socio_id" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
            <table class="table table-striped table-bordered">
            	<tr>
					<th class="success">Numero de solicitud</th>
					<th class="success">Numero de socio</th>
					<th class="success">Nombre del socio</th>
					<th class="success">Tipo de socio</th>
					<th class="success">Tipo de solicitud</th>
					<th class="success">Estado de la solicitud</th>
					<th class="success">Accion</th>
				</tr>
				<?php
				while($row=mysql_fetch_array($sql)){
				$idsolicitud = $row['idsolicitud'] ;
				$nsocio = $row['nsocio'] ;
                $nombre = $row['nombre']. ', '.$row['apellido'] ;
         		$tipo = $row['tipo'] ;
         		$stipo = $row['stipo'] ;
				$estado = $row['estado'] ;
         		?>						
				<tr>
					<td><?php echo $idsolicitud;?></td>
					<td><?php echo $nsocio;?></td>
					<td><?php echo $nombre;?></td>
					<td><?php echo $tipo;?></td>
					<td><?php echo $stipo;?></td>
					<td><?php echo $estado;?></td>
					<td>
					<a href="#" data-toggle="modal" data-target="#myModal2" data-id="<?php echo $row['idsolicitud'];?>">
					<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
					</td>
				</tr>
				<!-- Modal -->
				<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="modal-title" id="myModalLabel"><span class="label label-success">Datos del Afiliado</span></h3>
					  </div>
					  <div class="modal-body">
						<h3>ID Solicitud: <span class="label label-primary"><label id="lblid"></label></span></h3><hr>
						<h3>Tipo Solicitud: <span class="label label-primary"><label id="lbltipo"></label></span></h3><hr>
						<h3>Numero de Socio: <span class="label label-primary"><label id="lblnumero"></label></span></h3><hr>
						<h3>Nombre: <span class="label label-primary"><label id="lblnombre"></label></span></h3><hr>
						<h3>Apellido: <span class="label label-primary"><label id="lblapellido"></label></span></h3><hr>
						<h3>Motivo: <span class="label label-primary"><label id="lblmotivo"></label></span></h3><hr>
						<h3>Estado: <span class="label label-primary"><label id="lblestado"></label></span></h3><hr>
						<h3>Presidente: <span class="label label-primary"><label id="lblpres"></label></span></h3><hr>
						<h3>Observacion: <span class="label label-primary"><label id="lblobservacion"></label></span></h3>
					  </div>
					  
					  <div class="modal-footer">
						<button type="button" class="pull-right botoncss" data-dismiss="modal">Cerrar</button>
					  </div>
					</div>
				  </div>
				</div>
             <?php
            }
        }
  }
?>
<script type="text/javascript">
	 $("a[data-toggle=modal]").click(function() 
    {		
		console.log($(this).attr("data-id"));
		
		$.ajax({			
			url     : "buscarformulario.php?idsolicitud="+$(this).attr("data-id"),
			type    : "POST",
			dataType: "json",
	 success: function( data ){
								console.log(data.encontro);
								if (data.encontro =="SI")
								{
								document.getElementById("lblid").innerHTML = data.idsol;
								document.getElementById("lbltipo").innerHTML = data.tiposol;
								document.getElementById("lblnumero").innerHTML = data.numsocio;
								document.getElementById("lblnombre").innerHTML = data.nombre;
								document.getElementById("lblapellido").innerHTML = data.apellido;
								document.getElementById("lblmotivo").innerHTML = data.motivo;
								document.getElementById("lblestado").innerHTML = data.estado;
								document.getElementById("lblpres").innerHTML = data.nomusuario;
								document.getElementById("lblobservacion").innerHTML = data.observacion;
								}
								else
								{
								document.getElementById("lblid").innerHTML = "";
								document.getElementById("lbltipo").innerHTML = "";
								document.getElementById("lblnumero").innerHTML = "";
								document.getElementById("lblnombre").innerHTML = "";
								document.getElementById("lblapellido").innerHTML = "";
								document.getElementById("lblmotivo").innerHTML = "";
								document.getElementById("lblestado").innerHTML = "";
								document.getElementById("lblpres").innerHTML = "";
								document.getElementById("lblobservacion").innerHTML = "";
								}
							},
	 error:	function( data ){
								document.getElementById("lblid").innerHTML = "error";
								document.getElementById("lbltipo").innerHTML = "error";
								document.getElementById("lblnumero").innerHTML = "error";
								document.getElementById("lblnombre").innerHTML = "error";
								document.getElementById("lblapellido").innerHTML = "error";
								document.getElementById("lblmotivo").innerHTML = "error";
								document.getElementById("lblestado").innerHTML = "error";
								document.getElementById("lblpres").innerHTML = "error";
								document.getElementById("lblobservacion").innerHTML = "error";
							}													
	});
});
	</script>

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
        
            $sql = mysql_query("select id, nsocio, nombre, apellido, tipo from socios WHERE (nombre LIKE '%".$b."%' OR apellido LIKE '%".$b."%' OR nsocio LIKE '%".$b."%') and (estado = 'Activo') " ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
			<table class="table table-striped table-bordered">
			<tr>
				<th class="success">Numero de socio</th>
				<th class="success">Nombre del socio</th>
				<th class="success">Tipo de socio</th>
				<th  class="success">Accion</th>
				<th class="success">Ver</th>
			</tr>
			<?php
				while($row=mysql_fetch_array($sql)){
				$nsocio = $row['nsocio'] ;
                $nombre = $row['nombre']. ', '.$row['apellido'] ;
         		$tipo = $row['tipo'] ;
         		?>					
				<tr>
					<td><?php echo $nsocio;?></td>
					<td><?php echo $nombre;?></td>
					<td><?php echo $tipo;?></td>
					<td>
									<div>
									<?php

									if ($row['tipo'] == 'Civil'){
										echo '<h7><a href="modificarformularioscivil.php?accion=modifica&idu='.$row['id'].'&close=dor"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a></h7>';
									}else{
										if ($row['tipo'] == 'Pensionista'){
											echo '<h7><a href="modificarformulariospensionista.php?accion=modifica&idu='.$row['id'].'&close=dor"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a></h7>';
										}else{
											if ($row['tipo'] == 'Militar'){
												echo '<h7><a href="modificarformulariosmilitar.php?accion=modifica&idu='.$row['id'].'&close=dor"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a></h7>';
											}
										}
									}
									?>
									</div>
									</td>
									<td>
									<a href="#" data-toggle="modal" data-target="#myModal1" data-id="<?php echo $row['id'];?>">
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
						<h3>Tipo de Afiliado: <span class="label label-primary"><label id="lbltipo"></label></span></h3><hr>
						<h3>N° Afiliado: <span class="label label-primary"><label id="lblnsocio"></label></span></h3><hr>
						<h3>Nombre: <span class="label label-primary"><label id="lblnombre"></label></span></h3><hr>
						<h3>Apellido: <span class="label label-primary"><label id="lblapellido"></label></span></h3><hr>
						<h3>Localidad de Nacimiento: <span class="label label-primary"><label id="lbllocalidadnacimiento"></label></span></h3><hr>
						<h3>Fecha de Nacimiento: <span class="label label-primary"><label id="lblfechanacimiento"></label></span></h3><hr>
						<h3>DNI: <span class="label label-primary"><label id="lbldni"></label></span></h3><hr>
						<h3>Estado Civil: <span class="label label-primary"><label id="lblestadocivil"></label></span></h3><hr>
						<h3>Sexo: <span class="label label-primary"><label id="lblsexo"></label></span></h3><hr>
						<h3>Domicilio: <span class="label label-primary"><label id="lbldomicilio"></label></span></h3><hr>
						<h3>Barrio: <span class="label label-primary"><label id="lblbarrio"></label></span></h3><hr>
						<h3>Localidad Actual: <span class="label label-primary"><label id="lbllocaactual"></label></span></h3><hr>
						<h3>Codigo Postal: <span class="label label-primary"><label id="lblcp"></label></span></h3><hr>
						<h3>Telefono: <span class="label label-primary"><label id="lbltelefono"></label></span></h3><hr>
						<h3>Celular: <span class="label label-primary"><label id="lblcelular"></label></span></h3><hr>
						<h3>Email: <span class="label label-primary"><label id="lblemail"></label></span></h3><hr>
						<h3>Forma de Pago: <span class="label label-primary"><label id="lblformadepago"></label></span></h3><hr>
						<h3>Domicilio Cobrador: <span class="label label-primary"><label id="lbldomiciliocobrador"></label></span></h3><hr>
						<h3>Barrio Cobrador: <span class="label label-primary"><label id="lblbarriocobrador"></label></span></h3><hr>
						<h3>Localidad Cobrador: <span class="label label-primary"><label id="lbllocalidad_idcobrador"></label></span></h3><hr>
						<h3>Zona: <span class="label label-primary"><label id="lblzona_id"></label></span></h3><hr>
						<h3>Libro: <span class="label label-primary"><label id="lbllibro"></label></span></h3><hr>
						<h3>Acta: <span class="label label-primary"><label id="lblacta"></label></span></h3><hr>
						<h3>Categoria: <span class="label label-primary"><label id="lblcategoria_id"></label></span></h3><hr>
						<h3>Embarcadero: <span class="label label-primary"><label id="lblestadoembarcadero"></label></span></h3><hr>
						<h3>Estado: <span class="label label-primary"><label id="lblestado"></label></span></h3>
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
        
            $sql = mysql_query("select id, nsocio, nombre, apellido, tipo from socios where estado = 'Activo' " ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
            	<table class="table table-striped table-bordered">
            	<tr>
					<th class="success">Numero de socio</th>
					<th class="success">Nombre del socio</th>
					<th class="success">Tipo de socio</th>
					<th  class="success">Accion</th>
					<th class="success">Ver</th>
				</tr>
				<?php
				while($row=mysql_fetch_array($sql)){
				$nsocio = $row['nsocio'] ;
                $nombre = $row['nombre']. ', '.$row['apellido'] ;
         		$tipo = $row['tipo'] ;
         		?>						
				<tr>
					<td><?php echo $nsocio;?></td>
					<td><?php echo $nombre;?></td>
					<td><?php echo $tipo;?></td>
					<td>
									<div>
									<?php

									if ($row['tipo'] == 'Civil'){
										echo '<h7><a href="modificarformularioscivil.php?accion=modifica&idu='.$row['id'].'&close=dor"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a></h7>';
									}else{
										if ($row['tipo'] == 'Pensionista'){
											echo '<h7><a href="modificarformulariospensionista.php?accion=modifica&idu='.$row['id'].'&close=dor"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a></h7>';
										}else{
											if ($row['tipo'] == 'Militar'){
												echo '<h7><a href="modificarformulariosmilitar.php?accion=modifica&idu='.$row['id'].'&close=dor"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a></h7>';
											}
										}
									}
									?>
									</div>
									</td>
									<td>
									<a href="#" data-toggle="modal" data-target="#myModal2" data-id="<?php echo $row['id'];?>">
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
						<h3>Tipo de Afiliado: <span class="label label-primary"><label id="lbltipo"></label></span></h3><hr>
						<h3>N° Afiliado: <span class="label label-primary"><label id="lblnsocio"></label></span></h3><hr>
						<h3>Nombre: <span class="label label-primary"><label id="lblnombre"></label></span></h3><hr>
						<h3>Apellido: <span class="label label-primary"><label id="lblapellido"></label></span></h3><hr>
						<h3>Localidad de Nacimiento: <span class="label label-primary"><label id="lbllocalidadnacimiento"></label></span></h3><hr>
						<h3>Fecha de Nacimiento: <span class="label label-primary"><label id="lblfechanacimiento"></label></span></h3><hr>
						<h3>DNI: <span class="label label-primary"><label id="lbldni"></label></span></h3><hr>
						<h3>Estado Civil: <span class="label label-primary"><label id="lblestadocivil"></label></span></h3><hr>
						<h3>Sexo: <span class="label label-primary"><label id="lblsexo"></label></span></h3><hr>
						<h3>Domicilio: <span class="label label-primary"><label id="lbldomicilio"></label></span></h3><hr>
						<h3>Barrio: <span class="label label-primary"><label id="lblbarrio"></label></span></h3><hr>
						<h3>Localidad Actual: <span class="label label-primary"><label id="lbllocaactual"></label></span></h3><hr>
						<h3>Codigo Postal: <span class="label label-primary"><label id="lblcp"></label></span></h3><hr>
						<h3>Telefono: <span class="label label-primary"><label id="lbltelefono"></label></span></h3><hr>
						<h3>Celular: <span class="label label-primary"><label id="lblcelular"></label></span></h3><hr>
						<h3>Email: <span class="label label-primary"><label id="lblemail"></label></span></h3><hr>
						<h3>Forma de Pago: <span class="label label-primary"><label id="lblformadepago"></label></span></h3><hr>
						<h3>Domicilio Cobrador: <span class="label label-primary"><label id="lbldomiciliocobrador"></label></span></h3><hr>
						<h3>Barrio Cobrador: <span class="label label-primary"><label id="lblbarriocobrador"></label></span></h3><hr>
						<h3>Localidad Cobrador: <span class="label label-primary"><label id="lbllocalidad_idcobrador"></label></span></h3><hr>
						<h3>Zona: <span class="label label-primary"><label id="lblzona_id"></label></span></h3><hr>
						<h3>Libro: <span class="label label-primary"><label id="lbllibro"></label></span></h3><hr>
						<h3>Acta: <span class="label label-primary"><label id="lblacta"></label></span></h3><hr>
						<h3>Categoria: <span class="label label-primary"><label id="lblcategoria_id"></label></span></h3><hr>
						<h3>Embarcadero: <span class="label label-primary"><label id="lblestadoembarcadero"></label></span></h3><hr>
						<h3>Estado: <span class="label label-primary"><label id="lblestado"></label></span></h3>
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
			url     : "buscarafiliados.php?id="+$(this).attr("data-id"),
			type    : "POST",
			dataType: "json",
	 success: function( data ){
								console.log(data.encontro);
								if (data.encontro =="SI")
								{
								document.getElementById("lbltipo").innerHTML = data.tipo;
								document.getElementById("lblnsocio").innerHTML = data.nsocio;
								document.getElementById("lblnombre").innerHTML = data.nombre;
								document.getElementById("lblapellido").innerHTML = data.apellido;
								document.getElementById("lbllocalidadnacimiento").innerHTML = data.descripcion;
								document.getElementById("lblfechanacimiento").innerHTML = data.fechanacimiento;
								document.getElementById("lbldni").innerHTML = data.dni;
								document.getElementById("lblestadocivil").innerHTML = data.estadocivil;
								document.getElementById("lblsexo").innerHTML = data.sexo;
								document.getElementById("lbldomicilio").innerHTML = data.domicilio;
								document.getElementById("lblbarrio").innerHTML = data.barrio;
								document.getElementById("lbllocaactual").innerHTML = data.descripcion2;
								document.getElementById("lblcp").innerHTML = data.cp;
								document.getElementById("lbltelefono").innerHTML = data.telefono;
								document.getElementById("lblcelular").innerHTML = data.celular;
								document.getElementById("lblemail").innerHTML = data.email;
								document.getElementById("lblformadepago").innerHTML = data.formadepago;
								document.getElementById("lbldomiciliocobrador").innerHTML = data.domiciliocobrador;
								document.getElementById("lblbarriocobrador").innerHTML = data.barriocobrador;
								document.getElementById("lbllocalidad_idcobrador").innerHTML = data.descripcion3;
								document.getElementById("lblzona_id").innerHTML = data.desczona;
								document.getElementById("lbllibro").innerHTML = data.libro;
								document.getElementById("lblacta").innerHTML = data.acta;
								document.getElementById("lblcategoria_id").innerHTML = data.desccat;
								document.getElementById("lblestadoembarcadero").innerHTML = data.estadoembarcadero;
								document.getElementById("lblestado").innerHTML = data.estado;
								}
								else
								{
								document.getElementById("lbltipo").innerHTML = "";
								document.getElementById("lblnsocio").innerHTML = "";
								document.getElementById("lblnombre").innerHTML = "";
								document.getElementById("lblapellido").innerHTML = "";
								document.getElementById("lbllocalidadnacimiento").innerHTML = "";
								document.getElementById("lblfechanacimiento").innerHTML = "";
								document.getElementById("lbldni").innerHTML = "";
								document.getElementById("lblestadocivil").innerHTML = "";
								document.getElementById("lblsexo").innerHTML = "";
								document.getElementById("lbldomicilio").innerHTML = "";
								document.getElementById("lblbarrio").innerHTML = "";
								document.getElementById("lbllocaactual").innerHTML = "";
								document.getElementById("lblcp").innerHTML = "";
								document.getElementById("lbltelefono").innerHTML = "";
								document.getElementById("lblcelular").innerHTML = "";
								document.getElementById("lblemail").innerHTML = "";
								document.getElementById("lblformadepago").innerHTML = "";
								document.getElementById("lbldomiciliocobrador").innerHTML = "";
								document.getElementById("lblbarriocobrador").innerHTML = "";
								document.getElementById("lbllocalidad_idcobrador").innerHTML = "";
								document.getElementById("lblzona_id").innerHTML = "";
								document.getElementById("lbllibro").innerHTML = "";
								document.getElementById("lblacta").innerHTML = "";
								document.getElementById("lblcategoria_id").innerHTML = "";
								document.getElementById("lblestadoembarcadero").innerHTML = "";
								document.getElementById("lblestado").innerHTML = "";
								}
							},
	 error:	function( data ){
								document.getElementById("lbltipo").innerHTML = "error";
								document.getElementById("lblnsocio").innerHTML = "error";
								document.getElementById("lblnombre").innerHTML = "error";
								document.getElementById("lblapellido").innerHTML = "error";
								document.getElementById("lbllocalidadnacimiento").innerHTML = "error";
								document.getElementById("lblfechanacimiento").innerHTML = "error";
								document.getElementById("lbldni").innerHTML = "error";
								document.getElementById("lblestadocivil").innerHTML = "error";
								document.getElementById("lblsexo").innerHTML = "error";
								document.getElementById("lbldomicilio").innerHTML = "error";
								document.getElementById("lblbarrio").innerHTML = "error";
								document.getElementById("lbllocaactual").innerHTML = "error";
								document.getElementById("lblcp").innerHTML = "error";
								document.getElementById("lbltelefono").innerHTML = "error";
								document.getElementById("lblcelular").innerHTML = "error";
								document.getElementById("lblemail").innerHTML = "error";
								document.getElementById("lblformadepago").innerHTML = "error";
								document.getElementById("lbldomiciliocobrador").innerHTML = "error";
								document.getElementById("lblbarriocobrador").innerHTML = "error";
								document.getElementById("lbllocalidad_idcobrador").innerHTML = "error";
								document.getElementById("lblzona_id").innerHTML = "error";
								document.getElementById("lbllibro").innerHTML = "error";
								document.getElementById("lblacta").innerHTML = "error";
								document.getElementById("lblcategoria_id").innerHTML = "error";
								document.getElementById("lblestadoembarcadero").innerHTML = "error";
								document.getElementById("lblestado").innerHTML = "error";
							}													
	});
});
	</script>

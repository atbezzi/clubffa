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
        
            $sql = mysql_query("select e.id as idembarca, e.nombre, e.matricula, e.arboladura, s.nsocio, s.nombre as snombre, s.apellido from embarcaciones e inner join socios s on s.id=e.socio_id WHERE (e.nombre LIKE '%".$b."%' OR e.matricula LIKE '%".$b."%' OR s.nsocio LIKE '%".$b."%') and (e.estado = 'Activo') " ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
			<table class="table table-striped table-bordered">
			<tr>
				<th class="success text-center">Nombre</th>
				<th class="success text-center">Arboladura</th>
				<th class="success text-center">Matricula</th>
				<th class="success text-center">Número de socio</th>
				<th class="success text-center">Nombre del socio</th>
				<th class="success text-center">Editar</th>
				<th class="success text-center">Baja</th>
				<th class="success text-center">Ver+</th>
				<th class="success text-center">QR</th>
				<th class="success text-center">Foto</th>
			</tr>
			<?php
				while($row=mysql_fetch_array($sql)){
                $nombre = $row['nombre'] ;
				$arboladura = $row['arboladura'] ;
         		$matricula = $row['matricula'] ;
         		$nsocio = $row['nsocio'] ;
                $snombre = $row['snombre']. ', '.$row['apellido'] ;
         		?>					
				<tr>
					<td class="text-center"><?php echo $nombre;?></td>
					<td class="text-center"><?php echo $arboladura;?></td>
					<td class="text-center"><?php echo $matricula;?></td>
					<td class="text-center"><?php echo $nsocio;?></td>
					<td class="text-center"><?php echo $snombre;?></td>
					<td class="text-center">
					<span class="label label-primary text-center">
					<a href="modificarembarcacion.php?accion=modifica&ide=<?php echo $row['idembarca'];?>&close=dor">
					<font color=white><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></font></a>
					</span>
					</td>
					<td class="text-center">
					<span class="label label-danger text-center">
					<a href="consultarembarcacion.php?accion=baja&idembarca=<?php echo $row['idembarca'];?>&close=dor">
					<font color=white><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></font></a>
					</span>
					</td>
					<td class="text-center">
					<span class="label label-success text-center">
					<a href="#" data-toggle="modal" data-target="#myModal1" data-id="<?php echo $row['idembarca'];?>">
					<font color=white><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></font></a>
					</span>
					</td>
					<td class="text-center">
					<span class="label label-warning text-center">
					<a href="qr/buscarimprimirqr.php?accion=imprimir&ide=<?php echo $row['idembarca'];?>&close=dor" target="_blank">
					<font color=white><span class="glyphicon glyphicon-qrcode" aria-hidden="true"></span></font></a>
					</span>
					</td>
					<td class="text-center">
					<span class="label label-default text-center">
					<a href="fotoembarca.php?accion=modifica&idf=<?php echo $row['idembarca'];?>&close=dor">
					<font color=white><span class="glyphicon glyphicon-picture" aria-hidden="true"></span></font></a>
					</span>
					</td>
					</tr>
				<!-- Modal -->
				<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel"><span class="label label-success">Datos de la embarcación</span></h4>
					  </div>
					  <div class="modal-body">
						<h3>Nombre embarcación: <span class="label label-primary"><label id="lblnombre"></label></span></h3><br>
						<h3>Arboladura: <span class="label label-primary"><label id="lblarboladura"></label></span></h3><br>
						<h3>Casco: <span class="label label-primary"><label id="lblcasco"></label></span></h3><br>
						<h3>Eslora: <span class="label label-primary"><label id="lbleslora"></label></span></h3><br>
						<h3>Manga: <span class="label label-primary"><label id="lblmanga"></label></span></h3><br>
						<h3>Puntal: <span class="label label-primary"><label id="lblpuntal"></label></span></h3><br>
						<h3>Calado: <span class="label label-primary"><label id="lblcalado"></label></span></h3><br>
						<h3>Tonelaje: <span class="label label-primary"><label id="lbltonelaje"></label></span></h3><br>
						<h3>Marca motor: <span class="label label-primary"><label id="lblmarcacotor"></label></span></h3><br>
						<h3>Numero motor: <span class="label label-primary"><label id="lblnumeromotor"></label></span></h3><br>
						<h3>Potencia motor: <span class="label label-primary"><label id="lblpotmotor"></label></span></h3><br>
						<h3>Matricula: <span class="label label-primary"><label id="lblmatricula"></label></span></h3><br>
						<h3>Rey: <span class="label label-primary"><label id="lblrey"></label></span></h3><br>
						<h3>Fecha última inspección: <span class="label label-primary"><label id="lblfecinsp"></label></span></h3><br>
						<h3>N° de socio: <span class="label label-primary"><label id="lblcodigosocio"></label></span></h3><br>
						<h3>Elementos: <span class="label label-primary"><label id="lblelementos"></label></span></h3><br>
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
        
            $sql = mysql_query("select e.id as idembarca, e.nombre, e.matricula, e.arboladura, s.nsocio, s.nombre as snombre, s.apellido from embarcaciones e inner join socios s on s.id=e.socio_id where e.estado = 'Activo'" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
            	<table class="table table-striped table-bordered">
            	<tr>
				<th class="success text-center">Nombre</th>
				<th class="success text-center">Arboladura</th>
				<th class="success text-center">Matricula</th>
				<th class="success text-center">Número de socio</th>
				<th class="success text-center">Nombre del socio</th>
				<th class="success text-center">Editar</th>
				<th class="success text-center">Baja</th>
				<th class="success text-center">Ver+</th>
				<th class="success text-center">QR</th>
				<th class="success text-center">Foto</th>
				</tr>
				<?php
				while($row=mysql_fetch_array($sql)){
                $nombre = $row['nombre'] ;
				$arboladura = $row['arboladura'] ;
         		$matricula = $row['matricula'] ;
         		$nsocio = $row['nsocio'] ;
                $snombre = $row['snombre']. ', '.$row['apellido'] ;
         		?>						
				<tr>
					<td class="text-center"><?php echo $nombre;?></td>
					<td class="text-center"><?php echo $arboladura;?></td>
					<td class="text-center"><?php echo $matricula;?></td>
					<td class="text-center"><?php echo $nsocio;?></td>
					<td class="text-center"><?php echo $snombre;?></td>
					<td class="text-center">
					<span class="label label-primary text-center">
					<a href="modificarembarcacion.php?accion=modifica&ide=<?php echo $row['idembarca'];?>&close=dor">
					<font color=white><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></font></a>
					</span>
					</td>
					<td class="text-center">
					<span class="label label-danger text-center">
					<a href="consultarembarcacion.php?accion=baja&idembarca=<?php echo $row['idembarca'];?>&close=dor">
					<font color=white><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></font></a>
					</span>
					</td>
					<td class="text-center">
					<span class="label label-success text-center">
					<a href="#" data-toggle="modal" data-target="#myModal2" data-id="<?php echo $row['idembarca'];?>">
					<font color=white><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></font></a>
					</span>
					</td>
					<td class="text-center">
					<span class="label label-warning text-center">
					<a href="qr/buscarimprimirqr.php?accion=imprimir&ide=<?php echo $row['idembarca'];?>&close=dor" target="_blank">
					<font color=white><span class="glyphicon glyphicon-qrcode" aria-hidden="true"></span></font></a>
					</span>
					</td>
					<td class="text-center">
					<span class="label label-default text-center">
					<a href="fotoembarca.php?accion=modifica&idf=<?php echo $row['idembarca'];?>&close=dor">
					<font color=white><span class="glyphicon glyphicon-picture" aria-hidden="true"></span></font></a>
					</span>
					</td>
					</tr>
				</tr>
			<!-- Modal -->
			<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><span class="label label-success">Datos de la embarcación</span></h4>
				  </div>
				  <div class="modal-body">
					<h3>Nombre embarcación: <span class="label label-primary"><label id="lblnombre"></label></span></h3><br>
					<h3>Arboladura: <span class="label label-primary"><label id="lblarboladura"></label></span></h3><br>
					<h3>Casco: <span class="label label-primary"><label id="lblcasco"></label></span></h3><br>
					<h3>Eslora: <span class="label label-primary"><label id="lbleslora"></label></span></h3><br>
					<h3>Manga: <span class="label label-primary"><label id="lblmanga"></label></span></h3><br>
					<h3>Puntal: <span class="label label-primary"><label id="lblpuntal"></label></span></h3><br>
					<h3>Calado: <span class="label label-primary"><label id="lblcalado"></label></span></h3><br>
					<h3>Tonelaje: <span class="label label-primary"><label id="lbltonelaje"></label></span></h3><br>
					<h3>Marca motor: <span class="label label-primary"><label id="lblmarcacotor"></label></span></h3><br>
					<h3>Numero motor: <span class="label label-primary"><label id="lblnumeromotor"></label></span></h3><br>
					<h3>Potencia motor: <span class="label label-primary"><label id="lblpotmotor"></label></span></h3><br>
					<h3>Matricula: <span class="label label-primary"><label id="lblmatricula"></label></span></h3><br>
					<h3>Rey: <span class="label label-primary"><label id="lblrey"></label></span></h3><br>
					<h3>Fecha última inspección: <span class="label label-primary"><label id="lblfecinsp"></label></span></h3><br>
					<h3>N° de socio: <span class="label label-primary"><label id="lblcodigosocio"></label></span></h3><br>
					<h3>Elementos: <span class="label label-primary"><label id="lblelementos"></label></span></h3><br>
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
<script>
	 $("a[data-toggle=modal]").click(function() 
    {   
		console.log($(this).attr('data-id'));
		
		$.ajax({			
			url     : 'buscarembarcaciones.php?idembarca='+$(this).attr('data-id'),
			type    : 'POST',
			dataType: 'json',
	success: function( data ) {
			console.log(data.encontro);
			if (data.encontro =="SI")
			{
			document.getElementById("lblnombre").innerHTML = data.nombre;
			document.getElementById("lblarboladura").innerHTML = data.arboladura;
			document.getElementById("lblcasco").innerHTML = data.casco;
			document.getElementById("lbleslora").innerHTML = data.eslora;
			document.getElementById("lblmanga").innerHTML = data.manga;
			document.getElementById("lblpuntal").innerHTML = data.puntal;
			document.getElementById("lblcalado").innerHTML = data.calado;
			document.getElementById("lbltonelaje").innerHTML = data.tonelaje;
			document.getElementById("lblmarcacotor").innerHTML = data.motormarca;
			document.getElementById("lblnumeromotor").innerHTML = data.motornumero;
			document.getElementById("lblpotmotor").innerHTML = data.motorpotencia;
			document.getElementById("lblmatricula").innerHTML = data.matricula;
			document.getElementById("lblrey").innerHTML = data.rey;
			document.getElementById("lblfecinsp").innerHTML = data.inspeccion;
			document.getElementById("lblcodigosocio").innerHTML = data.socio_id;
			document.getElementById("lblelementos").innerHTML = data.elementos;
			}
			else
			{
			document.getElementById("lblnombre").innerHTML = "";
			document.getElementById("lblarboladura").innerHTML = "";
			document.getElementById("lblcasco").innerHTML = "";
			document.getElementById("lbleslora").innerHTML = "";
			document.getElementById("lblmanga").innerHTML = "";
			document.getElementById("lblpuntal").innerHTML = "";
			document.getElementById("lblcalado").innerHTML = "";
			document.getElementById("lbltonelaje").innerHTML = "";
			document.getElementById("lblmarcacotor").innerHTML = "";
			document.getElementById("lblnumeromotor").innerHTML = "";
			document.getElementById("lblpotmotor").innerHTML = "";
			document.getElementById("lblmatricula").innerHTML = "";
			document.getElementById("lblrey").innerHTML = "";
			document.getElementById("lblfecinsp").innerHTML = "";
			document.getElementById("lblcodigosocio").innerHTML = "";
			document.getElementById("lblelementos").innerHTML = "";
			}
					
							},
	error:	function( data ) {
		
			document.getElementById("lblnombre").innerHTML = "error";
			document.getElementById("lblarboladura").innerHTML = "error";
			document.getElementById("lblcasco").innerHTML = "error";
			document.getElementById("lbleslora").innerHTML = "error";
			document.getElementById("lblmanga").innerHTML = "error";
			document.getElementById("lblpuntal").innerHTML = "error";
			document.getElementById("lblcalado").innerHTML = "error";
			document.getElementById("lbltonelaje").innerHTML = "error";
			document.getElementById("lblmarcacotor").innerHTML = "error";
			document.getElementById("lblnumeromotor").innerHTML = "error";
			document.getElementById("lblpotmotor").innerHTML = "error";
			document.getElementById("lblmatricula").innerHTML = "error";
			document.getElementById("lblrey").innerHTML = "error";
			document.getElementById("lblfecinsp").innerHTML = "error";
			document.getElementById("lblcodigosocio").innerHTML = "error";
			document.getElementById("lblelementos").innerHTML = "error";
							}														
});
    });
	
	</script>
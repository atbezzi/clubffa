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
				<th class="warning">Numero de solicitud</th>
				<th class="warning">Numero de socio</th>
				<th class="warning">Nombre del socio</th>
				<th class="warning">Tipo de socio</th>
				<th  class="warning">Tipo de solicitud</th>
				<th  class="warning">Estado de la solicitud</th>
				<th  class="warning">Accion</th>
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
					<?php if ($tipo=="Civil")
					{?>
					<a href="consultarformularioscivil.php?accion=consultar&idu=<?php echo $row['idsoc'];?>&close=dor">
					<?php	}
							if ($tipo=="Pensionista")
							{
						?>
						<a href="consultarformulariospensionista.php?accion=consultar&idu=<?php echo $row['idsoc'];?>&close=dor">
						<?php
							}
						?>
					<?php if ($tipo=="Militar")
					{?>
					<a href="consultarformulariosmilitar.php?accion=consultar&idu=<?php echo $row['idsoc'];?>&close=dor">
					<?php	}?>
					<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>	
					</td>
					</tr>
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
					<th class="warning">Numero de solicitud</th>
					<th class="warning">Numero de socio</th>
					<th class="warning">Nombre del socio</th>
					<th class="warning">Tipo de socio</th>
					<th  class="warning">Tipo de solicitud</th>
					<th  class="warning">Estado de la solicitud</th>
					<th  class="warning">Accion</th>
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
					<?php if ($tipo=="Civil")
					{?>
					<a href="consultarformularioscivil.php?accion=consultar&idu=<?php echo $row['idsoc'];?>&close=dor">
					<?php	}
							if ($tipo=="Pensionista")
							{
						?>
						<a href="consultarformulariospensionista.php?accion=consultar&idu=<?php echo $row['idsoc'];?>&close=dor">
						<?php
							}
						?>
					<?php if ($tipo=="Militar")
					{?>
					<a href="consultarformulariosmilitar.php?accion=consultar&idu=<?php echo $row['idsoc'];?>&close=dor">
					<?php	}?>
					<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>	
					</td>
				</tr>
             <?php
            }
        }
  }  
?>

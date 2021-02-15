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
				<th class="warning">Nombre</th>
				<th class="warning">Arboladura</th>
				<th class="warning">Matricula</th>
				<th class="warning">Número de socio</th>
				<th class="warning">Nombre del socio</th>
				<th class="warning">Editar</th>
				<th class="warning">Acciones</th>
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
					<td><?php echo $nombre;?></td>
					<td><?php echo $arboladura;?></td>
					<td><?php echo $matricula;?></td>
					<td><?php echo $nsocio;?></td>
					<td><?php echo $snombre;?></td>
					<td>
					<a href="modificarembarcacion.php?accion=modifica&ide=<?php echo $row['idembarca'];?>&close=dor">
					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
					</td>
					<td>
					<a href="#" data-toggle="modal" data-target="#myModal" data-id="<?php echo $row['id'];?>">
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
        
            $sql = mysql_query("select e.id as idembarca, e.nombre, e.matricula, e.arboladura, s.nsocio, s.nombre as snombre, s.apellido from embarcaciones e inner join socios s on s.id=e.socio_id" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
            	<table class="table table-striped table-bordered">
            	<tr>
				<th class="warning">Nombre</th>
				<th class="warning">Arboladura</th>
				<th class="warning">Matricula</th>
				<th class="warning">Número de socio</th>
				<th class="warning">Nombre del socio</th>
				<th class="warning">Editar</th>
				<th class="warning">Acciones</th>
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
					<td><?php echo $nombre;?></td>
					<td><?php echo $arboladura;?></td>
					<td><?php echo $matricula;?></td>
					<td><?php echo $nsocio;?></td>
					<td><?php echo $snombre;?></td>
					<td>
					<a href="modificarembarcacion.php?accion=modifica&ide=<?php echo $row['idembarca'];?>&close=dor">
					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
					</td>
					<td>
					<a href="#" data-toggle="modal" data-target="#myModal" data-id="<?php echo $row['id'];?>">
					<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
					</td>
					</tr>
				</tr>
             <?php
            }
        }
  }  
?>

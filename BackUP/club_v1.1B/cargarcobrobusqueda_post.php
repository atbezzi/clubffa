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
					<a href="cargarcobrodos.php?accion=buscar&idu=<?php echo $row['nsocio'];?>&close=dor">
					<span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
					</td>
					</tr>
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
					<a href="cargarcobrodos.php?accion=buscar&idu=<?php echo $row['nsocio'];?>&close=dor">
					<span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
					</td>
				</tr>
             <?php
            }
        }
  }  
?>

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
        
            $sql = mysql_query("SELECT c.id, c.zona_id, c.nombre, c.apellido, c.estado, z.descripcion FROM cobradores c INNER JOIN zonas z ON c.zona_id = z.id WHERE c.nombre LIKE '%".$b."%' OR c.apellido LIKE '%".$b."%' LIMIT 10" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
			<table class="table table-striped table-bordered">
			<tr>
				<th class="success">Nombre/s y Apellido/s</th>
				<th class="success">Zona</th>
				<th class="success">Estado</th>
				<th class="success">Acciones</th>
			</tr>
			<?php
				while($row=mysql_fetch_array($sql)){
                $nombre = $row['nombre']. ', '.$row['apellido'] ;
         		$descripcion = $row['descripcion'] ;
				$estado = $row['estado'] ;
         		?>					
				<tr>
						<td><?php echo $nombre;?></td>
						<td><?php echo $descripcion;?></td>
						<td><?php echo $estado;?></td>
						<td>
						<?php if ($row['estado']=="P")
						{?>
						<a href="consultarcobrador.php?accion=alta&idc=<?php echo $row['id'];?>&close=dor">
						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
						&nbsp;&nbsp;
						<a href="consultarcobrador.php?accion=baja&idc=<?php echo $row['id'];?>&close=dor">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
						<?php	}
								if ($row['estado']=="Activo")
								{
							?>
							<a href="consultarcobrador.php?accion=baja&idc=<?php echo $row['id'];?>&close=dor">
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
							<?php
								}
							?>
						<?php if ($row['estado']=="Inactivo")
						{?>
						<a href="consultarcobrador.php?accion=alta&idc=<?php echo $row['id'];?>&close=dor">
						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
						<?php	}?>
						
						<a href="modificarcobrador.php?accion=modifica&idc=<?php echo $row['id'];?>&close=dor">
						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
						</td>
					</tr>
             <?php
            }
        }
  }

  function consultar() { 
  	 $con = mysql_connect('localhost','root', '');
            mysql_select_db('clubffaa', $con);
        
            $sql = mysql_query("SELECT c.id, c.zona_id, c.nombre, c.apellido, c.estado, z.descripcion FROM cobradores c INNER JOIN zonas z ON c.zona_id = z.id" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
            	<table class="table table-striped table-bordered">
            	<tr>
					<th class="success">Nombre/s y Apellido/s</th>
					<th class="success">Zona</th>
					<th class="success">Estado</th>
					<th class="success">Acciones</th>
				</tr>
				<?php
				while($row=mysql_fetch_array($sql)){
                $nombre = $row['nombre']. ', '.$row['apellido'] ;
         		$descripcion = $row['descripcion'] ;
				$estado = $row['estado'] ;
         		?>						
				<tr>
					<td><?php echo $nombre;?></td>
					<td><?php echo $descripcion;?></td>
					<td><?php echo $estado;?></td>
					<td>
					<?php if ($row['estado']=="P")
					{?>
					<a href="consultarcobrador.php?accion=alta&idc=<?php echo $row['id'];?>&close=dor">
					<span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
					&nbsp;&nbsp;
					<a href="consultarcobrador.php?accion=baja&idc=<?php echo $row['id'];?>&close=dor">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
					<?php	}
							if ($row['estado']=="Activo")
							{
						?>
						<a href="consultarcobrador.php?accion=baja&idc=<?php echo $row['id'];?>&close=dor">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
						<?php
							}
						?>
					<?php if ($row['estado']=="Inactivo")
					{?>
					<a href="consultarcobrador.php?accion=alta&idc=<?php echo $row['id'];?>&close=dor">
					<span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
					<?php	}?>
					
					<a href="modificarcobrador.php?accion=modifica&idc=<?php echo $row['id'];?>&close=dor">
					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
					</td>
				</tr>
             <?php
            }
        }
  }  
?>



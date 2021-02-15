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
        
            $sql = mysql_query("SELECT c.id, c.zona_id, c.nombre, c.apellido, c.estado, z.descripcion FROM cobradores c INNER JOIN zonas z ON c.zona_id = z.id WHERE c.estado = 'Activo' and c.nombre LIKE '%".$b."%' OR c.apellido LIKE '%".$b."%' LIMIT 10" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
			<table class="table table-striped table-bordered">
			<tr>
				<th class="success text-center">Nombre/s y apellido/s</th>
				<th class="success text-center">Zona</th>
				<th class="success text-center">Baja</th>
				<th class="success text-center">Editar</th>
			</tr>
			<?php
				while($row=mysql_fetch_array($sql)){
                $nombre = $row['nombre']. ', '.$row['apellido'] ;
         		$descripcion = $row['descripcion'] ;
         		?>					
				<tr>
						<td class="text-center"><?php echo $nombre;?></td>
						<td class="text-center"><?php echo $descripcion;?></td>
						<td class="text-center">
						<?php if ($row['estado']=="Pendiente")
						{?>
						<span class="label label-warning text-center">
						<a href="consultarcobrador.php?accion=alta&idc=<?php echo $row['id'];?>&close=dor">
						<font color=white><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></font></a>
						&nbsp;&nbsp;
						<a href="consultarcobrador.php?accion=baja&idc=<?php echo $row['id'];?>&close=dor" onclick="return confirm('¿Esta seguro que desea dar de baja este cobrador?')">
						<font color=white><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></font></a>
						</span>
						<?php	}
								if ($row['estado']=="Activo")
								{
							?>
							<span class="label label-danger text-center">
							<a href="consultarcobrador.php?accion=baja&idc=<?php echo $row['id'];?>&close=dor" onclick="return confirm('¿Esta seguro que desea dar de baja este cobrador?')">
							<font color=white><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></font></a>
							</span>
							<?php
								}
							?>
						<?php if ($row['estado']=="Inactivo")
						{?>
						<span class="label label-success text-center">
						<a href="consultarcobrador.php?accion=alta&idc=<?php echo $row['id'];?>&close=dor">
						<font color=white><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></font></a>
						</span>
						<?php	}?>
						</td>
						<td class="text-center">
						<span class="label label-primary text-center">
						<a href="modificarcobrador.php?accion=modifica&idc=<?php echo $row['id'];?>&close=dor">
						<font color=white><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></font></a>
						</span>
						</td>
					</tr>
             <?php
            }
        }
  }

  function consultar() { 
  	 $con = mysql_connect('localhost','root', '');
            mysql_select_db('clubffaa', $con);
        
            $sql = mysql_query("SELECT c.id, c.zona_id, c.nombre, c.apellido, c.estado, z.descripcion FROM cobradores c INNER JOIN zonas z ON c.zona_id = z.id where c.estado = 'Activo'" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
            	<table class="table table-striped table-bordered">
            	<tr>
					<th class="success text-center">Nombre/s y apellido/s</th>
					<th class="success text-center">Zona</th>
					<th class="success text-center">Baja</th>
					<th class="success text-center">Editar</th>
				</tr>
				<?php
				while($row=mysql_fetch_array($sql)){
                $nombre = $row['nombre']. ', '.$row['apellido'] ;
         		$descripcion = $row['descripcion'] ;
         		?>						
				<tr>
					<td class="text-center"><?php echo $nombre;?></td>
					<td class="text-center"><?php echo $descripcion;?></td>
					<td class="text-center">
					<?php if ($row['estado']=="Pendiente")
					{?>
					<span class="label label-warning text-center">
					<a href="consultarcobrador.php?accion=alta&idc=<?php echo $row['id'];?>&close=dor">
					<font color=white><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></font></a>
					&nbsp;&nbsp;
					<a href="consultarcobrador.php?accion=baja&idc=<?php echo $row['id'];?>&close=dor" onclick="return confirm('¿Esta seguro que desea dar de baja este cobrador?')">
					<font color=white><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></font></a>
					</span>
					<?php	}
							if ($row['estado']=="Activo")
							{
						?>
						<span class="label label-danger text-center">
						<a href="consultarcobrador.php?accion=baja&idc=<?php echo $row['id'];?>&close=dor" onclick="return confirm('¿Esta seguro que desea dar de baja este cobrador?')">
						<font color=white><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></font></a>
						</span>
						<?php
							}
						?>
					<?php if ($row['estado']=="Inactivo")
					{?>
					<span class="label label-success text-center">
					<a href="consultarcobrador.php?accion=alta&idc=<?php echo $row['id'];?>&close=dor">
					<font color=white><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></font></a>
					</span>
					<?php	}?>
					</td>
					<td class="text-center">
					<span class="label label-primary text-center">
					<a href="modificarcobrador.php?accion=modifica&idc=<?php echo $row['id'];?>&close=dor">
					<font color=white><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></font></a>
					</span>
					</td>
				</tr>
             <?php
            }
        }
  }  
?>



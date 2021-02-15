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
        
            $sql = mysql_query("select f.id as idfamilia, f.nombre, f.apellido, f.dni, f.fechanacimiento, f.parentesco from familiares f inner join socios s on s.id=f.socio_id where (s.nsocio = ".$b.") and (s.estado = 'Activo') " ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
			<table class="table table-striped table-bordered">
			<tr>
			<th class="warning">Nombre</th>
			<th class="warning">DNI</th>
			<th  class="warning">Fecha de Nacimiento</th>
			<th  class="warning">Parentesco</th>
			<th class="warning">Editar</th>
			</tr>
			<?php
				while($row=mysql_fetch_array($sql)){
                $nombre = $row['nombre']. ', '.$row['apellido'] ;
         		$dni = $row['dni'] ;
         		$fechanacimiento = $row['fechanacimiento'] ;
				$parentesco = $row['parentesco'] ;
         		?>					
				<tr>
					<td><?php echo $nombre;?></td>
					<td><?php echo $dni;?></td>
					<td><?php echo $fechanacimiento;?></td>
					<td><?php echo $parentesco;?></td>
					<td>
					<a href="modificarfamiliar.php?accion=modifica&idf=<?php echo $row['idfamilia'];?>&close=dor">
					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
					</td>
					</tr>
			</table>
             <?php
            }
        }
  }

  function consultar() { 
  	{?>
            	
            	<table class="table table-striped table-bordered">
            	<tr>
			<th class="warning">Nombre</th>
			<th class="warning">DNI</th>
			<th  class="warning">Fecha de Nacimiento</th>
			<th  class="warning">Parentesco</th>
			<th class="warning">Editar</th>
				</tr>
				
             <?php
            
        
  }
  }  
?>

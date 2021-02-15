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
        
            $sql = mysql_query("select f.id as idfamilia, f.foto, f.nombre, f.apellido, f.dni, f.fechanacimiento, f.parentesco from familiares f inner join socios s on s.id=f.socio_id where (s.nsocio = ".$b.") and (f.estado = 'Activo') " ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
			<table class="table table-striped table-bordered">
			<tr>
			<th class="success text-center">Foto</th>
			<th class="success text-center">Nombre</th>
			<th class="success text-center">DNI</th>
			<th class="success text-center">Fecha de Nacimiento</th>
			<th class="success text-center">Parentesco</th>
			<th class="success text-center">Editar foto</th>
			<th class="success text-center">Baja</th>
			<th class="success text-center">Editar</th>
			</tr>
			<?php
				while($row=mysql_fetch_array($sql)){
                $nombre = $row['nombre']. ', '.$row['apellido'] ;
         		$dni = $row['dni'] ;
         		$fechanacimiento = $row['fechanacimiento'] ;
				$parentesco = $row['parentesco'] ;
				$foto = $row['foto'] ;
         		?>					
				<tr>
					<td class="text-center">
						<img class="img-rounded" src="foto\familiar\<?php echo $row['foto'];?>" width="75px" height="75px">
					</td>
					<td class="text-center"><?php echo $nombre;?></td>
					<td class="text-center"><?php echo $dni;?></td>
					<td class="text-center"><?php echo $fechanacimiento;?></td>
					<td class="text-center"><?php echo $parentesco;?></td>
					<td class="text-center">
					<span class="label label-success text-center">
					<a href="fotofamiliar.php?accion=modifica&idf=<?php echo $row['idfamilia'];?>&close=dor">
					<font color=white><span class="glyphicon glyphicon-user" aria-hidden="true"></span></font></a>
					</span>
					</td>
					<td class="text-center">
					<span class="label label-danger text-center">
					<a href="consultarfamiliar.php?accion=baja&idf=<?php echo $row['idfamilia'];?>&close=dor">
					<font color=white><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></font></a>
					</span>
					</td>
					<td class="text-center">
					<span class="label label-primary text-center">
					<a href="modificarfamiliar.php?accion=modifica&idf=<?php echo $row['idfamilia'];?>&close=dor">
					<font color=white><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></font></a>
					</span>
					</td>
					</tr>
             <?php
            }
        }
  }

  function consultar() { 
  	{?>
            	
            	<table class="table table-striped table-bordered">
            	<tr>
			<th class="success text-center">Foto</th>
			<th class="success text-center">Nombre</th>
			<th class="success text-center">DNI</th>
			<th class="success text-center">Fecha de Nacimiento</th>
			<th class="success text-center">Parentesco</th>
			<th class="success text-center">Editar foto</th>
			<th class="success text-center">Baja</th>
			<th class="success text-center">Editar</th>
				</tr>
             <?php
            
        
  }
  }  
?>

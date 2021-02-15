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
        
            $sql = mysql_query("select id, nombre, apellido, dni, fechanacimiento, parentesco from familiares where (socio_id = ".$b.") and (estado = 'Activo') " ,$con);
              
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
			<th  class="warning">Accion</th>
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
			<th class="warning">Nombre</th>
			<th class="warning">DNI</th>
			<th  class="warning">Fecha de Nacimiento</th>
			<th  class="warning">Parentesco</th>
			<th  class="warning">Accion</th>
				</tr>
				
             <?php
            
        
  }
  }  
?>

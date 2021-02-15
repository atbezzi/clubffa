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
        
            $sql = mysql_query("select id, nsocio, foto, nombre, apellido, tipo from socios WHERE (nombre LIKE '%".$b."%' OR apellido LIKE '%".$b."%' OR nsocio LIKE '%".$b."%') and (estado = 'Aprobado') " ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
			<table class="table table-striped table-bordered">
			<tr>
			<th class="success text-center">Número de socio</th>
			<th class="success text-center">Nombre</th>
			<th class="success text-center">Tipo de socio</th>
			</tr>
			<?php
				while($row=mysql_fetch_array($sql)){
				$nsocio = $row['nsocio'] ;
                $nombre = $row['nombre']. ', '.$row['apellido'] ;
         		$tipo = $row['tipo'] ;
         		?>					
				<tr>
					<td class="text-center"><?php echo $nsocio;?></td>
					<td class="text-center"><?php echo $nombre;?></td>
					<td class="text-center"><?php echo $tipo;?></td>
				</tr>
             <?php
            }
        }
  }

  function consultar() { 
  	 $con = mysql_connect('localhost','root', '');
            mysql_select_db('clubffaa', $con);
        
            $sql = mysql_query("select id, nsocio, foto, nombre, apellido, tipo from socios where estado = 'Aprobado' " ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
            	<table class="table table-striped table-bordered">
            	<tr>
				<th class="success text-center">Número de socio</th>
				<th class="success text-center">Nombre</th>
				<th class="success text-center">Tipo de socio</th>
				</tr>
				<?php
				while($row=mysql_fetch_array($sql)){
				$nsocio = $row['nsocio'] ;
                $nombre = $row['nombre']. ', '.$row['apellido'] ;
         		$tipo = $row['tipo'] ;
         		?>						
				<tr>
					<td class="text-center"><?php echo $nsocio;?></td>
					<td class="text-center"><?php echo $nombre;?></td>
					<td class="text-center"><?php echo $tipo;?></td>
				</tr>
             <?php
            }
        }
  }  
?>

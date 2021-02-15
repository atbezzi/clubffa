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
        
            $sql = mysql_query("SELECT * FROM categorias c WHERE c.descripcion LIKE '%".$b."%' LIMIT 10" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
			<table class="table table-striped table-bordered">
			<tr>
				<th class="success">Nombre</th>
				<th class="success">Tipo</th>
				<th class="success">Estado</th>
				<th class="success">Editar</th>
			</tr>
			<?php
				while($row=mysql_fetch_array($sql)){
                $descripcion = $row['descripcion'];
         		$tipo = $row['tipo'] ;
				$estado = $row['estado'] ;
         		?>					
				<tr>
						<td><?php echo $descripcion;?></td>
						<td><?php echo $tipo;?></td>
						<td><?php echo $estado;?></td>
						<td>
						<a href="modificartarifas.php?accion=modifica&idc=<?php echo $row['id'];?>&close=dor">
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
        
            $sql = mysql_query("SELECT * FROM categorias c" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
            	<table class="table table-striped table-bordered">
            	<tr>
					<th class="success">Nombre</th>
				    <th class="success">Tipo</th>
				    <th class="success">Estado</th>
					<th class="success">Editar</th>
				</tr>
				<?php
				while($row=mysql_fetch_array($sql)){
                $descripcion = $row['descripcion'];
         		$tipo = $row['tipo'] ;
				$estado = $row['estado'] ;
         		?>					
				<tr>
						<td><?php echo $descripcion;?></td>
						<td><?php echo $tipo;?></td>
						<td><?php echo $estado;?></td>
						<td>
						<a href="modificartarifas.php?accion=modifica&idc=<?php echo $row['id'];?>&close=dor">
						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
						</td>
				</tr>
             <?php
            }
        }
  }  
?>
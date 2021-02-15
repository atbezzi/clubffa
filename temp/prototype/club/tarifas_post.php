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
				<th class="success text-center">Nombre</th>
				<th class="success text-center">Tipo</th>
				<th class="success text-center">Estado</th>
				<th class="success text-center">Editar</th>
			</tr>
			<?php
				while($row=mysql_fetch_array($sql)){
                $descripcion = $row['descripcion'];
         		$tipo = $row['tipo'] ;
				$estado = $row['estado'] ;
         		?>					
				<tr>
						<td class="text-center"><?php echo $descripcion;?></td>
						<td class="text-center"><?php echo $tipo;?></td>
						<td class="text-center"><?php echo $estado;?></td>
						<td class="text-center">
						<span class="label label-primary text-center">
						<a href="modificartarifas.php?accion=modifica&idc=<?php echo $row['id'];?>&close=dor">
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
        
            $sql = mysql_query("SELECT * FROM categorias c" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
            	<table class="table table-striped table-bordered">
            	<tr>
					<th class="success text-center">Nombre</th>
				    <th class="success text-center">Tipo</th>
				    <th class="success text-center">Estado</th>
					<th class="success text-center">Editar</th>
				</tr>
				<?php
				while($row=mysql_fetch_array($sql)){
                $descripcion = $row['descripcion'];
         		$tipo = $row['tipo'] ;
				$estado = $row['estado'] ;
         		?>					
				<tr>
						<td class="text-center"><?php echo $descripcion;?></td>
						<td class="text-center"><?php echo $tipo;?></td>
						<td class="text-center"><?php echo $estado;?></td>
						<td class="text-center">
						<span class="label label-primary text-center">
						<a href="modificartarifas.php?accion=modifica&idc=<?php echo $row['id'];?>&close=dor">
						<font color=white><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></font></a>
						</span>
						</td>
				</tr>
             <?php
            }
        }
  }  
?>
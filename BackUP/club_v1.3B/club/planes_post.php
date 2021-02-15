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
        
            $sql = mysql_query("select p.id, p.descripcion, p.detalle, c.descripcion as categoria, p.cantidad_familiar, p.meses, p.importe from planes p inner join categorias c on c.id = p.categoria_id where p.descripcion LIKE '%".$b."%' and p.estado = 'Activo'" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
			<table class="table table-striped table-bordered">
			<tr>							
				<th class="success text-center">Descripción</th>
				<th class="success text-center">Detalle</th>
				<th class="success text-center">Categoria</th>
				<th class="success text-center">Familiares</th>
				<th class="success text-center">Meses</th>
				<th class="success text-center">Importe</th>
				<th class="success text-center">Editar</th>
			</tr>
			<?php
				while($row=mysql_fetch_array($sql)){
                $descripcion = $row['descripcion'] ;
				$detalle = $row['detalle'] ;
				$categoria = $row['categoria'] ;
         		$cantidad_familiar = $row['cantidad_familiar'] ;
         		$meses = $row['meses'] ;
                $importe = $row['importe'] ;
         		?>					
				<tr>
					<td class="text-left"><?php echo $descripcion;?></td>
					<td class="text-left"><?php echo $detalle;?></td>
					<td class="text-left"><?php echo $categoria;?></td>
					<td class="text-right"><?php echo $cantidad_familiar;?></td>
					<td class="text-right"><?php echo $meses;?></td>
					<td class="text-right"><?php echo "$".$importe;?></td>
					<td class="text-center">
					<span class="label label-primary text-center">
					<a href="modificartarifaplan.php?accion=modifica&idp=<?php echo $row['id'];?>&close=dor">
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
        
            $sql = mysql_query("select p.id, p.descripcion, p.detalle, c.descripcion as categoria, p.cantidad_familiar, p.meses, p.importe from planes p inner join categorias c on c.id = p.categoria_id where p.estado = 'Activo'" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
            	<table class="table table-striped table-bordered">
            	<tr>							
					<th class="success text-center">Descripción</th>
					<th class="success text-center">Detalle</th>
					<th class="success text-center">Categoria</th>
					<th class="success text-center">Familiares</th>
					<th class="success text-center">Meses</th>
					<th class="success text-center">Importe</th>
					<th class="success text-center">Editar</th>
				</tr>
				<?php
				while($row=mysql_fetch_array($sql)){
                $descripcion = $row['descripcion'] ;
				$detalle = $row['detalle'] ;
				$categoria = $row['categoria'] ;
         		$cantidad_familiar = $row['cantidad_familiar'] ;
         		$meses = $row['meses'] ;
                $importe = $row['importe'] ;
         		?>					
				<tr>
					<td class="text-left"><?php echo $descripcion;?></td>
					<td class="text-left"><?php echo $detalle;?></td>
					<td class="text-left"><?php echo $categoria;?></td>
					<td class="text-right"><?php echo $cantidad_familiar;?></td>
					<td class="text-right"><?php echo $meses;?></td>
					<td class="text-right"><?php echo "$".$importe;?></td>
					<td class="text-center">
					<span class="label label-primary text-center">
					<a href="modificartarifaplan.php?accion=modifica&idp=<?php echo $row['id'];?>&close=dor">
					<font color=white><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></font></a>
					</span>
					</td>
				</tr>
             <?php
            }
        }
  }  
?>

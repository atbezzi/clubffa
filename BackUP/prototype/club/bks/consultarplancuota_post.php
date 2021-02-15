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
        
            $sql = mysql_query("select p.id as idplan, p.descripcion, c.descripcion as categoria, p.cantidad_familiar as familiares, p.cantidad_cuota as cuotas, p.importe 
			from planes p inner join categorias c on c.id = p.categoria_id where p.estado = 'Activo' and (p.descripcion LIKE '%".$b."%' OR c.descripcion LIKE '%".$b."%')" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
			<table class="table table-striped table-bordered">
			<tr>							
			<th class="success text-center">Descripcion</th>
			<th class="success text-center">Categoria</th>
			<th class="success text-center">Familiares</th>
			<th class="success text-center">Cuotas</th>
			<th class="success text-center">Importe</th>
			<th class="success text-center">Baja</th>
			</tr>
			<?php
				while($row=mysql_fetch_array($sql)){
                $descripcion = $row['descripcion'] ;
				$categoria = $row['categoria'] ;
         		$familiares = $row['familiares'] ;
         		$cuotas = $row['cuotas'] ;
                $importe = $row['importe'] ;
         		?>					
				<tr>
					<td class="text-center"><?php echo $descripcion;?></td>
					<td class="text-center"><?php echo $categoria;?></td>
					<td class="text-center"><?php echo $familiares;?></td>
					<td class="text-center"><?php echo $cuotas;?></td>
					<td class="text-center"><?php echo $importe;?></td>
					<td class="text-center">
					<span class="label label-danger text-center">
					<a href="consultarplancuota.php?accion=baja&idp=<?php echo $row['idplan'];?>&close=dor">
					<font color=white><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></font></a>
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
        
            $sql = mysql_query("select p.id as idplan, p.descripcion, c.descripcion as categoria, p.cantidad_familiar as familiares, p.cantidad_cuota as cuotas, p.importe 
			from planes p inner join categorias c on c.id = p.categoria_id where p.estado = 'Activo'" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
            	<table class="table table-striped table-bordered">
            	<tr>							
				<th class="success text-center">Descripcion</th>
				<th class="success text-center">Categoria</th>
				<th class="success text-center">Familiares</th>
				<th class="success text-center">Cuotas</th>
				<th class="success text-center">Importe</th>
				<th class="success text-center">Baja</th>
				</tr>
				<?php
				while($row=mysql_fetch_array($sql)){
                $descripcion = $row['descripcion'] ;
				$categoria = $row['categoria'] ;
         		$familiares = $row['familiares'] ;
         		$cuotas = $row['cuotas'] ;
                $importe = $row['importe'] ;
         		?>					
				<tr>
					<td class="text-center"><?php echo $descripcion;?></td>
					<td class="text-center"><?php echo $categoria;?></td>
					<td class="text-center"><?php echo $familiares;?></td>
					<td class="text-center"><?php echo $cuotas;?></td>
					<td class="text-center"><?php echo $importe;?></td>
					<td class="text-center">
					<span class="label label-danger text-center">
					<a href="consultarplancuota.php?accion=baja&idp=<?php echo $row['idplan'];?>&close=dor">
					<font color=white><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></font></a>
					</span>
					</td>
				</tr>
             <?php
            }
        }
  }  
?>

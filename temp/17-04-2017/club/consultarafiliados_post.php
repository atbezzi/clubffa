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
        
            $sql = mysql_query("select id, nsocio, nombre, apellido, tipo from socios WHERE (nombre LIKE '%".$b."%' OR apellido LIKE '%".$b."%' OR nsocio LIKE '%".$b."%') and (estado = 'Activo') " ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
			<table class="table table-striped table-bordered">
			<tr>
				<th class="warning">Numero de socio</th>
				<th class="warning">Nombre del socio</th>
				<th class="warning">Tipo de socio</th>
				<th  class="warning">Accion</th>
				<th class="warning">Ver</th>
			</tr>
			<?php
				while($row=mysql_fetch_array($sql)){
				$nsocio = $row['nsocio'] ;
                $nombre = $row['nombre']. ', '.$row['apellido'] ;
         		$tipo = $row['tipo'] ;
         		?>					
				<tr>
					<td><?php echo $nsocio;?></td>
					<td><?php echo $nombre;?></td>
					<td><?php echo $tipo;?></td>
					<td>
									<div>
									<?php

									if ($row['tipo'] == 'Civil'){
										echo '<h7><a href="modificarformularioscivil.php?accion=modifica&idu='.$row['id'].'&close=dor"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a></h7>';
									}else{
										if ($row['tipo'] == 'Pensionista'){
											echo '<h7><a href="modificarformulariospensionista.php?accion=modifica&idu='.$row['id'].'&close=dor"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a></h7>';
										}else{
											if ($row['tipo'] == 'Militar'){
												echo '<h7><a href="modificarformulariosmilitar.php?accion=modifica&idu='.$row['id'].'&close=dor"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a></h7>';
											}
										}
									}
									?>
									</div>
									</td>
									<td>
									<a href="#" data-toggle="modal" data-target="#myModal" data-id="<?php echo $datos['id'];?>">
									<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
									</td>
					</tr>
             <?php
            }
        }
  }

  function consultar() { 
  	 $con = mysql_connect('localhost','root', '');
            mysql_select_db('clubffaa', $con);
        
            $sql = mysql_query("select id, nsocio, nombre, apellido, tipo from socios where estado = 'Activo' " ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
            	<table class="table table-striped table-bordered">
            	<tr>
					<th class="warning">Numero de socio</th>
					<th class="warning">Nombre del socio</th>
					<th class="warning">Tipo de socio</th>
					<th  class="warning">Accion</th>
					<th class="warning">Ver</th>
				</tr>
				<?php
				while($row=mysql_fetch_array($sql)){
				$nsocio = $row['nsocio'] ;
                $nombre = $row['nombre']. ', '.$row['apellido'] ;
         		$tipo = $row['tipo'] ;
         		?>						
				<tr>
					<td><?php echo $nsocio;?></td>
					<td><?php echo $nombre;?></td>
					<td><?php echo $tipo;?></td>
					<td>
									<div>
									<?php

									if ($row['tipo'] == 'Civil'){
										echo '<h7><a href="modificarformularioscivil.php?accion=modifica&idu='.$row['id'].'&close=dor"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a></h7>';
									}else{
										if ($row['tipo'] == 'Pensionista'){
											echo '<h7><a href="modificarformulariospensionista.php?accion=modifica&idu='.$row['id'].'&close=dor"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a></h7>';
										}else{
											if ($row['tipo'] == 'Militar'){
												echo '<h7><a href="modificarformulariosmilitar.php?accion=modifica&idu='.$row['id'].'&close=dor"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a></h7>';
											}
										}
									}
									?>
									</div>
									</td>
									<td>
									<a href="#" data-toggle="modal" data-target="#myModal" data-id="<?php echo $datos['id'];?>">
									<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
									</td>
				</tr>
             <?php
            }
        }
  }  
?>

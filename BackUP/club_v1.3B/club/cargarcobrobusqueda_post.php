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
        
            $sql = mysql_query("SELECT s.id, s.nsocio, s.nombre, s.apellido, s.tipo FROM socios s 
								where s.id not in (SELECT s.id FROM socios s JOIN plan_socio ps on (s.id=ps.socio_id) where ps.vencimiento > date(now())) and 
								(nombre LIKE '%".$b."%' OR apellido LIKE '%".$b."%' OR nsocio LIKE '%".$b."%') and s.estado = 'Activo' 
								group by s.id" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
			<table class="table table-striped table-bordered">
			<tr>
				<th class="success text-center">Numero de socio</th>
				<th class="success text-center">Nombre del socio</th>
				<th class="success text-center">Tipo de socio</th>
				<th class="success text-center">Accion</th>
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
					<td class="text-center">
					<span class="label label-primary text-center">
					<a href="cargarcobrodos.php?accion=buscar&idu=<?php echo $row['nsocio'];?>&close=dor">
					<font color=white><span class="glyphicon glyphicon-search" aria-hidden="true"></span></font></a>
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
        
            $sql = mysql_query("SELECT s.id, s.nsocio, s.nombre, s.apellido, s.tipo FROM socios s 
								where s.id not in (SELECT s.id FROM socios s JOIN plan_socio ps on (s.id=ps.socio_id) where ps.vencimiento > date(now())) and s.estado = 'Activo' 
								group by s.id" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
            	<table class="table table-striped table-bordered">
            	<tr>
					<th class="success text-center">Numero de socio</th>
					<th class="success text-center">Nombre del socio</th>
					<th class="success text-center">Tipo de socio</th>
					<th class="success text-center">Accion</th>
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
					<td class="text-center">
					<span class="label label-primary text-center">
					<a href="cargarcobrodos.php?accion=buscar&idu=<?php echo $row['nsocio'];?>&close=dor">
					<font color=white><span class="glyphicon glyphicon-search" aria-hidden="true"></span></font></a>
					</span>
					</td>
				</tr>
             <?php
            }
        }
  }  
?>

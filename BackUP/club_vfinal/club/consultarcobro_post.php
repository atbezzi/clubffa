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
        
            $sql = mysql_query("SELECT p.id as idu, DATE_FORMAT(p.fechapago,'%d/%m/%Y') as fecha, p.recibo as recibo, p.detalle as detalle, p.importe as imptotal, s.nsocio as numsocio, s.nombre as nomsocio, s.apellido as apellidosocio FROM cobros p INNER JOIN socios s ON s.id = p.socio_id  WHERE (p.recibo LIKE '%".$b."%' OR s.nsocio LIKE '%".$b."%') AND p.estado = 'Pago' ORDER by p.fechapago DESC" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
			<table class="table table-striped table-bordered">
			<tr>							
				<th class="success text-center">Fecha Pago</th>
				<th class="success text-center">Recibo</th>
				<th class="success text-center">Detalle</th>
				<th class="success text-center">Imp. total</th>
				<th class="success text-center">Número de socio</th>
				<th class="success text-center">Nombre del socio</th>
				<th class="success text-center">Imprimir</th>
			</tr>
			<?php
				while($row=mysql_fetch_array($sql)){
                $fecha = $row['fecha'] ;
				$recibo = $row['recibo'] ;
				$detalle = $row['detalle'] ;
         		$imptotal = $row['imptotal'] ;
         		$numsocio = $row['numsocio'] ;
                $snombre = $row['nomsocio']. ', '.$row['apellidosocio'] ;
         		?>					
				<tr>
					<td class="text-center"><?php echo $fecha;?></td>
					<td class="text-center"><?php echo $recibo;?></td>
					<td class="text-center"><?php echo $detalle;?></td>
					<td class="text-right"><?php echo "$".$imptotal;?></td>
					<td class="text-center"><?php echo $numsocio;?></td>
					<td class="text-left"><?php echo $snombre;?></td>
					<td class="text-center">
					<span class="label label-primary text-center">
					<a href="buscarimprimircobrosconsultas.php?accion=imprimir&idu=<?php echo $row['idu'];?>&close=dor" target="_blank">
					<font color=white><span class="glyphicon glyphicon-print" aria-hidden="true"></span></font></a>
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
        
            $sql = mysql_query("SELECT p.id as idu, DATE_FORMAT(p.fechapago,'%d/%m/%Y') as fecha, p.recibo as recibo, p.detalle as detalle, p.importe as imptotal, s.nsocio as numsocio, s.nombre as nomsocio, s.apellido as apellidosocio FROM cobros p INNER JOIN socios s ON s.id = p.socio_id WHERE p.estado = 'Pago' ORDER by p.fechapago DESC" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
            	<table class="table table-striped table-bordered">
            	<tr>							
					<th class="success text-center">Fecha pago</th>
					<th class="success text-center">Recibo</th>
					<th class="success text-center">Detalle</th>
					<th class="success text-center">Imp. total</th>
					<th class="success text-center">Número de socio</th>
					<th class="success text-center">Nombre del socio</th>
					<th class="success text-center">Imprimir</th>
				</tr>
				<?php
				while($row=mysql_fetch_array($sql)){
                $fecha = $row['fecha'] ;
				$recibo = $row['recibo'] ;
				$detalle = $row['detalle'] ;
         		$imptotal = $row['imptotal'] ;
         		$numsocio = $row['numsocio'] ;
                $snombre = $row['nomsocio']. ', '.$row['apellidosocio'] ;
         		?>					
				<tr>
					<td class="text-center"><?php echo $fecha;?></td>
					<td class="text-center"><?php echo $recibo;?></td>
					<td class="text-center"><?php echo $detalle;?></td>
					<td class="text-right"><?php echo "$".$imptotal;?></td>
					<td class="text-center"><?php echo $numsocio;?></td>
					<td class="text-left"><?php echo $snombre;?></td>
					<td class="text-center">
					<span class="label label-primary text-center">
					<a href="buscarimprimircobrosconsultas.php?accion=imprimir&idu=<?php echo $row['idu'];?>&close=dor" target="_blank">
					<font color=white><span class="glyphicon glyphicon-print" aria-hidden="true"></span></font></a>
					</span>
					</td>
					</tr>
				</tr>
             <?php
            }
        }
  }  
?>

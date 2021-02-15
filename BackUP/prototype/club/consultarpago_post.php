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
        
            $sql = mysql_query("SELECT id, recibo, detalle, importe, DATE_FORMAT(fecha,'%d/%m/%Y') as fecha FROM pagos where estado = 'Activo' and recibo LIKE '%".$b."%' ORDER BY fecha DESC" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
			<table class="table table-striped table-bordered">
			<tr>							
				<th class="success text-center">Recibo</th>
				<th class="success text-center">Detalle</th>
				<th class="success text-center">Importe</th>
				<th class="success text-center">Fecha de pago</th>
				<th class="success text-center">Anular</th>
			</tr>
			<?php
				while($row=mysql_fetch_array($sql)){
				$recibo = $row['recibo'] ;
				$detalle = $row['detalle'] ;
         		$importe = $row['importe'] ;
                $fecha = $row['fecha'] ;
         		?>					
				<tr>
					<td class="text-center"><?php echo $recibo;?></td>
					<td class="text-center"><?php echo $detalle;?></td>
					<td class="text-right"><?php echo "$".$importe;?></td>
					<td class="text-center"><?php echo $fecha;?></td>
					<td class="text-center">
					<span class="label label-danger text-center">
					<a href="consultarpago.php?accion=baja&idu=<?php echo $row['id'];?>&close=dor" onclick="return confirm('¿Esta seguro que desea dar de baja este pago?')">
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
        
            $sql = mysql_query("SELECT id, recibo, detalle, importe, DATE_FORMAT(fecha,'%d/%m/%Y') as fecha FROM pagos where estado = 'Activo' ORDER BY fecha DESC" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
            	<table class="table table-striped table-bordered">
            	<tr>							
					<th class="success text-center">Recibo</th>
					<th class="success text-center">Detalle</th>
					<th class="success text-center">Importe</th>
					<th class="success text-center">Fecha de pago</th>
					<th class="success text-center">Anular</th>
				</tr>
				<?php
				while($row=mysql_fetch_array($sql)){
				$recibo = $row['recibo'] ;
				$detalle = $row['detalle'] ;
         		$importe = $row['importe'] ;
                $fecha = $row['fecha'] ;
         		?>					
				<tr>
					<td class="text-center"><?php echo $recibo;?></td>
					<td class="text-center"><?php echo $detalle;?></td>
					<td class="text-right"><?php echo "$".$importe;?></td>
					<td class="text-center"><?php echo $fecha;?></td>
					<td class="text-center">
					<span class="label label-danger text-center">
					<a href="consultarpago.php?accion=baja&idu=<?php echo $row['id'];?>&close=dor" onclick="return confirm('¿Esta seguro que desea dar de baja este pago?')">
					<font color=white><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></font></a>
					</span>
					</td>
				</tr>
				</tr>
             <?php
            }
        }
  }  
?>

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
        
            $sql = mysql_query("SELECT s.nsocio, s.nombre, s.apellido, c.recibo, c.detalle, c.servicio, c.importe, DATE_FORMAT(c.fechaalta, '%d/%m/%Y') as fechaalta, 
			c.idaltausuario FROM cobros c INNER JOIN socios s ON c.socio_id = s.id WHERE s.nombre LIKE '%".$b."%' OR s.apellido LIKE '%".$b."%' OR s.nsocio LIKE '%".$b."%' order by s.apellido" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
			<table class="table table-striped table-bordered">
				<tr>
				<th class="success text-center">Numero de socio</th>
				<th class="success text-center">Nombre del socio</th>
				<th class="success text-center">Recibo</th>
				<th class="success text-center">Detalle</th>
				<th class="success text-center">Servicio</th>
				<th class="success text-center">Importe</th>
				<th class="success text-center">Fecha de alta</th>
				<th class="success text-center">Usuario alta</th>
				</tr>
			<?php
				while($row=mysql_fetch_array($sql)){
				$nsocio = $row['nsocio'] ;
                $nombre = $row['apellido']. ', '.$row['nombre'] ;
				$recibo = $row['recibo'] ;
				$detalle = $row['detalle'] ;
				$servicio = $row['servicio'] ;
				$importe = $row['importe'] ;
         		$fechaalta = $row['fechaalta'] ;
         		$idaltausuario = $row['idaltausuario'] ;
         		?>					
				<tr>
				<td class="text-center"><?php echo $nsocio;?></td>
				<td class="text-center"><?php echo $nombre;?></td>
				<td class="text-center"><?php echo $recibo;?></td>
				<td class="text-center"><?php echo $detalle;?></td>
				<td class="text-center"><?php echo $servicio;?></td>
				<td class="text-center"><?php echo $importe;?></td>
				<td class="text-center"><?php echo $fechaalta;?></td>
				<td class="text-center"><?php echo $idaltausuario;?></td>
				</tr>
             <?php
            }
        }
  }

  function consultar() { 
  	 $con = mysql_connect('localhost','root', '');
            mysql_select_db('clubffaa', $con);
        
            $sql = mysql_query("SELECT s.nsocio, s.nombre, s.apellido, c.recibo, c.detalle, c.servicio, c.importe, DATE_FORMAT(c.fechaalta, '%d/%m/%Y') as fechaalta, 
			c.idaltausuario FROM cobros c INNER JOIN socios s ON c.socio_id = s.id order by s.apellido" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
            <table class="table table-striped table-bordered">
            	<tr>
				<th class="success text-center">Numero de socio</th>
				<th class="success text-center">Nombre del socio</th>
				<th class="success text-center">Recibo</th>
				<th class="success text-center">Detalle</th>
				<th class="success text-center">Servicio</th>
				<th class="success text-center">Importe</th>
				<th class="success text-center">Fecha de alta</th>
				<th class="success text-center">Usuario alta</th>
				</tr>
				<?php
				while($row=mysql_fetch_array($sql)){
				$nsocio = $row['nsocio'] ;
                $nombre = $row['apellido']. ', '.$row['nombre'] ;
				$recibo = $row['recibo'] ;
				$detalle = $row['detalle'] ;
				$servicio = $row['servicio'] ;
				$importe = $row['importe'] ;
         		$fechaalta = $row['fechaalta'] ;
         		$idaltausuario = $row['idaltausuario'] ;
         		?>						
				<tr>
				<td class="text-center"><?php echo $nsocio;?></td>
				<td class="text-center"><?php echo $nombre;?></td>
				<td class="text-center"><?php echo $recibo;?></td>
				<td class="text-center"><?php echo $detalle;?></td>
				<td class="text-center"><?php echo $servicio;?></td>
				<td class="text-center"><?php echo $importe;?></td>
				<td class="text-center"><?php echo $fechaalta;?></td>
				<td class="text-center"><?php echo $idaltausuario;?></td>
				</tr>
             <?php
            }
        }
  }
?>

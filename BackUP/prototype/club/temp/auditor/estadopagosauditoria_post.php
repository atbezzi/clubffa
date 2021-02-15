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
        
            $sql = mysql_query("SELECT p.id, p.recibo, p.detalle, p.importe, DATE_FORMAT(p.fechaalta, '%d/%m/%Y') as fechaalta, p.idaltausuario FROM pagos p 
			WHERE p.recibo LIKE '%".$b."%' OR p.detalle LIKE '%".$b."%' ORDER BY p.id" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
			<table class="table table-striped table-bordered">
				<tr>
				<th class="success text-center">ID</th>
				<th class="success text-center">Recibo</th>
				<th class="success text-center">Detalle</th>
				<th class="success text-center">Importe</th>
				<th class="success text-center">Fecha de alta</th>
				<th class="success text-center">Usuario alta</th>
				</tr>
			<?php
				while($row=mysql_fetch_array($sql)){
				$id = $row['id'] ;
				$recibo = $row['recibo'] ;
				$detalle = $row['detalle'] ;
				$importe = $row['importe'] ;
         		$fechaalta = $row['fechaalta'] ;
         		$idaltausuario = $row['idaltausuario'] ;
         		?>					
				<tr>
				<td class="text-center"><?php echo $id;?></td>
				<td class="text-center"><?php echo $recibo;?></td>
				<td class="text-center"><?php echo $detalle;?></td>
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
        
            $sql = mysql_query("SELECT p.id, p.recibo, p.detalle, p.importe, DATE_FORMAT(p.fechaalta, '%d/%m/%Y') as fechaalta, p.idaltausuario FROM pagos p ORDER BY p.id" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
            <table class="table table-striped table-bordered">
            	<tr>
				<th class="success text-center">ID</th>
				<th class="success text-center">Recibo</th>
				<th class="success text-center">Detalle</th>
				<th class="success text-center">Importe</th>
				<th class="success text-center">Fecha de alta</th>
				<th class="success text-center">Usuario alta</th>
				</tr>
				<?php
				while($row=mysql_fetch_array($sql)){
				$id = $row['id'] ;
				$recibo = $row['recibo'] ;
				$detalle = $row['detalle'] ;
				$importe = $row['importe'] ;
         		$fechaalta = $row['fechaalta'] ;
         		$idaltausuario = $row['idaltausuario'] ;
         		?>						
				<tr>
				<td class="text-center"><?php echo $id;?></td>
				<td class="text-center"><?php echo $recibo;?></td>
				<td class="text-center"><?php echo $detalle;?></td>
				<td class="text-center"><?php echo $importe;?></td>
				<td class="text-center"><?php echo $fechaalta;?></td>
				<td class="text-center"><?php echo $idaltausuario;?></td>
				</tr>
             <?php
            }
        }
  }
?>

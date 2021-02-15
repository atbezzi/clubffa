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
        
            $sql = mysql_query("SELECT s.nsocio, s.nombre, s.apellido, DATE_FORMAT(s.fechaalta, '%d/%m/%Y') as fechaalta, s.idaltausuario, 
			DATE_FORMAT(s.fechaupdate, '%d/%m/%Y') as fechamodifica, s.idmodificausuario from socios s WHERE s.nombre LIKE '%".$b."%' OR s.apellido LIKE '%".$b."%' OR s.nsocio LIKE '%".$b."%' order by s.apellido" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
			<table class="table table-striped table-bordered">
				<tr>
				<th class="success text-center">Numero de socio</th>
				<th class="success text-center">Nombre del socio</th>
				<th class="success text-center">Fecha de alta</th>
				<th class="success text-center">Usuario alta</th>
				<th class="success text-center">Fecha de modificaciones</th>
				<th class="success text-center">Usuario modificacion</th>
				</tr>
			<?php
				while($row=mysql_fetch_array($sql)){
				$nsocio = $row['nsocio'] ;
                $nombre = $row['apellido']. ', '.$row['nombre'] ;
         		$fechaalta = $row['fechaalta'] ;
         		$idaltausuario = $row['idaltausuario'] ;
				$fechamodifica = $row['fechamodifica'] ;
				$idmodificausuario = $row['idmodificausuario'] ;
         		?>					
				<tr>
				<td class="text-center"><?php echo $nsocio;?></td>
				<td class="text-center"><?php echo $nombre;?></td>
				<td class="text-center"><?php echo $fechaalta;?></td>
				<td class="text-center"><?php echo $idaltausuario;?></td>
				<td class="text-center"><?php echo $fechamodifica;?></td>
				<td class="text-center"><?php echo $idmodificausuario;?></td>
				</tr>
             <?php
            }
        }
  }

  function consultar() { 
  	 $con = mysql_connect('localhost','root', '');
            mysql_select_db('clubffaa', $con);
        
            $sql = mysql_query("SELECT s.nsocio, s.nombre, s.apellido, DATE_FORMAT(s.fechaalta, '%d/%m/%Y') as fechaalta, s.idaltausuario, 
			DATE_FORMAT(s.fechaupdate, '%d/%m/%Y') as fechamodifica, s.idmodificausuario from socios s order by s.apellido" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
            <table class="table table-striped table-bordered">
            	<tr>
				<th class="success text-center">Numero de socio</th>
				<th class="success text-center">Nombre del socio</th>
				<th class="success text-center">Fecha de alta</th>
				<th class="success text-center">Usuario alta</th>
				<th class="success text-center">Fecha de modificaciones</th>
				<th class="success text-center">Usuario modificacion</th>
				</tr>
				<?php
				while($row=mysql_fetch_array($sql)){
				$nsocio = $row['nsocio'] ;
                $nombre = $row['apellido']. ', '.$row['nombre'] ;
         		$fechaalta = $row['fechaalta'] ;
         		$idaltausuario = $row['idaltausuario'] ;
				$fechamodifica = $row['fechamodifica'] ;
				$idmodificausuario = $row['idmodificausuario'] ;
         		?>						
				<tr>
				<td class="text-center"><?php echo $nsocio;?></td>
				<td class="text-center"><?php echo $nombre;?></td>
				<td class="text-center"><?php echo $fechaalta;?></td>
				<td class="text-center"><?php echo $idaltausuario;?></td>
				<td class="text-center"><?php echo $fechamodifica;?></td>
				<td class="text-center"><?php echo $idmodificausuario;?></td>
				</tr>
             <?php
            }
        }
  }
?>

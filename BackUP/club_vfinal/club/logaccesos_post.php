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
        
            $sql = mysql_query("select codigo, usuario, fecha from log_accesos WHERE usuario LIKE '%".$b."%' order by codigo desc" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
			<table class="table table-striped table-bordered">
				<tr>
				<th class="success text-center">ID de acceso</th>
				<th class="success text-center">Usuario</th>
				<th class="success text-center">Fecha de acceso</th>
				</tr>
			<?php
				while($row=mysql_fetch_array($sql)){
				$codigo = $row['codigo'] ;
				$usuario = $row['usuario'] ;
				$fecha = $row['fecha'] ;
         		?>					
				<tr>
				<td class="text-center"><?php echo $codigo;?></td>
				<td class="text-center"><?php echo $usuario;?></td>
				<td class="text-center"><?php echo $fecha;?></td>
				</tr>
             <?php
            }
        }
  }

  function consultar() { 
  	 $con = mysql_connect('localhost','root', '');
            mysql_select_db('clubffaa', $con);
        
            $sql = mysql_query("select codigo, usuario, fecha from log_accesos order by codigo desc" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
            <table class="table table-striped table-bordered">
            	<tr>
				<th class="success text-center">ID de acceso</th>
				<th class="success text-center">Usuario</th>
				<th class="success text-center">Fecha de acceso</th>
				</tr>
				<?php
				while($row=mysql_fetch_array($sql)){
				$codigo = $row['codigo'] ;
				$usuario = $row['usuario'] ;
				$fecha = $row['fecha'] ;
         		?>						
				<tr>
				<td class="text-center"><?php echo $codigo;?></td>
				<td class="text-center"><?php echo $usuario;?></td>
				<td class="text-center"><?php echo $fecha;?></td>
				</tr>
             <?php
            }
        }
  }
?>

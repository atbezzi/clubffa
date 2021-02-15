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
        
            $sql = mysql_query("SELECT * FROM categorias c WHERE c.descripcion LIKE '%".$b."%' LIMIT 10" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
			<table class="table table-striped table-bordered">
			<tr>
				<th class="warning">Nombre</th>
				<th class="warning">Tipo</th>
				<th class="warning">Estado</th>
				<th class="warning">Acciones</th>
				<th class="warning">Editar</th>
			</tr>
			<?php
				while($row=mysql_fetch_array($sql)){
                $descripcion = $row['descripcion'];
         		$tipo = $row['tipo'] ;
				$estado = $row['estado'] ;
         		?>					
				<tr>
						<td><?php echo $descripcion;?></td>
						<td><?php echo $tipo;?></td>
						<td><?php echo $estado;?></td>
						<td>
						<?php if ($row['estado']=="P")
						{?>
						<a href="consultarcategorias.php?accion=alta&idc=<?php echo $row['id'];?>&close=dor">
						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
						&nbsp;&nbsp;
						<a href="consultarcategorias.php?accion=baja&idc=<?php echo $row['id'];?>&close=dor">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
						<?php	}
								if ($row['estado']=="Activo")
								{
							?>
							<a href="consultarcategorias.php?accion=baja&idc=<?php echo $row['id'];?>&close=dor">
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
							<?php
								}
							?>
						<?php if ($row['estado']=="Inactivo")
						{?>
						<a href="consultarcategorias.php?accion=alta&idc=<?php echo $row['id'];?>&close=dor">
						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
						<?php	}?>
						</td>
						<td>
						<a href="modificarcategorias.php?accion=modifica&idc=<?php echo $row['id'];?>&close=dor">
						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
						</td>
					</tr>
             <?php
            }
        }
  }

  function consultar() { 
  	 $con = mysql_connect('localhost','root', '');
            mysql_select_db('clubffaa', $con);
        
            $sql = mysql_query("SELECT * FROM categorias c" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
            	<table class="table table-striped table-bordered">
            	<tr>
					<th class="warning">Nombre</th>
				    <th class="warning">Tipo</th>
				    <th class="warning">Estado</th>
					<th class="warning">Acciones</th>
					<th class="warning">Editar</th>
				</tr>
				<?php
				while($row=mysql_fetch_array($sql)){
                $descripcion = $row['descripcion'];
         		$tipo = $row['tipo'] ;
				$estado = $row['estado'] ;
         		?>					
				<tr>
						<td><?php echo $descripcion;?></td>
						<td><?php echo $tipo;?></td>
						<td><?php echo $estado;?></td>
						<td>
						<?php if ($row['estado']=="P")
						{?>
						<a href="consultarcategorias.php?accion=alta&idc=<?php echo $row['id'];?>&close=dor">
						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
						&nbsp;&nbsp;
						<a href="consultarcategorias.php?accion=baja&idc=<?php echo $row['id'];?>&close=dor">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
						<?php	}
								if ($row['estado']=="Activo")
								{
							?>
							<a href="consultarcategorias.php?accion=baja&idc=<?php echo $row['id'];?>&close=dor">
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
							<?php
								}
							?>
						<?php if ($row['estado']=="Inactivo")
						{?>
						<a href="consultarcategorias.php?accion=alta&idc=<?php echo $row['id'];?>&close=dor">
						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
						<?php	}?>
						</td>
						<td>
						<a href="modificarcategorias.php?accion=modifica&idc=<?php echo $row['id'];?>&close=dor">
						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
						</td>
				</tr>
             <?php
            }
        }
  }  
?>
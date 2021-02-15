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
        
            $sql = mysql_query("select p.id, p.descripcion, p.detalle, c.descripcion as categoria, p.cantidad_familiar, p.meses, p.importe from planes p inner join categorias c on c.id = p.categoria_id where p.descripcion LIKE '%".$b."%' and p.estado = 'Activo'" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
			<table class="table table-striped table-bordered">
			<tr>							
				<th class="success text-center">Descripción</th>
				<th class="success text-center">Detalle</th>
				<th class="success text-center">Categoria</th>
				<th class="success text-center">Familiares</th>
				<th class="success text-center">Meses</th>
				<th class="success text-center">Importe</th>
				<th class="success text-center">Anular</th>
			</tr>
			<?php
				while($row=mysql_fetch_array($sql)){
                $descripcion = $row['descripcion'] ;
				$detalle = $row['detalle'] ;
				$categoria = $row['categoria'] ;
         		$cantidad_familiar = $row['cantidad_familiar'] ;
         		$meses = $row['meses'] ;
                $importe = $row['importe'] ;
         		?>					
				<tr>
					<td class="text-left"><?php echo $descripcion;?></td>
					<td class="text-left"><?php echo $detalle;?></td>
					<td class="text-left"><?php echo $categoria;?></td>
					<td class="text-right"><?php echo $cantidad_familiar;?></td>
					<td class="text-right"><?php echo $meses;?></td>
					<td class="text-right"><?php echo "$".$importe;?></td>
					<td class="text-center">
					<span class="label label-danger text-center">
					<a href="consultarplanes.php?accion=anular&idp=<?php echo $row['id'];?>&close=dor" onclick="return confirm('¿Esta seguro que desea dar de baja este plan?')">
					<font color=white><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></font></a>
					</span>
					</td>
				</tr>
				<!-- Modal -->
				<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel"><span class="label label-success">Datos de Cobro</span></h4>
					  </div>
					  <div class="modal-body">
						<input type="hidden" id="lblidu" name="lblidu" class="form-control">
						<div id="tablacobros" name="tablacobros">
						</div>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="pull-right botoncss" data-dismiss="modal">Cerrar</button>
					  </div>
					</div>
				  </div>
				</div>
             <?php
            }
        }
  }

  function consultar() { 
  	 $con = mysql_connect('localhost','root', '');
            mysql_select_db('clubffaa', $con);
        
            $sql = mysql_query("select p.id, p.descripcion, p.detalle, c.descripcion as categoria, p.cantidad_familiar, p.meses, p.importe from planes p inner join categorias c on c.id = p.categoria_id where p.estado = 'Activo'" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
            	<table class="table table-striped table-bordered">
            	<tr>							
					<th class="success text-center">Descripción</th>
					<th class="success text-center">Detalle</th>
					<th class="success text-center">Categoria</th>
					<th class="success text-center">Familiares</th>
					<th class="success text-center">Meses</th>
					<th class="success text-center">Importe</th>
					<th class="success text-center">Anular</th>
				</tr>
				<?php
				while($row=mysql_fetch_array($sql)){
                $descripcion = $row['descripcion'] ;
				$detalle = $row['detalle'] ;
				$categoria = $row['categoria'] ;
         		$cantidad_familiar = $row['cantidad_familiar'] ;
         		$meses = $row['meses'] ;
                $importe = $row['importe'] ;
         		?>					
				<tr>
					<td class="text-left"><?php echo $descripcion;?></td>
					<td class="text-left"><?php echo $detalle;?></td>
					<td class="text-left"><?php echo $categoria;?></td>
					<td class="text-right"><?php echo $cantidad_familiar;?></td>
					<td class="text-right"><?php echo $meses;?></td>
					<td class="text-right"><?php echo "$".$importe;?></td>
					<td class="text-center">
					<span class="label label-danger text-center">
					<a href="consultarplanes.php?accion=anular&idp=<?php echo $row['id'];?>&close=dor" onclick="return confirm('¿Esta seguro que desea dar de baja este plan?')">
					<font color=white><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></font></a>
					</span>
					</td>
				</tr>
			<!-- Modal -->
			<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><span class="label label-success">Datos de Cobro</span></h4>
				  </div>
				  <div class="modal-body">
					<input type="hidden" id="lblidu" name="lblidu" class="form-control">
					<div id="tablacobros" name="tablacobros">
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="pull-right botoncss" data-dismiss="modal">Cerrar</button>
				  </div>
				</div>
			  </div>
			</div>
             <?php
            }
        }
  }  
?>

<script type="text/javascript">	
 $("a[data-toggle=modal]").click(function() 
{   
	console.log($(this).attr('data-id'));
	var idulbl = $(this).attr('data-id');
	document.getElementById("lblidu").value = idulbl;
	
		$.ajax({
				url: 'buscartablacobro.php',
				type    : 'POST',
				dataType: 'json',
				data: $('#lblidu').serialize(),
				success: 
					function( data ) {
					  
					   options = '<table class="table table-striped table-bordered"><tr><th class="success">Periodo</th><th class="success">Cuota</th><th class="success">Detalle</th><th class="success">Importe</th></tr>';
							for(var i=0;i<data.length; i++)
						{
							options = options+'<tr><td class="text-center">'+data[i].periodo+'</td><td>'+data[i].cuota+'</td><td>'+data[i].detalle+'</td><td class="text-right">$ '+data[i].importe+'</td></tr>';    
								//alert (data[i].periodo);
						}
						options = options+'</table>';
						
						document.getElementById("tablacobros").innerHTML = options;
					},
					
				error:
					function( data ) {
						alert("ocurrio un error inesperado, por favor consultar con soporte tecnico");
					}
			});
});
</script>
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
        
            $sql = mysql_query("SELECT p.id as idu, p.fechapago as fecha, p.recibo as recibo, p.importetotal as imptotal, s.nsocio as numsocio, s.nombre as nomsocio, s.apellido as apellidosocio FROM pagos p INNER JOIN socios s ON s.id = p.socio_id  WHERE (p.recibo LIKE '%".$b."%' OR s.nsocio LIKE '%".$b."%') AND p.estado = 'Pago' ORDER by fecha DESC" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
			<table class="table table-striped table-bordered">
			<tr>							
				<th class="success text-center">Fecha Pago</th>
				<th class="success text-center">Recibo</th>
				<th class="success text-center">Imp. total</th>
				<th class="success text-center">Número de socio</th>
				<th class="success text-center">Nombre del socio</th>
				<th class="success text-center">Ver+</th>
				<th class="success text-center">Anular</th>
				<th class="success text-center">Imprimir</th>
			</tr>
			<?php
				while($row=mysql_fetch_array($sql)){
                $fecha = $row['fecha'] ;
				$recibo = $row['recibo'] ;
         		$imptotal = $row['imptotal'] ;
         		$numsocio = $row['numsocio'] ;
                $snombre = $row['nomsocio']. ', '.$row['apellidosocio'] ;
         		?>					
				<tr>
					<td class="text-center"><?php echo $fecha;?></td>
					<td class="text-center"><?php echo $recibo;?></td>
					<td class="text-center"><?php echo $imptotal;?></td>
					<td class="text-center"><?php echo $numsocio;?></td>
					<td class="text-center"><?php echo $snombre;?></td>
					<td class="text-center">
					<span class="label label-success text-center">
					<a href="#" data-toggle="modal" data-target="#myModal1" data-id="<?php echo $row['idu'];?>">
					<font color=white><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></font></a>
					</span>
					</td>
					<td class="text-center">
					<span class="label label-danger text-center">
					<a href="consultarcobro.php?accion=anular&idu=<?php echo $row['idu'];?>&close=dor">
					<font color=white><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></font></a>
					</span>
					</td>
					<td class="text-center">
					<span class="label label-primary text-center">
					<a href="buscarimprimircobrosdos.php?accion=imprimir&idu=<?php echo $row['idu'];?>&close=dor" target="_blank">
					<font color=white><span class="glyphicon glyphicon-print" aria-hidden="true"></span></font></a>
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
        
            $sql = mysql_query("SELECT p.id as idu, p.fechapago as fecha, p.recibo as recibo, p.importetotal as imptotal, s.nsocio as numsocio, s.nombre as nomsocio, s.apellido as apellidosocio FROM pagos p INNER JOIN socios s ON s.id = p.socio_id WHERE p.estado = 'Pago' ORDER by fecha DESC" ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
            	<table class="table table-striped table-bordered">
            	<tr>							
					<th class="success text-center">Fecha Pago</th>
					<th class="success text-center">Recibo</th>
					<th class="success text-center">Imp. total</th>
					<th class="success text-center">Número de socio</th>
					<th class="success text-center">Nombre del socio</th>
					<th class="success text-center">Ver+</th>
					<th class="success text-center">Anular</th>
					<th class="success text-center">Imprimir</th>
				</tr>
				<?php
				while($row=mysql_fetch_array($sql)){
                $fecha = $row['fecha'] ;
				$recibo = $row['recibo'] ;
         		$imptotal = $row['imptotal'] ;
         		$numsocio = $row['numsocio'] ;
                $snombre = $row['nomsocio']. ', '.$row['apellidosocio'] ;
         		?>					
				<tr>
					<td class="text-center"><?php echo $fecha;?></td>
					<td class="text-center"><?php echo $recibo;?></td>
					<td class="text-center"><?php echo $imptotal;?></td>
					<td class="text-center"><?php echo $numsocio;?></td>
					<td class="text-center"><?php echo $snombre;?></td>
					<td class="text-center">
					<span class="label label-success text-center">
					<a href="#" data-toggle="modal" data-target="#myModal2" data-id="<?php echo $row['idu'];?>">
					<font color=white><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></font></a>
					</span>
					</td>
					<td class="text-center">
					<span class="label label-danger text-center">
					<a href="consultarcobro.php?accion=anular&idu=<?php echo $row['idu'];?>&close=dor">
					<font color=white><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></font></a>
					</span>
					</td>
					<td class="text-center">
					<span class="label label-primary text-center">
					<a href="buscarimprimircobrosdos.php?accion=imprimir&idu=<?php echo $row['idu'];?>&close=dor" target="_blank">
					<font color=white><span class="glyphicon glyphicon-print" aria-hidden="true"></span></font></a>
					</span>
					</td>
					</tr>
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
							options = options+'<tr><td>'+data[i].periodo+'</td><td>'+data[i].cuota+'</td><td>'+data[i].detalle+'</td><td>'+data[i].importe+'</td></tr>';    
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
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
        
            $sql = mysql_query("select nombre, apellido, dni from socios where (nsocio = ".$b.") and (estado = 'Activo') " ,$con);
              
            $contar = @mysql_num_rows($sql);

            if($b = trim("")){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{?>
            	
			
			<?php

       if($contar > 0)
            {
            while($row=mysql_fetch_array($sql))
              {
              $nombre = $row['nombre'];
              $apellido = $row['apellido'] ;
              $dni = $row['dni'] ;
              ?>
              <label for="title" class="col-sm-12 control-label">&nbsp;Nombre de Afiliado: <span class="label label-success"><?php echo $nombre ?></span></label>
              <label for="title" class="col-sm-12 control-label">&nbsp;Apellido de Afiliado: <span class="label label-success"><?php echo $apellido ?></span></label>  
              <label for="title" class="col-sm-12 control-label">&nbsp;DNI de Afiliado: <span class="label label-success"><?php echo $dni ?></span></label>
                <?php  
              }
            }
        else
          {?>
			<label for="title" class="col-sm-12 control-label">&nbsp;Nombre de Afiliado:</label>
            <label for="title" class="col-sm-12 control-label">&nbsp;Apellido de Afiliado:</label>  
            <label for="title" class="col-sm-12 control-label">&nbsp;DNI de Afiliado:</label>
            <?php
          }
    }}
 function consultar()
    {?>
              
              <label for="title" class="col-sm-12 control-label">&nbsp;Nombre de Afiliado:</label>
            <label for="title" class="col-sm-12 control-label">&nbsp;Apellido de Afiliado:</label>  
            <label for="title" class="col-sm-12 control-label">&nbsp;DNI de Afiliado:</label>
        
             <?php
            
        
  }?>
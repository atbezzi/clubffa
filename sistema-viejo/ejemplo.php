<?php
$query = "SELECT tarjetas.*,nombrecompleto FROM tarjetas LEFT JOIN tarjetas_clientes ON tarjetas_clientes.idtarjeta = tarjetas.idtarjeta LEFT JOIN clientes ON clientes.idcliente = tarjetas_clientes.idcliente WHERE fechabaja = '0000-00-00 00:00:00' 
AND tarjetas.Nrotarjeta = '$txtelnrotarjetaabscar'";
//echo $query;
    $resp = mysql_query($query);
    
    $querytar = "SELECT tarjetas.* FROM tarjetas  WHERE  tarjetas.Nrotarjeta = '$txtelnrotarjetaabscar'";
//echo $query;
    $resptar = mysql_query($querytar);
    
    $saldoactualdelcli= 0;
    
    $total = mysql_num_rows($resp) ;
    if ($total >=1)
    {
        
        while($datos = mysql_fetch_array($resp)) {
            if ($datos[FechaBaja]==null and  $datos[nombrecompleto]==null)
            {
                $nombrecompleto = "Libre- Ok para Utilizar";
            $montoactual = $saldoactualdelcli;
            $idcliente = $datos['idtarjeta'];
            $dni = $datos['nrotarjeta'];
            $encontro="SI";
            }
            else
            {
                $nombrecompleto = $datos['nombrecompleto'];
            $montoactual = $saldoactualdelcli;
            $idcliente = $datos['idtarjeta'];
            $dni = $datos['nrotarjeta'];
            $encontro="NO";
            }    
            

        } ;
    
        
    }else{
            while($datos2 = mysql_fetch_array($resptar)) {
            $encontro="SI";
            $nombrecompleto = "Sin uso";
            $idcliente = $datos2['idtarjeta'];
            $dni = $datos2['nrotarjeta'];
            $encontro="SI";
            } ;
    }
    ?>
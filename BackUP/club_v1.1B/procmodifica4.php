<?php
include_once 'inc/conexion.php';
mysql_query('SET CHARACTER SET utf8'); //oro en polvo
$idl=$_POST['idl'];
$q=$_POST['q'];
//echo "------------------------------------------------------------hola-".$idl;
$res=mysql_query("select * from localidades where provincia_id = ".$q);
?>
<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Localidad ocupación:</label>
<select type="text" name="localidadocupa" class="form-control" id="localidadocupa" value="<?php echo $vlocalidadocupa;?>">
<?php while($fila=mysql_fetch_array($res)){
	if ($idl == $fila['id']){
		$select = "selected";
	} else{
		$select = "";
	}
?>
<option <?php echo $select; ?> value="<?php echo $fila['id']; ?>"><?php echo $fila['descripcion']; ?></option>
<?php } 
?>
</select>
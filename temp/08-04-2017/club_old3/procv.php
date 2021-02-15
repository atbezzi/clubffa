<?php
include_once 'inc/conexion.php';
mysql_query('SET CHARACTER SET utf8'); //oro en polvo
$q=$_POST['q'];
//echo "------------------------------------------------------------hola-".$q;
$res=mysql_query("select * from localidades where provincia_id =".$q);
?>
<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Localidad:</label>
<select type="text" name="localidadviveen" class="form-control" id="localidadviveen" value="<?php echo $vviveen;?>">
<?php while($fila=mysql_fetch_array($res)){
	if ($q == $fila['id']){
		$select = "selected";
	} else{
		$select = "";
	}
?>
<option <?php echo $select; ?> value="<?php echo $fila['id']; ?>"><?php echo $fila['descripcion']; ?></option>
<?php } 
?>
</select>
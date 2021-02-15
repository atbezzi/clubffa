<script src="js/ajax.js"></script>
<?php
include_once 'inc/conexion.php';
mysql_query('SET CHARACTER SET utf8'); //oro en polvo
error_reporting(0);
$q=$_POST['q'];
//echo "------------------------------------------------------------hola-".$q;
$res=mysql_query("select * from categorias where tipo = '$q' and estado = 'Activo'");
?>
<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Categorias:</label>
<select type="text" name="categoria" class="form-control" id="categoria" value="<?php echo $vcategoria;?>">
<option>Seleccione una categoría</option>
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
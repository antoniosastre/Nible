<?php 
$nota = notabyid($_GET['i']);

?>

<form action="programa.php?p=procesareditarnota&i=<?php echo $nota['id']; ?>" method="post" enctype="multipart/form-data">
<br />
<fieldset>
<legend>Título del trabajo</legend>

<input type="text" name="trabajo" value="<?php echo utf8_encode($nota['trabajo']); ?>" maxlength="99" size="99"><br />

</fieldset>
<br />
<fieldset>
<legend>Clientes</legend>

<label for="cliente">Cliente:</label>
<select name="cliente">
<option value="-1">Nuevo Cliente</option>
<option value="0">Sin cliente</option>
<?php
$todosclientes = todosclientes();
$sele = "";
while($uncliente = mysqli_fetch_array($todosclientes)){
	if($nota['cliente']==$uncliente['id']){ $sele = "selected"; }else{$sele = "";}
	if($uncliente['empresa']!=""){
		echo "<option value=\"".$uncliente['id']."\" ".$sele.">".utf8_encode($uncliente['empresa'])." (".utf8_encode($uncliente['nombre'])." ".utf8_encode($uncliente['apellidos']).")</option>";
	}else{
		echo "<option value=\"".$uncliente['id']."\" ".$sele.">".utf8_encode($uncliente['nombre'])." ".utf8_encode($uncliente['apellidos'])."</option>";
	}
}
?>
</select><br /><br />

<?php $datoscliente = clientebyid($nota['cliente']); ?>

<label for="nomcli">Nombre:</label>
<input type="text" name="nomcli" value="<?php echo utf8_encode($datoscliente['nombre']); ?>" />

<label for="apecli"> Apellidos:</label>
<input type="text" name="apecli" value="<?php echo utf8_encode($datoscliente['apellidos']); ?>" />

<label for="empcli"> Empresa:</label>
<input type="text" name="empcli" value="<?php echo utf8_encode($datoscliente['empresa']); ?>" />

<br /><br />

<label for="nifcli">DNI/CIF:</label>
<input type="text" name="nifcli" value="<?php echo utf8_encode($datoscliente['nif']); ?>" />

<label for="telcli">Teléfono:</label>
<input type="text" name="telcli" value="<?php echo $datoscliente['telefono']; ?>" />

<label for="emacli">Email:</label>
<input type="text" name="emacli" value="<?php echo utf8_encode($datoscliente['email']); ?>" />

<br /><br />

<label for="notcli">Notas:</label>
<textarea name="notcli" cols="40" rows="5"><?php echo utf8_encode($datoscliente['notas']); ?></textarea>


</fieldset>

<br />

<fieldset>
<legend>Atributos</legend>

<label for="fecha_in">Fecha In:</label>
<input type="date" name="fecha_in" value="<?php echo $nota['fecha_in']; ?>">

<label for="fecha_out">Fecha Out:</label>
<input type="date" name="fecha_out" value="<?php echo $nota['fecha_out']; ?>"><br /><br />

<label for="descripcion">Descripción:</label>
<textarea name="descripcion" cols="30" rows="5"><?php echo utf8_encode($nota['descripcion']); ?></textarea>

<label for="notas">Notas:</label>
<textarea name="notas" cols="30" rows="5"><?php echo utf8_encode($nota['notas']); ?></textarea><br /><br />

<label for="asig">Asignar:</label>
<select name="asig" >
<?php
$todosusuarios = todosidymostrar();
while($unuser = mysqli_fetch_array($todosusuarios)){
	$selected="";
	if($unuser['id']==$nota['asignado']) $selected = "selected";
echo "<option value=\"".$unuser['id']."\" ".$selected.">".
utf8_encode($unuser['mostrar'])."</option>";
}
?>
</select>
<label for="prio"> Prioridad:</label>
<select name="prioridad">
	<option value="0"<?php if($nota['prioridad']==0) echo " selected"; ?>>0 - Blanco</option>
    <option value="1"<?php if($nota['prioridad']==1) echo " selected"; ?>>1 - Verde</option>
    <option value="2"<?php if($nota['prioridad']==2) echo " selected"; ?>>2 - Azul</option>
    <option value="3"<?php if($nota['prioridad']==3) echo " selected"; ?>>3 - Amarillo</option>
    <option value="4"<?php if($nota['prioridad']==4) echo " selected"; ?>>4 - Naranja</option>
    <option value="5"<?php if($nota['prioridad']==5) echo " selected"; ?>>5 - Rojo</option>
</select>

<label for="estado"> Estado:</label>
<select name="estado">
	<option value="0"<?php if($nota['estado']==0) echo " selected"; ?>>0 - Stand by...</option>
    <option value="1"<?php if($nota['estado']==1) echo " selected"; ?>>1 - Pendiente Diseño</option>
    <option value="2"<?php if($nota['estado']==2) echo " selected"; ?>>2 - Pendiente Materiales</option>
    <option value="3"<?php if($nota['estado']==3) echo " selected"; ?>>3 - Pendiente Impresión</option>
    <option value="4"<?php if($nota['estado']==4) echo " selected"; ?>>4 - Pendiente Manipulado</option>
    <option value="5"<?php if($nota['estado']==5) echo " selected"; ?>>5 - Pendiente Instalación</option>
    <option value="6"<?php if($nota['estado']==6) echo " selected"; ?>>6 - Pendiente Recogida/Entrega</option>
    <option value="7"<?php if($nota['estado']==7) echo " selected"; ?>>7 - Pendiente Facturar</option>
    <option value="8"<?php if($nota['estado']==8) echo " selected"; ?>>8 - Pendiente Pago</option>
</select>
<br /><br />

<label for="precio">Precio:</label>
<input type="text" name="precio" value="<?php echo str_replace(".",",",$nota['precio']); ?>"> €<br />

</fieldset>

<fieldset>
<legend>Archivos</legend>
<br /><label for="file[]">Archivos:</label>
<input type="file" name="file[]" multiple="multiple"><br>

<?php
if ($archivos = archivosde($nota['id'])) {
	echo "<table border=\"0\" width=\"100%\" align=\"center\" valign=\"middle\">";
	echo "<tr><td>Archivos (".mysqli_num_rows($archivos).")</td><td>Tipo</td><td>Peso (MB)</td><td>¿Eliminar?</td></tr>";
	 while($archivo = mysqli_fetch_array($archivos)){
		 echo "<tr>";
	echo "<td><a href=\"archivos/".$nota['id']."/".$archivo['nombre']."\" target=\"new\" download=\"".$archivo['nombre']."\">".$archivo['nombre']."</a></td>";
	echo "<td>".$archivo['tipo']."</td>";
	echo "<td>".round(($archivo['peso'] / (1024*1024)),2)."</td>";
	echo "<td><input type=\"checkbox\" name=\"eliminar[]\" value=\"".$archivo['id']."\">";
		echo "</tr>";
	 }
	 echo "</table>";
  }
?>
</fieldset>
<br />
<a href="?p=vistanotas&a=t&e=t"><button>Cancelar</button></a>
<input type="submit" name="submit" value="Guardar">
</form>
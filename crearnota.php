<form action="programa.php?p=procesarcrearnota" method="post" enctype="multipart/form-data">
<br />
<fieldset>
<legend>Título del trabajo</legend>
<input type="text" name="trabajo" maxlength="99" size="99">
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
while($uncliente = mysqli_fetch_array($todosclientes)){
	if($uncliente['empresa']!=""){
		echo "<option value=\"".$uncliente['id']."\">".utf8_encode($uncliente['empresa'])." (".utf8_encode($uncliente['nombre'])." ".utf8_encode($uncliente['apellidos']).")</option>";
	}else{
		echo "<option value=\"".$uncliente['id']."\">".utf8_encode($uncliente['nombre'])." ".utf8_encode($uncliente['apellidos'])."</option>";
	}
}
?>
</select><br /><br />

<label for="nomcli">Nombre:</label>
<input type="text" name="nomcli" />

<label for="apecli"> Apellidos:</label>
<input type="text" name="apecli" />

<label for="empcli"> Empresa:</label>
<input type="text" name="empcli" />

<br /><br />

<label for="nifcli">DNI/CIF:</label>
<input type="text" name="nifcli" />

<label for="telcli">Teléfono:</label>
<input type="text" name="telcli" />

<label for="emacli">Email:</label>
<input type="text" name="emacli" />

<br /><br />

<label for="notcli">Notas:</label>
<textarea name="notcli" cols="40" rows="5"></textarea>


</fieldset>

<br />

<fieldset>
<legend>Atributos</legend>

<label for="fecha_in">Fecha In:</label>
<input type="date" name="fecha_in" value="<?php echo date("Y-m-d"); ?>">

<label for="fecha_out">Fecha Out:</label>
<input type="date" name="fecha_out"><br /><br />

<label for="descripcion">Descripción:</label>
<textarea name="descripcion" cols="30" rows="5">Descripción...</textarea>

<label for="notas">Notas:</label>
<textarea name="notas" cols="30" rows="5">Notas...</textarea><br /><br />

<label for="asig">Asignar:</label>
<select name="asig">
<?php
$todosusuarios = todosidymostrar();
while($unuser = mysqli_fetch_array($todosusuarios)){
echo "<option value=\"".utf8_encode($unuser['id'])."\">".
utf8_encode($unuser['mostrar'])."</option>";
}
?>
</select>
<label for="prioridad"> Prioridad:</label>
<select name="prioridad">
	<option value="0">0 - Blanco</option>
    <option value="1">1 - Verde</option>
    <option value="2">2 - Azul</option>
    <option value="3">3 - Amarillo</option>
    <option value="4">4 - Naranja</option>
    <option value="5">5 - Rojo</option>
</select>

<label for="estado"> Estado:</label>
<select name="estado">
	<option value="0">0 - Stand by...</option>
    <option value="1">1 - Pendiente Diseño</option>
    <option value="2">2 - Pendiente Materiales</option>
    <option value="3">3 - Pendiente Impresión</option>
    <option value="4">4 - Pendiente Manipulado</option>
    <option value="5">5 - Pendiente Instalación</option>
    <option value="6">5 - Pendiente Recogida/Entrega</option>
    <option value="7">5 - Pendiente Facturar</option>
    <option value="8">5 - Pendiente Pago</option>
</select><br /><br />

<label for="precio">Precio:</label>
<input type="text" name="precio"> €<br />

</fieldset>
<br />
<fieldset>
<legend>Archivos</legend>
<label for="file[]">Archivos:</label>
<input type="file" name="file[]" multiple="multiple"><br>
</fieldset>
<br />
<a href="?p=vistanotas&a=t&e=t"><button>Cancelar</button></a>
<input type="submit" name="submit" value="Guardar">
</form>
